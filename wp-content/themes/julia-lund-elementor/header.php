<?php
/**
 * @package Julia_Lund_Elementor
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/logo-mark.svg' ) ); ?>" alt="" width="40" height="40">
		<?php endif; ?>
		<span>
			<span class="name" style="display:block;"><?php bloginfo( 'name' ); ?></span>
			<span class="tag" style="display:block;"><?php bloginfo( 'description' ); ?></span>
		</span>
	</a>

	<nav class="site-nav" aria-label="<?php esc_attr_e( 'Primær navigation', 'julia-lund-elementor' ); ?>">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'fallback_cb'    => false,
		) );
		?>
	</nav>
</header>
