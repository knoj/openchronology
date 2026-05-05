/**
 * openchronology.js — Reference Parser
 * OpenChronology Specification v0.3
 *
 * Pure data layer. No rendering. No DOM.
 * ESM module — import { parse, validate, ... } from './openchronology.js'
 *
 * @license CC-BY-4.0
 * @see https://openchronology.org/specification
 */

// ─────────────────────────────────────────────────────────────────────────────
// § 1. Spec version
// ─────────────────────────────────────────────────────────────────────────────

export const SPEC_VERSION = '0.3'

// ─────────────────────────────────────────────────────────────────────────────
// § 2. Built-in vocabularies
// ─────────────────────────────────────────────────────────────────────────────

export const BUILTIN_CALENDARS = new Set([
  'gregorian', 'julian', 'islamic', 'hebrew', 'chinese', 'unix', 'jdn',
])

export const BUILTIN_UNIVERSES = new Set(['real', 'relative'])

export const BUILTIN_BODIES = new Map([
  ['earth', { id: 'earth', name: 'Earth', type: 'builtin', crs: 'wgs84',    image_url: null, width: null, height: null }],
  ['moon',  { id: 'moon',  name: 'Moon',  type: 'builtin', crs: 'moon_me',  image_url: null, width: null, height: null }],
  ['mars',  { id: 'mars',  name: 'Mars',  type: 'builtin', crs: 'mars_iau', image_url: null, width: null, height: null }],
  ['sun',   { id: 'sun',   name: 'Sun',   type: 'builtin', crs: null,       image_url: null, width: null, height: null }],
])

export const WARNING_CODES = {
  // Resolution
  UNRESOLVED_CALENDAR_REF:    'UNRESOLVED_CALENDAR_REF',
  UNRESOLVED_UNIVERSE_REF:    'UNRESOLVED_UNIVERSE_REF',
  UNRESOLVED_BODY_REF:        'UNRESOLVED_BODY_REF',
  USED_INLINE_FALLBACK:       'USED_INLINE_FALLBACK',
  FLOATING_EVENT:             'FLOATING_EVENT',
  CALENDAR_NOT_SUPPORTED:     'CALENDAR_NOT_SUPPORTED',
  UNIVERSE_DEFAULT_CALENDAR:  'UNIVERSE_DEFAULT_CALENDAR',
  // Relations
  RELATION_MISSING_TARGET_ID: 'RELATION_MISSING_TARGET_ID',
  RELATION_ID_MISMATCH:       'RELATION_ID_MISMATCH',
  RELATION_FETCH_FAILED:      'RELATION_FETCH_FAILED',
  // Schema / structure
  SCHEMA_VERSION_MISMATCH:    'SCHEMA_VERSION_MISMATCH',
  MISSING_REQUIRED_FIELD:     'MISSING_REQUIRED_FIELD',
  UNKNOWN_EVENT_TYPE:         'UNKNOWN_EVENT_TYPE',
  INVALID_UUID:               'INVALID_UUID',
  MISSING_ORIGINAL_TYPE:      'MISSING_ORIGINAL_TYPE',
  INVALID_PRECISION:          'INVALID_PRECISION',
  INVALID_TEMPORAL_SCOPE:     'INVALID_TEMPORAL_SCOPE',
  INVALID_GEOGRAPHIC_SCOPE:   'INVALID_GEOGRAPHIC_SCOPE',
  SIGNIFICANCE_OUT_OF_RANGE:  'SIGNIFICANCE_OUT_OF_RANGE',
  UNKNOWN_RELATION_TYPE:      'UNKNOWN_RELATION_TYPE',
  INVALID_DESCRIPTION_FORMAT: 'INVALID_DESCRIPTION_FORMAT',
  INVALID_JSON:               'INVALID_JSON',
  TYPE_DEFAULTED:             'TYPE_DEFAULTED',
  // Parsing
  DATE_PARSE_FAILED:          'DATE_PARSE_FAILED',
  // Fetch
  CALENDAR_REF_RESOLVED:      'CALENDAR_REF_RESOLVED',
}

// ─────────────────────────────────────────────────────────────────────────────
// § 3. Internal: controlled vocabularies
// ─────────────────────────────────────────────────────────────────────────────

const VALID_EVENT_TYPES = new Set([
  'event', 'era', 'marker', 'tombstone', 'deprecated',
])

const VALID_PRECISION = new Set([
  'millisecond', 'second', 'minute', 'hour', 'day', 'month',
  'year', 'decade', 'century', 'millennium', 'epoch', 'circa', 'custom',
])

const VALID_TEMPORAL_SCOPES = new Set([
  'cosmic', 'geological', 'deep_history', 'historical',
  'generational', 'living_memory', 'recent', 'immediate',
])

