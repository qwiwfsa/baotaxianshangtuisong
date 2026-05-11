<?php
/**
 * Displays top navigation
 *
 * @package SAAS Software
 */
?>
<div class="site-navigation">
    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'saas-software'); ?>" role="navigation">
        <ul class="primary-menu theme-menu">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu(
                    array(
                        'container' => '',
                        'items_wrap' => '%3$s',
                        'theme_location' => 'primary',
                    )
                );
            } else {
                wp_list_pages(
                    array(
                        'match_menu_classes' => true,
                        'show_sub_menu_icons' => true,
                        'title_li' => false,
                        'walker' => new SAAS_Software_Menu_Page(),
                    )
                );
            } ?>
        </ul>
    </nav>
</div>
<div class="navbar-controls twp-hide-js">
    <button type="button" class="navbar-control navbar-control-offcanvas">
        <span class="navbar-control-trigger" tabindex="-1">
            <i class="fas fa-th"></i>
        </span>
    </button>
</div>