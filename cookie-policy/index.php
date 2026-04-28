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

$pageTitle       = 'Cookie Policy | ' . $siteName;
$pageDescription = 'Cookie Policy for ' . $siteName . ' — what cookies we use and how to control them.';
$canonicalUrl    = $siteUrl . '/cookie-policy/';
$currentPage     = 'legal';

// SEO: <link rel="canonical"> + <script type="application/ld+json"> are rendered by includes/head.php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Cookie Policy",
  "url": "<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>/cookie-policy/",
  "description": "<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>",
  "publisher": {
    "@type": "Organization",
    "name": "<?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?>"
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      { "@type": "ListItem", "position": 1, "name": "Home", "item": "<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>/" },
      { "@type": "ListItem", "position": 2, "name": "Cookie Policy", "item": "<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>/cookie-policy/" }
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

.cookie-table tr:nth-child(even) td {
  background: rgba(var(--color-primary-rgb), 0.02);
}

@media (max-width: 767px) {
  .content-narrow { padding: 0 var(--space-md); }
  .legal-section { padding: var(--section-pad-mobile); }
  .cookie-table { font-size: 0.8rem; }
  .cookie-table th, .cookie-table td { padding: var(--space-xs) var(--space-sm); }
}
</style>

<section class="legal-hero" aria-labelledby="legal-hero-heading">
    <div>
      <h1 id="legal-hero-heading">Cookie Policy</h1>
      <nav class="legal-breadcrumb" aria-label="Breadcrumb">
        <a href="/">Home</a>
        <span aria-hidden="true">/</span>
        <span aria-current="page">Cookie Policy</span>
      </nav>
    </div>
  </section>

  <section class="legal-section">
    <div class="content-narrow">
      <p class="legal-updated"><strong>Last Updated:</strong> <?php echo $lastUpdated; ?></p>

      <h2>Introduction</h2>
      <p><?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?> uses cookies and similar tracking technologies on our website. This Cookie Policy explains what these technologies are, why we use them, and your rights to control their use.</p>
      <p>By using our website, you consent to the use of cookies as described in this policy. You can withdraw or adjust your consent at any time using the browser controls described below.</p>

      <h2>What Are Cookies</h2>
      <p>Cookies are small text files that are placed on your computer or mobile device by websites that you visit. They are widely used to make websites work — or work more efficiently — as well as to provide information to website owners.</p>
      <p>Cookies can be "session" cookies (deleted when you close your browser) or "persistent" cookies (stored on your device until they expire or you delete them). They can be set by the website you are visiting ("first-party cookies") or by other services operating on that page ("third-party cookies").</p>

      <h2>Strictly Necessary Cookies</h2>
      <p>These cookies are essential for our website to function correctly. They cannot be switched off without affecting the basic functionality of the website. They do not track browsing activity across other websites and do not store any personally identifiable information.</p>
      <table class="cookie-table">
        <thead>
          <tr>
            <th>Cookie Name</th>
            <th>Provider</th>
            <th>Purpose</th>
            <th>Duration</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>PHPSESSID</td>
            <td>This website</td>
            <td>PHP session identifier — maintains session state during your visit</td>
            <td>Session (deleted on browser close)</td>
          </tr>
        </tbody>
      </table>

      <h2>Analytics Cookies</h2>
      <p>We use Google Analytics 4 (GA4) to understand how visitors interact with our website. These cookies help us measure traffic, identify popular pages, and improve the user experience. The data collected is aggregated and does not personally identify you.</p>
      <table class="cookie-table">
        <thead>
          <tr>
            <th>Cookie Name</th>
            <th>Provider</th>
            <th>Purpose</th>
            <th>Duration</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>_ga</td>
            <td>Google Analytics 4</td>
            <td>Distinguishes unique users by assigning a randomly generated number as a client identifier</td>
            <td>2 years</td>
          </tr>
          <tr>
            <td>_ga_[container-id]</td>
            <td>Google Analytics 4</td>
            <td>Persists session state and tracks individual measurement container sessions</td>
            <td>2 years</td>
          </tr>
        </tbody>
      </table>
      <p>To opt out of Google Analytics tracking across all websites, you can install the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">Google Analytics Opt-out Browser Add-on</a>. You can also adjust your settings in Google's <a href="https://myaccount.google.com/data-and-privacy" target="_blank" rel="noopener noreferrer">My Account privacy controls</a>.</p>

      <h2>Functional Cookies and Third-Party Resources</h2>
      <p>Our website loads certain third-party resources that may set cookies or access your device to provide functionality such as fonts, icons, and interactive components. These services are necessary for the website to display and function as designed.</p>
      <table class="cookie-table">
        <thead>
          <tr>
            <th>Service</th>
            <th>Provider</th>
            <th>Domains</th>
            <th>Purpose</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Google Fonts</td>
            <td>Google LLC</td>
            <td>fonts.googleapis.com, fonts.gstatic.com</td>
            <td>Loads web fonts used for page typography. Google may log the request IP address. See <a href="https://developers.google.com/fonts/faq/privacy" target="_blank" rel="noopener noreferrer">Google Fonts privacy FAQ</a>.</td>
          </tr>
          <tr>
            <td>Google Maps</td>
            <td>Google LLC</td>
            <td>maps.googleapis.com, maps.gstatic.com</td>
            <td>Embeds interactive maps for displaying business location. Subject to <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">Google's Privacy Policy</a>.</td>
          </tr>
          <tr>
            <td>Lucide Icons</td>
            <td>jsDelivr / Lucide</td>
            <td>cdn.jsdelivr.net</td>
            <td>Loads the Lucide icon library for interface icons. jsDelivr may log basic request data per their <a href="https://www.jsdelivr.com/privacy-policy-jsdelivr-net" target="_blank" rel="noopener noreferrer">privacy policy</a>.</td>
          </tr>
          <tr>
            <td>Swiper Carousel</td>
            <td>jsDelivr / Swiper</td>
            <td>cdn.jsdelivr.net</td>
            <td>Loads the Swiper.js library for image carousels and testimonial sliders (if present on the page).</td>
          </tr>
        </tbody>
      </table>

      <h2>How to Control Cookies</h2>
      <p>You have the right to decide whether to accept or reject cookies. You can exercise cookie preferences through your browser settings. Most browsers allow you to:</p>
      <ul>
        <li>View cookies that have been set and delete them individually</li>
        <li>Block third-party cookies</li>
        <li>Block cookies from particular sites</li>
        <li>Block all cookies from being set</li>
        <li>Delete all cookies when you close your browser</li>
      </ul>
      <p>Instructions for managing cookies in common browsers:</p>
      <ul>
        <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener noreferrer">Google Chrome</a></li>
        <li><a href="https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer" target="_blank" rel="noopener noreferrer">Mozilla Firefox</a></li>
        <li><a href="https://support.apple.com/en-us/105082" target="_blank" rel="noopener noreferrer">Apple Safari</a></li>
        <li><a href="https://support.microsoft.com/en-us/windows/manage-cookies-in-microsoft-edge-168dab11-0753-043d-7c16-ede5947fc64d" target="_blank" rel="noopener noreferrer">Microsoft Edge</a></li>
      </ul>
      <p>Please note that blocking or deleting cookies may affect the functionality of our website and other websites you visit.</p>

      <h2>Do Not Track and Global Privacy Control</h2>
      <p>Some browsers include a "Do Not Track" (DNT) feature that signals websites you visit that you do not want your online activity tracked. Our website does not currently respond to DNT signals because there is no industry-wide standard for how websites should respond to them.</p>
      <p>We do, however, honor the <strong>Global Privacy Control (GPC)</strong> signal. If your browser transmits a GPC signal, we treat it as an opt-out of sale and sharing of your personal information, consistent with applicable state privacy laws including the California Privacy Rights Act (CPRA).</p>

      <h2>California Residents</h2>
      <p>California residents have additional rights regarding their personal information under the CCPA/CPRA. For information about your rights and how to exercise them, please see the <a href="/privacy-policy/#ccpa-rights">California Residents section of our Privacy Policy</a>.</p>

      <h2>Changes to This Cookie Policy</h2>
      <p>We may update this Cookie Policy from time to time to reflect changes in the technologies we use or applicable legal requirements. When we make material changes, we will update the "Last Updated" date at the top of this page. We encourage you to review this page periodically.</p>

      <h2>Contact Us</h2>
      <p>If you have questions about our use of cookies or this Cookie Policy, please contact us:</p>
      <ul>
        <li><strong><?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?></strong></li>
        <li>Email: <a href="mailto:<?php echo htmlspecialchars($companyEmail, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($companyEmail, ENT_QUOTES, 'UTF-8'); ?></a></li>
        <?php if (!empty($companyPhone)): ?>
        <li>Phone: <a href="tel:<?php echo telHref($companyPhone); ?>"><?php echo htmlspecialchars($companyPhone, ENT_QUOTES, 'UTF-8'); ?></a></li>
        <?php endif; ?>
        <?php if (!empty($companyAddress)): ?>
        <li>Address: <?php echo htmlspecialchars($companyAddress, ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endif; ?>
      </ul>
    </div>
  </section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
