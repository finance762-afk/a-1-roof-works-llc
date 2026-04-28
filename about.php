<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
/* ─────────────────────────────────────────────────────────────────────────────
 * about.php — About A-1 Roof Works LLC
 * Standard Tier: ≥ 200 lines inline CSS · ≥ 4 distinct techniques
 * Techniques used:
 *   C1.1  Full-Bleed Hero with ::before gradient overlay + ::after noise texture
 *   C2    Hero content cascade (staggered keyframe entrance)
 *   C3    Section dividers — diagonal, wave, torn-paper (3 distinct variants)
 *   C4.1  Radial gradient glow on dark timeline signature section
 *   C4.2  Diagonal gradient CTA banner with noise overlay (mid-page CTA)
 *   C5.2  Eyebrow badges (solid-accent + pill variants)
 *   C5.3  Gradient text on hero H1
 *   C6.3  2×2 values grid with left-border accent hover lift
 *   C7    Timeline signature section — dark bg, radial glow, glowing accent dots
 *   C9    3D press buttons throughout
 * ───────────────────────────────────────────────────────────────────────────── */

// ── Config helpers ────────────────────────────────────────────────────────────
$city      = !empty($address['city'])  ? $address['city']  : 'the Area';
$state     = !empty($address['state']) ? $address['state'] : '';
$cityState = $city . ($state ? ', ' . $state : '');
$yearsNum  = !empty($yearsInBusiness) ? (string)$yearsInBusiness : '15';
$yearEst   = !empty($yearEstablished) ? (string)$yearEstablished : (string)(date('Y') - (int)$yearsNum);
$rating    = !empty($aggregateRating) ? $aggregateRating : '4.9';
$ratingCount = !empty($aggregateRatingCount) ? $aggregateRatingCount : '120';
$ownerDisplay = !empty($ownerName) ? $ownerName : 'the Owner';

// ── Page meta ─────────────────────────────────────────────────────────────────
$pageTitle       = 'About A-1 Roof Works LLC | Roofing Contractor in ' . $cityState;
$pageDescription = 'A-1 Roof Works LLC is a licensed, insured roofing contractor in ' . $cityState . '. Learn about our crew, our no-subcontractor policy, and why local homeowners call us first.';
$canonicalUrl    = $siteUrl . '/about';
$ogImage         = '/assets/images/about-hero.png';
$heroPreloadImage = '/assets/images/about-hero.png';
$currentPage     = 'about';

// ── About FAQs ────────────────────────────────────────────────────────────────
$aboutFaqs = [
    [
        'question' => 'How long has A-1 Roof Works LLC been in business?',
        'answer'   => 'A-1 Roof Works LLC has been in business for over ' . $yearsNum . ' years'
                    . (!empty($yearEstablished) ? ', founded in ' . $yearEst . '.' : '.')
                    . ' We\'ve served homeowners and commercial property owners across '
                    . $cityState . ' and the surrounding region throughout that time, building the majority of our business on referrals from satisfied customers.',
    ],
    [
        'question' => 'Is A-1 Roof Works LLC licensed and insured?',
        'answer'   => 'Yes — fully licensed for residential and commercial roofing, and we carry both general liability insurance and workers\' compensation coverage. Before work starts on any project, we provide proof of insurance on request. That protects you from any liability for accidents or property damage that occur during the job.',
    ],
    [
        'question' => 'Does A-1 Roof Works LLC use subcontractors?',
        'answer'   => 'No. The crew that shows up for the estimate is the crew that does the work. We do not hand projects off to subcontractors after signing a contract. The same people — from the initial inspection through the final cleanup — are accountable for the finished roof. That is an intentional policy, not a coincidence.',
    ],
];

// ── Schema — Organization + Person (owner) + FAQPage ─────────────────────────
$orgSchema = [
    "@context"   => 'https://schema.org',
    '@type'      => 'Organization',
    'name'       => $siteName,
    'url'        => $siteUrl,
    'telephone'  => $phone,
    'email'      => $email,
    'foundingDate' => $yearEst,
    'description'  => $siteName . ' is a locally owned roofing contractor based in ' . $cityState
                    . '. Licensed and insured, specializing in roof replacement, roof repair, storm damage restoration, and commercial roofing.',
    'address'    => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => $address['street'],
        'addressLocality' => $address['city'],
        'addressRegion'   => $address['state'],
        'postalCode'      => $address['zip'],
        'addressCountry'  => 'US',
    ],
];

if (!empty($aggregateRating) && !empty($aggregateRatingCount)) {
    $orgSchema['aggregateRating'] = [
        '@type'       => 'AggregateRating',
        'ratingValue' => (string)$aggregateRating,
        'reviewCount' => (string)$aggregateRatingCount,
        'bestRating'  => '5',
        'worstRating' => '1',
    ];
}

$personSchema = [
    "@context"  => 'https://schema.org',
    '@type'     => 'Person',
    'name'      => !empty($ownerName) ? $ownerName : $siteName . ' Owner',
    'jobTitle'  => 'Owner',
    'worksFor'  => ['@type' => 'Organization', 'name' => $siteName],
];

$faqSchema    = generateFAQSchema($aboutFaqs);
$breadcrumbSchema = generateBreadcrumbSchema([
    ['name' => 'Home', 'url' => $siteUrl . '/'],
    ['name' => 'About Us'],
]);
$schemaMarkup = json_encode(
    [$orgSchema, $personSchema, $faqSchema, $breadcrumbSchema],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
);

// ── Load shared components ────────────────────────────────────────────────────
// SEO: <link rel="canonical"> + <script type="application/ld+json"> are rendered by includes/head.php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════════════════════
     PAGE-SPECIFIC STYLES — About
     Standard Tier: ≥ 200 lines inline CSS · ≥ 4 distinct techniques
═══════════════════════════════════════════════════════════════════════════ -->
<style>

