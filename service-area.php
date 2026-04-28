<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
/* ─────────────────────────────────────────────────────────────────────────────
 * service-area.php — Service Area Overview
 * A-1 Roof Works LLC
 * Standard Tier: ≥ 200 lines inline CSS · ≥ 4 distinct techniques
 * Techniques used:
 *   C1.1  Full-Bleed Hero with ::before gradient overlay + ::after noise texture
 *   C2    Hero content cascade (staggered keyframe entrance)
 *   C3    Section dividers — diagonal, torn-paper, wave (3 distinct variants)
 *   C4.2  Diagonal gradient CTA banner with noise overlay (mid-page CTA #2)
 *   C5.2  Eyebrow badges (solid-accent + pill)
 *   C5.3  Large editorial pullquote with oversized accent typography (signature section)
 *   C6.3  Area cards grid with hover lift + accent underline
 *   C7    Signature editorial pullquote section — tight column, accent border, large type
 *   C9    3D press buttons throughout
 * ───────────────────────────────────────────────────────────────────────────── */

// ── Config helpers ────────────────────────────────────────────────────────────
$city        = !empty($address['city'])  ? $address['city']  : 'the Area';
$state       = !empty($address['state']) ? $address['state'] : '';
$cityState   = $city . ($state ? ', ' . $state : '');
$yearsNum    = !empty($yearsInBusiness) ? (string)$yearsInBusiness : '15';

// Service areas — use config if populated, else fallback generic
$displayAreas = [];
if (!empty($serviceAreas)) {
    foreach ($serviceAreas as $area) {
        $displayAreas[] = [
            'city'    => $area['city'],
            'state'   => $area['state'] ?? $state,
            'primary' => $area['primary'] ?? false,
            'blurb'   => !empty($area['primary'])
                ? 'Our primary service hub. We typically respond same-day for inspections and within 48 hours for estimates across ' . $area['city'] . '.'
                : 'Full roofing services available — replacement, repair, storm damage, inspection, and gutters throughout ' . $area['city'] . '.',
        ];
    }
} else {
    // Fallback when no service areas are configured
    $displayAreas = [
        [
            'city'    => $city,
            'state'   => $state,
            'primary' => true,
            'blurb'   => 'Our primary service hub. We respond same-day for inspections and within 48 hours for estimates across ' . $cityState . '.',
        ],
        [
            'city'    => 'Surrounding Communities',
            'state'   => $state,
            'primary' => false,
            'blurb'   => 'We serve the wider regional area for all roofing services — replacement, repair, storm damage, inspection, and gutters.',
        ],
        [
            'city'    => 'Nearby Counties',
            'state'   => $state,
            'primary' => false,
            'blurb'   => 'Coverage extends into neighboring counties. Call to confirm service availability for your specific address.',
        ],
        [
            'city'    => 'Commercial Clients',
            'state'   => $state,
            'primary' => false,
            'blurb'   => 'Commercial roofing available across the broader regional area. TPO, modified bitumen, and low-slope systems.',
        ],
    ];
}

// ── Page meta ─────────────────────────────────────────────────────────────────
$pageTitle       = 'Roofing in ' . $city . ' & Surrounding Areas | A-1 Roof Works LLC';
$pageDescription = 'A-1 Roof Works LLC serves ' . $cityState . ' and the surrounding region with local crews, same-day storm response, and roofing expertise built for the area. Get a free estimate.';
$canonicalUrl    = $siteUrl . '/service-area';
$ogImage         = '/assets/images/service-area-hero.png';
$heroPreloadImage = '/assets/images/service-area-hero.png';
$currentPage     = 'service-area';

// ── Service Area FAQs ─────────────────────────────────────────────────────────
$areaFaqs = [
    [
        'question' => 'What areas does A-1 Roof Works LLC serve?',
        'answer'   => 'We serve ' . $cityState . ' and the surrounding region. Our crews are locally based — not dispatched from hours away. For specific locations outside our primary area, call us directly. If we can reach your property within a reasonable distance, we\'ll schedule the job.',
    ],
    [
        'question' => 'Do you charge a travel fee for areas outside ' . $city . '?',
        'answer'   => 'No travel surcharge for jobs within our standard service radius. For projects at the outer edge of our coverage area, we\'ll discuss any logistics honestly before scheduling — there are no hidden fees added after the estimate is signed.',
    ],
    [
        'question' => 'How quickly can you respond for emergency roof repairs near me?',
        'answer'   => 'For active leaks or storm damage in our primary service area, we target same-day response. We\'ll get someone to the property to assess the damage and secure the roof if needed — the goal is to stop further damage before it compounds.',
    ],
];

