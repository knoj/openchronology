<?php
$page_title = 'AI Use Guide — OpenChronology';
$page_desc  = 'Guide to providing your AI with the prompts to implement the OpenChronology standard in your site or application.';
$page_url   = 'https://openchronology.org/ai-guide.php';
$active_nav = 'ai-guide';
include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';
?>


<!-- ═══ PAGE HEADER ═══════════════════════════════════════════════════════ -->
<header class="page-header">
  <div class="page-header-inner">
    <span class="page-eyebrow">Guide</span>
    <h1 class="page-title">What to Give Your <em>AI&nbsp;Chatbot</em></h1>
    <p class="page-lead">A single context block you paste into any AI assistant &#8212; ChatGPT, Claude,
      Gemini, or others &#8212; to instantly create structured timeline data or build a working
      timeline viewer for your own website. No schema knowledge required.</p>
  </div>
</header>


<!-- ═══ BODY ═══════════════════════════════════════════════════════════════ -->
<main class="page-body" id="main">


  <!-- ─── CHOOSE YOUR PATH ─────────────────────────────────────────────── -->
  <section class="section" id="choose-path">

    <div class="section-label">What this page helps you do</div>
    <h2 class="section-title" style="margin-top:0">Two things you can build with AI</h2>
    <div class="section-body">
      <p>OpenChronology is a format for storing and sharing time-based data as portable
         <code>.chron</code> files. AI chatbots don&#8217;t know this format by default &#8212;
         but a single copied block of text is all they need. There are two things people
         typically want to accomplish:</p>
    </div>

    <div class="path-grid">
      <div class="path-card">
        <div class="path-card-icon" aria-hidden="true">&#128193;</div>
        <h3 class="path-card-title">Generate <code>.chron</code> event files</h3>
        <p class="path-card-desc">You have a topic &#8212; a period of history, a fictional world,
          a project plan, a family archive &#8212; and you want to produce structured,
          timeline-ready <code>.chron</code> files you can load into any OpenChronology
          viewer or tool.</p>
        <span class="path-card-anchor">&#8594; Jump to file prompts</span>
      </div>

      <div class="path-card">
        <div class="path-card-icon" aria-hidden="true">&#128187;</div>
        <h3 class="path-card-title">Build a timeline viewer</h3>
        <p class="path-card-desc">You want to embed a timeline on your own website or app &#8212;
          something that reads <code>.chron</code> files and renders them.
          The AI can write complete viewer code for you, ready to publish to your site.</p>
        <span class="path-card-anchor">&#8594; Jump to viewer prompts</span>
      </div>
    </div>

    <!-- ── SVG: Example timeline ──────────────────────────────────────── -->
    <div style="margin-top:36px">
      <p style="font-family:var(--font-mono);font-size:10px;letter-spacing:0.1em;text-transform:uppercase;color:var(--ink-muted);margin-bottom:12px;">
        What a rendered timeline looks like &#8212; events from .chron files
      </p>
      <div style="background:var(--surface-warm);border:1px solid var(--border);border-radius:12px;padding:28px 20px 20px;overflow:hidden;">
        <svg viewBox="0 0 760 210" xmlns="http://www.w3.org/2000/svg" role="img"
             aria-label="Example timeline showing events at different significance levels and a shaded era span"
             style="width:100%;display:block;max-width:760px;margin:0 auto;">
          <defs>
            <linearGradient id="g1" x1="0%" y1="0%" x2="100%" y2="0%">
              <stop offset="0%"   stop-color="#2e6fac" stop-opacity="0"/>
              <stop offset="8%"   stop-color="#2e6fac" stop-opacity="0.08"/>
              <stop offset="92%"  stop-color="#2e6fac" stop-opacity="0.08"/>
              <stop offset="100%" stop-color="#2e6fac" stop-opacity="0"/>
            </linearGradient>
          </defs>

          <!-- Era band -->
          <rect x="56" y="100" width="390" height="24" rx="3"
                fill="url(#g1)" stroke="#2e6fac" stroke-width="0.5" stroke-opacity="0.35"/>
          <text x="64" y="116" font-family="'DM Sans',sans-serif" font-size="9" fill="#2e6fac" opacity="0.65">era — 1789–1900</text>

          <!-- Axis -->
          <line x1="28" y1="124" x2="732" y2="124" stroke="#bec8da" stroke-width="1.5"/>
          <polyline points="24,120 28,124 24,128" fill="none" stroke="#bec8da" stroke-width="1.5" stroke-linejoin="round"/>
          <polyline points="736,120 732,124 736,128" fill="none" stroke="#bec8da" stroke-width="1.5" stroke-linejoin="round"/>

          <!-- Tick marks -->
          <line x1="56"  y1="120" x2="56"  y2="129" stroke="#bec8da" stroke-width="1"/>
          <line x1="156" y1="120" x2="156" y2="129" stroke="#bec8da" stroke-width="1"/>
          <line x1="260" y1="120" x2="260" y2="129" stroke="#bec8da" stroke-width="1"/>
          <line x1="370" y1="120" x2="370" y2="129" stroke="#bec8da" stroke-width="1"/>
          <line x1="446" y1="120" x2="446" y2="129" stroke="#bec8da" stroke-width="1"/>
          <line x1="560" y1="120" x2="560" y2="129" stroke="#bec8da" stroke-width="1"/>
          <line x1="674" y1="120" x2="674" y2="129" stroke="#bec8da" stroke-width="1"/>

          <!-- Date labels -->
          <text x="56"  y="143" text-anchor="middle" font-family="'JetBrains Mono',monospace" font-size="9" fill="#8a96a8">1789</text>
          <text x="156" y="143" text-anchor="middle" font-family="'JetBrains Mono',monospace" font-size="9" fill="#8a96a8">1820</text>
          <text x="260" y="143" text-anchor="middle" font-family="'JetBrains Mono',monospace" font-size="9" fill="#8a96a8">1850</text>
          <text x="370" y="143" text-anchor="middle" font-family="'JetBrains Mono',monospace" font-size="9" fill="#8a96a8">1880</text>
          <text x="446" y="143" text-anchor="middle" font-family="'JetBrains Mono',monospace" font-size="9" fill="#8a96a8">1900</text>
          <text x="560" y="143" text-anchor="middle" font-family="'JetBrains Mono',monospace" font-size="9" fill="#8a96a8">1930</text>
          <text x="674" y="143" text-anchor="middle" font-family="'JetBrains Mono',monospace" font-size="9" fill="#8a96a8">1960</text>

          <!-- Event 1: French Revolution — above, sig 900 -->
          <line x1="56" y1="124" x2="56" y2="56" stroke="#1a3a5c" stroke-width="1.5"/>
          <circle cx="56" cy="124" r="6.5" fill="#1a3a5c"/>
          <circle cx="56" cy="124" r="3"   fill="#fff"/>
          <text x="56" y="48"  text-anchor="middle" font-family="'Source Serif 4',serif" font-size="10.5" fill="#1a3a5c" font-style="italic">French Revolution</text>
          <text x="56" y="59"  text-anchor="middle" font-family="'JetBrains Mono',monospace" font-size="8" fill="#5a6478">sig 900</text>

          <!-- Event 2: Napoleonic Wars — below, sig 800 -->
          <line x1="96" y1="124" x2="96" y2="170" stroke="#2a5080" stroke-width="1.5"/>
          <circle cx="96" cy="124" r="5.5" fill="#2a5080"/>
          <circle cx="96" cy="124" r="2.5" fill="#fff"/>
          <text x="96" y="182" text-anchor="middle" font-family="'Source Serif 4',serif" font-size="10.5" fill="#2a5080" font-style="italic">Napoleonic Wars</text>
          <text x="96" y="192" text-anchor="middle" font-family="'JetBrains Mono',monospace" font-size="8" fill="#8a96a8">sig 800</text>

          <!-- Event 3: Great Exhibition — above, sig 500 -->
          <line x1="238" y1="124" x2="238" y2="74" stroke="#2e6fac" stroke-width="1.2"/>
          <circle cx="238" cy="124" r="4.5" fill="#2e6fac"/>
          <circle cx="238" cy="124" r="2"   fill="#fff"/>
          <text x="238" y="66"  text-anchor="middle" font-family="'Source Serif 4',serif" font-size="10.5" fill="#2e6fac" font-style="italic">Great Exhibition</text>
          <text x="238" y="77"  text-anchor="middle" font-family="'JetBrains Mono',monospace" font-size="8" fill="#8a96a8">sig 500</text>

          <!-- Event 4: Origin of Species — below, sig 700 -->
          <line x1="306" y1="124" x2="306" y2="170" stroke="#1e5090" stroke-width="1.2"/>
          <circle cx="306" cy="124" r="5" fill="#1e5090"/>
          <circle cx="306" cy="124" r="2.5" fill="#fff"/>
          <text x="314" y="180" text-anchor="start"  font-family="'Source Serif 4',serif" font-size="10.5" fill="#1e5090" font-style="italic">Origin of Species</text>
          <text x="306" y="191" text-anchor="middle" font-family="'JetBrains Mono',monospace" font-size="8" fill="#8a96a8">sig 700</text>

          <!-- Event 5: WWI — above, sig 950 -->
          <line x1="490" y1="124" x2="490" y2="50" stroke="#1a3a5c" stroke-width="1.8"/>
          <circle cx="490" cy="124" r="7"   fill="#1a3a5c"/>
          <circle cx="490" cy="124" r="3.5" fill="#fff"/>
          <text x="490" y="42"  text-anchor="middle" font-family="'Source Serif 4',serif" font-size="10.5" fill="#1a3a5c" font-style="italic">World War I</text>
          <text x="490" y="53"  text-anchor="middle" font-family="'JetBrains Mono',monospace" font-size="8" fill="#5a6478">sig 950</text>

          <!-- Event 6: Moon Landing — below, sig 970 -->
          <line x1="674" y1="124" x2="674" y2="172" stroke="#1a3a5c" stroke-width="1.8"/>
          <circle cx="674" cy="124" r="7.5" fill="#1a3a5c"/>
          <circle cx="674" cy="124" r="3.5" fill="#fff"/>
          <text x="674" y="184" text-anchor="middle" font-family="'Source Serif 4',serif" font-size="10.5" fill="#1a3a5c" font-style="italic">Moon Landing</text>
          <text x="674" y="195" text-anchor="middle" font-family="'JetBrains Mono',monospace" font-size="8" fill="#5a6478">sig 970</text>

          <!-- Legend -->
          <circle cx="36"  cy="164" r="7"   fill="#1a3a5c"/>
          <text   x="48"  y="168" font-family="'DM Sans',sans-serif" font-size="9" fill="#8a96a8">high significance</text>
          <circle cx="140" cy="164" r="4.5" fill="#2e6fac"/>
          <text   x="150" y="168" font-family="'DM Sans',sans-serif" font-size="9" fill="#8a96a8">medium</text>
          <rect   x="204" y="159" width="20" height="9" rx="2"
                  fill="#2e6fac" fill-opacity="0.1" stroke="#2e6fac" stroke-width="0.5" stroke-opacity="0.4"/>
          <text   x="229" y="168" font-family="'DM Sans',sans-serif" font-size="9" fill="#8a96a8">era / span</text>
        </svg>
      </div>
    </div>

  </section>


  <hr class="divider">


  <!-- ─── THE CONTEXT BLOCK ─────────────────────────────────────────────── -->
  <section class="section" style="margin-top:64px" id="context-block">
    <div class="section-label">Step 1 — The Context Block</div>
    <h2 class="section-title" style="margin-top:0">Copy this. Paste it first.</h2>
    <div class="section-body">
      <p>This block primes your AI with everything it needs to know about the OpenChronology format.
         Paste it at the start of any new conversation, before your actual request.
         It works for both paths &#8212; generating event files <em>and</em> building viewers.</p>
    </div>

    <div class="context-block-wrap" aria-labelledby="cb-title">
      <div class="context-block-header">
        <div>
          <div class="context-block-title" id="cb-title">OpenChronology v0.3 &#8212; AI Context Block</div>
          <div class="context-block-meta">~700 tokens &nbsp;&#183;&nbsp; Works with ChatGPT, Claude, Gemini, and others</div>
        </div>
        <button class="copy-btn" id="copyBtn" onclick="copyContextBlock()" aria-label="Copy context block to clipboard">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
          </svg>
          <span id="copyBtnText">Copy to clipboard</span>
        </button>
      </div>
      <textarea class="context-block-text" id="contextBlock" readonly spellcheck="false"
                aria-label="OpenChronology AI context block — select all and copy, or use the button above">You are helping create OpenChronology .chron files — an open standard for portable chronological data.

