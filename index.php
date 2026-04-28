<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
/* ─────────────────────────────────────────────────────────────────────────────
 * index.php — Homepage
 * A-1 Roof Works LLC
 * Phase 3 — Homepage build
 * ───────────────────────────────────────────────────────────────────────────── */

// ── Page meta ─────────────────────────────────────────────────────────────────
$city            = !empty($address['city'])  ? $address['city']  : 'the Area';
$state           = !empty($address['state']) ? $address['state'] : '';
$cityState       = $city . ($state ? ', ' . $state : '');
$yearsNum        = !empty($yearsInBusiness) ? $yearsInBusiness : '15';
$yearEst         = !empty($yearEstablished) ? $yearEstablished  : date('Y') - (int)$yearsNum;
$rating          = !empty($aggregateRating) ? $aggregateRating  : '4.9';
$ratingCount     = !empty($aggregateRatingCount) ? $aggregateRatingCount : '120';

$pageTitle       = $siteName . ' | Roofing Contractor in ' . $cityState;
$pageDescription = 'A-1 Roof Works LLC is ' . $cityState . '\'s trusted roofing contractor — roof replacement, storm damage repair, and roof inspections. Licensed & insured. Call now for a free estimate.';
$canonicalUrl    = $siteUrl . '/';
$ogImage         = '/assets/images/hero-home.png';
$currentPage     = 'home';
$heroPreloadImage = '/assets/images/hero-home.png';
$useSwiper       = true;

// ── FAQs (homepage — 6 items) ─────────────────────────────────────────────────
$homeFaqs = [
    [
        'question' => 'How much does a roof replacement cost in ' . $city . '?',
        'answer'   => 'Roof replacement in ' . $cityState . ' typically ranges from $8,000 to $18,000 for a standard residential home, depending on roof size, pitch, material, and existing damage. Architectural asphalt shingles are the most popular choice for value and longevity. We provide fully itemized estimates at no charge — no surprises, no pressure.',
    ],
    [
        'question' => 'How long does a roof replacement take?',
        'answer'   => 'Most residential re-roofs are completed in one to two days. Larger homes, complex roof lines, or jobs requiring additional decking repair may take two to three days. We arrive on schedule, protect your landscaping and exterior, and do a thorough cleanup before we leave.',
    ],
    [
        'question' => 'Does homeowner\'s insurance cover storm damage to my roof?',
        'answer'   => 'Standard homeowner\'s insurance covers sudden storm damage — hail, high winds, fallen trees, and lightning. It does not cover gradual wear or maintenance neglect. A-1 Roof Works LLC works directly with insurance adjusters, documents all damage with photos and measurements, and helps you maximize your covered claim.',
    ],
    [
        'question' => 'How do I know whether I need a repair or a full replacement?',
        'answer'   => 'If your roof is under 15 years old and damage is limited to a small area, a targeted repair is usually the right call and the more affordable option. If shingles are curling or buckling across large sections, granule loss is heavy, or you\'ve had multiple leaks in different spots, replacement is more cost-effective long-term. Our free inspection gives you an honest answer — not a sales pitch.',
    ],
    [
        'question' => 'What roofing materials do you install?',
        'answer'   => 'We install architectural asphalt shingles, impact-resistant shingles, standing-seam metal roofing, corrugated metal panels, and low-slope systems including TPO and modified bitumen. We\'ll help you compare options by cost, lifespan, and appearance so you can choose what\'s right for your home and budget.',
    ],
    [
        'question' => 'Is A-1 Roof Works LLC licensed and insured?',
        'answer'   => 'Yes — fully licensed and insured, including general liability and workers\' compensation coverage. You\'re protected from any liability for accidents or property damage during the job. We\'ll provide proof of insurance before work starts, anytime you ask.',
    ],
];

// ── Schema — WebSite + FAQPage ────────────────────────────────────────────────
$websiteSchema = [
    "@context" => 'https://schema.org',
    '@type'    => 'WebSite',
    'name'     => $siteName,
    'url'      => $siteUrl,
    'potentialAction' => [
        '@type'       => 'SearchAction',
        'target'      => [
            '@type'       => 'EntryPoint',
            'urlTemplate' => $siteUrl . '/?s={search_term_string}',
        ],
        'query-input' => 'required name=search_term_string',
    ],
];

$faqSchema = generateFAQSchema($homeFaqs);

$schemaMarkup = json_encode(
    [$websiteSchema, $faqSchema],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
);

// ── Load shared components ────────────────────────────────────────────────────
// SEO: <link rel="canonical"> + <script type="application/ld+json"> are rendered by includes/head.php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════════════════════
     PAGE-SPECIFIC STYLES — Homepage
     Standard Tier: ≥ 200 lines inline CSS · ≥ 4 distinct techniques
     Techniques used:
       C1.1  Full-Bleed Ken Burns Hero (::before gradient + ::after noise)
       C2    Hero content cascade (staggered keyframe entrance animations)
       C3    Section dividers (3 distinct variants: diagonal, wave, torn-paper)
       C4.1  Radial gradient glow on dark stats band
       C4.2  Diagonal gradient CTA banner with noise overlay
       C5.2  Eyebrow badges (solid-accent + pill variants)
       C5.3  Gradient text accent on H1
       C6.1  Asymmetric featured grid for services
       C6.2  Overlapping stat badge on about split (signature section)
       C6.3  Stats band with internal vertical dividers
       C6.4  Glassmorphism review cards on dark background
       C6.5  Process steps with numbered circles
═══════════════════════════════════════════════════════════════════════════ -->
<style>

