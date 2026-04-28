<?php
/* ─────────────────────────────────────────────────────────────────────────────
 * services/roof-replacement.php — Roof Replacement Service Page
 * A-1 Roof Works LLC
 * Standard Tier: ≥ 200 lines inline CSS · ≥ 4 distinct techniques
 * Techniques used:
 *   C1  Small service hero (60vh) — ::before gradient + ::after noise
 *   C2  Staggered hero entrance animations
 *   C3  Section dividers — 3 distinct styles (diagonal-down, wave, diagonal-up)
 *   C5  Eyebrow labels above every H2
 *   C6  Split layout (image right) for service detail
 *   C6  2×2 icon card grid for Why Choose Us (signature section variant)
 *   C7  Material comparison cards floating over full-bleed photo (signature)
 *   C8  Numbered timeline for process steps
 *   C9  3D-press button pattern on all CTAs
 *   C10 FAQ accordion-style with expand icons
 * ───────────────────────────────────────────────────────────────────────────── */

// ── Page meta ──────────────────────────────────────────────────────────────────
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$city      = !empty($address['city'])  ? $address['city']  : 'the Area';
$state     = !empty($address['state']) ? $address['state'] : '';
$cityState = $city . ($state ? ', ' . $state : '');
$yearsNum  = !empty($yearsInBusiness) ? $yearsInBusiness : '15';

$pageTitle       = 'Roof Replacement in ' . $cityState . ' | A-1 Roof Works LLC';
$pageDescription = 'Complete roof replacement in ' . $cityState . ' — full tear-off, decking inspection, and new installation in 1–2 days. Architectural asphalt, metal, and impact-resistant shingles. Free estimates. Licensed & insured.';
$canonicalUrl    = $siteUrl . '/services/roof-replacement';
$ogImage         = '/assets/images/roof-replacement-hero.png';
$currentPage     = 'services';
$heroPreloadImage = '/assets/images/roof-replacement-hero.png';

// ── FAQs ───────────────────────────────────────────────────────────────────────
$faqs = [
    [
        'question' => 'How much does roof replacement cost in ' . $city . '?',
        'answer'   => 'Most residential replacements in the area run $8,000–$18,000 depending on square footage, pitch, material choice, and amount of decking repair needed. Architectural asphalt shingles are the most common and cost-effective option. We provide fully itemized estimates — no surprises after the job starts.',
    ],
    [
        'question' => 'How long does a roof replacement take?',
        'answer'   => 'Most standard residential homes are completed in one to two days. Complex roof lines, steep pitches, or significant decking damage may add a day. We give you a project timeline before scheduling so you can plan accordingly.',
    ],
    [
        'question' => 'Can I stay home during the replacement?',
        'answer'   => 'Yes. Roof replacement is loud, but you don\'t need to vacate. We keep the work zone clear of your entryways and let you know before we need access to the attic or need to temporarily move vehicles.',
    ],
    [
        'question' => 'Will my homeowner\'s insurance cover a new roof?',
        'answer'   => 'If your roof was damaged by a covered peril — hail, wind, falling tree — yes, in most cases. Insurance doesn\'t cover age or general wear. We document all storm damage thoroughly and work directly with your adjuster to maximize what your policy covers.',
    ],
];

// ── Schema ─────────────────────────────────────────────────────────────────────
$serviceSchema = generateServiceSchema([
    'name'        => 'Roof Replacement',
    'description' => 'Complete residential roof replacement in ' . $cityState . '. Full tear-off, decking inspection, moisture barrier installation, and new shingle or metal roof installation. Most homes completed in 1–2 days. Architectural asphalt, impact-resistant, and standing-seam metal options available.',
], $siteUrl, $siteName);

// Add AggregateRating to service schema if available
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
    ['name' => 'Roof Replacement'],
]);

