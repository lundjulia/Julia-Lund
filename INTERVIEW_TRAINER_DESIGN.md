# Kopilka Slov — Interview Vocabulary Trainer MVP

## Understanding summary

- Extend the existing Kopilka Slov app without replacing its current vocabulary features.
- Add an Interview mode inside the existing Practice tab.
- Start with one preloaded collection: JBT Marel Interview, containing about 25 phrases.
- Track phrase states: New, Learning, Familiar, and Interview-ready.
- Run a compact daily flow: Learn, Recall, Fill the gap, Speak, then Repeat difficult phrases.
- Prioritize active retrieval and spoken use over passive recognition.
- Keep interview preparation—not app development—as the priority.

## Assumptions and non-functional requirements

- This is a personal app with low data volume and no multi-user scale requirements.
- Current vocabulary data and functionality must remain backward-compatible.
- Interview data is stored separately in localStorage and included in JSON backup export/import.
- Existing Firebase synchronization remains unchanged in the MVP; interview progress is local-only.
- Speech recognition uses the browser's built-in Web Speech API and is started only by the user.
- No audio recordings are retained or uploaded; a typed transcript fallback is always available.
- The app remains usable offline except for its existing translation and cloud-sync integrations.
- The existing single-file architecture remains maintainable for this bounded feature.

## Final design

### Navigation and collection home

The current Practice tab receives a compact mode switch: Words and Interview. Word practice continues to call the existing implementation unchanged. Interview opens a collection card for JBT Marel Interview showing due phrases, state counts, and a Start daily session button.

### Data model

Interview collections and phrase progress live under a new versioned localStorage key. Seed content is merged by stable phrase ID, so future versions can add content without overwriting progress. Each phrase stores its text, Russian meaning, example, category, state index, interval box, next-review date, correct/incorrect history, spoken-use history, and difficult flag.

### Session flow

A session selects a small due set, prioritizing difficult and overdue phrases. It creates five ordered stages:

1. Learn: phrase, meaning, example, and pronunciation.
2. Recall: retrieve the English phrase from its Russian meaning, then self-mark.
3. Fill the gap: type the missing phrase in an example sentence.
4. Speak: answer one interview question using 2–3 target phrases. Browser speech recognition or typed input produces a transcript; normalized phrase matching marks target phrases as used.
5. Repeat difficult phrases: retry phrases missed in Recall/Fill or unused in Speak.

### Progress and repetition

Correct retrieval advances an interval box; misses reset it and flag the phrase as difficult. Phrase state is derived from demonstrated performance, with Interview-ready requiring successful spoken use rather than recognition alone. Intervals remain intentionally simple: same session, 1 day, 3 days, 7 days, and 14 days. Difficult phrases return at the end of the current session and the next day.

### Errors and fallbacks

- Unsupported or denied microphone access shows a clear typed-answer fallback.
- Speech matching ignores case and punctuation and accepts simple inflection variants only where safe.
- An empty transcript cannot advance the Speak stage until the user either records or types an answer.
- Corrupt interview storage falls back to seeded phrases without affecting existing vocabulary.
- Import merges interview progress by stable ID and never deletes current data.

### Verification

- Static JavaScript syntax check.
- Browser smoke test of existing add/list/practice/statistics views.
- Browser test of every interview stage, typed fallback, phrase matching, state changes, difficult retry, persistence, and export/import payload shape.
- Responsive inspection at phone and desktop widths.

## Decision log

1. Interview Practice lives inside the current Practice tab, not in a fifth tab.
   - Alternatives: new tab; generalized word/phrase engine.
   - Reason: smallest safe change and cleanest mobile navigation.
2. Interview data is separate from existing word data.
   - Alternative: migrate the current word schema.
   - Reason: protects current user data and cloud synchronization.
3. The app remains a single-file application.
   - Alternative: refactor into a build-tool project.
   - Reason: the feature is bounded and a rebuild would add maintenance overhead.
4. Browser speech recognition has a typed fallback.
   - Alternative: external speech/AI service.
   - Reason: privacy, offline resilience, and no API cost.
5. Interview-ready requires successful spoken use.
   - Alternative: derive state only from spaced-repetition box.
   - Reason: the goal is active interview retrieval.
6. Existing Firebase behavior is not expanded in the MVP.
   - Alternative: synchronize interview collections immediately.
   - Reason: avoids schema risk and keeps scope aligned with interview preparation.

