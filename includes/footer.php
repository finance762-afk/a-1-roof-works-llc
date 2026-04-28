<?php
/**
 * footer.php — Site footer, scripts, and closing tags for A-1 Roof Works LLC
 *
 * Outputs:
 *   - </main>  ← closes the <main> opened by header.php
 *   - <footer> with 4-column grid (brand, services, areas/nav, contact)
 *   - AEO entity block
 *   - Footer legal row (Privacy Policy | Terms | Cookie Policy | Accessibility | DNSSMI | Sitemap)
 *   - Copyright line + dofollow Page One Insights credit
 *   - Back-to-top button
 *   - Mobile floating CTA bar
 *   - All script tags (main.js, animations.js, effects.js, CDNs)
 *   - Inline init script (Lucide icons, back-to-top, navbar scroll, mobile menu)
 *   - </body></html>
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

// NAP footer phone ← set $phone in config.php (example format: (555) 555-0100)

/* Split services array for two-column layout in footer */
$serviceCount   = !empty($services) ? count($services) : 0;
$servicesHalf   = (int) ceil($serviceCount / 2);
$servicesFirst  = $serviceCount > 0 ? array_slice($services, 0, $servicesHalf) : [];
$servicesSecond = $serviceCount > 0 ? array_slice($services, $servicesHalf)   : [];

/* AEO entity: area list (up to 5 cities) */
$areaNames = [];
if (!empty($serviceAreas)) {
    foreach (array_slice($serviceAreas, 0, 5) as $area) {
        $areaNames[] = $area['city'];
    }
}
$areaList = !empty($areaNames) ? implode(', ', $areaNames) . ' and surrounding areas' : 'the local area';
?>

</main><!-- /#main-content -->

<!-- ═══════════════════════════════════════════════════════════════
     FOOTER