const VALID_GEOGRAPHIC_SCOPES = new Set([
  'universal', 'galactic', 'planetary', 'global', 'continental',
  'national', 'regional', 'local', 'point',
  // NOTE: 'global' is used in v0.3 example files but absent from the spec vocabulary.
  // It is accepted here pending a v0.4 vocabulary update. See project notes.
])

const VALID_RELATION_TYPES = new Set([
  'causes', 'caused_by', 'follows', 'precedes', 'contains', 'part_of',
  'references', 'referenced_by', 'contradicts', 'retcons', 'retconned_by',
  'supports', 'disputes', 'influences', 'influenced_by',
  'simultaneous_with', 'related_to',
])

const VALID_DESCRIPTION_FORMATS = new Set(['plain', 'markdown', 'html'])

const UUID_V4_RE = /^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i

// ─────────────────────────────────────────────────────────────────────────────
// § 4. Warning level ordering
// ─────────────────────────────────────────────────────────────────────────────

const LEVEL_ORDER = { debug: 0, info: 1, warn: 2, error: 3 }

function meetsLevel(warningLevel, minLevel) {
  return (LEVEL_ORDER[warningLevel] ?? 0) >= (LEVEL_ORDER[minLevel] ?? 1)
}

// ─────────────────────────────────────────────────────────────────────────────
// § 5. Structural validation (bundled schema-lite)
//
// Validates required fields, type constraints, and controlled vocabulary.
// In a future version this can optionally delegate to Ajv against the live
// schemas at schemas.openchronology.org when schemaSource: 'remote'.
// ─────────────────────────────────────────────────────────────────────────────

function validateRaw(raw) {
  const errors   = []
  const warnings = []

  const err  = (code, message, field) => errors.push({ level: 'error', code, message, field: field ?? null })
  const warn = (code, message, field) => warnings.push({ level: 'warn',  code, message, field: field ?? null })
  const info = (code, message, field) => warnings.push({ level: 'info',  code, message, field: field ?? null })

  // ── meta ──────────────────────────────────────────────────────────────────
  if (!raw?.meta?.schema_version) {
    err(WARNING_CODES.MISSING_REQUIRED_FIELD, 'meta.schema_version is required.', 'meta.schema_version')
  } else if (raw.meta.schema_version !== SPEC_VERSION) {
    warn(
      WARNING_CODES.SCHEMA_VERSION_MISMATCH,
      `File declares schema_version '${raw.meta.schema_version}', parser targets '${SPEC_VERSION}'. Parsing best-effort.`,
      'meta.schema_version',
    )
  }

  // ── event block required ──────────────────────────────────────────────────
  if (!raw?.event) {
    err(WARNING_CODES.MISSING_REQUIRED_FIELD, 'event block is required.', 'event')
    return { errors, warnings } // cannot continue without event block
  }

  const event = raw.event

  // ── event.id ──────────────────────────────────────────────────────────────
  if (!event.id) {
    err(WARNING_CODES.MISSING_REQUIRED_FIELD, 'event.id is required.', 'event.id')
  } else if (!UUID_V4_RE.test(event.id)) {
    warn(WARNING_CODES.INVALID_UUID, `event.id '${event.id}' does not appear to be a valid UUID-v4.`, 'event.id')
  }

  // ── event.type ────────────────────────────────────────────────────────────
  const eventType = event.type ?? 'event'
  if (event.type && !VALID_EVENT_TYPES.has(event.type)) {
    warn(
      WARNING_CODES.UNKNOWN_EVENT_TYPE,
      `Unknown event.type '${event.type}'. Expected: ${[...VALID_EVENT_TYPES].join(', ')}.`,
      'event.type',
    )
  }

  // ── tombstone / deprecated: original_type encouraged ─────────────────────
  if ((eventType === 'tombstone' || eventType === 'deprecated') && !event.original_type) {
    info(
      WARNING_CODES.MISSING_ORIGINAL_TYPE,
      `Event type '${eventType}' should include original_type to record what was deleted.`,
      'event.original_type',
    )
  }

  // ── event.content (required for non-tombstone) ────────────────────────────
  if (eventType !== 'tombstone') {
    if (!event.content) {
      err(WARNING_CODES.MISSING_REQUIRED_FIELD, 'event.content is required for non-tombstone events.', 'event.content')
    } else {
      if (!event.content.title) {
        err(WARNING_CODES.MISSING_REQUIRED_FIELD, 'event.content.title is required.', 'event.content.title')
      }
      if (event.content.description_format && !VALID_DESCRIPTION_FORMATS.has(event.content.description_format)) {
        warn(
          WARNING_CODES.INVALID_DESCRIPTION_FORMAT,
          `Unknown description_format '${event.content.description_format}'. Expected: plain, markdown, html.`,
          'event.content.description_format',
        )
      }
    }
  }

  // ── temporal ──────────────────────────────────────────────────────────────
  if (event.temporal) {
    const t = event.temporal
    if (!t.start_value) {
      warn(
        WARNING_CODES.MISSING_REQUIRED_FIELD,
        'temporal.start_value is required when the temporal block is present.',
        'temporal.start_value',
      )
    }
    if (t.precision && !VALID_PRECISION.has(t.precision)) {
      warn(WARNING_CODES.INVALID_PRECISION, `Unknown precision '${t.precision}'.`, 'temporal.precision')
    }
    if (t.uncertainty) {
      const u = t.uncertainty
      if (!u.type || !u.margin_value == null || !u.margin_unit) {
        warn(
          WARNING_CODES.MISSING_REQUIRED_FIELD,
          'temporal.uncertainty requires type, margin_value, and margin_unit.',
          'temporal.uncertainty',
        )
      }
    }
  }

  // ── significance ──────────────────────────────────────────────────────────
  if (event.significance) {
    const s = event.significance
    if (s.temporal_scope && !VALID_TEMPORAL_SCOPES.has(s.temporal_scope)) {
      warn(
        WARNING_CODES.INVALID_TEMPORAL_SCOPE,
        `Unknown temporal_scope '${s.temporal_scope}'.`,
        'significance.temporal_scope',
      )
    }
    if (s.geographic_scope && !VALID_GEOGRAPHIC_SCOPES.has(s.geographic_scope)) {
      warn(
        WARNING_CODES.INVALID_GEOGRAPHIC_SCOPE,
        `Unknown geographic_scope '${s.geographic_scope}'.`,
        'significance.geographic_scope',
      )
    }
    if (typeof s.value === 'number' && (s.value < 0 || s.value > 1000)) {
      warn(
        WARNING_CODES.SIGNIFICANCE_OUT_OF_RANGE,
        `significance.value ${s.value} is outside the valid 0–1000 range.`,
        'significance.value',
      )
    }
  }

  // ── relations ─────────────────────────────────────────────────────────────
  if (Array.isArray(event.relations)) {
    event.relations.forEach((rel, i) => {
      if (!rel.target_id) {
        err(
          WARNING_CODES.RELATION_MISSING_TARGET_ID,
          `relations[${i}] is missing required target_id. External URLs belong in content.sources per v0.3.`,
          `event.relations[${i}].target_id`,
        )
      }
      if (rel.type && !VALID_RELATION_TYPES.has(rel.type)) {
        warn(
          WARNING_CODES.UNKNOWN_RELATION_TYPE,
          `relations[${i}] has unknown type '${rel.type}'.`,
          `event.relations[${i}].type`,
        )
      }
    })
  }

  return { errors, warnings }
}

