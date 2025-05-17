=== 3D Flipbook PDF Viewer & Embedder – E-Books, Manuals, Newsletters, Reports ===

Contributors:      raselsha
Requires at least: 3.0
Tested up to:      6.8
Requires PHP:      7.0
Stable tag:	       trunk
License:           GPLv2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
Tags:              ebook reader, newsletter, pdf, pdf viewer, pdf download,

Display PDFs as interactive 3D flipbooks or traditional viewers for E-Books, Manuals, Newsletters, and Reports.

== Description ==
3D Flipbook PDF Viewer & Embedder allows easy reading and downloading of PDF files on your WordPress website, offering both traditional and interactive 3D Flipbook views for documents, newsletters, and eBooks directly within web pages. With a user-friendly interface and customizable features, it tracks reads and downloads per item. You can also choose to show or hide the read and download buttons.

## This plugin supports 4 templates for Archive view
* **List Template**
* **Grid Template**
* **Newsletter Template**
* **Ebook Template**

## Shortcode for arvhive view
* **[pdfev_viewer template="list"]**
* **[pdfev_viewer template="grid"]**
* **[pdfev_viewer template="ebook"]**
* **[pdfev_viewer template="newsletter"]**

## Shortcode for single page/post
* **[pdfev_embed_viewer id="post_id"]**

## Features
* **Display PDFs Anywhere:**  Easily embed PDFs in any page or post using a shortcode, with both traditional and 3D Flipbook views.
* **Archive Page Templates:** Choose from four distinct templates for your archive pages.
* **Track Reads and Downloads:** Monitor the number of times your content is read and downloaded for better insights.
* **Standalone Sidebar Menu:** WordPress sidebar has a dedicated menu.
* **Color Adjustment Settings:** Personalize colors with an intuitive settings page.
* **Customizable Archive Page URL:** Modify the URL structure of your archive pages to suit your needs.
* **Download Button Control:** Toggle the PDF download button on or off as desired.
* **Editable Archive Page Title:** Customize the title of your archive pages.
* **Archive Page Shortcode:** Utilize a shortcode specifically for archive pages.
* **Single Document Shortcode:** Easily embed single documents with a dedicated shortcode.
* **Import Demo Content:** Quickly set up your archive view with the import demo button.
* **Multilingual Support:** Fully compatible with multiple languages.
* **Button Enable/Disable:** Options to show/hide read and download buttons for both traditional and 3D Flipbook views.

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