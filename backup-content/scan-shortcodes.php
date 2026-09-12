<?php
$ids = array( 1130, 1096, 1053, 1031, 1005, 991, 924, 941, 926, 908, 858, 845, 812, 791, 734, 705, 653, 613, 549, 514, 481, 454, 405, 375, 311, 35, 14 );

foreach ( $ids as $id ) {
	$post = get_post( $id );
	if ( ! $post ) {
		continue;
	}
	$content = $post->post_content;
	$hits    = array();

	foreach ( array( 'fusion_builder', 'fusion_text', 'fusion_slider', 'fusion_checklist', 'fusion_', 'su_list', 'su_', '[gallery' ) as $needle ) {
		if ( strpos( $content, '[' . $needle ) !== false || strpos( $content, $needle ) !== false ) {
			$hits[] = $needle;
		}
	}

	$has_fusion = ( strpos( $content, 'fusion_' ) !== false );
	$has_su     = ( strpos( $content, '[su_' ) !== false );
	$has_gallery = ( strpos( $content, '[gallery' ) !== false );

	printf(
		"%d\t%s\tfusion=%s\tsu=%s\tgallery=%s\tlen=%d\n",
		$id,
		$post->post_title,
		$has_fusion ? 'YES' : 'no',
		$has_su ? 'YES' : 'no',
		$has_gallery ? 'YES' : 'no',
		strlen( $content )
	);
}
