<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

/* ── Hardcoded service list (config $services may be empty) ───────── */
$allServices = [
    ['name' => 'Roof Replacement',    'slug' => 'roof-replacement',    'icon' => 'hard-hat',       'desc' => 'Complete tear-off and new roof installation — asphalt, metal, or flat systems. Most residential jobs finished in 1–2 days.'],
    ['name' => 'Roof Repair',         'slug' => 'roof-repair',         'icon' => 'wrench',          'desc' => 'Targeted repairs that fix the actual source — flashing, shingles, valleys, vents. No guesswork, no repeat visits for the same problem.'],
    ['name' => 'Storm Damage Repair', 'slug' => 'storm-damage-repair', 'icon' => 'cloud-lightning', 'desc' => 'Hail and wind damage documentation, insurance claim coordination, and complete repair or replacement.'],
    ['name' => 'Roof Inspection',     'slug' => 'roof-inspection',     'icon' => 'search',          'desc' => 'Written inspection reports with photos — for pre-purchase, insurance renewal, or annual condition assessment.'],
    ['name' => 'Commercial Roofing',  'slug' => 'commercial-roofing',  'icon' => 'building-2',      'desc' => 'TPO, modified bitumen, and low-slope metal systems for commercial buildings and multi-family properties.'],
    ['name' => 'Gutter Installation', 'slug' => 'gutter-installation', 'icon' => 'droplets',        'desc' => 'Seamless gutters formed on-site, properly sized and pitched, with downspouts that protect your foundation.'],
];

