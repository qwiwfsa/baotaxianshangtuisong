<div class="theme-offer">
	<?php
        // Check if the demo import has been completed
        $vw_one_page_demo_import_completed = get_option('vw_one_page_demo_import_completed', false);

        // If the demo import is completed, display the "View Site" button
        if ($vw_one_page_demo_import_completed) {
        echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'vw-one-page') . '</p>';
        echo '<span><a href="' . esc_url(home_url()) . '" class="button button-primary site-btn" target="_blank">' . esc_html__('View Site', 'vw-one-page') . '</a></span>';
        }

		//POST and update the customizer and other related data of POLITICAL CAMPAIGN
        if (isset($_POST['submit'])) {

        // Check if ibtana visual editor is installed and activated
        if (!is_plugin_active('ibtana-visual-editor/plugin.php')) {
          // Install the plugin if it doesn't exist
          $vw_one_page_plugin_slug = 'ibtana-visual-editor';
          $vw_one_page_plugin_file = 'ibtana-visual-editor/plugin.php';

          // Check if plugin is installed
          $vw_one_page_installed_plugins = get_plugins();
          if (!isset($vw_one_page_installed_plugins[$vw_one_page_plugin_file])) {
              include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
              include_once(ABSPATH . 'wp-admin/includes/file.php');
              include_once(ABSPATH . 'wp-admin/includes/misc.php');
              include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

              // Install the plugin
              $vw_one_page_upgrader = new Plugin_Upgrader();
              $vw_one_page_upgrader->install('https://downloads.wordpress.org/plugin/ibtana-visual-editor.latest-stable.zip');
          }
          // Activate the plugin
          activate_plugin($vw_one_page_plugin_file);
        }

            // ------- Create Nav Menu --------
            $vw_one_page_menuname = 'Main Menus';
            $vw_one_page_bpmenulocation = 'primary';
            $vw_one_page_menu_exists = wp_get_nav_menu_object($vw_one_page_menuname);

            if (!$vw_one_page_menu_exists) {
                $vw_one_page_menu_id = wp_create_nav_menu($vw_one_page_menuname);

                // Create Home Page
                $vw_one_page_home_title = 'Home';
                $vw_one_page_home = array(
                    'post_type' => 'page',
                    'post_title' => $vw_one_page_home_title,
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'home'
                );
                $vw_one_page_home_id = wp_insert_post($vw_one_page_home);
                // Assign Home Page Template
                add_post_meta($vw_one_page_home_id, '_wp_page_template', 'page-template/custom-home-page.php');
                // Update options to set Home Page as the front page
                update_option('page_on_front', $vw_one_page_home_id);
                update_option('show_on_front', 'page');
                // Add Home Page to Menu
                wp_update_nav_menu_item($vw_one_page_menu_id, 0, array(
                    'menu-item-title' => __('Home', 'vw-one-page'),
                    'menu-item-classes' => 'home',
                    'menu-item-url' => home_url('/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $vw_one_page_home_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create Pages Page with Dummy Content
                $vw_one_page_pages_title = 'Pages';
                $vw_one_page_pages_content = '
                <p>Explore all the pages we have on our website. Find information about our services, company, and more.</p>

                 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br>

                  All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $vw_one_page_pages = array(
                    'post_type' => 'page',
                    'post_title' => $vw_one_page_pages_title,
                    'post_content' => $vw_one_page_pages_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'pages'
                );
                $vw_one_page_pages_id = wp_insert_post($vw_one_page_pages);
                // Add Pages Page to Menu
                wp_update_nav_menu_item($vw_one_page_menu_id, 0, array(
                    'menu-item-title' => __('Pages', 'vw-one-page'),
                    'menu-item-classes' => 'pages',
                    'menu-item-url' => home_url('/pages/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $vw_one_page_pages_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Create About Us Page with Dummy Content
                $vw_one_page_about_title = 'About Us';
                $vw_one_page_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br>

                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br>

                            All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
                $vw_one_page_about = array(
                    'post_type' => 'page',
                    'post_title' => $vw_one_page_about_title,
                    'post_content' => $vw_one_page_about_content,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_slug' => 'about-us'
                );
                $vw_one_page_about_id = wp_insert_post($vw_one_page_about);
                // Add About Us Page to Menu
                wp_update_nav_menu_item($vw_one_page_menu_id, 0, array(
                    'menu-item-title' => __('About Us', 'vw-one-page'),
                    'menu-item-classes' => 'about-us',
                    'menu-item-url' => home_url('/about-us/'),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $vw_one_page_about_id,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type'
                ));

                // Set the menu location if it's not already set
                if (!has_nav_menu($vw_one_page_bpmenulocation)) {
                    $locations = get_theme_mod('nav_menu_locations'); // Use 'nav_menu_locations' to get locations array
                    if (empty($locations)) {
                        $locations = array();
                    }
                    $locations[$vw_one_page_bpmenulocation] = $vw_one_page_menu_id;
                    set_theme_mod('nav_menu_locations', $locations);
                }

        }


            // Set the demo import completion flag
    		update_option('vw_one_page_demo_import_completed', true);
    		// Display success message and "View Site" button
    		echo '<p class="notice-text">' . esc_html__('Your demo import has been completed successfully.', 'vw-one-page') . '</p>';
    		echo '<span><a href="' . esc_url(home_url()) . '" class="button button-primary site-btn" target="_blank">' . esc_html__('View Site', 'vw-one-page') . '</a></span>';
            //end


            // Top Bar //
            
            set_theme_mod( 'vw_one_page_phone_icon', 'fas fa-phone' );
            set_theme_mod( 'vw_one_page_phone_number', '+00 123 456 7890' );
            set_theme_mod( 'vw_one_page_email_icon', 'fas fa-envelope-open' );
            set_theme_mod( 'vw_one_page_email_address', 'support@example.com' );
            set_theme_mod( 'vw_one_page_time_icon', 'far fa-clock' );
            set_theme_mod( 'vw_one_page_timing', 'Mon To Fri 08.00-18.00' );

            // slider section start //
            set_theme_mod( 'vw_one_page_slider_small_title', 'THE STANDARD LOREM IPSUM PASSAGE' );
            set_theme_mod( 'vw_one_page_slider_button_text', 'Read More' );
            set_theme_mod( 'vw_one_page_slider_button_link', '#' );

            for($vw_one_page_i=1;$vw_one_page_i<=3;$vw_one_page_i++){
               $vw_one_page_slider_title = 'LOREM IPSUM DOLOR SIT AMET CONSECTETUR';
               $vw_one_page_slider_content = 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
                  // Create post object
               $my_post = array(
               'post_title'    => wp_strip_all_tags( $vw_one_page_slider_title ),
               'post_content'  => $vw_one_page_slider_content,
               'post_status'   => 'publish',
               'post_type'     => 'page',
               );

               // Insert the post into the database
               $vw_one_page_post_id = wp_insert_post( $my_post );

               if ($vw_one_page_post_id) {
                 // Set the theme mod for the slider page
                 set_theme_mod('vw_one_page_slider_page' . $vw_one_page_i, $vw_one_page_post_id);

                  $vw_one_page_image_url = get_template_directory_uri().'/images/slider'.$vw_one_page_i.'.png';

                $vw_one_page_image_id = media_sideload_image($vw_one_page_image_url, $vw_one_page_post_id, null, 'id');

                    if (!is_wp_error($vw_one_page_image_id)) {
                        // Set the downloaded image as the post's featured image
                        set_post_thumbnail($vw_one_page_post_id, $vw_one_page_image_id);
                    }
                }
            }

            // services section

            set_theme_mod('vw_one_page_services', 'category1' );

            // Define post category names and post titles
            $vw_one_page_category_names = array('category1', 'category2');
            $vw_one_page_title_array = array(
                array("SERVICES TITLE 1", "SERVICES TITLE 2", "SERVICES TITLE 3", "SERVICES TITLE 4"),
                array("SERVICES TITLE 1", "SERVICES TITLE 2", "SERVICES TITLE 3", "SERVICES TITLE 4")
            );

            foreach ($vw_one_page_category_names as $vw_one_page_index => $vw_one_page_category_name) {
                // Create or retrieve the post category term ID
                $vw_one_page_term = term_exists($vw_one_page_category_name, 'category');
                if ($vw_one_page_term === 0 || $vw_one_page_term === null) {
                    // If the term does not exist, create it
                    $vw_one_page_term = wp_insert_term($vw_one_page_category_name, 'category');
                }
                if (is_wp_error($vw_one_page_term)) {
                    error_log('Error creating category: ' . $vw_one_page_term->get_error_message());
                    continue; // Skip to the next iteration if category creation fails
                }

                for ($vw_one_page_i = 0; $vw_one_page_i < 4; $vw_one_page_i++) {
                    // Create post content
                    $vw_one_page_title = $vw_one_page_title_array[$vw_one_page_index][$vw_one_page_i];
                    $vw_one_page_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';

                    // Create post post object
                    $vw_one_page_my_post = array(
                        'post_title'    => wp_strip_all_tags($vw_one_page_title),
                        'post_content'  => $vw_one_page_content,
                        'post_status'   => 'publish',
                        'post_type'     => 'post', // Post type set to 'post'
                    );

                    // Insert the post into the database
                    $vw_one_page_post_id = wp_insert_post($vw_one_page_my_post);

                    if (is_wp_error($vw_one_page_post_id)) {
                        error_log('Error creating post: ' . $vw_one_page_post_id->get_error_message());
                        continue; // Skip to the next post if creation fails
                    }

                    // Assign the category to the post
                    wp_set_post_categories($vw_one_page_post_id, array((int)$vw_one_page_term['term_id']));

                    // Handle the featured image using media_sideload_image
                    $vw_one_page_image_url = get_template_directory_uri() . '/images/services' . ($vw_one_page_i + 1) . '.png';
                    $vw_one_page_image_id = media_sideload_image($vw_one_page_image_url, $vw_one_page_post_id, null, 'id');

                    if (is_wp_error($vw_one_page_image_id)) {
                        error_log('Error downloading image: ' . $vw_one_page_image_id->get_error_message());
                        continue; // Skip to the next post if image download fails
                    }
                    // Assign featured image to post
                    set_post_thumbnail($vw_one_page_post_id, $vw_one_page_image_id);
                }
            } 

            //About us
            set_theme_mod( 'vw_one_page_about_button_text', 'MORE' );
            
            $vw_one_page_banner_title = 'About us';
             $vw_one_page_banner_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam… Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took<br>
             
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam… Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took';
                   // Create post object
                 // Create post object
             $my_post = array(
             'post_title'    => wp_strip_all_tags( $vw_one_page_banner_title ),
             'post_content'  => $vw_one_page_banner_content,
             'post_status'   => 'publish',
             'post_type'     => 'page',
             );
 
             // Insert the post into the database
             $vw_one_page_post_id = wp_insert_post( $my_post );
 
             if ($vw_one_page_post_id) {
                 // Set the theme mod for the slider page
             set_theme_mod('vw_one_page_about_page', $vw_one_page_post_id);
 
             $vw_one_page_image_url = get_template_directory_uri().'/images/about.png';
 
             $vw_one_page_image_id = media_sideload_image($vw_one_page_image_url, $vw_one_page_post_id, null, 'id');
 
                 if (!is_wp_error($vw_one_page_image_id)) {
                     // Set the downloaded image as the post's featured image
                     set_post_thumbnail($vw_one_page_post_id, $vw_one_page_image_id);
                 }
             }
        }
    ?>

	<p><?php esc_html_e('Please back up your website if it’s already live with data. This importer will overwrite your existing settings with the new customizer values for VW One Page', 'vw-one-page'); ?></p>
    <form action="<?php echo esc_url(home_url()); ?>/wp-admin/themes.php?page=vw_one_page_guide" method="POST" onsubmit="return validate(this);">
        <?php if (!get_option('vw_one_page_demo_import_completed')) : ?>
            <input class="run-import" type="submit" name="submit" value="<?php esc_attr_e('Run Importer', 'vw-one-page'); ?>" class="button button-primary button-large">
        <?php endif; ?>
        <div id="spinner" style="display:none;">         
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/spinner.png" alt="" />
        </div>
    </form>
    <script type="text/javascript">
        function validate(form) {
            if (confirm("Do you really want to import the theme demo content?")) {
                // Show the spinner
                document.getElementById('spinner').style.display = 'block';
                // Allow the form to be submitted
                return true;
            } 
            else {
                return false;
            }
        }
    </script>
</div>