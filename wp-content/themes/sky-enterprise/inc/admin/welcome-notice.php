<?php

/**
 * file for holding dashboard welcome page for theme
 */
if (!function_exists('sky_enterprise_is_plugin_installed')) {
    function sky_enterprise_is_plugin_installed($plugin_slug)
    {
        $plugin_path = WP_PLUGIN_DIR . '/' . $plugin_slug;
        return file_exists($plugin_path);
    }
}
if (!function_exists('sky_enterprise_is_plugin_activated')) {
    function sky_enterprise_is_plugin_activated($plugin_slug)
    {
        return is_plugin_active($plugin_slug);
    }
}
function sky_enterprise_dismissble_notice()
{
    update_option('sky_enterprise_dismissed_custom_notice', 1);
}
add_action('wp_ajax_sky_enterprise_dismissble_notice', 'sky_enterprise_dismissble_notice');
// Hook into a custom action when the button is clicked
add_action('wp_ajax_sky_enterprise_install_and_activate_plugins', 'sky_enterprise_install_and_activate_plugins');
add_action('wp_ajax_nopriv_sky_enterprise_install_and_activate_plugins', 'sky_enterprise_install_and_activate_plugins');
add_action('wp_ajax_sky_enterprise_rplugin_activation', 'sky_enterprise_rplugin_activation');
add_action('wp_ajax_nopriv_sky_enterprise_rplugin_activation', 'sky_enterprise_rplugin_activation');

// Function to install and activate the plugins

require_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/misc.php');
require_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');
function sky_enterprise_install_and_activate_plugins()
{
    // Define the plugins to be installed and activated
    $recommended_plugins = array(
        array(
            'slug' => 'sky-addons',
            'file' => 'sky-addons.php',
            'name' => 'Sky Addons'
        ),
        array(
            'slug' => 'advanced-import',
            'file' => 'advanced-import.php',
            'name' => 'Advanced Imporrt'
        ),
        array(
            'slug' => 'sky-essential-addons',
            'file' => 'sky-essential-addons.php',
            'name' => 'Sky Essential Addons'
        ),
        // Add more plugins here as needed
    );

    // Include the necessary WordPress functions


    // Set up a transient to store the installation progress
    set_transient('install_and_activate_progress', array(), MINUTE_IN_SECONDS * 10);

    // Loop through each plugin
    foreach ($recommended_plugins as $plugin) {
        $plugin_slug = $plugin['slug'];
        $plugin_file = $plugin['file'];
        $plugin_name = $plugin['name'];

        // Check if the plugin is active
        if (is_plugin_active($plugin_slug . '/' . $plugin_file)) {
            update_install_and_activate_progress($plugin_name, 'Already Active');
            continue; // Skip to the next plugin
        }

        // Check if the plugin is installed but not active
        if (is_sky_enterprise_plugin_installed($plugin_slug . '/' . $plugin_file)) {
            $activate = activate_plugin($plugin_slug . '/' . $plugin_file);
            if (is_wp_error($activate)) {
                update_install_and_activate_progress($plugin_name, 'Error');
                continue; // Skip to the next plugin
            }
            update_install_and_activate_progress($plugin_name, 'Activated');
            continue; // Skip to the next plugin
        }

        // Plugin is not installed or activated, proceed with installation
        update_install_and_activate_progress($plugin_name, 'Installing');

        // Fetch plugin information
        $api = plugins_api('plugin_information', array(
            'slug' => $plugin_slug,
            'fields' => array('sections' => false),
        ));

        // Check if plugin information is fetched successfully
        if (is_wp_error($api)) {
            update_install_and_activate_progress($plugin_name, 'Error');
            continue; // Skip to the next plugin
        }

        // Set up the plugin upgrader
        $upgrader = new Plugin_Upgrader();
        $install = $upgrader->install($api->download_link);

        // Check if installation is successful
        if ($install) {
            // Activate the plugin
            $activate = activate_plugin($plugin_slug . '/' . $plugin_file);

            // Check if activation is successful
            if (is_wp_error($activate)) {
                update_install_and_activate_progress($plugin_name, 'Error');
                continue; // Skip to the next plugin
            }
            update_install_and_activate_progress($plugin_name, 'Activated');
        } else {
            update_install_and_activate_progress($plugin_name, 'Error');
        }
    }

    // Delete the progress transient
    $redirect_url = admin_url('themes.php?page=advanced-import');

    // Delete the progress transient
    delete_transient('install_and_activate_progress');
    // Return JSON response
    wp_send_json_success(array('redirect_url' => $redirect_url));
}

// Function to check if a plugin is installed but not active
function is_sky_enterprise_plugin_installed($plugin_slug)
{
    $plugins = get_plugins();
    return isset($plugins[$plugin_slug]);
}