// ── Schema — FAQPage ──────────────────────────────────────────────────────────
$faqSchema    = generateFAQSchema($areaFaqs);
$breadcrumbSchema = generateBreadcrumbSchema([
    ['name' => 'Home',         'url' => $siteUrl . '/'],
    ['name' => 'Service Area'],
]);
$schemaMarkup = json_encode(
    [$faqSchema, $breadcrumbSchema],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
);

// ── Load shared components ────────────────────────────────────────────────────
// SEO: <link rel="canonical"> + <script type="application/ld+json"> are rendered by includes/head.php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════════════════════
     PAGE-SPECIFIC STYLES — Service Area
     Standard Tier: ≥ 200 lines inline CSS · ≥ 4 distinct techniques
═══════════════════════════════════════════════════════════════════════════ -->
<style>

/* ─── 0. Page utilities ───────────────────────────────────────────────────── */
.page-service-area .section-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  font-family: var(--font-heading);
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  margin-bottom: var(--space-md);
}
.page-service-area .eyebrow-solid {
  background: var(--color-accent);
  color: var(--color-primary-dark);
  padding: var(--space-xs) var(--space-md);
  border-radius: 999px;
}
.page-service-area .eyebrow-pill {
  background: rgba(var(--color-accent-rgb), 0.12);
  border: 1px solid rgba(var(--color-accent-rgb), 0.35);
  color: var(--color-accent);
  padding: 6px var(--space-md);
  border-radius: 999px;
}
.page-service-area .section-heading {
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
  text-wrap: balance;
  color: var(--color-primary);
  margin-bottom: var(--space-lg);
}
.page-service-area .section-lead {
  font-size: 1.02rem;
  color: var(--color-text-light);
  line-height: 1.65;
  max-width: 62ch;
}
.page-service-area .section-header { margin-bottom: var(--space-3xl); }
.page-service-area .section-header.centered { text-align: center; }
.page-service-area .section-header.centered .section-lead { margin-inline: auto; }
.sa-svg-divider { display: block; overflow: hidden; line-height: 0; }
.sa-svg-divider svg { display: block; width: 100%; height: 60px; }

