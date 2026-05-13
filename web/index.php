<?php
$page_title = 'OpenChronology, an open timeline and event standard — OpenChronology';
$page_desc  = 'OpenChronology is an open timeline and event standard supporting real-world time and location as well as fictional universes and calendars.';
$page_url   = 'https://openchronology.org/index.php';
$active_nav = '';
$page_head  = '
<style>

    /* ─── Shared section container ─────────── */
    .container {
      max-width: var(--wrap-wide);
      margin: 0 auto;
      padding: 0 var(--space-lg);
    }

    /* ─── Hero extras ──────────────────────── */
    .hero-statement {
      font-size: 16px;
      color: rgba(255,255,255,0.60);
      max-width: 560px;
      line-height: 1.72;
      margin-top: 14px;
      text-align: center;
    }
    .hero-statement strong { color: rgba(255,255,255,0.90); }

    /* ─── Timeline decoration ──────────────── */
    .hero-timeline-wrap {
      background: var(--navy-mid);
      border-top: 1px solid rgba(255,255,255,0.07);
      overflow-x: auto;
    }
    .hero-timeline {
      max-width: var(--wrap-wide);
      margin: 0 auto;
      padding: 22px var(--space-lg);
      display: flex;
      align-items: center;
      position: relative;
    }
    .hero-timeline::before {
      content: \'\';
      position: absolute;
      left: var(--space-lg); right: var(--space-lg);
      top: calc(50% + 4px);
      height: 1px;
      background: rgba(255,255,255,0.12);
      pointer-events: none;
    }
    .tl-item {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 9px;
      position: relative;
      z-index: 1;
    }
    .tl-label {
      font-family: var(--font-mono);
      font-size: 9.5px; letter-spacing: 0.04em;
      color: rgba(255,255,255,0.42);
      line-height: 1.45; text-align: center;
    }
    .tl-dot {
      width: 10px; height: 10px;
      border-radius: 50%;
      background: rgba(255,255,255,0.18);
      border: 2px solid rgba(255,255,255,0.38);
    }
    .tl-dot.active {
      background: #5aabef; border-color: #5aabef;
      box-shadow: 0 0 10px rgba(90,171,239,0.55);
    }
    .tl-dot.future {
      background: transparent;
      border-style: dashed; border-color: rgba(255,255,255,0.20);
    }

    /* ─── Insight band ─────────────────────── */
    .insight-band {
      background: var(--navy-mid);
      padding: 52px var(--space-lg);
    }
    .insight-band .container { text-align: center; }
    .insight-quote {
      font-family: var(--font-serif);
      font-size: clamp(16px, 2.2vw, 20px);
      font-weight: 300;
      color: rgba(255,255,255,0.78);
      line-height: 1.72;
      max-width: 760px;
      margin: 0 auto 12px;
    }
    .insight-quote em { font-style: italic; color: rgba(255,255,255,0.58); }
    .insight-source {
      font-family: var(--font-mono);
      font-size: 11px; letter-spacing: 0.1em;
      color: rgba(255,255,255,0.30);
    }

    /* ─── Section paddings ─────────────────── */
    .what    { padding: 80px var(--space-lg); background: var(--surface); }
    .usecases{ padding: 80px var(--space-lg); background: var(--surface-warm); }
    .formats { padding: 80px var(--space-lg); background: var(--surface); }
    .registry{ padding: 80px var(--space-lg); background: var(--surface-tinted); }
    .formats-intro, .registry-intro, .usecases-intro { margin-bottom: 36px; }

    /* ─── What section ─────────────────────── */
    .what-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px; margin-top: 32px;
      align-items: start;
    }
    .what-text p { color: var(--ink-mid); font-size: 15.5px; line-height: 1.78; margin-bottom: 14px; }
    .what-text p:last-child { margin-bottom: 0; }
    .what-pillars {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }
    .pillar {
      background: var(--surface-tinted);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      padding: 20px;
    }
    .pillar-label {
      font-family: var(--font-mono);
      font-size: 9.5px; letter-spacing: 0.15em;
      text-transform: uppercase; color: var(--blue);
      margin-bottom: 5px;
    }
    .pillar-title {
      font-family: var(--font-serif);
      font-size: 15px; font-weight: 400;
      color: var(--navy); margin-bottom: 7px; line-height: 1.3;
    }
    .pillar-desc { font-size: 13px; color: var(--ink-soft); line-height: 1.65; }

    /* ─── Use cases ────────────────────────── */
    .cases-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    .case-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      padding: 28px 24px;
      transition: box-shadow var(--transition), border-color var(--transition);
    }
    .case-card:hover { box-shadow: var(--shadow-md); border-color: var(--border-mid); }
    .case-icon {
      display: flex; align-items: center; justify-content: center;
      width: 44px; height: 44px;
      background: var(--blue-pale);
      border-radius: var(--radius-md);
      color: var(--navy-mid); margin-bottom: 16px;
    }
    .case-icon svg { width: 24px; height: 24px; }
    .case-title {
      font-family: var(--font-serif);
      font-size: 18px; font-weight: 400;
      color: var(--navy); margin-bottom: 10px;
    }
    .case-body {
      font-size: 14.5px; color: var(--ink-mid);
      line-height: 1.72; margin-bottom: 14px;
    }
    .case-example {
      font-family: var(--font-mono);
      font-size: 12px; color: var(--blue);
      background: var(--blue-ghost);
      border: 1px solid var(--blue-pale);
      border-radius: var(--radius-sm);
      padding: 8px 12px; line-height: 1.5;
    }

    /* ─── 1000 Year Project ────────────────── */
    .thousandyear {
      background: var(--navy);
      padding: 80px var(--space-lg);
      position: relative; overflow: hidden;
    }
    .thousandyear-bg {
      position: absolute; inset: 0;
      background: linear-gradient(135deg, #122a44 0%, var(--navy-mid) 100%);
      pointer-events: none;
    }
    .thousandyear .container { position: relative; z-index: 1; }
    .thousandyear-inner {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 64px; align-items: center;
    }
    .thousandyear-text .section-label { color: #5aabef; }
    .thousandyear-text .section-title { color: #fff; }
    .thousandyear-text p { color: rgba(255,255,255,0.66); }
    .thousandyear-text p strong { color: rgba(255,255,255,0.92); }
    .thousandyear-link {
      display: inline-flex; align-items: center; gap: 8px;
      margin-top: 20px;
      font-family: var(--font-mono); font-size: 11.5px;
      letter-spacing: 0.1em; text-transform: uppercase;
      color: #5aabef; text-decoration: none;
      border-bottom: 1px solid rgba(90,171,239,0.3); padding-bottom: 2px;
      transition: color var(--transition), border-color var(--transition);
    }
    .thousandyear-link:hover { color: #7fc4f8; border-color: rgba(90,171,239,0.6); }

    .thousandyear-visual { position: relative; padding-left: 28px; }
    .ty-timeline-line {
      position: absolute; left: 4px; top: 0; bottom: 0;
      width: 1px; background: rgba(255,255,255,0.12);
    }
    .ty-event {
      display: grid;
      grid-template-columns: 18px 1fr;
      gap: 0 16px; padding: 14px 0; position: relative;
    }
    .ty-dot {
      width: 18px; height: 18px; border-radius: 50%;
      background: rgba(255,255,255,0.07);
      border: 1.5px solid rgba(255,255,255,0.20);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0; margin-top: 2px;
      position: relative; z-index: 1;
      margin-left: -7px;
    }
    .ty-dot-inner { width: 6px; height: 6px; border-radius: 50%; background: rgba(255,255,255,0.32); }
    .ty-dot.highlight { background: rgba(90,171,239,0.2); border-color: #5aabef; }
    .ty-dot.highlight .ty-dot-inner { background: #5aabef; }
    .ty-dot.future { background: transparent; border-style: dashed; border-color: rgba(255,255,255,0.15); }
    .ty-dot.future .ty-dot-inner { background: rgba(255,255,255,0.10); }
    .ty-date {
      font-family: var(--font-mono);
      font-size: 10px; letter-spacing: 0.06em;
      color: rgba(255,255,255,0.36); margin-bottom: 2px;
    }
    .ty-label { font-size: 13px; font-weight: 500; color: rgba(255,255,255,0.80); margin-bottom: 2px; line-height: 1.3; }
    .ty-sub { font-size: 11.5px; color: rgba(255,255,255,0.36); line-height: 1.55; }

    /* ─── File formats ─────────────────────── */
    .ext {
      font-family: var(--font-mono);
      font-size: 12.5px; color: var(--blue); font-weight: 500;
    }
    .fmt-title { font-weight: 600; color: var(--navy); font-size: 13.5px; }

    /* ─── Schema Registry ──────────────────── */
    .registry-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px; margin-bottom: 28px;
    }
    .schema-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg); padding: 20px;
      transition: box-shadow var(--transition), border-color var(--transition);
    }
    .schema-card:hover { box-shadow: var(--shadow-md); border-color: var(--blue); }
    .schema-file {
      font-family: var(--font-mono);
      font-size: 11.5px; color: var(--blue);
      display: block; margin-bottom: 8px;
    }
    .schema-title { font-size: 14px; font-weight: 600; color: var(--navy); margin-bottom: 6px; }
    .schema-desc { font-size: 13px; color: var(--ink-soft); line-height: 1.6; margin-bottom: 0; }
    .registry-url {
      font-family: var(--font-mono);
      font-size: 13px; color: var(--blue);
      text-decoration: none;
      display: inline-flex; align-items: center; gap: 4px;
      border: 1px solid var(--blue-pale);
      background: var(--blue-ghost);
      padding: 9px 18px; border-radius: var(--radius-md);
      transition: background var(--transition), border-color var(--transition);
    }
    .registry-url:hover { background: var(--blue-pale); border-color: var(--blue); color: var(--navy); }
    .registry-url span { color: var(--navy); font-weight: 600; }

    /* ─── Status band ──────────────────────── */
    .status-band { background: var(--navy); padding: 60px var(--space-lg); }
    .status-inner {
      display: grid; grid-template-columns: repeat(3, 1fr);
      gap: 40px; text-align: center;
    }
    .stat-value {
      font-family: var(--font-serif);
      font-size: clamp(30px, 5vw, 52px);
      font-weight: 300; color: #fff;
      line-height: 1; margin-bottom: 10px;
    }
    .stat-label {
      font-size: 12px; font-weight: 600;
      color: rgba(255,255,255,0.52);
      letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 5px;
    }
    .stat-sub { font-size: 12px; color: rgba(255,255,255,0.28); }

    /* ─── Responsive ───────────────────────── */
    @media (max-width: 900px) {
      .what-grid { grid-template-columns: 1fr; gap: 40px; }
      .registry-grid { grid-template-columns: 1fr 1fr; }
      .thousandyear-inner { grid-template-columns: 1fr; gap: 48px; }
    }
    @media (max-width: 700px) {
      .what, .usecases, .formats, .registry, .thousandyear { padding: 56px var(--space-md); }
      .insight-band { padding: 40px var(--space-md); }
      .status-band  { padding: 44px var(--space-md); }
      .cases-grid   { grid-template-columns: 1fr; }
      .registry-grid{ grid-template-columns: 1fr; }
      .status-inner { grid-template-columns: 1fr; gap: 32px; }
      .thousandyear-visual { display: none; }
      .hero-statement { text-align: left; }
    }
    @media (max-width: 400px) {
      .what-pillars { grid-template-columns: 1fr; }
    }
</style>';
include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';
?>



  <!-- ── Hero ───────────────────────────────── -->
  <header class="page-header page-header--hero">
    <div class="page-header-inner">
      <span class="page-eyebrow animate-fade-up">Open Standard — Version 0.3</span>
      <h1 class="page-title animate-fade-up delay-1">
        One language<br>for <em>every</em> moment<br>in time.
      </h1>
      <p class="page-lead animate-fade-up delay-2">
        From the Magna Carta to the Age of Dragons.<br>
        From a soil sensor reading to the fall of Constantinople.
      </p>
      <p class="hero-statement animate-fade-up delay-3">
        <strong>OpenChronology</strong> is a platform-agnostic open standard for storing,
        sharing, and visualizing chronological data — across real history, fictional universes,
        scientific observation, and project management.
      </p>
      <div class="hero-actions animate-fade-up delay-4">
        <a href="specification.php" class="btn btn--blue">Read the Specification</a>
        <a href="https://schemas.openchronology.org" class="btn btn--secondary">Schema Registry</a>
        <a href="https://1000yearproject.org" class="btn btn--secondary">The 1000 Year Project</a>
      </div>
    </div>
  </header>

  <!-- ── Timeline decoration ────────────────── -->
  <div class="hero-timeline-wrap hide-mobile">
    <div class="hero-timeline">
      <div class="tl-item">
        <div class="tl-label">13.8 Ga<br>Big Bang</div>
        <div class="tl-dot"></div>
      </div>
      <div class="tl-item">
        <div class="tl-label">252 Ma<br>Permian Extinction</div>
        <div class="tl-dot"></div>
      </div>
      <div class="tl-item">
        <div class="tl-label">1215<br>Magna Carta</div>
        <div class="tl-dot"></div>
      </div>
      <div class="tl-item">
        <div class="tl-label">1453<br>Fall of Constantinople</div>
        <div class="tl-dot"></div>
      </div>
      <div class="tl-item">
        <div class="tl-label">2026<br>OpenChronology v0.3</div>
        <div class="tl-dot active"></div>
      </div>
      <div class="tl-item">
        <div class="tl-label">3026<br>Redwood falls</div>
        <div class="tl-dot future"></div>
      </div>
    </div>
  </div>

  <!-- ── Insight Band ──────────────────────── -->
  <div class="insight-band">
    <div class="container">
      <p class="insight-quote">
        A redwood alive today may have sprouted before the Magna Carta was signed.
        <em>Tracking it meaningfully requires a standard that can hold a daily humidity reading
        and a century of world history with equal precision.</em>
      </p>
      <p class="insight-source">— OpenChronology Specification, §1.3</p>
    </div>
  </div>

  <!-- ── What It Is ─────────────────────────── -->
  <section class="what" id="what">
    <div class="container">
      <span class="section-label">The Standard</span>
      <h2 class="section-title">What is OpenChronology?</h2>

      <div class="what-grid">
        <div class="what-text">
          <p>
            Existing timeline formats are built around a narrow assumption: that time is a single,
            agreed-upon Gregorian axis. <strong>OpenChronology rejects that assumption.</strong>
          </p>
          <p>
            Time is relative. A stardate is not a calendar date. A fantasy world's Third Age
            has no ISO 8601 equivalent. A project sprint doesn't care what century it falls in.
            A geologist measures in millions of years.
          </p>
          <p>
            OpenChronology treats time as a <strong>flexible variable</strong> — one that can represent
            absolute history, relative chronology, fictional universes, or deep geological time,
            all within the same portable file format.
          </p>
          <p>
            <strong>Universal portability is the primary goal:</strong> an event created in a
            project management app should be renderable in a historical visualization app without
            data loss. An event authored offline should work identically when published to the web.
          </p>
        </div>

        <div class="what-pillars">
          <div class="pillar">
            <div class="pillar-label">Absolute History</div>
            <div class="pillar-title">Strictly dated events</div>
            <div class="pillar-desc">Gregorian, Julian, Hebrew, Islamic, Chinese — any real-world calendar system, with full uncertainty modeling.</div>
          </div>
          <div class="pillar">
            <div class="pillar-label">Relative Time</div>
            <div class="pillar-title">Project &amp; media timelines</div>
            <div class="pillar-desc">Day 1, Day 5. 00:04:32 into a film. Sprint 3. Relative time without a calendar anchor.</div>
          </div>
          <div class="pillar">
            <div class="pillar-label">Fictional Universes</div>
            <div class="pillar-title">Custom calendar systems</div>
            <div class="pillar-desc">Stardates, Fantasy Epochs, Shire Reckoning. Define a universe once, reference it everywhere.</div>
          </div>
          <div class="pillar">
            <div class="pillar-label">Deep Time</div>
            <div class="pillar-title">Geologic &amp; cosmic scales</div>
            <div class="pillar-desc">Millions of years. Billions of years. Events that dwarf human history, expressed with the same precision.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── Use Cases ──────────────────────────── -->
  <section class="usecases" id="usecases">
    <div class="container">
      <div class="usecases-intro">
        <span class="section-label">Who It Serves</span>
        <h2 class="section-title">Built for every kind of storyteller.</h2>
        <p>The same standard serves radically different domains — because the underlying
           problem is always the same: events in time, connected by meaning.</p>
      </div>

      <div class="cases-grid">

        <div class="case-card">
          <span class="case-icon">
            <svg viewBox="0 0 36 36" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M18 10 C13 10 8 12 8 12 L8 27 C8 27 13 25 18 27 C23 25 28 27 28 27 L28 12 C28 12 23 10 18 10 Z"/>
              <line x1="18" y1="10" x2="18" y2="27"/>
              <line x1="11" y1="16" x2="16.5" y2="15.5" stroke-width="1" opacity="0.7"/>
              <line x1="11" y1="19" x2="16.5" y2="18.5" stroke-width="1" opacity="0.7"/>
              <line x1="11" y1="22" x2="16.5" y2="21.5" stroke-width="1" opacity="0.7"/>
              <line x1="19.5" y1="15.5" x2="25" y2="16" stroke-width="1" opacity="0.7"/>
              <line x1="19.5" y1="18.5" x2="25" y2="19" stroke-width="1" opacity="0.7"/>
              <line x1="19.5" y1="21.5" x2="25" y2="22" stroke-width="1" opacity="0.7"/>
              <line x1="18" y1="4" x2="18" y2="7.5"/>
              <line x1="15.2" y1="5.3" x2="17" y2="7.8"/>
              <line x1="20.8" y1="5.3" x2="19" y2="7.8"/>
            </svg>
          </span>
          <div class="case-title">World-Builders</div>
          <p class="case-body">Novelists, game designers, and screenwriters constructing fictional universes.
            Define a custom calendar once in a <code>.chroncal</code> file, then reference
            it across thousands of events. Work entirely offline, publish to the web when ready.</p>
          <div class="case-example">→ The Age of Dragons precedes The Council of Elrond by 3,000 years</div>
        </div>

        <div class="case-card">
          <span class="case-icon">
            <svg viewBox="0 0 36 36" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <line x1="9" y1="7" x2="27" y2="7"/>
              <line x1="9" y1="29" x2="27" y2="29"/>
              <path d="M9 7 L18 18 L27 7"/>
              <path d="M9 29 L18 18 L27 29"/>
              <path d="M12 26 Q18 23 24 26" stroke-width="1" opacity="0.6"/>
              <path d="M13.5 28 Q18 25.5 22.5 28" stroke-width="1" opacity="0.6"/>
              <circle cx="18" cy="18" r="1.2" fill="currentColor" stroke="none"/>
            </svg>
          </span>
          <div class="case-title">Historians &amp; Researchers</div>
          <p class="case-body">Scholars validating and annotating real-world events with full uncertainty modeling.
            Express that an event occurred <em>circa</em> 450 BCE ± 25 years with a confidence
            of 0.7 — and have that uncertainty be machine-readable.</p>
          <div class="case-example">→ Battle of the Catalaunian Plains, c. 451 CE ± 1 year</div>
        </div>

        <div class="case-card">
          <span class="case-icon">
            <svg viewBox="0 0 36 36" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <line x1="18" y1="30" x2="18" y2="19"/>
              <line x1="18" y1="22" x2="11" y2="18"/>
              <line x1="18" y1="22" x2="25" y2="18"/>
              <line x1="18" y1="19" x2="12" y2="14"/>
              <line x1="18" y1="19" x2="24" y2="14"/>
              <line x1="18" y1="16" x2="14" y2="11"/>
              <line x1="18" y1="16" x2="22" y2="11"/>
              <line x1="14" y1="11" x2="11" y2="7"/>
              <line x1="14" y1="11" x2="16" y2="7"/>
              <line x1="22" y1="11" x2="20" y2="7"/>
              <line x1="22" y1="11" x2="25" y2="7"/>
              <line x1="18" y1="13" x2="18" y2="6"/>
              <line x1="18" y1="30" x2="13" y2="33"/>
              <line x1="18" y1="30" x2="23" y2="33"/>
            </svg>
          </span>
          <div class="case-title">Scientists &amp; Naturalists</div>
          <p class="case-body">Environmental sensors, biological observations, and geological records spanning
            timescales from milliseconds to millennia. The founding anchor: a single redwood tree,
            documented across a thousand years.</p>
          <div class="case-example">→ Soil moisture: 34.2% — Tuesday, May 4, 2026, 06:14:22 UTC</div>
        </div>

        <div class="case-card">
          <span class="case-icon">
            <svg viewBox="0 0 36 36" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <line x1="8" y1="8" x2="8" y2="30" stroke-width="1" opacity="0.4"/>
              <line x1="8" y1="13" x2="28" y2="13"/>
              <circle cx="8"  cy="13" r="2" fill="currentColor" stroke="none"/>
              <circle cx="28" cy="13" r="2" fill="currentColor" stroke="none"/>
              <line x1="13" y1="20" x2="30" y2="20"/>
              <circle cx="13" cy="20" r="2" fill="currentColor" stroke="none"/>
              <circle cx="30" cy="20" r="2" fill="currentColor" stroke="none"/>
              <line x1="10" y1="27" x2="22" y2="27"/>
              <circle cx="10" cy="27" r="2" fill="currentColor" stroke="none"/>
              <circle cx="22" cy="27" r="2" fill="currentColor" stroke="none"/>
            </svg>
          </span>
          <div class="case-title">Project Managers</div>
          <p class="case-body">Sprint planning, product launches, and operational timelines in a portable, open format
            that outlasts any single tool. Relative time means no dependency on a specific calendar
            anchor — Day 1 is whenever you say it is.</p>
          <div class="case-example">→ Sprint 4 · Day 3 · Feature freeze milestone</div>
        </div>

      </div>
    </div>
  </section>

  <!-- ── 1000 Year Project ──────────────────── -->
  <section class="thousandyear" id="origin">
    <div class="thousandyear-bg"></div>
    <div class="container">
      <div class="thousandyear-inner">
        <div class="thousandyear-text">
          <span class="section-label">Founding Anchor</span>
          <h2 class="section-title">Born from a thousand-year tree.</h2>
          <p>OpenChronology was born from the <strong>1000 Year Project</strong> — an initiative
            to document the complete life of a redwood tree from the moment it sprouts to the day
            it falls, across a full millennium.</p>
          <p>Daily photography. Environmental sensor data. Eventually full lidar and photogrammetry
            scans. A redwood alive today may have sprouted before the Magna Carta was signed.</p>
          <p>Tracking it meaningfully requires a standard that can hold a daily humidity reading
            and a century of world history with equal precision. <strong>That standard is OpenChronology.</strong></p>
          <a href="https://1000yearproject.org" class="thousandyear-link">Visit 1000yearproject.org →</a>
        </div>

        <div class="thousandyear-visual">
          <div class="ty-timeline-line"></div>

          <div class="ty-event">
            <div class="ty-dot"><div class="ty-dot-inner"></div></div>
            <div class="ty-content">
              <div class="ty-date">c. 1215</div>
              <div class="ty-label">Magna Carta signed</div>
              <div class="ty-sub">A redwood sprouting today outlives this by 800 years</div>
            </div>
          </div>
          <div class="ty-event">
            <div class="ty-dot"><div class="ty-dot-inner"></div></div>
            <div class="ty-content">
              <div class="ty-date">c. 1500</div>
              <div class="ty-label">Age of Exploration begins</div>
              <div class="ty-sub">A living redwood remembers a world before the Americas were mapped</div>
            </div>
          </div>
          <div class="ty-event">
            <div class="ty-dot highlight"><div class="ty-dot-inner"></div></div>
            <div class="ty-content">
              <div class="ty-date">2026 — Now</div>
              <div class="ty-label">OpenChronology v0.3 released</div>
              <div class="ty-sub">The standard is built. The tree begins to be documented.</div>
            </div>
          </div>
          <div class="ty-event">
            <div class="ty-dot future"><div class="ty-dot-inner"></div></div>
            <div class="ty-content">
              <div class="ty-date">c. 3026</div>
              <div class="ty-label">The tree falls</div>
              <div class="ty-sub">A millennium of daily records, fully portable, fully open</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── File Family ────────────────────────── -->
  <section class="formats" id="formats">
    <div class="container">
      <div class="formats-intro">
        <span class="section-label">File Family</span>
        <h2 class="section-title">Five formats. One ecosystem.</h2>
        <p>OpenChronology follows a document-per-event architecture — each event is a standalone,
          independently citable file. Events are assembled into timelines by bundle packages
          or streaming feeds.</p>
      </div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Extension</th>
              <th>Format</th>
              <th>Contains</th>
              <th>Analogous to</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span class="ext">.chron</span></td>
              <td><div class="fmt-title">Event File</div></td>
              <td>A single event, era, or marker — with temporal, spatial, relational, and media data</td>
              <td>A Wikipedia article</td>
            </tr>
            <tr>
              <td><span class="ext">.chroncal</span></td>
              <td><div class="fmt-title">Calendar Definition</div></td>
              <td>A reusable calendar system — epoch, structure, month names, leap rules</td>
              <td>A shared stylesheet</td>
            </tr>
            <tr>
              <td><span class="ext">.chronverse</span></td>
              <td><div class="fmt-title">Universe Definition</div></td>
              <td>A universe definition — canon scopes, default calendar, temporal anchor</td>
              <td>A world-building bible entry</td>
            </tr>
            <tr>
              <td><span class="ext">.chronpkg</span></td>
              <td><div class="fmt-title">Bundle Package</div></td>
              <td>A ZIP collection of <code>.chron</code> files, assets, and definitions</td>
              <td>A book or anthology</td>
            </tr>
            <tr>
              <td><span class="ext">.chronstream</span></td>
              <td><div class="fmt-title">Streaming Feed</div></td>
              <td>A lightweight NDJSON event feed for APIs and large dataset export</td>
              <td>An RSS feed</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ── Schema Registry ────────────────────── -->
  <section class="registry" id="registry">
    <div class="container">
      <div class="registry-intro">
        <span class="section-label">Schema Registry</span>
        <h2 class="section-title">Machine-readable. Live now.</h2>
        <p>OpenChronology publishes JSON Schema (draft/2020-12) files for all formats.
          Reference them in your <code>.chron</code> files for validation tooling support.</p>
      </div>

      <div class="registry-grid">
        <div class="schema-card">
          <span class="schema-file">core.schema.json</span>
          <div class="schema-title">Core Event Schema</div>
          <p class="schema-desc">Minimum required structure for <code>.chron</code> files. The Tier 1 conformance floor.</p>
        </div>
        <div class="schema-card">
          <span class="schema-file">full.schema.json</span>
          <div class="schema-title">Full Event Schema</div>
          <p class="schema-desc">Complete <code>.chron</code> validation including all optional blocks. Tier 3 requirement.</p>
        </div>
        <div class="schema-card">
          <span class="schema-file">calendar.schema.json</span>
          <div class="schema-title">Calendar Schema</div>
          <p class="schema-desc">Validates standalone <code>.chroncal</code> calendar definition files.</p>
        </div>
        <div class="schema-card">
          <span class="schema-file">universe.schema.json</span>
          <div class="schema-title">Universe Schema</div>
          <p class="schema-desc">Validates standalone <code>.chronverse</code> universe definition files.</p>
        </div>
        <div class="schema-card">
          <span class="schema-file">manifest.schema.json</span>
          <div class="schema-title">Bundle Manifest Schema</div>
          <p class="schema-desc">Validates <code>manifest.json</code> inside <code>.chronpkg</code> archives.</p>
        </div>
        <div class="schema-card">
          <span class="schema-file">stream.schema.json</span>
          <div class="schema-title">Stream Header Schema</div>
          <p class="schema-desc">Validates the header record of <code>.chronstream</code> NDJSON feeds.</p>
        </div>
      </div>

      <a href="https://schemas.openchronology.org/v0.3/index.json" class="registry-url">
        <span>schemas.openchronology.org</span>/v0.3/index.json →
      </a>
    </div>
  </section>

  <!-- ── Status Band ────────────────────────── -->
  <div class="status-band">
    <div class="container">
      <div class="status-inner">
        <div class="stat-item">
          <div class="stat-value">0.3</div>
          <div class="stat-label">Current Version</div>
          <div class="stat-sub">Pre-Release Draft — May 2026</div>
        </div>
        <div class="stat-item">
          <div class="stat-value">6</div>
          <div class="stat-label">Published Schemas</div>
          <div class="stat-sub">Live at schemas.openchronology.org</div>
        </div>
        <div class="stat-item">
          <div class="stat-value">CC&#8209;BY</div>
          <div class="stat-label">License</div>
          <div class="stat-sub">Open standard, free to implement</div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Mobile nav toggle
    const toggle = document.querySelector('.nav-toggle');
    const links  = document.querySelector('.nav-links');
    if (toggle && links) {
      toggle.addEventListener('click', () => {
        const isOpen = links.classList.toggle('is-open');
        toggle.setAttribute('aria-expanded', String(isOpen));
      });
      document.addEventListener('click', (e) => {
        if (!e.target.closest('.site-nav')) {
          links.classList.remove('is-open');
          toggle.setAttribute('aria-expanded', 'false');
        }
      });
    }
  </script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
