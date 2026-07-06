# Julia Lund — Portfolio (WordPress block-tema)

Et roligt, kurateret portfolio-tema til en brand manager / UX-UI- og digital
designer. Bygget som et **fuldt block-tema (Full Site Editing)** — der er
ingen hardcodet HTML, som skal redigeres i kode. Alt — tekst, billeder,
farver, typografi og layout — redigeres direkte i WordPress' Editor.

> Foretrækker du at redigere med **Elementor** i stedet for WordPress'
> egen editor? Brug søster-temaet `../julia-lund-elementor/` og dets
> `ELEMENTOR-GUIDE.md`.

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
7. Upload dit eget logo under **Design → Editor → Styles → sidelogo** (eller
   via Tilpasning). Er intet logo uploadet, vises kun navn + tagline i
   headeren — se `assets/images/logo-mark.svg` for et forslag til
   geometrisk monogram, du kan bruge som udgangspunkt.
8. Sæt din tagline under **Indstillinger → Generelt → Undertitel** (vises
   automatisk under navnet i headeren, ligesom "UX/UI & Brand Designer" er
   sat som standard).

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

Designretningen er inspireret af moderne, redaktionelle UX/UI-portfolioer
(bl.a. et enkelt, rebalanceret gradient-"blob"-motiv mod en neutral,
grå baggrund) — tilpasset til Julia Lunds eget farve- og typografi-udtryk
i stedet for kopieret direkte:

- **Signatur-grafik:** ét blødt, malerisk gradient-blob (guld/ler/blomme,
  `assets/images/hero-blob.svg`) bruges sparsomt bag hero-overskriften og
  om profilbilledet — stedets eneste farveindslag mod den ellers neutrale,
  grå/off-white palet. Undgår at blive "for trendy" ved kun at optræde ét
  eller to steder.
- **Typografisk kontrast:** Hero-overskriften bruger en redaktionel,
  small-caps-agtig serif (`Didot`/`Bodoni MT` med system-fallback) i
  små bogstaver — resten af overskrifterne (Om mig, case-titler,
  sektioner) er en ren, geometrisk sans-serif. Denne kontrast (én stor
  serif-linje, resten sans) er hentet fra referencen uden at genbruge dens
  konkrete skrifttype.
- **Ingen eksterne skrifttyper** — alt er system-font-stakke. Nul
  netværkskald, hurtig indlæsning. Vil du bruge en bestemt skrifttype
  (fx en rigtig Didot/Bodoni-fil eller Fraunces + Inter), tilføjes den
  under `settings.typography.fontFamilies` i `theme.json` med
  `@font-face`-filer i `assets/fonts/`.
- **Ingen plugin-afhængighed.** Cases er en almindelig custom post type —
  ingen Page Builder eller ACF krævet.
- **Farvepalet:** Papir (baggrund), Blæk (tekst), Sten (sekundær tekst),
  Sand (sektion-baggrund), Ler (primær accent — knapper/links), Blomme og
  Guld (kun brugt i signatur-gradienten). Alle tekst/baggrund-kombinationer
  er tjekket til mindst WCAG AA-kontrast (4.5:1+).
- **Cirkulært portræt** på Om mig-siden, kategori-tags som piller (runde
  outline-badges) på case-kort, og understreget aktivt menupunkt i
  navigationen — alle tre er små, genkendelige detaljer fra referencen,
  genskabt med egne farver/proportioner.
- **Dummybilleder** er lette SVG-placeholders (`assets/images/`) — udskift
  dem blot med rigtige billeder ved at uploade nye billeder i editoren.

## Kontaktformular

Kontaktsiden viser direkte kontaktinfo (e-mail, telefon, sociale links) og
kræver ingen plugin. Ønsker du en rigtig formular, kan et letvægts-plugin
som **Jetpack (kontaktformular-blok)** eller **Fluent Forms** tilføjes —
begge fungerer i Gutenberg uden at ændre temaet.
