<?php
/**
 * Fallback template.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>

<section class="content-area">
	<div class="wrap">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				the_title( '<h2>', '</h2>' );
				the_excerpt();
			endwhile;
		else :
			esc_html_e( 'No se ha encontrado contenido.', 'nubamia' );
		endif;
		?>
	</div>
</section>

<?php
get_footer();
