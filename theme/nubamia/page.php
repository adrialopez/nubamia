<?php
/**
 * Generic page template.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

$is_contact = is_page( 'contacto' );
?>

<section class="page-hero">
	<div class="wrap">
		<h1><?php the_title(); ?></h1>
	</div>
</section>

<section class="content-area <?php echo $is_contact ? 'contact-wrap' : ''; ?>">
	<div class="wrap">
		<?php
		while ( have_posts() ) :
			the_post();

			if ( has_post_thumbnail() && ! $is_contact ) {
				the_post_thumbnail( 'large' );
			}

			the_content();
		endwhile;
		?>
	</div>
</section>

<?php
get_footer();
