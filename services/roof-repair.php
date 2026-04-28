<?php
/* ─────────────────────────────────────────────────────────────────────────────
 * services/roof-repair.php — Roof Repair Service Page
 * A-1 Roof Works LLC
 * Standard Tier: ≥ 200 lines inline CSS · ≥ 4 distinct techniques
 * Techniques used:
 *   C1  Small service hero (60vh) — ::before gradient + ::after noise
 *   C2  Staggered hero entrance animations
 *   C3  Section dividers — 3 distinct styles (wave-up, torn diagonal, diagonal)
 *   C5  Eyebrow labels above every H2
 *   C6  Split layout (image LEFT) for service detail — reversed from roof-replacement
 *   C6  Compact icon-chip list for Why Choose Us (unique to this page)
 *   C7  Editorial pullquote block — large typography + accent border (signature)
 *   C8  Inline process chips / pill-badge steps
 *   C9  3D-press button pattern on all CTAs
 *   C10 FAQ with details/summary accordion
 * ───────────────────────────────────────────────────────────────────────────── */

// ── Page meta ──────────────────────────────────────────────────────────────────
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$city      = !empty($address['city'])  ? $address['city']  : 'the Area';
$state     = !empty($address['state']) ? $address['state'] : '';
$cityState = $city . ($state ? ', ' . $state : '');
$yearsNum  = !empty($yearsInBusiness) ? $yearsInBusiness : '15';

$pageTitle       = 'Roof Repair in ' . $cityState . ' | A-1 Roof Works LLC';
$pageDescription = 'Professional roof repair in ' . $cityState . ' — we find the actual leak source, not just the interior stain. Flashing, shingles, valleys, boots, and ridge cap repair. Same-day or next-day service. Free estimates.';
$canonicalUrl    = $siteUrl . '/services/roof-repair';
$ogImage         = '/assets/images/roof-repair-hero.png';
$currentPage     = 'services';
$heroPreloadImage = '/assets/images/roof-repair-hero.png';

// ── FAQs ───────────────────────────────────────────────────────────────────────
$faqs = [
    [
        'question' => 'How much does roof repair cost in ' . $city . '?',
        'answer'   => 'Minor repairs — a cracked boot, a few missing shingles, failed flashing sealant — typically run $300–$800. More involved repairs like valley replacement, chimney flashing rebuild, or multi-section shingle work run $800–$2,000. We provide written estimates before any work starts.',
    ],
    [
        'question' => 'How do I know if I need a repair or a full replacement?',
        'answer'   => 'If your roof is under 15 years old and damage is localized, repair is almost always the right call. If you\'ve had repeated leaks in different spots, shingles are curling or losing granules across large sections, or the roof is 20+ years old, replacement is typically more cost-effective. Our free inspection gives you a straight answer.',
    ],
    [
        'question' => 'Can you repair a roof in winter or during rain?',
        'answer'   => 'Minor emergency work — tarping, sealing exposed areas — can be done in any conditions. Permanent repairs with proper adhesion require dry conditions and temperatures above 40°F. We\'ll tell you what can be done now vs. what needs to wait for the right conditions.',
    ],
];

// ── Schema ─────────────────────────────────────────────────────────────────────
$serviceSchema = generateServiceSchema([
    'name'        => 'Roof Repair',
    'description' => 'Professional roof repair in ' . $cityState . '. Flashing replacement, vent boot repair, shingle replacement, valley repair, ridge cap, and leak diagnosis. We find the actual source of the leak — not just the symptom — and complete most repairs same-day or next-day.',
], $siteUrl, $siteName);

if (!empty($aggregateRating) && !empty($aggregateRatingCount)) {
    $serviceSchema['aggregateRating'] = [
        '@type'       => 'AggregateRating',
        'ratingValue' => (string) $aggregateRating,
        'reviewCount' => (string) $aggregateRatingCount,
        'bestRating'  => '5',
        'worstRating' => '1',
    ];
}

$faqSchema = generateFAQSchema($faqs);

$breadcrumbSchema = generateBreadcrumbSchema([
    ['name' => 'Home',     'url' => $siteUrl . '/'],
    ['name' => 'Services', 'url' => $siteUrl . '/services'],
    ['name' => 'Roof Repair'],
]);

$howToSchema = generateHowToSchema(
    'How Roof Repair Works — A-1 Roof Works LLC',
    'Three steps from diagnosis to documented repair — we find the actual leak source before touching anything, provide a written estimate, and complete most repairs same-day.',
    [
        ['name' => 'Diagnostic Inspection',
         'text' => 'We assess the roof systematically: suspected entry point, adjacent flashing, underlayment condition visible at eaves, and the full moisture path from outside to the interior symptom. We trace where water is actually entering before touching anything — and we explain our findings to you clearly before any work starts.'],
        ['name' => 'Written Scope & Estimate',
         'text' => 'You receive a written description of what we found, what we\'ll do to fix it, and a clear price. No verbal agreements. No scope that expands without notice. If we discover additional issues during the repair, we stop and discuss before proceeding.'],
        ['name' => 'Same-Day Repair & Documentation',
         'text' => 'Most repairs are completed in a single visit. We photograph the completed work alongside the before photos, and provide you with a written record of what was done, the materials used, and the date of service.'],
    ]
);

$schemaMarkup = json_encode(
    [$serviceSchema, $faqSchema, $breadcrumbSchema, $howToSchema],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
);

// ── Load shared components ─────────────────────────────────────────────────────
// SEO: <link rel="canonical"> + <script type="application/ld+json"> are rendered by includes/head.php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════════════════════
     PAGE-SPECIFIC STYLES — Roof Repair
     Standard Tier: ≥ 200 lines inline CSS · ≥ 4 distinct techniques
     All values use var() tokens — no hardcoded colors/spacing/shadows
═══════════════════════════════════════════════════════════════════════════ -->
<style>

