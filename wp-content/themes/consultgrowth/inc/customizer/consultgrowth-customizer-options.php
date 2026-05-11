<?php
/**
 * Customizer section options.
 *
 * @package consultgrowth
 *
 */

function consultgrowth_customizer_theme_settings( $wp_customize ){
	
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
		
		$wp_customize->add_setting(
			'consultstreet_footer_copright_text',
			array(
				'sanitize_callback' =>  'consultgrowth_sanitize_text',
				'default' => __('Copyright &copy; 2026 | Powered by <a href="//wordpress.org/">WordPress</a> <span class="sep"> | </span> ConsultGrowth theme by <a target="_blank" href="//themearile.com/">ThemeArile</a>', 'consultgrowth'),
				'transport'         => $selective_refresh,
			)	
		);
		$wp_customize->add_control('consultstreet_footer_copright_text', array(
				'label' => esc_html__('Footer Copyright','consultgrowth'),
				'section' => 'consultstreet_footer_copyright',
				'priority'        => 10,
				'type'    =>  'textarea'
		));

}
add_action( 'customize_register', 'consultgrowth_customizer_theme_settings' );

function consultgrowth_sanitize_text( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
}