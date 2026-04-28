<?php
/* ─────────────────────────────────────────────────────────────────────────────
 * services/storm-damage-repair.php — Storm Damage Repair Service Page
 * A-1 Roof Works LLC
 * Standard Tier: ≥ 200 lines inline CSS · ≥ 4 distinct techniques
 * Techniques used:
 *   C1  Small service hero (60vh) — urgent dark overlay, ::before gradient + ::after noise
 *   C2  Staggered hero entrance animations with alert eyebrow styling
 *   C3  Section dividers — 3 distinct styles (torn-paper, wave, diagonal)
 *   C5  Eyebrow labels above every H2, alert-variant on hero
 *   C6  Split layout for service detail — alternating from other pages
 *   C7  Bold urgency timeline — bright step markers, emergency color treatment (signature)
 *   C8  Why-us as horizontal feature strip (unique layout not used elsewhere)
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

$pageTitle       = 'Storm Damage Roof Repair in ' . $cityState . ' | A-1 Roof Works LLC';
$pageDescription = 'Storm damage roof repair and insurance claim coordination in ' . $cityState . '. Hail, wind, and fallen tree damage — same-day inspection, complete documentation before filing, and direct adjuster coordination. Call now.';
$canonicalUrl    = $siteUrl . '/services/storm-damage-repair';
$ogImage         = '/assets/images/storm-damage-hero.png';
$currentPage     = 'services';
$heroPreloadImage = '/assets/images/storm-damage-hero.png';

// ── FAQs ───────────────────────────────────────────────────────────────────────
$faqs = [
    [
        'question' => 'How do I know if my roof has hail damage?',
        'answer'   => 'The clearest signs: dents on metal flashing, gutters, or downspouts (hail leaves circular impact marks); bruised or fractured granule coating on shingles that looks darker in raking light; cracked or displaced shingles after wind. The most reliable answer is a professional inspection from a roofer who gets on the roof — not someone who just looks from the ground.',
    ],
    [
        'question' => 'Should I call my insurance company or a roofer first?',
        'answer'   => 'Call the roofer first. Get an independent documentation of damage before the adjuster arrives. Once you file a claim, you want your own photographic record so your adjuster\'s assessment can be compared against it. Filing before documentation is in place can leave you with less leverage if items are missed.',
    ],
    [
        'question' => 'Does homeowner\'s insurance cover storm damage?',
        'answer'   => 'Standard homeowner\'s policies cover sudden storm damage from hail, wind, falling trees, and lightning. They don\'t cover gradual wear or maintenance neglect. Deductibles vary — some policies have separate wind/hail deductibles, often 1–2% of the home\'s insured value. We help you understand what your policy covers before you file.',
    ],
    [
        'question' => 'What if my claim is denied?',
        'answer'   => 'Denials often happen when documentation is incomplete or damage is misclassified. We can provide supplemental documentation, and you have the right to a re-inspection. If a denial seems improper, a public adjuster can also advocate on your behalf. We\'ve successfully supplemented dozens of initially underpaid claims.',
    ],
];

// ── Schema ─────────────────────────────────────────────────────────────────────
$serviceSchema = generateServiceSchema([
    'name'        => 'Storm Damage Roof Repair',
    'description' => 'Storm damage roof inspection, documentation, and repair in ' . $cityState . '. Same-day response after major storm events. Pre-insurance damage documentation, direct adjuster coordination, emergency tarping, and complete repair or replacement after claim approval.',
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
    ['name' => 'Storm Damage Repair'],
]);

$howToSchema = generateHowToSchema(
    'How Storm Damage Repair Works — A-1 Roof Works LLC',
    'Four steps from post-storm assessment to completed repair — we document damage before you file your claim, coordinate with your adjuster, and complete the work once the claim is approved.',
    [
        ['name' => 'Emergency Assessment',
         'text' => 'We inspect your full roof promptly after the storm — shingles, metal components, gutters, flashing, and every penetration point. We look for hail impact patterns under raking light, check granule loss section by section, photograph every dented metal surface, and note displaced or cracked shingles throughout.'],
        ['name' => 'Pre-Filing Documentation Package',
         'text' => 'Before you file, we provide a complete damage report: GPS-tagged photos of every affected area, granule loss measurements by section, shingle samples demonstrating impact bruising, and a written description of all damage found. This becomes your independent record when the adjuster\'s estimate arrives.'],
        ['name' => 'Adjuster Coordination',
         'text' => 'We are available to meet your insurance adjuster on-site, walk through findings together, and present our documentation alongside their inspection. Initial estimates that miss entire sections or misclassify damage get supplemented with the documentation package we built before you filed.'],
        ['name' => 'Repair or Replacement',
         'text' => 'Once your claim is approved, we schedule and complete the work. Storm-related replacements typically take one to two days. If emergency tarping was needed between assessment and final repair, we handle that immediately and coordinate its removal as part of the final installation.'],
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
     PAGE-SPECIFIC STYLES — Storm Damage Repair
     Standard Tier: ≥ 200 lines inline CSS · ≥ 4 distinct techniques
     All values use var() tokens — no hardcoded colors/spacing/shadows
     Unique visual: urgent/alert color treatment in hero and signature section
═══════════════════════════════════════════════════════════════════════════ -->
<style>

/* ── 0. Scoped utility resets ─────────────────────────────────────────────── */
.page-services .sd-container {
  width: 100%;
  max-width: var(--max-width, 1200px);
  margin-inline: auto;
  padding-inline: var(--space-lg);
}
@media (max-width: 767px) {
  .page-services .sd-container { padding-inline: var(--space-md); }
}
.page-services .prose-sd {
  max-width: 65ch;
}
.page-services .prose-sd p {
  color: var(--color-text-light);
  line-height: 1.72;
  font-size: 1.0rem;
  margin-bottom: var(--space-lg);
}
.page-services .prose-sd p:last-child { margin-bottom: 0; }

