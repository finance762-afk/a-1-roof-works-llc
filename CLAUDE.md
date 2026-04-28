# CLAUDE.md — Page One Insights Build Standards

> Claude Code reads this file automatically on every build. All rules here are **mandatory** unless explicitly overridden by the build prompt.

---

## How This File Works

CLAUDE.md is the **enforcement layer** — it defines what a build must contain and what's forbidden. The **how** lives in reference files. Read the references before writing code:

- `~/crm/references/design-system.md` — visual architecture, CSS tokens, premium technique library, visual vocabulary archetypes (**READ FIRST**)
- `~/crm/references/seo-aeo-2026.md` — SEO + AEO specifications, schema markup, llms.txt patterns
- `~/crm/references/build-phases.md` — PHP architecture, build phase order, deployment pipeline

Rules below win when they conflict with anything in references.

---

## Tier Visual Quality Matrix (MANDATORY — ENFORCED BY QA)

Every build is assigned a tier in the build prompt. The tier determines the visual bar.

| Tier | CSS lines/page (inline `<style>`) | Distinct techniques/page | QA enforcement on failure |
|---|---|---|---|
| **Premium** | **≥ 400** | **≥ 6** from technique library | **FAIL HARD** — build cannot deploy |
| **Standard** | **≥ 200** | **≥ 4** from technique library | WARN — logged but build proceeds |
| **Basic** | **≥ 100** | **≥ 2** from technique library | WARN — logged but build proceeds |

### Automatic-fail conditions (ALL tiers)

- A page with **zero** inline `<style>` blocks fails regardless of tier
- A page that reuses CSS class names from another page's `<style>` block without visual differentiation (just copying) fails
- A page using only default/global `styles.css` classes with no page-specific work fails
- A page where `<style>` contains hardcoded colors, shadows, or spacing values (not `var()` tokens) fails

### Required techniques (per-page minimum)

Each page must use techniques from `design-system.md` Part C. The per-page requirements in C12 define which techniques are mandatory on which page types. At a minimum, every page includes:

- Layered hero (C1) with `::before` gradient overlay + `::after` noise texture
- At least 2 different section divider styles (C3)
- Text-wrap: balance on every heading
- No two consecutive sections with identical layout or background treatment
- One signature section (C7) that doesn't repeat elsewhere on the page

### Why this exists

Without quantitative enforcement, builds produced by AI agents drift toward the minimum — pages with zero custom CSS technically meet qualitative "use premium techniques" rules. The line count and technique count are the floor. Hitting them does not guarantee quality, but falling below them guarantees failure.

---

## Legal & Compliance Requirements (REQUIRED — EVERY BUILD)

Every Page One Insights client website MUST include the following legal and compliance elements. These are non-negotiable and required for TCPA 2025/2026, CCPA/CPRA, ADA WCAG 2.1 AA, and multi-state privacy law compliance. Missing any of these items is an automatic QA fail.

### Four Required Legal Pages (All Tiers)

All pages use subdirectory/index.php pattern:

- `/privacy-policy/index.php` — CCPA/CPRA + 19 other state rights, SMS terms, data processor disclosure
- `/terms/index.php` — Governing law from client's state of formation
- `/cookie-policy/index.php` — GA4, Fonts, Maps, CDN cookies disclosed
- `/accessibility/index.php` — WCAG 2.1 AA conformance statement

Legal pages are linked ONLY from the footer legal row. Never in top nav or body CTAs.

### Footer Legal Row (Every Page)

Above the copyright line in `includes/footer.php`:

```
Privacy Policy | Terms of Service | Cookie Policy | Accessibility | Do Not Sell or Share My Personal Information | Sitemap
```

"Do Not Sell or Share" links to `/privacy-policy/#ccpa-rights` anchor.

### Contact Form: Dual Consent Checkboxes (TCPA 2025/2026)

Contact forms MUST include THREE separate checkboxes:

