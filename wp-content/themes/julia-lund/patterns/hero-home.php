<?php
/**
 * Title: Hero — Forside
 * Slug: julia-lund/hero-home
 * Categories: julia-lund
 * Description: Stort intro-hero med et blødt malerisk gradient-blob som signaturgrafik bag en redaktionel overskrift.
 */
?>
<!-- wp:group {"align":"full","className":"hero-visual","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|60","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"46rem"}} -->
<div class="wp-block-group alignfull hero-visual" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40)">

<!-- wp:image {"className":"hero-blob","width":"780px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image hero-blob" style="width:780px"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/hero-blob.svg' ) ); ?>" alt="" role="presentation"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"hero-content","layout":{"type":"constrained","contentSize":"46rem"}} -->
<div class="wp-block-group hero-content">

<!-- wp:paragraph {"textColor":"stone","style":{"typography":{"fontSize":"var:preset|font-size|small","letterSpacing":"0.12em"}}} -->
<p class="has-stone-color has-text-color" style="font-size:var(--wp--preset--font-size--small);letter-spacing:0.12em">BRAND · UX/UI · DIGITAL DESIGN</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"style":{"typography":{"fontFamily":"var(--wp--preset--font-family--display)","fontWeight":"400","fontStyle":"normal","textTransform":"lowercase","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
<h1 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--20);font-family:var(--wp--preset--font-family--display);font-weight:400;letter-spacing:-0.01em;text-transform:lowercase">Brand &amp; UX/UI design</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"stone","style":{"typography":{"fontSize":"var:preset|font-size|large","lineHeight":"1.5"},"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
<p class="has-stone-color has-text-color" style="margin-top:var(--wp--preset--spacing--30);font-size:var(--wp--preset--font-size--large);line-height:1.5">Jeg hjælper mærker og virksomheder med at se, føles og fungere skarpere — gennem brand identity, UX/UI og digital design med ro og præcision.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)">
<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#cases">↗ Se udvalgte cases</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30)"><a href="/kontakt">Kontakt mig →</a></p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->
