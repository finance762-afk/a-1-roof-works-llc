<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$faqs = [
    [
        'question' => 'How much does gutter installation cost?',
        'answer'   => 'Seamless aluminum gutters typically run $6–$14 per linear foot installed, depending on profile size, mounting complexity, and downspout count. A standard residential home might run $800–$2,200 total. Copper is significantly higher. We provide exact pricing after measuring your home.',
    ],
    [
        'question' => 'How long do gutters last?',
        'answer'   => 'Quality aluminum gutters last 20–30 years with reasonable maintenance. Copper lasts 50+ years. The limiting factor is usually the fascia board they\'re attached to — if fascia is rotting, we address that before installation so the new gutters have a solid mounting surface.',
    ],
    [
        'question' => 'Do I need gutter guards?',
        'answer'   => 'If you have significant tree cover within 30 feet of the roofline, gutter guards typically pay for themselves in reduced cleaning and prevent the water damage caused by clogged gutters. For homes with minimal tree exposure, regular cleaning (1–2 times per year) is sufficient without guards. We\'ll give you an honest recommendation based on your specific situation.',
    ],
];

$schemaMarkup = json_encode([
    generateServiceSchema(
        ['name' => 'Gutter Installation', 'description' => 'Seamless gutter installation and repair — aluminum and copper gutters formed on-site, properly sized and pitched, with downspout routing that protects foundations.'],
        $siteUrl,
        $siteName
    ),
    generateFAQSchema($faqs),
    generateBreadcrumbSchema([
        ['name' => 'Home',     'url' => $siteUrl . '/'],
        ['name' => 'Services', 'url' => $siteUrl . '/services'],
        ['name' => 'Gutter Installation'],
    ]),
    generateHowToSchema(
        'How Gutter Installation Works — A-1 Roof Works LLC',
        'Three steps from measurement to water test — we design the system to your roofline, fabricate seamless gutters on-site, and verify correct pitch and flow before we leave.',
        [
            ['name' => 'Measurement & System Design',
             'text' => 'We measure the full roofline, calculate water volume per section based on slope and surface area, and determine downspout locations and sizing. Existing fascia is inspected for rot before installation begins.'],
            ['name' => 'On-Site Fabrication & Installation',
             'text' => 'Seamless gutters are formed on-site from coil stock in your selected color and profile. Installed with hidden hangers, proper pitch toward downspouts, and sealed end caps.'],
            ['name' => 'Downspout Routing & Water Test',
             'text' => 'Downspouts are directed away from the foundation using extensions or underground drainage where appropriate. We run a water test before completion to verify pitch and flow.'],
        ]
    ),
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

$pageTitle        = 'Gutter Installation in ' . ($address['city'] ?: 'Your Area') . ', ' . ($address['state'] ?: '') . ' | A-1 Roof Works LLC';
$pageDescription  = 'Seamless aluminum gutter installation, sized and pitched correctly for your roof. On-site fabrication, hidden hangers, proper downspout routing. ' . ($address['city'] ? 'Serving ' . $address['city'] . ', ' . $address['state'] . '.' : 'Licensed and insured.');
$canonicalUrl     = $siteUrl . '/services/gutter-installation';
$currentPage      = 'services';
$heroPreloadImage = '/assets/images/gutter-installation-hero.png';
$ogImage          = '/assets/images/gutter-installation-hero.png';

// SEO: <link rel="canonical"> + <script type="application/ld+json"> are rendered by includes/head.php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<style>
/* ═══════════════════════════════════════════════════════════════
   GUTTER INSTALLATION — Page-specific styles
   Standard tier: 200+ lines, ≥ 4 distinct visual techniques
   C1 hero (warm home-protection tone), C3 dividers, C4.2 CTA banner,
   C5.2 eyebrow, C5.3 gradient text, C6.5 numbered steps, C7 signature
════════════════════════════════════════════════════════════════ */

/* ── Hero (C1.1 — warm, home-protection aesthetic) ───────────────── */
.gutter-hero {
  position: relative;
  min-height: 60vh;
  display: flex;
  align-items: center;
  background-image: url('/assets/images/gutter-installation-hero.png');
  background-size: cover;
  background-position: center 55%;
  overflow: hidden;
}
/* ::before — warm amber-tinted navy gradient */
.gutter-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    100deg,
    rgba(var(--color-primary-rgb), 0.88) 0%,
    rgba(var(--color-primary-rgb), 0.6) 45%,
    rgba(15, 36, 64, 0.38) 100%
  );
  z-index: 1;
}
/* ::after — noise texture */
.gutter-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.05'/%3E%3C/svg%3E");
  background-size: 200px 200px;
  opacity: 0.05;
  z-index: 2;
  pointer-events: none;
}
.gutter-hero-inner { position: relative; z-index: 3; padding: var(--section-pad); width: 100%; }
.gutter-hero .container { max-width: var(--max-width); margin-inline: auto; padding-inline: var(--space-lg); }
.gutter-hero h1 {
  font-family: var(--font-heading);
  font-size: clamp(2.2rem, 5vw, 3.8rem);
  font-weight: 700;
  line-height: 1.12;
  letter-spacing: -0.02em;
  text-wrap: balance;
  color: #fff;
  max-width: 680px;
  margin-bottom: var(--space-md);
}
.gutter-hero .hero-accent {
  background: linear-gradient(90deg, var(--color-accent), #ffd04d);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.gutter-hero-sub {
  font-family: var(--font-body);
  font-size: clamp(1rem, 2vw, 1.15rem);
  color: rgba(255,255,255,0.88);
  max-width: 540px;
  line-height: 1.65;
  margin-bottom: var(--space-2xl);
}
.gutter-hero-actions { display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-lg); }
.gutter-hero-phone {
  display: inline-flex;
  align-items: center;
  gap: var(--space-xs);
  color: rgba(255,255,255,0.9);
  font-family: var(--font-heading);
  font-size: 1.05rem;
  font-weight: 600;
  letter-spacing: 0.02em;
  text-decoration: none;
  transition: color var(--transition-fast);
}
.gutter-hero-phone:hover { color: var(--color-accent); }

