<?php
$appointment_theme=wp_get_theme();
global $appointment_importer_filepath, $appointment_importer_pro_filepath, $appointment_importer_new_filepath;
function appointment_hasdifferentandnotemptyvalues($array, $attribute) {
    if (empty($array)) {
        return false;
    }
    $values = [];
    foreach ($array as $item) {
        if (empty($item[$attribute])) {
            return false;
        }
        $values[] = $item[$attribute];
    }
    return count(array_unique($values)) !== 1;
}
function appointment_getuniquevalues($array, $attribute) {
    $values = array_column($array, $attribute);
    $uniqueValues = array_unique($values);
    return $uniqueValues;
}?>
<div id="free_pro_demo" class="appointment-tab-pane panel-close">
<?php
if(!class_exists('Spice_Starter_Sites')){
    global $hook_suffix;
    if($hook_suffix==='toplevel_page_appointment-welcome'){?>
        <div class="active-import-actions">
            <span><strong><?php echo esc_html('Activate Spice Starter Sites Demo Importer Now and Import any available demo in One Click','appointment');?></strong></span>
            <button id="install-import-plugin-button-options-page" data-plugin-slug="spice-starter-sites" data-plugin-url="<?php echo esc_url( 'https://spicethemes.com/extensions/spice-starter-sites.zip');?>"><?php echo esc_html__( 'Install', 'appointment' ); ?>
            </button>
        </div>
<?php } 
}?> 
	<section id="spice-starter-sites-importer-dashboard">
	    <div class="sss-library-body-wrapper" id="sss-demo-section-inner"> 
	        <div class="sss-library-content">
	            <div class="sss-library-heading">
	                <h3 style="text-align: center"><?php echo esc_html('Starter Sites','appointment');?></h3>
	                <p><?php echo esc_html('All free & premium demo content available here','appointment');?></p>
	            </div>
	            <div class="sss-library-content-wrapper sss-business-starter-demo">
	                <?php
	                $result = appointment_hasdifferentandnotemptyvalues($appointment_importer_filepath, 'categories');
	                if($result==true):
	                    if(!empty($appointment_importer_filepath) && !empty($appointment_importer_pro_filepath) && !empty($appointment_importer_new_filepath) ){
	                            $combinearray=array_merge($appointment_importer_filepath, $appointment_importer_pro_filepath, $appointment_importer_new_filepath);
	                        }
	                        else if(!empty($appointment_importer_filepath) && !empty($appointment_importer_pro_filepath) ){
	                            $combinearray=array_merge($appointment_importer_filepath, $appointment_importer_pro_filepath);
	                        }
	                        else if(!empty($appointment_importer_filepath) && !empty($appointment_importer_new_filepath) ){
	                            $combinearray=array_merge($appointment_importer_filepath, $appointment_importer_new_filepath);
	                        }
	                        else if(!empty($appointment_importer_pro_filepath) && !empty($appointment_importer_new_filepath) ){
	                            $combinearray=array_merge($appointment_importer_pro_filepath, $appointment_importer_new_filepath);
	                        }
	                    $uniqueValues = appointment_getuniquevalues($appointment_importer_filepath, 'categories');?>
	                        <div class="tabs">
	                            <button class="tab-button active" data-tab="all"><?php esc_html_e('All','appointment');?></button>
	                            <?php
	                            foreach ($uniqueValues as $value) {                            
	                                echo '<button class="tab-button" data-tab="'.htmlspecialchars($value).'">'.htmlspecialchars($value).'</button>';
	                            }?>
	                        </div>
	                <?php
	                endif;
	                echo '<div class="tab-content">'; 
	                foreach($appointment_importer_filepath as $appointment_importer_target){?>
	                     <div class="tab-item sss-content-section sss-starter-pack" data-tab="<?php echo esc_attr($appointment_importer_target['categories']);?>">
	                        <div class="sss-card <?php echo esc_attr($appointment_importer_target['status']); ?>" >
	                            <div class="sss-starter-pack-inner-img" style="background-image:url(<?php echo esc_url($appointment_importer_target['image']);?>)"></div>
	                            <div class="stater-badge-new">
	                                <img decoding="async" width="50" height="24" src="<?php echo esc_url('https://spicethemes.com/wp-content/uploads/2023/06/bedge_6.png');?>" class="attachment-large size-large wp-image-7046"  loading="lazy">
	                            </div>
	                            <div class="sss-card-details">
	                                <div class="sss-heading"><h4><?php echo esc_html($appointment_importer_target['title']);?></h4></div>
                                    <?php if($appointment_importer_target['categories']=='Gutenberg' || $appointment_importer_target['categories']=='Elementor'){?>
                                        <div class="sss-card-icon">
                                            <?php 
                                            if($appointment_importer_target['categories']=='Gutenberg'){?>
                                                <img src="<?php echo esc_url( get_template_directory_uri() ) . '/admin/img/gicon.png'; ?>" width="25" height="25">
                                            <?php 
                                            }
                                            elseif($appointment_importer_target['categories']=='Elementor'){?>
                                              <img src="<?php echo esc_url( get_template_directory_uri() ) . '/admin/img/eicon.png'; ?>" width="25" height="25">
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
	                                <div class="sss-card-btn">
	                                    <a href="<?php echo esc_url($appointment_importer_target['demo_link']);?>" class="sss-preview" target="_blank"><?php esc_html_e('Preview','appointment');?></a>
	                                     <?php if (class_exists('Spice_Starter_Sites')){?>
	                                    	<a  href="#" class="sss-popup" data-theme="<?php echo esc_attr($appointment_importer_target['slug']);?>" data-plugin="<?php echo esc_attr($appointment_importer_target['plugin']);?>"  data-title="<?php echo esc_attr($appointment_importer_target['title']);?>"><?php esc_html_e('Install','appointment');?></a>
	                                    <?php }?>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                <?php
	                }
	                foreach($appointment_importer_pro_filepath as $appointment_importer_pro_target){?>
	                    <div class="tab-item sss-content-section sss-starter-pack" data-tab="<?php echo esc_attr($appointment_importer_pro_target['categories']);?>">
	                        <div class="sss-card <?php echo esc_attr($appointment_importer_pro_target['status']); ?>" >
	                            <div class="sss-starter-pack-inner-img" style="background-image:url(<?php echo esc_url($appointment_importer_pro_target['image']);?>)"></div>
	                            <div class="stater-badge-new">
	                                <img decoding="async" width="50" height="24" src="<?php echo esc_url('https://spicethemes.com/wp-content/uploads/2023/06/bedge-9.png');?>" class="attachment-large size-large wp-image-7046" alt="" loading="lazy">
	                            </div>
	                            <div class="sss-card-details">
	                                <div class="sss-heading"><h4><?php echo esc_html($appointment_importer_pro_target['title']);?></h4></div>
	                                <?php if($appointment_importer_pro_target['categories']=='Gutenberg' || $appointment_importer_pro_target['categories']=='Elementor'){?>
                                        <div class="sss-card-icon">
                                            <?php 
                                            if($appointment_importer_pro_target['categories']=='Gutenberg'){?>
                                                <img src="<?php echo esc_url( get_template_directory_uri() ) . '/admin/img/gicon.png'; ?>" width="25" height="25">
                                            <?php 
                                            }
                                            elseif($appointment_importer_pro_target['categories']=='Elementor'){?>
                                              <img src="<?php echo esc_url( get_template_directory_uri() ) . '/admin/img/eicon.png'; ?>" width="25" height="25">
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
	                                <div class="sss-card-btn">
	                                    <a href="<?php echo esc_url($appointment_importer_pro_target['demo_link']);?>" class="sss-preview" target="_blank"><?php esc_html_e('Preview','appointment');?></a>
	                                    <?php 
	                                    if (class_exists('Spice_Starter_Sites')){
		                                    if($appointment_theme->name!='Appointment Pro' && $appointment_theme->name!='Appointment Pro Child' && $appointment_theme->name!='Appointment Pro child'){?>
		                                        <a  href="<?php echo esc_url('https://webriti.com/appointment/');?>" class="sss-buy-now" target="_blank" ><?php esc_html_e('Buy Now','appointment')?></a>
		                                    <?php }else{ ?>
		                                        <a  href="#" class="sss-popup" data-theme="<?php echo esc_attr($appointment_importer_pro_target['slug']);?>" data-plugin="<?php echo esc_attr($appointment_importer_pro_target['plugin']);?>" data-title="<?php echo esc_attr($appointment_importer_pro_target['title']);?>"><?php esc_html_e('Install','appointment');?></a>
		                                    <?php } 
		                                }?>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                <?php
	                }
	                echo '</div>';
	                ?>
	            </div>
	        </div>
	    </div>

	    <div class="sss_template" id="sss_template_1">
	       
	        <div align="center">
	             <?php            
	            if($appointment_theme->name =='Appointment' || 'Appointment child' == $appointment_theme->name  || 'Appointment Child' == $appointment_theme->name  || 'Appointment Blue' == $appointment_theme->name || 'Appointment Blue child' == $appointment_theme->name  || 'Appointment Blue Child' == $appointment_theme->name  || 'Appointment Dark' == $appointment_theme->name || 'Appointment Dark child' == $appointment_theme->name  || 'Appointment Dark Child' == $appointment_theme->name  || 'Appointment Green' == $appointment_theme->name || 'Appointment Green child' == $appointment_theme->name  || 'Appointment Green Child' == $appointment_theme->name  || 'Appointment Red' == $appointment_theme->name || 'Appointment Red child' == $appointment_theme->name  || 'Appointment Red Child' == $appointment_theme->name  || 'Appointee' == $appointment_theme->name || 'Appointee Child' == $appointment_theme->name  || 'Appointee Child' == $appointment_theme->name  || 'Shk Corporate' == $appointment_theme->name || 'Shk Corporate child' == $appointment_theme->name  || 'Shk Corporate Child' == $appointment_theme->name  || 'vice' == $appointment_theme->name || 'vice child' == $appointment_theme->name  || 'vice Child' == $appointment_theme->name || $appointment_theme->name =='Appointment Pro' || 'Appointment Pro Child' == $appointment_theme->name || 'Appointment Pro child' == $appointment_theme->name){?>
	                <h3 class="spice-starter-sites-importer-heading"><?php esc_html_e('Demo Import Instructions','appointment');?></h3>
	                <div align="justify" class="block-container">
	                    <button type="button" class="sss_block_close">X</button>
	                    <div class="importer-header">
	                    
	                    <p><?php esc_html_e('Spice Starter Sites Importer is a plugin that provides a demo import feature with one click. Follow instructions for better results.','appointment');?></p>
	                    </div>
	                    <div class="importer-body">
	                    <ol>
	                        <li><?php esc_html_e('Start with a fresh or reset WordPress installation.', 'appointment');?></li>
	                        <li><?php esc_html_e('Install & activate all recommended plugins.', 'appointment');?></li>
	                        <li><?php esc_html_e('Click "Import Demo Data," and wait for the success message.', 'appointment');?></li>
	                        <li><?php esc_html_e('Do not re-import to avoid issues; reset WordPress if re-importing is necessary.', 'appointment');?></li>
	                        <li><?php esc_html_e('Enjoy your new demo site!', 'appointment')?></li>                
	                    </ol>
	                    <a href="#" class="spice-starter-sites-importer-button next-btn button-primary"><?php esc_html_e('Next', 'appointment');?> </a>
	                    </div>
	                </div>
	            <?php 
	            } else {?>
	                <h3 class="spice-starter-sites-importer-heading"><?php esc_html_e('Spice Starter Sites Importer','appointment');?></h3>
	                <?php if(class_exists('Spice_Starter_Sites')){?>
		                <div align="center" class="spice-starter-sites-importer-sorry-msg">
		                    <img src="<?php echo esc_url(SPICE_STARTER_SITES_PLUGIN_URL.'assets/images/not-support.gif');?>"/>
		                    <p align="center" class="spice-starter-sites-importer-warning"><span><?php esc_html_e('Sorry!','appointment');?></span><?php esc_html_e(' This Theme is not compatible for this plugins','appointment');?></p>
		                </div>
		            <?php } 
	            }?>   
	         </div>
	       </div>
	    </div>

	</section>
	<script>
	     /* ---------------------------------------------- /*
	 * Preloader
	 /* ---------------------------------------------- */
	(function(){

	    jQuery(document).ready(function() {
	        jQuery('body').addClass('sss-main');
	    // Fullscreen Serach Box    

	    jQuery(function() {      
	      jQuery('.sss-popup').on("click", function(event) {   
	        var theme_data=jQuery(this).data('theme');
	        var theme_plugin=jQuery(this).data('plugin');
	        var theme_title=jQuery(this).data('title');
	        event.preventDefault();
	       jQuery("#sss_template_1").addClass("open");
	       jQuery(".next-btn").attr("data-theme",theme_data);
	       jQuery(".next-btn").attr("data-plugin",theme_plugin);
	       jQuery(".next-btn").attr("data-title",theme_title);
	        jQuery('#sss_template_1 > form > input[type="search"]').focus();
	      });

	      jQuery("#sss_template_1,.sss_template button.sss_block_close").on("click keyup", function(event) {
	        if (
	          event.target == this ||
	          event.target.className == "sss_block_close" ||
	          event.keyCode == 27
	        ) {
	         jQuery(this).removeClass("open");
	        }
	      });

	     jQuery("iframe").submit(function(event) {
	        event.preventDefault();
	        return false;
	      });
	    });
	jQuery('.next-btn').on("click", function(event) {     
	        event.preventDefault();
	        var theme_data=jQuery(this).data('theme');
	        var theme_plugin=jQuery(this).data('plugin');
	        var theme_title=jQuery(this).data('title');
	        var url='admin.php?page=spice-settings-importer&theme='+theme_data+'&plugin='+theme_plugin+'&title='+theme_title;
	        document.location = url;
	      });
	    });
	})(jQuery);
	 </script>
</div>