// Function to update the installation and activation progress
function update_install_and_activate_progress($plugin_name, $status)
{
    $progress = get_transient('install_and_activate_progress');
    $progress[] = array(
        'plugin' => $plugin_name,
        'status' => $status,
    );
    set_transient('install_and_activate_progress', $progress, MINUTE_IN_SECONDS * 10);
}


function sky_enterprise_dashboard_menu()
{
    add_theme_page(esc_html__('Sky Enterprise Lite', 'sky-enterprise'), esc_html__('Sky Enterprise Lite', 'sky-enterprise'), 'edit_theme_options', 'about-sky-enterprise', 'sky_enterprise_theme_info_display');
}
add_action('admin_menu', 'sky_enterprise_dashboard_menu');
function sky_enterprise_theme_info_display()
{ ?>
    <div class="dashboard-about-sky-enterprise">
        <div class="sky-enterprise-dashboard">
            <h3><?php echo __('Welcome to Sky Enterprise (Free Version)', 'sky-enterprise') ?> </h3>
            <br/>
            <ul id="sky-enterprise-dashboard-tabs-nav">
                <li><a href="#sky-enterprise-upgrade-to-pro"><?php echo __('Upgrade to Pro', 'sky-enterprise') ?></a></li>
                <li><a href="#sky-enterprise-comparision"><?php echo __('free vs Pro', 'sky-enterprise') ?></a></li>
                <li><a href="#sky-enterprise-setup"><?php echo __('Setup Instruction', 'sky-enterprise') ?></a></li>
            </ul> <!-- END tabs-nav -->
            <div id="tabs-content">
                <div id="sky-enterprise-upgrade-to-pro" class="tab-content">
                    <div class="half-col pro-features">
                        <h3><?php echo __('Premium Features', 'sky-enterprise') ?></h3>
                        <p><?php echo __('Including all free features and comes pro templates, blocks, patterns that enhance and power up the website, here are some blocks that add the powerful features for your business website. By seamlessly integrating these blocks with our ready-to-use patterns', 'sky-enterprise') ?></p>
                        <a href="https://skythemes.com/themes/sky-enterprise-pro" class="upgrade-btn button" target="_blank"><?php echo __('Upgrade to Pro', 'sky-enterprise') ?></a>
                    </div>

                </div>
                <div id="sky-enterprise-comparision" class="tab-content">
                    <div class="featured-list">
                        <div class="half-col pro-features">
                            <h3><?php echo __('Sky Enterprise Features (Pro)', 'sky-enterprise') ?></h3>
                            <p><b><?php echo __('Premium Integrated Page + Block Templates', 'sky-enterprise') ?></b></p>
                            <ul>
                                <li><?php echo __('15+ pro template pages', 'sky-enterprise') ?></li>
                                <li><?php echo __('15+ pro template blocks', 'sky-enterprise') ?></li>
                                <li><?php echo __('Premium support', 'sky-enterprise') ?></li>
                            </ul>
                            <br />
                            <p><b><?php echo __('Premium Patterns', 'sky-enterprise') ?></b></p>
                            <ul>
                                <li><?php echo __('10+ pro patterns', 'sky-enterprise') ?></li>
                                <li><?php echo __('Feature Banner', 'sky-enterprise') ?></li>
                                <li><?php echo __('Feature Content', 'sky-enterprise') ?></li>
                                <li><?php echo __('Portfolio patterns', 'sky-enterprise') ?></li>
                                <li><?php echo __('3 Pricing tables', 'sky-enterprise') ?></li>
                            </ul>
                            <br />
                            <p><b><?php echo __('Premium Blocks', 'sky-enterprise') ?></b></p>
                            <ul>
                                <li><?php echo __('10+ pro blocks', 'sky-enterprise') ?></li>
                                <li><?php echo __('Advanced Slider', 'sky-enterprise') ?></li>
                                <li><?php echo __('Map', 'sky-enterprise') ?></li>
                                <li><?php echo __('Grid', 'sky-enterprise') ?></li>
                                <li><?php echo __('Post Carousel', 'sky-enterprise') ?></li>
                                <li><?php echo __('Post List', 'sky-enterprise') ?></li>
                                <li><?php echo __('Star Rating', 'sky-enterprise') ?></li>
                                <li><?php echo __('Team', 'sky-enterprise') ?></li>
                                <li><?php echo __('Testimonial', 'sky-enterprise') ?></li>
                                <li><?php echo __('FAQs', 'sky-enterprise') ?></li>
                                <li><?php echo __('Info Box', 'sky-enterprise') ?></li>
                            </ul>
                            <br />
                            <a href="https://skythemes.com/themes/sky-enterprise-pro" class="upgrade-btn button" target="_blank"><?php echo __('Upgrade to Pro', 'sky-enterprise') ?></a>
                        </div>
                        <div class="half-col free-features">
                            <h3><?php echo __('Sky Enterprise Features (Free)', 'sky-enterprise') ?></h3>
                            <ul>
                                <li>
                                    <ul>
                                        <li><?php echo __('Banner Section', 'sky-enterprise') ?></li>
                                        <li><?php echo __('About Us Section', 'sky-enterprise') ?></li>
                                        <li><?php echo __('Services Section', 'sky-enterprise') ?></li>
                                        <li><?php echo __('Featured Work Section', 'sky-enterprise') ?></li>
                                        <li><?php echo __('Testimonial Section', 'sky-enterprise') ?></li>
                                        <li><?php echo __('Call To Action Section', 'sky-enterprise') ?></li>
                                        <li><?php echo __('FAQ Section ', 'sky-enterprise') ?></li>
                                        <li><?php echo __('Counter Section', 'sky-enterprise') ?></li>
                                        <li><?php echo __('Latest Post Display Section', 'sky-enterprise') ?></li>
                                        <li><?php echo __('Brands Logo Showcase', 'sky-enterprise') ?></li>
                                    </ul>
                                </li>
                                <li><strong> - <?php echo __('Fully Customizable Header Layout', 'sky-enterprise') ?></strong></li>
                                <li> <strong>- <?php echo __('Fully Customizable Footer Layout ', 'sky-enterprise') ?></strong></li>
                                <li><strong> - <?php echo __('12+ Beautiful Fonts Option', 'sky-enterprise') ?></strong></li>
                                <li> <strong>- <?php echo __('On Scroll Animation option', 'sky-enterprise') ?></strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="sky-enterprise-setup" class="tab-content">
                    <h3 class="sky-enterprise-baisc-guideline-header"><?php echo __('Basic Theme Setup', 'sky-enterprise') ?></h3>
                    <div class="sky-enterprise-baisc-guideline">
                        <div class="featured-box">
                            <ul>
                                <li><strong><?php echo __('Setup Header Layout:', 'sky-enterprise') ?></strong>
                                    <ul>
                                        <li> - <?php echo __('Go to Appearance -> Editor -> Patterns -> Template Parts -> Header:', 'sky-enterprise') ?></li>
                                        <li> - <?php echo __('click on Header > Click on Edit (Icon) -> Add or Remove Requirend block/content as your requirement.:', 'sky-enterprise') ?></li>
                                        <li> - <?php echo __('Click on save to update your layout', 'sky-enterprise') ?></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="featured-box">
                            <ul>
                                <li><strong><?php echo __('Setup Footer Layout:', 'sky-enterprise') ?></strong>
                                    <ul>
                                        <li> - <?php echo __('Go to Appearance -> Editor -> Patterns -> Template Parts -> Footer:', 'sky-enterprise') ?></li>
                                        <li> - <?php echo __('click on Footer > Click on Edit (Icon) > Add or Remove Requirend block/content as your requirement.:', 'sky-enterprise') ?></li>
                                        <li> - <?php echo __('Click on save to update your layout', 'sky-enterprise') ?></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="featured-box">
                            <ul>
                                <li><strong><?php echo __('Setup Templates like Homepage/404/Search/Page/Single and more templates Layout:', 'sky-enterprise') ?></strong>
                                    <ul>
                                        <li> - <?php echo __('Go to Appearance -> Editor -> Templates:', 'sky-enterprise') ?></li>
                                        <li> - <?php echo __('click on Template(You need to edit/update) > Click on Edit (Icon) > Add or Remove Requirend block/content as your requirement.:', 'sky-enterprise') ?></li>
                                        <li> - <?php echo __('Click on save to update your layout', 'sky-enterprise') ?></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="featured-box">
                            <ul>
                                <li><strong><?php echo __('Restore/Reset Default Content layout of Template(Like: Frontpage/Blog/Archive etc.)', 'sky-enterprise') ?></strong>
                                    <ul>
                                        <li> - <?php echo __('Go to Appearance -> Editor -> Templates:', 'sky-enterprise') ?></li>
                                        <li> - <?php echo __('Click on Manage all Templates', 'sky-enterprise') ?></li>
                                        <li> - <?php echo __('Click on 3 Dots icon at right side of respective Template', 'sky-enterprise') ?></li>
                                        <li> - <?php echo __('Click on Clear Customization', 'sky-enterprise') ?></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="featured-box">
                            <ul>
                                <li><strong><?php echo __('Restore/Reset Default Content layout of Template Parts(Header/Footer/Sidebar)', 'sky-enterprise') ?></strong>
                                    <ul>
                                        <li> - <?php echo __('Go to Appearance -> Editor -> Patterns:', 'sky-enterprise') ?></li>
                                        <li> - <?php echo __('Click on Manage All Template Parts', 'sky-enterprise') ?></li>
                                        <li> - <?php echo __('Click on 3 Dots icon at right side of respective Template parts', 'sky-enterprise') ?></li>
                                        <li> - <?php echo __('Click on Clear Customization', 'sky-enterprise') ?></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
