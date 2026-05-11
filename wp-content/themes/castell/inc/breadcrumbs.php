<?php
function castell_breadcrumbs() {

       $castell_showonhome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $castell_showcurrent = 1;
    if (is_home() || is_front_page()) {

            echo '<ul id="breadcrumbs" class="banner-link text-center"><li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'castell') . '</a></li></ul>';
    } else {

        echo '<ul id="breadcrumbs" class="banner-link text-center"><li><a href="' . esc_url(home_url('/')). '">' . esc_html__('Home', 'castell') . '</a> ';
        if (is_category()) {
            $castell_thisCat = get_category(get_query_var('cat'), false);
            if ($castell_thisCat->parent != 0)
                echo esc_html(get_category_parents($castell_thisCat->parent, TRUE, ' '));
            echo  esc_html__('Archive by category', 'castell') . ' " ' . single_cat_title('', false) . ' "';
        }   elseif (is_search()) {
            echo  esc_html__('Search Results For ', 'castell') . ' " ' . get_search_query() . ' "';
        } elseif (is_day()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ';
            echo '<a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . esc_html(get_the_time('F') ). '</a> ';
            echo  esc_html(get_the_time('d'));
        } elseif (is_month()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ';
            echo  esc_html(get_the_time('F')) ;
        } elseif (is_year()) {
            echo esc_html(get_the_time('Y')) ;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $castell_post_type = get_post_type_object(get_post_type());
                $castell_slug = $castell_post_type->rewrite;
                echo '<a href="' . esc_url(home_url('/'. $castell_slug['slug'] . '/')) .'">' . esc_html($castell_post_type->labels->singular_name) . '</a>';
                if ($castell_showcurrent == 1)
                    echo  esc_html(get_the_title()) ;
            } else {
                $castell_cat = get_the_category();
                $castell_cat = $castell_cat[0];
                $castell_cats = get_category_parents($castell_cat, TRUE, ' ');
                if ($castell_showcurrent == 0)
                    $castell_cats =
                            preg_replace("#^(.+)\s\s$#", "$1", $castell_cats);
                echo $castell_cats;
                if ($castell_showcurrent == 1)
                    echo  esc_html(get_the_title());
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $castell_post_type = get_post_type_object(get_post_type());
            echo esc_html($castell_post_type->labels->singular_name );
        } elseif (is_page()) {
            if ($castell_showcurrent == 1)
                echo esc_html(get_the_title());
        } elseif (is_page() && $post->post_parent) {
            $castell_parent_id = $post->post_parent;
            $castell_breadcrumbs = array();
            while ($castell_parent_id) {
                $castell_page = get_page($castell_parent_id);
                $castell_breadcrumbs[] = '<a href="' . esc_url(get_permalink($castell_page->ID)) . '">' . esc_html(get_the_title($castell_page->ID)) . '</a>';
                $castell_parent_id = $castell_page->post_parent;
            }
            $castell_breadcrumbs = array_reverse($castell_breadcrumbs);
            for ($castell_i = 0; $castell_i < count($castell_breadcrumbs); $castell_i++) {
                echo $castell_breadcrumbs[$castell_i];
                if ($castell_i != count($castell_breadcrumbs) - 1)
                    echo ' ';
            }
            if ($castell_showcurrent == 1)
                echo esc_html(get_the_title());
        } elseif (is_tag()) {
            echo  esc_html__('Posts tagged', 'castell') . ' " ' . esc_html(single_tag_title('', false)) . ' "';
        } elseif (is_author()) {
            global $author;
            $castell_userdata = get_userdata($author);
            echo  esc_html__('Articles Published by', 'castell') . ' " ' . esc_html($castell_userdata->display_name ). ' "';
        } elseif (is_404()) {
            echo esc_html__('Error 404', 'castell') ;
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            printf( /* translators: %s is search query variable*/ esc_html__(' ( Page %s )', 'castell'),esc_html(get_query_var('paged')) );
        }

        
        echo '</li></ul>';
    }
}