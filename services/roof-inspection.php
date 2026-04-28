<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$faqs = [
    [
        'question' => 'How much does a roof inspection cost?',
        'answer'   => 'We offer free inspections as part of estimating roofing work. For standalone inspection reports — pre-purchase, insurance documentation, or independent assessment — fees typically run $150–$300 depending on home size. The cost is typically offset by what you learn before making a major decision.',
    ],
    [
        'question' => 'How long does a roof inspection take?',
        'answer'   => 'Most residential inspections take 45 minutes to 1.5 hours depending on the home\'s size and roof complexity. Written reports are delivered within 24–48 hours.',
    ],
    [
        'question' => 'Can I be home during the inspection?',
        'answer'   => 'Yes, and we recommend it. We\'re happy to walk you through findings on the spot, point out what we\'re seeing, and answer questions in real time. If you\'re buying a home and can\'t be there, we\'ll document everything thoroughly in the written report.',
    ],
];

$schemaMarkup = json_encode([
    generateServiceSchema(
        ['name' => 'Roof Inspection', 'description' => 'Professional roof inspection services with written reports, timestamped photos, and condition assessments — for pre-purchase, insurance renewal, and annual maintenance.'],
        $siteUrl,
        $siteName
    ),
    generateFAQSchema($faqs),
    generateBreadcrumbSchema([
        ['name' => 'Home',     'url' => $siteUrl . '/'],
        ['name' => 'Services', 'url' => $siteUrl . '/services'],
        ['name' => 'Roof Inspection'],
    ]),
    generateHowToSchema(
        'How a Roof Inspection Works — A-1 Roof Works LLC',
        'Three steps from scheduling to written report — we confirm the appointment, physically walk the entire roof, and deliver a detailed PDF report within 24–48 hours.',
        [
            ['name' => 'Schedule & Prepare',
             'text' => 'We confirm the inspection appointment, review any available records (age of roof, previous repairs), and arrive with full inspection equipment and camera.'],
            ['name' => 'Full Roof Assessment',
             'text' => 'Systematic walk of the entire roof surface, all penetrations, all flashing joints, gutters, and visible decking at eaves. Photos taken at every area of concern.'],
            ['name' => 'Written Report Delivery',
             'text' => 'Organized PDF report within 24–48 hours covering condition by section, priority findings, estimated lifespan, and cost-range recommendations for any identified work.'],
        ]
    ),
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

$pageTitle        = 'Roof Inspection Services in ' . ($address['city'] ?: 'Your Area') . ', ' . ($address['state'] ?: '') . ' | ' . $siteName;
$pageDescription  = 'Thorough roof inspections with written reports and photos. Pre-purchase, insurance renewal, or annual condition checks. ' . ($address['city'] ? 'Serving ' . $address['city'] . ', ' . $address['state'] . '.' : 'Licensed and insured.');
$canonicalUrl     = $siteUrl . '/services/roof-inspection';
$currentPage      = 'services';
$heroPreloadImage = '/assets/images/roof-inspection-hero.png';
$ogImage          = '/assets/images/roof-inspection-hero.png';

// SEO: <link rel="canonical"> + <script type="application/ld+json"> are rendered by includes/head.php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<style>
/* ═══════════════════════════════════════════════════════════════
   ROOF INSPECTION — Page-specific styles
   Standard tier: 200+ lines, ≥ 4 distinct visual techniques
   C1 hero, C3 dividers, C4.2 CTA banner, C5.2 eyebrow,
   C5.3 gradient text, C6.5 numbered steps, C7 signature
════════════════════════════════════════════════════════════════ */

/* ── Hero (C1.1) ─────────────────────────────────────────────────── */
.insp-hero {
  position: relative;
  min-height: 60vh;
  display: flex;
  align-items: center;
  background-image: url('/assets/images/roof-inspection-hero.png');
  background-size: cover;
  background-position: center 40%;
  overflow: hidden;
}
/* ::before — lighter gradient (professional/analytical tone) */
.insp-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    105deg,
    rgba(var(--color-primary-rgb), 0.78) 0%,
    rgba(var(--color-primary-rgb), 0.45) 55%,
    rgba(var(--color-primary-rgb), 0.22) 100%
  );
  z-index: 1;
}
/* ::after — SVG noise texture overlay */
.insp-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
  background-repeat: repeat;
  background-size: 200px 200px;
  opacity: 0.04;
  z-index: 2;
  pointer-events: none;
}
.insp-hero-inner {
  position: relative;
  z-index: 3;
  padding: var(--section-pad);
  width: 100%;
}
.insp-hero .container { max-width: var(--max-width); margin-inline: auto; padding-inline: var(--space-lg); }
.insp-hero h1 {
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
/* C5.3 — gradient text on subtitle keyword */
.insp-hero .hero-accent {
  background: linear-gradient(90deg, var(--color-accent), #ffd04d);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.insp-hero-sub {
  font-family: var(--font-body);
  font-size: clamp(1rem, 2vw, 1.18rem);
  color: rgba(255,255,255,0.88);
  max-width: 520px;
  line-height: 1.6;
  margin-bottom: var(--space-2xl);
}
.insp-hero-actions {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: var(--space-lg);
}
/* CTA #1 button */
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
  white-space: nowrap;
  text-decoration: none;
}
.btn-svc-primary:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.18); }
.btn-svc-primary:active { transform: translateY(2px);  box-shadow: 0 2px 0 rgba(0,0,0,0.18); }
.insp-hero-phone {
  display: inline-flex;
  align-items: center;
  gap: var(--space-xs);
  color: rgba(255,255,255,0.92);
  font-family: var(--font-heading);
  font-size: 1.05rem;
  font-weight: 600;
  letter-spacing: 0.02em;
  text-decoration: none;
  transition: color var(--transition-fast);
}
.insp-hero-phone:hover { color: var(--color-accent); }
.insp-hero-phone svg { width: 18px; height: 18px; }

