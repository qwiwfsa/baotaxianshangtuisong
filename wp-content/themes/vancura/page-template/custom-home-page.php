<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<main id="wp-toolbar" role="main">
	<?php do_action( 'vancura_above_slider' ); ?>

	<?php if( get_theme_mod('vancura_slider_hide_show',false) != false){ ?>
		<?php
    $container_type = get_theme_mod('vancura_boxfull_width', ''); // Get the selected container type
	// Define the default container class
	$container_class = '';
	
	// If container or container-fluid is selected, update the container class
	if ($container_type === 'container' || $container_type === 'container-fluid') {
		$container_class = $container_type;
	}
    ?>
	<div class="<?php echo esc_attr($container_class); ?>">
		<section id="slider">
		  	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
			    <?php $slider_pages = array();
			    $slider =  get_theme_mod('vancura_slider_number');
			      	for ( $count = 1; $count <= $slider; $count++ ) {
				        $mod = intval( get_theme_mod( 'vancura_slider' . $count ));
				        if ( 'page-none-selected' != $mod ) {
				          $slider_pages[] = $mod;
				        }
			      	}
			      	if( !empty($slider_pages) ) :
			        $args = array(
			          	'post_type' => 'page',
			          	'post__in' => $slider_pages,
			          	'orderby' => 'post__in'
			        );
			        $query = new WP_Query( $args );
			        if ( $query->have_posts() ) :
			          $i = 1;
			    ?>     
			    <div class="carousel-inner" role="listbox">
			      	<?php  while ( $query->have_posts() ) : $query->the_post(); ?>
			        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
			          	<a href="<?php echo esc_url( get_permalink() );?>">
			          		<?php if(has_post_thumbnail()) {?>
								<img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php the_title_attribute(); ?>" />
            				<?php } else {?>
            					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/slider.png" alt="<?php the_title_attribute(); ?> "/>
            				<?php }?>
			          	</a>
						<?php
							$vancura_slider_effect = get_theme_mod('vancura_slider_effect', '')
						?>
			          	<div class="carousel-caption <?php echo ($vancura_slider_effect); ?>">
				            <div class="inner_carousel">
				              	<h1><?php the_title(); ?></h1>
				              	<p><?php $vancura_excerpt = get_the_excerpt(); echo esc_html( vancura_string_limit_words( $vancura_excerpt, esc_attr(get_theme_mod('vancura_slider_excerpt_length','15') ) )); ?></p>
				            </div>
				            <div class="read-btn">
			            		<a href="<?php the_permalink(); ?>"><?php esc_html_e('EXPLORE MORE','vancura'); ?><i class="fas fa-arrow-right"></i><span class="screen-reader-text"><?php the_title(); ?></span></a>
					       	</div>
			          	</div>
			        </div>
			      	<?php $i++; endwhile; 
			      	wp_reset_postdata();?>
			    </div>
			    <?php else : ?>
			    <div class="no-postfound"></div>
			      <?php endif;
			    endif;?>
			    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		      		<span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
		      		<span class="screen-reader-text"><?php esc_html_e( 'Previous','vancura' );?></span>
			    </a>
			    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		      		<span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
		      		<span class="screen-reader-text"><?php esc_html_e( 'Next','vancura' );?></span>
			    </a>
		  	</div>  
		  	<div class="clearfix"></div>
		</section>
	<?php }?>

	<?php do_action('vancura_below_slider'); ?>

	<?php /*--Our Services Section --*/?>
	<?php
    $container_type = get_theme_mod('vancura_boxfull_width', ''); // Get the selected container type
	// Define the default container class
	$container_class = 'container';
	
	// If container or container-fluid is selected, update the container class
	if ($container_type === 'container' || $container_type === 'container-fluid') {
		$container_class = $container_type;
	}
    ?>
	<div class="<?php echo esc_attr($container_class); ?>">
	<?php if( get_theme_mod('vancura_service_cat1') != '' || get_theme_mod('vancura_title_page') != '' || get_theme_mod('vancura_service_cat2') != '' ){ ?>
		<section id="our_service">
				<div class="service-box">
		            <div class="row">
	          			<div class="col-lg-4 col-md-4">
				      		<?php $catData1=  get_theme_mod('vancura_service_cat1'); 
							if($catData1){ 
								$args = array(
									'post_type' => 'post',
									'category_name' => esc_html($catData1 ,'vancura'),
						          'posts_per_page' => get_theme_mod('vancura_service_number')
						        );
						        $i=1;
				      		$page_query = new WP_Query( $args);?>
			        		<?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
								<div class="service-cat1">	
			        				<div class="row">
							      		<div class="col-lg-9 col-md-8">
									      	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									      	<p><?php $excerpt = get_the_excerpt(); echo esc_html( vancura_string_limit_words( $excerpt,10 ) ); ?></p>
			          					</div>
				        				<div class="col-lg-3 col-md-4">
								      		<?php the_post_thumbnail(); ?>
								      	</div>
								    </div>
		          				</div>
				          		<?php $i++; endwhile; 
				          	wp_reset_postdata();
				          	}?>
				        </div>
			          	<div class="col-lg-4 col-md-4">
							<?php 
					        $service_pages = array();
						        $mod = intval( get_theme_mod( 'vancura_title_page' ));
						        if ( 'page-none-selected' != $mod ) {
						          $service_pages[] = $mod;
						        }
						      	if( !empty($service_pages) ) :
						        $args = array(
						          	'post_type' => 'page',
						          	'post__in' => $service_pages,
						          	'orderby' => 'post__in'
						        );
						        $query = new WP_Query( $args );
						        if ( $query->have_posts() ) :
						          $i = 1;
						     
					            while ( $query->have_posts() ) : $query->the_post(); ?>
					            	<div class="service-headpage">
						            	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						            	<div class="service-img">
							            	<?php if(has_post_thumbnail()) { ?>
							            		<?php the_post_thumbnail(); ?>
							            	<?php } ?>
							            </div>
						            </div>
					            <?php endwhile;  
					            wp_reset_postdata();?>
						    <?php else : ?>
						    <div class="no-postfound"></div>
						      <?php endif;
						    endif;?>  
					    </div>
			          	<div class="col-lg-4 col-md-4">
			          		<?php $catData1=  get_theme_mod('vancura_service_cat2'); 
							if($catData1){ 
								$args = array(
									'post_type' => 'post',
									'category_name' => esc_html($catData1 ,'vancura'),
						          'posts_per_page' => get_theme_mod('vancura_service_number')
						        );
						        $i=1;
				      		$page_query = new WP_Query($args);?>
				        		<?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>	
				        			<div class="service-cat2">
								      	<div class="row">
					        				<div class="col-lg-3 col-md-4">
									      		<?php the_post_thumbnail(); ?>
									      	</div>
									      	<div class="col-lg-9 col-md-8">
										      	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										      	<p><?php $excerpt = get_the_excerpt(); echo esc_html( vancura_string_limit_words( $excerpt,10 ) ); ?></p>
					          				</div>
				          				</div>
				          			</div>
				          		<?php $i++; endwhile; 
				          	wp_reset_postdata();
				          	}?>
			          	</div>
		      		</div>
				</div>
				<div class="clearfix"></div>
		</section>
	<?php }?>

	<?php do_action('vancura_below_service_section'); ?>

	<div class="container lz-content">
	  	<?php while ( have_posts() ) : the_post(); ?>
	        <?php the_content(); ?>
	    <?php endwhile; // end of the loop. ?>
	</div>
</main>

<?php get_footer(); ?>