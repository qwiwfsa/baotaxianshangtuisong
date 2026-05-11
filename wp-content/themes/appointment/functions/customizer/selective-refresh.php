<?php
/**
 * Includes functions for selective refresh
 * 
 * @package Appointment
 */
function appointment_customize_selective_refresh( $wp_customize ) {
    if ( ! isset( $wp_customize->selective_refresh ) ) return;
    // Site Title
    $wp_customize->selective_refresh->add_partial('blogname',
        array(
            'selector'        => '.site-title a',
            'render_callback' => 'appointment_customize_partial_blogname'
        )
    );
    // Site Tagline
    $wp_customize->selective_refresh->add_partial('blogdescription',
        array(
            'selector'        => '.site-description',
            'render_callback' => 'appointment_customize_partial_blogdescription'
        )
    );
    // Header Social Icons
    $wp_customize->selective_refresh->add_partial('appointment_options[header_social_media_enabled]',
        array(
            'selector'        => '.head-contact-social',
            'settings' => 'appointment_options[header_social_media_enabled]'
        )
    );
    // Latest Blog Section Head
    $wp_customize->selective_refresh->add_partial('appointment_options[blog_heading]',
        array(
            'selector'        => '.blog-section .section-heading-title h2',
            'settings' => 'appointment_options[blog_heading]'
        )
    );
    // Latest Blog Section Description
    $wp_customize->selective_refresh->add_partial('appointment_options[blog_description]',
        array(
            'selector'        => '.blog-section .section-heading-title p',
            'settings' => 'appointment_options[blog_description]'
        )
    );
    // Footer Copyright
    $wp_customize->selective_refresh->add_partial('appointment_options[footer_copyright_text]',
        array(
            'selector'        => '.footer-copyright',
            'settings' => 'appointment_options[footer_copyright_text]'
        )
    );
    // Footer Social Icons
    $wp_customize->selective_refresh->add_partial('appointment_options[footer_social_media_enabled]',
        array(
            'selector'        => '.footer-contact-social',
            'settings' => 'appointment_options[footer_social_media_enabled]'
        )
    );
    // Related Post
    $wp_customize->selective_refresh->add_partial('single_post_related_posts_title',
        array(
            'selector'        => '.related-post-title h3',
            'render_callback' => 'single_post_related_posts_title'
        )
    );

}
add_action( 'customize_register', 'appointment_customize_selective_refresh' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function appointment_customize_partial_blogname() {
    bloginfo( 'name' );
}
function appointment_customize_partial_blogdescription() {
    bloginfo( 'description' );
}