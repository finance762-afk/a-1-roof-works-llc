<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$pageTitle       = '404 — Page Not Found | A-1 Roof Works LLC';
$pageDescription = 'The page you were looking for does not exist. Find roofing services, contact information, and more.';
$canonicalUrl    = $siteUrl . '/404';
$currentPage     = '404';
$noindex         = true;

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<style>
/* ── 404 Page Styles ──────────────────────────────────────────────────── */
.error-page {
  min-height: calc(100vh - var(--navbar-height));
  display: flex;
  align-items: center;
  justify-content: center;
  padding: var(--space-4xl) var(--space-lg);
  background: var(--color-bg);
  position: relative;
  overflow: hidden;
}

.error-page::before {
  content: '404';
  position: absolute;
  font-family: var(--font-heading);
  font-size: clamp(12rem, 30vw, 22rem);
  font-weight: 900;
  color: rgba(var(--color-primary-rgb), 0.04);
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  pointer-events: none;
  white-space: nowrap;
  letter-spacing: -0.05em;
  user-select: none;
}

.error-inner {
  max-width: 680px;
  width: 100%;
  text-align: center;
  position: relative;
  z-index: 1;
}

.error-code {
  font-family: var(--font-heading);
  font-size: clamp(5rem, 15vw, 9rem);
  font-weight: 900;
  line-height: 1;
  letter-spacing: -0.04em;
  background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: var(--space-lg);
  display: block;
}

.error-heading {
  font-family: var(--font-heading);
  font-size: clamp(1.4rem, 3.5vw, 2rem);
  font-weight: 700;
  color: var(--color-primary);
  letter-spacing: -0.02em;
  text-wrap: balance;
  line-height: 1.2;
  margin-bottom: var(--space-md);
}

.error-subtext {
  font-size: 1.05rem;
  color: var(--color-text-light);
  line-height: 1.65;
  max-width: 52ch;
  margin: 0 auto var(--space-2xl);
}

/* ── Divider ────────────────────────────────────────────────────────────── */
.error-divider {
  width: 60px;
  height: 3px;
  background: linear-gradient(90deg, var(--color-primary), var(--color-accent));
  border-radius: 99px;
  margin: 0 auto var(--space-2xl);
}

/* ── Quick Links Grid ─────────────────────────────────────────────────── */
.error-links-label {
  font-family: var(--font-heading);
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--color-text-light);
  margin-bottom: var(--space-md);
}

.error-links {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-sm);
  margin-bottom: var(--space-2xl);
}

.error-link-item {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-xs);
  padding: var(--space-sm) var(--space-md);
  background: var(--color-bg-alt);
  border: 1px solid rgba(var(--color-primary-rgb), 0.10);
  border-radius: var(--radius-md);
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--color-primary);
  text-decoration: none;
  transition: all var(--transition-base);
}

.error-link-item:hover {
  background: var(--color-primary);
  color: #fff;
  border-color: var(--color-primary);
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
}

.error-link-item i {
  font-size: 0.9rem;
  flex-shrink: 0;
}

/* ── CTA Row ────────────────────────────────────────────────────────────── */
.error-cta-row {
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
  background: var(--color-accent);
  color: #fff;
  font-family: var(--font-heading);
  font-size: 1rem;
  font-weight: 700;
  letter-spacing: 0.03em;
  border-radius: var(--radius-md);
  text-decoration: none;
  box-shadow: 0 4px 0 #b37800;
  transition: all var(--transition-fast);
  position: relative;
  overflow: hidden;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 0 #b37800;
  color: #fff;
}

.btn-primary:active {
  transform: translateY(2px);
  box-shadow: 0 2px 0 #b37800;
}

.error-phone-link {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  font-family: var(--font-heading);
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--color-primary);
  text-decoration: none;
  transition: color var(--transition-fast);
}

.error-phone-link:hover {
  color: var(--color-accent);
}

/* ── Responsive ─────────────────────────────────────────────────────────── */
@media (max-width: 767px) {
  .error-page {
    padding: var(--space-3xl) var(--space-md);
    align-items: flex-start;
    padding-top: calc(var(--navbar-height) + var(--space-2xl));
  }

  .error-links {
    grid-template-columns: repeat(2, 1fr);
  }

  .error-cta-row {
    flex-direction: column;
    gap: var(--space-md);
  }

  .btn-primary {
    width: 100%;
    justify-content: center;
  }
}
</style>

<section class="error-page" aria-labelledby="error-heading">
    <div class="error-inner">
      <span class="error-code" aria-hidden="true">404</span>
      <h1 class="error-heading" id="error-heading">That Page Doesn't Exist — But Your Roof Might Have a Problem That Does</h1>
      <div class="error-divider" aria-hidden="true"></div>
      <p class="error-subtext">The page you're looking for has moved or never existed. Try the links below, or call us directly if you need roofing help in the area.</p>

      <p class="error-links-label">Popular Pages</p>
      <nav class="error-links" aria-label="Popular pages">
        <a href="/" class="error-link-item">
          <i data-lucide="home"></i>
          Home
        </a>
        <a href="/services" class="error-link-item">
          <i data-lucide="layers"></i>
          All Services
        </a>
        <a href="/services/roof-replacement" class="error-link-item">
          <i data-lucide="hard-hat"></i>
          Roof Replacement
        </a>
        <a href="/services/roof-repair" class="error-link-item">
          <i data-lucide="wrench"></i>
          Roof Repair
        </a>
        <a href="/services/storm-damage-repair" class="error-link-item">
          <i data-lucide="cloud-lightning"></i>
          Storm Damage
        </a>
        <a href="/contact" class="error-link-item">
          <i data-lucide="phone"></i>
          Free Estimate
        </a>
      </nav>

      <div class="error-cta-row">
        <a href="/contact" class="btn-primary">
          <i data-lucide="clipboard-list"></i>
          Get a Free Estimate
        </a>
        <?php if (!empty($contactPhone)): ?>
        <a href="tel:<?php echo telHref($contactPhone); ?>" class="error-phone-link">
          <i data-lucide="phone-call"></i>
          <?php echo htmlspecialchars($contactPhone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
