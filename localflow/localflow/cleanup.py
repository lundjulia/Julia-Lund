"""Turn a raw transcript into polished text, entirely on-device.

Two layers, both local:
1. A regex pass that strips filler words and fixes obvious spacing/casing.
   This always runs and is the fallback if Ollama is unreachable.
2. An optional pass through a local Ollama model for grammar/formatting,
   the same "polish" step Wispr Flow does in the cloud - done here against
   http://localhost only, so no text ever leaves the machine.
"""

from __future__ import annotations

import re

import requests

from localflow.config import Config

_FILLER_RE = re.compile(
    r"\b(um+|uh+|erm+|you know|i mean|like,)\b[,]?\s*", re.IGNORECASE
)
_WHITESPACE_RE = re.compile(r"\s+")

_SYSTEM_PROMPT = (
    "You clean up dictated speech transcripts. Fix grammar, punctuation, and "
    "capitalization, remove filler words and false starts, and keep the "
    "original meaning and tone. Return only the cleaned text with no "
    "commentary, quotes, or preamble."
)


def strip_fillers(text: str) -> str:
    """Cheap, offline, dependency-free cleanup pass."""
    cleaned = _FILLER_RE.sub("", text)
    cleaned = _WHITESPACE_RE.sub(" ", cleaned).strip()
    if cleaned and cleaned[0].islower():
        cleaned = cleaned[0].upper() + cleaned[1:]
    return cleaned


def ollama_available(config: Config, timeout: float = 2.0) -> bool:
    """Quick reachability check for the menu bar status item."""
    try:
        response = requests.get(f"{config.ollama_url}/api/tags", timeout=timeout)
        return response.ok
    except requests.RequestException:
        return False


def _query_ollama(text: str, config: Config, timeout: float = 15.0) -> str:
    response = requests.post(
        f"{config.ollama_url}/api/generate",
        json={
            "model": config.ollama_model,
            "system": _SYSTEM_PROMPT,
            "prompt": text,
            "stream": False,
        },
        timeout=timeout,
    )
    response.raise_for_status()
    result = response.json().get("response", "").strip()
    return result


def polish(raw_text: str, config: Config) -> str:
    """Best-effort cleanup: regex baseline, then local LLM if available."""
    baseline = strip_fillers(raw_text)
    if not baseline or not config.cleanup_enabled:
        return baseline

    try:
        polished = _query_ollama(baseline, config)
    except (requests.RequestException, ValueError):
        return baseline

    return polished or baseline
