# Byg siden i Elementor — trin for trin

Dette tema (`julia-lund-elementor`) leverer kun: header, footer, farver/fonte
som tokens, og "Case"-indholdstypen. **Selve siderne bygger du i Elementor**
efter opskriften herunder. Alt er skrevet, så resultatet matcher
søster-temaet (`julia-lund`, det redigerbare WordPress-tema), bare bygget
med widgets i stedet for blokke.

## 0. Forudsætninger (gøres én gang)

1. Aktivér temaet under **Design → Temaer**.
2. Installér og aktivér pluginet **Elementor** (gratis version er nok).
3. Gå til **Elementor → Settings → Post Types**, og sæt flueben ved **Case**
   (ellers kan du ikke redigere cases med Elementor).
4. Sæt din tagline under **Indstillinger → Generelt → Undertitel** (vises i
   headeren, fx "UX/UI & Brand Designer").
5. Opret en menu under **Udseende → Menuer** med Forside, Cases, Om mig,
   Kontakt, og tildel den til placeringen **"Primær navigation"**.
6. **Site Settings → Global Colors** (åbnes fra Elementor-editoren, det
   lille hamburgermenu-ikon øverst til venstre) — opret disse fem, så alle
   widgets kan vælge dem i farvevælgeren i stedet for at skulle huske hex-koder:

   | Navn | Hex |
   |---|---|
   | Ink | `#16140f` |
   | Stone | `#6d6a65` |
   | Paper | `#f1f0ee` |
   | Sand | `#e7e4df` |
   | Clay | `#a34a30` |

