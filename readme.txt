=== 3D Flipbook PDF Viewer & Embedder – E-Books, Manuals, Newsletters, Reports ===

Contributors:      raselsha
Requires at least: 3.0
Tested up to:      6.8
Requires PHP:      7.0
Stable tag:	       trunk
License:           GPLv2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
Tags:               3d flipbook, ebook, flipbook, pdf, pdf embed,

Display PDFs as interactive 3D flipbooks or traditional viewers for E-Books, Manuals, Newsletters, and Reports.

== Description ==
**3D Flipbook PDF Viewer & Embedder** lets you display and embed PDF files on your WordPress site with traditional or interactive 3D Flipbook views. Ideal for documents, newsletters, and eBooks, it features read/download tracking, customizable buttons, and a user-friendly interface. Now includes Elementor widgets for easily embedding single or archive views using drag-and-drop.

## This plugin supports 4 templates for Archive view
* **List Template**
* **Grid Template**
* **Newsletter Template**
* **Ebook Template**

## Shortcode for multiple template view
Easily generate and customize shortcodes with our built-in shortcode generator.

**Shortcode Attributes**

You can use the `[pdfev_viewer]` shortcode with the following attributes:

- `template`  
  Choose the display layout.  
  **Accepted values**: `list`, `grid`, `ebook`, `newsletter`  
  **Default**: `list`

- `limit`  
  Number of PDF items to display.  
  **Accepted values**: Any number like `5`, `10`, `20`  
  **Default**: `10`

- `order`  
  Set display order.  
  **Accepted values**: `asc`, `dsc`  
  **Default**: `dsc`

- `read`  
  Show or hide the **Read** button.  
  **Accepted values**: `yes`, `no`  
  **Default**: `yes`

- `download`  
  Show or hide the **Download** button.  
  **Accepted values**: `yes`, `no`  
  **Default**: `yes`

- `reading_count`  
  Show or hide how many times the PDF has been read.  
  **Accepted values**: `yes`, `no`  
  **Default**: `yes`

- `downloading_count`  
  Show or hide how many times the PDF has been downloaded.  
  **Accepted values**: `yes`, `no`  
  **Default**: `yes`

**Example**

* [pdfev_viewer `template="list"` `limit="10"` `order="dsc"` `read="yes"` `download="yes"` `reading_count="yes"` `downloading_count="yes"` ]
* [pdfev_viewer `template="grid"` ]
* [pdfev_viewer `template="ebook"` `limit="10"` `order="asc"` `read="yes"` `download="yes"`]
* [pdfev_viewer `template="newsletter"` `limit="30"` `order="dsc"`]

## Shortcode for single page/post
* [pdfev_embed_viewer `id="post_id"`]

## Features

- **Display PDFs Anywhere**  
  Easily embed PDFs into any post or page using a shortcode, supporting both traditional and interactive 3D Flipbook views.

- **Multiple Archive Templates**  
  Choose from four unique display templates: `list`, `grid`, `ebook`, and `newsletter`.

- **Flexible Shortcode Usage**  
  Use shortcodes anywhere to display your PDF documents or e-books with full control over layout and behavior.

- **Shortcode Generator** 
  Easily generate and customize shortcodes with our built-in shortcode generator. Navigate to Settings > Shortcode to create the perfect shortcode for your needs

- **Interactive E-Book View**  
  The `ebook` template includes a smooth hover-preview effect for a realistic book feel.

- **3D Flipbook & Traditional Reading Modes**  
  Readers can view content in either immersive 3D Flipbook mode or standard document view.

- **Usage Tracking**  
  Monitor how many times each PDF has been read or downloaded with built-in counters.

- **Dedicated Admin Menu**  
  A standalone sidebar menu in the WordPress dashboard for managing your documents.

- **Color Customization**  
  Adjust colors easily using the built-in settings page for better design integration.

- **Custom Archive URLs**  
  Modify the archive page URL slug to match your site's structure or branding.

- **Download Button Toggle**  
  Enable or disable the PDF download button as needed from the settings panel.

- **Editable Archive Titles**  
  Set custom titles for your archive pages to suit your content and audience.

- **Archive Page Shortcode**  
  Display an archive of all documents using a dedicated archive shortcode.

- **Single Document Shortcode**  
  Embed individual PDFs using a specialized shortcode for single-view mode.

- **Elementor Widgets Support**
  Includes custom Elementor widgets for both archive and single document views—easily drag-and-drop your PDFs anywhere on the page.

- **Import Demo Content**  
  Quickly set up your site with sample content using the demo import feature.

- **Multilingual Support**  
  Fully compatible with translation plugins to support multiple languages.

- **Read & Download Button Control**  
  Easily show or hide the Read and Download buttons for both viewing modes.

== Screenshot ==

== Installation ==

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select pdf-embed-viewer.zip from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard

= Using FTP =

1. Download pdf-embed-viewer.zip
2. Extract the pdf-embed-viewer directory to your computer
3. Upload the pdf-embed-viewer directory to the /wp-content/plugins/ directory
4. Activate the plugin in the Plugin dashboard