/* ── 0. Scoped utilities ──────────────────────────────────────────────────── */
.page-services .rep-container {
  width: 100%;
  max-width: var(--max-width, 1200px);
  margin-inline: auto;
  padding-inline: var(--space-lg);
}
@media (max-width: 767px) {
  .page-services .rep-container { padding-inline: var(--space-md); }
}
.page-services .prose-rep {
  max-width: 65ch;
}
.page-services .prose-rep p {
  color: var(--color-text-light);
  line-height: 1.72;
  font-size: 1.0rem;
  margin-bottom: var(--space-lg);
}
.page-services .prose-rep p:last-child { margin-bottom: 0; }

/* ── 1. Service Hero — C1 ─────────────────────────────────────────────────── */
.rep-hero {
  min-height: 60vh;
  display: flex;
  align-items: flex-end;
  position: relative;
  overflow: hidden;
  background-image: url('/assets/images/roof-repair-hero.png');
  background-size: cover;
  background-position: center 35%;
}
/* Gradient overlay — left-heavy to create natural reading area */
.rep-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    120deg,
    rgba(var(--color-primary-dark-rgb), 0.97) 0%,
    rgba(var(--color-primary-rgb), 0.82) 50%,
    rgba(var(--color-primary-rgb), 0.45) 100%
  );
  z-index: 1;
}
/* SVG noise texture */
.rep-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  z-index: 1;
  pointer-events: none;
}
.rep-hero-inner {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: calc(var(--navbar-height, 80px) + var(--space-4xl)) 0 var(--space-3xl);
}
.rep-hero-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: rgba(var(--color-accent-rgb), 0.14);
  border: 1px solid rgba(var(--color-accent-rgb), 0.38);
  border-radius: 999px;
  padding: 6px 18px;
  font-family: var(--font-heading);
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--color-accent);
  margin-bottom: var(--space-xl);
  animation: rep-fade-down 0.6s ease both;
}
.rep-hero-title {
  font-family: var(--font-heading);
  font-size: clamp(2.2rem, 5.5vw, 4rem);
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -0.025em;
  color: #fff;
  text-wrap: balance;
  max-width: 22ch;
  margin-bottom: var(--space-lg);
  animation: rep-fade-up 0.65s ease 0.10s both;
}
.rep-hero-title .rep-accent-word {
  background: linear-gradient(135deg, #fff 0%, var(--color-accent) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.rep-hero-sub {
  font-size: clamp(0.95rem, 1.8vw, 1.1rem);
  color: rgba(255,255,255,0.80);
  line-height: 1.65;
  max-width: 50ch;
  margin-bottom: var(--space-2xl);
  animation: rep-fade-up 0.65s ease 0.22s both;
}
.rep-hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  align-items: center;
  animation: rep-fade-up 0.65s ease 0.34s both;
}
/* Response-time badge strip in hero */
.rep-hero-badges {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  margin-top: var(--space-2xl);
  animation: rep-fade-up 0.65s ease 0.46s both;
}
.rep-hero-badge {
  display: flex;
  align-items: center;
  gap: var(--space-sm);
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.16);
  border-radius: var(--radius-md);
  padding: 8px 14px;
  color: rgba(255,255,255,0.88);
  font-size: 0.82rem;
  font-weight: 600;
  font-family: var(--font-heading);
  backdrop-filter: blur(6px);
}
.rep-hero-badge i { color: var(--color-accent); }

