# Julia Lund — Portfolio (WordPress block-tema)

Et roligt, kurateret portfolio-tema til en brand manager / UX-UI- og digital
designer. Bygget som et **fuldt block-tema (Full Site Editing)** — der er
ingen hardcodet HTML, som skal redigeres i kode. Alt — tekst, billeder,
farver, typografi og layout — redigeres direkte i WordPress' Editor.

## Kom i gang lokalt

Du skal bruge en lokal WordPress-installation (tema alene kan ikke "åbnes"
som en almindelig hjemmeside — det er en skabelon, WordPress bygger siden
ud fra). Nemmeste veje:

1. **Local (by WP Engine)** — gratis, GUI-baseret. Opret et nyt site, kopiér
   derefter denne mappe (`julia-lund/`) ind i
   `wp-content/themes/julia-lund/` i det nye site.
2. **wp-env** (kræver Docker) — fra roden af en WordPress-plugin/theme-repo:
   `npx @wordpress/env start`, og læg temaet i `wp-content/themes/`.
3. **Et eksisterende lokalt WP-miljø** (MAMP, XAMPP, Studio by WordPress.com
   m.fl.) — kopiér mappen ind i dit `wp-content/themes/`-katalog.

Når temaet ligger i `wp-content/themes/julia-lund/`:

1. Gå til **Design → Temaer** i wp-admin og aktivér **"Julia Lund — Portfolio"**.
2. Gå til **Design → Editor** — her redigeres forside, header/footer og sider
   visuelt (Gutenberg / Site Editor).
3. Opret dine cases under **Cases → Tilføj ny case** i menuen til venstre.
   Hver case får automatisk et startskema (meta-linje, "Udfordring",
   "Løsning", "Resultat"), som du bare udfylder og erstatter billeder i.
4. Sæt et **fremhævet billede** på hver case og vælg en **case-kategori**
   (Brand Identity, UX/UI Design, Digital Design, Kampagne, Foto & Video —
   du kan tilføje flere under **Cases → Kategorier**). Case-kortene på
   forsiden opdateres automatisk — der er intet at rette i kode.
5. Opret to sider: **"Om mig"** og **"Kontakt"**. Under sideindstillinger
   (højre side i editoren → **Skabelon**) vælger du hhv. "Om mig" og
   "Kontakt" som sidetype — så udfyldes siden med det færdige, redigerbare
   layout.
6. Ret menuen under **Design → Editor → Navigation** (Forside, Cases,
   Om mig, Kontakt).

## Hvad ligger hvor

| Sti | Formål |
|---|---|
| `theme.json` | Alle design-tokens: farver, typografi, spacing, layout-bredder. Kan justeres i **Design → Editor → Styles** uden kode. |
| `templates/` | Sideskabeloner (forside, side, case-detalje, case-arkiv, 404). |
| `parts/` | Header og footer (genbruges på alle sider). |
| `patterns/` | Genbrugelige indholdsblokke (hero, cases-grid, services, om mig, kontakt). Kan indsættes/duplikeres frit fra "Mønstre" i blok-inserteren. |
| `functions.php` | Opsætning, "Case" custom post type + kategori-taxonomy, mønster-kategori. |
| `assets/` | Supplerende CSS (fokus-tilstande, skip-link) og SVG-dummybilleder. |

## Designvalg (kort)

- **Ingen eksterne skrifttyper** — bruger elegante system-font-stakke
  (serif til overskrifter, sans til brødtekst). Nul netværkskald, hurtig
  indlæsning. Vil du bruge en bestemt skrifttype (fx Fraunces + Inter),
  tilføjes den under `settings.typography.fontFamilies` i `theme.json`
  med `@font-face`-filer i `assets/fonts/`.
- **Ingen plugin-afhængighed.** Cases er en almindelig custom post type —
  ingen Page Builder eller ACF krævet.
- **Farvepalet:** Papir (baggrund), Blæk (tekst), Sten (sekundær tekst),
  Sand (sektion-baggrund), Ler (accent). Alle kombinationer er tjekket til
  mindst WCAG AA-kontrast.
- **Dummybilleder** er lette SVG-placeholders (`assets/images/`) — udskift
  dem blot med rigtige billeder ved at uploade nye billeder i editoren.

## Kontaktformular

Kontaktsiden viser direkte kontaktinfo (e-mail, telefon, sociale links) og
kræver ingen plugin. Ønsker du en rigtig formular, kan et letvægts-plugin
som **Jetpack (kontaktformular-blok)** eller **Fluent Forms** tilføjes —
begge fungerer i Gutenberg uden at ændre temaet.
