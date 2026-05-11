<?php
/**
 * Recommended plugins
 *
 * @package castell
 */

if ( ! function_exists( 'castell_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function castell_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'castell' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
			array(
                'name'     => esc_html__( 'Image Slider', 'castell' ),
                'slug'     => 'image-slider-slideshow',
                'required' => false,
            )
        );
		 
		 
        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'castell_recommended_plugins' );