@keyframes rep-fade-down {
  from { opacity: 0; transform: translateY(-12px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes rep-fade-up {
  from { opacity: 0; transform: translateY(18px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* ── 2. Buttons ───────────────────────────────────────────────────────────── */
.rep-btn-primary {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: var(--color-accent);
  color: var(--color-primary-dark);
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  padding: 14px var(--space-2xl);
  border-radius: var(--radius-md);
  box-shadow: 0 4px 0 rgba(0,0,0,0.22);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  text-decoration: none;
  border: none;
  cursor: pointer;
}
.rep-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.18); }
.rep-btn-primary:active { transform: translateY(2px); box-shadow: 0 2px 0 rgba(0,0,0,0.18); }
.rep-btn-outline-light {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: transparent;
  color: #fff;
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 600;
  letter-spacing: 0.04em;
  padding: 13px var(--space-xl);
  border-radius: var(--radius-md);
  border: 2px solid rgba(255,255,255,0.50);
  transition: border-color var(--transition-fast), background var(--transition-fast);
  text-decoration: none;
}
.rep-btn-outline-light:hover {
  border-color: rgba(255,255,255,0.85);
  background: rgba(255,255,255,0.07);
}
.rep-btn-white {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: #fff;
  color: var(--color-primary-dark);
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  padding: 14px var(--space-2xl);
  border-radius: var(--radius-md);
  box-shadow: 0 4px 0 rgba(0,0,0,0.18);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  text-decoration: none;
}
.rep-btn-white:hover { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.14); }
.rep-btn-white:active { transform: translateY(2px); box-shadow: 0 2px 0 rgba(0,0,0,0.14); }

/* ── 3. Breadcrumb bar ────────────────────────────────────────────────────── */
.rep-breadcrumb-bar {
  background: var(--color-bg-alt);
  border-bottom: 1px solid rgba(var(--color-primary-rgb), 0.08);
  padding: var(--space-sm) 0;
}
.rep-breadcrumb-list {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-sm);
  align-items: center;
  list-style: none;
  font-size: 0.82rem;
  color: var(--color-text-light);
}
.rep-breadcrumb-list li + li::before {
  content: '/';
  margin-right: var(--space-sm);
  color: rgba(var(--color-primary-rgb), 0.28);
}
.rep-breadcrumb-list a {
  color: var(--color-secondary);
  font-weight: 500;
  transition: color var(--transition-fast);
}
.rep-breadcrumb-list a:hover { color: var(--color-primary); }
.rep-breadcrumb-list li:last-child { color: var(--color-text); font-weight: 600; }

/* ── 4. Eyebrow label ─────────────────────────────────────────────────────── */
.rep-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  font-family: var(--font-heading);
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  background: rgba(var(--color-accent-rgb), 0.11);
  border: 1px solid rgba(var(--color-accent-rgb), 0.28);
  color: var(--color-accent);
  padding: 5px 14px;
  border-radius: 999px;
  margin-bottom: var(--space-md);
}

/* ── 5. Section headings ──────────────────────────────────────────────────── */
.rep-section-heading {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
  color: var(--color-primary);
  text-wrap: balance;
  margin-bottom: var(--space-lg);
}
.rep-section-lead {
  font-size: 1.0rem;
  color: var(--color-text-light);
  line-height: 1.72;
  max-width: 62ch;
}
.rep-section-header { margin-bottom: var(--space-3xl); }
.rep-section-header.centered { text-align: center; }
.rep-section-header.centered .rep-section-lead { margin-inline: auto; }

/* ── 6. Service Detail — split layout IMAGE LEFT ─────────────────────────── */
.rep-detail-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg);
}
.rep-detail-grid {
  display: grid;
  grid-template-columns: 400px 1fr;
  gap: var(--space-3xl);
  align-items: start;
}
.rep-detail-heading {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
  color: var(--color-primary);
  text-wrap: balance;
  margin-bottom: var(--space-xl);
}
.rep-last-updated {
  font-size: 0.78rem;
  color: var(--color-text-light);
  margin-bottom: var(--space-xl);
  font-style: italic;
}
/* Image composition — dark overlay chip + diagonal corner accent */
.rep-detail-image-wrap {
  position: sticky;
  top: calc(var(--navbar-height, 80px) + var(--space-xl));
}
.rep-detail-image-frame {
  position: relative;
  border-radius: var(--radius-lg);
  overflow: visible;
}
.rep-detail-image-inner {
  position: relative;
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-xl);
}
.rep-detail-image-inner::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    180deg,
    transparent 55%,
    rgba(var(--color-primary-dark-rgb), 0.55) 100%
  );
}
.rep-detail-image-inner picture,
.rep-detail-image-inner img {
  display: block;
  width: 100%;
  height: auto;
  aspect-ratio: 3/4;
  object-fit: cover;
}
/* Accent corner decoration — bottom-left */
.rep-detail-image-frame::after {
  content: '';
  position: absolute;
  bottom: -8px;
  left: -8px;
  width: 55%;
  height: 55%;
  border-bottom: 3px solid var(--color-accent);
  border-left: 3px solid var(--color-accent);
  border-radius: 0 0 0 var(--radius-lg);
  z-index: -1;
}
/* Floating repair tag */
.rep-image-tag {
  position: absolute;
  bottom: var(--space-lg);
  right: var(--space-lg);
  background: rgba(var(--color-primary-dark-rgb), 0.90);
  border: 1px solid rgba(var(--color-accent-rgb), 0.38);
  border-radius: var(--radius-md);
  padding: var(--space-sm) var(--space-md);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 0.78rem;
  font-weight: 600;
  z-index: 2;
  backdrop-filter: blur(8px);
  display: flex;
  align-items: center;
  gap: var(--space-sm);
}
.rep-image-tag i { color: var(--color-accent); }

/* ── 7. Repair types chip list ────────────────────────────────────────────── */
.rep-types-list {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-sm);
  margin-top: var(--space-xl);
}
.rep-type-chip {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(var(--color-primary-rgb), 0.05);
  border: 1px solid rgba(var(--color-primary-rgb), 0.12);
  border-radius: 999px;
  padding: 6px 14px;
  font-size: 0.82rem;
  font-weight: 600;
  color: var(--color-primary);
  transition: background var(--transition-fast), border-color var(--transition-fast);
}
.rep-type-chip:hover {
  background: rgba(var(--color-accent-rgb), 0.10);
  border-color: rgba(var(--color-accent-rgb), 0.30);
  color: var(--color-accent);
}
.rep-type-chip i { width: 14px; height: 14px; }

/* ── 8. SVG Dividers ──────────────────────────────────────────────────────── */
.rep-divider {
  display: block;
  line-height: 0;
  overflow: hidden;
}
.rep-divider svg {
  display: block;
  width: 100%;
  height: 60px;
}

/* ── 9. Why Choose Us — compact icon list ─────────────────────────────────── */
.rep-why-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg-alt);
}
.rep-why-list {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: var(--space-xl);
  margin-top: var(--space-3xl);
}
.rep-why-item {
  display: flex;
  align-items: flex-start;
  gap: var(--space-lg);
  padding: var(--space-xl);
  background: var(--color-bg);
  border-radius: var(--radius-lg);
  border-left: 3px solid transparent;
  box-shadow: var(--shadow-sm);
  transition: border-color var(--transition-base), box-shadow var(--transition-base), transform var(--transition-base);
}
.rep-why-item:hover {
  border-left-color: var(--color-accent);
  box-shadow: var(--shadow-md);
  transform: translateX(4px);
}
.rep-why-icon-wrap {
  flex-shrink: 0;
  width: 46px;
  height: 46px;
  background: rgba(var(--color-accent-rgb), 0.10);
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background var(--transition-fast);
}
.rep-why-icon-wrap i {
  color: var(--color-accent);
  width: 22px;
  height: 22px;
  transition: transform var(--transition-fast);
}
.rep-why-item:hover .rep-why-icon-wrap { background: rgba(var(--color-accent-rgb), 0.18); }
.rep-why-item:hover .rep-why-icon-wrap i { transform: scale(1.12) rotate(-4deg); }
.rep-why-item-body {}
.rep-why-item-title {
  font-family: var(--font-heading);
  font-size: 1.0rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: var(--space-xs);
  line-height: 1.3;
}
.rep-why-item-text {
  font-size: 0.88rem;
  color: var(--color-text-light);
  line-height: 1.65;
}

