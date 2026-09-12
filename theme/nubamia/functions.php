<?php
/**
 * Nubamía theme functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NUBAMIA_VERSION', '1.0.0' );

function nubamia_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'customize-selective-refresh-widgets' );

	set_post_thumbnail_size( 640, 400, true );
	add_image_size( 'nubamia-card', 480, 300, true );

	register_nav_menus(
		array(
			'primary' => __( 'Menú principal', 'nubamia' ),
			'footer'  => __( 'Menú footer', 'nubamia' ),
		)
	);
}
add_action( 'after_setup_theme', 'nubamia_setup' );

function nubamia_scripts() {
	wp_enqueue_style( 'nubamia-google-fonts', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Caveat:wght@400;600;700&display=swap', array(), null );
	wp_enqueue_style( 'nubamia-style', get_template_directory_uri() . '/style.css', array(), NUBAMIA_VERSION );
	wp_enqueue_style( 'nubamia-main', get_template_directory_uri() . '/css/main.css', array( 'nubamia-style' ), NUBAMIA_VERSION );
	wp_enqueue_script( 'nubamia-nav', get_template_directory_uri() . '/js/nav.js', array(), NUBAMIA_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'nubamia_scripts' );

function nubamia_excerpt_length( $length ) {
	return 26;
}
add_filter( 'excerpt_length', 'nubamia_excerpt_length' );

function nubamia_excerpt_more( $more ) {
	return '…';
}
add_filter( 'excerpt_more', 'nubamia_excerpt_more' );

/**
 * Simple fallback menu when no menu is assigned to a location yet.
 */
function nubamia_fallback_menu() {
	echo '<ul class="menu"><li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Inicio', 'nubamia' ) . '</a></li></ul>';
}