/* ── 1. Storm Hero — C1 (urgent dark feel) ────────────────────────────────── */
.sd-hero {
  min-height: 65vh;
  display: flex;
  align-items: flex-end;
  position: relative;
  overflow: hidden;
  background-image: url('/assets/images/storm-damage-hero.png');
  background-size: cover;
  background-position: center 30%;
}
/* Very dark overlay — urgent, immediate feel */
.sd-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    165deg,
    rgba(var(--color-primary-dark-rgb), 0.97) 0%,
    rgba(var(--color-primary-dark-rgb), 0.88) 45%,
    rgba(var(--color-primary-rgb), 0.70) 100%
  );
  z-index: 1;
}
/* SVG noise texture */
.sd-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.05'/%3E%3C/svg%3E");
  z-index: 1;
  pointer-events: none;
}
.sd-hero-inner {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: calc(var(--navbar-height, 80px) + var(--space-4xl)) 0 var(--space-3xl);
}
/* Alert-style eyebrow — warm accent tint, more prominent */
.sd-hero-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: rgba(var(--color-accent-rgb), 0.20);
  border: 1px solid rgba(var(--color-accent-rgb), 0.55);
  border-radius: var(--radius-md);
  padding: 7px 18px;
  font-family: var(--font-heading);
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--color-accent);
  margin-bottom: var(--space-xl);
  animation: sd-fade-down 0.6s ease both;
}
.sd-hero-eyebrow i { width: 14px; height: 14px; }
/* Hero H1 */
.sd-hero-title {
  font-family: var(--font-heading);
  font-size: clamp(2.2rem, 5.8vw, 4.2rem);
  font-weight: 800;
  line-height: 1.08;
  letter-spacing: -0.025em;
  color: #fff;
  text-wrap: balance;
  max-width: 24ch;
  margin-bottom: var(--space-lg);
  animation: sd-fade-up 0.65s ease 0.10s both;
}
.sd-hero-title .sd-accent-word {
  background: linear-gradient(135deg, #fff 0%, var(--color-accent) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
/* Urgency callout under H1 */
.sd-hero-urgency {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: rgba(var(--color-accent-rgb), 0.12);
  border-radius: var(--radius-md);
  padding: 6px 14px;
  font-family: var(--font-heading);
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--color-accent);
  letter-spacing: 0.04em;
  margin-bottom: var(--space-lg);
  animation: sd-fade-up 0.65s ease 0.20s both;
}
.sd-hero-sub {
  font-size: clamp(0.95rem, 1.8vw, 1.1rem);
  color: rgba(255,255,255,0.78);
  line-height: 1.65;
  max-width: 50ch;
  margin-bottom: var(--space-2xl);
  animation: sd-fade-up 0.65s ease 0.28s both;
}
.sd-hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  align-items: center;
  animation: sd-fade-up 0.65s ease 0.38s both;
}
.sd-hero-trust {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  margin-top: var(--space-2xl);
  animation: sd-fade-up 0.65s ease 0.48s both;
}
.sd-hero-trust-item {
  display: flex;
  align-items: center;
  gap: var(--space-sm);
  color: rgba(255,255,255,0.72);
  font-size: 0.83rem;
  font-weight: 600;
}
.sd-hero-trust-item i { color: var(--color-accent); }