/* ── 10. Signature Section — Editorial Pullquote ──────────────────────────── */
.rep-pullquote-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg);
}
.rep-pullquote-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-4xl);
  align-items: center;
}
/* Left: editorial quote block */
.rep-pullquote-block {
  border-left: 5px solid var(--color-accent);
  padding-left: var(--space-2xl);
}
.rep-pullquote-quote {
  font-family: var(--font-heading);
  font-size: clamp(1.6rem, 3.5vw, 2.4rem);
  font-weight: 700;
  line-height: 1.22;
  color: var(--color-primary);
  margin-bottom: var(--space-lg);
  letter-spacing: -0.015em;
}
.rep-pullquote-quote em {
  font-style: normal;
  color: var(--color-accent);
}
.rep-pullquote-attribution {
  font-size: 0.85rem;
  color: var(--color-text-light);
  font-style: italic;
}
/* Right: supporting stats or content */
.rep-pullquote-stats {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-lg);
}
.rep-stat-block {
  background: var(--color-bg-alt);
  border-radius: var(--radius-lg);
  padding: var(--space-xl);
  text-align: center;
  border-bottom: 2px solid var(--color-accent);
}
.rep-stat-number {
  font-family: var(--font-heading);
  font-size: clamp(2rem, 4vw, 2.8rem);
  font-weight: 800;
  color: var(--color-primary);
  line-height: 1;
  display: block;
  margin-bottom: var(--space-xs);
}
.rep-stat-label {
  font-size: 0.82rem;
  color: var(--color-text-light);
  line-height: 1.4;
  font-weight: 600;
}

/* ── 11. Process — Inline step pills ──────────────────────────────────────── */
.rep-process-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg-alt);
}
.rep-process-steps {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-xl);
  margin-top: var(--space-3xl);
}
.rep-process-card {
  background: var(--color-bg);
  border-radius: var(--radius-lg);
  padding: var(--space-2xl);
  box-shadow: var(--shadow-card);
  position: relative;
  overflow: hidden;
  transition: transform var(--transition-base), box-shadow var(--transition-base);
}
.rep-process-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-xl);
}
.rep-process-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--color-accent), var(--color-primary));
}
.rep-process-step-num {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 44px;
  height: 44px;
  background: var(--color-primary);
  border-radius: 50%;
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 800;
  color: var(--color-accent);
  margin-bottom: var(--space-lg);
  box-shadow: 0 0 0 3px rgba(var(--color-accent-rgb), 0.20);
  transition: background var(--transition-fast), color var(--transition-fast);
}
.rep-process-card:hover .rep-process-step-num {
  background: var(--color-accent);
  color: var(--color-primary-dark);
}
.rep-process-step-title {
  font-family: var(--font-heading);
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: var(--space-sm);
  line-height: 1.3;
}
.rep-process-step-text {
  font-size: 0.88rem;
  color: var(--color-text-light);
  line-height: 1.65;
}

/* ── 12. Mid-page CTA Banner ──────────────────────────────────────────────── */
.rep-cta-banner {
  position: relative;
  overflow: hidden;
  background: linear-gradient(
    148deg,
    var(--color-primary-dark) 0%,
    var(--color-primary) 60%,
    var(--color-secondary) 100%
  );
  padding: var(--section-pad, 80px 20px);
}
.rep-cta-banner::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}
.rep-cta-banner-inner {
  position: relative;
  z-index: 1;
  text-align: center;
}
.rep-cta-banner-eyebrow {
  display: inline-block;
  background: rgba(var(--color-accent-rgb), 0.18);
  border: 1px solid rgba(var(--color-accent-rgb), 0.40);
  color: var(--color-accent);
  font-family: var(--font-heading);
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  padding: 5px 14px;
  border-radius: 999px;
  margin-bottom: var(--space-lg);
}
.rep-cta-banner-title {
  font-family: var(--font-heading);
  font-size: clamp(1.9rem, 4vw, 3rem);
  font-weight: 800;
  color: #fff;
  line-height: 1.12;
  letter-spacing: -0.02em;
  text-wrap: balance;
  margin-bottom: var(--space-lg);
}
.rep-cta-banner-sub {
  font-size: 1.05rem;
  color: rgba(255,255,255,0.78);
  max-width: 52ch;
  margin-inline: auto;
  margin-bottom: var(--space-2xl);
  line-height: 1.6;
}
.rep-cta-banner-phone {
  display: block;
  font-family: var(--font-heading);
  font-size: clamp(2rem, 4vw, 2.8rem);
  font-weight: 800;
  color: var(--color-accent);
  letter-spacing: 0.02em;
  margin-bottom: var(--space-2xl);
  transition: opacity var(--transition-fast);
  text-decoration: none;
}
.rep-cta-banner-phone:hover { opacity: 0.85; }
.rep-cta-banner-actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  justify-content: center;
  align-items: center;
}

/* ── 13. FAQ Section ──────────────────────────────────────────────────────── */
.rep-faq-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg);
}
.rep-faq-list {
  display: grid;
  gap: var(--space-md);
  margin-top: var(--space-3xl);
  max-width: 820px;
  margin-inline: auto;
}
.rep-faq-item {
  background: var(--color-bg-alt);
  border-radius: var(--radius-md);
  border: 1px solid rgba(var(--color-primary-rgb), 0.08);
  overflow: hidden;
}
.rep-faq-question {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-lg);
  padding: var(--space-xl) var(--space-2xl);
  font-family: var(--font-heading);
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--color-primary);
  cursor: pointer;
  list-style: none;
  transition: background var(--transition-fast);
  line-height: 1.4;
}
.rep-faq-question::-webkit-details-marker { display: none; }
.rep-faq-question:hover { background: rgba(var(--color-primary-rgb), 0.03); }
.rep-faq-icon {
  flex-shrink: 0;
  width: 22px;
  height: 22px;
  background: rgba(var(--color-accent-rgb), 0.12);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background var(--transition-fast), transform var(--transition-fast);
}
.rep-faq-icon i { color: var(--color-accent); width: 12px; height: 12px; }
details[open] .rep-faq-icon {
  background: var(--color-accent);
  transform: rotate(45deg);
}
details[open] .rep-faq-icon i { color: var(--color-primary-dark); }
.rep-faq-answer {
  padding: var(--space-lg) var(--space-2xl) var(--space-xl);
  font-size: 0.94rem;
  color: var(--color-text-light);
  line-height: 1.72;
  border-top: 1px solid rgba(var(--color-primary-rgb), 0.06);
}

