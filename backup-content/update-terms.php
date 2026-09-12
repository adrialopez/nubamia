<?php
$content = file_get_contents( '/tmp/terminos-uso.html' );

$result = wp_update_post(
	array(
		'ID'           => 1246,
		'post_title'   => 'Términos de Uso',
		'post_name'    => 'terminos-de-uso',
		'post_content' => $content,
	),
	true
);

echo is_wp_error( $result ) ? 'ERROR: ' . $result->get_error_message() : "Updated: $result\n";

update_post_meta( 1246, '_wp_old_slug', 'terms-of-use' );
