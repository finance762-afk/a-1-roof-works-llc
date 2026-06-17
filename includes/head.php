<?php
require_once __DIR__ . '/site-config.php';
/**
 * head.php — Document <head> for A-1 Roof Works LLC
 *
 * Requires the calling page to have already set (or will use sensible defaults):
 *   $pageTitle       — full <title> string
 *   $pageDescription — meta description (150-160 chars)
 *   $canonicalUrl    — absolute self-referencing URL
 *   $ogImage         — absolute or root-relative path to OG image
 *   $currentPage     — slug used for nav active state + GSC conditional
 *   $schemaMarkup    — (optional) page-specific JSON-LD string
 *   $noindex         — (optional) true on thank-you.php
 *   $heroPreloadImage — (optional) root-relative path to hero bg image
 *   $useSwiper       — (optional) true to load Swiper CSS
 *
 * config.php and functions.php are loaded via require_once so it's safe
 * to call head.php as the very first include on a page.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

/* ── Resolve title ──────────────────────────────────────────────────────── */
if (empty($pageTitle)) {
    $pageTitle = $siteName
        . ' | ' . (!empty($primaryKeyword) ? ucwords($primaryKeyword) : 'Roofing Contractor')
        . (!empty($address['city']) ? ' | ' . $address['city'] . ', ' . $address['state'] : '');
}

/* ── Resolve OG image ───────────────────────────────────────────────────── */
if (empty($ogImage)) {
    $resolvedOgImage = $siteUrl . '/assets/images/og-home.jpg';
} elseif (strpos($ogImage, 'http') === 0) {
    $resolvedOgImage = $ogImage;
} else {
    $resolvedOgImage = $siteUrl . '/' . ltrim($ogImage, '/');
}

/* ── Brand color tokens (with sensible roofing-industry defaults) ──────── */
$primaryHex     = !empty($colors['primary'])      ? $colors['primary']      : '#1b3a6b';
$primaryDarkHex = !empty($colors['primary_dark']) ? $colors['primary_dark'] : '#0f2440';
$secondaryHex   = !empty($colors['secondary'])    ? $colors['secondary']    : '#2d6fa6';
$accentHex      = !empty($colors['accent'])       ? $colors['accent']       : '#e8a000';

$primaryRgb     = hexToRgb($primaryHex);
$primaryDarkRgb = hexToRgb($primaryDarkHex);
$accentRgb      = hexToRgb($accentHex);

/* ── Build LocalBusiness schema as PHP array → json_encode ─────────────── */
$lbSchema = [
    '@context'    => 'https://schema.org',
    '@type'       => ['LocalBusiness', 'RoofingContractor'],
    'name'        => $siteName,
    'url'         => $siteUrl,
    'telephone'   => $phone,
    'email'       => $email,
    'description' => $siteName . ' is a licensed roofing contractor serving '
                   . (!empty($address['city']) ? $address['city'] . ', ' . $address['state'] : 'the local area')
                   . '. We specialize in roof replacement, roof repair, and storm damage restoration.',
    'address'     => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => $address['street'],
        'addressLocality' => $address['city'],
        'addressRegion'   => $address['state'],
        'postalCode'      => $address['zip'],
        'addressCountry'  => 'US',
    ],
    'image' => $resolvedOgImage,
];

// AggregateRating — only if we have both ratingValue and reviewCount
if (!empty($aggregateRating) && !empty($aggregateRatingCount)) {
    $lbSchema['aggregateRating'] = [
        '@type'       => 'AggregateRating',
        'ratingValue' => (string) $aggregateRating,
        'reviewCount' => (string) $aggregateRatingCount,
        'bestRating'  => '5',
        'worstRating' => '1',
    ];
}

// areaServed — from $serviceAreas
if (!empty($serviceAreas)) {
    $lbSchema['areaServed'] = array_map(function($area) {
        return ['@type' => 'City', 'name' => $area['city'] . ', ' . $area['state']];
    }, $serviceAreas);
}

// hasOfferCatalog — from $services
if (!empty($services)) {
    $lbSchema['hasOfferCatalog'] = [
        '@type'           => 'OfferCatalog',
        'name'            => 'Roofing Services',
        'itemListElement' => array_map(function($svc) {
            return [
                '@type'        => 'Offer',
                'itemOffered'  => [
                    '@type'       => 'Service',
                    'name'        => $svc['name'],
                    'description' => $svc['description'] ?? '',
                ],
            ];
        }, $services),
    ];
}

