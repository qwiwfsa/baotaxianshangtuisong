<?php
if ( ! class_exists( 'Digital_Magazine_Plugin_Activation_Settings' ) ) {
	/**
	 * Theme_Plugin_Activation_Settings initial setup
	 *
	 * @since 1.6.2
	 */

	class Digital_Magazine_Plugin_Activation_Settings {

        private static $instance;

        /** Initiator **/
        public static function get_instance() {
          if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
          }
          return self::$instance;
        }

        /*  Constructor */
        public function __construct() {
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
            $actions                   = $this->digital_magazine_get_recommended_actions();
        }

        public function enqueue_scripts() {
            wp_enqueue_script('updates');
            wp_register_script( 'theme-plugin-activation-script', get_template_directory_uri() . '/demo-import/assets/js/demo-import-plugin-activation.js', array('jquery') );
            wp_localize_script('theme-plugin-activation-script', 'digital_magazine_activate_plugin',
                array(
                    'installing' => esc_html__('Installing', 'digital-magazine'),
                    'activating' => esc_html__('Activating', 'digital-magazine'),
                    'error' => esc_html__('Error', 'digital-magazine'),
                    'ajax_url' => esc_url(admin_url('admin-ajax.php')),
                )
            );
            wp_enqueue_script( 'theme-plugin-activation-script' );
        }

        // --------- Plugin Actions ---------
        public function digital_magazine_get_recommended_actions() {

            $act_count           = 0;
            $actions_todo = get_option( 'recommending_actions', array());
            
            $plugins = $this->digital_magazine_get_recommended_plugins();

            if ($plugins) {
                foreach ($plugins as $key => $plugin) {
                    $action = array();
                    if (!isset($plugin['slug'])) {
                        continue;
                    }

                    $action['id']   = 'install_' . $plugin['slug'];
                    $action['desc'] = '';
                    if (isset($plugin['desc'])) {
                        $action['desc'] = $plugin['desc'];
                    }

                    $action['name'] = '';
                    if (isset($plugin['name'])) {
                        $action['title'] = $plugin['name'];
                    }

                    $link_and_is_done  = $this->digital_magazine_get_plugin_buttion($plugin['slug'], $plugin['name'], $plugin['function']);
                    $action['link']    = $link_and_is_done['button'];
                    $action['is_done'] = $link_and_is_done['done'];
                    if (!$action['is_done'] && (!isset($actions_todo[$action['id']]) || !$actions_todo[$action['id']])) {
                        $act_count++;
                    }
                    $recommended_actions[] = $action;
                    $actions_todo[]        = array('id' => $action['id'], 'watch' => true);
                }
                return array('count' => $act_count, 'actions' => $recommended_actions);
            }

        }

        public function digital_magazine_get_recommended_plugins() {
                
            $plugins = apply_filters('digital_magazine_theme_recommended_plugins', array());
            return $plugins;
        }

        public function digital_magazine_get_plugin_buttion($slug, $name, $function) {
                $is_done      = false;
                $button_html  = '';
                $is_installed = $this->digital_magazine_is_plugin_installed($slug);
                $plugin_path  = $this->digital_magazine_get_plugin_basename_from_slug($slug);
                $is_activeted = (class_exists($function)) ? true : false;
                if (!$is_installed) {
                    $plugin_install_url = add_query_arg(
                        array(
                            'action' => 'install-plugin',
                            'plugin' => $slug,
                        ),
                        self_admin_url('update.php')
                    );
                    $plugin_install_url = wp_nonce_url($plugin_install_url, 'install-plugin_' . esc_attr($slug));
                    $button_html        = sprintf('<a class="theme-plugin-install install-now button-secondary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
                        esc_attr($slug),
                        esc_url($plugin_install_url),
                        /* translators: 1: Plugin Name. */
                        sprintf(esc_html__('Install %s Now', 'digital-magazine'), esc_html($name)),
                        esc_html($name),
                        esc_html__('Install & Activate', 'digital-magazine')
                    );
                } elseif ($is_installed && !$is_activeted) {

                    $plugin_activate_link = add_query_arg(
                        array(
                            'action'        => 'activate',
                            'plugin'        => rawurlencode($plugin_path),
                            'plugin_status' => 'all',
                            'paged'         => '1',
                            '_wpnonce'      => wp_create_nonce('activate-plugin_' . $plugin_path),
                        ), self_admin_url('plugins.php')
                    );

                    $button_html = sprintf('<a class="theme-plugin-activate activate-now button-primary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
                        esc_attr($slug),
                        esc_url($plugin_activate_link),
                        /* translators: 1: Plugin Name. */
                        sprintf(esc_html__('Activate %s Now', 'digital-magazine'), esc_html($name)),
                        esc_html($name),
                        esc_html__('Activate', 'digital-magazine')
                    );
                } elseif ($is_activeted) {
                    $button_html = sprintf('<div class="action-link button disabled"><span class="dashicons dashicons-yes"></span> %s</div>', esc_html__('Active', 'digital-magazine'));
                    $is_done     = true;
                }

                return array('done' => $is_done, 'button' => $button_html);
            }
        public function digital_magazine_is_plugin_installed($slug) {
            $installed_plugins = $this->digital_magazine_get_installed_plugins(); // Retrieve a list of all installed plugins (WP cached).
            $file_path         = $this->digital_magazine_get_plugin_basename_from_slug($slug);
            return (!empty($installed_plugins[$file_path]));
        }
        public function digital_magazine_get_plugin_basename_from_slug($slug) {
            $keys = array_keys($this->digital_magazine_get_installed_plugins());
            foreach ($keys as $key) {
                if (preg_match('|^' . $slug . '/|', $key)) {
                    return $key;
                }
            }
            return $slug;
        }
        
        public function digital_magazine_get_installed_plugins() {

            if (!function_exists('get_plugins')) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }

            return get_plugins();
        }
    
    }
}
/**
 * Kicking this off by calling 'get_instance()' method
 */
Digital_Magazine_Plugin_Activation_Settings::get_instance();