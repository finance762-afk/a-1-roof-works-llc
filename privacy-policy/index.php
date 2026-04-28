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

$pageTitle       = 'Privacy Policy | ' . $siteName;
$pageDescription = 'Privacy Policy for ' . $siteName . ' — how we collect, use, and protect your information.';
$canonicalUrl    = $siteUrl . '/privacy-policy/';
$currentPage     = 'legal';

// SEO: <link rel="canonical"> + <script type="application/ld+json"> are rendered by includes/head.php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Privacy Policy",
  "url": "<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>/privacy-policy/",
  "description": "<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>",
  "publisher": {
    "@type": "Organization",
    "name": "<?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?>"
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      { "@type": "ListItem", "position": 1, "name": "Home", "item": "<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>/" },
      { "@type": "ListItem", "position": 2, "name": "Privacy Policy", "item": "<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>/privacy-policy/" }
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
      <h1 id="legal-hero-heading">Privacy Policy</h1>
      <nav class="legal-breadcrumb" aria-label="Breadcrumb">
        <a href="/">Home</a>
        <span aria-hidden="true">/</span>
        <span aria-current="page">Privacy Policy</span>
      </nav>
    </div>
  </section>

  <section class="legal-section">
    <div class="content-narrow">
      <p class="legal-updated"><strong>Last Updated:</strong> <?php echo $lastUpdated; ?></p>

      <h2>Introduction</h2>
      <p><?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?> (a <?php echo htmlspecialchars($companyEntityType, ENT_QUOTES, 'UTF-8'); ?> formed in the State of <?php echo htmlspecialchars($companyState, ENT_QUOTES, 'UTF-8'); ?>, referred to herein as "Company," "we," "us," or "our") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your personal information when you visit our website or contact us about our roofing services.</p>
      <p>By using our website or submitting a contact form, you acknowledge that you have read and understood this Privacy Policy. If you do not agree with its terms, please do not use our website or submit your personal information through our forms.</p>
      <p>This Policy applies to information we collect on our website, through contact forms, via telephone, and through any other electronic communications between you and our company.</p>

      <h2>Information We Collect</h2>
      <h3>Information You Provide Directly</h3>
      <p>When you fill out a contact or estimate request form on our website, we collect:</p>
      <ul>
        <li><strong>Name</strong> — your first and last name</li>
        <li><strong>Email address</strong> — for correspondence and follow-up</li>
        <li><strong>Phone number</strong> — for scheduling and direct communication</li>
        <li><strong>Service needed</strong> — the roofing service you are inquiring about</li>
        <li><strong>Message</strong> — any additional details you provide about your project</li>
        <li><strong>Communication preferences</strong> — your opt-in or opt-out choices for email and SMS marketing</li>
      </ul>

      <h3>Automatically Captured Information</h3>
      <p>When you submit a contact form, our CRM system (operated by Page One Insights LLC) automatically captures:</p>
      <ul>
        <li><strong>IP address</strong> — for fraud prevention and legal compliance</li>
        <li><strong>User agent string</strong> — browser and device type</li>
        <li><strong>Consent timestamp</strong> — exact date and time your consent was recorded</li>
        <li><strong>Page URL</strong> — the page from which you submitted the form</li>
        <li><strong>Consent version</strong> — the version of our consent language active at time of submission</li>
      </ul>
      <p>This consent record is stored for a minimum of four (4) years for TCPA compliance purposes.</p>

      <h3>Analytics Data</h3>
      <p>We use Google Analytics 4 (GA4) to understand how visitors interact with our website. GA4 collects information such as pages visited, time on site, referring URLs, device type, and general geographic location. This data is aggregated and anonymized; it is not linked to your name or contact information unless you have also submitted a contact form.</p>
      <p>Google Analytics uses cookies. You can learn more about how Google uses your data at <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">https://policies.google.com/privacy</a>.</p>

      <h2>How We Use Your Information</h2>
      <p>We use the information we collect for the following purposes:</p>
      <ul>
        <li><strong>Respond to your inquiry</strong> — to answer questions, provide estimates, and discuss your roofing project</li>
        <li><strong>Schedule appointments</strong> — to arrange roof inspections, consultations, or service calls</li>
        <li><strong>Transactional communications</strong> — appointment confirmations, project updates, and follow-up on completed work</li>
        <li><strong>Email marketing</strong> — if you have opted in, we may send periodic information about our services, promotions, and roofing tips. You may unsubscribe at any time.</li>
        <li><strong>SMS/text communications</strong> — if you have opted in, we may send text messages regarding your inquiry, appointment reminders, or service updates. Reply STOP at any time to unsubscribe.</li>
        <li><strong>Improve our website</strong> — using aggregated analytics data to understand how visitors use our site and improve the user experience</li>
        <li><strong>Legal compliance</strong> — to maintain records required by law, including consent records under the Telephone Consumer Protection Act (TCPA)</li>
      </ul>

      <h2>How We Share Your Information</h2>
      <p>We do <strong>not</strong> sell, rent, or trade your personal information to third parties for their own marketing purposes. We share your information only as described below:</p>
      <ul>
        <li><strong>Google LLC</strong> — for Google Analytics 4 (website analytics), Google Fonts (typography rendering), and Google Maps (if embedded on our site). Google's privacy policy governs their use of this data.</li>
        <li><strong>Page One Insights LLC</strong> — our web design and CRM provider, acting as a data processor on our behalf. Page One Insights uses the following sub-processors:
          <ul>
            <li><strong>Supabase Inc.</strong> — cloud database hosting for lead and consent records</li>
            <li><strong>Twilio SendGrid</strong> — transactional email delivery (lead notification emails to our team)</li>
            <li><strong>Twilio Inc.</strong> — SMS delivery infrastructure (if SMS communications are enabled)</li>
          </ul>
        </li>
        <li><strong>Hostinger International Ltd.</strong> — our website hosting provider. Hostinger may have access to server-level data (IP addresses, server logs) in the normal course of hosting operations.</li>
        <li><strong>Legal requirements</strong> — we may disclose your information if required to do so by law, court order, or governmental regulation, or if we believe disclosure is necessary to protect our rights, prevent fraud, or ensure the safety of our customers and employees.</li>
      </ul>

      <h2>Your Privacy Rights</h2>

      <h3 id="ccpa-rights">California Residents (CCPA/CPRA)</h3>
      <p>If you are a California resident, you have the following rights under the California Consumer Privacy Act (CCPA) as amended by the California Privacy Rights Act (CPRA):</p>
      <ul>
        <li><strong>Right to Know</strong> — the right to request disclosure of the categories and specific pieces of personal information we have collected about you, the sources, our business purposes for collection, and the categories of third parties with whom we share it.</li>
        <li><strong>Right to Delete</strong> — the right to request deletion of personal information we have collected from you, subject to certain exceptions (e.g., records we are legally required to retain).</li>
        <li><strong>Right to Correct</strong> — the right to request correction of inaccurate personal information we maintain about you.</li>
        <li><strong>Right to Limit Use of Sensitive Personal Information</strong> — the right to direct us to use and disclose sensitive personal information only for purposes permitted by the CPRA.</li>
        <li><strong>Right to Opt-Out of Sale or Sharing</strong> — we do not sell or share your personal information for cross-context behavioral advertising. There is nothing to opt out of at this time, but you may submit a request to confirm this.</li>
        <li><strong>Right to Non-Discrimination</strong> — we will not discriminate against you for exercising any of your CCPA/CPRA rights. We will not deny services, charge different prices, or provide a different level of service because you exercised a privacy right.</li>
        <li><strong>Authorized Agent</strong> — you may designate an authorized agent to submit a rights request on your behalf. We may require written proof of authorization and verification of the agent's identity.</li>
      </ul>
      <p>We honor browser-based Global Privacy Control (GPC) signals as an opt-out of sale and sharing of personal information.</p>
      <p>To exercise any of these rights, please contact us at <a href="mailto:<?php echo htmlspecialchars($companyEmail, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($companyEmail, ENT_QUOTES, 'UTF-8'); ?></a> or call <a href="tel:<?php echo telHref($companyPhone); ?>"><?php echo htmlspecialchars($companyPhone, ENT_QUOTES, 'UTF-8'); ?></a>. We will respond within 45 days. If additional time is needed (up to a total of 90 days), we will notify you of the extension and the reason within the initial 45-day period.</p>

      <h3>Other State Privacy Rights</h3>
      <p>Residents of the following states have similar rights to access, delete, correct, or opt out of certain processing of their personal data under their respective state privacy laws:</p>
      <ul>
        <li><strong>Virginia</strong> (Virginia Consumer Data Protection Act — VCDPA)</li>
        <li><strong>Colorado</strong> (Colorado Privacy Act — CPA)</li>
        <li><strong>Connecticut</strong> (Connecticut Data Privacy Act — CTDPA)</li>
        <li><strong>Utah</strong> (Utah Consumer Privacy Act — UCPA)</li>
        <li><strong>Texas</strong> (Texas Data Privacy and Security Act — TDPSA)</li>
        <li><strong>Florida</strong> (Florida Digital Bill of Rights — FDBR)</li>
        <li><strong>Oregon</strong> (Oregon Consumer Privacy Act — OCPA)</li>
        <li><strong>Montana</strong> (Montana Consumer Data Privacy Act — MCDPA)</li>
        <li><strong>Delaware</strong> (Delaware Personal Data Privacy Act — DPDPA)</li>
        <li><strong>Iowa</strong> (Iowa Consumer Data Protection Act — ICDPA)</li>
        <li><strong>Tennessee</strong> (Tennessee Information Protection Act — TIPA)</li>
        <li><strong>Indiana</strong> (Indiana Consumer Data Protection Act — ICDPA)</li>
        <li><strong>Kentucky</strong> (Kentucky Consumer Data Protection Act — KCDPA)</li>
        <li><strong>Rhode Island</strong> (Rhode Island Data Transparency and Privacy Protection Act — DTPPA)</li>
        <li><strong>Maryland</strong> (Maryland Online Data Privacy Act — MODPA)</li>
        <li><strong>Minnesota</strong> (Minnesota Consumer Data Privacy Act — MCDPA)</li>
        <li><strong>New Hampshire</strong> (New Hampshire Privacy Act — NHPA)</li>
        <li><strong>New Jersey</strong> (New Jersey Data Privacy Act — NJDPA)</li>
        <li><strong>Nebraska</strong> (Nebraska Data Privacy Act — NDPA)</li>
      </ul>
      <p>To exercise rights under any of these laws, please contact us using the information in the "Contact Us" section below. We will respond in accordance with the applicable law's requirements.</p>

      <h2>Data Retention</h2>
      <p>We retain personal information for the following periods:</p>
      <ul>
        <li><strong>Consent and lead records</strong> — a minimum of four (4) years from the date of collection, to satisfy the TCPA's statute of limitations for litigation purposes.</li>
        <li><strong>Active client records</strong> — for the duration of the client relationship plus four (4) years after the last transaction, for warranty, liability, and legal purposes.</li>
        <li><strong>Analytics data</strong> — retained by Google Analytics per Google's data retention settings (typically 14 months for user-level data).</li>
      </ul>
      <p>After the applicable retention period, we securely delete or anonymize personal information.</p>

      <h2>Security</h2>
      <p>We implement reasonable technical and organizational security measures to protect your personal information from unauthorized access, use, disclosure, alteration, or destruction. These measures include SSL/TLS encryption for data transmission, secure cloud hosting with access controls, and limited access to personal data on a need-to-know basis.</p>
      <p>However, no method of transmission over the internet or method of electronic storage is 100% secure. While we strive to protect your information, we cannot guarantee its absolute security. If you have reason to believe your interaction with us is no longer secure, please notify us immediately.</p>

      <h2>Children's Privacy</h2>
      <p>Our website is not directed at children under the age of 13, and we do not knowingly collect personal information from children under 13. If we become aware that we have inadvertently received personal information from a visitor under the age of 13, we will delete such information from our records. If you believe we may have collected information from a child under 13, please contact us immediately.</p>

      <h2>Third-Party Links</h2>
      <p>Our website may contain links to third-party websites, such as review platforms or social media pages. This Privacy Policy applies only to our website. We are not responsible for the privacy practices of third-party sites and encourage you to review their privacy policies before providing any personal information.</p>

      <h2>SMS Program Terms</h2>
      <p>If you have opted in to receive SMS/text messages from <?php echo htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'); ?>:</p>
      <ul>
        <li>Message types may include appointment reminders, service updates, estimate follow-ups, and occasional promotional offers.</li>
        <li>Message frequency varies based on your inquiry and communication needs.</li>
        <li>Message and data rates may apply. Check with your wireless carrier for details.</li>
        <li>To unsubscribe at any time, reply <strong>STOP</strong> to any message. You will receive a confirmation and no further messages will be sent.</li>
        <li>For assistance, reply <strong>HELP</strong> or contact us at <a href="mailto:<?php echo htmlspecialchars($companyEmail, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($companyEmail, ENT_QUOTES, 'UTF-8'); ?></a>.</li>
        <li>Wireless carriers are not liable for delayed or undelivered messages.</li>
        <li><strong>Consent to receive SMS messages is not a condition of purchasing any service from us.</strong></li>
      </ul>

      <h2>Changes to This Policy</h2>
      <p>We may update this Privacy Policy from time to time to reflect changes in our practices, applicable law, or for other operational, legal, or regulatory reasons. When we make material changes, we will update the "Last Updated" date at the top of this page. We encourage you to review this Policy periodically.</p>
      <p>Your continued use of our website after any changes to this Policy constitutes your acceptance of the updated terms.</p>

      <h2>Contact Us</h2>
      <p>If you have questions, concerns, or requests related to this Privacy Policy or your personal information, please contact us:</p>
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