WHAT IS A .chron FILE
Each .chron file stores exactly one event as JSON with a .chron extension.
One event = one file. Files are self-contained and independently citable.

MINIMUM VALID FILE  (only 3 fields are required)
{
  "meta": { "schema_version": "0.3" },
  "event": {
    "id": "550e8400-e29b-41d4-a716-446655440000",
    "content": { "title": "Name of the event" }
  }
}

RULES
- schema_version is always "0.3"
- event.id must be a UUID v4 — generate a fresh, unique one per file
- event.content.title is the only other required field
- All other fields are optional
- Use kebab-case filenames with .chron extension  (e.g. battle-of-hastings.chron)

FULL FIELD REFERENCE

meta:
  schema_version    "0.3"  (required)
  author            "Name" or ["Name1", "Name2"]
  license           "CC-BY-4.0" or other SPDX identifier
  canonical_url     full URL if hosted

event:
  id                UUID v4 string  (required)
  type              "event" | "era" | "milestone" | "record" | "note"  (default: "event")

  content:          (required)
    title           string  (required)
    description     string — narrative text about the event
    description_format  "plain" | "markdown" | "html"  (default: "plain")
    date_label      string — human-readable date for display, e.g. "July 20, 1969"
    tags            ["tag1", "tag2", ...]
    sources         [ { "title": "Source Name", "url": "https://...", "type": "web" } ]
                    source type options: "primary" | "secondary" | "web" | "academic" | "archive"

  temporal:         (include for any dated event)
    start_value     ISO 8601 string: "1969-07-20" or "1969-07-20T20:17:40Z"
                    BCE dates use negative years: "-0044-03-15" = March 15, 44 BC
    end_value       end date for eras or periods (same format as start_value)
    precision       "millisecond" | "second" | "minute" | "hour" | "day" | "month" |
                    "year" | "decade" | "century" | "millennium" | "epoch" | "circa"
    calendar        "gregorian" (default) | "julian" | "islamic" | "hebrew" | "chinese"
    uncertainty     { "type": "range", "margin_value": 50, "margin_unit": "year" }
                    uncertainty type: "range" | "before" | "after" | "no_earlier_than" | "no_later_than"

  spatial:          (include for events with a location)
    body            "earth" (default) | "moon" | "mars" | "venus" | "mercury" | "sun"
                    Use any string for fictional worlds or custom locations
    geometry        { "type": "Point", "coordinates": [longitude, latitude] }
    region          { "name": "Region Name", "admin_level": "country" }

  significance:     (optional — helps timeline viewers prioritize events)
    value           0–1000  (0 = trivial, 500 = notable, 1000 = civilizational)
    temporal_scope  "epochal" | "millennial" | "centennial" | "generational" | "decadal" |
                    "annual" | "seasonal" | "monthly" | "weekly" | "daily" | "hourly"
    geographic_scope "global" | "continental" | "national" | "regional" | "local" | "street"

