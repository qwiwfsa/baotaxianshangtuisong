<?php 
/* 	
* Template Name: Home Two
*/
$busiprof_theme_options=busiprof_theme_setup_data();
  $busiprof_is_front_page = wp_parse_args(  get_option( 'busiprof_theme_options', array() ), $busiprof_theme_options );
  
  if (  $busiprof_is_front_page['front_page'] != 'yes' ) {
  	if(is_page()){
		get_template_part('page');
  	}
  	else{
 		get_template_part('index');
 	}
  }
  else {	
  		get_header();
  $busiprof_current_options = wp_parse_args(  get_option( 'busiprof_theme_options', array() ), $busiprof_theme_options );
  		?>
<!-- Slider Section of Index Page -->
<div id="content">
<?php do_action( 'busiprof_home_template_sections', false ); ?>


<!-- footer Section of index blog -->
<?php get_template_part('index', 'blog'); ?>
<?php do_action( 'busiprof_home_tesi_sections', false ); ?>
</div>
<?php get_footer();
}