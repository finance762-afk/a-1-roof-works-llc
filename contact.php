<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
/* ─────────────────────────────────────────────────────────────────────────────
 * contact.php — Contact / Free Estimate
 * A-1 Roof Works LLC
 * Standard Tier: ≥ 200 lines inline CSS · ≥ 4 distinct techniques
 * Techniques used:
 *   C1.1  Full-Bleed Hero with ::before gradient overlay + ::after noise texture
 *   C2    Hero content cascade (staggered keyframe entrance)
 *   C3    Section dividers — diagonal + wave (2 distinct variants)
 *   C4.2  Diagonal gradient CTA banner variant (mid-page "Prefer to Call?")
 *   C5.2  Eyebrow badges (solid-accent + pill)
 *   C6.3  Split layout: form left, contact info panel right
 *   C9    3D press button on form submit
 *   C10   Styled form inputs with animated focus states + TCPA consent fieldset
 * ───────────────────────────────────────────────────────────────────────────── */

// ── Config helpers ────────────────────────────────────────────────────────────
$city        = !empty($address['city'])  ? $address['city']  : 'the Area';
$state       = !empty($address['state']) ? $address['state'] : '';
$cityState   = $city . ($state ? ', ' . $state : '');
$yearsNum    = !empty($yearsInBusiness) ? (string)$yearsInBusiness : '15';

// ── Page meta ─────────────────────────────────────────────────────────────────
$pageTitle       = 'Free Roofing Estimate in ' . $cityState . ' | A-1 Roof Works LLC';
$pageDescription = 'Request a free roofing estimate from A-1 Roof Works LLC in ' . $cityState . '. Licensed & insured. No pressure, no obligation — call or fill out our contact form for a same-day response.';
$canonicalUrl    = $siteUrl . '/contact';
$ogImage         = '/assets/images/contact-hero.png';
$heroPreloadImage = '/assets/images/contact-hero.png';
$currentPage     = 'contact';

// ── Schema — ContactPage ──────────────────────────────────────────────────────
$contactPageSchema = [
    "@context"  => 'https://schema.org',
    '@type'     => 'ContactPage',
    'name'      => 'Contact ' . $siteName,
    'url'       => $siteUrl . '/contact',
    'description' => 'Get a free roofing estimate from ' . $siteName . '. Licensed and insured roofing contractor serving ' . $cityState . '.',
    'mainEntity' => [
        '@type'     => 'LocalBusiness',
        'name'      => $siteName,
        'telephone' => $phone,
        'email'     => $email,
        'address'   => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => $address['street'],
            'addressLocality' => $address['city'],
            'addressRegion'   => $address['state'],
            'postalCode'      => $address['zip'],
            'addressCountry'  => 'US',
        ],
    ],
];

$schemaMarkup = json_encode(
    [
        $contactPageSchema,
        generateBreadcrumbSchema([
            ['name' => 'Home',    'url' => $siteUrl . '/'],
            ['name' => 'Contact'],
        ]),
    ],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
);

// ── Load shared components ────────────────────────────────────────────────────
// SEO: <link rel="canonical"> + <script type="application/ld+json"> are rendered by includes/head.php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════════════════════
     PAGE-SPECIFIC STYLES — Contact
     Standard Tier: ≥ 200 lines inline CSS · ≥ 4 distinct techniques
═══════════════════════════════════════════════════════════════════════════ -->
<style>

