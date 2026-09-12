<?php
$social = get_option( 'wpseo_social' );

$logo_url = 'https://nubamia.com/wp-content/uploads/2013/01/nubamia-logo.png';

$social['og_default_image']    = $logo_url;
$social['og_default_image_id'] = 12;

update_option( 'wpseo_social', $social );

$check = get_option( 'wpseo_social' );
echo 'og_default_image: ' . $check['og_default_image'] . "\n";
