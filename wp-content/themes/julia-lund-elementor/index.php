<?php
/**
 * Fallback template. Elementor edits the content of whatever loop runs
 * inside the_content() below — there is deliberately no markup here for
 * Elementor to fight with.
 *
 * @package Julia_Lund_Elementor
 */

get_header();
?>

<main id="main">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
	else :
		?>
		<p style="padding: 48px;"><?php esc_html_e( 'Intet indhold fundet.', 'julia-lund-elementor' ); ?></p>
		<?php
	endif;
	?>
</main>

<?php
get_footer();