$schemaMarkup = json_encode([
    [
        "@context"        => 'https://schema.org',
        '@type'           => 'ItemList',
        'name'            => 'Roofing Services',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Roof Replacement',    'url' => $siteUrl . '/services/roof-replacement'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Roof Repair',         'url' => $siteUrl . '/services/roof-repair'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Storm Damage Repair', 'url' => $siteUrl . '/services/storm-damage-repair'],
            ['@type' => 'ListItem', 'position' => 4, 'name' => 'Roof Inspection',     'url' => $siteUrl . '/services/roof-inspection'],
            ['@type' => 'ListItem', 'position' => 5, 'name' => 'Commercial Roofing',  'url' => $siteUrl . '/services/commercial-roofing'],
            ['@type' => 'ListItem', 'position' => 6, 'name' => 'Gutter Installation', 'url' => $siteUrl . '/services/gutter-installation'],
        ],
    ],
    generateBreadcrumbSchema([
        ['name' => 'Home',     'url' => $siteUrl . '/'],
        ['name' => 'Services'],
    ]),
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

$pageTitle        = 'Roofing Services in ' . ($address['city'] ?: 'Your Area') . ', ' . ($address['state'] ?: '') . ' | ' . $siteName;
$pageDescription  = 'Roof replacement, repair, storm damage, inspections, commercial roofing, and gutters. ' . $siteName . ' serves ' . ($address['city'] ? $address['city'] . ', ' . $address['state'] . ' ' : '') . 'and surrounding areas. Licensed and insured.';
$canonicalUrl     = $siteUrl . '/services';
$currentPage      = 'services';
$ogImage          = '/assets/images/roof-replacement-hero.png';

// SEO: <link rel="canonical"> + <script type="application/ld+json"> are rendered by includes/head.php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<style>
/* ═══════════════════════════════════════════════════════════════
   SERVICES INDEX — Unique layout and CSS
   Standard tier: 200+ lines, ≥ 4 visual techniques
   C1 hero (split composition), C3 dividers, C4.2 CTA banner,
   C5.2 eyebrow pills, C5.3 gradient text, C7 signature ticker row
════════════════════════════════════════════════════════════════ */

/* ── Hero — asymmetric split (distinct from service sub-pages) ─── */
.svc-index-hero {
  position: relative;
  min-height: 50vh;
  display: grid;
  grid-template-columns: 1fr 1fr;
  overflow: hidden;
}
/* Left panel: primary brand color */
.svc-hero-left {
  position: relative;
  background: var(--color-primary-dark);
  display: flex;
  align-items: center;
  padding: var(--section-pad);
  z-index: 2;
}
/* ::before — noise on left panel */
.svc-hero-left::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.05'/%3E%3C/svg%3E");
  background-size: 200px 200px;
  pointer-events: none;
}
/* Diagonal overlap: left panel clips into right at an angle */
.svc-hero-left::after {
  content: '';
  position: absolute;
  top: 0;
  right: -60px;
  width: 120px;
  height: 100%;
  background: var(--color-primary-dark);
  clip-path: polygon(0 0, 0 100%, 100% 100%, 40% 0);
  z-index: 3;
}
.svc-hero-left-inner { position: relative; z-index: 4; max-width: 520px; }
/* Right panel: photo background */
.svc-hero-right {
  position: relative;
  background-image: url('/assets/images/roof-replacement-hero.png');
  background-size: cover;
  background-position: center 30%;
}
.svc-hero-right::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(var(--color-primary-rgb), 0.25), rgba(0,0,0,0.1));
}
.svc-index-hero h1 {
  font-family: var(--font-heading);
  font-size: clamp(2rem, 4vw, 3.2rem);
  font-weight: 700;
  line-height: 1.12;
  letter-spacing: -0.02em;
  text-wrap: balance;
  color: #fff;
  margin-bottom: var(--space-md);
}
/* C5.3 gradient text */
.svc-hero-accent {
  background: linear-gradient(90deg, var(--color-accent), #ffd04d);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.svc-hero-sub {
  font-family: var(--font-body);
  font-size: 1rem;
  color: rgba(255,255,255,0.82);
  line-height: 1.65;
  margin-bottom: var(--space-2xl);
  max-width: 42ch;
}
.svc-hero-actions { display: flex; flex-wrap: wrap; gap: var(--space-md); align-items: center; }

/* ── Shared buttons ──────────────────────────────────────────────── */
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
.btn-svc-outline-dark {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: transparent;
  color: var(--color-primary);
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  padding: 13px var(--space-2xl);
  border-radius: var(--radius-md);
  border: 2px solid var(--color-primary);
  text-decoration: none;
  transition: background var(--transition-fast), color var(--transition-fast);
}
.btn-svc-outline-dark:hover { background: var(--color-primary); color: #fff; }
.btn-svc-outline-white {
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
}
.btn-svc-outline-white:hover { border-color: #fff; background: rgba(255,255,255,0.08); }
.svc-hero-phone {
  display: inline-flex;
  align-items: center;
  gap: var(--space-xs);
  color: rgba(255,255,255,0.88);
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 600;
  text-decoration: none;
  transition: color var(--transition-fast);
}
.svc-hero-phone:hover { color: var(--color-accent); }

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

/* ── Container / spacing ─────────────────────────────────────────── */
.container { width: 100%; max-width: var(--max-width); margin-inline: auto; padding-inline: var(--space-lg); }
.svc-section { padding: var(--section-pad); }
.svc-section--alt { padding: var(--section-pad); background: var(--color-bg-alt); }
.section-heading {
  font-family: var(--font-heading);
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  font-weight: 700;
  line-height: 1.15;
  letter-spacing: -0.02em;
  text-wrap: balance;
  color: var(--color-primary-dark);
  margin-bottom: var(--space-md);
}
.gradient-word {
  background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* ── Service cards grid ──────────────────────────────────────────── */
.svc-intro { max-width: 60ch; margin-bottom: var(--space-3xl); }
.svc-intro p { font-family: var(--font-body); font-size: 1rem; color: var(--color-text-light); line-height: 1.7; }
.svc-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-xl);
}
.svc-card {
  background: var(--color-bg);
  border: 1px solid rgba(0,0,0,0.07);
  border-radius: var(--radius-lg);
  padding: var(--space-2xl);
  box-shadow: var(--shadow-card);
  display: flex;
  flex-direction: column;
  transition: transform var(--transition-base), box-shadow var(--transition-base), border-color var(--transition-base);
  text-decoration: none;
  color: inherit;
  position: relative;
  overflow: hidden;
}
.svc-card::before {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--color-primary), var(--color-accent));
  opacity: 0;
  transition: opacity var(--transition-base);
}
.svc-card:hover {
  transform: translateY(-6px);
  box-shadow: var(--shadow-xl);
  border-color: rgba(var(--color-accent-rgb), 0.3);
}
.svc-card:hover::before { opacity: 1; }
.svc-card:focus-visible { outline: 2px solid var(--color-accent); outline-offset: 3px; }
.svc-card-icon {
  width: 52px;
  height: 52px;
  border-radius: var(--radius-md);
  background: rgba(var(--color-primary-rgb), 0.08);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-primary);
  margin-bottom: var(--space-lg);
  transition: background var(--transition-base), color var(--transition-base);
}
.svc-card-icon svg { width: 24px; height: 24px; }
.svc-card:hover .svc-card-icon { background: var(--color-accent); color: var(--color-primary-dark); }
.svc-card-name {
  font-family: var(--font-heading);
  font-size: 1.15rem;
  font-weight: 700;
  color: var(--color-primary-dark);
  letter-spacing: 0.01em;
  margin-bottom: var(--space-sm);
  transition: color var(--transition-fast);
}
.svc-card:hover .svc-card-name { color: var(--color-primary); }
.svc-card-desc {
  font-family: var(--font-body);
  font-size: 0.9rem;
  color: var(--color-text-light);
  line-height: 1.65;
  flex: 1;
  margin-bottom: var(--space-lg);
}
.svc-card-link {
  display: inline-flex;
  align-items: center;
  gap: var(--space-xs);
  font-family: var(--font-heading);
  font-size: 0.88rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  color: var(--color-primary);
  text-transform: uppercase;
  transition: gap var(--transition-fast), color var(--transition-fast);
  text-decoration: none;
}
.svc-card-link svg { width: 14px; height: 14px; transition: transform var(--transition-fast); }
.svc-card:hover .svc-card-link { color: var(--color-accent); gap: var(--space-sm); }
.svc-card:hover .svc-card-link svg { transform: translateX(3px); }