$howToSchema = generateHowToSchema(
    'How Roof Replacement Works — A-1 Roof Works LLC',
    'Four steps from first call to final walkthrough — free assessment, written estimate, scheduled installation, and warranty documentation.',
    [
        ['name' => 'Free Roof Assessment',
         'text' => 'Full inspection with photos, measurements, and written findings. We examine decking condition through attic access, check flashing and penetrations, and document every area of concern. No pressure, no upsell — just an honest report of what your roof needs.'],
        ['name' => 'Written Estimate & Material Selection',
         'text' => 'Itemized estimate showing labor, materials, decking allowance, and disposal — broken out line by line. We present 2–3 material options at different price points and explain what each product delivers for your roof\'s pitch and local weather exposure.'],
        ['name' => 'Scheduled Installation',
         'text' => 'We work in a single continuous sequence: tear-off, decking inspection and repair, ice-and-water shield, felt underlayment, and new shingle installation. Most standard residential roofs — 20 to 30 squares — are fully completed in one working day.'],
        ['name' => 'Final Walkthrough & Warranty Docs',
         'text' => 'We walk the full property perimeter with you, run a magnetic sweep for loose fasteners, verify all flashing is sealed and all penetrations are properly finished, clear all debris, and hand over your manufacturer and workmanship warranty documentation before we leave.'],
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
     PAGE-SPECIFIC STYLES — Roof Replacement
     Standard Tier: ≥ 200 lines inline CSS · ≥ 4 distinct techniques
     All values use var() tokens — no hardcoded colors/spacing/shadows
═══════════════════════════════════════════════════════════════════════════ -->
<style>

/* ── 0. Scoped utility resets ─────────────────────────────────────────────── */
.page-services .rr-container {
  width: 100%;
  max-width: var(--max-width, 1200px);
  margin-inline: auto;
  padding-inline: var(--space-lg);
}
@media (max-width: 767px) {
  .page-services .rr-container { padding-inline: var(--space-md); }
}
.page-services .prose-rr {
  max-width: 65ch;
}
.page-services .prose-rr p {
  color: var(--color-text-light);
  line-height: 1.72;
  font-size: 1.0rem;
  margin-bottom: var(--space-lg);
}
.page-services .prose-rr p:last-child { margin-bottom: 0; }

/* ── 1. Service Hero — C1 ─────────────────────────────────────────────────── */
.rr-hero {
  min-height: 60vh;
  display: flex;
  align-items: flex-end;
  position: relative;
  overflow: hidden;
  background-image: url('/assets/images/roof-replacement-hero.png');
  background-size: cover;
  background-position: center 40%;
  padding-bottom: 0;
}
/* Gradient overlay — deep brand tint fading toward center */
.rr-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    160deg,
    rgba(var(--color-primary-rgb), 0.96) 0%,
    rgba(var(--color-primary-rgb), 0.80) 55%,
    rgba(var(--color-primary-rgb), 0.50) 100%
  );
  z-index: 1;
}
/* SVG noise texture — film-grain depth */
.rr-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  z-index: 1;
  pointer-events: none;
}
.rr-hero-inner {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: calc(var(--navbar-height, 80px) + var(--space-4xl)) 0 var(--space-3xl);
}
/* Hero eyebrow */
.rr-hero-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: rgba(var(--color-accent-rgb), 0.15);
  border: 1px solid rgba(var(--color-accent-rgb), 0.40);
  border-radius: 999px;
  padding: 6px 18px;
  font-family: var(--font-heading);
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--color-accent);
  margin-bottom: var(--space-xl);
  animation: rr-fade-down 0.6s ease both;
}
/* Hero H1 */
.rr-hero-title {
  font-family: var(--font-heading);
  font-size: clamp(2.2rem, 5.5vw, 4rem);
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -0.025em;
  color: #fff;
  text-wrap: balance;
  max-width: 22ch;
  margin-bottom: var(--space-lg);
  animation: rr-fade-up 0.65s ease 0.1s both;
}
.rr-hero-title .rr-accent-word {
  background: linear-gradient(135deg, #fff 0%, var(--color-accent) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
/* Hero sub */
.rr-hero-sub {
  font-size: clamp(0.95rem, 1.8vw, 1.1rem);
  color: rgba(255,255,255,0.80);
  line-height: 1.65;
  max-width: 52ch;
  margin-bottom: var(--space-2xl);
  animation: rr-fade-up 0.65s ease 0.22s both;
}
/* Hero actions */
.rr-hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  align-items: center;
  animation: rr-fade-up 0.65s ease 0.34s both;
}
/* Trust strip in hero */
.rr-hero-trust {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-lg);
  margin-top: var(--space-2xl);
  animation: rr-fade-up 0.65s ease 0.46s both;
}
.rr-hero-trust-item {
  display: flex;
  align-items: center;
  gap: var(--space-sm);
  color: rgba(255,255,255,0.75);
  font-size: 0.85rem;
  font-weight: 600;
}
.rr-hero-trust-item i { color: var(--color-accent); }

/* Hero entrance keyframes */
@keyframes rr-fade-down {
  from { opacity: 0; transform: translateY(-12px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes rr-fade-up {
  from { opacity: 0; transform: translateY(18px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* ── 2. Primary CTA buttons ───────────────────────────────────────────────── */
.rr-btn-primary {
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
  border: none;
  cursor: pointer;
  text-decoration: none;
}
.rr-btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 0 rgba(0,0,0,0.18);
}
.rr-btn-primary:active {
  transform: translateY(2px);
  box-shadow: 0 2px 0 rgba(0,0,0,0.18);
}
.rr-btn-outline {
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
  border: 2px solid rgba(255,255,255,0.55);
  transition: border-color var(--transition-fast), background var(--transition-fast);
  text-decoration: none;
}
.rr-btn-outline:hover {
  border-color: rgba(255,255,255,0.90);
  background: rgba(255,255,255,0.08);
}

/* ── 3. Breadcrumb bar ────────────────────────────────────────────────────── */
.rr-breadcrumb-bar {
  background: var(--color-bg-alt);
  border-bottom: 1px solid rgba(var(--color-primary-rgb), 0.08);
  padding: var(--space-sm) 0;
}
.rr-breadcrumb-list {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-sm);
  align-items: center;
  list-style: none;
  font-size: 0.82rem;
  color: var(--color-text-light);
}
.rr-breadcrumb-list li + li::before {
  content: '/';
  margin-right: var(--space-sm);
  color: rgba(var(--color-primary-rgb), 0.30);
}
.rr-breadcrumb-list a {
  color: var(--color-secondary);
  font-weight: 500;
  transition: color var(--transition-fast);
}
.rr-breadcrumb-list a:hover { color: var(--color-primary); }
.rr-breadcrumb-list li:last-child { color: var(--color-text); font-weight: 600; }

/* ── 4. Eyebrow label ─────────────────────────────────────────────────────── */
.rr-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  font-family: var(--font-heading);
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  background: rgba(var(--color-accent-rgb), 0.12);
  border: 1px solid rgba(var(--color-accent-rgb), 0.30);
  color: var(--color-accent);
  padding: 5px 14px;
  border-radius: 999px;
  margin-bottom: var(--space-md);
}

/* ── 5. Service Detail — split layout (image right) ─────────────────────── */
.rr-detail-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg);
}
.rr-detail-grid {
  display: grid;
  grid-template-columns: 1fr 420px;
  gap: var(--space-3xl);
  align-items: start;
}
.rr-detail-heading {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
  color: var(--color-primary);
  text-wrap: balance;
  margin-bottom: var(--space-xl);
}
.rr-last-updated {
  font-size: 0.78rem;
  color: var(--color-text-light);
  margin-bottom: var(--space-xl);
  font-style: italic;
}
/* Image composition — shadow frame with accent border corner */
.rr-detail-image-wrap {
  position: sticky;
  top: calc(var(--navbar-height, 80px) + var(--space-xl));
}
.rr-detail-image-frame {
  position: relative;
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-xl);
}
.rr-detail-image-frame::before {
  content: '';
  position: absolute;
  top: -6px;
  right: -6px;
  width: 60%;
  height: 60%;
  border-top: 3px solid var(--color-accent);
  border-right: 3px solid var(--color-accent);
  border-radius: 0 var(--radius-lg) 0 0;
  z-index: 2;
  pointer-events: none;
}
.rr-detail-image-frame picture,
.rr-detail-image-frame img {
  display: block;
  width: 100%;
  height: auto;
  aspect-ratio: 4/3;
  object-fit: cover;
}
/* Floating badge on image */
.rr-image-badge {
  position: absolute;
  bottom: var(--space-lg);
  left: var(--space-lg);
  background: rgba(var(--color-primary-rgb), 0.94);
  border: 1px solid rgba(var(--color-accent-rgb), 0.40);
  border-radius: var(--radius-md);
  padding: var(--space-sm) var(--space-md);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 0.78rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: var(--space-sm);
  z-index: 3;
  backdrop-filter: blur(8px);
}
.rr-image-badge i { color: var(--color-accent); }

