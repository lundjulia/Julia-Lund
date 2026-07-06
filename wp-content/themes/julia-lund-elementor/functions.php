<?php
/**
 * Julia Lund Portfolio (Elementor edition) — theme bootstrap.
 *
 * @package Julia_Lund_Elementor
 */

defined( 'ABSPATH' ) || exit;

/**
 * Theme setup. This is a classic (non-block) theme on purpose — Elementor
 * edits the content of individual pages/posts, and expects a normal
 * header.php/footer.php + the_content() template structure rather than a
 * Full Site Editing block theme.
 */
function julia_lund_el_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus( array(
		'primary' => __( 'Primær navigation', 'julia-lund-elementor' ),
	) );

	load_theme_textdomain( 'julia-lund-elementor', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'julia_lund_el_setup' );

/**
 * Enqueue the theme stylesheet (design tokens + Elementor-widget reskin).
 */
function julia_lund_el_assets() {
	wp_enqueue_style(
		'julia-lund-elementor-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'julia_lund_el_assets' );

/**
 * Register the "Case" custom post type used for portfolio projects.
 * Works the same regardless of which theme/builder is active — build
 * individual cases with "Edit with Elementor", and list them anywhere
 * with Elementor's built-in "Posts" widget (Post Type: Case).
 */
function julia_lund_el_register_case_cpt() {
	$labels = array(
		'name'                  => __( 'Cases', 'julia-lund-elementor' ),
		'singular_name'         => __( 'Case', 'julia-lund-elementor' ),
		'add_new_item'          => __( 'Tilføj ny case', 'julia-lund-elementor' ),
		'edit_item'             => __( 'Rediger case', 'julia-lund-elementor' ),
		'new_item'              => __( 'Ny case', 'julia-lund-elementor' ),
		'view_item'             => __( 'Vis case', 'julia-lund-elementor' ),
		'view_items'            => __( 'Vis cases', 'julia-lund-elementor' ),
		'search_items'          => __( 'Søg i cases', 'julia-lund-elementor' ),
		'not_found'             => __( 'Ingen cases fundet', 'julia-lund-elementor' ),
		'all_items'             => __( 'Alle cases', 'julia-lund-elementor' ),
		'featured_image'        => __( 'Case-billede', 'julia-lund-elementor' ),
		'set_featured_image'    => __( 'Vælg case-billede', 'julia-lund-elementor' ),
		'remove_featured_image' => __( 'Fjern case-billede', 'julia-lund-elementor' ),
		'menu_name'             => __( 'Cases', 'julia-lund-elementor' ),
	);

	register_post_type( 'case', array(
		'labels'       => $labels,
		'public'       => true,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-portfolio',
		'has_archive'  => false,
		'rewrite'      => array( 'slug' => 'cases' ),
		'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'menu_position' => 5,
	) );
}
add_action( 'init', 'julia_lund_el_register_case_cpt' );

/**
 * Case category taxonomy — selectable per case, and shown as a pill badge
 * automatically when listed via Elementor's "Posts" widget (see style.css).
 */
function julia_lund_el_register_case_taxonomy() {
	register_taxonomy( 'case_category', 'case', array(
		'labels' => array(
			'name'          => __( 'Case-kategorier', 'julia-lund-elementor' ),
			'singular_name' => __( 'Case-kategori', 'julia-lund-elementor' ),
			'search_items'  => __( 'Søg kategorier', 'julia-lund-elementor' ),
			'all_items'     => __( 'Alle kategorier', 'julia-lund-elementor' ),
			'edit_item'     => __( 'Rediger kategori', 'julia-lund-elementor' ),
			'add_new_item'  => __( 'Tilføj ny kategori', 'julia-lund-elementor' ),
			'menu_name'     => __( 'Kategorier', 'julia-lund-elementor' ),
		),
		'hierarchical'      => true,
		'public'            => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => 'case-kategori' ),
	) );
}
add_action( 'init', 'julia_lund_el_register_case_taxonomy' );

/**
 * Seed a starter set of case categories so the list isn't empty the
 * first time a case is created.
 */
function julia_lund_el_seed_case_categories() {
	$terms = array(
		__( 'Brand Identity', 'julia-lund-elementor' ),
		__( 'UX/UI Design', 'julia-lund-elementor' ),
		__( 'Digital Design', 'julia-lund-elementor' ),
		__( 'Kampagne', 'julia-lund-elementor' ),
		__( 'Foto & Video', 'julia-lund-elementor' ),
	);

	foreach ( $terms as $term ) {
		if ( ! term_exists( $term, 'case_category' ) ) {
			wp_insert_term( $term, 'case_category' );
		}
	}
}
add_action( 'after_switch_theme', 'julia_lund_el_seed_case_categories' );

/**
 * Give the site tagline a sensible starting value instead of WordPress'
 * generic default (shown next to the logo in header.php).
 */
function julia_lund_el_seed_tagline() {
	if ( in_array( get_option( 'blogdescription' ), array( '', 'Just another WordPress site' ), true ) ) {
		update_option( 'blogdescription', __( 'UX/UI & Brand Designer', 'julia-lund-elementor' ) );
	}
}
add_action( 'after_switch_theme', 'julia_lund_el_seed_tagline' );

/**
 * Print a "skip to content" link right after <body>.
 */
function julia_lund_el_skip_link() {
	printf(
		'<a class="skip-link" href="#main">%s</a>',
		esc_html__( 'Spring til indhold', 'julia-lund-elementor' )
	);
}
add_action( 'wp_body_open', 'julia_lund_el_skip_link' );
