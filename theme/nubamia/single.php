<?php
/**
 * Single post template.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>

<section class="page-hero">
	<div class="wrap">
		<h1><?php the_title(); ?></h1>
	</div>
</section>

<section class="content-area single-post">
	<div class="wrap">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<p class="post-meta"><?php echo esc_html( get_the_date() ); ?></p>

			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'large' ); ?>
			<?php endif; ?>

			<?php the_content(); ?>

			<div class="author-box">
				<p>
					<?php esc_html_e( 'Escrito por Mariana Martínez, creadora de Nubamía.', 'nubamia' ); ?>
					<?php esc_html_e( 'Si buscas recursos para acompañar a tu familia a medida que tus peques crecen, visita', 'nubamia' ); ?>
					<a href="https://mariana-martinez.es/" target="_blank" rel="noopener">mariana-martinez.es</a>.
				</p>
			</div>

			<nav class="post-nav">
				<div><?php previous_post_link( '%link', '« %title' ); ?></div>
				<div><?php next_post_link( '%link', '%title »' ); ?></div>
			</nav>

			<?php nubamia_print_related_posts(); ?>

			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template(); ?>
			<?php endif; ?>
		<?php endwhile; ?>
	</div>
</section>

<?php
get_footer();
