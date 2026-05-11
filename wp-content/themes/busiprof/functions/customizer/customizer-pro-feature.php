<?php //Pro Details
function busiprof_pro_feature_customizer( $wp_customize ) {
class Busiprof_WP_Pro__Feature_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
    <div class="busiprof-pro-features-customizer">
    <ul class="busiprof-pro-features">
        <li>
            <span class="busiprof-pro-label"><?php esc_html_e( 'PRO','busiprof' ); ?></span>
            <?php esc_html_e( 'Social Icon Settings','busiprof' ); ?>
        </li>
        <li>
            <span class="busiprof-pro-label"><?php esc_html_e( 'PRO','busiprof' ); ?></span>
            <?php esc_html_e( 'Slider Settings','busiprof' ); ?>
        </li>
        <li>
            <span class="busiprof-pro-label"><?php esc_html_e( 'PRO','busiprof' ); ?></span>
            <?php esc_html_e( 'Create Unlimited Services','busiprof' ); ?>
        </li>
        <li>
            <span class="busiprof-pro-label"><?php esc_html_e( 'PRO','busiprof' ); ?></span>
            <?php esc_html_e( 'Portfolio Management','busiprof' ); ?>
        </li>
        <li>
            <span class="busiprof-pro-label"><?php esc_html_e( 'PRO','busiprof' ); ?></span>
            <?php esc_html_e( 'Client Slider Settings','busiprof' ); ?>
        </li>
        <li>
            <span class="busiprof-pro-label"><?php esc_html_e( 'PRO','busiprof' ); ?></span>
            <?php esc_html_e( 'Multiple Page Templates','busiprof' ); ?>
        </li>
        <li>
            <span class="busiprof-pro-label"><?php esc_html_e( 'PRO','busiprof' ); ?></span>
            <?php esc_html_e( 'SEO Friendly URL Settings','busiprof' ); ?>
        </li>
        <li>
            <span class="busiprof-pro-label"><?php esc_html_e( 'PRO','busiprof' ); ?></span>
            <?php esc_html_e( 'Section Reordering','busiprof' ); ?>
        </li>
        <li>
            <span class="busiprof-pro-label"><?php esc_html_e( 'PRO','busiprof' ); ?></span>
            <?php esc_html_e( 'Support for WPML / Polylang','busiprof' ); ?>
        </li>
        <li>
            <span class="busiprof-pro-label"><?php esc_html_e( 'PRO','busiprof' ); ?></span>
            <?php esc_html_e( 'Quality Support','busiprof' ); ?>
        </li>
    </ul>
    <a target="_blank" href="<?php echo esc_url('https://webriti.com/busiprof/');?>" class="busiprof-pro-button button-primary"><?php esc_html_e( 'UPGRADE TO PRO','busiprof' ); ?></a>
    <hr>
</div>
    <?php
    }
}
$wp_customize->add_section( 'busiprof_pro_feature_section' , array(
        'title'      => esc_html__('View PRO Details', 'busiprof'),
        'priority'   => 1,
    ) );

$wp_customize->add_setting(
    'upgrade_pro_feature',
    array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )   
);
$wp_customize->add_control( new Busiprof_WP_Pro__Feature_Customize_Control( $wp_customize, 'upgrade_pro_feature', array(
        'section' => 'busiprof_pro_feature_section',
        'setting' => 'upgrade_pro_feature',
    ))
);
class Busiprof_WP_Feature_document_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
   
     <div class="busiprof-pro-content">
        <ul class="busiprof-pro-des">
            <li> 
                <?php esc_html_e('Pro version theme comes with add social icons and enable / disable the social icons.','busiprof');?>
            </li>
            <li> 
                <?php esc_html_e('Pro version theme comes with add multiple slides in slider and you can select the slider enable / disable option, manage slider animation etc.','busiprof');?>
            </li>
            <li> 
                <?php esc_html_e('Create multiple services and show services with different column layouts like 2c/3c/4c.','busiprof');?>
            </li>
            <li> 
                <?php esc_html_e('Portfolio section, templates , archives with 3 possible layouts.','busiprof');?>
            </li>
            <li> 
                <?php esc_html_e('Pro version theme comes with the show all clients with slider animation on the frontpage using client slider settings.','busiprof');?>
            </li>
            <li> 
                <?php esc_html_e('Theme comes with multiple page settings like about us, service etc.','busiprof');?>
            </li>
            <li> 
                <?php esc_html_e('You can change the URL slug using SEO friendly URL settings','busiprof');?>
            </li>
            <li> 
                <?php esc_html_e('Theme Layout manager will helps you to rearrange the sections.','busiprof');?>
            </li>           
            <li> 
                <?php esc_html_e('Translation ready supporting popular plugins WPML / Polylang.','busiprof');?>
            </li>
            <li> 
                <?php esc_html_e('Dedicated support, various widget and sidebar management.','busiprof');?>
            </li>
        </ul>
     </div>
    <?php
    }
}

$wp_customize->add_setting(
    'doc_Review_feature',
    array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )   
);
$wp_customize->add_control( new Busiprof_WP_Feature_document_Customize_Control( $wp_customize, 'doc_Review_feature', array( 
        'section' => 'busiprof_pro_feature_section',
        'setting' => 'doc_Review_feature',
    ))
);

}
add_action( 'customize_register', 'busiprof_pro_feature_customizer' );