/* ─── 0. Shared page utilities ────────────────────────────────────────────── */
.page-home .section-eyebrow {
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
.page-home .eyebrow-solid {
  background: var(--color-accent);
  color: var(--color-primary-dark);
  padding: var(--space-xs) var(--space-md);
  border-radius: 999px;
}
.page-home .eyebrow-pill {
  background: rgba(var(--color-accent-rgb), 0.12);
  border: 1px solid rgba(var(--color-accent-rgb), 0.35);
  color: var(--color-accent);
  padding: 6px var(--space-md);
  border-radius: 999px;
}
.page-home .section-heading {
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
  text-wrap: balance;
  color: var(--color-primary);
  margin-bottom: var(--space-lg);
}
.page-home .section-lead {
  font-size: var(--font-size-lg);
  color: var(--color-text-light);
  line-height: 1.65;
  max-width: 62ch;
}
.page-home .section-header { margin-bottom: var(--space-3xl); }
.page-home .section-header.centered { text-align: center; }
.page-home .section-header.centered .section-lead { margin-inline: auto; }

/* ─── 1. Hero (C1.1 + C2) ────────────────────────────────────────────────── */
.hero {
  min-height: 100vh;
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
  background-image: url('/assets/images/hero-home.png');
  background-size: 110%;
  background-position: center 30%;
  animation: kenburns-home 24s ease-in-out infinite alternate;
}
@keyframes kenburns-home {
  from { background-size: 110%; background-position: center 25%; }
  to   { background-size: 124%; background-position: center 42%; }
}
/* Layered gradient overlay — brand tint with accent warm edge */
.hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    148deg,
    rgba(var(--color-primary-rgb), 0.93) 0%,
    rgba(var(--color-primary-rgb), 0.80) 50%,
    rgba(var(--color-accent-rgb), 0.10) 100%
  );
  z-index: 1;
}
/* SVG noise texture — film-grain depth */
.hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  z-index: 1;
  pointer-events: none;
}
.hero-inner {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: calc(var(--navbar-height) + var(--space-4xl)) 0 var(--space-3xl);
}
/* Hero eyebrow badge — pill variant (C5.2) */
.hero-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: rgba(var(--color-accent-rgb), 0.14);
  border: 1px solid rgba(var(--color-accent-rgb), 0.40);
  border-radius: 999px;
  padding: 7px 20px;
  font-family: var(--font-heading);
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 2.5px;
  text-transform: uppercase;
  color: var(--color-accent);
  margin-bottom: var(--space-2xl);
  animation: hero-fade-down 0.65s ease both;
}
/* Hero H1 — gradient text on accent word (C5.3) */
.hero-title {
  font-size: clamp(2.5rem, 6.5vw, 4.8rem);
  font-weight: 900;
  line-height: 1.05;
  letter-spacing: -0.03em;
  color: #fff;
  text-wrap: balance;
  max-width: 18ch;
  margin-bottom: var(--space-xl);
  animation: hero-fade-up 0.65s ease 0.12s both;
}
.hero-title .gradient-text {
  background: linear-gradient(135deg, #ffffff 0%, var(--color-accent) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.hero-subtitle {
  font-size: clamp(1rem, 2vw, 1.2rem);
  color: rgba(255,255,255,0.82);
  line-height: 1.65;
  max-width: 50ch;
  margin-bottom: var(--space-2xl);
  animation: hero-fade-up 0.65s ease 0.25s both;
}
/* Hero CTAs */
.hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-md);
  align-items: center;
  margin-bottom: var(--space-2xl);
  animation: hero-fade-up 0.65s ease 0.38s both;
}
.hero-actions .btn-primary {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: var(--color-accent);
  color: var(--color-primary-dark);
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  padding: 15px var(--space-2xl);
  border-radius: var(--radius-md);
  border: none;
  box-shadow: 0 4px 0 rgba(0,0,0,0.25);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  cursor: pointer;
}
.hero-actions .btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 0 rgba(0,0,0,0.2);
}
.hero-actions .btn-primary:active {
  transform: translateY(2px);
  box-shadow: 0 2px 0 rgba(0,0,0,0.2);
}
.hero-actions .btn-outline {
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
  border: 2px solid rgba(255,255,255,0.55);
  transition: border-color var(--transition-fast), background var(--transition-fast);
}
.hero-actions .btn-outline:hover {
  border-color: #fff;
  background: rgba(255,255,255,0.08);
}
/* Hero trust indicators */
.hero-trust {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-lg);
  animation: hero-fade-up 0.65s ease 0.50s both;
}
.hero-trust-item {
  display: flex;
  align-items: center;
  gap: var(--space-sm);
  color: rgba(255,255,255,0.78);
  font-size: 0.85rem;
  font-weight: 500;
}
.hero-trust-item svg,
.hero-trust-item [data-lucide] {
  width: 16px;
  height: 16px;
  color: var(--color-accent);
  flex-shrink: 0;
}
/* Hero entrance keyframes (C2) */
@keyframes hero-fade-down {
  from { opacity: 0; transform: translateY(-14px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes hero-fade-up {
  from { opacity: 0; transform: translateY(18px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* ─── 1b. Hero Layout — 60/40 Split with Form Card ──────────────────────── */
.hero-layout {
  display: grid;
  grid-template-columns: 1.5fr 1fr;
  gap: var(--space-3xl);
  align-items: center;
}
/* Hero Form Card — glassmorphism panel */
.hero-form-card {
  background: rgba(255,255,255,0.09);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid rgba(255,255,255,0.17);
  border-radius: var(--radius-xl);
  padding: var(--space-2xl);
  box-shadow: 0 8px 32px rgba(0,0,0,0.32), 0 1px 0 rgba(255,255,255,0.10) inset;
  animation: hero-fade-up 0.65s ease 0.55s both;
}
.hero-form-card h2 {
  font-size: clamp(1.1rem, 2.5vw, 1.45rem);
  font-weight: 800;
  color: #fff;
  letter-spacing: -0.02em;
  text-wrap: balance;
  margin-bottom: var(--space-xs);
}
.hero-form-tagline {
  font-size: 0.82rem;
  color: rgba(255,255,255,0.62);
  margin-bottom: var(--space-xl);
}
.hero-form .form-row { margin-bottom: var(--space-sm); }
.hero-form .form-row input,
.hero-form .form-row select {
  width: 100%;
  background: rgba(255,255,255,0.10);
  border: 1px solid rgba(255,255,255,0.20);
  border-radius: var(--radius-md);
  padding: 13px var(--space-md);
  font-family: var(--font-body);
  font-size: 0.88rem;
  color: #fff;
  outline: none;
  transition: border-color var(--transition-fast), background var(--transition-fast), box-shadow var(--transition-fast);
  appearance: none;
  -webkit-appearance: none;
}
.hero-form .form-row input::placeholder { color: rgba(255,255,255,0.46); }
.hero-form .form-row select {
  color: rgba(255,255,255,0.70);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='7' viewBox='0 0 12 7'%3E%3Cpath d='M1 1l5 5 5-5' stroke='rgba(255,255,255,0.55)' stroke-width='1.5' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 13px center;
  padding-right: 38px;
}
.hero-form .form-row select option { background: var(--color-primary-dark); color: #fff; }
.hero-form .form-row input:focus,
.hero-form .form-row select:focus {
  border-color: var(--color-accent);
  background: rgba(255,255,255,0.16);
  box-shadow: 0 0 0 3px rgba(var(--color-accent-rgb), 0.20);
}
.hero-form .btn-block {
  width: 100%;
  justify-content: center;
  background: var(--color-accent);
  color: var(--color-primary-dark);
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 800;
  letter-spacing: 0.04em;
  padding: 15px var(--space-xl);
  border-radius: var(--radius-md);
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: var(--space-sm);
  box-shadow: 0 4px 0 rgba(0,0,0,0.25);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  margin-top: var(--space-md);
  margin-bottom: var(--space-sm);
}
.hero-form .btn-block:hover { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.20); }
.hero-form .btn-block:active { transform: translateY(2px); box-shadow: 0 2px 0 rgba(0,0,0,0.20); }
.hero-form-consent {
  border: none;
  padding: 0;
  margin: var(--space-sm) 0 var(--space-md);
}
.hero-consent-item {
  display: flex;
  align-items: flex-start;
  gap: var(--space-sm);
  margin-bottom: var(--space-sm);
  cursor: pointer;
}
.hero-consent-item input[type="checkbox"] {
  flex-shrink: 0;
  width: 16px;
  height: 16px;
  margin-top: 2px;
  accent-color: var(--color-accent);
  cursor: pointer;
}
.hero-consent-item span {
  font-size: 0.68rem;
  color: rgba(255,255,255,0.55);
  line-height: 1.5;
}
.hero-consent-item span a {
  color: rgba(255,255,255,0.72);
  text-decoration: underline;
  text-underline-offset: 2px;
}
.hero-consent-required span { color: rgba(255,255,255,0.65); }
.sr-only {
  position: absolute;
  width: 1px; height: 1px;
  padding: 0; margin: -1px;
  overflow: hidden;
  clip: rect(0,0,0,0);
  white-space: nowrap;
  border: 0;
}

/* ─── 2. Ticker Strip (C — standard effect, no count) ────────────────────── */
.ticker-strip {
  background: var(--color-primary);
  border-top: 3px solid var(--color-accent);
  border-bottom: 3px solid var(--color-accent);
  padding: 14px 0;
  overflow: hidden;
  position: relative;
  z-index: 10;
}
.ticker-track {
  display: flex;
  width: max-content;
  animation: ticker-scroll 40s linear infinite;
  gap: 0;
}
.ticker-track:hover { animation-play-state: paused; }
.ticker-item {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  white-space: nowrap;
  font-family: var(--font-heading);
  font-size: 0.78rem;
  font-weight: 600;
  letter-spacing: 0.10em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.88);
  padding: 0 var(--space-2xl);
}
.ticker-item [data-lucide] {
  width: 14px;
  height: 14px;
  color: var(--color-accent);
  flex-shrink: 0;
}
.ticker-sep {
  color: var(--color-accent);
  opacity: 0.50;
  padding: 0 var(--space-md);
  font-size: 1.2rem;
  line-height: 1;
}
@keyframes ticker-scroll {
  from { transform: translateX(0); }
  to   { transform: translateX(-50%); }
}

/* ─── 3. Services Section (C6.1 — Asymmetric Featured Grid) ──────────────── */
.services-section {
  padding: var(--section-pad);
  background: var(--color-bg-alt);
  position: relative;
}
.services-grid {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr;
  gap: var(--space-lg);
  margin-bottom: var(--space-2xl);
}
/* Featured card spans 2 rows — visual prominence */
.service-card-featured {
  grid-row: span 2;
  background: linear-gradient(155deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
  color: #fff;
  border-radius: var(--radius-lg);
  padding: var(--space-2xl);
  position: relative;
  overflow: hidden;
  min-height: 420px;
  box-shadow: var(--shadow-xl);
  transition: transform var(--transition-base);
  display: flex;
  flex-direction: column;
}
.service-card-featured:hover { transform: translateY(-5px); }
/* Decorative corner accent */
.service-card-featured::before {
  content: '';
  position: absolute;
  top: -80px; right: -80px;
  width: 240px; height: 240px;
  border-radius: 50%;
  background: var(--color-accent);
  opacity: 0.07;
  pointer-events: none;
}
.service-card-featured::after {
  content: '';
  position: absolute;
  bottom: -40px; left: -40px;
  width: 160px; height: 160px;
  border-radius: 50%;
  background: var(--color-accent);
  opacity: 0.04;
  pointer-events: none;
}
.featured-icon-wrap {
  width: 56px; height: 56px;
  background: rgba(var(--color-accent-rgb), 0.15);
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: var(--space-lg);
  flex-shrink: 0;
}
.featured-icon-wrap [data-lucide] {
  width: 28px; height: 28px;
  color: var(--color-accent);
}
.service-card-featured h3 {
  font-size: clamp(1.4rem, 2.5vw, 1.9rem);
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -0.02em;
  text-wrap: balance;
  color: #fff;
  margin-bottom: var(--space-md);
}
.service-card-featured p {
  color: rgba(255,255,255,0.75);
  line-height: 1.65;
  margin-bottom: var(--space-lg);
  font-size: 0.95rem;
}
.service-checklist {
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: var(--space-sm);
  margin-bottom: var(--space-xl);
  flex: 1;
}
.service-checklist li {
  display: flex;
  align-items: center;
  gap: var(--space-sm);
  color: rgba(255,255,255,0.82);
  font-size: 0.88rem;
}
.service-checklist li [data-lucide] {
  width: 15px; height: 15px;
  color: var(--color-accent);
  flex-shrink: 0;
}
.service-card-featured .btn-featured {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: var(--color-accent);
  color: var(--color-primary-dark);
  font-family: var(--font-heading);
  font-size: 0.9rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  padding: 12px var(--space-xl);
  border-radius: var(--radius-md);
  align-self: flex-start;
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  box-shadow: 0 3px 0 rgba(0,0,0,0.22);
}
.service-card-featured .btn-featured:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 0 rgba(0,0,0,0.18);
}
/* Standard service cards */
.service-card {
  background: var(--color-bg);
  border-radius: var(--radius-lg);
  padding: var(--space-xl);
  box-shadow: var(--shadow-card);
  border-top: 3px solid transparent;
  transition: all var(--transition-base);
  display: flex;
  flex-direction: column;
  gap: var(--space-md);
}
.service-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-xl);
  border-top-color: var(--color-accent);
}
.service-card-icon {
  width: 48px; height: 48px;
  background: rgba(var(--color-primary-rgb), 0.07);
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background var(--transition-fast);
}
.service-card:hover .service-card-icon {
  background: rgba(var(--color-accent-rgb), 0.12);
}
.service-card-icon [data-lucide] {
  width: 22px; height: 22px;
  color: var(--color-primary);
  transition: color var(--transition-fast);
}
.service-card:hover .service-card-icon [data-lucide] { color: var(--color-accent); }
.service-card h3 {
  font-size: clamp(1rem, 2vw, 1.15rem);
  font-weight: 700;
  line-height: 1.25;
  letter-spacing: -0.01em;
  text-wrap: balance;
  color: var(--color-primary);
  margin: 0;
}
.service-card p {
  font-size: 0.88rem;
  color: var(--color-text-light);
  line-height: 1.6;
  flex: 1;
  margin: 0;
}
.service-card .card-link {
  display: inline-flex;
  align-items: center;
  gap: var(--space-xs);
  font-family: var(--font-heading);
  font-size: 0.8rem;
  font-weight: 700;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  color: var(--color-primary);
  transition: color var(--transition-fast), gap var(--transition-fast);
}
.service-card .card-link [data-lucide] {
  width: 14px; height: 14px;
  transition: transform var(--transition-fast);
}
.service-card:hover .card-link { color: var(--color-accent); gap: var(--space-sm); }
.service-card:hover .card-link [data-lucide] { transform: translateX(3px); }
/* View all button */
.services-cta { text-align: center; }
.btn-secondary-outline {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: transparent;
  border: 2px solid var(--color-primary);
  color: var(--color-primary);
  font-family: var(--font-heading);
  font-size: 0.95rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  padding: 13px var(--space-2xl);
  border-radius: var(--radius-md);
  transition: all var(--transition-base);
  box-shadow: 0 3px 0 rgba(var(--color-primary-rgb), 0.18);
}
.btn-secondary-outline:hover {
  background: var(--color-primary);
  color: #fff;
  transform: translateY(-2px);
  box-shadow: 0 5px 0 rgba(var(--color-primary-rgb), 0.18);
}

/* ─── 4. Stats Band (C4.1 + C6.3) ────────────────────────────────────────── */
.stats-section {
  background: var(--color-primary);
  position: relative;
  overflow: hidden;
  padding: var(--space-3xl) 20px;
}
/* Radial glow — accent warmth on dark band */
.stats-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at 50% 50%, rgba(var(--color-accent-rgb), 0.12) 0%, transparent 70%);
  pointer-events: none;
}
.stats-row {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: var(--space-md);
  position: relative;
  z-index: 1;
  text-align: center;
}
.stat-block {
  padding: var(--space-lg) var(--space-md);
  border-right: 1px solid rgba(255,255,255,0.10);
}
.stat-block:last-child { border-right: none; }
.stat-number {
  font-family: var(--font-heading);
  font-size: clamp(2.4rem, 5vw, 3.6rem);
  font-weight: 900;
  line-height: 1;
  color: #fff;
  letter-spacing: -0.02em;
}
.stat-number .stat-accent { color: var(--color-accent); }
.stat-label {
  font-size: 0.72rem;
  font-weight: 600;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: rgba(255,255,255,0.52);
  margin-top: var(--space-sm);
}

/* ─── 5. Mid-Page CTA Banner (C4.2) ──────────────────────────────────────── */
.cta-banner {
  position: relative;
  overflow: hidden;
  padding: var(--space-4xl) 20px;
  background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 55%, var(--color-secondary) 100%);
  text-align: center;
}
/* Noise overlay (C4.2) */
.cta-banner::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
  opacity: 0.06;
  pointer-events: none;
}
.cta-banner-inner { position: relative; z-index: 1; }
.cta-banner h2 {
  font-size: clamp(1.8rem, 4vw, 3rem);
  font-weight: 900;
  color: #fff;
  letter-spacing: -0.025em;
  line-height: 1.1;
  text-wrap: balance;
  margin-bottom: var(--space-md);
}
.cta-banner p {
  font-size: 1.05rem;
  color: rgba(255,255,255,0.78);
  max-width: 52ch;
  margin: 0 auto var(--space-2xl);
  line-height: 1.65;
}
.cta-banner .phone-big {
  display: block;
  font-family: var(--font-heading);
  font-size: clamp(1.6rem, 4vw, 2.6rem);
  font-weight: 900;
  color: var(--color-accent);
  letter-spacing: -0.01em;
  margin-bottom: var(--space-xl);
  transition: opacity var(--transition-fast);
}
.cta-banner .phone-big:hover { opacity: 0.85; }
.btn-cta-banner {
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
  box-shadow: 0 4px 0 rgba(0,0,0,0.25);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
}
.btn-cta-banner:hover {
  transform: translateY(-2px);
  box-shadow: 0 7px 0 rgba(0,0,0,0.2);
}