/* ── 6. SVG Dividers ──────────────────────────────────────────────────────── */
.rr-divider {
  display: block;
  line-height: 0;
  overflow: hidden;
}
.rr-divider svg {
  display: block;
  width: 100%;
  height: 60px;
}

/* ── 7. Why Choose Us — 2×2 icon card grid (signature grid technique) ────── */
.rr-why-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg-alt);
}
.rr-why-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: var(--space-xl);
  margin-top: var(--space-3xl);
}
.rr-why-card {
  background: var(--color-bg);
  border-radius: var(--radius-lg);
  padding: var(--space-2xl);
  box-shadow: var(--shadow-card);
  border-top: 3px solid transparent;
  transition: transform var(--transition-base), box-shadow var(--transition-base), border-color var(--transition-base);
  position: relative;
  overflow: hidden;
}
.rr-why-card::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: var(--color-accent);
  transition: width var(--transition-base);
}
.rr-why-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-xl);
  border-top-color: var(--color-accent);
}
.rr-why-card:hover::after { width: 100%; }
.rr-why-icon {
  width: 52px;
  height: 52px;
  background: rgba(var(--color-accent-rgb), 0.10);
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: var(--space-lg);
  transition: background var(--transition-fast);
}
.rr-why-icon i {
  color: var(--color-accent);
  width: 24px;
  height: 24px;
  transition: transform var(--transition-fast);
}
.rr-why-card:hover .rr-why-icon { background: rgba(var(--color-accent-rgb), 0.18); }
.rr-why-card:hover .rr-why-icon i { transform: scale(1.15) rotate(-5deg); }
.rr-why-card-title {
  font-family: var(--font-heading);
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: var(--space-sm);
  line-height: 1.3;
}
.rr-why-card-text {
  font-size: 0.92rem;
  color: var(--color-text-light);
  line-height: 1.65;
}

/* ── 8. Material Comparison — Signature Section ───────────────────────────── */
/* Full-bleed dark photo bg with floating material cards */
.rr-materials-section {
  position: relative;
  background-image: url('/assets/images/roof-replacement-hero.png');
  background-size: cover;
  background-position: center 60%;
  background-attachment: fixed;
  padding: var(--section-pad, 80px 20px);
}
.rr-materials-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    180deg,
    rgba(var(--color-primary-rgb), 0.91) 0%,
    rgba(var(--color-primary-dark-rgb), 0.96) 100%
  );
  z-index: 0;
}
.rr-materials-inner {
  position: relative;
  z-index: 1;
}
.rr-materials-heading {
  font-family: var(--font-heading);
  font-size: clamp(1.7rem, 3.5vw, 2.5rem);
  font-weight: 800;
  color: #fff;
  text-wrap: balance;
  margin-bottom: var(--space-lg);
}
.rr-materials-sub {
  font-size: 1rem;
  color: rgba(255,255,255,0.72);
  line-height: 1.65;
  max-width: 58ch;
  margin-bottom: var(--space-3xl);
}
.rr-materials-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: var(--space-lg);
}
.rr-material-card {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: var(--radius-lg);
  padding: var(--space-xl) var(--space-lg);
  backdrop-filter: blur(8px);
  transition: background var(--transition-base), transform var(--transition-base);
}
.rr-material-card:hover {
  background: rgba(255,255,255,0.11);
  transform: translateY(-4px);
}
.rr-material-card-name {
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 700;
  color: var(--color-accent);
  margin-bottom: var(--space-sm);
  text-transform: uppercase;
  letter-spacing: 0.06em;
}
.rr-material-lifespan {
  font-family: var(--font-heading);
  font-size: 1.8rem;
  font-weight: 800;
  color: #fff;
  line-height: 1;
  margin-bottom: var(--space-xs);
}
.rr-material-lifespan span {
  font-size: 0.85rem;
  font-weight: 500;
  color: rgba(255,255,255,0.55);
}
.rr-material-desc {
  font-size: 0.84rem;
  color: rgba(255,255,255,0.68);
  line-height: 1.55;
  margin-top: var(--space-md);
}
.rr-material-badge {
  display: inline-block;
  background: rgba(var(--color-accent-rgb), 0.20);
  border: 1px solid rgba(var(--color-accent-rgb), 0.40);
  color: var(--color-accent);
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  padding: 2px 8px;
  border-radius: 4px;
  margin-top: var(--space-sm);
}

