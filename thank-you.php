<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$noindex         = true;
$pageTitle       = 'Thank You — We\'ll Be in Touch | A-1 Roof Works LLC';
$pageDescription = 'Your message has been received. A-1 Roof Works LLC will contact you within 2 business hours.';
$canonicalUrl    = $siteUrl . '/thank-you';
$currentPage     = 'thank-you';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<style>
/* ── Thank You Page Styles ───────────────────────────────────────────── */
.thankyou-page {
  min-height: calc(100vh - var(--navbar-height));
  padding: calc(var(--navbar-height) + var(--space-4xl)) var(--space-lg) var(--space-4xl);
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--color-bg);
  position: relative;
  overflow: hidden;
}

.thankyou-page::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(var(--color-primary-rgb), 0.05) 0%, transparent 70%);
  pointer-events: none;
}

.thankyou-inner {
  max-width: 640px;
  width: 100%;
  text-align: center;
  position: relative;
  z-index: 1;
}

/* ── Success Icon ───────────────────────────────────────────────────────── */
.success-icon-wrap {
  width: 88px;
  height: 88px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto var(--space-xl);
  box-shadow: 0 0 0 12px rgba(var(--color-primary-rgb), 0.08), var(--shadow-lg);
}

.success-icon-wrap i {
  color: #fff;
  width: 40px;
  height: 40px;
}

/* ── Heading ────────────────────────────────────────────────────────────── */
.thankyou-heading {
  font-family: var(--font-heading);
  font-size: clamp(1.6rem, 4vw, 2.4rem);
  font-weight: 800;
  color: var(--color-primary);
  letter-spacing: -0.02em;
  text-wrap: balance;
  line-height: 1.2;
  margin-bottom: var(--space-md);
}

.thankyou-subtext {
  font-size: 1.05rem;
  color: var(--color-text-light);
  line-height: 1.65;
  max-width: 50ch;
  margin: 0 auto var(--space-md);
}

.thankyou-urgent {
  font-size: 1rem;
  color: var(--color-text);
  line-height: 1.6;
  max-width: 50ch;
  margin: 0 auto var(--space-xl);
}

/* ── Phone CTA ──────────────────────────────────────────────────────────── */
.thankyou-phone {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  font-family: var(--font-heading);
  font-size: clamp(1.4rem, 4vw, 1.8rem);
  font-weight: 800;
  color: var(--color-accent);
  text-decoration: none;
  letter-spacing: -0.01em;
  margin-bottom: var(--space-3xl);
  transition: color var(--transition-fast);
}

.thankyou-phone:hover { color: var(--color-primary); }

/* ── Divider ────────────────────────────────────────────────────────────── */
.thankyou-divider {
  width: 60px;
  height: 3px;
  background: linear-gradient(90deg, var(--color-primary), var(--color-accent));
  border-radius: 99px;
  margin: 0 auto var(--space-3xl);
}

/* ── Next Steps ─────────────────────────────────────────────────────────── */
.next-steps-label {
  font-family: var(--font-heading);
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--color-text-light);
  margin-bottom: var(--space-lg);
}

.next-steps {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-md);
  margin-bottom: var(--space-3xl);
  text-align: left;
}

.next-step {
  background: var(--color-bg-alt);
  border: 1px solid rgba(var(--color-primary-rgb), 0.08);
  border-radius: var(--radius-lg);
  padding: var(--space-lg);
  position: relative;
  overflow: hidden;
  transition: box-shadow var(--transition-base);
}

.next-step::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--color-primary), var(--color-accent));
}

.next-step-num {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  background: var(--color-primary);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 0.9rem;
  font-weight: 800;
  border-radius: 50%;
  margin-bottom: var(--space-sm);
  flex-shrink: 0;
}

.next-step-title {
  font-family: var(--font-heading);
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: var(--space-xs);
  text-wrap: balance;
}

