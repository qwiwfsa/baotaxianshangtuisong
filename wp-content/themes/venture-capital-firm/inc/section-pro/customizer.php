<?php 
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Venture_Capital_Firm_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Venture_Capital_Firm_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new Venture_Capital_Firm_Customize_Section_Pro( $manager,'venture_capital_firm_go_pro', array(
			'priority'   => 1,
			'title'    => esc_html__( 'Venture Capital Firm Pro', 'venture-capital-firm' ),
			'pro_text' => esc_html__( 'Upgrade Pro', 'venture-capital-firm' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/products/venture-capital-wordpress-theme'),
		) )	);

		// Register sections.
		$manager->add_section( new Venture_Capital_Firm_Customize_Section_Pro( $manager,'venture_capital_firm_live_demo', array(
			'priority'   => 2,
			'title'    => esc_html__( 'Venture Capital Firm Live Demo', 'venture-capital-firm' ),
			'demo_text' => esc_html__( 'Live Demo', 'venture-capital-firm' ),
			'demo_url'  => esc_url('https://www.vwthemes.net/venture-capital-firm-pro/'),
		) )	);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_style( 'venture-capital-firm-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Venture_Capital_Firm_Customize::get_instance();