/* ── Breadcrumb bar ──────────────────────────────────────────────── */
.breadcrumb-bar {
  background: var(--color-bg-alt);
  border-bottom: 1px solid rgba(0,0,0,0.07);
  padding: var(--space-sm) 0;
}
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
.breadcrumb-list li + li::before {
  content: '/';
  margin-right: var(--space-xs);
  opacity: 0.5;
}
.breadcrumb-list a {
  color: var(--color-secondary);
  text-decoration: none;
  transition: color var(--transition-fast);
}
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
.eyebrow-pill--light {
  background: rgba(255,255,255,0.12);
  color: rgba(255,255,255,0.9);
  border-color: rgba(255,255,255,0.25);
}

/* ── Section headings ────────────────────────────────────────────── */
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
/* C5.3 — gradient on a key word */
.gradient-word {
  background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* ── Section padding / containers ────────────────────────────────── */
.insp-section {
  padding: var(--section-pad);
}
.insp-section--alt {
  padding: var(--section-pad);
  background: var(--color-bg-alt);
}
.insp-section--dark {
  padding: var(--section-pad);
  background: var(--color-primary-dark);
  color: #fff;
}
.container {
  width: 100%;
  max-width: var(--max-width);
  margin-inline: auto;
  padding-inline: var(--space-lg);
}
.prose { max-width: 65ch; }
.prose p {
  font-family: var(--font-body);
  font-size: 1rem;
  line-height: 1.7;
  color: var(--color-text);
  margin-bottom: var(--space-lg);
}
.prose p:last-child { margin-bottom: 0; }

/* ── Split layout (service detail) ─────────────────────────────── */
.insp-split {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-4xl);
  align-items: start;
}
.insp-split-image {
  position: relative;
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-xl);
}
.insp-split-image picture,
.insp-split-image img {
  display: block;
  width: 100%;
  aspect-ratio: 4/3;
  object-fit: cover;
}
/* C6.2 — overlapping badge breaking out of image */
.insp-image-badge {
  position: absolute;
  bottom: -16px;
  right: -16px;
  background: var(--color-accent);
  color: var(--color-primary-dark);
  font-family: var(--font-heading);
  font-size: 0.85rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  padding: var(--space-md) var(--space-lg);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-lg);
  max-width: 160px;
  text-align: center;
  line-height: 1.3;
  z-index: 2;
}

