<?php
$ids = array( 1130, 1096, 1053, 1005, 991, 924, 941, 926, 908, 858, 791, 734, 705, 653, 613, 514, 481, 454, 405, 375, 311, 35 );

$backup_dir = '/tmp/nubamia-post-backups';
if ( ! is_dir( $backup_dir ) ) {
	mkdir( $backup_dir, 0755, true );
}

foreach ( $ids as $id ) {
	$post = get_post( $id );
	if ( ! $post ) {
		echo "SKIP $id (not found)\n";
		continue;
	}

	// Backup original content before touching it.
	file_put_contents( "$backup_dir/post-$id.html", $post->post_content );

	$content = $post->post_content;

	// Strip every fusion_* shortcode tag (opening incl. attributes, and closing),
	// but leave everything else (su_list, gallery, sociallocker, actual text/HTML) untouched.
	$content = preg_replace( '/\[\/?fusion_[a-z0-9_]*(?:\s[^\]]*)?\]/i', '', $content );

	$result = wp_update_post(
		array(
			'ID'           => $id,
			'post_content' => $content,
		),
		true
	);

	if ( is_wp_error( $result ) ) {
		echo "ERROR $id: " . $result->get_error_message() . "\n";
	} else {
		$remaining = ( strpos( $content, 'fusion_' ) !== false ) ? 'STILL HAS fusion_' : 'clean';
		echo "Updated $id ($post->post_title) - $remaining\n";
	}
}