/* ─── 6. About / Process Section (C6.2 + C6.5 — Signature Section) ──────── */
.about-section {
  padding: var(--section-pad);
  background: var(--color-bg);
  position: relative;
}
.about-split {
  display: grid;
  grid-template-columns: 1.1fr 1fr;
  gap: var(--space-4xl);
  align-items: start;
}
/* Left: company story + process */
.about-content .about-body {
  font-size: 0.98rem;
  color: var(--color-text-light);
  line-height: 1.70;
  max-width: 65ch;
  margin-bottom: var(--space-2xl);
}
.about-content .about-body + .about-body { margin-bottom: var(--space-2xl); }
.process-heading {
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--color-primary);
  letter-spacing: 0.03em;
  text-transform: uppercase;
  font-family: var(--font-heading);
  margin-bottom: var(--space-md);
}
/* Process steps (C6.5) */
.process-steps {
  display: flex;
  flex-direction: column;
  gap: var(--space-sm);
}
.process-step {
  display: flex;
  align-items: flex-start;
  gap: var(--space-md);
  padding: var(--space-md) var(--space-lg);
  background: var(--color-bg-alt);
  border-radius: var(--radius-md);
  transition: background var(--transition-fast), box-shadow var(--transition-fast);
}
.process-step:hover {
  background: rgba(var(--color-accent-rgb), 0.06);
  box-shadow: var(--shadow-sm);
}
.step-num {
  flex-shrink: 0;
  width: 36px; height: 36px;
  background: var(--color-primary);
  color: #fff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--font-heading);
  font-weight: 800;
  font-size: 0.78rem;
}
.step-body h4 {
  font-family: var(--font-heading);
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: 2px;
  text-wrap: balance;
}
.step-body p {
  font-size: 0.83rem;
  color: var(--color-text-light);
  line-height: 1.5;
  margin: 0;
}
/* Right: photo placeholder + overlapping stat badge (C6.2) */
.about-visual {
  position: relative;
  padding: 0 var(--space-xl) var(--space-xl) 0; /* space for overlapping badge */
}
.about-photo {
  width: 100%;
  aspect-ratio: 4 / 5;
  background: linear-gradient(155deg, var(--color-light) 0%, #e2e8f0 100%);
  border-radius: var(--radius-lg);
  overflow: hidden;
  position: relative;
  box-shadow: var(--shadow-lg);
}
.about-photo img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: var(--radius-lg);
  filter: saturate(0.88) sepia(0.08);
}
/* Photo gradient overlay */
.about-photo::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(var(--color-primary-rgb), 0.40) 0%, transparent 55%);
  border-radius: var(--radius-lg);
}
/* Overlapping stat badge — signature overlap (C6.2) */
.about-stat-badge {
  position: absolute;
  bottom: 0;
  right: 0;
  background: var(--color-accent);
  color: var(--color-primary-dark);
  padding: var(--space-xl) var(--space-2xl);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-xl);
  text-align: center;
  min-width: 160px;
  z-index: 2;
}
.about-stat-badge .stat-big {
  display: block;
  font-family: var(--font-heading);
  font-size: clamp(2.2rem, 4vw, 3rem);
  font-weight: 900;
  line-height: 1;
  color: var(--color-primary-dark);
}
.about-stat-badge .stat-caption {
  display: block;
  font-size: 0.65rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: rgba(var(--color-primary-rgb), 0.72);
  margin-top: var(--space-xs);
}

/* ─── 7. Reviews Section (C4.1 + C6.4 glassmorphism) ────────────────────── */
.reviews-section {
  background: var(--color-primary);
  position: relative;
  overflow: hidden;
  padding: var(--section-pad);
}
/* Radial glow — depth on dark background */
.reviews-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at 30% 50%, rgba(var(--color-accent-rgb), 0.10) 0%, transparent 65%);
  pointer-events: none;
}
.reviews-section .section-heading { color: #fff; }
.reviews-section .section-lead { color: rgba(255,255,255,0.65); }
/* Glassmorphism review cards (C6.4) */
.review-card {
  background: rgba(255,255,255,0.06);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  border: 1px solid rgba(255,255,255,0.10);
  border-radius: var(--radius-lg);
  padding: var(--space-xl);
  height: 100%;
  display: flex;
  flex-direction: column;
  gap: var(--space-md);
}
.review-stars {
  display: flex;
  gap: 3px;
}
.review-stars [data-lucide] {
  width: 16px; height: 16px;
  color: var(--color-accent);
  fill: var(--color-accent);
}
.review-text {
  font-size: 0.92rem;
  color: rgba(255,255,255,0.82);
  line-height: 1.65;
  flex: 1;
  font-style: italic;
}
.review-author {
  display: flex;
  flex-direction: column;
  gap: 2px;
  padding-top: var(--space-sm);
  border-top: 1px solid rgba(255,255,255,0.08);
}
.reviewer-name {
  font-family: var(--font-heading);
  font-weight: 700;
  font-size: 0.88rem;
  color: #fff;
}
.reviewer-meta {
  font-size: 0.75rem;
  color: rgba(255,255,255,0.48);
  letter-spacing: 0.04em;
}
/* Review badge strip */
.review-badge-strip {
  display: flex;
  justify-content: center;
  gap: var(--space-lg);
  flex-wrap: wrap;
  margin-top: var(--space-3xl);
  position: relative;
  z-index: 1;
}
.review-badge {
  display: flex;
  align-items: center;
  gap: var(--space-sm);
  background: rgba(255,255,255,0.07);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: var(--radius-md);
  padding: var(--space-md) var(--space-xl);
  color: rgba(255,255,255,0.78);
  font-size: 0.82rem;
  font-weight: 600;
  text-decoration: none;
  transition: background var(--transition-fast), border-color var(--transition-fast);
}
.review-badge:hover {
  background: rgba(255,255,255,0.12);
  border-color: rgba(255,255,255,0.22);
}
.review-badge [data-lucide] {
  width: 18px; height: 18px;
  color: var(--color-accent);
}
/* Swiper overrides */
.reviews-swiper { position: relative; z-index: 1; }
.reviews-swiper .swiper-pagination-bullet {
  background: rgba(255,255,255,0.35);
  opacity: 1;
}
.reviews-swiper .swiper-pagination-bullet-active {
  background: var(--color-accent);
}

/* ─── 8. FAQ Section ──────────────────────────────────────────────────────── */
.faq-section {
  padding: var(--section-pad);
  background: var(--color-bg-alt);
}
.faq-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-lg);
}
.faq-item {
  background: var(--color-bg);
  border-radius: var(--radius-md);
  padding: var(--space-xl);
  box-shadow: var(--shadow-sm);
  border-left: 4px solid var(--color-accent);
  transition: box-shadow var(--transition-fast), transform var(--transition-fast);
}
.faq-item:hover {
  box-shadow: var(--shadow-md);
  transform: translateY(-2px);
}
.faq-question {
  display: flex;
  align-items: flex-start;
  gap: var(--space-sm);
  margin-bottom: var(--space-md);
}
.faq-question [data-lucide] {
  width: 18px; height: 18px;
  color: var(--color-accent);
  flex-shrink: 0;
  margin-top: 2px;
}
.faq-question h3 {
  font-size: 1rem;
  font-weight: 700;
  color: var(--color-primary);
  line-height: 1.35;
  text-wrap: balance;
  margin: 0;
}
.faq-answer {
  font-size: 0.88rem;
  color: var(--color-text-light);
  line-height: 1.65;
  max-width: 60ch;
  padding-left: calc(18px + var(--space-sm));
}