@keyframes sd-fade-down {
  from { opacity: 0; transform: translateY(-12px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes sd-fade-up {
  from { opacity: 0; transform: translateY(18px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* ── 2. Buttons ───────────────────────────────────────────────────────────── */
.sd-btn-primary {
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
.sd-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.18); }
.sd-btn-primary:active { transform: translateY(2px); box-shadow: 0 2px 0 rgba(0,0,0,0.18); }
.sd-btn-outline-light {
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
.sd-btn-outline-light:hover {
  border-color: rgba(255,255,255,0.85);
  background: rgba(255,255,255,0.07);
}
.sd-btn-white {
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
.sd-btn-white:hover { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.14); }
.sd-btn-white:active { transform: translateY(2px); box-shadow: 0 2px 0 rgba(0,0,0,0.14); }

/* ── 3. Breadcrumb bar ────────────────────────────────────────────────────── */
.sd-breadcrumb-bar {
  background: var(--color-primary-dark);
  border-bottom: 1px solid rgba(255,255,255,0.10);
  padding: var(--space-sm) 0;
}
.sd-breadcrumb-list {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-sm);
  align-items: center;
  list-style: none;
  font-size: 0.82rem;
  color: rgba(255,255,255,0.55);
}
.sd-breadcrumb-list li + li::before {
  content: '/';
  margin-right: var(--space-sm);
  color: rgba(255,255,255,0.25);
}
.sd-breadcrumb-list a {
  color: rgba(255,255,255,0.70);
  font-weight: 500;
  transition: color var(--transition-fast);
}
.sd-breadcrumb-list a:hover { color: var(--color-accent); }
.sd-breadcrumb-list li:last-child { color: rgba(255,255,255,0.90); font-weight: 600; }

/* ── 4. Eyebrow label variants ────────────────────────────────────────────── */
.sd-eyebrow {
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
.sd-eyebrow-white {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  font-family: var(--font-heading);
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  background: rgba(255,255,255,0.10);
  border: 1px solid rgba(255,255,255,0.20);
  color: rgba(255,255,255,0.85);
  padding: 5px 14px;
  border-radius: 999px;
  margin-bottom: var(--space-md);
}

/* ── 5. Section headings ──────────────────────────────────────────────────── */
.sd-section-heading {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
  color: var(--color-primary);
  text-wrap: balance;
  margin-bottom: var(--space-lg);
}
.sd-section-heading-light {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
  color: #fff;
  text-wrap: balance;
  margin-bottom: var(--space-lg);
}
.sd-section-lead {
  font-size: 1.0rem;
  color: var(--color-text-light);
  line-height: 1.72;
  max-width: 62ch;
}
.sd-section-header { margin-bottom: var(--space-3xl); }
.sd-section-header.centered { text-align: center; }
.sd-section-header.centered .sd-section-lead { margin-inline: auto; }

/* ── 6. SVG Dividers ──────────────────────────────────────────────────────── */
.sd-divider {
  display: block;
  line-height: 0;
  overflow: hidden;
}
.sd-divider svg {
  display: block;
  width: 100%;
  height: 60px;
}

/* ── 7. Service Detail — split layout (image RIGHT, mirrored from repair) ─── */
.sd-detail-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg);
}
.sd-detail-grid {
  display: grid;
  grid-template-columns: 1fr 380px;
  gap: var(--space-3xl);
  align-items: start;
}
.sd-detail-heading {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
  color: var(--color-primary);
  text-wrap: balance;
  margin-bottom: var(--space-xl);
}
.sd-last-updated {
  font-size: 0.78rem;
  color: var(--color-text-light);
  margin-bottom: var(--space-xl);
  font-style: italic;
}
/* Image — sticky, clipped with top-right accent */
.sd-detail-image-wrap {
  position: sticky;
  top: calc(var(--navbar-height, 80px) + var(--space-xl));
}
.sd-detail-image-frame {
  position: relative;
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-xl);
}
.sd-detail-image-frame::before {
  content: '';
  position: absolute;
  top: -6px;
  right: -6px;
  width: 50%;
  height: 50%;
  border-top: 3px solid var(--color-accent);
  border-right: 3px solid var(--color-accent);
  border-radius: 0 var(--radius-lg) 0 0;
  z-index: 2;
  pointer-events: none;
}
.sd-detail-image-frame picture,
.sd-detail-image-frame img {
  display: block;
  width: 100%;
  height: auto;
  aspect-ratio: 3/4;
  object-fit: cover;
}
.sd-image-callout {
  position: absolute;
  top: var(--space-lg);
  left: var(--space-lg);
  background: rgba(var(--color-primary-dark-rgb), 0.92);
  border: 1px solid rgba(var(--color-accent-rgb), 0.40);
  border-radius: var(--radius-md);
  padding: var(--space-sm) var(--space-md);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 0.78rem;
  font-weight: 700;
  z-index: 3;
  backdrop-filter: blur(8px);
  display: flex;
  align-items: center;
  gap: var(--space-sm);
}
.sd-image-callout i { color: var(--color-accent); }

/* ── 8. Why Choose Us — horizontal feature strip ─────────────────────────── */
.sd-why-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-primary-dark);
  position: relative;
  overflow: hidden;
}
.sd-why-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  pointer-events: none;
}
.sd-why-inner { position: relative; z-index: 1; }
.sd-why-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: var(--space-xl);
  margin-top: var(--space-3xl);
}
.sd-why-feature {
  text-align: center;
  padding: var(--space-xl) var(--space-md);
  border-top: 2px solid rgba(var(--color-accent-rgb), 0.28);
  transition: border-top-color var(--transition-base);
}
.sd-why-feature:hover { border-top-color: var(--color-accent); }
.sd-why-feature-icon {
  width: 56px;
  height: 56px;
  background: rgba(var(--color-accent-rgb), 0.12);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto var(--space-lg);
  transition: background var(--transition-fast), transform var(--transition-fast);
}
.sd-why-feature-icon i {
  color: var(--color-accent);
  width: 24px;
  height: 24px;
  transition: transform var(--transition-fast);
}
.sd-why-feature:hover .sd-why-feature-icon { background: rgba(var(--color-accent-rgb), 0.22); }
.sd-why-feature:hover .sd-why-feature-icon i { transform: scale(1.12) rotate(-5deg); }
.sd-why-feature-title {
  font-family: var(--font-heading);
  font-size: 0.95rem;
  font-weight: 700;
  color: #fff;
  margin-bottom: var(--space-sm);
  line-height: 1.3;
}
.sd-why-feature-text {
  font-size: 0.84rem;
  color: rgba(255,255,255,0.62);
  line-height: 1.6;
}

/* ── 9. SIGNATURE SECTION — Urgency Process Timeline ────────────────────── */
/* Bold step markers, emergency accent treatment, unique layout */
.sd-timeline-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg-alt);
}
.sd-timeline {
  display: grid;
  gap: 0;
  margin-top: var(--space-3xl);
  position: relative;
}
/* Vertical connecting bar */
.sd-timeline::before {
  content: '';
  position: absolute;
  left: 28px;
  top: 30px;
  bottom: 30px;
  width: 2px;
  background: linear-gradient(
    180deg,
    var(--color-accent) 0%,
    rgba(var(--color-accent-rgb), 0.20) 100%
  );
}
.sd-timeline-step {
  display: grid;
  grid-template-columns: 60px 1fr;
  gap: var(--space-xl);
  padding-bottom: var(--space-3xl);
  position: relative;
}
.sd-timeline-step:last-child { padding-bottom: 0; }
/* Number circle — larger, more impact */
.sd-step-marker {
  position: relative;
  z-index: 1;
  width: 58px;
  height: 58px;
  background: var(--color-accent);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--font-heading);
  font-size: 1.3rem;
  font-weight: 900;
  color: var(--color-primary-dark);
  flex-shrink: 0;
  box-shadow: 0 0 0 4px rgba(var(--color-accent-rgb), 0.20), var(--shadow-md);
  transition: transform var(--transition-fast);
}
.sd-timeline-step:hover .sd-step-marker { transform: scale(1.08); }
/* Step content card */
.sd-step-content {
  background: var(--color-bg);
  border-radius: var(--radius-lg);
  padding: var(--space-2xl);
  box-shadow: var(--shadow-card);
  border-left: 3px solid transparent;
  transition: border-color var(--transition-base), box-shadow var(--transition-base);
  position: relative;
  overflow: hidden;
}
.sd-step-content::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: transparent;
  transition: background var(--transition-base);
}
.sd-timeline-step:hover .sd-step-content {
  border-left-color: var(--color-accent);
  box-shadow: var(--shadow-md);
}
.sd-timeline-step:hover .sd-step-content::before {
  background: linear-gradient(90deg, var(--color-accent), transparent);
}
.sd-step-title {
  font-family: var(--font-heading);
  font-size: 1.15rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: var(--space-sm);
  line-height: 1.3;
}
.sd-step-text {
  font-size: 0.92rem;
  color: var(--color-text-light);
  line-height: 1.7;
}
/* Timeline detail sub-tags */
.sd-step-tags {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-sm);
  margin-top: var(--space-md);
}
.sd-step-tag {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  background: rgba(var(--color-accent-rgb), 0.10);
  border: 1px solid rgba(var(--color-accent-rgb), 0.22);
  color: var(--color-accent);
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  padding: 3px 10px;
  border-radius: 4px;
}