/* ── CTA Banner (C4.2) — CTA #2 ──────────────────────────────────── */
.svc-cta-banner {
  position: relative;
  overflow: hidden;
  background: linear-gradient(110deg, var(--color-primary) 0%, var(--color-primary-dark) 60%, rgba(0,0,0,0.9) 100%);
  padding: var(--space-4xl) var(--space-lg);
}
.svc-cta-banner::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.06'/%3E%3C/svg%3E");
  background-size: 200px 200px;
  pointer-events: none;
  z-index: 0;
}
.svc-cta-inner { position: relative; z-index: 1; text-align: center; max-width: 700px; margin-inline: auto; }
.svc-cta-banner h2 { font-family: var(--font-heading); font-size: clamp(1.7rem, 3.5vw, 2.4rem); font-weight: 700; color: #fff; letter-spacing: -0.01em; text-wrap: balance; margin-bottom: var(--space-md); }
.svc-cta-banner p { font-family: var(--font-body); font-size: 1.05rem; color: rgba(255,255,255,0.82); line-height: 1.65; margin-bottom: var(--space-2xl); }
.svc-cta-phone { display: block; font-family: var(--font-heading); font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 700; color: var(--color-accent); letter-spacing: 0.02em; text-decoration: none; margin-bottom: var(--space-xl); transition: opacity var(--transition-fast); }
.svc-cta-phone:hover { opacity: 0.85; }
.svc-cta-actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }

/* ── Why A-1 Roof Works section (C7 — signature horizontal trust bar) */
.svc-trust-section {
  padding: var(--section-pad);
  background: var(--color-bg);
}
.svc-trust-header {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-4xl);
  align-items: center;
  margin-bottom: var(--space-3xl);
}
.svc-trust-header-text .section-heading { margin-bottom: var(--space-md); }
.svc-trust-header-text p { font-family: var(--font-body); font-size: 1rem; color: var(--color-text-light); line-height: 1.7; max-width: 48ch; }
.svc-trust-stats {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-xl);
}
.svc-trust-stat {
  background: var(--color-bg-alt);
  border-radius: var(--radius-lg);
  padding: var(--space-xl);
  border-left: 4px solid var(--color-accent);
}
.svc-trust-stat-num {
  font-family: var(--font-heading);
  font-size: 2.4rem;
  font-weight: 700;
  color: var(--color-primary);
  line-height: 1;
  display: block;
}
.svc-trust-stat-label { font-family: var(--font-body); font-size: 0.82rem; color: var(--color-text-light); letter-spacing: 0.04em; text-transform: uppercase; margin-top: var(--space-xs); display: block; }
.svc-trust-points {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: var(--space-xl);
  border-top: 1px solid rgba(0,0,0,0.07);
  padding-top: var(--space-3xl);
}
.svc-trust-point { text-align: center; }
.svc-trust-point-icon {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background: rgba(var(--color-primary-rgb), 0.07);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-primary);
  margin: 0 auto var(--space-md);
}
.svc-trust-point-icon svg { width: 24px; height: 24px; }
.svc-trust-point-title { font-family: var(--font-heading); font-size: 1rem; font-weight: 700; color: var(--color-primary-dark); margin-bottom: var(--space-xs); letter-spacing: 0.01em; }
.svc-trust-point-body { font-family: var(--font-body); font-size: 0.87rem; color: var(--color-text-light); line-height: 1.6; margin: 0; }

