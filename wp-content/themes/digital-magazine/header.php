<?php
/**
 * The header for our theme
 *
 * @package Digital Magazine
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'digital-magazine' ); ?></a>
    <?php
    $digital_magazine_preloader_wrap = absint( get_theme_mod( 'digital_magazine_enable_preloader', 0 ) );
    if ( $digital_magazine_preloader_wrap === 1 ) : ?>
        <div id="loader">
            <div class="loader-container">
                <div id="preloader" class="loader-2">
                    <div class="dot"></div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php 
        $digital_magazine_has_header_image = has_header_image();

        if ( $digital_magazine_has_header_image ) {
            $digital_magazine_header_image_url = esc_url( get_header_image() );
        } else {
            $digital_magazine_header_image_url = '';
        }
    ?>
    <header id="masthead" class="site-header">
        <div class="headermain">
            <div class="header-info-box">
                <?php if (get_theme_mod('digital_magazine_show_topbar', 1)) : ?>
                    <div class="top-head">
                        <div class="top-left">
                            <span class="social-media">
                                <?php if ( get_theme_mod( 'digital_magazine_facebook_link_option','#' ) ) : ?>
                                    <a href="<?php echo esc_url( get_theme_mod( 'digital_magazine_facebook_link_option','#' ) ); ?>" target="_blank" rel="noopener noreferrer">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ( get_theme_mod( 'digital_magazine_twitter_link_option','#' ) ) : ?>
                                    <a href="<?php echo esc_url( get_theme_mod( 'digital_magazine_twitter_link_option','#' ) ); ?>" target="_blank" rel="noopener noreferrer">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ( get_theme_mod( 'digital_magazine_google_link_option','#' ) ) : ?>
                                    <a href="<?php echo esc_url( get_theme_mod( 'digital_magazine_google_link_option','#' ) ); ?>" target="_blank" rel="noopener noreferrer">
                                        <i class="fab fa-google"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ( get_theme_mod( 'digital_magazine_youtube_link_option','#' ) ) : ?>
                                    <a href="<?php echo esc_url( get_theme_mod( 'digital_magazine_youtube_link_option','#' ) ); ?>" target="_blank" rel="noopener noreferrer">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="top-right">
                            <?php if ( get_theme_mod( 'digital_magazine_header_info_email','abc1245@example.com' ) ) : ?>
                                <span class="main-box mail">
                                    <a href="mailto:<?php echo esc_attr( get_theme_mod( 'digital_magazine_header_info_email','abc1245@example.com' ) ); ?>">
                                        <i class="<?php echo esc_attr(get_theme_mod('digital_magazine_header_mail_icon','fas fa-envelope')); ?>"></i><span><?php echo esc_html( get_theme_mod( 'digital_magazine_header_info_email','abc1245@example.com' ) ); ?></span>
                                    </a>
                                </span>
                            <?php endif; ?>
                            <?php if (get_theme_mod('digital_magazine_header_info_location','Yourlocation1245')): ?>
                                <div class="location">
                                    <span class="main-head">
                                        <i class="<?php echo esc_attr(get_theme_mod('digital_magazine_header_location_icon','fas fa-location-arrow')); ?>"></i><?php echo esc_html(get_theme_mod('digital_magazine_header_info_location','Yourlocation1245')); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <?php if ( get_theme_mod( 'digital_magazine_header_info_phone','+00 123 456 7890' ) ) : ?>
                                <span class="main-box phone">
                                    <a href="tel:<?php echo esc_attr( get_theme_mod( 'digital_magazine_header_info_phone','+00 123 456 7890' ) ); ?>">
                                        <i class="<?php echo esc_attr(get_theme_mod('digital_magazine_header_phone_icon','fas fa-phone-alt')); ?>"></i><span><?php echo esc_html( get_theme_mod( 'digital_magazine_header_info_phone','+00 123 456 7890' ) ); ?></span>
                                    </a>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="header-menu-box" style="background-image: url('<?php echo $digital_magazine_header_image_url; ?>'); background-repeat: no-repeat; background-size: cover;">
                    <div class="menucontent <?php echo esc_attr( get_theme_mod( 'digital_magazine_enable_sticky_header', false ) ? 'sticky-header' : '' ); ?>">
                        <div class="flex-row">
                            <div class="nav-menu-header-left">
                                <div class="site-branding">
                                    <?php
                                    if ( function_exists( 'the_custom_logo' ) ) {
                                        the_custom_logo();
                                    }
                                    if ( is_front_page() && is_home() ) :
                                        if ( get_theme_mod( 'digital_magazine_site_title_text', true ) ) : ?>
                                            <h1 class="site-title">
                                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                            </h1>
                                        <?php endif;
                                    else :
                                        if ( get_theme_mod( 'digital_magazine_site_title_text', true ) ) : ?>
                                            <p class="site-title">
                                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                            </p>
                                        <?php endif;
                                    endif;
                                    $digital_magazine_description = get_bloginfo( 'description', 'display' );
                                    if ( $digital_magazine_description || is_customize_preview() ) :
                                        if ( get_theme_mod( 'digital_magazine_site_tagline_text', false ) ) : ?>
                                            <p class="site-description"><?php echo esc_html( $digital_magazine_description ); ?></p>
                                        <?php endif;
                                    endif; ?>
                                </div>
                            </div>
                            <div class="nav-menu-header-center">
                                <nav id="site-navigation" class="main-navigation">
                                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                                        <span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'digital-magazine' ); ?></span>
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <?php
                                    wp_nav_menu( array(
                                        'theme_location' => 'menu-1',
                                        'menu_id'        => 'primary-menu',
                                    ) );
                                    ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </header>
</div>