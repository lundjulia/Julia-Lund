<?php
/**
 * Archive fallback (e.g. a case-category term archive). The main "all
 * cases" overview is meant to be built as its own Elementor page using
 * the Posts widget — see ELEMENTOR-GUIDE.md — so this file only needs
 * to look reasonable, not be the primary listing page.
 *
 * @package Julia_Lund_Elementor
 */

get_header();
?>

<main id="main">
	<div class="jl-archive-intro">
		<h1><?php the_archive_title(); ?></h1>
	</div>

	<div class="jl-card-grid">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<article class="jl-card">
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'large' ); ?>
						<?php endif; ?>
					</a>
					<?php
					$terms = get_the_terms( get_the_ID(), 'case_category' );
					if ( $terms && ! is_wp_error( $terms ) ) :
						?>
						<span class="pill"><?php echo esc_html( $terms[0]->name ); ?></span>
					<?php endif; ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p><?php the_excerpt(); ?></p>
				</article>
				<?php
			endwhile;
		else :
			?>
			<p><?php esc_html_e( 'Intet fundet.', 'julia-lund-elementor' ); ?></p>
			<?php
		endif;
		?>
	</div>
</main>

<?php
get_footer();
