<?php
if(is_admin()){
	require get_template_directory() . '/admin/inc/class-webriti-about-page.php';
}
require get_template_directory() . '/admin/inc/plugin-include-control.php';
require get_template_directory() . '/admin/inc/include-companion.php';
$appointment_theme=wp_get_theme();
global $appointment_importer_filepath, $appointment_importer_pro_filepath, $appointment_importer_new_filepath;

    $appointment_demo_link='https://webriti.com/startersites/appointment/';
    $appointment_local_import=$appointment_local_import_widget=$appointment_local_import_customizer=$preview_url=$appointment_preview_image_url='';
    if ('Appointment' == $appointment_theme->name || 'Appointment Pro' == $appointment_theme->name || 'Appointment child' == $appointment_theme->name  || 'Appointment Child' == $appointment_theme->name || 'Appointment Pro Child' == $appointment_theme->name || 'Appointment Pro child' == $appointment_theme->name) {
        $appointment_local_import               = $appointment_demo_link . 'lite/default/content.xml';
        $appointment_local_import_widget        = $appointment_demo_link . 'lite/default/widget.wie';
        $appointment_local_import_customizer    = $appointment_demo_link . 'lite/default/customizer.dat';
        $appointment_preview_url               = 'https://appointment.webriti.com/';
        $appointment_preview_image_url          = $appointment_demo_link . 'thumbnail/default.jpg';
    }
    else if ('Appointment Green' == $appointment_theme->name) {
        $appointment_local_import               = $appointment_demo_link . 'lite/appointment-green/content.xml';
        $appointment_local_import_widget        = $appointment_demo_link . 'lite/appointment-green/widget.wie';
        $appointment_local_import_customizer    = $appointment_demo_link . 'lite/appointment-green/customizer.dat';
        $appointment_preview_url               = 'https://appointment-green.webriti.com/';
        $appointment_preview_image_url          = $appointment_demo_link . 'thumbnail/appointment-green.jpg';
    }
    else if ('Appointment Blue' == $appointment_theme->name) {
        $appointment_local_import               = $appointment_demo_link . 'lite/appointment-blue/content.xml';
        $appointment_local_import_widget        = $appointment_demo_link . 'lite/appointment-blue/widget.wie';
        $appointment_local_import_customizer    = $appointment_demo_link . 'lite/appointment-blue/customizer.dat';
        $appointment_preview_url               = 'https://appointment-blue.webriti.com/';
        $appointment_preview_image_url          = $appointment_demo_link . 'thumbnail/appointment-blue.jpg';
    }
    else if ('Appointment Red' == $appointment_theme->name) {
        $appointment_local_import               = $appointment_demo_link . 'lite/appointment-red/content.xml';
        $appointment_local_import_widget        = $appointment_demo_link . 'lite/appointment-red/widget.wie';
        $appointment_local_import_customizer    = $appointment_demo_link . 'lite/appointment-red/customizer.dat';
        $appointment_preview_url               = 'https://appointment-red.webriti.com/';
        $appointment_preview_image_url          = $appointment_demo_link . 'thumbnail/appointment-red.jpg';
    }
    else if ('Appointee' == $appointment_theme->name) {
        $appointment_local_import               = $appointment_demo_link . 'lite/appointee/content.xml';
        $appointment_local_import_widget        = $appointment_demo_link . 'lite/appointee/widget.wie';
        $appointment_local_import_customizer    = $appointment_demo_link . 'lite/appointee/customizer.dat';
        $appointment_preview_url               = 'https://appointee.webriti.com/';
        $appointment_preview_image_url          = $appointment_demo_link . 'thumbnail/appointee.jpg';
    }
    else if ('Appointment Dark' == $appointment_theme->name) {
        $appointment_local_import               = $appointment_demo_link . 'lite/appointment-dark/content.xml';
        $appointment_local_import_widget        = $appointment_demo_link . 'lite/appointment-dark/widget.wie';
        $appointment_local_import_customizer    = $appointment_demo_link . 'lite/appointment-dark/customizer.dat';
        $appointment_preview_url               = 'https://appointment-dark.webriti.com/';
        $appointment_preview_image_url          = $appointment_demo_link . 'thumbnail/appointment-dark.jpg';
    }
    else if ('vice' == $appointment_theme->name) {
        $appointment_local_import               = $appointment_demo_link . 'lite/vice/content.xml';
        $appointment_local_import_widget        = $appointment_demo_link . 'lite/vice/widget.wie';
        $appointment_local_import_customizer    = $appointment_demo_link . 'lite/vice/customizer.dat';
        $appointment_preview_url               = 'https://vice.webriti.com/';
        $appointment_preview_image_url          = $appointment_demo_link . 'thumbnail/vice.jpg';
    }
    else if ('Shk Corporate' == $appointment_theme->name) {
        $appointment_local_import               = $appointment_demo_link . 'lite/shk-corporate/content.xml';
        $appointment_local_import_widget        = $appointment_demo_link . 'lite/shk-corporate/widget.wie';
        $appointment_local_import_customizer    = $appointment_demo_link . 'lite/shk-corporate/customizer.dat';
        $appointment_preview_url               = 'https://shk-corporate.webriti.com/';
        $appointment_preview_image_url          = $appointment_demo_link . 'thumbnail/shk-corporate.jpg';
    }
    else{
        $appointment_local_import               = $appointment_demo_link . 'lite/default/content.xml';
        $appointment_local_import_widget        = $appointment_demo_link . 'lite/default/widget.wie';
        $appointment_local_import_customizer    = $appointment_demo_link . 'lite/default/customizer.dat';
        $appointment_preview_url               = 'https://appointment.webriti.com/';
        $appointment_preview_image_url          = $appointment_demo_link . 'thumbnail/default.jpg';
    }
    if ('Appointment' == $appointment_theme->name || 'Appointment Pro' == $appointment_theme->name || 'Appointment child' == $appointment_theme->name  || 'Appointment Child' == $appointment_theme->name || 'Appointment Pro Child' == $appointment_theme->name || 'Appointment Pro child' == $appointment_theme->name) {
        $appointment_importer_filepath= array(
            'appointment'=>array(
                'title'=>esc_html__('Default','appointment'),
                'categories'=>'Customizer',
                'slug'=>'appointment',
                'content'=>$appointment_local_import,
                'customizer'=>$appointment_local_import_customizer,
                'widget'=>$appointment_local_import_widget,
                'image'=>$appointment_preview_image_url,
                'demo_link'=>$appointment_preview_url,
                'plugin'=>'wpcf7-wpseo-wc',
                'status'=>'',
               ),
            'appointment-ele'=>array(
                'title'=>esc_html__('Default Elementor','appointment'),
                'categories'=>'Elementor',
                'slug'=>'appointment-ele',
                'content'=>$appointment_demo_link.'lite/default-elementor/content.xml',
                'customizer'=>$appointment_demo_link.'lite/default-elementor/customizer.dat',
                'widget'=>$appointment_demo_link.'lite/default-elementor/widget.wie',
                'image'=>$appointment_demo_link.'thumbnail/default-elementor.jpg',
                'demo_link'=>'https://ap-default.webriti.com/',
                'plugin'=>'wpcf7-wpseo-ele-wc',
                'status'=>'new',
               ),
           'business'=>array(
                'title'=>esc_html__('Business','appointment'),
                'categories'=>'Elementor',
                'slug'=>'business',
                'content'=>$appointment_demo_link.'lite/business/content.xml',
                'customizer'=>$appointment_demo_link.'lite/business/customizer.dat',
                'widget'=>$appointment_demo_link.'lite/business/widget.wie',
                'image'=>$appointment_demo_link.'thumbnail/business.jpg',
                'demo_link'=>'https://ap-business.webriti.com/',
                'plugin'=>'wpcf7-wpseo-ele',
                'status'=>'',
               ),
           'restaurants'=>array(
                'title'=>esc_html__('Restaurants','appointment'),
                'categories'=>'Elementor',
                'slug'=>'restaurants',
                'content'=>$appointment_demo_link.'lite/restaurants/content.xml',
                'customizer'=>$appointment_demo_link.'lite/restaurants/customizer.dat',
                'widget'=>$appointment_demo_link.'lite/restaurants/widget.wie',
                'image'=>$appointment_demo_link.'thumbnail/restaurants.jpg',
                'demo_link'=>'https://ap-restaurants.webriti.com/',
                'plugin'=>'wpcf7-wpseo-ele',
                'status'=>'',
               ),
           'appointment-gutenberg'=>array(
                'title'=>esc_html__('Default Gutenberg','appointment'),
                'categories'=>'Gutenberg',
                'slug'=>'appointment-gutenberg',
                'content'=>$appointment_demo_link.'lite/gutenberg/appointment/content.xml',
                'customizer'=>$appointment_demo_link.'lite/gutenberg/appointment/customizer.dat',
                'widget'=>$appointment_demo_link.'lite/gutenberg/appointment/widget.wie',
                'image'=>$appointment_demo_link.'thumbnail/gutenberg/default-gutenberg.jpg',
                'demo_link'=>'https://demo-appointment.webriti.com/demo-one/',
                'plugin'=>'wpcf7-wpseo-sb-wc',
                'status'=>'',
               ),
           'growkit-gutenberg'=>array(
                'title'=>esc_html__('Growkit Gutenberg','appointment'),
                'categories'=>'Gutenberg',
                'slug'=>'growkit-gutenberg',
                'content'=>$appointment_demo_link.'lite/gutenberg/growkit/content.xml',
                'customizer'=>$appointment_demo_link.'lite/gutenberg/growkit/customizer.dat',
                'widget'=>$appointment_demo_link.'lite/gutenberg/growkit/widget.wie',
                'image'=>$appointment_demo_link.'thumbnail/gutenberg/growkit-gutenberg.jpg',
                'demo_link'=>'https://demo-appointment.webriti.com/demo-two/',
                'plugin'=>'wpcf7-wpseo-sb',
                'status'=>'',
               ),
           'building-gutenberg'=>array(
                'title'=>esc_html__('Building Gutenberg','appointment'),
                'categories'=>'Gutenberg',
                'slug'=>'building-gutenberg',
                'content'=>$appointment_demo_link.'lite/gutenberg/building/content.xml',
                'customizer'=>$appointment_demo_link.'lite/gutenberg/building/customizer.dat',
                'widget'=>$appointment_demo_link.'lite/gutenberg/building/widget.wie',
                'image'=>$appointment_demo_link.'thumbnail/gutenberg/building-gutenberg.jpg',
                'demo_link'=>'https://demo-appointment.webriti.com/demo-three',
                'plugin'=>'wpcf7-wpseo-sb',
                'status'=>'',
               ),
        );
    }else{
        $appointment_importer_filepath= array(
            'appointment'=>array(
                'title'=>esc_html__('Default','appointment'),
                'categories'=>'Customizer',
                'slug'=>'appointment',
                'content'=>$appointment_local_import,
                'customizer'=>$appointment_local_import_customizer,
                'widget'=>$appointment_local_import_widget,
                'image'=>$appointment_preview_image_url,
                'demo_link'=>$appointment_preview_url,
                'plugin'=>'wpcf7-wpseo-wc',
                'status'=>'',
               ),
            'business'=>array(
                'title'=>esc_html__('Business','appointment'),
                'categories'=>'Elementor',
                'slug'=>'business',
                'content'=>$appointment_demo_link.'lite/business/content.xml',
                'customizer'=>$appointment_demo_link.'lite/business/customizer.dat',
                'widget'=>$appointment_demo_link.'lite/business/widget.wie',
                'image'=>$appointment_demo_link.'thumbnail/business.jpg',
                'demo_link'=>'https://ap-business.webriti.com/',
                'plugin'=>'wpcf7-wpseo-ele',
                'status'=>'',
               ),
           'restaurants'=>array(
                'title'=>esc_html__('Restaurants','appointment'),
                'categories'=>'Elementor',
                'slug'=>'restaurants',
                'content'=>$appointment_demo_link.'lite/restaurants/content.xml',
                'customizer'=>$appointment_demo_link.'lite/restaurants/customizer.dat',
                'widget'=>$appointment_demo_link.'lite/restaurants/widget.wie',
                'image'=>$appointment_demo_link.'thumbnail/restaurants.jpg',
                'demo_link'=>'https://ap-restaurants.webriti.com/',
                'plugin'=>'wpcf7-wpseo-ele',
                'status'=>'',
               ),
           'growkit-gutenberg'=>array(
                'title'=>esc_html__('Growkit Gutenberg','appointment'),
                'categories'=>'Gutenberg',
                'slug'=>'growkit-gutenberg',
                'content'=>$appointment_demo_link.'lite/gutenberg/growkit/content.xml',
                'customizer'=>$appointment_demo_link.'lite/gutenberg/growkit/customizer.dat',
                'widget'=>$appointment_demo_link.'lite/gutenberg/growkit/widget.wie',
                'image'=>$appointment_demo_link.'thumbnail/gutenberg/growkit-gutenberg.jpg',
                'demo_link'=>'https://demo-appointment.webriti.com/demo-two/',
                'plugin'=>'wpcf7-wpseo-sb',
                'status'=>'',
               ),
           'building-gutenberg'=>array(
                'title'=>esc_html__('Building Gutenberg','appointment'),
                'categories'=>'Gutenberg',
                'slug'=>'building-gutenberg',
                'content'=>$appointment_demo_link.'lite/gutenberg/building/content.xml',
                'customizer'=>$appointment_demo_link.'lite/gutenberg/building/customizer.dat',
                'widget'=>$appointment_demo_link.'lite/gutenberg/building/widget.wie',
                'image'=>$appointment_demo_link.'thumbnail/gutenberg/building-gutenberg.jpg',
                'demo_link'=>'https://demo-appointment.webriti.com/demo-three',
                'plugin'=>'wpcf7-wpseo-sb',
                'status'=>'',
               ),
        );
    }

    $appointment_importer_pro_filepath= array(
        'appointment-pro'=>array(
            'title'=>esc_html__('Default Pro','appointment'),
            'categories'=>'Customizer',
            'slug'=>'appointment-pro',
            'content'=>$appointment_demo_link.'pro/default/content.xml',
            'customizer'=>$appointment_demo_link.'pro/default/customizer.dat',
            'widget'=>$appointment_demo_link.'pro/default/widget.wie',
            'image'=>$appointment_demo_link.'pro/thumbnail/default-pro.jpg',
            'demo_link'=>'https://appointment-pro.webriti.com/',
            'plugin'=>'wpcf7-woo',
            'status'=>'',
        ),
        'corporate'=>array(
            'title'=>esc_html__('Corporate','appointment'),
            'categories'=>'Elementor',
            'slug'=>'corporate',
            'content'=>$appointment_demo_link.'pro/corporate/content.xml',
            'customizer'=>$appointment_demo_link.'pro/corporate/customizer.dat',
            'widget'=>$appointment_demo_link.'pro/corporate/widget.wie',
            'image'=>$appointment_demo_link.'pro/thumbnail/corporate.jpg',
            'demo_link'=>'https://ap-corporate.webriti.com/',
            'plugin'=>'wpcf7-wpseo-ele',
            'status'=>'',
        ),
        'maintenance'=>array(
            'title'=>esc_html__('Maintenance','appointment'),
            'categories'=>'Elementor',
            'slug'=>'maintenance',
            'content'=>$appointment_demo_link.'pro/maintenance/content.xml',
            'customizer'=>$appointment_demo_link.'pro/maintenance/customizer.dat',
            'widget'=>$appointment_demo_link.'pro/maintenance/widget.wie',
            'image'=>$appointment_demo_link.'pro/thumbnail/maintenance.jpg',
            'demo_link'=>'https://ap-maintenance.webriti.com/',
            'plugin'=>'wpcf7-wpseo-ele',
            'status'=>'',
        ),
        'education'=>array(
            'title'=>esc_html__('Education','appointment'),
            'categories'=>'Elementor',
            'slug'=>'education',
            'content'=>$appointment_demo_link.'pro/education/content.xml',
            'customizer'=>$appointment_demo_link.'pro/education/customizer.dat',
            'widget'=>$appointment_demo_link.'pro/education/widget.wie',
            'image'=>$appointment_demo_link.'pro/thumbnail/education.jpg',
            'demo_link'=>'https://ap-education.webriti.com/',
            'plugin'=>'wpcf7-wpseo-ele',
            'status'=>'',
        ),
        'architect'=>array(
            'title'=>esc_html__('Architect','appointment'),
            'categories'=>'Elementor',
            'slug'=>'architect',
            'content'=>$appointment_demo_link.'pro/architect/content.xml',
            'customizer'=>$appointment_demo_link.'pro/architect/customizer.dat',
            'widget'=>$appointment_demo_link.'pro/architect/widget.wie',
            'image'=>$appointment_demo_link.'pro/thumbnail/architect.jpg',
            'demo_link'=>'https://ap-architect.webriti.com/',
            'plugin'=>'wpcf7-wpseo-ele',
            'status'=>'',
        ),
        'finance'=>array(
            'title'=>esc_html__('Finance','appointment'),
            'categories'=>'Elementor',
            'slug'=>'finance',
            'content'=>$appointment_demo_link.'pro/finance/content.xml',
            'customizer'=>$appointment_demo_link.'pro/finance/customizer.dat',
            'widget'=>$appointment_demo_link.'pro/finance/widget.wie',
            'image'=>$appointment_demo_link.'pro/thumbnail/finance.jpg',
            'demo_link'=>'https://ap-finance.webriti.com/',
            'plugin'=>'wpcf7-wpseo-ele',
            'status'=>'',
        ),
       'appointment-pro-gutenberg'=>array(
            'title'=>esc_html__('Default Pro Gutenberg','appointment'),
            'categories'=>'Gutenberg',
            'slug'=>'appointment-pro-gutenberg',
            'content'=>$appointment_demo_link.'pro/gutenberg/appointment-pro/content.xml',
            'customizer'=>$appointment_demo_link.'pro/gutenberg/appointment-pro/customizer.dat',
            'widget'=>$appointment_demo_link.'pro/gutenberg/appointment-pro/widget.wie',
            'image'=>$appointment_demo_link.'pro/thumbnail/gutenberg/default-pro-gutenberg.jpg',
            'demo_link'=>'https://demo-appointment.webriti.com/demo-pro-one',
            'plugin'=>'wpcf7-wpseo-sbp',
            'status'=>'',
        ),
       'business-gutenberg'=>array(
            'title'=>esc_html__('Business Gutenberg','appointment'),
            'categories'=>'Gutenberg',
            'slug'=>'business-gutenberg',
            'content'=>$appointment_demo_link.'pro/gutenberg/business/content.xml',
            'customizer'=>$appointment_demo_link.'pro/gutenberg/business/customizer.dat',
            'widget'=>$appointment_demo_link.'pro/gutenberg/business/widget.wie',
            'image'=>$appointment_demo_link.'pro/thumbnail/gutenberg/business-gutenberg.jpg',
            'demo_link'=>'https://demo-appointment.webriti.com/demo-pro-two',
            'plugin'=>'wpcf7-wpseo-sbp',
            'status'=>'',
        ),
       'corporate-gutenberg'=>array(
            'title'=>esc_html__('Corporate Gutenberg','appointment'),
            'categories'=>'Gutenberg',
            'slug'=>'corporate-gutenberg',
            'content'=>$appointment_demo_link.'pro/gutenberg/corporate/content.xml',
            'customizer'=>$appointment_demo_link.'pro/gutenberg/corporate/customizer.dat',
            'widget'=>$appointment_demo_link.'pro/gutenberg/corporate/widget.wie',
            'image'=>$appointment_demo_link.'pro/thumbnail/gutenberg/corporate-gutenberg.jpg',
            'demo_link'=>'https://demo-appointment.webriti.com/demo-pro-three',
            'plugin'=>'wpcf7-wpseo-sbp',
            'status'=>'',
        ),
       'digital-agency-gutenberg'=>array(
            'title'=>esc_html__('Digital Agency Gutenberg','appointment'),
            'categories'=>'Gutenberg',
            'slug'=>'digital-agency-gutenberg',
            'content'=>$appointment_demo_link.'pro/gutenberg/digital-agency/content.xml',
            'customizer'=>$appointment_demo_link.'pro/gutenberg/digital-agency/customizer.dat',
            'widget'=>$appointment_demo_link.'pro/gutenberg/digital-agency/widget.wie',
            'image'=>$appointment_demo_link.'pro/thumbnail/gutenberg/digital-agency-gutenberg.jpg',
            'demo_link'=>'https://demo-appointment.webriti.com/demo-pro-four',
            'plugin'=>'wpcf7-wpseo-sbp',
            'status'=>'',
        ), 
        'architecture-gutenberg'=>array(
            'title'=>esc_html__('Architecture Gutenberg','appointment'),
            'categories'=>'Gutenberg',
            'slug'=>'architecture-gutenberg',
            'content'=>$appointment_demo_link.'pro/gutenberg/architecture/content.xml',
            'customizer'=>$appointment_demo_link.'pro/gutenberg/architecture/customizer.dat',
            'widget'=>$appointment_demo_link.'pro/gutenberg/architecture/widget.wie',
            'image'=>$appointment_demo_link.'pro/thumbnail/gutenberg/architecture-gutenberg.jpg',
            'demo_link'=>'https://demo-appointment.webriti.com/demo-pro-five',
            'plugin'=>'wpcf7-wpseo-sbp',
            'status'=>'new',
        ),      
    ); 