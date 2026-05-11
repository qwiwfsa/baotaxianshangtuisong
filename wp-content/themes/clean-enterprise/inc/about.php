<?php
/**
 * Clean Enterprise Theme page
 *
 * @package Clean_Enterprise
 */

function clean_enterprise_about_admin_style( $hook ) {
	if ( 'appearance_page_clean-enterprise-about' === $hook ) {
		wp_enqueue_style( 'clean-enterprise-about-admin', get_theme_file_uri( 'assets/css/about-admin.css' ), null, '1.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'clean_enterprise_about_admin_style' );

/**
 * Add theme page
 */
function clean_enterprise_menu() {
	add_theme_page( esc_html__( 'About Theme', 'clean-enterprise' ), esc_html__( 'About Theme', 'clean-enterprise' ), 'edit_theme_options', 'clean-enterprise-about', 'clean_enterprise_about_display' );
}
add_action( 'admin_menu', 'clean_enterprise_menu' );

/**
 * Display About page
 */
function clean_enterprise_about_display() {
	$theme = wp_get_theme();
	?>
	<div class="wrap about-wrap full-width-layout">
		<h1><?php echo esc_html( $theme ); ?></h1>
		<div class="about-theme">
			<div class="theme-description">
				<p class="about-text">
					<?php
					// Remove last sentence of description.
					$description = explode( '. ', $theme->get( 'Description' ) );

					array_pop( $description );

					$description = implode( '. ', $description );

					echo esc_html( $description . '.' );
				?></p>
				<p class="actions">
					<a href="https://catchthemes.com/themes/clean-enterprise" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'clean-enterprise' ); ?></a>

					<a href="https://catchthemes.com/demo/clean-enterprise" class="button button-secondary" target="_blank"><?php esc_html_e( 'View Demo', 'clean-enterprise' ); ?></a>

					<a href="https://catchthemes.com/themes/clean-enterprise/#theme-instructions" class="button button-primary" target="_blank"><?php esc_html_e( 'Theme Instructions', 'clean-enterprise' ); ?></a>

					<a href="https://wordpress.org/support/theme/clean-enterprise/reviews/#new-post" class="button button-secondary" target="_blank"><?php esc_html_e( 'Rate this theme', 'clean-enterprise' ); ?></a>

					<a href="https://catchthemes.com/themes/clean-enterprise-pro" class="green button button-secondary" target="_blank"><?php esc_html_e( 'Upgrade to pro', 'clean-enterprise' ); ?></a>
				</p>
			</div>

			<div class="theme-screenshot">
				<img src="<?php echo esc_url( $theme->get_screenshot() ); ?>" />
			</div>

		</div>

		<nav class="nav-tab-wrapper wp-clearfix" aria-label="<?php esc_attr_e( 'Secondary menu', 'clean-enterprise' ); ?>">
			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'clean-enterprise-about' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['page'] ) && 'clean-enterprise-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'About', 'clean-enterprise' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'clean-enterprise-about', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Free Vs Pro', 'clean-enterprise' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'clean-enterprise-about', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'changelog' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Changelog', 'clean-enterprise' ); ?></a>
		</nav>

		<?php
			clean_enterprise_main_screen();

			clean_enterprise_free_vs_pro_screen();

			clean_enterprise_changelog_screen();
		?>

		<div class="return-to-dashboard">
			<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
				<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
					<?php is_multisite() ? esc_html_e( 'Return to Updates', 'clean-enterprise' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'clean-enterprise' ); ?>
				</a> |
			<?php endif; ?>
			<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'clean-enterprise' ) : esc_html_e( 'Go to Dashboard', 'clean-enterprise' ); ?></a>
		</div>
	</div>
	<?php
}

/**
 * Output the main about screen.
 */
function clean_enterprise_main_screen() {
	if ( isset( $_GET['page'] ) && 'clean-enterprise-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) {
	?>
		<div class="feature-section two-col">
			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Theme Customizer', 'clean-enterprise' ); ?></h2>
				<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'clean-enterprise' ) ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Customize', 'clean-enterprise' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Got theme support question?', 'clean-enterprise' ); ?></h2>
				<p><?php esc_html_e( 'Get genuine support from genuine people. Whether it\'s customization or compatibility, our seasoned developers deliver tailored solutions to your queries.', 'clean-enterprise' ) ?></p>
				<p><a href="https://catchthemes.com/support-forum" class="button button-primary"><?php esc_html_e( 'Support Forum', 'clean-enterprise' ); ?></a></p>
			</div>
		</div>
	<?php
	}
}

/**
 * Output the changelog screen.
 */
