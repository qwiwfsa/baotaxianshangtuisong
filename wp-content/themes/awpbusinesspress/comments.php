<?php
/**
 * The default template for comments
 */
if ( post_password_required() ) : ?>
	<p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'awpbusinesspress' ); ?></p>
	<?php
	return;
endif;

// awpbusinesspress comment part.
if ( ! function_exists( 'awpbusinesspress_comments' ) ) :
	function awpbusinesspress_comments( $comment, $args, $depth ) {

		// get theme data.
		global $comment_data;

		// translations.
		$leave_reply = isset($comment_data['translation_reply_to_coment']) ? $comment_data['translation_reply_to_coment'] : esc_html__( 'Reply', 'awpbusinesspress' );
		?>
<!--Comment-->
<div <?php comment_class( 'media comment-box' ); ?> id="comment-<?php comment_ID(); ?>">
	<a class="pull-left-comment" href="<?php the_author_meta( 'user_url' ); ?>">
		<?php echo get_avatar( $comment, $size = 70 ); ?>
	</a>
	<div class="media-body">
		<div class="comment-detail">
			<h6 class="comment-detail-title"><?php comment_author(); ?> <span class="comment-date"><?php esc_html_e( 'Posted on ', 'awpbusinesspress' ); ?><?php echo esc_html( comment_time( 'g:i a' ) ); ?>
				<?php
					echo ' - ';
					echo esc_html( comment_date( 'M j, Y' ) );
				?>
			</span></h6>
			<?php comment_text(); ?>

			<?php edit_comment_link( esc_html__( 'Edit', 'awpbusinesspress' ), '<p class="edit-link">', '</p>' ); ?>
	
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'awpbusinesspress' ); ?></em><br/>
			<?php endif; ?>

			<div class="reply">
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'reply_text' => $leave_reply,
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
							'per_page'   => $args['per_page'],
						)
					)
				);
				?>
			</div>
		</div>	
	</div>
</div>
<!--/Comment-->
		<?php
	}
endif;
?>

<?php if ( have_comments() ) : ?>				
<!--Comment Section-->
<article class="comment-section wow fadeInDown animated" data-wow-delay="0.4s">
	<div class="comment-title"><h3><i class="fa fa-comment-o"></i> <?php comments_number( esc_html__( 'No comments so far', 'awpbusinesspress' ), esc_html__( '1 comment so far', 'awpbusinesspress' ), esc_html__( '% Comments', 'awpbusinesspress' ) ); ?></h3></div>				
	<?php wp_list_comments( array( 'callback' => 'awpbusinesspress_comments' ) ); ?>			
</article>
<!--/Comment Section-->
<?php endif; ?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<nav id="comment-nav-below">
	<h1 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'awpbusinesspress' ); ?></h1>
	<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'awpbusinesspress' ) ); ?></div>
	<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'awpbusinesspress' ) ); ?></div>
</nav>
<?php endif; ?>

<?php if ( ! comments_open() && get_comments_number() ) : ?>
	<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'awpbusinesspress' ); ?></p>
<?php endif; ?>


<?php
if ( 'open' == $post->comment_status ) :
	if ( get_option( 'comment_registration' ) && ! $user_ID ) :
		?>
		<p><?php echo sprintf( wp_kses( 'You must be <a href="%s">logged in</a> to post a comment', 'awpbusinesspress' ), esc_url( home_url( 'wp-login.php' ) ) . '?redirect_to=' . urlencode( get_permalink() ) ); ?></p>
		<?php else :

			echo '<article class="comment-form-section">';

			$awpbusinesspress_fields_value = array(
				'author' => '<label>' . esc_html__( 'Name', 'awpbusinesspress' ) . '<input type="text" name="author" id="author"  class="blog-form-control"></label>',
				'email'  => '<label>' . esc_html__( 'Email', 'awpbusinesspress' ) . '<input type="text" name="email" id="email" class="blog-form-control"><label>',
			);

			function awpbusinesspress_fields( $awpbusinesspress_fields_value ) {
				return $awpbusinesspress_fields_value;
			}
			add_filter( 'comment_form_default_fields', 'awpbusinesspress_fields' );

			$defaults = array(
				'fields'               => apply_filters( 'awpbusinesspress_comment_form_default_fields', $awpbusinesspress_fields_value ),
				'comment_field'        => '<label>' . esc_html__( 'Message', 'awpbusinesspress' ) . '<textarea id="comments" name="comment" class="blog-form-control-textarea" rows="5"></textarea></label>',
				'logged_in_as'         => '<p class="blog-post-info-detail">' . esc_html__( 'Logged in as', 'awpbusinesspress' ) . ' ' . '<a href="' . esc_url( admin_url( 'profile.php' ) ) . '">' . esc_html( $user_identity ) . '</a>' . ' <a href="' . esc_url( wp_logout_url( get_permalink() ) ) . '" title="' . esc_attr__( 'Log out of this account', 'awpbusinesspress' ) . '">' . esc_html__( 'Logout', 'awpbusinesspress' ) . '</a>' . '</p>',
				'id_submit'            => 'blogdetail-btn',
				'label_submit'         => esc_html__( 'Submit', 'awpbusinesspress' ),
				'class_submit'         => 'btn-large btn-dark btn-animation',
				'comment_notes_after'  => '',
				'comment_notes_before' => '',
				'title_reply'          => '<div class="comment-title"><h3>' . esc_html__( 'Leave a Reply', 'awpbusinesspress' ) . '</h3></div>',
				'id_form'              => 'commentform',
			);
			ob_start();
			comment_form( $defaults );

			echo '</article>';

	endif;
endif;
