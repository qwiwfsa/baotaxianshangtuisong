<?php

/**
 * sky-enterprise: Block Patterns
 *
 * @since sky-enterprise 1.0.0
 */

/**
 * Registers pattern categories for sky-enterprise
 *
 * @since sky-enterprise 1.0.0
 *
 * @return void
 */
function sky_enterprise_register_pattern_category()
{
	$block_pattern_categories = array(
		'sky-enterprise' => array('label' => __('Sky Enterprise Patterns', 'sky-enterprise')),
		'sky-enterprise-homes' => array('label' => __('Sky Enterprise Homepage Templates', 'sky-enterprise')),
		'sky-enterprise-about' => array('label' => __('Sky Enterprise About Us Page', 'sky-enterprise')),
		'sky-enterprise-service' => array('label' => __('Sky Enterprise Services Page', 'sky-enterprise')),
		'sky-enterprise-contact' => array('label' => __('Sky Enterprise Contact Us Page', 'sky-enterprise'))
	);

	$block_pattern_categories = apply_filters('sky_enterprise_block_pattern_categories', $block_pattern_categories);

	foreach ($block_pattern_categories as $name => $properties) {
		if (!WP_Block_Pattern_Categories_Registry::get_instance()->is_registered($name)) {
			register_block_pattern_category($name, $properties); // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_pattern_category
		}
	}
}
add_action('init', 'sky_enterprise_register_pattern_category', 9);
