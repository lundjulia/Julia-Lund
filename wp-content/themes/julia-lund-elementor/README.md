# Julia Lund — Portfolio (Elementor-udgave)

Letvægts, klassisk WordPress-tema bygget til at blive samlet med
**Elementor** i stedet for WordPress' egen blok-editor. Hvis du er vant til
Elementor, er det denne udgave, du skal bruge — se søster-temaet
`../julia-lund/` hvis du hellere vil redigere direkte i WordPress uden
noget plugin.

**Start her: [`ELEMENTOR-GUIDE.md`](./ELEMENTOR-GUIDE.md)** — den
indeholder den fulde, widget-for-widget opskrift på at samle forsiden,
Om mig, Kontakt og case-siderne, så resultatet matcher den tilsigtede
designretning (samme farver, typografi og layout som `julia-lund`-temaet).

## Hvad temaet leverer (uden Elementor)

- `style.css` — alle farver/fonte/spacing som CSS-variabler, plus CSS der
  automatisk giver Elementors standard-widgets (Posts, Button, Image) det
  rigtige udseende uden at du skal style hver widget manuelt.
- `functions.php` — temaopsætning, **"Case"** custom post type +
  kategori-taxonomy (til portfolio-projekter), menu-lokation.
- `header.php` / `footer.php` — logo, tagline, navigation, footer-links.
  Redigeres ikke i Elementor (kræver Elementor Pro Theme Builder for det) —
  se sidste afsnit i `ELEMENTOR-GUIDE.md`.
- `page.php`, `single.php`, `archive.php`, `404.php` — minimale skabeloner,
  der blot udskriver `the_content()`, så Elementor frit kan overtage
  indholdet på enhver side/post.

## Kom i gang lokalt

Samme fremgangsmåde som `julia-lund`-temaet: installér WordPress lokalt
(Local by WP Engine, wp-env, MAMP …), kopiér denne mappe ind i
`wp-content/themes/julia-lund-elementor/`, aktivér temaet, installér
Elementor, og følg `ELEMENTOR-GUIDE.md`.