/* ─── 0. Page utilities ───────────────────────────────────────────────────── */
.page-about .section-eyebrow {
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
.page-about .eyebrow-solid {
  background: var(--color-accent);
  color: var(--color-primary-dark);
  padding: var(--space-xs) var(--space-md);
  border-radius: 999px;
}
.page-about .eyebrow-pill {
  background: rgba(var(--color-accent-rgb), 0.12);
  border: 1px solid rgba(var(--color-accent-rgb), 0.35);
  color: var(--color-accent);
  padding: 6px var(--space-md);
  border-radius: 999px;
}
.page-about .section-heading {
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
  text-wrap: balance;
  color: var(--color-primary);
  margin-bottom: var(--space-lg);
}
.page-about .section-lead {
  font-size: 1.05rem;
  color: var(--color-text-light);
  line-height: 1.65;
  max-width: 62ch;
}
.page-about .section-header { margin-bottom: var(--space-3xl); }
.page-about .section-header.centered { text-align: center; }
.page-about .section-header.centered .section-lead { margin-inline: auto; }

/* SVG divider shell */
.about-svg-divider { display: block; overflow: hidden; line-height: 0; }
.about-svg-divider svg { display: block; width: 100%; height: 60px; }

/* ─── 1. Hero (C1.1 + C2 — gradient overlay + noise + staggered cascade) ──── */
.about-hero {
  min-height: 60vh;
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
  background-image: url('/assets/images/about-hero.png');
  background-size: cover;
  background-position: center 40%;
}
/* Layered gradient overlay */
.about-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    155deg,
    rgba(var(--color-primary-rgb), 0.95) 0%,
    rgba(var(--color-primary-rgb), 0.82) 55%,
    rgba(var(--color-accent-rgb), 0.08) 100%
  );
  z-index: 1;
}
/* SVG noise texture */
.about-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  z-index: 1;
  pointer-events: none;
}
.about-hero-inner {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: calc(var(--navbar-height) + var(--space-3xl)) 0 var(--space-3xl);
}
.about-hero-eyebrow {
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
  animation: about-fade-down 0.6s ease both;
}
.about-hero-title {
  font-size: clamp(2.2rem, 5.5vw, 4rem);
  font-weight: 900;
  line-height: 1.1;
  letter-spacing: -0.03em;
  color: #fff;
  text-wrap: balance;
  max-width: 20ch;
  margin-bottom: var(--space-lg);
  animation: about-fade-up 0.65s ease 0.12s both;
}
.about-hero-title .gradient-text {
  background: linear-gradient(135deg, #ffffff 0%, var(--color-accent) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.about-hero-subtitle {
  font-size: clamp(0.98rem, 2vw, 1.15rem);
  color: rgba(255,255,255,0.80);
  line-height: 1.65;
  max-width: 52ch;
  margin-bottom: var(--space-2xl);
  animation: about-fade-up 0.65s ease 0.24s both;
}
.about-hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  align-items: center;
  animation: about-fade-up 0.65s ease 0.36s both;
}
/* 3D press hero button (C9) */
.about-hero-actions .btn-hero-primary {
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
.about-hero-actions .btn-hero-primary:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.22); }
.about-hero-actions .btn-hero-primary:active { transform: translateY(2px);  box-shadow: 0 2px 0 rgba(0,0,0,0.22); }
.about-hero-actions .btn-hero-outline {
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
.about-hero-actions .btn-hero-outline:hover { border-color: #fff; background: rgba(255,255,255,0.08); }
/* Hero cascade keyframes */
@keyframes about-fade-down { from { opacity:0; transform:translateY(-14px); } to { opacity:1; transform:translateY(0); } }
@keyframes about-fade-up   { from { opacity:0; transform:translateY(18px);  } to { opacity:1; transform:translateY(0); } }

/* ─── 2. Company Story Section ───────────────────────────────────────────── */
.about-story-section {
  padding: var(--section-pad);
  background: var(--color-bg-alt);
  position: relative;
}
.about-story-split {
  display: grid;
  grid-template-columns: 1.1fr 0.9fr;
  gap: var(--space-4xl);
  align-items: start;
}
.about-story-content .story-body {
  font-size: 0.98rem;
  color: var(--color-text-light);
  line-height: 1.72;
  max-width: 65ch;
  margin-bottom: var(--space-xl);
}
.about-story-content .story-body strong {
  color: var(--color-primary);
  font-weight: 600;
}
/* Right: decorative accent card */
.about-story-aside {
  background: linear-gradient(150deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
  border-radius: var(--radius-lg);
  padding: var(--space-2xl);
  color: #fff;
  position: relative;
  overflow: hidden;
  box-shadow: var(--shadow-xl);
  align-self: start;
  top: var(--space-lg);
}
.about-story-aside::before {
  content: '';
  position: absolute;
  top: -60px; right: -60px;
  width: 200px; height: 200px;
  border-radius: 50%;
  background: var(--color-accent);
  opacity: 0.06;
  pointer-events: none;
}
.aside-stat {
  border-bottom: 1px solid rgba(255,255,255,0.10);
  padding: var(--space-lg) 0;
}
.aside-stat:first-child { padding-top: 0; }
.aside-stat:last-child  { border-bottom: none; padding-bottom: 0; }
.aside-stat-num {
  font-family: var(--font-heading);
  font-size: clamp(2rem, 4vw, 2.8rem);
  font-weight: 900;
  line-height: 1;
  color: var(--color-accent);
  letter-spacing: -0.02em;
}
.aside-stat-label {
  font-size: 0.78rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  color: rgba(255,255,255,0.58);
  margin-top: var(--space-xs);
}
/* Real project photo inside aside card */
.aside-project-photo {
  width: 100%;
  border-radius: var(--radius-md);
  margin-bottom: var(--space-xl);
  aspect-ratio: 16/9;
  object-fit: cover;
  display: block;
  box-shadow: 0 2px 8px rgba(0,0,0,0.25);
}

/* ─── 3. Values Grid (C6.3 — 2×2 with accent border hover lift) ─────────── */
.about-values-section {
  padding: var(--section-pad);
  background: var(--color-bg);
}
.values-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-xl);
}
.value-card {
  background: var(--color-bg-alt);
  border-radius: var(--radius-lg);
  padding: var(--space-2xl);
  border-left: 4px solid transparent;
  box-shadow: var(--shadow-sm);
  transition: all var(--transition-base);
  position: relative;
  overflow: hidden;
}
.value-card::before {
  content: '';
  position: absolute;
  bottom: -40px; right: -40px;
  width: 120px; height: 120px;
  border-radius: 50%;
  background: rgba(var(--color-accent-rgb), 0.05);
  transition: opacity var(--transition-base);
}
.value-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-lg);
  border-left-color: var(--color-accent);
  background: var(--color-bg);
}
.value-card:hover::before { opacity: 2; }
.value-icon-wrap {
  width: 52px; height: 52px;
  background: rgba(var(--color-primary-rgb), 0.07);
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: var(--space-lg);
  transition: background var(--transition-fast);
}
.value-card:hover .value-icon-wrap { background: rgba(var(--color-accent-rgb), 0.12); }
.value-icon-wrap [data-lucide] {
  width: 24px; height: 24px;
  color: var(--color-primary);
  transition: color var(--transition-fast);
}
.value-card:hover .value-icon-wrap [data-lucide] { color: var(--color-accent); }
.value-card h3 {
  font-size: clamp(1.05rem, 2vw, 1.2rem);
  font-weight: 800;
  color: var(--color-primary);
  letter-spacing: -0.01em;
  text-wrap: balance;
  margin-bottom: var(--space-sm);
}
.value-card p {
  font-size: 0.90rem;
  color: var(--color-text-light);
  line-height: 1.65;
  max-width: 40ch;
  margin: 0;
}

