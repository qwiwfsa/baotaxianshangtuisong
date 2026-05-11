<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'busiprof' ); ?></p>
	<?php return;endif;?>
         <?php if ( have_comments() ) : ?>
         <div class="comments-area">
			<h3><?php esc_html_e('Comment','busiprof');?> <span>(<?php echo esc_html(get_comments_number());?>)</span></h3>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'busiprof' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'busiprof' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'busiprof' ) ); ?></div>
		</nav>
		<?php endif;  ?>
		<?php wp_list_comments( array( 'callback' => 'busiprof_comment' ) ); ?>
		<!-- comment_mn -->
		</div>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'busiprof' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'busiprof' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'busiprof' ) ); ?></div>
		</nav>
		<?php endif;  ?>
		<?php
			elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :  ?>
	<?php endif; ?>
<?php if ('open' == $post->comment_status) : ?>
<?php if ( get_option('comment_registration') && isset($user_ID ) ) : ?>
<p><?php echo sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment','busiprof' ), esc_url(site_url( 'wp-login.php' )) . '?redirect_to=' .  urlencode( esc_url(get_permalink()) )); ?></p>
<?php else : ?>
<div class="comment-form">
	<div class="row">
	<?php
 $busiprof_fields=array(
    'author' => '<div class="form-group col-xs-6"><input name="author" id="author" value="" type="text"  placeholder="'. esc_attr__( "Name",'busiprof' ).'"  /></div>',
    'email'  => '<div class="form-group col-xs-6"><input name="email" id="email" value=""   type="text" placeholder="'. esc_attr__( "Email",'busiprof' ).'"></div>',
);
 function busiprof_comment_fields($busiprof_fields) {
return $busiprof_fields;
}
add_filter('comment_form_default_fields','busiprof_comment_fields');
	$busiprof_defaults = array(
     'fields'               => apply_filters( 'comment_form_default_fields', $busiprof_fields ),
	'comment_field'        => '<div class="form-group col-xs-12"><textarea rows="5" id="comment" name="comment" type="text" placeholder="'. esc_attr__( "Message",'busiprof' ).'" rows="3"></textarea></div>',
	 'logged_in_as' => '<div class="col-xs-12"><p class="logged-in-as">' . esc_html__("Logged in as",'busiprof' ).'<a href="'. esc_url(admin_url( 'profile.php' )).'">'.$user_identity.'</a>'. '<a href="'. esc_url(wp_logout_url( get_permalink() )).'" title="'. esc_attr__( "Logout of this account",'busiprof' ).'">'.esc_html__("Logout",'busiprof').'</a>' . '</p></div>',
	 'id_submit'            => 'submit_btn',
	'label_submit'         =>esc_html__('Send Message','busiprof'),
	'comment_notes_after'  => '',
	 'title_reply'       => '<div class="col-xs-12"><h3 class="comment-title">' . esc_html__('Leave a Reply','busiprof') .'</h3></div>',
	 'id_form'      => 'action'
	);
comment_form($busiprof_defaults);
?></div>
</div><!-- leave_comment_mn -->
<?php endif; // If registration required and not logged in ?>
<?php endif;
