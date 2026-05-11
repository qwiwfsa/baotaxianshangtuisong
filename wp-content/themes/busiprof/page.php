<?php
get_header();
get_template_part('index', 'bannerstrip');
?>
<!-- Blog & Sidebar Section -->
<div id="content">
    <section>
        <div class="container">
            <div class="row">

                <!--Blog Detail-->
                <?php
                if (class_exists('WooCommerce')) {

                    if (is_account_page() || is_cart() || is_checkout()) {
                        echo '<div class="col-md-' . (!is_active_sidebar("woocommerce-1") ? "12" : "8" ) . '">';
                    } else {

                        echo '<div class="col-md-' . (!is_active_sidebar("sidebar-primary") ? "12" : "8" ) . '">';
                    }
                } else {

                    echo '<div class="col-md-' . (!is_active_sidebar("sidebar-primary") ? "12" : "8" ) . '">';
                }
                ?>
                <div class="page-content">
                    <div class="page-content-new">
                    <?php the_post();
                    if(has_post_thumbnail()): ?>
                        <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                            <?php the_post_thumbnail(); ?>
                        </a>
                    <?php endif;
                    echo the_content(); ?>
                    </div>
                <?php
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
                ?>
                </div>
            </div>
            <!--/End of Blog Detail-->

<?php
if (class_exists('WooCommerce')) {

    if (is_account_page() || is_cart() || is_checkout()) {
        get_sidebar('woocommerce');
    } else {

        get_sidebar();
    }
} else {

    get_sidebar();
}
?>
        </div>
</div>
</section>
</div>
<!-- End of Blog & Sidebar Section -->

<div class="clearfix"></div>
<?php
get_footer();
