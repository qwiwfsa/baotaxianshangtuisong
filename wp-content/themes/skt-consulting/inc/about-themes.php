<?php
//about theme info
add_action( 'admin_menu', 'skt_consulting_abouttheme' );
function skt_consulting_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'skt-consulting'), esc_html__('About Theme', 'skt-consulting'), 'edit_theme_options', 'skt_consulting_guide', 'skt_consulting_mostrar_guide');   
} 
//guidline for about theme
function skt_consulting_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_attr_e('Theme Information', 'skt-consulting'); ?>
		   </div>
          <p><?php esc_html_e('SKT Consulting is a consultant advice giving template suited for expert discussion of business, medical, enterprise, corporate, sales, IT, software, HR, CA, accountant, lawyer, doctor, reiki, healing, agency and other types of consultation. Suited for start ups, medium and large organization websites. Clean, Flexible, Simple, WooCommerce and Gutenberg compatible and page builders friendly. It is multipurpose and comes with a ready to import Elementor template plugin as add on which allows to import 63+ design templates for making use in home and other inner pages. Use it to create any type of business, personal, blog and eCommerce website. It is fast, flexible, simple and fully customizable.','skt-consulting'); ?></p>
		  <a href="<?php echo esc_url(SKT_CONSULTING_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(SKT_CONSULTING_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'skt-consulting'); ?></a> | 
				<a href="<?php echo esc_url(SKT_CONSULTING_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'skt-consulting'); ?></a> | 
				<a href="<?php echo esc_url(SKT_CONSULTING_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'skt-consulting'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(SKT_CONSULTING_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>