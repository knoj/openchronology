<?php
$page_title = 'Libraries &amp; Implementations — OpenChronology';
$page_desc  = 'Community-built parsers, SDKs, and tools that implement the OpenChronology standard across every major programming language.';
$page_url   = 'https://openchronology.org/libraries.php';
$active_nav = 'libraries';
include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';
?>


<!-- ═══ PAGE HEADER ═══════════════════════════════════════════════════════ -->
<header class="page-header">
  <div class="page-header-inner">
    <span class="page-eyebrow">Ecosystem</span>
    <h1 class="page-title">Libraries &amp; <em>Implementations</em></h1>
    <p class="page-lead">Community-built parsers, SDKs, and tools that implement the OpenChronology
      standard across every major programming language. One format &#8212; every platform.</p>
  </div>
</header>


<!-- ═══ BODY ═══════════════════════════════════════════════════════════════ -->
<main class="page-body" id="main">


  <!-- ─── UNDER CONSTRUCTION CALLOUT ──────────────────────────────────── -->
  <section class="section" id="status">

    <div class="callout callout--note">
      <div class="callout-icon" aria-hidden="true">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <line x1="12" y1="8" x2="12" y2="12"/>
          <line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
      </div>
      <div>
        <strong>This page is coming soon.</strong>
        The OpenChronology standard is pre-release and the library ecosystem is just getting started.
        This page will be the living registry of community implementations as they appear.
        In the meantime, see the <a href="/specification.php">specification</a> or use
        <a href="https://chronology.studio" target="_blank" rel="noopener">Chronology Studio</a>
        as the reference JavaScript implementation.
      </div>
    </div>

  </section>


  <!-- ─── WHAT WILL BE HERE ─────────────────────────────────────────────── -->
  <section class="section" id="overview">

    <div class="section-label">What this page will contain</div>
    <h2 class="section-title" style="margin-top:0">A registry of implementations, organized by language</h2>

    <div class="section-body">
      <p>OpenChronology is language-agnostic by design. The format is a JSON document with a
        published schema — any language with a JSON library can implement a parser in an afternoon.
        This page will list every known implementation so developers can drop one into their project
        without starting from scratch.</p>
      <p>Listings will be tagged with capability badges so you can immediately see what each library
        supports:</p>
    </div>

    <div class="tag-grid" style="display:flex;flex-wrap:wrap;gap:10px;margin-top:28px;margin-bottom:36px;">
      <span class="code-tag"><code>parse</code> — Read and deserialize <code>.chron</code> files</span>
      <span class="code-tag"><code>validate</code> — Validate against the JSON Schema</span>
      <span class="code-tag"><code>create</code> — Programmatically generate events</span>
      <span class="code-tag"><code>calendar</code> — <code>.chroncal</code> support</span>
      <span class="code-tag"><code>universe</code> — <code>.chronverse</code> support</span>
      <span class="code-tag"><code>package</code> — Pack/unpack <code>.chronpkg</code> bundles</span>
      <span class="code-tag"><code>stream</code> — <code>.chronstream</code> feed support</span>
      <span class="code-tag"><code>render</code> — Timeline visualization</span>
    </div>

    <div class="section-body">
      <p>Languages planned for coverage: JavaScript / TypeScript, Python, Rust, Go, PHP, Ruby,
        Java / Kotlin, C# / .NET, Swift, Dart / Flutter, and others as the community grows.
        Each section will list official and community libraries with their spec version support,
        maintainer, and status (<em>Official</em>, <em>Community</em>, or <em>Experimental</em>).</p>
    </div>

  </section>


  <!-- ─── REFERENCE IMPLEMENTATION ─────────────────────────────────────── -->
  <section class="section" id="reference">

    <div class="section-label">Available now</div>
    <h2 class="section-title" style="margin-top:0">The reference implementation</h2>

    <div class="callout callout--reference" style="margin-top:0">
      <div class="callout-icon" aria-hidden="true">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="16 18 22 12 16 6"/>
          <polyline points="8 6 2 12 8 18"/>
        </svg>
      </div>
      <div>
        <strong>openchronology.js</strong> — JavaScript / Browser &amp; Node.js<br>
        <span style="opacity:0.8">The official reference parser, hosted at
        <a href="https://openchronology.org/src/openchronology.js" target="_blank" rel="noopener"><code>openchronology.org/src/openchronology.js</code></a>.
        ESM module. Covers <code>parse</code>, <code>validate</code>, <code>create</code>, and <code>render</code> (via
        <a href="https://chronology.studio" target="_blank" rel="noopener">Chronology Studio</a>).
        Spec v0.3. Maintained by the OpenChronology Working Group.</span>
      </div>
    </div>

  </section>


  <!-- ─── BUILD YOUR OWN ────────────────────────────────────────────────── -->
  <section class="section" id="build">

    <div class="section-label">For implementers</div>
    <h2 class="section-title" style="margin-top:0">Building a library?</h2>

    <div class="section-body">
      <p>Everything you need to write a conforming parser, validator, or creator is in the open:</p>
    </div>

    <ul class="prose-list" style="margin-top:20px;">
      <li>
        <strong><a href="/specification.php">The specification</a></strong> —
        normative definition of every field, every file type, and all conformance tiers.
      </li>
      <li>
        <strong><a href="https://schemas.openchronology.org" target="_blank" rel="noopener">The schema registry</a></strong> —
        machine-readable JSON Schemas for <code>.chron</code>, <code>.chroncal</code>,
        <code>.chronverse</code>, <code>.chronpkg</code>, and <code>.chronstream</code>.
      </li>
      <li>
        <strong><a href="/ai-guide.php">The AI Guide</a></strong> —
        paste a single context block into any AI assistant and bootstrap a working implementation
        in minutes.
      </li>
      <li>
        <strong><a href="https://openchronology.org/examples/events/" target="_blank" rel="noopener">Example <code>.chron</code> files</a></strong> —
        17 validated events you can use as test fixtures.
      </li>
    </ul>

    <div class="section-body" style="margin-top:36px;">
      <p>The minimum recommended implementation for a useful library is <code>parse</code> +
        <code>validate</code> + <code>create</code> for the base <code>.chron</code> event type.
        That alone covers the vast majority of use cases.</p>
      <p>To register your library for listing on this page, open a GitHub issue or pull request
        against <a href="https://github.com/knoj/openchronology" target="_blank" rel="noopener">github.com/knoj/openchronology</a>.
        There is no approval process — implementations that parse correctly and declare their
        supported spec version are listed.</p>
    </div>

  </section>


</main>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
