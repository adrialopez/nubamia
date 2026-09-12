<?php
/**
 * 404 template.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>

<section class="page-hero">
	<div class="wrap">
		<h1><?php esc_html_e( 'Página no encontrada', 'nubamia' ); ?></h1>
	</div>
</section>

<section class="content-area" style="text-align:center;">
	<div class="wrap">
		<p><?php esc_html_e( 'Lo sentimos, no hemos encontrado la página que buscas.', 'nubamia' ); ?></p>
		<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Volver al inicio', 'nubamia' ); ?></a>
	</div>
</section>

<?php
get_footer();