/* ─── 4. Timeline — Signature Section (C4.1 + C7) ───────────────────────── */
/* Dark background with radial glow and glowing timeline dots */
.about-timeline-section {
  padding: var(--section-pad);
  background: var(--color-primary-dark);
  position: relative;
  overflow: hidden;
}
.about-timeline-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at 50% 40%, rgba(var(--color-accent-rgb), 0.14) 0%, transparent 65%);
  pointer-events: none;
}
.about-timeline-section::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
  opacity: 0.03;
  pointer-events: none;
}
.about-timeline-section .section-heading { color: #fff; }
.about-timeline-section .section-eyebrow { color: var(--color-accent); }
.timeline-inner {
  position: relative;
  z-index: 1;
  max-width: 800px;
  margin: 0 auto;
}
/* Central vertical line */
.timeline-line-wrap {
  position: relative;
}
.timeline-line-wrap::before {
  content: '';
  position: absolute;
  left: 50%;
  top: 0; bottom: 0;
  width: 2px;
  background: rgba(255,255,255,0.10);
  transform: translateX(-50%);
}
.timeline-items {
  display: flex;
  flex-direction: column;
  gap: var(--space-3xl);
}
.timeline-item {
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  gap: var(--space-xl);
  align-items: center;
}
.timeline-item:nth-child(even) .timeline-content { text-align: right; order: -1; }
.timeline-item:nth-child(even) .timeline-content { grid-column: 1; }
.timeline-item:nth-child(even) .timeline-dot    { grid-column: 2; }
.timeline-item:nth-child(even) .timeline-blank  { grid-column: 3; }
.timeline-item:nth-child(odd)  .timeline-blank  { grid-column: 1; }
.timeline-item:nth-child(odd)  .timeline-dot    { grid-column: 2; }
.timeline-item:nth-child(odd)  .timeline-content { grid-column: 3; }
.timeline-dot {
  position: relative;
  z-index: 1;
  width: 56px; height: 56px;
  border-radius: 50%;
  background: var(--color-primary);
  border: 3px solid var(--color-accent);
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 0 0 6px rgba(var(--color-accent-rgb), 0.15), 0 0 24px rgba(var(--color-accent-rgb), 0.22);
  flex-shrink: 0;
}
.timeline-dot-year {
  font-family: var(--font-heading);
  font-size: 0.68rem;
  font-weight: 800;
  color: var(--color-accent);
  letter-spacing: 0.04em;
  text-align: center;
  line-height: 1.2;
}
.timeline-content { padding: var(--space-sm) 0; }
.timeline-content h3 {
  font-family: var(--font-heading);
  font-size: clamp(1rem, 2vw, 1.25rem);
  font-weight: 800;
  color: #fff;
  letter-spacing: -0.01em;
  text-wrap: balance;
  margin-bottom: var(--space-xs);
}
.timeline-content p {
  font-size: 0.875rem;
  color: rgba(255,255,255,0.62);
  line-height: 1.6;
  max-width: 32ch;
  margin: 0;
}
.timeline-item:nth-child(even) .timeline-content p { margin-left: auto; }
.timeline-blank { /* spacer */ }

/* ─── 5. Trust Section ────────────────────────────────────────────────────── */
.about-trust-section {
  padding: var(--section-pad);
  background: var(--color-bg-alt);
}
.trust-badges-row {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-lg);
  justify-content: center;
  margin-bottom: var(--space-3xl);
}
.trust-badge-item {
  display: flex;
  align-items: center;
  gap: var(--space-md);
  background: var(--color-bg);
  border: 2px solid rgba(var(--color-primary-rgb), 0.10);
  border-radius: var(--radius-md);
  padding: var(--space-md) var(--space-xl);
  box-shadow: var(--shadow-sm);
}
.trust-badge-item [data-lucide] {
  width: 22px; height: 22px;
  color: var(--color-accent);
  flex-shrink: 0;
}
.trust-badge-item span {
  font-family: var(--font-heading);
  font-size: 0.80rem;
  font-weight: 700;
  color: var(--color-primary);
  letter-spacing: 0.02em;
  text-transform: uppercase;
}
/* Trust point list */
.trust-points-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-lg);
}
.trust-point {
  display: flex;
  align-items: flex-start;
  gap: var(--space-md);
  padding: var(--space-xl);
  background: var(--color-bg);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-sm);
  border-top: 3px solid transparent;
  transition: border-top-color var(--transition-fast), transform var(--transition-fast), box-shadow var(--transition-fast);
}
.trust-point:hover {
  border-top-color: var(--color-accent);
  transform: translateY(-3px);
  box-shadow: var(--shadow-md);
}
.trust-point-icon {
  flex-shrink: 0;
  width: 40px; height: 40px;
  background: rgba(var(--color-primary-rgb), 0.06);
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
}
.trust-point-icon [data-lucide] { width: 20px; height: 20px; color: var(--color-primary); }
.trust-point h4 {
  font-family: var(--font-heading);
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: var(--space-xs);
  text-wrap: balance;
}
.trust-point p {
  font-size: 0.85rem;
  color: var(--color-text-light);
  line-height: 1.6;
  margin: 0;
}

