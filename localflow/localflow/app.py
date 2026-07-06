"""Menu bar app: hold the hotkey, speak, release, and the polished text is
pasted wherever your cursor is. Everything below runs on-device; the only
network call this process ever makes is to Ollama on localhost.
"""

from __future__ import annotations

import threading

import rumps

from localflow.cleanup import polish
from localflow.config import Config
from localflow.hotkey import HotkeyListener
from localflow.inject import inject_text
from localflow.recorder import Recorder
from localflow.transcriber import Transcriber

IDLE_TITLE = "🎤"
RECORDING_TITLE = "🔴 REC"
BUSY_TITLE = "⏳"


class LocalFlowApp(rumps.App):
    def __init__(self) -> None:
        super().__init__("localflow", title=IDLE_TITLE, quit_button="Quit")
        self.config = Config.load()
        self.recorder = Recorder()
        self._transcriber: Transcriber | None = None

        self.cleanup_item = rumps.MenuItem(
            "Cleanup enabled", callback=self._toggle_cleanup
        )
        self.cleanup_item.state = self.config.cleanup_enabled
        self.menu = [
            self.cleanup_item,
            rumps.MenuItem(f"Whisper model: {self.config.whisper_model}"),
            rumps.MenuItem(f"Ollama model: {self.config.ollama_model}"),
        ]

        self.hotkey = HotkeyListener(
            self.config.hotkey, self._on_activate, self._on_deactivate
        )

        threading.Thread(target=self._load_model, daemon=True).start()

    def _load_model(self) -> None:
        self._transcriber = Transcriber(self.config.whisper_model)

    def _toggle_cleanup(self, sender: rumps.MenuItem) -> None:
        self.config.cleanup_enabled = not self.config.cleanup_enabled
        sender.state = self.config.cleanup_enabled
        self.config.save()

    def _on_activate(self) -> None:
        if self._transcriber is None:
            return  # model still loading
        self.title = RECORDING_TITLE
        self.recorder.start()

    def _on_deactivate(self) -> None:
        audio = self.recorder.stop()
        self.title = BUSY_TITLE
        threading.Thread(target=self._process, args=(audio,), daemon=True).start()

    def _process(self, audio) -> None:
        try:
            raw_text = self._transcriber.transcribe(audio)
            final_text = polish(raw_text, self.config)
            inject_text(final_text)
        finally:
            self.title = IDLE_TITLE

    def run(self) -> None:
        self.hotkey.start()
        super().run()


def main() -> None:
    LocalFlowApp().run()


if __name__ == "__main__":
    main()