/* ─── 0. Page utilities ───────────────────────────────────────────────────── */
.page-contact .section-eyebrow {
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
.page-contact .eyebrow-solid {
  background: var(--color-accent);
  color: var(--color-primary-dark);
  padding: var(--space-xs) var(--space-md);
  border-radius: 999px;
}
.page-contact .eyebrow-pill {
  background: rgba(var(--color-accent-rgb), 0.12);
  border: 1px solid rgba(var(--color-accent-rgb), 0.35);
  color: var(--color-accent);
  padding: 6px var(--space-md);
  border-radius: 999px;
}
.page-contact .section-heading {
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
  text-wrap: balance;
  color: var(--color-primary);
  margin-bottom: var(--space-lg);
}
.contact-svg-divider { display: block; overflow: hidden; line-height: 0; }
.contact-svg-divider svg { display: block; width: 100%; height: 60px; }

/* ─── 1. Hero (C1.1 + C2) ────────────────────────────────────────────────── */
.contact-hero {
  min-height: 50vh;
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
  background-image: url('/assets/images/contact-hero.png');
  background-size: cover;
  background-position: center 35%;
}
.contact-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    158deg,
    rgba(var(--color-primary-rgb), 0.96) 0%,
    rgba(var(--color-primary-rgb), 0.82) 55%,
    rgba(var(--color-secondary), 0.10) 100%
  );
  z-index: 1;
}
.contact-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  z-index: 1;
  pointer-events: none;
}
.contact-hero-inner {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: calc(var(--navbar-height) + var(--space-3xl)) 0 var(--space-3xl);
}
.contact-hero-eyebrow {
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
  animation: contact-fade-down 0.6s ease both;
}
.contact-hero h1 {
  font-size: clamp(2.2rem, 5.5vw, 3.8rem);
  font-weight: 900;
  line-height: 1.1;
  letter-spacing: -0.03em;
  color: #fff;
  text-wrap: balance;
  max-width: 22ch;
  margin-bottom: var(--space-lg);
  animation: contact-fade-up 0.65s ease 0.12s both;
}
.contact-hero-subtitle {
  font-size: clamp(0.95rem, 2vw, 1.1rem);
  color: rgba(255,255,255,0.80);
  line-height: 1.65;
  max-width: 52ch;
  margin-bottom: var(--space-2xl);
  animation: contact-fade-up 0.65s ease 0.24s both;
}
.contact-hero-trust {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-lg);
  animation: contact-fade-up 0.65s ease 0.36s both;
}
.contact-hero-trust-item {
  display: flex;
  align-items: center;
  gap: var(--space-sm);
  background: rgba(255,255,255,0.10);
  border: 1px solid rgba(255,255,255,0.20);
  border-radius: var(--radius-md);
  padding: var(--space-sm) var(--space-md);
  color: rgba(255,255,255,0.90);
  font-size: 0.83rem;
  font-weight: 600;
}
.contact-hero-trust-item [data-lucide] { width: 15px; height: 15px; color: var(--color-accent); flex-shrink: 0; }
@keyframes contact-fade-down { from { opacity:0; transform:translateY(-14px); } to { opacity:1; transform:translateY(0); } }
@keyframes contact-fade-up   { from { opacity:0; transform:translateY(18px);  } to { opacity:1; transform:translateY(0); } }

/* ─── 2. Contact Split Section (C6.3) ────────────────────────────────────── */
.contact-main-section {
  padding: var(--section-pad);
  background: var(--color-bg);
}
.contact-split {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: var(--space-4xl);
  align-items: start;
}