## Privacy Policy
PDF Embed Viewer uses [Appsero](https://appsero.com) SDK to collect some telemetry data upon user's confirmation. This helps us to troubleshoot problems faster & make product improvements.

Appsero SDK **does not gather any data by default.** The SDK only starts gathering basic telemetry data **when a user allows it via the admin notice**. We collect the data to ensure a great user experience for all our users.

Integrating Appsero SDK **DOES NOT IMMEDIATELY** start gathering data, **without confirmation from users in any case.**

Learn more about how [Appsero collects and uses this data](https://appsero.com/privacy-policy/).


== Changelog ==

= 1.3.0 =
* Elementor Widgets Support
* Archive View Widgets
* Single View Widgets

= 1.2.8 =
* Code refactor
* Support Form added
* Single page widh and shortcode page width adjusted
* Preview image setup

= 1.2.7 =
* Shortcode for single page toggle button fix
* Admin backend show the filesize and total pages

= 1.2.6 =
* PDF Prevew thumbnail generation
* Featured image from preview thumbnail

= 1.2.5 =
* fix admin icons
* Shortcode Generator Added

= 1.2.4 =
* Template shortcode Attribute set
* Ebook cover fliping style on hover
* Update E-book Design

= 1.2.3 =
* Arichive view number pagination fix

= 1.2.2 =
* Single page template update
* Shortcode view upate for 3D flipbook

= 1.2.1 =
* Fix empty page loading issue

= 1.2.0 =
* Added 3D flipbook library

= 1.1.2 =
* Insert Demo pages for shortcode view.
* Fix default counter value.
* Code refactor.

= 1.1.1 =
* An option added for return page when use shortcode.
* A settings added for show/hide counter.
* Code refactor.

= 1.1.0 =
* Template file missing error fix.

= 1.0.10 =
* Download button counter fix.
* Read Button show hide settings.
* Read and Download Button style fix.
* Template hook added for edit template.
* Download counter and read data added into post table.

= 1.0.9 =
* Grid Archive view responsive and css update.
* Ebook Archive view responsive and css update.

= 1.0.8 =
* Fatal error fix that count manager not incleded.
* Single page navigation icon fix.

= 1.0.7 =
* Add a new feature to count read a pdf and download counting
* Translation Update

= 1.0.6 =
* Demo import button fix
* Translation Update

= 1.0.5 =
* Archive page slug editable from settings page
* Import Demo button on settings page
* Translation update

= 1.0.4 =
* Shortcode added for single view
* Button translation and Read button
* Download Button hover effect
* General tab new section for Shortcode
* Shortcode column added for backend

= 1.0.3 =
* Shortcode added for 4 templates view
* Color changing issue for template
* Translation for template header
* Sample data inserted on activation

= 1.0.2 =
* Appsero analytics setup

= 1.0.1 =
* Admin support info

= 1.0.0 =
* Initial Release

== Frequently Asked Questions ==

= Q. How do I embed a PDF on a single page or post? =
A. Use the shortcode [pdfev_embed_viewer id="post_id"], replacing post_id with the ID of your uploaded PDF post.

= Q. Can I create a gallery or archive of multiple PDFs? =
A. Yes! Use [pdfev_viewer template="list"], [pdfev_viewer template="grid"], [pdfev_viewer template="ebook"], or [pdfev_viewer template="newsletter"] to create different archive layouts.

= Q. How do I track how many times a PDF is read or downloaded? =
A. The plugin automatically tracks reads and downloads. You can see the counts in the plugin settings and post list.

= Q. Is there an option to show or hide the download and view counters on buttons? =
A. Yes! In the plugin settings, you can enable or disable the read (view) and download counters on the action buttons easily.

= Q. Can I customize the archive page URL and titles? =
A. Yes! You can change the archive page slug and title easily from the plugin settings.

= Q. How do I switch between the Traditional PDF View and 3D Flipbook View? =
A. You can choose your preferred mode between the two views in the plugin’s settings to enable or disable.

= Q. Does the plugin support multiple languages? =
A. Yes, it’s translation-ready and compatible with multilingual websites.

= Q. Can I override the plugin templates in my child theme? =
A. Yes! You can override the plugin templates easily. Just copy the desired template files from the template/ folder inside the plugin and paste them into your child theme.
For example:
your-child-theme/template/archive.php
your-child-theme/template/single.php
You can then modify the copied file as needed without worrying about plugin updates overwriting your changes.

= Q. How do I import demo content? =
A. Just click the "Import Demo" button in the plugin settings to quickly add sample content.

= Q. Will this plugin slow down my website? =
A. No, the plugin is lightweight and optimized for fast performance.

= Q. Do I need coding knowledge to use this plugin? =
A. No coding skills are required! You can manage everything with shortcodes and plugin settings.

= Q. Is Appsero collecting my private data? =
A. No. Appsero only collects basic telemetry data after you give permission. It’s 100% optional and secure.