/* ── Closing CTA #3 ──────────────────────────────────────────────── */
.svc-closing-cta { padding: var(--section-pad); background: var(--color-bg-alt); text-align: center; }
.svc-closing-cta h2 { font-family: var(--font-heading); font-size: clamp(1.7rem, 3.5vw, 2.4rem); font-weight: 700; color: var(--color-primary-dark); text-wrap: balance; margin-bottom: var(--space-md); }
.svc-closing-cta p { font-family: var(--font-body); font-size: 1.05rem; color: var(--color-text-light); line-height: 1.65; max-width: 52ch; margin-inline: auto; margin-bottom: var(--space-2xl); }
.svc-closing-actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }

/* ── SVG Dividers ────────────────────────────────────────────────── */
.svg-divider { display: block; line-height: 0; overflow: hidden; }
.svg-divider svg { display: block; width: 100%; }

/* ── Responsive ──────────────────────────────────────────────────── */
@media (max-width: 1023px) {
  .svc-index-hero { grid-template-columns: 1fr; }
  .svc-hero-right { display: none; }
  .svc-hero-left::after { display: none; }
  .svc-hero-left { padding: var(--section-pad); }
  .svc-grid { grid-template-columns: repeat(2, 1fr); }
  .svc-trust-header { grid-template-columns: 1fr; gap: var(--space-2xl); }
  .svc-trust-points { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 767px) {
  .svc-index-hero { min-height: 55vh; }
  .svc-grid { grid-template-columns: 1fr; }
  .svc-section,
  .svc-section--alt,
  .svc-trust-section,
  .svc-closing-cta { padding: var(--section-pad-mobile); }
  .svc-cta-banner { padding: var(--space-3xl) var(--space-md); }
  .svc-trust-stats { grid-template-columns: 1fr 1fr; }
  .svc-trust-points { grid-template-columns: 1fr; gap: var(--space-lg); }
  .container { padding-inline: var(--space-md); }
}
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
</style>

<!-- ── Hero (CTA #1) ─────────────────────────────────────────────────────── -->
<section class="svc-index-hero" aria-labelledby="svc-hero-h1">
  <!-- Left: content panel -->
  <div class="svc-hero-left">
    <div class="svc-hero-left-inner">
      <span class="eyebrow-pill eyebrow-pill--light">Complete Roofing Services</span>
      <h1 id="svc-hero-h1">
        Expert Roofing Services in<br>
        <span class="svc-hero-accent"><?php echo htmlspecialchars(($address['city'] ?: 'Your Area') . ', ' . ($address['state'] ?: ''), ENT_QUOTES, 'UTF-8'); ?></span>
      </h1>
      <p class="svc-hero-sub">
        Replacements, repairs, storm damage, inspections, commercial systems, and gutters. One licensed and insured contractor — from first call to final cleanup.
      </p>
      <div class="svc-hero-actions">
        <a href="/contact" class="btn-svc-primary">
          <i data-lucide="clipboard-list" aria-hidden="true"></i>
          Get Free Estimate
        </a>
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>" class="svc-hero-phone">
          <i data-lucide="phone" aria-hidden="true"></i>
          <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php else: ?>
        <a href="/contact" class="svc-hero-phone">
          <i data-lucide="calendar" aria-hidden="true"></i>
          Schedule a Visit
        </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <!-- Right: photo panel (hidden on mobile) -->
  <div class="svc-hero-right" aria-hidden="true"></div>
</section>

<!-- ── BREADCRUMB ─────────────────────────────────────────────────────────── -->
<nav class="bc-bar" aria-label="Breadcrumb">
  <div class="container">
    <ol class="bc-list" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="/" itemprop="item"><span itemprop="name">Home</span></a>
        <meta itemprop="position" content="1">
      </li>
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">Services</span>
        <meta itemprop="position" content="2">
      </li>
    </ol>
  </div>
</nav>

<!-- ── Service Cards Grid ────────────────────────────────────────────────── -->
<section class="svc-section" aria-labelledby="svc-grid-h2" data-animate="fade-up">
  <div class="container">

    <div class="svc-intro">
      <span class="eyebrow-pill">What We Do</span>
      <h2 id="svc-grid-h2" class="section-heading">
        Six Services. <span class="gradient-word">One Reliable Crew.</span>
      </h2>
      <p>Every job — residential or commercial, repair or full replacement — is handled by the same licensed team. No subcontracting. No middlemen. The crew that shows up is the crew that does the work.</p>
      <p class="last-updated-line">Last Updated: April 2026</p>
    </div>

    <div class="svc-grid">
      <?php foreach ($allServices as $svc): ?>
      <a href="/services/<?php echo htmlspecialchars($svc['slug'], ENT_QUOTES, 'UTF-8'); ?>"
         class="svc-card"
         data-animate="fade-up"
         aria-label="<?php echo htmlspecialchars($svc['name'], ENT_QUOTES, 'UTF-8'); ?> — Learn More">
        <div class="svc-card-icon" aria-hidden="true">
          <i data-lucide="<?php echo htmlspecialchars($svc['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
        </div>
        <p class="svc-card-name"><?php echo htmlspecialchars($svc['name'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p class="svc-card-desc"><?php echo htmlspecialchars($svc['desc'], ENT_QUOTES, 'UTF-8'); ?></p>
        <span class="svc-card-link" aria-hidden="true">
          Learn More
          <i data-lucide="arrow-right"></i>
        </span>
      </a>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ── SVG Divider: diagonal-down ──────────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" style="height:60px">
    <polygon fill="var(--color-primary)" points="0,0 1200,60 1200,60 0,60"/>
  </svg>
</div>

<!-- ── CTA Banner (CTA #2) ───────────────────────────────────────────────── -->
<section class="svc-cta-banner" aria-labelledby="svc-cta2-h2">
  <div class="container">
    <div class="svc-cta-inner">
      <span class="eyebrow-pill eyebrow-pill--light">Free Estimates</span>
      <h2 id="svc-cta2-h2">Not Sure Which Service You Need?</h2>
      <p>Tell us what you're seeing — we'll inspect it, tell you what it is, and tell you what it costs to fix. No charge for the visit, no pressure to hire us.</p>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="svc-cta-phone" aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php endif; ?>
      <div class="svc-cta-actions">
        <a href="/contact" class="btn-svc-primary">
          <i data-lucide="clipboard-list" aria-hidden="true"></i>
          Request a Free Estimate
        </a>
        <a href="/service-area" class="btn-svc-outline-white">Our Service Area</a>
      </div>
    </div>
  </div>
</section>

<!-- ── SVG Divider: wave ──────────────────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 80" preserveAspectRatio="none" style="height:80px; background:var(--color-primary-dark)">
    <path d="M0,40 C300,80 900,0 1200,40 L1200,80 L0,80 Z" fill="var(--color-bg)"/>
  </svg>
</div>

<!-- ── Why A-1 Roof Works (C7 — signature: stats + trust grid) ──────────── -->
<section class="svc-trust-section" aria-labelledby="svc-trust-h2" data-animate="fade-up">
  <div class="container">
    <div class="svc-trust-header">
      <div class="svc-trust-header-text">
        <span class="eyebrow-pill">Why Choose Us</span>
        <h2 id="svc-trust-h2" class="section-heading">What Sets <span class="gradient-word">A-1 Roof Works</span> Apart</h2>
        <p>We're a local roofing company — not a national franchise with local brand. Every job is done by our own licensed crew, and we stand behind the work with our own warranty. Here's what that means in practice.</p>
      </div>
      <div class="svc-trust-stats" aria-label="Key facts about A-1 Roof Works">
        <?php if (!empty($yearsInBusiness)): ?>
        <div class="svc-trust-stat">
          <span class="svc-trust-stat-num"><?php echo htmlspecialchars($yearsInBusiness, ENT_QUOTES, 'UTF-8'); ?>+</span>
          <span class="svc-trust-stat-label">Years in Business</span>
        </div>
        <?php else: ?>
        <div class="svc-trust-stat">
          <span class="svc-trust-stat-num">6</span>
          <span class="svc-trust-stat-label">Roofing Services Offered</span>
        </div>
        <?php endif; ?>
        <?php if (!empty($aggregateRating)): ?>
        <div class="svc-trust-stat">
          <span class="svc-trust-stat-num"><?php echo htmlspecialchars($aggregateRating, ENT_QUOTES, 'UTF-8'); ?></span>
          <span class="svc-trust-stat-label">Average Customer Rating</span>
        </div>
        <?php else: ?>
        <div class="svc-trust-stat">
          <span class="svc-trust-stat-num">1–2</span>
          <span class="svc-trust-stat-label">Day Typical Residential Turnaround</span>
        </div>
        <?php endif; ?>
        <div class="svc-trust-stat">
          <span class="svc-trust-stat-num">100%</span>
          <span class="svc-trust-stat-label">Licensed &amp; Insured Coverage</span>
        </div>
        <div class="svc-trust-stat">
          <span class="svc-trust-stat-num">$0</span>
          <span class="svc-trust-stat-label">Cost for Your Free Estimate</span>
        </div>
      </div>
    </div>

    <div class="svc-trust-points">
      <div class="svc-trust-point" data-animate="fade-up">
        <div class="svc-trust-point-icon" aria-hidden="true">
          <i data-lucide="users"></i>
        </div>
        <p class="svc-trust-point-title">Our Crew, Not Subs</p>
        <p class="svc-trust-point-body">No third-party labor. Every job is installed by our own licensed employees — people we've trained and stand behind.</p>
      </div>
      <div class="svc-trust-point" data-animate="fade-up" style="--delay:100ms">
        <div class="svc-trust-point-icon" aria-hidden="true">
          <i data-lucide="file-check"></i>
        </div>
        <p class="svc-trust-point-title">Written Estimates and Warranties</p>
        <p class="svc-trust-point-body">Scope, materials, and price in writing before work begins. Workmanship warranty in writing when it's done.</p>
      </div>
      <div class="svc-trust-point" data-animate="fade-up" style="--delay:200ms">
        <div class="svc-trust-point-icon" aria-hidden="true">
          <i data-lucide="map-pin"></i>
        </div>
        <p class="svc-trust-point-title">Local — Not a Franchise</p>
        <p class="svc-trust-point-body">We're based here. We know the local building codes, common local roof problems, and the neighborhoods we work in.</p>
      </div>
      <div class="svc-trust-point" data-animate="fade-up" style="--delay:300ms">
        <div class="svc-trust-point-icon" aria-hidden="true">
          <i data-lucide="shield-check"></i>
        </div>
        <p class="svc-trust-point-title">Licensed, Bonded, and Insured</p>
        <p class="svc-trust-point-body">Full liability and workers' comp coverage protects you and your property. Available to verify on request.</p>
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

<!-- ── Closing CTA (CTA #3) ─────────────────────────────────────────────── -->
<section class="svc-closing-cta" aria-labelledby="svc-cta3-h2" data-animate="fade-up">
  <div class="container">
    <span class="eyebrow-pill">Get Started</span>
    <h2 id="svc-cta3-h2">Ready to Get an Honest Assessment of Your Roof?</h2>
    <p>Free estimates with no obligation. Same-day availability on emergency repairs. We'll tell you exactly what needs to be done — and what doesn't.</p>
    <div class="svc-closing-actions">
      <a href="/contact" class="btn-svc-primary">
        <i data-lucide="clipboard-list" aria-hidden="true"></i>
        Get Your Free Estimate
      </a>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="btn-svc-secondary">
        <i data-lucide="phone" aria-hidden="true"></i>
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php else: ?>
      <a href="/about" class="btn-svc-secondary">
        <i data-lucide="info" aria-hidden="true"></i>
        About Our Company
      </a>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
