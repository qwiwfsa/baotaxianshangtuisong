<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>	
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
       <?php 
         if ( is_singular() && pings_open( get_queried_object() ) ) : 
           echo '<link rel="pingback" href=" '.esc_url(get_bloginfo( 'pingback_url' )).' ">';
        endif;
        wp_head();
        $busiprof_current_options = wp_parse_args(get_option('busiprof_theme_options', array()), busiprof_theme_setup_data());
        ?>	
    </head>
    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>	
        <div id="page" class="site">
            <a class="skip-link busiprof-screen-reader" href="#content"><?php esc_html_e('Skip to content', 'busiprof'); ?></a>
            <!-- Navbar -->	
            <nav class="navbar navbar-default navbar-expand-lg">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <?php
                        if (($busiprof_current_options['enable_logo_text'] == true) && ($busiprof_current_options['enable_logo_text'] != 'nomorenow') && (!has_custom_logo())) {
                            echo '<a class="navbar-brand" href="' . esc_url(home_url('/')) . '" class="brand">';
                            bloginfo('name');
                            echo '</a>';
                        } elseif (($busiprof_current_options['upload_image'] != "") && ($busiprof_current_options['enable_logo_text'] != 'nomorenow') && (!has_custom_logo())) {
                            ?>
                            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" class="brand">
                                <img alt="<?php bloginfo("name"); ?>" src="<?php echo (esc_url($busiprof_current_options['upload_image'])) ? $busiprof_current_options['upload_image'] : '#'; ?>" 
                                     alt="<?php bloginfo("name"); ?>"
                                     class="logo_imgae" style="width:<?php echo esc_attr($busiprof_current_options['width']) . 'px'; ?>; height:<?php echo esc_attr($busiprof_current_options['height']) . 'px'; ?>;">
                            </a>
                            <?php
                        } else {
                            $busiprof_current_options['enable_logo_text'] = 'nomorenow';
                            update_option('busiprof_theme_options', $busiprof_current_options);
                            if (has_custom_logo()):
                                echo '<span class="navbar-brand">';
                                the_custom_logo();
                                echo '</span>';
                            endif;
                            ?>
                            <div class="custom-logo-link-url">
                                <h1 class="site-title"><a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" ><?php bloginfo('name'); ?></a>
                                </h1>
                                <?php
                                $busiprof_description = get_bloginfo('description', 'display');
                                if ($busiprof_description || is_customize_preview()) :
                                    ?>
                                    <p class="site-description"><?php echo $busiprof_description; ?></p>
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                        ?>	
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                       <span class="navbar-toggler-icon"></span>
                     </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'container' => 'nav-collapse collapse navbar-inverse-collapse',
                            'menu_class' => 'nav navbar-nav navbar-right ms-auto',
                            'fallback_cb' => 'busiprof_fallback_page_menu',
                            'walker' => new Busiprof_nav_walker())
                        );
                        ?>			
                    </div>
                </div>
            </nav>	
            <!-- End of Navbar -->