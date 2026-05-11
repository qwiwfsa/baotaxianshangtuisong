<?php
$busiprof_current_options = wp_parse_args(  get_option( 'busiprof_theme_options', array() ), busiprof_theme_setup_data() );
 ?>
<!-- Page Title -->
<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="page-title">
					<h2><?php 
						if( is_archive() ){ 
						
						if( is_shop() ){
			
						printf( esc_html__( '%1$s %2$s', 'busiprof' ), wp_kses_post($busiprof_current_options['shop_prefix']), single_tag_title( '', false ));
						} elseif(is_archive()){
						
							the_archive_title(); 
						}
							
						}
						elseif( is_front_page() ){
							esc_html_e('Home', 'busiprof' );	
						}
						elseif(is_home()){
							echo esc_html(single_post_title());
						}                     
						elseif( is_search() ){
							printf( esc_html__( '%1$s %2$s', 'busiprof' ), wp_kses_post($busiprof_current_options['search_prefix']), get_search_query() );
						}
						elseif( is_404() ){
							printf( esc_html($busiprof_current_options['404_prefix']));
						}						
						else{ 						
							the_title(); 
						}  
						?></h2>
				</div>
			</div>
			<div class="col-md-6">
				<ul class="page-breadcrumb">
					<?php if (function_exists('busiprof_custom_breadcrumbs')) busiprof_custom_breadcrumbs();?>
				</ul>
			</div>
		</div>
	</div>	
</section>
<!-- End of Page Title -->
<div class="clearfix"></div>