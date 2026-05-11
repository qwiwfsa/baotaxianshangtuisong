<?php
/**
 * Displays top navigation
 *
 * @package Charity Zone
 */
?>

<div class="container">
    <div class="row">
        <div class="offset-lg-4 col-lg-6 col-md-8 col-4 align-self-center">
            <div class="toggle-nav mobile-menu">
                <button onclick="charity_zone_openNav()"><i class="fas fa-th"></i></button>
            </div>
            <div id="mySidenav" class="nav sidenav">
                <nav id="site-navigation" class="main-navigation navbar navbar-expand-xl" aria-label="<?php esc_attr_e( 'Top Menu', 'charity-zone' ); ?>">
                    <?php {
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_class'     => 'menu', 
                                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'fallback_cb' => 'wp_page_menu',
                            )
                        );
                    } ?>
                </nav>
                <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="charity_zone_closeNav()"><i class="fas fa-times"></i></a>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-8 donate-btn align-self-center">
            <?php if(get_theme_mod('charity_zone_donate_button_text') != '' || get_theme_mod('charity_zone_donate_button_url') != ''){ ?>
                <a href="<?php echo esc_url(get_theme_mod('charity_zone_donate_button_url','')); ?>"><?php echo esc_html(get_theme_mod('charity_zone_donate_button_text','')); ?></a>
            <?php }?>
        </div>
    </div>
</div>