/* ── Why Choose Us bullets ───────────────────────────────────────── */
.insp-reasons {
  list-style: none;
  padding: 0;
  margin: var(--space-xl) 0 0;
  display: flex;
  flex-direction: column;
  gap: var(--space-lg);
}
.insp-reason {
  display: flex;
  gap: var(--space-md);
  align-items: flex-start;
}
.insp-reason-icon {
  flex-shrink: 0;
  width: 36px;
  height: 36px;
  background: rgba(var(--color-accent-rgb), 0.12);
  border: 1px solid rgba(var(--color-accent-rgb), 0.25);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-accent);
  margin-top: 2px;
}
.insp-reason-icon svg { width: 16px; height: 16px; }
.insp-reason-title {
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 700;
  color: var(--color-primary-dark);
  margin-bottom: var(--space-xs);
  letter-spacing: 0.01em;
}
.insp-reason-body {
  font-family: var(--font-body);
  font-size: 0.92rem;
  color: var(--color-text-light);
  line-height: 1.6;
  margin: 0;
}

/* ── Process steps (C6.5 numbered circles) ───────────────────────── */
.insp-steps {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-2xl);
  margin-top: var(--space-3xl);
}
.insp-step {
  position: relative;
  text-align: center;
}
.insp-step::after {
  content: '';
  position: absolute;
  top: 28px;
  left: calc(50% + 32px);
  width: calc(100% - 64px);
  height: 2px;
  background: linear-gradient(90deg, var(--color-accent), rgba(var(--color-accent-rgb), 0.15));
}
.insp-step:last-child::after { display: none; }
.insp-step-num {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background: var(--color-primary);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 1.4rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto var(--space-lg);
  position: relative;
  z-index: 1;
  box-shadow: 0 4px 16px rgba(var(--color-primary-rgb), 0.35);
}
.insp-step-title {
  font-family: var(--font-heading);
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--color-primary-dark);
  margin-bottom: var(--space-sm);
  letter-spacing: 0.01em;
}
.insp-step-body {
  font-family: var(--font-body);
  font-size: 0.9rem;
  color: var(--color-text-light);
  line-height: 1.65;
  margin: 0;
}

/* ── CTA Banner (C4.2 diagonal gradient + noise) — CTA #2 ────────── */
.insp-cta-banner {
  position: relative;
  overflow: hidden;
  background: linear-gradient(108deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
  padding: var(--space-4xl) var(--space-lg);
}
.insp-cta-banner::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.06'/%3E%3C/svg%3E");
  background-size: 200px 200px;
  pointer-events: none;
  z-index: 0;
}
.insp-cta-inner {
  position: relative;
  z-index: 1;
  text-align: center;
  max-width: 700px;
  margin-inline: auto;
}
.insp-cta-banner h2 {
  font-family: var(--font-heading);
  font-size: clamp(1.7rem, 3.5vw, 2.4rem);
  font-weight: 700;
  color: #fff;
  letter-spacing: -0.01em;
  text-wrap: balance;
  margin-bottom: var(--space-md);
}
.insp-cta-banner p {
  font-family: var(--font-body);
  font-size: 1.05rem;
  color: rgba(255,255,255,0.82);
  line-height: 1.65;
  margin-bottom: var(--space-2xl);
}
.insp-cta-phone {
  display: block;
  font-family: var(--font-heading);
  font-size: clamp(1.6rem, 3vw, 2.2rem);
  font-weight: 700;
  color: var(--color-accent);
  letter-spacing: 0.02em;
  text-decoration: none;
  margin-bottom: var(--space-xl);
  transition: opacity var(--transition-fast);
}
.insp-cta-phone:hover { opacity: 0.85; }
.insp-cta-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: var(--space-md);
}
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
.btn-svc-outline:hover {
  border-color: #fff;
  background: rgba(255,255,255,0.08);
}

