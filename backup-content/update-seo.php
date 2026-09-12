<?php
$titles = get_option( 'wpseo_titles' );

$titles['company_name']         = 'Nubamía';
$titles['company_logo']         = 'https://nubamia.com/wp-content/uploads/2013/01/nubamia-logo.png';
$titles['company_logo_id']      = 12;
$titles['company_or_person']    = 'company';

$updated = update_option( 'wpseo_titles', $titles );

echo $updated ? "wpseo_titles updated\n" : "wpseo_titles unchanged (already set?)\n";

$current = get_option( 'wpseo_titles' );
echo 'company_name: ' . $current['company_name'] . "\n";
echo 'company_logo: ' . $current['company_logo'] . "\n";