/* ─── Form (C10 — styled inputs + animated focus + TCPA fieldset) ─────────── */
.contact-form-wrap h2 {
  font-size: clamp(1.4rem, 3vw, 2rem);
  font-weight: 800;
  color: var(--color-primary);
  letter-spacing: -0.02em;
  text-wrap: balance;
  margin-bottom: var(--space-sm);
}
.contact-form-wrap .form-intro {
  font-size: 0.92rem;
  color: var(--color-text-light);
  line-height: 1.60;
  max-width: 55ch;
  margin-bottom: var(--space-2xl);
}
.contact-form {
  display: flex;
  flex-direction: column;
  gap: var(--space-lg);
}
.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-lg);
}
.form-field { display: flex; flex-direction: column; gap: var(--space-sm); }
.form-label {
  font-family: var(--font-heading);
  font-size: 0.78rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--color-text);
}
.required-star { color: #c0392b; }
.form-input {
  width: 100%;
  padding: 13px var(--space-md);
  border: 2px solid rgba(var(--color-primary-rgb), 0.15);
  border-radius: var(--radius-md);
  font-family: var(--font-body);
  font-size: 0.95rem;
  color: var(--color-text);
  background: var(--color-bg);
  transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
  outline: none;
  -webkit-appearance: none;
  appearance: none;
}
.form-input:focus {
  border-color: var(--color-primary);
  box-shadow: 0 0 0 3px rgba(var(--color-primary-rgb), 0.10);
}
.form-input::placeholder { color: rgba(var(--color-primary-rgb), 0.28); }
.form-select {
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%231b3a6b' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 14px center;
  padding-right: 40px;
  cursor: pointer;
}
.form-textarea { resize: vertical; min-height: 110px; }

/* TCPA Consent Fieldset */
.form-consent-fieldset {
  border: 1px solid rgba(var(--color-primary-rgb), 0.15);
  border-radius: var(--radius-md);
  padding: var(--space-lg) var(--space-xl);
  margin-top: var(--space-sm);
  background: rgba(var(--color-primary-rgb), 0.025);
}
.form-consent-legend {
  font-family: var(--font-heading);
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  padding: 0 var(--space-sm);
  color: var(--color-text-light);
}
.form-consent-item {
  display: flex;
  align-items: flex-start;
  gap: var(--space-md);
  padding: var(--space-md) 0;
  cursor: pointer;
  border-bottom: 1px solid rgba(var(--color-primary-rgb), 0.06);
}
.form-consent-item:last-child { border-bottom: none; }
.consent-checkbox {
  flex-shrink: 0;
  margin-top: 3px;
  width: 18px;
  height: 18px;
  cursor: pointer;
  accent-color: var(--color-primary);
}
.consent-label {
  font-size: 0.82rem;
  line-height: 1.55;
  color: var(--color-text-light);
}
.consent-label strong { font-weight: 600; color: var(--color-text); }
.consent-label a { color: var(--color-primary); text-decoration: underline; }

/* Submit button (C9 — 3D press) */
.form-submit-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-sm);
  background: var(--color-primary);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 1.05rem;
  font-weight: 800;
  letter-spacing: 0.04em;
  padding: 16px var(--space-2xl);
  border-radius: var(--radius-md);
  border: none;
  box-shadow: 0 4px 0 var(--color-primary-dark);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  cursor: pointer;
  overflow: hidden;
  width: 100%;
}
.form-submit-btn:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 var(--color-primary-dark); }
.form-submit-btn:active { transform: translateY(2px);  box-shadow: 0 2px 0 var(--color-primary-dark); }
.form-submit-btn:focus-visible { outline: 2px solid var(--color-accent); outline-offset: 2px; }

/* ─── Contact Info Panel (right column) ──────────────────────────────────── */
.contact-info-panel {
  background: var(--color-bg-alt);
  border-radius: var(--radius-lg);
  padding: var(--space-2xl);
  border-top: 4px solid var(--color-accent);
  box-shadow: var(--shadow-md);
  position: sticky;
  top: calc(var(--navbar-height) + var(--space-lg));
}
.contact-info-panel h3 {
  font-size: clamp(1.1rem, 2vw, 1.3rem);
  font-weight: 800;
  color: var(--color-primary);
  letter-spacing: -0.01em;
  text-wrap: balance;
  margin-bottom: var(--space-xl);
}
.contact-info-items {
  display: flex;
  flex-direction: column;
  gap: var(--space-lg);
  margin-bottom: var(--space-2xl);
}
.contact-info-item {
  display: flex;
  align-items: flex-start;
  gap: var(--space-md);
}
.contact-info-icon {
  flex-shrink: 0;
  width: 40px; height: 40px;
  background: rgba(var(--color-primary-rgb), 0.07);
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 2px;
}
.contact-info-icon [data-lucide] { width: 18px; height: 18px; color: var(--color-primary); }
.contact-info-text { flex: 1; }
.contact-info-text .info-label {
  font-family: var(--font-heading);
  font-size: 0.72rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: var(--color-text-light);
  margin-bottom: 3px;
}
.contact-info-text .info-value {
  font-size: 0.95rem;
  color: var(--color-text);
  font-weight: 600;
  line-height: 1.45;
}
.contact-info-text .info-value a {
  color: var(--color-primary);
  font-weight: 700;
  transition: color var(--transition-fast);
}
.contact-info-text .info-value a:hover { color: var(--color-accent); }
/* Hours table */
.hours-list {
  display: flex;
  flex-direction: column;
  gap: 4px;
}
.hours-row {
  display: flex;
  justify-content: space-between;
  font-size: 0.85rem;
  color: var(--color-text-light);
}
.hours-row .day { font-weight: 600; color: var(--color-text); }
/* Map placeholder */
.map-placeholder {
  width: 100%;
  aspect-ratio: 16 / 9;
  background: var(--color-bg);
  border-radius: var(--radius-md);
  border: 1px solid rgba(var(--color-primary-rgb), 0.10);
  overflow: hidden;
  margin-top: var(--space-xl);
}
.map-placeholder iframe { width: 100%; height: 100%; border: none; }

