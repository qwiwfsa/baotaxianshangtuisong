=== SAAS Software ===
Contributors: TheMagnifico52
Requires at least: 5.0
Tested up to: 6.9
Requires PHP: 7.2
Stable tag: 0.1.1
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Tags: three-columns, four-columns, translation-ready, wide-blocks, block-styles, custom-logo, one-column, two-columns, grid-layout, sticky-post, custom-background, custom-colors, custom-header, custom-menu, featured-image-header, featured-images, flexible-header, footer-widgets, post-formats, threaded-comments, theme-options, left-sidebar, right-sidebar, full-width-template, editor-style, education, portfolio, blog

The SAAS Software is a modern, multipurpose, and elegant WordPress theme built for startups, software companies, SaaS agencies, SaaS Solutions, Software agencies, SaaS Services, SaaS Development, Cloud Software, Software Consulting, SaaS Marketing, SaaS Growth and digital agencies looking to create a powerful online presence. With its minimal and sophisticated layout, it offers a clean and user-friendly interface that ensures effortless navigation and a visually stunning experience for visitors.

== Description ==

SAAS Software theme The SAAS Software is a modern, multipurpose, and elegant theme designed for startups, software companies, SaaS agencies, SaaS solutions, SaaS services, SaaS development, cloud software, software consulting, SaaS marketing, SaaS growth, digital agencies, tech startup websites, SaaS landing pages, software product sites, IT solutions platforms, business automation software, cloud business tools, SaaS CRM systems, SaaS ERP software, enterprise cloud tools, AI automation platforms, project management SaaS tools, CRM software providers, cybersecurity SaaS firms, fintech startups, HR management platforms, marketing automation tools, customer support SaaS solutions, workflow automation systems, SaaS onboarding tools, data analytics platforms, subscription software services, and B2B software developers seeking a professional and scalable online presence; featuring a clean, minimal, and sophisticated layout, it ensures a smooth and user-friendly experience with visually stunning presentation; built on Bootstrap with optimized and secure code, it delivers fast loading speeds and reliable performance, while its fully responsive and retina-ready design guarantees seamless functionality across all devices; the theme includes key sections such as an engaging banner, testimonial area, and team showcase to effectively highlight products, client feedback, and company expertise, along with strategically placed call-to-action (CTA) buttons and social media integration to boost engagement; extensive personalization and customization options allow complete control over layouts, styles, and branding, while compatibility with the Forminator plugin enables efficient lead generation, pricing tables, signup forms, and inquiry handling; ideal for agency, consulting, domain, and ISP-related businesses, the SAAS Software theme provides a powerful, flexible, and user-friendly solution for building a high-performance SaaS and technology website.

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Type in SAAS Software in the search form and press the 'Enter' key on your keyboard.
3. Click on the 'Activate' button to use your new theme right away.
4. Navigate to Appearance > Customize in your admin panel and customize to taste.

== Copyright ==

SAAS Software WordPress Theme, Copyright 2025 TheMagnifico52
SAAS Software is distributed under the terms of the GNU GPL

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

== Frequently Asked Questions ==

= Does this theme support any plugins? =

SAAS Software includes support for Infinite Scroll in Jetpack.

== Credits ==

SAAS Software bundles the following third-party resources:

Font Awesome Free 5.6.3 by @fontawesome - https://fontawesome.com
 * License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License)

Bootstrap
 * Bootstrap v5.3.3 (https://getbootstrap.com/)
 * Copyright 2011-2025 The Bootstrap Authors
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)

PSR-4 autoloader
  * Justin Tadlock
  * License: https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
  * Source: https://github.com/WPTRT/autoload

Webfonts Loader
  * https://github.com/WPTT/webfont-loader
  * License: https://github.com/WPTT/webfont-loader/blob/master/LICENSE

CustomizeSectionButton
  * Justin Tadlock
  * Copyright 2019, Justin Tadlock.
  * License: https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
  * https://github.com/WPTRT/customize-section-button

