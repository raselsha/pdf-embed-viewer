=== 3D Flipbook PDF Viewer & Embedder ===

Contributors:      raselsha
Requires at least: 3.0
Tested up to:      7.0
Requires PHP:      7.0
Stable tag:        1.5.1
License:           GPLv2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
Tags:              pdf-viewer, pdf-embed, flipbook, 3d-flipbook, ebook, elementor, document-viewer, digital-publishing

Embed PDFs as an interactive 3D flipbook or standard viewer — perfect for eBooks, catalogs, manuals, newsletters & reports.

== Description ==
**3D Flipbook PDF Viewer & Embedder** is a free WordPress plugin for displaying PDF documents as a realistic, interactive **3D page-flip flipbook** — or as a standard traditional PDF viewer — anywhere on your site. It's the PDF viewer of choice for eBooks, digital magazines, product catalogs, brochures, manuals, newsletters, and reports.

No coding required: upload a PDF, drop in a shortcode (or use the included **Elementor** widgets for full drag-and-drop setup), and you're done. Built-in read/download counters, customizable action buttons, category organization, and a modern PDF Embed admin screen make it easy to manage a whole library of documents. Watch [live Demo](https://flipbook.lieusoft.com/)

https://www.youtube.com/watch?v=8EgfVxynlPo



## Archive View Templates Supported
* **List** 📋
* **Grid** 🟦
* **Newsletter** 📰
* **Ebook** 📚

## Elementor Widgets

**Effortless Elementor Integration** ⚡

- Add **Archive View** and **Single PDF View** widgets to your pages with simple drag-and-drop.
- Instantly display PDF lists or single documents—full support for all shortcode attributes.
- Visually customize layouts, buttons, and counters—no coding needed. 🎨
- Fully compatible with all Elementor-ready themes for maximum flexibility.

## Shortcodes Overview

Easily embed and customize PDF displays using our shortcodes. Use the built-in generator for quick setup. 🛠️

### Archive/Multiple PDFs Shortcode

Use `[pdfev_viewer]` to display a list, grid, ebook, or newsletter-style archive of PDFs.

**Attributes:**

- `template`  
  Layout style: `list`, `grid`, `ebook`, `newsletter` (default: `list`)

- `limit`  
  Number of items to show (default: `10`)

- `order`  
  Display order: `asc`, `dsc` (default: `dsc`)

- `read`  
  Show Read button: `yes`, `no` (default: `yes`)

- `download`  
  Show Download button: `yes`, `no` (default: `yes`)

- `reading_count`  
  Show read counter: `yes`, `no` (default: `yes`)

- `downloading_count`  
  Show download counter: `yes`, `no` (default: `yes`)

- `show_description`  
  Show description: `yes`, `no` (default: `yes`)

- `show_author`  
  Show author: `yes`, `no` (default: `yes`)

- `show_publisher`  
  Show publisher: `yes`, `no` (default: `yes`)

- `show_year`  
  Show published year: `yes`, `no` (default: `yes`)

- `show_edition`  
  Show edition: `yes`, `no` (default: `yes`)

**Examples:**

- `[pdfev_viewer template="grid" limit="10" order="dsc" read="yes" download="yes" reading_count="yes" downloading_count="yes" show_description="yes" show_author="yes" show_publisher="yes" show_year="yes" show_edition="yes"]`
- `[pdfev_viewer template="list"]`
- `[pdfev_viewer template="ebook"]`
- `[pdfev_viewer template="newsletter"]`

### Single PDF Shortcode

Display a single PDF by post ID:

- `[pdfev_embed_viewer id="post_id"]`

## Features

- **Embed PDFs Anywhere**
  Add PDFs to any post or page with a shortcode—choose between traditional or interactive 3D Flipbook views.

- **Seamless Theme Integration**
  The single PDF page renders using your active theme's own header and footer, including modern block themes—no mismatched styling or duplicated titles.

- **Multiple Archive Templates**  
  Display your PDFs in `list`, `grid`, `ebook`, or `newsletter` layouts.

- **Document Meta Visibility Controls**  
  Show or hide document Description, Author, Publisher, Published Year, and Edition information from settings.

