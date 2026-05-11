<?php
/**
 * Getting started template
 */
?>
<div id="getting_started" class="busiprof-tab-pane active">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<div class="busiprof-tab-pane-half busiprof-tab-pane-first-half">
					<h3><?php esc_html_e( "Recommended Plugins", 'busiprof' ); ?></h3>
					<div style="border-top: 1px solid #eaeaea;">
						<p style="margin-top: 16px;">
							<?php esc_html_e( 'To take full advanctage of the theme features you need to install recommended plugins.', 'busiprof' ); ?>
						</p>
						<p><a target="_self" href="#recommended_actions" class="busiprof-custom-class"><?php esc_html_e( 'Click here','busiprof');?></a></p>
					</div>
				</div>
				<div class="busiprof-tab-pane-half busiprof-tab-pane-first-half">
					<h3><?php esc_html_e( "Start Customizing", 'busiprof' ); ?></h3>
					<div style="border-top: 1px solid #eaeaea;">
						<p style="margin-top: 16px;">
							<?php esc_html_e( 'After activating recommended plugins , now you can start customization.', 'busiprof' ); ?>
						</p>
						<p><a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer','busiprof');?></a></p>
					</div>
				</div>
				<div class="busiprof-tab-pane-half busiprof-tab-pane-first-half">
					<h3><?php esc_html_e( "Documentation", 'busiprof' ); ?></h3>
					<div style="border-top: 1px solid #eaeaea;">
						<p style="margin-top: 16px;">
							<?php esc_html_e( 'Browse the documention for the detailed information regarding this theme.', 'busiprof' ); ?>
						</p>
						<p><a target="_blank" href="<?php echo esc_url('https://help.webriti.com/themes/busiprof/busiprof-wordpress-theme/'); ?>"><?php esc_html_e( 'Documentation','busiprof');?></a></p>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="busiprof-tab-pane-half busiprof-tab-pane-first-half">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/admin/img/busiprof.png'; ?>" alt="<?php esc_attr_e( 'busiprof Theme', 'busiprof' ); ?>" />
				</div>
			</div>	
		</div>
		<div class="row">
			<div class="busiprof-tab-center">
				<h3><?php esc_html_e( "Useful Links", 'busiprof' ); ?></h3>
			</div>
			<div class=" useful_box">
                <div class="busiprof-tab-pane-half busiprof-tab-pane-first-half">
                    <a href="<?php echo esc_url('https://busiprof.webriti.com/'); ?>" target="_blank"  class="info-block">
                    	<div class="dashicons dashicons-desktop info-icon"></div>
                    	<p class="info-text"><?php echo esc_html__('Lite Demo','busiprof'); ?></p>
                	</a>
                    <a href="<?php echo esc_url('https://busiprof-pro.webriti.com/'); ?>" target="_blank"  class="info-block">
                    	<div class="dashicons dashicons-book-alt info-icon"></div>
                    	<p class="info-text"><?php echo esc_html__('PRO Demo','busiprof'); ?></p>
                    </a>        
                </div>
                <div class="busiprof-tab-pane-half busiprof-tab-pane-first-half">
                    <a href="<?php echo esc_url('https://wordpress.org/support/view/theme-reviews/busiprof'); ?>" target="_blank"  class="info-block">
                    	<div class="dashicons dashicons-smiley info-icon"></div>
                    	<p class="info-text"><?php echo esc_html__('Your feedback is valuable to us','busiprof'); ?></p>
                    </a>
                    <a href="<?php echo esc_url('https://webriti.com/busiprof/'); ?>" target="_blank"  class="info-block">
                    	<div class="dashicons dashicons-book-alt info-icon"></div>
                    	<p class="info-text"><?php echo esc_html__('Premium Theme Details','busiprof'); ?></p>
                    </a>
                </div>
            </div>        
        </div>            
    </div>
</div>