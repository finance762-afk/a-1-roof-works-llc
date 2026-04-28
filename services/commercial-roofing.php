<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$faqs = [
    [
        'question' => 'What commercial roofing systems do you install?',
        'answer'   => 'We install TPO (thermoplastic polyolefin) membrane, modified bitumen (torch-applied and cold-applied), EPDM rubber membrane, and low-slope standing seam metal. System selection depends on slope, existing structure, budget, and performance requirements. We\'ll walk you through the options.',
    ],
    [
        'question' => 'How do you handle active businesses during commercial roofing?',
        'answer'   => 'We schedule installation phases to minimize disruption — early start times, weekend work, and phased completion to keep sections functional. We communicate the schedule upfront and flag any noise-intensive phases in advance.',
    ],
    [
        'question' => 'Do you provide commercial roofing warranties?',
        'answer'   => 'Yes — both manufacturer material warranties (typically 15–30 years depending on system and installation tier) and our own workmanship warranty. We handle manufacturer warranty registration as part of project closeout.',
    ],
];

$schemaMarkup = json_encode([
    generateServiceSchema(
        ['name' => 'Commercial Roofing', 'description' => 'Commercial roofing installation and replacement — TPO membrane, modified bitumen, EPDM, and low-slope standing seam metal for commercial buildings and multi-family properties.'],
        $siteUrl,
        $siteName
    ),
    generateFAQSchema($faqs),
    generateBreadcrumbSchema([
        ['name' => 'Home',     'url' => $siteUrl . '/'],
        ['name' => 'Services', 'url' => $siteUrl . '/services'],
        ['name' => 'Commercial Roofing'],
    ]),
    generateHowToSchema(
        'How Commercial Roofing Works — A-1 Roof Works LLC',
        'Four steps from site assessment to closeout documentation — system selection, detailed proposal, phased installation, and complete warranty documentation.',
        [
            ['name' => 'Site Assessment & System Selection',
             'text' => 'We inspect the existing roof system, drainage configuration, penetrations, and access points. We then recommend the appropriate system based on slope, use, budget, and warranty requirements.'],
            ['name' => 'Detailed Scope & Proposal',
             'text' => 'Written scope covering materials, phases, crew schedule, and project timeline. Commercial proposals include manufacturer product specifications and warranty terms.'],
            ['name' => 'Phased Installation',
             'text' => 'Phased where needed to keep portions of the building operational. Dedicated project manager, daily progress updates, site protection throughout.'],
            ['name' => 'Completion Documentation',
             'text' => 'As-built photos, warranty registration, and closeout documentation for your records — everything property management, ownership, or financing requires.'],
        ]
    ),
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

$pageTitle        = 'Commercial Roofing in ' . ($address['city'] ?: 'Your Area') . ', ' . ($address['state'] ?: '') . ' | ' . $siteName;
$pageDescription  = 'Commercial roofing installation — TPO, modified bitumen, EPDM, and low-slope metal systems. Scheduling flexibility for active businesses and multi-family properties. ' . ($address['city'] ? 'Serving ' . $address['city'] . ', ' . $address['state'] . '.' : '');
$canonicalUrl     = $siteUrl . '/services/commercial-roofing';
$currentPage      = 'services';
$heroPreloadImage = '/assets/images/commercial-roofing-hero.png';
$ogImage          = '/assets/images/commercial-roofing-hero.png';

// SEO: <link rel="canonical"> + <script type="application/ld+json"> are rendered by includes/head.php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<style>
/* ═══════════════════════════════════════════════════════════════
   COMMERCIAL ROOFING — Page-specific styles
   Standard tier: 200+ lines, ≥ 4 distinct visual techniques
   C1 hero (bold/industrial), C3 dividers, C4.2 CTA banner,
   C5.2 eyebrow, C5.3 gradient text, C6.5 numbered steps, C7 signature
════════════════════════════════════════════════════════════════ */

/* ── Hero (C1.1 — bold/industrial dark overlay) ───────────────────── */
.comm-hero {
  position: relative;
  min-height: 60vh;
  display: flex;
  align-items: center;
  background-image: url('/assets/images/commercial-roofing-hero.png');
  background-size: cover;
  background-position: center 35%;
  overflow: hidden;
}
/* ::before — deeper, darker gradient for industrial feel */
.comm-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    112deg,
    rgba(var(--color-primary-rgb), 0.93) 0%,
    rgba(var(--color-primary-rgb), 0.72) 50%,
    rgba(0,0,0,0.55) 100%
  );
  z-index: 1;
}
/* ::after — coarser noise texture, slightly higher opacity (industrial) */
.comm-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.06'/%3E%3C/svg%3E");
  background-size: 200px 200px;
  opacity: 0.06;
  z-index: 2;
  pointer-events: none;
}
.comm-hero-inner {
  position: relative;
  z-index: 3;
  padding: var(--section-pad);
  width: 100%;
}
.comm-hero .container { max-width: var(--max-width); margin-inline: auto; padding-inline: var(--space-lg); }
.comm-hero h1 {
  font-family: var(--font-heading);
  font-size: clamp(2.3rem, 5.5vw, 4rem);
  font-weight: 700;
  line-height: 1.1;
  letter-spacing: -0.02em;
  text-wrap: balance;
  color: #fff;
  max-width: 720px;
  margin-bottom: var(--space-md);
}
/* C5.3 — accent-colored gradient text */
.comm-hero .hero-accent {
  background: linear-gradient(90deg, var(--color-accent), #ffd04d);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.comm-hero-sub {
  font-family: var(--font-body);
  font-size: clamp(1rem, 2vw, 1.15rem);
  color: rgba(255,255,255,0.85);
  max-width: 560px;
  line-height: 1.65;
  margin-bottom: var(--space-2xl);
}
.comm-hero-actions {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: var(--space-lg);
}
/* Trust strip in hero (industrial badge row) */
.comm-hero-trust {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-lg);
  margin-top: var(--space-2xl);
  padding-top: var(--space-xl);
  border-top: 1px solid rgba(255,255,255,0.15);
}
.comm-trust-item {
  display: flex;
  align-items: center;
  gap: var(--space-sm);
  font-family: var(--font-heading);
  font-size: 0.85rem;
  font-weight: 600;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.78);
}
.comm-trust-item svg { width: 16px; height: 16px; color: var(--color-accent); }

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
.comm-hero-phone {
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
.comm-hero-phone:hover { color: var(--color-accent); }

/* ── Breadcrumb ──────────────────────────────────────────────────── */
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
.eyebrow-pill--light {
  background: rgba(255,255,255,0.12);
  color: rgba(255,255,255,0.9);
  border-color: rgba(255,255,255,0.25);
}

/* ── Section containers / padding ────────────────────────────────── */
.comm-section { padding: var(--section-pad); }
.comm-section--alt { padding: var(--section-pad); background: var(--color-bg-alt); }
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

/* ── Service systems grid (C7 — signature section) ────────────────── */
.comm-systems-section {
  padding: var(--section-pad);
  background: var(--color-primary-dark);
  position: relative;
  overflow: hidden;
}
.comm-systems-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
  background-size: 200px 200px;
  pointer-events: none;
}
.comm-systems-inner { position: relative; z-index: 1; }
.comm-systems-section .section-heading { color: #fff; }
.comm-systems-section .eyebrow-pill { background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.85); border-color: rgba(255,255,255,0.2); }
.comm-systems-section .section-sub {
  font-family: var(--font-body);
  font-size: 1rem;
  color: rgba(255,255,255,0.72);
  max-width: 55ch;
  line-height: 1.65;
  margin-bottom: var(--space-3xl);
}
.comm-systems-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: var(--space-xl);
}
.comm-system-card {
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: var(--radius-lg);
  padding: var(--space-2xl);
  transition: background var(--transition-base), border-color var(--transition-base);
}
.comm-system-card:hover {
  background: rgba(255,255,255,0.09);
  border-color: rgba(var(--color-accent-rgb), 0.4);
}
.comm-system-icon {
  width: 48px;
  height: 48px;
  background: rgba(var(--color-accent-rgb), 0.15);
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-accent);
  margin-bottom: var(--space-lg);
}
.comm-system-icon svg { width: 24px; height: 24px; }
.comm-system-name {
  font-family: var(--font-heading);
  font-size: 1.15rem;
  font-weight: 700;
  color: #fff;
  letter-spacing: 0.01em;
  margin-bottom: var(--space-sm);
}
.comm-system-desc {
  font-family: var(--font-body);
  font-size: 0.9rem;
  color: rgba(255,255,255,0.7);
  line-height: 1.65;
  margin: 0;
}

