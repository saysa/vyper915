<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	// footer info
	$footerText = get_option ( THEME_NAME."_footer_text" );

	// pop up banner
	$banner_type = get_option ( THEME_NAME."_banner_type" );
	
	$banner_fly_in = get_option ( THEME_NAME."_banner_fly_in" );
	$banner_fly_out = get_option ( THEME_NAME."_banner_fly_out" );
	$banner_start = get_option ( THEME_NAME."_banner_start" );
	$banner_close = get_option ( THEME_NAME."_banner_close" );
	$banner_overlay = get_option ( THEME_NAME."_banner_overlay" );
	$banner_views = get_option ( THEME_NAME."_banner_views" );
	$banner_timeout = get_option ( THEME_NAME."_banner_timeout" );
	
	$banner_text_image_img = get_option ( THEME_NAME."_banner_text_image_img" ) ;
	$banner_image = get_option ( THEME_NAME."_banner_image" );
	$banner_text = stripslashes ( get_option ( THEME_NAME."_banner_text" ) );
	
	if ( $banner_type == "image" ) {
	//Image Banner
		$cookie_name = substr ( md5 ( $banner_image ), 1,6 );
	} else if ( $banner_type == "text" ) { 
	//Text Banner
		$cookie_name = substr ( md5 ( $banner_text ), 1,6 );
	} else if ( $banner_type == "text_image" ) { 
	//Image And Text Banner
		$cookie_name = substr ( md5 ( $banner_text_image_img ), 1,6 );
	} else {
		$cookie_name = "popup";
	}

	if ( !$banner_start) {
		$banner_start = 0;
	}
	
	if ( !$banner_close) {
		$banner_close = 0;
	}
	
	if ( $banner_overlay == "on") {
		$banner_overlay = "true";
	} else {
		$banner_overlay = "false";
	}
	

	?>
            <!-- Footer -->
            <footer id="footer" role="contentinfo">
                <div class="inner-wrapper">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer') ) : ?>
					<?php endif; ?>
                </div>
                
                <!-- Copyright -->
                <div id="copyright">
                    <div class="inner-wrapper">
                        <div class="row">
                            <div class="grid_6">&copy; Copyright <?php echo date("Y");?>. All rights reserved.</div>
                            <div class="grid_6"><?php _e("Theme made by ", THEME_NAME);?><a href="http://themeforest.net/user/different-themes/portfolio?ref=different-themes" target="_blank">Different Themes</a></div>
                        </div>
                    </div>
                </div>
                
            </footer>

		</div>
<?php
			//pop up banner
			if ( $banner_type != "off" ) {
		?>
		
		<script type="text/javascript">
		<!--
		
		jQuery(document).ready(function($){
			$('#popup_content').popup( {
				starttime 			 : <?php echo $banner_start; ?>,
				selfclose			 : <?php echo $banner_close; ?>,
				popup_div			 : 'popup',
				overlay_div	 		 : 'overlay',
				close_id			 : 'baner_close',
				overlay				 : <?php echo $banner_overlay; ?>,
				opacity_level		 : 0.7,
				overlay_cc			 : false,
				centered			 : true,
				top	 		   		 : 130,
				left	 			 : 130,
				setcookie 			 : true,
				cookie_name	 		 : '<?php echo $cookie_name;?>',
				cookie_timeout 	 	 : <?php echo $banner_timeout; ?>,
				cookie_views 		 : <?php echo $banner_views ; ?>,
				floating	 		 : true,
				floating_reaction	 : 700,
				floating_speed 		 : 12,
				<?php 
					if ( $banner_fly_in != "off") { 
						echo "fly_in : true,
						fly_from : '".$banner_fly_in."', "; 
					} else {
						echo "fly_in : false,";
					}
				?>
				<?php 
					if ( $banner_fly_out != "off") { 
						echo "fly_out : true,
						fly_to : '".$banner_fly_out."', "; 
					} else {
						echo "fly_out : false,";
					}
				?>
				popup_appear  		 : 'show',
				popup_appear_time 	 : 0,
				confirm_close	 	 : false,
				confirm_close_text 	 : 'Do you really want to close?'
			} );
		});
		-->
		</script>
		<?php } ?>
		<?php if(is_page_template('template-homepage.php')) { ?>
			<?php 
				$_slider_auto = get_post_meta ( DF_page_id(), "_".THEME_NAME."_slider_auto", true ); 
				$_slider_time = get_post_meta ( DF_page_id(), "_".THEME_NAME."_slider_time", true ); 
				$_slider_animation = get_post_meta ( DF_page_id(), "_".THEME_NAME."_slider_animation", true ); 

			?>
	    	<script>
				// Flexslider
			    jQuery(".flexslider").flexslider({
			    	animation: "<?php echo $_slider_animation;?>",
			    	slideshow: <?php echo ($_slider_auto=="on") ? "true" : "false";?>,
			    	slideshowSpeed: <?php echo $_slider_time;?>, 
			    	controlNav: false
			    });
	    	</script>
    	<?php } ?>
		<?php wp_footer(); ?>
	</body>
</html>