/* ─── 1. Hero (C1.1 + C2) ────────────────────────────────────────────────── */
.sa-hero {
  min-height: 60vh;
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
  background-image: url('/assets/images/service-area-hero.png');
  background-size: cover;
  background-position: center 45%;
}
.sa-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    152deg,
    rgba(var(--color-primary-rgb), 0.94) 0%,
    rgba(var(--color-primary-rgb), 0.78) 55%,
    rgba(var(--color-accent-rgb), 0.08) 100%
  );
  z-index: 1;
}
.sa-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  z-index: 1;
  pointer-events: none;
}
.sa-hero-inner {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: calc(var(--navbar-height) + var(--space-3xl)) 0 var(--space-3xl);
}
.sa-hero-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: rgba(var(--color-accent-rgb), 0.14);
  border: 1px solid rgba(var(--color-accent-rgb), 0.40);
  border-radius: 999px;
  padding: 7px 20px;
  font-family: var(--font-heading);
  font-size: 0.70rem;
  font-weight: 700;
  letter-spacing: 2.5px;
  text-transform: uppercase;
  color: var(--color-accent);
  margin-bottom: var(--space-xl);
  animation: sa-fade-down 0.6s ease both;
}
.sa-hero h1 {
  font-size: clamp(2rem, 5.5vw, 3.8rem);
  font-weight: 900;
  line-height: 1.1;
  letter-spacing: -0.03em;
  color: #fff;
  text-wrap: balance;
  max-width: 24ch;
  margin-bottom: var(--space-lg);
  animation: sa-fade-up 0.65s ease 0.12s both;
}
.sa-hero-subtitle {
  font-size: clamp(0.95rem, 2vw, 1.1rem);
  color: rgba(255,255,255,0.80);
  line-height: 1.65;
  max-width: 52ch;
  margin-bottom: var(--space-2xl);
  animation: sa-fade-up 0.65s ease 0.24s both;
}
.sa-hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  align-items: center;
  animation: sa-fade-up 0.65s ease 0.36s both;
}
.btn-sa-primary {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: var(--color-accent);
  color: var(--color-primary-dark);
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 800;
  letter-spacing: 0.04em;
  padding: 15px var(--space-2xl);
  border-radius: var(--radius-md);
  border: none;
  box-shadow: 0 4px 0 rgba(0,0,0,0.28);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  cursor: pointer;
  overflow: hidden;
}
.btn-sa-primary:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.22); }
.btn-sa-primary:active { transform: translateY(2px);  box-shadow: 0 2px 0 rgba(0,0,0,0.22); }
.btn-sa-outline {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: transparent;
  color: #fff;
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 600;
  letter-spacing: 0.04em;
  padding: 14px var(--space-xl);
  border-radius: var(--radius-md);
  border: 2px solid rgba(255,255,255,0.52);
  transition: border-color var(--transition-fast), background var(--transition-fast);
}
.btn-sa-outline:hover { border-color: #fff; background: rgba(255,255,255,0.08); }
@keyframes sa-fade-down { from { opacity:0; transform:translateY(-14px); } to { opacity:1; transform:translateY(0); } }
@keyframes sa-fade-up   { from { opacity:0; transform:translateY(18px);  } to { opacity:1; transform:translateY(0); } }

/* ─── 2. Service Area Overview ───────────────────────────────────────────── */
.sa-overview-section {
  padding: var(--section-pad);
  background: var(--color-bg-alt);
}
.sa-overview-body {
  font-size: 0.98rem;
  color: var(--color-text-light);
  line-height: 1.72;
  max-width: 65ch;
  margin-bottom: var(--space-3xl);
}
.sa-overview-body strong { color: var(--color-primary); font-weight: 600; }

/* ─── 3. Area Cards Grid (C6.3 — hover lift + accent underline) ──────────── */
.area-cards-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-xl);
}
.area-card {
  background: var(--color-bg);
  border-radius: var(--radius-lg);
  padding: var(--space-xl);
  box-shadow: var(--shadow-card);
  border-bottom: 3px solid transparent;
  transition: all var(--transition-base);
  position: relative;
}
.area-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-xl);
  border-bottom-color: var(--color-accent);
}
.area-card-primary {
  background: var(--color-primary);
  border-bottom-color: var(--color-accent);
}
.area-card-primary:hover { background: var(--color-primary-dark); }
.area-icon-wrap {
  width: 44px; height: 44px;
  background: rgba(var(--color-primary-rgb), 0.07);
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: var(--space-md);
  transition: background var(--transition-fast);
}
.area-card:hover .area-icon-wrap { background: rgba(var(--color-accent-rgb), 0.10); }
.area-card-primary .area-icon-wrap { background: rgba(255,255,255,0.10); }
.area-icon-wrap [data-lucide] { width: 20px; height: 20px; color: var(--color-primary); transition: color var(--transition-fast); }
.area-card:hover .area-icon-wrap [data-lucide] { color: var(--color-accent); }
.area-card-primary .area-icon-wrap [data-lucide] { color: var(--color-accent); }
.area-card h3 {
  font-family: var(--font-heading);
  font-size: clamp(1rem, 2vw, 1.2rem);
  font-weight: 800;
  color: var(--color-primary);
  letter-spacing: -0.01em;
  text-wrap: balance;
  margin-bottom: var(--space-sm);
}
.area-card-primary h3 { color: #fff; }
.area-state-tag {
  display: inline-block;
  font-size: 0.68rem;
  font-weight: 700;
  font-family: var(--font-heading);
  text-transform: uppercase;
  letter-spacing: 1.5px;
  color: var(--color-accent);
  margin-bottom: var(--space-md);
}
.area-card p {
  font-size: 0.86rem;
  color: var(--color-text-light);
  line-height: 1.60;
  margin: 0;
}
.area-card-primary p { color: rgba(255,255,255,0.72); }
.area-primary-badge {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  background: var(--color-accent);
  color: var(--color-primary-dark);
  font-family: var(--font-heading);
  font-size: 0.65rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  padding: 3px 10px;
  border-radius: 999px;
  margin-bottom: var(--space-md);
}

/* ─── 4. Map Section ─────────────────────────────────────────────────────── */
.sa-map-section {
  padding: var(--space-4xl) 0;
  background: var(--color-bg);
}
.sa-map-section .container { padding-bottom: 0; }
.sa-map-embed {
  width: 100%;
  aspect-ratio: 21 / 7;
  min-height: 360px;
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-lg);
}
.sa-map-embed iframe { width: 100%; height: 100%; border: none; display: block; }

