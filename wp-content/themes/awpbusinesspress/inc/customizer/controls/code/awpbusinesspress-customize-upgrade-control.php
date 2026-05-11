<?php
/**
 * Customize Heading control class.
 *
 * @package awpbusinesspress
 *
 * @see     WP_Customize_Control
 * @access  public
 */

/**
 * Class awpbusinesspress_Customize_Upgrade_Control
 */
class awpbusinesspress_Customize_Upgrade_Control extends awpbusinesspress_Customize_Base_Control {

	/**
	 * Customize control type.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'awpbusinesspress-upgrade';

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @access protected
	 * @return void
	 */
	protected function content_template() {
		$upgrade_to_pro_link = 'https://awplife.com/wordpress-themes/wpbusinesspress-premium/';
		?>

		<div class="awpbusinesspress-upgrade-pro-message" style="display:none;";>
			<# if ( data.label ) { #><h4 class="customize-control-title"><?php echo wp_kses_post( 'Upgrade to <a href="' . $upgrade_to_pro_link . '" target="_blank" > WPBusinessPress Pro </a> to add more', 'awpbusinesspress' ); ?> {{{ data.label }}} <?php esc_html_e( 'and get the other premium features.', 'awpbusinesspress' ); ?></h4><# } #>
		</div>

		<?php
	}

	/**
	 * Render content is still called, so be sure to override it with an empty function in your subclass as well.
	 */
	protected function render_content() {

	}

}
