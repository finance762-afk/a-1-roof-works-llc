# Legal & Compliance Reference — Page One Insights Client Websites

> **Last Updated:** April 24, 2026
>
> This document contains all legal page templates, consent markup, footer legal row, visual standards, audit checklists, and retrofit instructions for enforcing TCPA 2025/2026, CCPA/CPRA, multi-state privacy, ADA WCAG 2.1 AA, CAN-SPAM, and FCC opt-out compliance on every client website.

---

## Section 1: Required PHP Variable Block

Every legal page starts with a variable block that pulls from `includes/config.php`:

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

// Legal page variables (pulled from config.php)
$companyName       = $siteName;
$companyEntityType = $entityType;           // "Limited Liability Company", "Corporation", etc.
$companyState      = $stateOfFormation;     // "Texas", "California", etc.
$companyEmail      = $contactEmail;
$companyPhone      = $contactPhone;
$companyAddress    = $businessAddress;
$lastUpdated       = 'April 24, 2026';      // MUST be manually updated when templates change

$pageTitle       = 'Privacy Policy | ' . $siteName;
$pageDescription = 'Privacy Policy for ' . $siteName . ' — how we collect, use, and protect your information.';
$canonicalUrl    = $siteUrl . '/privacy-policy/';
$currentPage     = 'legal';
?>
```

Adjust `$pageTitle`, `$pageDescription`, and `$canonicalUrl` per page (Terms, Cookie Policy, Accessibility).

---

## Section 2: File Structure Pattern

All legal pages use subdirectory/index.php pattern to avoid Hostinger 403 errors:

- `/privacy-policy/index.php`
- `/terms/index.php`
- `/cookie-policy/index.php`
- `/accessibility/index.php`

**Never** flat files like `/privacy.php`. Always use `$_SERVER['DOCUMENT_ROOT']` for includes.

---

## Section 3: Privacy Policy Template

```php
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

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<!-- Schema: WebPage + BreadcrumbList -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Privacy Policy",
  "url": "<?php echo $siteUrl; ?>/privacy-policy/",
  "description": "<?php echo htmlspecialchars($pageDescription); ?>",
  "publisher": {
    "@type": "Organization",
    "name": "<?php echo htmlspecialchars($companyName); ?>"
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      { "@type": "ListItem", "position": 1, "name": "Home", "item": "<?php echo $siteUrl; ?>/" },
      { "@type": "ListItem", "position": 2, "name": "Privacy Policy", "item": "<?php echo $siteUrl; ?>/privacy-policy/" }
    ]
  }
}
</script>

<section class="legal-hero">
  <div class="container">
    <h1>Privacy Policy</h1>
  </div>
</section>

