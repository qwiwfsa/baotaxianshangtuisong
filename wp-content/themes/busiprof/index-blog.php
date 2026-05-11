<?php  $busiprof_current_options = wp_parse_args(  get_option( 'busiprof_theme_options', array() ), busiprof_theme_setup_data() ); 
if( $busiprof_current_options['home_recentblog_section_enabled']=='on' ) { ?>
<!-- Testimonial & Blog Section -->
<section id="section" class="home-post-latest">
	<div class="container">	
		<!-- Section Title -->
		<div class="row">
		<?php
		if( $busiprof_current_options['recent_blog_title'] != '' || $busiprof_current_options['recent_blog_description'] !='' ) { ?>
			<div class="col-md-12">
				<div class="section-title">
					<?php
					if( $busiprof_current_options['recent_blog_title'] != '' ) { ?>
					<h1 class="section-heading"><?php echo wp_kses_post($busiprof_current_options['recent_blog_title']);?></h1>
					<?php } if( $busiprof_current_options['recent_blog_description'] !='')  { ?>
					<p><?php echo esc_html($busiprof_current_options['recent_blog_description']);?></p>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
		</div>
		<!-- /Section Title -->	
			
		<!-- Blog Post -->				
		<div class="row">
		<?php 	$busiprof_args = array( 'post_type' => 'post','posts_per_page' => 4,'post__not_in'=>get_option("sticky_posts")) ; 	
						query_posts( $busiprof_args );
						if(query_posts( $busiprof_args ))
					{	
						while(have_posts()):the_post();
					{ ?>
			<div class="col-md-6">
				<div class="post"> 
					<div class="media"> 
						<figure class="post-thumbnail"><?php $busiprof_defalt_arg =array('class' => "");?>
							<?php if(has_post_thumbnail()){?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('',$busiprof_defalt_arg);?></a>
							<?php } ?>
						</figure> 
						<div class="bp-entry-meta <?php if(!has_post_thumbnail()){ echo 'img-remove';} ?>">
                                <span class="bp-cat-links">
                                 <?php the_category(' '); ?>
                                </span>
                        </div>
						<div class="media-body">
							<?php if( $busiprof_current_options['home_recentblog_meta_enable']=='on' ) { ?>
							<div class="entry-meta">
							<span class="entry-date"><a href="<?php echo esc_url( home_url('/') ); ?><?php echo esc_html(date( 'Y/m' , strtotime( get_the_date() )) ); ?>"><time datetime=""><?php echo esc_html(get_the_date());?></time></a></span>
							<span class="comments-link"><?php  comments_popup_link( esc_html__( 'Leave a Reply', 'busiprof' ) ); ?></span>
							<?php if( get_the_tags() ) { ?>
							<span class="tag-links"><?php the_tags('', ', ', ''); ?></span>
							<?php } ?>
							</div>
							<?php } ?>

							
							<div class="entry-header">
								<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
							</div>
							<div class="entry-content">
								<p><?php the_content(__('Read More','busiprof')); ?></p>
							</div>
						</div> 
					</div>
				</div>
			</div>
			<?php } endwhile; } ?>
		</div>
		<!-- /Blog Post -->
			
			
	</div>
</section>
<!-- End of Testimonial & Blog Section -->
<div class="clearfix"></div>
<?php }