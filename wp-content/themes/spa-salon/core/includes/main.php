<?php

/**
* Get started notice
*/

add_action( 'wp_ajax_spa_salon_dismissed_notice_handler', 'spa_salon_ajax_notice_handler' );

/**
 * AJAX handler to store the state of dismissible notices.
 */
function spa_salon_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        // Store it in the options table
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function spa_salon_deprecated_hook_admin_notice() {
    // Check if it's been dismissed...
    if ( ! get_option( 'dismissed-get_started', false ) ) {
        $current_screen = get_current_screen();

        // Check screen ID correctly
        if ( 
            $current_screen && 
            $current_screen->id !== 'appearance_page_spa-salon-guide-page' &&
            $current_screen->id !== 'appearance_page_spasalon-wizard'
        ) {
            $spa_salon_comments_theme = wp_get_theme();
            ?>
            <div class="spa-salon-notice-wrapper updated notice notice-get-started-class is-dismissible" data-notice="get_started">
                <div class="spa-salon-notice">
                    <div class="spa-salon-notice-content">
                        <div class="spa-salon-notice-heading">
                            <h2>
                                <?php esc_html_e('Thanks For Installing ', 'spa-salon'); ?>
                                <?php echo esc_html( $spa_salon_comments_theme ); ?>
                                <?php esc_html_e('Theme', 'spa-salon'); ?>
                            </h2>
                            <p>
                                <?php
                                /* translators: %s: theme name */
                                printf(
                                    esc_html__("%s is now installed and ready to use. We've provided some links to get you started.", 'spa-salon'),
                                    $spa_salon_comments_theme
                                );
                                ?>
                            </p>
                        </div>
                        <div class="diplay-flex-btn">
                            <a class="button button-primary" href="<?php echo esc_url( admin_url( 'themes.php?page=spa-salon-guide-page' ) ); ?>">
                                <?php echo esc_html__('GET STARTED', 'spa-salon'); ?>
                            </a>
                            <a class="button button-primary" href="<?php echo esc_url( SPA_SALON_DOCS_FREE ); ?>">
                                <?php echo esc_html__('GO TO PREMIUM', 'spa-salon'); ?>
                            </a>
                            <a class="button button-primary import" href="<?php echo esc_url( admin_url( 'themes.php?page=spasalon-wizard' ) ); ?>">
                                <?php echo esc_html__('ONE CLICK DEMO IMPORTER', 'spa-salon'); ?>
                            </a>
                        </div>
                    </div>
                    <div class="spa-salon-notice-img">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/notification.png' ); ?>" alt="<?php esc_attr_e('logo', 'spa-salon'); ?>">
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
add_action( 'admin_notices', 'spa_salon_deprecated_hook_admin_notice' );

add_action( 'admin_menu', 'spa_salon_getting_started' );
function spa_salon_getting_started() {
	add_theme_page( esc_html__('Get Started', 'spa-salon'), esc_html__('Get Started', 'spa-salon'), 'edit_theme_options', 'spa-salon-guide-page', 'spa_salon_test_guide');
}

function spa_salon_admin_enqueue_scripts() {
	wp_enqueue_style( 'spa-salon-admin-style', esc_url( get_template_directory_uri() ).'/css/main.css' );
	wp_enqueue_script( 'spa-salon-admin-script', get_template_directory_uri() . '/js/spa-salon-admin-script.js', array( 'jquery' ), '', true );
    wp_localize_script( 'spa-salon-admin-script', 'spa_salon_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action( 'admin_enqueue_scripts', 'spa_salon_admin_enqueue_scripts' );

if( ! defined( 'SPA_SALON_DOCS_FREE' ) ) {
define('SPA_SALON_DOCS_FREE',__('https://demo.misbahwp.com/docs/spa-salon-free-docs/','spa-salon'));
}
if( ! defined( 'SPA_SALON_DOCS_PRO' ) ) {
define('SPA_SALON_DOCS_PRO',__('https://demo.misbahwp.com/docs/spa-salon-pro-docs','spa-salon'));
}
if( ! defined( 'SPA_SALON_BUY_NOW' ) ) {
define('SPA_SALON_BUY_NOW',__('https://www.misbahwp.com/products/spa-wordpress-theme','spa-salon'));
}
if( ! defined( 'SPA_SALON_SUPPORT_FREE' ) ) {
define('SPA_SALON_SUPPORT_FREE',__('https://wordpress.org/support/theme/spa-salon','spa-salon'));
}
if( ! defined( 'SPA_SALON_REVIEW_FREE' ) ) {
define('SPA_SALON_REVIEW_FREE',__('https://wordpress.org/support/theme/spa-salon/reviews/#new-post','spa-salon'));
}
if( ! defined( 'SPA_SALON_DEMO_PRO' ) ) {
define('SPA_SALON_DEMO_PRO',__('https://demo.misbahwp.com/spa-salon/','spa-salon'));
}
if( ! defined( 'SPA_SALON_THEME_BUNDLE' ) ) {
define('SPA_SALON_THEME_BUNDLE',__('https://www.misbahwp.com/products/wordpress-bundle','spa-salon'));
}

function spa_salon_test_guide() { ?>
	<?php $spa_salon_comments_theme = wp_get_theme(); ?>
	<div class="wrap" id="main-page">
		<div id="lefty">
			<div id="admin_links">
				<a href="<?php echo esc_url( SPA_SALON_DOCS_FREE ); ?>" target="_blank" class="blue-button-1"><?php esc_html_e( 'Documentation', 'spa-salon' ) ?></a>
				<a href="<?php echo esc_url( admin_url('customize.php') ); ?>" id="customizer" target="_blank"><?php esc_html_e( 'Customize', 'spa-salon' ); ?> </a>
				<a class="blue-button-1" href="<?php echo esc_url( SPA_SALON_SUPPORT_FREE ); ?>" target="_blank" class="btn3"><?php esc_html_e( 'Support', 'spa-salon' ) ?></a>
				<a class="blue-button-2" href="<?php echo esc_url( SPA_SALON_REVIEW_FREE ); ?>" target="_blank" class="btn4"><?php esc_html_e( 'Review', 'spa-salon' ) ?></a>
			</div>
			<div id="description">
				<h3><?php esc_html_e('Welcome! Thank you for choosing ','spa-salon'); ?><?php echo esc_html( $spa_salon_comments_theme ); ?>  <span><?php esc_html_e('Version: ', 'spa-salon'); ?><?php echo esc_html($spa_salon_comments_theme['Version']);?></span></h3>
				<div class="demo-import-box">
					<h4><?php echo esc_html__('Import homepage demo in just one click.','spa-salon'); ?></h4>
					<p><?php echo esc_html__('Get started with the wordpress theme installation','spa-salon'); ?></p>
					<a class="button button-primary import" href="themes.php?page=spasalon-wizard"><?php echo esc_html__('ONE CLICK DEMO IMPORTER','spa-salon'); ?></a>
				</div>
				<img class="img_responsive" style="width:100%;" src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png">
				<div id="description-insidee">
					<?php
						$spa_salon_comments_theme = wp_get_theme();
						echo wp_kses_post( apply_filters( 'misbah_theme_description', esc_html( $spa_salon_comments_theme->get( 'Description' ) ) ) );
					?>
				</div>
			</div>
		</div>

		<div id="righty">
			<div class="postboxx donate">
				<h3 class="hndle"><?php esc_html_e( 'Upgrade to Premium', 'spa-salon' ); ?></h3>
				<div class="insidee">
					<p><?php esc_html_e('Discover upgraded pro features with premium version click to upgrade.','spa-salon'); ?></p>
					<div id="admin_pro_links">
						<a class="blue-button-2" href="<?php echo esc_url( SPA_SALON_BUY_NOW ); ?>" target="_blank"><?php esc_html_e( 'Go Pro', 'spa-salon' ); ?></a>
						<a class="blue-button-1" href="<?php echo esc_url( SPA_SALON_DEMO_PRO ); ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'spa-salon' ) ?></a>
						<a class="blue-button-2" href="<?php echo esc_url( SPA_SALON_DOCS_PRO ); ?>" target="_blank"><?php esc_html_e( 'Pro Docs', 'spa-salon' ) ?></a>
					</div>
				</div>

				<h3 class="hndle bundle"><?php esc_html_e( 'Get All Themes', 'spa-salon' ); ?></h3>
				<div class="insidee theme-bundle">
					<img width="100%" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/bundle-image.png' ); ?>" alt="<?php esc_attr_e('logo', 'spa-salon'); ?>">
					<p class="offer"><?php esc_html_e('Get 100+ Perfect WordPress Theme In A Single Package at just $89."','spa-salon'); ?></p>
					<p class="coupon"><?php esc_html_e('Get Our Theme Pack of 100+ WordPress Themes At 15% Off','spa-salon'); ?><span class="coupon-code"><?php esc_html_e('"Bundleup15"','spa-salon'); ?></span></p>
					<div id="admin_pro_linkss">
						<a class="blue-button-1" href="<?php echo esc_url( SPA_SALON_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e( 'Buy All Themes - $89', 'spa-salon' ) ?></a>
					</div>
				<div class="d-table">
			    <ul class="d-column">
			      <li class="feature"><?php esc_html_e('Features','spa-salon'); ?></li>
			      <li class="free"><?php esc_html_e('Pro','spa-salon'); ?></li>
			      <li class="plus"><?php esc_html_e('Free','spa-salon'); ?></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('24hrs Priority Support','spa-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Kirki Framework','spa-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('One Click Demo Import','spa-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Secton Reordering','spa-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Enable / Disable Option','spa-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Posttype','spa-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Multiple Sections','spa-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Color Pallete','spa-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Widgets','spa-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Page Templates','spa-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Typography','spa-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Section Background Image / Color ','spa-salon'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
	  		</div>
			</div>
		</div>
	</div>
<?php } ?>