<section class="legal-content">
  <div class="content-narrow">
    <p class="legal-updated"><strong>Last Updated:</strong> <?php echo $lastUpdated; ?></p>

    <h2>Introduction</h2>
    <p><?php echo htmlspecialchars($companyName); ?> ("Company," "we," "us," or "our"), a <?php echo htmlspecialchars($companyEntityType); ?> formed in the State of <?php echo htmlspecialchars($companyState); ?>, operates this website. This Privacy Policy describes how we collect, use, disclose, and protect your personal information when you visit our website or submit information through our contact forms.</p>
    <p>By using our website, you agree to the collection and use of information in accordance with this policy. If you do not agree, please do not use our website.</p>

    <h2>Information We Collect</h2>
    <h3>Information You Provide</h3>
    <p>When you submit a contact form or request a quote, we collect:</p>
    <ul>
      <li>Full name</li>
      <li>Email address</li>
      <li>Phone number</li>
      <li>Service requested</li>
      <li>Message or project details</li>
    </ul>
    <p>We also automatically capture the following when you submit a form:</p>
    <ul>
      <li>IP address</li>
      <li>Browser user agent</li>
      <li>Consent timestamp</li>
      <li>Page URL where the form was submitted</li>
      <li>Consent version identifier</li>
    </ul>

    <h3>Information Collected Automatically</h3>
    <p>We use Google Analytics 4 to collect anonymized usage data, including:</p>
    <ul>
      <li>Pages visited and time on site</li>
      <li>Device type, browser, and operating system</li>
      <li>Referring website</li>
      <li>General geographic location (city/region level)</li>
    </ul>

    <h2>How We Use Your Information</h2>
    <ul>
      <li>Respond to your inquiries and requests for service</li>
      <li>Schedule appointments and provide estimates</li>
      <li>Send transactional communications related to your inquiry</li>
      <li>With your explicit consent, send marketing communications via email</li>
      <li>With your explicit consent, send SMS/text messages about services, appointments, and promotions</li>
      <li>Improve our website and services</li>
      <li>Comply with legal obligations</li>
    </ul>

    <h2>How We Share Your Information</h2>
    <p>We do not sell your personal information. We may share your information with the following categories of service providers who assist in operating our business:</p>

    <h3>Google LLC</h3>
    <p>We use Google Analytics (website analytics), Google Fonts (typography), and Google Maps (embedded maps) on this website. Google may collect cookies and usage data as described in their <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Privacy Policy</a>.</p>

    <h3>Page One Insights LLC</h3>
    <p>Our website and lead management services are provided by Page One Insights LLC, a web design and digital marketing company based in Greenville, SC. Page One Insights handles form submissions, CRM (customer relationship management), and communications infrastructure on our behalf. Their sub-processors include:</p>
    <ul>
      <li><strong>Supabase Inc.</strong> — data hosting and database services</li>
      <li><strong>Twilio SendGrid</strong> — email delivery for lead notifications</li>
      <li><strong>Twilio Inc.</strong> — SMS/text message delivery (only if you opt in to SMS communications)</li>
    </ul>

    <h3>Hosting Provider</h3>
    <p>Our website is hosted by Hostinger International Ltd., which provides web hosting infrastructure.</p>

    <h3>Legal Requirements</h3>
    <p>We may disclose your information if required by law, court order, or governmental regulation, or if disclosure is necessary to protect our rights, property, or safety.</p>

    <h2>Your Privacy Rights</h2>

    <h3 id="ccpa-rights">California Residents (CCPA/CPRA)</h3>
    <p>If you are a California resident, you have the following rights under the California Consumer Privacy Act (CCPA) as amended by the California Privacy Rights Act (CPRA):</p>
    <ul>
      <li><strong>Right to Know:</strong> You may request that we disclose the categories and specific pieces of personal information we have collected about you.</li>
      <li><strong>Right to Delete:</strong> You may request that we delete personal information we have collected from you, subject to certain exceptions.</li>
      <li><strong>Right to Correct:</strong> You may request that we correct inaccurate personal information we maintain about you.</li>
      <li><strong>Right to Limit Use of Sensitive Personal Information:</strong> You may limit the use and disclosure of your sensitive personal information.</li>
      <li><strong>Right to Opt-Out of Sale/Sharing:</strong> We do not sell or share your personal information for cross-context behavioral advertising. However, you may still exercise this right by contacting us.</li>
      <li><strong>Right to Non-Discrimination:</strong> We will not discriminate against you for exercising your privacy rights.</li>
      <li><strong>Authorized Agent:</strong> You may designate an authorized agent to make a request on your behalf.</li>
    </ul>
    <p>We honor Global Privacy Control (GPC) signals as a valid opt-out request.</p>
    <p>To exercise these rights, contact us at <a href="mailto:<?php echo htmlspecialchars($companyEmail); ?>"><?php echo htmlspecialchars($companyEmail); ?></a> or call <a href="tel:<?php echo htmlspecialchars($companyPhone); ?>"><?php echo htmlspecialchars($companyPhone); ?></a>. We will respond within 45 days.</p>

    <h3>Other State Privacy Rights</h3>
    <p>Residents of the following states have similar privacy rights under their respective state laws. While specific rights vary by state, they generally include the right to access, correct, delete, and opt out of certain data processing activities:</p>
    <ul>
      <li><strong>Virginia</strong> — Virginia Consumer Data Protection Act (VCDPA)</li>
      <li><strong>Colorado</strong> — Colorado Privacy Act (CPA)</li>
      <li><strong>Connecticut</strong> — Connecticut Data Privacy Act (CTDPA)</li>
      <li><strong>Utah</strong> — Utah Consumer Privacy Act (UCPA)</li>
      <li><strong>Texas</strong> — Texas Data Privacy and Security Act (TDPSA)</li>
      <li><strong>Florida</strong> — Florida Digital Bill of Rights (FDBR)</li>
      <li><strong>Oregon</strong> — Oregon Consumer Privacy Act (OCPA)</li>
      <li><strong>Montana</strong> — Montana Consumer Data Privacy Act (MCDPA)</li>
      <li><strong>Delaware</strong> — Delaware Personal Data Privacy Act (DPDPA)</li>
      <li><strong>Iowa</strong> — Iowa Consumer Data Protection Act (ICDPA)</li>
      <li><strong>Tennessee</strong> — Tennessee Information Protection Act (TIPA)</li>
      <li><strong>Indiana</strong> — Indiana Consumer Data Protection Act (ICDPA)</li>
      <li><strong>Kentucky</strong> — Kentucky Consumer Data Protection Act (KCDPA)</li>
      <li><strong>Rhode Island</strong> — Rhode Island Data Transparency and Privacy Protection Act (DTPPA)</li>
      <li><strong>Maryland</strong> — Maryland Online Data Privacy Act (MODPA)</li>
      <li><strong>Minnesota</strong> — Minnesota Consumer Data Privacy Act (MCDPA)</li>
      <li><strong>New Hampshire</strong> — New Hampshire Privacy Act (NHPA)</li>
      <li><strong>New Jersey</strong> — New Jersey Data Privacy Act (NJDPA)</li>
      <li><strong>Nebraska</strong> — Nebraska Data Privacy Act (NDPA)</li>
    </ul>
    <p>To exercise your rights under any state privacy law, contact us using the information in the "Contact Us" section below. We will respond within the timeframe required by your state's law.</p>

    <h2>Data Retention</h2>
    <p>We retain lead data and consent records for four (4) years from the date of collection, consistent with the statute of limitations for TCPA claims. After this period, data is purged unless an active client relationship exists. Active client data is retained for the duration of the relationship plus four years.</p>

    <h2>Security</h2>
    <p>We implement reasonable technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. These include encrypted data transmission (SSL/TLS), secure database hosting, and access controls. However, no method of electronic transmission or storage is 100% secure, and we cannot guarantee absolute security.</p>

    <h2>Children's Privacy</h2>
    <p>Our website and services are not directed to children under the age of 13. We do not knowingly collect personal information from children under 13. If you believe we have inadvertently collected such information, please contact us immediately and we will take steps to delete it.</p>

    <h2>Third-Party Links</h2>
    <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of those sites. We encourage you to review the privacy policies of any third-party sites you visit.</p>

    <h2>SMS Program Terms</h2>
    <p>If you opt in to receive SMS/text messages from <?php echo htmlspecialchars($companyName); ?>:</p>
    <ul>
      <li><strong>Message frequency:</strong> Varies. You may receive appointment reminders, service updates, and promotional offers.</li>
      <li><strong>Message and data rates may apply.</strong> Check with your carrier for details.</li>
      <li><strong>Opt-out:</strong> Text <strong>STOP</strong> to cancel at any time. You may also opt out by emailing <a href="mailto:<?php echo htmlspecialchars($companyEmail); ?>"><?php echo htmlspecialchars($companyEmail); ?></a>, calling <a href="tel:<?php echo htmlspecialchars($companyPhone); ?>"><?php echo htmlspecialchars($companyPhone); ?></a>, or any other reasonable method. We will honor all reasonable opt-out requests.</li>
      <li><strong>Help:</strong> Text <strong>HELP</strong> for help, or contact us at the email or phone number above.</li>
      <li><strong>Carriers:</strong> Carriers are not liable for delayed or undelivered messages.</li>
      <li><strong>Consent is not a condition of purchase.</strong> You are not required to opt in to SMS to use our services or receive a quote.</li>
    </ul>

    <h2>Changes to This Privacy Policy</h2>
    <p>We may update this Privacy Policy from time to time. Changes will be posted on this page with an updated "Last Updated" date. Your continued use of our website after changes constitutes acceptance of the revised policy.</p>

    <h2>Contact Us</h2>
    <p>If you have questions about this Privacy Policy or wish to exercise your privacy rights, contact us:</p>
    <ul>
      <li><strong><?php echo htmlspecialchars($companyName); ?></strong></li>
      <li>Email: <a href="mailto:<?php echo htmlspecialchars($companyEmail); ?>"><?php echo htmlspecialchars($companyEmail); ?></a></li>
      <li>Phone: <a href="tel:<?php echo htmlspecialchars($companyPhone); ?>"><?php echo htmlspecialchars($companyPhone); ?></a></li>
      <li>Address: <?php echo htmlspecialchars($companyAddress); ?></li>
    </ul>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