/* ─── 5. Why Local Matters — Signature Section (C5.3 + C7) ──────────────── */
/* Editorial pullquote with large accent typography — signature section */
.sa-local-section {
  padding: var(--section-pad);
  background: var(--color-bg-alt);
}
.sa-local-editorial {
  max-width: 780px;
  margin: 0 auto;
  text-align: center;
}
/* Giant decorative quote mark */
.sa-local-editorial::before {
  content: '\201C';
  display: block;
  font-family: var(--font-heading);
  font-size: clamp(6rem, 12vw, 10rem);
  line-height: 0.7;
  color: var(--color-accent);
  opacity: 0.25;
  margin-bottom: calc(-1 * var(--space-lg));
  pointer-events: none;
}
.sa-pullquote {
  position: relative;
  border-left: none;
  padding: var(--space-2xl) var(--space-3xl);
  background: var(--color-bg);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-md);
  border-top: 4px solid var(--color-accent);
  margin-bottom: var(--space-3xl);
}
.sa-pullquote blockquote {
  font-family: var(--font-heading);
  font-size: clamp(1.15rem, 2.5vw, 1.55rem);
  font-weight: 700;
  line-height: 1.55;
  color: var(--color-primary);
  text-wrap: balance;
  letter-spacing: -0.01em;
  font-style: italic;
  margin: 0;
}
.sa-pullquote-attr {
  display: block;
  margin-top: var(--space-xl);
  font-size: 0.80rem;
  font-weight: 700;
  font-family: var(--font-heading);
  text-transform: uppercase;
  letter-spacing: 0.12em;
  color: var(--color-accent);
  font-style: normal;
}
/* Three local advantage points below quote */
.sa-local-advantages {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-xl);
  text-align: left;
}
.local-advantage {
  padding: var(--space-xl);
  background: var(--color-bg);
  border-radius: var(--radius-md);
  border-top: 3px solid var(--color-primary);
  box-shadow: var(--shadow-sm);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
}
.local-advantage:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
.local-advantage-icon {
  width: 44px; height: 44px;
  background: rgba(var(--color-primary-rgb), 0.07);
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: var(--space-md);
}
.local-advantage-icon [data-lucide] { width: 20px; height: 20px; color: var(--color-primary); }
.local-advantage h4 {
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 800;
  color: var(--color-primary);
  text-wrap: balance;
  margin-bottom: var(--space-sm);
}
.local-advantage p {
  font-size: 0.86rem;
  color: var(--color-text-light);
  line-height: 1.60;
  margin: 0;
}

/* ─── 6. Mid-Page CTA Banner (C4.2 — CTA #2) ────────────────────────────── */
.sa-cta-banner {
  position: relative;
  overflow: hidden;
  padding: var(--space-4xl) 20px;
  background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 55%, var(--color-secondary) 100%);
  text-align: center;
}
.sa-cta-banner::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
  opacity: 0.06;
  pointer-events: none;
}
.sa-cta-inner { position: relative; z-index: 1; }
.sa-cta-banner h2 {
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  font-weight: 900;
  color: #fff;
  letter-spacing: -0.025em;
  line-height: 1.1;
  text-wrap: balance;
  margin-bottom: var(--space-md);
}
.sa-cta-banner p {
  font-size: 1.02rem;
  color: rgba(255,255,255,0.78);
  max-width: 52ch;
  margin: 0 auto var(--space-2xl);
  line-height: 1.65;
}
.sa-cta-banner .phone-big {
  display: block;
  font-family: var(--font-heading);
  font-size: clamp(1.6rem, 4vw, 2.6rem);
  font-weight: 900;
  color: var(--color-accent);
  letter-spacing: -0.01em;
  margin-bottom: var(--space-xl);
}
.btn-sa-cta {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: var(--color-accent);
  color: var(--color-primary-dark);
  font-family: var(--font-heading);
  font-size: 1.05rem;
  font-weight: 800;
  letter-spacing: 0.04em;
  padding: 16px var(--space-2xl);
  border-radius: var(--radius-md);
  box-shadow: 0 4px 0 rgba(0,0,0,0.28);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  overflow: hidden;
}
.btn-sa-cta:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.22); }
.btn-sa-cta:active { transform: translateY(2px);  box-shadow: 0 2px 0 rgba(0,0,0,0.22); }

/* ─── 7. Service Area FAQs ───────────────────────────────────────────────── */
.sa-faq-section {
  padding: var(--section-pad);
  background: var(--color-bg);
}
.sa-faq-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-lg);
  max-width: 820px;
  margin: 0 auto;
}
.sa-faq-item {
  background: var(--color-bg-alt);
  border-radius: var(--radius-md);
  padding: var(--space-xl) var(--space-2xl);
  border-left: 4px solid var(--color-accent);
  transition: box-shadow var(--transition-fast), transform var(--transition-fast);
}
.sa-faq-item:hover { box-shadow: var(--shadow-md); transform: translateY(-2px); }
.sa-faq-item h3 {
  font-size: 1.02rem;
  font-weight: 700;
  color: var(--color-primary);
  line-height: 1.35;
  text-wrap: balance;
  margin-bottom: var(--space-md);
}
.sa-faq-item p {
  font-size: 0.90rem;
  color: var(--color-text-light);
  line-height: 1.68;
  max-width: 65ch;
  margin: 0;
}