// ─────────────────────────────────────────────────────────────────────────────
// § 6. Resolution pipeline
// ─────────────────────────────────────────────────────────────────────────────

// ── 6a. Universe ──────────────────────────────────────────────────────────────

function resolveUniverse(definitions, temporalUniverse) {
  const id = temporalUniverse ?? null

  // Default to 'real' when universe is completely absent
  if (!id) {
    return { id: 'real', type: 'builtin', source: null, definition: null }
  }

  // Built-in check
  if (BUILTIN_UNIVERSES.has(id)) {
    return { id, type: 'builtin', source: null, definition: null }
  }

  // Inline definition present?
  const def = definitions?.universes?.[id]
  if (!def) {
    return { id, type: 'unresolved', source: null, definition: null }
  }

  if (def.type === 'builtin') {
    return { id, type: 'builtin', source: null, definition: null }
  }

  // External reference — carry ref for potential future async resolution
  return {
    id,
    type:       'unresolved',
    source:     def.ref ?? null,
    definition: null,
    _ref:       def.ref ?? null,
  }
}

// ── 6b. Calendar ──────────────────────────────────────────────────────────────

function resolveCalendarSync(definitions, calendarId) {
  const id = calendarId ?? null

  if (!id) return { id: null, type: 'none', source: null, definition: null }

  if (BUILTIN_CALENDARS.has(id)) {
    return { id, type: 'builtin', source: null, definition: null }
  }

  const def = definitions?.calendars?.[id]
  if (!def) {
    return { id, type: 'unresolved', source: null, definition: null }
  }

  if (def.type === 'builtin') {
    return { id, type: 'builtin', source: null, definition: null }
  }

  // External — flag for async resolution
  return {
    id,
    type:          'unresolved',
    source:        def.ref ?? null,
    definition:    null,
    _ref:          def.ref ?? null,
    _hasFallback:  !!def.inline_fallback,
    _fallback:     def.inline_fallback ?? null,
  }
}