function clean_enterprise_free_vs_pro_screen() {
	if ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) {
	?>
		<div class="wrap about-wrap vs-theme-table">
			<div id="compare" aria-labelledby="ui-id-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" style="display: block;" aria-hidden="false">
			   <div class="tab-containter">
				  <div class="wrapper">
					 <div class="tab-header">
						<h2 class="entry-title">Free Vs Pro (Premium)</h2>
					 </div>
					 <div class="compare-table">
						<div class="hentry">
							<table>
								<thead>
									<tr>
										<th>Free</th>
										<th>Features</th>
										<th>Pro (Premium)</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Responsive Design</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Super Easy Setup</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Color Options for various sections</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Header Media</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Primary</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Secondary</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Social on Header Top</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Social on Primary Menu</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>		
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Social on Secondary Menu</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Social on Contact Section</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Social on Footer</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Comment Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Contact Info</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Excerpt Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Content: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Featured Content: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Content: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Content: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Featured Content: Custom Post Type</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Featured Slider: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Slider: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Slider: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Slider: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Slider: Image Overlay</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Featured Slider: Content Alignment</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Font Family Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Footer Editor Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Header Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Hero Content Options: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Hero Content Options: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Hero Content Options: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Hero Content Options: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Site Layout: Fluid</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Site Layout: Boxed</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Default Layout: Right Sidebar(Content, Primary Sidebar)</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Default Layout: Left Sidebar(Primary Sidebar,Content)</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Default Layout: No Sidebar</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Default Layout: No Sidebar:Full Width</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Site Content Style: Classic</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Site Content Style: Modern</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Homepage/Archive: Right Sidebar(Content,Primary Sidebar)</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Homepage/Archive: Left Sidebar(Primary Sidebar,Content)</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Homepage/Archive: No Sidebar</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Homepage/Archive: No Sidebar:Full Width</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Archive Content Layout: 2 columns</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Archive Content Layout: 3 columns</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Archive Content Layout: 4 columns</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Single Page/Post Image Layout: Post Thumbnail(470*264)</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Single Page/Post Image Layout: Slider Image Size(1920*820)</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Single Page/Post Image Layout: Original Image Size</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Menu Option: Menu Style: Classic or Modern</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>News: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>News: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>News: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>News: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Pagination Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Portfolio: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Portfolio: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Portfolio: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Portfolio: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Portfolio: Custom Post Type</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Scrollup Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Service: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Service: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Service: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Service: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Service: Custom Post Type</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Stats: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Stats: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Stats: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Stats: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Team: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Team: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Team: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Team: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Testimonials: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Testimonials: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Testimonials: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Testimonials: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-yes"></i></td>
										<td>Testimonials: Custom Post Type</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Update Notifier</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Why Choose Us: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Why Choose Us: Page</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Why Choose Us: Post</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Why Choose Us: Category</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>Why Choose Us: Custom</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>WooCommerce Options</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>WPML Ready</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
									<tr>
										<td><i class="dashicons dashicons-no"></i></td>
										<td>WooCommerce Ready</td>
										<td><i class="dashicons dashicons-yes"></i></td>
									</tr>
								</tbody>
							</table>
						</div>
					 </div>
				  </div>
			   </div>
			</div>
		</div>
	<?php
	}
}

/**
 * Output the changelog screen.
 */
function clean_enterprise_changelog_screen() {
	if ( isset( $_GET['tab'] ) && 'changelog' === $_GET['tab'] ) {
		global $wp_filesystem;
	?>
		<div class="wrap about-wrap">

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'clean-enterprise' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'clean_enterprise_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = clean_enterprise_parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
	<?php
	}
}

/**
 * Parse changelog from readme file.
 * @param  string $content
 * @return string
 */
function clean_enterprise_parse_changelog( $content ) {
	// Explode content with ==  to juse separate main content to array of headings.
	$content = explode ( '== ', $content );

	$changelog_isolated = '';

	// Get element with 'Changelog ==' as starting string, i.e isolate changelog.
	foreach ( $content as $key => $value ) {
		if (strpos( $value, 'Changelog ==') === 0) {
	    	$changelog_isolated = str_replace( 'Changelog ==', '', $value );
	    }
	}

	// Now Explode $changelog_isolated to manupulate it to add html elements.
	$changelog_array = explode( '= ', $changelog_isolated );

	// Unset first element as it is empty.
	unset( $changelog_array[0] );

	$changelog = '<pre class="changelog">';
		
	foreach ( $changelog_array as $value) {
		// Replace all enter (\n) elements with </span><span> , opening and closing span will be added in next process.
		$value = preg_replace( '/\n+/', '</span><span>', $value );

		// Add openinf and closing div and span, only first span element will have heading class.
		$value = '<div class="block"><span class="heading">= ' . $value . '</span></div>';

		// Remove empty <span></span> element which newr formed at the end.
		$changelog .= str_replace( '<span></span>', '', $value );
	}

	$changelog .= '</pre>';

	return wp_kses_post( $changelog );
}
