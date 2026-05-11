<?php
/**
 * Custom typography options for this theme
 *
 * @package Digital Magazine
 */

function digital_magazine_output_custom_font_css() {
    $digital_magazine_font_choice = get_theme_mod( 'digital_magazine_font_family', 'default' );

    if ( $digital_magazine_font_choice === 'default' ) {
        return;
    }

    $digital_magazine_font_map = array(
        'bad_script'       => '"Bad Script", cursive',
        'roboto'           => '"Roboto", sans-serif',
        'playfair_display' => '"Playfair Display", serif',
        'open_sans'        => '"Open Sans", sans-serif',
        'lobster'          => '"Lobster", cursive',
        'merriweather'     => '"Merriweather", serif',
        'oswald'           => '"Oswald", sans-serif',
        'raleway'          => '"Raleway", sans-serif',
        // Add new fonts here
        'poppins'          => '"Poppins", sans-serif',
        'lato'             => '"Lato", sans-serif',
        'source_sans_pro'  => '"Source Sans Pro", sans-serif',
        'quicksand'        => '"Quicksand", sans-serif',
        'nunito'           => '"Nunito", sans-serif',
        'montserrat'       => '"Montserrat", sans-serif',
        'roboto_condensed' => '"Roboto Condensed", sans-serif',
        'playfair_display_sc' => '"Playfair Display SC", serif',
        'alegreya'         => '"Alegreya", serif',
        'fira_sans'        => '"Fira Sans", sans-serif',
    );

    $digital_magazine_font_family = isset( $digital_magazine_font_map[ $digital_magazine_font_choice ] ) ? $digital_magazine_font_map[ $digital_magazine_font_choice ] : $digital_magazine_font_map['pt_sans'];

    $digital_magazine_custom_css = "
        body,
        h1, h2, h3, h4, h5, h6,
        p, a, span, div,
        .site, .entry-content, .main-navigation, .widget,
        input, textarea, button, .menu, .site-title, .site-description {
            font-family: {$digital_magazine_font_family} !important;
        }
    ";

    wp_add_inline_style( 'digital-magazine-google-fonts', $digital_magazine_custom_css );
}
add_action( 'wp_enqueue_scripts', 'digital_magazine_output_custom_font_css', 20 );


function digital_magazine_sanitize_font_family( $digital_magazine_input ) {
    $digital_magazine_valid = array(
        'default', 'bad_script', 'roboto',
        'playfair_display', 'open_sans', 'lobster', 'merriweather', 'oswald', 'raleway',
        // Add new font options here
        'poppins', 'lato', 'source_sans_pro', 'quicksand', 'nunito', 'montserrat',
        'roboto_condensed', 'playfair_display_sc', 'alegreya', 'fira_sans'
    );
    return in_array( $digital_magazine_input, $digital_magazine_valid ) ? $digital_magazine_input : 'default';
}

function digital_magazine_enqueue_selected_google_font() {
    $digital_magazine_font_choice = get_theme_mod( 'digital_magazine_font_family', 'default' );

    $digital_magazine_font_links = array(
        'bad_script'       => 'https://fonts.googleapis.com/css2?family=Bad+Script&display=swap',
        'roboto'           => 'https://fonts.googleapis.com/css2?family=Roboto&display=swap',
        'playfair_display' => 'https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap',
        'open_sans'        => 'https://fonts.googleapis.com/css2?family=Open+Sans&display=swap',
        'lobster'          => 'https://fonts.googleapis.com/css2?family=Lobster&display=swap',
        'merriweather'     => 'https://fonts.googleapis.com/css2?family=Merriweather&display=swap',
        'oswald'           => 'https://fonts.googleapis.com/css2?family=Oswald&display=swap',
        'raleway'          => 'https://fonts.googleapis.com/css2?family=Raleway&display=swap',
        // Add new font URLs here
        'poppins'          => 'https://fonts.googleapis.com/css2?family=Poppins&display=swap',
        'lato'             => 'https://fonts.googleapis.com/css2?family=Lato&display=swap',
        'source_sans_pro'  => 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap',
        'quicksand'        => 'https://fonts.googleapis.com/css2?family=Quicksand&display=swap',
        'nunito'           => 'https://fonts.googleapis.com/css2?family=Nunito&display=swap',
        'montserrat'       => 'https://fonts.googleapis.com/css2?family=Montserrat&display=swap',
        'roboto_condensed' => 'https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap',
        'playfair_display_sc' => 'https://fonts.googleapis.com/css2?family=Playfair+Display+SC&display=swap',
        'alegreya'         => 'https://fonts.googleapis.com/css2?family=Alegreya&display=swap',
        'fira_sans'        => 'https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap',
    );

    if ( isset( $digital_magazine_font_links[ $digital_magazine_font_choice ] ) ) {
        wp_enqueue_style( 'digital-magazine-dynamic-font', $digital_magazine_font_links[ $digital_magazine_font_choice ], array(), null );
    }
}
add_action( 'wp_enqueue_scripts', 'digital_magazine_enqueue_selected_google_font' );