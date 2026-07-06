<?php
/**
 * Page template. This is the file Elementor takes over on any page you
 * click "Edit with Elementor" on — everything you build there renders
 * inside the_content() below.
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