/* ── Shared button patterns ──────────────────────────────────────── */
.btn-svc-primary {
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
  border: none;
  cursor: pointer;
  box-shadow: 0 4px 0 rgba(0,0,0,0.22);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  overflow: hidden;
  text-decoration: none;
  white-space: nowrap;
}
.btn-svc-primary:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.18); }
.btn-svc-primary:active { transform: translateY(2px);  box-shadow: 0 2px 0 rgba(0,0,0,0.18); }
.btn-svc-secondary {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: var(--color-primary);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  padding: 14px var(--space-2xl);
  border-radius: var(--radius-md);
  border: none;
  text-decoration: none;
  box-shadow: 0 4px 0 var(--color-primary-dark);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  overflow: hidden;
}
.btn-svc-secondary:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 var(--color-primary-dark); }
.btn-svc-secondary:active { transform: translateY(2px);  box-shadow: 0 2px 0 var(--color-primary-dark); }
.btn-svc-outline {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: transparent;
  color: #fff;
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  padding: 13px var(--space-2xl);
  border-radius: var(--radius-md);
  border: 2px solid rgba(255,255,255,0.5);
  text-decoration: none;
  transition: border-color var(--transition-fast), background var(--transition-fast);
  overflow: hidden;
}
.btn-svc-outline:hover { border-color: #fff; background: rgba(255,255,255,0.08); }

/* ── Breadcrumb ──────────────────────────────────────────────────── */
.breadcrumb-bar { background: var(--color-bg-alt); border-bottom: 1px solid rgba(0,0,0,0.07); padding: var(--space-sm) 0; }
.breadcrumb-list {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: var(--space-xs);
  list-style: none;
  padding: 0;
  margin: 0;
  font-size: 0.85rem;
  font-family: var(--font-body);
  color: var(--color-text-light);
}
.breadcrumb-list li + li::before { content: '/'; margin-right: var(--space-xs); opacity: 0.5; }
.breadcrumb-list a { color: var(--color-secondary); text-decoration: none; transition: color var(--transition-fast); }
.breadcrumb-list a:hover { color: var(--color-primary); }
.breadcrumb-list li:last-child span { color: var(--color-text); font-weight: 600; }

/* ── Eyebrow pill (C5.2) ─────────────────────────────────────────── */
.eyebrow-pill {
  display: inline-block;
  background: rgba(var(--color-accent-rgb), 0.12);
  color: var(--color-accent);
  border: 1px solid rgba(var(--color-accent-rgb), 0.3);
  font-family: var(--font-heading);
  font-size: 0.78rem;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  padding: 5px 14px;
  border-radius: 100px;
  margin-bottom: var(--space-md);
}
.eyebrow-pill--light { background: rgba(255,255,255,0.12); color: rgba(255,255,255,0.9); border-color: rgba(255,255,255,0.25); }

/* ── Section containers ──────────────────────────────────────────── */
.gutter-section { padding: var(--section-pad); }
.gutter-section--alt { padding: var(--section-pad); background: var(--color-bg-alt); }
.container { width: 100%; max-width: var(--max-width); margin-inline: auto; padding-inline: var(--space-lg); }
.section-heading {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 700;
  line-height: 1.15;
  letter-spacing: -0.02em;
  text-wrap: balance;
  color: var(--color-primary-dark);
  margin-bottom: var(--space-lg);
}
.gradient-word {
  background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.prose { max-width: 65ch; }
.prose p { font-family: var(--font-body); font-size: 1rem; line-height: 1.7; color: var(--color-text); margin-bottom: var(--space-lg); }
.prose p:last-child { margin-bottom: 0; }

/* ── Materials comparison (C7 — signature: visual material table) ── */
.gutter-materials-section {
  padding: var(--section-pad);
  background: var(--color-bg);
}
.gutter-materials-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: var(--space-lg);
  margin-top: var(--space-3xl);
}
.gutter-material-card {
  border-radius: var(--radius-lg);
  overflow: hidden;
  border: 2px solid rgba(0,0,0,0.06);
  transition: border-color var(--transition-base), box-shadow var(--transition-base);
}
.gutter-material-card:hover {
  border-color: var(--color-accent);
  box-shadow: var(--shadow-md);
}
.gutter-material-header {
  padding: var(--space-lg);
  background: var(--color-primary);
  text-align: center;
}
.gutter-material-header.accent-header { background: var(--color-accent); }
.gutter-material-name {
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 700;
  color: #fff;
  letter-spacing: 0.04em;
  text-transform: uppercase;
}
.gutter-material-header.accent-header .gutter-material-name { color: var(--color-primary-dark); }
.gutter-material-body { padding: var(--space-lg); background: var(--color-bg-alt); height: 100%; }
.gutter-material-lifespan {
  font-family: var(--font-heading);
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--color-primary-dark);
  display: block;
  margin-bottom: var(--space-xs);
}
.gutter-material-desc {
  font-family: var(--font-body);
  font-size: 0.85rem;
  color: var(--color-text-light);
  line-height: 1.6;
  margin: 0;
}
.gutter-material-tag {
  display: inline-block;
  font-family: var(--font-heading);
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.07em;
  text-transform: uppercase;
  padding: 3px 10px;
  border-radius: 100px;
  background: rgba(var(--color-accent-rgb), 0.12);
  color: var(--color-accent);
  border: 1px solid rgba(var(--color-accent-rgb), 0.25);
  margin-top: var(--space-md);
  display: block;
  width: fit-content;
}

