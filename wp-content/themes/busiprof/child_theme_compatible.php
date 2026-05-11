<?php
function theme_setup_data()
{
		$template_uri = BUSI_TEMPLATE_DIR_URI. '/images/default/';	
		
		return $busiprof_theme_options = array(
		
			'front_page'  => 'yes',
			
			'upload_image'=>'',
			'width'=>'138',
			'height'=>'49',
			'enable_logo_text'=>false,
			
			'upload_image_favicon'=>'',
			'home_banner_strip_enabled'=>'on',
			
			'home_page_slider_enabled'=>'on',			
			'home_service_section_enabled'=>'on',
			'home_project_section_enabled'=>'on',
			'home_testimonial_section_enabled'=>'on',
			'home_recentblog_section_enabled'=>'on',
			'contact_info_enabled' => 'on',
			'contact_google_map_enabled'=>'on',
			'contact_client_enabled' => 'on',
			
			'home_banner_strip_enabled' => 'on',
			'home_page_slider_enabled' => 'on',
			'slider_head_title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam mattis ligula',//Slide Heading
			'slider_image'=>  $template_uri .'home_slide.jpg',//Slide Image
			'caption_head' =>'Sollicitudin commodo',//Image Caption Heading
			'caption_text' =>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam mattis ligula vel velit tempus, sit amet aliquet ligula fringilla.',//Caption detail
			'readmore_text' => 'Sit Amet',
			'readmore_text_link' => "#",
			'image_url'=>  $template_uri .'home_slide.jpg',//Slide Image
			'title' => 'Sollicitudin commodo',//Image Caption Heading
			'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam mattis ligula vel velit tempus, sit amet aliquet ligula fringilla.',//Caption detail
			'button_text' => 'Morbi urna',
			'link' => "#",
			'readmore_target'=> false,
			
			
			//Slide Heading								
			'animation' => 'slide',
			'slide_direction' => 'horizontal',
			'animation_speed' => '1000',
			'slideshow_speed' => '2000',
			
			'client_strip'=>'yes',
			'client_strip_slide_speed'=>'2000',
			'client_strip_total' =>4,
			'client_title' => __('Meet our clients','busiprof'),
			'client_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam mattis ligula vel velit tempus, sit amet aliquet ligula fringilla.',
			
			'busiprof_custom_css' =>"",
			
			'footer_copyright_text' => sprintf(__('<p><a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://webriti.com" rel="nofollow">BusiProf</a> by Webriti</p>', 'busiprof')),
			
			'footer_social_media_enabled'=>'on',
			'footer_twitter_link' =>"#",
			'footer_facebook_link' =>"#",
			'footer_linkedin_link' =>"#",
			'footer_google_link' => '#',
			'footer_skype_link' => '#',
			
			'enable_projects' => 'on',
			'portfolio_section_enabled' => 'on',
			'protfolio_tag_line'=> 'Fusce quis urna',
			'protfolio_description_tag' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam mattis ligula vel velit tempus, sit amet aliquet ligula fringilla.",
								
			'slider_readmore'=>'#',
			
			'enable_services' => 'on',
			'service_list' => 4,
			'read_more_btn_enabled' => 'on',
			'service_readmore_button'=>__('More Services','busiprof'),
			'service_readmore_link'=>'#',
			
			
			
			'service_heading_one' => 'Ligula Fringilla',//Service Heading One
			'service_tagline'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam mattis ligula vel velit tempus, sit amet aliquet ligula fringilla.',//Service Tagline
			
			'service_image_one' => '',//Service Icon First
			'service_image_two' => '',//Service Icon Second	
			'service_image_three' => '',	//Service Icon Third
			'service_image_four' => '',//Service Icon Fourth
			
			'service_icon_one' => '',
			'service_icon_two' =>'',
			'service_icon_three' => '',
			'service_icon_four' => '',
			
			'service_title_one' => '',//Service Title One
			'service_title_two' =>'',//Service Title Two
			'service_title_three' =>'',//Service Title Three
			'service_title_four' =>'',//Service Title Four
			
			'service_text_one' =>'',//Service Description One
			'service_text_two' => '',//Service Description Two
			'service_text_three' => '',//Service Description Three
			'service_text_four' => '',
			
			'service_link_btn' => '#',//More Button Link
			'service_button_value' => __('More Services','busiprof'),
			
			
			'project_title_one' => 'Fusce quis urna', //project title one
			'project_thumb_one' =>$template_uri .'/rec_project.jpg', //project thumbnail one
			'project_text_one'  => 'Fusce & quis urna Fusce', //project text-description one
			'project_one_url' => '#',
			
			'project_title_two' => 'Fusce quis urna', //project title two
			'project_thumb_two' =>$template_uri .'/rec_project2.jpg', //project thumbnail two
			'project_text_two'  => 'Fusce & quis urna Fusce', //project text-description two
			'project_two_url' => '#',
			
			'project_title_three' => 'Fusce quis urna', //project title three
			'project_thumb_three' =>$template_uri .'/rec_project3.jpg', //project thumbnail three
			'project_text_three'  => 'Fusce & quis urna Fusce', //project text-description three
			'project_three_url' => '#',
			
			'project_title_four' => 'Fusce quis urna', //project title three
			'project_thumb_four' =>$template_uri .'/rec_project4.jpg', //project thumbnail three
			'project_text_four'  => 'Fusce & quis urna Fusce', //project text-description three
			'project_four_url' => '#',
			
			
			
			//Testimonials
			'testimonials_title' => 'Fusce quis urna', // Testimonials title 
			'testimonials_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', // Testimonials text  
  				
			'testimonials_image_one' => $template_uri.'/testimonial.jpg', // Testimonials image 
			'testimonials_text_one' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam mattis ligula vel velit tempus, sit amet aliquet ligula fringilla.', // Testimonials description
			'testimonials_name_one' =>  'Natalie Portman', // Testimonials name
			'testimonials_designation_one' => '(Fusce & quis urna)', // testmonials designation
			
			'testimonials_image_two' => $template_uri.'/testimonial2.jpg',  // Testimonials image 
			'testimonials_text_two' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam mattis ligula vel velit tempus, sit amet aliquet ligula fringilla.', // Testimonials description
			'testimonials_name_two' => 'Natalie Portman', // Testimonials name
			'testimonials_designation_two' => '(Fusce & quis urna)', // testmonials designation
			'testimonial_tagline' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
			
			'recent_blog_title' =>'Lorem Ipsum',
			'recent_blog_description' =>'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
			'home_recentblog_meta_enable' => 'on',
			
			//contact page settings
			'contact_address_1'=>__('378 Kingston Court','busiprof'),
			'contact_address_2'=>__('West New York, NJ 07093','busiprof'),
			'contact_number'=>__('973-960-4715','busiprof'),
			'contact_fax_number'=>__('0276-758645','busiprof'),
			'contact_email'=>__('info@busiprof.com','busiprof'),
			'contact_website'=>__('https://www.busiprof.com','busiprof'),
			'google_map_url' => 'https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Kota+Industrial+Area,+Kota,+Rajasthan&amp;aq=2&amp;oq=kota+&amp;sll=25.003049,76.117499&amp;sspn=0.020225,0.042014&amp;t=h&amp;ie=UTF8&amp;hq=&amp;hnear=Kota+Industrial+Area,+Kota,+Rajasthan&amp;z=13&amp;ll=25.142832,75.879538',
			
			//Post Type slug Options
			'busiprof_slider_slug' => 'busiprof-slider',
			'busiprof_service_slug' => 'busiprof-service',
			'busiprof_project_slug' => 'busiprof-project',
			'busiprof_testimonial_slug' => 'busiprof-testimonial',
			'busiprof_team_slug' => 'busiprof-team',
			'busiprof_portfolio_slug' => 'busiprof-portfolio',
			'busiprof_project_texonomy_slug' => 'project-category',
			
			//Taxonomy Archive Setting
			'taxonomy_portfolio_list' => 2 ,
			
			// layout manager settings
			'busi_layout_section1' => 'slider',
			'busi_layout_section2' => 'Service Section',
			'busi_layout_section3' => 'Project Section',
			'busi_layout_section4' => 'Testimonials section',
			'busi_layout_section5' => 'Client strip',
			
			// Archive page title
			'archive_prefix' => __('Archive','busiprof'),
			'category_prefix' => __('Category','busiprof'),
			'author_prefix' => __('All posts by','busiprof'),
			'tag_prefix'	=> __('Tag','busiprof'),
			'search_prefix'	=> __('Search results for','busiprof'),
			'404_prefix'	=> __('404','busiprof'),
			'shop_prefix'	=> __('Shop','busiprof'),

	);
		
}