async function resolveExternalCalendar(calResolution, fetchTimeout, warnings) {
  if (calResolution.type !== 'unresolved' || !calResolution._ref) {
    return calResolution
  }

  const url = calResolution._ref

  // Local / relative paths cannot be resolved in a browser/worker context
  if (!url.startsWith('https://') && !url.startsWith('http://')) {
    if (calResolution._hasFallback) {
      warnings.push({
        level: 'info',
        code:    WARNING_CODES.USED_INLINE_FALLBACK,
        message: `Calendar ref '${url}' is a local path (cannot resolve remotely). Using inline_fallback.`,
        field:   'definitions.calendars',
      })
      return { ...calResolution, type: 'fallback', definition: calResolution._fallback }
    }
    warnings.push({
      level:   'warn',
      code:    WARNING_CODES.UNRESOLVED_CALENDAR_REF,
      message: `Calendar ref '${url}' is a local path and cannot be resolved. No inline_fallback available.`,
      field:   'definitions.calendars',
    })
    return calResolution
  }

  try {
    const controller = new AbortController()
    const timer = setTimeout(() => controller.abort(), fetchTimeout)
    const res = await fetch(url, { signal: controller.signal })
    clearTimeout(timer)

    if (!res.ok) throw new Error(`HTTP ${res.status}`)
    const definition = await res.json()

    warnings.push({
      level:   'debug',
      code:    WARNING_CODES.CALENDAR_REF_RESOLVED,
      message: `Calendar ref '${url}' resolved successfully.`,
      field:   'definitions.calendars',
    })
    return { ...calResolution, type: 'resolved', source: url, definition }
  } catch (err) {
    if (calResolution._hasFallback) {
      warnings.push({
        level:   'info',
        code:    WARNING_CODES.USED_INLINE_FALLBACK,
        message: `Calendar ref '${url}' unreachable (${err.message}). Using inline_fallback.`,
        field:   'definitions.calendars',
      })
      return { ...calResolution, type: 'fallback', definition: calResolution._fallback }
    }
    warnings.push({
      level:   'warn',
      code:    WARNING_CODES.UNRESOLVED_CALENDAR_REF,
      message: `Calendar ref '${url}' unreachable (${err.message}). No inline_fallback. Event will be floating.`,
      field:   'definitions.calendars',
    })
    return calResolution
  }
}

// ── 6c. Body ──────────────────────────────────────────────────────────────────

function resolveBody(definitions, bodyId) {
  if (!bodyId) {
    return { id: null, type: 'none', source: null, definition: null }
  }

  // Built-in
  if (BUILTIN_BODIES.has(bodyId)) {
    return { id: bodyId, type: 'builtin', source: null, definition: BUILTIN_BODIES.get(bodyId) }
  }

  // Inline definitions.bodies
  const def = definitions?.bodies?.[bodyId]
  if (def) {
    if (def.type === 'builtin') {
      // Explicitly declared as builtin — name not required per v0.3
      const builtin = BUILTIN_BODIES.get(bodyId)
      return { id: bodyId, type: 'builtin', source: null, definition: builtin ?? { id: bodyId, type: 'builtin', crs: null, image_url: null, width: null, height: null } }
    }
    return {
      id: bodyId,
      type: 'inline',
      source: null,
      definition: {
        id:        bodyId,
        name:      def.name ?? bodyId,
        type:      def.type ?? 'custom',
        crs:       def.crs ?? null,
        image_url: def.image_url ?? null,
        width:     def.width ?? null,
        height:    def.height ?? null,
      },
    }
  }

  return { id: bodyId, type: 'unresolved', source: null, definition: null }
}

// ─────────────────────────────────────────────────────────────────────────────
// § 7. Date resolution
//
// Converts start_value / end_value strings to Unix timestamps (SI seconds).
//
// Fully supported: gregorian, unix, jdn
// Stubbed (info warning): julian, islamic, hebrew, chinese
//   — These require non-trivial calendar arithmetic and will be implemented
//     in a future version. Contributions welcome.
// ─────────────────────────────────────────────────────────────────────────────

/**
 * JavaScript's Date constructor requires 6-digit expanded-year notation for
 * negative (BCE) dates: '-000025-01-01' not '-0025-01-01'.
 * This normalizer pads the year component to 6 digits when needed.
 *
 * Examples:
 *   '-0025-01-01'  → '-000025-01-01'   (25 BCE = astronomical year -24)
 *   '-100-01-01'   → '-000100-01-01'
 *   '1969-07-20'   → '1969-07-20'      (positive years unchanged)
 *   '-000025-01-01'→ '-000025-01-01'   (already 6-digit, unchanged)
 */
function normalizeISOYear(value) {
  // Match negative years with fewer than 6 digits: -1 to -99999
  return value.replace(/^-(\d{1,5})(-.*)$/, (_, year, rest) => {
    return `-${year.padStart(6, '0')}${rest}`
  })
}

