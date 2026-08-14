# Kopilka Slov

A compact, browser-based vocabulary app with two practice modes:

- **Words** — the original vocabulary collection, translations, examples, spaced repetition, statistics, optional Firebase sync, and JSON backup.
- **Interview** — an active Interview Vocabulary Trainer with the preloaded **JBT Marel Interview** collection.

## Interview Practice MVP

- 25 interview phrases grouped around brand, process, strategy, collaboration, and delivery
- Phrase states: New → Learning → Familiar → Interview-ready
- Daily sequence: Learn → Recall → Fill the gap → Speak → Repeat difficult phrases
- Spoken interview questions with 2–3 target phrases
- Browser speech recognition with a typed-answer fallback
- Local phrase-use tracking and spaced repetition
- Interview progress included in JSON export/import

Interview progress is stored locally in the current browser. The existing word data and Firebase synchronization format are unchanged.

## Run

Serve this folder with any simple static web server and open `index.html`. No build step is required.

## Design notes

See `INTERVIEW_TRAINER_DESIGN.md` for the agreed scope, architecture, assumptions, and decision log.