Pxhere Images,
	License: CC0 1.0 Universal (CC0 1.0)
	Source: https://pxhere.com/en/license

	License: CC0 1.0 Universal (CC0 1.0)
	Source: https://pxhere.com/en/photo/1563085

  License: CC0 1.0 Universal (CC0 1.0)
  Source: https://pxhere.com/en/photo/1562059

  License: CC0 1.0 Universal (CC0 1.0)
  Source: https://pxhere.com/en/photo/434687

  License: CC0 1.0 Universal (CC0 1.0)
  Source: https://pxhere.com/en/photo/1325260

  License: CC0 1.0 Universal (CC0 1.0)
  Source: https://pxhere.com/en/photo/93882

  License: CC0 1.0 Universal (CC0 1.0)
  Source: https://pxhere.com/en/photo/922426

  License: CC0 1.0 Universal (CC0 1.0)
  Source: https://pxhere.com/en/photo/946516

  License: CC0 1.0 Universal (CC0 1.0)
  Copyright: rawpixel.com
  Source: https://pxhere.com/en/photo/1434697

== Changelog ==

= 0.1.1 =

* Updated description.

= 0.1.0 =

* Done some changes.

= 0.0.9 =

* Fixed malformed HTML closing tags in admin notice (h2, p).
* Fixed missing output escaping: replaced echo wp_get_theme() with esc_html(), _e() with esc_html_e().
* Fixed security: added check_ajax_referer() and current_user_can() to tm_install_and_activate_plugin(), tm_check_plugin_exists(), saas_software_demo_importer_ajax_handler() AJAX handlers.
* Fixed security: added nonce verification to saas_software_dismissable_notice() and saas_software_ajax_notice_handler().
* Fixed security: added nonce verification and capability check to saas_software_update_recommended_action_callback() in theme-installation.php.
* Fixed sanitization of $_POST inputs in AJAX handlers using sanitize_key(), sanitize_file_name(), wp_unslash().
* Fixed incorrect esc_attr() usage with multiple arguments in comment date/time display in template-tags.php.
* Fixed esc_url() incorrectly applied to get_comment_author_link() HTML output in template-tags.php.
* Fixed stray </i> HTML tag in content-single.php.
* Fixed orphaned </div> in index.php when no posts are found.
* Fixed scroll-to-top anchor missing href attribute in footer.php.
* Fixed wrong post_type hidden input value in search form (mainheader.php); added esc_attr() to search query value.
* Fixed deprecated get_page_by_title() replaced with WP_Query via get_posts() per WordPress 6.2 handbook.
* Fixed key name mismatch: nr_actions_recommended -> count_actions_recommended in theme-installation localize script.
* Replaced console.log() calls in theme-installation.js and theme-importer.js with silent error handling.
* Added nonce to recommend-action AJAX call in theme-installation.js.
* Replaced die() with wp_die() in AJAX handler functions.

= 0.0.8

* Added pro btn in global settings.
* Added pro btn in post layout settings.
* Added pro btn in 404 page settings.
* Added pro btn in banner settings.
* Added pro btn in service settings.
* Added pro btn in footer settings.
* Added 404 page settings.
* Added sticky header.
* Added woocommerce product sale positions.
* Added woocommerce product sale border radius.
* Added product border radius option.
* Added product box shadow option.
* Added post page image border radius setting.
* Added post page image box shadow setting.
* Added single post page image border radius
* Added single post page image box shadow setting.
* Added Enable single post meta setting.
* Added Enable single post title setting.
* Added Enable single post tags setting.
* Added show / hide post navigation setting.
* Added single post comment title setting.
* Added single post comment button text setting.
* Added menu font size setting.
* Added menu text transform setting.
* Added menu font weight setting.

= 0.0.7

* Updated description.

= 0.0.6

* Css issue resolved.
* Updated demo impoter code.

= 0.0.5

* Updated description.

= 0.0.4

* Update single.php file
* Update page single file.
* Update archive product file.
* Update single-product file.
* Update notice code.
* Added new code of global color.
* Update Demo impoter code.
* Update pattern file.

= 0.0.3

* Added some tags.
* Added post layout option.
* Updated getstart.

= 0.0.2

* Added default sidebar.
* Added demo impoter.
* Added getstart.
* Added POT file.

= 0.0.1

* Initial release.