function resolveUnixTimestamp(value, calendarId, warnings, field) {
  if (!value || !calendarId) return null

  switch (calendarId.toLowerCase()) {

    case 'gregorian': {
      // ISO 8601: YYYY, YYYY-MM, YYYY-MM-DD, YYYY-MM-DDTHH:MM:SSZ
      // Negative (BCE) years need 6-digit padding for JS Date compatibility.
      const normalized = normalizeISOYear(value)
      const d = new Date(normalized)
      if (isNaN(d.getTime())) {
        warnings.push({ level: 'warn', code: WARNING_CODES.DATE_PARSE_FAILED, message: `Could not parse '${value}' as a Gregorian (ISO 8601) date.`, field })
        return null
      }
      return d.getTime() / 1000
    }

    case 'unix': {
      const n = parseFloat(value)
      if (isNaN(n)) {
        warnings.push({ level: 'warn', code: WARNING_CODES.DATE_PARSE_FAILED, message: `Could not parse '${value}' as a Unix timestamp.`, field })
        return null
      }
      return n
    }

    case 'jdn': {
      // Julian Day Number → Unix seconds
      // Unix epoch (1970-01-01 00:00:00 UTC) = JDN 2440587.5
      const jdn = parseFloat(value)
      if (isNaN(jdn)) {
        warnings.push({ level: 'warn', code: WARNING_CODES.DATE_PARSE_FAILED, message: `Could not parse '${value}' as a Julian Day Number.`, field })
        return null
      }
      return (jdn - 2440587.5) * 86400
    }

    case 'julian':
    case 'islamic':
    case 'hebrew':
    case 'chinese': {
      warnings.push({
        level:   'info',
        code:    WARNING_CODES.CALENDAR_NOT_SUPPORTED,
        message: `Unix timestamp conversion for calendar '${calendarId}' is not yet implemented. start_unix / end_unix will be null.`,
        field:   'temporal.calendar',
      })
      return null
    }

    default: {
      warnings.push({
        level:   'info',
        code:    WARNING_CODES.CALENDAR_NOT_SUPPORTED,
        message: `Unknown calendar '${calendarId}' — cannot resolve Unix timestamps.`,
        field:   'temporal.calendar',
      })
      return null
    }
  }
}

// ─────────────────────────────────────────────────────────────────────────────
// § 8. Display date resolution (§7.5 priority chain)
// ─────────────────────────────────────────────────────────────────────────────

const MONTH_FULL  = ['January','February','March','April','May','June','July','August','September','October','November','December']
const MONTH_SHORT = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']

/** Apply a CLDR-style format_hint pattern to a UTC Date object. */
function applyFormatPattern(pattern, date, eraLabel) {
  if (!pattern || !date || isNaN(date.getTime())) return null

  // Order matters: longer tokens before shorter ones to avoid partial replacement
  let result = pattern
    .replace('MMMM', MONTH_FULL[date.getUTCMonth()])
    .replace('MMM',  MONTH_SHORT[date.getUTCMonth()])
    .replace('MM',   String(date.getUTCMonth() + 1).padStart(2, '0'))
    .replace('M',    String(date.getUTCMonth() + 1))
    .replace('DD',   String(date.getUTCDate()).padStart(2, '0'))
    .replace('D',    String(date.getUTCDate()))
    .replace('YYYY', String(date.getUTCFullYear()).padStart(4, '0'))

  if (eraLabel) result = `${result} ${eraLabel}`
  return result
}

/**
 * Resolve display_date per §7.5 priority chain.
 * Returns { display_date: string|null, display_date_source: string|null }
 */
function resolveDisplayDate(content, temporal, locale) {
  // Step 1: locale-specific translation date_label
  if (locale && content?.translations?.[locale]?.date_label) {
    return {
      display_date:        content.translations[locale].date_label,
      display_date_source: 'translation',
    }
  }

  // Step 2: base content.date_label
  if (content?.date_label) {
    return {
      display_date:        content.date_label,
      display_date_source: 'date_label',
    }
  }

  // Step 3: format_hint pattern applied to start_value
  if (temporal?.format_hint?.pattern && temporal?.start_value) {
    const d = new Date(temporal.start_value)
    if (!isNaN(d.getTime())) {
      const formatted = applyFormatPattern(
        temporal.format_hint.pattern,
        d,
        temporal.format_hint.era_label ?? null,
      )
      if (formatted) {
        return { display_date: formatted, display_date_source: 'format_hint' }
      }
    }
  }

  // Step 4: renderer's responsibility — return null
  return { display_date: null, display_date_source: null }
}

// ─────────────────────────────────────────────────────────────────────────────
// § 9. Block normalizers
// ─────────────────────────────────────────────────────────────────────────────

