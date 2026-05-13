<?php
$page_title = 'Working Group — OpenChronology';
$page_desc  = 'The OpenChronology Working Group stewards the standard — managing the spec, reviewing proposals, and coordinating the open ecosystem.';
$page_url   = 'https://openchronology.org/working-group.php';
$active_nav = 'working-group';
include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';
?>


<!-- ═══ PAGE HEADER ═══════════════════════════════════════════════════════ -->
<header class="page-header">
  <div class="page-header-inner">
    <span class="page-eyebrow">Governance</span>
    <h1 class="page-title">The <em>Working Group</em></h1>
    <p class="page-lead">The OpenChronology Working Group stewards the standard &#8212; managing
      the specification, reviewing community proposals, and coordinating the open ecosystem.
      The standard is open; the process is transparent.</p>
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
        OpenChronology is currently in pre-release. The working group structure and formal
        governance process will be published here alongside the 1.0 release. In the meantime,
        the best way to get involved is through
        <a href="https://github.com/knoj/openchronology" target="_blank" rel="noopener">GitHub</a>.
      </div>
    </div>

  </section>


  <!-- ─── WHAT WILL BE HERE ─────────────────────────────────────────────── -->
  <section class="section" id="overview">

    <div class="section-label">What this page will contain</div>
    <h2 class="section-title" style="margin-top:0">Governance, process, and how to participate</h2>

    <div class="section-body">
      <p>OpenChronology is an open standard, not a product. No single company owns it. The
        Working Group exists to ensure the spec evolves deliberately &#8212; with backward
        compatibility, clear versioning, and genuine community input. When this page is complete,
        it will cover:</p>
    </div>

    <ul class="prose-list" style="margin-top:20px;">
      <li>
        <strong>Working Group members</strong> &#8212;
        who currently stewards the standard, their roles, and how new members are nominated.
      </li>
      <li>
        <strong>The proposal process</strong> &#8212;
        how to submit a change request or new feature proposal, the review stages, and what
        makes a proposal likely to be accepted.
      </li>
      <li>
        <strong>The versioning policy</strong> &#8212;
        how MINOR and MAJOR version bumps are decided, the backward-compatibility commitment,
        and how migration guides are published.
      </li>
      <li>
        <strong>Meeting notes and decisions</strong> &#8212;
        a public record of significant discussions and the reasoning behind spec decisions.
      </li>
      <li>
        <strong>Roadmap</strong> &#8212;
        planned features and open questions for future spec versions.
      </li>
    </ul>

  </section>


  <!-- ─── GET INVOLVED NOW ──────────────────────────────────────────────── -->
  <section class="section" id="get-involved">

    <div class="section-label">Get involved now</div>
    <h2 class="section-title" style="margin-top:0">The standard is built in the open</h2>

    <div class="section-body">
      <p>All spec work happens publicly on GitHub. You don&#8217;t need to wait for formal
        governance to participate &#8212; open an issue, start a discussion, or submit a pull
        request against the working repository.</p>
    </div>

    <ul class="prose-list" style="margin-top:20px;">
      <li>
        <strong><a href="https://github.com/knoj/openchronology/issues" target="_blank" rel="noopener">Open an issue</a></strong> &#8212;
        report an ambiguity in the spec, propose a new field, or flag a compatibility concern.
      </li>
      <li>
        <strong><a href="https://github.com/knoj/openchronology/discussions" target="_blank" rel="noopener">Start a discussion</a></strong> &#8212;
        broader questions about direction, use cases, or ecosystem fit.
      </li>
      <li>
        <strong><a href="/specification.php">Read the spec</a></strong> &#8212;
        the current normative definition of everything in the standard.
      </li>
      <li>
        <strong><a href="/libraries.php">Build an implementation</a></strong> &#8212;
        the fastest way to shape a standard is to implement it and report what breaks.
      </li>
    </ul>

    <div class="section-body" style="margin-top:36px;">
      <p>OpenChronology is anchored by the
        <a href="https://1000yearproject.org" target="_blank" rel="noopener">1000 Year Project</a>
        but designed for universal use &#8212; history, fiction, science, project management,
        or any domain that needs structured, portable chronological data. The Working Group
        welcomes participants from all of these communities.</p>
    </div>

  </section>


</main>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
