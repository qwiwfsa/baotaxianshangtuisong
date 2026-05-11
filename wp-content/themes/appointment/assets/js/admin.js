(function($) {
    $( function() {
//Js for Home page Slide Variation
       if($("#_customize-input-slide_variation").val()=='banner_image')
        {
            $("#customize-control-wc_sps_shortcode").hide();
            $("#customize-control-appointment_options-slider_radio").show();
			$("#customize-control-appointment_options-slider_options").show();
			$("#customize-control-appointment_options-slider_transition_delay").show();
		    $("#customize-control-appointment_options-featured_slider_post").show();
		    $("#customize-control-appointment_options-slider_select_category").show();
			$("#wc_appointment_post_slider").hide();
			$("#wc_appointment_post_slider_demo").hide();
       }
       else
       {
            $("#customize-control-wc_sps_shortcode").show();
            $("#customize-control-appointment_options-slider_radio").hide();
			$("#customize-control-appointment_options-slider_options").hide();
			$("#customize-control-appointment_options-slider_transition_delay").hide();
		    $("#customize-control-appointment_options-featured_slider_post").hide();
		    $("#customize-control-appointment_options-slider_select_category").hide();
            $("#wc_appointment_post_slider").show();
            $("#wc_appointment_post_slider_demo").show();			
       }
       
        wp.customize('slide_variation', function(control) {
        control.bind(function( slider_variation ) {
            if(slider_variation=='banner_image')
            {
            $("#customize-control-wc_sps_shortcode").hide();
            $("#customize-control-appointment_options-slider_radio").show();
			$("#customize-control-appointment_options-slider_options").show();
			$("#customize-control-appointment_options-slider_transition_delay").show();
		    $("#customize-control-appointment_options-featured_slider_post").show();
		    $("#customize-control-appointment_options-slider_select_category").show();
			$("#wc_appointment_post_slider").hide();
			$("#wc_appointment_post_slider_demo").hide();
            }
            else
            {
            $("#customize-control-wc_sps_shortcode").show();
            $("#customize-control-appointment_options-slider_radio").hide();
			$("#customize-control-appointment_options-slider_options").hide();
			$("#customize-control-appointment_options-slider_transition_delay").hide();
		    $("#customize-control-appointment_options-featured_slider_post").hide();
		    $("#customize-control-appointment_options-slider_select_category").hide();
			$("#wc_appointment_post_slider").show();
			$("#wc_appointment_post_slider_demo").show();
            }
            });
    });
    });
})(jQuery)