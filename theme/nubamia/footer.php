<?php
/**
 * Footer template.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?></main>
<footer class="site-footer">
	<div class="wrap">
		<div class="footer-grid">
			<div>
				<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="height:44px;">
				</a>
				<p><?php bloginfo( 'description' ); ?></p>
			</div>
			<div>
				<h4><?php esc_html_e( 'Servicios', 'nubamia' ); ?></h4>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => '',
						'fallback_cb'    => false,
						'depth'          => 1,
					)
				);
				?>
			</div>
			<div>
				<h4><?php esc_html_e( 'Contacto', 'nubamia' ); ?></h4>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"><?php esc_html_e( 'Escríbenos', 'nubamia' ); ?></a></li>
				</ul>
			</div>
		</div>
		<div class="footer-bottom">
			<p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Todos los derechos reservados.', 'nubamia' ); ?>
				· <a href="<?php echo esc_url( home_url( '/politica-privacidad/' ) ); ?>"><?php esc_html_e( 'Privacidad', 'nubamia' ); ?></a>
				· <a href="<?php echo esc_url( home_url( '/politica-cookies/' ) ); ?>"><?php esc_html_e( 'Cookies', 'nubamia' ); ?></a>
				· <a href="javascript:void(0);" class="cky-banner-element"><?php esc_html_e( 'Configurar cookies', 'nubamia' ); ?></a>
			</p>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