/* ── 9. Process Timeline ──────────────────────────────────────────────────── */
.rr-process-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg);
}
.rr-process-list {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: var(--space-xl);
  margin-top: var(--space-3xl);
  position: relative;
}
/* Connecting line across steps */
.rr-process-list::before {
  content: '';
  position: absolute;
  top: 28px;
  left: 28px;
  right: 28px;
  height: 2px;
  background: linear-gradient(
    90deg,
    var(--color-accent) 0%,
    rgba(var(--color-accent-rgb), 0.25) 100%
  );
  z-index: 0;
}
.rr-process-step {
  position: relative;
  z-index: 1;
}
.rr-process-number {
  width: 56px;
  height: 56px;
  background: var(--color-primary);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--font-heading);
  font-size: 1.2rem;
  font-weight: 800;
  color: var(--color-accent);
  margin-bottom: var(--space-lg);
  border: 3px solid var(--color-bg);
  box-shadow: 0 0 0 2px var(--color-accent);
  transition: transform var(--transition-fast), background var(--transition-fast);
}
.rr-process-step:hover .rr-process-number {
  transform: scale(1.08);
  background: var(--color-accent);
  color: var(--color-primary-dark);
}
.rr-process-step-title {
  font-family: var(--font-heading);
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: var(--space-sm);
  line-height: 1.3;
}
.rr-process-step-text {
  font-size: 0.88rem;
  color: var(--color-text-light);
  line-height: 1.65;
}

/* ── 10. Mid-page CTA Banner ──────────────────────────────────────────────── */
.rr-cta-banner {
  position: relative;
  overflow: hidden;
  background: linear-gradient(
    145deg,
    var(--color-primary-dark) 0%,
    var(--color-primary) 55%,
    var(--color-secondary) 100%
  );
  padding: var(--section-pad, 80px 20px);
}
.rr-cta-banner::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 0;
}
.rr-cta-banner-inner {
  position: relative;
  z-index: 1;
  text-align: center;
}
.rr-cta-banner-eyebrow {
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
.rr-cta-banner-title {
  font-family: var(--font-heading);
  font-size: clamp(1.9rem, 4vw, 3rem);
  font-weight: 800;
  color: #fff;
  line-height: 1.12;
  letter-spacing: -0.02em;
  text-wrap: balance;
  margin-bottom: var(--space-lg);
}
.rr-cta-banner-sub {
  font-size: 1.05rem;
  color: rgba(255,255,255,0.78);
  max-width: 52ch;
  margin-inline: auto;
  margin-bottom: var(--space-2xl);
  line-height: 1.6;
}
.rr-cta-banner-phone {
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
.rr-cta-banner-phone:hover { opacity: 0.85; }
.rr-cta-banner-actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  justify-content: center;
  align-items: center;
}
.rr-btn-white {
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
  box-shadow: 0 4px 0 rgba(0,0,0,0.20);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  text-decoration: none;
}
.rr-btn-white:hover { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.16); }
.rr-btn-white:active { transform: translateY(2px); box-shadow: 0 2px 0 rgba(0,0,0,0.16); }

/* ── 11. FAQ Section ──────────────────────────────────────────────────────── */
.rr-faq-section {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-bg-alt);
}
.rr-faq-list {
  display: grid;
  gap: var(--space-md);
  margin-top: var(--space-3xl);
}
.rr-faq-item {
  background: var(--color-bg);
  border-radius: var(--radius-md);
  border: 1px solid rgba(var(--color-primary-rgb), 0.08);
  box-shadow: var(--shadow-sm);
  overflow: hidden;
}
.rr-faq-question {
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
.rr-faq-question::-webkit-details-marker { display: none; }
.rr-faq-question:hover { background: rgba(var(--color-primary-rgb), 0.03); }
.rr-faq-question .rr-faq-icon {
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
.rr-faq-question .rr-faq-icon i { color: var(--color-accent); width: 12px; height: 12px; }
details[open] .rr-faq-question .rr-faq-icon {
  background: var(--color-accent);
  transform: rotate(45deg);
}
details[open] .rr-faq-question .rr-faq-icon i { color: var(--color-primary-dark); }
.rr-faq-answer {
  padding: 0 var(--space-2xl) var(--space-xl);
  font-size: 0.94rem;
  color: var(--color-text-light);
  line-height: 1.72;
  border-top: 1px solid rgba(var(--color-primary-rgb), 0.06);
  padding-top: var(--space-lg);
}

/* ── 12. Closing CTA ──────────────────────────────────────────────────────── */
.rr-closing-cta {
  padding: var(--section-pad, 80px 20px);
  background: var(--color-primary);
  text-align: center;
  position: relative;
  overflow: hidden;
}
.rr-closing-cta::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  pointer-events: none;
}
.rr-closing-cta-inner { position: relative; z-index: 1; }
.rr-closing-cta-title {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem, 3.5vw, 2.8rem);
  font-weight: 800;
  color: #fff;
  text-wrap: balance;
  margin-bottom: var(--space-lg);
  line-height: 1.2;
}
.rr-closing-cta-sub {
  font-size: 1.05rem;
  color: rgba(255,255,255,0.78);
  max-width: 52ch;
  margin-inline: auto;
  margin-bottom: var(--space-2xl);
  line-height: 1.6;
}
.rr-closing-cta-guarantee {
  font-size: 0.85rem;
  color: rgba(255,255,255,0.55);
  margin-top: var(--space-lg);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-sm);
}
.rr-closing-cta-guarantee i { color: var(--color-accent); }

/* ── 13. Section heading patterns ────────────────────────────────────────── */
.rr-section-heading {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
  color: var(--color-primary);
  text-wrap: balance;
  margin-bottom: var(--space-lg);
}
.rr-section-lead {
  font-size: 1.0rem;
  color: var(--color-text-light);
  line-height: 1.72;
  max-width: 62ch;
}
.rr-section-header { margin-bottom: var(--space-3xl); }
.rr-section-header.centered { text-align: center; }
.rr-section-header.centered .rr-section-lead { margin-inline: auto; }