function normalizeContent(raw, temporal, locale) {
  if (!raw) return null

  const { display_date, display_date_source } = resolveDisplayDate(raw, temporal, locale)

  return {
    title:               raw.title               ?? null,
    description:         raw.description         ?? null,
    description_format:  raw.description_format  ?? 'plain',
    date_label:          raw.date_label          ?? null,
    display_date,
    display_date_source,
    tags:          Array.isArray(raw.tags)    ? raw.tags    : [],
    sources:       Array.isArray(raw.sources) ? raw.sources : [],
    translations:  raw.translations ?? null,
  }
}

function normalizeTemporal(raw, calResolution, uniResolution, warnings) {
  if (!raw) return null

  // Determine whether timestamps can be resolved
  const calId = calResolution?.id ?? null
  const isResolvable = calId && (
    calResolution.type === 'builtin' ||
    calResolution.type === 'resolved' ||
    calResolution.type === 'fallback'
  )

  const isFloating = !isResolvable

  if (isFloating) {
    warnings.push({
      level:   'warn',
      code:    WARNING_CODES.FLOATING_EVENT,
      message: `Calendar '${calId ?? '(none)'}' could not be resolved. Event placed on floating track per §7.3.`,
      field:   'temporal.calendar',
    })
  }

  const startUnix = isFloating
    ? null
    : resolveUnixTimestamp(raw.start_value, calId, warnings, 'temporal.start_value')

  const endUnix = (isFloating || !raw.end_value)
    ? null
    : resolveUnixTimestamp(raw.end_value, calId, warnings, 'temporal.end_value')

  return {
    universe:    raw.universe    ?? null,
    calendar:    raw.calendar    ?? null,
    start_value: raw.start_value ?? null,
    end_value:   raw.end_value   ?? null,
    precision:   raw.precision   ?? null,
    format_hint: raw.format_hint ?? null,
    uncertainty: raw.uncertainty ?? null,
    resolved: {
      start_unix:     startUnix,
      end_unix:       endUnix,
      is_point_event: !raw.end_value,
      is_floating:    isFloating,
    },
  }
}

function normalizeSpatial(raw, bodyResolution, warnings) {
  if (!raw) return null

  if (bodyResolution.type === 'unresolved') {
    warnings.push({
      level:   'warn',
      code:    WARNING_CODES.UNRESOLVED_BODY_REF,
      message: `Body '${bodyResolution.id}' is not a recognized built-in and has no inline definition.`,
      field:   'spatial.body',
    })
  }

  return {
    body:          raw.body          ?? null,
    crs:           raw.crs           ?? null,
    region_codes:  Array.isArray(raw.region_codes) ? raw.region_codes : [],
    custom_region: raw.custom_region ?? null,
    geometry:      raw.geometry      ?? null,
    resolved_body: (bodyResolution.type !== 'none' && bodyResolution.type !== 'unresolved')
                   ? bodyResolution.definition
                   : null,
  }
}

function normalizeSignificance(raw) {
  if (!raw) return null
  return {
    value:            raw.value            ?? null,
    temporal_scope:   raw.temporal_scope   ?? null,
    geographic_scope: raw.geographic_scope ?? null,
    metrics:    Array.isArray(raw.metrics) ? raw.metrics : [],
    visibility: raw.visibility ?? null,
  }
}

async function normalizeRelations(rawRelations, opts, warnings) {
  if (!Array.isArray(rawRelations)) return []

  const results = []

  for (let i = 0; i < rawRelations.length; i++) {
    const rel = rawRelations[i]
    let resolved = { status: 'unresolved', event: null }

    if (opts.fetchRelations && rel.target_url && rel.target_id) {
      try {
        const controller = new AbortController()
        const timer = setTimeout(() => controller.abort(), opts.fetchTimeout)
        const res = await fetch(rel.target_url, { signal: controller.signal })
        clearTimeout(timer)

        if (!res.ok) throw new Error(`HTTP ${res.status}`)
        const targetRaw = await res.json()

        if (targetRaw?.event?.id && targetRaw.event.id !== rel.target_id) {
          warnings.push({
            level:   'warn',
            code:    WARNING_CODES.RELATION_ID_MISMATCH,
            message: `relations[${i}]: fetched event.id '${targetRaw.event.id}' does not match target_id '${rel.target_id}'.`,
            field:   `event.relations[${i}].target_id`,
          })
          resolved = { status: 'id_mismatch', event: null }
        } else {
          // Parse the fetched event — fetchRelations: false prevents circular fetching
          const fetchedEvent = await parse(targetRaw, { ...opts, fetchRelations: false })
          resolved = { status: 'fetched', event: fetchedEvent }
        }
      } catch (err) {
        warnings.push({
          level:   'info',
          code:    WARNING_CODES.RELATION_FETCH_FAILED,
          message: `relations[${i}]: could not fetch '${rel.target_url}' (${err.message}).`,
          field:   `event.relations[${i}].target_url`,
        })
      }
    }

    results.push({
      type:          rel.type          ?? null,
      target_id:     rel.target_id     ?? null,
      target_url:    rel.target_url    ?? null,
      description:   rel.description   ?? null,
      canon:         rel.canon         ?? null,
      confidence:    rel.confidence     ?? null,
      bidirectional: rel.bidirectional ?? false,
      _resolved:     resolved,
    })
  }

  return results
}