════════════════════════════════════════════════════════════════ -->
<footer class="site-footer"
        itemscope
        itemtype="https://schema.org/LocalBusiness"
        aria-label="Site footer">

  <!-- Hidden microdata properties for schema completeness -->
  <meta itemprop="name"      content="<?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?>">
  <meta itemprop="url"       content="<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>">
  <?php if (!empty($phone)): ?>
  <meta itemprop="telephone" content="<?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
  <?php endif; ?>

  <!-- ── Footer Top (4-column grid) ──────────────────────────────────── -->
  <div class="footer-top">
    <div class="container">
      <div class="footer-grid">

        <!-- Column 1: Brand + Trust badges -->
        <div class="footer-col footer-brand">

          <a href="/" class="footer-logo" aria-label="<?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?> — Go to homepage">
            <img src="/assets/images/logo.png"
                 alt="A1 Roof Works logo featuring an orange worker on a green house roof with chimney"
                 width="40"
                 height="40"
                 loading="lazy"
                 class="footer-logo-img">
            <span class="footer-logo-text">Roof Works</span>
          </a>

          <p class="footer-tagline"><?php echo htmlspecialchars($tagline, ENT_QUOTES, 'UTF-8'); ?></p>

          <p class="footer-desc">
            Professional roofing contractor serving
            <?php echo htmlspecialchars($address['city'] ?? 'the local area', ENT_QUOTES, 'UTF-8'); ?><?php if (!empty($address['state'])): ?>,
            <?php echo htmlspecialchars($address['state'], ENT_QUOTES, 'UTF-8'); ?><?php endif; ?>.
            Licensed, insured, and dedicated to roofs that last.
          </p>

          <div class="footer-trust-badges" aria-label="Trust indicators">
            <span class="trust-badge">
              <i data-lucide="shield-check" aria-hidden="true"></i>
              Licensed &amp; Insured
            </span>
            <?php if (!empty($yearsInBusiness)): ?>
            <span class="trust-badge">
              <i data-lucide="award" aria-hidden="true"></i>
              <?php echo htmlspecialchars($yearsInBusiness, ENT_QUOTES, 'UTF-8'); ?>+ Years in Business
            </span>
            <?php endif; ?>
            <span class="trust-badge">
              <i data-lucide="tag" aria-hidden="true"></i>
              Free Estimates
            </span>
            <span class="trust-badge">
              <i data-lucide="star" aria-hidden="true"></i>
              <?php if (!empty($aggregateRating)): ?>
              <?php echo htmlspecialchars($aggregateRating, ENT_QUOTES, 'UTF-8'); ?> / 5 — Rated by Customers
              <?php else: ?>
              Top-Rated Local Roofer
              <?php endif; ?>
            </span>
          </div>

          <?php if (!empty($socialLinks)): ?>
          <div class="footer-social" aria-label="Social media profiles">
            <?php foreach ($socialLinks as $platform => $url): ?>
            <?php if (!empty($url)): ?>
            <?php
            $iconMap = [
                'facebook'  => 'facebook',
                'instagram' => 'instagram',
                'youtube'   => 'youtube',
                'yelp'      => 'star',
                'google'    => 'map-pin',
                'bbb'       => 'shield',
                'twitter'   => 'twitter',
            ];
            $icon = $iconMap[$platform] ?? 'external-link';
            ?>
            <a href="<?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>"
               class="social-link"
               target="_blank"
               rel="noopener noreferrer"
               aria-label="<?php echo htmlspecialchars(ucfirst($platform), ENT_QUOTES, 'UTF-8'); ?> (opens in new tab)">
              <i data-lucide="<?php echo $icon; ?>" aria-hidden="true"></i>
            </a>
            <?php endif; ?>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

        </div><!-- /footer-brand -->

        <!-- Column 2: Services (first half) -->
        <div class="footer-col">
          <h3 class="footer-heading">Our Services</h3>
          <ul class="footer-links" role="list">
            <?php if (!empty($servicesFirst)): ?>
              <?php foreach ($servicesFirst as $svc): ?>
              <li>
                <a href="/services/<?php echo getServiceSlug($svc['name']); ?>" class="footer-link">
                  <?php echo htmlspecialchars($svc['name'], ENT_QUOTES, 'UTF-8'); ?>
                </a>
              </li>
              <?php endforeach; ?>
            <?php else: ?>
              <!-- Default service links — populate $services in config.php to replace -->
              <li><a href="/services/roof-replacement"   class="footer-link">Roof Replacement</a></li>
              <li><a href="/services/roof-repair"         class="footer-link">Roof Repair</a></li>
              <li><a href="/services/storm-damage-repair" class="footer-link">Storm Damage Repair</a></li>
              <li><a href="/services/roof-inspection"     class="footer-link">Roof Inspection</a></li>
            <?php endif; ?>
            <li>
              <a href="/services" class="footer-link footer-link--all">View All Services →</a>
            </li>
          </ul>
        </div>

        <!-- Column 3: More services (second half) + service areas + quick nav -->
        <div class="footer-col">

          <?php if (!empty($servicesSecond)): ?>
          <h3 class="footer-heading">More Services</h3>
          <ul class="footer-links" role="list">
            <?php foreach ($servicesSecond as $svc): ?>
            <li>
              <a href="/services/<?php echo getServiceSlug($svc['name']); ?>" class="footer-link">
                <?php echo htmlspecialchars($svc['name'], ENT_QUOTES, 'UTF-8'); ?>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php else: ?>
          <h3 class="footer-heading">Service Areas</h3>
          <ul class="footer-links" role="list">
            <?php if (!empty($serviceAreas)): ?>
              <?php foreach (array_slice($serviceAreas, 0, 6) as $area): ?>
              <li>
                <a href="/service-area/<?php echo getAreaSlug($area['city']); ?>" class="footer-link">
                  <?php echo htmlspecialchars($area['city'], ENT_QUOTES, 'UTF-8'); ?>,
                  <?php echo htmlspecialchars($area['state'], ENT_QUOTES, 'UTF-8'); ?>
                </a>
              </li>
              <?php endforeach; ?>
            <?php else: ?>
              <li><a href="/service-area" class="footer-link">Local Service Area</a></li>
            <?php endif; ?>
            <li><a href="/service-area" class="footer-link footer-link--all">View All Areas →</a></li>
          </ul>
          <?php endif; ?>

          <h3 class="footer-heading" style="margin-top:var(--space-xl)">Quick Navigation</h3>
          <ul class="footer-links" role="list">
            <li><a href="/"            class="footer-link">Home</a></li>
            <li><a href="/services"    class="footer-link">Services</a></li>
            <li><a href="/service-area" class="footer-link">Service Area</a></li>
            <li><a href="/about"       class="footer-link">About Us</a></li>
            <li><a href="/contact"     class="footer-link">Contact</a></li>
          </ul>

        </div>

        <!-- Column 4: Contact info + CTA -->
        <div class="footer-col footer-contact-col">
          <h3 class="footer-heading">Contact Us</h3>

          <address class="footer-address"
                   itemscope
                   itemprop="address"
                   itemtype="https://schema.org/PostalAddress">
            <?php if (!empty($address['street'])): ?>
            <div class="footer-contact-item">
              <i data-lucide="map-pin" aria-hidden="true"></i>
              <span>
                <span itemprop="streetAddress"><?php echo htmlspecialchars($address['street'], ENT_QUOTES, 'UTF-8'); ?></span><br>
                <span itemprop="addressLocality"><?php echo htmlspecialchars($address['city'], ENT_QUOTES, 'UTF-8'); ?></span>,
                <span itemprop="addressRegion"><?php echo htmlspecialchars($address['state'], ENT_QUOTES, 'UTF-8'); ?></span>
                <span itemprop="postalCode"><?php echo htmlspecialchars($address['zip'], ENT_QUOTES, 'UTF-8'); ?></span>
                <meta itemprop="addressCountry" content="US">
              </span>
            </div>
            <?php endif; ?>

            <?php if (!empty($phone)): ?>
            <div class="footer-contact-item">
              <i data-lucide="phone" aria-hidden="true"></i>
              <a href="tel:<?php echo telHref($phone); ?>"
                 itemprop="telephone">
                <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>
              </a>
            </div>
            <?php endif; ?>

            <?php if (!empty($phoneSecondary)): ?>
            <div class="footer-contact-item">
              <i data-lucide="phone-call" aria-hidden="true"></i>
              <a href="tel:<?php echo telHref($phoneSecondary); ?>">
                <?php echo htmlspecialchars($phoneSecondary, ENT_QUOTES, 'UTF-8'); ?>
              </a>
            </div>
            <?php endif; ?>

            <?php if (!empty($email)): ?>
            <div class="footer-contact-item">
              <i data-lucide="mail" aria-hidden="true"></i>
              <a href="mailto:<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>"
                 itemprop="email">
                <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>
              </a>
            </div>
            <?php endif; ?>

          </address>

          <a href="/contact" class="footer-cta-btn">Get Free Estimate</a>

        </div><!-- /footer-contact-col -->

      </div><!-- /.footer-grid -->
    </div><!-- /.container -->
  </div><!-- /.footer-top -->

  <!-- ── AEO Entity Block ─────────────────────────────────────────────────
       Structured descriptive paragraph for AI crawlers (Claude, ChatGPT,
       Perplexity, Google AI Overviews). Visible but visually subdued.
  ─────────────────────────────────────────────────────────────────────── -->
  <div class="footer-entity">
    <div class="container">
      <p itemscope itemtype="https://schema.org/LocalBusiness">
        <meta itemprop="name" content="<?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?>">
        <meta itemprop="url"  content="<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>">
        <?php if (!empty($phone)): ?><meta itemprop="telephone" content="<?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>"><?php endif; ?>
        <?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?> is a roofing contractor based in
        <?php echo htmlspecialchars($address['city'] ?? 'the local area', ENT_QUOTES, 'UTF-8'); ?><?php if (!empty($address['state'])): ?>,
        <?php echo htmlspecialchars($address['state'], ENT_QUOTES, 'UTF-8'); ?><?php endif; ?>,
        serving <?php echo htmlspecialchars($areaList, ENT_QUOTES, 'UTF-8'); ?>.<?php if (!empty($yearEstablished)): ?>
        Founded in <?php echo htmlspecialchars($yearEstablished, ENT_QUOTES, 'UTF-8'); ?>,<?php endif; ?>
        <?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?> specializes in roof replacement, roof repair,
        and storm damage restoration.<?php if (!empty($phone)): ?>
        Contact: <a href="tel:<?php echo telHref($phone); ?>"><?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?></a><?php endif; ?><?php if (!empty($email)): ?>
        | <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?><?php endif; ?><?php if (!empty($siteUrl)): ?>
        | <?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?><?php endif; ?>.
        Licensed and insured.
      </p>
    </div>
  </div><!-- /.footer-entity -->

  <!-- ── Footer Bottom Bar ────────────────────────────────────────────────
       Legal row + copyright + dofollow credit link (REQUIRED)
  ─────────────────────────────────────────────────────────────────────── -->
  <div class="footer-bottom-bar">
    <div class="container">

      <!-- Legal row (TCPA/CCPA/CPRA compliance — all 6 links required) -->
      <nav class="footer-legal-row" aria-label="Legal pages">
        <a href="/privacy-policy/">Privacy Policy</a>
        <span class="divider" aria-hidden="true">|</span>
        <a href="/terms/">Terms of Service</a>
        <span class="divider" aria-hidden="true">|</span>
        <a href="/cookie-policy/">Cookie Policy</a>
        <span class="divider" aria-hidden="true">|</span>
        <a href="/accessibility/">Accessibility</a>
        <span class="divider" aria-hidden="true">|</span>
        <a href="/privacy-policy/#ccpa-rights">Do Not Sell or Share My Personal Information</a>
        <span class="divider" aria-hidden="true">|</span>
        <a href="/sitemap.xml">Sitemap</a>
      </nav>

      <!-- Copyright + dofollow credit (REQUIRED — do not alter or remove) -->
      <div class="footer-copyright">
        <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?>. All rights reserved.</p>
        <p class="footer-credit">
          <a href="https://pageoneinsights.com" rel="dofollow" target="_blank">Web Design &amp; Hosting by Page One Insights, LLC</a>
        </p>
      </div>

    </div><!-- /.container -->
  </div><!-- /.footer-bottom-bar -->

