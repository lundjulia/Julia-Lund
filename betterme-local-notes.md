# BetterMe Local — architecture notes

BetterMe is closed-source, so this is a functional reconstruction from the public
App Store listing (screenshots + description), not decompiled or reverse-engineered
code. The observable product architecture is a typical mobile-coaching-app shape:

- **Onboarding quiz** → goal/level inputs feed a plan generator (server-side in the
  real app, tied to a paid subscription).
- **Personalized plan**: a day-by-day calendar (Day 1…N) of workouts, checkmarked
  as completed, presumably persisted to a user account/backend.
- **Workout library**: categorized by modality (Pilates, Calisthenics, Chair Yoga),
  each workout tagged with a focus zone, duration and calorie estimate.
- **Workout player**: video-driven, per-exercise progress dots, a countdown timer,
  running elapsed time / calories, prev/next controls, and a preview of the next
  exercise.
- **Progress tracking**: streaks and history, likely synced to an account/subscription
  backend for retention and paywall gating.

## This local build

`betterme-local.html` reproduces that flow as a single, self-contained HTML file —
open it directly in a browser, no server, no build step, no account, no network
calls of any kind (no CDN fonts/scripts either). All state (generated plan, streak,
totals) lives in the browser's `localStorage` on this device only.

Since the real exercise videos, AI plan generation and account system are
proprietary/server-side, they're replaced with:
- A small built-in exercise/workout library (30 exercises, 9 workouts across the
  three modalities) with hand-authored durations and calorie estimates.
- A client-side weighted-random plan generator (goal → category mix, level →
  work-interval length, days/week → weekly rest-day template) that produces a
  14-day plan on first launch.
- A real per-second countdown timer (work/rest intervals, pause/resume, prev/next,
  auto-advance) instead of video playback.

Reset/regenerate controls live under Profile, since there's no account to delete —
just local data.
