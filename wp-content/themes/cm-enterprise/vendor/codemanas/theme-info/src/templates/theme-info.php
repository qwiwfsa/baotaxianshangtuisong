<?php
global $data;
$theme            = wp_get_theme();
$intro_img        = get_template_directory_uri() . '/vendor/codemanas/theme-info/img/intro_img.png';
$slider_icon      = get_template_directory_uri() . '/vendor/codemanas/theme-info/img/slider-icon.png';
$progressBar_icon = get_template_directory_uri() . '/vendor/codemanas/theme-info/img/progressBar-icon.png';
$countdown_icon   = get_template_directory_uri() . '/vendor/codemanas/theme-info/img/countdown-icon.png';
$accordion_icon   = get_template_directory_uri() . '/vendor/codemanas/theme-info/img/accordion-icon.png';
$masonry_icon     = get_template_directory_uri() . '/vendor/codemanas/theme-info/img/masonry-icon.png';
$counter_icon     = get_template_directory_uri() . '/vendor/codemanas/theme-info/img/counter-icon.png';
$design_library   = get_template_directory_uri() . '/vendor/codemanas/theme-info/img/design-library.png';

$default_translations = [
	'live_demo'                            => 'Live Demo',
	'documentation'                        => 'Documentation',
	'documentation_link'                   => 'https://docs.cmblocks.com/',
	'cm_blocks_section_subtitle'           => 'CM Blocks - WordPress Blocks Unleashed',
	'cm_blocks_section_title'              => 'Easily start building your websites with CM Blocks',
	'cm_blocks_section_desc'               => 'CM Blocks is a custom WordPress blocks plugin designed to streamline the process of building websites using the WordPress platform. WordPress blocks, introduced with the Gutenberg editor, are content elements that allow users to add various types of content to their posts or pages in a visually appealing and structured manner.',
	'get_cm_block_suite'                   => 'Get CM Blocks Suite',
	'cm_blocks_collection_image'           => 'CM BLocks Collection images',
	'tab1_title'                           => 'Get Started',
	'tab2_title'                           => 'Change Log',
	'tab3_title'                           => 'CM Blocks',
	'quick_setting'                        => 'Quick Settings',
	'header'                               => 'Header',
	'sticky_header_info'                   => 'To enable sticky header please install',
	'cm_blocks'                            => 'CM Blocks',
	'configure_sticky_header'              => 'Configure the sticky header feature on or off as needed',
	'learn_more'                           => 'Learn More',
	'footer'                               => 'Footer',
	'style_variation'                      => 'Styles Variation',
	'navigation'                           => 'Navigation',
	'all_templates'                        => 'All Templates',
	'page_templates'                       => 'Page Templates',
	'our_plugins'                          => 'Our Plugins',
	'free'                                 => 'Free',
	'vcwz_title'                           => 'Video Conferencing with Zoom',
	'vcwz_desc'                            => 'Video Conferencing with zoom free version',
	'swt_title'                            => 'Search With Typesense',
	'swt_desc'                             => 'Instant Search With Typesense free version',
	'spb_title'                            => 'Simple Popup Block',
	'spb_desc'                             => 'A simple and easy to use popup block plugin for block editor',
	'activated'                            => 'Activated',
	'install_and_activate'                 => 'Install and Activate',
	'help_and_support'                     => 'Help and Support',
	'help_and_support_desc'                => 'No Problem!! Please create a support ticket. Our dedicated support team will help you to solve your problem',
	'support'                              => 'Support',
	'documentation_desc'                   => 'From Edit screen of page/post, you can easily import Beautiful Patterns.',
	'review'                               => 'Review',
	'leave_a_review'                       => 'Leave a Review',
	'leave_a_review_desc'                  => 'From Edit screen of page/post, you can easily import Beautiful Patterns.',
	'craft_your_distinctive_web'           => '" Craft Your Distinctive Web Presence with Our Design Library "',
	'explore_your_extensive_collection'    => 'Explore our extensive collection of expertly crafted patterns and page designs. Choose from a variety of options to create your site exactly as you envision it.',
	'with_just_a_few_clicks'               => 'With just a few clicks, easily create beautiful sections anywhere on your site.',
	'our_blocks'                           => 'Our Blocks',
	'slider_icon'                          => 'Slider Icon',
	'slider'                               => 'Slider',
	'create_smooth_and_interactive'        => 'Create Smooth and interactive user interface.',
	'docs'                                 => 'Docs',
	'accordion_icon'                       => 'Accordion Icon',
	'accordion'                            => 'Accordion',
	'easy_accordion_which_enhance'         => 'Easy Accordion which enhance user experience and make site organized.',
	'masonry_gallery_icon'                 => 'Masonry Gallery Icon',
	'masonry_gallery'                      => 'Masonry Gallery',
	'simple_grid_based_gallery'            => 'Simple grid based gallery inside WordPress content editor.',
	'progress_bar_icon'                    => 'Progress Bar Icon',
	'progress_bar'                         => 'Progress Bar',
	'beautiful_slider_bar_without_writing' => 'Beautiful slider bar without writing long lines of code on WordPress.',
	'countdown_icon'                       => 'Countdown Icon',
	'countdown'                            => 'Countdown',
	'countdown_desc'                       => 'Customizable WordPress blocks that allows user to add timer inside.',
	'counter_icon'                         => 'Counter Icon',
	'counter'                              => 'Counter',
	'counter_desc'                         => 'Create beautiful Counters without writing a bunch of code.',
	'cm_blocks_suite'                      => 'Elevate your design with CM Blocks Suite.',
	'cm_blocks_suite_desc'                 => 'Unlock Premium Designs and access a collection of unique, high-quality templates that will make your site stand out. With dedicated priority support, you will have everything you need to create exceptional websites effortlessly. Elevate your design capabilities today with our Premium Designs!',
	'get_started_now'                      => 'Get Started Now',

];
if ( isset( $translations ) ) {
	$translations = array_merge( $default_translations, $translations );
} else {
	$translations = $default_translations;
}

function dashed_theme_name( $theme ) {
	if ( $theme && $theme->get( 'Name' ) != null ) {
		$modified_theme_name = str_replace( ' ', '-', strtolower( $theme->get( 'Name' ) ) );

		return $modified_theme_name;
	}

	return '';
}

$dashed_theme_name = dashed_theme_name( $theme );

use Codemanas\ThemeInfo\ThemeSetting;

?>