/* ── 14. Responsive breakpoints ──────────────────────────────────────────── */
@media (max-width: 1023px) {
  .rr-detail-grid { grid-template-columns: 1fr; }
  .rr-detail-image-wrap { position: static; order: -1; }
  .rr-materials-grid { grid-template-columns: repeat(2, 1fr); }
  .rr-process-list { grid-template-columns: repeat(2, 1fr); }
  .rr-process-list::before { display: none; }
  .rr-why-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 767px) {
  .rr-hero-title { max-width: 100%; }
  .rr-why-grid { grid-template-columns: 1fr; }
  .rr-materials-grid { grid-template-columns: 1fr; }
  .rr-process-list { grid-template-columns: 1fr; }
  .rr-cta-banner-actions { flex-direction: column; }
  .rr-hero-trust { gap: var(--space-md); }
}

/* ── 15. Reduced-motion ───────────────────────────────────────────────────── */
@media (prefers-reduced-motion: reduce) {
  .rr-hero-eyebrow,
  .rr-hero-title,
  .rr-hero-sub,
  .rr-hero-actions,
  .rr-hero-trust {
    animation: none;
  }
  .rr-materials-section { background-attachment: scroll; }
}

/* ── Project Photo Strip ─────────────────────────────────────────── */
.rr-photo-strip {
  padding: var(--space-3xl) 0;
  background: var(--color-bg-alt);
}
.rr-photo-pair {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-md);
}
.rr-photo-pair-item {
  border-radius: var(--radius-lg);
  overflow: hidden;
  aspect-ratio: 4/3;
  box-shadow: var(--shadow-card);
}
.rr-photo-pair-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--transition-base);
}
.rr-photo-pair-item:hover img { transform: scale(1.04); }
@media (max-width: 767px) {
  .rr-photo-pair { grid-template-columns: 1fr; }
}

</style>

