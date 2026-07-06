<?php
/**
 * Julia Lund Portfolio — theme bootstrap.
 *
 * @package Julia_Lund
 */

defined( 'ABSPATH' ) || exit;

/**
 * Theme setup.
 */
function julia_lund_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	add_editor_style( 'assets/css/editor-style.css' );

	load_theme_textdomain( 'julia-lund', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'julia_lund_setup' );

/**
 * Enqueue front-end assets.
 *
 * theme.json handles almost all visual styling; this file only carries the
 * small progressive-enhancement rules that theme.json cannot express
 * (hover/focus transitions, aspect-ratio crops, skip-link, print rules).
 */
function julia_lund_assets() {
	wp_enqueue_style(
		'julia-lund-style',
		get_theme_file_uri( 'assets/css/style.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'julia_lund_assets' );

/**
 * Print a "skip to content" link right after <body> so keyboard and
 * screen-reader users can bypass the header/navigation.
 */
function julia_lund_skip_link() {
	printf(
		'<a class="skip-link" href="#main">%s</a>',
		esc_html__( 'Spring til indhold', 'julia-lund' )
	);
}
add_action( 'wp_body_open', 'julia_lund_skip_link' );

/**
 * Register the "Case" custom post type used for portfolio projects.
 *
 * Cases are plain WordPress posts so cases can be added, reordered and
 * edited in Gutenberg exactly like any other content — no page-builder
 * lock-in and no hardcoded case cards in the templates.
 */
function julia_lund_register_case_cpt() {
	$labels = array(
		'name'                  => __( 'Cases', 'julia-lund' ),
		'singular_name'         => __( 'Case', 'julia-lund' ),
		'add_new_item'          => __( 'Tilføj ny case', 'julia-lund' ),
		'edit_item'             => __( 'Rediger case', 'julia-lund' ),
		'new_item'              => __( 'Ny case', 'julia-lund' ),
		'view_item'             => __( 'Vis case', 'julia-lund' ),
		'view_items'            => __( 'Vis cases', 'julia-lund' ),
		'search_items'          => __( 'Søg i cases', 'julia-lund' ),
		'not_found'             => __( 'Ingen cases fundet', 'julia-lund' ),
		'all_items'             => __( 'Alle cases', 'julia-lund' ),
		'archives'              => __( 'Case-arkiv', 'julia-lund' ),
		'featured_image'        => __( 'Case-billede', 'julia-lund' ),
		'set_featured_image'    => __( 'Vælg case-billede', 'julia-lund' ),
		'remove_featured_image' => __( 'Fjern case-billede', 'julia-lund' ),
		'menu_name'             => __( 'Cases', 'julia-lund' ),
	);

	register_post_type( 'case', array(
		'labels'       => $labels,
		'public'       => true,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-portfolio',
		'has_archive'  => 'cases',
		'rewrite'      => array( 'slug' => 'cases' ),
		'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
		'template'     => array(
			array( 'core/pattern', array( 'slug' => 'julia-lund/single-case-meta' ) ),
		),
		'menu_position' => 5,
	) );
}
add_action( 'init', 'julia_lund_register_case_cpt' );

/**
 * Register the taxonomy used to group cases (Brand identity, UX/UI, ...).
 */
function julia_lund_register_case_taxonomy() {
	register_taxonomy( 'case_category', 'case', array(
		'labels' => array(
			'name'          => __( 'Case-kategorier', 'julia-lund' ),
			'singular_name' => __( 'Case-kategori', 'julia-lund' ),
			'search_items'  => __( 'Søg kategorier', 'julia-lund' ),
			'all_items'     => __( 'Alle kategorier', 'julia-lund' ),
			'edit_item'     => __( 'Rediger kategori', 'julia-lund' ),
			'add_new_item'  => __( 'Tilføj ny kategori', 'julia-lund' ),
			'menu_name'     => __( 'Kategorier', 'julia-lund' ),
		),
		'hierarchical'      => true,
		'public'            => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => 'case-kategori' ),
	) );
}
add_action( 'init', 'julia_lund_register_case_taxonomy' );

/**
 * Seed a starter set of case categories on theme activation so the
 * category list isn't empty the first time a case is created.
 */
function julia_lund_seed_case_categories() {
	$terms = array(
		__( 'Brand Identity', 'julia-lund' ),
		__( 'UX/UI Design', 'julia-lund' ),
		__( 'Digital Design', 'julia-lund' ),
		__( 'Kampagne', 'julia-lund' ),
		__( 'Foto & Video', 'julia-lund' ),
	);

	foreach ( $terms as $term ) {
		if ( ! term_exists( $term, 'case_category' ) ) {
			wp_insert_term( $term, 'case_category' );
		}
	}
}
add_action( 'after_switch_theme', 'julia_lund_seed_case_categories' );

/**
 * Give the site tagline a sensible starting value (shown next to the
 * site title in the header via the Site Tagline block) instead of
 * WordPress' generic default.
 */
function julia_lund_seed_tagline() {
	if ( in_array( get_option( 'blogdescription' ), array( '', 'Just another WordPress site' ), true ) ) {
		update_option( 'blogdescription', __( 'UX/UI & Brand Designer', 'julia-lund' ) );
	}
}
add_action( 'after_switch_theme', 'julia_lund_seed_tagline' );

/**
 * Register block pattern category so all theme patterns are grouped
 * together in the pattern inserter instead of scattered under "Uncategorized".
 */
function julia_lund_register_pattern_categories() {
	register_block_pattern_category( 'julia-lund', array(
		'label' => __( 'Julia Lund — Portfolio', 'julia-lund' ),
	) );
}
add_action( 'init', 'julia_lund_register_pattern_categories' );

/**
 * A quiet "ghost" button style alongside the theme's default filled button,
 * used for secondary calls to action (e.g. "Se alle cases").
 */
function julia_lund_register_block_styles() {
	register_block_style( 'core/button', array(
		'name'  => 'outline',
		'label' => __( 'Outline', 'julia-lund' ),
	) );
}
add_action( 'init', 'julia_lund_register_block_styles' );

/**
 * Trim the admin bar / dashboard clutter that doesn't apply to a
 * single-purpose portfolio site (kept minimal on purpose).
 */
function julia_lund_excerpt_length( $length ) {
	return 26;
}
add_filter( 'excerpt_length', 'julia_lund_excerpt_length' );