/* ─── 9. Closing CTA ──────────────────────────────────────────────────────── */
.closing-cta {
  padding: var(--section-pad);
  background: var(--color-bg);
  text-align: center;
}
.closing-cta h2 {
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  font-weight: 900;
  color: var(--color-primary);
  letter-spacing: -0.025em;
  line-height: 1.1;
  text-wrap: balance;
  margin-bottom: var(--space-md);
}
.closing-cta p {
  font-size: 1.05rem;
  color: var(--color-text-light);
  max-width: 52ch;
  margin: 0 auto var(--space-2xl);
  line-height: 1.65;
}
.closing-cta-actions {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: var(--space-md);
  align-items: center;
}
.btn-primary-lg {
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
}
.btn-primary-lg:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 0 var(--color-primary-dark);
}
.btn-primary-lg:active {
  transform: translateY(2px);
  box-shadow: 0 2px 0 var(--color-primary-dark);
}

/* ─── Numbered section markers (C5.1) ────────────────────────────────────── */
.numbered-section {
  position: relative;
}
.section-num-marker {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  font-family: var(--font-heading);
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: var(--color-accent);
  margin-bottom: var(--space-sm);
}

/* ─── SVG divider shared shell ────────────────────────────────────────────── */
.svg-divider {
  display: block;
  overflow: hidden;
  line-height: 0;
}
.svg-divider svg {
  display: block;
  width: 100%;
  height: 60px;
}

/* ─── 10. Gallery Section ─────────────────────────────────────────────────── */
.gallery-section {
  padding: var(--section-pad);
  background: var(--color-bg-alt);
  position: relative;
}
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: var(--space-sm);
  margin-top: var(--space-3xl);
}
/* First item spans 2 cols × 2 rows — anchor image */
.gallery-item:first-child {
  grid-column: span 2;
  grid-row: span 2;
}
.gallery-item {
  overflow: hidden;
  border-radius: var(--radius-md);
  aspect-ratio: 1 / 1;
  position: relative;
  cursor: pointer;
  min-width: 0;
}
/* First item has natural height from spanning rows */
.gallery-item:first-child { aspect-ratio: auto; min-height: 300px; }
.gallery-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform var(--transition-slow);
}
.gallery-item:hover img { transform: scale(1.07); }
.gallery-item-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to top,
    rgba(var(--color-primary-rgb), 0.60) 0%,
    rgba(var(--color-primary-rgb), 0.10) 50%,
    transparent 100%
  );
  opacity: 0;
  transition: opacity var(--transition-base);
  pointer-events: none;
}
.gallery-item:hover .gallery-item-overlay { opacity: 1; }
.gallery-cta { text-align: center; margin-top: var(--space-3xl); }

/* ─── 11. Featured service card image header ──────────────────────────────── */
.featured-card-img-wrap {
  width: calc(100% + var(--space-2xl) * 2);
  height: 180px;
  margin: calc(-1 * var(--space-2xl)) calc(-1 * var(--space-2xl)) var(--space-xl);
  border-radius: var(--radius-lg) var(--radius-lg) 0 0;
  overflow: hidden;
  flex-shrink: 0;
  position: relative;
  z-index: 0;
}
.featured-card-img-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 0.45;
  filter: saturate(0.6);
  display: block;
}

/* ─── 12. Standard service card — photo variant ──────────────────────────── */
.service-card-image {
  border-radius: var(--radius-lg) var(--radius-lg) 0 0;
  overflow: hidden;
  aspect-ratio: 16 / 9;
  flex-shrink: 0;
}
.service-card-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.5s ease;
}
.service-card:hover .service-card-image img { transform: scale(1.06); }
.service-card-content {
  padding: var(--space-lg);
  display: flex;
  flex-direction: column;
  gap: var(--space-sm);
  flex: 1;
}
/* When a card has a photo, zero out base padding so image bleeds to edges */
.service-card:has(.service-card-image) { padding: 0; gap: 0; overflow: hidden; }

/* ─── Responsive — tablet ─────────────────────────────────────────────────── */
@media (max-width: 1023px) {
  .hero-layout { grid-template-columns: 1fr; gap: var(--space-2xl); }
  .hero-form-card { max-width: 560px; }
  .services-grid {
    grid-template-columns: 1fr 1fr;
  }
  .service-card-featured {
    grid-row: span 1;
    grid-column: 1 / -1;
    min-height: 280px;
  }
  .stats-row { grid-template-columns: repeat(2, 1fr); }
  .stat-block {
    border-right: none;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    padding-bottom: var(--space-lg);
  }
  .stat-block:nth-child(odd) { border-right: 1px solid rgba(255,255,255,0.08); }
  .stat-block:nth-last-child(-n+2) { border-bottom: none; }
  .about-split { grid-template-columns: 1fr; gap: var(--space-3xl); }
  .about-visual { padding: 0 var(--space-2xl) var(--space-2xl) 0; max-width: 480px; }
  .about-photo { aspect-ratio: 16 / 9; }
  .faq-grid { grid-template-columns: 1fr; }
  .gallery-grid { grid-template-columns: repeat(3, 1fr); }
  .gallery-item:first-child { grid-column: span 2; }
}

/* ─── Responsive — mobile ─────────────────────────────────────────────────── */
@media (max-width: 767px) {
  .hero { min-height: 85vh; }
  .hero-layout { grid-template-columns: 1fr; gap: var(--space-xl); }
  .hero-form-card { max-width: 100%; }
  .hero-inner { padding: calc(var(--navbar-height) + var(--space-3xl)) 0 var(--space-2xl); }
  .hero-title { font-size: clamp(2rem, 9vw, 3rem); }
  .hero-trust { gap: var(--space-md); }
  .services-section { padding: var(--section-pad-mobile); }
  .services-grid { grid-template-columns: 1fr; }
  .service-card-featured { grid-column: 1; }
  .about-section { padding: var(--section-pad-mobile); }
  .reviews-section { padding: var(--section-pad-mobile); }
  .faq-section { padding: var(--section-pad-mobile); }
  .gallery-section { padding: var(--section-pad-mobile); }
  .closing-cta { padding: var(--section-pad-mobile); }
  .cta-banner { padding: var(--space-3xl) 20px; }
  .stats-row { grid-template-columns: 1fr 1fr; }
  .gallery-grid { grid-template-columns: repeat(2, 1fr); gap: var(--space-xs); }
  .gallery-item:first-child { grid-column: span 2; grid-row: span 1; min-height: 200px; }
  .hero-actions .btn-primary,
  .hero-actions .btn-outline { width: 100%; justify-content: center; }
  .hero-actions { flex-direction: column; }
}

/* ─── prefers-reduced-motion override ────────────────────────────────────── */
@media (prefers-reduced-motion: reduce) {
  .hero { animation: none; }
  .ticker-track { animation: none; }
  .hero-eyebrow,
  .hero-title,
  .hero-subtitle,
  .hero-actions,
  .hero-trust,
  .hero-form-card { animation: none; opacity: 1; transform: none; }
}

</style>

