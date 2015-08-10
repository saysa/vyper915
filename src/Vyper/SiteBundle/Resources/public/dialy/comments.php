<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php printf ( __( 'This post is password protected. Enter the password to view comments.' , THEME_NAME ));?></p>
	<?php
		return;
	}

	

?>

<?php //You can start editing here. ?>
	<?php if (have_comments() || comments_open()) : ?>
        <!-- Comments -->
        <div class="comments" id="comments">
        	<p class="title"><span><?php comments_number(__('0 <strong>Comments</strong>', THEME_NAME), __('1 <strong>Comment</strong>', THEME_NAME), __('% <strong>Comments</strong>', THEME_NAME)); ?></span></p>

			<ol class="comments-list">
				<?php wp_list_comments('type=comment&callback=differentthemes_comment'); ?>
			</ol>
			<div class="comments-pager"><?php paginate_comments_links(); ?></div>
			<?php if (!have_comments()) : ?>
				<!-- No comments view -->
				<div class="no-comments">
				    <i class="fa fa-comments"></i>
				    <h5><?php _e("No comments!", THEME_NAME);?></h5>
				    <p><?php _e("There are no comments yet, but you can be first to comment this article.", THEME_NAME);?></p>
				</div>
			<?php endif; ?>	
		</div>
	<?php endif; ?>	

	<?php if ( comments_open() ) : ?>
        <!-- Respond -->
        <div id="respond">
        	<p class="title"><span><?php _e("Leave <strong>reply</strong>", THEME_NAME);?></span></p>

            <a href="#" name="respond"></a>     	
			<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
				<p class="registered-user-restriction"><?php printf ( __( 'Only <a href="%1$s"> registered </a> users can comment.', THEME_NAME ), wp_login_url( get_permalink() ));?> </p>
			<?php else : ?>
				<?php 
					$defaults = array(
						'comment_field'       	=> '<p class="comment-form-comment"><label>'.__("Comment:",THEME_NAME).'<span>*</span></label><textarea name="comment" id="comment" placeholder="'.__("Your comment..",THEME_NAME).'" required></textarea></p>',
						'comment_notes_before' 	=> '',
						'comment_notes_after'  	=> '',
						'id_form'              	=> 'writecomment',
						'id_submit'            	=> 'submit',
						'title_reply'          => '',
						'title_reply_to'       => '',
						'cancel_reply_link'    	=> '',
						'label_submit'         	=> ''.__( 'Post a comment', THEME_NAME ).'',
					);
					comment_form($defaults);			
				?>							
			<?php endif; // if you delete this the sky will fall on your head ?>
		</div>
	<?php endif; ?>