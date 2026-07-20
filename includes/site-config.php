<?php
// Loads per-site config written by site-verify and post-deploy Edge Functions.
// Sets $gscVerification (string) and $ga4MeasurementId (string) for use in head.php / footer.php.
$__siteConfigPath = __DIR__ . '/site-config.json';
$gscVerification = '';
$ga4MeasurementId = '';
if (is_readable($__siteConfigPath)) {
    $__cfg = json_decode(file_get_contents($__siteConfigPath), true);
    if (is_array($__cfg)) {
        $gscVerification  = isset($__cfg['gsc_verification'])    ? (string) $__cfg['gsc_verification']    : '';
        $ga4MeasurementId = isset($__cfg['ga4_measurement_id'])  ? (string) $__cfg['ga4_measurement_id']  : '';
    }
}
