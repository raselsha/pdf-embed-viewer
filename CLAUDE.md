# PDF Embed Viewer — CLAUDE.md

## Project
"3D Flipbook PDF Viewer & Embedder" — WordPress plugin (`pdf-embed-viewer.php`, text domain
`pdf-embed-viewer`). Displays PDFs as an interactive 3D flipbook (via bundled `3dflipbook`/`pdf.js`
vendor libs) or a plain iframe viewer, for e-books, manuals, newsletters, and reports.

Always follow WordPress Coding Standards. Professional plugin — no shortcuts on escaping,
sanitization, or nonces.

### Tech Stack
- PHP 7.0+ (declared `Requires PHP: 7.0`, but written loosely — verify before using PHP 8-only syntax)
- WordPress (CPT/taxonomy/postmeta/options — **no custom DB tables**)
- JavaScript (jQuery, ES5-ish, no build step)
- Elementor widgets (optional integration, only loaded if Elementor is active)
- Frontend CSS (`assets/css/frontend.css`) is compiled from SCSS under `assets/scss/frontend/`
  (`npm run frontend` to watch). **Admin CSS (`assets/css/admin.css`) is hand-written plain CSS,
  edited directly — no build step.** It uses native CSS nesting (widely supported in current
  browsers, which is all wp-admin needs), so it stays organized the way the old SCSS was without
  needing a compiler.

### Architecture
- **Entry**: `pdf-embed-viewer.php` — defines `PDFEV_Const_*` constants, manually `require_once`s
  every class file (no autoloader), boots `PDFEV_Embed_Viewer`.
