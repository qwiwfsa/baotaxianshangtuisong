<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Advance Blogging
 */
get_header(); ?>

<main id="main" role="main" class="content-aa">
	<div class="container">
        <div class="page-content text-center py-5">
			<?php if(get_theme_mod('advance_blogging_404_title','404 Not Found')){ ?>	
				<h1><?php echo esc_html( get_theme_mod('advance_blogging_404_title',__('404 Not Found', 'advance-blogging' )) ); ?></h1>
			<?php }?>
			<?php if(get_theme_mod('advance_blogging_404_text','Looks like you have taken a wrong turn. Dont worry it happens to the best of us.')){ ?>
				<p class="text-404 mb-2"><?php echo esc_html( get_theme_mod('advance_blogging_404_text',__('Looks like you have taken a wrong turn. Dont worry it happens to the best of us.', 'advance-blogging' )) ); ?></p>
			<?php }?>
			<?php if(get_theme_mod('advance_blogging_404_button_text','Back to Home Page')){ ?>
				<div class="read-moresec pt-3 pb-4">
	           		<a href="<?php echo esc_url( home_url() ); ?>" class="button hvr-sweep-to-right p-2"><?php echo esc_html( get_theme_mod('advance_blogging_404_button_text',__('Back to Home Page', 'advance-blogging' )) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('advance_blogging_404_button_text',__('Back to Home Page', 'advance-blogging' )) ); ?></span></a>
				</div>
				<div class="clearfix"></div>
			<?php }?>
        </div>
	</div>
</main>
	
<?php get_footer(); ?>