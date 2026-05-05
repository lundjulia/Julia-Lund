Update the DSB Plus prototype to include a clearer check-in/check-out flow.

Use `dsb-points-checkout.html` as the current visual reference.
Use the illustration assets from:
- public/images/illustrations/coffee_illustration.png
- public/images/illustrations/croissant_illustration.png
- public/images/illustrations/slashice_illustration.png
- public/images/illustrations/sodavand_illustration.png

Add 2 extra screens before the existing checkout screens:

Screen 0A: Check-in active state
- Header: “You are checked in”
- Show current journey:
  - From: Copenhagen H
  - To: Aarhus H
  - Status: Active journey
- Show small DSB Plus note:
  - “Points will be added after checkout”
- CTA:
  - “Check out”
- Keep it calm, functional and DSB-like
- No reward push yet

Screen 0B: Check-out confirmation
- Header: “Ready to check out?”
- Show trip summary
- CTA:
  - “Check out now”
- Secondary:
  - “Continue journey”
- Add small note:
  - “Your points are calculated after the trip”
- Keep this screen simple and practical

Then keep the existing 3 screens:
1. Current checkout
2. Improved checkout with earned points
3. Non-Plus user state

Design direction:
- Clean Scandinavian UI
- DSB-inspired blue/off-white palette
- Rounded cards
- Clear spacing
- Hand-drawn reward illustrations used sparingly
- Coffee illustration only in the reward/points feedback state

For Figma:
- Build native Figma frames
- Use Auto Layout throughout
- Create reusable components
- Do not create new HTML unless explicitly asked
