<?php

function appointment_red_header_layout_customizer($wp_customize) {

    class Appointment_red_Image_Radio_Button_Custom_Control extends WP_Customize_Control {

        /**
         * The type of control being rendered
         */
        public $type = 'image_radio_button';

        public function enqueue() {
            add_action('customize_controls_print_styles', array($this, 'print_styles'));
        }

        public function print_styles() {
            ?><style>
                /*blue child*/
                .image_radio_button_control .radio-button-label > img{
                    margin-top: 5%;
                }
            </style>
            <?php
        }

        /**
         * Render the control in the customizer
         */
        public function render_content() {
            ?>
            <div class="image_radio_button_control">
                <?php if (!empty($this->label)) { ?>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php } ?>
                <?php if (!empty($this->description)) { ?>
                    <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php } ?>

                <?php foreach ($this->choices as $key => $value) { ?>
                    <label class="radio-button-label">
                        <input type="radio" name="<?php echo esc_attr($this->id); ?>" value="<?php echo esc_attr($key); ?>" <?php $this->link(); ?> <?php checked(esc_attr($key), $this->value()); ?>/>
                        <img src="<?php echo esc_attr($value['image']); ?>" alt="<?php echo esc_attr($value['name']); ?>" title="<?php echo esc_attr($value['name']); ?>" />
                    </label>
                <?php } ?>
            </div>
            <?php
        }

    }

    $appointment_red_header_settings = wp_parse_args(get_option('appointment_options', array()), appointment_theme_setup_data());


    /* Header Layout section */
    $wp_customize->add_section('header_layout_setting', array(
        'title' => esc_html__('Header Layout', 'appointment-red'),
        'panel' => 'header_options'
    ));

    // Header Layout settings
    if ((!has_custom_logo() && $appointment_red_header_settings['enable_header_logo_text'] == 'nomorenow' ) || $appointment_red_header_settings['enable_header_logo_text'] == 1 || $appointment_red_header_settings['upload_image_logo'] != '') {

        $wp_customize->add_setting('appointment_options[header_layout_setting]', array(
            'default' => 'default',
            'sanitize_callback' => 'appointment_red_sanitize_radio',
            'type' => 'option'
        ));
    } else {

        $wp_customize->add_setting('appointment_options[header_layout_setting]', array(
            'default' => 'sticky',
            'sanitize_callback' => 'appointment_red_sanitize_radio',
            'type' => 'option'
        ));
    }
    $wp_customize->add_control(new Appointment_red_Image_Radio_Button_Custom_Control($wp_customize, 'appointment_options[header_layout_setting]',
                    array(
                'label' => esc_html__('Header Layout Setting', 'appointment-red'),
                'section' => 'header_layout_setting',
                'choices' => array(
                    'default' => array(
                        'image' => APPOINTMENT_RED_TEMPLATE_DIR_URI . '/images/appointment-red-header1.png',
                        'name' => esc_html__('Header Standard', 'appointment-red')
                    ),
                    'sticky' => array(
                        'image' => APPOINTMENT_RED_TEMPLATE_DIR_URI . '/images/appointment-red-header2.png',
                        'name' => esc_html__('Header Overlap', 'appointment-red')
                    )
                )
                    )
    ));
}

add_action('customize_register', 'appointment_red_header_layout_customizer');

//radio box sanitization function
function appointment_red_sanitize_radio($input, $setting) {

    $input = sanitize_key($input);

    $choices = $setting->manager->get_control($setting->id)->choices;

    //return if valid 
    return ( array_key_exists($input, $choices) ? $input : $setting->default );
}