<div class="cm-admin cm-admin-info__wrapper">
    <div class="cm-admin-top__section">
        <div class="cm-admin-topbar">
            <h2>
				<?php echo esc_html( $theme['Name'] ); ?>
            </h2>
        </div>
        <div class="cm-admin-top-right__section">
            <a href="<?php
			echo esc_url( 'http://demo.cmblocks.com/' . $dashed_theme_name . '/' )
			?>" class="cm-theme-admin-btn-primary" target="_blank"><?php echo $translations['live_demo'] ?></a>
            <a href="<?php echo $translations['documentation_link'] ?>" class="cm-theme-admin-btn-outline" target="_blank"><?php echo $translations['documentation'] ?></a>
        </div>
    </div>
    <!--    intro section starts-->
    <div class="cm-admin-intro">
        <div class="cm-admin-intro__info">
            <h3><?php echo $translations['cm_blocks_section_subtitle'] ?></h3>
            <h2><?php echo $translations['cm_blocks_section_title'] ?></h2>
            <p class="desc"><?php echo $translations['cm_blocks_section_desc'] ?></p>
            <a href="<?php echo esc_url( 'https://cmblocks.com/' ) ?>" class="body-btn-primary" target="_blank">
				<?php echo $translations['get_cm_block_suite'] ?>
            </a>
        </div>
        <div class="cm-admin-intro__img">
            <img src="<?php echo esc_url( $intro_img ); ?>" alt="<?php echo $translations['cm_blocks_collection_image'] ?>">
        </div>
    </div>
    <!--    intro section ends-->
    <div class="cm-admin-main">
        <div class="main__wrapper">
            <div class="cm-admin_tabs-wrapper">
                <div class="cm-admin_tabs">
                    <div class="tab active" id="tab1"><?php echo $translations['tab1_title']; ?></div>
                    <div class="tab" id="tab2"><?php echo $translations['tab2_title'] ?></div>
                    <div class="tab" id="tab3"><?php echo $translations['tab3_title'] ?></div>
                </div>

                <div class="tab-panel-container">
                    <div class="tab-panel active" data-tab="tab1">
                        <div class="tab-section__wrapper">
                            <div class="tab-section">
                                <h3 class="section-header"><?php echo $translations['quick_setting'] ?></h3>
                                <div class="quick-setting__wrapper">
                                    <div class="quick-setting__card">
                                        <div class="quick-setting__card-title">
                                            <h4><?php echo $translations['header'] ?></h4>
                                            <a href="<?php echo esc_url( admin_url( '/site-editor.php?postId=' . $dashed_theme_name . '%2F%2Fheader&postType=wp_template_part&canvas=edit' ) ); ?>">
                                                <svg width="48" height="43"
                                                     viewBox="0 0 48 43"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          clip-rule="evenodd"
                                                          d="M40 2.40333C44.5 -2.09668 49.5 5.40329 44.5 8.4033L40 2.40333ZM21 18.5L38.75 3.5L41 6.5L43.25 9.5L25.5 25.5L18.494 26.6677C17.6773 26.8038 17.0585 25.9451 17.4459 25.2134L21 18.5ZM1 10C1 7.79086 2.79086 6 5 6H25C26.1046 6 27 6.89543 27 8C27 9.10457 26.1046 10 25 10H5V38.5H35V23.5C35 22.3954 35.8954 21.5 37 21.5C38.1046 21.5 39 22.3954 39 23.5V38.5C39 40.7091 37.2091 42.5 35 42.5H5C2.79086 42.5 1 40.7091 1 38.5V10Z"/>
                                                    <path d="M40 2.40333L39.6464 2.04978L39.3398 2.35642L39.6 2.70333L40 2.40333ZM44.5 8.4033L44.1 8.70331L44.3706 9.06406L44.7572 8.83205L44.5 8.4033ZM38.75 3.5L39.15 3.2L38.832 2.77605L38.4273 3.1181L38.75 3.5ZM21 18.5L20.6773 18.1181L20.6034 18.1805L20.5581 18.2661L21 18.5ZM41 6.5L40.6 6.8L40.6 6.8L41 6.5ZM43.25 9.5L43.5848 9.87139L43.9241 9.56549L43.65 9.2L43.25 9.5ZM25.5 25.5L25.5822 25.9932L25.7263 25.9692L25.8348 25.8714L25.5 25.5ZM18.494 26.6677L18.5762 27.1609L18.5762 27.1609L18.494 26.6677ZM17.4459 25.2134L17.004 24.9794L17.004 24.9794L17.4459 25.2134ZM5 10V9.5H4.5V10H5ZM5 38.5H4.5V39H5V38.5ZM35 38.5V39H35.5V38.5H35ZM40.3536 2.75689C41.3923 1.71809 42.4038 1.42063 43.2478 1.51726C44.1054 1.61545 44.8769 2.13013 45.4036 2.87856C45.9303 3.62708 46.1872 4.57617 46.045 5.49051C45.905 6.39075 45.3725 7.29673 44.2428 7.97456L44.7572 8.83205C46.1275 8.00987 46.845 6.85335 47.0331 5.64422C47.219 4.44919 46.8822 3.24203 46.2214 2.30306C45.5606 1.364 44.5509 0.659929 43.3616 0.523755C42.1587 0.386024 40.8577 0.83857 39.6464 2.04978L40.3536 2.75689ZM44.9 8.1033L40.4 2.10333L39.6 2.70333L44.1 8.70331L44.9 8.1033ZM38.4273 3.1181L20.6773 18.1181L21.3227 18.8819L39.0727 3.8819L38.4273 3.1181ZM41.4 6.2L39.15 3.2L38.35 3.8L40.6 6.8L41.4 6.2ZM43.65 9.2L41.4 6.2L40.6 6.8L42.85 9.8L43.65 9.2ZM25.8348 25.8714L43.5848 9.87139L42.9152 9.12861L25.1652 25.1286L25.8348 25.8714ZM18.5762 27.1609L25.5822 25.9932L25.4178 25.0068L18.4118 26.1745L18.5762 27.1609ZM17.004 24.9794C16.4229 26.0771 17.3512 27.365 18.5762 27.1609L18.4118 26.1745C18.0035 26.2425 17.694 25.8132 17.8878 25.4473L17.004 24.9794ZM20.5581 18.2661L17.004 24.9794L17.8878 25.4473L21.4419 18.7339L20.5581 18.2661ZM5 5.5C2.51472 5.5 0.5 7.51472 0.5 10H1.5C1.5 8.067 3.067 6.5 5 6.5V5.5ZM25 5.5H5V6.5H25V5.5ZM27.5 8C27.5 6.61929 26.3807 5.5 25 5.5V6.5C25.8284 6.5 26.5 7.17157 26.5 8H27.5ZM25 10.5C26.3807 10.5 27.5 9.38071 27.5 8H26.5C26.5 8.82843 25.8284 9.5 25 9.5V10.5ZM5 10.5H25V9.5H5V10.5ZM5.5 38.5V10H4.5V38.5H5.5ZM35 38H5V39H35V38ZM34.5 23.5V38.5H35.5V23.5H34.5ZM37 21C35.6193 21 34.5 22.1193 34.5 23.5H35.5C35.5 22.6716 36.1716 22 37 22V21ZM39.5 23.5C39.5 22.1193 38.3807 21 37 21V22C37.8284 22 38.5 22.6716 38.5 23.5H39.5ZM39.5 38.5V23.5H38.5V38.5H39.5ZM35 43C37.4853 43 39.5 40.9853 39.5 38.5H38.5C38.5 40.433 36.933 42 35 42V43ZM5 43H35V42H5V43ZM0.5 38.5C0.5 40.9853 2.51472 43 5 43V42C3.067 42 1.5 40.433 1.5 38.5H0.5ZM0.5 10V38.5H1.5V10H0.5Z"/>
                                                </svg>
                                            </a>
                                        </div>
										<?php
										$all_plugins = get_plugins();

										echo '<p class="cm-admin-small-warning">';
										if ( ! array_key_exists( 'cm-blocks/cm-blocks.php', $all_plugins ) ) {

											echo $translations['sticky_header_info'];
											echo '<a href="https://wordpress.org/plugins/cm-blocks/" target="_blank">';
											echo $translations['cm_blocks'];
											echo '</a>';
										} else {
											echo $translations['configure_sticky_header'];
										}
										echo '<br><a class="cm-theme-admin-btn-secondary" href="https://cmblocks.com/introducing-sticky-header" target="_blank">';
										echo $translations['learn_more'];
										echo '</a></p>';


										?>
                                    </div>
                                    <div class="quick-setting__card">
                                        <div class="quick-setting__card-title">
                                            <h4><?php echo $translations['footer']; ?></h4>
                                            <a href="<?php echo esc_url( admin_url( '/site-editor.php?postType=wp_template_part&postId=' . $dashed_theme_name . '%2F%2Ffooter&canvas=edit' ) ); ?>">
                                                <svg width="48" height="43"
                                                     viewBox="0 0 48 43"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          clip-rule="evenodd"
                                                          d="M40 2.40333C44.5 -2.09668 49.5 5.40329 44.5 8.4033L40 2.40333ZM21 18.5L38.75 3.5L41 6.5L43.25 9.5L25.5 25.5L18.494 26.6677C17.6773 26.8038 17.0585 25.9451 17.4459 25.2134L21 18.5ZM1 10C1 7.79086 2.79086 6 5 6H25C26.1046 6 27 6.89543 27 8C27 9.10457 26.1046 10 25 10H5V38.5H35V23.5C35 22.3954 35.8954 21.5 37 21.5C38.1046 21.5 39 22.3954 39 23.5V38.5C39 40.7091 37.2091 42.5 35 42.5H5C2.79086 42.5 1 40.7091 1 38.5V10Z"/>
                                                    <path d="M40 2.40333L39.6464 2.04978L39.3398 2.35642L39.6 2.70333L40 2.40333ZM44.5 8.4033L44.1 8.70331L44.3706 9.06406L44.7572 8.83205L44.5 8.4033ZM38.75 3.5L39.15 3.2L38.832 2.77605L38.4273 3.1181L38.75 3.5ZM21 18.5L20.6773 18.1181L20.6034 18.1805L20.5581 18.2661L21 18.5ZM41 6.5L40.6 6.8L40.6 6.8L41 6.5ZM43.25 9.5L43.5848 9.87139L43.9241 9.56549L43.65 9.2L43.25 9.5ZM25.5 25.5L25.5822 25.9932L25.7263 25.9692L25.8348 25.8714L25.5 25.5ZM18.494 26.6677L18.5762 27.1609L18.5762 27.1609L18.494 26.6677ZM17.4459 25.2134L17.004 24.9794L17.004 24.9794L17.4459 25.2134ZM5 10V9.5H4.5V10H5ZM5 38.5H4.5V39H5V38.5ZM35 38.5V39H35.5V38.5H35ZM40.3536 2.75689C41.3923 1.71809 42.4038 1.42063 43.2478 1.51726C44.1054 1.61545 44.8769 2.13013 45.4036 2.87856C45.9303 3.62708 46.1872 4.57617 46.045 5.49051C45.905 6.39075 45.3725 7.29673 44.2428 7.97456L44.7572 8.83205C46.1275 8.00987 46.845 6.85335 47.0331 5.64422C47.219 4.44919 46.8822 3.24203 46.2214 2.30306C45.5606 1.364 44.5509 0.659929 43.3616 0.523755C42.1587 0.386024 40.8577 0.83857 39.6464 2.04978L40.3536 2.75689ZM44.9 8.1033L40.4 2.10333L39.6 2.70333L44.1 8.70331L44.9 8.1033ZM38.4273 3.1181L20.6773 18.1181L21.3227 18.8819L39.0727 3.8819L38.4273 3.1181ZM41.4 6.2L39.15 3.2L38.35 3.8L40.6 6.8L41.4 6.2ZM43.65 9.2L41.4 6.2L40.6 6.8L42.85 9.8L43.65 9.2ZM25.8348 25.8714L43.5848 9.87139L42.9152 9.12861L25.1652 25.1286L25.8348 25.8714ZM18.5762 27.1609L25.5822 25.9932L25.4178 25.0068L18.4118 26.1745L18.5762 27.1609ZM17.004 24.9794C16.4229 26.0771 17.3512 27.365 18.5762 27.1609L18.4118 26.1745C18.0035 26.2425 17.694 25.8132 17.8878 25.4473L17.004 24.9794ZM20.5581 18.2661L17.004 24.9794L17.8878 25.4473L21.4419 18.7339L20.5581 18.2661ZM5 5.5C2.51472 5.5 0.5 7.51472 0.5 10H1.5C1.5 8.067 3.067 6.5 5 6.5V5.5ZM25 5.5H5V6.5H25V5.5ZM27.5 8C27.5 6.61929 26.3807 5.5 25 5.5V6.5C25.8284 6.5 26.5 7.17157 26.5 8H27.5ZM25 10.5C26.3807 10.5 27.5 9.38071 27.5 8H26.5C26.5 8.82843 25.8284 9.5 25 9.5V10.5ZM5 10.5H25V9.5H5V10.5ZM5.5 38.5V10H4.5V38.5H5.5ZM35 38H5V39H35V38ZM34.5 23.5V38.5H35.5V23.5H34.5ZM37 21C35.6193 21 34.5 22.1193 34.5 23.5H35.5C35.5 22.6716 36.1716 22 37 22V21ZM39.5 23.5C39.5 22.1193 38.3807 21 37 21V22C37.8284 22 38.5 22.6716 38.5 23.5H39.5ZM39.5 38.5V23.5H38.5V38.5H39.5ZM35 43C37.4853 43 39.5 40.9853 39.5 38.5H38.5C38.5 40.433 36.933 42 35 42V43ZM5 43H35V42H5V43ZM0.5 38.5C0.5 40.9853 2.51472 43 5 43V42C3.067 42 1.5 40.433 1.5 38.5H0.5ZM0.5 10V38.5H1.5V10H0.5Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="quick-setting__card">
                                        <div class="quick-setting__card-title">
                                            <h4><?php echo $translations['style_variation']; ?></h4>
                                            <a href="<?php echo esc_url( admin_url( '/site-editor.php?path=%2Fwp_global_styles' ) ); ?>">
                                                <svg width="48" height="43"
                                                     viewBox="0 0 48 43"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          clip-rule="evenodd"
                                                          d="M40 2.40333C44.5 -2.09668 49.5 5.40329 44.5 8.4033L40 2.40333ZM21 18.5L38.75 3.5L41 6.5L43.25 9.5L25.5 25.5L18.494 26.6677C17.6773 26.8038 17.0585 25.9451 17.4459 25.2134L21 18.5ZM1 10C1 7.79086 2.79086 6 5 6H25C26.1046 6 27 6.89543 27 8C27 9.10457 26.1046 10 25 10H5V38.5H35V23.5C35 22.3954 35.8954 21.5 37 21.5C38.1046 21.5 39 22.3954 39 23.5V38.5C39 40.7091 37.2091 42.5 35 42.5H5C2.79086 42.5 1 40.7091 1 38.5V10Z"/>
                                                    <path d="M40 2.40333L39.6464 2.04978L39.3398 2.35642L39.6 2.70333L40 2.40333ZM44.5 8.4033L44.1 8.70331L44.3706 9.06406L44.7572 8.83205L44.5 8.4033ZM38.75 3.5L39.15 3.2L38.832 2.77605L38.4273 3.1181L38.75 3.5ZM21 18.5L20.6773 18.1181L20.6034 18.1805L20.5581 18.2661L21 18.5ZM41 6.5L40.6 6.8L40.6 6.8L41 6.5ZM43.25 9.5L43.5848 9.87139L43.9241 9.56549L43.65 9.2L43.25 9.5ZM25.5 25.5L25.5822 25.9932L25.7263 25.9692L25.8348 25.8714L25.5 25.5ZM18.494 26.6677L18.5762 27.1609L18.5762 27.1609L18.494 26.6677ZM17.4459 25.2134L17.004 24.9794L17.004 24.9794L17.4459 25.2134ZM5 10V9.5H4.5V10H5ZM5 38.5H4.5V39H5V38.5ZM35 38.5V39H35.5V38.5H35ZM40.3536 2.75689C41.3923 1.71809 42.4038 1.42063 43.2478 1.51726C44.1054 1.61545 44.8769 2.13013 45.4036 2.87856C45.9303 3.62708 46.1872 4.57617 46.045 5.49051C45.905 6.39075 45.3725 7.29673 44.2428 7.97456L44.7572 8.83205C46.1275 8.00987 46.845 6.85335 47.0331 5.64422C47.219 4.44919 46.8822 3.24203 46.2214 2.30306C45.5606 1.364 44.5509 0.659929 43.3616 0.523755C42.1587 0.386024 40.8577 0.83857 39.6464 2.04978L40.3536 2.75689ZM44.9 8.1033L40.4 2.10333L39.6 2.70333L44.1 8.70331L44.9 8.1033ZM38.4273 3.1181L20.6773 18.1181L21.3227 18.8819L39.0727 3.8819L38.4273 3.1181ZM41.4 6.2L39.15 3.2L38.35 3.8L40.6 6.8L41.4 6.2ZM43.65 9.2L41.4 6.2L40.6 6.8L42.85 9.8L43.65 9.2ZM25.8348 25.8714L43.5848 9.87139L42.9152 9.12861L25.1652 25.1286L25.8348 25.8714ZM18.5762 27.1609L25.5822 25.9932L25.4178 25.0068L18.4118 26.1745L18.5762 27.1609ZM17.004 24.9794C16.4229 26.0771 17.3512 27.365 18.5762 27.1609L18.4118 26.1745C18.0035 26.2425 17.694 25.8132 17.8878 25.4473L17.004 24.9794ZM20.5581 18.2661L17.004 24.9794L17.8878 25.4473L21.4419 18.7339L20.5581 18.2661ZM5 5.5C2.51472 5.5 0.5 7.51472 0.5 10H1.5C1.5 8.067 3.067 6.5 5 6.5V5.5ZM25 5.5H5V6.5H25V5.5ZM27.5 8C27.5 6.61929 26.3807 5.5 25 5.5V6.5C25.8284 6.5 26.5 7.17157 26.5 8H27.5ZM25 10.5C26.3807 10.5 27.5 9.38071 27.5 8H26.5C26.5 8.82843 25.8284 9.5 25 9.5V10.5ZM5 10.5H25V9.5H5V10.5ZM5.5 38.5V10H4.5V38.5H5.5ZM35 38H5V39H35V38ZM34.5 23.5V38.5H35.5V23.5H34.5ZM37 21C35.6193 21 34.5 22.1193 34.5 23.5H35.5C35.5 22.6716 36.1716 22 37 22V21ZM39.5 23.5C39.5 22.1193 38.3807 21 37 21V22C37.8284 22 38.5 22.6716 38.5 23.5H39.5ZM39.5 38.5V23.5H38.5V38.5H39.5ZM35 43C37.4853 43 39.5 40.9853 39.5 38.5H38.5C38.5 40.433 36.933 42 35 42V43ZM5 43H35V42H5V43ZM0.5 38.5C0.5 40.9853 2.51472 43 5 43V42C3.067 42 1.5 40.433 1.5 38.5H0.5ZM0.5 10V38.5H1.5V10H0.5Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="quick-setting__card">
                                        <div class="quick-setting__card-title">
                                            <h4><?php echo $translations['navigation']; ?></h4>
                                            <a href="<?php echo esc_url( admin_url( '/site-editor.php?path=%2Fnavigation' ) ); ?>">
                                                <svg width="48" height="43"
                                                     viewBox="0 0 48 43"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          clip-rule="evenodd"
                                                          d="M40 2.40333C44.5 -2.09668 49.5 5.40329 44.5 8.4033L40 2.40333ZM21 18.5L38.75 3.5L41 6.5L43.25 9.5L25.5 25.5L18.494 26.6677C17.6773 26.8038 17.0585 25.9451 17.4459 25.2134L21 18.5ZM1 10C1 7.79086 2.79086 6 5 6H25C26.1046 6 27 6.89543 27 8C27 9.10457 26.1046 10 25 10H5V38.5H35V23.5C35 22.3954 35.8954 21.5 37 21.5C38.1046 21.5 39 22.3954 39 23.5V38.5C39 40.7091 37.2091 42.5 35 42.5H5C2.79086 42.5 1 40.7091 1 38.5V10Z"/>
                                                    <path d="M40 2.40333L39.6464 2.04978L39.3398 2.35642L39.6 2.70333L40 2.40333ZM44.5 8.4033L44.1 8.70331L44.3706 9.06406L44.7572 8.83205L44.5 8.4033ZM38.75 3.5L39.15 3.2L38.832 2.77605L38.4273 3.1181L38.75 3.5ZM21 18.5L20.6773 18.1181L20.6034 18.1805L20.5581 18.2661L21 18.5ZM41 6.5L40.6 6.8L40.6 6.8L41 6.5ZM43.25 9.5L43.5848 9.87139L43.9241 9.56549L43.65 9.2L43.25 9.5ZM25.5 25.5L25.5822 25.9932L25.7263 25.9692L25.8348 25.8714L25.5 25.5ZM18.494 26.6677L18.5762 27.1609L18.5762 27.1609L18.494 26.6677ZM17.4459 25.2134L17.004 24.9794L17.004 24.9794L17.4459 25.2134ZM5 10V9.5H4.5V10H5ZM5 38.5H4.5V39H5V38.5ZM35 38.5V39H35.5V38.5H35ZM40.3536 2.75689C41.3923 1.71809 42.4038 1.42063 43.2478 1.51726C44.1054 1.61545 44.8769 2.13013 45.4036 2.87856C45.9303 3.62708 46.1872 4.57617 46.045 5.49051C45.905 6.39075 45.3725 7.29673 44.2428 7.97456L44.7572 8.83205C46.1275 8.00987 46.845 6.85335 47.0331 5.64422C47.219 4.44919 46.8822 3.24203 46.2214 2.30306C45.5606 1.364 44.5509 0.659929 43.3616 0.523755C42.1587 0.386024 40.8577 0.83857 39.6464 2.04978L40.3536 2.75689ZM44.9 8.1033L40.4 2.10333L39.6 2.70333L44.1 8.70331L44.9 8.1033ZM38.4273 3.1181L20.6773 18.1181L21.3227 18.8819L39.0727 3.8819L38.4273 3.1181ZM41.4 6.2L39.15 3.2L38.35 3.8L40.6 6.8L41.4 6.2ZM43.65 9.2L41.4 6.2L40.6 6.8L42.85 9.8L43.65 9.2ZM25.8348 25.8714L43.5848 9.87139L42.9152 9.12861L25.1652 25.1286L25.8348 25.8714ZM18.5762 27.1609L25.5822 25.9932L25.4178 25.0068L18.4118 26.1745L18.5762 27.1609ZM17.004 24.9794C16.4229 26.0771 17.3512 27.365 18.5762 27.1609L18.4118 26.1745C18.0035 26.2425 17.694 25.8132 17.8878 25.4473L17.004 24.9794ZM20.5581 18.2661L17.004 24.9794L17.8878 25.4473L21.4419 18.7339L20.5581 18.2661ZM5 5.5C2.51472 5.5 0.5 7.51472 0.5 10H1.5C1.5 8.067 3.067 6.5 5 6.5V5.5ZM25 5.5H5V6.5H25V5.5ZM27.5 8C27.5 6.61929 26.3807 5.5 25 5.5V6.5C25.8284 6.5 26.5 7.17157 26.5 8H27.5ZM25 10.5C26.3807 10.5 27.5 9.38071 27.5 8H26.5C26.5 8.82843 25.8284 9.5 25 9.5V10.5ZM5 10.5H25V9.5H5V10.5ZM5.5 38.5V10H4.5V38.5H5.5ZM35 38H5V39H35V38ZM34.5 23.5V38.5H35.5V23.5H34.5ZM37 21C35.6193 21 34.5 22.1193 34.5 23.5H35.5C35.5 22.6716 36.1716 22 37 22V21ZM39.5 23.5C39.5 22.1193 38.3807 21 37 21V22C37.8284 22 38.5 22.6716 38.5 23.5H39.5ZM39.5 38.5V23.5H38.5V38.5H39.5ZM35 43C37.4853 43 39.5 40.9853 39.5 38.5H38.5C38.5 40.433 36.933 42 35 42V43ZM5 43H35V42H5V43ZM0.5 38.5C0.5 40.9853 2.51472 43 5 43V42C3.067 42 1.5 40.433 1.5 38.5H0.5ZM0.5 10V38.5H1.5V10H0.5Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="quick-setting__card">
                                        <div class="quick-setting__card-title">
                                            <h4><?php echo $translations['all_templates']; ?></h4>
                                            <a href="<?php echo esc_url( admin_url( 'site-editor.php?path=%2Fwp_template%2Fall' ) ); ?>">
                                                <svg width="48" height="43"
                                                     viewBox="0 0 48 43"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          clip-rule="evenodd"
                                                          d="M40 2.40333C44.5 -2.09668 49.5 5.40329 44.5 8.4033L40 2.40333ZM21 18.5L38.75 3.5L41 6.5L43.25 9.5L25.5 25.5L18.494 26.6677C17.6773 26.8038 17.0585 25.9451 17.4459 25.2134L21 18.5ZM1 10C1 7.79086 2.79086 6 5 6H25C26.1046 6 27 6.89543 27 8C27 9.10457 26.1046 10 25 10H5V38.5H35V23.5C35 22.3954 35.8954 21.5 37 21.5C38.1046 21.5 39 22.3954 39 23.5V38.5C39 40.7091 37.2091 42.5 35 42.5H5C2.79086 42.5 1 40.7091 1 38.5V10Z"/>
                                                    <path d="M40 2.40333L39.6464 2.04978L39.3398 2.35642L39.6 2.70333L40 2.40333ZM44.5 8.4033L44.1 8.70331L44.3706 9.06406L44.7572 8.83205L44.5 8.4033ZM38.75 3.5L39.15 3.2L38.832 2.77605L38.4273 3.1181L38.75 3.5ZM21 18.5L20.6773 18.1181L20.6034 18.1805L20.5581 18.2661L21 18.5ZM41 6.5L40.6 6.8L40.6 6.8L41 6.5ZM43.25 9.5L43.5848 9.87139L43.9241 9.56549L43.65 9.2L43.25 9.5ZM25.5 25.5L25.5822 25.9932L25.7263 25.9692L25.8348 25.8714L25.5 25.5ZM18.494 26.6677L18.5762 27.1609L18.5762 27.1609L18.494 26.6677ZM17.4459 25.2134L17.004 24.9794L17.004 24.9794L17.4459 25.2134ZM5 10V9.5H4.5V10H5ZM5 38.5H4.5V39H5V38.5ZM35 38.5V39H35.5V38.5H35ZM40.3536 2.75689C41.3923 1.71809 42.4038 1.42063 43.2478 1.51726C44.1054 1.61545 44.8769 2.13013 45.4036 2.87856C45.9303 3.62708 46.1872 4.57617 46.045 5.49051C45.905 6.39075 45.3725 7.29673 44.2428 7.97456L44.7572 8.83205C46.1275 8.00987 46.845 6.85335 47.0331 5.64422C47.219 4.44919 46.8822 3.24203 46.2214 2.30306C45.5606 1.364 44.5509 0.659929 43.3616 0.523755C42.1587 0.386024 40.8577 0.83857 39.6464 2.04978L40.3536 2.75689ZM44.9 8.1033L40.4 2.10333L39.6 2.70333L44.1 8.70331L44.9 8.1033ZM38.4273 3.1181L20.6773 18.1181L21.3227 18.8819L39.0727 3.8819L38.4273 3.1181ZM41.4 6.2L39.15 3.2L38.35 3.8L40.6 6.8L41.4 6.2ZM43.65 9.2L41.4 6.2L40.6 6.8L42.85 9.8L43.65 9.2ZM25.8348 25.8714L43.5848 9.87139L42.9152 9.12861L25.1652 25.1286L25.8348 25.8714ZM18.5762 27.1609L25.5822 25.9932L25.4178 25.0068L18.4118 26.1745L18.5762 27.1609ZM17.004 24.9794C16.4229 26.0771 17.3512 27.365 18.5762 27.1609L18.4118 26.1745C18.0035 26.2425 17.694 25.8132 17.8878 25.4473L17.004 24.9794ZM20.5581 18.2661L17.004 24.9794L17.8878 25.4473L21.4419 18.7339L20.5581 18.2661ZM5 5.5C2.51472 5.5 0.5 7.51472 0.5 10H1.5C1.5 8.067 3.067 6.5 5 6.5V5.5ZM25 5.5H5V6.5H25V5.5ZM27.5 8C27.5 6.61929 26.3807 5.5 25 5.5V6.5C25.8284 6.5 26.5 7.17157 26.5 8H27.5ZM25 10.5C26.3807 10.5 27.5 9.38071 27.5 8H26.5C26.5 8.82843 25.8284 9.5 25 9.5V10.5ZM5 10.5H25V9.5H5V10.5ZM5.5 38.5V10H4.5V38.5H5.5ZM35 38H5V39H35V38ZM34.5 23.5V38.5H35.5V23.5H34.5ZM37 21C35.6193 21 34.5 22.1193 34.5 23.5H35.5C35.5 22.6716 36.1716 22 37 22V21ZM39.5 23.5C39.5 22.1193 38.3807 21 37 21V22C37.8284 22 38.5 22.6716 38.5 23.5H39.5ZM39.5 38.5V23.5H38.5V38.5H39.5ZM35 43C37.4853 43 39.5 40.9853 39.5 38.5H38.5C38.5 40.433 36.933 42 35 42V43ZM5 43H35V42H5V43ZM0.5 38.5C0.5 40.9853 2.51472 43 5 43V42C3.067 42 1.5 40.433 1.5 38.5H0.5ZM0.5 10V38.5H1.5V10H0.5Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="quick-setting__card">
                                        <div class="quick-setting__card-title">
                                            <h4><?php echo $translations['page_templates']; ?></h4>
                                            <a href="<?php echo esc_url( admin_url( 'site-editor.php?path=%2Fwp_template' ) ); ?>">
                                                <svg width="48" height="43"
                                                     viewBox="0 0 48 43"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          clip-rule="evenodd"
                                                          d="M40 2.40333C44.5 -2.09668 49.5 5.40329 44.5 8.4033L40 2.40333ZM21 18.5L38.75 3.5L41 6.5L43.25 9.5L25.5 25.5L18.494 26.6677C17.6773 26.8038 17.0585 25.9451 17.4459 25.2134L21 18.5ZM1 10C1 7.79086 2.79086 6 5 6H25C26.1046 6 27 6.89543 27 8C27 9.10457 26.1046 10 25 10H5V38.5H35V23.5C35 22.3954 35.8954 21.5 37 21.5C38.1046 21.5 39 22.3954 39 23.5V38.5C39 40.7091 37.2091 42.5 35 42.5H5C2.79086 42.5 1 40.7091 1 38.5V10Z"/>
                                                    <path d="M40 2.40333L39.6464 2.04978L39.3398 2.35642L39.6 2.70333L40 2.40333ZM44.5 8.4033L44.1 8.70331L44.3706 9.06406L44.7572 8.83205L44.5 8.4033ZM38.75 3.5L39.15 3.2L38.832 2.77605L38.4273 3.1181L38.75 3.5ZM21 18.5L20.6773 18.1181L20.6034 18.1805L20.5581 18.2661L21 18.5ZM41 6.5L40.6 6.8L40.6 6.8L41 6.5ZM43.25 9.5L43.5848 9.87139L43.9241 9.56549L43.65 9.2L43.25 9.5ZM25.5 25.5L25.5822 25.9932L25.7263 25.9692L25.8348 25.8714L25.5 25.5ZM18.494 26.6677L18.5762 27.1609L18.5762 27.1609L18.494 26.6677ZM17.4459 25.2134L17.004 24.9794L17.004 24.9794L17.4459 25.2134ZM5 10V9.5H4.5V10H5ZM5 38.5H4.5V39H5V38.5ZM35 38.5V39H35.5V38.5H35ZM40.3536 2.75689C41.3923 1.71809 42.4038 1.42063 43.2478 1.51726C44.1054 1.61545 44.8769 2.13013 45.4036 2.87856C45.9303 3.62708 46.1872 4.57617 46.045 5.49051C45.905 6.39075 45.3725 7.29673 44.2428 7.97456L44.7572 8.83205C46.1275 8.00987 46.845 6.85335 47.0331 5.64422C47.219 4.44919 46.8822 3.24203 46.2214 2.30306C45.5606 1.364 44.5509 0.659929 43.3616 0.523755C42.1587 0.386024 40.8577 0.83857 39.6464 2.04978L40.3536 2.75689ZM44.9 8.1033L40.4 2.10333L39.6 2.70333L44.1 8.70331L44.9 8.1033ZM38.4273 3.1181L20.6773 18.1181L21.3227 18.8819L39.0727 3.8819L38.4273 3.1181ZM41.4 6.2L39.15 3.2L38.35 3.8L40.6 6.8L41.4 6.2ZM43.65 9.2L41.4 6.2L40.6 6.8L42.85 9.8L43.65 9.2ZM25.8348 25.8714L43.5848 9.87139L42.9152 9.12861L25.1652 25.1286L25.8348 25.8714ZM18.5762 27.1609L25.5822 25.9932L25.4178 25.0068L18.4118 26.1745L18.5762 27.1609ZM17.004 24.9794C16.4229 26.0771 17.3512 27.365 18.5762 27.1609L18.4118 26.1745C18.0035 26.2425 17.694 25.8132 17.8878 25.4473L17.004 24.9794ZM20.5581 18.2661L17.004 24.9794L17.8878 25.4473L21.4419 18.7339L20.5581 18.2661ZM5 5.5C2.51472 5.5 0.5 7.51472 0.5 10H1.5C1.5 8.067 3.067 6.5 5 6.5V5.5ZM25 5.5H5V6.5H25V5.5ZM27.5 8C27.5 6.61929 26.3807 5.5 25 5.5V6.5C25.8284 6.5 26.5 7.17157 26.5 8H27.5ZM25 10.5C26.3807 10.5 27.5 9.38071 27.5 8H26.5C26.5 8.82843 25.8284 9.5 25 9.5V10.5ZM5 10.5H25V9.5H5V10.5ZM5.5 38.5V10H4.5V38.5H5.5ZM35 38H5V39H35V38ZM34.5 23.5V38.5H35.5V23.5H34.5ZM37 21C35.6193 21 34.5 22.1193 34.5 23.5H35.5C35.5 22.6716 36.1716 22 37 22V21ZM39.5 23.5C39.5 22.1193 38.3807 21 37 21V22C37.8284 22 38.5 22.6716 38.5 23.5H39.5ZM39.5 38.5V23.5H38.5V38.5H39.5ZM35 43C37.4853 43 39.5 40.9853 39.5 38.5H38.5C38.5 40.433 36.933 42 35 42V43ZM5 43H35V42H5V43ZM0.5 38.5C0.5 40.9853 2.51472 43 5 43V42C3.067 42 1.5 40.433 1.5 38.5H0.5ZM0.5 10V38.5H1.5V10H0.5Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="plugins-tab-section">
                                <h3 class="section-header"><?php echo $translations['our_plugins']; ?></h3>
                                <div class="plugins__wrapper">
                                    <div class="plugins__card">
                                        <div class="plugins__card-img">
                                            <img src="<?php echo esc_url( get_theme_file_uri( '/vendor/codemanas/theme-info/img/zoom.png' ) ); ?>"
                                                 alt="<?php echo $translations['vcwz_title']; ?>">
                                            <p class="free"><?php echo $translations['free']; ?></p>
                                        </div>
                                        <h4 class="plugin-title"><?php echo $translations['vcwz_title']; ?></h4>
                                        <p class="desc"><?php echo $translations['vcwz_desc']; ?></p>
										<?php
										$ThemeSetting = $themeSettingInstance ?? null;
										if ( $themeSettingInstance === null ) {
											die( 'Theme Setttings Not Defined' );
										}
										$plugin_slug
											= 'video-conferencing-with-zoom-api';
										$plugin_file
											= $ThemeSetting->codemanas_get_plugin_file( $plugin_slug );

										if ( is_plugin_active( $plugin_file ) ) {
											$button_classes
												         = 'button activated install-plugin';
											$button_text = $translations['activated'];
										} else {
											$button_classes
												         = 'button install install-plugin';
											$button_text = $translations['install_and_activate'];
										}
										?>
                                        <button class="<?php echo esc_attr( $button_classes ); ?>"
                                                data-plugin-slug="<?php echo esc_attr( $plugin_slug ); ?>"
                                                data-file-name="video-conferencing-with-zoom-api"><?php echo esc_html( $button_text ); ?></button>
                                    </div>

                                    <div class="plugins__card">
                                        <div class="plugins__card-img">
                                            <img src="<?php echo esc_url( get_theme_file_uri( '/vendor/codemanas/theme-info/img/typesense.png' ) ); ?>"
                                                 alt="<?php echo $translations['swt_title']; ?>">
                                            <p class="free"><?php echo $translations['free']; ?></p>
                                        </div>
                                        <h4 class="plugin-title"><?php echo $translations['swt_title']; ?></h4>
                                        <p class="desc"><?php echo $translations['swt_desc']; ?></p>
										<?php
										$plugin_slug = 'search-with-typesense';
										$plugin_file
										             = $ThemeSetting->codemanas_get_plugin_file( $plugin_slug );

										if ( is_plugin_active( $plugin_file ) ) {
											$button_classes
												         = 'button activated install-plugin';
											$button_text = $translations['activated'];
										} else {
											$button_classes
												         = 'button install install-plugin';
											$button_text = $translations['install_and_activate'];
										}
										?>
                                        <button class="<?php echo esc_attr( $button_classes ); ?>"
                                                data-plugin-slug="<?php echo esc_attr( $plugin_slug ); ?>"
                                                data-file-name='codemanas-typesense'><?php echo esc_html( $button_text ); ?></button>
                                    </div>

                                    <div class="plugins__card">
                                        <div class="plugins__card-img">
                                            <img src="<?php echo esc_url( get_theme_file_uri( '/vendor/codemanas/theme-info/img/popup.png' ) ); ?>"
                                                 alt="<?php echo $translations['spb_title']; ?>">
                                            <p class="free"><?php echo $translations['free']; ?></p>
                                        </div>
                                        <h4 class="plugin-title"><?php echo $translations['spb_title']; ?></h4>
                                        <p class="desc"><?php echo $translations['spb_desc']; ?></p>
										<?php
										$plugin_slug = 'simple-popup-block';
										$plugin_file
										             = $ThemeSetting->codemanas_get_plugin_file( $plugin_slug );

										if ( is_plugin_active( $plugin_file ) ) {
											$button_classes
												         = 'button activated install-plugin';
											$button_text = $translations['activated'];
										} else {
											$button_classes
												         = 'button install install-plugin';
											$button_text = $translations['install_and_activate'];
										}
										?>
                                        <button class="<?php echo esc_attr( $button_classes ); ?>"
                                                data-plugin-slug="<?php echo esc_attr( $plugin_slug ); ?>"
                                                data-file-name="simple-popup-block"><?php echo esc_html( $button_text ); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cm-admin__sidebar">
                            <div class="cm-admin__sidebar-cards">
                                <h4><?php echo $translations['help_and_support']; ?></h4>
                                <p class="desc"><?php echo $translations['help_and_support_desc']; ?></p>
                                <div class="cards-btn">
                                    <a href="<?php echo esc_url( 'https://wordpress.org/support/theme/' . $dashed_theme_name . '/' ) ?>" class="button" target="_blank"><?php echo $translations['support']; ?></a>
                                </div>
                            </div>
                            <div class="cm-admin__sidebar-cards">
                                <h4><?php echo $translations['documentation']; ?></h4>
                                <p class="desc"><?php echo $translations['documentation_desc']; ?></p>
                                <div class="cards-btn">
                                    <a href="<?php echo $translations['documentation_link'] ?>" class="button" target="_blank"><?php echo $translations['documentation']; ?></a>
                                </div>
                            </div>
                            <div class="cm-admin__sidebar-cards">
                                <h4><?php echo $translations['leave_a_review']; ?></h4>
                                <p class="desc"><?php echo $translations['leave_a_review_desc']; ?></p>
                                <div class="cards-btn">
                                    <a href="<?php echo esc_url( 'https://wordpress.org/support/theme/' . $dashed_theme_name . '/reviews/' ) ?>" class="button" target="_blank"><?php echo $translations['review']; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-panel" data-tab="tab2">
                        <div class="change-log__wrapper">
							<?php
							$readmePath  = get_template_directory() . '/readme.txt';
							$fileContent = file_get_contents( $readmePath );
							$startPos    = strpos( $fileContent, '== Changelog ==' );
							$endPos      = strpos( $fileContent, '==',
								$startPos + strlen( '== Changelog ==' ) );

							if ( $startPos !== false && $endPos !== false ) {
								$changelog = substr( $fileContent, $startPos, $endPos - $startPos );
								$entries   = explode( PHP_EOL, $changelog );
								foreach ( $entries as $entry ) {
									$trimmedEntry = trim( $entry );
									if ( strpos( $trimmedEntry, '==' ) !== 0
									) {
										echo '<p>' . $trimmedEntry . '</p>';
									}
								}
							} else {
								echo 'Changelog section not found';
							}
							?>
                        </div>
                        <div class="cm-admin__sidebar">
                            <div class="cm-admin__sidebar-cards">
                                <h4><?php echo $translations['help_and_support']; ?></h4>
                                <p class="desc"><?php echo $translations['help_and_support_desc']; ?></p>
                                <div class="cards-btn">
                                    <a href="<?php echo esc_url( 'https://wordpress.org/support/theme/' . $dashed_theme_name . '/' ) ?>" class="button" target="_blank"><?php echo $translations['support']; ?></a>
                                </div>
                            </div>
                            <div class="cm-admin__sidebar-cards">
                                <h4><?php echo $translations['documentation']; ?></h4>
                                <p class="desc"><?php echo $translations['documentation_desc']; ?></p>
                                <div class="cards-btn">
                                    <a href="<?php echo $translations['documentation_link'] ?>" class="button" target="_blank"><?php echo $translations['documentation']; ?></a>
                                </div>
                            </div>
                            <div class="cm-admin__sidebar-cards">
                                <h4><?php echo $translations['leave_a_review']; ?></h4>
                                <p class="desc"><?php echo $translations['leave_a_review_desc']; ?></p>
                                <div class="cards-btn">
                                    <a href="<?php echo esc_url( 'https://wordpress.org/support/theme/' . $dashed_theme_name . '/reviews/' ) ?>" class="button" target="_blank"><?php echo $translations['review']; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-panel" data-tab="tab3">
                        <div class="tab-section">
                            <div class="tab-section-cmBLocks">
                                <div class="tab-section-cmBLocks__wrapper">
                                    <div class="quick-setting__wrapper quick-setting__wrapper--design-library">
                                        <div class="cm-theme-admin-design-library__preview-image">
                                            <img src="<?php echo esc_url( $design_library ); ?>" alt="Design Library">
                                        </div>
                                        <div class="cm-theme-admin-design-library-tab__section">
                                            <h2><?php echo $translations['craft_your_distinctive_web']; ?></h2>
                                            <p class="cm-theme-admin-card-item__desc"><?php echo $translations['explore_your_extensive_collection']; ?></p>
                                            <p class="cm-theme-admin-card-item__desc"><?php echo $translations['with_just_a_few_clicks']; ?></p>
                                            <a href="<?php echo esc_url( 'https://cmblocks.com/cm-blocks-design-library-v1-2-0/' ) ?>" target="_blank" class="body-btn-primary"><?php echo $translations['learn_more']; ?></a>
                                        </div>
                                    </div>
                                    <h2><?php echo $translations['our_blocks']; ?></h2>
                                    <div class="quick-setting__wrapper">
                                        <div class="cm-theme-admin-card-item">
                                            <img src="<?php echo esc_url( $slider_icon ) ?>" alt="<?php echo $translations['slider_icon']; ?>">
                                            <div class="cm-theme-admin-card-item__info">
                                                <h5 class="cm-theme-admin-card-item__title"><?php echo $translations['slider']; ?></h5>
                                                <p class="cm-theme-admin-card-item__desc"><?php echo $translations['create_smooth_and_interactive']; ?></p>
                                                <div class="cm-theme-admin-card-item-btn__wrapper">
                                                    <a class="body-btn-primary" href="<?php echo esc_url( 'https://docs.cmblocks.com/slider/' ) ?>" target="_blank"><?php echo $translations['docs'] ?></a>
                                                    <a class="cm-theme-admin-btn-secondary" href="<?php echo esc_url( 'https://cmblocks.com/cm-blocks/slider#slider-demo' ) ?>" target="_blank"><?php echo $translations['live_demo']; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cm-theme-admin-card-item">
                                            <img src="<?php echo esc_url( $accordion_icon ) ?>" alt="<?php echo $translations['accordion_icon']; ?>">
                                            <div class="cm-theme-admin-card-item__info">
                                                <h5 class="cm-theme-admin-card-item__title"><?php echo $translations['accordion']; ?></h5>
                                                <p class="cm-theme-admin-card-item__desc"><?php echo $translations['easy_accordion_which_enhance']; ?></p>
                                                <div class="cm-theme-admin-card-item-btn__wrapper">
                                                    <a class="body-btn-primary" href="<?php echo esc_url( 'https://docs.cmblocks.com/accordion/' ) ?>" target="_blank"><?php echo $translations['docs']; ?></a>
                                                    <a class="cm-theme-admin-btn-secondary" href="<?php echo esc_url( 'https://cmblocks.com/accordion/#accordion-demo' ) ?>" target="_blank"><?php echo $translations['live_demo']; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cm-theme-admin-card-item">
                                            <img src="<?php echo esc_url( $masonry_icon ) ?>" alt="<?php echo $translations['masonry_gallery_icon']; ?>">
                                            <div class="cm-theme-admin-card-item__info">
                                                <h5 class="cm-theme-admin-card-item__title"><?php echo $translations['masonry_gallery']; ?></h5>
                                                <p class="cm-theme-admin-card-item__desc"><?php echo $translations['simple_grid_based_gallery']; ?></p>
                                                <div class="cm-theme-admin-card-item-btn__wrapper">
                                                    <a class="body-btn-primary" href="<?php echo esc_url( 'https://docs.cmblocks.com/masonry-gallery/' ) ?>" target="_blank"><?php echo $translations['docs']; ?></a>
                                                    <a class="cm-theme-admin-btn-secondary" href="<?php echo esc_url( 'https://cmblocks.com/masonry-gallery/#masonry-demo' ) ?>" target="_blank"><?php echo $translations['live_demo']; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cm-theme-admin-card-item">
                                            <img src="<?php echo esc_url( $progressBar_icon ) ?>" alt="<?php echo $translations['progress_bar_icon']; ?>">
                                            <div class="cm-theme-admin-card-item__info">
                                                <h5 class="cm-theme-admin-card-item__title"><?php echo $translations['progress_bar']; ?></h5>
                                                <p class="cm-theme-admin-card-item__desc"><?php echo $translations['beautiful_slider_bar_without_writing']; ?></p>
                                                <div class="cm-theme-admin-card-item-btn__wrapper">
                                                    <a class="body-btn-primary" href="<?php echo esc_url( 'https://docs.cmblocks.com/progress-bar/' ) ?>" target="_blank"><?php echo $translations['docs']; ?></a>
                                                    <a class="cm-theme-admin-btn-secondary" href="<?php echo esc_url( 'https://cmblocks.com/progress-bar/#progressBar-demo' ) ?>" target="_blank"><?php echo $translations['live_demo']; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cm-theme-admin-card-item">
                                            <img src="<?php echo esc_url( $countdown_icon ) ?>" alt="<?php echo $translations['countdown_icon']; ?>">
                                            <div class="cm-theme-admin-card-item__info">
                                                <h5 class="cm-theme-admin-card-item__title"><?php echo $translations['countdown']; ?></h5>
                                                <p class="cm-theme-admin-card-item__desc"><?php echo $translations['countdown_desc']; ?></p>
                                                <div class="cm-theme-admin-card-item-btn__wrapper">
                                                    <a class="body-btn-primary" href="<?php echo esc_url( 'https://docs.cmblocks.com/countdown/' ) ?>" target="_blank"><?php echo $translations['docs']; ?></a>
                                                    <a class="cm-theme-admin-btn-secondary" href="<?php echo esc_url( 'https://cmblocks.com/cm-blocks/countdown-2/#countdown-demo' ) ?>" target="_blank"><?php echo $translations['live_demo']; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cm-theme-admin-card-item">
                                            <img src="<?php echo esc_url( $counter_icon ) ?>" alt="<?php echo $translations['counter_icon']; ?>">
                                            <div class="cm-theme-admin-card-item__info">
                                                <h5 class="cm-theme-admin-card-item__title"><?php echo $translations['counter']; ?></h5>
                                                <p class="cm-theme-admin-card-item__desc"><?php echo $translations['counter_desc']; ?></p>
                                                <div class="cm-theme-admin-card-item-btn__wrapper">
                                                    <a class="body-btn-primary" href="<?php echo esc_url( 'https://docs.cmblocks.com/counter/' ) ?>" target="_blank"><?php echo $translations['docs']; ?></a>
                                                    <a class="cm-theme-admin-btn-secondary" href="<?php echo esc_url( 'https://cmblocks.com/counter/#counter-demo' ) ?>" target="_blank"><?php echo $translations['live_demo']; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cm-admin-tab__wrapper">
                                    <a href="<?php echo esc_url( 'https://cmblocks.com/pricing/' ) ?>" class="cm-admin-designLibrary__pro" target="_blank">
                                        <h2><?php echo $translations['cm_blocks_suite']; ?></h2>
                                        <p class="cm-admin-card-item__desc">
											<?php echo $translations['cm_blocks_suite_desc']; ?>
                                        </p>
                                        <button class="body-btn-primary"><?php echo $translations['get_started_now']; ?></button>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>