/* ── Detail split ────────────────────────────────────────────────── */
.gutter-split {
  display: grid;
  grid-template-columns: 1.1fr 0.9fr;
  gap: var(--space-4xl);
  align-items: start;
}
.gutter-split-image {
  position: relative;
  border-radius: var(--radius-lg);
  overflow: visible;
  box-shadow: var(--shadow-xl);
}
.gutter-split-image picture, .gutter-split-image img {
  display: block;
  width: 100%;
  aspect-ratio: 4/5;
  object-fit: cover;
  border-radius: var(--radius-lg);
}
/* C6.2 — overlapping detail badge */
.gutter-detail-badge {
  position: absolute;
  bottom: -20px;
  left: -20px;
  background: var(--color-primary);
  color: #fff;
  padding: var(--space-lg) var(--space-xl);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-lg);
  z-index: 2;
}
.gutter-detail-badge .badge-num {
  font-family: var(--font-heading);
  font-size: 2rem;
  font-weight: 700;
  color: var(--color-accent);
  line-height: 1;
  display: block;
}
.gutter-detail-badge .badge-label {
  font-family: var(--font-body);
  font-size: 0.76rem;
  color: rgba(255,255,255,0.75);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-top: var(--space-xs);
  display: block;
}

/* ── Why choose us bullets ───────────────────────────────────────── */
.gutter-reasons {
  list-style: none;
  padding: 0;
  margin: var(--space-xl) 0 0;
  display: flex;
  flex-direction: column;
  gap: var(--space-md);
}
.gutter-reason {
  display: flex;
  gap: var(--space-md);
  align-items: flex-start;
}
.gutter-reason-icon {
  flex-shrink: 0;
  width: 38px;
  height: 38px;
  border-radius: 50%;
  background: rgba(var(--color-primary-rgb), 0.08);
  border: 1px solid rgba(var(--color-primary-rgb), 0.15);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-primary);
  margin-top: 2px;
}
.gutter-reason-icon svg { width: 17px; height: 17px; }
.gutter-reason-title { font-family: var(--font-heading); font-size: 0.97rem; font-weight: 700; color: var(--color-primary-dark); margin-bottom: var(--space-xs); }
.gutter-reason-body { font-family: var(--font-body); font-size: 0.88rem; color: var(--color-text-light); line-height: 1.6; margin: 0; }

