<?php
/**
 * Single post template. WordPress also falls back to this file for
 * single "Case" entries (no dedicated single-case.php needed, since a
 * single post/page/case all just render the_content() the same way).
 *
 * @package Julia_Lund_Elementor
 */

get_header();
?>

<main id="main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php
get_footer();