1. **Email opt-in (optional)** — receives marketing emails from company
2. **SMS opt-in (optional)** — receives text messages; includes "Consent is not a condition of purchase," "Message and data rates may apply," "Reply STOP to unsubscribe"
3. **Terms acceptance (REQUIRED)** — agreement to Privacy Policy and Terms of Service

These must be SEPARATE, UNBUNDLED, NOT pre-checked. This is a Texas TCPA requirement (Sept 2025) and industry best practice everywhere.

Hidden form fields required:

- `_consent_version` — currently `"v2.1"`
- `_consent_page` — PHP: `<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>`

The edge function at `https://db.pageone.cloud/functions/v1/leads/{client_slug}` automatically captures IP, user agent, and timestamp, and writes to `consent_records` table for legal defense.

### Required Intake Questions

Intake MUST collect before building:

- Business entity type (LLC, Sole Proprietorship, Corporation, Partnership)
- State of formation (for Terms governing law)
- Does client run paid advertising (Google Ads, Meta Ads)?
- States where business operates

### Why These Are Non-Negotiable

- **TCPA violations** = $500–$1,500 per text. Settlements in 2024–2025 averaged $7–15M. Class actions common.
- **CCPA/CPRA** — $2,500–$7,500 per violation. Applies if any California resident visits.
- **ADA Title III lawsuits** — up 25% YoY. Small businesses targeted.
- **Texas TCPA (Sept 2025)** — requires separate unbundled checkbox specifically.
- **FCC Opt-Out Rule (April 2025)** — businesses must honor any reasonable opt-out method.
- **CCPA 2026 updates** — mandatory confirmation that opt-out was honored.

### Full Templates

Complete page templates, consent HTML/CSS, footer legal row, sitemap entries, Phase 4 audit checklist, retrofit prompt, and agency disclaimer are documented at:

`/home/calvin/crm/references/legal-compliance.md`

- Phase 2 (Header/Footer/Head) must include the footer legal row.
- Phase 4 (Inner Pages) must generate all 4 legal page subdirectories.
- Phase 5 (SEO/Final Polish) must add legal pages to sitemap.xml.
- QA must verify all checklist items in Section 11 of legal-compliance.md.

---

## Lead Form Endpoint (REQUIRED — REPLACES FORMSUBMIT.CO)

All client website contact forms post to the Page One CRM endpoint. This is how leads reach the client's Portal, their CRM deal, and their email.

### Form action URL

```
https://db.pageone.cloud/functions/v1/leads/{client_slug}
```

Where `{client_slug}` is the client's slug (matches the build directory name in `~/client-sites/` and the `site_build_intakes.client_slug` column).

### Required form markup