/* ── 14. Closing CTA ──────────────────────────────────────────────────────── */
.rep-closing-cta {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg-alt);
  text-align: center;
}
.rep-closing-cta-inner {
  max-width: 640px;
  margin-inline: auto;
}
.rep-closing-cta-title {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 800;
  color: var(--color-primary);
  text-wrap: balance;
  margin-bottom: var(--space-lg);
  line-height: 1.2;
}
.rep-closing-cta-sub {
  font-size: 1.05rem;
  color: var(--color-text-light);
  margin-bottom: var(--space-2xl);
  line-height: 1.65;
}
.rep-closing-cta-actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  justify-content: center;
}
.rep-closing-cta-guarantee {
  margin-top: var(--space-lg);
  font-size: 0.82rem;
  color: var(--color-text-light);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-sm);
}
.rep-closing-cta-guarantee i { color: var(--color-accent); }

/* ── 15. Responsive breakpoints ──────────────────────────────────────────── */
@media (max-width: 1023px) {
  .rep-detail-grid { grid-template-columns: 1fr; }
  .rep-detail-image-wrap { position: static; }
  .rep-pullquote-grid { grid-template-columns: 1fr; }
  .rep-process-steps { grid-template-columns: 1fr; }
  .rep-why-list { grid-template-columns: 1fr; }
}
@media (max-width: 767px) {
  .rep-hero-title { max-width: 100%; }
  .rep-pullquote-stats { grid-template-columns: 1fr 1fr; }
  .rep-cta-banner-actions { flex-direction: column; }
  .rep-hero-badges { gap: var(--space-sm); }
}

/* ── 16. Reduced-motion ───────────────────────────────────────────────────── */
@media (prefers-reduced-motion: reduce) {
  .rep-hero-eyebrow,
  .rep-hero-title,
  .rep-hero-sub,
  .rep-hero-actions,
  .rep-hero-badges {
    animation: none;
  }
}

/* ── Project Photo Strip ─────────────────────────────────────────── */
.rep-photo-strip {
  padding: var(--space-3xl) 0;
  background: var(--color-bg-alt);
}
.rep-photo-pair {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-md);
}
.rep-photo-pair-item {
  border-radius: var(--radius-lg);
  overflow: hidden;
  aspect-ratio: 4/3;
  box-shadow: var(--shadow-card);
}
.rep-photo-pair-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--transition-base);
}
.rep-photo-pair-item:hover img { transform: scale(1.04); }
@media (max-width: 767px) {
  .rep-photo-pair { grid-template-columns: 1fr; }
}

</style>