/* ─── 8. Closing CTA (CTA #3) ────────────────────────────────────────────── */
.sa-closing-cta {
  padding: var(--section-pad);
  background: var(--color-bg-alt);
  text-align: center;
}
.sa-closing-cta h2 {
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  font-weight: 900;
  color: var(--color-primary);
  letter-spacing: -0.025em;
  line-height: 1.1;
  text-wrap: balance;
  margin-bottom: var(--space-md);
}
.sa-closing-cta p {
  font-size: 1.02rem;
  color: var(--color-text-light);
  max-width: 52ch;
  margin: 0 auto var(--space-2xl);
  line-height: 1.65;
}
.sa-closing-actions {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: var(--space-md);
  align-items: center;
}
.btn-sa-close-primary {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: var(--color-primary);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 1.05rem;
  font-weight: 800;
  letter-spacing: 0.04em;
  padding: 16px var(--space-2xl);
  border-radius: var(--radius-md);
  box-shadow: 0 4px 0 var(--color-primary-dark);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  overflow: hidden;
}
.btn-sa-close-primary:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 var(--color-primary-dark); }
.btn-sa-close-primary:active { transform: translateY(2px);  box-shadow: 0 2px 0 var(--color-primary-dark); }
.btn-sa-close-phone {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: var(--color-accent);
  color: var(--color-primary-dark);
  font-family: var(--font-heading);
  font-size: 1.05rem;
  font-weight: 800;
  letter-spacing: 0.04em;
  padding: 16px var(--space-2xl);
  border-radius: var(--radius-md);
  box-shadow: 0 4px 0 rgba(0,0,0,0.22);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  overflow: hidden;
}
.btn-sa-close-phone:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.16); }
.btn-sa-close-phone:active { transform: translateY(2px);  box-shadow: 0 2px 0 rgba(0,0,0,0.16); }

/* ─── Responsive ──────────────────────────────────────────────────────────── */
@media (max-width: 1023px) {
  .area-cards-grid { grid-template-columns: 1fr 1fr; }
  .sa-local-advantages { grid-template-columns: 1fr; }
  .sa-pullquote { padding: var(--space-xl) var(--space-2xl); }
}
@media (max-width: 767px) {
  .sa-hero { min-height: 70vh; }
  .sa-hero-inner { padding: calc(var(--navbar-height) + var(--space-2xl)) 0 var(--space-2xl); }
  .sa-hero h1 { font-size: clamp(1.9rem, 8vw, 2.8rem); }
  .sa-hero-actions { flex-direction: column; }
  .btn-sa-primary, .btn-sa-outline { width: 100%; justify-content: center; }
  .sa-overview-section { padding: var(--section-pad-mobile); }
  .area-cards-grid { grid-template-columns: 1fr; }
  .sa-map-section { padding: var(--space-3xl) 0; }
  .sa-map-embed { aspect-ratio: 4 / 3; min-height: 280px; border-radius: 0; }
  .sa-local-section { padding: var(--section-pad-mobile); }
  .sa-pullquote { padding: var(--space-lg); }
  .sa-pullquote blockquote { font-size: 1rem; }
  .sa-cta-banner { padding: var(--space-3xl) 20px; }
  .sa-faq-section { padding: var(--section-pad-mobile); }
  .sa-faq-item { padding: var(--space-lg); }
  .sa-closing-cta { padding: var(--section-pad-mobile); }
  .sa-closing-actions { flex-direction: column; }
  .btn-sa-close-primary,
  .btn-sa-close-phone { width: 100%; justify-content: center; }
}
@media (prefers-reduced-motion: reduce) {
  .sa-hero-eyebrow,
  .sa-hero h1,
  .sa-hero-subtitle,
  .sa-hero-actions { animation: none; opacity: 1; transform: none; }
}
/* ── Project Gallery ──────────────────────────────────────────────── */
.sa-gallery-section {
  padding: var(--section-pad);
  background: var(--color-bg-alt);
}
.sa-gallery-header {
  text-align: center;
  margin-bottom: var(--space-3xl);
}
.sa-gallery-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-sm);
}
.sa-gallery-grid-item {
  border-radius: var(--radius-md);
  overflow: hidden;
  aspect-ratio: 4/3;
  position: relative;
}
.sa-gallery-grid-item:first-child {
  grid-column: span 2;
  aspect-ratio: 16/7;
}
.sa-gallery-grid-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--transition-slow);
}
.sa-gallery-grid-item:hover img { transform: scale(1.06); }
@media (max-width: 1023px) {
  .sa-gallery-grid { grid-template-columns: repeat(2, 1fr); }
  .sa-gallery-grid-item:first-child { grid-column: span 2; }
}
@media (max-width: 767px) {
  .sa-gallery-section { padding: var(--section-pad-mobile); }
  .sa-gallery-grid { grid-template-columns: repeat(2, 1fr); gap: var(--space-xs); }
  .sa-gallery-grid-item:first-child { grid-column: span 2; aspect-ratio: 16/9; }
}

