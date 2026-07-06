"""Build a standalone macOS .app bundle: `python setup.py py2app`.

Requires `pip install py2app` first (not in requirements.txt since it's a
build-time tool, not a runtime dependency).
"""

from setuptools import setup

APP = ["localflow/app.py"]
OPTIONS = {
    "argv_emulation": False,
    "plist": {
        "LSUIElement": True,
        "CFBundleName": "localflow",
        "CFBundleIdentifier": "com.localflow.app",
        "CFBundleShortVersionString": "0.1.0",
        "NSMicrophoneUsageDescription": (
            "localflow needs microphone access to transcribe your speech "
            "on-device. Audio never leaves this Mac."
        ),
    },
    "packages": [
        "rumps",
        "pynput",
        "sounddevice",
        "numpy",
        "faster_whisper",
        "requests",
        "pyperclip",
    ],
}

setup(
    app=APP,
    name="localflow",
    options={"py2app": OPTIONS},
    setup_requires=["py2app"],
)