- **Flexible Shortcodes**  
  Use shortcodes to control layout, buttons, counters, and more.

- **Shortcode Generator**  
  Create custom shortcodes easily from the plugin settings.

- **Elementor Integration**  
  Drag-and-drop archive or single PDF widgets into your pages.

- **Category Support**  
  Organize PDFs by category for easy browsing.

- **Remote PDFs Support**
  A remote PDF URL can be used directly, or cloned into your own Media Library with one click.

- **Interactive Ebook View**
  The `ebook` template opens each cover on hover with a smooth 3D animation and shows a real preview of the document's next page, not just a placeholder.

- **Reading Direction (RTL/LTR) Support**
  Set each document's reading direction individually — the flipbook, its Previous/Next arrows, and the ebook grid's hover animation all mirror correctly for Arabic, Hebrew, and other right-to-left documents.

- **3D Flipbook & Standard Modes**
  Let users switch between immersive 3D and standard PDF views.

- **Usage Counters**  
  Track reads and downloads for each PDF.

- **Admin Menu**  
  Manage all documents from a dedicated dashboard menu.

- **Modern Settings Dashboard**  
  A sidebar-navigation settings page with card layouts, toggle switches, and styled dropdowns for a cleaner configuration experience.

- **Redesigned PDF Editor Screen**  
  Manage General, Book Information, and Template settings from organized tabs when adding or editing a PDF.

- **Color Customization**  
  Adjust colors from the settings page.

- **Custom Archive URLs**  
  Change the archive page slug to fit your site.

- **Download Button Toggle**  
  Enable or disable the download button as needed.

- **Editable Archive Titles**  
  Set custom titles for archive pages.

- **Archive & Single Shortcodes**  
  Show all documents or a single PDF with dedicated shortcodes.

- **Demo Import**  
  Add sample content with one click.

- **Multilingual Ready**  
  Compatible with translation plugins.

- **Read & Download Button Control**  
  Show or hide Read and Download buttons as needed.

== Screenshots ==

1. Interactive 3D flipbook view with realistic page-flip animation.
2. E-Book archive grid — hover a cover to flip it open and preview the document.
3. List, Grid, and Newsletter archive layouts for displaying multiple PDFs.
4. Modern PDF Embed post editor — General, Book Info, and Template tabs.
5. Plugin settings dashboard with archive, display, and branding options.
6. Elementor widgets for drag-and-drop Archive and Single PDF views.

== Installation ==

= Install via WordPress Dashboard =

1. Go to 'Plugins' > 'Add New' in your WordPress dashboard.
2. Click 'Upload Plugin'.
3. Choose the `pdf-embed-viewer.zip` file from your computer.
4. Click 'Install Now', then activate the plugin. ✅

= Install via FTP =

1. Download `pdf-embed-viewer.zip` and extract it.
2. Upload the extracted `pdf-embed-viewer` folder to `/wp-content/plugins/` on your server.
3. Go to 'Plugins' in your WordPress dashboard and activate the plugin. ✅

