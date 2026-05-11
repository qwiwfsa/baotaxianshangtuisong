<?php
if ( ! function_exists( 'appointment_aside_meta_content' ) ) :

		function appointment_aside_meta_content()
		{
		$appointment_options=appointment_theme_setup_data();
		$news_setting = wp_parse_args(  get_option( 'appointment_options', array() ), $appointment_options );
		if($news_setting['home_meta_section_settings'] == 0 ) { ?>
	    <!--show date of post-->
		<aside class="blog-post-date-area">
			<div class="date"> <div class="month-year"><?php echo esc_html(get_the_date()); ?></div></div>
			<div class="comment"><a href="<?php the_permalink(); ?>"><i class="fa fa-comments"></i><?php comments_number( '0', '1', '%' ); ?></a></div>
		</aside>
		<?php }  } endif;
if ( ! function_exists( 'appointment_post_meta_content' ) ) :
function appointment_post_meta_content()
{ 
			$appointment_options=appointment_theme_setup_data();
			$news_setting = wp_parse_args(  get_option( 'appointment_options', array() ), $appointment_options );
			if($news_setting['home_meta_section_settings'] == 0 ) { ?>
			<div class="blog-post-lg">
				<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '40'); ?></a>
				<?php esc_html_e('By','appointment');?><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php echo esc_html( get_the_author());?></a>
				<?php 	$tag_list = get_the_tag_list();
					if(!empty($tag_list)) { ?>
				<div class="blog-tags-lg"><i class="fa fa-tags"></i><?php the_tags('', ', ', ''); ?></div>
				<?php } ?>
			</div>
			<?php }  
} endif; 

// this functions accepts two parameters first is the preset size of the image and second  is for additional classes, you can also add yours 
if(!function_exists( 'appointment_post_thumbnail')) : 
function appointment_post_thumbnail($preset,$class){
if(has_post_thumbnail()){ 
 $defalt_arg =array('class' => $class); ?>
			<div class="blog-lg-box">
				<a class ="img-fluid" <?php if( !is_single() ){ ?> href="<?php the_permalink(); ?>" <?php } ?> title="<?php the_title_attribute(); ?>" >
				<?php the_post_thumbnail($preset, $defalt_arg); ?>
                                </a>
			</div>
			<?php } }endif;

// This Function Check whether Sidebar active or Not
if(!function_exists( 'appointment_post_layout_class' )) :
function appointment_post_layout_class(){
	if(is_active_sidebar('sidebar-1'))
		{ echo 'col-md-8'; } 
	else 
		{ echo 'col-md-12'; }  
} endif; 
//Edit link 
if (!function_exists('appointment_edit_link')) :
    function appointment_edit_link($view = 'default')
    {
        global $post;
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'appointment'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link"><i class="fa fa-edit"></i>',
                '</span>'
            );
    } 
endif;
/* Related Post section */
function appointment_related_post() { 
 if( get_post_type() != 'post' ) return;
 $related_post_enable = get_theme_mod('related_post_enable',true);
 if( !$related_post_enable ) return; 
		 $related_posts_title = get_theme_mod('single_post_related_posts_title','Related News');			     
		// Get the current post's ID
		$current_post_id = get_the_ID();
		// Get the categories of the current post
		$categories = get_the_category($current_post_id);
		if ($categories!=null) {
		$category_ids = array();
		foreach ($categories as $category) {
		$category_ids[] = $category->term_id;
		}
		// Query related posts based on the category IDs
		$args = array(
		'post__not_in' => array($current_post_id), // Exclude the current post
		'category__in' => $category_ids, // Include posts from the same categories
		'posts_per_page' => 3, // Adjust the number of related posts to display
		);
		$related_posts_query = new WP_Query($args); 
		// Display related posts
		if (!$related_posts_query->have_posts()) return; ?>
		<div class="related-post-section">
		 <div class="row">	
		<?php if($related_posts_title ) echo '<div class="col-md-12"><div class="related-post-title"><h3>' .esc_html( $related_posts_title ). '</h3></div></div>';	
		while ($related_posts_query->have_posts()) {
		$related_posts_query->the_post();
		// Display related post content, title, etc. ?>
		<div class="col-md-4 col-sm-6 col-xs-12 pull-left related-post-area">
		<div class="related-post-image">
		<?php 
		if(has_post_thumbnail()){   the_post_thumbnail('full',array('class'=>' img-responsive img-fluid')); } ?>
		</div>
		<div class="related-post-wrapper">
		<div class="related-blog-post-sm">
		<div class="blog-posted-sm">
		<i class="fa-regular fa-calendar" aria-hidden="true"></i><a href="<?php the_permalink();?>"><?php echo esc_html(get_the_date());?></a>
		</div>
		<div class="blog-comment-sm"><i class="fa-regular fa-comments" aria-hidden="true"></i><a href="<?php the_permalink(); ?>"><?php comments_number( '0', '1', '%' ); ?></a></div>
		</div>													
		<div class="related-post-caption">
		<h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
		</div>
		<div class="related-blog-post-author">
		<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '40'); ?></a>
		<div class="blog-admin-lg"><?php esc_html_e('By ','appointment');?><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php echo esc_html( get_the_author());?></a></div>
		</div>
		</div>
		</div>
		<?php } ?>
		</div>
        </div> <!-- closing of related post section -->
		<?php }
		// Reset the post data
		wp_reset_postdata();
		 ?>
<?php   } add_action('appointment_related_post_hook','appointment_related_post');?>