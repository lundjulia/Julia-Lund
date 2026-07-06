"""Insert transcribed text at the cursor in whatever app is focused.

Goes through the clipboard + a simulated Cmd+V rather than typing character
by character: it's instant regardless of text length and works identically
in every app, matching how Wispr Flow inserts text. The clipboard's previous
contents are restored afterwards so this doesn't clobber the user's copy
buffer.
"""

from __future__ import annotations

import time

import pyperclip
from pynput.keyboard import Controller, Key

_PASTE_SETTLE_SECONDS = 0.2


def inject_text(text: str) -> None:
    if not text:
        return

    try:
        previous_clipboard = pyperclip.paste()
    except pyperclip.PyperclipException:
        previous_clipboard = None

    pyperclip.copy(text)

    keyboard = Controller()
    with keyboard.pressed(Key.cmd):
        keyboard.press("v")
        keyboard.release("v")

    time.sleep(_PASTE_SETTLE_SECONDS)

    if previous_clipboard is not None:
        pyperclip.copy(previous_clipboard)