```html
<form action="https://db.pageone.cloud/functions/v1/leads/example-client-slug" method="POST">

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

### Field name rules

- `name`, `email`, `phone` — REQUIRED on every form. The CRM rejects submissions missing these. Field `name` attributes must match these strings exactly (lowercase).
- `service` — OPTIONAL but enables AI lead value estimation. Strongly recommended.
- `message` — OPTIONAL. Free-text field.
- `_honey` — REQUIRED. Spam protection. Must be visually hidden AND have `tabindex="-1"` and `autocomplete="off"`. Do NOT use `display:none` alone without `!important` — bots that parse CSS will skip it.
- `_next` — REQUIRED. Relative URL for thank-you redirect after submission. Default: `/thank-you`.

### What happens on submission

The CRM handles everything:
1. Lead saves to `portal_leads` table (client sees it in Portal realtime)
2. Linked to client's deal in Primary CRM (activity log entry)
3. Branded email sent to client with lead details + AI value estimate + Portal link
4. Customer Service CC'd on notification email (internal visibility)
5. User redirected to `_next` (the thank-you page)

### What NOT to include

- **NO** `_captcha`, `_subject`, `_template`, `_cc`, or any other formsubmit.co-legacy fields
- **NO** JavaScript for submission — native HTML form submit works and is more reliable
- **NO** external spam libraries (reCAPTCHA, hCaptcha) — honeypot + server-side rate limiting is sufficient
- **NO** mailto: action links — the CRM pipeline handles email delivery

### Thank-you page

Every build includes `/thank-you.php` with:
- `<meta name="robots" content="noindex,nofollow">` in head.php (via page-specific `$noindex = true`)
- Branded success message
- Phone number + CTA to call now
- Link back to home

---

## Footer Dofollow Link (REQUIRED — EVERY BUILD)

Every page must include via footer.php:

```html
<a href="https://pageoneinsights.com" rel="dofollow" target="_blank">Web Design & Hosting by Page One Insights, LLC</a>
```

No exceptions. Do not alter the anchor text. Do not add `rel="nofollow"`.

---

## PHP Include Path Rule (CRITICAL)

Every include across ALL .php files — root level and subdirectories — uses `$_SERVER['DOCUMENT_ROOT']`:

```php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
```

**NEVER use relative paths** like `include 'includes/head.php'` or `include '../includes/head.php'`. Relative paths break on Hostinger when mod_rewrite rewrites the URL but PHP's working directory stays at the document root. Pages in real subdirectories (like `/services/`) will 404 or render broken.

`$_SERVER['DOCUMENT_ROOT']` is the only reliable method.

---

## .htaccess (Subdirectory-Safe)

The rewrite rules MUST exclude `/assets/` and `/includes/`, and MUST NOT use `!-d` (which breaks subdirectory pages on Hostinger):

```apache
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/assets/
RewriteCond %{REQUEST_URI} !^/includes/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^([^\.]+)$ $1.php [NC,L]
RewriteCond %{THE_REQUEST} /([^.]+)\.php [NC]
RewriteRule ^ /%1 [NC,L,R=301]
```

The `!-d` condition is intentionally removed. Without this fix, pages inside real subdirectories like `services/kitchen-remodeling.php` fail to resolve on Hostinger.

---

## Accessibility Baseline (REQUIRED)

Every build includes:

- **Skip-to-content link** as first element in nav.php:
  ```html
  <a href="#main-content" class="skip-link">Skip to main content</a>
  ```
  Visually hidden by default, visible on `:focus-visible`, positioned above navbar.
- `<main id="main-content">` wraps page content on every page
- All interactive elements: visible `:focus-visible` outline (2px solid `var(--color-accent)`, 2px offset)
- ARIA landmarks: `<nav aria-label="Main navigation">`, `<main>`, `<footer>`
- All form inputs: associated `<label>` element (floating label pattern satisfies this)
- Color contrast: minimum WCAG AA (4.5:1 body text, 3:1 large text) — verify brand colors meet this before finalizing palette
- Keyboard navigation: all interactive elements reachable and operable via keyboard
- `aria-expanded` toggled on mobile menu toggle button
- `aria-current="page"` on active nav link
- `prefers-reduced-motion` respected in CSS reset (see design-system.md Part A)

---

## Copy Quality Standards (REQUIRED)

### Banned phrases (never use)

- "quality service" / "quality workmanship"
- "trusted professionals"
- "contact us today" (as a headline — fine as button text)
- "your satisfaction is our priority"
- "we go above and beyond"
- "one-stop shop"
- "second to none"

### Required copy characteristics

- **Benefit-driven headlines** — what the customer gets, not what the company claims
- **Specific service language with local context** — reference neighborhoods, landmarks, regional conditions
- **Confident, direct tone** — no hedging, no marketing filler
- **Clear CTAs with urgency or specificity** — "Get Your Free Estimate" / "Call Now — Same-Day Available" (not "Contact Us")
- **Real numbers where possible** — cost ranges, timeframes, years in business, jobs completed
- **Answer-first paragraphs** — every service/area page opens with a direct answer in the first 50 words, not marketing fluff
- **Written for this specific business** — not templated. If the same copy could appear on a competitor's site, rewrite it.

---

## Design Anti-Patterns (STRICTLY FORBIDDEN)

- No generic centered text blocks repeated section after section
- No equal-height bland sections stacked with no visual variation
- No default/unstyled buttons — every button uses the button pattern from design-system.md (C9 and button patterns)
- No stock layout repetition across pages — each page uniquely composed
- No decorative-only animations — every animation serves UX
- No more than 2 fonts — one heading + one body (plus optional accent script/italic for specific use cases only)
- No weak hero sections — hero must feel premium immediately
- No flat depthless designs — use elevation system on all elements
- No unstyled form inputs — floating labels with animated focus states required
- No paragraphs wider than 65ch — all prose width-constrained via `.prose` or `.prose-centered`
- No raw rectangle images — all images use a composition treatment from design-system.md C11
- No meta keywords tag — Google has ignored it since 2009
- No Twitter/X card tags — no discovery value for local home service businesses
- No hardcoded colors, shadows, or spacing values in CSS — use `var()` tokens only

---

## Visual Restraint Rule (CRITICAL)

- Not every technique in the library should be used on every site
- Maximum of **3–4 major visual effects** per page (VanillaTilt, magnetic CTA, typed text, parallax, before/after slider each count as a major effect)
- Standard effects that do NOT count toward the limit: scroll fade-up reveals, image wipe reveal on scroll, ripple on click, card hover shift, Ken Burns hero, ticker strip
- If an effect does not enhance clarity or UX for this specific page, do not include it
- Prefer simplicity over stacking features
- Each site must feel intentionally designed, not feature-loaded

---

## Adaptive Design Flexibility

Claude Code MAY adjust:
- Spacing values within the token scale (choose appropriate `--space-*` per context)
- Section ordering (sequence of content sections on a page)
- Grid ratios (e.g. `2fr 1fr 1fr` vs `1fr 1fr 1fr` when appropriate)
- Visual accent placement (where floating elements, decorative corners, etc. land)
- Divider style selection (choose from design-system.md C3 based on archetype fit)

Claude Code MUST NOT skip or omit:
- PHP includes architecture (head.php, nav.php, footer.php)
- CSS variable system and token scale
- Schema markup requirements
- 3 CTAs per page
- Entity blocks and AEO content
- Accessibility features (skip-to-content, prefers-reduced-motion, alt tags, semantic HTML, focus-visible)
- Footer dofollow link
- Lead form endpoint configuration
- Tier-minimum CSS line count and technique count

This rule permits refinement of visual execution, not removal of structural requirements.

---

## Local Preview — PHP Required

Preview command is always:

```bash
php -S localhost:8000
```

Before running, verify PHP is installed:

```bash
which php && php -v
```

If PHP is not found, do NOT suggest `npx serve` or `python3 -m http.server` — these cannot process PHP includes and will render broken pages. Instead:

1. Offer to generate a single temporary static file (`index-preview.html`) with all includes inlined so the homepage can be visually verified
2. Inform the user to install PHP via Homebrew for full preview: `brew install php`

---

## Enforcement Pipeline

Builds pass through these checks in order:

1. **Phase 5 QA** — site-qa-agent skill runs 62+ checks + tier-specific CSS validation (file exists + line counts + technique detection). Generates structured JSON report.
2. **Fix All remediation (Premium only)** — if Premium build fails, Phase 6 auto-runs to bring failing pages up to standard by applying missing techniques page-by-page.
3. **Re-QA** — after Phase 6, full QA runs again. If still failing, build halts for manual review.
4. **Deployment** — only builds passing QA deploy to production.

See site-qa-agent/SKILL.md for validator implementation.

---

## Pointers to Reference Files

For anything not covered above:

- **Visual architecture, CSS tokens, technique library, archetypes** → `~/crm/references/design-system.md`
- **SEO schema, meta tags, llms.txt, AEO content rules** → `~/crm/references/seo-aeo-2026.md`
- **PHP component structure, build phases, file organization, deployment** → `~/crm/references/build-phases.md`

If a requirement is not explicitly in this file and not in a reference file, it does not exist. Do not invent requirements.
