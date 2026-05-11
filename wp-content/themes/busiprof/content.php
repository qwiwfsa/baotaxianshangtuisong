<article <?php post_class('post'); ?>> 
	<span class="site-author">
		<figure class="avatar">
		<?php $busiprof_author_id=$post->post_author; ?>
			<a data-tip="<?php the_author() ;?>" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>" data-toggle="tooltip" title="<?php echo esc_attr(the_author_meta( 'display_name' , $busiprof_author_id )); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></a>
		</figure>
	</span>
		<header class="entry-header">
			<?php 	
				if ( is_single() ) :
				
				the_title('<h3 class="entry-title">', '</h3>' );
				
				else:
				
				the_title( sprintf( '<h3 class="entry-title"><a href="%s" >', esc_url( get_permalink() ) ), '</a></h3>' ); 
				
				endif; 
				?>
		</header>
	
		<div class="entry-meta">
		
			<span class="entry-date"><a href="<?php echo esc_url( home_url('/') ); ?><?php echo esc_html(date( 'Y/m' , strtotime( get_the_date() )) ); ?>"><time datetime=""><?php the_time('M j,Y');?></time></a></span>
			
			<span class="comments-link"><?php comments_popup_link( esc_html__('Leave a comment', 'busiprof' ) ); ?></span>
			
			<?php if( get_the_tags() ) { ?>
			<span class="tag-links"><?php the_tags('', ', ', ''); ?></span>
			<?php } ?>
		</div>
		<?php
		if(has_post_thumbnail()){
			if ( is_single() ) {
				the_post_thumbnail();
			}
			else
			{ ?>
				<a href="<?php the_permalink(); ?>" class="post-thumbnail" ><?php the_post_thumbnail(); ?></a>
			<?php	
			}	
		}?>
		<div class="bp-entry-meta <?php if(!has_post_thumbnail()){ echo 'img-remove';} ?>">
                <span class="bp-cat-links">
                 <?php the_category(' '); ?>
                </span>
        </div>
	<div class="entry-content">
		<?php the_content( esc_html__('Read More','busiprof') ); ?>
	</div>
</article>