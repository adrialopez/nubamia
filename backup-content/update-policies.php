<?php
$privacy_content = file_get_contents( '/tmp/politica-privacidad.html' );
$cookies_content = file_get_contents( '/tmp/politica-cookies.html' );

// Update the existing (English boilerplate) Privacy Policy page in place.
$result = wp_update_post(
	array(
		'ID'           => 1247,
		'post_title'   => 'Política de Privacidad',
		'post_name'    => 'politica-privacidad',
		'post_content' => $privacy_content,
	),
	true
);

if ( is_wp_error( $result ) ) {
	echo "ERROR updating 1247: " . $result->get_error_message() . "\n";
} else {
	echo "Updated privacy page: $result\n";
}

// Create the new cookie policy page (none existed).
$existing = get_page_by_path( 'politica-cookies' );

if ( $existing ) {
	echo "politica-cookies already exists as {$existing->ID}, updating content\n";
	wp_update_post(
		array(
			'ID'           => $existing->ID,
			'post_content' => $cookies_content,
		)
	);
} else {
	$new_id = wp_insert_post(
		array(
			'post_title'   => 'Política de Cookies',
			'post_name'    => 'politica-cookies',
			'post_content' => $cookies_content,
			'post_status'  => 'publish',
			'post_type'    => 'page',
		),
		true
	);
	if ( is_wp_error( $new_id ) ) {
		echo "ERROR creating cookies page: " . $new_id->get_error_message() . "\n";
	} else {
		echo "Created cookies page: $new_id\n";
	}
}
