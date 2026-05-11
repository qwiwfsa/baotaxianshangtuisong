<?php
/**
 * Template part for displaying section of blog content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @subpackage castell
 * @since 1.0
 */

$castell_enable_blog_section = get_theme_mod( 'castell_enable_blog_section', true );
$castell_blog_cat 		= get_theme_mod( 'castell_blog_cat', 'uncategorized' );
if($castell_enable_blog_section == true) {
$castell_blog_title 	= get_theme_mod( 'castell_blog_title', __( 'Latest News', 'castell' ) );
$castell_blog_subtitle 	= get_theme_mod( 'castell_blog_subtitle', __( '', 'castell' ) );
$castell_blog_count 	 = apply_filters( 'castell_blog_count', 3 );

?>
 <!-- blog start-->
    <section class="blog">
        <div class="container">
		 <?php
		if( !empty( $castell_blog_title ) ) {
		?>	
          <div class="section-title">
            <h2><?php echo esc_html( $castell_blog_title ); ?></h2>
            <div class="separator">
              <ul>
                <li></li>
                <li></li>
                <li></li>
              </ul>
            </div>
			<?php if($castell_blog_subtitle) { ?>
				<p><?php echo esc_html( $castell_blog_subtitle ); ?></p>
			<?php } ?>	
        </div>
		<?php } ?>
            <div class="row">
                <div class="blog-slider owl-carousel owl-theme">
					<?php
					if( !empty( $castell_blog_cat ) ) 
					{
					$blog_args = array(
						'post_type' 	 => 'post',
						'category_name'	 => esc_attr( $castell_blog_cat ),
						'posts_per_page' => absint( $castell_blog_count ),
					);

					$blog_query = new WP_Query( $blog_args );
					if( $blog_query->have_posts() ) {
						while( $blog_query->have_posts() ) {
							$blog_query->the_post();
								?>
							   <article class="blog-item blog-1">
								 <?php if( has_post_thumbnail() ) { ?>	
										<div class="post-img">
											<?php the_post_thumbnail(); ?>
											<div class="date">
												<p>
													<span><?php the_time( 'j' ); ?> </span>
													<?php the_time( 'M' ); ?>
												</p>
											</div>
										</div>
									<?php } ?>	
									<ul class="post-meta">
										<?php castell_posted_by(); ?> 
										<?php castell_post_comments();?>
									</ul>
									<div class="post-content pt-4">
										<h5>
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h5>
									</div>
								</article>
                               <?php
							}
						}
						wp_reset_postdata();
					}
					 ?>
                </div>
            </div>
        </div>
    </section>
    <!-- blog end-->
<?php } ?>