<?php
/**
 * Frontend performance cleanup: strip WordPress core output that this
 * site never uses (emoji, oEmbed, old blogging-client discovery links,
 * block-editor CSS — all content here is classic HTML, not blocks).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function nubamia_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'nubamia_disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'nubamia_disable_emojis_dns_prefetch', 10, 2 );
}
add_action( 'init', 'nubamia_disable_emojis' );

function nubamia_disable_emojis_tinymce( $plugins ) {
	return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
}

function nubamia_disable_emojis_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		$urls = array_filter(
			$urls,
			function ( $url ) {
				return false === strpos( $url, 'https://s.w.org/' );
			}
		);
	}
	return $urls;
}

function nubamia_cleanup_head() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}
add_action( 'init', 'nubamia_cleanup_head' );

function nubamia_dequeue_unused_assets() {
	wp_dequeue_script( 'wp-embed' );
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'classic-theme-styles' );
	wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'nubamia_dequeue_unused_assets', 100 );

function nubamia_resource_hints( $hints, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$hints[] = 'https://fonts.googleapis.com';
		$hints[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'nubamia_resource_hints', 10, 2 );