- **Namespacing is inconsistent**: some classes live in `PDFEV\` (e.g. `PDFEV\CPT`, `PDFEV\Shortcode`,
  `PDFEV\Template`, `PDFEV\Count_Manager`, `PDFEV\Admin_Settings`), others are global with a `PDFEV_`
  prefix (`PDFEV_Functions`, `PDFEV_Embed_Viewer`). Match whichever style the file you're editing
  already uses; don't silently "fix" this without asking, since it'd touch every `\PDFEV_Functions::`
  call site.
- **Classes** (`classes/`): each file instantiates itself as a singleton at the bottom
  (`new \PDFEV\Foo();` / `new PDFEV_Functions();`) and wires up via `add_action`/`add_filter`, almost
  entirely on `init`.
  - `cpt-register.php` — registers the `pdfev_embed_viewer` CPT and `pdfev_category` /
    `pdfev_author` / `pdfev_publisher` taxonomies.
  - `functions.php` — `PDFEV_Functions`, the general-purpose helper/render bucket (shortcode markup,
    PDF link resolution incl. the remote-file proxy, buttons, AJAX "load more" handler, Appsero
    telemetry init).
  - `shortcode.php` — registers `[pdfev_embed_viewer]` (single) and `[pdfev_viewer]` (archive).
  - `template.php` / `template/` / `template/style/*.php` — archive (list/grid/newsletter/ebook) and
    single-page rendering, hooked through `pdfev_template_*` actions so themes can override via
    `do_action`.
  - `metabox-register.php`, `metabox/*.php` — the post-edit-screen metabox (General / Book Info /
    Template tabs) and its `save_post` handler.
  - `admin-settings.php`, `settings/*.php` — the plugin settings page (General / Shortcode Generator
    / Support tabs), each tab is its own class hooked via `pdfev_settings_tabs*` actions.
  - `count-manager.php` — view/download counters stored as postmeta, incremented via AJAX.
  - `insert-demo.php` — one-click demo content importer (AJAX + admin notice).
  - `elementor/` — Elementor widget registrations (`Single View`, `Archive View`), both just build a
    shortcode string and run it through `do_shortcode()`.
- **Assets** (`assets/`): `js/frontend.js` (viewer, load-more, download counter AJAX),
  `js/admin.js` (metabox uploader/preview, settings page), CSS + SCSS.
- **Vendor** (`vendor/`): `pdf.js`, `3dflipbook`, `font-awesome`, `appsero` (telemetry SDK) —
  never edit these directly; if a fix is needed there, patch it in our own JS/CSS instead of the
  vendor file.

## Key Patterns
- **Remote PDFs are proxied, not iframed directly**: `PDFEV_Functions::get_pdf_link()` detects
  when `pdfev_meta_pdf_url` points at a different host than `home_url()` and rewrites it to
  `?pdfev_proxy=<url>`, handled by `PDFEV_Functions::pdfev_proxy()` (hooked on `init`). This exists
  to route around CORS/X-Frame-Options on third-party PDF hosts. **This endpoint is unauthenticated
  and public by design** (any visitor's browser needs to load PDFs through it) — any change here
  needs to keep it restricted to `http(s)` + path ending in `.pdf` + non-private/non-reserved
  resolved IP (see `PDFEV_Functions::is_allowed_proxy_url()`), and must verify the upstream
  `Content-Type` before echoing the body back. Do not relax these checks; this is exactly the kind
  of endpoint that becomes an open SSRF/XSS proxy if the validation is loosened "to fix a bug
  report" about some legitimate PDF failing to load — investigate the specific host instead.
- **AJAX handlers**: all registered via `wp_ajax_*` / `wp_ajax_nopriv_*` for the public-facing ones
  (`pdfev_load_more_archive`, `pdfev_count_manager_download`, `pdfev_import_demo_data` — admin-only
  in practice but still nopriv-reachable-shaped) and `wp_ajax_*` only for admin-only ones
  (`pdfev_shortcode_generate`). All of them must call `check_ajax_referer('pdf_ajax_nonce',
  'ajaxnonce')` (or equivalent `wp_verify_nonce`) — the shared nonce is created once via
  `wp_create_nonce('pdf_ajax_nonce')` in `enque-style-script.php` and localized to both the admin
  and frontend scripts as `ajaxnonce`.
- **Post-edit-screen saves**: `Metabox_General::save_post()` (hooked on the global `save_post`
  action, which fires for *every* post type) must check `$_POST['post_type'] ===
  'pdfev_embed_viewer'` **before** anything else, then require+verify the nonce
  (`pdfev_emd_vwr_metabox_nonce`) unconditionally — don't reintroduce an `if (isset($_POST[nonce]))`
  guard with no `else`, since that skips verification entirely when the nonce field is simply
  omitted from the request.
- **Settings page save**: `General_Settings::save_options_data()` on `init`, gated by
  `pdfev_emd_vwr_options_nonce` + `manage_options`.
- **Counters**: `pdfev_meta_views_count` (incremented on `wp_head` for `is_single()`) and
  `pdfev_meta_downloads_count` (incremented via nonce-checked AJAX) — plain postmeta, no locking, so
  under concurrent requests undercounting is possible but acceptable for a vanity metric.
- **Templates are theme-overridable**: `PDFEV_Functions::load_template()` checks
  `get_template_directory() . '/template/style/...'` before falling back to the plugin's own
  `template/style/...`. Preserve this lookup order in any template-loading changes.
- **Appsero telemetry**: `PDFEV_Functions::appsero_init_tracker()` on `plugins_loaded` — third-party
  usage tracking, opt-in per Appsero's own consent flow. Don't add additional outbound telemetry
  without flagging it in `readme.txt`.

## Coding Rules
- Escape all output (`esc_html`, `esc_attr`, `esc_url`) — never use `esc_html__()` /
  `esc_attr__()` on non-translatable dynamic values (counts, meta flags); those are for literal
  UI strings passed through `__()`/gettext, not runtime data. Plain `esc_html()`/`esc_attr()` for
  data.
- Sanitize all `$_POST`/`$_GET` input on the way in (`sanitize_text_field`, `sanitize_url`,
  `absint`, etc.) — this codebase already does this consistently; match the existing style.
- Every state-changing admin/AJAX action needs a nonce check that **fails closed**
  (`if (!isset($nonce) || !wp_verify_nonce(...)) return;`), not fail-open.
- No custom DB tables — this plugin (like the others in this environment) keeps everything in
  CPT/taxonomy/postmeta/options.

## Build/Test
- No build step for PHP.
- `assets/css/admin.css` is edited directly (plain CSS, native nesting) — no compile step.
  `assets/css/frontend.css` is still compiled from SCSS (`npm run frontend` to watch
  `assets/scss/frontend/`).
- `php -l <file>` to check syntax before considering a PHP change done.
- No automated test suite currently exists.