// ─────────────────────────────────────────────────────────────────────────────
// § 10. Internal: build a minimal failure result
// ─────────────────────────────────────────────────────────────────────────────

function makeFailureResult(raw, errors, allWarnings, opts, parsedAt) {
  return {
    _parse: {
      ok:             false,
      schema_version: raw?.meta?.schema_version ?? null,
      parsed_at:      parsedAt,
      source_url:     null,
      warnings:       allWarnings.filter(w => meetsLevel(w.level, opts.minLevel)),
      errors,
    },
    _resolution: { calendar: null, universe: null, body: null },
    _raw: raw,
    id:            raw?.event?.id            ?? null,
    type:          raw?.event?.type          ?? 'event',
    original_type: raw?.event?.original_type ?? null,
    content:      null,
    temporal:     null,
    spatial:      null,
    significance: null,
    relations:    [],
    recurrence:   null,
    dynamic:      null,
    custom_data:  null,
  }
}

// ─────────────────────────────────────────────────────────────────────────────
// § 11. Core exports
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Parse a .chron file into a normalized ParsedEvent object.
 *
 * @param   {string|object} input    - JSON string or pre-parsed object
 * @param   {object}        [options]
 * @param   {'debug'|'info'|'warn'|'error'} [options.minLevel='warn']
 * @param   {string|null}   [options.locale=null]           - BCP 47 locale
 * @param   {boolean}       [options.fetchRelations=false]
 * @param   {number}        [options.fetchTimeout=5000]     - ms
 * @param   {'bundled'|'remote'} [options.schemaSource='bundled']
 *
 * @returns {Promise<ParsedEvent>}
 *
 * @throws  {TypeError}    if input is not a string or plain object
 * @throws  {SyntaxError}  if input is a string containing invalid JSON
 */
export async function parse(input, options = {}) {
  // ── Input coercion ─────────────────────────────────────────────────────────
  if (input === null || input === undefined || typeof input === 'number' || Array.isArray(input)) {
    throw new TypeError(
      `parse() expects a JSON string or plain object; received ${Array.isArray(input) ? 'array' : String(input === null ? 'null' : typeof input)}.`
    )
  }

  // JSON.parse throws SyntaxError on bad input — intentional per contract
  const raw = typeof input === 'string' ? JSON.parse(input) : input

  const opts = {
    minLevel:       options.minLevel       ?? 'warn',
    locale:         options.locale         ?? null,
    fetchRelations: options.fetchRelations ?? false,
    fetchTimeout:   options.fetchTimeout   ?? 5000,
    schemaSource:   options.schemaSource   ?? 'bundled',
  }

  const parsedAt    = new Date().toISOString()
  const allWarnings = []   // collected throughout; filtered to minLevel at end

  // ── 1. Structural validation ───────────────────────────────────────────────
  const { errors: validationErrors, warnings: validationWarnings } = validateRaw(raw)
  allWarnings.push(...validationErrors, ...validationWarnings)

  if (validationErrors.some(e => e.level === 'error')) {
    return makeFailureResult(raw, validationErrors, allWarnings, opts, parsedAt)
  }

  const event       = raw.event
  const definitions = raw.definitions ?? {}

  // ── 2. Event type normalization ────────────────────────────────────────────
  const eventType = event.type ?? 'event'
  if (!event.type) {
    allWarnings.push({
      level:   'debug',
      code:    WARNING_CODES.TYPE_DEFAULTED,
      message: 'event.type absent; defaulted to "event" per spec §3.',
      field:   'event.type',
    })
  }

  // ── 3. Universe resolution ─────────────────────────────────────────────────
  const rawUniId     = event.temporal?.universe ?? null
  const uniResolution = resolveUniverse(definitions, rawUniId)

  if (uniResolution.type === 'unresolved') {
    allWarnings.push({
      level:   'warn',
      code:    WARNING_CODES.UNRESOLVED_UNIVERSE_REF,
      message: `Universe '${uniResolution.id}' could not be resolved.`,
      field:   'temporal.universe',
    })
  }

  // ── 4. Calendar resolution ─────────────────────────────────────────────────
  // Prefer explicit temporal.calendar; fall back to universe defaults.calendar
  let effectiveCalendar = event.temporal?.calendar ?? null

  if (!effectiveCalendar && uniResolution.definition?.defaults?.calendar) {
    effectiveCalendar = uniResolution.definition.defaults.calendar
    allWarnings.push({
      level:   'debug',
      code:    WARNING_CODES.UNIVERSE_DEFAULT_CALENDAR,
      message: `Calendar inherited from universe '${uniResolution.id}' default: '${effectiveCalendar}'.`,
      field:   'temporal.calendar',
    })
  }

  let calResolution = resolveCalendarSync(definitions, effectiveCalendar)

  // Attempt external fetch if needed
  if (calResolution.type === 'unresolved' && calResolution._ref) {
    calResolution = await resolveExternalCalendar(calResolution, opts.fetchTimeout, allWarnings)
  }

  // ── 5. Body resolution ────────────────────────────────────────────────────
  const bodyResolution = resolveBody(definitions, event.spatial?.body ?? null)

  // ── 6. Block normalization ────────────────────────────────────────────────
  const content     = normalizeContent(event.content, event.temporal, opts.locale)
  const temporal    = normalizeTemporal(event.temporal, calResolution, uniResolution, allWarnings)
  const spatial     = normalizeSpatial(event.spatial, bodyResolution, allWarnings)
  const significance = normalizeSignificance(event.significance)
  const relations   = await normalizeRelations(event.relations, opts, allWarnings)

  // ── 7. Build clean _resolution (strip internal keys) ──────────────────────
  const resolution = {
    calendar: { id: calResolution.id,  type: calResolution.type,  source: calResolution.source  },
    universe: { id: uniResolution.id,  type: uniResolution.type,  source: uniResolution.source  },
    body:     { id: bodyResolution.id, type: bodyResolution.type, source: bodyResolution.source },
  }

  // ── 8. Filter warnings to minLevel ────────────────────────────────────────
  const hasError         = allWarnings.some(w => w.level === 'error')
  const filteredWarnings = allWarnings.filter(w => meetsLevel(w.level, opts.minLevel))

  // ── 9. Assemble and return ParsedEvent ────────────────────────────────────
  return {
    _parse: {
      ok:             !hasError,
      schema_version: raw.meta?.schema_version ?? null,
      parsed_at:      parsedAt,
      source_url:     null,
      warnings:       filteredWarnings,
      errors:         allWarnings.filter(w => w.level === 'error'),
    },
    _resolution: resolution,
    _raw:        raw,

    id:            event.id,
    type:          eventType,
    original_type: event.original_type ?? null,

    content,
    temporal,
    spatial,
    significance,
    relations,
    recurrence:  event.recurrence  ?? null,
    dynamic:     event.dynamic     ?? null,
    custom_data: event.custom_data ?? null,
  }
}

