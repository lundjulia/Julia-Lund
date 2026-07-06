"""Local speech-to-text via faster-whisper.

The model is downloaded once (to the faster-whisper cache) and then runs
entirely on-device with no network access at inference time.
"""

from __future__ import annotations

import numpy as np

from localflow.recorder import SAMPLE_RATE


class Transcriber:
    def __init__(self, model_size: str) -> None:
        from faster_whisper import WhisperModel

        self._model = WhisperModel(model_size, device="cpu", compute_type="int8")

    def transcribe(self, audio: np.ndarray) -> str:
        if audio.size < SAMPLE_RATE * 0.2:
            return ""
        segments, _info = self._model.transcribe(audio, language="en")
        return " ".join(segment.text.strip() for segment in segments).strip()
