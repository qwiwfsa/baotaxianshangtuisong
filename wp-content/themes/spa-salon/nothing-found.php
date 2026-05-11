<h2 class="entry-title"><?php echo esc_html(get_theme_mod('spa_salon_no_results_page_title',__('Nothing Found','spa-salon')));?></h2>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	<p><?php printf( esc_html__( 'Ready to publish your first post? Get started here.', 'spa-salon' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
	<?php elseif ( is_search() ) : ?>
	<p><?php echo esc_html(get_theme_mod('spa_salon_no_results_page_content',__('Sorry, but nothing matched your search terms. Please try again with some different keywords.','spa-salon')));?></p><br />
		<?php get_search_form(); ?>
	<?php else : ?>
	<p><?php esc_html_e( 'Dont worry&hellip it happens to the best of us.', 'spa-salon' ); ?></p><br />
	<div class="more-btn">
		<a href="<?php echo esc_url(home_url() ); ?>"><?php esc_html_e( 'Back to Home Page', 'spa-salon' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Back to Home Page','spa-salon' );?></span></a>
	</div>
<?php endif; ?>