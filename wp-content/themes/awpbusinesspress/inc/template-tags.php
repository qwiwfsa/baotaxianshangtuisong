<?php
/**
 * Functions which enhance the theme into WordPress
 *
 * @package awpbusinesspress
 */

/**
 * Theme Custom Logo
 */
function awpbusinesspress_header_logo() { ?>

	<div class="site-branding"> 
		<?php
		if ( has_custom_logo() ) {
			the_custom_logo();
		}
		$awpbusinesspress_sticky_bar_logo = get_theme_mod( 'awpbusinesspress_sticky_bar_logo' );
		if ( $awpbusinesspress_sticky_bar_logo != null ) :
			?>

		<a class="sticky-navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" >
			<img src="<?php echo esc_url( $awpbusinesspress_sticky_bar_logo ); ?>" class="custom-logo" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>">
		</a>
			<?php
		endif;
		if ( display_header_text() ) :
			?>
			<div class="site-branding__title-wrap site-branding-text">
				<a class="site-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><h1 class="site-title"><?php esc_attr( bloginfo( 'name' ) ); ?></h1></a>
													<?php
														// Site tagline - description.
														$awpbusinesspress_description = get_bloginfo( 'description', 'display' );
														if ( $awpbusinesspress_description || is_customize_preview() ) :
															?>
					<p class="site-description"><?php echo esc_html( $awpbusinesspress_description ); ?></p>
															<?php
				endif;
														?>
			</div>
			<?php
		endif;
		?>
	</div>
	<?php
}
/**
 * Theme Logo Class
 */
function awpbusinesspress_header_logo_class( $html ) {
	$html = str_replace( 'custom-logo-link', 'navbar-brand', $html );
	return $html;
}
add_filter( 'get_custom_logo', 'awpbusinesspress_header_logo_class' );

/**
 * Select sanitization callback
 */
function awpbusinesspress_sanitize_select( $value ) {
	if ( is_array( $value ) ) {
		foreach ( $value as $key => $subvalue ) {
			$value[ $key ] = sanitize_text_field( $subvalue );
		}
		return $value;
	}
	return sanitize_text_field( $value );
}

/**
 * Theme Comment Function
*/
if ( ! function_exists( 'awpbusinesspress_comment' ) ) :
	function awpbusinesspress_comment( $comment, $args, $depth ) {
		// get theme data.
		global $comment_data;

		// translations.
		$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] :
		__( 'Reply', 'awpbusinesspress' );
		?>

		<div <?php comment_class( 'media comment-box' ); ?> id="comment-<?php comment_ID(); ?>">
			<a class="pull-left-comment">
				<?php echo get_avatar( $comment ); ?>
			</a>
			<div class="media-body">
				<div class="comment-detail">
					<h5 class="comment-detail-title"><?php printf( ( '%s' ), get_comment_author_link() ); ?>
						<time class="comment-date">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php comment_date( 'F j, Y' ); ?>&nbsp;<?php esc_html_e( 'at', 'awpbusinesspress' ); ?>&nbsp;<?php comment_time( 'g:i a' ); ?>
						</a>
						</time>
					</h5>
					<?php comment_text(); ?>
					<div class="reply">
						<?php
						comment_reply_link(
							array_merge(
								$args,
								array(
									'reply_text' => $leave_reply,
									'depth'      => $depth,
									'max_depth'  => $args['max_depth'],
								)
							)
						);
						?>
					</div>
						<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'awpbusinesspress' ); ?></em>
					<br/>
				<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}
endif;

add_filter( 'get_avatar', 'awpbusinesspress_gravatar_class' );
function awpbusinesspress_gravatar_class( $class ) {
	$class = str_replace( "class='avatar", "class='img-circle", $class );
	return $class;
}

function awpbusinesspress_read_more_button_class( $read_class ) {
	global $post;
		return '<p><a href="' . esc_url( get_permalink() ) . "#more-{$post->ID}\" class=\"more-link\">" . esc_html__( 'Read More', 'awpbusinesspress' ) . '</a></p>';
}
add_filter( 'the_content_more_link', 'awpbusinesspress_read_more_button_class' );