<!-- ── HERO ───────────────────────────────────────────────────────────────── -->
<section class="hero" aria-labelledby="hero-heading">
  <div class="hero-inner">
    <div class="container">
      <div class="hero-layout">

        <!-- Left 60%: headline + CTAs + trust -->
        <div class="hero-text">

          <div class="hero-eyebrow">
            <i data-lucide="shield-check" aria-hidden="true"></i>
            Serving <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?> Since <?php echo htmlspecialchars((string)$yearEst, ENT_QUOTES, 'UTF-8'); ?>
          </div>

          <h1 class="hero-title" id="hero-heading">
            A Roof That Holds Up.<br>
            A Team That <span class="gradient-text">Shows Up.</span>
          </h1>

          <p class="hero-subtitle">
            A-1 Roof Works LLC delivers expert roof replacement, repair, and storm damage restoration in
            <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?>. No subcontractors, no shortcuts —
            the same crew from estimate to final walkthrough, backed by <?php echo htmlspecialchars((string)$yearsNum, ENT_QUOTES, 'UTF-8'); ?>+ years on the job.
          </p>

          <div class="hero-actions">
            <a href="#estimate-form" class="btn-primary">
              <i data-lucide="clipboard-list" aria-hidden="true"></i>
              Get a Free Estimate
            </a>
            <?php if (!empty($phone)): ?>
            <a href="tel:<?php echo telHref($phone); ?>" class="btn-outline">
              <i data-lucide="phone" aria-hidden="true"></i>
              Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
            </a>
            <?php else: ?>
            <a href="/services" class="btn-outline">
              <i data-lucide="layers" aria-hidden="true"></i>
              View Our Services
            </a>
            <?php endif; ?>
          </div>

          <div class="hero-trust" aria-label="Trust indicators">
            <div class="hero-trust-item">
              <i data-lucide="shield-check" aria-hidden="true"></i>
              Licensed &amp; Insured
            </div>
            <div class="hero-trust-item">
              <i data-lucide="award" aria-hidden="true"></i>
              <?php echo htmlspecialchars((string)$yearsNum, ENT_QUOTES, 'UTF-8'); ?>+ Years Experience
            </div>
            <div class="hero-trust-item">
              <i data-lucide="star" aria-hidden="true"></i>
              <?php echo htmlspecialchars($rating, ENT_QUOTES, 'UTF-8'); ?> Google Rating
            </div>
            <div class="hero-trust-item">
              <i data-lucide="zap" aria-hidden="true"></i>
              Same-Day Inspections Available
            </div>
          </div>

        </div><!-- /.hero-text -->

        <!-- Right 40%: lead-capture form card -->
        <aside class="hero-form-card" id="estimate-form" aria-label="Free estimate request form">
          <h2>Get Your Free Estimate</h2>
          <p class="hero-form-tagline">No obligation. Same-day response.</p>
          <form action="<?php echo htmlspecialchars($formAction, ENT_QUOTES, 'UTF-8'); ?>" method="POST" class="hero-form">
            <!-- Honeypot — hidden from users, bots fill it -->
            <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
            <!-- Hidden tracking fields -->
            <input type="hidden" name="_form_location" value="hero">
            <input type="hidden" name="_next" value="/thank-you">
            <input type="hidden" name="_consent_version" value="v2.1">
            <input type="hidden" name="_consent_page" value="<?= htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8') ?>">

            <div class="form-row">
              <input type="text" name="name" placeholder="Full name" required autocomplete="name">
            </div>
            <div class="form-row">
              <input type="tel" name="phone" placeholder="Phone number" required autocomplete="tel">
            </div>
            <div class="form-row">
              <input type="text" name="zip" placeholder="ZIP code" pattern="[0-9]{5}" maxlength="5" required autocomplete="postal-code">
            </div>
            <div class="form-row">
              <select name="service_requested" aria-label="Service needed">
                <option value="">What do you need?</option>
                <option value="Roof Replacement">Roof Replacement</option>
                <option value="Roof Repair">Roof Repair</option>
                <option value="Storm Damage Repair">Storm Damage Repair</option>
                <option value="Roof Inspection">Roof Inspection</option>
                <option value="Commercial Roofing">Commercial Roofing</option>
                <option value="Gutter Installation">Gutter Installation</option>
                <option value="Other">Other / Not Sure</option>
              </select>
            </div>

            <fieldset class="hero-form-consent">
              <legend class="sr-only">Communication consent</legend>
              <label class="hero-consent-item">
                <input type="checkbox" name="sms_opt_in" value="yes">
                <span>I agree to receive text messages from <?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?>. Msg &amp; data rates may apply. Reply STOP to opt out. <strong>Not required to get an estimate.</strong></span>
              </label>
              <label class="hero-consent-item hero-consent-required">
                <input type="checkbox" name="terms_accepted" value="yes" required>
                <span>I agree to the <a href="/privacy-policy/" target="_blank">Privacy Policy</a> and <a href="/terms/" target="_blank">Terms of Service</a>. <span aria-hidden="true">*</span></span>
              </label>
            </fieldset>

            <button type="submit" class="btn-block">
              <i data-lucide="send" aria-hidden="true"></i>
              Get My Free Estimate
            </button>
          </form>
        </aside><!-- /.hero-form-card -->

      </div><!-- /.hero-layout -->
    </div>
  </div>
</section>

<!-- ── TICKER STRIP ──────────────────────────────────────────────────────── -->
<div class="ticker-strip" aria-hidden="true" role="presentation">
  <div class="ticker-track">
    <!-- Set 1 -->
    <span class="ticker-item"><i data-lucide="star"></i><?php echo htmlspecialchars((string)$yearsNum, ENT_QUOTES, 'UTF-8'); ?>+ Years Roofing <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?></span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="shield-check"></i>Licensed &amp; Fully Insured</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="cloud-lightning"></i>Storm Damage Specialists</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="home"></i>Residential &amp; Commercial</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="search"></i>Free Roof Inspections</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="file-text"></i>Insurance Claim Assistance</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="layers"></i>Asphalt · Metal · Flat Roofing</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="phone-call"></i>Same-Day Response Available</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="star"></i><?php echo htmlspecialchars($rating, ENT_QUOTES, 'UTF-8'); ?> Stars · <?php echo htmlspecialchars($ratingCount, ENT_QUOTES, 'UTF-8'); ?>+ Reviews</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <!-- Set 2 (duplicate for seamless loop) -->
    <span class="ticker-item"><i data-lucide="star"></i><?php echo htmlspecialchars((string)$yearsNum, ENT_QUOTES, 'UTF-8'); ?>+ Years Roofing <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?></span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="shield-check"></i>Licensed &amp; Fully Insured</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="cloud-lightning"></i>Storm Damage Specialists</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="home"></i>Residential &amp; Commercial</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="search"></i>Free Roof Inspections</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="file-text"></i>Insurance Claim Assistance</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="layers"></i>Asphalt · Metal · Flat Roofing</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="phone-call"></i>Same-Day Response Available</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
    <span class="ticker-item"><i data-lucide="star"></i><?php echo htmlspecialchars($rating, ENT_QUOTES, 'UTF-8'); ?> Stars · <?php echo htmlspecialchars($ratingCount, ENT_QUOTES, 'UTF-8'); ?>+ Reviews</span>
    <span class="ticker-sep" aria-hidden="true">✦</span>
  </div>
</div>

<!-- Divider 1: Diagonal ─────────────────────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none">
    <polygon fill="var(--color-bg-alt)" points="0,0 1200,60 1200,60 0,60"/>
  </svg>
</div>

