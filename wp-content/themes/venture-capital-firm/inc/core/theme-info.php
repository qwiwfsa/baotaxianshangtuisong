<?php
/**
 * Add theme page
 */

function venture_capital_firm_menu() {
	add_theme_page( esc_html__( 'Venture Capital Firm', 'venture-capital-firm' ), esc_html__( 'Venture Capital Firm Theme', 'venture-capital-firm' ), 'edit_theme_options', 'venture-capital-firm-info', 'venture_capital_firm_theme_page_display' );
}
add_action( 'admin_menu', 'venture_capital_firm_menu' );

function venture_capital_firm_admin_theme_style() {
	wp_enqueue_style('venture-capital-firm-custom-admin-style', esc_url(get_template_directory_uri()) . '/css/admin-style.css');
	wp_enqueue_script('venture-capital-firm-tabs', esc_url(get_template_directory_uri()) . '/js/tab.js');
}
add_action('admin_enqueue_scripts', 'venture_capital_firm_admin_theme_style');

/**
 * Display About page
 */
function venture_capital_firm_theme_page_display() {
	$venture_capital_firm_theme = wp_get_theme();

	if ( is_child_theme() ) {
		$venture_capital_firm_theme = wp_get_theme()->parent();
	} ?>

	<div class="wrapper-info">
	    <div class="col-left sshot-section">
	    	<h2><?php esc_html_e( 'Welcome to Venture Capital Firm Theme', 'venture-capital-firm' ); ?> <span class="version"><?php esc_html_e('Version:','venture-capital-firm'); ?> <?php echo esc_html($venture_capital_firm_theme['Version']);?></span></h2>
	    	<p><?php esc_html_e('All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.','venture-capital-firm'); ?></p>
	    </div>
	    <div class="col-right coupen-section">
			<div class="logo-section">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png" alt="" />
			</div>
			<div class="logo-right">            
	            <div class="update-now">
	                <div class="theme-info">
	                    <div class="theme-info-left">
	                        <h2><?php esc_html_e('TRY PREMIUM','venture-capital-firm'); ?></h2>
	                        <h4><?php esc_html_e('VENTURE CAPITAL FIRM THEME','venture-capital-firm'); ?></h4>
	                    </div>    
	                    <div class="theme-info-right"></div>
	                </div>    
	                <div class="dicount-row">
	                    <div class="disc-sec">    
	                        <h5 class="disc-text"><?php esc_html_e('GET THE FLAT DISCOUNT OF','venture-capital-firm'); ?></h5>
	                        <h1 class="disc-per"><?php esc_html_e('20%','venture-capital-firm'); ?></h1>    
	                    </div>
	                    <div class="coupen-info">
	                        <h5 class="coupen-code"><?php esc_html_e('"VWPRO20"','venture-capital-firm'); ?></h5>
	                        <h5 class="coupen-text"><?php esc_html_e('USE COUPON CODE','venture-capital-firm'); ?></h5>
	                        <div class="info-link">                        
	                            <a href="<?php echo esc_url( VENTURE_CAPITAL_FIRM_BUY_NOW ); ?>" target="_blank"> <?php esc_html_e( 'UPGRADE TO PRO', 'venture-capital-firm' ); ?></a>
	                        </div>    
	                    </div>    
	                </div>                
	            </div>
	        </div> 
	    </div>

	    <div class="tab-sec">
			<div class="tab">
				<button class="tablinks" onclick="venture_capital_firm_open_tab(event, 'lite_theme')"><?php esc_html_e( 'Free Setup', 'venture-capital-firm' ); ?></button>
			  	<button class="tablinks" onclick="venture_capital_firm_open_tab(event, 'pro_theme')"><?php esc_html_e( 'Get Premium', 'venture-capital-firm' ); ?></button>
			  	<button class="tablinks" onclick="venture_capital_firm_open_tab(event, 'free_pro')"><?php esc_html_e( 'Free Vs Premium', 'venture-capital-firm' ); ?></button>
			  	<button class="tablinks" onclick="venture_capital_firm_open_tab(event, 'get_bundle')"><?php esc_html_e( 'Get 485+ Themes Bundle at $99', 'venture-capital-firm' ); ?></button>
			</div>

			<div id="lite_theme" class="tabcontent open">
				<div class="lite-theme-tab">
					<h3><?php esc_html_e( 'Lite Theme Information', 'venture-capital-firm' ); ?></h3>
					<hr class="h3hr">
				  	<p><?php esc_html_e('Venture Capital Firm is a modern, fast-loading business solution crafted for investment firms, startup accelerators, financial advisory agencies, and investment consultants, built with clean, responsive design, ultra-optimized code, and schema support to improve organic search visibility and deliver excellent PageSpeed performance even on mobile devices, with dedicated sections for portfolio showcases, services, team profiles, testimonials, case studies, and call-to-action blocks that drive engagement, while seamlessly integrating with contact form plugins such as Contact Form 7 and Ninja Forms to enhance lead capture, advanced SEO settings to help rank for targeted search queries like venture capital services and startup funding experts, retina-ready visuals and translation support for multilingual audiences, cross-browser compatibility for Chrome, Firefox, Safari, and Edge, and built-in styling controls to tailor colors, fonts, and layouts without coding; ideal for firms that want to present professionalism and trustworthiness while maximizing visibility across search engines, with lightweight assets that improve loading times and user experience, optimized navigation menus for reduced bounce rates, and deep integration with social sharing tools that expand reach on social platforms, making this theme perfect for financial professionals seeking a high-performance, search-friendly online presence that attracts investors and partners alike.','venture-capital-firm'); ?></p>
				  	<div class="col-left-inner">
						<div class="pro-links">
					    	<a href="<?php echo esc_url( admin_url() . 'site-editor.php' ); ?>" target="_blank"><?php esc_html_e('Edit Your Site', 'venture-capital-firm'); ?></a>
							<a href="<?php echo esc_url( home_url() ); ?>" target="_blank"><?php esc_html_e('Visit Your Site', 'venture-capital-firm'); ?></a>
						</div>
						<div class="support-forum-col-section">
							<div class="support-forum-col">
								<h4><?php esc_html_e('Having Trouble, Need Support?', 'venture-capital-firm'); ?></h4>
								<p> <?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'venture-capital-firm'); ?></p>
								<div class="info-link">
									<a href="<?php echo esc_url( VENTURE_CAPITAL_FIRM_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'venture-capital-firm'); ?></a>
								</div>
							</div>
							<div class="support-forum-col">
								<h4><?php esc_html_e('Reviews & Testimonials', 'venture-capital-firm'); ?></h4>
								<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'venture-capital-firm'); ?>  </p>
								<div class="info-link">
									<a href="<?php echo esc_url( VENTURE_CAPITAL_FIRM_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'venture-capital-firm'); ?></a>
								</div>
							</div>
							<div class="support-forum-col">
								<h4><?php esc_html_e('Theme Documentation', 'venture-capital-firm'); ?></h4>
								<p> <?php esc_html_e('If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'venture-capital-firm'); ?>  </p>
								<div class="info-link">
									<a href="<?php echo esc_url( VENTURE_CAPITAL_FIRM_FREE_DOC ); ?>" target="_blank"><?php esc_html_e('Free Theme Documentation', 'venture-capital-firm'); ?></a>
								</div>
							</div>
						</div>
				  	</div>
				</div>
			</div>

			<div id="pro_theme" class="tabcontent">
			  	<h3><?php esc_html_e( 'Premium Theme Information', 'venture-capital-firm' ); ?></h3>
				<hr class="h3hr">
				<div class="col-left-pro">
	    			<p><?php esc_html_e('The Venture Capital WordPress Theme is a modern, professional, and multipurpose solution designed specifically for investment firms, financial consultants, and startup agencies. With its clean, minimal, and elegant layout, this theme perfectly balances style with functionality. Built using Bootstrap, it is responsive, retina ready, and mobile friendly, ensuring a flawless display on all devices. This theme includes strategically designed sections such as Team, Testimonial, Banner with Call to Action (CTA), and social media integration, all optimized to convert visitors and build credibility. With intuitive customization options, even non-technical users can easily adjust layout elements, colors, and fonts to suit their brand’s style. Whether you aim to highlight your services, showcase successful portfolios, or grow your clientele, the Venture Capital WordPress Theme offers the right structure. It is SEO-friendly, built with optimized code and ensures a faster page load time, boosting both user experience and search engine rankings. Additionally, it’s translation ready and supports interactive, animated elements, making it appealing to a global audience. Its secure and clean code offers long-term reliability, and with regular updates, you stay current with the latest web trends.','venture-capital-firm'); ?></p>
	    		</div>
		    	<div class="col-right-pro">
			    	<div class="pro-links">
				    	<a href="<?php echo esc_url( VENTURE_CAPITAL_FIRM_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'venture-capital-firm'); ?></a>
						<a href="<?php echo esc_url( VENTURE_CAPITAL_FIRM_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Pro', 'venture-capital-firm'); ?></a>
						<a href="<?php echo esc_url( VENTURE_CAPITAL_FIRM_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'venture-capital-firm'); ?></a>
						<a href="<?php echo esc_url( VENTURE_CAPITAL_FIRM_THEME_BUNDLE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Get 485+ Themes Bundle at $99', 'venture-capital-firm'); ?></a>
					</div>
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pro.png" alt="" />
				</div>
			</div>

			<div id="free_pro" class="tabcontent">
				<div class="featurebox">
				    <h3 class="theme-features"><?php esc_html_e( 'Theme Features', 'venture-capital-firm' ); ?></h3>
					<hr class="h3hr1">
					<div class="table-image">
						<table class="tablebox">
							<thead>
								<tr>
									<th><?php esc_html_e('Features', 'venture-capital-firm'); ?></th>
									<th><?php esc_html_e('Free Themes', 'venture-capital-firm'); ?></th>
									<th><?php esc_html_e('Premium Themes', 'venture-capital-firm'); ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php esc_html_e('Easy Setup', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Responsive Design', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('SEO Friendly', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Banner Settings', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Template Pages', 'venture-capital-firm'); ?></td>
									<td class="table-img"><?php esc_html_e('1', 'venture-capital-firm'); ?></td>
									<td class="table-img"><?php esc_html_e('14', 'venture-capital-firm'); ?></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Home Page Template', 'venture-capital-firm'); ?></td>
									<td class="table-img"><?php esc_html_e('1', 'venture-capital-firm'); ?></td>
									<td class="table-img"><?php esc_html_e('1', 'venture-capital-firm'); ?></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Theme sections', 'venture-capital-firm'); ?></td>
									<td class="table-img"><?php esc_html_e('2', 'venture-capital-firm'); ?></td>
									<td class="table-img"><?php esc_html_e('12', 'venture-capital-firm'); ?></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Contact us Page Template', 'venture-capital-firm'); ?></td>
									<td class="table-img">0</td>
									<td class="table-img"><?php esc_html_e('1', 'venture-capital-firm'); ?></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Blog Templates & Layout', 'venture-capital-firm'); ?></td>
									<td class="table-img">0</td>
									<td class="table-img"><?php esc_html_e('3(Full width/Left/Right Sidebar)', 'venture-capital-firm'); ?></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Section Reordering', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Demo Importer', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Full Documentation', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Latest WordPress Compatibility', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Support 3rd Party Plugins', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Secure and Optimized Code', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Exclusive Functionalities', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Section Enable / Disable', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Section Google Font Choices', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Gallery', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Simple & Mega Menu Option', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Support to add custom CSS / JS ', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Shortcodes', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Custom Background, Colors, Header, Logo & Menu', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Premium Membership', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Budget Friendly Value', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Priority Error Fixing', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Custom Feature Addition', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('All Access Theme Pass', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Seamless Customer Support', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('WordPress 6.4 or later', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('PHP 8.2 or 8.3', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('MySQL 5.6 (or greater) | MariaDB 10.0 (or greater)', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Influence Registration', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr class="odd">
									<td><?php esc_html_e('Detailed Influencer Portfolio', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
									<td><?php esc_html_e('Premium Pricing Plan', 'venture-capital-firm'); ?></td>
									<td class="table-img"><span class="dashicons dashicons-no"></span></td>
									<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								</tr>
								<tr>
								<td></td>
								<td class="table-img"></td>
								<td class="update-link"><a href="<?php echo esc_url( VENTURE_CAPITAL_FIRM_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Upgrade to Pro', 'venture-capital-firm'); ?></a></td>
								</tr>
							</tbody>
						</table>

					</div>
				</div>
			</div>

			<div id="get_bundle" class="tabcontent">		  	
			   <div class="col-left-pro">
			   	<h3><?php esc_html_e( 'WP Theme Bundle', 'venture-capital-firm' ); ?></h3>
			    	<p><?php esc_html_e('Enhance your website effortlessly with our WP Theme Bundle. Get access to 485+ premium WordPress themes and 5+ powerful plugins, all designed to meet diverse business needs. Enjoy seamless integration with any plugins, ultimate customization flexibility, and regular updates to keep your site current and secure. Plus, benefit from our dedicated customer support, ensuring a smooth and professional web experience.','venture-capital-firm'); ?></p>
			    	<div class="feature">
			    		<h4><?php esc_html_e( 'Features:', 'venture-capital-firm' ); ?></h4>
			    		<p><?php esc_html_e('485+ Premium Themes & 5+ Plugins.', 'venture-capital-firm'); ?></p>
			    		<p><?php esc_html_e('Seamless Integration.', 'venture-capital-firm'); ?></p>
			    		<p><?php esc_html_e('Customization Flexibility.', 'venture-capital-firm'); ?></p>
			    		<p><?php esc_html_e('Regular Updates.', 'venture-capital-firm'); ?></p>
			    		<p><?php esc_html_e('Dedicated Support.', 'venture-capital-firm'); ?></p>
			    	</div>
			    	<p>Upgrade now and give your website the professional edge it deserves, all at an unbeatable price of $99!</p>
			    	<div class="pro-links">
						<a href="<?php echo esc_url( VENTURE_CAPITAL_FIRM_THEME_BUNDLE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'venture-capital-firm'); ?></a>
						<a href="<?php echo esc_url( VENTURE_CAPITAL_FIRM_THEME_BUNDLE_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'venture-capital-firm'); ?></a>
					</div>
			   </div>
			   <div class="col-right-pro">
			    	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/bundle.png" alt="" />
			   </div>		    
			</div>
		</div>
	</div>
<?php }?>
