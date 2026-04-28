<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$companyName       = $siteName;
$companyEntityType = $entityType;
$companyState      = $stateOfFormation;
$companyEmail      = $contactEmail;
$companyPhone      = $contactPhone;
$companyAddress    = $businessAddress;
$lastUpdated       = 'April 24, 2026';

$pageTitle       = 'Accessibility | ' . $siteName;
$pageDescription = 'Accessibility statement for ' . $siteName . ' — our commitment to WCAG 2.1 AA compliance.';
$canonicalUrl    = $siteUrl . '/accessibility/';
$currentPage     = 'legal';

// SEO: <link rel="canonical"> + <script type="application/ld+json"> are rendered by includes/head.php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Accessibility Statement",
  "url": "<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>/accessibility/",
  "description": "<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>",
  "publisher": {
    "@type": "Organization",
    "name": "<?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?>"
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      { "@type": "ListItem", "position": 1, "name": "Home", "item": "<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>/" },
      { "@type": "ListItem", "position": 2, "name": "Accessibility", "item": "<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>/accessibility/" }
    ]
  }
}
</script>

<style>
/* ── Legal Page Styles ──────────────────────────────────────────────────── */
.legal-hero {
  min-height: 40vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
  color: #fff;
  text-align: center;
  padding: calc(var(--navbar-height) + var(--space-3xl)) var(--space-lg) var(--space-3xl);
  position: relative;
  overflow: hidden;
}

.legal-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  pointer-events: none;
}

.legal-hero::after {
  content: '';
  position: absolute;
  bottom: -1px;
  left: 0;
  right: 0;
  height: 48px;
  background: var(--color-bg);
  clip-path: ellipse(55% 100% at 50% 100%);
}

.legal-hero h1 {
  font-size: clamp(2rem, 5vw, 3rem);
  font-weight: 800;
  letter-spacing: -0.02em;
  text-wrap: balance;
  position: relative;
  z-index: 1;
}

.legal-breadcrumb {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-sm);
  margin-top: var(--space-md);
  font-size: 0.875rem;
  opacity: 0.8;
  position: relative;
  z-index: 1;
}

.legal-breadcrumb a {
  color: rgba(255,255,255,0.85);
  text-decoration: none;
  transition: color var(--transition-fast);
}

.legal-breadcrumb a:hover { color: #fff; }

.legal-breadcrumb span { color: rgba(255,255,255,0.5); }

.legal-section {
  padding: var(--section-pad);
  background: var(--color-bg);
}

.content-narrow {
  max-width: 720px;
  margin: 0 auto;
  line-height: 1.75;
  color: var(--color-text);
}

.content-narrow h2 {
  font-family: var(--font-heading);
  font-size: 1.35rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-top: var(--space-3xl);
  padding-bottom: var(--space-sm);
  border-bottom: 1px solid rgba(var(--color-primary-rgb), 0.10);
  text-wrap: balance;
}

.content-narrow h3 {
  font-family: var(--font-heading);
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-top: var(--space-2xl);
  margin-bottom: var(--space-sm);
  text-wrap: balance;
}

.content-narrow p {
  margin-bottom: var(--space-md);
  font-size: 0.975rem;
}

.content-narrow ul {
  padding-left: var(--space-xl);
  margin-bottom: var(--space-md);
}

.content-narrow li {
  margin-bottom: var(--space-xs);
  font-size: 0.975rem;
}

.content-narrow a {
  color: var(--color-primary);
  text-decoration: underline;
  text-underline-offset: 2px;
}

.content-narrow a:hover { color: var(--color-accent); }

.legal-updated {
  font-size: 0.88rem;
  color: var(--color-text-light);
  margin-bottom: var(--space-2xl);
  padding: var(--space-sm) var(--space-md);
  background: var(--color-bg-alt);
  border-left: 3px solid var(--color-accent);
  border-radius: 0 var(--radius-md) var(--radius-md) 0;
}

/* ── Accessibility Feature Cards ─────────────────────────────────────── */
.a11y-features {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: var(--space-md);
  margin: var(--space-lg) 0 var(--space-xl);
}

.a11y-feature {
  background: var(--color-bg-alt);
  border: 1px solid rgba(var(--color-primary-rgb), 0.08);
  border-radius: var(--radius-md);
  padding: var(--space-lg);
  display: flex;
  gap: var(--space-md);
  align-items: flex-start;
}

.a11y-feature-icon {
  width: 36px;
  height: 36px;
  border-radius: var(--radius-md);
  background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  color: #fff;
}

.a11y-feature-icon i {
  width: 18px;
  height: 18px;
}

.a11y-feature-content {}

.a11y-feature-title {
  font-family: var(--font-heading);
  font-size: 0.925rem;
  font-weight: 700;
  color: var(--color-primary);
  margin-bottom: var(--space-xs);
}

.a11y-feature-desc {
  font-size: 0.85rem;
  color: var(--color-text-light);
  line-height: 1.55;
  margin: 0;
}

/* ── Conformance Badge ──────────────────────────────────────────────────── */
.a11y-badge {
  display: inline-flex;
  align-items: center;
  gap: var(--space-sm);
  background: rgba(var(--color-primary-rgb), 0.06);
  border: 1px solid rgba(var(--color-primary-rgb), 0.15);
  border-radius: var(--radius-md);
  padding: var(--space-sm) var(--space-md);
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--color-primary);
  margin-bottom: var(--space-xl);
}