/* ─── 3. What Happens Next ────────────────────────────────────────────────── */
.contact-next-section {
  padding: var(--space-3xl) 20px;
  background: var(--color-bg-alt);
}
.next-steps-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-xl);
  max-width: 860px;
  margin: 0 auto;
}
.next-step {
  text-align: center;
  padding: var(--space-xl);
  background: var(--color-bg);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-sm);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
}
.next-step:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
.next-step-num {
  width: 48px; height: 48px;
  background: var(--color-primary);
  color: #fff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--font-heading);
  font-weight: 900;
  font-size: 1.1rem;
  margin: 0 auto var(--space-md);
}
.next-step h4 {
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 800;
  color: var(--color-primary);
  text-wrap: balance;
  margin-bottom: var(--space-sm);
}
.next-step p {
  font-size: 0.85rem;
  color: var(--color-text-light);
  line-height: 1.60;
  margin: 0;
}
.next-steps-header {
  text-align: center;
  margin-bottom: var(--space-2xl);
}
.next-steps-header h2 {
  font-family: var(--font-heading);
  font-size: clamp(1.3rem, 2.5vw, 1.7rem);
  font-weight: 800;
  color: var(--color-primary);
  letter-spacing: -0.02em;
  text-wrap: balance;
  margin-bottom: var(--space-sm);
}
.next-steps-header p {
  font-size: 0.95rem;
  color: var(--color-text-light);
  max-width: 55ch;
  margin: 0 auto;
  line-height: 1.6;
}

/* ─── 4. Mid-Page CTA — Phone Emphasis (CTA #2) ──────────────────────────── */
.contact-phone-cta {
  padding: var(--space-4xl) 20px;
  background: var(--color-primary);
  text-align: center;
  position: relative;
  overflow: hidden;
}
.contact-phone-cta::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at 50% 50%, rgba(var(--color-accent-rgb), 0.12) 0%, transparent 65%);
  pointer-events: none;
}
.contact-phone-cta-inner {
  position: relative;
  z-index: 1;
  max-width: 680px;
  margin: 0 auto;
}
.contact-phone-cta h2 {
  font-size: clamp(1.6rem, 3.5vw, 2.4rem);
  font-weight: 900;
  color: #fff;
  letter-spacing: -0.025em;
  line-height: 1.1;
  text-wrap: balance;
  margin-bottom: var(--space-md);
}
.contact-phone-cta p {
  font-size: 1rem;
  color: rgba(255,255,255,0.72);
  line-height: 1.65;
  margin-bottom: var(--space-2xl);
}
.phone-display-large {
  display: inline-flex;
  align-items: center;
  gap: var(--space-md);
  background: var(--color-accent);
  color: var(--color-primary-dark);
  font-family: var(--font-heading);
  font-size: clamp(1.6rem, 4vw, 2.4rem);
  font-weight: 900;
  letter-spacing: -0.01em;
  padding: var(--space-lg) var(--space-2xl);
  border-radius: var(--radius-md);
  box-shadow: 0 4px 0 rgba(0,0,0,0.28);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  text-decoration: none;
  overflow: hidden;
}
.phone-display-large:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 rgba(0,0,0,0.22); }
.phone-display-large:active { transform: translateY(2px);  box-shadow: 0 2px 0 rgba(0,0,0,0.22); }
.phone-display-large [data-lucide] { width: 28px; height: 28px; flex-shrink: 0; }
.phone-subtext {
  display: block;
  font-size: 0.78rem;
  font-weight: 500;
  color: rgba(255,255,255,0.52);
  letter-spacing: 0.06em;
  text-transform: uppercase;
  margin-top: var(--space-md);
}

