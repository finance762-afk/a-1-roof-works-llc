# SEO + AEO Specification — Page One Insights

Reference file for all client website builds. Covers classical SEO (for Google ranking) and Answer Engine Optimization (for AI crawlers like Claude, ChatGPT, Perplexity, and Google's AI Overviews).

This file is read by Claude Code during every build. Every rule here is enforceable by the site-qa-agent skill.

---

## Part A — On-Page SEO Fundamentals

### Required per-page meta

Every page declares SEO variables **before** including head.php:

```php
<?php
$pageTitle       = "Page Name | Company | City, State";  // 50-60 chars
$pageDescription = "150-160 char description with primary keyword and CTA";
$canonicalUrl    = "https://domain.com/path-to-page";    // self-referencing, absolute
$ogImage         = "/assets/images/og-[page].jpg";       // absolute path, 1200×630px min
$currentPage     = "page-slug";                           // drives nav active state
$schemaMarkup    = '{...}';                               // page-specific JSON-LD
$noindex         = false;                                 // true for thank-you.php only

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
?>
```

### Title tag format

**Homepage:** `[Company Name] | [Primary Service] in [City, State]`
  - Example: `BBD Tree Service | Professional Tree Removal in St. Louis, MO`

**Service page:** `[Service Name] | [Company Name] | [City, State]`
  - Example: `Emergency Tree Removal | BBD Tree Service | St. Louis, MO`

**Area page:** `[Primary Service] in [Neighborhood/City] | [Company Name]`
  - Example: `Tree Service in Kirkwood | BBD Tree Service`

**About page:** `About [Company Name] | [City, State] [Primary Service]`

**Contact page:** `Contact [Company Name] | Call [Phone] | [City, State]`

### Meta description format

- 150-160 characters (Google truncates at ~155)
- First 120 chars must stand alone (some SERPs truncate earlier)
- Include primary keyword naturally (not stuffed)
- Include a CTA or distinctive value proposition
- Include phone number where space permits
- No quotation marks in the string (breaks some parsers)

Example: `Expert tree removal in St. Louis. 15+ years, fully licensed, same-day emergency service. Free estimates. Call 314-555-0100.`

### Heading structure

- **Exactly one `<h1>` per page** (enforced by QA)
- H1 contains primary keyword + location where natural
- H2/H3 hierarchy respected — never skip from H1 to H3
- At least one H2 per service/area page phrased as a **question** (for AEO — see Part C)

### Internal linking

- Every page links to 2-3 other internal pages with descriptive anchor text
- No "click here" / "read more" / "learn more" alone — anchor text must describe destination
- No orphan pages — every page must be reachable from at least one other page
- Footer includes at least: home, services, service areas (if applicable), about, contact
- Breadcrumbs on every page except homepage (visible HTML + BreadcrumbList schema)

### Phone numbers

- Always wrap in `<a href="tel:+1XXXXXXXXXX">` for click-to-call
- Format consistently across site — pick one format and use it everywhere (e.g. always `(314) 555-0100` or always `314-555-0100`)
- Phone number in nav on desktop (visible or reveal-on-scroll)
- Phone number in footer on every page
- Phone number in hero CTA area

### Last Updated

Every service and area page includes a visible "Last Updated: [Month Year]" marker. Updates trust signals for both users and Google.

```html
<p class="last-updated">Last Updated: <?= date('F Y') ?></p>
```

### OG tags (required)

```html
<meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
<meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>">
<meta property="og:image" content="<?= htmlspecialchars($absoluteOgImage) ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= htmlspecialchars($companyName) ?>">
```

### NO Twitter/X card tags

Do NOT include `twitter:card`, `twitter:title`, `twitter:description`, `twitter:image`. These provide zero discovery value for local home service businesses and add bloat. Forbidden.

### NO meta keywords

Do NOT include `<meta name="keywords">`. Google has ignored this tag since 2009. It's a forbidden tag in CLAUDE.md.

### Canonical tag

Every page has a self-referencing canonical:

```html
<link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">
```

Absolute URL, including protocol. Must match the actual production URL exactly (no trailing slash mismatches, no `www` vs non-`www` inconsistencies).

### robots meta

Standard pages: omit the robots meta tag (default is index,follow — no need to state explicitly).

Exceptions:
- `thank-you.php` — `<meta name="robots" content="noindex,nofollow">` via `$noindex = true`
- `404.php` — `<meta name="robots" content="noindex">` via `$noindex = true`

---

## Part B — Schema Markup (JSON-LD)

Schema is the highest-leverage SEO work after meta tags. Google uses it directly for rich results, and AI crawlers use it for fact extraction.

### Universal schema (every page)

**LocalBusiness** schema on every page. NAP must be character-for-character identical to the client's Google Business Profile.

```json
{
  "@context": "https://schema.org",
  "@type": "TreeService",
  "name": "BBD Tree Service",
  "image": "https://bbdtreeservice.com/assets/images/og-home.jpg",
  "url": "https://bbdtreeservice.com",
  "telephone": "+13145550100",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "123 Main St",
    "addressLocality": "St. Louis",
    "addressRegion": "MO",
    "postalCode": "63101",
    "addressCountry": "US"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 38.6270,
    "longitude": -90.1994
  },
  "openingHoursSpecification": [{
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
    "opens": "07:00",
    "closes": "18:00"
  }],
  "priceRange": "$$",
  "areaServed": [
    {"@type": "City", "name": "St. Louis"},
    {"@type": "City", "name": "Kirkwood"},
    {"@type": "City", "name": "Webster Groves"}
  ],
  "sameAs": [
    "https://www.facebook.com/bbdtreeservice",
    "https://www.google.com/maps/place/..."
  ]
}
```

**Schema `@type` by industry:**
- Tree service: `TreeService` or `HomeAndConstructionBusiness`
- Lawn care: `LawnMaintenanceService` or `HomeAndConstructionBusiness`
- Towing: `AutoTowing`
- Plumbing: `Plumber`
- Roofing: `RoofingContractor`
- HVAC: `HVACBusiness`
- Electrician: `Electrician`
- Carpet cleaning: `HousePainter` is wrong — use `HomeAndConstructionBusiness`
- Tile/grout: `HomeAndConstructionBusiness`
- When in doubt: `LocalBusiness` (generic parent)

### Page-specific schema stacking

**Homepage**: LocalBusiness + WebSite (with SearchAction) + AggregateRating + FAQPage

```json
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "url": "https://bbdtreeservice.com",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://bbdtreeservice.com/search?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
```

**Service pages**: LocalBusiness + Service + AggregateRating + FAQPage (optional) + HowTo (where applicable)

```json
{
  "@context": "https://schema.org",
  "@type": "Service",
  "serviceType": "Emergency Tree Removal",
  "provider": {
    "@type": "TreeService",
    "name": "BBD Tree Service"
  },
  "areaServed": {
    "@type": "City",
    "name": "St. Louis"
  },
  "description": "24/7 emergency tree removal services for storm damage, dangerous trees, and insurance claim support.",
  "offers": {
    "@type": "Offer",
    "priceSpecification": {
      "@type": "PriceSpecification",
      "priceCurrency": "USD",
      "minPrice": "500",
      "maxPrice": "3500"
    }
  }
}
```

**Service area pages**: LocalBusiness + Place

**About page**: LocalBusiness + Organization + Person (for owner if name is public)

```json
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "John Smith",
  "jobTitle": "Owner",
  "worksFor": {
    "@type": "TreeService",
    "name": "BBD Tree Service"
  }
}
```

**Contact page**: LocalBusiness + ContactPage

**FAQ page**: FAQPage with every question/answer pair

```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "How much does tree removal cost in St. Louis?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Tree removal in St. Louis typically ranges from $500 to $3,500 depending on tree size, location, and difficulty. Small trees under 30 feet: $500-$1,000. Medium trees: $1,000-$2,000. Large or hazardous trees: $2,000-$3,500."
    }
  }]
}
```

### BreadcrumbList (required on all non-homepage pages)

Every non-home page includes both a **visible HTML breadcrumb** AND a **BreadcrumbList schema**:

```json
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://bbdtreeservice.com"},
    {"@type": "ListItem", "position": 2, "name": "Services", "item": "https://bbdtreeservice.com/services"},
    {"@type": "ListItem", "position": 3, "name": "Emergency Tree Removal", "item": "https://bbdtreeservice.com/services/emergency-tree-removal"}
  ]
}
```

### ImageObject schema (hero images)

Every page's hero image includes ImageObject schema in the LocalBusiness schema or as a separate graph:

```json
{
  "@type": "ImageObject",
  "url": "https://bbdtreeservice.com/assets/images/og-emergency-removal.jpg",
  "width": 1200,
  "height": 630,
  "caption": "Emergency tree removal after storm damage in St. Louis"
}
```

### AggregateRating

Include on Homepage, Service pages, About page when the client has real Google reviews. Never fabricate.

```json
{
  "@type": "AggregateRating",
  "ratingValue": "4.9",
  "reviewCount": "127",
  "bestRating": "5",
  "worstRating": "1"
}
```

Pull the numbers from the client's actual GBP listing. If the client has fewer than 5 reviews, omit AggregateRating — Google may flag it as thin data.

### HowTo schema (where applicable)

Use for service pages that describe a step-by-step process:

```json
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How We Remove Large Trees Safely",
  "step": [
    {"@type": "HowToStep", "position": 1, "name": "Site assessment", "text": "Our certified arborists assess the tree, surroundings, and risk factors before any work begins."},
    {"@type": "HowToStep", "position": 2, "name": "Equipment setup", "text": "We set up cranes, rigging, or bucket trucks based on the specific removal strategy."},
    {"@type": "HowToStep", "position": 3, "name": "Sectional removal", "text": "For large or hazardous trees, we remove in sections to protect your property."},
    {"@type": "HowToStep", "position": 4, "name": "Stump grinding (optional)", "text": "We grind the stump below grade and remove debris."},
    {"@type": "HowToStep", "position": 5, "name": "Cleanup", "text": "All wood, branches, and debris are removed. Your property is left clean."}
  ]
}
```

---

## Part C — Answer Engine Optimization (AEO)

AEO optimizes for AI crawlers. These weight differently from Google: they favor structured, conversational, direct-answer content over keyword density.

### Entity Block (required on every page)

Every page includes an **entity block** in the first 100 words of visible body content AND in the footer. Format:

> [Company Name] is a [industry] company based in [City, State], serving [service area]. Founded [year or "with X years of experience"], [Company Name] specializes in [top 3 services]. Contact: [phone] | [email] | [website]. Licensed and insured.

Example:

> BBD Tree Service is a tree care company based in St. Louis, Missouri, serving St. Louis County and the surrounding Metro East area. Founded in 2008, BBD specializes in emergency tree removal, tree trimming, and stump grinding. Contact: (314) 555-0100 | info@bbdtreeservice.com | bbdtreeservice.com. Licensed and insured.

**Why this matters:** AI crawlers use this block as ground truth for the business entity. Consistent phrasing across all pages prevents confusion when the AI cites the business.

### Answer Blocks (service and area pages)

Every service and area page includes **answer blocks** — explicit question/answer pairs that AI crawlers can extract directly:

```html
<div class="answer-block">
  <h2>How much does emergency tree removal cost in St. Louis?</h2>
  <p>Emergency tree removal in St. Louis typically ranges from $500 to $3,500. Small trees under 30 feet cost $500-$1,000. Medium trees 30-60 feet cost $1,000-$2,000. Large or hazardous trees over 60 feet cost $2,000-$3,500. Insurance often covers emergency removal after storm damage.</p>
</div>
```

**Answer block rules:**
- The H2 is a complete question (not a topic — "How much does X cost" not "Pricing")
- The answer is 1-3 sentences, direct, with **specific numbers/timeframes** where possible
- Includes cost range, timeframe, scope, or other quantifiable answer
- No marketing fluff ("We're the best" is not an answer)

### Conversational keyword integration

Modern search and AI queries are conversational. Integrate naturally:

- At least one H2 or H3 per service page phrased as a question
- "near me" phrasing in area page body copy (naturally, not stuffed)
- Questions people actually ask — use Search Console "Queries" data or tools like AlsoAsked to find them
- Write for the question, not the keyword

**Examples:**
- Bad: H2 "Tree Removal St. Louis"
- Good: H2 "How do I know if a tree needs to be removed?"

- Bad: H2 "Emergency Services"
- Good: H2 "What qualifies as an emergency tree situation?"

### FAQ Distribution

Every tier includes FAQ content, with density scaled by page:

| Page type | FAQ count |
|---|---|
| Homepage | 5-7 FAQs |
| Service pages | 3-4 FAQs |
| Service area pages | 2-3 FAQs |
| FAQ page (Premium only) | 10-12 FAQs total |

Every FAQ section has corresponding **FAQPage schema** (see Part B).

### First 50 words

The first 50 words of every section must answer the implied question of that section. No throat-clearing, no "In today's world...", no "Tree service is important because...".

**Bad:** "Tree removal is a service that many homeowners need from time to time. Whether you have an old tree or a new problem, our team can help with a variety of situations..."

**Good:** "Emergency tree removal in St. Louis costs $500-$3,500 depending on tree size and difficulty. We respond within 2 hours for true emergencies and accept most insurance claims. Our certified arborists handle everything from storm damage to hazardous tree assessments."

### Trust indicators (naturally woven)

Include these where they fit — never as a bullet list:

- Licensed and insured (specify state licensing number if available)
- Years in business
- Certifications (ISA Certified Arborist, etc.)
- Cost ranges (not exact prices — "typically $500-$1,500")
- Timeframes ("same-day", "within 2 hours", "48-hour turnaround")
- Warranty/guarantee terms

### Local authority signals

Reference local specifics:
- Named neighborhoods/suburbs (not just "St. Louis" — also "Kirkwood", "Webster Groves", "Clayton")
- Regional landmarks ("near Forest Park", "serving the Central West End")
- Regional conditions ("Midwest storm seasons", "Missouri soil types", "local oak species")
- Nearby cities served

---

## Part D — AEO Files

### llms.txt (root-level)

Every site has `/llms.txt` — a structured business summary for AI crawlers. Placed at the domain root. Format:

```
# [Company Name]

[One-sentence description — "X company in [city] specializing in [top services]"]

## Business Information
- Owner: [Owner name]
- Phone: [phone]
- Email: [email]
- Address: [full address]
- Hours: [Mon-Fri 7am-6pm, etc.]
- Service Area: [list of cities/regions served]
- Licensed: [yes/no + state license # if applicable]
- Insured: [yes]
- Founded: [year]

## Services
- [Service 1]
- [Service 2]
- [Service 3]
- ...

## Pages
- Home: https://domain.com/ — Main landing page, services overview
- About: https://domain.com/about — Company history and team
- Services: https://domain.com/services — All services listing
- [Individual service]: https://domain.com/services/[slug] — [one-line description]
- ...

## About
[2-3 sentence description of the business. Plain prose. No marketing fluff.]
```

### llms-full.txt (root-level)

Expanded version of llms.txt. Same structure plus:

```
## Full About
[3-5 sentences about the business, founding story, and positioning.]

## Service Details
### [Service 1]
[One paragraph describing the service, what's included, typical cost range, typical timeframe.]

### [Service 2]
[One paragraph...]

## Frequently Asked Questions

Q: [Question 1]
A: [Answer 1]

Q: [Question 2]
A: [Answer 2]

[Include 8-10 FAQ pairs covering the most common questions across the business.]

## Certifications & Trust Signals
- [Certification 1]
- [Certification 2]
- [Insurance details]
- [Years in business]
- [Notable projects or partnerships]

## Online Presence
- Website: https://domain.com
- Google Business Profile: [URL]
- Facebook: [URL]
- Instagram: [URL]
- Yelp: [URL]
- BBB: [URL]
- [Other platforms]
```

Both files are plain text (not markdown rendering — though they use markdown-style headers for readability). AI crawlers parse them directly.

### robots.txt

```
User-agent: *
Allow: /

Sitemap: https://domain.com/sitemap.xml
Sitemap: https://domain.com/sitemap-images.xml
```

No `Disallow` rules unless the client has specific pages to exclude. Don't add `Disallow: /wp-admin/` or other CMS-specific rules — these sites aren't WordPress.

**Do NOT block AI crawlers in robots.txt.** These sites WANT to be crawled by Claude, ChatGPT, Perplexity, and Google's AI Overviews — that's the point of AEO. Blocking them defeats the strategy.

### sitemap.xml

Every page listed with `lastmod`, `changefreq`, `priority`. Use clean URLs (no `.php` extension):

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://bbdtreeservice.com/</loc>
    <lastmod>2026-04-23</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>https://bbdtreeservice.com/services/emergency-tree-removal</loc>
    <lastmod>2026-04-23</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.9</priority>
  </url>
  <!-- ... all pages ... -->
</urlset>
```

**Priority guidance:**
- Homepage: 1.0
- Primary services: 0.9
- Service area pages: 0.8
- Secondary services: 0.8
- About: 0.7
- Contact: 0.7
- FAQ: 0.6

### sitemap-images.xml

Separate image sitemap. Every client photo gets an entry:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
  <url>
    <loc>https://bbdtreeservice.com/services/emergency-tree-removal</loc>
    <image:image>
      <image:loc>https://bbdtreeservice.com/assets/images/emergency-removal-crane.jpg</image:loc>
      <image:caption>Crane-assisted emergency tree removal after storm damage</image:caption>
      <image:title>Emergency tree removal — St. Louis</image:title>
    </image:image>
    <!-- More images on this page -->
  </url>
</urlset>
```

Image captions and titles are LLM-readable — treat them as content, not metadata.

---

## Part E — Technical SEO

### Clean URLs

URLs never contain `.php` extension. `.htaccess` rewrites handle this (see CLAUDE.md for the exact rule). Examples:

- ✅ `https://domain.com/services/emergency-tree-removal`
- ❌ `https://domain.com/services/emergency-tree-removal.php`

### 404.php

Custom 404 page with:
- Same nav and footer as rest of site (don't strip to bare page)
- Clear message that the page doesn't exist
- Primary CTA (call phone number or visit homepage)
- Links to main sections (services, about, contact)
- `<meta name="robots" content="noindex">` set via `$noindex = true`

### thank-you.php

Thank-you page served after form submission:
- Same nav and footer
- Branded success message with client's business name
- Phone number with click-to-call
- "What happens next" — 2-3 sentence explanation of response time and next steps
- `<meta name="robots" content="noindex,nofollow">` set via `$noindex = true`
- Optional: GTM/GA4 conversion tracking trigger

### Core Web Vitals targets

- Lighthouse Performance: 90+
- Lighthouse Accessibility: 95+
- Lighthouse SEO: 95+
- Total page weight: under 3MB
- LCP (Largest Contentful Paint): under 2.5s
- CLS (Cumulative Layout Shift): under 0.1 (enforced via aspect-ratio CSS on all images)

### GA4 + GSC placeholders

head.php includes conditional placeholders for Google Analytics 4 and Google Search Console verification:

```html
<?php if (!empty($ga4MeasurementId)): ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars($ga4MeasurementId) ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?= htmlspecialchars($ga4MeasurementId) ?>');
</script>
<?php endif; ?>

<?php if (!empty($gscVerification)): ?>
<meta name="google-site-verification" content="<?= htmlspecialchars($gscVerification) ?>">
<?php endif; ?>
```

These pull from the client's intake data. Always included conditionally — never hardcoded.

### Preconnect / dns-prefetch

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
<link rel="preload" as="image" href="/assets/images/hero-home.jpg">
<link rel="preload" as="font" type="font/woff2" href="https://fonts.gstatic.com/..." crossorigin>
```

Preconnect saves 100-300ms on font loading. Preload on hero image prevents the LCP fallback.

---

## Part F — Content Rules

### Answer-first opening

Every service page and area page opens with a direct answer, not marketing fluff.

**Bad opening (marketing fluff):**
> "At BBD Tree Service, we understand that trees are an important part of your property. Our team of experts is dedicated to providing you with the best tree service in St. Louis..."

**Good opening (answer-first):**
> "Emergency tree removal in St. Louis costs $500-$3,500 depending on tree size and urgency. Our certified arborists respond within 2 hours for true emergencies, accept most insurance claims, and handle everything from storm damage to hazardous tree removal. We've been serving the St. Louis metro area for 15+ years."

The answer-first opening is simultaneously good SEO (dense with keywords in context), good AEO (extractable answer), and good UX (respects the reader's time).

### Consistent entity naming

The business name, service terms, and location references must be **character-for-character identical** across all pages. Pick once, use everywhere. AI crawlers flag inconsistencies as potential entity confusion.

Examples:
- If the company is legally "BBD Tree Service LLC" but goes by "BBD Tree Service" — use "BBD Tree Service" on every page. Don't mix in "BBD Tree Service LLC" occasionally.
- If a service is called "Emergency Tree Removal" — don't also call it "Emergency Tree Service" or "24/7 Tree Removal" elsewhere.
- If the location is "St. Louis, Missouri" — don't abbreviate to "STL" or "St. Louis, MO" on some pages.

### Service naming consistency

Every service has one canonical name. Document it in the build intake. Use it in:
- Page title
- H1
- Schema `serviceType`
- Navigation label
- Footer link
- Internal linking anchor text
- llms.txt / llms-full.txt

---

## Part G — Verification Checklist

Before a build can pass QA, every page must satisfy:

- [ ] Unique `<title>` tag, 50-60 chars, correct format
- [ ] Unique `<meta description>`, 150-160 chars
- [ ] Exactly one `<h1>`
- [ ] Self-referencing canonical with absolute URL
- [ ] OG tags (title, description, image, url, type, site_name)
- [ ] NO Twitter/X card tags
- [ ] NO meta keywords tag
- [ ] LocalBusiness JSON-LD schema
- [ ] Page-specific schema (Service / Place / Person / FAQPage / BreadcrumbList as applicable)
- [ ] BreadcrumbList schema on non-homepage pages + visible HTML breadcrumb
- [ ] Entity block in first 100 words
- [ ] Entity block in footer
- [ ] All images have descriptive alt text with keyword + location
- [ ] All images have explicit width + height
- [ ] All images have loading="lazy" except hero
- [ ] All phone numbers wrapped in `<a href="tel:">`
- [ ] Internal links to 2-3 other pages with descriptive anchor text
- [ ] Answer-first opening paragraph
- [ ] At least one H2 phrased as a question (service + area pages)
- [ ] FAQ section with correct density for page type
- [ ] FAQPage schema when FAQs present
- [ ] "Last Updated: [Month Year]" visible (service + area pages)
- [ ] Schema matches NAP from GBP character-for-character

Root-level files:
- [ ] `sitemap.xml` with all pages, lastmod, changefreq, priority
- [ ] `sitemap-images.xml` with all client images, captions, titles
- [ ] `robots.txt` referencing both sitemaps
- [ ] `llms.txt` populated
- [ ] `llms-full.txt` populated with FAQ section
- [ ] `404.php` with full nav + footer + noindex
- [ ] `thank-you.php` with full nav + footer + noindex

---

*This file is the canonical SEO/AEO standard. Update it when SERP behavior or AI crawler norms shift meaningfully. Do not add requirements speculatively — every addition becomes a QA enforcement point.*
