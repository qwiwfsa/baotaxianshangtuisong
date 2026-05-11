<?php
//about theme info
add_action( 'admin_menu', 'advance_blogging_gettingstarted' );
function advance_blogging_gettingstarted() {    	
	add_theme_page( esc_html__('Theme Demo Content', 'advance-blogging'), esc_html__('Theme Demo Content', 'advance-blogging'), 'edit_theme_options', 'advance_blogging_guide', 'advance_blogging_mostrar_guide');   
}

// Add a Custom CSS file to WP Admin Area
function advance_blogging_admin_theme_style() {
   wp_enqueue_style('advance-blogging-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/getstart.css');
   wp_enqueue_script('tabs', esc_url(get_template_directory_uri()) . '/inc/dashboard/js/tab.js');

	// Admin notice code START
	wp_register_script('advance-blogging-notice', esc_url(get_template_directory_uri()) . '/inc/dashboard/js/notice.js', array('jquery'), time(), true);
	wp_enqueue_script('advance-blogging-notice');
	// Admin notice code END
}
add_action('admin_enqueue_scripts', 'advance_blogging_admin_theme_style');

//guidline for about theme
function advance_blogging_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'advance-blogging' );
?>

<div class="wrapper-info">  
		<div id="tc-header">
			<div class="tc-container main-header">
				<a class="tc-logo">
					<img role="img" src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/dashboard/images/logo.png" alt="" />
				</a>
				<span class="tc-header-action">
				<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customize', 'advance-blogging'); ?></a>
				<a href="<?php echo esc_url( ADVANCE_BLOGGING_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'advance-blogging' ); ?></a>
				<a href="<?php echo esc_url( 'https://www.themescaliber.com/products/blog-wordpress-theme/'); ?>" target="_blank"> <?php esc_html_e( 'Get Premium', 'advance-blogging' ); ?></a>
				<a href="<?php echo esc_url( 'https://www.themescaliber.com/products/wordpress-theme-bundle' ); ?>" class="bundle_btn" target="_blank"> <?php esc_html_e( 'Bundle of 220+ Themes at $99', 'advance-blogging' ); ?></a>
				</span>
			</div>
		</div>
		<div class="tc-container tab-sec">
			<div class="tc-tabs">
				<ul>
					<li class="tablinks home active" onclick="advance_blogging_openCity(event, 'tc_demo')">
						<a href="#">
							<?php esc_html_e( 'Theme Demo Import', 'advance-blogging' ); ?>
						</a>
					</li>
					<li class="tablinks" onclick="advance_blogging_openCity(event, 'tc_index')">
						<a href="#">
							<?php esc_html_e( 'Free Theme Information', 'advance-blogging' ); ?>
						</a>
					</li>
					<li class="tablinks" onclick="advance_blogging_openCity(event, 'tc_pro')">
						<a href="#">
							<?php esc_html_e( 'Premium Theme Information', 'advance-blogging' ); ?>
						</a>
					</li>
					<li class="tablinks" onclick="advance_blogging_openCity(event, 'tc_create')">
						<a href="#">
							<?php esc_html_e( 'Theme Support', 'advance-blogging' ); ?>
						</a>
					</li>
				</ul>
			</div><!-- END .tc-tabs -->
		</div>

		<div class="tc-container">
			<div class="tc-section">
				<div  id="tc_demo" class="tabcontent">
					<h2><?php esc_html_e( 'Welcome to Advance Blogging', 'advance-blogging' ); ?> <span class="version">Version: <?php echo esc_html($theme['Version']);?></span></h2>
					<hr>
					<div class="demo">
						<h4><?php esc_html_e( 'Click the "Run Importer" button below to load demo content for Advance Blogging', 'advance-blogging' ); ?></h4>
						<?php /* Demo Import */ require get_parent_theme_file_path( '/inc/dashboard/demo-importer.php' );?>
					</div>
				</div><!-- END .tc-section -->
			</div>
		</div>

		<div class="tc-container">
			<div class="tc-section">
				<div  id="tc_index" class="tabcontent">
					<h2><?php esc_html_e( 'Welcome to Advance Blogging Theme', 'advance-blogging' ); ?> <span class="version">Version: <?php echo esc_html($theme['Version']);?></span></h2>
					<hr>
					<div class="info-link">
						<a href="<?php echo esc_url( ADVANCE_BLOGGING_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'advance-blogging' ); ?></a>
						<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'advance-blogging'); ?></a>
						<a class="get-pro" href="<?php echo esc_url( ADVANCE_BLOGGING_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Get Pro', 'advance-blogging'); ?></a>
					</div>
					<div class="col-tc-6">
						<img role="img" src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/dashboard/images/screenshot.png" alt="" />
					</div>
					<div class="col-tc-6">
					<P><?php esc_html_e( 'Advance Blogging is a clean, minimal, and multipurpose blog theme designed for lifestyle blogs, food blogs, sports blogs, technology blogs, fashion blogs, SEO blogs, cooking and recipe blogs, beauty and wellness blogs, travel journals, cultural blogs, personal finance blogs, health and fitness blogs, relationship and parenting blogs, affiliate blogs, photography blogs, portfolios, craft blogs, video blogs, podcast interviews, knowledge-sharing blogs, fan fiction, and content-focused websites, with additional relevance for niches such as digital marketing, online magazines, creative blogging, niche blogging, multipurpose blogging, minimal blog layouts, responsive blog design, mobile-friendly templates, clean blog UI, schema-ready layout, and creative portfolio presentation. Perfect for magazine-style websites, news portals, professional portfolios, or newspaper sites, the theme offers a fully responsive and cross-browser compatible design that adapts seamlessly to desktops, tablets, and mobile devices. Highly customizable options allow you to personalize headers, footers, logos, backgrounds, and featured images to enhance your articles and visual storytelling. Built on a robust framework, this theme includes Contact Form 7 integration and supports popular enhancement plugins such as Yoast SEO to improve optimization, handle inquiries, manage newsletter signups, and boost user engagement, while its SEO-friendly code ensures faster page load times and better search visibility. With multilingual support for Arabic, German, Spanish, French, Italian, Russian, Turkish, and Chinese, Advance Blogging provides a versatile foundation for bloggers, content creators, and online publishers seeking a professional, functional, and visually appealing platform. ', 'advance-blogging' ); ?></P>
					</div>
				</div>
			</div><!-- END .tc-section -->
		</div>

		<div class="tc-container">
			<div class="tc-section">
				<div id="tc_pro" class="tabcontent">
					<h3><?php esc_html_e( 'Advance Blogging Theme Information', 'advance-blogging' ); ?></h3>
					<hr>
					<div class="info-link-pro">
						<a href="<?php echo esc_url( ADVANCE_BLOGGING_BUY_NOW ); ?>" target="_blank"> <?php esc_html_e( 'Buy Now', 'advance-blogging' ); ?></a>
						<a href="<?php echo esc_url( ADVANCE_BLOGGING_LIVE_DEMO ); ?>" target="_blank"> <?php esc_html_e( 'Live Demo', 'advance-blogging' ); ?></a>
						<a href="<?php echo esc_url( ADVANCE_BLOGGING_PRO_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Pro Documentation', 'advance-blogging' ); ?></a>
					</div>
					<div class="pro-image">
						<img role="img" src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/dashboard/images/resize.png" alt="" />
					</div>
				<div class="col-pro-5">
					<h4><?php esc_html_e( 'Advance Blogging Pro Theme', 'advance-blogging' ); ?></h4>
					<P><?php esc_html_e( 'Blog WordPress theme is an awesome theme made just for bloggers. Blogging is the new fever soaring in the internet world and everyone is trying their hands in it. As writing a blog is a fairly easy task, what is difficult for most of the people is getting the desired look for their blog. The blog WordPress theme presented by us is the answer for all the people finding a professional-looking, clean, stylish and visually appealing theme to instantly start writing blogs without worrying about the tons of responsibilities that come with a website.This versatile blog WordPress theme can be used for blogging, as a portfolio, for writing resumes, journals, biographies and as a landing page. As far as blogging is concerned, you can use it for writing any type of blog. It is a fully responsive, cross-browser compatible, translation ready, SEO-friendly and lightweight theme. This theme has limitless possibilities of customization with an advanced gallery to organize eye-catching pictures in various layouts. Social media icons will help you reach maximum people in minimum time. There are various sections and custom post types like testimonial section, newsletter subscription, latest blogs, gallery and others. Each section can be enabled/disabled according to your requirements. The blog WP theme offers premium membership which gives you access to customer support and regular theme updates.', 'advance-blogging' ); ?></P>	
				</div>
				<div class="col-pro-6">				
					<h4><?php esc_html_e( 'Theme Features', 'advance-blogging' ); ?></h4>
					<ul>
						<li><?php esc_html_e( 'Theme Options using Customizer API', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Responsive design', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Favicon, Logo, title and tagline customization', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Advanced Color options', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( '100+ Font Family Options', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Background Image Option', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Simple Menu Option', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Additional section for products', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Enable-Disable options on All sections', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Home Page setting for different sections', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Advance Slider with unlimited slides', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Partner Section', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Promotional Banner Section for Products', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Seperate Newsletter Section', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Text and call to action button for each slides', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Pagination option', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Custom CSS option', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Translations Ready', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Custom Backgrounds, Colors, Headers, Logo & Menu', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Customizable Home Page', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Full-Width Template', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Footer Widgets & Editor Style', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Banner & Post Type Plugin Functionality', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Woo Commerce Compatible', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Multiple Inner Page Templates', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Product Sliders', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Testimonial Slider', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Testimonial Posttype', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Testimonial Listing With Shortcode', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Contact page template', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Contact Widget', 'advance-blogging' ); ?></li>
						<li><?php esc_html_e( 'Advance Social Media Feature', 'advance-blogging' ); ?></li>
					</ul>			
				</div>	
			</div><!-- END .tc-section -->
		</div>

		<div class="tc-container">
			<div class="tc-section">
				<div id="tc_create" class="tabcontent">
					<div class="tab-cont">
						<h4><?php esc_html_e( 'Need Support?', 'advance-blogging' ); ?></h4>				
						<div class="info-link-support">
							<P><?php esc_html_e( 'Our team is obliged to help you in every way possible whenever you face any type of difficulties and doubts.', 'advance-blogging' ); ?></P>
							<a href="<?php echo esc_url( ADVANCE_BLOGGING_SUPPORT ); ?>" target="_blank"> <?php esc_html_e( 'Support Forum', 'advance-blogging' ); ?></a>
						</div>
					</div>
					<div class="tab-cont">	
						<h4><?php esc_html_e('Reviews', 'advance-blogging'); ?></h4>				
						<div class="info-link-support">
							<P><?php esc_html_e( 'It is commendable to have such a theme inculcated with amazing features and robust functionalities. I feel grateful to recommend this theme to one and all.', 'advance-blogging' ); ?></P>
							<a href="<?php echo esc_url( ADVANCE_BLOGGING_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'advance-blogging'); ?></a>
						</div>
					</div>

					<div class="tc-section large-section">
						<h2>Let‘s customize your website</h2>
						<p>There are many changes you can make to customize your website. Explore customization options and make it unique.</p>
						<div class="tc-buttons">
							<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>" class="tc-btn primary large-button"><?php esc_html_e('Start Customizing', 'advance-blogging'); ?></a>
						</div><!-- END .tc-buttons -->
					</div>
				</div>
			</div><!-- END .tc-section -->
		</div>
	</div>
<?php } ?>