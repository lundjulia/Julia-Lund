<?php
/**
 * Title: Case-grid (Query Loop)
 * Slug: julia-lund/case-grid
 * Categories: julia-lund
 * Description: Viser udvalgte cases automatisk via en Query Loop — nye cases oprettet under "Cases" i menuen dukker op her uden kodeændringer.
 */
?>
<!-- wp:group {"anchor":"cases","align":"full","style":{"spacing":{"padding":{"top":"var:custom|spacing|section-gap","bottom":"var:custom|spacing|section-gap","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<div id="cases" class="wp-block-group alignfull" style="padding-top:var(--wp--custom--spacing--section-gap);padding-bottom:var(--wp--custom--spacing--section-gap);padding-left:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40)">

<!-- wp:columns {"verticalAlignment":"bottom"} -->
<div class="wp-block-columns are-vertically-aligned-bottom">

<!-- wp:column {"verticalAlignment":"bottom"} -->
<div class="wp-block-column is-vertically-aligned-bottom">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Udvalgte cases</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom"} -->
<div class="wp-block-column is-vertically-aligned-bottom">
<!-- wp:paragraph {"align":"right","textColor":"stone"} -->
<p class="has-text-align-right has-stone-color has-text-color"><a href="/cases">Se alle cases →</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

</div>
<!-- /wp:columns -->

<!-- wp:query {"queryId":1,"query":{"perPage":6,"pages":0,"offset":0,"postType":"case","order":"desc","orderBy":"date","inherit":false},"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-query" style="margin-top:var(--wp--preset--spacing--50)">

<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->

<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/5","style":{"border":{"radius":"2px"}}} /-->

<!-- wp:post-terms {"term":"case_category","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} /-->

<!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}}} /-->

<!-- wp:post-excerpt {"excerptLength":18,"textColor":"stone"} /-->

<!-- /wp:post-template -->

<!-- wp:query-pagination {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous /-->
<!-- wp:query-pagination-numbers /-->
<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph -->
<p>Ingen cases oprettet endnu — opret din første case under “Cases” i admin-menuen til venstre.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results -->

</div>
<!-- /wp:query -->

</div>
<!-- /wp:group -->
