"""Global hold-to-talk key listener.

Requires the Accessibility permission to be granted to the running process
on macOS (System Settings -> Privacy & Security -> Accessibility), the same
permission Wispr Flow itself needs to watch for its hotkey system-wide.
"""

from __future__ import annotations

from typing import Callable

from pynput import keyboard


def resolve_key(name: str) -> keyboard.Key | keyboard.KeyCode:
    """Turn a config string like 'alt_r' or 'f13' into a pynput key object."""
    special = getattr(keyboard.Key, name, None)
    if special is not None:
        return special
    if len(name) == 1:
        return keyboard.KeyCode.from_char(name)
    raise ValueError(f"Unknown hotkey name: {name!r}")


class HotkeyListener:
    def __init__(
        self,
        key_name: str,
        on_activate: Callable[[], None],
        on_deactivate: Callable[[], None],
    ) -> None:
        self._target_key = resolve_key(key_name)
        self._on_activate = on_activate
        self._on_deactivate = on_deactivate
        self._active = False
        self._listener = keyboard.Listener(
            on_press=self._handle_press, on_release=self._handle_release
        )

    def _handle_press(self, key) -> None:
        if key == self._target_key and not self._active:
            self._active = True
            self._on_activate()

    def _handle_release(self, key) -> None:
        if key == self._target_key and self._active:
            self._active = False
            self._on_deactivate()

    def start(self) -> None:
        self._listener.start()

    def stop(self) -> None:
        self._listener.stop()