/* ── Detail split ────────────────────────────────────────────────── */
.comm-detail-split {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-4xl);
  align-items: start;
}
.comm-detail-image {
  position: relative;
  border-radius: var(--radius-lg);
  overflow: visible;
  box-shadow: var(--shadow-xl);
}
.comm-detail-image picture, .comm-detail-image img {
  display: block;
  width: 100%;
  aspect-ratio: 3/4;
  object-fit: cover;
  border-radius: var(--radius-lg);
}
/* C6.2 — overlapping stat card */
.comm-stat-overlay {
  position: absolute;
  top: -20px;
  left: -20px;
  background: var(--color-primary);
  color: #fff;
  padding: var(--space-lg) var(--space-xl);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-lg);
  z-index: 2;
  min-width: 140px;
}
.comm-stat-num {
  font-family: var(--font-heading);
  font-size: 2.2rem;
  font-weight: 700;
  color: var(--color-accent);
  line-height: 1;
  display: block;
}
.comm-stat-label {
  font-family: var(--font-body);
  font-size: 0.78rem;
  color: rgba(255,255,255,0.75);
  letter-spacing: 0.04em;
  text-transform: uppercase;
  margin-top: var(--space-xs);
  display: block;
}

/* ── Why choose us bullets ───────────────────────────────────────── */
.comm-reasons {
  list-style: none;
  padding: 0;
  margin: var(--space-xl) 0 0;
  display: flex;
  flex-direction: column;
  gap: var(--space-lg);
}
.comm-reason {
  display: flex;
  gap: var(--space-md);
  align-items: flex-start;
  padding: var(--space-lg);
  background: var(--color-bg-alt);
  border-radius: var(--radius-md);
  border-left: 3px solid var(--color-accent);
}
.comm-reason-num {
  flex-shrink: 0;
  font-family: var(--font-heading);
  font-size: 1.4rem;
  font-weight: 700;
  color: var(--color-accent);
  line-height: 1;
  min-width: 24px;
  margin-top: 2px;
}
.comm-reason-title {
  font-family: var(--font-heading);
  font-size: 0.97rem;
  font-weight: 700;
  color: var(--color-primary-dark);
  margin-bottom: var(--space-xs);
  letter-spacing: 0.01em;
}
.comm-reason-body {
  font-family: var(--font-body);
  font-size: 0.88rem;
  color: var(--color-text-light);
  line-height: 1.6;
  margin: 0;
}

