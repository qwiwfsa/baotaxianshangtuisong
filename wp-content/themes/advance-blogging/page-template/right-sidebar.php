<?php
/**
 * Template Name:Page with Right Sidebar
 */
get_header(); ?>

<?php do_action( 'advance_blogging_header_page_right' ); ?>

<div class="container">
    <main id="main" role="main" class="middle-align row py-5">
		<div class="col-lg-8 col-md-8" class="content-aa" >
            <?php while ( have_posts() ) : the_post(); ?>
               <?php the_post_thumbnail(); ?>
                <h1><?php the_title(); ?></h1>
                <div class="entry-content"><?php the_content();?></div>
            <?php endwhile; // end of the loop. ?>
            <?php
                //If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template();
            ?>
            <div class="clear"></div> 
        </div>
        <div class="col-lg-4 col-md-4" id="sidebar">
			<?php dynamic_sidebar('sidebar-2'); ?>
		</div>        
        <div class="clearfix"></div>
    </main>
</div>

<?php do_action( 'advance_blogging_footer_page_right' ); ?>

<?php get_footer(); ?>