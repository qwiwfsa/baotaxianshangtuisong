<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Advance Blogging
 */
get_header(); ?>

<main id="main" role="main" class="middle-align py-4">
	<div class="container">
		<?php
        $advance_blogging_single_post_sidebar = get_theme_mod( 'advance_blogging_single_post_sidebar','Right Sidebar');
        if($advance_blogging_single_post_sidebar == 'Left Sidebar'){ ?>
            <div class="row">
				<div class="col-lg-4 col-md-4"><?php get_sidebar();?></div>
				<div class="col-lg-8 col-md-8" class="content-aa">
					<?php if (get_theme_mod('advance_blogging_single_post_breadcrumb',true) != ''){ ?>
			            <div class="bradcrumbs">
			                <?php advance_blogging_the_breadcrumb(); ?>
			            </div>
			        <?php }?>
					<?php while ( have_posts() ) : the_post(); 
						get_template_part( 'template-parts/single-post');
					endwhile; // end of the loop. ?>
		       	</div>
		    </div>
	    <?php }else if($advance_blogging_single_post_sidebar == 'Right Sidebar'){ ?>
	    	<div class="row">
		       	<div class="col-lg-8 col-md-8" class="content-aa">
		       		<?php if (get_theme_mod('advance_blogging_single_post_breadcrumb',true) != ''){ ?>
			            <div class="bradcrumbs">
			                <?php advance_blogging_the_breadcrumb(); ?>
			            </div>
			        <?php }?>
					<?php while ( have_posts() ) : the_post(); 
						get_template_part( 'template-parts/single-post');
					endwhile; // end of the loop. ?>
		       	</div>
				<div class="col-lg-4 col-md-4"><?php get_sidebar();?></div>
			</div>
		<?php }else if($advance_blogging_single_post_sidebar == 'One Column'){ ?>
			<div class="content-aa">
				<?php if (get_theme_mod('advance_blogging_single_post_breadcrumb',true) != ''){ ?>
			            <div class="bradcrumbs">
			                <?php advance_blogging_the_breadcrumb(); ?>
			            </div>
			    <?php }?>
				<?php while ( have_posts() ) : the_post(); 
					get_template_part( 'template-parts/single-post');
				endwhile; // end of the loop. ?>
	       	</div>
	    <?php }else if($advance_blogging_single_post_sidebar == 'Three Columns'){ ?>
	    	<div class="row">
		       	<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
		       	<div class="col-lg-6 col-md-6" class="content-aa">
		       		<?php if (get_theme_mod('advance_blogging_single_post_breadcrumb',true) != ''){ ?>
			            <div class="bradcrumbs">
			                <?php advance_blogging_the_breadcrumb(); ?>
			            </div>
			        <?php }?>
					<?php while ( have_posts() ) : the_post(); 
						get_template_part( 'template-parts/single-post');
					endwhile; // end of the loop. ?>
		       	</div>
				<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar( 'sidebar-2' ); ?></div>
			</div>
		<?php }else if($advance_blogging_single_post_sidebar == 'Four Columns'){ ?>
			<div class="row">
				<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar( 'sidebar-1' ); ?></div>
		       	<div class="col-lg-3 col-md-3" class="content-aa">
		       		<?php if (get_theme_mod('advance_blogging_single_post_breadcrumb',true) != ''){ ?>
			            <div class="bradcrumbs">
			                <?php advance_blogging_the_breadcrumb(); ?>
			            </div>
			        <?php }?>
					<?php while ( have_posts() ) : the_post(); 
						get_template_part( 'template-parts/single-post');
					endwhile; // end of the loop. ?>
		       	</div>
				<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar( 'sidebar-2' ); ?></div>
				<div id="sidebar" class="col-lg-3 col-md-3"><?php dynamic_sidebar( 'sidebar-3' ); ?></div>
			</div>
        <?php }else if($advance_blogging_single_post_sidebar == 'Grid Layout'){ ?>
        	<div class="row">
				<div class="col-lg-8 col-md-8" class="content-aa">
					<?php if (get_theme_mod('advance_blogging_single_post_breadcrumb',true) != ''){ ?>
			            <div class="bradcrumbs">
			                <?php advance_blogging_the_breadcrumb(); ?>
			            </div>
			        <?php }?>
					<?php while ( have_posts() ) : the_post(); 
						get_template_part( 'template-parts/single-post');
					endwhile; // end of the loop. ?>
		       	</div>
				<div class="col-lg-4 col-md-4"><?php get_sidebar();?></div>
			</div>
		<?php }else {?>
			<div class="row">
		       	<div class="col-lg-8 col-md-8" class="content-aa">
		       		<?php if (get_theme_mod('advance_blogging_single_post_breadcrumb',true) != ''){ ?>
			            <div class="bradcrumbs">
			                <?php advance_blogging_the_breadcrumb(); ?>
			            </div>
			        <?php }?>
					<?php while ( have_posts() ) : the_post(); 
						get_template_part( 'template-parts/single-post');
					endwhile; // end of the loop. ?>
		       	</div>
				<div class="col-lg-4 col-md-4"><?php get_sidebar();?></div>
			</div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</main>

<?php get_footer(); ?>