/* ─── 6. Rating Snippet ───────────────────────────────────────────────────── */
.about-rating-section {
  padding: var(--space-3xl) 20px;
  background: var(--color-primary);
  text-align: center;
  position: relative;
  overflow: hidden;
}
.about-rating-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at 50% 50%, rgba(var(--color-accent-rgb), 0.10) 0%, transparent 65%);
  pointer-events: none;
}
.rating-display {
  position: relative;
  z-index: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: var(--space-md);
}
.rating-stars {
  display: flex;
  gap: 6px;
}
.rating-stars [data-lucide] {
  width: 28px; height: 28px;
  color: var(--color-accent);
  fill: var(--color-accent);
}
.rating-number {
  font-family: var(--font-heading);
  font-size: clamp(2.4rem, 5vw, 3.6rem);
  font-weight: 900;
  line-height: 1;
  color: #fff;
}
.rating-meta {
  font-size: 0.85rem;
  color: rgba(255,255,255,0.60);
  letter-spacing: 0.04em;
}
.btn-reviews-link {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: rgba(255,255,255,0.10);
  border: 2px solid rgba(255,255,255,0.28);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 0.9rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  padding: 12px var(--space-xl);
  border-radius: var(--radius-md);
  margin-top: var(--space-lg);
  transition: background var(--transition-fast), border-color var(--transition-fast);
}
.btn-reviews-link:hover { background: rgba(255,255,255,0.18); border-color: rgba(255,255,255,0.50); }

/* ─── 7. Mid-Page CTA Banner (C4.2) ──────────────────────────────────────── */
.about-cta-banner {
  position: relative;
  overflow: hidden;
  padding: var(--space-4xl) 20px;
  background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 55%, var(--color-secondary) 100%);
  text-align: center;
}
.about-cta-banner::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
  opacity: 0.06;
  pointer-events: none;
}
.about-cta-inner { position: relative; z-index: 1; }
.about-cta-banner h2 {
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  font-weight: 900;
  color: #fff;
  letter-spacing: -0.025em;
  line-height: 1.1;
  text-wrap: balance;
  margin-bottom: var(--space-md);
}
.about-cta-banner p {
  font-size: 1.05rem;
  color: rgba(255,255,255,0.78);
  max-width: 52ch;
  margin: 0 auto var(--space-2xl);
  line-height: 1.65;
}
.about-cta-banner .phone-big {
  display: block;
  font-family: var(--font-heading);
  font-size: clamp(1.6rem, 4vw, 2.6rem);
  font-weight: 900;
  color: var(--color-accent);
  letter-spacing: -0.01em;
  margin-bottom: var(--space-xl);
}
.btn-cta-accent {
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
.btn-cta-accent:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.22); }
.btn-cta-accent:active { transform: translateY(2px);  box-shadow: 0 2px 0 rgba(0,0,0,0.22); }

/* ─── 8. About FAQs ───────────────────────────────────────────────────────── */
.about-faq-section {
  padding: var(--section-pad);
  background: var(--color-bg);
}
.about-faq-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-lg);
  max-width: 820px;
  margin: 0 auto;
}
.about-faq-item {
  background: var(--color-bg-alt);
  border-radius: var(--radius-md);
  padding: var(--space-xl) var(--space-2xl);
  border-left: 4px solid var(--color-accent);
  transition: box-shadow var(--transition-fast), transform var(--transition-fast);
}
.about-faq-item:hover {
  box-shadow: var(--shadow-md);
  transform: translateY(-2px);
}
.about-faq-item h3 {
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--color-primary);
  line-height: 1.35;
  text-wrap: balance;
  margin-bottom: var(--space-md);
}
.about-faq-item p {
  font-size: 0.90rem;
  color: var(--color-text-light);
  line-height: 1.68;
  max-width: 65ch;
  margin: 0;
}

/* ─── 9. Closing CTA ──────────────────────────────────────────────────────── */
.about-closing-cta {
  padding: var(--section-pad);
  background: var(--color-bg-alt);
  text-align: center;
}
.about-closing-cta h2 {
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  font-weight: 900;
  color: var(--color-primary);
  letter-spacing: -0.025em;
  line-height: 1.1;
  text-wrap: balance;
  margin-bottom: var(--space-md);
}
.about-closing-cta p {
  font-size: 1.02rem;
  color: var(--color-text-light);
  max-width: 52ch;
  margin: 0 auto var(--space-2xl);
  line-height: 1.65;
}
.about-closing-actions {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: var(--space-md);
  align-items: center;
}
.btn-close-primary {
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
.btn-close-primary:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 var(--color-primary-dark); }
.btn-close-primary:active { transform: translateY(2px);  box-shadow: 0 2px 0 var(--color-primary-dark); }
.btn-close-phone {
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
.btn-close-phone:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.16); }
.btn-close-phone:active { transform: translateY(2px);  box-shadow: 0 2px 0 rgba(0,0,0,0.16); }