</footer><!-- /.site-footer -->

<!-- ── Back to Top ────────────────────────────────────────────────────────── -->
<button class="back-to-top"
        id="backToTop"
        type="button"
        aria-label="Scroll back to top of page">
  <i data-lucide="chevron-up" aria-hidden="true"></i>
</button>

<!-- ── Mobile Floating CTA Bar (visible < 768px) ─────────────────────────── -->
<div class="mobile-float-cta" role="complementary" aria-label="Quick contact">
  <?php if (!empty($phone)): ?>
  <a href="tel:<?php echo telHref($phone); ?>"
     class="mobile-float-call"
     aria-label="Call us: <?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
    <i data-lucide="phone" aria-hidden="true"></i>
    <span>Call Now</span>
  </a>
  <?php endif; ?>
  <a href="/contact"
     class="mobile-float-estimate"
     aria-label="Get a free estimate">
    <i data-lucide="clipboard-list" aria-hidden="true"></i>
    <span>Free Estimate</span>
  </a>
</div>

<!-- ═══════════════════════════════════════════════════════════════
     SCRIPTS
     Defer all non-critical scripts. Lucide must load before init.
════════════════════════════════════════════════════════════════ -->
<script src="/assets/js/animations.js" defer></script>
<script src="/assets/js/effects.js" defer></script>
<script src="/assets/js/main.js" defer></script>