.next-step-text {
  font-size: 0.85rem;
  color: var(--color-text-light);
  line-height: 1.55;
}

/* ── Action Row ─────────────────────────────────────────────────────────── */
.thankyou-actions {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-md);
  flex-wrap: wrap;
}

.btn-primary {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  padding: 14px 28px;
  background: var(--color-primary);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 700;
  letter-spacing: 0.03em;
  border-radius: var(--radius-md);
  text-decoration: none;
  box-shadow: 0 4px 0 var(--color-primary-dark);
  transition: all var(--transition-fast);
  position: relative;
  overflow: hidden;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 0 var(--color-primary-dark);
  color: #fff;
}

.btn-primary:active {
  transform: translateY(2px);
  box-shadow: 0 2px 0 var(--color-primary-dark);
}

.btn-secondary-link {
  display: inline-flex;
  align-items: center;
  gap: var(--space-xs);
  font-size: 0.95rem;
  font-weight: 600;
  color: var(--color-primary);
  text-decoration: underline;
  text-underline-offset: 3px;
  transition: color var(--transition-fast);
}

.btn-secondary-link:hover { color: var(--color-accent); }

/* ── Responsive ─────────────────────────────────────────────────────────── */
@media (max-width: 767px) {
  .thankyou-page {
    padding: calc(var(--navbar-height) + var(--space-2xl)) var(--space-md) var(--space-3xl);
    align-items: flex-start;
  }

  .next-steps {
    grid-template-columns: 1fr;
  }

  .thankyou-actions {
    flex-direction: column;
    gap: var(--space-md);
  }

  .btn-primary {
    width: 100%;
    justify-content: center;
  }
}
</style>

<section class="thankyou-page" aria-labelledby="thankyou-heading">
    <div class="thankyou-inner">

      <div class="success-icon-wrap" aria-hidden="true">
        <i data-lucide="check"></i>
      </div>

      <h1 class="thankyou-heading" id="thankyou-heading">We Got Your Request — You'll Hear From Us Shortly</h1>

      <p class="thankyou-subtext">Your information has been received. Someone from our team will reach out within 2 business hours during business hours (Mon–Fri 7am–6pm, Sat 8am–2pm).</p>

      <p class="thankyou-urgent">If you have an urgent roof situation that can't wait — an active leak, storm damage — call us directly:</p>

      <?php if (!empty($contactPhone)): ?>
      <a href="tel:<?php echo telHref($contactPhone); ?>" class="thankyou-phone">
        <i data-lucide="phone-call"></i>
        <?php echo htmlspecialchars($contactPhone, ENT_QUOTES, 'UTF-8'); ?>
      </a>
      <?php endif; ?>

      <div class="thankyou-divider" aria-hidden="true"></div>

      <p class="next-steps-label">What Happens Next</p>
      <div class="next-steps">
        <div class="next-step">
          <div class="next-step-num">1</div>
          <p class="next-step-title">We Review Your Request</p>
          <p class="next-step-text">We'll contact you to confirm project details and answer any questions you have before the visit.</p>
        </div>
        <div class="next-step">
          <div class="next-step-num">2</div>
          <p class="next-step-title">Schedule Your Inspection</p>
          <p class="next-step-text">We'll schedule a free roof inspection at a time that's convenient for you — including Saturday appointments.</p>
        </div>
        <div class="next-step">
          <div class="next-step-num">3</div>
          <p class="next-step-title">Get Your Written Estimate</p>
          <p class="next-step-text">You'll receive a clear, written estimate — no pressure, no obligation, and no surprise charges.</p>
        </div>
      </div>

      <div class="thankyou-actions">
        <a href="/" class="btn-primary">
          <i data-lucide="home"></i>
          Back to Home
        </a>
        <a href="/services" class="btn-secondary-link">
          <i data-lucide="layers"></i>
          Browse Our Services
        </a>
      </div>

    </div>
  </section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
