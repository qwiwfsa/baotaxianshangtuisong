<?php
/**
 * The template for displaying all pages
 *
 * @package Digital Magazine
 */

get_header();
?>

<div class="container">
	<?php
	$digital_magazine_page_layout = get_theme_mod( 'digital_magazine_page_layout', 'layout-1' );

	if ( $digital_magazine_page_layout == 'layout-1' ) {
		?>
	<div class="site-wrapper">
		<main id="primary" class="site-main lay-width">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'revolution/template-parts/content', 'page' );

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</main>
		<?php if ( is_active_sidebar( 'sidebar-1' )) { ?>
		<aside id="secondary" class="widget-area sidebar-width">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</aside>
		<?php } else { ?>
			<aside id="secondary" class="widget-area sidebar-width">
				<div class="default-sidebar">
					<aside id="search-3" class="widget widget_search">
						<h2 class="widget-title"><?php esc_html_e('Search Anything', 'digital-magazine'); ?></h2>
						<?php get_search_form(); ?>
					</aside>
					<aside id="recent-posts-2" class="widget widget_recent_entries">
						<h2 class="widget-title"><?php esc_html_e('Latest Posts', 'digital-magazine'); ?></h2>
						<ul>
							<?php
							$digital_magazine_recent_posts = wp_get_recent_posts(array('numberposts' => 5));
							foreach ($digital_magazine_recent_posts as $digital_magazine_post) {
								echo '<li><a href="' . esc_url(get_permalink($digital_magazine_post['ID'])) . '">' . esc_html($digital_magazine_post['post_title']) . '</a></li>';
							}
							?>
						</ul>
					</aside>
					<aside id="recent-comments-2" class="widget widget_recent_comments">
						<h2 class="widget-title"><?php esc_html_e('Latest Comments', 'digital-magazine'); ?></h2>
						<ul id="recentcomments">
							<?php
								$digital_magazine_comments = get_comments(array(
									'number' => 5,
									'status' => 'approve',
								));
								foreach ($digital_magazine_comments as $digital_magazine_comment) {
									echo '<li class="recentcomments">' . esc_html($digital_magazine_comment->comment_author) . ': <a href="' . esc_url(get_comment_link($digital_magazine_comment->comment_ID)) . '">' . esc_html(get_the_title($digital_magazine_comment->comment_post_ID)) . '</a></li>';
								}
							?>
						</ul>
					</aside>
					<aside id="categories-2" class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e('Explore Categories', 'digital-magazine'); ?></h2>
						<ul>
							<?php
								wp_list_categories(array(
									'title_li' => '',
								));
							?>
						</ul>
					</aside>
					<aside id="archives-2" class="widget widget_archive">
						<h2 class="widget-title"><?php esc_html_e('Blog Archives', 'digital-magazine'); ?></h2>
						<ul>
							<?php
								wp_get_archives(array(
									'type' => 'postbypost',
									'format' => 'html',
								));
							?>
						</ul>
					</aside>
						<aside id="pages-2" class="widget widget_pages">
							<h2 class="widget-title"><?php esc_html_e('Explore Our Pages', 'digital-magazine'); ?></h2>
							<ul>
								<?php
									wp_list_pages(array(
										'title_li' => '',
									));
								?>
							</ul>
						</aside>
					<aside id="calendar-2" class="widget widget_calendar">
							<h2 class="widget-title"><?php esc_html_e('Calender', 'digital-magazine'); ?></h2>
							<?php get_calendar(); ?>
					</aside>
			   </div>
			</aside>
	<?php } ?>
	</div>
	<?php
	} elseif ( $digital_magazine_page_layout == 'layout-2' ) {
		?>
	<div class="site-wrapper">
		<?php if ( is_active_sidebar( 'sidebar-1' )) { ?>
		<aside id="secondary" class="widget-area sidebar-width">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</aside>
		<?php } else { ?>
			<aside id="secondary" class="widget-area sidebar-width">
				<div class="default-sidebar">
					<aside id="search-3" class="widget widget_search">
						<h2 class="widget-title"><?php esc_html_e('Search Anything', 'digital-magazine'); ?></h2>
						<?php get_search_form(); ?>
					</aside>
					<aside id="recent-posts-2" class="widget widget_recent_entries">
						<h2 class="widget-title"><?php esc_html_e('Latest Posts', 'digital-magazine'); ?></h2>
						<ul>
							<?php
							$digital_magazine_recent_posts = wp_get_recent_posts(array('numberposts' => 5));
							foreach ($digital_magazine_recent_posts as $digital_magazine_post) {
								echo '<li><a href="' . esc_url(get_permalink($digital_magazine_post['ID'])) . '">' . esc_html($digital_magazine_post['post_title']) . '</a></li>';
							}
							?>
						</ul>
					</aside>
					<aside id="recent-comments-2" class="widget widget_recent_comments">
						<h2 class="widget-title"><?php esc_html_e('Latest Comments', 'digital-magazine'); ?></h2>
						<ul id="recentcomments">
							<?php
								$digital_magazine_comments = get_comments(array(
									'number' => 5,
									'status' => 'approve',
								));
								foreach ($digital_magazine_comments as $digital_magazine_comment) {
									echo '<li class="recentcomments">' . esc_html($digital_magazine_comment->comment_author) . ': <a href="' . esc_url(get_comment_link($digital_magazine_comment->comment_ID)) . '">' . esc_html(get_the_title($digital_magazine_comment->comment_post_ID)) . '</a></li>';
								}
							?>
						</ul>
					</aside>
					<aside id="categories-2" class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e('Explore Categories', 'digital-magazine'); ?></h2>
						<ul>
							<?php
								wp_list_categories(array(
									'title_li' => '',
								));
							?>
						</ul>
					</aside>
					<aside id="archives-2" class="widget widget_archive">
						<h2 class="widget-title"><?php esc_html_e('Blog Archives', 'digital-magazine'); ?></h2>
						<ul>
							<?php
								wp_get_archives(array(
									'type' => 'postbypost',
									'format' => 'html',
								));
							?>
						</ul>
					</aside>
						<aside id="pages-2" class="widget widget_pages">
							<h2 class="widget-title"><?php esc_html_e('Explore Our Pages', 'digital-magazine'); ?></h2>
							<ul>
								<?php
									wp_list_pages(array(
										'title_li' => '',
									));
								?>
							</ul>
						</aside>
					<aside id="calendar-2" class="widget widget_calendar">
							<h2 class="widget-title"><?php esc_html_e('Calender', 'digital-magazine'); ?></h2>
							<?php get_calendar(); ?>
					</aside>
			   </div>
			</aside>
	<?php } ?>
		<main id="primary" class="site-main lay-width">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'revolution/template-parts/content', 'page' );

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</main>
	</div>
	<?php 
	} elseif ( $digital_magazine_page_layout == 'layout-3' ) { // No-sidebar layout ?>
		<div class="site-wrapper full-width">
			<main id="primary" class="site-main lay-width">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'revolution/template-parts/content', 'page' );

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</main>
		</div>
	<?php } ?>
</div>

<?php
get_footer();
				