7. **Site Settings → Global Fonts**:
   - **Text** (brødtekst/knapper/navigation): `-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif`
   - **Heading** (almindelige overskrifter — alt undtagen hero'et): samme
     sans-stak som ovenfor, vægt 600.
   - Til selve hero-overskriften (kun ét sted) sætter du i stedet skrifttypen
     direkte på den ene Heading-widget (se trin 1 nedenfor): `Didot, "Bodoni MT", Georgia, "Times New Roman", serif`.

## 1. Forsiden

**Sider → Tilføj ny** → kald den "Forside" → **Rediger med Elementor**.
Sæt den bagefter som forside under **Indstillinger → Læsning → Statisk side**.

**Sektion 1 — Hero**
- Sektionens indstillinger (Advanced → CSS Classes): `hero-visual`
- Widget **Image**: `assets/images/hero-blob.svg`, CSS-klasse `hero-blob`
  (lægger sig automatisk som blødt baggrundselement bag teksten)
- Widget **Heading** (H6 eller Text): "BRAND · UX/UI · DIGITAL DESIGN" —
  farve Stone, letter-spacing ~0.12em, størrelse ~0.9rem
- Widget **Heading** (H1): "Brand & UX/UI design" — skrifttype Didot/Bodoni
  (se trin 0.7), vægt 400, **små bogstaver** (Style → Transform: lowercase),
  størrelse ~clamp(2.75rem, 4vw, 5.5rem)
- Widget **Text Editor**: "Jeg hjælper mærker og virksomheder med at se,
  føles og fungere skarpere — gennem brand identity, UX/UI og digital
  design med ro og præcision." — farve Stone
- Widget **Button**: tekst "↗ Se udvalgte cases", stil = Outline/Transparent
  med 1px kant i Ink, link til `#cases`
- Widget **Text Editor** eller **Button** (link-stil): "Kontakt mig →" →
  link til Kontakt-siden

**Sektion 2 — Kort profiltekst**
- To kolonner (36% / 64%)
- Kolonne 1: **Image**-widget, `assets/images/placeholder-portrait.svg`
- Kolonne 2: **Heading** "Om mig, kort fortalt" + **Text Editor** med
  bio-teksten (se `julia-lund`-temaets `patterns/intro-profile.php` for den
  fulde tekst) + link "Læs mere om mig →"

**Sektion 3 — Udvalgte cases** (giv sektionen ID/anker `cases`)
- **Heading** "Udvalgte cases" + link "Se alle cases →" i samme række
  (Columns: 2 kolonner, højre kolonne højrestillet)
- Widget **Posts**:
  - Source → Post Type: **Case**
  - Columns: 3, Posts Per Page: 6
  - Skin: Classic eller Cards
  - Aktivér "Meta Data" → Terms (viser case-kategorien som pille — allerede
    stylet i temaets CSS)
  - Aktivér "Read More" med tekst "Se case →"

**Sektion 4 — Kompetencer**
- **Heading** "Hvad jeg kan hjælpe med" + **Text Editor** underoverskrift
- 3 kolonner, i hver kolonne to blokke med: lille tal i Clay-farve (01, 02 …),
  **Heading** (fx "Brand Identity"), **Text Editor** (kort beskrivelse).
  Tekstindhold: se `julia-lund`-temaets `patterns/services-grid.php`.

**Sektion 5 — Kontakt-CTA**
- Centreret: **Heading** "Har du et projekt i støbeskeen?", **Text Editor**,
  **Button** "Skriv til mig" → link til Kontakt-siden

## 2. Om mig-siden

Ny side "Om mig" (slug `om-mig`) → Rediger med Elementor.

- To kolonner (58% / 42%): venstre = eyebrow "OM MIG" + stor **Heading**
  (almindelig sans, IKKE Didot — kun forsidens hero bruger serif-fonten);
  højre = **Image**-widget med CSS-klasse `round-photo` (beskærer billedet
  cirkulært automatisk) + evt. et **Image**-widget med `hero-blob.svg` bag
  ved, CSS-klasse `hero-blob`, i en sektion/wrapper med CSS-klasse
  `hero-visual` for at positionere den korrekt.
- Herunder: to kolonner (20% / 80%) — venstre "BIO" (lille, Stone), højre
  tre **Text Editor**-afsnit med bio-teksten.
- Ny sektion med sand baggrund: "Baggrund & værktøjer" + 3 kolonner
  (10+ års erfaring / 30+ projekter / Værktøjer).
- Genbrug CTA-sektionen fra forsiden (kopiér med Elementors "Copy/Paste"
  eller gem den som en **Elementor-skabelon** første gang, så du kan
  genindsætte den på flere sider).

## 3. Kontakt-siden

Ny side "Kontakt" (slug `kontakt`) → Rediger med Elementor.

- Eyebrow "KONTAKT" + **Heading** "Lad os tage en snak" + **Text Editor**
- **Divider**-widget
- **Heading** med mailto-link: `hej@julialund.dk`
- **Text Editor**: telefon + by
- **Text Editor** eller **Social Icons**-widget: Instagram, LinkedIn

Vil du have en rigtig formular i stedet for/ud over kontaktinfoen, er
**Elementor Pro** (Form-widget) eller et gratis plugin som **WPForms
Lite**/**Fluent Forms** de nemmeste veje — begge virker fint sammen med
dette tema.

## 4. Case-detaljesider

Hver case er en almindelig post under **Cases**. Åbn en case → **Rediger
med Elementor**:

- **Heading**: kategori som lille pille-tekst (frivilligt — eller lad
  kategorien stå i Elementors "Post Info"-widget, hvis din version har den)
- **Heading (H1)**: casens titel
- **Image**: caseens hovedbillede (eller sæt det som fremhævet billede og
  brug dynamic tag "Featured Image", hvis din Elementor-version har
  Dynamic Tags)
- **Text Editor**: kort intro
- **Heading (H2)** "Udfordringen" + **Text Editor**
- **Heading (H2)** "Løsningen" + **Text Editor**
- **Image**: resultatbillede
- **Heading (H2)** "Resultatet" + **Text Editor**
- Link "← Tilbage til alle cases"

**Tip:** Byg den første case færdig, gem den som en **Elementor-skabelon**
("Save as Template" i editoren), og genbrug skabelonen som udgangspunkt
for hver ny case — så skal du kun udskifte tekst og billeder fremover.

## 5. "Alle cases"-siden

Opret en side "Cases" (slug `cases`) → Rediger med Elementor → indsæt en
**Posts**-widget (Post Type: Case, Columns: 3, Posts Per Page: 9,
Pagination: til) — samme opskrift som case-grid'et på forsiden, bare uden
"Udvalgte" i overskriften og med flere cases ad gangen.

## Om header og footer

Header (logo/tagline/navigation) og footer ligger i `header.php`/
`footer.php` og redigeres **ikke** i Elementor (gratis Elementor kan kun
redigere almindelige sider/indlæg, ikke tema-skabelonerne). Vil du kunne
bygge header/footer visuelt i Elementor, kræver det **Elementor Pro**
(Theme Builder). Uden Pro retter du logo via **Design → Tilpas → Site
Identity**, menuen via **Udseende → Menuer**, og evt. tekst-detaljer ved at
bede mig ændre `header.php`/`footer.php` direkte.
