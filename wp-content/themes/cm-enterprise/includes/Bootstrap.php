<?php
namespace Codemanas\CMEnterprise;

use Codemanas\ThemeInfo\ThemeSetting;

final class Bootstrap {
	public static ?Bootstrap $instance = null;

	public static function get_instance(): ?Bootstrap {
		return is_null( self::$instance ) ? self::$instance = new self() : self::$instance;
	}

	public function autoloader(): void {
		// Make sure to use the correct path for your autoloader
		require_once __DIR__ . '/../vendor/autoload.php';
	}

	public function initTheme(): void {
		$translate_strings = $this->get_translate_strings();
		ThemeSetting::get_instance($translate_strings);
		Setup::get_instance();
		AssetsHandler::get_instance();
		Blocks::get_instance();
	}

	private function get_translate_strings(): array {
		return [
			'live_demo'                            => __('Live Demo', 'cm-enterprise'),
			'documentation'                        => __('Documentation', 'cm-enterprise'),
			'cm_blocks_section_subtitle'           => __('CM Blocks - WordPress Blocks Unleashed', 'cm-enterprise'),
			'cm_blocks_section_title'              => __('Easily start building your websites with CM Blocks', 'cm-enterprise'),
			'cm_blocks_section_desc'               => __('CM Blocks is a custom WordPress blocks plugin designed to streamline the process of building websites using the WordPress platform. WordPress blocks, introduced with the Gutenberg editor, are content elements that allow users to add various types of content to their posts or pages in a visually appealing and structured manner.', 'cm-enterprise'),
			'get_cm_block_suite'                   => __('Get CM Blocks Suite', 'cm-enterprise'),
			'cm_blocks_collection_image'           => __('CM BLocks Collection images', 'cm-enterprise'),
			'tab1_title'                           => __('Get Started', 'cm-enterprise'),
			'tab2_title'                           => __('Change Log', 'cm-enterprise'),
			'tab3_title'                           => __('CM Blocks', 'cm-enterprise'),
			'quick_setting'                        => __('Quick Settings', 'cm-enterprise'),
			'header'                               => __('Header', 'cm-enterprise'),
			'sticky_header_info'                   => __('To enable sticky header please install', 'cm-enterprise'),
			'cm_blocks'                            => __('CM Blocks', 'cm-enterprise'),
			'configure_sticky_header'              => __('Configure the sticky header feature on or off as needed', 'cm-enterprise'),
			'learn_more'                           => __('Learn More', 'cm-enterprise'),
			'footer'                               => __('Footer', 'cm-enterprise'),
			'style_variation'                      => __('Styles Variation', 'cm-enterprise'),
			'navigation'                           => __('Navigation', 'cm-enterprise'),
			'all_templates'                        => __('All Templates', 'cm-enterprise'),
			'page_templates'                       => __('Page Templates', 'cm-enterprise'),
			'our_plugins'                          => __('Our Plugins', 'cm-enterprise'),
			'free'                                 => __('Free', 'cm-enterprise'),
			'vcwz_title'                           => __('Video Conferencing with Zoom', 'cm-enterprise'),
			'vcwz_desc'                            => __('Video Conferencing with zoom free version', 'cm-enterprise'),
			'swt_title'                            => __('Search With Typesense', 'cm-enterprise'),
			'swt_desc'                             => __('Instant Search With Typesense free version', 'cm-enterprise'),
			'spb_title'                            => __('Simple Popup Block', 'cm-enterprise'),
			'spb_desc'                             => __('A simple and easy to use popup block plugin for block editor', 'cm-enterprise'),
			'activated'                            => __('Activated', 'cm-enterprise'),
			'install'                              => __('Install', 'cm-enterprise'),
			'help_and_support'                     => __('Help and Support', 'cm-enterprise'),
			'help_and_support_desc'                => __('No Problem!! Please create a support ticket. Our dedicated support team will help you to solve your problem', 'cm-enterprise'),
			'support'                              => __('Support', 'cm-enterprise'),
			'documentation_desc'                   => __('From Edit screen of page/post, you can easily import Beautiful Patterns.', 'cm-enterprise'),
			'review'                               => __('Review', 'cm-enterprise'),
			'leave_a_review'                       => __('Leave a Review', 'cm-enterprise'),
			'leave_a_review_desc'                  => __('From Edit screen of page/post, you can easily import Beautiful Patterns.', 'cm-enterprise'),
			'craft_your_distinctive_web'           => __('" Craft Your Distinctive Web Presence with Our Design Library "', 'cm-enterprise'),
			'explore_your_extensive_collection'    => __('Explore our extensive collection of expertly crafted patterns and page designs. Choose from a variety of options to create your site exactly as you envision it.', 'cm-enterprise'),
			'with_just_a_few_clicks'               => __('With just a few clicks, easily create beautiful sections anywhere on your site.', 'cm-enterprise'),
			'our_blocks'                           => __('Our Blocks', 'cm-enterprise'),
			'slider_icon'                          => __('Slider Icon', 'cm-enterprise'),
			'slider'                               => __('Slider', 'cm-enterprise'),
			'create_smooth_and_interactive'        => __('Create Smooth and interactive user interface.', 'cm-enterprise'),
			'docs'                                 => __('Docs', 'cm-enterprise'),
			'accordion_icon'                       => __('Accordion Icon', 'cm-enterprise'),
			'accordion'                            => __('Accordion', 'cm-enterprise'),
			'easy_accordion_which_enhance'         => __('Easy Accordion which enhance user experience and make site organized.', 'cm-enterprise'),
			'masonry_gallery_icon'                 => __('Masonry Gallery Icon', 'cm-enterprise'),
			'masonry_gallery'                      => __('Masonry Gallery', 'cm-enterprise'),
			'simple_grid_based_gallery'            => __('Simple grid based gallery inside WordPress content editor.', 'cm-enterprise'),
			'progress_bar_icon'                    => __('Progress Bar Icon', 'cm-enterprise'),
			'progress_bar'                         => __('Progress Bar', 'cm-enterprise'),
			'beautiful_slider_bar_without_writing' => __('Beautiful slider bar without writing long lines of code on WordPress.', 'cm-enterprise'),
			'countdown_icon'                       => __('Countdown Icon', 'cm-enterprise'),
			'countdown'                            => __('Countdown', 'cm-enterprise'),
			'countdown_desc'                       => __('Customizable WordPress blocks that allows user to add timer inside.', 'cm-enterprise'),
			'counter_icon'                         => __('Counter Icon', 'cm-enterprise'),
			'counter'                              => __('Counter', 'cm-enterprise'),
			'counter_desc'                         => __('Create beautiful Counters without writing a bunch of code.', 'cm-enterprise'),
			'cm_blocks_suite'                      => __('Elevate your design with CM Blocks Suite.', 'cm-enterprise'),
			'cm_blocks_suite_desc'                 => __('Unlock Premium Designs and access a collection of unique, high-quality templates that will make your site stand out. With dedicated priority support, you will have everything you need to create exceptional websites effortlessly. Elevate your design capabilities today with our Premium Designs!', 'cm-enterprise'),
			'get_started_now'                      => __('Get Started Now', 'cm-enterprise'),
		];
	}
	public function __construct() {
		$this->autoloader();
		$this->initTheme();
	}
}

Bootstrap::get_instance();