<?php if (!empty($useSwiper)): ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
<?php endif; ?>

<?php if (!empty($useTilt)): ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js" defer></script>
<?php endif; ?>

<!-- Lucide icons CDN (needed by nav, footer, and any page using data-lucide) -->
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

<script>
(function() {
  'use strict';

  /* ── Lucide icon initialisation ────────────────────────────────────── */
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }

  /* ── Back-to-top ────────────────────────────────────────────────────── */
  var backToTop = document.getElementById('backToTop');
  if (backToTop) {
    window.addEventListener('scroll', function() {
      backToTop.classList.toggle('visible', window.scrollY > 300);
    }, { passive: true });

    backToTop.addEventListener('click', function() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ── Navbar scroll behaviour ─────────────────────────────────────────
     Adds .scrolled to <header> after 80px — triggers glassmorphism.
  ─────────────────────────────────────────────────────────────────── */
  var siteHeader = document.querySelector('[data-header]');
  if (siteHeader) {
    var lastScroll = 0;
    window.addEventListener('scroll', function() {
      var currentScroll = window.scrollY;
      siteHeader.classList.toggle('scrolled', currentScroll > 80);
      lastScroll = currentScroll;
    }, { passive: true });
  }

  /* ── Mobile menu ─────────────────────────────────────────────────────── */
  var hamburgerBtn = document.getElementById('hamburgerBtn');
  var mobileMenu   = document.getElementById('mobileMenu');
  var mobileClose  = document.getElementById('mobileClose');
  var menuOverlay  = document.getElementById('menuOverlay');

  function openMobileMenu() {
    if (!mobileMenu || !hamburgerBtn) return;
    mobileMenu.classList.add('is-open');
    mobileMenu.setAttribute('aria-hidden', 'false');
    hamburgerBtn.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
    /* Move focus into panel for keyboard users */
    var firstFocusable = mobileMenu.querySelector('button, [href]');
    if (firstFocusable) firstFocusable.focus();
  }

  function closeMobileMenu() {
    if (!mobileMenu || !hamburgerBtn) return;
    mobileMenu.classList.remove('is-open');
    mobileMenu.setAttribute('aria-hidden', 'true');
    hamburgerBtn.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
    hamburgerBtn.focus();
  }

  if (hamburgerBtn) hamburgerBtn.addEventListener('click', openMobileMenu);
  if (mobileClose)  mobileClose.addEventListener('click', closeMobileMenu);
  if (menuOverlay)  menuOverlay.addEventListener('click', closeMobileMenu);

  /* Close on any nav / sub link click */
  if (mobileMenu) {
    mobileMenu.querySelectorAll('.mobile-nav-link, .mobile-sub-link, .mobile-cta-btn, .mobile-phone-cta').forEach(function(el) {
      el.addEventListener('click', closeMobileMenu);
    });
  }

  /* Escape key closes menu */
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('is-open')) {
      closeMobileMenu();
    }
  });

  /* ── Desktop dropdown keyboard support ──────────────────────────────── */
  document.querySelectorAll('.has-dropdown > .nav-link').forEach(function(trigger) {
    trigger.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        var expanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', expanded ? 'false' : 'true');
      }
    });
    /* Reset aria-expanded on mouse interactions */
    var parent = trigger.parentElement;
    if (parent) {
      parent.addEventListener('mouseenter', function() { trigger.setAttribute('aria-expanded', 'true'); });
      parent.addEventListener('mouseleave', function() { trigger.setAttribute('aria-expanded', 'false'); });
    }
  });

  /* Re-init Lucide after any dynamic content updates (e.g. Swiper slides) */
  document.addEventListener('lucide:reinit', function() {
    if (typeof lucide !== 'undefined') lucide.createIcons();
  });

}());
</script>

</body>
</html>