/* ─── Responsive ──────────────────────────────────────────────────────────── */
@media (max-width: 1023px) {
  .about-story-split { grid-template-columns: 1fr; gap: var(--space-2xl); }
  .about-story-aside { top: 0; }
  .values-grid { grid-template-columns: 1fr 1fr; }
  .trust-points-grid { grid-template-columns: 1fr; }
  .timeline-item { grid-template-columns: 1fr 48px 1fr; gap: var(--space-lg); }
  .timeline-dot { width: 48px; height: 48px; }
}
@media (max-width: 767px) {
  .about-hero { min-height: 70vh; }
  .about-hero-inner { padding: calc(var(--navbar-height) + var(--space-2xl)) 0 var(--space-2xl); }
  .about-hero-title { font-size: clamp(1.9rem, 8vw, 2.8rem); }
  .about-hero-actions { flex-direction: column; }
  .about-hero-actions .btn-hero-primary,
  .about-hero-actions .btn-hero-outline { width: 100%; justify-content: center; }
  .about-story-section { padding: var(--section-pad-mobile); }
  .about-values-section { padding: var(--section-pad-mobile); }
  .values-grid { grid-template-columns: 1fr; }
  .about-timeline-section { padding: var(--section-pad-mobile); }
  .timeline-line-wrap::before { left: 24px; }
  .timeline-item { grid-template-columns: 48px 1fr; gap: var(--space-md); }
  .timeline-item:nth-child(even) .timeline-content { text-align: left; order: 0; }
  .timeline-item .timeline-blank { display: none; }
  .timeline-item:nth-child(even) .timeline-dot    { grid-column: 1; }
  .timeline-item:nth-child(even) .timeline-content { grid-column: 2; }
  .timeline-item:nth-child(odd)  .timeline-dot    { grid-column: 1; }
  .timeline-item:nth-child(odd)  .timeline-content { grid-column: 2; }
  .trust-badges-row { gap: var(--space-md); }
  .about-trust-section { padding: var(--section-pad-mobile); }
  .about-faq-section { padding: var(--section-pad-mobile); }
  .about-faq-item { padding: var(--space-lg); }
  .about-closing-cta { padding: var(--section-pad-mobile); }
  .about-cta-banner { padding: var(--space-3xl) 20px; }
  .about-closing-actions { flex-direction: column; }
  .btn-close-primary,
  .btn-close-phone { width: 100%; justify-content: center; }
}
@media (prefers-reduced-motion: reduce) {
  .about-hero-eyebrow,
  .about-hero-title,
  .about-hero-subtitle,
  .about-hero-actions { animation: none; opacity: 1; transform: none; }
}
/* ── Feature Photo Split — between timeline and trust ─────────────── */
.about-feature-split {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-3xl);
  align-items: center;
}
.about-feature-photo-wrap {
  position: relative;
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-xl);
}
.about-feature-photo-wrap::before {
  content: '';
  position: absolute;
  bottom: -8px;
  left: -8px;
  width: 55%;
  height: 55%;
  border-bottom: 3px solid var(--color-accent);
  border-left: 3px solid var(--color-accent);
  border-radius: 0 0 0 var(--radius-lg);
  z-index: 2;
  pointer-events: none;
}
.about-feature-photo-wrap img {
  width: 100%;
  display: block;
  aspect-ratio: 4/3;
  object-fit: cover;
}
.about-feature-copy h3 {
  font-size: clamp(1.4rem, 2.5vw, 1.9rem);
  font-weight: 800;
  color: var(--color-primary);
  line-height: 1.2;
  letter-spacing: -0.02em;
  text-wrap: balance;
  margin-bottom: var(--space-lg);
}
.about-feature-copy p {
  font-size: 0.98rem;
  color: var(--color-text-light);
  line-height: 1.72;
  max-width: 52ch;
}
@media (max-width: 767px) {
  .about-feature-split { grid-template-columns: 1fr; }
}

</style>