function awpbusinesspress_post_thumbnail() {
	if ( has_post_thumbnail() ) {
		echo '<figure class="post-thumbnail"><a href="' . esc_url( get_the_permalink() ) . '">';
		the_post_thumbnail( '', array( 'class' => 'img-fluid' ) );
		echo '</a></figure>';
	}
}

/**
 * Theme Page Header Title
 */
function awpbusinesspress_theme_page_header_title() {
	if ( is_archive() ) {
		echo '<div class="page-header-title text-center"><h1 class="text-white">';
		if ( is_day() ) :
			/* translators: %1$s %2$s: date */
			printf( esc_html__( '%1$s %2$s', 'awpbusinesspress' ), esc_html__( 'Archives', 'awpbusinesspress' ), get_the_date() );
		elseif ( is_month() ) :
			/* translators: %1$s %2$s: month */
			printf( esc_html__( '%1$s %2$s', 'awpbusinesspress' ), esc_html__( 'Archives', 'awpbusinesspress' ), get_the_date( 'F Y' ) );
		elseif ( is_year() ) :
			/* translators: %1$s %2$s: year */
			printf( esc_html__( '%1$s %2$s', 'awpbusinesspress' ), esc_html__( 'Archives', 'awpbusinesspress' ), get_the_date( 'Y' ) );
		elseif ( is_author() ) :
			/* translators: %1$s %2$s: author */
			printf( esc_html__( '%1$s %2$s', 'awpbusinesspress' ), esc_html__( 'All posts by', 'awpbusinesspress' ), get_the_author() );
		elseif ( is_category() ) :
			/* translators: %1$s %2$s: category */
			printf( esc_html__( '%1$s %2$s', 'awpbusinesspress' ), esc_html__( 'Category', 'awpbusinesspress' ), single_cat_title( '', false ) );
		elseif ( is_tag() ) :
			/* translators: %1$s %2$s: tag */
			printf( esc_html__( '%1$s %2$s', 'awpbusinesspress' ), esc_html__( 'Tag', 'awpbusinesspress' ), single_tag_title( '', false ) );
		elseif ( class_exists( 'WooCommerce' ) && is_shop() ) :
			/* translators: %1$s %2$s: WooCommerce */
			printf( esc_html__( '%1$s %2$s', 'awpbusinesspress' ), esc_html__( 'Shop', 'awpbusinesspress' ), single_tag_title( '', false ) );
		elseif ( is_archive() ) :
			the_archive_title( '<h1 class="text-white">', '</h1>' );
		endif;
		echo '</h1></div>';
	} elseif ( is_404() ) {
		echo '<div class="page-header-title text-center"><h1 class="text-white">';
		/* translators: %1$s: 404 */
		printf( esc_html__( '%1$s', 'awpbusinesspress' ), esc_html__( 'Error 404', 'awpbusinesspress' ) );
		echo '</h1></div>';
	} elseif ( is_search() ) {
		echo '<div class="page-header-title text-center"><h1 class="text-white">';
		/* translators: %1$s %2$s: search */
		printf( esc_html__( '%1$s %2$s', 'awpbusinesspress' ), esc_html__( 'Search results for', 'awpbusinesspress' ), get_search_query() );
		echo '</h1></div>';
	} else {
		echo '<div class="page-header-title text-center"><h1 class="text-white">' . esc_html( get_the_title() ) . '</h1></div>';
	}
}

function awpbusinesspress_bootstrap_menu_notitle( $menu ) {
	return $menu = preg_replace( '/ title=\"(.*?)\"/', '', $menu );
}
add_filter( 'wp_nav_menu', 'awpbusinesspress_bootstrap_menu_notitle' );

/**
 * Theme Breadcrumbs Url
 */
function awpbusinesspress_page_url() {
	$page_url = 'http';
	if ( key_exists( 'HTTPS', $_SERVER ) && ( $_SERVER['HTTPS'] == 'on' ) ) {
		$page_url .= 's';
	}
	$page_url .= '://';
	if ( $_SERVER['SERVER_PORT'] != '80' ) {
		$page_url .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
	} else {
		$page_url .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	}
	return $page_url;
}

