"""Persisted user settings for localflow.

Everything lives in a JSON file under ~/.config/localflow so settings survive
restarts without ever leaving the machine.
"""

from __future__ import annotations

import json
from dataclasses import asdict, dataclass
from pathlib import Path

CONFIG_DIR = Path.home() / ".config" / "localflow"
CONFIG_PATH = CONFIG_DIR / "config.json"

# pynput key name for the default hold-to-talk key.
DEFAULT_HOTKEY = "alt_r"
DEFAULT_WHISPER_MODEL = "base.en"
DEFAULT_OLLAMA_MODEL = "llama3.2:3b"
DEFAULT_OLLAMA_URL = "http://localhost:11434"


@dataclass
class Config:
    hotkey: str = DEFAULT_HOTKEY
    whisper_model: str = DEFAULT_WHISPER_MODEL
    cleanup_enabled: bool = True
    ollama_model: str = DEFAULT_OLLAMA_MODEL
    ollama_url: str = DEFAULT_OLLAMA_URL

    @classmethod
    def load(cls, path: Path = CONFIG_PATH) -> "Config":
        if not path.exists():
            return cls()
        data = json.loads(path.read_text())
        known = {f for f in cls.__dataclass_fields__}
        return cls(**{k: v for k, v in data.items() if k in known})

    def save(self, path: Path = CONFIG_PATH) -> None:
        path.parent.mkdir(parents=True, exist_ok=True)
        path.write_text(json.dumps(asdict(self), indent=2))
