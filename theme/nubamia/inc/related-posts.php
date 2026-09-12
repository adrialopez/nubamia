<?php
/**
 * Related posts for single blog entries: same category first, filled in
 * with the most recent posts if a post doesn't have enough siblings.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function nubamia_get_related_posts( $post_id, $limit = 3 ) {
	$categories = wp_get_post_categories( $post_id );
	$found      = array();

	if ( ! empty( $categories ) ) {
		$related = new WP_Query(
			array(
				'category__in'        => $categories,
				'post__not_in'        => array( $post_id ),
				'posts_per_page'      => $limit,
				'orderby'             => 'date',
				'order'               => 'DESC',
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);
		$found   = $related->posts;
	}

	if ( count( $found ) < $limit ) {
		$exclude   = array_merge( array( $post_id ), wp_list_pluck( $found, 'ID' ) );
		$remaining = new WP_Query(
			array(
				'post__not_in'        => $exclude,
				'posts_per_page'      => $limit - count( $found ),
				'orderby'             => 'date',
				'order'               => 'DESC',
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);
		$found = array_merge( $found, $remaining->posts );
	}

	return $found;
}

function nubamia_print_related_posts() {
	if ( ! is_singular( 'post' ) ) {
		return;
	}

	$related = nubamia_get_related_posts( get_the_ID(), 3 );

	if ( empty( $related ) ) {
		return;
	}
	?>
	<section class="related-posts">
		<h2><?php esc_html_e( 'Quizá también te interese', 'nubamia' ); ?></h2>
		<div class="blog-grid">
			<?php foreach ( $related as $related_post ) : ?>
				<article class="post-card">
					<a href="<?php echo esc_url( get_permalink( $related_post ) ); ?>">
						<?php if ( has_post_thumbnail( $related_post ) ) : ?>
							<?php echo get_the_post_thumbnail( $related_post, 'nubamia-card' ); ?>
						<?php else : ?>
							<img src="<?php echo esc_url( get_template_directory_uri() . '/images/logo.png' ); ?>" alt="" style="background:#f3fafc;padding:40px;">
						<?php endif; ?>
					</a>
					<div class="post-card-body">
						<p class="post-meta"><?php echo esc_html( get_the_date( '', $related_post ) ); ?></p>
						<h2><a href="<?php echo esc_url( get_permalink( $related_post ) ); ?>"><?php echo esc_html( get_the_title( $related_post ) ); ?></a></h2>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
}