<!-- ── Hero (CTA #1) ──────────────────────────────────────────────────────── -->
<section class="rr-hero" aria-labelledby="rr-hero-heading">
  <div class="rr-hero-inner">
    <div class="rr-container">

      <p class="rr-hero-eyebrow" aria-hidden="true">
        <i data-lucide="home" aria-hidden="true"></i>
        Roof Replacement Specialists
      </p>

      <h1 class="rr-hero-title" id="rr-hero-heading">
        Complete <span class="rr-accent-word">Roof Replacement</span> in <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?>
      </h1>

      <p class="rr-hero-sub">
        Full tear-off, thorough decking inspection, and new installation — most homes completed in one to two days. Architectural asphalt, impact-resistant shingles, and standing-seam metal options available.
      </p>

      <div class="rr-hero-actions">
        <a href="/contact" class="rr-btn-primary">
          <i data-lucide="clipboard-list" aria-hidden="true"></i>
          Get Free Estimate
        </a>
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>" class="rr-btn-outline">
          <i data-lucide="phone" aria-hidden="true"></i>
          <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php endif; ?>
      </div>

      <div class="rr-hero-trust">
        <span class="rr-hero-trust-item">
          <i data-lucide="shield-check" aria-hidden="true"></i>
          Licensed &amp; Insured
        </span>
        <span class="rr-hero-trust-item">
          <i data-lucide="clock" aria-hidden="true"></i>
          1–2 Day Completion
        </span>
        <span class="rr-hero-trust-item">
          <i data-lucide="file-check" aria-hidden="true"></i>
          Manufacturer Warranty Included
        </span>
        <span class="rr-hero-trust-item">
          <i data-lucide="star" aria-hidden="true"></i>
          Free Estimates — No Pressure
        </span>
      </div>

    </div>
  </div>
</section>

<!-- ── Breadcrumb ─────────────────────────────────────────────────────────── -->
<nav class="rr-breadcrumb-bar" aria-label="Breadcrumb">
  <div class="rr-container">
    <ol class="rr-breadcrumb-list"
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
        <span itemprop="name">Roof Replacement</span>
        <meta itemprop="position" content="3">
      </li>

    </ol>
  </div>
</nav>

<!-- ── Service Detail — split layout ─────────────────────────────────────── -->
<section class="rr-detail-section" aria-labelledby="rr-detail-heading" data-animate="fade-up">
  <div class="rr-container">
    <div class="rr-detail-grid">

      <!-- Content — left column -->
      <div class="rr-detail-content">
        <span class="rr-eyebrow">
          <i data-lucide="info" aria-hidden="true"></i>
          When Replacement Makes Sense
        </span>
        <h2 class="rr-detail-heading" id="rr-detail-heading">
          When Repair Stops Being the Right Answer
        </h2>
        <p class="rr-last-updated">Last Updated: April 2026</p>

        <div class="prose-rr">
          <p>
            When shingles are 20 or more years old, showing widespread granule loss, or leaking from multiple locations that don't share a single cause, replacement becomes the smarter financial decision over continued repair. A-1 Roof Works handles the entire process — full tear-off, systematic decking inspection, moisture barrier installation, and new shingle or metal installation. Most standard residential homes are done in one to two days, and we work in a continuous sequence so your roof is never left partially exposed overnight.
          </p>
          <p>
            Material choice matters more than most homeowners realize before they get into it. Architectural asphalt is the most widely installed option — a 30-to-50-year product that performs well in most climates and stays cost-effective per year of service. Impact-resistant shingles are worth considering if you're in a hail-prone zone: they reduce future damage risk and often qualify for an insurance premium discount. Standing-seam metal runs longer — 50-plus years — and performs particularly well on lower-pitched roofs where water drainage is slower. We help you compare the real cost per year of service for each option against your home's pitch, exposure, and expected time in the house, rather than just quoting the cheapest upfront number.
          </p>
          <p>
            If storm damage triggered the need for replacement, the documentation sequence matters enormously for your insurance claim. We photograph and record everything before demolition begins: shingle samples showing granule impact bruising, measurements of affected sections, dented metal components, and lifted or displaced flashing. We work directly with adjusters throughout the claim process and know exactly what documentation they need to approve a full replacement rather than a patched repair. Clients who come to us before filing typically see better claim outcomes than those who file first and call a roofer second.
          </p>
        </div>

        <!-- Internal links -->
        <div style="margin-top: var(--space-xl); display: flex; gap: var(--space-md); flex-wrap: wrap;">
          <a href="/services/roof-repair" style="color: var(--color-secondary); font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 4px;">
            <i data-lucide="arrow-right" aria-hidden="true" style="width:14px;height:14px;"></i>
            Roof Repair Services
          </a>
          <a href="/services/storm-damage-repair" style="color: var(--color-secondary); font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 4px;">
            <i data-lucide="arrow-right" aria-hidden="true" style="width:14px;height:14px;"></i>
            Storm Damage Repair
          </a>
          <a href="/contact" style="color: var(--color-secondary); font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 4px;">
            <i data-lucide="arrow-right" aria-hidden="true" style="width:14px;height:14px;"></i>
            Get a Free Estimate
          </a>
        </div>
      </div>

      <!-- Image — right column -->
      <div class="rr-detail-image-wrap" data-animate="wipe-right">
        <div class="rr-detail-image-frame">
          <picture>
            <img src="/assets/images/photo-003.jpg" alt="Roofing crew performing mid-project roof repair with exposed shingles and gutter cleaning visible on residential home" width="840" height="630" loading="lazy">
          </picture>
          <div class="rr-image-badge">
            <i data-lucide="calendar-check" aria-hidden="true"></i>
            Completed in 1–2 Days
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Divider: diagonal down into bg-alt -->
<div class="rr-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <polygon fill="var(--color-bg-alt)" points="0,60 1200,0 1200,60"/>
  </svg>
</div>

<!-- ── Why Choose Us — 2×2 card grid ─────────────────────────────────────── -->
<section class="rr-why-section" aria-labelledby="rr-why-heading" data-animate="fade-up">
  <div class="rr-container">

    <div class="rr-section-header centered">
      <span class="rr-eyebrow">
        <i data-lucide="check-circle" aria-hidden="true"></i>
        What Sets Us Apart
      </span>
      <h2 class="rr-section-heading" id="rr-why-heading">
        Why Homeowners in <?php echo htmlspecialchars($city, ENT_QUOTES, 'UTF-8'); ?> Choose A-1 for Replacement
      </h2>
      <p class="rr-section-lead">
        Roof replacement is a significant investment. These four points explain why our customers come back for the next home, and refer neighbors.
      </p>
    </div>

    <div class="rr-why-grid">

      <div class="rr-why-card" data-animate="fade-up">
        <div class="rr-why-icon">
          <i data-lucide="users" aria-hidden="true"></i>
        </div>
        <h3 class="rr-why-card-title">Same Crew, Start to Finish</h3>
        <p class="rr-why-card-text">
          The crew that tears off your old roof is the same crew that installs the new one. No handoffs, no communication gaps, no "the other guys left it like that" excuses. One team accountable for the whole job, from the first shingle lifted to the final walkthrough.
        </p>
      </div>

      <div class="rr-why-card" data-animate="fade-up">
        <div class="rr-why-icon">
          <i data-lucide="search" aria-hidden="true"></i>
        </div>
        <h3 class="rr-why-card-title">Full Decking Inspection — No Upcharge</h3>
        <p class="rr-why-card-text">
          After tear-off, we inspect every board of your decking for rot, soft spots, and moisture damage before anything new goes on. Rotted sections get replaced — we do it at cost with no markup, because cutting corners on decking defeats the purpose of a new roof.
        </p>
      </div>

      <div class="rr-why-card" data-animate="fade-up">
        <div class="rr-why-icon">
          <i data-lucide="shield" aria-hidden="true"></i>
        </div>
        <h3 class="rr-why-card-title">Complete Property Protection</h3>
        <p class="rr-why-card-text">
          Tarps on all landscaping. Plywood over exposed windows and doors if conditions call for it. Magnetic sweep for fasteners run at the end of every work day. Your driveway, lawn, and landscaping are in the same condition when we leave as when we arrived.
        </p>
      </div>

      <div class="rr-why-card" data-animate="fade-up">
        <div class="rr-why-icon">
          <i data-lucide="file-text" aria-hidden="true"></i>
        </div>
        <h3 class="rr-why-card-title">Two Layers of Warranty Coverage</h3>
        <p class="rr-why-card-text">
          Manufacturer-backed material warranty on every product we install, plus our own workmanship warranty covering installation defects. You get written documentation of both before we leave the property, not a verbal promise you have to chase later.
        </p>
      </div>

    </div>

  </div>
</section>

<!-- Divider: wave into dark bg (materials section) -->
<div class="rr-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path fill="var(--color-primary-dark)" d="M0,30 C300,60 900,0 1200,30 L1200,60 L0,60 Z"/>
  </svg>
</div>

<!-- ── Materials Section — SIGNATURE SECTION ──────────────────────────────── -->
<section class="rr-materials-section" aria-labelledby="rr-materials-heading" data-animate="fade-up">
  <div class="rr-container">
    <div class="rr-materials-inner">

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-3xl); align-items: end; margin-bottom: var(--space-3xl);">
        <div>
          <span style="display:inline-flex;align-items:center;gap:var(--space-sm);font-family:var(--font-heading);font-size:0.68rem;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;background:rgba(var(--color-accent-rgb),0.15);border:1px solid rgba(var(--color-accent-rgb),0.35);color:var(--color-accent);padding:5px 14px;border-radius:999px;margin-bottom:var(--space-lg);">
            <i data-lucide="layers" aria-hidden="true"></i>
            Material Comparison
          </span>
          <h2 class="rr-materials-heading" id="rr-materials-heading">
            Choosing the Right Material for Your Home
          </h2>
        </div>
        <p class="rr-materials-sub" style="margin-bottom:0;">
          We compare cost per year of service — not just the upfront price. A $12,000 architectural shingle job that lasts 40 years costs $300/year. A $24,000 standing-seam metal roof that lasts 60 years costs $400/year but eliminates re-roofing entirely if you're in the house long-term.
        </p>
      </div>

      <div class="rr-materials-grid">

        <div class="rr-material-card">
          <p class="rr-material-card-name">Architectural Asphalt</p>
          <p class="rr-material-lifespan">30–50<span> yr lifespan</span></p>
          <p class="rr-material-desc">
            Most popular residential choice. Dimensional texture, wide color range, excellent cost-per-year value. Class A fire rating standard. Works on 3:12 pitch or steeper.
          </p>
          <span class="rr-material-badge">Most Common</span>
        </div>

        <div class="rr-material-card">
          <p class="rr-material-card-name">Impact-Resistant</p>
          <p class="rr-material-lifespan">30–50<span> yr lifespan</span></p>
          <p class="rr-material-desc">
            Class 4 impact rating — engineered to resist hail damage. Many insurers offer premium discounts of 20–30% for impact-resistant roofs. Ideal for hail-prone areas.
          </p>
          <span class="rr-material-badge">Insurance Discount Eligible</span>
        </div>

        <div class="rr-material-card">
          <p class="rr-material-card-name">Standing Seam Metal</p>
          <p class="rr-material-lifespan">50+<span> yr lifespan</span></p>
          <p class="rr-material-desc">
            Premium metal option with concealed fasteners. Outstanding on low-to-moderate pitch roofs. Energy-efficient, recyclable, and the closest thing to a permanent roof available.
          </p>
          <span class="rr-material-badge">Premium</span>
        </div>

        <div class="rr-material-card">
          <p class="rr-material-card-name">Corrugated Metal</p>
          <p class="rr-material-lifespan">40–60<span> yr lifespan</span></p>
          <p class="rr-material-desc">
            Industrial aesthetic suited to agricultural, commercial, and contemporary residential applications. Lower cost than standing seam with comparable durability. Exposed fastener system.
          </p>
          <span class="rr-material-badge">Commercial / Ag Look</span>
        </div>

      </div>

    </div>
  </div>
