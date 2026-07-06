<?php
/**
 * Title: Kort profiltekst
 * Slug: julia-lund/intro-profile
 * Categories: julia-lund
 * Description: To-kolonne sektion med portræt og en kort introduktion til designeren.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:custom|spacing|section-gap-sm","bottom":"var:custom|spacing|section-gap-sm","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--custom--spacing--section-gap-sm);padding-bottom:var(--wp--custom--spacing--section-gap-sm);padding-left:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40)">

<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center">

<!-- wp:column {"verticalAlignment":"center","width":"36%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:36%">
<!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"2px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/placeholder-portrait.svg' ) ); ?>" alt="Portræt af Julia Lund" style="border-radius:2px"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"64%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:64%">

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Om mig, kort fortalt</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Jeg er brand- og UX/UI-designer med base i København. I over ti år har jeg hjulpet virksomheder og skabere med at omsætte en idé til et sammenhængende visuelt sprog — fra logo og identitet til digitale produkter, kampagner og indhold.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Jeg arbejder tæt sammen med mine kunder og går aldrig på kompromis med hverken det æstetiske eller det funktionelle.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--40)"><a href="/om-mig">Læs mere om mig →</a></p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:column -->

</div>
<!-- /wp:columns -->

</div>
<!-- /wp:group -->
