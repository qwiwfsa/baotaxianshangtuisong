<?php
/**
 * Recommended Plugins Panel
 *
 * @package awpbusinesspress
 */
?>
<div id="recommended-plugins-panel" class="panel-left">
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
			<div class="recom-plugin-wrap mb-0">
				<div class="plugin-title-install clearfix">
					<span class="title" title="">
						<?php esc_html_e( 'Recommended Plugin', 'awpbusinesspress' ); ?>
					</span>
					<p><?php esc_html_e( 'AWP Companion Plugin is highly recommended for awpbusinesspress Theme, After installing it, you will be able to show all the Front-Page features and Business sections for your Website.', 'awpbusinesspress' ); ?></p>
					<?php
					echo '<div class="button-wrap">';
					echo awpbusinesspress_Getting_Started_Page_Plugin_Helper::instance()->get_button_html( $awpbusinesspress_plugin['slug'] );
					echo '</div>';
					?>
				</div>
			</div>
			</br>
			<?php
		}
		?>
		</div>
		<?php
	}
	?>
</div>
