<?php
/**
 * functions.php — Shared helper functions for A-1 Roof Works LLC
 *
 * Included via require_once by head.php and any page that needs helpers
 * before head.php is loaded.
 */

/**
 * Convert a CSS hex color to "R, G, B" string for use in rgba() tokens.
 * e.g. hexToRgb('#1b3a6b') → '27, 58, 107'
 */
function hexToRgb(string $hex): string {
    $hex = ltrim($hex, '#');
    if (strlen($hex) === 3) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    if (strlen($hex) !== 6) {
        return '0, 0, 0';
    }
    return (string) hexdec(substr($hex, 0, 2)) . ', '
         . (string) hexdec(substr($hex, 2, 2)) . ', '
         . (string) hexdec(substr($hex, 4, 2));
}

/**
 * Check whether a given page slug matches the current page.
 * Drives aria-current and active nav class.
 */
function isActivePage(string $page): bool {
    global $currentPage;
    return isset($currentPage) && $currentPage === $page;
}

/**
 * Format a raw phone number for display.
 * Handles 10-digit and 11-digit (leading 1) US numbers.
 * Preserves already-formatted strings.
 * e.g. '5551234567' → '(555) 123-4567'
 */
function formatPhone(string $phone): string {
    $digits = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($digits) === 11 && $digits[0] === '1') {
        $digits = substr($digits, 1);
    }
    if (strlen($digits) === 10) {
        return '(' . substr($digits, 0, 3) . ') ' . substr($digits, 3, 3) . '-' . substr($digits, 6);
    }
    return $phone;
}

/**
 * Return a bare phone number string safe for use in href="tel:".
 * e.g. '(555) 123-4567' → '+15551234567'
 */
function telHref(string $phone): string {
    $digits = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($digits) === 10) {
        return '+1' . $digits;
    }
    if (strlen($digits) === 11 && $digits[0] === '1') {
        return '+' . $digits;
    }
    return $phone;
}

/**
 * Convert a service name to a clean URL slug.
 * e.g. 'Roof Replacement' → 'roof-replacement'
 */
function getServiceSlug(string $name): string {
    $slug = strtolower(trim($name));
    $slug = preg_replace('/[^a-z0-9\s\-]/', '', $slug);
    $slug = preg_replace('/[\s\-]+/', '-', $slug);
    return trim($slug, '-');
}

/**
 * Convert a city name to a clean URL slug.
 * e.g. 'St. Louis' → 'st-louis'
 */
function getAreaSlug(string $city): string {
    $slug = strtolower(trim($city));
    $slug = preg_replace('/[^a-z0-9\s\-]/', '', $slug);
    $slug = preg_replace('/[\s\-]+/', '-', $slug);
    return trim($slug, '-');
}

/**
 * Generate a Service JSON-LD schema array for an individual service page.
 *
 * @param  array  $service  — ['name' => '', 'description' => '', ...]
 * @param  string $siteUrl  — base URL (from config $siteUrl)
 * @param  string $siteName — business name (from config $siteName)
 * @return array            — ready for json_encode()
 */
function generateServiceSchema(array $service, string $siteUrl = '', string $siteName = ''): array {
    return [
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        'name'        => $service['name'] ?? '',
        'description' => $service['description'] ?? '',
        'provider'    => [
            '@type' => 'RoofingContractor',
            'name'  => $siteName,
            'url'   => $siteUrl,
        ],
        'url'         => rtrim($siteUrl, '/') . '/services/' . getServiceSlug($service['name'] ?? ''),
        'areaServed'  => ['@type' => 'Country', 'name' => 'US'],
    ];
}

/**
 * Generate a FAQPage JSON-LD schema array.
 *
 * @param  array $faqs — [['question' => '...', 'answer' => '...'], ...]
 * @return array       — ready for json_encode()
 */
function generateFAQSchema(array $faqs): array {
    $items = [];
    foreach ($faqs as $faq) {
        if (empty($faq['question']) || empty($faq['answer'])) {
            continue;
        }
        $items[] = [
            '@type'          => 'Question',
            'name'           => $faq['question'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq['answer'],
            ],
        ];
    }
    return [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $items,
    ];
}

/**
 * Echo HTML meta tags for SEO — title, description, canonical.
 * Used for pages that build their own meta block outside head.php.
 */
function generateMetaTags(string $title, string $description, string $canonical): void {
    echo '<title>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</title>' . PHP_EOL;
    echo '<meta name="description" content="' . htmlspecialchars($description, ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
    echo '<link rel="canonical" href="' . htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
}

/**
 * Generate a BreadcrumbList JSON-LD schema array.
 *
 * @param  array  $items   — [['name' => '...', 'url' => '...'], ...]
 *                           Last item may omit 'url' (current page, no link needed)
 * @return array           — ready for json_encode()
 */
function generateBreadcrumbSchema(array $items): array {
    $listItems = [];
    foreach ($items as $i => $item) {
        $listItem = [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $item['name'],
        ];
        if (!empty($item['url'])) {
            $listItem['item'] = $item['url'];
        }
        $listItems[] = $listItem;
    }
    return [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $listItems,
    ];
}

/**
 * Generate a HowTo JSON-LD schema array.
 *
 * @param  string $name         — HowTo title (e.g. "How Roof Replacement Works")
 * @param  string $description  — Brief description of the process
 * @param  array  $steps        — [['name' => '...', 'text' => '...'], ...]
 * @return array                — ready for json_encode()
 */
function generateHowToSchema(string $name, string $description, array $steps): array {
    $howToSteps = [];
    foreach ($steps as $step) {
        $howToSteps[] = [
            '@type' => 'HowToStep',
            'name'  => $step['name'],
            'text'  => $step['text'],
        ];
    }
    return [
        '@context'    => 'https://schema.org',
        '@type'       => 'HowTo',
        'name'        => $name,
        'description' => $description,
        'step'        => $howToSteps,
    ];
}