```

---

## Section 4: Terms of Service Template

```php
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

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Terms of Service",
  "url": "<?php echo $siteUrl; ?>/terms/",
  "description": "<?php echo htmlspecialchars($pageDescription); ?>",
  "publisher": {
    "@type": "Organization",
    "name": "<?php echo htmlspecialchars($companyName); ?>"
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      { "@type": "ListItem", "position": 1, "name": "Home", "item": "<?php echo $siteUrl; ?>/" },
      { "@type": "ListItem", "position": 2, "name": "Terms of Service", "item": "<?php echo $siteUrl; ?>/terms/" }
    ]
  }
}
</script>

<section class="legal-hero">
  <div class="container">
    <h1>Terms of Service</h1>
  </div>
</section>

<section class="legal-content">
  <div class="content-narrow">
    <p class="legal-updated"><strong>Last Updated:</strong> <?php echo $lastUpdated; ?></p>

    <h2>Acceptance of Terms</h2>
    <p>These Terms of Service ("Terms") constitute a legally binding agreement between you ("you" or "user") and <?php echo htmlspecialchars($companyName); ?>, a <?php echo htmlspecialchars($companyEntityType); ?> formed in the State of <?php echo htmlspecialchars($companyState); ?> ("Company," "we," "us," or "our"). By accessing or using our website, you agree to be bound by these Terms. If you do not agree, do not use our website.</p>

    <h2>Description of Services</h2>
    <p><?php echo htmlspecialchars($companyName); ?> provides professional services as described on this website. The specific services available, service areas, and pricing are subject to change without notice. Descriptions of services on this website are for informational purposes and do not constitute a binding offer.</p>

    <h2>Use of This Website</h2>
    <p>You agree to use this website only for lawful purposes. You may not:</p>
    <ul>
      <li>Use the website in any way that violates applicable federal, state, or local laws</li>
      <li>Attempt to gain unauthorized access to any portion of the website or its systems</li>
      <li>Use automated tools to scrape, crawl, or extract data from the website without written permission</li>
      <li>Transmit any material that is defamatory, obscene, threatening, or that constitutes harassment</li>
      <li>Interfere with or disrupt the website's infrastructure or other users' access</li>
    </ul>

    <h2>Intellectual Property</h2>
    <p>All content on this website — including text, graphics, logos, images, photographs, and software — is the property of <?php echo htmlspecialchars($companyName); ?> or its content suppliers and is protected by United States and international copyright, trademark, and other intellectual property laws. You may not reproduce, distribute, modify, or create derivative works from any content without our prior written consent.</p>

    <h2>User Submissions</h2>
    <p>When you submit information through our contact forms, request-a-quote forms, or review platforms, you represent that:</p>
    <ul>
      <li>The information you provide is accurate and complete</li>
      <li>You have the right to submit the information</li>
      <li>Your submission does not violate any third-party rights</li>
    </ul>
    <p>By submitting content, you grant <?php echo htmlspecialchars($companyName); ?> a non-exclusive, royalty-free, perpetual license to use, display, and reproduce such content in connection with our business operations, including marketing and testimonials.</p>

    <h2>Estimates and Pricing</h2>
    <p>Any estimates, quotes, or pricing information provided through this website or in response to inquiries are for informational purposes only and do not constitute binding offers. Final pricing is determined after a site assessment, inspection, or detailed consultation and may differ from initial estimates based on actual conditions, scope of work, materials required, and other factors.</p>

    <h2>Service Disclaimers</h2>
    <p>This website and all services are provided on an "AS IS" and "AS AVAILABLE" basis without warranties of any kind, either express or implied, including but not limited to implied warranties of merchantability, fitness for a particular purpose, and non-infringement. We do not warrant that the website will be uninterrupted, error-free, or free of viruses or other harmful components.</p>

    <h2>Limitation of Liability</h2>
    <p>To the fullest extent permitted by applicable law, <?php echo htmlspecialchars($companyName); ?> shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including but not limited to loss of profits, data, or use, arising out of or in connection with your use of this website or our services. Our total liability for any claim arising out of or relating to these Terms or our services shall not exceed the total amount you have paid to us in the twelve (12) months preceding the claim. Some states do not allow the exclusion or limitation of certain damages, so the above limitations may not apply to you.</p>

    <h2>Indemnification</h2>
    <p>You agree to indemnify, defend, and hold harmless <?php echo htmlspecialchars($companyName); ?>, its officers, directors, employees, agents, and affiliates from and against any claims, liabilities, damages, judgments, awards, losses, costs, or expenses (including reasonable attorneys' fees) arising out of or relating to your violation of these Terms or your use of the website.</p>

    <h2>Governing Law</h2>
    <p>These Terms are governed by the laws of the State of <?php echo htmlspecialchars($companyState); ?>, without regard to conflict of laws principles. Any dispute arising out of or relating to these Terms shall be resolved in the state or federal courts located in <?php echo htmlspecialchars($companyState); ?>.</p>

    <h2>Changes to These Terms</h2>
    <p>We reserve the right to update or modify these Terms at any time. Changes will be posted on this page with an updated "Last Updated" date. Your continued use of the website after changes constitutes acceptance of the revised Terms.</p>

    <h2>Severability</h2>
    <p>If any provision of these Terms is held to be invalid or unenforceable, the remaining provisions shall continue in full force and effect.</p>

    <h2>Entire Agreement</h2>
    <p>These Terms, together with our Privacy Policy and Cookie Policy, constitute the entire agreement between you and <?php echo htmlspecialchars($companyName); ?> regarding your use of this website.</p>

    <h2>Contact Us</h2>
    <p>If you have questions about these Terms of Service, contact us:</p>
    <ul>
      <li><strong><?php echo htmlspecialchars($companyName); ?></strong></li>
      <li>Email: <a href="mailto:<?php echo htmlspecialchars($companyEmail); ?>"><?php echo htmlspecialchars($companyEmail); ?></a></li>
      <li>Phone: <a href="tel:<?php echo htmlspecialchars($companyPhone); ?>"><?php echo htmlspecialchars($companyPhone); ?></a></li>
      <li>Address: <?php echo htmlspecialchars($companyAddress); ?></li>
    </ul>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
```

---

## Section 5: Cookie Policy Template

```php
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

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Cookie Policy",
  "url": "<?php echo $siteUrl; ?>/cookie-policy/",
  "description": "<?php echo htmlspecialchars($pageDescription); ?>",
  "publisher": {
    "@type": "Organization",
    "name": "<?php echo htmlspecialchars($companyName); ?>"
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      { "@type": "ListItem", "position": 1, "name": "Home", "item": "<?php echo $siteUrl; ?>/" },
      { "@type": "ListItem", "position": 2, "name": "Cookie Policy", "item": "<?php echo $siteUrl; ?>/cookie-policy/" }
    ]
  }
}
</script>

