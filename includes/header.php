<?php
/**
 * header.php — Includes nav.php and opens the <main> content wrapper.
 *
 * Outputs:
 *   - Everything from includes/nav.php (skip link, navbar, mobile menu)
 *   - <main id="main-content">   ← page body wraps from here
 *
 * Expects config.php and functions.php to be loaded (head.php handles this).
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php';
?>

<main id="main-content">
