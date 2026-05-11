<?php
/**
 * Recommended plugins
 *
 * @package finance-elementor
 */

if ( ! function_exists( 'finance_elementor_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function finance_elementor_recommended_plugins() {

        $plugins = array(  

            array(
                'name'     => esc_html__( 'Testerwp Ecommerce Companion', 'finance-elementor' ),
                'slug'     => 'testerwp-ecommerce-companion',
                'required' => false,
            ),              
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'finance-elementor' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Elementor Website Builder', 'finance-elementor' ),
                'slug'     => 'elementor',
                'required' => false,
            ),
             array(
                'name'     => esc_html__( 'ElementsKit Lite', 'finance-elementor' ),
                'slug'     => 'elementskit-lite',
                'required' => false,
            ),
             array(
                'name'     => esc_html__( 'WooCommerce', 'finance-elementor' ),
                'slug'     => 'woocommerce',
                'required' => false,
            ),
        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'finance_elementor_recommended_plugins' );