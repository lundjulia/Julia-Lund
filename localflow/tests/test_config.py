from pathlib import Path

from localflow.config import Config


def test_defaults():
    config = Config()
    assert config.hotkey == "alt_r"
    assert config.cleanup_enabled is True


def test_round_trip(tmp_path: Path):
    path = tmp_path / "config.json"
    original = Config(hotkey="f13", whisper_model="small.en", cleanup_enabled=False)
    original.save(path)

    loaded = Config.load(path)

    assert loaded == original


def test_load_missing_file_returns_defaults(tmp_path: Path):
    path = tmp_path / "does_not_exist.json"
    assert Config.load(path) == Config()


def test_load_ignores_unknown_keys(tmp_path: Path):
    path = tmp_path / "config.json"
    path.write_text('{"hotkey": "f13", "some_future_field": 123}')

    loaded = Config.load(path)

    assert loaded.hotkey == "f13"
