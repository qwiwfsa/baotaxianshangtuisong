<?php
get_header(); ?>

<!--Page Title-->
<?php get_template_part( 'breadcrumb' ); ?>
<!--/End of Page Title -->

<div class="clearfix"></div>

<?php
	global $woocommerce;
	$shop_page_id        = get_option( 'woocommerce_shop_page_id' );
	$page_sidebar_layout = get_post_meta( $shop_page_id, '_sidebar_layout', true );

	$awpbusinesspress_archive_blog_pages_layout = get_theme_mod( 'awpbusinesspress_archive_blog_pages_layout', 'awpbusinesspress_right_sidebar' );
?>

	<!-- Blog & Sidebar Section archive.php -->
	<section id="main-content" class="section site-content theme-grey">
		<div class="container top-margin m-top-30" id="content">
			<div class="row">
				<!--Side bar-->
				<?php if ( $awpbusinesspress_archive_blog_pages_layout == 'awpbusinesspress_left_sidebar' || ! $awpbusinesspress_archive_blog_pages_layout == 'awpbusinesspress_no_sidebar' ) : ?>
					<?php get_sidebar( 'woocommerce' ); ?>
				<?php endif; ?>

				<?php if ( $awpbusinesspress_archive_blog_pages_layout == 'awpbusinesspress_no_sidebar' ) : ?>
				<div class="col-lg-12 col-md-12 col-sm-12">	
				<?php else : ?>
				<div class="col-lg-<?php echo ( ! is_active_sidebar( 'woocommerce' ) ? '12' : '8' ); ?> col-md-<?php echo ( ! is_active_sidebar( 'woocommerce' ) ? '12' : '8' ); ?> col-sm-12">
				<?php endif; ?>			

				<!--Blog Section-->

					<div class="blog">
						<?php
							woocommerce_content();
						?>
					</div>
				</div>
				<!--/Side Bar-->
				<?php if ( $awpbusinesspress_archive_blog_pages_layout == 'awpbusinesspress_right_sidebar' || ! $awpbusinesspress_archive_blog_pages_layout == 'awpbusinesspress_no_sidebar' ) : ?>
					<?php get_sidebar( 'woocommerce' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<!-- /Blog & Sidebar Section -->

<?php get_footer(); 