// sameAs — from $socialLinks
$sameAs = array_values(array_filter($socialLinks ?? []));
if (!empty($sameAs)) {
    $lbSchema['sameAs'] = $sameAs;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php if (!empty($noindex)): ?>
  <meta name="robots" content="noindex,nofollow">
<?php else: ?>
  <meta name="robots" content="index,follow,max-snippet:-1,max-image-preview:large,max-video-preview:-1">
<?php endif; ?>

  <!-- Primary SEO -->
  <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars(isset($pageDescription) ? $pageDescription : '', ENT_QUOTES, 'UTF-8'); ?>">
  <link rel="canonical" href="<?php echo htmlspecialchars(isset($canonicalUrl) ? $canonicalUrl : $siteUrl, ENT_QUOTES, 'UTF-8'); ?>">

  <!-- Open Graph (no Twitter/X cards per build standards) -->
  <meta property="og:type"        content="website">
  <meta property="og:title"       content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars(isset($pageDescription) ? $pageDescription : '', ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:url"         content="<?php echo htmlspecialchars(isset($canonicalUrl) ? $canonicalUrl : $siteUrl, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:image"       content="<?php echo htmlspecialchars($resolvedOgImage, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:image:width"  content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:site_name"   content="<?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:locale"      content="en_US">

  <!-- Performance hints -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="dns-prefetch" href="https://fonts.googleapis.com">
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">

  <!-- Google Fonts: Rajdhani (heading) + Open Sans (body) — construction/roofing pairing -->
  <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap"
        onload="this.onload=null;this.rel='stylesheet'">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap">
  <noscript>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap">
  </noscript>

<?php if (!empty($heroPreloadImage)): ?>
  <!-- Hero image preload (LCP optimisation) -->
  <link rel="preload" as="image" href="<?php echo htmlspecialchars($heroPreloadImage, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif; ?>

<?php if (!empty($useSwiper)): ?>
  <!-- Swiper CSS (conditional) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<?php endif; ?>

  <!-- Brand color token override (applied after framework.css loads) -->
  <style>
    :root {
      --color-primary:          <?php echo $primaryHex; ?>;
      --color-primary-dark:     <?php echo $primaryDarkHex; ?>;
      --color-primary-rgb:      <?php echo $primaryRgb; ?>;
      --color-primary-dark-rgb: <?php echo $primaryDarkRgb; ?>;
      --color-secondary:        <?php echo $secondaryHex; ?>;
      --color-accent:           <?php echo $accentHex; ?>;
      --color-accent-rgb:       <?php echo $accentRgb; ?>;
      --color-bg-dark:          <?php echo $primaryHex; ?>;
      --font-heading: 'Rajdhani', system-ui, sans-serif;
      --font-body:    'Open Sans', system-ui, sans-serif;
    }
  </style>

  <!-- Shared framework stylesheet -->
  <link rel="stylesheet" href="/assets/css/framework.css">

  <!-- Favicon -->
  <link rel="icon" href="/assets/images/favicon.svg" type="image/svg+xml">
  <link rel="icon" href="/assets/images/favicon.svg" sizes="any">

<?php if (!empty($ga4MeasurementId)): ?>
  <!-- Google Analytics 4 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo htmlspecialchars($ga4MeasurementId, ENT_QUOTES, 'UTF-8'); ?>"></script>
  <script>
    window.dataLayer=window.dataLayer||[];
    function gtag(){dataLayer.push(arguments);}
    gtag('js',new Date());
    gtag('config','<?php echo htmlspecialchars($ga4MeasurementId, ENT_QUOTES, 'UTF-8'); ?>');
  </script>
<?php else: ?>
  <!-- GA4 tracking inactive — add your Measurement ID to $ga4MeasurementId in config.php -->
<?php endif; ?>

<?php if (!empty($gscVerification) && (isset($currentPage) && $currentPage === 'home')): ?>
  <!-- Google Search Console verification (homepage only) -->
  <meta name="google-site-verification" content="<?php echo htmlspecialchars($gscVerification, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif; ?>

  <!-- LocalBusiness schema (on every page) -->
  <script type="application/ld+json">
<?php echo json_encode($lbSchema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
  </script>

<?php if (!empty($schemaMarkup)): ?>
  <!-- Page-specific schema -->
  <script type="application/ld+json">
<?php echo $schemaMarkup; ?>
  </script>
<?php endif; ?>

<?php require_once __DIR__ . '/edit-mode.php'; ?>
</head>
<body class="page-<?php echo htmlspecialchars(isset($currentPage) ? $currentPage : 'default', ENT_QUOTES, 'UTF-8'); ?>">
