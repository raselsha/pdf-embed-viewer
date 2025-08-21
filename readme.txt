=== 3D Flipbook PDF Viewer & Embedder ===

Contributors:      raselsha
Requires at least: 3.0
Tested up to:      6.8
Requires PHP:      7.0
Stable tag:        trunk
License:           GPLv2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
Tags:              3d-flipbook, ebook, flipbook, pdf-embed, elementor

Display PDFs as interactive 3D flipbooks or standard viewers—ideal for eBooks, manuals, newsletters, and reports.

== Description ==
**3D Flipbook PDF Viewer & Embedder** enables you to embed and display PDFs on your WordPress site in both traditional and interactive 3D Flipbook modes. Easily showcase documents, newsletters, and eBooks with read/download counters, customizable action buttons, and an intuitive interface. Elementor widgets are included for drag-and-drop embedding of single PDFs or archives. 🖱️


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

**Examples:**

- `[pdfev_viewer template="list" limit="10" order="dsc" read="yes" download="yes" reading_count="yes" downloading_count="yes"]`
- `[pdfev_viewer template="grid"]`
- `[pdfev_viewer template="ebook" limit="10" order="asc" read="yes" download="yes"]`
- `[pdfev_viewer template="newsletter" limit="30" order="dsc"]`

### Single PDF Shortcode

Display a single PDF by post ID:

- `[pdfev_embed_viewer id="post_id"]`

## Features

- **Embed PDFs Anywhere**  
  Add PDFs to any post or page with a shortcode—choose between traditional or interactive 3D Flipbook views.

- **Multiple Archive Templates**  
  Display your PDFs in `list`, `grid`, `ebook`, or `newsletter` layouts.

- **Flexible Shortcodes**  
  Use shortcodes to control layout, buttons, counters, and more.

- **Shortcode Generator**  
  Create custom shortcodes easily from the plugin settings.

- **Elementor Integration**  
  Drag-and-drop archive or single PDF widgets into your pages.

- **Category Support**  
  Organize PDFs by category for easy browsing.

- **Interactive Ebook View**  
  The `ebook` template features a hover-preview for a realistic book effect.

- **3D Flipbook & Standard Modes**  
  Let users switch between immersive 3D and standard PDF views.

- **Usage Counters**  
  Track reads and downloads for each PDF.

- **Admin Menu**  
  Manage all documents from a dedicated dashboard menu.

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

== Screenshot ==

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

= How do I embed a PDF on a single page or post? =
Use the shortcode `[pdfev_embed_viewer id="post_id"]`, replacing `post_id` with the ID of your uploaded PDF post.

= Can I create a gallery or archive of multiple PDFs? =
Yes! Use `[pdfev_viewer template="list"]`, `[pdfev_viewer template="grid"]`, `[pdfev_viewer template="ebook"]`, or `[pdfev_viewer template="newsletter"]` to display different archive layouts.

= Does the plugin support Elementor? =
Yes, the plugin includes Elementor widgets for both archive and single PDF views. You can drag-and-drop PDF lists or individual PDF viewers into your pages, with full support for shortcode attributes and visual customization.

= Can I organize my PDFs by category? =
Yes, you can assign categories to your PDFs, making it easy to organize and allow users to browse documents by topic or type.

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
