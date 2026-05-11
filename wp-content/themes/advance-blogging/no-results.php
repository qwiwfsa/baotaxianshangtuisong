<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Advance Blogging
 */
?>

<header role="banner">
	<h2 class="entry-title"><?php echo esc_html( get_theme_mod('advance_blogging_no_result_title',__('Nothing Found', 'advance-blogging' )) ); ?></h2>
</header>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( esc_html__( 'Ready to publish your first post? Get started here.', 'advance-blogging' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
<?php elseif ( is_search() ) : ?>
		<p><?php echo esc_html( get_theme_mod('advance_blogging_no_result_text',__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'advance-blogging' )) ); ?></p><br />
		<?php if (get_theme_mod('advance_blogging_show_search_form',true) != '') {
			get_search_form();
		}?>
<?php else : ?>
	<p><?php esc_html_e( 'Dont worry it happens to the best of us.', 'advance-blogging' ); ?></p><br />
	<div class="read-moresec pt-3 pb-4">
		<a href="<?php echo esc_url( home_url() ); ?>" class="button"><?php esc_html_e( 'Back to Home Page', 'advance-blogging' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Back to Home Page','advance-blogging' );?></span></a>
	</div>
<?php endif; ?>