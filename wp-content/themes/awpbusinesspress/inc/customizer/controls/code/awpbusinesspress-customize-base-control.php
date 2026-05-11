<?php
/**
 * Customize Base control class.
 *
 * @package awpbusinesspress
 *
 * @see     WP_Customize_Control
 * @access  public
 */

/**
 * Class awpbusinesspress_Customize_Base_Control
 */
class awpbusinesspress_Customize_Base_Control extends WP_Customize_Control {

	/**
	 * Enqueue scripts all controls.
	 */
	public function enqueue() {

		// Color picker alpha.
		wp_enqueue_script( 'wp-color-picker-alpha', AWPBUSINESSPRESS_THEME_URL . '/inc/customizer/controls/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), '1.0.0', true );
		// wp color picker.
		$color_picker_strings = array(
			'clear'            => __( 'Clear', 'awpbusinesspress' ),
			'clearAriaLabel'   => __( 'Clear color', 'awpbusinesspress' ),
			'defaultString'    => __( 'Default', 'awpbusinesspress' ),
			'defaultAriaLabel' => __( 'Select default color', 'awpbusinesspress' ),
			'pick'             => __( 'Select Color', 'awpbusinesspress' ),
			'defaultLabel'     => __( 'Color value', 'awpbusinesspress' ),
		);
		wp_localize_script( 'wp-color-picker-alpha', 'wpColorPickerL10n', $color_picker_strings );
		wp_enqueue_script( 'wp-color-picker-alpha' );

		// Scripts for nesting panel/section.
		wp_enqueue_script( 'awpbusinesspress-extend-customizer', AWPBUSINESSPRESS_THEME_URL . '/inc/customizer/assets/js/extend-customizer.js', array( 'jquery' ), false, true );
		wp_enqueue_style( 'awpbusinesspress-extend-customizer', AWPBUSINESSPRESS_THEME_URL . '/inc/customizer/assets/css/extend-customizer.css' );

		// Main scripts.
		wp_enqueue_script(
			'awpbusinesspress-controls',
			AWPBUSINESSPRESS_THEME_URL . '/inc/customizer/controls/js/controls.js',
			array(
				'jquery',
				'customize-base',
				'wp-color-picker-alpha',
			),
			false,
			true
		);

		wp_enqueue_style( 'awpbusinesspress-controls', AWPBUSINESSPRESS_THEME_URL . '/inc/customizer/controls/css/controls.css' );

	}


	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see    WP_Customize_Control::to_json()
	 * @access public
	 * @return void
	 */
	public function to_json() {

		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}

		$this->json['id']      = $this->id;
		$this->json['value']   = $this->value();
		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['l10n']    = $this->l10n();

		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}

	}

	/**
	 * Render content is still called, so be sure to override it with an empty function in your subclass as well.
	 */
	protected function render_content() {
	}

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @access protected
	 * @return void
	 */
	protected function content_template() {
	}

	/**
	 * Returns an array of translation strings.
	 *
	 * @access protected
	 * @return array
	 */
	protected function l10n() {
		return array();
	}

}
