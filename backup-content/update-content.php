<?php
$map = array(
	135 => '/tmp/page-135.clean.html',
	140 => '/tmp/page-140.clean.html',
	164 => '/tmp/page-164.clean.html',
);

foreach ( $map as $id => $file ) {
	$content = file_get_contents( $file );
	$result  = wp_update_post(
		array(
			'ID'           => $id,
			'post_content' => $content,
		),
		true
	);
	if ( is_wp_error( $result ) ) {
		echo "ERROR updating $id: " . $result->get_error_message() . "\n";
	} else {
		echo "Updated post $id\n";
	}
}
