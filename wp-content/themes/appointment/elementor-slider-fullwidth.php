<?php
// Template Name: Template with slider

get_header();
?>
<div id="wrap"></div>
<div class="clearfix"></div>
<?php
if ( function_exists( 'webriti_companion_activate' ) ):
    webriti_companion_appointment_slider();
else:
?>
    <div class="alert alert-warning alert-dismissible text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php esc_html_e('To show the slider, you have to activate the companion plugin.','appointment'); ?>
    </div>
<?php endif; 
    the_content(); 
    get_footer();
?>