/* ── Process steps (C6.5) ────────────────────────────────────────── */
.comm-steps {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: var(--space-xl);
  margin-top: var(--space-3xl);
  counter-reset: steps;
}
.comm-step {
  position: relative;
}
.comm-step::after {
  content: '';
  position: absolute;
  top: 27px;
  left: calc(50% + 28px);
  width: calc(100% - 56px);
  height: 2px;
  background: rgba(var(--color-accent-rgb), 0.25);
}
.comm-step:last-child::after { display: none; }
.comm-step-num {
  width: 54px;
  height: 54px;
  border-radius: 50%;
  background: var(--color-accent);
  color: var(--color-primary-dark);
  font-family: var(--font-heading);
  font-size: 1.3rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: var(--space-lg);
  position: relative;
  z-index: 1;
  box-shadow: 0 4px 14px rgba(var(--color-accent-rgb), 0.35);
}
.comm-step-title {
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 700;
  color: var(--color-primary-dark);
  margin-bottom: var(--space-sm);
  letter-spacing: 0.01em;
}
.comm-step-body {
  font-family: var(--font-body);
  font-size: 0.88rem;
  color: var(--color-text-light);
  line-height: 1.65;
  margin: 0;
}

/* ── CTA Banner (C4.2) ────────────────────────────────────────────── */
.comm-cta-banner {
  position: relative;
  overflow: hidden;
  background: linear-gradient(110deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
  padding: var(--space-4xl) var(--space-lg);
}
.comm-cta-banner::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.06'/%3E%3C/svg%3E");
  background-size: 200px 200px;
  pointer-events: none;
  z-index: 0;
}
.comm-cta-inner { position: relative; z-index: 1; text-align: center; max-width: 700px; margin-inline: auto; }
.comm-cta-banner h2 {
  font-family: var(--font-heading);
  font-size: clamp(1.7rem, 3.5vw, 2.4rem);
  font-weight: 700;
  color: #fff;
  letter-spacing: -0.01em;
  text-wrap: balance;
  margin-bottom: var(--space-md);
}
.comm-cta-banner p { font-family: var(--font-body); font-size: 1.05rem; color: rgba(255,255,255,0.82); line-height: 1.65; margin-bottom: var(--space-2xl); }
.comm-cta-phone {
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
.comm-cta-phone:hover { opacity: 0.85; }
.comm-cta-actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }

