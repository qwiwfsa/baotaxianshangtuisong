<?php
// Add Getstart admin notice
function venture_capital_firm_admin_notice() { 
      $venture_capital_firm_meta = get_option( 'venture_capital_firm_admin_notice' );

       if( !$venture_capital_firm_meta ){
       if( is_network_admin() ){
            return;
        } if( ! current_user_can( 'manage_options' ) ){
            return;
        }if ( isset($_GET['page']) && $_GET['page'] === 'venture-capital-firm-info' ) {
            return;
        } ?>
        <div class="notice notice-success is-dismissible welcome-notice">
            <div class="notice-row">
                <div class="notice-text">
                    <p class="welcome-text1"><?php esc_html_e( '🎉 Welcome to VW Themes,', 'venture-capital-firm' ); ?></p>
                    <p class="welcome-text2"><?php esc_html_e( 'You are now using the Venture Capital Firm, a beautifully designed theme to kickstart your website.', 'venture-capital-firm' ); ?></p>
                    <p class="welcome-text3"><?php esc_html_e( 'To help you get started quickly, use the options below:', 'venture-capital-firm' ); ?></p>

                    <span class="import-btn">
                        <a href="javascript:void(0);" id="install-activate-button" class="button admin-button info-button">
                           <?php echo __('GET STARTED', 'venture-capital-firm'); ?>
                        </a>
                        <script type="text/javascript">
                            document.getElementById('install-activate-button').addEventListener('click', function () {
                                const venture_capital_firm_button = this;
                                const venture_capital_firm_redirectUrl = '<?php echo esc_url(admin_url("themes.php?page=venture-capital-firm-info")); ?>';
                                // First, check if plugin is already active
                                jQuery.post(ajaxurl, { action: 'check_plugin_activation' }, function (response) {
                                    if (response.success && response.data.active) {
                                        // Plugin already active — just redirect
                                        window.location.href = venture_capital_firm_redirectUrl;
                                    } else {
                                        // Show Installing & Activating only if not already active
                                        venture_capital_firm_button.textContent = 'Installing & Activating...';

                                        jQuery.post(ajaxurl, {
                                            action: 'install_and_activate_required_plugin',
                                            nonce: '<?php echo wp_create_nonce("install_activate_nonce"); ?>'
                                        }, function (response) {
                                            if (response.success) {
                                                window.location.href = venture_capital_firm_redirectUrl;
                                            } else {
                                                alert('Failed to activate the plugin.');
                                                venture_capital_firm_button.textContent = 'Try Again';
                                            }
                                        });
                                    }
                                });
                            });
                        </script>

                    </span>

                    <span class="demo-btn">
                        <a href="https://www.vwthemes.net/venture-capital-firm-pro/" class="button button-primary" target="_blank">
                            <?php esc_html_e( 'VIEW DEMO', 'venture-capital-firm' ); ?>
                        </a>
                    </span>

                    <span class="upgrade-btn">
                        <a href="https://www.vwthemes.com/products/venture-capital-wordpress-theme" class="button button-primary" target="_blank">
                            <?php esc_html_e( 'UPGRADE TO PRO', 'venture-capital-firm' ); ?>
                        </a>
                    </span>

                    <span class="bundle-btn">
                        <a href="https://www.vwthemes.com/products/wp-theme-bundle" class="button button-primary" target="_blank">
                            <?php esc_html_e( 'BUNDLE OF 485+ THEMES', 'venture-capital-firm' ); ?>
                        </a>
                    </span>
                </div>

                <div class="notice-img1">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/arrow-notice.png' ); ?>" width="180" alt="<?php esc_attr_e( 'Venture Capital Firm', 'venture-capital-firm' ); ?>" />
                </div>

                <div class="notice-img2">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/bundle-notice.png' ); ?>" width="180" alt="<?php esc_attr_e( 'Venture Capital Firm', 'venture-capital-firm' ); ?>" />
                </div>
            </div>
        </div>
        <?php

    }?>
        <?php

}

add_action( 'admin_notices', 'venture_capital_firm_admin_notice' );

if( ! function_exists( 'venture_capital_firm_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function venture_capital_firm_update_admin_notice(){
  if ( isset( $_GET['venture_capital_firm_admin_notice'] ) && $_GET['venture_capital_firm_admin_notice'] == '1' ) {
        update_option( 'venture_capital_firm_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'venture_capital_firm_update_admin_notice' );

//After Switch theme function
add_action('after_switch_theme', 'venture_capital_firm_getstart_setup_options');
function venture_capital_firm_getstart_setup_options () {
    update_option('venture_capital_firm_admin_notice', FALSE );
}