<section class="legal-hero">
  <div class="container">
    <h1>Cookie Policy</h1>
  </div>
</section>

<section class="legal-content">
  <div class="content-narrow">
    <p class="legal-updated"><strong>Last Updated:</strong> <?php echo $lastUpdated; ?></p>

    <p><?php echo htmlspecialchars($companyName); ?> ("we," "us," or "our") uses cookies and similar technologies on our website. This Cookie Policy explains what cookies are, what cookies we use, and how you can control them.</p>

    <h2>What Are Cookies</h2>
    <p>Cookies are small text files stored on your device when you visit a website. They help websites remember your preferences and understand how you interact with the site.</p>

    <h2>Strictly Necessary Cookies</h2>
    <p>These cookies are essential for the website to function and cannot be disabled.</p>
    <table class="cookie-table">
      <thead>
        <tr><th>Cookie</th><th>Provider</th><th>Purpose</th><th>Duration</th></tr>
      </thead>
      <tbody>
        <tr><td>PHPSESSID</td><td>This website</td><td>PHP session management</td><td>Session</td></tr>
      </tbody>
    </table>

    <h2>Analytics Cookies</h2>
    <p>These cookies help us understand how visitors interact with our website by collecting anonymous usage data.</p>
    <table class="cookie-table">
      <thead>
        <tr><th>Cookie</th><th>Provider</th><th>Purpose</th><th>Duration</th></tr>
      </thead>
      <tbody>
        <tr><td>_ga</td><td>Google Analytics 4</td><td>Distinguishes unique users</td><td>2 years</td></tr>
        <tr><td>_ga_&lt;container-id&gt;</td><td>Google Analytics 4</td><td>Maintains session state</td><td>2 years</td></tr>
      </tbody>
    </table>
    <p>You can opt out of Google Analytics by installing the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">Google Analytics Opt-out Browser Add-on</a>.</p>

    <h2>Functional Cookies &amp; Third-Party Resources</h2>
    <p>The following third-party resources may set cookies or collect data to provide functionality on our website:</p>
    <table class="cookie-table">
      <thead>
        <tr><th>Resource</th><th>Provider</th><th>Purpose</th></tr>
      </thead>
      <tbody>
        <tr><td>Google Fonts (fonts.googleapis.com, fonts.gstatic.com)</td><td>Google LLC</td><td>Typography — loads web fonts for consistent display</td></tr>
        <tr><td>Google Maps (maps.googleapis.com)</td><td>Google LLC</td><td>Embedded map for location display (if applicable)</td></tr>
        <tr><td>Lucide Icons CDN (cdn.jsdelivr.net/npm/lucide)</td><td>jsDelivr / Lucide</td><td>Iconography — loads SVG icons</td></tr>
        <tr><td>Swiper CDN (cdn.jsdelivr.net/npm/swiper)</td><td>jsDelivr / Swiper</td><td>UI functionality — carousel/slider component (if applicable)</td></tr>
      </tbody>
    </table>

    <h2>How to Control Cookies</h2>
    <p>You can control and delete cookies through your browser settings. Most browsers allow you to:</p>
    <ul>
      <li>View what cookies are stored and delete them individually</li>
      <li>Block third-party cookies</li>
      <li>Block cookies from specific sites</li>
      <li>Block all cookies</li>
      <li>Delete all cookies when you close your browser</li>
    </ul>
    <p>Please note that blocking certain cookies may affect the functionality of our website.</p>

    <h2>Do Not Track / Global Privacy Control</h2>
    <p>We honor the Global Privacy Control (GPC) signal. When we detect a GPC signal from your browser, we treat it as a valid opt-out request for the sale or sharing of your personal information.</p>

    <h3 id="ccpa-cookie-rights">California Residents</h3>
    <p>For more information about your privacy rights under the CCPA/CPRA, including your right to opt out of the sale or sharing of personal information, please see our <a href="/privacy-policy/#ccpa-rights">Privacy Policy — California Residents section</a>.</p>

    <h2>Changes to This Cookie Policy</h2>
    <p>We may update this Cookie Policy from time to time. Changes will be posted on this page with an updated "Last Updated" date.</p>

    <h2>Contact Us</h2>
    <p>If you have questions about our use of cookies, contact us:</p>
    <ul>
      <li><strong><?php echo htmlspecialchars($companyName); ?></strong></li>
      <li>Email: <a href="mailto:<?php echo htmlspecialchars($companyEmail); ?>"><?php echo htmlspecialchars($companyEmail); ?></a></li>
      <li>Phone: <a href="tel:<?php echo htmlspecialchars($companyPhone); ?>"><?php echo htmlspecialchars($companyPhone); ?></a></li>
    </ul>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
