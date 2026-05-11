<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( !class_exists( 'digital_magazine_Welcome' ) ) {

	class digital_magazine_Welcome {
		public $theme_fields;

		public function __construct( $fields = array() ) {
			$this->theme_fields = $fields;
			add_action ('admin_init' , array( $this, 'admin_scripts' ) );
			add_action('admin_menu', array( $this, 'digital_magazine_getstart_page_menu' ));
		}

		public function admin_scripts() {
			global $pagenow;
			$file_dir = get_template_directory_uri() . '/getstarted/assets/';

			if ( $pagenow === 'themes.php' && isset($_GET['page']) && $_GET['page'] === 'digital-magazine-getstart-page' ) {

				wp_enqueue_style (
					'digital-magazine-getstart-page-style',
					$file_dir . 'css/getstart-page.css',
					array(), '1.0.0'
				);

				wp_enqueue_script (
					'digital-magazine-getstart-page-functions',
					$file_dir . 'js/getstart-page.js',
					array('jquery'),
					'1.0.0',
					true
				);
			}
		}

        public function theme_info($id, $digital_magazine_screenshot = false) {
            $digital_magazine_themedata = wp_get_theme();
            return ($digital_magazine_screenshot === true) ? esc_url($digital_magazine_themedata->get_screenshot()) : esc_html($digital_magazine_themedata->get($id));
        }

        public function digital_magazine_getstart_page_menu() {
            add_theme_page(
                /* translators: 1: Theme Name. */
                sprintf(esc_html__('About %1$s', 'digital-magazine'), $this->theme_info('Name')),
                sprintf(esc_html__('About %1$s', 'digital-magazine'), $this->theme_info('Name')),
                'edit_theme_options',
                'digital-magazine-getstart-page',
                array( $this, 'digital_magazine_getstart_page' )
            );
		}

        public function digital_magazine_getstart_page() {
            $digital_magazine_tabs = array(
                'digital_magazine_getting_started' => esc_html__('Getting Started', 'digital-magazine'),
                'digital_magazine_free_pro' => esc_html__('Free VS Pro', 'digital-magazine'),
                'changelog' => esc_html__('Changelog', 'digital-magazine'),
                'support' => esc_html__('Support', 'digital-magazine'),
                'review' => esc_html__('Rate & Review', 'digital-magazine'),
            );
            ?>
                <div class="wrap about-wrap access-wrap">

                    <div class="abt-promo-wrap clearfix">
                        <div class="abt-theme-wrap">
                            <h1>
                                <?php
                                printf(
                                    /* translators: 1: Theme Name. */
                                    esc_html__('Welcome to %1$s - Version %2$s', 'digital-magazine'),
                                    esc_html($this->theme_info('Name')),
                                    esc_html($this->theme_info('Version'))
                                );
                                ?>
                            </h1>
                            <div class="buttons">
                                <a target="_blank" href="<?php echo esc_url('https://www.revolutionwp.com/products/digital-magazine-wordpress-theme'); ?>"><?php echo esc_html__('Buy Pro Theme', 'digital-magazine'); ?></a>
                                <a target="_blank" href="<?php echo esc_url('https://demo.revolutionwp.com/digital-magazine-pro/'); ?>"><?php echo esc_html__('Preview Pro Version', 'digital-magazine'); ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="nav-tab-wrapper clearfix">
                        <?php
                            $tabHTML = '';

                            foreach ($digital_magazine_tabs as $id => $digital_magazine_label) :

                                $digital_magazine_target = '';
                                $digital_magazine_nav_class = 'nav-tab';
                                $digital_magazine_section = isset($_GET['section']) ? sanitize_text_field($_GET['section']) : 'digital_magazine_getting_started';

                                if ($id === $digital_magazine_section) {
                                    $digital_magazine_nav_class .= ' nav-tab-active';
                                }

                                if ($id === 'digital_magazine_free_pro') {
                                    $digital_magazine_nav_class .= ' upgrade-button';
                                }

                                switch ($id) {

                                    case 'support':
                                        $digital_magazine_target = 'target="_blank"';
                                        $url = esc_url('https://wordpress.org/support/theme/' . esc_html($this->theme_info('TextDomain')));
                                    break;

                                    case 'review':
                                        $digital_magazine_target = 'target="_blank"';
                                        $url = esc_url('https://wordpress.org/support/theme/' . esc_html($this->theme_info('TextDomain')) . '/reviews/#new-post');
                                    break;
                                    
                                    case 'digital_magazine_getting_started':
                                        $url = esc_url(admin_url('themes.php?page=digital-magazine-getstart-page'));
                                    break;

                                    default:
                                        $url = esc_url(admin_url('themes.php?page=digital-magazine-getstart-page&section=' . esc_attr($id)));
                                    break;

                                }

                                $tabHTML .= '<a ';
                                $tabHTML .= $digital_magazine_target;
                                $tabHTML .= ' href="' . $url . '"';
                                $tabHTML .= ' class="' . esc_attr($digital_magazine_nav_class) . '"';
                                $tabHTML .= '>';
                                $tabHTML .= esc_html($digital_magazine_label);
                                $tabHTML .= '</a>';

                            endforeach;

                            echo $tabHTML;
                        ?>
                    </div>

                    <div class="getstart-section-wrapper">
                        <div class="getstart-section digital_magazine_getting_started clearfix">
                            <?php
                                $digital_magazine_section = isset($_GET['section']) ? sanitize_text_field($_GET['section']) : 'digital_magazine_getting_started';
                                switch ($digital_magazine_section) {

                                    case 'digital_magazine_free_pro':
                                        $this->digital_magazine_free_pro();
                                    break;

                                    case 'changelog':
                                        $this->changelog();
                                    break;

                                    case 'digital_magazine_getting_started':
                                    default:
                                        $this->digital_magazine_getting_started();
                                    break;

                                }
                            ?>
                        </div>
                    </div>

                </div>
            <?php
		}

        public function digital_magazine_getting_started() {
            ?>
            <div class="getting-started-top-wrap clearfix">
                <div class="theme-details">
                    <div class="theme-screenshot">
                        <img src="<?php echo esc_url( $this->theme_info( 'Screenshot', true ) ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'digital-magazine' ); ?>"/>
                    </div>
                    <div class="about-text"><?php echo esc_html( $this->theme_info( 'Description' ) ); ?></div>
                    <div class="clearfix"></div>
                </div>
                <div class="theme-steps-list">
                    <div class="theme-steps demo-import">
                        <h3><?php echo esc_html__( 'One Click Demo Import', 'digital-magazine' ); ?></h3>
                        <p><?php echo esc_html__( 'Easily set up your website with our One Click Demo Import feature. This functionality allows you to replicate our demo site with just a single click, ensuring you have a fully functional layout to start from. Whether you’re a beginner or an experienced developer, this tool simplifies the setup process, saving you time and effort.', 'digital-magazine' ); ?></p>
                        <a target="_blank" class="button button-primary" href="<?php echo esc_url( admin_url( 'themes.php?page=digitalmagazine-demoimport' ) ); ?>"><?php echo esc_html__( 'Click Here For Demo Import', 'digital-magazine' ); ?></a>
                    </div>
                    <div class="getstart">
                        <div class="theme-steps">
                            <h3><?php echo esc_html__( 'Documentation', 'digital-magazine' ); ?></h3>
                            <p><?php echo esc_html__( 'Need more details? Check our comprehensive documentation for step-by-step guidance on using the Digital Magazine Theme.', 'digital-magazine' ); ?></p>
                            <a target="_blank" class="button button-primary" href="<?php echo esc_url( 'https://demo.revolutionwp.com/wpdocs/digital-magazine-free/' ); ?>"><?php echo esc_html__( 'Go to Free Docs', 'digital-magazine' ); ?></a>
                        </div>

                        <div class="theme-steps">
                            <h3><?php echo esc_html__( 'Preview Pro Theme', 'digital-magazine' ); ?></h3>
                            <p><?php echo esc_html__( 'Discover the full potential of our Pro Theme! Click the Live Demo button to experience premium features and beautiful designs.', 'digital-magazine' ); ?></p>
                            <a target="_blank" class="button button-primary" href="<?php echo esc_url( 'https://demo.revolutionwp.com/digital-magazine-pro/' ); ?>"><?php echo esc_html__( 'Live Demo', 'digital-magazine' ); ?></a>
                        </div>

                        <div class="theme-steps highlight">
                            <h3><?php echo esc_html__( 'Buy Digital Magazine Pro', 'digital-magazine' ); ?></h3>
                            <p><?php echo esc_html__( 'Unlock unlimited features and enhancements by purchasing the Pro version of Digital Magazine Theme.', 'digital-magazine' ); ?></p>
                            <a target="_blank" class="button button-primary" href="<?php echo esc_url( 'https://www.revolutionwp.com/products/digital-magazine-wordpress-theme' ); ?>"><?php echo esc_html__( 'Buy Pro Version @$39', 'digital-magazine' ); ?></a>
                        </div>

                        <div class="theme-steps highlight">
                            <h3><?php echo esc_html__( 'Get the Bundle', 'digital-magazine' ); ?></h3>
                            <p><?php echo esc_html__( 'The WordPress Theme Bundle is a comprehensive collection of 50+ premium themes, offering everything you need to create stunning, professional websites with ease.', 'digital-magazine' ); ?></p>
                            <a target="_blank" class="button button-primary" href="<?php echo esc_url( 'https://www.revolutionwp.com/products/wordpress-theme-bundle' ); ?>"><?php echo esc_html__( 'Get Bundle', 'digital-magazine' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

		public function digital_magazine_free_pro() {
            ?>
            <table class="card table free-pro" cellspacing="0" cellpadding="0">
                <tbody class="table-body">
                    <tr class="table-head">
                        <th class="large"><?php echo esc_html__( 'Features', 'digital-magazine' ); ?></th>
                        <th class="indicator"><?php echo esc_html__( 'Free theme', 'digital-magazine' ); ?></th>
                        <th class="indicator"><?php echo esc_html__( 'Pro Theme', 'digital-magazine' ); ?></th>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'One Click Demo Import', 'digital-magazine' ); ?></h4>
                                <div class="feature-inline-row">
                                    <span class="info-icon dashicon dashicons dashicons-info"></span>
                                    <span class="feature-description">
                                        <?php echo esc_html__( 'After the activation of Digital Magazine theme, all settings will be imported and Data Import.', 'digital-magazine' ); ?>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'Responsive Design', 'digital-magazine' ); ?></h4>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'Site Logo upload', 'digital-magazine' ); ?></h4>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'Footer Copyright text', 'digital-magazine' ); ?></h4>
                                <div class="feature-inline-row">
                                    <span class="info-icon dashicon dashicons dashicons-info"></span>
                                    <span class="feature-description">
                                        <?php echo esc_html__( 'Remove the copyright text from the Footer.', 'digital-magazine' ); ?>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'Global Color', 'digital-magazine' ); ?></h4>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'Regular Bug Fixes', 'digital-magazine' ); ?></h4>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'Theme Sections', 'digital-magazine' ); ?></h4>
                            </div>
                        </td>
                        <td class="indicator"><span class="abc"><?php echo esc_html__( '2 Sections', 'digital-magazine' ); ?></span></td>
                        <td class="indicator"><span class="abc"><?php echo esc_html__( '15+ Sections', 'digital-magazine' ); ?></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'Custom colors', 'digital-magazine' ); ?></h4>
                                <div class="feature-inline-row">
                                    <span class="info-icon dashicon dashicons dashicons-info"></span>
                                    <span class="feature-description">
                                        <?php echo esc_html__( 'Choose a color for links, buttons, icons and so on.', 'digital-magazine' ); ?>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'Google fonts', 'digital-magazine' ); ?></h4>
                                <div class="feature-inline-row">
                                    <span class="info-icon dashicon dashicons dashicons-info"></span>
                                    <span class="feature-description">
                                        <?php echo esc_html__( 'You can choose and use over 600 different fonts, for the logo, the menu and the titles.', 'digital-magazine' ); ?>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'Enhanced Plugin Integration', 'digital-magazine' ); ?></h4>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'Fully SEO Optimized', 'digital-magazine' ); ?></h4>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'Premium Support', 'digital-magazine' ); ?></h4>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'Extensive Customization', 'digital-magazine' ); ?></h4>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'Custom Post Types', 'digital-magazine' ); ?></h4>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="feature-row">
                        <td class="large">
                            <div class="feature-wrap">
                                <h4><?php echo esc_html__( 'High-Level Compatibility with Modern Browsers', 'digital-magazine' ); ?></h4>
                            </div>
                        </td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                        <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                    </tr>

                    <tr class="upsell-row">
                        <td></td>
                        <td><span class="abc"><?php echo esc_html__( 'Try Out Our Premium Version', 'digital-magazine' ); ?></span></td>
                        <td>
                            <a target="_blank" href="<?php echo esc_url( 'https://www.revolutionwp.com/products/digital-magazine-wordpress-theme' ); ?>" class="button button-primary"><?php echo esc_html__( 'Buy Pro Theme', 'digital-magazine' ); ?></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
        }

		public function changelog() {
            if ( is_file( trailingslashit( get_stylesheet_directory() ) . '/getstarted/digital_magazine_changelog.php' ) ) {
                require_once( trailingslashit( get_stylesheet_directory() ) . '/getstarted/digital_magazine_changelog.php' );
            } else {
                require_once( trailingslashit( get_template_directory() ) . '/getstarted/digital_magazine_changelog.php' );
            }
        }
	}

}
new digital_magazine_Welcome();
?>