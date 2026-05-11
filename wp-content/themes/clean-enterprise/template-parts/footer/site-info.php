<?php
$class = 'one';
?>

<div id="site-generator">
	<div class="site-info <?php echo $class; // WPCS: XSS OK. ?>">
		<div class="wrapper">
			<div id="footer-left-content" class="copyright">

					<?php
				        $theme_data = wp_get_theme();

				      $footer_text = sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved. %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'clean-enterprise' ), esc_attr( date_i18n( __( 'Y', 'clean-enterprise' ) ) ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>', get_the_privacy_policy_link() ) . ' &#124; ' . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'clean-enterprise' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( $theme_data->get( 'Author' ) ) .'</a>';

				        echo wp_kses_post( $footer_text ); ?>
			</div> <!-- .footer-left-content -->
		</div> <!-- .wrapper -->
	</div><!-- .site-info -->
</div> <!-- #site-generator -->
