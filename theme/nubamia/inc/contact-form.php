<?php
/**
 * Lightweight native contact form, compatible with the legacy
 * [contact-form to="..." subject="..."][contact-field label="..." type="..." required="1"/]...[/contact-form]
 * shortcode markup already stored in page content (originally rendered by Jetpack).
 *
 * Implemented independently so the site does not depend on Jetpack being
 * connected to WordPress.com.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Nubamia_Contact_Form {

	private static $fields = array();
	private static $result = null; // 'success' | 'error' | null

	public static function init() {
		add_shortcode( 'contact-form', array( __CLASS__, 'render_form' ) );
		add_shortcode( 'contact-field', array( __CLASS__, 'render_field' ) );
		add_action( 'template_redirect', array( __CLASS__, 'maybe_handle_submission' ) );
	}

	public static function maybe_handle_submission() {
		if ( empty( $_POST['nubamia_contact_submit'] ) ) {
			return;
		}

		if ( ! isset( $_POST['nubamia_contact_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['nubamia_contact_nonce'] ), 'nubamia_contact_form' ) ) {
			self::$result = 'error';
			return;
		}

		// Honeypot: real visitors never fill this hidden field.
		if ( ! empty( $_POST['nubamia_contact_website'] ) ) {
			self::$result = 'success';
			return;
		}

		$to      = isset( $_POST['nubamia_contact_to'] ) ? sanitize_email( wp_unslash( $_POST['nubamia_contact_to'] ) ) : get_option( 'admin_email' );
		$subject = isset( $_POST['nubamia_contact_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['nubamia_contact_subject'] ) ) : __( 'Nuevo mensaje de contacto', 'nubamia' );

		$name  = isset( $_POST['nombre'] ) ? sanitize_text_field( wp_unslash( $_POST['nombre'] ) ) : '';
		$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
		$msg   = isset( $_POST['comentario'] ) ? sanitize_textarea_field( wp_unslash( $_POST['comentario'] ) ) : '';

		if ( empty( $name ) || empty( $email ) || ! is_email( $email ) ) {
			self::$result = 'error';
			return;
		}

		$body  = sprintf( "Nombre: %s\n", $name );
		$body .= sprintf( "Email: %s\n\n", $email );
		$body .= sprintf( "Comentario:\n%s\n", $msg );

		$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

		$sent = wp_mail( $to ? $to : get_option( 'admin_email' ), $subject, $body, $headers );

		self::$result = $sent ? 'success' : 'error';
	}

	public static function render_field( $atts ) {
		$atts = shortcode_atts(
			array(
				'label'    => '',
				'type'     => 'text',
				'required' => '0',
			),
			$atts,
			'contact-field'
		);

		$name     = sanitize_title( $atts['label'] );
		$required = ! empty( $atts['required'] ) && '0' !== $atts['required'];

		self::$fields[] = array(
			'name'     => $name,
			'label'    => $atts['label'],
			'required' => $required,
		);

		$value = isset( $_POST[ $name ] ) ? sanitize_text_field( wp_unslash( $_POST[ $name ] ) ) : '';

		ob_start();
		?>
		<p class="contact-form-field">
			<label for="nubamia-field-<?php echo esc_attr( $name ); ?>">
				<?php echo esc_html( $atts['label'] ); ?><?php echo $required ? ' *' : ''; ?>
			</label>
			<?php if ( 'textarea' === $atts['type'] ) : ?>
				<textarea id="nubamia-field-<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php echo $required ? 'required' : ''; ?>><?php echo esc_textarea( $value ); ?></textarea>
			<?php else : ?>
				<?php $input_type = 'email' === $atts['type'] ? 'email' : 'text'; ?>
				<input type="<?php echo esc_attr( $input_type ); ?>" id="nubamia-field-<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" <?php echo $required ? 'required' : ''; ?>>
			<?php endif; ?>
		</p>
		<?php
		return ob_get_clean();
	}

	public static function render_form( $atts, $content = '' ) {
		self::$fields = array();

		$atts = shortcode_atts(
			array(
				'to'      => get_option( 'admin_email' ),
				'subject' => __( 'Nuevo mensaje de contacto', 'nubamia' ),
			),
			$atts,
			'contact-form'
		);

		$fields_html = do_shortcode( $content );

		ob_start();

		if ( 'success' === self::$result ) {
			?>
			<div class="contact-form-message contact-form-success">
				<p><?php esc_html_e( '¡Gracias! Hemos recibido tu mensaje y te contestaremos lo antes posible.', 'nubamia' ); ?></p>
			</div>
			<?php
			return ob_get_clean();
		}
		?>

		<?php if ( 'error' === self::$result ) : ?>
			<div class="contact-form-message contact-form-error">
				<p><?php esc_html_e( 'No hemos podido enviar tu mensaje. Revisa los datos e inténtalo de nuevo.', 'nubamia' ); ?></p>
			</div>
		<?php endif; ?>

		<form class="contact-form" method="post" action="<?php echo esc_url( get_permalink() ); ?>#contact-form">
			<?php echo $fields_html; ?>
			<input type="text" name="nubamia_contact_website" value="" autocomplete="off" tabindex="-1" style="position:absolute;left:-9999px;" aria-hidden="true">
			<input type="hidden" name="nubamia_contact_to" value="<?php echo esc_attr( $atts['to'] ); ?>">
			<input type="hidden" name="nubamia_contact_subject" value="<?php echo esc_attr( $atts['subject'] ); ?>">
			<?php wp_nonce_field( 'nubamia_contact_form', 'nubamia_contact_nonce' ); ?>
			<p>
				<input type="submit" name="nubamia_contact_submit" value="<?php esc_attr_e( 'Enviar', 'nubamia' ); ?>">
			</p>
		</form>
		<?php
		return ob_get_clean();
	}
}

Nubamia_Contact_Form::init();
