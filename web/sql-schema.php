<?php
$page_title = 'Advisory SQL Schema — OpenChronology Specification v0.3';
$page_desc  = 'Advisory SQL Schema for use in an OpenChronology implementation where .chron files are stored in a database.';
$page_url   = 'https://openchronology.org/sql-schema.php';
$active_nav = '';
$page_head  = '
<style>
    /* ─── Layout ──────────────────────────── */
    :root { --sidebar-w: 256px; }

    .page-layout {
      display: flex;
      max-width: 1400px;
      margin: 0 auto;
    }

    /* ─── Sidebar ─────────────────────────── */
    .sidebar {
      width: var(--sidebar-w);
      flex-shrink: 0;
      position: sticky;
      top: 54px;
      height: calc(100vh - 54px);
      overflow-y: auto;
      padding: 2.5rem 0 2rem 1.75rem;
      border-right: 1px solid var(--border);
      scrollbar-width: thin;
      scrollbar-color: var(--ink-faint) transparent;
    }
    .sidebar::-webkit-scrollbar { width: 3px; }
    .sidebar::-webkit-scrollbar-thumb { background: var(--ink-faint); border-radius: 2px; }

    .toc-header {
      font-family: var(--font-mono);
      font-size: 9.5px; letter-spacing: 0.2em;
      text-transform: uppercase; color: var(--ink-muted);
      margin-bottom: 1.2rem; padding-bottom: 0.6rem;
      border-bottom: 1px solid var(--border);
    }
    .toc-list { list-style: none; }
    .toc-list li { margin-bottom: 0.05rem; }
    .toc-list a {
      font-family: var(--font-mono);
      font-size: 11px; color: var(--ink-muted);
      display: block;
      padding: 0.28rem 0.5rem 0.28rem 0;
      border-left: 2px solid transparent;
      transition: color var(--transition), border-color var(--transition), padding var(--transition);
      line-height: 1.4; text-decoration: none;
    }
    .toc-list a:hover { color: var(--ink-mid); text-decoration: none; }
    .toc-list a.active {
      color: var(--blue);
      border-left-color: var(--blue);
      padding-left: 0.6rem;
    }
    .toc-divider {
      height: 1px; background: var(--border);
      margin: 0.7rem 0.5rem 0.7rem 0;
    }
    .toc-back {
      margin-top: 1.5rem; padding-top: 1.2rem;
      border-top: 1px solid var(--border);
    }
    .toc-back a {
      display: flex; align-items: center; gap: 0.4rem;
      font-family: var(--font-mono); font-size: 10.5px;
      color: var(--blue); text-decoration: none;
      transition: color var(--transition);
    }
    .toc-back a:hover { color: var(--navy); }

    /* ─── Main content ────────────────────── */
    .spec-content {
      flex: 1; min-width: 0;
      padding: 3rem 3.5rem 6rem 3rem;
      max-width: 860px;
    }

    /* ─── Title block ─────────────────────── */
    .spec-title-block {
      padding-bottom: 2.5rem; margin-bottom: 3rem;
      border-bottom: 2px solid var(--navy-pale);
    }
    .spec-eyebrow {
      font-family: var(--font-mono);
      font-size: 10px; letter-spacing: 0.2em;
      text-transform: uppercase; color: var(--blue);
      margin-bottom: 0.8rem;
      display: flex; align-items: center; gap: 0.6rem;
    }
    .spec-eyebrow::before { content: \'\'; width: 20px; height: 1px; background: var(--blue); }
    .spec-title {
      font-family: var(--font-serif);
      font-size: clamp(28px, 4vw, 40px);
      font-weight: 300; color: var(--navy);
      line-height: 1.1; margin-bottom: 0.5rem;
    }
    .non-normative {
      display: inline-flex; align-items: center;
      font-family: var(--font-mono); font-size: 10px;
      letter-spacing: 0.12em; text-transform: uppercase;
      color: var(--navy); border: 1px solid var(--navy-pale);
      background: var(--navy-ghost);
      padding: 0.25em 0.8em; border-radius: var(--radius-sm);
      margin-top: 0.8rem;
    }

    /* ─── Section headings ────────────────── */
    .spec-section {
      margin-bottom: 4rem;
      scroll-margin-top: 70px;
    }
    .sec-label {
      font-family: var(--font-mono);
      font-size: 9.5px; letter-spacing: 0.2em;
      text-transform: uppercase; color: var(--blue);
      margin-bottom: 0.5rem;
      display: flex; align-items: center; gap: 0.5rem;
    }
    .sec-label::before { content: \'\'; width: 16px; height: 1px; background: var(--blue); }
    h2.sec-title {
      font-family: var(--font-serif);
      font-size: clamp(22px, 3vw, 28px);
      font-weight: 400; color: var(--navy);
      line-height: 1.2; margin-bottom: 1rem;
      scroll-margin-top: 70px; margin-top: 0;
    }
    h3.sec-sub {
      font-family: var(--font-serif);
      font-size: clamp(17px, 2vw, 20px);
      font-weight: 400; color: var(--navy-mid);
      margin: 2.5rem 0 0.8rem;
      scroll-margin-top: 70px;
    }
    .sec-divider {
      height: 1px; background: var(--border);
      margin: 3.5rem 0;
    }

    /* ─── Code blocks ─────────────────────── */
    pre {
      background: var(--surface-tinted);
      border: 1px solid var(--border);
      border-left: 3px solid var(--navy-pale);
      padding: 1.3rem 1.5rem;
      overflow-x: auto;
      margin: 1rem 0 1.5rem;
      border-radius: 0 var(--radius-md) var(--radius-md) 0;
    }
    pre code {
      font-family: var(--font-mono);
      font-size: 12.5px; color: var(--ink-mid);
      background: none; padding: 0;
      line-height: 1.7;
    }
    .sql-comment { color: var(--ink-muted); font-style: italic; }
    .sql-keyword { color: var(--navy); font-weight: 600; }
    .sql-type    { color: var(--blue-dim); }

    /* ─── Spec page footer ────────────────── */
    .spec-footer {
      background: var(--navy);
      color: rgba(255,255,255,0.55);
      padding: 40px var(--space-lg);
    }
    .spec-footer-inner {
      max-width: 1400px; margin: 0 auto;
      display: flex; justify-content: space-between;
      align-items: center; flex-wrap: wrap; gap: 1rem;
    }
    .spec-footer-brand {
      font-family: var(--font-serif); font-size: 14px;
      color: rgba(255,255,255,0.75);
    }
    .spec-footer-links {
      display: flex; gap: 24px; list-style: none;
    }
    .spec-footer-links a {
      font-family: var(--font-mono); font-size: 11px;
      letter-spacing: 0.08em; text-transform: uppercase;
      color: rgba(255,255,255,0.45); text-decoration: none;
      transition: color var(--transition);
    }
    .spec-footer-links a:hover { color: rgba(255,255,255,0.85); }
    .spec-footer-meta {
      font-family: var(--font-mono); font-size: 10.5px;
      color: rgba(255,255,255,0.28);
    }

    /* ─── Responsive ──────────────────────── */
    @media (max-width: 900px) {
      .sidebar { display: none; }
      .spec-content { padding: 2rem 1.5rem 4rem; }
    }
    @media (max-width: 700px) {
      .spec-content { padding: 1.5rem var(--space-md) 4rem; }
    }
</style>';
include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';
?>

  <div class="page-layout">

    <!-- ── Sidebar TOC ───────────────────────── -->
    <nav class="sidebar" aria-label="Table of contents">
      <div class="toc-header">Contents</div>
      <ul class="toc-list" id="toc">
        <li><a href="#design" class="active">Design Principles</a></li>
        <div class="toc-divider"></div>
        <li><a href="#tables">Core Tables</a></li>
        <li><a href="#t-packages" style="padding-left:0.8rem; font-size:10.5px; color:var(--ink-faint);">packages</a></li>
        <li><a href="#t-events"   style="padding-left:0.8rem; font-size:10.5px; color:var(--ink-faint);">events</a></li>
        <li><a href="#t-relations" style="padding-left:0.8rem; font-size:10.5px; color:var(--ink-faint);">event_relations</a></li>
        <li><a href="#t-metrics"  style="padding-left:0.8rem; font-size:10.5px; color:var(--ink-faint);">event_metrics</a></li>
        <li><a href="#t-media"    style="padding-left:0.8rem; font-size:10.5px; color:var(--ink-faint);">event_media</a></li>
        <li><a href="#t-calendars" style="padding-left:0.8rem; font-size:10.5px; color:var(--ink-faint);">calendars</a></li>
        <li><a href="#t-universes" style="padding-left:0.8rem; font-size:10.5px; color:var(--ink-faint);">universes</a></li>
        <div class="toc-divider"></div>
        <li><a href="#queries">Example Queries</a></li>
      </ul>
      <div class="toc-back">
        <a href="specification.php">
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><polyline points="7,2 3,6 7,10"/></svg>
          Back to Specification
        </a>
      </div>
    </nav>

    <!-- ── Main content ──────────────────────── -->
    <main class="spec-content">

      <!-- Title block -->
      <div class="spec-title-block" id="top">
        <div class="spec-eyebrow">Appendix A · OpenChronology Specification v0.3</div>
        <h1 class="spec-title">Advisory SQL Schema</h1>
        <div class="non-normative">Non-Normative</div>
        <p style="margin-top:1.2rem; color:var(--ink-mid); line-height:1.7;">
          Implementations are free to store event data in any manner. This schema is provided as
          a reference for developers building relational database backends. Designed for SQLite,
          PostgreSQL, and MySQL compatibility. Nothing in this appendix is required for conformance.
        </p>
      </div>

      <!-- ── A.1 Design Principles ─────────────── -->
      <section class="spec-section" id="design">
        <div class="sec-label">A.1</div>
        <h2 class="sec-title">Design Principles</h2>
        <ul style="color:var(--ink-mid); line-height:1.8; padding-left:1.4rem;">
          <li style="margin-bottom:0.5rem;"><strong style="color:var(--ink);">Full fidelity</strong> — The complete event JSON blob is stored in a <code>data</code> column. Indexed columns are projections of frequently-queried fields, not the source of truth.</li>
          <li style="margin-bottom:0.5rem;"><strong style="color:var(--ink);">Normalization</strong> — Relations, metrics, and media are normalized into their own tables for efficient JOIN queries.</li>
          <li style="margin-bottom:0.5rem;"><strong style="color:var(--ink);">Dual temporal storage</strong> — Temporal values are stored as both their original calendar-native string (for faithful display) and as a resolved Unix timestamp (for range queries and sorting).</li>
          <li><strong style="color:var(--ink);">Tombstone retention</strong> — Tombstone records MUST be retained. Filter them with <code>WHERE type != 'tombstone'</code>. Never hard-delete them.</li>
        </ul>
      </section>

      <div class="sec-divider"></div>

      <!-- ── A.2 Core Tables ───────────────────── -->
      <section class="spec-section" id="tables">
        <div class="sec-label">A.2</div>
        <h2 class="sec-title">Core Tables</h2>

        <h3 class="sec-sub" id="t-packages">packages</h3>
        <p style="color:var(--ink-mid); line-height:1.7;">One row per <code>.chronpkg</code> bundle manifest. Events reference packages via <code>package_id</code>.</p>
        <pre><code><span class="sql-comment">-- Packages (from .chronpkg manifest)</span>
<span class="sql-keyword">CREATE TABLE</span> packages (
  id              <span class="sql-type">TEXT</span> <span class="sql-keyword">PRIMARY KEY</span>,   <span class="sql-comment">-- package_id from manifest</span>
  title           <span class="sql-type">TEXT</span> <span class="sql-keyword">NOT NULL</span>,
  schema_version  <span class="sql-type">TEXT</span> <span class="sql-keyword">NOT NULL</span>,
  meta            <span class="sql-type">JSON</span>,
  created_at      <span class="sql-type">TIMESTAMP</span>,
  updated_at      <span class="sql-type">TIMESTAMP</span>
);</code></pre>

        <h3 class="sec-sub" id="t-events">events</h3>
        <p style="color:var(--ink-mid); line-height:1.7;">One row per <code>.chron</code> file. The <code>data</code> column holds the complete original JSON for full fidelity. All other columns are indexed projections.</p>
        <pre><code><span class="sql-comment">-- Events (one row per .chron file)</span>
<span class="sql-keyword">CREATE TABLE</span> events (
  id                    <span class="sql-type">TEXT</span> <span class="sql-keyword">PRIMARY KEY</span>,   <span class="sql-comment">-- UUID-v4</span>
  package_id            <span class="sql-type">TEXT</span> <span class="sql-keyword">REFERENCES</span> packages(id),
  type                  <span class="sql-type">TEXT</span> <span class="sql-keyword">NOT NULL</span>
                          <span class="sql-keyword">CHECK</span> (type <span class="sql-keyword">IN</span> (<span class="sql-type">'event'</span>,<span class="sql-type">'era'</span>,<span class="sql-type">'marker'</span>,<span class="sql-type">'tombstone'</span>,<span class="sql-type">'deprecated'</span>)),
  original_type         <span class="sql-type">TEXT</span>
                          <span class="sql-keyword">CHECK</span> (original_type <span class="sql-keyword">IN</span> (<span class="sql-type">'event'</span>,<span class="sql-type">'era'</span>,<span class="sql-type">'marker'</span>,<span class="sql-keyword">NULL</span>)),
  title                 <span class="sql-type">TEXT</span>,
  universe              <span class="sql-type">TEXT</span>,
  calendar              <span class="sql-type">TEXT</span>,
  start_value           <span class="sql-type">TEXT</span>,
  end_value             <span class="sql-type">TEXT</span>,
  start_unix            <span class="sql-type">REAL</span>,              <span class="sql-comment">-- Resolved SI seconds</span>
  end_unix              <span class="sql-type">REAL</span>,
  precision             <span class="sql-type">TEXT</span>,
  significance_value    <span class="sql-type">INTEGER</span>,
  temporal_scope        <span class="sql-type">TEXT</span>,
  geographic_scope      <span class="sql-type">TEXT</span>,
  longitude             <span class="sql-type">REAL</span>,              <span class="sql-comment">-- GeoJSON order</span>
  latitude              <span class="sql-type">REAL</span>,
  altitude              <span class="sql-type">REAL</span>,
  canonical_url         <span class="sql-type">TEXT</span>,
  is_recurring          <span class="sql-type">BOOLEAN</span> <span class="sql-keyword">DEFAULT</span> <span class="sql-keyword">FALSE</span>,
  data                  <span class="sql-type">JSON</span> <span class="sql-keyword">NOT NULL</span>,
  created_at            <span class="sql-type">TIMESTAMP</span> <span class="sql-keyword">DEFAULT</span> CURRENT_TIMESTAMP,
  updated_at            <span class="sql-type">TIMESTAMP</span> <span class="sql-keyword">DEFAULT</span> CURRENT_TIMESTAMP
);

<span class="sql-keyword">CREATE INDEX</span> idx_events_package       <span class="sql-keyword">ON</span> events(package_id);
<span class="sql-keyword">CREATE INDEX</span> idx_events_type          <span class="sql-keyword">ON</span> events(type);
<span class="sql-keyword">CREATE INDEX</span> idx_events_start_unix    <span class="sql-keyword">ON</span> events(start_unix);
<span class="sql-keyword">CREATE INDEX</span> idx_events_temporal_scope <span class="sql-keyword">ON</span> events(temporal_scope);
<span class="sql-keyword">CREATE INDEX</span> idx_events_geo_scope     <span class="sql-keyword">ON</span> events(geographic_scope);
<span class="sql-keyword">CREATE INDEX</span> idx_events_sig_value     <span class="sql-keyword">ON</span> events(significance_value);</code></pre>

        <h3 class="sec-sub" id="t-relations">event_relations</h3>
        <p style="color:var(--ink-mid); line-height:1.7;">Normalized from the event's <code>relations</code> array. <code>target_event_id</code> may be NULL when only <code>target_url</code> is known (unresolved cross-file relation).</p>
        <pre><code><span class="sql-keyword">CREATE TABLE</span> event_relations (
  id              <span class="sql-type">INTEGER</span> <span class="sql-keyword">PRIMARY KEY AUTOINCREMENT</span>,
  source_event_id <span class="sql-type">TEXT</span> <span class="sql-keyword">NOT NULL REFERENCES</span> events(id),
  target_event_id <span class="sql-type">TEXT</span>,
  target_url      <span class="sql-type">TEXT</span>,
  relation_type   <span class="sql-type">TEXT</span> <span class="sql-keyword">NOT NULL</span>,
  canon_scope     <span class="sql-type">TEXT</span>,
  canon_status    <span class="sql-type">TEXT</span>,
  confidence      <span class="sql-type">REAL</span>,
  bidirectional   <span class="sql-type">BOOLEAN</span> <span class="sql-keyword">DEFAULT</span> <span class="sql-keyword">FALSE</span>,
  description     <span class="sql-type">TEXT</span>
);</code></pre>

        <h3 class="sec-sub" id="t-metrics">event_metrics</h3>
        <p style="color:var(--ink-mid); line-height:1.7;">Normalized from <code>significance.metrics[]</code>. Enables efficient per-domain significance queries.</p>
        <pre><code><span class="sql-keyword">CREATE TABLE</span> event_metrics (
  id           <span class="sql-type">INTEGER</span> <span class="sql-keyword">PRIMARY KEY AUTOINCREMENT</span>,
  event_id     <span class="sql-type">TEXT</span> <span class="sql-keyword">NOT NULL REFERENCES</span> events(id),
  metric_type  <span class="sql-type">TEXT</span> <span class="sql-keyword">NOT NULL</span>,
  metric_value <span class="sql-type">INTEGER</span> <span class="sql-keyword">NOT NULL</span>,
  description  <span class="sql-type">TEXT</span>
);</code></pre>

        <h3 class="sec-sub" id="t-media">event_media</h3>
        <p style="color:var(--ink-mid); line-height:1.7;">Normalized from the event's <code>media[]</code> array.</p>
        <pre><code><span class="sql-keyword">CREATE TABLE</span> event_media (
  id           <span class="sql-type">INTEGER</span> <span class="sql-keyword">PRIMARY KEY AUTOINCREMENT</span>,
  event_id     <span class="sql-type">TEXT</span> <span class="sql-keyword">NOT NULL REFERENCES</span> events(id),
  media_type   <span class="sql-type">TEXT</span> <span class="sql-keyword">NOT NULL</span>,
  url          <span class="sql-type">TEXT</span> <span class="sql-keyword">NOT NULL</span>,
  alt_text     <span class="sql-type">TEXT</span>,
  sync_enabled <span class="sql-type">BOOLEAN</span> <span class="sql-keyword">DEFAULT</span> <span class="sql-keyword">FALSE</span>
);</code></pre>

        <h3 class="sec-sub" id="t-calendars">calendars</h3>
        <p style="color:var(--ink-mid); line-height:1.7;">Resolved calendar definition cache. Populated on first fetch; updated when <code>canonical_url</code> returns a newer version.</p>
        <pre><code><span class="sql-keyword">CREATE TABLE</span> calendars (
  id              <span class="sql-type">TEXT</span> <span class="sql-keyword">PRIMARY KEY</span>,
  canonical_url   <span class="sql-type">TEXT</span>,
  display_name    <span class="sql-type">TEXT</span>,
  calendar_type   <span class="sql-type">TEXT</span> <span class="sql-keyword">NOT NULL CHECK</span> (calendar_type <span class="sql-keyword">IN</span> (<span class="sql-type">'builtin'</span>,<span class="sql-type">'custom'</span>)),
  structure_type  <span class="sql-type">TEXT</span> <span class="sql-keyword">CHECK</span> (structure_type <span class="sql-keyword">IN</span> (<span class="sql-type">'linear'</span>,<span class="sql-type">'cyclic'</span>,<span class="sql-keyword">NULL</span>)),
  definition      <span class="sql-type">JSON</span>,
  cached_at       <span class="sql-type">TIMESTAMP</span>
);</code></pre>

        <h3 class="sec-sub" id="t-universes">universes</h3>
        <p style="color:var(--ink-mid); line-height:1.7;">Resolved universe definition cache. The <code>canon_scopes</code> column holds the JSON array of valid scope objects for this universe.</p>
        <pre><code><span class="sql-keyword">CREATE TABLE</span> universes (
  id               <span class="sql-type">TEXT</span> <span class="sql-keyword">PRIMARY KEY</span>,
  canonical_url    <span class="sql-type">TEXT</span>,
  display_name     <span class="sql-type">TEXT</span>,
  universe_type    <span class="sql-type">TEXT</span> <span class="sql-keyword">NOT NULL CHECK</span> (universe_type <span class="sql-keyword">IN</span> (<span class="sql-type">'builtin'</span>,<span class="sql-type">'absolute'</span>,<span class="sql-type">'relative'</span>)),
  default_calendar <span class="sql-type">TEXT</span>,
  canon_scopes     <span class="sql-type">JSON</span>,
  definition       <span class="sql-type">JSON</span>,
  cached_at        <span class="sql-type">TIMESTAMP</span>
);</code></pre>
      </section>

      <div class="sec-divider"></div>

      <!-- ── A.3 Example Queries ────────────────── -->
      <section class="spec-section" id="queries">
        <div class="sec-label">A.3</div>
        <h2 class="sec-title">Example Queries</h2>

        <h3 class="sec-sub">Historical/global events by significance</h3>
        <pre><code><span class="sql-comment">-- Events visible at historical/global zoom, ordered by significance</span>
<span class="sql-keyword">SELECT</span> id, title, start_value, significance_value
<span class="sql-keyword">FROM</span> events
<span class="sql-keyword">WHERE</span> temporal_scope <span class="sql-keyword">IN</span> (<span class="sql-type">'epochal'</span>,<span class="sql-type">'millennial'</span>,<span class="sql-type">'centennial'</span>,<span class="sql-type">'generational'</span>)
  <span class="sql-keyword">AND</span> geographic_scope <span class="sql-keyword">IN</span> (<span class="sql-type">'global'</span>,<span class="sql-type">'continental'</span>)
  <span class="sql-keyword">AND</span> type != <span class="sql-type">'tombstone'</span>
<span class="sql-keyword">ORDER BY</span> significance_value <span class="sql-keyword">DESC</span>;</code></pre>

        <h3 class="sec-sub">Events in a geographic bounding box</h3>
        <pre><code><span class="sql-keyword">SELECT</span> id, title, longitude, latitude, significance_value
<span class="sql-keyword">FROM</span> events
<span class="sql-keyword">WHERE</span> longitude <span class="sql-keyword">BETWEEN</span> -74.01 <span class="sql-keyword">AND</span> -73.97
  <span class="sql-keyword">AND</span> latitude  <span class="sql-keyword">BETWEEN</span>  40.70 <span class="sql-keyword">AND</span>  40.75
  <span class="sql-keyword">AND</span> type != <span class="sql-type">'tombstone'</span>
  <span class="sql-keyword">AND</span> significance_value >= 300;</code></pre>

        <h3 class="sec-sub">All events causally connected to a given event</h3>
        <pre><code><span class="sql-keyword">SELECT</span> e.id, e.title, r.relation_type
<span class="sql-keyword">FROM</span> event_relations r
<span class="sql-keyword">JOIN</span> events e <span class="sql-keyword">ON</span> e.id = r.target_event_id
<span class="sql-keyword">WHERE</span> r.source_event_id = <span class="sql-type">'TARGET-UUID-HERE'</span>
  <span class="sql-keyword">AND</span> r.relation_type <span class="sql-keyword">IN</span> (<span class="sql-type">'causes'</span>,<span class="sql-type">'caused_by'</span>,<span class="sql-type">'influences'</span>,<span class="sql-type">'influenced_by'</span>);</code></pre>

        <h3 class="sec-sub">Tombstone-safe upsert respecting tombstone priority</h3>
        <p style="color:var(--ink-mid); line-height:1.7;">When ingesting events from a feed or merge operation, tombstone records must always win regardless of insert order.</p>
        <pre><code><span class="sql-keyword">INSERT INTO</span> events (id, type, data) <span class="sql-keyword">VALUES</span> (?, ?, ?)
<span class="sql-keyword">ON CONFLICT</span>(id) <span class="sql-keyword">DO UPDATE SET</span>
  type = <span class="sql-keyword">CASE</span>
    <span class="sql-keyword">WHEN</span> excluded.type = <span class="sql-type">'tombstone'</span> <span class="sql-keyword">THEN</span> <span class="sql-type">'tombstone'</span>
    <span class="sql-keyword">WHEN</span> events.type   = <span class="sql-type">'tombstone'</span> <span class="sql-keyword">THEN</span> <span class="sql-type">'tombstone'</span>
    <span class="sql-keyword">ELSE</span> excluded.type <span class="sql-keyword">END</span>,
  data = <span class="sql-keyword">CASE</span>
    <span class="sql-keyword">WHEN</span> excluded.type = <span class="sql-type">'tombstone'</span> <span class="sql-keyword">THEN</span> excluded.data
    <span class="sql-keyword">WHEN</span> events.type   = <span class="sql-type">'tombstone'</span> <span class="sql-keyword">THEN</span> events.data
    <span class="sql-keyword">ELSE</span> excluded.data <span class="sql-keyword">END</span>;</code></pre>

        <div class="callout callout--note">
          <div class="callout-icon">ℹ</div>
          <div class="callout-body"><strong>Tombstone Rule</strong> — The CASE logic above implements the tombstone priority rule: once a row is marked as a tombstone, no subsequent insert or update may overwrite it with a non-tombstone record. This mirrors the normative requirement in §6.10 and §7.1.</div>
        </div>
      </section>

    </main>
  </div>

  <script>

    // TOC active link via IntersectionObserver
    const sections = document.querySelectorAll('[id]');
    const tocLinks  = document.querySelectorAll('#toc a');
    const observer  = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          tocLinks.forEach(l => l.classList.remove('active'));
          const active = document.querySelector(`#toc a[href="#${entry.target.id}"]`);
          if (active) active.classList.add('active');
        }
      });
    }, { rootMargin: '-54px 0px -60% 0px' });
    sections.forEach(s => observer.observe(s));
  </script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
