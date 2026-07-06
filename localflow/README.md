# localflow

A private, fully local clone of [Wispr Flow](https://wisprflow.ai)'s dictation
flow: hold a hotkey anywhere on macOS, speak, release, and the polished text
is pasted at your cursor.

Unlike Wispr Flow, nothing here ever leaves your machine:

- **Transcription** runs on-device via [`faster-whisper`](https://github.com/SYSTRAN/faster-whisper)
  (a local Whisper model).
- **Cleanup** (removing filler words, fixing grammar/punctuation) is done by
  a local [Ollama](https://ollama.ai) model over `http://localhost:11434` —
  never a call to any external server.
- **Text injection** copies to the clipboard and simulates Cmd+V into
  whatever app is focused; the clipboard's previous contents are restored
  afterwards.

The only two "network" calls this app ever makes are loopback calls to
Ollama on your own machine. There is no telemetry, no account, and no cloud
fallback.

## How it works

```
hold hotkey ──▶ record mic (in-memory only)
release key ──▶ faster-whisper transcribes locally
             ──▶ regex filler-word strip (always local)
             ──▶ optional local Ollama polish pass (still local)
             ──▶ paste into focused app via clipboard + Cmd+V
```

See `localflow/recorder.py`, `transcriber.py`, `cleanup.py`, `inject.py`,
`hotkey.py`, and `app.py` for each stage.

## Setup (macOS)

1. Install system dependencies:

   ```bash
   brew install portaudio ollama
   ```

2. Create a virtualenv and install Python dependencies:

   ```bash
   cd localflow
   python3 -m venv .venv
   source .venv/bin/activate
   pip install -r requirements.txt
   ```

3. Pull a local model for the cleanup step (optional but recommended — the
   default `Config` in `localflow/config.py` expects `llama3.2:3b`):

   ```bash
   ollama pull llama3.2:3b
   ```

4. Grant Accessibility permission the first time you run the app: macOS
   requires this for any process that listens for global hotkeys or sends
   synthetic keystrokes. Go to **System Settings → Privacy & Security →
   Accessibility** and enable it for your terminal (or the packaged app,
   if you build one with `py2app`/`pyinstaller`).

5. Run it:

   ```bash
   python -m localflow.app
   ```

   A 🎤 icon appears in the menu bar. Hold the **right Option key**, speak,
   and release — the transcribed, polished text is pasted at your cursor.

## Configuration

Settings persist to `~/.config/localflow/config.json` (created on first
save) and can also be edited directly:

| Field             | Default        | Notes                                          |
| ----------------- | -------------- | ----------------------------------------------- |
| `hotkey`          | `alt_r`        | Any `pynput.keyboard.Key` name, e.g. `f13`      |
| `whisper_model`   | `base.en`      | Any faster-whisper model size (`tiny.en` … `large-v3`) |
| `cleanup_enabled` | `true`         | Toggle from the menu bar, or here               |
| `ollama_model`    | `llama3.2:3b`  | Any model you've pulled with `ollama pull`      |
| `ollama_url`      | `http://localhost:11434` | Change only if Ollama runs on a non-default port |

If Ollama isn't running, cleanup silently falls back to the regex-based
filler-word stripper in `cleanup.py`, and if that produces nothing useful,
the raw transcript is used — dictation never blocks on the LLM being
available.

## Choosing a Whisper model size

Larger models are more accurate but slower on CPU. `base.en` is a good
default for short dictation; try `small.en` if you have CPU headroom, or
`tiny.en` on older Intel Macs where latency matters more than accuracy.

## Tests

The recorder, hotkey listener, and menu bar app depend on macOS-only
libraries (`sounddevice`'s PortAudio backend, `pynput`'s global hooks,
`rumps`) and real audio/input hardware, so they aren't covered by automated
tests here. The pure logic — config persistence and the cleanup pipeline,
including its Ollama-unavailable fallback path — is:

```bash
pip install pytest
pytest
```