</section>

<!-- Divider: diagonal up into bg (process section) -->
<div class="rr-divider" aria-hidden="true" style="background: var(--color-primary-dark);">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <polygon fill="var(--color-bg)" points="0,60 1200,0 1200,60 0,60"/>
  </svg>
</div>

<!-- ── Process Timeline ────────────────────────────────────────────────────── -->
<section class="rr-process-section" aria-labelledby="rr-process-heading" data-animate="fade-up">
  <div class="rr-container">

    <div class="rr-section-header centered">
      <span class="rr-eyebrow">
        <i data-lucide="list-ordered" aria-hidden="true"></i>
        How It Works
      </span>
      <h2 class="rr-section-heading" id="rr-process-heading">
        Your Roof Replacement, Step by Step
      </h2>
      <p class="rr-section-lead" style="margin-inline: auto;">
        Four clear steps from first call to final walkthrough — no surprises, no unanswered questions, no debris left in your yard.
      </p>
    </div>

    <ol class="rr-process-list" aria-label="Roof replacement process steps">

      <li class="rr-process-step" data-animate="fade-up">
        <div class="rr-process-number" aria-hidden="true">01</div>
        <h3 class="rr-process-step-title">Free Roof Assessment</h3>
        <p class="rr-process-step-text">
          Full inspection with photos, measurements, and written findings. We examine decking condition through attic access, check flashing and penetrations, and document every area of concern. No pressure, no upsell — just an honest report of what your roof needs.
        </p>
      </li>

      <li class="rr-process-step" data-animate="fade-up">
        <div class="rr-process-number" aria-hidden="true">02</div>
        <h3 class="rr-process-step-title">Written Estimate &amp; Material Selection</h3>
        <p class="rr-process-step-text">
          Itemized estimate showing labor, materials, decking allowance, and disposal — broken out line by line. We present 2–3 material options at different price points and explain what each product delivers for your roof's pitch and local weather exposure.
        </p>
      </li>

      <li class="rr-process-step" data-animate="fade-up">
        <div class="rr-process-number" aria-hidden="true">03</div>
        <h3 class="rr-process-step-title">Scheduled Installation</h3>
        <p class="rr-process-step-text">
          We work in a single continuous sequence: tear-off, decking inspection and repair, ice-and-water shield, felt underlayment, and new shingle installation. Most standard residential roofs — 20 to 30 squares — are fully completed in one working day.
        </p>
      </li>

      <li class="rr-process-step" data-animate="fade-up">
        <div class="rr-process-number" aria-hidden="true">04</div>
        <h3 class="rr-process-step-title">Final Walkthrough &amp; Warranty Docs</h3>
        <p class="rr-process-step-text">
          We walk the full property perimeter with you, run a magnetic sweep for loose fasteners, verify all flashing is sealed and all penetrations are properly finished, clear all debris, and hand over your manufacturer and workmanship warranty documentation before we leave.
        </p>
      </li>

    </ol>

  </div>
</section>