/* ── Process steps (C6.5) ────────────────────────────────────────── */
.gutter-steps {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-2xl);
  margin-top: var(--space-3xl);
}
.gutter-step { position: relative; text-align: center; }
.gutter-step::after {
  content: '';
  position: absolute;
  top: 27px;
  left: calc(50% + 32px);
  width: calc(100% - 64px);
  height: 2px;
  background: linear-gradient(90deg, var(--color-primary), rgba(var(--color-primary-rgb), 0.1));
}
.gutter-step:last-child::after { display: none; }
.gutter-step-num {
  width: 54px;
  height: 54px;
  border-radius: 50%;
  background: var(--color-primary);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 1.3rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto var(--space-lg);
  position: relative;
  z-index: 1;
  box-shadow: 0 4px 16px rgba(var(--color-primary-rgb), 0.3);
}
.gutter-step-title { font-family: var(--font-heading); font-size: 1.05rem; font-weight: 700; color: var(--color-primary-dark); margin-bottom: var(--space-sm); }
.gutter-step-body { font-family: var(--font-body); font-size: 0.88rem; color: var(--color-text-light); line-height: 1.65; margin: 0; }

/* ── CTA Banner (C4.2) ────────────────────────────────────────────── */
.gutter-cta-banner {
  position: relative;
  overflow: hidden;
  background: linear-gradient(108deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
  padding: var(--space-4xl) var(--space-lg);
}
.gutter-cta-banner::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.06'/%3E%3C/svg%3E");
  background-size: 200px 200px;
  pointer-events: none;
  z-index: 0;
}
.gutter-cta-inner { position: relative; z-index: 1; text-align: center; max-width: 700px; margin-inline: auto; }
.gutter-cta-banner h2 { font-family: var(--font-heading); font-size: clamp(1.7rem, 3.5vw, 2.4rem); font-weight: 700; color: #fff; letter-spacing: -0.01em; text-wrap: balance; margin-bottom: var(--space-md); }
.gutter-cta-banner p { font-family: var(--font-body); font-size: 1.05rem; color: rgba(255,255,255,0.82); line-height: 1.65; margin-bottom: var(--space-2xl); }
.gutter-cta-phone { display: block; font-family: var(--font-heading); font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 700; color: var(--color-accent); letter-spacing: 0.02em; text-decoration: none; margin-bottom: var(--space-xl); transition: opacity var(--transition-fast); }
.gutter-cta-phone:hover { opacity: 0.85; }
.gutter-cta-actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }

/* ── FAQ ────────────────────────────────────────────────────────── */
.gutter-faq-section { padding: var(--section-pad); background: var(--color-bg-alt); }
.gutter-faq-list { margin-top: var(--space-3xl); max-width: 820px; margin-inline: auto; display: flex; flex-direction: column; gap: var(--space-md); }
.faq-item { background: var(--color-bg); border: 1px solid rgba(0,0,0,0.07); border-radius: var(--radius-md); overflow: hidden; }
.faq-question {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: var(--space-md);
  padding: var(--space-lg);
  background: none;
  border: none;
  cursor: pointer;
  text-align: left;
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 700;
  color: var(--color-primary-dark);
  letter-spacing: 0.01em;
  transition: color var(--transition-fast);
}
.faq-question:hover { color: var(--color-primary); }
.faq-question:focus-visible { outline: 2px solid var(--color-accent); outline-offset: 2px; }
.faq-icon { flex-shrink: 0; width: 20px; height: 20px; color: var(--color-accent); transition: transform var(--transition-base); }
.faq-item.is-open .faq-icon { transform: rotate(180deg); }
.faq-answer { max-height: 0; overflow: hidden; transition: max-height var(--transition-base); }
.faq-answer-inner { padding: 0 var(--space-lg) var(--space-lg); font-family: var(--font-body); font-size: 0.95rem; color: var(--color-text); line-height: 1.7; }

/* ── Closing CTA ─────────────────────────────────────────────────── */
.gutter-closing-cta { padding: var(--section-pad); background: var(--color-bg); text-align: center; }
.gutter-closing-cta h2 { font-family: var(--font-heading); font-size: clamp(1.7rem, 3.5vw, 2.4rem); font-weight: 700; color: var(--color-primary-dark); text-wrap: balance; margin-bottom: var(--space-md); }
.gutter-closing-cta p { font-family: var(--font-body); font-size: 1.05rem; color: var(--color-text-light); line-height: 1.65; max-width: 52ch; margin-inline: auto; margin-bottom: var(--space-2xl); }
.gutter-closing-actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }

