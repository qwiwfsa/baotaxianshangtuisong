<?php
/**
 * Getting Started Panel.
 *
 * @package awpbusinesspress
 */
?>
<div id="getting-started-panel" class="panel-left visible">
	<div class="panel-aside panel-column">
	<?php
	$awpbusinesspress_free_plugins = array(
		'awp-companion' => array(
			'name'     => 'AWP Companion',
			'slug'     => 'awp-companion',
			'filename' => 'awp-companion.php',
		),
	);
	if ( ! empty( $awpbusinesspress_free_plugins ) ) {
	?>
		<div class="recomended-plugin-wrap">
		<?php
		foreach ( $awpbusinesspress_free_plugins as $awpbusinesspress_plugin ) {
			$awpbusinesspress_info = awpbusinesspress_call_plugin_api( $awpbusinesspress_plugin['slug'] ); 
		?>
			<h4 title="">
				<?php esc_html_e( 'Companion Plugin', 'awpbusinesspress' ); ?>
			</h4>
			<p class="mt-0"><?php esc_html_e( 'AWP Companion Plugin requires to show all the front page features and Customization setting of Front Page.', 'awpbusinesspress' ); ?></p>
			<?php
			echo '<div class="mt-12">';
			echo awpbusinesspress_Getting_Started_Page_Plugin_Helper::instance()->get_button_html( $awpbusinesspress_plugin['slug'] );
			echo '</div>';
			?>

			</br>
			<?php
		}
		?>
		</div>
		<?php
	}
	?>
	</div> 
	<div class="panel-aside panel-column">
		<h4><?php esc_html_e( 'Go to the Customizer', 'awpbusinesspress' ); ?></h4>
		<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every single aspect of the theme. Because this theme provides advanced settings to control the theme layout through the customizer.', 'awpbusinesspress' ); ?></p>
		<a class="button button-primary" target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'awpbusinesspress' ); ?>"><?php esc_html_e( 'Go to the Customizer', 'awpbusinesspress' ); ?></a>
	</div>

	<div class="panel-aside panel-column">
		<h4><?php esc_html_e( 'Theme Documentation Link', 'awpbusinesspress' ); ?></h4>
		<p><?php esc_html_e( 'For an easy guide, here are the theme documentation', 'awpbusinesspress' ); ?></p>
		<a class="button button-primary" target="_blank" href="https://awplife.com/docs/wpbusinesspress/" title="<?php esc_attr_e( 'Visit', 'awpbusinesspress' ); ?>"><?php esc_html_e( 'Docs', 'awpbusinesspress' ); ?></a>
		<p><a class="button button-primary" target="_blank" href="https://www.youtube.com/playlist?list=PLXR1UeeO9dcfx8Wx_4Z-T-1NCw8ovnPQ8" title="<?php esc_attr_e( 'Visit', 'awpbusinesspress' ); ?>"><?php esc_html_e( 'Video Tutorial', 'awpbusinesspress' ); ?></a></p>
	</div>
</div>