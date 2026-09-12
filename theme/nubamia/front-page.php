<?php
/**
 * Front page template.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>

<section class="hero">
	<div class="wrap hero-content">
		<div class="site-logo-big">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
		</div>
		<h1 class="tagline"><?php bloginfo( 'description' ); ?></h1>
		<p>En Nubamía diseñamos detalles únicos y 100% personalizados para dar la bienvenida a tu bebé: Baby Showers, decoración del hospital y muchas otras ocasiones especiales.</p>
		<a class="btn" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Cuéntanos tu idea</a>
	</div>
</section>

<section class="services">
	<div class="wrap">
		<h2 style="text-align:center;">Nuestros servicios</h2>

		<div class="services-grid">

			<div class="service-card">
				<span class="icon">🎉</span>
				<h3><a href="<?php echo esc_url( home_url( '/baby-showers/' ) ); ?>">Baby Showers</a></h3>
				<p>¡Te ayudamos a organizar la fiesta para la futura mamá y su bebé!</p>
				<ul>
					<li>Invitaciones</li>
					<li>Decoración para la fiesta</li>
					<li>Juegos</li>
				</ul>
				<a class="more" href="<?php echo esc_url( home_url( '/baby-showers/' ) ); ?>">Saber más »</a>
			</div>

			<div class="service-card">
				<span class="icon">🏥</span>
				<h3><a href="<?php echo esc_url( home_url( '/decoracion-del-hospital/' ) ); ?>">Decoración de Hospitales</a></h3>
				<p>¡Recibe a los que te visitan para conocer a tu bebé de una manera especial!</p>
				<ul>
					<li>Colgantes personalizados para la puerta del hospital</li>
					<li>Detalles de agradecimiento</li>
				</ul>
				<a class="more" href="<?php echo esc_url( home_url( '/decoracion-del-hospital/' ) ); ?>">Saber más »</a>
			</div>

			<div class="service-card">
				<span class="icon">✨</span>
				<h3><a href="<?php echo esc_url( home_url( '/detalles-personalizados/' ) ); ?>">Más detalles personalizados</a></h3>
				<p>Personalizamos tus eventos y ocasiones especiales. ¡Cuéntanos tu idea y te ayudamos a hacerla realidad!</p>
				<ul>
					<li>Tarjetas personalizadas para niños</li>
					<li>Invitaciones para diferentes eventos</li>
					<li>Diseño de papelería personalizada</li>
				</ul>
				<a class="more" href="<?php echo esc_url( home_url( '/detalles-personalizados/' ) ); ?>">Saber más »</a>
			</div>

		</div>
	</div>
</section>

<section class="about-teaser">
	<div class="wrap">
		<h2>Sobre nosotros</h2>
		<p>En Nubamía nos encanta el diseño de cosas bonitas, especiales y únicas. Nos apasionan los pequeños detalles porque creemos que pueden hacer una gran diferencia en cualquier evento u ocasión especial.</p>
		<a class="btn btn-outline" href="<?php echo esc_url( home_url( '/sobre-nosotros/' ) ); ?>">Conócenos</a>
	</div>
</section>

<?php
get_footer();
