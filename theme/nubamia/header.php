<?php
/**
 * Header template.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<div class="wrap">
		<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
		</a>
		<input type="checkbox" id="nav-toggle" class="nav-toggle-checkbox">
		<label for="nav-toggle" class="menu-toggle" aria-label="<?php esc_attr_e( 'Abrir menú', 'nubamia' ); ?>">&#9776;</label>
		<nav class="main-nav" aria-label="<?php esc_attr_e( 'Menú principal', 'nubamia' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'fallback_cb'    => 'nubamia_fallback_menu',
				)
			);
			?>
		</nav>
	</div>
</header>
<main id="main-content">