/* ── FAQ ────────────────────────────────────────────────────────── */
.comm-faq-section { padding: var(--section-pad); }
.comm-faq-list { margin-top: var(--space-3xl); max-width: 800px; margin-inline: auto; display: flex; flex-direction: column; gap: var(--space-md); }
.faq-item { background: var(--color-bg-alt); border: 1px solid rgba(0,0,0,0.07); border-radius: var(--radius-md); overflow: hidden; }
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
.comm-closing-cta { padding: var(--section-pad); background: var(--color-bg-alt); text-align: center; }
.comm-closing-cta h2 { font-family: var(--font-heading); font-size: clamp(1.7rem, 3.5vw, 2.4rem); font-weight: 700; color: var(--color-primary-dark); text-wrap: balance; margin-bottom: var(--space-md); }
.comm-closing-cta p { font-family: var(--font-body); font-size: 1.05rem; color: var(--color-text-light); line-height: 1.65; max-width: 52ch; margin-inline: auto; margin-bottom: var(--space-2xl); }
.comm-closing-actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-md); }

/* ── SVG Dividers ────────────────────────────────────────────────── */
.svg-divider { display: block; line-height: 0; overflow: hidden; }
.svg-divider svg { display: block; width: 100%; }

/* ── Responsive ──────────────────────────────────────────────────── */
@media (max-width: 1023px) {
  .comm-detail-split { grid-template-columns: 1fr; gap: var(--space-2xl); }
  .comm-detail-image { order: -1; }
  .comm-stat-overlay { top: var(--space-md); left: var(--space-md); }
  .comm-systems-grid { grid-template-columns: 1fr; }
  .comm-steps { grid-template-columns: repeat(2, 1fr); }
  .comm-step::after { display: none; }
}
@media (max-width: 767px) {
  .comm-hero { min-height: 70vh; }
  .comm-hero-actions { flex-direction: column; align-items: flex-start; }
  .comm-hero-trust { gap: var(--space-md); }
  .comm-section,
  .comm-section--alt,
  .comm-systems-section,
  .comm-faq-section,
  .comm-closing-cta { padding: var(--section-pad-mobile); }
  .comm-cta-banner { padding: var(--space-3xl) var(--space-md); }
  .comm-steps { grid-template-columns: 1fr; }
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
.comm-photo-strip {
  padding: var(--space-3xl) 0;
  background: var(--color-bg-alt);
}
.comm-photo-pair {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-md);
}
.comm-photo-pair-item {
  border-radius: var(--radius-lg);
  overflow: hidden;
  aspect-ratio: 4/3;
  box-shadow: var(--shadow-card);
}
.comm-photo-pair-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--transition-base);
}
.comm-photo-pair-item:hover img { transform: scale(1.04); }
@media (max-width: 767px) {
  .comm-photo-pair { grid-template-columns: 1fr; }
}
</style>