WORKED EXAMPLE
{
  "meta": {
    "schema_version": "0.3",
    "author": "Your Name",
    "license": "CC-BY-4.0"
  },
  "event": {
    "id": "7c9e6679-7425-40de-944b-e07fc1f90ae7",
    "type": "milestone",
    "content": {
      "title": "Apollo 11 Moon Landing",
      "description": "Neil Armstrong and Buzz Aldrin became the first humans to walk on the Moon.",
      "date_label": "July 20, 1969",
      "tags": ["space", "nasa", "moon", "cold-war"],
      "sources": [
        {
          "title": "NASA Apollo 11 Mission",
          "url": "https://www.nasa.gov/mission_pages/apollo/apollo-11.html",
          "type": "web"
        }
      ]
    },
    "temporal": {
      "start_value": "1969-07-20T20:17:40Z",
      "precision": "second",
      "calendar": "gregorian"
    },
    "spatial": {
      "body": "moon",
      "region": { "name": "Sea of Tranquility" }
    },
    "significance": {
      "value": 950,
      "temporal_scope": "epochal",
      "geographic_scope": "global"
    }
  }
}

VALIDATION AND TOOLS
- Validate files:  https://chronology.studio/tools/validator.html
- Visualize files: https://chronology.studio/tools/timeline-viewer/
- Author files:    https://chronology.studio/tools/event-author.html
- Full spec:       https://openchronology.org/specification.html
- Reference parser (ESM, browser-ready): https://openchronology.org/src/openchronology.js</textarea>
      <div class="context-block-footer">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--ink-muted);flex-shrink:0" aria-hidden="true">
          <circle cx="12" cy="12" r="10"/>
          <line x1="12" y1="8" x2="12" y2="12"/>
          <line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        <p class="context-block-footer-note">
          <strong>Free to use and share.</strong>
          Published under CC-BY-4.0. Embed it in your own tools, guides, or prompts without attribution.
        </p>
      </div>
    </div>
  </section>


  <hr class="divider">


  <!-- ─── HOW TO USE ───────────────────────────────────────────────────── -->
  <section class="section" style="margin-top:64px" id="how-to-use">
    <div class="section-label">Step 2 — Using It</div>
    <h2 class="section-title" style="margin-top:0">Three steps to get started</h2>
    <div class="section-body">
      <p>Works with any AI assistant that accepts a free-text prompt.
         No account, API key, or technical knowledge required.</p>
    </div>
    <div class="steps">
      <div class="step">
        <div class="step-num" aria-hidden="true">1</div>
        <div class="step-body">
          <div class="step-title">Open a new conversation in your AI chatbot</div>
          <p class="step-desc">Start fresh &#8212; any conversational AI works.
            A new chat ensures nothing interferes with the context you&#8217;re about to provide.</p>
        </div>
      </div>
      <div class="step">
        <div class="step-num" aria-hidden="true">2</div>
        <div class="step-body">
          <div class="step-title">Paste the context block as your first message</div>
          <p class="step-desc">Copy the entire block above and send it on its own before anything else.
            You can optionally end it with:
            <code>Confirm you understand this format and are ready to help.</code>
            The AI will acknowledge it.</p>
        </div>
      </div>
      <div class="step">
        <div class="step-num" aria-hidden="true">3</div>
        <div class="step-body">
          <div class="step-title">Make your request &#8212; use the examples below</div>
          <p class="step-desc">In your next message, describe what you want.
            Use the prompts in the sections below as starting points.
            The AI will generate complete, valid output you can use immediately.</p>
        </div>
      </div>
    </div>
  </section>


  <hr class="divider">


  <!-- ─── PATH A: FILE PROMPTS ─────────────────────────────────────────── -->
  <section class="section" style="margin-top:64px" id="file-prompts">
    <div class="section-label">Path A &#8212; Generating .chron files</div>
    <h2 class="section-title" style="margin-top:0">Example prompts for creating event files</h2>
    <div class="section-body">
      <p>These prompts produce valid <code>.chron</code> files you can load directly into a viewer
         or the tools at <a href="https://chronology.studio" target="_blank" rel="noopener">Chronology Studio</a>.</p>
    </div>
    <div class="use-cases">

      <div class="use-case">
        <div class="use-case-head">
          <div class="use-case-icon" aria-hidden="true">&#127963;</div>
          <div class="use-case-name">Historical Research</div>
        </div>
        <div class="use-case-body">
          <div class="prompt-box">Generate 10 .chron files covering the major events of the French Revolution, from 1789 to 1799. Include dates, descriptions, tags, and significance scores. Output each file separately with a clear filename.</div>
          <p class="use-case-note"><strong>Tip:</strong> Ask for a specific era or event count. The AI will spread significance values to reflect relative importance.</p>
        </div>
      </div>

      <div class="use-case">
        <div class="use-case-head">
          <div class="use-case-icon" aria-hidden="true">&#128218;</div>
          <div class="use-case-name">Fiction &amp; World-Building</div>
        </div>
        <div class="use-case-body">
          <div class="prompt-box">I'm building a fantasy world called Aeryndal. Create .chron files for 8 founding events of the kingdom spanning 1,200 years of in-world history. Use type "era" for multi-century events and "milestone" for pivotal moments.</div>
          <p class="use-case-note"><strong>Tip:</strong> Use any string for <code>body</code> &#8212; e.g. <code>"aeryndal"</code>. The <code>calendar</code> field accepts <code>"gregorian"</code> as a stand-in for custom systems.</p>
        </div>
      </div>

      <div class="use-case">
        <div class="use-case-head">
          <div class="use-case-icon" aria-hidden="true">&#128203;</div>
          <div class="use-case-name">Project Management</div>
        </div>
        <div class="use-case-body">
          <div class="prompt-box">Convert this project plan into .chron files: [paste your milestones]. Use type "milestone" for deliverables and "era" for phases. Set precision to "day" and tag each event with its project phase.</div>
          <p class="use-case-note"><strong>Tip:</strong> Paste a bullet list of milestones directly into your prompt. The AI will extract dates and structure everything correctly.</p>
        </div>
      </div>

      <div class="use-case">
        <div class="use-case-head">
          <div class="use-case-icon" aria-hidden="true">&#127795;</div>
          <div class="use-case-name">Family History</div>
        </div>
        <div class="use-case-body">
          <div class="prompt-box">Create .chron files for my grandmother's life story from these notes: [paste your notes]. Where exact dates are unknown, use precision "year" or "circa" with an appropriate uncertainty margin.</div>
          <p class="use-case-note"><strong>Tip:</strong> The <code>uncertainty</code> field handles approximate dates gracefully &#8212; ideal for genealogy and oral history.</p>
        </div>
      </div>

      <div class="use-case">
        <div class="use-case-head">
          <div class="use-case-icon" aria-hidden="true">&#128300;</div>
          <div class="use-case-name">Science &amp; Discovery</div>
        </div>
        <div class="use-case-body">
          <div class="prompt-box">Generate .chron files for 12 pivotal moments in the history of human spaceflight from Sputnik to today. Include spatial data (body = "earth" for launches, "moon" for lunar events) and cite NASA sources.</div>
          <p class="use-case-note"><strong>Tip:</strong> The <code>body</code> field lets you anchor events to specific planets or moons &#8212; great for space history.</p>
        </div>
      </div>

      <div class="use-case">
        <div class="use-case-head">
          <div class="use-case-icon" aria-hidden="true">&#128240;</div>
          <div class="use-case-name">News &amp; Current Events</div>
        </div>
        <div class="use-case-body">
          <div class="prompt-box">I'm building a timeline of [topic] from [start year] to today. Generate .chron files for the 15 most significant events. Include a date_label for each and set geographic_scope based on the event's actual reach.</div>
          <p class="use-case-note"><strong>Tip:</strong> <code>geographic_scope</code> drives how a viewer weights events &#8212; set it deliberately.</p>
        </div>
      </div>

    </div>
  </section>


  <hr class="divider">


  <!-- ─── PATH B: VIEWER PROMPTS ───────────────────────────────────────── -->
  <section class="section" style="margin-top:64px" id="viewer-prompts">
    <div class="section-label">Path B &#8212; Building a timeline viewer</div>
    <h2 class="section-title" style="margin-top:0">Example prompts for building your own viewer</h2>
    <div class="section-body">
      <p>The OpenChronology reference parser is a ready-made ESM module you can point your AI at.
         These prompts produce complete, self-contained viewer code ready to publish on your own website.</p>
    </div>
    <div class="use-cases">

      <div class="use-case">
        <div class="use-case-head">
          <div class="use-case-icon" aria-hidden="true">&#128220;</div>
          <div class="use-case-name">Simple Vertical List</div>
        </div>
        <div class="use-case-body">
          <div class="prompt-box">Using the OpenChronology reference parser at https://openchronology.org/src/openchronology.js, build a vanilla JS timeline viewer that fetches an array of .chron file URLs, sorts them by start_value, and renders a vertical list showing date_label and title for each event.</div>
          <p class="use-case-note"><strong>Tip:</strong> Good first viewer &#8212; readable, fast, works in any browser without a framework.</p>
        </div>
      </div>

      <div class="use-case">
        <div class="use-case-head">
          <div class="use-case-icon" aria-hidden="true">&#8596;&#65039;</div>
          <div class="use-case-name">Horizontal Scrolling Timeline</div>
        </div>
        <div class="use-case-body">
          <div class="prompt-box">Build an interactive horizontal timeline using the OpenChronology parser. Events should be positioned proportionally by date on a scrollable axis. Show event dots sized by significance value. On click, expand a card with title and description.</div>
          <p class="use-case-note"><strong>Tip:</strong> Ask for it in vanilla JS or React &#8212; specify your stack. The parser handles date resolution automatically.</p>
        </div>
      </div>

      <div class="use-case">
        <div class="use-case-head">
          <div class="use-case-icon" aria-hidden="true">&#127183;</div>
          <div class="use-case-name">Card-Based Feed</div>
        </div>
        <div class="use-case-body">
          <div class="prompt-box">Build a responsive card grid that reads .chron files and displays each event as a card with its title, date_label, description (first 200 characters), and tags as chips. Sort by significance descending. Use CSS Grid.</div>
          <p class="use-case-note"><strong>Tip:</strong> Great for curated collections where you want the most important events to surface first.</p>
        </div>
      </div>

      <div class="use-case">
        <div class="use-case-head">
          <div class="use-case-icon" aria-hidden="true">&#127820;</div>
          <div class="use-case-name">Styled for Your Brand</div>
        </div>
        <div class="use-case-body">
          <div class="prompt-box">Build a timeline viewer using the OpenChronology parser that matches my site's style: [describe your colors, fonts, layout]. Load events from a local array of .chron objects. Each event shows title, date_label, and a collapsible description.</div>
          <p class="use-case-note"><strong>Tip:</strong> Describe your visual style or paste a link to your site &#8212; the AI will match it.</p>
        </div>
      </div>

    </div>
  </section>


  <hr class="divider">


  <!-- ─── TIPS ─────────────────────────────────────────────────────────── -->
  <section class="section" style="margin-top:64px" id="tips">
    <div class="section-label">Best Practices</div>
    <h2 class="section-title" style="margin-top:0">Tips for better results</h2>
    <div class="tips-list">

      <div class="tip">
        <div class="tip-bullet" aria-hidden="true">
          <svg width="10" height="10" viewBox="0 0 12 12" fill="none"><path d="M2 6l3 3 5-5" stroke="#1e7a4a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <p class="tip-text"><strong>Start a fresh conversation each session.</strong>
          Re-paste the context block whenever you start a new chat.
          Without it, AI models revert to guessing field names and formats.</p>
      </div>

      <div class="tip">
        <div class="tip-bullet" aria-hidden="true">
          <svg width="10" height="10" viewBox="0 0 12 12" fill="none"><path d="M2 6l3 3 5-5" stroke="#1e7a4a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <p class="tip-text"><strong>Ask for files in batches of 5&#8211;10.</strong>
          Smaller batches prevent the AI from truncating or rushing the last files in a long list.</p>
      </div>

      <div class="tip">
        <div class="tip-bullet" aria-hidden="true">
          <svg width="10" height="10" viewBox="0 0 12 12" fill="none"><path d="M2 6l3 3 5-5" stroke="#1e7a4a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <p class="tip-text"><strong>Always validate generated files.</strong>
          Drop each file into the
          <a href="https://chronology.studio/tools/validator.php" target="_blank" rel="noopener">Validator</a>
          at Chronology Studio. It catches missing fields and malformed UUIDs instantly.</p>
      </div>

      <div class="tip">
        <div class="tip-bullet" aria-hidden="true">
          <svg width="10" height="10" viewBox="0 0 12 12" fill="none"><path d="M2 6l3 3 5-5" stroke="#1e7a4a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <p class="tip-text"><strong>Check UUIDs for uniqueness.</strong>
          Some AI models reuse the example UUID from the context block.
          Ask: <em>&#8220;Regenerate any files that share a UUID &#8212; every event must have a unique id.&#8221;</em></p>
      </div>

      <div class="tip">
        <div class="tip-bullet" aria-hidden="true">
          <svg width="10" height="10" viewBox="0 0 12 12" fill="none"><path d="M2 6l3 3 5-5" stroke="#1e7a4a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <p class="tip-text"><strong>Approximate dates are better than no dates.</strong>
          Don&#8217;t omit <code>temporal</code> just because an exact date is unknown.
          A <code>precision</code> of <code>&#8220;circa&#8221;</code> with an <code>uncertainty</code> margin
          is far more useful in a viewer than a missing date entirely.</p>
      </div>

      <div class="tip">
        <div class="tip-bullet" aria-hidden="true">
          <svg width="10" height="10" viewBox="0 0 12 12" fill="none"><path d="M2 6l3 3 5-5" stroke="#1e7a4a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <p class="tip-text"><strong>For viewer builds, point the AI at the reference parser.</strong>
          The URL <code>https://openchronology.org/src/openchronology.js</code> is in the context block.
          Using it produces cleaner code than asking the AI to parse <code>.chron</code> files from scratch.</p>
      </div>

    </div>
  </section>


  <hr class="divider">


  <!-- ─── WHAT TO DO WITH YOUR OUTPUT ─────────────────────────────────── -->
  <section class="section" style="margin-top:64px" id="next-steps">
    <div class="section-label">After Generation</div>
    <h2 class="section-title" style="margin-top:0">What to do with your output</h2>
    <div class="section-body">
      <p>What you do next depends on which path you took.</p>
    </div>

    <!-- Path A outcome ─────────────────────────────────────────────────── -->
    <div style="margin-bottom:44px">
      <h3 style="font-family:var(--font-body);font-size:12px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:var(--blue);margin:0 0 14px;display:flex;align-items:center;gap:10px;">
        <span style="display:inline-block;width:3px;height:16px;background:var(--blue);border-radius:2px;flex-shrink:0"></span>
        If you generated .chron files &#8212; Path A
      </h3>
      <p style="font-size:15px;color:var(--ink-soft);margin-bottom:20px;line-height:1.72;">
        Your AI-generated files are ready to use with the tools at
        <a href="https://chronology.studio" target="_blank" rel="noopener">Chronology Studio</a>.
        Everything runs in your browser &#8212; nothing is uploaded to a server.
      </p>
      <div class="next-grid">
        <a href="https://chronology.studio/tools/validator.php" class="next-card" target="_blank" rel="noopener">
          <div class="next-card-num">01 &#8212; Validate</div>
          <div class="next-card-title">Validator &amp; Upgrader</div>
          <p class="next-card-desc">Drag in your files for instant schema validation. Catches errors before they reach a viewer.</p>
        </a>
        <a href="https://chronology.studio/tools/timeline-viewer/" class="next-card" target="_blank" rel="noopener">
          <div class="next-card-num">02 &#8212; Visualize</div>
          <div class="next-card-title">Timeline Viewer Gallery</div>
          <p class="next-card-desc">Four rendering styles &#8212; Horizon, Codex, Ledger, Gantt. Drop your files in and see them rendered immediately.</p>
        </a>
        <a href="https://chronology.studio/tools/event-author.php" class="next-card" target="_blank" rel="noopener">
          <div class="next-card-num">03 &#8212; Refine</div>
          <div class="next-card-title">Event Author</div>
          <p class="next-card-desc">Import any <code>.chron</code> file to edit fields, adjust significance, and re-export &#8212; no JSON editing required.</p>
        </a>
      </div>
    </div>

    <!-- Path B outcome ─────────────────────────────────────────────────── -->
    <div style="padding-top:36px;border-top:1px solid var(--border)">
      <h3 style="font-family:var(--font-body);font-size:12px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:var(--blue);margin:0 0 14px;display:flex;align-items:center;gap:10px;">
        <span style="display:inline-block;width:3px;height:16px;background:var(--blue);border-radius:2px;flex-shrink:0"></span>
        If you built a timeline viewer &#8212; Path B
      </h3>
      <p style="font-size:15px;color:var(--ink-soft);margin-bottom:20px;line-height:1.72;">
        Your AI-generated viewer is ready to go live. Here is how to get it onto the web.
      </p>
      <div class="next-grid" style="grid-template-columns:1fr 1fr">
        <div class="next-card" style="cursor:default">
          <div class="next-card-num">01 &#8212; Standalone page</div>
          <div class="next-card-title">Publish as its own webpage</div>
          <p class="next-card-desc">Save the viewer as an <code>.html</code> file and upload it to any web host.
            Place your <code>.chron</code> files on the same server or a CORS-enabled domain.
            Link to it from your site, social profiles, or anywhere you like.</p>
        </div>
        <div class="next-card" style="cursor:default">
          <div class="next-card-num">02 &#8212; Embed in a page</div>
          <div class="next-card-title">Add it to an existing site</div>
          <p class="next-card-desc">Using WordPress, Webflow, Squarespace, or similar?
            Paste the viewer&#8217;s HTML and JS into a <em>Custom HTML</em> or <em>Embed</em> block.
            Most platforms support this directly in their page editor.</p>
        </div>
        <div class="next-card" style="cursor:default">
          <div class="next-card-num">03 &#8212; Framework integration</div>
          <div class="next-card-title">Integrate with your tech stack</div>
          <p class="next-card-desc">Working with React, Vue, Next.js, Astro, or another framework?
            Ask the AI to convert the viewer into a component for your stack.
            The OpenChronology parser is an ESM module &#8212; it drops in cleanly to any modern JS project.</p>
        </div>
        <div class="next-card" style="cursor:default">
          <div class="next-card-num">04 &#8212; Share the standard</div>
          <div class="next-card-title">Tell others it&#8217;s OpenChronology</div>
          <p class="next-card-desc">Linking back to <code>openchronology.org</code> or noting the standard your viewer uses
            helps grow the ecosystem &#8212; making it easier for others to contribute events,
            build compatible tools, and preserve timelines for the long term.</p>
        </div>
      </div>
    </div>

  </section>


</main>



<script>
// ── Copy context block ─────────────────────────────────────────────────
function copyContextBlock() {
  const text = document.getElementById('contextBlock').value;
  const btn  = document.getElementById('copyBtn');

  const checkIcon = '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>';
  const copyIcon  = '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>';

  function showCopied() {
    btn.classList.add('copied');
    btn.innerHTML = checkIcon + '<span id="copyBtnText">Copied!</span>';
    setTimeout(function() {
      btn.classList.remove('copied');
      btn.innerHTML = copyIcon + '<span id="copyBtnText">Copy to clipboard</span>';
    }, 2500);
  }

  if (navigator.clipboard && navigator.clipboard.writeText) {
    navigator.clipboard.writeText(text).then(showCopied).catch(function() {
      document.getElementById('contextBlock').select();
      document.execCommand('copy');
      showCopied();
    });
  } else {
    var ta = document.getElementById('contextBlock');
    ta.select();
    ta.setSelectionRange(0, 99999);
    try { document.execCommand('copy'); showCopied(); }
    catch(e) { btn.innerHTML = copyIcon + '<span id="copyBtnText">Select all &amp; copy</span>'; }
  }
}
</script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