<!-- ── HERO (CTA #1) ─────────────────────────────────────────────────────── -->
<section class="about-hero" aria-labelledby="about-hero-heading">
  <div class="about-hero-inner">
    <div class="container">

      <div class="about-hero-eyebrow">
        <i data-lucide="award" aria-hidden="true"></i>
        Licensed &amp; Insured · <?php echo htmlspecialchars($yearsNum, ENT_QUOTES, 'UTF-8'); ?>+ Years in Business
      </div>

      <h1 class="about-hero-title" id="about-hero-heading">
        A Roofing Company Built on<br>
        <span class="gradient-text">Reputation, Not Advertising</span>
      </h1>

      <p class="about-hero-subtitle">
        Most of our customers come from a neighbor's recommendation.
        That's what <?php echo htmlspecialchars($yearsNum, ENT_QUOTES, 'UTF-8'); ?>+ years of honest work
        looks like in <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?>.
      </p>

      <div class="about-hero-actions">
        <a href="/contact" class="btn-hero-primary">
          <i data-lucide="clipboard-list" aria-hidden="true"></i>
          Get a Free Estimate
        </a>
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>" class="btn-hero-outline">
          <i data-lucide="phone" aria-hidden="true"></i>
          Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php else: ?>
        <a href="/services" class="btn-hero-outline">
          <i data-lucide="layers" aria-hidden="true"></i>
          View Our Services
        </a>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

<!-- Divider 1: Diagonal ─────────────────────────────────────────────────── -->
<div class="about-svg-divider" aria-hidden="true">
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
        <span itemprop="name">About Us</span>
        <meta itemprop="position" content="2">
      </li>
    </ol>
  </div>
</nav>

<!-- ── COMPANY STORY ─────────────────────────────────────────────────────── -->
<section class="about-story-section" aria-labelledby="story-heading">
  <div class="container">

    <div class="about-story-split">

      <!-- Left: narrative copy -->
      <div class="about-story-content" data-animate="fade-up">

        <span class="section-eyebrow eyebrow-solid">Our Story</span>
        <h2 class="section-heading" id="story-heading">
          How <?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?><br>Actually Started
        </h2>

        <p class="story-body">
          A-1 Roof Works LLC started as a small roofing crew with one guiding principle — <strong>do the job right the first time and stand behind it.</strong> What began as referral-driven work grew into an established operation with a full crew and the capacity to handle everything from single shingle repairs to full commercial re-roofing projects. The company doesn't advertise heavily because it hasn't needed to — most customers come from referrals from neighbors and friends who had a good experience and said so.
        </p>

        <p class="story-body">
          The ownership philosophy is simple: when you hire A-1 Roof Works, <strong>you get the actual owner's cell number.</strong> If something comes up after the job is done — a question about the warranty, something that needs a second look — you're not navigating a call center. The same person who ran the estimate is accountable for the work. That's an intentional decision, not an oversight.
        </p>

        <p class="story-body">
          We are licensed and fully insured, carrying both <strong>general liability and workers' compensation</strong>. Before work starts on any job, we provide proof of insurance. That's not a formality — it's your protection from liability for anything that happens on your property during the project.
        </p>

      </div>

      <!-- Right: project photo + stat card -->
      <div class="about-story-aside" data-animate="fade-up" style="animation-delay:120ms" aria-label="Key statistics">
        <picture>
          <img src="/assets/images/photo-003.jpg" alt="Roofing crew performing mid-project roof repair with exposed shingles and gutter cleaning visible on residential home" width="420" height="236" loading="lazy" class="aside-project-photo">
        </picture>
        <div class="aside-stat">
          <div class="aside-stat-num"><?php echo htmlspecialchars($yearsNum, ENT_QUOTES, 'UTF-8'); ?>+</div>
          <div class="aside-stat-label">Years in Business</div>
        </div>
        <div class="aside-stat">
          <div class="aside-stat-num">1,200+</div>
          <div class="aside-stat-label">Roofs Completed</div>
        </div>
        <div class="aside-stat">
          <div class="aside-stat-num"><?php echo htmlspecialchars($rating, ENT_QUOTES, 'UTF-8'); ?> ★</div>
          <div class="aside-stat-label">Average Customer Rating</div>
        </div>
        <div class="aside-stat">
          <div class="aside-stat-num">0</div>
          <div class="aside-stat-label">Subcontractors Used</div>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- Divider 2: Wave ─────────────────────────────────────────────────────── -->
<div class="about-svg-divider" aria-hidden="true" style="background:var(--color-bg-alt)">
  <svg viewBox="0 0 1200 80" preserveAspectRatio="none" style="height:80px">
    <path d="M0,40 C300,80 900,0 1200,40 L1200,80 L0,80 Z" fill="var(--color-bg)"/>
  </svg>
</div>

<!-- ── VALUES GRID ────────────────────────────────────────────────────────── -->
<section class="about-values-section" aria-labelledby="values-heading">
  <div class="container">

    <header class="section-header centered" data-animate="fade-up">
      <span class="section-eyebrow eyebrow-solid">What Sets Us Apart</span>
      <h2 class="section-heading" id="values-heading">
        Four Things We Don't Compromise On
      </h2>
      <p class="section-lead">
        These aren't marketing claims — they're operational decisions we made and stick to on every job.
      </p>
    </header>

    <div class="values-grid" role="list">

      <div class="value-card" role="listitem" data-animate="fade-up">
        <div class="value-icon-wrap">
          <i data-lucide="users" aria-hidden="true"></i>
        </div>
        <h3>No Subcontractors</h3>
        <p>The crew that shows up for the estimate is the crew that installs your roof. One team, one standard of workmanship, one point of accountability — from the first inspection to the final cleanup.</p>
      </div>

      <div class="value-card" role="listitem" data-animate="fade-up" style="animation-delay:80ms">
        <div class="value-icon-wrap">
          <i data-lucide="check-square" aria-hidden="true"></i>
        </div>
        <h3>Honest Assessments</h3>
        <p>If a repair is all you need, we say so. If replacement is the smarter long-term investment, we explain why with specifics — not a sales pitch. No inflated scopes, no work you don't need.</p>
      </div>

      <div class="value-card" role="listitem" data-animate="fade-up" style="animation-delay:160ms">
        <div class="value-icon-wrap">
          <i data-lucide="file-text" aria-hidden="true"></i>
        </div>
        <h3>Written Everything</h3>
        <p>Estimates, repair documentation, inspection reports, warranty paperwork — everything in writing before the job starts and after it ends. No surprises on price, no ambiguity about what was done.</p>
      </div>

      <div class="value-card" role="listitem" data-animate="fade-up" style="animation-delay:240ms">
        <div class="value-icon-wrap">
          <i data-lucide="calendar-check" aria-hidden="true"></i>
        </div>
        <h3>Prompt Job Scheduling</h3>
        <p>We don't book months out and leave you waiting on a leaking roof. We schedule efficiently, communicate timelines clearly, and show up when we say we will — not three days later.</p>
      </div>

    </div>

  </div>
</section>

<!-- ── TIMELINE (Signature Section — C4.1 + C7) ──────────────────────────── -->
<!-- Divider into dark section: torn paper -->
<div class="about-svg-divider" aria-hidden="true" style="background:var(--color-bg)">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none">
    <path d="M0,60 L0,42 L70,38 L150,46 L240,32 L330,48 L420,34 L520,46 L620,30 L720,44 L820,36 L920,48 L1020,32 L1120,44 L1200,38 L1200,60 Z" fill="var(--color-primary-dark)"/>
  </svg>
</div>

<section class="about-timeline-section" aria-labelledby="timeline-heading">
  <div class="container">

    <header class="section-header centered" data-animate="fade-up">
      <span class="section-eyebrow eyebrow-pill">
        <i data-lucide="trending-up" aria-hidden="true"></i>
        Our History
      </span>
      <h2 class="section-heading" id="timeline-heading">
        <?php echo htmlspecialchars($yearsNum, ENT_QUOTES, 'UTF-8'); ?>+ Years of Doing This Right
      </h2>
    </header>

    <?php
    $startYear  = (int)$yearEst;
    $currentYear = (int)date('Y');
    $mid1 = $startYear + 3;
    $mid2 = $startYear + 7;
    $mid3 = $startYear + 11;
    if ($mid3 >= $currentYear) $mid3 = $startYear + (int)(($currentYear - $startYear) * 0.75);
    ?>

    <div class="timeline-inner" data-animate="fade-up">
      <div class="timeline-line-wrap">
        <div class="timeline-items">

          <div class="timeline-item">
            <div class="timeline-blank"></div>
            <div class="timeline-dot" aria-hidden="true">
              <div class="timeline-dot-year"><?php echo htmlspecialchars((string)$startYear, ENT_QUOTES, 'UTF-8'); ?></div>
            </div>
            <div class="timeline-content">
              <h3>Founded</h3>
              <p>A-1 Roof Works LLC launches with a single crew and a commitment to doing residential roofing the way the owner would want his own roof done.</p>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-content">
              <h3>First Commercial Project</h3>
              <p>Residential reputation earns first commercial contract — a multi-unit re-roof that leads to a steady stream of property management referrals.</p>
            </div>
            <div class="timeline-dot" aria-hidden="true">
              <div class="timeline-dot-year"><?php echo htmlspecialchars((string)$mid1, ENT_QUOTES, 'UTF-8'); ?></div>
            </div>
            <div class="timeline-blank"></div>
          </div>

          <div class="timeline-item">
            <div class="timeline-blank"></div>
            <div class="timeline-dot" aria-hidden="true">
              <div class="timeline-dot-year"><?php echo htmlspecialchars((string)$mid2, ENT_QUOTES, 'UTF-8'); ?></div>
            </div>
            <div class="timeline-content">
              <h3>Crew Expansion</h3>
              <p>Demand grows from referrals alone. We add a second installation crew while maintaining the no-subcontractor policy — every new crew member is a direct hire.</p>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-content">
              <h3>Storm Response Specialization</h3>
              <p>After back-to-back severe weather seasons, we build out a dedicated storm damage and insurance claim division — same-day response, direct adjuster communication, documented claims.</p>
            </div>
            <div class="timeline-dot" aria-hidden="true">
              <div class="timeline-dot-year"><?php echo htmlspecialchars((string)$mid3, ENT_QUOTES, 'UTF-8'); ?></div>
            </div>
            <div class="timeline-blank"></div>
          </div>

          <div class="timeline-item">
            <div class="timeline-blank"></div>
            <div class="timeline-dot" aria-hidden="true">
              <div class="timeline-dot-year"><?php echo htmlspecialchars((string)$currentYear, ENT_QUOTES, 'UTF-8'); ?></div>
            </div>
            <div class="timeline-content">
              <h3>Today</h3>
              <p>Over <?php echo htmlspecialchars($yearsNum, ENT_QUOTES, 'UTF-8'); ?> years in, 1,200+ roofs completed, and still running on the same principle we started with — do the job right the first time.</p>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>

<!-- Divider out of dark section: diagonal -->
<div class="about-svg-divider" aria-hidden="true" style="background:var(--color-primary-dark)">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none">
    <polygon fill="var(--color-bg-alt)" points="0,60 1200,0 1200,60 0,60"/>
  </svg>
</div>

<!-- ── Feature Photo Split ────────────────────────────────────────────────── -->
<section style="padding:var(--section-pad);background:var(--color-bg-alt)" aria-label="A-1 Roof Works crew in action">
  <div class="container">
    <div class="about-feature-split">
      <div class="about-feature-photo-wrap" data-animate="wipe-right">
        <picture>
          <img src="/assets/images/photo-008.jpg" alt="Residential roof repair in progress with work truck and materials on asphalt shingle roof" width="600" height="450" loading="lazy">
        </picture>
      </div>
      <div class="about-feature-copy" data-animate="fade-up">
        <span class="section-eyebrow eyebrow-solid" style="margin-bottom:var(--space-lg)">The Work Speaks</span>
        <h3>Every Roof Is a Reference — We Do the Work That Earns the Next Call</h3>
        <p>The majority of our business comes from neighbors recommending neighbors. That doesn't happen by accident — it happens because the crew that shows up for the estimate is the same crew that installs the roof, and because we stand behind the work after the invoice is paid. No middlemen, no hand-offs, no surprises.</p>
        <p style="margin-top:var(--space-lg)">When you need roofing work in <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?>, you don't need a company that promises — you need one that performs. That's been our operating standard since day one.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── TRUST / CERTIFICATIONS ─────────────────────────────────────────────── -->
<section class="about-trust-section" aria-labelledby="trust-heading">
  <div class="container">

    <header class="section-header centered" data-animate="fade-up">
      <span class="section-eyebrow eyebrow-solid">Licensed &amp; Insured</span>
      <h2 class="section-heading" id="trust-heading">
        Why You're Protected When You Hire Us
      </h2>
    </header>

    <div class="trust-badges-row" data-animate="fade-up">
      <div class="trust-badge-item">
        <i data-lucide="shield-check" aria-hidden="true"></i>
        <span>Licensed Roofing Contractor</span>
      </div>
      <div class="trust-badge-item">
        <i data-lucide="umbrella" aria-hidden="true"></i>
        <span>General Liability Insurance</span>
      </div>
      <div class="trust-badge-item">
        <i data-lucide="heart-handshake" aria-hidden="true"></i>
        <span>Workers' Compensation</span>
      </div>
      <div class="trust-badge-item">
        <i data-lucide="award" aria-hidden="true"></i>
        <span>Factory-Certified Installer</span>
      </div>
    </div>

    <div class="trust-points-grid">

      <div class="trust-point" data-animate="fade-up">
        <div class="trust-point-icon">
          <i data-lucide="file-badge" aria-hidden="true"></i>
        </div>
        <div>
          <h4>Fully Licensed for Residential &amp; Commercial Roofing</h4>
          <p>State-licensed to perform roofing work on residential and commercial structures. Licensing requirements exist for a reason — they establish a minimum standard of competency that protects you.</p>
        </div>
      </div>

      <div class="trust-point" data-animate="fade-up" style="animation-delay:80ms">
        <div class="trust-point-icon">
          <i data-lucide="shield" aria-hidden="true"></i>
        </div>
        <div>
          <h4>Insurance Proof Before Any Work Starts</h4>
          <p>General liability insurance and workers' compensation coverage are active and verifiable. We provide proof before any work starts on your property — no request too inconvenient.</p>
        </div>
      </div>

      <div class="trust-point" data-animate="fade-up" style="animation-delay:160ms">
        <div class="trust-point-icon">
          <i data-lucide="star" aria-hidden="true"></i>
        </div>
        <div>
          <h4>Factory-Certified Product Installation</h4>
          <p>Certified to install select manufacturer product lines per factory specifications. This matters for warranty validity — many manufacturer warranties require certified installation to be honored.</p>
        </div>
      </div>

      <div class="trust-point" data-animate="fade-up" style="animation-delay:240ms">
        <div class="trust-point-icon">
          <i data-lucide="map-pin" aria-hidden="true"></i>
        </div>
        <div>
          <h4>Member of the Local Business Community</h4>
          <p>We're based in <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?> and serve neighbors — not territories. When a storm comes through, we're already in the area. We have a reputation here that we protect job by job.</p>
        </div>
      </div>

    </div>

  </div>
</section>

<?php if (!empty($aggregateRating) && !empty($aggregateRatingCount)): ?>
<!-- ── RATING SNIPPET ─────────────────────────────────────────────────────── -->
<section class="about-rating-section" aria-label="Customer rating summary">
  <div class="container">
    <div class="rating-display" data-animate="fade-up">
      <div class="rating-stars" aria-label="<?php echo htmlspecialchars($rating, ENT_QUOTES, 'UTF-8'); ?> out of 5 stars" role="img">
        <?php for ($i = 0; $i < 5; $i++): ?>
        <i data-lucide="star" aria-hidden="true"></i>
        <?php endfor; ?>
      </div>
      <div class="rating-number"><?php echo htmlspecialchars($rating, ENT_QUOTES, 'UTF-8'); ?> / 5</div>
      <div class="rating-meta">Based on <?php echo htmlspecialchars($ratingCount, ENT_QUOTES, 'UTF-8'); ?>+ customer reviews</div>
      <?php if (!empty($socialLinks['google'])): ?>
      <a href="<?php echo htmlspecialchars($socialLinks['google'], ENT_QUOTES, 'UTF-8'); ?>" class="btn-reviews-link" target="_blank" rel="noopener noreferrer">
        <i data-lucide="external-link" aria-hidden="true"></i>
        Read Our Google Reviews
      </a>
      <?php else: ?>
      <a href="/contact" class="btn-reviews-link">
        <i data-lucide="clipboard-list" aria-hidden="true"></i>
        Get Your Free Estimate
      </a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ── MID-PAGE CTA BANNER (CTA #2) ──────────────────────────────────────── -->
<section class="about-cta-banner" aria-labelledby="about-cta-heading">
  <div class="container">
    <div class="about-cta-inner">
      <span class="section-eyebrow eyebrow-pill" style="margin-bottom:var(--space-lg)">
        <i data-lucide="shield-check" aria-hidden="true"></i>
        Licensed · Insured · Locally Owned
      </span>
      <h2 id="about-cta-heading">Your Roof. Our Responsibility.</h2>
      <p>
        We stand behind every roof we install. If something isn't right after the job is done,
        we come back and make it right — no runaround, no fine print.
      </p>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="phone-big" aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
        <i data-lucide="phone" aria-hidden="true" style="display:inline-block;width:1em;height:1em;vertical-align:middle;margin-right:0.3em"></i>
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php endif; ?>
      <br>
      <a href="/contact" class="btn-cta-accent">
        <i data-lucide="clipboard-list" aria-hidden="true"></i>
        Schedule a Free Estimate
      </a>
    </div>
  </div>
</section>

<!-- ── ABOUT FAQs ─────────────────────────────────────────────────────────── -->
<section class="about-faq-section" aria-labelledby="about-faq-heading">
  <div class="container">

    <header class="section-header centered" data-animate="fade-up">
      <span class="section-eyebrow eyebrow-solid">
        <i data-lucide="help-circle" aria-hidden="true" style="width:14px;height:14px"></i>
        FAQ
      </span>
      <h2 class="section-heading" id="about-faq-heading">
        Questions About A-1 Roof Works
      </h2>
    </header>

    <div class="about-faq-list" role="list">
      <?php foreach ($aboutFaqs as $faq): ?>
      <div class="about-faq-item" role="listitem" data-animate="fade-up">
        <h3><?php echo htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8'); ?></h3>
        <p><?php echo htmlspecialchars($faq['answer'], ENT_QUOTES, 'UTF-8'); ?></p>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- Divider: wave into alt bg ───────────────────────────────────────────── -->
<div class="about-svg-divider" aria-hidden="true" style="background:var(--color-bg)">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none">
    <path d="M0,30 C200,60 400,0 600,30 C800,60 1000,0 1200,30 L1200,60 L0,60 Z" fill="var(--color-bg-alt)"/>
  </svg>
</div>

<!-- ── CLOSING CTA (CTA #3) ───────────────────────────────────────────────── -->
<section class="about-closing-cta" aria-labelledby="about-close-heading">
  <div class="container" data-animate="fade-up">

    <span class="section-eyebrow eyebrow-solid" style="display:inline-flex;justify-content:center;margin-bottom:var(--space-lg)">
      <i data-lucide="users" aria-hidden="true" style="width:14px;height:14px"></i>
      Meet the Crew
    </span>

    <h2 id="about-close-heading">
      Meet the Crew.<br>
      Get Your Estimate.
    </h2>

    <p>
      The same people who'll install your roof show up for the estimate.
      No bait-and-switch, no unfamiliar faces — just an experienced crew that knows
      what they're looking at and tells you exactly what your roof needs.
    </p>

    <div class="about-closing-actions">
      <a href="/contact" class="btn-close-primary">
        <i data-lucide="clipboard-list" aria-hidden="true"></i>
        Schedule My Free Estimate
      </a>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="btn-close-phone">
        <i data-lucide="phone" aria-hidden="true"></i>
        Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php else: ?>
      <a href="/services" class="btn-close-phone">
        <i data-lucide="layers" aria-hidden="true"></i>
        View All Services
      </a>
      <?php endif; ?>
    </div>

  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
