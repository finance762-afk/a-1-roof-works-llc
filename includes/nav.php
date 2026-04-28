<?php
/**
 * nav.php — Site navigation: skip link, glassmorphism navbar, mobile menu.
 *
 * Outputs:
 *   - Skip-to-content link
 *   - <header class="site-header" data-header>
 *       <nav> with logo, desktop nav links, services dropdown, desktop CTA
 *       Hamburger button (mobile)
 *   - .mobile-menu full-screen overlay panel
 *   - </header>
 *
 * Expects config.php and functions.php to be loaded (head.php handles this).
 * Included by includes/header.php which also opens <main id="main-content">.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>

<!-- Skip navigation (accessibility) -->
<a href="#main-content" class="skip-link">Skip to main content</a>

<header class="site-header" data-header>

  <nav class="navbar" aria-label="Main navigation">
    <div class="navbar-inner container">

      <!-- ── Logo ─────────────────────────────────────────────────────── -->
      <a href="/" class="navbar-logo" aria-label="<?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?> — Go to homepage">
        <img src="/assets/images/logo.png"
             alt="A1 Roof Works logo featuring an orange worker on a green house roof with chimney"
             width="40"
             height="40"
             loading="eager"
             class="navbar-logo-img">
        <span class="logo-text">
          <span class="logo-name">Roof Works</span>
          <span class="logo-tagline"><?php echo htmlspecialchars($tagline, ENT_QUOTES, 'UTF-8'); ?></span>
        </span>
      </a>

      <!-- ── Desktop Navigation ────────────────────────────────────────── -->
      <ul class="navbar-links" role="list">

        <li>
          <a href="/"
             class="nav-link<?php echo isActivePage('home') ? ' nav-link--active' : ''; ?>"
             <?php echo isActivePage('home') ? 'aria-current="page"' : ''; ?>>
            Home
          </a>
        </li>

        <!-- Services with dropdown -->
        <li class="has-dropdown">
          <a href="/services"
             class="nav-link<?php echo isActivePage('services') ? ' nav-link--active' : ''; ?>"
             aria-haspopup="true"
             aria-expanded="false"
             <?php echo isActivePage('services') ? 'aria-current="page"' : ''; ?>>
            Services
            <i data-lucide="chevron-down" class="nav-chevron" aria-hidden="true"></i>
          </a>
          <?php if (!empty($services)): ?>
          <ul class="dropdown-menu" role="list">
            <?php foreach ($services as $svc): ?>
            <li>
              <a href="/services/<?php echo getServiceSlug($svc['name']); ?>"
                 class="dropdown-link">
                <?php echo htmlspecialchars($svc['name'], ENT_QUOTES, 'UTF-8'); ?>
              </a>
            </li>
            <?php endforeach; ?>
            <li>
              <a href="/services" class="dropdown-link dropdown-link--all">
                View All Services →
              </a>
            </li>
          </ul>
          <?php else: ?>
          <!-- Default dropdown fallback — populate $services in config.php to replace -->
          <ul class="dropdown-menu" role="list">
            <li><a href="/services/roof-replacement"  class="dropdown-link">Roof Replacement</a></li>
            <li><a href="/services/roof-repair"        class="dropdown-link">Roof Repair</a></li>
            <li><a href="/services/storm-damage-repair" class="dropdown-link">Storm Damage Repair</a></li>
            <li><a href="/services"                    class="dropdown-link dropdown-link--all">View All Services →</a></li>
          </ul>
          <?php endif; ?>
        </li>

        <li>
          <a href="/service-area"
             class="nav-link<?php echo isActivePage('service-area') ? ' nav-link--active' : ''; ?>"
             <?php echo isActivePage('service-area') ? 'aria-current="page"' : ''; ?>>
            Service Area
          </a>
        </li>

        <li>
          <a href="/about"
             class="nav-link<?php echo isActivePage('about') ? ' nav-link--active' : ''; ?>"
             <?php echo isActivePage('about') ? 'aria-current="page"' : ''; ?>>
            About
          </a>
        </li>

        <li>
          <a href="/contact"
             class="nav-link<?php echo isActivePage('contact') ? ' nav-link--active' : ''; ?>"
             <?php echo isActivePage('contact') ? 'aria-current="page"' : ''; ?>>
            Contact
          </a>
        </li>

      </ul><!-- /.navbar-links -->

      <!-- ── Desktop CTA ───────────────────────────────────────────────── -->
      <div class="navbar-cta" aria-label="Quick contact">
        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>" class="navbar-phone" aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
          <i data-lucide="phone" aria-hidden="true"></i>
          <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php endif; ?>
        <a href="/contact" class="btn-nav-cta">Free Estimate</a>
      </div>

      <!-- ── Hamburger (mobile) ─────────────────────────────────────────── -->
      <button class="hamburger"
              id="hamburgerBtn"
              type="button"
              aria-expanded="false"
              aria-controls="mobileMenu"
              aria-label="Open navigation menu">
        <span class="hamburger-line" aria-hidden="true"></span>
        <span class="hamburger-line" aria-hidden="true"></span>
        <span class="hamburger-line" aria-hidden="true"></span>
      </button>

    </div><!-- /.navbar-inner -->
  </nav><!-- /.navbar -->

  <!-- ── Mobile Full-Screen Menu ─────────────────────────────────────────── -->
  <div class="mobile-menu"
       id="mobileMenu"
       aria-hidden="true"
       role="dialog"
       aria-modal="true"
       aria-label="Site navigation">

    <!-- Tap-outside overlay -->
    <div class="mobile-menu-overlay" id="menuOverlay" aria-hidden="true"></div>

    <!-- Slide-in panel -->
    <div class="mobile-menu-panel" role="document">

      <button class="mobile-close"
              id="mobileClose"
              type="button"
              aria-label="Close navigation menu">
        <i data-lucide="x" aria-hidden="true"></i>
      </button>

      <nav class="mobile-nav" aria-label="Mobile navigation">
        <ul class="mobile-nav-list" role="list">

          <li>
            <a href="/"
               class="mobile-nav-link<?php echo isActivePage('home') ? ' mobile-nav-link--active' : ''; ?>"
               <?php echo isActivePage('home') ? 'aria-current="page"' : ''; ?>>
              Home
            </a>
          </li>

          <li>
            <a href="/services"
               class="mobile-nav-link<?php echo isActivePage('services') ? ' mobile-nav-link--active' : ''; ?>"
               <?php echo isActivePage('services') ? 'aria-current="page"' : ''; ?>>
              Services
            </a>
            <!-- Service sub-links -->
            <?php if (!empty($services)): ?>
            <ul class="mobile-sub-links" role="list">
              <?php foreach ($services as $svc): ?>
              <li>
                <a href="/services/<?php echo getServiceSlug($svc['name']); ?>" class="mobile-sub-link">
                  <?php echo htmlspecialchars($svc['name'], ENT_QUOTES, 'UTF-8'); ?>
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
            <?php else: ?>
            <ul class="mobile-sub-links" role="list">
              <li><a href="/services/roof-replacement"   class="mobile-sub-link">Roof Replacement</a></li>
              <li><a href="/services/roof-repair"         class="mobile-sub-link">Roof Repair</a></li>
              <li><a href="/services/storm-damage-repair" class="mobile-sub-link">Storm Damage Repair</a></li>
            </ul>
            <?php endif; ?>
          </li>

          <li>
            <a href="/service-area"
               class="mobile-nav-link<?php echo isActivePage('service-area') ? ' mobile-nav-link--active' : ''; ?>"
               <?php echo isActivePage('service-area') ? 'aria-current="page"' : ''; ?>>
              Service Area
            </a>
          </li>

          <li>
            <a href="/about"
               class="mobile-nav-link<?php echo isActivePage('about') ? ' mobile-nav-link--active' : ''; ?>"
               <?php echo isActivePage('about') ? 'aria-current="page"' : ''; ?>>
              About
            </a>
          </li>

          <li>
            <a href="/contact"
               class="mobile-nav-link<?php echo isActivePage('contact') ? ' mobile-nav-link--active' : ''; ?>"
               <?php echo isActivePage('contact') ? 'aria-current="page"' : ''; ?>>
              Contact
            </a>
          </li>

        </ul><!-- /.mobile-nav-list -->

        <?php if (!empty($phone)): ?>
        <a href="tel:<?php echo telHref($phone); ?>"
           class="mobile-phone-cta"
           aria-label="Call <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
          <i data-lucide="phone" aria-hidden="true"></i>
          <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
        </a>
        <?php endif; ?>

        <a href="/contact" class="mobile-cta-btn">Get Free Estimate</a>

      </nav><!-- /.mobile-nav -->

    </div><!-- /.mobile-menu-panel -->
  </div><!-- /.mobile-menu -->

</header>