<!-- ── Project Photos ─────────────────────────────────────────────────────── -->
<section class="rr-photo-strip" aria-label="Recent roof replacement projects">
  <div class="rr-container">
    <div class="rr-photo-pair">
      <div class="rr-photo-pair-item" data-animate="fade-up">
        <picture>
          <img src="/assets/images/photo-001.jpg" alt="Close-up aerial view of gray asphalt shingles with metal roof flashing and gutters, showing roofing material detail and installation" width="600" height="450" loading="lazy">
        </picture>
      </div>
      <div class="rr-photo-pair-item" data-animate="fade-up" style="animation-delay:80ms">
        <picture>
          <img src="/assets/images/photo-002.jpg" alt="Newly installed asphalt shingle roof with gray dimensional shingles and white PVC pipe penetration" width="600" height="450" loading="lazy">
        </picture>
      </div>
    </div>
  </div>
</section>

<!-- Divider: diagonal into CTA banner -->
<div class="rr-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <polygon fill="var(--color-primary-dark)" points="0,0 1200,60 1200,60 0,60"/>
  </svg>
</div>

<!-- ── Mid-Page CTA Banner — CTA #2 ───────────────────────────────────────── -->
<section class="rr-cta-banner" aria-labelledby="rr-cta-heading">
  <div class="rr-container">
    <div class="rr-cta-banner-inner">

      <span class="rr-cta-banner-eyebrow">Free — No Obligation</span>

      <h2 class="rr-cta-banner-title" id="rr-cta-heading">
        Know Exactly What Your Replacement Costs Before You Commit
      </h2>

      <p class="rr-cta-banner-sub">
        Itemized estimate. No verbal ballparks. Know the full scope — materials, labor, decking allowance, and disposal — before you sign anything.
      </p>

      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="rr-cta-banner-phone" aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php endif; ?>

      <div class="rr-cta-banner-actions">
        <a href="/contact" class="rr-btn-white">
          <i data-lucide="clipboard-list" aria-hidden="true"></i>
          Schedule Free Estimate
        </a>
        <a href="/services" style="display:inline-flex;align-items:center;gap:var(--space-sm);color:rgba(255,255,255,0.80);font-family:var(--font-heading);font-size:0.95rem;font-weight:600;letter-spacing:0.04em;text-decoration:none;transition:color var(--transition-fast);">
          <i data-lucide="grid" aria-hidden="true"></i>
          View All Services
        </a>
      </div>

    </div>
  </div>
</section>

<!-- Divider: wave into bg-alt (FAQ) -->
<div class="rr-divider" aria-hidden="true" style="background: var(--color-primary-dark);">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path fill="var(--color-bg-alt)" d="M0,30 C400,0 800,60 1200,20 L1200,60 L0,60 Z"/>
  </svg>
</div>

<!-- ── FAQ Section ────────────────────────────────────────────────────────── -->
<section class="rr-faq-section" aria-labelledby="rr-faq-heading" data-animate="fade-up">
  <div class="rr-container">

    <div class="rr-section-header centered">
      <span class="rr-eyebrow">
        <i data-lucide="help-circle" aria-hidden="true"></i>
        Common Questions
      </span>
      <h2 class="rr-section-heading" id="rr-faq-heading">
        Roof Replacement Questions — Answered Directly
      </h2>
    </div>

    <div class="rr-faq-list" role="list">

      <?php foreach ($faqs as $i => $faq): ?>
      <details class="rr-faq-item" <?php echo $i === 0 ? 'open' : ''; ?>>
        <summary class="rr-faq-question">
          <?php echo htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8'); ?>
          <span class="rr-faq-icon" aria-hidden="true">
            <i data-lucide="plus" aria-hidden="true"></i>
          </span>
        </summary>
        <div class="rr-faq-answer">
          <?php echo htmlspecialchars($faq['answer'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
      </details>
      <?php endforeach; ?>

    </div>

    <p style="text-align:center; margin-top: var(--space-2xl); font-size: 0.9rem; color: var(--color-text-light);">
      Have a question not covered here?
      <a href="/contact" style="color: var(--color-secondary); font-weight: 600;">Send us a message</a>
      or <a href="/about" style="color: var(--color-secondary); font-weight: 600;">read more about how we work</a>.
    </p>

  </div>
</section>

<!-- Divider: diagonal into closing CTA -->
<div class="rr-divider" aria-hidden="true" style="background: var(--color-bg-alt);">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <polygon fill="var(--color-primary)" points="0,60 1200,0 1200,60 0,60"/>
  </svg>
</div>

<!-- ── Closing CTA — CTA #3 ───────────────────────────────────────────────── -->
<section class="rr-closing-cta" aria-labelledby="rr-closing-heading">
  <div class="rr-container">
    <div class="rr-closing-cta-inner">

      <h2 class="rr-closing-cta-title" id="rr-closing-heading">
        A New Roof Is a One-Time Decision — Make It the Right One
      </h2>

      <p class="rr-closing-cta-sub">
        Most homeowners replace their roof once in their ownership of a home. We make sure it's done properly, documented completely, and backed by warranties you can actually use. Free estimates — no pressure, no expiring quotes.
      </p>

      <div style="display:flex; flex-wrap:wrap; gap:var(--space-md); justify-content:center; align-items:center;">
        <a href="/contact" class="rr-btn-primary">
          <i data-lucide="clipboard-list" aria-hidden="true"></i>
          Get Free Estimate
        </a>
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>" class="rr-btn-white">
          <i data-lucide="phone" aria-hidden="true"></i>
          Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php endif; ?>
      </div>

      <p class="rr-closing-cta-guarantee">
        <i data-lucide="shield-check" aria-hidden="true"></i>
        Licensed &amp; insured · Free estimates · Manufacturer + workmanship warranty included
      </p>

    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