</style>

<!-- ── HERO (CTA #1) ─────────────────────────────────────────────────────── -->
<section class="sa-hero" aria-labelledby="sa-hero-heading">
  <div class="sa-hero-inner">
    <div class="container">

      <div class="sa-hero-eyebrow">
        <i data-lucide="map-pin" aria-hidden="true"></i>
        Locally Based · Locally Responsive
      </div>

      <h1 id="sa-hero-heading">
        Roofing Services Across <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?> &amp; Surrounding Communities
      </h1>

      <p class="sa-hero-subtitle">
        Our crews are based in <?php echo htmlspecialchars($city, ENT_QUOTES, 'UTF-8'); ?> — not dispatched from two counties over.
        Same-day storm response. Local knowledge. Crews who know the area before they pull up to your property.
      </p>

      <div class="sa-hero-actions">
        <a href="/contact" class="btn-sa-primary">
          <i data-lucide="clipboard-list" aria-hidden="true"></i>
          Get a Free Estimate
        </a>
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>" class="btn-sa-outline">
          <i data-lucide="phone" aria-hidden="true"></i>
          Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php else: ?>
        <a href="/services" class="btn-sa-outline">
          <i data-lucide="layers" aria-hidden="true"></i>
          View Our Services
        </a>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

<!-- Divider: diagonal into alt bg ──────────────────────────────────────── -->
<div class="sa-svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none">
    <polygon fill="var(--color-bg-alt)" points="0,0 1200,60 1200,60 0,60"/>
  </svg>
</div>

<!-- ── BREADCRUMB ─────────────────────────────────────────────────────────── -->
<nav class="bc-bar" aria-label="Breadcrumb">
  <div class="container">
    <ol class="bc-list" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="/" itemprop="item"><span itemprop="name">Home</span></a>
        <meta itemprop="position" content="1">
      </li>
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">Service Area</span>
        <meta itemprop="position" content="2">
      </li>
    </ol>
  </div>
</nav>

<!-- ── SERVICE AREA OVERVIEW ─────────────────────────────────────────────── -->
<section class="sa-overview-section" aria-labelledby="sa-overview-heading">
  <div class="container">

    <header class="section-header" data-animate="fade-up">
      <span class="section-eyebrow eyebrow-solid">Coverage Area</span>
      <h2 class="section-heading" id="sa-overview-heading">
        Where We Work
      </h2>
    </header>

    <p class="sa-overview-body" data-animate="fade-up">
      <?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?> serves homeowners and property owners
      across <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?> and the surrounding region.
      <strong>Our crews are based locally</strong> — we're not a regional franchise dispatching from hours away.
      When you call for an inspection or emergency response, you get a local team that knows local weather patterns,
      building codes, and the material requirements for this region. If your roof takes a hit from a major storm,
      we're already nearby and can respond the same day.
    </p>

    <!-- Area cards grid -->
    <div class="area-cards-grid">
      <?php foreach ($displayAreas as $i => $area): ?>
      <div class="area-card<?php echo !empty($area['primary']) ? ' area-card-primary' : ''; ?>"
           data-animate="fade-up"
           style="animation-delay:<?php echo min($i * 80, 400); ?>ms">

        <?php if (!empty($area['primary'])): ?>
        <div class="area-primary-badge">
          <i data-lucide="star" aria-hidden="true" style="width:10px;height:10px"></i>
          Primary Area
        </div>
        <?php endif; ?>

        <div class="area-icon-wrap">
          <i data-lucide="map-pin" aria-hidden="true"></i>
        </div>

        <h3><?php echo htmlspecialchars($area['city'], ENT_QUOTES, 'UTF-8'); ?></h3>

        <?php if (!empty($area['state'])): ?>
        <div class="area-state-tag"><?php echo htmlspecialchars($area['state'], ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <p><?php echo htmlspecialchars($area['blurb'], ENT_QUOTES, 'UTF-8'); ?></p>

      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ── PROJECT GALLERY ───────────────────────────────────────────────────── -->
<section class="sa-gallery-section" aria-labelledby="sa-gallery-heading">
  <div class="container">
    <header class="sa-gallery-header" data-animate="fade-up">
      <span class="section-eyebrow eyebrow-solid">Our Work</span>
      <h2 class="section-heading" id="sa-gallery-heading">Roofing Projects Across <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?></h2>
    </header>
    <div class="sa-gallery-grid" role="list" aria-label="Project photo gallery">
      <div class="sa-gallery-grid-item" role="listitem" data-animate="fade-up">
        <picture>
          <img src="/assets/images/photo-028.jpg" alt="Roofing crew actively installing new shingles on residential roof with ridge vent and removal of old materials" width="800" height="350" loading="lazy">
        </picture>
      </div>
      <div class="sa-gallery-grid-item" role="listitem" data-animate="fade-up" style="animation-delay:60ms">
        <picture>
          <img src="/assets/images/photo-003.jpg" alt="Roofing crew performing mid-project roof repair with exposed shingles and gutter cleaning visible on residential home" width="400" height="300" loading="lazy">
        </picture>
      </div>
      <div class="sa-gallery-grid-item" role="listitem" data-animate="fade-up" style="animation-delay:120ms">
        <picture>
          <img src="/assets/images/photo-008.jpg" alt="Residential roof repair in progress with work truck and materials on asphalt shingle roof" width="400" height="300" loading="lazy">
        </picture>
      </div>
      <div class="sa-gallery-grid-item" role="listitem" data-animate="fade-up" style="animation-delay:60ms">
        <picture>
          <img src="/assets/images/photo-011.jpg" alt="Roofer installing asphalt shingles during active roof repair work with professional tools" width="400" height="300" loading="lazy">
        </picture>
      </div>
      <div class="sa-gallery-grid-item" role="listitem" data-animate="fade-up" style="animation-delay:120ms">
        <picture>
          <img src="/assets/images/photo-015.jpg" alt="Roofer using pneumatic nail gun to install asphalt shingles during active roof replacement project" width="400" height="300" loading="lazy">
        </picture>
      </div>
      <div class="sa-gallery-grid-item" role="listitem" data-animate="fade-up" style="animation-delay:180ms">
        <picture>
          <img src="/assets/images/photo-019.jpg" alt="Roofer installing dark asphalt shingles on residential roof during active roof replacement project" width="400" height="300" loading="lazy">
        </picture>
      </div>
    </div>
  </div>
</section>

<!-- ── MAP SECTION ────────────────────────────────────────────────────────── -->
<section class="sa-map-section" aria-labelledby="sa-map-heading">
  <div class="container">
    <h2 id="sa-map-heading" class="visually-hidden">Service area map</h2>
    <div class="sa-map-embed">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d193595.9147703055!2d-74.11976397304903!3d40.69766374859258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus"
        title="A-1 Roof Works LLC service area map — <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?> and surrounding region"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</section>

<!-- Divider: torn paper into alt bg ─────────────────────────────────────── -->
<div class="sa-svg-divider" aria-hidden="true" style="background:var(--color-bg)">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none">
    <path d="M0,60 L0,38 L80,44 L160,30 L250,46 L340,34 L440,48 L540,32 L640,46 L740,36 L840,50 L940,34 L1040,46 L1140,32 L1200,40 L1200,60 Z" fill="var(--color-bg-alt)"/>
  </svg>
</div>

<!-- ── WHY LOCAL MATTERS — Signature Editorial Section (C5.3 + C7) ─────────
     This is the signature section: editorial pullquote with large accent
     typography, tight column, accent border, oversized decorative quote mark.
─────────────────────────────────────────────────────────────────────────── -->
<section class="sa-local-section" aria-labelledby="sa-local-heading">
  <div class="container">

    <header class="section-header centered" data-animate="fade-up">
      <span class="section-eyebrow eyebrow-solid">Why Local Matters</span>
      <h2 class="section-heading" id="sa-local-heading">
        A Roofer Who Knows the Region<br>Installs a Better Roof
      </h2>
    </header>

    <div class="sa-local-editorial" data-animate="fade-up">

      <!-- Signature pullquote -->
      <div class="sa-pullquote">
        <blockquote>
          "A roofer who shows up in 20 minutes understands local weather better than one who drives 2 hours.
          Local expertise isn't marketing copy — it's the difference between a roof designed for this region
          and one that's just installed here."
        </blockquote>
        <cite class="sa-pullquote-attr">
          — <?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?>, Serving <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?>
        </cite>
      </div>

      <!-- Three local advantage points -->
      <div class="sa-local-advantages">

        <div class="local-advantage" data-animate="fade-up">
          <div class="local-advantage-icon">
            <i data-lucide="zap" aria-hidden="true"></i>
          </div>
          <h4>Same-Day Storm Response</h4>
          <p>We're already in the area when severe weather hits. When you call after a storm, we don't need to drive two hours to reach you — we're a local crew in a local market.</p>
        </div>

        <div class="local-advantage" data-animate="fade-up" style="animation-delay:100ms">
          <div class="local-advantage-icon">
            <i data-lucide="book-open" aria-hidden="true"></i>
          </div>
          <h4>Local Code Knowledge</h4>
          <p>We know the building requirements and permit processes for the municipalities we serve. No learning curve on your job, no delays from a crew unfamiliar with local inspectors.</p>
        </div>

        <div class="local-advantage" data-animate="fade-up" style="animation-delay:200ms">
          <div class="local-advantage-icon">
            <i data-lucide="cloud" aria-hidden="true"></i>
          </div>
          <h4>Regional Material Expertise</h4>
          <p>We spec materials that perform in local climate conditions — wind ratings, impact resistance, thermal cycling — not just what's popular in a catalog. What works in one region fails in another.</p>
        </div>

      </div><!-- /sa-local-advantages -->

    </div><!-- /sa-local-editorial -->

  </div>
</section>

<!-- ── MID-PAGE CTA BANNER (CTA #2) ──────────────────────────────────────── -->
<section class="sa-cta-banner" aria-labelledby="sa-cta-heading">
  <div class="container">
    <div class="sa-cta-inner" data-animate="fade-up">
      <span class="section-eyebrow eyebrow-pill" style="margin-bottom:var(--space-lg)">
        <i data-lucide="map-pin" aria-hidden="true"></i>
        Serving <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?> &amp; the Surrounding Region
      </span>
      <h2 id="sa-cta-heading">
        We're in Your Neighborhood.<br>
        Call for a Free Inspection.
      </h2>
      <p>
        Our crews are local, our response is fast, and our estimates are free.
        Find out exactly what your roof needs — no pressure, no obligation.
      </p>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="phone-big" aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
        <i data-lucide="phone" aria-hidden="true" style="display:inline-block;width:1em;height:1em;vertical-align:middle;margin-right:0.3em"></i>
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php endif; ?>
      <a href="/contact" class="btn-sa-cta">
        <i data-lucide="clipboard-list" aria-hidden="true"></i>
        Request a Free Estimate
      </a>
    </div>
  </div>
</section>

<!-- Divider: wave into bg ───────────────────────────────────────────────── -->
<div class="sa-svg-divider" aria-hidden="true" style="background:var(--color-primary);margin-top:-1px">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none">
    <path d="M0,30 C200,60 400,0 600,30 C800,60 1000,0 1200,30 L1200,60 L0,60 Z" fill="var(--color-bg)"/>
  </svg>
</div>

<!-- ── SERVICE AREA FAQs ─────────────────────────────────────────────────── -->
<section class="sa-faq-section" aria-labelledby="sa-faq-heading">
  <div class="container">

    <header class="section-header centered" data-animate="fade-up">
      <span class="section-eyebrow eyebrow-solid">
        <i data-lucide="help-circle" aria-hidden="true" style="width:14px;height:14px"></i>
        FAQ
      </span>
      <h2 class="section-heading" id="sa-faq-heading">
        Questions About Our Coverage Area
      </h2>
    </header>

    <div class="sa-faq-list" role="list">
      <?php foreach ($areaFaqs as $faq): ?>
      <div class="sa-faq-item" role="listitem" data-animate="fade-up">
        <h3><?php echo htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8'); ?></h3>
        <p><?php echo htmlspecialchars($faq['answer'], ENT_QUOTES, 'UTF-8'); ?></p>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- Divider: diagonal into alt bg ──────────────────────────────────────── -->
<div class="sa-svg-divider" aria-hidden="true" style="background:var(--color-bg)">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none">
    <polygon fill="var(--color-bg-alt)" points="0,60 1200,0 1200,60 0,60"/>
  </svg>
</div>

<!-- ── CLOSING CTA (CTA #3) ───────────────────────────────────────────────── -->
<section class="sa-closing-cta" aria-labelledby="sa-close-heading">
  <div class="container" data-animate="fade-up">

    <span class="section-eyebrow eyebrow-solid" style="display:inline-flex;justify-content:center;margin-bottom:var(--space-lg)">
      <i data-lucide="shield-check" aria-hidden="true" style="width:14px;height:14px"></i>
      Licensed · Insured · Locally Based
    </span>

    <h2 id="sa-close-heading">
      In <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?>?<br>
      We Can Be There Today.
    </h2>

    <p>
      Free inspection, written estimate, no pressure. We serve <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?> and the surrounding
      region with a local crew that responds fast and does the work right the first time.
    </p>

    <div class="sa-closing-actions">
      <a href="/contact" class="btn-sa-close-primary">
        <i data-lucide="clipboard-list" aria-hidden="true"></i>
        Get My Free Estimate
      </a>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="btn-sa-close-phone">
        <i data-lucide="phone" aria-hidden="true"></i>
        Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php else: ?>
      <a href="/services" class="btn-sa-close-phone">
        <i data-lucide="layers" aria-hidden="true"></i>
        View All Services
      </a>
      <?php endif; ?>
    </div>

  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
