<?php
/**
 * @package Julia_Lund_Elementor
 */

get_header();
?>

<main id="main">
	<div style="max-width:36rem;margin:0 auto;padding:var(--jl-section-gap) 24px;text-align:center;">
		<p style="font-size:0.9rem;letter-spacing:0.12em;color:var(--jl-stone);">404</p>
		<h1><?php esc_html_e( 'Siden blev ikke fundet', 'julia-lund-elementor' ); ?></h1>
		<p style="color:var(--jl-stone);"><?php esc_html_e( 'Siden du leder efter findes ikke, eller er blevet flyttet.', 'julia-lund-elementor' ); ?></p>
		<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="jl-btn"><?php esc_html_e( 'Tilbage til forsiden', 'julia-lund-elementor' ); ?></a></p>
	</div>
</main>

<?php
get_footer();