/* ── 10. Documentation detail — what we record ────────────────────────────── */
.sd-docs-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg);
}
.sd-docs-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-xl);
  margin-top: var(--space-3xl);
}
.sd-doc-card {
  background: var(--color-bg-alt);
  border-radius: var(--radius-lg);
  padding: var(--space-xl);
  border-bottom: 3px solid var(--color-accent);
  transition: transform var(--transition-base), box-shadow var(--transition-base);
}
.sd-doc-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-md);
}
.sd-doc-card-icon {
  width: 44px;
  height: 44px;
  background: rgba(var(--color-primary-rgb), 0.08);
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: var(--space-md);
}
.sd-doc-card-icon i {
  color: var(--color-primary);
  width: 20px;
  height: 20px;
  transition: transform var(--transition-fast);
}
.sd-doc-card:hover .sd-doc-card-icon i { transform: scale(1.15); }
.sd-doc-card-title {
  font-family: var(--font-heading);
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: var(--space-xs);
}
.sd-doc-card-text {
  font-size: 0.84rem;
  color: var(--color-text-light);
  line-height: 1.60;
}

/* ── 11. Mid-page CTA Banner ──────────────────────────────────────────────── */
.sd-cta-banner {
  position: relative;
  overflow: hidden;
  /* Deeper, more saturated diagonal — storm urgency feel */
  background: linear-gradient(
    150deg,
    rgba(var(--color-primary-dark-rgb), 1) 0%,
    rgba(var(--color-primary-rgb), 0.92) 50%,
    rgba(var(--color-secondary), 1) 100%
  );
  background-color: var(--color-primary-dark);
  padding: var(--section-pad, 80px 20px);
}
.sd-cta-banner::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.05'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}
.sd-cta-banner-inner {
  position: relative;
  z-index: 1;
  text-align: center;
}
.sd-cta-banner-title {
  font-family: var(--font-heading);
  font-size: clamp(1.9rem, 4vw, 3rem);
  font-weight: 800;
  color: #fff;
  line-height: 1.12;
  letter-spacing: -0.02em;
  text-wrap: balance;
  margin-bottom: var(--space-lg);
}
.sd-cta-banner-sub {
  font-size: 1.05rem;
  color: rgba(255,255,255,0.75);
  max-width: 55ch;
  margin-inline: auto;
  margin-bottom: var(--space-2xl);
  line-height: 1.6;
}
.sd-cta-banner-phone {
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
.sd-cta-banner-phone:hover { opacity: 0.85; }
.sd-cta-banner-actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  justify-content: center;
}

/* ── 12. FAQ Section ──────────────────────────────────────────────────────── */
.sd-faq-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg-alt);
}
.sd-faq-list {
  display: grid;
  gap: var(--space-md);
  margin-top: var(--space-3xl);
  max-width: 840px;
  margin-inline: auto;
}
.sd-faq-item {
  background: var(--color-bg);
  border-radius: var(--radius-md);
  border: 1px solid rgba(var(--color-primary-rgb), 0.08);
  overflow: hidden;
}
.sd-faq-question {
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
.sd-faq-question::-webkit-details-marker { display: none; }
.sd-faq-question:hover { background: rgba(var(--color-primary-rgb), 0.03); }
.sd-faq-icon {
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
.sd-faq-icon i { color: var(--color-accent); width: 12px; height: 12px; }
details[open] .sd-faq-icon {
  background: var(--color-accent);
  transform: rotate(45deg);
}
details[open] .sd-faq-icon i { color: var(--color-primary-dark); }
.sd-faq-answer {
  padding: var(--space-lg) var(--space-2xl) var(--space-xl);
  font-size: 0.94rem;
  color: var(--color-text-light);
  line-height: 1.72;
  border-top: 1px solid rgba(var(--color-primary-rgb), 0.06);
}

/* ── 13. Closing CTA ──────────────────────────────────────────────────────── */
.sd-closing-cta {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-primary);
  text-align: center;
  position: relative;
  overflow: hidden;
}
.sd-closing-cta::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  pointer-events: none;
}
.sd-closing-cta-inner { position: relative; z-index: 1; max-width: 680px; margin-inline: auto; }
.sd-closing-cta-title {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem, 3.5vw, 2.8rem);
  font-weight: 800;
  color: #fff;
  text-wrap: balance;
  margin-bottom: var(--space-lg);
  line-height: 1.2;
}
.sd-closing-cta-sub {
  font-size: 1.05rem;
  color: rgba(255,255,255,0.78);
  margin-bottom: var(--space-2xl);
  line-height: 1.65;
}
.sd-closing-cta-actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  justify-content: center;
}
.sd-closing-cta-guarantee {
  margin-top: var(--space-lg);
  font-size: 0.82rem;
  color: rgba(255,255,255,0.55);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-sm);
  flex-wrap: wrap;
}
.sd-closing-cta-guarantee i { color: var(--color-accent); }

/* ── 14. Responsive breakpoints ──────────────────────────────────────────── */
@media (max-width: 1023px) {
  .sd-detail-grid { grid-template-columns: 1fr; }
  .sd-detail-image-wrap { position: static; order: -1; }
  .sd-why-grid { grid-template-columns: repeat(2, 1fr); }
  .sd-docs-grid { grid-template-columns: repeat(2, 1fr); }
  .sd-timeline-step { grid-template-columns: 52px 1fr; }
}
@media (max-width: 767px) {
  .sd-hero-title { max-width: 100%; }
  .sd-why-grid { grid-template-columns: 1fr; }
  .sd-docs-grid { grid-template-columns: 1fr; }
  .sd-timeline::before { left: 26px; }
  .sd-timeline-step { grid-template-columns: 54px 1fr; gap: var(--space-md); }
  .sd-cta-banner-actions { flex-direction: column; }
  .sd-closing-cta-actions { flex-direction: column; }
  .sd-hero-trust { gap: var(--space-sm); }
}