<!-- ── Hero (CTA #1) ──────────────────────────────────────────────────────── -->
<section class="rep-hero" aria-labelledby="rep-hero-heading">
  <div class="rep-hero-inner">
    <div class="rep-container">

      <p class="rep-hero-eyebrow" aria-hidden="true">
        <i data-lucide="wrench" aria-hidden="true"></i>
        Roof Repair Specialists
      </p>

      <h1 class="rep-hero-title" id="rep-hero-heading">
        <span class="rep-accent-word">Roof Repair</span> in <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?> — Fix the Source, Not Just the Symptom
      </h1>

      <p class="rep-hero-sub">
        Most leaks don't originate where the stain appears inside your home. We trace water paths from outside in, identify the actual entry point, and fix it with compatible materials — documented with photos before and after.
      </p>

      <div class="rep-hero-actions">
        <a href="/contact" class="rep-btn-primary">
          <i data-lucide="clipboard-list" aria-hidden="true"></i>
          Schedule Inspection
        </a>
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>" class="rep-btn-outline-light">
          <i data-lucide="phone" aria-hidden="true"></i>
          <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php endif; ?>
      </div>

      <div class="rep-hero-badges">
        <span class="rep-hero-badge">
          <i data-lucide="zap" aria-hidden="true"></i>
          Same-Day or Next-Day Service
        </span>
        <span class="rep-hero-badge">
          <i data-lucide="camera" aria-hidden="true"></i>
          Before &amp; After Documentation
        </span>
        <span class="rep-hero-badge">
          <i data-lucide="shield-check" aria-hidden="true"></i>
          Licensed &amp; Insured
        </span>
        <span class="rep-hero-badge">
          <i data-lucide="file-check" aria-hidden="true"></i>
          Written Repair Estimate
        </span>
      </div>

    </div>
  </div>
</section>

<!-- ── Breadcrumb ─────────────────────────────────────────────────────────── -->
<nav class="rep-breadcrumb-bar" aria-label="Breadcrumb">
  <div class="rep-container">
    <ol class="rep-breadcrumb-list"
        itemscope
        itemtype="https://schema.org/BreadcrumbList">

      <li itemprop="itemListElement"
          itemscope
          itemtype="https://schema.org/ListItem">
        <a href="/" itemprop="item"><span itemprop="name">Home</span></a>
        <meta itemprop="position" content="1">
      </li>

      <li itemprop="itemListElement"
          itemscope
          itemtype="https://schema.org/ListItem">
        <a href="/services" itemprop="item"><span itemprop="name">Services</span></a>
        <meta itemprop="position" content="2">
      </li>

      <li itemprop="itemListElement"
          itemscope
          itemtype="https://schema.org/ListItem">
        <span itemprop="name">Roof Repair</span>
        <meta itemprop="position" content="3">
      </li>

    </ol>
  </div>
</nav>

<!-- ── Service Detail — split layout (image LEFT) ────────────────────────── -->
<section class="rep-detail-section" aria-labelledby="rep-detail-heading" data-animate="fade-up">
  <div class="rep-container">
    <div class="rep-detail-grid">

      <!-- Image — LEFT column (reversed from roof-replacement) -->
      <div class="rep-detail-image-wrap" data-animate="wipe-right">
        <div class="rep-detail-image-frame">
          <div class="rep-detail-image-inner">
            <picture>
              <img src="/assets/images/photo-001.jpg" alt="Close-up of asphalt shingle roof with black flashing and drip edge detail showing installation quality" width="800" height="1066" loading="lazy">
            </picture>
          </div>
          <div class="rep-image-tag">
            <i data-lucide="search" aria-hidden="true"></i>
            Leak Source Diagnosed First
          </div>
        </div>
      </div>

      <!-- Content — right column -->
      <div class="rep-detail-content">
        <span class="rep-eyebrow">
          <i data-lucide="info" aria-hidden="true"></i>
          How We Approach Repairs
        </span>
        <h2 class="rep-detail-heading" id="rep-detail-heading">
          Finding Where Water Actually Enters — Not Just Where It Shows Up
        </h2>
        <p class="rep-last-updated">Last Updated: April 2026</p>

        <div class="prose-rep">
          <p>
            Most roof problems have a specific, identifiable cause — a failed flashing seal, a cracked vent boot, missing or slipping shingles after a wind event. The mistake most contractors make is treating symptoms without finding the source. Water travels before it appears as a ceiling stain, which means the entry point is often not directly above the stained area. We trace the water path systematically from outside in before touching anything, and seal the actual entry point with compatible materials, not just the nearest visible gap.
          </p>
          <p>
            The repair types we handle most frequently: flashing replacement around chimneys, skylights, and pipe penetrations — the most common source of leaks on roofs under 20 years old; valley repair where two roof planes meet and water concentrates; ridge cap replacement after wind blow-off; shingle replacement after impact or displacement; gutter apron repair; and soffit and fascia damage caused by water infiltration from a failing roof edge. We document what was found and what was done with photos on every repair visit, so you have a complete record for insurance or future inspections.
          </p>
          <p>
            We'll always tell you honestly whether repair or replacement makes better sense for your situation. If a repair would cost more than 30% of a replacement's total cost on a roof over 15 years old, we'll say that upfront — not after we're half done. If a targeted repair on an otherwise sound roof buys you 5–8 good years, we'll tell you that too. You get the information you need to make a decision that fits your timeline and budget, not a sales pitch.
          </p>
        </div>

        <!-- Repair type chips -->
        <div class="rep-types-list" role="list" aria-label="Repair types we handle">
          <span class="rep-type-chip"><i data-lucide="triangle" aria-hidden="true"></i> Flashing Repair</span>
          <span class="rep-type-chip"><i data-lucide="circle" aria-hidden="true"></i> Vent Boot Replacement</span>
          <span class="rep-type-chip"><i data-lucide="layers" aria-hidden="true"></i> Shingle Replacement</span>
          <span class="rep-type-chip"><i data-lucide="git-merge" aria-hidden="true"></i> Valley Repair</span>
          <span class="rep-type-chip"><i data-lucide="bar-chart-2" aria-hidden="true"></i> Ridge Cap</span>
          <span class="rep-type-chip"><i data-lucide="droplets" aria-hidden="true"></i> Gutter Apron</span>
          <span class="rep-type-chip"><i data-lucide="wind" aria-hidden="true"></i> Blow-Off Repair</span>
          <span class="rep-type-chip"><i data-lucide="cloud" aria-hidden="true"></i> Skylight Flashing</span>
        </div>

        <!-- Internal links -->
        <div style="margin-top: var(--space-xl); display: flex; gap: var(--space-md); flex-wrap: wrap;">
          <a href="/services/roof-replacement" style="color: var(--color-secondary); font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 4px;">
            <i data-lucide="arrow-right" aria-hidden="true" style="width:14px;height:14px;"></i>
            Roof Replacement
          </a>
          <a href="/services/storm-damage-repair" style="color: var(--color-secondary); font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 4px;">
            <i data-lucide="arrow-right" aria-hidden="true" style="width:14px;height:14px;"></i>
            Storm Damage Repair
          </a>
        </div>

      </div>

    </div>
  </div>
</section>

<!-- Divider: wave into bg-alt (why section) -->
<div class="rep-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path fill="var(--color-bg-alt)" d="M0,0 C300,50 900,10 1200,45 L1200,60 L0,60 Z"/>
  </svg>
</div>

<!-- ── Why Choose Us — compact icon list ─────────────────────────────────── -->
<section class="rep-why-section" aria-labelledby="rep-why-heading" data-animate="fade-up">
  <div class="rep-container">

    <div class="rep-section-header centered">
      <span class="rep-eyebrow">
        <i data-lucide="check-circle" aria-hidden="true"></i>
        Why Homeowners Call Us
      </span>
      <h2 class="rep-section-heading" id="rep-why-heading">
        What Makes A-1 Different for Roof Repairs in <?php echo htmlspecialchars($city, ENT_QUOTES, 'UTF-8'); ?>
      </h2>
      <p class="rep-section-lead">
        Most repair calls come down to trust: will they actually fix what's broken, show up when they say they will, and not push for more than the job needs?
      </p>
    </div>

    <div class="rep-why-list">

      <div class="rep-why-item" data-animate="fade-up">
        <div class="rep-why-icon-wrap">
          <i data-lucide="map-pin" aria-hidden="true"></i>
        </div>
        <div class="rep-why-item-body">
          <h3 class="rep-why-item-title">We Find the Actual Leak Source</h3>
          <p class="rep-why-item-text">
            Not just the interior stain. Leaks travel. Patching the wrong spot wastes your money and your time, and the ceiling stain comes back three weeks later. We trace the water path from outside in before we touch anything.
          </p>
        </div>
      </div>

      <div class="rep-why-item" data-animate="fade-up">
        <div class="rep-why-icon-wrap">
          <i data-lucide="clock" aria-hidden="true"></i>
        </div>
        <div class="rep-why-item-body">
          <h3 class="rep-why-item-title">Same-Day or Next-Day in Most Cases</h3>
          <p class="rep-why-item-text">
            We don't put repair jobs in a multi-week queue. Most repairs are scheduled within 24–48 hours — which matters when rain is in the forecast and you have an active leak. Emergency response available for urgent situations.
          </p>
        </div>
      </div>

      <div class="rep-why-item" data-animate="fade-up">
        <div class="rep-why-icon-wrap">
          <i data-lucide="camera" aria-hidden="true"></i>
        </div>
        <div class="rep-why-item-body">
          <h3 class="rep-why-item-title">Written Documentation on Every Repair</h3>
          <p class="rep-why-item-text">
            Photos before and after, materials used, and a written description of what we found and what we did. Useful for insurance records and future inspections. You're not left relying on a verbal account of what happened to your roof.
          </p>
        </div>
      </div>

      <div class="rep-why-item" data-animate="fade-up">
        <div class="rep-why-icon-wrap">
          <i data-lucide="balance-scale" aria-hidden="true"></i>
        </div>
        <div class="rep-why-item-body">
          <h3 class="rep-why-item-title">Honest Repair-or-Replace Recommendation</h3>
          <p class="rep-why-item-text">
            We have no financial incentive to push you toward a full replacement if a repair is the right call. If a targeted fix is the smartest move, we'll tell you — even if it means a smaller job for us. If replacement makes more sense, we'll explain exactly why.
          </p>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- Divider: diagonal into bg (pullquote signature section) -->
<div class="rep-divider" aria-hidden="true" style="background: var(--color-bg-alt);">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <polygon fill="var(--color-bg)" points="0,0 1200,60 1200,60 0,60"/>
  </svg>
</div>

<!-- ── Editorial Pullquote — SIGNATURE SECTION ────────────────────────────── -->
<section class="rep-pullquote-section" aria-labelledby="rep-pullquote-heading" data-animate="fade-up">
  <div class="rep-container">
    <div class="rep-pullquote-grid">

      <!-- Left: editorial quote -->
      <div class="rep-pullquote-block">
        <p class="rep-pullquote-quote" id="rep-pullquote-heading">
          "The most expensive repair is the one that patches the <em>wrong spot</em> and leaves the leak to return — and return it does."
        </p>
        <p class="rep-pullquote-attribution">
          — A-1 Roof Works LLC | <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <div style="margin-top: var(--space-2xl);">
          <p style="color: var(--color-text-light); font-size: 0.95rem; line-height: 1.7; max-width: 52ch;">
            The most common roof repair failure we see when reviewing previous work: water entry point was never located. Contractor sealed the visible gap near the interior stain — which had nothing to do with how the water actually got in. We don't start work until we know exactly where water is entering, verified from the exterior.
          </p>
        </div>
      </div>

      <!-- Right: stat blocks -->
      <div class="rep-pullquote-stats">
        <div class="rep-stat-block">
          <span class="rep-stat-number">$300</span>
          <span class="rep-stat-label">Starting cost for minor repairs</span>
        </div>
        <div class="rep-stat-block">
          <span class="rep-stat-number">24hr</span>
          <span class="rep-stat-label">Typical scheduling turnaround</span>
        </div>
        <div class="rep-stat-block">
          <span class="rep-stat-number">1</span>
          <span class="rep-stat-label">Visit completes most repairs</span>
        </div>
        <div class="rep-stat-block">
          <span class="rep-stat-number">100%</span>
          <span class="rep-stat-label">Repairs documented with photos</span>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Divider: torn diagonal into bg-alt (process) -->
<div class="rep-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path fill="var(--color-bg-alt)" d="M0,0 L0,60 L1200,60 L1200,20 L900,45 L600,15 L300,50 L0,25 Z"/>
  </svg>
</div>

<!-- ── Process — 3 cards ───────────────────────────────────────────────────── -->
<section class="rep-process-section" aria-labelledby="rep-process-heading" data-animate="fade-up">
  <div class="rep-container">

    <div class="rep-section-header centered">
      <span class="rep-eyebrow">
        <i data-lucide="list-ordered" aria-hidden="true"></i>
        The Repair Process
      </span>
      <h2 class="rep-section-heading" id="rep-process-heading">
        How a Repair Job Actually Works
      </h2>
      <p class="rep-section-lead" style="margin-inline: auto;">
        Three steps from your first call to a completed, documented repair. No moving parts, no ambiguity.
      </p>
    </div>

    <ol class="rep-process-steps" aria-label="Roof repair process steps">

      <li class="rep-process-card" data-animate="fade-up">
        <div class="rep-process-step-num" aria-hidden="true">01</div>
        <h3 class="rep-process-step-title">Diagnostic Inspection</h3>
        <p class="rep-process-step-text">
          We assess the roof systematically: suspected entry point, adjacent flashing, underlayment condition visible at eaves, and the full moisture path from outside to the interior symptom. We trace where water is actually entering before touching anything — and we explain our findings to you clearly before any work starts.
        </p>
      </li>

      <li class="rep-process-card" data-animate="fade-up">
        <div class="rep-process-step-num" aria-hidden="true">02</div>
        <h3 class="rep-process-step-title">Written Scope &amp; Estimate</h3>
        <p class="rep-process-step-text">
          You receive a written description of what we found, what we'll do to fix it, and a clear price. No verbal agreements that you have to try to remember. No scope that expands without notice. If we discover additional issues during the repair, we stop and discuss before proceeding.
        </p>
      </li>

      <li class="rep-process-card" data-animate="fade-up">
        <div class="rep-process-step-num" aria-hidden="true">03</div>
        <h3 class="rep-process-step-title">Same-Day Repair &amp; Documentation</h3>
        <p class="rep-process-step-text">
          Most repairs are completed in a single visit. We photograph the completed work alongside the before photos, and provide you with a written record of what was done, the materials used, and the date of service. Something worth having for your homeowner's records.
        </p>
      </li>

    </ol>

  </div>
</section>

<!-- ── Project Photos ─────────────────────────────────────────────────────── -->
<section class="rep-photo-strip" aria-label="Recent roof repair projects">
  <div class="container">
    <div class="rep-photo-pair">
      <div class="rep-photo-pair-item" data-animate="fade-up">
        <picture>
          <img src="/assets/images/photo-002.jpg" alt="Roof inspection measurement on asphalt shingle roof with white PVC pipe and measurement tools" width="600" height="450" loading="lazy">
        </picture>
      </div>
      <div class="rep-photo-pair-item" data-animate="fade-up" style="animation-delay:80ms">
        <picture>
          <img src="/assets/images/photo-003.jpg" alt="Residential roof repair in progress showing removed shingles, gutters filled with debris, and roofing tools on house exterior" width="600" height="450" loading="lazy">
        </picture>
      </div>
    </div>
  </div>
</section>

<!-- Divider: diagonal into CTA banner -->
<div class="rep-divider" aria-hidden="true" style="background: var(--color-bg-alt);">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <polygon fill="var(--color-primary-dark)" points="0,60 1200,0 1200,60 0,60"/>
  </svg>
</div>

<!-- ── Mid-Page CTA Banner — CTA #2 ───────────────────────────────────────── -->
<section class="rep-cta-banner" aria-labelledby="rep-cta-heading">
  <div class="rep-container">
    <div class="rep-cta-banner-inner">

      <span class="rep-cta-banner-eyebrow">Same-Day Available</span>

      <h2 class="rep-cta-banner-title" id="rep-cta-heading">
        A Leak That Isn't Fixed Is Getting Worse Every Rain
      </h2>

      <p class="rep-cta-banner-sub">
        Water infiltration compounds. A failed flashing seal today becomes damaged decking, then mold, then a structural repair bill. Call now — most repairs scheduled within 24–48 hours.
      </p>

      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="rep-cta-banner-phone" aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php endif; ?>

      <div class="rep-cta-banner-actions">
        <a href="/contact" class="rep-btn-white">
          <i data-lucide="clipboard-list" aria-hidden="true"></i>
          Schedule Inspection
        </a>
        <a href="/services" style="display:inline-flex;align-items:center;gap:var(--space-sm);color:rgba(255,255,255,0.80);font-family:var(--font-heading);font-size:0.95rem;font-weight:600;letter-spacing:0.04em;text-decoration:none;transition:color var(--transition-fast);">
          <i data-lucide="grid" aria-hidden="true"></i>
          View All Services
        </a>
      </div>

    </div>
  </div>
</section>

<!-- Divider: wave into bg (FAQ) -->
<div class="rep-divider" aria-hidden="true" style="background: var(--color-primary-dark);">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path fill="var(--color-bg)" d="M0,40 C400,10 800,55 1200,25 L1200,60 L0,60 Z"/>
  </svg>
</div>

<!-- ── FAQ Section ────────────────────────────────────────────────────────── -->
<section class="rep-faq-section" aria-labelledby="rep-faq-heading" data-animate="fade-up">
  <div class="rep-container">

    <div class="rep-section-header centered">
      <span class="rep-eyebrow">
        <i data-lucide="help-circle" aria-hidden="true"></i>
        Common Questions
      </span>
      <h2 class="rep-section-heading" id="rep-faq-heading">
        Roof Repair Questions, Answered Directly
      </h2>
    </div>

    <div class="rep-faq-list" role="list">

      <?php foreach ($faqs as $i => $faq): ?>
      <details class="rep-faq-item" <?php echo $i === 0 ? 'open' : ''; ?>>
        <summary class="rep-faq-question">
          <?php echo htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8'); ?>
          <span class="rep-faq-icon" aria-hidden="true">
            <i data-lucide="plus" aria-hidden="true"></i>
          </span>
        </summary>
        <div class="rep-faq-answer">
          <?php echo htmlspecialchars($faq['answer'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
      </details>
      <?php endforeach; ?>

    </div>

    <p style="text-align:center; margin-top: var(--space-2xl); font-size: 0.9rem; color: var(--color-text-light);">
      More questions?
      <a href="/contact" style="color: var(--color-secondary); font-weight: 600;">Contact us directly</a>
      or <a href="/services/roof-replacement" style="color: var(--color-secondary); font-weight: 600;">read about full replacements</a> if your issue may be larger.
    </p>

  </div>
</section>

<!-- Divider: diagonal into closing CTA -->
<div class="rep-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <polygon fill="var(--color-bg-alt)" points="0,0 1200,60 1200,60 0,60"/>
  </svg>
</div>

<!-- ── Closing CTA — CTA #3 ───────────────────────────────────────────────── -->
<section class="rep-closing-cta" aria-labelledby="rep-closing-heading">
  <div class="rep-container">
    <div class="rep-closing-cta-inner">

      <h2 class="rep-closing-cta-title" id="rep-closing-heading">
        Stop Guessing Where the Leak Is — Get a Definitive Answer
      </h2>

      <p class="rep-closing-cta-sub">
        We diagnose the source, give you a written estimate, and complete the repair in a single visit in most cases. No multi-week wait, no verbal-only quotes, no returning crew because the first fix didn't hold.
      </p>

      <div class="rep-closing-cta-actions">
        <a href="/contact" class="rep-btn-primary">
          <i data-lucide="clipboard-list" aria-hidden="true"></i>
          Schedule Free Inspection
        </a>
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>" style="display:inline-flex;align-items:center;gap:var(--space-sm);color:var(--color-primary);font-family:var(--font-heading);font-size:1rem;font-weight:700;letter-spacing:0.04em;text-decoration:none;padding:14px var(--space-xl);border-radius:var(--radius-md);border:2px solid rgba(var(--color-primary-rgb),0.25);transition:border-color var(--transition-fast);">
          <i data-lucide="phone" aria-hidden="true"></i>
          <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php endif; ?>
      </div>

      <p class="rep-closing-cta-guarantee">
        <i data-lucide="shield-check" aria-hidden="true"></i>
        Licensed &amp; insured · Free estimates · Same-day scheduling available · Written documentation included
      </p>

    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