/* ── SVG Dividers ────────────────────────────────────────────────── */
.svg-divider { display: block; line-height: 0; overflow: hidden; }
.svg-divider svg { display: block; width: 100%; }

/* ── Responsive ──────────────────────────────────────────────────── */
@media (max-width: 1023px) {
  .gutter-materials-grid { grid-template-columns: repeat(2, 1fr); }
  .gutter-split { grid-template-columns: 1fr; gap: var(--space-2xl); }
  .gutter-split-image { order: -1; }
  .gutter-detail-badge { left: var(--space-md); bottom: var(--space-md); }
  .gutter-steps { grid-template-columns: 1fr; }
  .gutter-step::after { display: none; }
}
@media (max-width: 767px) {
  .gutter-hero { min-height: 70vh; }
  .gutter-hero-actions { flex-direction: column; align-items: flex-start; }
  .gutter-section,
  .gutter-section--alt,
  .gutter-materials-section,
  .gutter-faq-section,
  .gutter-closing-cta { padding: var(--section-pad-mobile); }
  .gutter-cta-banner { padding: var(--space-3xl) var(--space-md); }
  .gutter-materials-grid { grid-template-columns: 1fr; }
  .container { padding-inline: var(--space-md); }
}
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
/* ── Project Photo Strip ─────────────────────────────────────────── */
.gutter-photo-strip {
  padding: var(--space-3xl) 0;
  background: var(--color-bg-alt);
}
.gutter-photo-pair {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-md);
}
.gutter-photo-pair-item {
  border-radius: var(--radius-lg);
  overflow: hidden;
  aspect-ratio: 4/3;
  box-shadow: var(--shadow-card);
}
.gutter-photo-pair-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--transition-base);
}
.gutter-photo-pair-item:hover img { transform: scale(1.04); }
@media (max-width: 767px) {
  .gutter-photo-pair { grid-template-columns: 1fr; }
}
</style>

