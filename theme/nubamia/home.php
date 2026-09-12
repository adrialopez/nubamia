<?php
/**
 * Blog listing template (posts page).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>

<section class="page-hero">
	<div class="wrap">
		<h1><?php echo esc_html( get_the_title( get_option( 'page_for_posts' ) ) ?: __( 'Blog', 'nubamia' ) ); ?></h1>
	</div>
</section>

<section class="content-area">
	<div class="wrap">

		<?php if ( have_posts() ) : ?>
			<div class="blog-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class( 'post-card' ); ?>>
						<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'nubamia-card' ); ?>
							<?php else : ?>
								<img src="<?php echo esc_url( get_template_directory_uri() . '/images/logo.png' ); ?>" alt="" style="background:#f3fafc;padding:40px;">
							<?php endif; ?>
						</a>
						<div class="post-card-body">
							<p class="post-meta"><?php echo esc_html( get_the_date() ); ?></p>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php the_excerpt(); ?></p>
						</div>
					</article>
					<?php
				endwhile;
				?>
			</div>

			<div class="pagination">
				<?php
				echo paginate_links(
					array(
						'prev_text' => '« Anterior',
						'next_text' => 'Siguiente »',
					)
				);
				?>
			</div>

		<?php else : ?>
			<p><?php esc_html_e( 'Todavía no hay entradas publicadas.', 'nubamia' ); ?></p>
		<?php endif; ?>

	</div>
</section>

<?php
get_footer();
