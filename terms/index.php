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

$pageTitle       = 'Terms of Service | ' . $siteName;
$pageDescription = 'Terms of Service for ' . $siteName . ' — terms governing your use of our website and services.';
$canonicalUrl    = $siteUrl . '/terms/';
$currentPage     = 'legal';

// SEO: <link rel="canonical"> + <script type="application/ld+json"> are rendered by includes/head.php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Terms of Service",
  "url": "<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>/terms/",
  "description": "<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>",
  "publisher": {
    "@type": "Organization",
    "name": "<?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?>"
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      { "@type": "ListItem", "position": 1, "name": "Home", "item": "<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>/" },
      { "@type": "ListItem", "position": 2, "name": "Terms of Service", "item": "<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>/terms/" }
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
      <h1 id="legal-hero-heading">Terms of Service</h1>
      <nav class="legal-breadcrumb" aria-label="Breadcrumb">
        <a href="/">Home</a>
        <span aria-hidden="true">/</span>
        <span aria-current="page">Terms of Service</span>
      </nav>
    </div>
  </section>

  <section class="legal-section">
    <div class="content-narrow">
      <p class="legal-updated"><strong>Last Updated:</strong> <?php echo $lastUpdated; ?></p>

      <h2>Acceptance of Terms</h2>
      <p>These Terms of Service ("Terms") constitute a legally binding agreement between you ("user," "you," or "your") and <?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?>, a <?php echo htmlspecialchars($companyEntityType, ENT_QUOTES, 'UTF-8'); ?> formed in the State of <?php echo htmlspecialchars($companyState, ENT_QUOTES, 'UTF-8'); ?> ("Company," "we," "us," or "our"), governing your access to and use of our website and services.</p>
      <p>By accessing or using our website, submitting a contact or estimate request form, or otherwise interacting with us through any digital channel, you agree to be bound by these Terms. If you do not agree to these Terms, you must not use our website or services.</p>
      <p>We reserve the right to modify these Terms at any time. Changes will be effective immediately upon posting to our website. Your continued use of our website after any modifications constitutes your acceptance of the updated Terms.</p>

      <h2>Description of Services</h2>
      <p><?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?> provides roofing services including, but not limited to, roof replacement, roof repair, storm damage repair, gutter services, and related exterior contracting work in the areas we serve.</p>
      <p>Our website is provided for informational purposes. The information on this website — including service descriptions, pricing guidance, and process information — is subject to change without notice and does not constitute a binding contract or offer. Actual scope, specifications, and pricing for any project are determined through an on-site assessment and confirmed in a written estimate or contract.</p>

      <h2>Use of This Website</h2>
      <p>You agree to use our website only for lawful purposes and in a manner that does not infringe the rights of others or restrict or inhibit anyone else's use of the website. Prohibited uses include:</p>
      <ul>
        <li>Using the website in any way that violates applicable local, state, national, or international laws or regulations</li>
        <li>Attempting to gain unauthorized access to any part of the website, server, or network connected to the website</li>
        <li>Transmitting any unsolicited or unauthorized advertising, promotional material, spam, or any other form of solicitation</li>
        <li>Scraping, crawling, or harvesting any information from the website using automated tools without our prior written consent</li>
        <li>Posting or transmitting any material that is defamatory, offensive, obscene, or otherwise objectionable</li>
        <li>Impersonating any person or entity or misrepresenting your affiliation with any person or entity</li>
        <li>Interfering with or disrupting the operation of our website or the servers and networks used to make it available</li>
      </ul>
      <p>We reserve the right to terminate or restrict your access to our website at any time without notice for any violation of these Terms.</p>

      <h2>Intellectual Property</h2>
      <p>All content on this website — including text, graphics, logos, button icons, images, audio clips, digital downloads, data compilations, and software — is the property of <?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?> or its content suppliers and is protected by United States and international copyright, trademark, and other intellectual property laws.</p>
      <p>You may access and use our website for personal, non-commercial informational purposes only. You may not reproduce, distribute, modify, create derivative works of, publicly display, publicly perform, republish, download, store, or transmit any content from our website without our prior written consent, except as follows:</p>
      <ul>
        <li>Your computer may temporarily store copies of materials in RAM as a result of your accessing and viewing those materials</li>
        <li>You may store files that are automatically cached by your web browser for display enhancement purposes</li>
        <li>You may print or download one copy of a reasonable number of pages for your own personal, non-commercial use, provided you do not further reproduce, publish, or distribute the material</li>
      </ul>

      <h2>User Submissions</h2>
      <p>When you submit information through our contact or estimate request forms, you represent and warrant that:</p>
      <ul>
        <li>All information you provide is accurate, current, and complete to the best of your knowledge</li>
        <li>You have the right to submit the information and it does not violate any third party's rights</li>
        <li>Your submission does not violate any applicable laws, regulations, or these Terms</li>
      </ul>
      <p>By submitting photos, testimonials, or other content to us, you grant <?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?> a non-exclusive, royalty-free, perpetual, irrevocable license to use, reproduce, and display such content for marketing, advertising, and promotional purposes, including on our website and social media profiles.</p>

      <h2>Estimates and Pricing</h2>
      <p>Any pricing information, cost ranges, or estimates provided on our website or through our contact forms are for informational purposes only and do not constitute a binding offer or contract. Actual project pricing is determined following an in-person assessment of your specific property and project requirements.</p>
      <p>A formal written estimate will be provided after inspection. No work will begin until you have reviewed, accepted, and signed a written project agreement or contract. We are not responsible for decisions made based on general pricing information displayed on our website.</p>

      <h2>Service Disclaimers</h2>
      <p>OUR WEBSITE AND SERVICES ARE PROVIDED ON AN "AS IS" AND "AS AVAILABLE" BASIS WITHOUT ANY WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED. TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW, WE DISCLAIM ALL WARRANTIES, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, TITLE, AND NON-INFRINGEMENT.</p>
      <p>We do not warrant that our website will be uninterrupted or error-free, that defects will be corrected, or that the website or the server that makes it available are free of viruses or other harmful components.</p>

      <h2>Limitation of Liability</h2>
      <p>TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW, IN NO EVENT SHALL <?php echo htmlspecialchars(strtoupper($companyName), ENT_QUOTES, 'UTF-8'); ?>, ITS OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, OR SUPPLIERS BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES — INCLUDING BUT NOT LIMITED TO LOSS OF PROFITS, DATA, USE, GOODWILL, OR OTHER INTANGIBLE LOSSES — ARISING OUT OF OR RELATED TO YOUR USE OF OR INABILITY TO USE OUR WEBSITE OR SERVICES.</p>
      <p>OUR TOTAL LIABILITY TO YOU FOR ALL CLAIMS ARISING FROM OR RELATED TO YOUR USE OF OUR WEBSITE OR SERVICES SHALL NOT EXCEED THE TOTAL AMOUNT YOU HAVE PAID TO US IN THE TWELVE (12) MONTHS PRECEDING THE CLAIM.</p>
      <p>Some states or jurisdictions do not allow the exclusion of certain warranties or the limitation or exclusion of liability for incidental or consequential damages. In such jurisdictions, our liability will be limited to the greatest extent permitted by applicable law.</p>

      <h2>Indemnification</h2>
      <p>You agree to defend, indemnify, and hold harmless <?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?> and its officers, directors, employees, agents, and successors from and against any and all claims, liabilities, damages, judgments, awards, losses, costs, expenses, or fees (including reasonable attorneys' fees) arising out of or relating to: (a) your violation of these Terms; (b) your use of our website or services; (c) information you submit through our website; or (d) your violation of any third-party rights.</p>

      <h2>Governing Law</h2>
      <p>These Terms and your use of our website shall be governed by and construed in accordance with the laws of the State of <?php echo htmlspecialchars($companyState, ENT_QUOTES, 'UTF-8'); ?>, without regard to its conflict of law provisions. You agree that any legal action or proceeding arising under or relating to these Terms shall be brought exclusively in the courts of the State of <?php echo htmlspecialchars($companyState, ENT_QUOTES, 'UTF-8'); ?>, and you hereby consent to the personal jurisdiction and venue therein.</p>

      <h2>Changes to These Terms</h2>
      <p>We reserve the right to revise and update these Terms of Service at any time at our sole discretion. All changes are effective immediately when we post them. Your continued use of our website following the posting of revised Terms constitutes your acceptance of those changes.</p>
      <p>We encourage you to review this page periodically so that you are aware of any changes, as they are binding on you.</p>

      <h2>Severability</h2>
      <p>If any provision of these Terms is held to be invalid, illegal, or unenforceable for any reason, that provision shall be eliminated or limited to the minimum extent necessary so that the remaining provisions of these Terms continue in full force and effect.</p>

      <h2>Entire Agreement</h2>
      <p>These Terms of Service, together with our <a href="/privacy-policy/">Privacy Policy</a> and <a href="/cookie-policy/">Cookie Policy</a>, constitute the entire agreement between you and <?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?> with respect to your use of our website and supersede all prior and contemporaneous understandings, agreements, representations, and warranties, both written and oral, regarding the subject matter.</p>

      <h2>Contact Us</h2>
      <p>If you have questions about these Terms of Service, please contact us:</p>
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