/**
 * Synchronous schema validation only. No resolution, no output object.
 * Safe to call in hot paths — no async, no fetch, no allocations beyond
 * the error/warning arrays.
 *
 * @param   {string|object} input
 * @returns {{ ok: boolean, errors: object[], warnings: object[] }}
 */
export function validate(input) {
  let raw
  try {
    raw = typeof input === 'string' ? JSON.parse(input) : input
  } catch (e) {
    return {
      ok:       false,
      errors:   [{ level: 'error', code: WARNING_CODES.INVALID_JSON, message: e.message, field: null }],
      warnings: [],
    }
  }

  const { errors, warnings } = validateRaw(raw)
  return {
    ok:       errors.filter(e => e.level === 'error').length === 0,
    errors,
    warnings,
  }
}

// ─────────────────────────────────────────────────────────────────────────────
// § 12. Utility exports
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Returns true if the event is a tombstone (deleted event record).
 * Always check this before accessing content fields.
 * @param {object} event - ParsedEvent
 */
export function isTombstone(event) {
  return event?.type === 'tombstone'
}

/**
 * Returns true if the event's calendar could not be resolved.
 * Floating events must be rendered on a separate track per §7.3.
 * @param {object} event - ParsedEvent
 */
export function isFloating(event) {
  return event?.temporal?.resolved?.is_floating === true
}

/**
 * Returns warnings from a parsed event at or above the given severity level.
 * Independent of the minLevel used during parsing — operates on whatever
 * was captured. If minLevel is omitted, all captured warnings are returned.
 *
 * @param {object}  event     - ParsedEvent
 * @param {string}  [minLevel]
 * @returns {object[]}
 */
export function getWarnings(event, minLevel) {
  const warnings = event?._parse?.warnings ?? []
  if (!minLevel) return warnings
  return warnings.filter(w => meetsLevel(w.level, minLevel))
}

/**
 * Returns a shallow copy of the event with all parser metadata removed.
 * Strips _parse, _resolution, and _raw. Does not mutate the original.
 * Use this before passing an event to a viewer layer.
 *
 * @param {object} event - ParsedEvent
 * @returns {object}
 */
export function stripMeta(event) {
  const { _parse, _resolution, _raw, ...rest } = event
  return rest
}