/* ─── 5. Emergency CTA (CTA #3) ──────────────────────────────────────────── */
.contact-emergency-section {
  padding: var(--section-pad);
  background: var(--color-bg);
  text-align: center;
}
.emergency-card {
  max-width: 680px;
  margin: 0 auto;
  background: var(--color-bg-alt);
  border-radius: var(--radius-lg);
  padding: var(--space-2xl) var(--space-3xl);
  border-top: 4px solid var(--color-primary);
  box-shadow: var(--shadow-md);
}
.emergency-icon-row {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-md);
  margin-bottom: var(--space-lg);
}
.emergency-icon-wrap {
  width: 56px; height: 56px;
  background: rgba(var(--color-primary-rgb), 0.08);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.emergency-icon-wrap [data-lucide] { width: 26px; height: 26px; color: var(--color-primary); }
.emergency-card h2 {
  font-size: clamp(1.3rem, 2.5vw, 1.8rem);
  font-weight: 800;
  color: var(--color-primary);
  text-wrap: balance;
  letter-spacing: -0.02em;
  margin-bottom: var(--space-md);
}
.emergency-card p {
  font-size: 0.95rem;
  color: var(--color-text-light);
  line-height: 1.65;
  max-width: 52ch;
  margin: 0 auto var(--space-xl);
}
.btn-emergency-call {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: var(--color-primary);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 1.1rem;
  font-weight: 800;
  letter-spacing: 0.04em;
  padding: 16px var(--space-3xl);
  border-radius: var(--radius-md);
  box-shadow: 0 4px 0 var(--color-primary-dark);
  transition: transform var(--transition-fast), box-shadow var(--transition-fast);
  overflow: hidden;
}
.btn-emergency-call:hover  { transform: translateY(-2px); box-shadow: 0 6px 0 var(--color-primary-dark); }
.btn-emergency-call:active { transform: translateY(2px);  box-shadow: 0 2px 0 var(--color-primary-dark); }

/* ─── Responsive ──────────────────────────────────────────────────────────── */
@media (max-width: 1023px) {
  .contact-split { grid-template-columns: 1fr; gap: var(--space-2xl); }
  .contact-info-panel { position: static; }
  .next-steps-grid { grid-template-columns: 1fr; gap: var(--space-lg); max-width: 480px; }
  .form-row { grid-template-columns: 1fr; }
}
@media (max-width: 767px) {
  .contact-hero { min-height: 60vh; }
  .contact-hero-inner { padding: calc(var(--navbar-height) + var(--space-2xl)) 0 var(--space-2xl); }
  .contact-hero h1 { font-size: clamp(1.9rem, 8vw, 2.8rem); }
  .contact-hero-trust { gap: var(--space-sm); }
  .contact-main-section { padding: var(--section-pad-mobile); }
  .contact-emergency-section { padding: var(--section-pad-mobile); }
  .emergency-card { padding: var(--space-xl) var(--space-lg); }
  .contact-phone-cta { padding: var(--space-3xl) 20px; }
  .phone-display-large { font-size: 1.4rem; padding: var(--space-md) var(--space-xl); }
  .form-consent-fieldset { padding: var(--space-md); }
}
@media (prefers-reduced-motion: reduce) {
  .contact-hero-eyebrow,
  .contact-hero h1,
  .contact-hero-subtitle,
  .contact-hero-trust { animation: none; opacity: 1; transform: none; }
}

</style>

<!-- ── HERO (CTA #1 embedded in hero) ───────────────────────────────────── -->
<section class="contact-hero" aria-labelledby="contact-hero-heading">
  <div class="contact-hero-inner">
    <div class="container">

      <div class="contact-hero-eyebrow">
        <i data-lucide="clipboard-list" aria-hidden="true"></i>
        Free Estimates — No Pressure, No Obligation
      </div>

      <h1 id="contact-hero-heading">Get Your Free Roofing Estimate</h1>

      <p class="contact-hero-subtitle">
        No pressure, no obligation — just a qualified roofer, honest about what your roof actually needs.
        We respond within 2 business hours.
      </p>

      <div class="contact-hero-trust" aria-label="Trust indicators">
        <div class="contact-hero-trust-item">
          <i data-lucide="shield-check" aria-hidden="true"></i>
          Licensed &amp; Insured
        </div>
        <div class="contact-hero-trust-item">
          <i data-lucide="tag" aria-hidden="true"></i>
          Free Estimates
        </div>
        <div class="contact-hero-trust-item">
          <i data-lucide="zap" aria-hidden="true"></i>
          Same-Day Response
        </div>
        <div class="contact-hero-trust-item">
          <i data-lucide="users" aria-hidden="true"></i>
          No Subcontractors
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Divider: diagonal ───────────────────────────────────────────────────── -->
<div class="contact-svg-divider" aria-hidden="true">
  <svg viewBox="0 0 1200 60" preserveAspectRatio="none">
    <polygon fill="var(--color-bg)" points="0,0 1200,60 1200,60 0,60"/>
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
        <span itemprop="name">Contact</span>
        <meta itemprop="position" content="2">
      </li>
    </ol>
  </div>
</nav>

<!-- ── CONTACT SPLIT SECTION ─────────────────────────────────────────────── -->
<section class="contact-main-section" aria-labelledby="contact-form-heading">
  <div class="container">
    <div class="contact-split">

      <!-- ── LEFT: Form ─────────────────────────────────────────────────── -->
      <div class="contact-form-wrap" data-animate="fade-up">

        <span class="section-eyebrow eyebrow-solid">Send Us a Message</span>
        <h2 id="contact-form-heading">Tell Us About Your Roof</h2>
        <p class="form-intro">
          Fill out the form below and we'll get back to you within 2 business hours.
          For same-day emergency response, call us directly.
        </p>

        <form
          action="https://db.pageone.cloud/functions/v1/leads/a-1-roof-works-llc"
          method="POST"
          class="contact-form"
          novalidate>

          <!-- Honeypot — hidden from users, visible to bots -->
          <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">

          <!-- Hidden redirect + consent tracking -->
          <input type="hidden" name="_next" value="/thank-you">
          <input type="hidden" name="_consent_version" value="v2.1">
          <input type="hidden" name="_consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8'); ?>">

          <!-- Name + Phone (side by side on desktop) -->
          <div class="form-row">
            <div class="form-field">
              <label for="name" class="form-label">Your Name <span class="required-star">*</span></label>
              <input
                type="text"
                id="name"
                name="name"
                class="form-input"
                required
                autocomplete="name"
                placeholder="John Smith">
            </div>
            <div class="form-field">
              <label for="phone" class="form-label">Phone Number <span class="required-star">*</span></label>
              <input
                type="tel"
                id="phone"
                name="phone"
                class="form-input"
                required
                autocomplete="tel"
                placeholder="(000) 000-0000">
            </div>
          </div>

          <!-- Email -->
          <div class="form-field">
            <label for="email" class="form-label">Email Address <span class="required-star">*</span></label>
            <input
              type="email"
              id="email"
              name="email"
              class="form-input"
              required
              autocomplete="email"
              placeholder="you@email.com">
          </div>

          <!-- Service -->
          <div class="form-field">
            <label for="service" class="form-label">Service Needed</label>
            <select id="service" name="service" class="form-input form-select">
              <option value="">Select a service...</option>
              <?php if (!empty($services)): ?>
                <?php foreach ($services as $svc): ?>
                <option value="<?php echo htmlspecialchars($svc['name'], ENT_QUOTES, 'UTF-8'); ?>">
                  <?php echo htmlspecialchars($svc['name'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
                <?php endforeach; ?>
              <?php else: ?>
              <option value="Roof Replacement">Roof Replacement</option>
              <option value="Roof Repair">Roof Repair</option>
              <option value="Storm Damage Repair">Storm Damage Repair</option>
              <option value="Roof Inspection">Roof Inspection</option>
              <option value="Commercial Roofing">Commercial Roofing</option>
              <option value="Gutter Installation">Gutter Installation</option>
              <option value="Other">Other / Not Sure</option>
              <?php endif; ?>
            </select>
          </div>

          <!-- Message -->
          <div class="form-field">
            <label for="message" class="form-label">Tell Us About Your Roof</label>
            <textarea
              id="message"
              name="message"
              class="form-input form-textarea"
              rows="4"
              placeholder="Describe the issue, approximate age of roof, or any other details..."></textarea>
          </div>

          <!-- TCPA Consent Checkboxes — REQUIRED (3 separate, unbundled) -->
          <fieldset class="form-consent-fieldset">
            <legend class="form-consent-legend">Communication Preferences</legend>

            <label class="form-consent-item">
              <input type="checkbox" name="email_opt_in" value="yes" class="consent-checkbox">
              <span class="consent-label">
                <strong>Email updates (optional):</strong> I agree to receive emails from
                <?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?> about my inquiry,
                services, promotions, and news. I understand I can unsubscribe anytime via the link
                in any email or by emailing
                <?php echo htmlspecialchars($contactEmail ?? $email ?? 'us', ENT_QUOTES, 'UTF-8'); ?>.
                Message frequency varies.
              </span>
            </label>

            <label class="form-consent-item">
              <input type="checkbox" name="sms_opt_in" value="yes" class="consent-checkbox">
              <span class="consent-label">
                <strong>SMS/Text messages (optional):</strong> I agree to receive text messages from
                <?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?> at the phone number
                I provided. Message types may include appointment reminders, service updates, and
                promotional offers. Message frequency varies. Message and data rates may apply.
                Reply STOP to unsubscribe, HELP for help.
                <strong>Consent is not a condition of purchase.</strong>
              </span>
            </label>

            <label class="form-consent-item form-consent-required">
              <input type="checkbox" name="terms_accepted" value="yes" class="consent-checkbox" required>
              <span class="consent-label">
                I have read and agree to the
                <a href="/privacy-policy/">Privacy Policy</a>
                and
                <a href="/terms/">Terms of Service</a>. <span class="required-star">*</span>
              </span>
            </label>

          </fieldset>

          <button type="submit" class="form-submit-btn">
            <i data-lucide="send" aria-hidden="true"></i>
            Send My Request
          </button>

        </form>

      </div><!-- /contact-form-wrap -->

      <!-- ── RIGHT: Contact info ────────────────────────────────────────── -->
      <div class="contact-info-panel" data-animate="fade-up" style="animation-delay:120ms">

        <h3>Reach Us Directly</h3>

        <div class="contact-info-items">

          <?php if (!empty($phone)): ?>
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i data-lucide="phone" aria-hidden="true"></i>
            </div>
            <div class="contact-info-text">
              <div class="info-label">Phone</div>
              <div class="info-value">
                <a href="tel:<?php echo telHref($phone); ?>" aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
                  <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
                </a>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <?php if (!empty($email)): ?>
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i data-lucide="mail" aria-hidden="true"></i>
            </div>
            <div class="contact-info-text">
              <div class="info-label">Email</div>
              <div class="info-value">
                <a href="mailto:<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>">
                  <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>
                </a>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <?php if (!empty($address['street']) || !empty($address['city'])): ?>
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i data-lucide="map-pin" aria-hidden="true"></i>
            </div>
            <div class="contact-info-text">
              <div class="info-label">Service Area</div>
              <div class="info-value">
                <?php if (!empty($address['city'])): ?>
                <?php echo htmlspecialchars($address['city'], ENT_QUOTES, 'UTF-8'); ?><?php if (!empty($address['state'])): ?>, <?php echo htmlspecialchars($address['state'], ENT_QUOTES, 'UTF-8'); ?><?php endif; ?><br>
                <?php endif; ?>
                <?php if (!empty($address['street'])): ?>
                <?php echo htmlspecialchars($address['street'], ENT_QUOTES, 'UTF-8'); ?><?php if (!empty($address['zip'])): ?> <?php echo htmlspecialchars($address['zip'], ENT_QUOTES, 'UTF-8'); ?><?php endif; ?>
                <?php else: ?>
                <?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?> &amp; Surrounding Region
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php else: ?>
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i data-lucide="map-pin" aria-hidden="true"></i>
            </div>
            <div class="contact-info-text">
              <div class="info-label">Service Area</div>
              <div class="info-value"><?php echo htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8'); ?> &amp; Surrounding Region</div>
            </div>
          </div>
          <?php endif; ?>

          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i data-lucide="clock" aria-hidden="true"></i>
            </div>
            <div class="contact-info-text">
              <div class="info-label">Business Hours</div>
              <div class="info-value">
                <div class="hours-list">
                  <div class="hours-row"><span class="day">Mon – Fri</span><span>7:00 am – 6:00 pm</span></div>
                  <div class="hours-row"><span class="day">Saturday</span><span>8:00 am – 2:00 pm</span></div>
                  <div class="hours-row"><span class="day">Sunday</span><span>Emergency only</span></div>
                </div>
              </div>
            </div>
          </div>

        </div><!-- /contact-info-items -->

        <!-- Map embed -->
        <div class="map-placeholder" aria-label="A-1 Roof Works LLC service area map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d193595.9147703055!2d-74.11976397304903!3d40.69766374859258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus"
            title="A-1 Roof Works LLC service area"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>

      </div><!-- /contact-info-panel -->

    </div><!-- /contact-split -->
  </div>
</section>

<!-- Divider: wave ───────────────────────────────────────────────────────── -->
<div class="contact-svg-divider" aria-hidden="true" style="background:var(--color-bg)">
  <svg viewBox="0 0 1200 80" preserveAspectRatio="none" style="height:80px">
    <path d="M0,40 C300,80 900,0 1200,40 L1200,80 L0,80 Z" fill="var(--color-bg-alt)"/>
  </svg>
</div>

<!-- ── WHAT HAPPENS NEXT ──────────────────────────────────────────────────── -->
<section class="contact-next-section" aria-labelledby="next-steps-heading">
  <div class="container">

    <div class="next-steps-header" data-animate="fade-up">
      <span class="section-eyebrow eyebrow-solid" style="display:inline-flex;justify-content:center;margin-bottom:var(--space-lg)">
        <i data-lucide="arrow-right" aria-hidden="true" style="width:14px;height:14px"></i>
        After You Submit
      </span>
      <h2 id="next-steps-heading">What Happens After You Send the Form</h2>
      <p>No generic "thank you, we'll be in touch." Here's exactly what to expect.</p>
    </div>

    <div class="next-steps-grid">
      <div class="next-step" data-animate="fade-up">
        <div class="next-step-num" aria-hidden="true">1</div>
        <h4>We Review &amp; Call Back</h4>
        <p>We review your request and call you back within 2 business hours — usually sooner. If you submit outside hours, we call first thing the next morning.</p>
      </div>
      <div class="next-step" data-animate="fade-up" style="animation-delay:100ms">
        <div class="next-step-num" aria-hidden="true">2</div>
        <h4>Free Roof Inspection</h4>
        <p>We schedule a free on-site inspection at a time that works for you. We inspect the full roof system — shingles, flashing, decking, vents — and photograph everything.</p>
      </div>
      <div class="next-step" data-animate="fade-up" style="animation-delay:200ms">
        <div class="next-step-num" aria-hidden="true">3</div>
        <h4>Written Estimate, Zero Pressure</h4>
        <p>You receive a fully itemized written estimate. No verbal quotes, no vague pricing, no pressure to sign on the spot. Take the time you need to decide.</p>
      </div>
    </div>

  </div>
</section>

<!-- ── MID-PAGE CTA — Phone Emphasis (CTA #2) ───────────────────────────── -->
<section class="contact-phone-cta" aria-labelledby="phone-cta-heading">
  <div class="container">
    <div class="contact-phone-cta-inner" data-animate="fade-up">

      <span class="section-eyebrow eyebrow-pill" style="margin-bottom:var(--space-lg)">
        <i data-lucide="phone-call" aria-hidden="true"></i>
        Prefer to Talk?
      </span>

      <h2 id="phone-cta-heading">
        Prefer to Call? We Answer.
      </h2>
      <p>
        Skip the form. Call us directly and speak with someone who can answer your questions,
        schedule an inspection, or dispatch a crew for emergency work.
      </p>

      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="phone-display-large" aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
        <i data-lucide="phone" aria-hidden="true"></i>
        <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <span class="phone-subtext">Mon – Fri 7am–6pm · Sat 8am–2pm · Emergency: Anytime</span>
      <?php else: ?>
      <a href="/contact" class="phone-display-large">
        <i data-lucide="clipboard-list" aria-hidden="true"></i>
        Get Your Free Estimate
      </a>
      <span class="phone-subtext">Mon – Fri 7am–6pm · Sat 8am–2pm · Emergency: Anytime</span>
      <?php endif; ?>

    </div>
  </div>
</section>

<!-- ── EMERGENCY CTA (CTA #3) ────────────────────────────────────────────── -->
<section class="contact-emergency-section" aria-labelledby="emergency-heading">
  <div class="container" data-animate="fade-up">

    <div class="emergency-card">
      <div class="emergency-icon-row" aria-hidden="true">
        <div class="emergency-icon-wrap">
          <i data-lucide="cloud-lightning" aria-hidden="true"></i>
        </div>
      </div>
      <h2 id="emergency-heading">
        Actively Leaking? Call Now — Same-Day Response Available.
      </h2>
      <p>
        If your roof is actively leaking after a storm or severe weather, don't wait for a scheduled estimate.
        We respond same-day for emergency situations in our primary service area — we'll get someone to you to
        assess the damage and secure the roof before it gets worse.
      </p>
      <?php if (!empty($phone)): ?>
      <a href="tel:<?php echo telHref($phone); ?>" class="btn-emergency-call">
        <i data-lucide="phone" aria-hidden="true"></i>
        Call Now — <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php else: ?>
      <a href="/contact" class="btn-emergency-call">
        <i data-lucide="clipboard-list" aria-hidden="true"></i>
        Request Emergency Response
      </a>
      <?php endif; ?>
    </div>

  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
