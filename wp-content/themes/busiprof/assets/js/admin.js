(function($) {
    $( function() {
//Js for Home page Slide Variation
       if($("#_customize-input-slide_variation").val()=='banner_image')
        {
            $("#customize-control-wc_sps_shortcode").hide();
            $("#customize-control-busiprof_theme_options-slider_image").show();
			$("#customize-control-busiprof_theme_options-caption_head").show();
			$("#customize-control-busiprof_theme_options-caption_text").show();
		    $("#customize-control-busiprof_theme_options-readmore_text").show();
		    $("#customize-control-busiprof_theme_options-readmore_text_link").show();
			$("#customize-control-busiprof_theme_options-readmore_target").show();
       }
       else
       {
            $("#customize-control-wc_sps_shortcode").show();
            $("#customize-control-busiprof_theme_options-slider_image").hide();
			$("#customize-control-busiprof_theme_options-caption_head").hide();
			$("#customize-control-busiprof_theme_options-caption_text").hide();
		    $("#customize-control-busiprof_theme_options-readmore_text").hide();
		    $("#customize-control-busiprof_theme_options-readmore_text_link").hide();
			$("#customize-control-busiprof_theme_options-readmore_target").hide();
       }
       
        wp.customize('slide_variation', function(control) {
        control.bind(function( slider_variation ) {
            if(slider_variation=='banner_image')
            {
            $("#customize-control-wc_sps_shortcode").hide();
            $("#customize-control-busiprof_theme_options-slider_image").show();
			$("#customize-control-busiprof_theme_options-caption_head").show();
			$("#customize-control-busiprof_theme_options-caption_text").show();
		    $("#customize-control-busiprof_theme_options-readmore_text").show();
		    $("#customize-control-busiprof_theme_options-readmore_text_link").show();
			$("#customize-control-busiprof_theme_options-readmore_target").show();
            }
            else
            {
            $("#customize-control-wc_sps_shortcode").show();
            $("#customize-control-busiprof_theme_options-slider_image").hide();
			$("#customize-control-busiprof_theme_options-caption_head").hide();
			$("#customize-control-busiprof_theme_options-caption_text").hide();
		    $("#customize-control-busiprof_theme_options-readmore_text").hide();
		    $("#customize-control-busiprof_theme_options-readmore_text_link").hide();
			$("#customize-control-busiprof_theme_options-readmore_target").hide();
            }
            });
    });
    });
})(jQuery)