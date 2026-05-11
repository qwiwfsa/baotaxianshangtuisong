<?php
function appointment_header_option($wp_customize) {
     /******************** Logo Length *******************************/
    $wp_customize->add_setting( 'appointment_logo_length',
            array(
                'default' => 154,
                'sanitize_callback' => 'absint'
            )
        );
        $wp_customize->add_control( new Appointment_Slider_Custom_Control( $wp_customize, 'appointment_logo_length',
            array(
                'label' => esc_html__( 'Logo Width', 'appointment'  ),
                'priority' => 50,
                'section' => 'title_tagline',
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                ),
            )
        ) );
}
add_action('customize_register', 'appointment_header_option');