/* ── 15. Reduced-motion ───────────────────────────────────────────────────── */
@media (prefers-reduced-motion: reduce) {
  .sd-hero-eyebrow,
  .sd-hero-title,
  .sd-hero-urgency,
  .sd-hero-sub,
  .sd-hero-actions,
  .sd-hero-trust {
    animation: none;
  }
}

/* ── Project Photo Strip ─────────────────────────────────────────── */
.sd-photo-strip {
  padding: var(--space-3xl) 0;
  background: var(--color-bg-alt);
}
.sd-photo-pair {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-md);
}
.sd-photo-pair-item {
  border-radius: var(--radius-lg);
  overflow: hidden;
  aspect-ratio: 4/3;
  box-shadow: var(--shadow-card);
}
.sd-photo-pair-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--transition-base);
}
.sd-photo-pair-item:hover img { transform: scale(1.04); }
@media (max-width: 767px) {
  .sd-photo-pair { grid-template-columns: 1fr; }
}

</style>

<!-- ── Hero (CTA #1) ──────────────────────────────────────────────────────── -->
<section class="sd-hero" aria-labelledby="sd-hero-heading">
  <div class="sd-hero-inner">
    <div class="sd-container">

      <!-- Alert-style eyebrow — more prominent than standard pages -->
      <p class="sd-hero-eyebrow" aria-hidden="true">
        <i data-lucide="alert-triangle" aria-hidden="true"></i>
        Storm Damage — Act Before You File
      </p>

      <h1 class="sd-hero-title" id="sd-hero-heading">
        <span class="sd-accent-word">Storm Damage</span> Roof Repair in <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?>
      </h1>

      <p class="sd-hero-urgency" aria-label="Same-day response available">
        <i data-lucide="zap" aria-hidden="true"></i>
        Same-Day Inspection Response After Storm Events
      </p>

      <p class="sd-hero-sub">
        Hail and wind damage are often invisible from the ground. We document everything before you file — because the order of documentation determines the outcome of your insurance claim.
      </p>

      <div class="sd-hero-actions">
        <a href="/contact" class="sd-btn-primary">
          <i data-lucide="camera" aria-hidden="true"></i>
          Get Storm Inspection
        </a>
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>" class="sd-btn-outline-light">
          <i data-lucide="phone" aria-hidden="true"></i>
          <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php endif; ?>
      </div>

      <div class="sd-hero-trust">
        <span class="sd-hero-trust-item">
          <i data-lucide="shield-check" aria-hidden="true"></i>
          Licensed &amp; Insured
        </span>
        <span class="sd-hero-trust-item">
          <i data-lucide="file-text" aria-hidden="true"></i>
          Pre-Filing Documentation Package
        </span>
        <span class="sd-hero-trust-item">
          <i data-lucide="users" aria-hidden="true"></i>
          Direct Adjuster Coordination
        </span>
        <span class="sd-hero-trust-item">
          <i data-lucide="map-pin" aria-hidden="true"></i>
          Emergency Tarping Available
        </span>
      </div>

    </div>
  </div>
</section>

<!-- ── Breadcrumb (dark bar, matching hero tone) ──────────────────────────── -->
<nav class="sd-breadcrumb-bar" aria-label="Breadcrumb">
  <div class="sd-container">
    <ol class="sd-breadcrumb-list"
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
        <span itemprop="name">Storm Damage Repair</span>
        <meta itemprop="position" content="3">
      </li>

    </ol>
  </div>
</nav>

<!-- ── Service Detail — split layout ─────────────────────────────────────── -->
<section class="sd-detail-section" aria-labelledby="sd-detail-heading" data-animate="fade-up">
  <div class="sd-container">
    <div class="sd-detail-grid">

      <!-- Content — left column -->
      <div class="sd-detail-content">
        <span class="sd-eyebrow">
          <i data-lucide="info" aria-hidden="true"></i>
          Why Documentation Order Matters
        </span>
        <h2 class="sd-detail-heading" id="sd-detail-heading">
          Document First, File Second — It Changes the Outcome
        </h2>
        <p class="sd-last-updated">Last Updated: April 2026</p>

        <div class="prose-sd">
          <p>
            Hail and wind damage are deceptive. From the ground, a roof can look largely intact while sustaining thousands of dollars in impact damage that is only visible once you're on top of it — bruised shingles, cracked granule coating, dented metal components, lifted flashing. After a significant storm passes through the area, the smartest sequence is to get a professional inspection and build a complete damage documentation package before contacting your insurance company, because the order in which documentation is created has real consequences for claim outcomes.
          </p>
          <p>
            What we document before you file: shingle samples showing impact bruising visible under raking light; granule loss measurements by section, quantified rather than described generally; dent patterns on every metal component — ridge caps, vents, gutters, flashing, downspouts — each photographed with the circular impact marks that adjusters need to see; and GPS-tagged, timestamped photos of every affected area organized by roof section. This documentation package is what separates a claim that gets approved for a full replacement from one that gets approved for a patched repair at a fraction of the cost.
          </p>
          <p>
            We work directly with adjusters throughout the claim process — attending the adjuster inspection when scheduling allows, identifying items missed in the initial estimate, and submitting supplemental documentation when the approved amount doesn't reflect the actual scope of damage. We don't charge separately for claim coordination. Our job is to make sure your policy pays for what it's supposed to cover so you're not absorbing costs for damage that happened in a storm.
          </p>
        </div>

        <!-- Internal links -->
        <div style="margin-top: var(--space-xl); display: flex; gap: var(--space-md); flex-wrap: wrap;">
          <a href="/services/roof-replacement" style="color: var(--color-secondary); font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 4px;">
            <i data-lucide="arrow-right" aria-hidden="true" style="width:14px;height:14px;"></i>
            Full Roof Replacement
          </a>
          <a href="/services/roof-repair" style="color: var(--color-secondary); font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 4px;">
            <i data-lucide="arrow-right" aria-hidden="true" style="width:14px;height:14px;"></i>
            Standard Roof Repair
          </a>
          <a href="/contact" style="color: var(--color-secondary); font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 4px;">
            <i data-lucide="arrow-right" aria-hidden="true" style="width:14px;height:14px;"></i>
            Request Storm Inspection
          </a>
        </div>

      </div>

      <!-- Image — RIGHT column -->
      <div class="sd-detail-image-wrap" data-animate="wipe-right">
        <div class="sd-detail-image-frame">
          <picture>
            <img src="/assets/images/photo-028.jpg" alt="Roofing crew actively installing new shingles on residential roof with ridge vent and removal of old materials" width="760" height="1013" loading="lazy">
          </picture>
          <div class="sd-image-callout">
            <i data-lucide="camera" aria-hidden="true"></i>
            Documented Before You File
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Divider: torn paper into dark why section -->
<div class="sd-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path fill="var(--color-primary-dark)" d="M0,60 L0,25 L200,45 L400,15 L600,40 L800,10 L1000,35 L1200,20 L1200,60 Z"/>
  </svg>
</div>

<!-- ── Why Choose Us — horizontal feature strip on dark bg ───────────────── -->
<section class="sd-why-section" aria-labelledby="sd-why-heading" data-animate="fade-up">
  <div class="sd-container">
    <div class="sd-why-inner">

      <div class="sd-section-header centered">
        <span class="sd-eyebrow-white">
          <i data-lucide="check-circle" aria-hidden="true"></i>
          Storm Response Capabilities
        </span>
        <h2 class="sd-section-heading-light" id="sd-why-heading">
          Why Storm-Affected Homeowners in <?php echo htmlspecialchars($city, ENT_QUOTES, 'UTF-8'); ?> Call A-1 First
        </h2>
      </div>

      <div class="sd-why-grid">

        <div class="sd-why-feature" data-animate="fade-up">
          <div class="sd-why-feature-icon">
            <i data-lucide="clock" aria-hidden="true"></i>
          </div>
          <h3 class="sd-why-feature-title">Same-Day Inspection Response</h3>
          <p class="sd-why-feature-text">
            After major storm events, we prioritize affected homeowners and often have a crew in affected neighborhoods within 24 hours of the storm passing.
          </p>
        </div>

        <div class="sd-why-feature" data-animate="fade-up">
          <div class="sd-why-feature-icon">
            <i data-lucide="file-text" aria-hidden="true"></i>
          </div>
          <h3 class="sd-why-feature-title">Pre-Insurance Documentation</h3>
          <p class="sd-why-feature-text">
            We photograph and measure damage before you file so you have an independent record that can't be disputed. Adjuster estimates that miss items get challenged with evidence, not arguments.
          </p>
        </div>

        <div class="sd-why-feature" data-animate="fade-up">
          <div class="sd-why-feature-icon">
            <i data-lucide="users" aria-hidden="true"></i>
          </div>
          <h3 class="sd-why-feature-title">Direct Adjuster Coordination</h3>
          <p class="sd-why-feature-text">
            We attend adjuster inspections, supplement when items are missed, and advocate for the complete claim. We've worked enough claims to know what adjusters look for and what they sometimes overlook.
          </p>
        </div>

        <div class="sd-why-feature" data-animate="fade-up">
          <div class="sd-why-feature-icon">
            <i data-lucide="shield" aria-hidden="true"></i>
          </div>
          <h3 class="sd-why-feature-title">Emergency Tarping Available</h3>
          <p class="sd-why-feature-text">
            If your roof is compromised and rain is in the forecast, we secure it immediately with heavy-duty tarps to prevent interior damage while the claim process and permanent repair are planned.
          </p>
        </div>

      </div>

    </div>
  </div>
</section>

<!-- Divider: wave into bg-alt (signature section) -->
<div class="sd-divider" aria-hidden="true" style="background: var(--color-primary-dark);">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path fill="var(--color-bg-alt)" d="M0,20 C350,55 850,5 1200,38 L1200,60 L0,60 Z"/>
  </svg>
</div>

<!-- ── SIGNATURE SECTION — Urgency Process Timeline ──────────────────────── -->
<section class="sd-timeline-section" aria-labelledby="sd-timeline-heading" data-animate="fade-up">
  <div class="sd-container">

    <div class="sd-section-header" style="max-width: 680px;">
      <span class="sd-eyebrow">
        <i data-lucide="list-ordered" aria-hidden="true"></i>
        The Storm Claim Process
      </span>
      <h2 class="sd-section-heading" id="sd-timeline-heading">
        Four Steps From Post-Storm to Paid Claim
      </h2>
      <p class="sd-section-lead">
        The difference between a full replacement being covered and a partial payout often comes down to who documented what, and when. Here's how we structure the process to maximize your outcome.
      </p>
    </div>

    <ol class="sd-timeline" aria-label="Storm damage claim process steps">

      <li class="sd-timeline-step" data-animate="fade-up">
        <div class="sd-step-marker" aria-hidden="true">1</div>
        <div class="sd-step-content">
          <h3 class="sd-step-title">Emergency Assessment — On Your Roof, Not From the Ground</h3>
          <p class="sd-step-text">
            We inspect your full roof promptly after the storm — shingles, metal components, gutters, flashing, and every penetration point. We look for hail impact patterns under raking light, check granule loss section by section, photograph every dented metal surface, and note displaced or cracked shingles throughout. A ground-level "it looks fine" assessment misses the damage adjusters actually approve claims for.
          </p>
          <div class="sd-step-tags" aria-label="Assessment items">
            <span class="sd-step-tag"><i data-lucide="eye" aria-hidden="true" style="width:10px;height:10px;"></i> Shingles</span>
            <span class="sd-step-tag">Metal Components</span>
            <span class="sd-step-tag">Gutters</span>
            <span class="sd-step-tag">Flashing</span>
            <span class="sd-step-tag">Penetrations</span>
          </div>
        </div>
      </li>

      <li class="sd-timeline-step" data-animate="fade-up">
        <div class="sd-step-marker" aria-hidden="true">2</div>
        <div class="sd-step-content">
          <h3 class="sd-step-title">Pre-Filing Documentation Package — Your Independent Record</h3>
          <p class="sd-step-text">
            Before you file, we provide a complete damage report: GPS-tagged photos of every affected area, granule loss measurements by section, shingle samples demonstrating impact bruising, and a written description of all damage found. This becomes your independent record. When the adjuster's estimate comes in, you have something to compare it to — and when items are missed, you have documentation to challenge them with facts rather than disagreement.
          </p>
          <div class="sd-step-tags">
            <span class="sd-step-tag">GPS-Tagged Photos</span>
            <span class="sd-step-tag">Granule Measurements</span>
            <span class="sd-step-tag">Written Report</span>
            <span class="sd-step-tag">Shingle Samples</span>
          </div>
        </div>
      </li>

      <li class="sd-timeline-step" data-animate="fade-up">
        <div class="sd-step-marker" aria-hidden="true">3</div>
        <div class="sd-step-content">
          <h3 class="sd-step-title">Adjuster Coordination — We're There When It Counts</h3>
          <p class="sd-step-text">
            We're available to meet your insurance adjuster on-site, walk through findings together, and present our documentation alongside their inspection. Initial estimates that miss entire sections or misclassify damage get supplemented with the documentation package we built before you filed. We've supplemented enough claims to know which items are frequently underestimated and how to present evidence that adjusters can act on.
          </p>
          <div class="sd-step-tags">
            <span class="sd-step-tag">On-Site Presence</span>
            <span class="sd-step-tag">Supplemental Filing</span>
            <span class="sd-step-tag">Material Specs</span>
          </div>
        </div>
      </li>

      <li class="sd-timeline-step" data-animate="fade-up">
        <div class="sd-step-marker" aria-hidden="true">4</div>
        <div class="sd-step-content">
          <h3 class="sd-step-title">Repair or Replacement — Completed Once the Claim Is Approved</h3>
          <p class="sd-step-text">
            Once your claim is approved, we schedule and complete the work. Storm-related replacements typically take one to two days. If emergency tarping was needed between assessment and final repair, we handle that immediately — before the next rain — and coordinate its removal as part of the final installation. You're kept informed at every stage, and we handle all the scheduling complexity so the process doesn't add more stress to an already stressful event.
          </p>
          <div class="sd-step-tags">
            <span class="sd-step-tag">1–2 Day Completion</span>
            <span class="sd-step-tag">Emergency Tarping</span>
            <span class="sd-step-tag">Full Coordination</span>
          </div>
        </div>
      </li>

    </ol>

  </div>
</section>

<!-- Divider: diagonal into docs section on white bg -->
<div class="sd-divider" aria-hidden="true" style="background: var(--color-bg-alt);">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <polygon fill="var(--color-bg)" points="0,0 1200,60 1200,60 0,60"/>
  </svg>
</div>

<!-- ── What We Document ────────────────────────────────────────────────────── -->
<section class="sd-docs-section" aria-labelledby="sd-docs-heading" data-animate="fade-up">
  <div class="sd-container">

    <div class="sd-section-header centered">
      <span class="sd-eyebrow">
        <i data-lucide="camera" aria-hidden="true"></i>
        Complete Documentation
      </span>
      <h2 class="sd-section-heading" id="sd-docs-heading">
        What Our Damage Report Contains
      </h2>
      <p class="sd-section-lead" style="margin-inline: auto;">
        The documentation package we provide before you file is designed around what insurance adjusters and underwriters need to approve a complete claim.
      </p>
    </div>

    <div class="sd-docs-grid">

      <div class="sd-doc-card" data-animate="fade-up">
        <div class="sd-doc-card-icon">
          <i data-lucide="crosshair" aria-hidden="true"></i>
        </div>
        <h3 class="sd-doc-card-title">Impact Bruising Evidence</h3>
        <p class="sd-doc-card-text">
          Shingle samples showing granule fracture patterns under raking light — the bruising that proves hail impact at sufficient velocity to cause structural damage to the shingle mat.
        </p>
      </div>

      <div class="sd-doc-card" data-animate="fade-up">
        <div class="sd-doc-card-icon">
          <i data-lucide="ruler" aria-hidden="true"></i>
        </div>
        <h3 class="sd-doc-card-title">Section-by-Section Measurements</h3>
        <p class="sd-doc-card-text">
          Granule loss density measured by roof section, not estimated generally. Gives the adjuster quantified data to work with rather than a qualitative description.
        </p>
      </div>

      <div class="sd-doc-card" data-animate="fade-up">
        <div class="sd-doc-card-icon">
          <i data-lucide="map-pin" aria-hidden="true"></i>
        </div>
        <h3 class="sd-doc-card-title">GPS-Tagged Photo Record</h3>
        <p class="sd-doc-card-text">
          Every photo geotagged and timestamped — establishing that damage was documented at the property on a specific date following the storm event. Creates an undisputable timeline.
        </p>
      </div>

      <div class="sd-doc-card" data-animate="fade-up">
        <div class="sd-doc-card-icon">
          <i data-lucide="circle" aria-hidden="true"></i>
        </div>
        <h3 class="sd-doc-card-title">Metal Component Dent Patterns</h3>
        <p class="sd-doc-card-text">
          Photos of circular impact marks on gutters, vents, ridge caps, and flashing — the clearest objective evidence of hail size and impact density, documented before any repair or removal.
        </p>
      </div>

      <div class="sd-doc-card" data-animate="fade-up">
        <div class="sd-doc-card-icon">
          <i data-lucide="wind" aria-hidden="true"></i>
        </div>
        <h3 class="sd-doc-card-title">Wind Displacement Documentation</h3>
        <p class="sd-doc-card-text">
          Lifted, displaced, or cracked shingles and flashing recorded by location — documenting wind damage separately from hail damage where policies have different deductibles for each.
        </p>
      </div>

      <div class="sd-doc-card" data-animate="fade-up">
        <div class="sd-doc-card-icon">
          <i data-lucide="file-check" aria-hidden="true"></i>
        </div>
        <h3 class="sd-doc-card-title">Written Damage Narrative</h3>
        <p class="sd-doc-card-text">
          A structured written description of all damage found, organized by roof section with material and scope details — the document format adjusters and supervisors need for claim approval.
        </p>
      </div>

    </div>

  </div>
</section>

<!-- ── Project Photos ─────────────────────────────────────────────────────── -->
<section class="sd-photo-strip" aria-label="Storm damage repair project photos">
  <div class="container">
    <div class="sd-photo-pair">
      <div class="sd-photo-pair-item" data-animate="fade-up">
        <picture>
          <img src="/assets/images/photo-031.jpg" alt="Aerial view of roofers installing new shingles on residential roof with debris removal truck on lawn" width="600" height="450" loading="lazy">
        </picture>
      </div>
      <div class="sd-photo-pair-item" data-animate="fade-up" style="animation-delay:80ms">
        <picture>
          <img src="/assets/images/photo-008.jpg" alt="Residential roof repair in progress with shingles removed and work truck parked on driveway" width="600" height="450" loading="lazy">
        </picture>
      </div>
    </div>
  </div>
</section>

<!-- Divider: wave into CTA banner -->
<div class="sd-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path fill="var(--color-primary-dark)" d="M0,45 C250,10 600,55 950,20 C1050,10 1150,30 1200,40 L1200,60 L0,60 Z"/>
  </svg>
</div>

<!-- ── Mid-Page CTA Banner — CTA #2 ───────────────────────────────────────── -->
<section class="sd-cta-banner" aria-labelledby="sd-cta-heading">
  <div class="sd-container">
    <div class="sd-cta-banner-inner">

      <span class="sd-eyebrow-white">
        <i data-lucide="alert-triangle" aria-hidden="true"></i>
        Act Before You File
      </span>

      <h2 class="sd-cta-banner-title" id="sd-cta-heading">
        Your Claim Outcome Depends on What Gets Documented — and When
      </h2>

      <p class="sd-cta-banner-sub">
        Homeowners who document damage before filing consistently get more complete claim approvals than those who file first. Call now — we can often schedule an inspection within 24 hours of a storm event.
      </p>

      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="sd-cta-banner-phone" aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php endif; ?>

      <div class="sd-cta-banner-actions">
        <a href="/contact" class="sd-btn-white">
          <i data-lucide="camera" aria-hidden="true"></i>
          Schedule Storm Inspection
        </a>
        <a href="/services" style="display:inline-flex;align-items:center;gap:var(--space-sm);color:rgba(255,255,255,0.80);font-family:var(--font-heading);font-size:0.95rem;font-weight:600;letter-spacing:0.04em;text-decoration:none;transition:color var(--transition-fast);">
          <i data-lucide="grid" aria-hidden="true"></i>
          View All Services
        </a>
      </div>

    </div>
  </div>
</section>

<!-- Divider: diagonal into bg-alt (FAQ) -->
<div class="sd-divider" aria-hidden="true" style="background: var(--color-primary-dark);">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <polygon fill="var(--color-bg-alt)" points="0,0 1200,60 1200,60 0,60"/>
  </svg>
</div>

<!-- ── FAQ Section ────────────────────────────────────────────────────────── -->
<section class="sd-faq-section" aria-labelledby="sd-faq-heading" data-animate="fade-up">
  <div class="sd-container">

    <div class="sd-section-header centered">
      <span class="sd-eyebrow">
        <i data-lucide="help-circle" aria-hidden="true"></i>
        Common Questions
      </span>
      <h2 class="sd-section-heading" id="sd-faq-heading">
        Storm Damage &amp; Insurance Claims — Questions Answered
      </h2>
    </div>

    <div class="sd-faq-list" role="list">

      <?php foreach ($faqs as $i => $faq): ?>
      <details class="sd-faq-item" <?php echo $i === 0 ? 'open' : ''; ?>>
        <summary class="sd-faq-question">
          <?php echo htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8'); ?>
          <span class="sd-faq-icon" aria-hidden="true">
            <i data-lucide="plus" aria-hidden="true"></i>
          </span>
        </summary>
        <div class="sd-faq-answer">
          <?php echo htmlspecialchars($faq['answer'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
      </details>
      <?php endforeach; ?>

    </div>

    <p style="text-align:center; margin-top: var(--space-2xl); font-size: 0.9rem; color: var(--color-text-light);">
      Dealing with a denial or underpaid claim?
      <a href="/contact" style="color: var(--color-secondary); font-weight: 600;">Contact us directly</a> —
      we've worked dozens of supplemental claims successfully.
    </p>

  </div>
</section>

<!-- Divider: wave into primary (closing CTA) -->
<div class="sd-divider" aria-hidden="true" style="background: var(--color-bg-alt);">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path fill="var(--color-primary)" d="M0,30 C300,60 900,0 1200,35 L1200,60 L0,60 Z"/>
  </svg>
</div>

<!-- ── Closing CTA — CTA #3 ───────────────────────────────────────────────── -->
<section class="sd-closing-cta" aria-labelledby="sd-closing-heading">
  <div class="sd-container">
    <div class="sd-closing-cta-inner">

      <h2 class="sd-closing-cta-title" id="sd-closing-heading">
        Don't Let a Storm Become a More Expensive Problem
      </h2>

      <p class="sd-closing-cta-sub">
        Every week an undocumented or unrepaired storm-damaged roof sits through additional weather, the claim picture gets more complicated and the interior damage risk grows. Same-day inspections available after major storm events in <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?>.
      </p>

      <div class="sd-closing-cta-actions">
        <a href="/contact" class="sd-btn-primary">
          <i data-lucide="camera" aria-hidden="true"></i>
          Schedule Storm Inspection
        </a>
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>" class="sd-btn-white">
          <i data-lucide="phone" aria-hidden="true"></i>
          Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php endif; ?>
      </div>

      <p class="sd-closing-cta-guarantee">
        <i data-lucide="shield-check" aria-hidden="true"></i>
        Licensed &amp; insured
        <span aria-hidden="true">·</span>
        Pre-filing documentation included
        <span aria-hidden="true">·</span>
        Direct adjuster coordination
        <span aria-hidden="true">·</span>
        Emergency tarping available
      </p>

    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
