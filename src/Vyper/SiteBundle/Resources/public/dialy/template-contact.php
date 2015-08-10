<?php
/*
Template Name: Contact Page
*/	
?>
<?php get_header(); ?>
<?php 

	wp_reset_query();
	global $post;
	$mail_to = get_post_meta ($post->ID, "_".THEME_NAME."_contact_mail", true );

	$showTitle = get_post_meta ( $post->ID, "_".THEME_NAME."_show_title", true ); 

	//google map
	$map = get_post_meta ($post->ID, "_".THEME_NAME."_map", true );



?>
	<?php if($mail_to) { ?>
		<?php if (have_posts()) : ?>
			<?php if($map) { ?>
				<div id="above-the-fold" class="above-the-fold light featured">
				    <iframe src="<?php echo $map;?>&amp;iwloc=A&amp;output=embed" width="100%" height="400" frameborder="0" style="border:0"></iframe>
				</div>
			<?php } ?>
			<?php get_template_part(THEME_SINGLE."page-title"); ?> 
			<?php get_template_part(THEME_LOOP."loop-start"); ?> 
				<?php the_content(); ?>
	            <!-- Contact page -->
	            <div id="contact">
					<div id="message" style="display: none;">
						<div class="error_message"><?php _e("Attention! Please correct the errors below and try again.",THEME_NAME);?>
							<ul class="error_messages cross">
								<li class="name" style="display: none;"><?php _e("Your name is <strong>required</strong>.",THEME_NAME);?></li>
								<li class="email" style="display: none;"><?php _e("Your e-mail address is <strong>required</strong>.",THEME_NAME);?></li>
								<li class="message" style="display: none;"><?php _e("You must <strong>enter a message</strong> to send.",THEME_NAME);?></li>
							</ul>
						</div>
						<div class="success alert green" style="display: none;"><?php _e("Email sent successfully!",THEME_NAME);?></div>
					</div>

	            </div>
	            <form method="post" name="contactform" id="contactform">
	            	<input name="form_type" type="hidden" id="form_type" value="contact" />
	            	<input name="contact_id" type="hidden" id="contact_id" value="<?php echo df_page_id();?>" />

                    <div class="form-group">
                    	<label for="name"><?php _e("Name",THEME_NAME);?></label>
                   		<input name="name" type="text" id="name" value="" required>
                    </div>    
                    <div class="form-group">
                    	<label for="email"><?php _e("Email",THEME_NAME);?></label>
                    	<input name="email" type="email" id="email" value="" required>
                    </div>   
	                <div class="form-group">
	                    <label for="comments"><?php _e("Message",THEME_NAME);?></label>
	                    <textarea name="comments" type="text" id="comments" value="" required></textarea>
	                </div>      
	                <div class="form-group">
	                    <input type="submit" class="submit btn btn-blue" id="submit" value="<?php _e("Submit",THEME_NAME);?>">
	                </div>
	            </form>


		<?php get_template_part(THEME_LOOP."loop-end"); ?> 
	<?php else: ?>
		<p><?php printf ( __('Sorry, no posts matched your criteria.' , THEME_NAME )); ?></p>
	<?php endif; ?>
<?php } else { echo "<p style=\"color:#000; font-size:14pt; text-align: center; padding: 30px 0 10px 0;\">You need to set up Your contact mail!</p>"; } ?>

<?php get_footer(); ?>