```

---

## Section 6: Accessibility Statement Template

```php
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

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Accessibility Statement",
  "url": "<?php echo $siteUrl; ?>/accessibility/",
  "description": "<?php echo htmlspecialchars($pageDescription); ?>",
  "publisher": {
    "@type": "Organization",
    "name": "<?php echo htmlspecialchars($companyName); ?>"
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      { "@type": "ListItem", "position": 1, "name": "Home", "item": "<?php echo $siteUrl; ?>/" },
      { "@type": "ListItem", "position": 2, "name": "Accessibility", "item": "<?php echo $siteUrl; ?>/accessibility/" }
    ]
  }
}
</script>

<section class="legal-hero">
  <div class="container">
    <h1>Accessibility Statement</h1>
  </div>
</section>

<section class="legal-content">
  <div class="content-narrow">
    <p class="legal-updated"><strong>Last Updated:</strong> <?php echo $lastUpdated; ?></p>

    <h2>Our Commitment</h2>
    <p><?php echo htmlspecialchars($companyName); ?> is committed to ensuring digital accessibility for people with disabilities. We continually work to improve the user experience of our website and aim to conform to the Web Content Accessibility Guidelines (WCAG) 2.1 Level AA standards.</p>

    <h2>Accessibility Features</h2>
    <p>We have implemented the following accessibility features on our website:</p>
    <ul>
      <li><strong>Semantic HTML5 structure</strong> — proper use of headings, landmarks, lists, and structural elements for screen reader compatibility</li>
      <li><strong>Skip-to-content link</strong> — allows keyboard users to bypass navigation and jump directly to main content</li>
      <li><strong>ARIA labels and landmarks</strong> — descriptive labels on interactive elements and ARIA landmarks for navigation regions</li>
      <li><strong>Full keyboard navigation</strong> — all interactive elements are operable via keyboard</li>
      <li><strong>Visible focus indicators</strong> — clear visual focus outlines on all interactive elements when navigating with a keyboard</li>
      <li><strong>WCAG AA color contrast</strong> — minimum 4.5:1 contrast ratio for body text and 3:1 for large text</li>
      <li><strong>Descriptive alt text</strong> — all informational images include descriptive alternative text</li>
      <li><strong>Responsive zoom up to 200%</strong> — content remains usable and readable when zoomed to 200%</li>
      <li><strong><code>prefers-reduced-motion</code> media query</strong> — animations are disabled or reduced for users who prefer reduced motion</li>
      <li><strong>Form labels associated with inputs</strong> — all form fields have programmatically associated labels</li>
      <li><strong>Error messages programmatically linked to fields</strong> — form validation errors are announced to assistive technology</li>
    </ul>

    <h2>Known Limitations</h2>
    <p>Despite our best efforts, some areas of the website may not be fully accessible:</p>
    <ul>
      <li><strong>Third-party content:</strong> Embedded content such as Google Maps may not fully conform to WCAG 2.1 AA standards. We are working with third-party providers to address these limitations.</li>
    </ul>

    <h2>Feedback</h2>
    <p>We welcome your feedback on the accessibility of our website. If you encounter accessibility barriers or have suggestions for improvement, please contact us:</p>
    <ul>
      <li>Email: <a href="mailto:<?php echo htmlspecialchars($companyEmail); ?>"><?php echo htmlspecialchars($companyEmail); ?></a></li>
      <li>Phone: <a href="tel:<?php echo htmlspecialchars($companyPhone); ?>"><?php echo htmlspecialchars($companyPhone); ?></a></li>
    </ul>
    <p>We aim to respond to accessibility feedback within 5 business days.</p>

    <h2>Enforcement</h2>
    <p>We recognize your rights under the Americans with Disabilities Act (ADA), Section 508 of the Rehabilitation Act, and applicable state accessibility laws. If you believe that your rights have been violated, you may file a complaint with the appropriate enforcement agency or contact us directly so we can address your concerns.</p>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