/**
 * Theme Breadcrumbs
*/
if ( ! function_exists( 'awpbusinesspress_page_header_breadcrumbs' ) ) :
	function awpbusinesspress_page_header_breadcrumbs() {
		global $post;
		$homeLink                            = home_url();
		$awpbusinesspress_page_header_layout = get_theme_mod( 'awpbusinesspress_page_header_layout', 'awpbusinesspress_page_header_layout1' );
		if ( $awpbusinesspress_page_header_layout == 'awpbusinesspress_page_header_layout1' ) :
			$breadcrumb_class = 'text-center';
		else :
			$breadcrumb_class = 'text-right';
		endif;

		echo '<ul id="content" class="page-breadcrumb ' . esc_attr( $breadcrumb_class ) . '">';
		if ( is_home() || is_front_page() ) :
				echo '<li><a href="' . esc_url( $homeLink ) . '">' . esc_html__( 'Home', 'awpbusinesspress' ) . '</a></li>';
					echo '<li class="active">';
			echo single_post_title();
			echo '</li>';
						else :
							echo '<li><a href="' . esc_url( $homeLink ) . '">' . esc_html__( 'Home', 'awpbusinesspress' ) . '</a></li>';
							if ( is_category() ) {
								echo '<li class="active"><a href="' . esc_url( awpbusinesspress_page_url() ) . '">' . esc_html__( 'Archive by category', 'awpbusinesspress' ) . ' "' . single_cat_title( '', false ) . '"</a></li>';
							} elseif ( is_day() ) {
								echo '<li class="active"><a href="' . esc_url( get_year_link( esc_attr( get_the_time( 'Y' ) ) ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . '</a>';
								echo '<li class="active"><a href="' . esc_url( get_month_link( esc_attr( get_the_time( 'Y' ) ), esc_attr( get_the_time( 'm' ) ) ) ) . '">' . esc_html( get_the_time( 'F' ) ) . '</a>';
								echo '<li class="active"><a href="' . esc_url( awpbusinesspress_page_url() ) . '">' . esc_html( get_the_time( 'd' ) ) . '</a></li>';
							} elseif ( is_month() ) {
								echo '<li class="active"><a href="' . esc_url( get_year_link( esc_attr( get_the_time( 'Y' ) ) ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . '</a>';
								echo '<li class="active"><a href="' . esc_url( awpbusinesspress_page_url() ) . '">' . esc_html( get_the_time( 'F' ) ) . '</a></li>';
							} elseif ( is_year() ) {
								echo '<li class="active"><a href="' . esc_url( awpbusinesspress_page_url() ) . '">' . esc_html( get_the_time( 'Y' ) ) . '</a></li>';
							} elseif ( is_single() && ! is_attachment() && is_page( 'single-product' ) ) {
								if ( get_post_type() != 'post' ) {
									$cat = get_the_category();
									$cat = $cat[0];
									echo '<li>';
									echo esc_html( get_category_parents( $cat, true, '' ) );
									echo '</li>';
									echo '<li class="active"><a href="' . esc_url( awpbusinesspress_page_url() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
								}
							} elseif ( is_page() && $post->post_parent ) {
								$parent_id   = $post->post_parent;
								$breadcrumbs = array();
								while ( $parent_id ) {
									$page          = get_page( $parent_id );
									$breadcrumbs[] = '<li class="active"><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . get_the_title( $page->ID ) . '</a>';
									$parent_id     = $page->post_parent;
								}
								$breadcrumbs = array_reverse( $breadcrumbs );
								foreach ( $breadcrumbs as $crumb ) {
									echo $crumb;
								}
								echo '<li class="active"><a href="' . esc_url( awpbusinesspress_page_url() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
							} elseif ( is_search() ) {
								echo '<li class="active"><a href="' . esc_url( awpbusinesspress_page_url() ) . '">' . get_search_query() . '</a></li>';
							} elseif ( is_404() ) {
								echo '<li class="active"><a href="' . esc_url( awpbusinesspress_page_url() ) . '">' . esc_html__( 'Error 404', 'awpbusinesspress' ) . '</a></li>';
							} else {
								echo '<li class="active"><a href="' . esc_url( awpbusinesspress_page_url() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
							}
					endif;
						echo '</ul>';
	}
endif;

if ( ! function_exists( 'awpbusinesspress_custom_customizer_options' ) ) :
	function awpbusinesspress_custom_customizer_options() {

		$awpbusinesspress_sticky_bar_logo = get_theme_mod( 'awpbusinesspress_sticky_bar_logo' );

		$output_css = '';

		if ( has_header_image() ) :
			$output_css .= '.theme-page-header-area {
				background: #17212c url(' . esc_url( get_header_image() ) . ");
				background-attachment: scroll;
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				background-attachment: fixed;
			}\n";
		endif;

		if ( $awpbusinesspress_sticky_bar_logo != null ) :
			$output_css .= ".navbar-fixed .navbar-brand {
				display: none !important;
			}
            .not-sticky .sticky-navbar-brand {
				display: none !important;
			}\n";
		endif;

		$awpbusinesspress_menu_overlap         = get_theme_mod( 'awpbusinesspress_menu_overlap', true );
		$awpbusinesspress_page_header_disabled = get_theme_mod( 'awpbusinesspress_page_header_disabled', true );
		$awpbusinesspress_main_slider_disabled = get_theme_mod( 'awpbusinesspress_main_slider_disabled', true );

		// Page header CCS for Pages + Front page.
		if ( $awpbusinesspress_main_slider_disabled != true
		&& $awpbusinesspress_menu_overlap == true && $awpbusinesspress_page_header_disabled != true ) :
			$output_css .= ".navbar-overlap {
				background-color: rgba(0, 0, 0, 0.85) !important;
			}\n";
			$output_css .= ".site-content{
				margin-top:5%;
			}\n";
		endif;

		// Menu css
		if ( $awpbusinesspress_menu_overlap == true && $awpbusinesspress_page_header_disabled != true ) :
			$output_css .= "#main-content .top-margin {
			    margin-top: 12% !important;
			}\n";
		endif;

		if ( is_user_logged_in() && is_admin_bar_showing() ) {
			$output_css .= "@media (min-width: 600px){
                .navbar-fixed{top:32px;}
            }\n";
		}

		wp_add_inline_style( 'awpbusinesspress-style', $output_css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'awpbusinesspress_custom_customizer_options' );



add_action( 'after_switch_theme', 'awpbusinesspress_import_theme_mods_from_child_themes_to_parent_theme' );

/**
 * Import theme mods
 */
function awpbusinesspress_import_theme_mods_from_child_themes_to_parent_theme() {

	// Get the name of the previously active theme.
	$previous_theme = strtolower( get_option( 'theme_switched' ) );

	if ( ! in_array(
		$previous_theme,
		array(
			'awpbusinesspress',
			'coin-market',
			'hospital-health-care',
			'home-interior',
			'business-campaign',
		)
	) ) {
		return;
	}

	// Get the theme mods from the previous theme.
	$previous_theme_content = get_option( 'theme_mods_' . $previous_theme );

	if ( ! empty( $previous_theme_content ) ) {
		foreach ( $previous_theme_content as $previous_theme_mod_k => $previous_theme_mod_v ) {
			set_theme_mod( $previous_theme_mod_k, $previous_theme_mod_v );
		}
	}
}

/**
 * Admin notice
 */
class awpbusinesspress_screen {
	public function __construct() {
		/* notice  Lines*/
		add_action( 'switch_theme', array( $this, 'flush_dismiss_status' ) );
		add_action( 'admin_init', array( $this, 'getting_started_notice_dismissed' ) );
		add_action( 'load-themes.php', array( $this, 'awpbusinesspress_activation_admin_notice' ) );
	}
	public function awpbusinesspress_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ( 'themes.php' == $pagenow ) ) {
			add_action( 'admin_notices', array( $this, 'awpbusinesspress_admin_notice' ), 99 );
		}
	}
	/**
	 * Display an admin notice linking to the welcome screen
	 *
	 * @sfunctionse 1.8.2.4
	 */
	public function awpbusinesspress_admin_notice() {
		if ( is_admin() && ! get_user_meta( get_current_user_id(), 'gs_notice_dismissed' ) ){ ?>

			<div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
				<?php
					echo '<div><a href="' . esc_url( wp_nonce_url( add_query_arg( 'gs-notice-dismissed', 'dismiss_admin_notices' ) ) ) . '" class="getting-started-notice-dismiss"> Dismiss this notice </a></div>';
				?>
					<div class="awpbusinesspress-getting-started-notice clearfix">
						<div class="awpbusinesspress-theme-screenshot">
							<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png" class="screenshot" alt="<?php esc_attr_e( 'Theme Screenshot', 'awpbusinesspress' ); ?>" />
						</div><!-- /.awpbusinesspress-theme-screenshot -->
						<div class="awpbusinesspress-theme-notice-content">
							<h2 class="awpbusinesspress-notice-h2">
								<?php
								printf(
								/* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
									esc_html__( 'Welcome! Thank you for choosing %1$s!', 'awpbusinesspress' ),
									'<strong>' . wp_get_theme()->get( 'Name' ) . '</strong>'
								);
								?>
							</h2>

							<p class="plugin-install-notice"><?php echo sprintf( __( 'To take full advantage of all the features of this theme, please install and activate the <strong>AWP Companion</strong> plugin, then enjoy this theme.', 'awpbusinesspress' ) ); ?></p>

							<a class="awpbusinesspress-btn-get-started button button-primary button-hero awpbusinesspress-button-padding" href="#" data-name="" data-slug="">
							<?php
							printf(
							/* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
								esc_html__( 'Get started with %1$s', 'awpbusinesspress' ),
								'<strong>' . wp_get_theme()->get( 'Name' ) . '</strong>'
							);
							?>

							</a><span class="awpbusinesspress-push-down">
							<?php
								/* translators: %1$s: Anchor link start %2$s: Anchor link end */
								printf(
									'or %1$sCustomize theme%2$s</a></span>',
									'<a target="_blank" href="' . esc_url( admin_url( 'customize.php' ) ) . '">',
									'</a>'
								);
							?>
						</div><!-- /.awpbusinesspress-theme-notice-content -->
					</div>
				</div>
			<?php
		}
	}

	/**
	 * Register dismissal of the getting started notification.
	 * Acts on the dismiss link.
	 * If clicked, the admin notice disappears and will no longer be visible to this user.
	 */
	public function getting_started_notice_dismissed() {

		if ( isset( $_GET['gs-notice-dismissed'] ) ) {
			add_user_meta( get_current_user_id(), 'gs_notice_dismissed', 'true' );
		}
	}

	/**
	 * Deletes the getting started notice's dismiss status upon theme switch.
	 */
	public function flush_dismiss_status() {
		delete_user_meta( get_current_user_id(), 'gs_notice_dismissed', 'true' );
	}

}
$GLOBALS['awpbusinesspress_screen'] = new awpbusinesspress_screen();


/**
* Plugin installer
*/

add_action( 'wp_ajax_install_act_plugin', 'awpbusinesspress_admin_install_plugin' );

function awpbusinesspress_admin_install_plugin() {
	/**
	 * Install Plugin.
	 */
	include_once ABSPATH . '/wp-admin/includes/file.php';
	include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

	if ( ! file_exists( WP_PLUGIN_DIR . '/awp-companion' ) ) {
		$api = plugins_api(
			'plugin_information',
			array(
				'slug'   => sanitize_key( wp_unslash( 'awp-companion' ) ),
				'fields' => array(
					'sections' => false,
				),
			)
		);

		$skin     = new WP_Ajax_Upgrader_Skin();
		$upgrader = new Plugin_Upgrader( $skin );
		$result   = $upgrader->install( $api->download_link );
	}

	// Activate plugin.
	if ( current_user_can( 'activate_plugin' ) ) {
		$result = activate_plugin( 'awp-companion/awp-companion.php' );
	}
}