## Privacy Policy
PDF Embed Viewer uses the [Appsero](https://appsero.com) SDK to collect basic telemetry data, but **only after you give explicit consent** via the admin notice. This data helps us improve the plugin and troubleshoot issues. 🛡️

By default, Appsero SDK **does not collect any data**. Data collection begins **only if you allow it**. No personal or sensitive information is gathered without your permission.

For more details, see the [Appsero Privacy Policy](https://appsero.com/privacy-policy/). 🔒

=== Languages ===
* English (en_US)
* Bengali (bn_BD)
* French (fr_FR)

== Changelog ==

= 1.5.1 =
* Added a per-document Reading Direction (RTL/LTR) setting — the flipbook, its Previous/Next arrows, and the E-Book archive grid's hover effect all now flip correctly for Arabic/Hebrew and other right-to-left documents, on a per-book basis.
* Redesigned the E-Book archive grid: a smoother 3D cover-flip animation, a real preview of the document's second page rendered on hover (instead of a placeholder icon), hardcover-style page-thickness edges, and a fully responsive grid sized to the covers themselves.
* Fixed the single PDF page's header and footer looking different from the rest of the site on block themes (e.g. a smaller site title, missing navigation) — it now matches the theme's own header/footer exactly.
* Fixed a block theme adding its own duplicate title, a blank byline, and unrelated content (a second Previous/Next navigation, a "more posts" list) around the plugin's single PDF page.
* Fixed the single PDF page's title/actions and Previous/Next navigation not lining up with the width of the PDF viewer below them.
* Fixed a large empty gap that could appear at the bottom of the single PDF page on block themes.
* Added a "Download to Media Library" button to clone a remote PDF URL into your own site's Media Library.
* The Featured Image box now stays in sync with the Book Cover preview when you set a featured image.
* Redesigned the Book Info and Template tabs of the PDF editor screen with the same modern dropdowns, panels, and description editor as the rest of the settings.
* Added a Copy button for the single-item shortcode shown in the post editor.
* Fixed the settings page's bottom Save button not submitting the form.

= 1.5.0 =
* Redesigned the settings page and the PDF editor screen with a modern sidebar-navigation layout, cards, toggles, and styled dropdowns.
* Security: settings save now also verifies the current user's capability, not just the nonce.
* Fixed: flipbook scripts and styles were being loaded on every page of the site instead of only pages that actually display a PDF viewer.
* Added extensibility hooks so an official Pro add-on can offer secure PDF delivery and extra flipbook display options, without modifying this plugin's files.

= 1.4.4 =
* Security fix: PDF proxy endpoint could be used to reach internal/private network addresses; now restricted to public http(s) hosts and verified PDF responses only.
* Security fix: post save and download-counter requests are now properly nonce-verified.
* Fixed: admin list columns for download/view counts no longer routed through translation lookups.
* Fixed: featured image upload now verifies the file is a real image before saving.

= 1.4.2 =
* file size and pages count added with settings.

= 1.4.1 =
* pagination upgrade to ajax load more.

= 1.4.0 =
* Author, Description, Published Year, Published Edition fields Added.
* Global setting to display/hide of these info settings added.
* all template design updated with buttons.

= 1.3.9 =
* fixed. shortcode for single item id missing issue.

= 1.3.8 =
* pdf.js and pdf.worker.js library update.

= 1.3.7 =
* on plugin activation show dummy data import notice. 

= 1.3.6 =
* Remote pdf file can be used instead of uploaded. 

= 1.3.5 =
* github to wordpress release

= 1.3.4 =
* Translation Updated
* France language Updated


= 1.3.3 =
* Added category feature 🏷️
* Elementor widgets now support category selection 🧩

= 1.3.2 =
* Fixed full width issue in archive list view

= 1.3.1 =
* Fixed settings options saving issue

= 1.3.0 =
* Added Elementor Widgets Support 🧩
* Introduced Archive View and Single View Widgets

= 1.2.8 =
* Refactored code
* Added support form
* Adjusted width for single and shortcode pages
* Added preview image setup

= 1.2.7 =
* Fixed toggle button for single page shortcode
* Backend now shows file size and total pages

= 1.2.6 =
* Added PDF preview thumbnail generation 🖼️
* Set featured image from preview thumbnail

= 1.2.5 =
* Fixed admin icons
* Added Shortcode Generator 🛠️

= 1.2.4 =
* Added template shortcode attribute
* Added ebook cover flipping style on hover 📚
* Updated ebook design

= 1.2.3 =
* Fixed archive view pagination

= 1.2.2 =
* Updated single page template
* Updated shortcode view for 3D flipbook

= 1.2.1 =
* Fixed empty page loading issue

= 1.2.0 =
* Added 3D flipbook library 📖

= 1.1.2 =
* Added demo pages for shortcode view 🚀
* Fixed default counter value
* Refactored code

= 1.1.1 =
* Added option to return page when using shortcode
* Added setting to show/hide counter
* Refactored code

= 1.1.0 =
* Fixed missing template file error

= 1.0.10 =
* Fixed download button counter
* Added read button show/hide settings
* Improved button styles
* Added template hook for editing templates
* Added download and read data to post table

= 1.0.9 =
* Improved grid and ebook archive view responsiveness and CSS

= 1.0.8 =
* Fixed fatal error with count manager
* Fixed single page navigation icon

= 1.0.7 =
* Added PDF read and download counters 📊
* Updated translations

= 1.0.6 =
* Fixed demo import button 🚀
* Updated translations

= 1.0.5 =
* Made archive page slug editable from settings
* Added import demo button 🚀
* Updated translations

= 1.0.4 =
* Added shortcode for single view
* Improved button translation and read button
* Added download button hover effect
* Added shortcode section to general tab
* Added shortcode column to backend

= 1.0.3 =
* Added shortcode for 4 template views
* Fixed color changing issue for templates
* Added translation for template header
* Inserted sample data on activation

= 1.0.2 =
* Set up Appsero analytics

= 1.0.1 =
* Added admin support info

= 1.0.0 =
* Initial release 🎉

== Frequently Asked Questions ==

= What is the best free WordPress plugin for a 3D flipbook PDF viewer? =
3D Flipbook PDF Viewer & Embedder lets you display any PDF as a realistic, interactive page-flip flipbook — or as a standard PDF viewer — on any post, page, or Elementor layout, completely free.

= How do I embed a PDF on a single page or post? =
Use the shortcode `[pdfev_embed_viewer id="post_id"]`, replacing `post_id` with the ID of your uploaded PDF post.

= How do I show a PDF as a flipbook instead of a plain embed? =
Every uploaded PDF automatically gets an interactive 3D Flipbook view — visitors can toggle between the Flipbook and a Traditional (standard) viewer right on the page, no extra setup needed.

= Can I create a gallery or archive of multiple PDFs? =
Yes! Use `[pdfev_viewer template="list"]`, `[pdfev_viewer template="grid"]`, `[pdfev_viewer template="ebook"]`, or `[pdfev_viewer template="newsletter"]` to display different archive layouts.

= Does it support right-to-left (RTL) documents like Arabic or Hebrew PDFs? =
Yes. Each document has its own Reading Direction setting — when set to RTL, the flipbook, its Previous/Next navigation, and the E-Book grid's hover animation all mirror correctly for that document, independent of your site's overall language.

= Will the single PDF page match my theme, including block themes? =
Yes. The single PDF view renders using your active theme's own header and footer — including modern block themes like Twenty Twenty-Five — so it looks like a native part of your site, not a plugin bolt-on.

= Does the plugin support Elementor? =
Yes, the plugin includes Elementor widgets for both archive and single PDF views. You can drag-and-drop PDF lists or individual PDF viewers into your pages, with full support for shortcode attributes and visual customization.

= Can I organize my PDFs by category? =
Yes, you can assign categories to your PDFs, making it easy to organize and allow users to browse documents by topic or type.

= Can I use my PDFs from a remote server? =
Yes, you can link to a PDF hosted on a remote server, or clone it into your own Media Library with one click.


= How do I track how many times a PDF is read or downloaded? =
The plugin automatically tracks reads and downloads. You can view the counts in the plugin settings and post list.

= Is there an option to show or hide the download and view counters on buttons? =
Yes, you can enable or disable the read (view) and download counters on the action buttons from the plugin settings.

= Can I customize the archive page URL and titles? =
Yes, you can change the archive page slug and title from the plugin settings.

= How do I switch between the Traditional PDF View and 3D Flipbook View? =
You can choose your preferred mode in the plugin’s settings.

= Does the plugin support multiple languages? =
Yes, it is translation-ready and compatible with multilingual websites.

= Can I override the plugin templates in my child theme? =
Yes, copy the desired template files from the plugin’s `template/` folder to your child theme (e.g., `your-child-theme/template/archive.php`). You can then modify the copied files as needed.

= How do I import demo content? =
Click the "Import Demo" button in the plugin settings to quickly add sample content.

= Will this plugin slow down my website? =
No, the plugin is lightweight and optimized for fast performance.

= Do I need coding knowledge to use this plugin? =
No coding skills are required. You can manage everything with shortcodes and plugin settings.

= Is Appsero collecting my private data? =
No. Appsero only collects basic telemetry data after you give permission. It’s 100% optional and secure.