```

---

## Section 7: Dual Consent Checkbox HTML + CSS

### Contact Form Markup (Updated with TCPA 2025/2026 + Texas TCPA Compliance)

Replace the existing contact form submit area with the following consent checkboxes. Keep all existing fields (honeypot, name, email, phone, service, message) intact.

```html
<form action="https://db.pageone.cloud/functions/v1/leads/<?php echo $clientSlug; ?>" method="POST">

  <!-- Honeypot — MUST be hidden from users, bots fill it out -->
  <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">

  <!-- Thank-you redirect -->
  <input type="hidden" name="_next" value="/thank-you">

  <!-- Consent tracking -->
  <input type="hidden" name="_consent_version" value="v2.1">
  <input type="hidden" name="_consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">

  <!-- Required fields (names MUST match exactly) -->
  <label>
    <span>Your Name</span>
    <input type="text" name="name" required>
  </label>

  <label>
    <span>Email</span>
    <input type="email" name="email" required>
  </label>

  <label>
    <span>Phone</span>
    <input type="tel" name="phone" required>
  </label>

  <!-- Optional but strongly recommended -->
  <label>
    <span>Service Needed</span>
    <select name="service">
      <option value="">Select a service</option>
      <!-- Populate with client-specific service options from intake data -->
    </select>
  </label>

  <label>
    <span>Message</span>
    <textarea name="message" rows="4"></textarea>
  </label>

  <!-- ═══ SEPARATE CONSENT CHECKBOXES (TCPA 2025/2026 + Texas TCPA) ═══ -->

  <fieldset class="form-consent-fieldset">
    <legend class="form-consent-legend">Communication Consent</legend>

    <label class="form-consent-item">
      <input type="checkbox" name="email_opt_in" value="yes" class="consent-checkbox">
      <span class="consent-label">
        <strong>Email updates (optional):</strong> I agree to receive emails from
        <?php echo htmlspecialchars($siteName); ?> about my inquiry, services, promotions, and news. I understand I can unsubscribe anytime via the link in any email
        or by emailing <?php echo htmlspecialchars($contactEmail); ?>. Message frequency varies.
      </span>
    </label>

    <label class="form-consent-item">
      <input type="checkbox" name="sms_opt_in" value="yes" class="consent-checkbox">
      <span class="consent-label">
        <strong>SMS/Text messages (optional):</strong> I agree to receive text messages from
        <?php echo htmlspecialchars($siteName); ?> at the phone number I provided. Message types may include appointment reminders, service updates, and promotional
        offers. Message frequency varies. Message and data rates may apply. Reply STOP to unsubscribe, HELP for help.
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

  <button type="submit">Send Message</button>