/* ── FAQ section (C7 — signature: accordion with reveal) ─────────── */
.insp-faq-section {
  padding: var(--section-pad);
  background: var(--color-bg-alt);
}
.insp-faq-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-xl);
  margin-top: var(--space-3xl);
  align-items: start;
}
.insp-faq-intro { padding-right: var(--space-2xl); }
.insp-faq-intro .section-heading { margin-bottom: var(--space-lg); }
.insp-faq-intro p {
  font-family: var(--font-body);
  font-size: 1rem;
  color: var(--color-text-light);
  line-height: 1.7;
  margin-bottom: var(--space-md);
}
.insp-faq-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-md);
}
.faq-item {
  background: var(--color-bg);
  border: 1px solid rgba(0,0,0,0.08);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-sm);
  overflow: hidden;
}
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
.faq-icon {
  flex-shrink: 0;
  width: 20px;
  height: 20px;
  color: var(--color-accent);
  transition: transform var(--transition-base);
}
.faq-item.is-open .faq-icon { transform: rotate(180deg); }
.faq-answer {
  max-height: 0;
  overflow: hidden;
  transition: max-height var(--transition-base);
}
.faq-answer-inner {
  padding: 0 var(--space-lg) var(--space-lg);
  font-family: var(--font-body);
  font-size: 0.95rem;
  color: var(--color-text);
  line-height: 1.7;
}

/* ── Closing CTA #3 ──────────────────────────────────────────────── */
.insp-closing-cta {
  padding: var(--section-pad);
  background: var(--color-bg);
  text-align: center;
}
.insp-closing-cta h2 {
  font-family: var(--font-heading);
  font-size: clamp(1.7rem, 3.5vw, 2.4rem);
  font-weight: 700;
  color: var(--color-primary-dark);
  text-wrap: balance;
  margin-bottom: var(--space-md);
}
.insp-closing-cta p {
  font-family: var(--font-body);
  font-size: 1.05rem;
  color: var(--color-text-light);
  line-height: 1.65;
  max-width: 52ch;
  margin-inline: auto;
  margin-bottom: var(--space-2xl);
}
.insp-closing-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: var(--space-md);
}
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

/* ── SVG dividers ────────────────────────────────────────────────── */
.svg-divider { display: block; line-height: 0; overflow: hidden; }
.svg-divider svg { display: block; width: 100%; }

/* ── Responsive ──────────────────────────────────────────────────── */
@media (max-width: 1023px) {
  .insp-split { grid-template-columns: 1fr; gap: var(--space-2xl); }
  .insp-split-image { order: -1; }
  .insp-image-badge { right: var(--space-md); bottom: var(--space-md); }
  .insp-steps { grid-template-columns: 1fr; gap: var(--space-xl); }
  .insp-step::after { display: none; }
  .insp-faq-grid { grid-template-columns: 1fr; }
  .insp-faq-intro { padding-right: 0; }
}
@media (max-width: 767px) {
  .insp-hero { min-height: 70vh; }
  .insp-hero-actions { flex-direction: column; align-items: flex-start; }
  .insp-section,
  .insp-section--alt,
  .insp-section--dark,
  .insp-faq-section,
  .insp-closing-cta { padding: var(--section-pad-mobile); }
  .insp-cta-banner { padding: var(--space-3xl) var(--space-md); }
  .container { padding-inline: var(--space-md); }
}

/* ── Reduced motion ──────────────────────────────────────────────── */
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
/* ── Project Photo Strip ─────────────────────────────────────────── */
.insp-photo-strip {
  padding: var(--space-3xl) 0;
  background: var(--color-bg-alt);
}
.insp-photo-pair {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-md);
}
.insp-photo-pair-item {
  border-radius: var(--radius-lg);
  overflow: hidden;
  aspect-ratio: 4/3;
  box-shadow: var(--shadow-card);
}
.insp-photo-pair-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--transition-base);
}
.insp-photo-pair-item:hover img { transform: scale(1.04); }
@media (max-width: 767px) {
  .insp-photo-pair { grid-template-columns: 1fr; }
}
</style>