<!-- ── Hero (CTA #1) ─────────────────────────────────────────────────────── -->
<section class="gutter-hero" aria-labelledby="gutter-hero-h1">
  <div class="gutter-hero-inner">
    <div class="container">
      <span class="eyebrow-pill eyebrow-pill--light">Gutter Installation &amp; Repair</span>
      <h1 id="gutter-hero-h1">
        Gutter Installation in<br>
        <span class="hero-accent"><?php echo htmlspecialchars(($address['city'] ?: 'Your Area') . ', ' . ($address['state'] ?: ''), ENT_QUOTES, 'UTF-8'); ?></span>
      </h1>
      <p class="gutter-hero-sub">
        Seamless gutters formed on-site — no joints, no joint leaks. Correctly sized, properly pitched, and fastened to last without pulling away from the fascia.
      </p>
      <div class="gutter-hero-actions">
        <a href="/contact" class="btn-svc-primary">
          <i data-lucide="droplets" aria-hidden="true"></i>
          Get a Free Gutter Estimate
        </a>
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>" class="gutter-hero-phone">
          <i data-lucide="phone" aria-hidden="true"></i>
          <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php else: ?>
        <a href="/contact" class="gutter-hero-phone">
          <i data-lucide="calendar" aria-hidden="true"></i>
          Schedule a Measurement
        </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ── Breadcrumb ────────────────────────────────────────────────────────── -->
<nav class="breadcrumb-bar" aria-label="Breadcrumb">
  <div class="container">
    <ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="/" itemprop="item"><span itemprop="name">Home</span></a>
        <meta itemprop="position" content="1">
      </li>
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="/services" itemprop="item"><span itemprop="name">Services</span></a>
        <meta itemprop="position" content="2">
      </li>
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">Gutter Installation</span>
        <meta itemprop="position" content="3">
      </li>
    </ol>
  </div>
</nav>

<!-- ── Service Detail ────────────────────────────────────────────────────── -->
<section class="gutter-section" aria-labelledby="gutter-detail-h2" data-animate="fade-up">
  <div class="container">
    <div class="gutter-split">

      <!-- Content column -->
      <div>
        <span class="eyebrow-pill">Seamless Gutter Systems</span>
        <h2 id="gutter-detail-h2" class="section-heading">
          <span class="gradient-word">Gutters</span> That Actually Protect Your Home
        </h2>
        <p class="last-updated-line">Last Updated: April 2026</p>
        <div class="prose">
          <p>Gutters are a functional component of your roof system, not an afterthought. When they fail — clog, pull away from fascia, overflow, or route water toward the foundation — the damage they cause to fascia, soffit, foundation, and landscaping can cost far more than a proper gutter installation would have. We install seamless aluminum gutters formed on-site to match your exact roofline dimensions, with no joints along runs — the most common source of gutter leaks.</p>
          <p>Material and sizing options we offer: 5-inch K-style aluminum (standard residential), 6-inch K-style aluminum (high-flow areas, larger roof surfaces), half-round aluminum (traditional architectural look), and seamless copper (premium — patinas over time, 50+ year lifespan). Downspout sizing and placement are calculated based on actual roof surface area and local rainfall data, not guesswork.</p>
          <p>Gutter guards reduce maintenance and prevent clogging from leaves and debris. We install micro-mesh guard systems that allow water through while blocking organic material. Guards don't eliminate all maintenance, but they extend cleaning intervals dramatically and prevent the standing water buildup that causes gutter rust, fascia rot, and pest issues. We'll give you an honest assessment of whether guards make sense for your specific tree cover and roof slope.</p>
        </div>

        <ul class="gutter-reasons" aria-label="Why choose us for gutter installation">
          <li class="gutter-reason">
            <div class="gutter-reason-icon" aria-hidden="true"><i data-lucide="link-2-off"></i></div>
            <div>
              <p class="gutter-reason-title">Seamless gutters formed on-site</p>
              <p class="gutter-reason-body">No joints along the run means no joint-seam leaks — the most common failure point in sectional gutter systems.</p>
            </div>
          </li>
          <li class="gutter-reason">
            <div class="gutter-reason-icon" aria-hidden="true"><i data-lucide="ruler"></i></div>
            <div>
              <p class="gutter-reason-title">Properly sized for your actual roof area</p>
              <p class="gutter-reason-body">Sized to handle actual water volume during heavy rain events, not default sizing that looks right but overflows during downpours.</p>
            </div>
          </li>
          <li class="gutter-reason">
            <div class="gutter-reason-icon" aria-hidden="true"><i data-lucide="anchor"></i></div>
            <div>
              <p class="gutter-reason-title">Secure fastening that protects the fascia</p>
              <p class="gutter-reason-body">Hidden hangers at 24-inch intervals — not spike-and-ferrule which loosens over time and pulls the gutter away from the board.</p>
            </div>
          </li>
          <li class="gutter-reason">
            <div class="gutter-reason-icon" aria-hidden="true"><i data-lucide="home"></i></div>
            <div>
              <p class="gutter-reason-title">Downspout routing that protects your foundation</p>
              <p class="gutter-reason-body">Poorly placed or undersized downspouts are a direct path to basement water intrusion and foundation problems.</p>
            </div>
          </li>
        </ul>
      </div>

      <!-- Image column with overlapping badge (C6.2) -->
      <div class="gutter-split-image" data-animate="wipe-right">
        <div class="gutter-detail-badge" aria-hidden="true">
          <span class="badge-num">20–30</span>
          <span class="badge-label">Year lifespan, aluminum</span>
        </div>
        <picture>
          <img src="/assets/images/photo-057.jpg" alt="Residential roof repair in progress showing asphalt shingles, gutters, and protective mesh netting installation" width="600" height="750" loading="lazy">
        </picture>
      </div>

    </div>
  </div>
</section>

<!-- ── SVG Divider: diagonal-down ──────────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" style="height:60px">
    <polygon fill="var(--color-bg)" points="0,0 1200,60 1200,60 0,60"/>
  </svg>
</div>

<!-- ── Materials Comparison (C7 — signature section) ────────────────────── -->
<section class="gutter-materials-section" aria-labelledby="gutter-materials-h2" data-animate="fade-up">
  <div class="container">
    <div style="text-align:center; max-width:600px; margin-inline:auto;">
      <span class="eyebrow-pill">Material Options</span>
      <h2 id="gutter-materials-h2" class="section-heading">Four Profiles. The Right One for Your Home.</h2>
      <p style="font-family:var(--font-body); color:var(--color-text-light); line-height:1.65; margin-bottom:var(--space-sm);">We form seamless gutters on-site from coil stock — size and material selected during your free estimate based on roof area, slope, and style preference.</p>
    </div>
    <div class="gutter-materials-grid">
      <div class="gutter-material-card">
        <div class="gutter-material-header">
          <p class="gutter-material-name">5" K-Style Aluminum</p>
        </div>
        <div class="gutter-material-body">
          <span class="gutter-material-lifespan">20–30 yrs</span>
          <p class="gutter-material-desc">Standard residential profile. Handles typical roof surface areas efficiently, widely available in 20+ colors to match fascia or trim.</p>
          <span class="gutter-material-tag">Most Common Choice</span>
        </div>
      </div>
      <div class="gutter-material-card">
        <div class="gutter-material-header accent-header">
          <p class="gutter-material-name">6" K-Style Aluminum</p>
        </div>
        <div class="gutter-material-body">
          <span class="gutter-material-lifespan">20–30 yrs</span>
          <p class="gutter-material-desc">High-flow profile for larger roof sections or areas with heavy rainfall. Recommended when a 5" gutter would overflow during storms.</p>
          <span class="gutter-material-tag">High-Flow Areas</span>
        </div>
      </div>
      <div class="gutter-material-card">
        <div class="gutter-material-header">
          <p class="gutter-material-name">Half-Round Aluminum</p>
        </div>
        <div class="gutter-material-body">
          <span class="gutter-material-lifespan">20–30 yrs</span>
          <p class="gutter-material-desc">Traditional curved profile that complements colonial, craftsman, and historically styled homes. Slightly lower volume than K-style.</p>
          <span class="gutter-material-tag">Traditional Architecture</span>
        </div>
      </div>
      <div class="gutter-material-card">
        <div class="gutter-material-header">
          <p class="gutter-material-name">Seamless Copper</p>
        </div>
        <div class="gutter-material-body">
          <span class="gutter-material-lifespan">50+ yrs</span>
          <p class="gutter-material-desc">Premium option that develops a natural patina over time. The last gutters you'll ever install — priced accordingly, worth it for the right home.</p>
          <span class="gutter-material-tag">Premium / Permanent</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── SVG Divider: wave ──────────────────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 80" preserveAspectRatio="none" style="height:80px">
    <path d="M0,40 C300,0 900,80 1200,40 L1200,80 L0,80 Z" fill="var(--color-bg-alt)"/>
  </svg>
</div>

<!-- ── Process Steps (C6.5) ─────────────────────────────────────────────── -->
<section class="gutter-section--alt" aria-labelledby="gutter-process-h2" data-animate="fade-up">
  <div class="container">
    <div style="text-align:center; max-width:600px; margin-inline:auto;">
      <span class="eyebrow-pill">Installation Process</span>
      <h2 id="gutter-process-h2" class="section-heading">From Measurement to Water Test</h2>
      <p style="font-family:var(--font-body); color:var(--color-text-light); line-height:1.65; margin-bottom:var(--space-sm);">Three steps from free estimate to a fully functional gutter system.</p>
    </div>
    <div class="gutter-steps">
      <div class="gutter-step" data-animate="fade-up">
        <div class="gutter-step-num" aria-hidden="true">1</div>
        <h3 class="gutter-step-title">Measurement &amp; System Design</h3>
        <p class="gutter-step-body">We measure the full roofline, calculate water volume per section based on slope and surface area, and determine downspout locations and sizing. Existing fascia is inspected for rot before installation begins.</p>
      </div>
      <div class="gutter-step" data-animate="fade-up" style="--delay:100ms">
        <div class="gutter-step-num" aria-hidden="true">2</div>
        <h3 class="gutter-step-title">On-Site Fabrication &amp; Installation</h3>
        <p class="gutter-step-body">Seamless gutters are formed on-site from coil stock in your selected color and profile. Installed with hidden hangers, proper pitch toward downspouts, and sealed end caps.</p>
      </div>
      <div class="gutter-step" data-animate="fade-up" style="--delay:200ms">
        <div class="gutter-step-num" aria-hidden="true">3</div>
        <h3 class="gutter-step-title">Downspout Routing &amp; Water Test</h3>
        <p class="gutter-step-body">Downspouts are directed away from the foundation using extensions or underground drainage where appropriate. We run a water test before completion to verify pitch and flow.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── Project Photos ─────────────────────────────────────────────────────── -->
<section class="gutter-photo-strip" aria-label="Gutter installation project photos">
  <div class="container">
    <div class="gutter-photo-pair">
      <div class="gutter-photo-pair-item" data-animate="fade-up">
        <picture>
          <img src="/assets/images/photo-001.jpg" alt="Close-up aerial view of gray asphalt shingles with metal roof flashing and gutters, showing roofing material detail and installation" width="600" height="450" loading="lazy">
        </picture>
      </div>
      <div class="gutter-photo-pair-item" data-animate="fade-up" style="animation-delay:80ms">
        <picture>
          <img src="/assets/images/photo-002.jpg" alt="Newly installed asphalt shingle roof with gray dimensional shingles and white PVC pipe penetration" width="600" height="450" loading="lazy">
        </picture>
      </div>
    </div>
  </div>
</section>

<!-- ── CTA Banner (CTA #2) ───────────────────────────────────────────────── -->
<section class="gutter-cta-banner" aria-labelledby="gutter-cta2-h2">
  <div class="container">
    <div class="gutter-cta-inner">
      <span class="eyebrow-pill eyebrow-pill--light">Protect Your Home</span>
      <h2 id="gutter-cta2-h2">Failing Gutters Damage More Than the Gutters</h2>
      <p>Fascia rot, foundation water intrusion, and soffit damage all trace back to gutters that don't work. A correct installation pays for itself in what it prevents.</p>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="gutter-cta-phone" aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php endif; ?>
      <div class="gutter-cta-actions">
        <a href="/contact" class="btn-svc-primary">
          <i data-lucide="droplets" aria-hidden="true"></i>
          Get Your Free Estimate
        </a>
        <a href="/services" class="btn-svc-outline">View All Services</a>
      </div>
    </div>
  </div>
</section>

<!-- ── SVG Divider: diagonal-up ──────────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" style="height:60px">
    <polygon fill="var(--color-bg-alt)" points="0,60 1200,0 1200,60 0,60"/>
  </svg>
</div>

<!-- ── FAQ ──────────────────────────────────────────────────────────────── -->
<section class="gutter-faq-section" aria-labelledby="gutter-faq-h2" data-animate="fade-up">
  <div class="container">
    <div style="text-align:center; max-width:600px; margin-inline:auto;">
      <span class="eyebrow-pill">Common Questions</span>
      <h2 id="gutter-faq-h2" class="section-heading">Gutter Installation Questions</h2>
      <p style="font-family:var(--font-body); color:var(--color-text-light); line-height:1.65; margin-bottom:var(--space-sm);">Cost, lifespan, and whether you need gutter guards — answered directly.</p>
    </div>
    <div class="gutter-faq-list">
      <?php foreach ($faqs as $i => $faq): ?>
      <div class="faq-item" id="gfaq-<?php echo $i; ?>">
        <button class="faq-question"
                aria-expanded="false"
                aria-controls="gfaq-answer-<?php echo $i; ?>"
                onclick="toggleFaq(this)">
          <?php echo htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8'); ?>
          <i data-lucide="chevron-down" class="faq-icon" aria-hidden="true"></i>
        </button>
        <div class="faq-answer" id="gfaq-answer-<?php echo $i; ?>" role="region">
          <div class="faq-answer-inner">
            <?php echo htmlspecialchars($faq['answer'], ENT_QUOTES, 'UTF-8'); ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── SVG Divider ────────────────────────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" style="height:60px">
    <polygon fill="var(--color-bg)" points="0,0 1200,60 1200,60 0,60"/>
  </svg>
</div>

<!-- ── Closing CTA (CTA #3) ─────────────────────────────────────────────── -->
<section class="gutter-closing-cta" aria-labelledby="gutter-cta3-h2" data-animate="fade-up">
  <div class="container">
    <span class="eyebrow-pill">Get Started</span>
    <h2 id="gutter-cta3-h2">Ready to Stop the Water Where It Starts?</h2>
    <p>Free measurements, on-site fabrication, and a water test before we leave. Get an exact price for your home — no approximations.</p>
    <div class="gutter-closing-actions">
      <a href="/contact" class="btn-svc-primary">
        <i data-lucide="droplets" aria-hidden="true"></i>
        Get Your Free Estimate
      </a>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="btn-svc-secondary">
        <i data-lucide="phone" aria-hidden="true"></i>
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php else: ?>
      <a href="/services" class="btn-svc-secondary">
        <i data-lucide="grid" aria-hidden="true"></i>
        All Roofing Services
      </a>
      <?php endif; ?>
    </div>
  </div>
</section>

<script>
function toggleFaq(btn) {
  var item   = btn.closest('.faq-item');
  var answer = item.querySelector('.faq-answer');
  var isOpen = item.classList.contains('is-open');
  document.querySelectorAll('.faq-item.is-open').forEach(function(open) {
    if (open !== item) {
      open.classList.remove('is-open');
      open.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
      open.querySelector('.faq-answer').style.maxHeight = '0';
    }
  });
  if (isOpen) {
    item.classList.remove('is-open');
    btn.setAttribute('aria-expanded', 'false');
    answer.style.maxHeight = '0';
  } else {
    item.classList.add('is-open');
    btn.setAttribute('aria-expanded', 'true');
    answer.style.maxHeight = answer.scrollHeight + 'px';
    if (typeof lucide !== 'undefined') lucide.createIcons();
  }
}
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
