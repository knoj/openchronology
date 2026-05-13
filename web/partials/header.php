<?php
/**
 * OpenChronology.org — shared header partial
 *
 * Required variables (set before including this file):
 *   $page_title  — full <title> string, e.g. "Specification — OpenChronology"
 *   $page_desc   — meta description and og:description
 *   $page_url    — canonical URL, e.g. "https://openchronology.org/specification.php"
 *
 * Optional variables:
 *   $active_nav  — nav key to mark as active:
 *                  'specification' | 'libraries' | 'working-group' | 'ai-guide'
 *                  (external links and brand are never marked active)
 *   $page_head   — raw HTML injected inside <head> before </head>
 *                  (use for page-specific <style> blocks or preloads)
 *
 * Usage:
 *   <?php
 *   $page_title = 'Specification — OpenChronology';
 *   $page_desc  = 'The full OpenChronology specification.';
 *   $page_url   = 'https://openchronology.org/specification.php';
 *   $active_nav = 'specification';
 *   $page_head  = '<style>/* page-specific CSS *\/</style>';  // optional
 *   include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';
 *   ?>
 */

$active_nav = $active_nav ?? '';
$page_head  = $page_head  ?? '';

// Determine active class for each nav item
function _oc_nav_class(string $key, string $active): string {
    return $key === $active ? ' class="nav-active"' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($page_desc) ?>">
<meta property="og:title"       content="<?= htmlspecialchars($page_title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($page_desc) ?>">
<meta property="og:url"         content="<?= htmlspecialchars($page_url) ?>">
<meta property="og:type"        content="website">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,300;0,8..60,400;0,8..60,600;1,8..60,300;1,8..60,400&family=DM+Sans:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/style.css">
<?= $page_head ?>
</head>
<body>

<!-- ═══ NAV ═══════════════════════════════════════════════════════════════ -->
<nav class="site-nav" aria-label="Site navigation">
  <div class="nav-inner">
    <a href="/" class="nav-brand">
      <span class="nav-brand-dot" aria-hidden="true"></span>
      OpenChronology
    </a>
    <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
        <line x1="3" y1="6"  x2="21" y2="6"/>
        <line x1="3" y1="12" x2="21" y2="12"/>
        <line x1="3" y1="18" x2="21" y2="18"/>
      </svg>
    </button>
    <ul class="nav-links" id="navLinks">
      <li><a href="/specification.php"<?= _oc_nav_class('specification', $active_nav) ?>>Specification</a></li>
      <li><a href="https://schemas.openchronology.org" target="_blank" rel="noopener">Schemas</a></li>
      <li><a href="/libraries.php"<?= _oc_nav_class('libraries', $active_nav) ?>>Libraries</a></li>
      <li><a href="/working-group.php"<?= _oc_nav_class('working-group', $active_nav) ?>>Working Group</a></li>
      <li><a href="/ai-guide.php"<?= _oc_nav_class('ai-guide', $active_nav) ?>>AI Guide</a></li>
      <li><a href="https://chronology.studio" target="_blank" rel="noopener" class="nav-studio-link">Chronology Studio &#8594;</a></li>
    </ul>
  </div>
</nav>
