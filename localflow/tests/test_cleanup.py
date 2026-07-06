import requests

from localflow.cleanup import polish, strip_fillers
from localflow.config import Config


def test_strip_fillers_removes_common_filler_words():
    assert strip_fillers("um so i think, uh, we should ship it") == (
        "So i think, we should ship it"
    )


def test_strip_fillers_capitalizes_first_letter():
    assert strip_fillers("hello there") == "Hello there"


def test_strip_fillers_collapses_whitespace():
    assert strip_fillers("hello    there\n\nfriend") == "Hello there friend"


def test_strip_fillers_empty_input():
    assert strip_fillers("") == ""


def test_polish_returns_baseline_when_cleanup_disabled():
    config = Config(cleanup_enabled=False)
    assert polish("um hello there", config) == "Hello there"


def test_polish_returns_baseline_for_empty_input():
    config = Config(cleanup_enabled=True)
    assert polish("", config) == ""


def test_polish_uses_ollama_response_when_available(monkeypatch):
    config = Config(cleanup_enabled=True)

    class FakeResponse:
        def raise_for_status(self):
            pass

        def json(self):
            return {"response": "Hello there!"}

    monkeypatch.setattr(
        "localflow.cleanup.requests.post", lambda *a, **k: FakeResponse()
    )

    assert polish("um hello there", config) == "Hello there!"


def test_polish_falls_back_to_baseline_on_connection_error(monkeypatch):
    config = Config(cleanup_enabled=True)

    def raise_connection_error(*args, **kwargs):
        raise requests.ConnectionError("ollama is not running")

    monkeypatch.setattr("localflow.cleanup.requests.post", raise_connection_error)

    assert polish("um hello there", config) == "Hello there"


def test_polish_falls_back_to_baseline_on_empty_ollama_response(monkeypatch):
    config = Config(cleanup_enabled=True)

    class EmptyResponse:
        def raise_for_status(self):
            pass

        def json(self):
            return {"response": ""}

    monkeypatch.setattr(
        "localflow.cleanup.requests.post", lambda *a, **k: EmptyResponse()
    )

    assert polish("um hello there", config) == "Hello there"