.a11y-badge i {
  color: var(--color-accent);
  width: 16px;
  height: 16px;
}

.cookie-table {
  width: 100%;
  border-collapse: collapse;
  margin: var(--space-md) 0 var(--space-xl);
  font-size: 0.875rem;
}

.cookie-table th,
.cookie-table td {
  padding: var(--space-sm) var(--space-md);
  border: 1px solid rgba(var(--color-primary-rgb), 0.10);
  text-align: left;
  vertical-align: top;
}

.cookie-table th {
  background: var(--color-bg-alt);
  font-weight: 700;
  color: var(--color-primary);
}

@media (max-width: 767px) {
  .content-narrow { padding: 0 var(--space-md); }
  .legal-section { padding: var(--section-pad-mobile); }
  .a11y-features { grid-template-columns: 1fr; }
}
</style>

<section class="legal-hero" aria-labelledby="legal-hero-heading">
    <div>
      <h1 id="legal-hero-heading">Accessibility Statement</h1>
      <nav class="legal-breadcrumb" aria-label="Breadcrumb">
        <a href="/">Home</a>
        <span aria-hidden="true">/</span>
        <span aria-current="page">Accessibility</span>
      </nav>
    </div>
  </section>

  <section class="legal-section">
    <div class="content-narrow">
      <p class="legal-updated"><strong>Last Updated:</strong> <?php echo $lastUpdated; ?></p>

      <h2>Our Commitment</h2>
      <div class="a11y-badge" aria-label="WCAG 2.1 Level AA conformance target">
        <i data-lucide="shield-check"></i>
        WCAG 2.1 Level AA — Conformance Target
      </div>
      <p><?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?> is committed to ensuring our website is accessible to all users, including people with disabilities. We work to conform to the Web Content Accessibility Guidelines (WCAG) 2.1 at Level AA and strive for continual improvement of our website's accessibility.</p>
      <p>We believe that every person deserves equal access to information about our roofing services, regardless of disability or the assistive technology they use. This statement describes the measures we have taken and our ongoing commitment to digital accessibility.</p>

      <h2>Accessibility Features</h2>
      <p>We have implemented the following accessibility features throughout our website:</p>
      <div class="a11y-features">
        <div class="a11y-feature">
          <div class="a11y-feature-icon" aria-hidden="true">
            <i data-lucide="code-2"></i>
          </div>
          <div class="a11y-feature-content">
            <p class="a11y-feature-title">Semantic HTML5 Structure</p>
            <p class="a11y-feature-desc">Proper use of heading hierarchy (H1–H6), landmark regions, lists, and other semantic elements that convey structure to assistive technologies.</p>
          </div>
        </div>
        <div class="a11y-feature">
          <div class="a11y-feature-icon" aria-hidden="true">
            <i data-lucide="skip-forward"></i>
          </div>
          <div class="a11y-feature-content">
            <p class="a11y-feature-title">Skip-to-Content Link</p>
            <p class="a11y-feature-desc">A visually hidden "Skip to main content" link appears as the first focusable element, allowing keyboard users to bypass repeated navigation.</p>
          </div>
        </div>
        <div class="a11y-feature">
          <div class="a11y-feature-icon" aria-hidden="true">
            <i data-lucide="accessibility"></i>
          </div>
          <div class="a11y-feature-content">
            <p class="a11y-feature-title">ARIA Labels and Landmarks</p>
            <p class="a11y-feature-desc">Descriptive ARIA labels on navigation regions, interactive controls, and form elements. Landmark roles (<code>main</code>, <code>nav</code>, <code>footer</code>) defined throughout.</p>
          </div>
        </div>
        <div class="a11y-feature">
          <div class="a11y-feature-icon" aria-hidden="true">
            <i data-lucide="keyboard"></i>
          </div>
          <div class="a11y-feature-content">
            <p class="a11y-feature-title">Full Keyboard Navigation</p>
            <p class="a11y-feature-desc">All interactive elements — navigation links, buttons, form fields, and CTAs — are fully operable using only a keyboard. Tab order follows a logical reading sequence.</p>
          </div>
        </div>
        <div class="a11y-feature">
          <div class="a11y-feature-icon" aria-hidden="true">
            <i data-lucide="focus"></i>
          </div>
          <div class="a11y-feature-content">
            <p class="a11y-feature-title">Visible Focus Indicators</p>
            <p class="a11y-feature-desc">All interactive elements display a clear, visible focus outline (2px solid accent color with 2px offset) when navigated via keyboard or tab, meeting WCAG 2.4.11 (Focus Appearance).</p>
          </div>
        </div>
        <div class="a11y-feature">
          <div class="a11y-feature-icon" aria-hidden="true">
            <i data-lucide="contrast"></i>
          </div>
          <div class="a11y-feature-content">
            <p class="a11y-feature-title">WCAG AA Color Contrast</p>
            <p class="a11y-feature-desc">Body text meets a minimum 4.5:1 contrast ratio against its background. Large text (18pt+ or 14pt bold) meets a minimum 3:1 ratio. All brand color combinations have been verified.</p>
          </div>
        </div>
        <div class="a11y-feature">
          <div class="a11y-feature-icon" aria-hidden="true">
            <i data-lucide="image"></i>
          </div>
          <div class="a11y-feature-content">
            <p class="a11y-feature-title">Descriptive Alt Text</p>
            <p class="a11y-feature-desc">All informational images include descriptive alt attributes that convey the content and context of the image to screen reader users. Decorative images use empty alt attributes.</p>
          </div>
        </div>
        <div class="a11y-feature">
          <div class="a11y-feature-icon" aria-hidden="true">
            <i data-lucide="zoom-in"></i>
          </div>
          <div class="a11y-feature-content">
            <p class="a11y-feature-title">Responsive Zoom Support</p>
            <p class="a11y-feature-desc">Content remains readable and fully functional when text is zoomed up to 200% in browser settings. No horizontal scrolling is required at standard viewport widths when zoomed.</p>
          </div>
        </div>
        <div class="a11y-feature">
          <div class="a11y-feature-icon" aria-hidden="true">
            <i data-lucide="activity"></i>
          </div>
          <div class="a11y-feature-content">
            <p class="a11y-feature-title">Reduced Motion Support</p>
            <p class="a11y-feature-desc">All animations and transitions respect the <code>prefers-reduced-motion</code> media query. Users who have configured their OS to minimize motion will experience reduced or disabled animations.</p>
          </div>
        </div>
        <div class="a11y-feature">
          <div class="a11y-feature-icon" aria-hidden="true">
            <i data-lucide="form-input"></i>
          </div>
          <div class="a11y-feature-content">
            <p class="a11y-feature-title">Labeled Form Inputs</p>
            <p class="a11y-feature-desc">All form inputs are programmatically associated with their visible labels. Floating label animations do not remove the label from the accessibility tree. Required fields are clearly indicated.</p>
          </div>
        </div>
      </div>
      <ul>
        <li>Error messages are programmatically linked to their respective form fields via <code>aria-describedby</code> so screen readers announce errors in context</li>
        <li>Mobile navigation toggle uses <code>aria-expanded</code> to communicate open/closed state to assistive technologies</li>
        <li>Active navigation links use <code>aria-current="page"</code> to indicate the current page location</li>
        <li>Phone numbers are wrapped in <code>&lt;a href="tel:"&gt;</code> links for easy access on mobile and via assistive technologies</li>
        <li>All external links include <code>rel="noopener noreferrer"</code> and are identifiable by context</li>
      </ul>

      <h2>Known Limitations</h2>
      <p>While we strive for full WCAG 2.1 AA conformance, the following limitations currently exist:</p>
      <ul>
        <li><strong>Third-party embedded content</strong> — Google Maps embeds and social media widgets are controlled by third-party providers and may not fully conform to WCAG 2.1 AA. We are actively working with these providers and providing alternative contact methods for users who cannot access embedded maps.</li>
        <li><strong>Older PDF documents</strong> — any PDF documents linked from our website may not be fully accessible. If you need an accessible version of any document, please contact us and we will provide the information in an accessible format.</li>
        <li><strong>CDN-loaded libraries</strong> — some third-party JavaScript libraries (carousel components, icon sets) may have accessibility gaps we are working to address in future updates.</li>
      </ul>
      <p>We are actively working to resolve these limitations and improve the overall accessibility of our website.</p>

      <h2>Feedback and Contact</h2>
      <p>We welcome your feedback on the accessibility of our website. If you encounter any barriers, have difficulty accessing content, or need information in an alternative format, please contact us:</p>
      <ul>
        <li>Email: <a href="mailto:<?php echo htmlspecialchars($companyEmail, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($companyEmail, ENT_QUOTES, 'UTF-8'); ?></a></li>
        <?php if (!empty($companyPhone)): ?>
        <li>Phone: <a href="tel:<?php echo telHref($companyPhone); ?>"><?php echo htmlspecialchars($companyPhone, ENT_QUOTES, 'UTF-8'); ?></a></li>
        <?php endif; ?>
        <?php if (!empty($companyAddress)): ?>
        <li>Address: <?php echo htmlspecialchars($companyAddress, ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endif; ?>
      </ul>
      <p>We aim to respond to accessibility feedback within <strong>5 business days</strong>. We will work with you to provide the information you need in an accessible format or address the barrier you have identified.</p>

      <h2>Formal Complaints and Enforcement</h2>
      <p>Our website is designed to comply with the Americans with Disabilities Act (ADA) Title III, Section 508 of the Rehabilitation Act, and applicable state accessibility laws.</p>
      <p>If you are not satisfied with our response to your accessibility concern, you may pursue formal resolution through the following channels:</p>
      <ul>
        <li><strong>U.S. Department of Justice ADA Information Line</strong> — 1-800-514-0301 (voice) / 1-800-514-0383 (TTY)</li>
        <li><strong>U.S. Access Board</strong> — <a href="https://www.access-board.gov" target="_blank" rel="noopener noreferrer">www.access-board.gov</a></li>
        <li><strong>Office for Civil Rights (OCR)</strong> — for complaints related to websites receiving federal funding</li>
      </ul>
      <p>We are committed to working constructively with anyone who encounters an accessibility barrier on our website and to resolving concerns without the need for formal action.</p>
    </div>
  </section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