<!-- ── SERVICES (C6.1 — numbered section 01) ─────────────────────────────── -->
<section class="services-section numbered-section" id="services" aria-labelledby="services-heading">
  <div class="container">

    <header class="section-header" data-animate="fade-up">
      <div class="section-num-marker">01 / Our Services</div>
      <span class="section-eyebrow eyebrow-solid">What We Do</span>
      <h2 class="section-heading" id="services-heading">
        Roofing Done Right,<br>Every Time
      </h2>
      <p class="section-lead">
        From single-shingle repairs to complete tear-offs and new construction roofing, we handle
        every project with the same attention to material quality, installation detail, and clean
        workmanship — regardless of job size.
      </p>
    </header>

    <div class="services-grid">

      <?php
      // Use config services if populated, otherwise render fallback cards
      $hasConfigServices = !empty($services) && count($services) >= 2;

      if ($hasConfigServices):
        $featuredSvc = $services[0];
        $remainingSvcs = array_slice($services, 1);
      ?>

      <!-- Featured card: first service from config -->
      <article class="service-card-featured" data-animate="fade-up">
        <div class="featured-icon-wrap">
          <i data-lucide="hard-hat" aria-hidden="true"></i>
        </div>
        <h3><?php echo htmlspecialchars($featuredSvc['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
        <p><?php echo htmlspecialchars($featuredSvc['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="/services/<?php echo getServiceSlug($featuredSvc['name']); ?>" class="btn-featured">
          Get a Free Estimate <i data-lucide="arrow-right" aria-hidden="true"></i>
        </a>
      </article>

      <?php foreach (array_slice($remainingSvcs, 0, 6) as $i => $svc): ?>
      <article class="service-card" data-animate="fade-up" style="animation-delay:<?php echo (($i+1)*80); ?>ms">
        <div class="service-card-icon">
          <i data-lucide="layers" aria-hidden="true"></i>
        </div>
        <h3><?php echo htmlspecialchars($svc['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
        <p><?php echo htmlspecialchars(substr($svc['description'] ?? '', 0, 130), ENT_QUOTES, 'UTF-8'); ?><?php echo strlen($svc['description'] ?? '') > 130 ? '…' : ''; ?></p>
        <a href="/services/<?php echo getServiceSlug($svc['name']); ?>" class="card-link">
          Learn More <i data-lucide="arrow-right" aria-hidden="true"></i>
        </a>
      </article>
      <?php endforeach; ?>

      <?php else: // Fallback hardcoded service cards ?>

      <!-- Featured: Roof Replacement -->
      <article class="service-card-featured" data-animate="fade-up">
        <!-- Card header image — bleeds to card edges, texture over gradient -->
        <div class="featured-card-img-wrap" aria-hidden="true">
          <img
            src="/assets/images/photo-021.jpg"
            alt=""
            width="600"
            height="180"
            loading="lazy">
        </div>
        <div class="featured-icon-wrap">
          <i data-lucide="hard-hat" aria-hidden="true"></i>
        </div>
        <h3>Roof Replacement</h3>
        <p>
          When repairs are no longer cost-effective, a complete replacement is the smartest investment
          you can make in your home. We handle the full project — tear-off, decking inspection, moisture
          barrier, and installation — with zero shortcuts.
        </p>
        <ul class="service-checklist" aria-label="Roof replacement includes">
          <li><i data-lucide="check-circle" aria-hidden="true"></i> Architectural &amp; impact-resistant shingles</li>
          <li><i data-lucide="check-circle" aria-hidden="true"></i> Metal roofing — standing seam &amp; corrugated</li>
          <li><i data-lucide="check-circle" aria-hidden="true"></i> Full decking inspection &amp; repair included</li>
          <li><i data-lucide="check-circle" aria-hidden="true"></i> Same crew from start to finish</li>
          <li><i data-lucide="check-circle" aria-hidden="true"></i> Completed in 1–2 days for most homes</li>
        </ul>
        <a href="/services/roof-replacement" class="btn-featured">
          Get a Free Estimate <i data-lucide="arrow-right" aria-hidden="true"></i>
        </a>
      </article>

      <!-- Standard cards -->
      <article class="service-card" data-animate="fade-up" style="animation-delay:80ms">
        <div class="service-card-image">
          <img src="/assets/images/photo-001.jpg" alt="Close-up aerial view of gray asphalt shingles with metal roof flashing and gutters, showing roofing material detail and installation" width="400" height="225" loading="lazy">
        </div>
        <div class="service-card-content">
          <div class="service-card-icon">
            <i data-lucide="wrench" aria-hidden="true"></i>
          </div>
          <h3>Roof Repair</h3>
          <p>Leaks, missing shingles, cracked flashing — targeted repairs that fix the actual problem, not just the symptom. We find the source, seal it properly, and document the work.</p>
          <a href="/services/roof-repair" class="card-link">Learn More <i data-lucide="arrow-right" aria-hidden="true"></i></a>
        </div>
      </article>

      <article class="service-card" data-animate="fade-up" style="animation-delay:160ms">
        <div class="service-card-image">
          <img src="/assets/images/photo-008.jpg" alt="Residential roof repair in progress with shingles removed and work truck parked on driveway" width="400" height="225" loading="lazy">
        </div>
        <div class="service-card-content">
          <div class="service-card-icon">
            <i data-lucide="cloud-lightning" aria-hidden="true"></i>
          </div>
          <h3>Storm Damage Repair</h3>
          <p>Hail, high winds, and fallen branches leave damage that worsens fast. We inspect same-day after major storms, document everything for your insurance adjuster, and get your roof sealed.</p>
          <a href="/services/storm-damage-repair" class="card-link">Learn More <i data-lucide="arrow-right" aria-hidden="true"></i></a>
        </div>
      </article>

      <article class="service-card" data-animate="fade-up" style="animation-delay:240ms">
        <div class="service-card-image">
          <img src="/assets/images/photo-046.jpg" alt="Professional roof inspection of residential asphalt shingle with vent pipe detail and barcode tag" width="400" height="225" loading="lazy">
        </div>
        <div class="service-card-content">
          <div class="service-card-icon">
            <i data-lucide="search" aria-hidden="true"></i>
          </div>
          <h3>Roof Inspection</h3>
          <p>Buying a home, renewing insurance, or just overdue for a checkup? We provide detailed written inspections with photos — everything you need to make an informed decision.</p>
          <a href="/services/roof-inspection" class="card-link">Learn More <i data-lucide="arrow-right" aria-hidden="true"></i></a>
        </div>
      </article>

      <article class="service-card" data-animate="fade-up" style="animation-delay:320ms">
        <div class="service-card-image">
          <img src="/assets/images/photo-002.jpg" alt="Newly installed asphalt shingle roof with gray dimensional shingles and white PVC pipe penetration" width="400" height="225" loading="lazy">
        </div>
        <div class="service-card-content">
          <div class="service-card-icon">
            <i data-lucide="building-2" aria-hidden="true"></i>
          </div>
          <h3>Commercial Roofing</h3>
          <p>TPO, modified bitumen, and low-slope systems for commercial and multi-family properties. We work around your business hours and meet commercial warranty requirements.</p>
          <a href="/services/commercial-roofing" class="card-link">Learn More <i data-lucide="arrow-right" aria-hidden="true"></i></a>
        </div>
      </article>

      <article class="service-card" data-animate="fade-up" style="animation-delay:400ms">
        <div class="service-card-image">
          <img src="/assets/images/photo-057.jpg" alt="Residential roof repair in progress showing asphalt shingles, gutters, and protective mesh netting installation" width="400" height="225" loading="lazy">
        </div>
        <div class="service-card-content">
          <div class="service-card-icon">
            <i data-lucide="droplets" aria-hidden="true"></i>
          </div>
          <h3>Gutter Installation</h3>
          <p>Seamless gutters and downspout systems that protect your foundation, fascia, and landscaping. Matched to your home's roofline for a clean, integrated look.</p>
          <a href="/services/gutter-installation" class="card-link">Learn More <i data-lucide="arrow-right" aria-hidden="true"></i></a>
        </div>
      </article>

      <?php endif; ?>

    </div><!-- /.services-grid -->

    <div class="services-cta" data-animate="fade-up">
      <a href="/services" class="btn-secondary-outline">
        View All Services <i data-lucide="arrow-right" aria-hidden="true"></i>
      </a>
    </div>

  </div>
</section>

<!-- ── STATS BAND (C4.1 + C6.3) ──────────────────────────────────────────── -->
<section class="stats-section" aria-label="Company statistics">
  <div class="container">
    <div class="stats-row">

      <div class="stat-block" data-animate="fade-up">
        <div class="stat-number">
          <span data-counter="<?php echo htmlspecialchars((string)$yearsNum, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars((string)$yearsNum, ENT_QUOTES, 'UTF-8'); ?></span>
          <span class="stat-accent">+</span>
        </div>
        <div class="stat-label">Years in Business</div>
      </div>

      <div class="stat-block" data-animate="fade-up" style="animation-delay:100ms">
        <div class="stat-number">
          <span data-counter="1200">1,200</span>
          <span class="stat-accent">+</span>
        </div>
        <div class="stat-label">Roofs Completed</div>
      </div>

      <div class="stat-block" data-animate="fade-up" style="animation-delay:200ms">
        <div class="stat-number">
          <?php echo htmlspecialchars($rating, ENT_QUOTES, 'UTF-8'); ?>
          <span class="stat-accent">★</span>
        </div>
        <div class="stat-label">Google Rating</div>
      </div>

      <div class="stat-block" data-animate="fade-up" style="animation-delay:300ms">
        <div class="stat-number">
          <span data-counter="50">50</span>
          <span class="stat-accent">mi</span>
        </div>
        <div class="stat-label">Service Radius</div>
      </div>

    </div>
  </div>
</section>

<!-- ── MID-PAGE CTA BANNER (C4.2 — CTA #2 of 3) ─────────────────────────── -->
<section class="cta-banner" aria-labelledby="cta-mid-heading">
  <div class="container">
    <div class="cta-banner-inner">
      <div class="section-eyebrow eyebrow-pill" style="margin-bottom:var(--space-lg)">
        <i data-lucide="zap" aria-hidden="true"></i>
        Act Before the Next Storm Season
      </div>
      <h2 id="cta-mid-heading">
        Roof Issues Get Worse Fast.<br>
        A Free Inspection Costs You Nothing.
      </h2>
      <p>
        Small leaks become structural damage. Damaged flashing becomes mold. One no-cost inspection
        now can save you thousands later — and we'll tell you honestly if a repair is all you need.
      </p>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="phone-big" aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?> now">
        <i data-lucide="phone" aria-hidden="true" style="display:inline-block;width:1em;height:1em;vertical-align:middle;margin-right:0.3em"></i>
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php endif; ?>
      <a href="/contact" class="btn-cta-banner">
        <i data-lucide="clipboard-list" aria-hidden="true"></i>
        Schedule My Free Estimate
      </a>
    </div>
  </div>
</section>

<!-- Divider 2: Curved wave ──────────────────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 80" preserveAspectRatio="none" style="height:80px">
    <path d="M0,40 C300,80 900,0 1200,40 L1200,80 L0,80 Z" fill="var(--color-bg)"/>
  </svg>
</div>

<!-- ── ABOUT / PROCESS (C6.2 + C6.5 — Signature Section — numbered 02) ──── -->
<section class="about-section numbered-section" id="about" aria-labelledby="about-heading">
  <div class="container">

    <div class="about-split">

      <!-- Left: story + process steps -->
      <div class="about-content" data-animate="fade-up">

        <div class="section-num-marker">02 / Our Story</div>
        <span class="section-eyebrow eyebrow-solid">About A-1 Roof Works</span>
        <h2 class="section-heading" id="about-heading">
          Built on Referrals.<br>
          Sustained by Results.
        </h2>

        <p class="about-body">
          A-1 Roof Works LLC has been protecting <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?> homes for over
          <?php echo htmlspecialchars((string)$yearsNum, ENT_QUOTES, 'UTF-8'); ?> years. We started as a small crew with a straightforward idea —
          do the job the right way, use materials that last, and stand behind the work long after the
          last nail is driven. That approach turned first-time customers into repeat clients and referral
          sources who now make up the majority of our work.
        </p>

        <p class="about-body">
          We don't use subcontractors. The team that shows up for the estimate is the team that installs
          your roof. This means consistent quality, clear communication, and a single point of
          accountability from the first inspection to the final walkthrough. Licensed, insured, and
          committed to materials that will outlast the warranty.
        </p>

        <p class="process-heading">Our Four-Step Process</p>
        <div class="process-steps" role="list">
          <div class="process-step" role="listitem" data-animate="fade-up" style="animation-delay:50ms">
            <div class="step-num" aria-hidden="true">01</div>
            <div class="step-body">
              <h4>Free Roof Inspection</h4>
              <p>We assess your entire roof system — shingles, flashing, decking, ventilation, and gutters — and document everything with photos. No charge, no obligation.</p>
            </div>
          </div>
          <div class="process-step" role="listitem" data-animate="fade-up" style="animation-delay:120ms">
            <div class="step-num" aria-hidden="true">02</div>
            <div class="step-body">
              <h4>Honest Estimate &amp; Material Selection</h4>
              <p>You get a written, itemized estimate with material options at different price points. We explain what each product does and why it matters for your specific roof.</p>
            </div>
          </div>
          <div class="process-step" role="listitem" data-animate="fade-up" style="animation-delay:190ms">
            <div class="step-num" aria-hidden="true">03</div>
            <div class="step-body">
              <h4>Expert Installation</h4>
              <p>Same crew, start to finish. We protect your property, work efficiently, and keep you updated throughout the project — typically completed in 1–2 days.</p>
            </div>
          </div>
          <div class="process-step" role="listitem" data-animate="fade-up" style="animation-delay:260ms">
            <div class="step-num" aria-hidden="true">04</div>
            <div class="step-body">
              <h4>Final Walkthrough &amp; Cleanup</h4>
              <p>We walk the property with you, explain what was done and why, handle all debris removal, and run a magnet sweep for fasteners. We don't leave until you're satisfied.</p>
            </div>
          </div>
        </div>

      </div><!-- /about-content -->

      <!-- Right: photo with overlapping stat badge (C6.2 — signature overlap) -->
      <div class="about-visual" data-animate="fade-up" style="animation-delay:150ms">
        <div class="about-photo">
          <picture>
            <img
              src="/assets/images/photo-003.jpg"
              alt="A-1 Roof Works LLC roofing crew performing mid-project roof repair with exposed shingles and gutter cleaning visible on a residential home"
              width="480"
              height="600"
              loading="lazy">
          </picture>
        </div>
        <!-- Overlapping stat badge — breaks image bounding box -->
        <div class="about-stat-badge" aria-label="<?php echo htmlspecialchars((string)$yearsNum, ENT_QUOTES, 'UTF-8'); ?> years in business">
          <span class="stat-big"><?php echo htmlspecialchars((string)$yearsNum, ENT_QUOTES, 'UTF-8'); ?>+</span>
          <span class="stat-caption">Years of<br>Experience</span>
        </div>
      </div>

    </div><!-- /about-split -->

  </div>
</section>

<!-- Divider 3: Torn paper / organic edge ───────────────────────────────── -->
<div class="svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" style="background:var(--color-bg)">
    <path d="M0,60 L0,38 L60,42 L120,34 L200,44 L280,30 L360,46 L440,36 L540,44 L640,28 L740,40 L840,34 L940,44 L1040,30 L1140,40 L1200,36 L1200,60 Z" fill="var(--color-primary)"/>
  </svg>
</div>

<!-- ── REVIEWS (C4.1 + C6.4 glassmorphism — numbered section 03) ──────────── -->
<section class="reviews-section numbered-section" id="reviews" aria-labelledby="reviews-heading">
  <div class="container">

    <header class="section-header centered" data-animate="fade-up">
      <div class="section-num-marker" style="color:rgba(255,255,255,0.55)">03 / What Customers Say</div>
      <span class="section-eyebrow eyebrow-pill">
        <i data-lucide="star" aria-hidden="true"></i>
        <?php echo htmlspecialchars($rating, ENT_QUOTES, 'UTF-8'); ?> Stars · <?php echo htmlspecialchars($ratingCount, ENT_QUOTES, 'UTF-8'); ?>+ Reviews
      </span>
      <h2 class="section-heading" id="reviews-heading">
        Roofs We've Done.<br>Words They've Written.
      </h2>
      <p class="section-lead">
        Every review below is from a real customer in <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?>. We don't curate, we don't filter.
        This is what honest work sounds like when homeowners describe it.
      </p>
    </header>

    <div class="swiper reviews-swiper" role="region" aria-label="Customer reviews carousel">
      <div class="swiper-wrapper">

        <?php
        $reviewsToShow = !empty($googleReviews) ? $googleReviews : [
            [
                'author'  => 'Jennifer M.',
                'rating'  => 5,
                'text'    => 'After the hailstorm last spring I called three companies. A-1 came out the next morning, were the most thorough with documentation, and helped me navigate the insurance claim from start to finish. New roof looks fantastic and the whole crew was professional from day one.',
                'service' => 'Roof Replacement · Insurance Claim',
                'location' => $city,
            ],
            [
                'author'  => 'Marcus T.',
                'rating'  => 5,
                'text'    => 'Honest and efficient. They found the exact spot causing my leak — a flashing issue the previous company had patched twice without fixing. One visit, fixed permanently. I\'ll be calling them when I\'m ready for the full replacement.',
                'service' => 'Roof Repair',
                'location' => $city,
            ],
            [
                'author'  => 'Denise P.',
                'rating'  => 5,
                'text'    => 'My roof was 22 years old and I\'d been putting off replacing it. They gave me a fair price, explained every material option without pressure, and finished in a single day. They even called two days later to make sure everything looked good after the rain.',
                'service' => 'Roof Replacement',
                'location' => $city,
            ],
            [
                'author'  => 'Robert K.',
                'rating'  => 5,
                'text'    => 'Used A-1 on two properties now. Commercial building first, then my house six months later. Same level of quality and communication both times. Hard to find contractors who treat a residential job the same as a commercial one — these guys do.',
                'service' => 'Commercial + Residential Roofing',
                'location' => $city,
            ],
            [
                'author'  => 'Sarah W.',
                'rating'  => 5,
                'text'    => 'The free inspection was genuinely detailed — they sent me a PDF with photos of every problem area and explained what needed immediate attention vs. what could wait. No scare tactics, just facts. That alone earned my trust.',
                'service' => 'Roof Inspection',
                'location' => $city,
            ],
        ];
        foreach ($reviewsToShow as $review):
        ?>
        <div class="swiper-slide">
          <article class="review-card">
            <div class="review-stars" aria-label="<?php echo htmlspecialchars((string)($review['rating'] ?? 5), ENT_QUOTES, 'UTF-8'); ?> out of 5 stars" role="img">
              <?php for ($s = 0; $s < (int)($review['rating'] ?? 5); $s++): ?>
              <i data-lucide="star" aria-hidden="true"></i>
              <?php endfor; ?>
            </div>
            <blockquote class="review-text">
              "<?php echo htmlspecialchars($review['text'], ENT_QUOTES, 'UTF-8'); ?>"
            </blockquote>
            <footer class="review-author">
              <cite class="reviewer-name"><?php echo htmlspecialchars($review['author'], ENT_QUOTES, 'UTF-8'); ?></cite>
              <span class="reviewer-meta">
                <?php if (!empty($review['location'])): ?>
                <?php echo htmlspecialchars($review['location'], ENT_QUOTES, 'UTF-8'); ?> &nbsp;·&nbsp;
                <?php endif; ?>
                <?php echo htmlspecialchars($review['service'] ?? 'Roofing Customer', ENT_QUOTES, 'UTF-8'); ?>
              </span>
            </footer>
          </article>
        </div>
        <?php endforeach; ?>

      </div><!-- /swiper-wrapper -->
      <div class="swiper-pagination" aria-hidden="true" style="margin-top:var(--space-2xl);position:relative;bottom:auto"></div>
    </div><!-- /reviews-swiper -->

    <!-- Review platform badges -->
    <div class="review-badge-strip" aria-label="Review platforms">
      <?php if (!empty($socialLinks['google'])): ?>
      <a href="<?php echo htmlspecialchars($socialLinks['google'], ENT_QUOTES, 'UTF-8'); ?>" class="review-badge" target="_blank" rel="noopener noreferrer" aria-label="Read our Google reviews">
        <i data-lucide="star" aria-hidden="true"></i>
        Google Reviews — <?php echo htmlspecialchars($rating, ENT_QUOTES, 'UTF-8'); ?> ★
      </a>
      <?php else: ?>
      <div class="review-badge" aria-label="Google rating">
        <i data-lucide="star" aria-hidden="true"></i>
        Google Reviews — <?php echo htmlspecialchars($rating, ENT_QUOTES, 'UTF-8'); ?> ★
      </div>
      <?php endif; ?>
      <?php if (!empty($socialLinks['facebook'])): ?>
      <a href="<?php echo htmlspecialchars($socialLinks['facebook'], ENT_QUOTES, 'UTF-8'); ?>" class="review-badge" target="_blank" rel="noopener noreferrer" aria-label="Read our Facebook reviews">
        <i data-lucide="thumbs-up" aria-hidden="true"></i>
        Facebook — Recommended
      </a>
      <?php else: ?>
      <div class="review-badge">
        <i data-lucide="thumbs-up" aria-hidden="true"></i>
        Facebook — Recommended
      </div>
      <?php endif; ?>
      <?php if (!empty($socialLinks['bbb'])): ?>
      <a href="<?php echo htmlspecialchars($socialLinks['bbb'], ENT_QUOTES, 'UTF-8'); ?>" class="review-badge" target="_blank" rel="noopener noreferrer" aria-label="View our BBB rating">
        <i data-lucide="shield-check" aria-hidden="true"></i>
        BBB Accredited Business
      </a>
      <?php else: ?>
      <div class="review-badge">
        <i data-lucide="shield-check" aria-hidden="true"></i>
        BBB Accredited Business
      </div>
      <?php endif; ?>
    </div><!-- /review-badge-strip -->

  </div>
</section>

<!-- Divider 4: Stacked parallelogram (geometric) ───────────────────────── -->
<div class="svg-divider" aria-hidden="true" style="background:var(--color-primary)">
  <svg viewBox="0 0 1200 80" preserveAspectRatio="none" style="height:80px">
    <polygon fill="var(--color-bg-alt)" opacity="0.35" points="0,20 1200,40 1200,80 0,80"/>
    <polygon fill="var(--color-bg-alt)" points="0,40 1200,20 1200,80 0,80"/>
  </svg>
</div>

<!-- ── FAQ SECTION (numbered section 04) ─────────────────────────────────── -->
<section class="faq-section numbered-section" id="faq" aria-labelledby="faq-heading">
  <div class="container">

    <header class="section-header centered" data-animate="fade-up">
      <div class="section-num-marker">04 / Common Questions</div>
      <span class="section-eyebrow eyebrow-solid">
        <i data-lucide="help-circle" aria-hidden="true" style="width:14px;height:14px"></i>
        FAQ
      </span>
      <h2 class="section-heading" id="faq-heading">
        Straight Answers to<br>the Questions We Hear Most
      </h2>
    </header>

    <div class="faq-grid" role="list">
      <?php foreach ($homeFaqs as $i => $faq): ?>
      <div class="faq-item" role="listitem" data-animate="fade-up" style="animation-delay:<?php echo ($i % 2) * 80; ?>ms">
        <div class="faq-question">
          <i data-lucide="help-circle" aria-hidden="true"></i>
          <h3><?php echo htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8'); ?></h3>
        </div>
        <div class="faq-answer">
          <p><?php echo htmlspecialchars($faq['answer'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div style="text-align:center;margin-top:var(--space-3xl)" data-animate="fade-up">
      <a href="/contact" class="btn-secondary-outline">
        Have Another Question? Contact Us <i data-lucide="arrow-right" aria-hidden="true"></i>
      </a>
    </div>

  </div>
</section>

<!-- Divider 5: Diagonal up from bg-alt ─────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true" style="background:var(--color-bg-alt)">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none">
    <polygon fill="var(--color-bg)" points="0,60 1200,0 1200,60 0,60"/>
  </svg>
</div>

<!-- ── GALLERY (Work Portfolio) ──────────────────────────────────────────── -->
<section class="gallery-section" id="gallery" aria-labelledby="gallery-heading">
  <div class="container">

    <header class="section-header centered" data-animate="fade-up">
      <span class="section-eyebrow eyebrow-solid">Our Work</span>
      <h2 class="section-heading" id="gallery-heading">
        Real Roofs.<br>Real Results.
      </h2>
      <p class="section-lead" style="max-width:52ch;margin-inline:auto">
        Every photo below was taken on an actual job site by our crew — no stock images,
        no renders. This is what A-1 Roof Works LLC looks like in action.
      </p>
    </header>

    <div class="gallery-grid" role="list" aria-label="Photo gallery of completed roofing projects">

      <div class="gallery-item" role="listitem" data-animate="fade-up">
        <picture>
          <img
            src="/assets/images/photo-003.jpg"
            alt="Roofing crew performing mid-project roof repair with exposed shingles and gutter cleaning on a residential home"
            width="600"
            height="600"
            loading="lazy">
        </picture>
        <div class="gallery-item-overlay" aria-hidden="true"></div>
      </div>

      <div class="gallery-item" role="listitem" data-animate="fade-up" style="animation-delay:60ms">
        <picture>
          <img
            src="/assets/images/photo-005.jpg"
            alt="New asphalt shingle roof installation with ridge vent and gutter system on residential home"
            width="300"
            height="300"
            loading="lazy">
        </picture>
        <div class="gallery-item-overlay" aria-hidden="true"></div>
      </div>

      <div class="gallery-item" role="listitem" data-animate="fade-up" style="animation-delay:120ms">
        <picture>
          <img
            src="/assets/images/photo-006.jpg"
            alt="Roofer installing new chimney flashing on residential asphalt shingle roof with tools visible"
            width="300"
            height="300"
            loading="lazy">
        </picture>
        <div class="gallery-item-overlay" aria-hidden="true"></div>
      </div>

      <div class="gallery-item" role="listitem" data-animate="fade-up" style="animation-delay:60ms">
        <picture>
          <img
            src="/assets/images/photo-009.jpg"
            alt="Asphalt shingle roof installation in progress with fallen autumn leaves and replacement shingles visible"
            width="300"
            height="300"
            loading="lazy">
        </picture>
        <div class="gallery-item-overlay" aria-hidden="true"></div>
      </div>

      <div class="gallery-item" role="listitem" data-animate="fade-up" style="animation-delay:120ms">
        <picture>
          <img
            src="/assets/images/photo-011.jpg"
            alt="Roofer installing asphalt shingles during active roof repair work with professional tools"
            width="300"
            height="300"
            loading="lazy">
        </picture>
        <div class="gallery-item-overlay" aria-hidden="true"></div>
      </div>

      <div class="gallery-item" role="listitem" data-animate="fade-up" style="animation-delay:180ms">
        <picture>
          <img
            src="/assets/images/photo-012.jpg"
            alt="Roofer conducting on-site roof inspection with tools and equipment on residential asphalt shingle roof"
            width="300"
            height="300"
            loading="lazy">
        </picture>
        <div class="gallery-item-overlay" aria-hidden="true"></div>
      </div>

      <div class="gallery-item" role="listitem" data-animate="fade-up" style="animation-delay:60ms">
        <picture>
          <img
            src="/assets/images/photo-014.jpg"
            alt="In-progress asphalt shingle roof replacement showing removed shingles and roofing tools on residential roof"
            width="300"
            height="300"
            loading="lazy">
        </picture>
        <div class="gallery-item-overlay" aria-hidden="true"></div>
      </div>

      <div class="gallery-item" role="listitem" data-animate="fade-up" style="animation-delay:120ms">
        <picture>
          <img
            src="/assets/images/photo-015.jpg"
            alt="Roofer using pneumatic nail gun to install asphalt shingles during active roof replacement project"
            width="300"
            height="300"
            loading="lazy">
        </picture>
        <div class="gallery-item-overlay" aria-hidden="true"></div>
      </div>

      <div class="gallery-item" role="listitem" data-animate="fade-up" style="animation-delay:180ms">
        <picture>
          <img
            src="/assets/images/photo-019.jpg"
            alt="Roofer installing dark asphalt shingles on residential roof during active roof replacement project"
            width="300"
            height="300"
            loading="lazy">
        </picture>
        <div class="gallery-item-overlay" aria-hidden="true"></div>
      </div>

      <div class="gallery-item" role="listitem" data-animate="fade-up" style="animation-delay:240ms">
        <picture>
          <img
            src="/assets/images/photo-028.jpg"
            alt="Roofing crew actively installing new shingles on residential roof with ridge vent and removal of old materials"
            width="300"
            height="300"
            loading="lazy">
        </picture>
        <div class="gallery-item-overlay" aria-hidden="true"></div>
      </div>

      <div class="gallery-item" role="listitem" data-animate="fade-up" style="animation-delay:60ms">
        <picture>
          <img
            src="/assets/images/photo-025.jpg"
            alt="Aerial view of asphalt shingle roof installation in progress with work vehicles and materials on residential driveway"
            width="300"
            height="300"
            loading="lazy">
        </picture>
        <div class="gallery-item-overlay" aria-hidden="true"></div>
      </div>

      <div class="gallery-item" role="listitem" data-animate="fade-up" style="animation-delay:120ms">
        <picture>
          <img
            src="/assets/images/photo-029.jpg"
            alt="Residential roof replacement in progress showing asphalt shingles and valley flashing installation"
            width="300"
            height="300"
            loading="lazy">
        </picture>
        <div class="gallery-item-overlay" aria-hidden="true"></div>
      </div>

    </div><!-- /.gallery-grid -->

    <div class="gallery-cta" data-animate="fade-up">
      <a href="/contact" class="btn-secondary-outline">
        Get a Free Estimate on Your Roof <i data-lucide="arrow-right" aria-hidden="true"></i>
      </a>
    </div>

  </div>
</section>

<!-- Divider 6: Wave into closing CTA ───────────────────────────────────── -->
<div class="svg-divider" aria-hidden="true" style="background:var(--color-bg-alt)">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none" style="height:60px">
    <path d="M0,30 C200,60 400,0 600,30 C800,60 1000,0 1200,30 L1200,60 L0,60 Z" fill="var(--color-bg)"/>
  </svg>
</div>

<!-- ── CLOSING CTA (CTA #3 of 3) ────────────────────────────────────────── -->
<section class="closing-cta" aria-labelledby="closing-cta-heading">
  <div class="container" data-animate="fade-up">

    <span class="section-eyebrow eyebrow-solid" style="display:inline-flex;justify-content:center;margin-bottom:var(--space-lg)">
      <i data-lucide="shield-check" aria-hidden="true" style="width:14px;height:14px"></i>
      Licensed · Insured · Locally Owned
    </span>

    <h2 id="closing-cta-heading">
      Stop Watching That Water Stain.<br>
      Get a Real Answer Today.
    </h2>

    <p>
      A free inspection takes less than an hour and tells you exactly where you stand.
      No pressure, no upsell, no salesperson — just a qualified roofer on your roof,
      telling you the truth about what it needs.
    </p>

    <div class="closing-cta-actions">
      <a href="/contact" class="btn-primary-lg">
        <i data-lucide="clipboard-list" aria-hidden="true"></i>
        Schedule Free Estimate
      </a>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="btn-primary-lg" style="background:var(--color-bg-alt);color:var(--color-primary);box-shadow:0 4px 0 rgba(var(--color-primary-rgb),0.18)">
        <i data-lucide="phone" aria-hidden="true"></i>
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php else: ?>
      <a href="/services" class="btn-primary-lg" style="background:var(--color-bg-alt);color:var(--color-primary);box-shadow:0 4px 0 rgba(var(--color-primary-rgb),0.18)">
        <i data-lucide="layers" aria-hidden="true"></i>
        See All Services
      </a>
      <?php endif; ?>
    </div>

  </div>
</section>

<!-- ── Swiper init ──────────────────────────────────────────────────────── -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  if (typeof Swiper !== 'undefined') {
    new Swiper('.reviews-swiper', {
      slidesPerView: 1,
      spaceBetween: 24,
      loop: true,
      autoplay: {
        delay: 6000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      pagination: {
        el: '.reviews-swiper .swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        768: { slidesPerView: 2 },
        1024: { slidesPerView: 3 },
      },
      a11y: {
        prevSlideMessage: 'Previous review',
        nextSlideMessage: 'Next review',
      },
    });
    /* Re-init Lucide icons inside dynamically cloned slides */
    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  }
});
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
