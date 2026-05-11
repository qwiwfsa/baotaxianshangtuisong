<?php
//about theme info
add_action( 'admin_menu', 'skt_enterprise_abouttheme' );
function skt_enterprise_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'skt-enterprise'), esc_html__('About Theme', 'skt-enterprise'), 'edit_theme_options', 'skt_enterprise_guide', 'skt_enterprise_mostrar_guide');   
} 
//guidline for about theme
function skt_enterprise_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_html_e('Theme Information', 'skt-enterprise'); ?>
		   </div>
          <p><?php esc_html_e('SKT Enterprise is a free enterprise WordPress theme based on Elementor page builder. It uses SKT Templates which also come with around 200 free other templates and landing pages. Simple and easy to use and customizable and flexible this enteprise template can be used for any venture industry pursuit endeavour undertaking operation task corporation establishment shop program and business. This is a good template for startups, businesses which are starting now into servicing or product based too. Any other company or conglomerate can also use this as a base theme to create a large enterprise website.','skt-enterprise'); ?></p>
          <a href="<?php echo esc_url(SKT_ENTERPRISE_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(SKT_ENTERPRISE_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'skt-enterprise'); ?></a> | 
				<a href="<?php echo esc_url(SKT_ENTERPRISE_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'skt-enterprise'); ?></a> | 
				<a href="<?php echo esc_url(SKT_ENTERPRISE_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'skt-enterprise'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(SKT_ENTERPRISE_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>