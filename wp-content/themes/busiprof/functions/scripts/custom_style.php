<style>
.custom-logo{width: <?php echo intval(get_theme_mod('busiprof_logo_length',154));?>px; height: auto;}
</style>
<?php 
$busiprof_enable_header_typography        = get_theme_mod('enable_header_typography',false);
$busiprof_enable_banner_typography        = get_theme_mod('enable_banner_typography',false);
$busiprof_enable_slider_typography        = get_theme_mod('enable_slider_typography',false);
$busiprof_enable_homepage_typography      = get_theme_mod('enable_homepage_typography',false);
$busiprof_enable_content_typography       = get_theme_mod('enable_content_typography',false);
$busiprof_enable_post_typography          = get_theme_mod('enable_post_typography',false);
$busiprof_enable_sidebar_typography       = get_theme_mod('enable_sidebar_typography',false);
$busiprof_enable_footer_widget_typography = get_theme_mod('enable_footer_widget_typography',false);

/* Site title,tagline and menu */
if($busiprof_enable_header_typography == true)
{ ?>
		<style>
		body .site-title .navbar-brand, body .site-branding-text .site-title {
				font-size:<?php echo intval(get_theme_mod('site_title_fontsize','32')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('site_title_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('site_title_line_height','25')).'px'; ?>;
		}
		body .site-description {
				font-size:<?php echo intval(get_theme_mod('tagline_title_fontsize','15')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('tagline_title_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('tagline_line_height','25')).'px'; ?>;
		}
		body .navbar-default .navbar-nav > li > a,body .navbar6.navbar-default .navbar-nav > li > a {
				font-size:<?php echo intval(get_theme_mod('menu_title_fontsize','14')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('menu_title_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('menu_line_height','25')).'px'; ?>;
		}
		body .dropdown-menu li a {
				font-size:<?php echo intval(get_theme_mod('submenu_title_fontsize','14')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('submenu_title_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('submenu_line_height','25')).'px'; ?>;
		}
		</style>
<?php } 
/* Breadcrumb Section */
if($busiprof_enable_banner_typography == true)
{ ?>
		<style>
		body .page-title h2 {
				font-size:<?php echo intval(get_theme_mod('banner_title_fontsize','36')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('banner_title_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('banner_line_height','25')).'px'; ?>;
		}
		body .page-breadcrumb a, body .page-breadcrumb span, body .page-breadcrumb li {
				font-size:<?php echo intval(get_theme_mod('breadcrumb_title_fontsize','15')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('breadcrumb_title_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('breadcrumb_line_height','25')).'px'; ?>;
		}
		</style>
<?php }

/* Slider Section */
if($busiprof_enable_slider_typography == true)
{ ?>
		<style>
		body .slide-caption h2 { 
				font-size:<?php echo intval(get_theme_mod('slider_title_fontsize','30')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('slider_title_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('slider_line_height','40')).'px'; ?>;
		}
		</style>
<?php }


/* Homepage Sections title and description */
if($busiprof_enable_homepage_typography == true)
{ ?>
		<style>
		body .section-title .section-heading {
				font-size:<?php echo intval(get_theme_mod('homepage_title_fontsize','36')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('homepage_title_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('homepage_title_line_height','40')).'px'; ?>;
		}
		body .section-title p, .section-title-small p {
				font-size:<?php echo intval(get_theme_mod('homepage_description_fontsize','15')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('homepage_description_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('homepage_description_line_height','25')).'px'; ?>;
		}
		</style>
<?php }


/* Headings (h1,h2, h3, h4,h5, h6), paragraph and button */
if($busiprof_enable_content_typography == true)
{ ?>
		<style>
		/* Heading H1 */
		body  .post-template-default .site-content h1 , .page-template-fullwidth-page .page-content h1, .page-template-default .page-content h1 {
				font-size:<?php echo intval(get_theme_mod('h1_typography_fontsize','36')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('h1_typography_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('h1_line_height','40')).'px'; ?>;
		}
		/* Heading H2 */
		body  .header-title h2, .page-template-fullwidth-page .page-content h2, .page-template-default .page-content h2, .post-template-default .site-content h2, .page-title h2 {
			
				font-size:<?php echo intval(get_theme_mod('h2_typography_fontsize','30')).'px'; ?>!important;
				font-family:<?php echo esc_attr(get_theme_mod('h2_typography_fontfamily','Open Sans')); ?>!important;
				line-height: <?php echo intval(get_theme_mod('h2_line_height','35')).'px'; ?>;
		}
		/* Heading H3 */
		body .footer-sidebar .widget.widget_block h3, .page-template-fullwidth-page .page-content h3, .page-template-default .page-content h3, .post-template-default .site-content h3 {
				font-size:<?php echo intval(get_theme_mod('h3_typography_fontsize','24')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('h3_typography_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('h3_line_height','30')).'px'; ?>;
		}
		/* Heading H4 */
		body .page-content h4, .page-template-fullwidth-page .page-content h4, .page-template-default .page-content h4, .post-template-default .site-content h4, .service .post .entry-header h4, .portfolio .post .entry-header h4 {
			
				font-size:<?php echo intval(get_theme_mod('h4_typography_fontsize','20')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('h4_typography_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('h4_line_height','25')).'px'; ?>;
		}
		/* Heading H5 */
		body .comment-content h5 a, .page-template-fullwidth-page .page-content h5, .page-template-default .page-content h5, .post-template-default .site-content h5 {
				font-size:<?php echo intval(get_theme_mod('h5_typography_fontsize','16')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('h5_typography_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('h5_line_height','20')).'px'; ?>;
		}
		/* Heading H6 */
		body  .post-template-default .site-content h6 ,.page-template-fullwidth-page .page-content h6, .page-template-default .page-content h6 {
				font-size:<?php echo intval(get_theme_mod('h6_typography_fontsize','14')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('h6_typography_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('h6_line_height','20')).'px'; ?>;
		}
		
		/* Paragraph */
		body .slide-caption p, .service-box p, .portfolio-info p,.home-post-latest .post p,.testimonial-scroll .post .entry-content p,.page-content p,blockquote p, blockquote span,
        .site-content .post p,.comment-content p
		{
				font-size:<?php echo intval(get_theme_mod('p_typography_fontsize','15')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('p_typography_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('p_line_height','25')).'px'; ?>;
		}
		/* Button text */
		body .btn-wrap a, .slide-caption .flex-btn {
				font-size:<?php echo intval(get_theme_mod('button_text_typography_fontsize','16')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('button_text_typography_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('button_line_height','25')).'px'; ?>;
		}
		</style>
<?php }


/* Blog Page/Archive/Single Post */
if($busiprof_enable_post_typography == true)
{ ?>
		<style>
		body .site-content .entry-header .entry-title,.site-content .entry-header .entry-title > a {
				font-size:<?php echo intval(get_theme_mod('post_title_fontsize','27')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('post_title_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('post_title_line_height','25')).'px'; ?>;
		}
		</style>
<?php }

/* Sidebar font family */
if($busiprof_enable_sidebar_typography == true)
{ ?>
		<style>
		body  .sidebar .widget.widget_block h2,.sidebar .wp-block-search .wp-block-search__label {
				font-size:<?php echo intval(get_theme_mod('sidebar_fontsize','24')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('sidebar_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('sidebar_line_height','25')).'px'; ?>;
		}
		body .sidebar .widget p, body .sidebar .widget ul li, body .sidebar .widget ol li, body .sidebar .widget a,body .sidebar .widget .search_widget_input, body .sidebar .widget .wp-calendar-table, body .sidebar .widget > ul > li > a, body .sidebar .widget address, body .sidebar .widget ul li a:not(.sidebar-widget .wp-block-latest-posts__post-excerpt .slide-btn-area-sm a), body .sidebar .widget  .wp-block-latest-posts__post-excerpt .slide-text-bg2 span  {
				font-size:<?php echo intval(get_theme_mod('sidebar_widget_content_fontsize','15')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('sidebar_widget_content_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('sidebar_widget_content_line_height','25')).'px'; ?>;
		}
		</style>
<?php }

/* footer sidebar  */
if($busiprof_enable_footer_widget_typography == true)
{ ?>
		<style>
		body .footer-sidebar .wp-block-search .wp-block-search__label, .footer-sidebar .widget.widget_block h3,.footer-sidebar .wp-block-search .wp-block-search__label,.footer-sidebar .widget.widget_block h1,.footer-sidebar .widget.widget_block h2,.footer-sidebar .widget.widget_block h3,.footer-sidebar .widget.widget_block h4,.footer-sidebar .widget.widget_block h5,.footer-sidebar .widget.widget_block h6 {
				font-size:<?php echo intval(get_theme_mod('footer_widget_title_fontsize','24')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('footer_widget_title_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('footer_widget_title_line_height','25')).'px'; ?>;
		}
		body .footer-sidebar .widget p,.footer-sidebar ul li, .footer-sidebar ol li, .footer-sidebar ul li a {
				font-size:<?php echo intval(get_theme_mod('footer_widget_content_fontsize','15')).'px'; ?>;
				font-family:<?php echo esc_attr(get_theme_mod('footer_widget_content_fontfamily','Open Sans')); ?>;
				line-height: <?php echo intval(get_theme_mod('footer_widget_content_line_height','25')).'px'; ?>;
		}
		</style>
<?php }?>