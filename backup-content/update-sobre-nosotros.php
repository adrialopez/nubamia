<?php
$content = file_get_contents( '/tmp/sobre-nosotros-updated.html' );
$result  = wp_update_post(
	array(
		'ID'           => 120,
		'post_content' => $content,
	),
	true
);
echo is_wp_error( $result ) ? 'ERROR: ' . $result->get_error_message() : "Updated: $result\n";
