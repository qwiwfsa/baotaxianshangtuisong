<div class="theme-import">
	<?php 
        // Check if the demo import has been completed
        $advance_blogging_demo_import_completed = get_option('advance_blogging_demo_import_completed', false);

        // If the demo import is completed, display the "View Site" button
        if ($advance_blogging_demo_import_completed) {
        echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'advance-blogging') . '</p>';
        echo '<span><a href="' . esc_url(home_url()) . '"  class= "run-import view-site" target="_blank">' . esc_html__('VIEW SITE', 'advance-blogging') . '</a></span>';
        }

		// POST and update the customizer and other related data
        if (isset($_POST['submit'])) {

            // ------- Create Nav Menu --------
            $advance_blogging_menuname = 'Main Menus';
            $advance_blogging_bpmenulocation = 'primary';
            $advance_blogging_menu_exists = wp_get_nav_menu_object($advance_blogging_menuname);

            if (!$advance_blogging_menu_exists) {
                $advance_blogging_menu_id = wp_create_nav_menu($advance_blogging_menuname);

                // Create Home Page
                $advance_blogging_home_title = 'Home';
                $advance_blogging_home = array(
                    'post_type' => 'page',
                    'post_title' => $advance_blogging_home_title,
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'home'
                );
                $advance_blogging_home_id = wp_insert_post($advance_blogging_home);
                // Assign Home Page Template
                add_post_meta($advance_blogging_home_id, '_wp_page_template', 'page-template/custom-frontpage.php');
                // Update options to set Home Page as the front page
                update_option('page_on_front', $advance_blogging_home_id);
                update_option('show_on_front', 'page');
                // Add Home Page to Menu
                wp_update_nav_menu_item($advance_blogging_menu_id, 0, array(
                    'menu-item-title' => __('Home', 'advance-blogging'),
                    'menu-item-classes' => 'home',
                    'menu-item-url' => home_url('/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $advance_blogging_home_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create About Us Page with Dummy Content
                $advance_blogging_pages_title = 'About Us';
                $advance_blogging_pages_content = '
                <p>Explore all the pages we have on our website. Find information about our services, company, and more.</p>

                 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                  All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $advance_blogging_pages = array(
                    'post_type' => 'page',
                    'post_title' => $advance_blogging_pages_title,
                    'post_content' => $advance_blogging_pages_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'pages'
                );
                $advance_blogging_pages_id = wp_insert_post($advance_blogging_pages);
                // Add About Us Page to Menu
                wp_update_nav_menu_item($advance_blogging_menu_id, 0, array(
                    'menu-item-title' => __('About Us', 'advance-blogging'),
                    'menu-item-classes' => 'pages',
                    'menu-item-url' => home_url('/pages/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $advance_blogging_pages_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // ===== CREATE BLOG PAGE =====
                $advance_blogging_blog_page = get_page_by_path('blog');
                if (!$advance_blogging_blog_page) {
                    $advance_blogging_blog_page_id = wp_insert_post(array(
                        'post_type'   => 'page',
                        'post_title'  => 'Blog',
                        'post_status' => 'publish',
                        'post_name'   => 'blog',
                    ));

                } else {
                    $advance_blogging_blog_page_id = $advance_blogging_blog_page->ID;
                }
                update_option('page_for_posts', $advance_blogging_blog_page_id);

                wp_update_nav_menu_item($advance_blogging_menu_id, 0, array(
                    'menu-item-title'     => __('Blog', 'advance-blogging'),
                    'menu-item-object-id' => $advance_blogging_blog_page_id,
                    'menu-item-object'    => 'page',
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                ));

                // Create Category Page with Dummy Content
                $advance_blogging_about_title = 'Category';
                $advance_blogging_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                            All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $advance_blogging_about = array(
                    'post_type' => 'page',
                    'post_title' => $advance_blogging_about_title,
                    'post_content' => $advance_blogging_about_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'about-us'
                );
                $advance_blogging_about_id = wp_insert_post($advance_blogging_about);
                // Add Category Page to Menu
                wp_update_nav_menu_item($advance_blogging_menu_id, 0, array(
                    'menu-item-title' => __('Category', 'advance-blogging'),
                    'menu-item-classes' => 'about-us',
                    'menu-item-url' => home_url('/about-us/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $advance_blogging_about_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create Shop Page with Dummy Content
                $advance_blogging_about_title = 'Shop';
                $advance_blogging_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                            All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $advance_blogging_about = array(
                    'post_type' => 'page',
                    'post_title' => $advance_blogging_about_title,
                    'post_content' => $advance_blogging_about_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'about-us'
                );
                $advance_blogging_about_id = wp_insert_post($advance_blogging_about);
                // Add Shop Page to Menu
                wp_update_nav_menu_item($advance_blogging_menu_id, 0, array(
                    'menu-item-title' => __('Shop', 'advance-blogging'),
                    'menu-item-classes' => 'about-us',
                    'menu-item-url' => home_url('/about-us/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $advance_blogging_about_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                 // Create Contact Us Page with Dummy Content
                $advance_blogging_about_title = 'Contact Us';
                $advance_blogging_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                            All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $advance_blogging_about = array(
                    'post_type' => 'page',
                    'post_title' => $advance_blogging_about_title,
                    'post_content' => $advance_blogging_about_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'about-us'
                );
                $advance_blogging_about_id = wp_insert_post($advance_blogging_about);
                // Add Contact Us Page to Menu
                wp_update_nav_menu_item($advance_blogging_menu_id, 0, array(
                    'menu-item-title' => __('Contact Us', 'advance-blogging'),
                    'menu-item-classes' => 'about-us',
                    'menu-item-url' => home_url('/about-us/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $advance_blogging_about_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Set the menu location if it's not already set
                if (!has_nav_menu($advance_blogging_bpmenulocation)) {
                    $advance_blogging_locations = get_theme_mod('nav_menu_locations'); // Use 'nav_menu_locations' to get locations array
                    if (empty($advance_blogging_locations)) {
                        $advance_blogging_locations = array();
                    }
                    $advance_blogging_locations[$advance_blogging_bpmenulocation] = $advance_blogging_menu_id;
                    set_theme_mod('nav_menu_locations', $advance_blogging_locations);
                }
                
        }     

            // Social Icon
            
            set_theme_mod( 'advance_blogging_topbar_hide', true ); 
            set_theme_mod( 'advance_blogging_facebook_url', '#' ); 
            set_theme_mod( 'advance_blogging_twitter_url', '#' ); 
            set_theme_mod( 'advance_blogging_tumblr_url', '#' ); 
            set_theme_mod( 'advance_blogging_pinterest_url', '#' ); 
            set_theme_mod( 'advance_blogging_linkedin_url', '#' ); 
            set_theme_mod( 'advance_blogging_insta_url', '#' ); 
            set_theme_mod( 'advance_blogging_youtube_url', '#' ); 

            //Slider    
            set_theme_mod('advance_blogging_slider_arrows', true ); 
            $advance_blogging_slider_titles = [
                'BECOME WORLD OF SUPERMODEL',
                'UNLOCK THE SECRETS OF STYLE AND CONFIDENCE',
                'BUILD YOUR TRENDSETTING BLOG TODAY',
                'INSPIRE THE WORLD WITH YOUR UNIQUE VOICE',
            ];
            
            $advance_blogging_slider_contents = [
                'Step into the glamorous world of supermodels and learn how to shine on every platform.',
                'Discover tips and tricks to elevate your style, build confidence, and embrace your true self.',
                'Start your blogging journey with tools and strategies to set trends and engage your audience.',
                'Share your story, inspire your readers, and make your mark in the blogging universe.',
            ];            
            for($advance_blogging_i=1;$advance_blogging_i<=4;$advance_blogging_i++){
                $advance_blogging_slider_title = $advance_blogging_slider_titles[$advance_blogging_i - 1];
                $advance_blogging_slider_content = $advance_blogging_slider_contents[$advance_blogging_i - 1];
                // Create post object
                $advance_blogging_my_post = array(
                'post_title'    => wp_strip_all_tags( $advance_blogging_slider_title ),
                'post_content'  => $advance_blogging_slider_content,
                'post_status'   => 'publish',
                'post_type'     => 'page',
                );
 
                // Insert the post into the database
                $advance_blogging_post_id = wp_insert_post( $advance_blogging_my_post );
 
                if ($advance_blogging_post_id) {
                  // Set the theme mod for the slider page
                  set_theme_mod('advance_blogging_slider_page' . $advance_blogging_i, $advance_blogging_post_id);
 
                   $advance_blogging_image_url = get_template_directory_uri().'/images/blog-banner'.$advance_blogging_i.'.png';
 
                 $advance_blogging_image_id = media_sideload_image($advance_blogging_image_url, $advance_blogging_post_id, null, 'id');
 
                     if (!is_wp_error($advance_blogging_image_id)) {
                         // Set the downloaded image as the post's featured image
                         set_post_thumbnail($advance_blogging_post_id, $advance_blogging_image_id);
                     }
                 }
            } 

            //Category Post  
            set_theme_mod('advance_blogging_category', true ); 
            set_theme_mod('advance_blogging_category_post', true ); 
            set_theme_mod('advance_blogging_blogcategory_setting', 'category1'); 
            $advance_blogging_category_names = array('category1', 'category2', 'category3', 'category4');
            $advance_blogging_title_array = array(
                array("AWESOME HAIRSTYLE FASHION TREND", "SNOWING IN MY TOWN AFTER A LONG TIME"),
                array("AWESOME HAIRSTYLE FASHION TREND", "SNOWING IN MY TOWN AFTER A LONG TIME"),
                array("AWESOME HAIRSTYLE FASHION TREND", "SNOWING IN MY TOWN AFTER A LONG TIME"),
                array("AWESOME HAIRSTYLE FASHION TREND", "SNOWING IN MY TOWN AFTER A LONG TIME")
            );

            foreach ($advance_blogging_category_names as $advance_blogging_index => $advance_blogging_category_name) {
                // Create or retrieve the post category term ID
                $advance_blogging_term = term_exists($advance_blogging_category_name, 'category');
                
                if ($advance_blogging_term === 0 || $advance_blogging_term === null) {
                    // If the term does not exist, create it
                    $advance_blogging_term = wp_insert_term($advance_blogging_category_name, 'category');
                    
                    if (is_wp_error($advance_blogging_term)) {
                        error_log('Error creating category: ' . $advance_blogging_term->get_error_message());
                        continue; // Skip to the next iteration if category creation fails
                    }
                }

                // Iterate over the post titles for each category
                for ($advance_blogging_i = 0; $advance_blogging_i < 2; $advance_blogging_i++) {
                    // Create post content
                    $advance_blogging_title = $advance_blogging_title_array[$advance_blogging_index][$advance_blogging_i];
                    $advance_blogging_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard';

                    // Create post object
                    $advance_blogging_my_post = array(
                        'post_title'   => wp_strip_all_tags($advance_blogging_title),
                        'post_content' => $advance_blogging_content,
                        'post_status'  => 'publish',
                        'post_type'    => 'post', // Post type set to 'post'
                    );

                    // Insert the post into the database
                    $advance_blogging_post_id = wp_insert_post($advance_blogging_my_post);

                    if (is_wp_error($advance_blogging_post_id)) {
                        error_log('Error creating post: ' . $advance_blogging_post_id->get_error_message());
                        continue; // Skip to the next post if creation fails
                    }

                    // Assign the category to the post
                    wp_set_post_categories($advance_blogging_post_id, array((int)$advance_blogging_term['term_id']));

                    // Handle the featured image using media_sideload_image
                    $advance_blogging_image_url = get_template_directory_uri() . '/images/banner-image' . ($advance_blogging_i + 1) . '.png';
                    $advance_blogging_image_id = media_sideload_image($advance_blogging_image_url, $advance_blogging_post_id, null, 'id');

                    if (is_wp_error($advance_blogging_image_id)) {
                        error_log('Error downloading image: ' . $advance_blogging_image_id->get_error_message());
                        continue; // Skip to the next post if image download fails
                    }
                    
                    // Assign featured image to post
                    set_post_thumbnail($advance_blogging_post_id, $advance_blogging_image_id);
                }
            }

            //Latest Post
            set_theme_mod( 'advance_blogging_latest_section', true ); 
            set_theme_mod( 'advance_blogging_latest_post_setting', 'latestcategory1' ); 
            $advance_blogging_category_names = array('latestcategory1', 'latestcategory2', 'latestcategory3', 'latestcategory4');
            $advance_blogging_title_array = array(
                array("BEST VIMEO CHANNELS FOR MEN'S FASHION & STYLE", "BEST VIMEO CHANNELS FOR MEN'S FASHION & STYLE"),
                array("BEST VIMEO CHANNELS FOR MEN'S FASHION & STYLE", "BEST VIMEO CHANNELS FOR MEN'S FASHION & STYLE"),
                array("BEST VIMEO CHANNELS FOR MEN'S FASHION & STYLE", "BEST VIMEO CHANNELS FOR MEN'S FASHION & STYLE"),
                array("BEST VIMEO CHANNELS FOR MEN'S FASHION & STYLE", "BEST VIMEO CHANNELS FOR MEN'S FASHION & STYLE")
            );

            foreach ($advance_blogging_category_names as $advance_blogging_index => $advance_blogging_category_name) {
                // Create or retrieve the post category term ID
                $advance_blogging_term = term_exists($advance_blogging_category_name, 'category');
                
                if ($advance_blogging_term === 0 || $advance_blogging_term === null) {
                    // If the term does not exist, create it
                    $advance_blogging_term = wp_insert_term($advance_blogging_category_name, 'category');
                    
                    if (is_wp_error($advance_blogging_term)) {
                        error_log('Error creating category: ' . $advance_blogging_term->get_error_message());
                        continue; // Skip to the next iteration if category creation fails
                    }
                }

                // Iterate over the post titles for each category
                for ($advance_blogging_i = 0; $advance_blogging_i < 2; $advance_blogging_i++) {
                    // Create post content
                    $advance_blogging_title = $advance_blogging_title_array[$advance_blogging_index][$advance_blogging_i];
                    $advance_blogging_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard';

                    // Create post object
                    $advance_blogging_my_post = array(
                        'post_title'   => wp_strip_all_tags($advance_blogging_title),
                        'post_content' => $advance_blogging_content,
                        'post_status'  => 'publish',
                        'post_type'    => 'post', // Post type set to 'post'
                    );

                    // Insert the post into the database
                    $advance_blogging_post_id = wp_insert_post($advance_blogging_my_post);

                    if (is_wp_error($advance_blogging_post_id)) {
                        error_log('Error creating post: ' . $advance_blogging_post_id->get_error_message());
                        continue; // Skip to the next post if creation fails
                    }

                    // Assign the category to the post
                    wp_set_post_categories($advance_blogging_post_id, array((int)$advance_blogging_term['term_id']));

                    // Handle the featured image using media_sideload_image
                    $advance_blogging_image_url = get_template_directory_uri() . '/images/blog-service-image' . ($advance_blogging_i + 1) . '.png';
                    $advance_blogging_image_id = media_sideload_image($advance_blogging_image_url, $advance_blogging_post_id, null, 'id');

                    if (is_wp_error($advance_blogging_image_id)) {
                        error_log('Error downloading image: ' . $advance_blogging_image_id->get_error_message());
                        continue; // Skip to the next post if image download fails
                    }
                    
                    // Assign featured image to post
                    set_post_thumbnail($advance_blogging_post_id, $advance_blogging_image_id);
                }
            }

            //Copyright Text
            set_theme_mod( 'advance_blogging_footer_copy', 'By ThemesCaliber' ); 

            // Set the demo import completion flag
    		update_option('advance_blogging_demo_import_completed', true);
    		// Display success message and "View Site" button
    		echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'advance-blogging') . '</p>';
    		echo '<span><a href="' . esc_url(home_url()) . '" class="run-import site-btn" target="_blank">' . esc_html__('VIEW SITE', 'advance-blogging') . '</a></span>';

        }
    ?>
  
    <p class="note"><?php esc_html_e( 'Please Note: If your website is live and already contains data, we recommend creating a backup first. Running this importer will replace your current settings with the custom values from the demo.', 'advance-blogging' ); ?></p>
        <form action="<?php echo esc_url(home_url()); ?>/wp-admin/themes.php?page=advance_blogging_guide" method="POST" onsubmit="return validate(this);">
        <?php if (!get_option('advance_blogging_demo_import_completed')) : ?>
            <button type="submit" name="submit" class="run-import">
                    <?php esc_html_e('Run Importer','advance-blogging'); ?>
                    <span id="spinner" style="display: none;">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/spinner.gif" alt="Loading..." style="width:34px; height:34px; vertical-align: middle;" />
                    </span>
            </button>
        <?php endif; ?>
        </form>
        <script type="text/javascript">
            function validate(valid) {
                if(confirm("Do you really want to import the theme demo content?")){
                    document.getElementById('spinner').style.display = 'inline-block';
                }
                else {
                    return false;
                }
            }
        </script>
    </div>