<!-- ── Hero (CTA #1) ─────────────────────────────────────────────────────── -->
<section class="insp-hero" aria-labelledby="insp-hero-h1">
  <div class="insp-hero-inner">
    <div class="container">
      <span class="eyebrow-pill eyebrow-pill--light">Roof Inspection Services</span>
      <h1 id="insp-hero-h1">
        Roof Inspection in<br>
        <span class="hero-accent"><?php echo htmlspecialchars(($address['city'] ?: 'Your Area') . ', ' . ($address['state'] ?: ''), ENT_QUOTES, 'UTF-8'); ?></span>
      </h1>
      <p class="insp-hero-sub">
        Written reports with timestamped photos. Pre-purchase, insurance renewal, or annual condition checks. We get on the roof — not a view from the driveway.
      </p>
      <div class="insp-hero-actions">
        <a href="/contact" class="btn-svc-primary">
          <i data-lucide="clipboard-list" aria-hidden="true"></i>
          Get Free Estimate
        </a>
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>" class="insp-hero-phone">
          <i data-lucide="phone" aria-hidden="true"></i>
          <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php else: ?>
        <a href="/contact" class="insp-hero-phone">
          <i data-lucide="calendar" aria-hidden="true"></i>
          Schedule an Inspection
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
        <span itemprop="name">Roof Inspection</span>
        <meta itemprop="position" content="3">
      </li>
    </ol>
  </div>
</nav>

<!-- ── Service Detail ────────────────────────────────────────────────────── -->
<section class="insp-section" aria-labelledby="insp-detail-h2" data-animate="fade-up">
  <div class="container">
    <div class="insp-split">

      <!-- Content column -->
      <div>
        <span class="eyebrow-pill">What to Expect</span>
        <h2 id="insp-detail-h2" class="section-heading">
          <span class="gradient-word">Documented.</span> Systematic. Honest.
        </h2>
        <p class="last-updated-line">Last Updated: April 2026</p>
        <div class="prose">
          <p>A roof inspection done properly takes time. It means getting on the roof, not just walking around the yard with binoculars. We examine every section systematically: shingle condition, granule coverage and loss patterns, flashing seals at all penetrations (chimneys, vents, skylights, valleys), ridge cap integrity, gutters and fascia, and visible signs of decking issues at the eaves. Everything is documented with timestamped photos organized by area.</p>
          <p>Three scenarios where inspection delivers clear value: (1) Pre-purchase — knowing the actual condition of a roof before closing protects buyers from inheriting costly problems. We provide written reports that can be used in purchase negotiations. (2) Insurance renewal — some carriers require proof of condition before issuing or renewing a policy on a roof over 15 years old. Our written report with photos satisfies this requirement. (3) Annual maintenance — catching failed flashing or early granule loss before they become leaks is significantly cheaper than emergency repair after water damage occurs.</p>
          <p>Our inspection report includes: overall condition rating, estimated remaining useful life, priority issues that need immediate attention, items to monitor over the next 12–24 months, and recommendations with approximate cost ranges. You'll know exactly where your roof stands, not just whether it "looks okay."</p>
        </div>

        <!-- Why Choose Us -->
        <ul class="insp-reasons" aria-label="Why choose us for roof inspection">
          <li class="insp-reason">
            <div class="insp-reason-icon" aria-hidden="true">
              <i data-lucide="footprints"></i>
            </div>
            <div>
              <p class="insp-reason-title">We get on the roof</p>
              <p class="insp-reason-body">Not a ground-level visual estimate. Every inspection involves an actual roof walk with systematic documentation of each section.</p>
            </div>
          </li>
          <li class="insp-reason">
            <div class="insp-reason-icon" aria-hidden="true">
              <i data-lucide="file-text"></i>
            </div>
            <div>
              <p class="insp-reason-title">Written report with photos, not a verbal opinion</p>
              <p class="insp-reason-body">You receive a PDF with organized photos by section and a clear written assessment within 24–48 hours of the inspection.</p>
            </div>
          </li>
          <li class="insp-reason">
            <div class="insp-reason-icon" aria-hidden="true">
              <i data-lucide="check-circle"></i>
            </div>
            <div>
              <p class="insp-reason-title">No pressure to sell you anything</p>
              <p class="insp-reason-body">Inspection findings are independent. We'll tell you if the roof needs nothing for 5 years, and we'll tell you if it needs immediate attention. The report is honest regardless.</p>
            </div>
          </li>
          <li class="insp-reason">
            <div class="insp-reason-icon" aria-hidden="true">
              <i data-lucide="clock"></i>
            </div>
            <div>
              <p class="insp-reason-title">Pre-purchase turnaround that fits your timeline</p>
              <p class="insp-reason-body">We can often schedule within 48 hours, which fits most real estate transaction timelines without creating delays.</p>
            </div>
          </li>
        </ul>
      </div>

      <!-- Image column with overlapping badge (C6.2) -->
      <div class="insp-split-image" data-animate="wipe-right">
        <picture>
          <img src="/assets/images/photo-004.jpg" alt="Residential roof in progress showing asphalt shingle installation with metal flashing and completed sections" width="720" height="540" loading="lazy">
        </picture>
        <div class="insp-image-badge" aria-hidden="true">
          Report delivered within 48 hrs
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ── SVG Divider: diagonal-down ──────────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" style="height:60px">
    <polygon fill="var(--color-bg-alt)" points="0,0 1200,60 1200,60 0,60"/>
  </svg>
</div>

<!-- ── How It Works ──────────────────────────────────────────────────────── -->
<section class="insp-section--alt" aria-labelledby="insp-process-h2" data-animate="fade-up">
  <div class="container">
    <div style="text-align:center; max-width: 600px; margin-inline: auto;">
      <span class="eyebrow-pill">The Process</span>
      <h2 id="insp-process-h2" class="section-heading">From Scheduling to Written Report</h2>
      <p class="prose" style="margin-inline:auto; color:var(--color-text-light);">Three steps from first contact to a clear picture of your roof's condition — no upselling, no ambiguity.</p>
    </div>

    <div class="insp-steps">
      <div class="insp-step" data-animate="fade-up">
        <div class="insp-step-num" aria-hidden="true">1</div>
        <h3 class="insp-step-title">Schedule &amp; Prepare</h3>
        <p class="insp-step-body">We confirm the inspection appointment, review any available records (age of roof, previous repairs), and arrive with full inspection equipment and camera.</p>
      </div>
      <div class="insp-step" data-animate="fade-up" style="--delay:100ms">
        <div class="insp-step-num" aria-hidden="true">2</div>
        <h3 class="insp-step-title">Full Roof Assessment</h3>
        <p class="insp-step-body">Systematic walk of the entire roof surface, all penetrations, all flashing joints, gutters, and visible decking at eaves. Photos taken at every area of concern.</p>
      </div>
      <div class="insp-step" data-animate="fade-up" style="--delay:200ms">
        <div class="insp-step-num" aria-hidden="true">3</div>
        <h3 class="insp-step-title">Written Report Delivery</h3>
        <p class="insp-step-body">Organized PDF report within 24–48 hours covering condition by section, priority findings, estimated lifespan, and cost-range recommendations for any identified work.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── Project Photos ─────────────────────────────────────────────────────── -->
<section class="insp-photo-strip" aria-label="Recent roof inspection projects">
  <div class="container">
    <div class="insp-photo-pair">
      <div class="insp-photo-pair-item" data-animate="fade-up">
        <picture>
          <img src="/assets/images/photo-001.jpg" alt="Close-up of asphalt shingle roof with black flashing and drip edge detail showing installation quality" width="600" height="450" loading="lazy">
        </picture>
      </div>
      <div class="insp-photo-pair-item" data-animate="fade-up" style="animation-delay:80ms">
        <picture>
          <img src="/assets/images/photo-006.jpg" alt="Roofer installing new chimney flashing on residential asphalt shingle roof with tools visible" width="600" height="450" loading="lazy">
        </picture>
      </div>
    </div>
  </div>
</section>

<!-- ── SVG Divider: wave ──────────────────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 80" preserveAspectRatio="none" style="height:80px">
    <path d="M0,40 C300,80 900,0 1200,40 L1200,80 L0,80 Z" fill="var(--color-primary)"/>
  </svg>
</div>

<!-- ── CTA Banner (CTA #2) ───────────────────────────────────────────────── -->
<section class="insp-cta-banner" aria-labelledby="insp-cta2-h2">
  <div class="container">
    <div class="insp-cta-inner">
      <span class="eyebrow-pill eyebrow-pill--light">Book Your Inspection</span>
      <h2 id="insp-cta2-h2">Know Your Roof's Actual Condition</h2>
      <p>Written documentation, photos, and an honest assessment — delivered within 48 hours. Useful before closing, before renewing your policy, or just before problems become expensive.</p>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="insp-cta-phone" aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php endif; ?>
      <div class="insp-cta-actions">
        <a href="/contact" class="btn-svc-primary">
          <i data-lucide="calendar-check" aria-hidden="true"></i>
          Schedule an Inspection
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

<!-- ── FAQ (C7 — signature accordion layout) ────────────────────────────── -->
<section class="insp-faq-section" aria-labelledby="insp-faq-h2" data-animate="fade-up">
  <div class="container">
    <div class="insp-faq-grid">
      <div class="insp-faq-intro">
        <span class="eyebrow-pill">Common Questions</span>
        <h2 id="insp-faq-h2" class="section-heading">Roof Inspection Questions Answered</h2>
        <p>Straightforward answers about cost, timing, and what you get — before you schedule.</p>
        <p>If your question isn't here, <a href="/contact" style="color:var(--color-primary); font-weight:600;">reach out directly</a> and we'll give you a straight answer.</p>
      </div>
      <div class="insp-faq-list">
        <?php foreach ($faqs as $i => $faq): ?>
        <div class="faq-item" id="faq-<?php echo $i; ?>">
          <button class="faq-question"
                  aria-expanded="false"
                  aria-controls="faq-answer-<?php echo $i; ?>"
                  onclick="toggleFaq(this)">
            <?php echo htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8'); ?>
            <i data-lucide="chevron-down" class="faq-icon" aria-hidden="true"></i>
          </button>
          <div class="faq-answer" id="faq-answer-<?php echo $i; ?>" role="region">
            <div class="faq-answer-inner">
              <?php echo htmlspecialchars($faq['answer'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ── SVG Divider: diagonal-down (back to white) ─────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" style="height:60px">
    <polygon fill="var(--color-bg)" points="0,0 1200,60 1200,60 0,60"/>
  </svg>
</div>

<!-- ── Closing CTA (CTA #3) ─────────────────────────────────────────────── -->
<section class="insp-closing-cta" aria-labelledby="insp-cta3-h2" data-animate="fade-up">
  <div class="container">
    <span class="eyebrow-pill">Get Started</span>
    <h2 id="insp-cta3-h2">Schedule Your Roof Inspection Today</h2>
    <p>Most inspections are available within 48 hours. Get a written report you can actually use — not just a verbal opinion on your doorstep.</p>
    <div class="insp-closing-actions">
      <a href="/contact" class="btn-svc-primary">
        <i data-lucide="clipboard-list" aria-hidden="true"></i>
        Request an Inspection
      </a>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="btn-svc-secondary">
        <i data-lucide="phone" aria-hidden="true"></i>
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php else: ?>
      <a href="/services" class="btn-svc-secondary">
        <i data-lucide="grid" aria-hidden="true"></i>
        View All Services
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

  /* Close all other items */
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