<!-- ── Hero (CTA #1) ─────────────────────────────────────────────────────── -->
<section class="comm-hero" aria-labelledby="comm-hero-h1">
  <div class="comm-hero-inner">
    <div class="container">
      <span class="eyebrow-pill eyebrow-pill--light">Commercial Roofing</span>
      <h1 id="comm-hero-h1">
        Commercial Roofing in<br>
        <span class="hero-accent"><?php echo htmlspecialchars(($address['city'] ?: 'Your Area') . ', ' . ($address['state'] ?: ''), ENT_QUOTES, 'UTF-8'); ?></span>
      </h1>
      <p class="comm-hero-sub">
        TPO, modified bitumen, EPDM, and low-slope metal systems for commercial buildings and multi-family properties. Dedicated project management and scheduling that works around your operations.
      </p>
      <div class="comm-hero-actions">
        <a href="/contact" class="btn-svc-primary">
          <i data-lucide="building-2" aria-hidden="true"></i>
          Request a Commercial Quote
        </a>
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>" class="comm-hero-phone">
          <i data-lucide="phone" aria-hidden="true"></i>
          <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php else: ?>
        <a href="/contact" class="comm-hero-phone">
          <i data-lucide="calendar" aria-hidden="true"></i>
          Schedule a Site Assessment
        </a>
        <?php endif; ?>
      </div>
      <div class="comm-hero-trust" aria-label="Trust indicators">
        <span class="comm-trust-item"><i data-lucide="shield-check" aria-hidden="true"></i> Licensed &amp; Insured</span>
        <span class="comm-trust-item"><i data-lucide="layers" aria-hidden="true"></i> TPO / ModBit / EPDM / Metal</span>
        <span class="comm-trust-item"><i data-lucide="clock" aria-hidden="true"></i> Schedule-Flexible Installation</span>
        <span class="comm-trust-item"><i data-lucide="file-check" aria-hidden="true"></i> Manufacturer Warranty Docs</span>
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
        <span itemprop="name">Commercial Roofing</span>
        <meta itemprop="position" content="3">
      </li>
    </ol>
  </div>
</nav>

<!-- ── Systems (C7 — signature: dark full-bleed section with system cards) ── -->
<section class="comm-systems-section" aria-labelledby="comm-systems-h2" data-animate="fade-up">
  <div class="container">
    <div class="comm-systems-inner">
      <span class="eyebrow-pill">Commercial Systems We Install</span>
      <h2 id="comm-systems-h2" class="section-heading">Four Systems. One Crew. No Subcontracting.</h2>
      <p class="last-updated-line">Last Updated: April 2026</p>
      <p class="section-sub">We install each of these directly — not handed off to a specialty sub. System selection depends on slope, use, budget, and warranty requirements.</p>
      <div class="comm-systems-grid">
        <div class="comm-system-card">
          <div class="comm-system-icon" aria-hidden="true"><i data-lucide="layers"></i></div>
          <p class="comm-system-name">TPO Membrane</p>
          <p class="comm-system-desc">Thermoplastic polyolefin — heat-welded seams, energy-reflective white surface. The most commonly specified commercial flat roof system for good reason: durable, maintainable, and competitively priced over its lifespan.</p>
        </div>
        <div class="comm-system-card">
          <div class="comm-system-icon" aria-hidden="true"><i data-lucide="flame"></i></div>
          <p class="comm-system-name">Modified Bitumen</p>
          <p class="comm-system-desc">Torch-applied or cold-applied SBS and APP modified bitumen for roofs requiring proven long-term performance. Multi-layer systems that handle foot traffic and thermal cycling on industrial or heavily used roofs.</p>
        </div>
        <div class="comm-system-card">
          <div class="comm-system-icon" aria-hidden="true"><i data-lucide="droplets"></i></div>
          <p class="comm-system-name">EPDM Rubber</p>
          <p class="comm-system-desc">Ethylene propylene diene monomer — fully adhered, ballasted, or mechanically attached. Excellent UV resistance, ozone resistance, and flexibility in temperature extremes. Common on commercial and institutional buildings.</p>
        </div>
        <div class="comm-system-card">
          <div class="comm-system-icon" aria-hidden="true"><i data-lucide="minus"></i></div>
          <p class="comm-system-name">Low-Slope Standing Seam Metal</p>
          <p class="comm-system-desc">Concealed-fastener standing seam for low-slope commercial applications where a metal system is specified. Long lifespan, minimal maintenance, and premium appearance for commercial properties that need the visual upgrade.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── SVG Divider: wave from dark ───────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 80" preserveAspectRatio="none" style="height:80px; background:var(--color-primary-dark)">
    <path d="M0,40 C400,80 800,0 1200,40 L1200,80 L0,80 Z" fill="var(--color-bg)"/>
  </svg>
</div>

<!-- ── Service Detail ────────────────────────────────────────────────────── -->
<section class="comm-section" aria-labelledby="comm-detail-h2" data-animate="fade-up">
  <div class="container">
    <div class="comm-detail-split">

      <!-- Image column with overlapping stat (C6.2) -->
      <div class="comm-detail-image">
        <div class="comm-stat-overlay" aria-hidden="true">
          <span class="comm-stat-num">30 yr</span>
          <span class="comm-stat-label">Manufacturer Warranty Available</span>
        </div>
        <picture>
          <img src="/assets/images/photo-003.jpg" alt="Roofing crew performing mid-project roof repair with exposed shingles and gutter cleaning visible on residential home" width="600" height="800" loading="lazy">
        </picture>
      </div>

      <!-- Content column -->
      <div>
        <span class="eyebrow-pill">Commercial &amp; Multi-Family</span>
        <h2 id="comm-detail-h2" class="section-heading">
          <span class="gradient-word">Built</span> for Commercial Scale
        </h2>
        <div class="prose">
          <p>Commercial roofing systems are different from residential — larger square footage, lower slopes, more complex drainage requirements, and often higher material performance standards. We install TPO membrane systems, modified bitumen (torch-down and cold-applied), EPDM rubber roofing, and low-slope standing seam metal for commercial and multi-family properties in the area. Every commercial project gets a dedicated project manager and a detailed pre-installation scope document.</p>
          <p>Commercial jobs require scheduling flexibility most contractors can't provide. We work around your business operations — early starts, weekend installation phases, phased completion to keep sections of the building open and operational. We also understand commercial warranty documentation requirements for most major manufacturers, which matters when property ownership or financing is involved.</p>
          <p>For multi-family residential properties — apartments, condos, townhome communities — we manage the coordination with property management, provide documentation for HOA or owner files, and have the crew capacity to complete large projects without stretching schedules over weeks. A complete roof replacement on a 20-unit building shouldn't take a month.</p>
        </div>

        <ul class="comm-reasons" aria-label="Why choose us for commercial roofing">
          <li class="comm-reason">
            <span class="comm-reason-num" aria-hidden="true">1</span>
            <div>
              <p class="comm-reason-title">Experience with TPO, modified bitumen, EPDM, and metal systems</p>
              <p class="comm-reason-body">We don't subcontract membrane work to someone else. Our crew installs it directly.</p>
            </div>
          </li>
          <li class="comm-reason">
            <span class="comm-reason-num" aria-hidden="true">2</span>
            <div>
              <p class="comm-reason-title">Project coordination around business operations</p>
              <p class="comm-reason-body">We work around business hours, tenant schedules, and operational needs without compromising installation quality.</p>
            </div>
          </li>
          <li class="comm-reason">
            <span class="comm-reason-num" aria-hidden="true">3</span>
            <div>
              <p class="comm-reason-title">Manufacturer documentation for commercial warranties</p>
              <p class="comm-reason-body">We provide the paperwork trails property owners need for financing, insurance, and resale.</p>
            </div>
          </li>
          <li class="comm-reason">
            <span class="comm-reason-num" aria-hidden="true">4</span>
            <div>
              <p class="comm-reason-title">Crew capacity for large-scale work</p>
              <p class="comm-reason-body">Multi-building or high-square-footage projects don't stretch our schedule. We bring the resources the job requires.</p>
            </div>
          </li>
        </ul>
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

<!-- ── Process Steps (C6.5) ─────────────────────────────────────────────── -->
<section class="comm-section--alt" aria-labelledby="comm-process-h2" data-animate="fade-up">
  <div class="container">
    <div style="text-align:center; max-width:620px; margin-inline:auto;">
      <span class="eyebrow-pill">How It Works</span>
      <h2 id="comm-process-h2" class="section-heading">From Site Assessment to Closeout Documentation</h2>
    </div>
    <div class="comm-steps">
      <div class="comm-step" data-animate="fade-up">
        <div class="comm-step-num" aria-hidden="true">1</div>
        <h3 class="comm-step-title">Site Assessment &amp; System Selection</h3>
        <p class="comm-step-body">We inspect the existing roof system, drainage configuration, penetrations, and access points. We then recommend the appropriate system based on slope, use, budget, and warranty requirements.</p>
      </div>
      <div class="comm-step" data-animate="fade-up" style="--delay:100ms">
        <div class="comm-step-num" aria-hidden="true">2</div>
        <h3 class="comm-step-title">Detailed Scope &amp; Proposal</h3>
        <p class="comm-step-body">Written scope covering materials, phases, crew schedule, and project timeline. Commercial proposals include manufacturer product specifications and warranty terms.</p>
      </div>
      <div class="comm-step" data-animate="fade-up" style="--delay:200ms">
        <div class="comm-step-num" aria-hidden="true">3</div>
        <h3 class="comm-step-title">Phased Installation</h3>
        <p class="comm-step-body">Phased where needed to keep portions of the building operational. Dedicated project manager, daily progress updates, site protection throughout.</p>
      </div>
      <div class="comm-step" data-animate="fade-up" style="--delay:300ms">
        <div class="comm-step-num" aria-hidden="true">4</div>
        <h3 class="comm-step-title">Completion Documentation</h3>
        <p class="comm-step-body">As-built photos, warranty registration, and closeout documentation for your records — everything property management, ownership, or financing requires.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── Project Photos ─────────────────────────────────────────────────────── -->
<section class="comm-photo-strip" aria-label="Commercial roofing project photos">
  <div class="container">
    <div class="comm-photo-pair">
      <div class="comm-photo-pair-item" data-animate="fade-up">
        <picture>
          <img src="/assets/images/photo-001.jpg" alt="Close-up aerial view of gray asphalt shingles with metal roof flashing and gutters, showing roofing material detail and installation" width="600" height="450" loading="lazy">
        </picture>
      </div>
      <div class="comm-photo-pair-item" data-animate="fade-up" style="animation-delay:80ms">
        <picture>
          <img src="/assets/images/photo-002.jpg" alt="Newly installed asphalt shingle roof with gray dimensional shingles and white PVC pipe penetration" width="600" height="450" loading="lazy">
        </picture>
      </div>
    </div>
  </div>
</section>

<!-- ── CTA Banner (CTA #2) ───────────────────────────────────────────────── -->
<section class="comm-cta-banner" aria-labelledby="comm-cta2-h2">
  <div class="container">
    <div class="comm-cta-inner">
      <span class="eyebrow-pill eyebrow-pill--light">Commercial Projects</span>
      <h2 id="comm-cta2-h2">Let's Talk About Your Building</h2>
      <p>Commercial scopes need a proper site walk first. Tell us about your building and we'll schedule a no-pressure assessment at your convenience.</p>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="comm-cta-phone" aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php endif; ?>
      <div class="comm-cta-actions">
        <a href="/contact" class="btn-svc-primary">
          <i data-lucide="building-2" aria-hidden="true"></i>
          Request a Site Assessment
        </a>
        <a href="/services" class="btn-svc-outline">View All Services</a>
      </div>
    </div>
  </div>
</section>

<!-- ── SVG Divider: diagonal-up ──────────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" style="height:60px">
    <polygon fill="var(--color-bg)" points="0,60 1200,0 1200,60 0,60"/>
  </svg>
</div>

<!-- ── FAQ ──────────────────────────────────────────────────────────────── -->
<section class="comm-faq-section" aria-labelledby="comm-faq-h2" data-animate="fade-up">
  <div class="container">
    <div style="text-align:center; max-width:600px; margin-inline:auto;">
      <span class="eyebrow-pill">Common Questions</span>
      <h2 id="comm-faq-h2" class="section-heading">Commercial Roofing Questions</h2>
      <p style="font-family:var(--font-body); color:var(--color-text-light); line-height:1.65; margin-bottom:var(--space-sm);">Answers about systems, scheduling, and warranties — before you pick up the phone.</p>
    </div>
    <div class="comm-faq-list">
      <?php foreach ($faqs as $i => $faq): ?>
      <div class="faq-item" id="cfaq-<?php echo $i; ?>">
        <button class="faq-question"
                aria-expanded="false"
                aria-controls="cfaq-answer-<?php echo $i; ?>"
                onclick="toggleFaq(this)">
          <?php echo htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8'); ?>
          <i data-lucide="chevron-down" class="faq-icon" aria-hidden="true"></i>
        </button>
        <div class="faq-answer" id="cfaq-answer-<?php echo $i; ?>" role="region">
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
    <polygon fill="var(--color-bg-alt)" points="0,0 1200,60 1200,60 0,60"/>
  </svg>
</div>

<!-- ── Closing CTA (CTA #3) ─────────────────────────────────────────────── -->
<section class="comm-closing-cta" aria-labelledby="comm-cta3-h2" data-animate="fade-up">
  <div class="container">
    <span class="eyebrow-pill">Get Started</span>
    <h2 id="comm-cta3-h2">Your Commercial Roof Handled From Assessment to Warranty</h2>
    <p>Site visit, written scope, phased installation, complete documentation. One contractor from start to closeout — no hand-offs, no gaps.</p>
    <div class="comm-closing-actions">
      <a href="/contact" class="btn-svc-primary">
        <i data-lucide="building-2" aria-hidden="true"></i>
        Request a Commercial Quote
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