</form>
```

### Required CSS (add to framework.css or head.php)

```css
/* Consent fieldset */
.form-consent-fieldset {
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 1rem 1.25rem;
  margin: 1.5rem 0 1rem;
  background: var(--card-muted, rgba(0,0,0,0.02));
}
.form-consent-legend {
  font-size: 0.8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  padding: 0 0.5rem;
  color: var(--muted);
}
.form-consent-item {
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
  padding: 0.75rem 0;
  cursor: pointer;
  border-bottom: 1px solid var(--border-subtle, rgba(0,0,0,0.05));
}
.form-consent-item:last-child { border-bottom: none; }
.consent-checkbox {
  flex-shrink: 0;
  margin-top: 0.2rem;
  width: 18px;
  height: 18px;
  cursor: pointer;
}
.consent-label {
  font-size: 0.85rem;
  line-height: 1.5;
  color: var(--text);
}
.consent-label strong { font-weight: 600; }
.consent-label a { color: var(--primary); text-decoration: underline; }
.required-star { color: var(--accent, #c0392b); }
.form-consent-required .consent-label { font-weight: 500; }

@media (max-width: 600px) {
  .form-consent-fieldset { padding: 0.75rem 1rem; }
  .consent-label { font-size: 0.8rem; }
}
```

---

## Section 8: Footer Legal Row HTML + CSS

### Footer Legal Row Markup

Add this to `includes/footer.php` **above** the copyright line / `.footer-bottom-bar`:

```html
<div class="footer-legal-row">
  <a href="/privacy-policy/">Privacy Policy</a>
  <span class="divider">|</span>
  <a href="/terms/">Terms of Service</a>
  <span class="divider">|</span>
  <a href="/cookie-policy/">Cookie Policy</a>
  <span class="divider">|</span>
  <a href="/accessibility/">Accessibility</a>
  <span class="divider">|</span>
  <a href="/privacy-policy/#ccpa-rights">Do Not Sell or Share My Personal Information</a>
  <span class="divider">|</span>
  <a href="/sitemap.xml">Sitemap</a>
</div>
```

### Footer Legal Row CSS

```css
.footer-legal-row {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 0.5rem 0.75rem;
  padding: 1rem 0;
  font-size: 0.85rem;
  color: var(--muted);
  border-top: 1px solid var(--border-subtle, rgba(255,255,255,0.1));
  margin-top: 1.5rem;
}
.footer-legal-row a {
  color: var(--muted);
  text-decoration: none;
}
.footer-legal-row a:hover { color: var(--foreground); text-decoration: underline; }
.footer-legal-row .divider { color: var(--border); }

@media (max-width: 640px) {
  .footer-legal-row { flex-direction: column; gap: 0.4rem; text-align: center; }
  .footer-legal-row .divider { display: none; }
}
```

---

## Section 9: Legal Page Visual Standards

Each legal page follows this layout:

- **Hero:** 40vh, brand-colored gradient overlay, H1 only (no CTAs, no images)
- **Content:** `.content-narrow` class (max-width 720px, centered), prose styling
- **H2 section headers** with subtle divider
- **Last Updated** date at top of content
- **NO** `data-animate` attributes (legal pages must load instantly)
- **NO** top nav links to legal pages (footer only)
- **Schema:** WebPage + BreadcrumbList (include in `<head>` or inline `<script>`)

### Legal Page CSS (add to framework.css or per-page `<style>`)

```css
.legal-hero {
  min-height: 40vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, var(--color-primary), var(--color-secondary, var(--color-primary-dark)));
  color: #fff;
  text-align: center;
  padding: 2rem 1rem;
}
.legal-hero h1 {
  font-size: clamp(2rem, 5vw, 3rem);
  font-weight: 800;
  letter-spacing: -0.02em;
}
.content-narrow {
  max-width: 720px;
  margin: 0 auto;
  padding: 3rem 1.5rem 4rem;
  line-height: 1.7;
  color: var(--text);
}
.content-narrow h2 {
  margin-top: 2.5rem;
  padding-bottom: 0.5rem;
  border-bottom: 1px solid var(--border-subtle, rgba(0,0,0,0.08));
  font-size: 1.35rem;
}
.content-narrow h3 {
  margin-top: 1.75rem;
  font-size: 1.1rem;
}
.content-narrow ul { padding-left: 1.5rem; }
.content-narrow li { margin-bottom: 0.4rem; }
.content-narrow a { color: var(--color-primary); text-decoration: underline; }
.legal-updated {
  font-size: 0.9rem;
  color: var(--muted);
  margin-bottom: 2rem;
}
.cookie-table {
  width: 100%;
  border-collapse: collapse;
  margin: 1rem 0 1.5rem;
  font-size: 0.9rem;
}
.cookie-table th, .cookie-table td {
  padding: 0.6rem 0.75rem;
  border: 1px solid var(--border-subtle, rgba(0,0,0,0.1));
  text-align: left;
}
.cookie-table th {
  background: var(--card-muted, rgba(0,0,0,0.03));
  font-weight: 600;
}
```

---

## Section 10: Sitemap Entries

Add to `sitemap.xml`:

```xml
<url>
  <loc><?php echo $siteUrl; ?>/privacy-policy/</loc>
  <priority>0.3</priority>
  <changefreq>yearly</changefreq>
</url>
<url>
  <loc><?php echo $siteUrl; ?>/terms/</loc>
  <priority>0.3</priority>
  <changefreq>yearly</changefreq>
</url>
<url>
  <loc><?php echo $siteUrl; ?>/cookie-policy/</loc>
  <priority>0.3</priority>
  <changefreq>yearly</changefreq>
</url>
<url>
  <loc><?php echo $siteUrl; ?>/accessibility/</loc>
  <priority>0.3</priority>
  <changefreq>yearly</changefreq>
</url>
```

---

## Section 11: Phase 4 Audit Checklist

When QA-ing a build, verify:

- [ ] `/privacy-policy/index.php` exists, loads, contains `id="ccpa-rights"` anchor
- [ ] `/terms/index.php` exists, Governing Law matches `$companyState`
- [ ] `/cookie-policy/index.php` exists, lists GA4 + Fonts + Maps + CDNs
- [ ] `/accessibility/index.php` exists, states WCAG 2.1 AA target
- [ ] Footer legal row on every page with all 6 links
- [ ] Contact form has 3 checkboxes: email_opt_in, sms_opt_in, terms_accepted (required)
- [ ] Contact form has hidden `_consent_version` field
- [ ] "Consent is not a condition of purchase" text present in SMS consent
- [ ] Reply STOP / HELP language present in SMS consent
- [ ] Legal pages NOT in top nav
- [ ] Last Updated dates present
- [ ] All 4 legal pages in sitemap.xml at priority 0.3
- [ ] `$companyEntityType`, `$companyState`, all placeholders populated (no `[COMPANY]` raw text)
- [ ] Page One Insights LLC disclosed as data processor in Privacy Policy
- [ ] SMS program terms section in Privacy Policy (frequency, rates, opt-out)
- [ ] All 20+ state privacy rights mentioned in Privacy Policy

---

## Section 12: Required Intake Fields

Add to build intake form:

- **Business entity type** (dropdown): LLC / Sole Proprietorship / Corporation / Partnership / Other
- **State of formation** (dropdown: all 50 states + DC)
- **Does the business run paid advertising?** (Google Ads, Meta Ads — affects Cookie Policy disclosures)
- **Business operates in states:** (checklist — may affect which state privacy sections apply)

---

## Section 13: Retrofit Prompt for Existing Sites

Use this prompt to retrofit legal compliance onto an existing `~/client-sites/{slug}/` directory. Run with Claude Code.

### Retrofit Instructions

```
You are retrofitting legal compliance for an existing Page One Insights client website.

CLIENT INFO:
- Company Name: {$companyName}
- Entity Type: {$entityType} (e.g., "Limited Liability Company")
- State of Formation: {$companyState}
- Contact Email: {$companyEmail}
- Contact Phone: {$companyPhone}
- Business Address: {$companyAddress}
- Client Slug: {$clientSlug}

WORKING DIRECTORY: ~/client-sites/{slug}/

STEPS:

1. UPDATE includes/config.php — add these variables if missing:
   $entityType = '{$entityType}';
   $stateOfFormation = '{$companyState}';
   $contactEmail = '{$companyEmail}';  // may already exist as $email
   $contactPhone = '{$companyPhone}';  // may already exist as $phone
   $businessAddress = '{$companyAddress}';

2. CREATE legal page subdirectories:
   mkdir -p privacy-policy terms cookie-policy accessibility

3. CREATE /privacy-policy/index.php using Section 3 template from ~/crm/references/legal-compliance.md
4. CREATE /terms/index.php using Section 4 template
5. CREATE /cookie-policy/index.php using Section 5 template
6. CREATE /accessibility/index.php using Section 6 template

   All pages: populate every PHP variable with client data. No raw placeholders.

7. UPDATE includes/footer.php — add the Footer Legal Row (Section 8) above the copyright/.footer-bottom-bar line.

8. UPDATE contact form (contact.php or /contact/index.php):
   - Add hidden fields: _consent_version (value="v2.1"), _consent_page
   - Add the 3 consent checkboxes from Section 7
   - Keep all existing form fields and honeypot intact

9. UPDATE sitemap.xml — add the 4 legal page entries from Section 10

10. VERIFY:
    - Run through the Phase 4 audit checklist (Section 11)
    - Check all PHP includes use $_SERVER['DOCUMENT_ROOT']
    - Verify no raw $companyName or [COMPANY] text remains

11. GIT COMMIT AND PUSH:
    cd ~/client-sites/{slug}
    git add -A
    git commit -m "Legal compliance retrofit — TCPA 2025/2026, CCPA, ADA WCAG 2.1 AA"
    git push origin master
```

---

## Section 14: Agency Legal Disclaimer

> **Important Legal Disclaimer**
>
> These templates are general compliance templates intended as starting points for small local service businesses. They are NOT legal advice. Page One Insights LLC is a web design and marketing agency, not a law firm, and does not provide legal services.
>
> Clients should have these pages reviewed by an attorney licensed in their state before publication, particularly if their business:
> - Operates in healthcare (HIPAA)
> - Operates in financial services (GLBA)
> - Markets to or serves users under 13 (COPPA)
> - Has a significant B2B client base with custom contracts
> - Operates in multiple states with varying regulations
>
> Page One Insights service agreements should include an indemnification clause stating: Agency provides website design and marketing services only; agency does not provide legal advice; client is solely responsible for the accuracy and legal sufficiency of website legal pages; client indemnifies agency against any claims arising from legal page content or compliance failures.
