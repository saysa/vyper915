<?php

	$logo = get_option(THEME_NAME.'_logo');			

	//menu color
	$menuStyle = get_option(THEME_NAME.'_menu_style');	
	$topMenuStyle = get_option(THEME_NAME.'_top_menu_style');	
	//header style
	$headerStyle = get_option(THEME_NAME.'_header_style');	

	//top banner
	$bannerTop = get_option(THEME_NAME.'_banner_top');	
	$bannerCode = get_option(THEME_NAME.'_banner_code');	

	//layout	
	$layout = get_option(THEME_NAME.'_page_layout');	

	//weather forecast
	$weatherSet = get_option(THEME_NAME."_weather");

	$locationType = get_option(THEME_NAME."_weather_location_type");
	if($locationType == "custom") {
		$weather = DF_weather_forecast(str_replace(' ', '+', get_option(THEME_NAME."_weather_city")));
	} else {
		$weather = DF_weather_forecast($_SERVER['REMOTE_ADDR']);
	}

	if($topMenuStyle=="light") { 
		$weatherStyle = "dark"; 
	} else {
		$weatherStyle = "light"; 
	}

	//logo wrapper
	$subCount = get_option(THEME_NAME."_subcount");
	if(!$subCount) { $subCount = 5; }

?>

        <!-- Wrapper -->
        <div id="wrapper" class="<?php echo $layout;?>">

            <!-- Header -->
            <header id="header" class="<?php echo $headerStyle;?>" role="banner">
            	<?php if($weatherSet=="on" || has_nav_menu('top-menu')) { ?>
	                <!-- Top bar -->
	                <div class="top-bar <?php echo $topMenuStyle;?>">
	                    <div class="inner-wrapper">
							<?php 
								$walker = new DF_Walker_Top;
								$args = array(
									'container' => '',
									'theme_location' => 'top-menu',
									"link_before" => '',
									"menu_class" => 'top-menu',
									"link_after" => '' ,
									'items_wrap' => '<ul class="%2$s">%3$s</ul>',
									'depth' => 3,
									"echo" => false,
									"walker" => $walker
								);
													
								if(has_nav_menu('top-menu')) {
							?>
		                        <!-- Responsive menu -->
		                        <a class="click-to-open-menu"><i class="fa fa-align-justify"></i></a>
		                        <!-- Top menu -->
		                        <nav class="top-menu" role="navigation">
					    			<?php echo add_menu_arrows(wp_nav_menu($args)); ?>
					  	 		</nav>
							<?php		
								} 
							?>

				            <?php if($weatherSet=="on") { ?>
							    <!-- Weather -->
							    <div class="weather-report">
							    	<?php if(!isset($weather['error'])) { ?>

			                            <span class="report"><?php echo $weather['temp_'.get_option(THEME_NAME."_temperature")];?></span>
			                            <img src="<?php echo THEME_IMAGE_URL.$weatherStyle."-".$weather['image'];?>.png" alt="<?php printf( __( '%s', THEME_NAME ), $weather['weatherDesc'] );?>">
			                            <span class="city"><?php echo $weather['city'].', '.$weather['country'];?></span>

									<?php 
										} else {
											echo "<span class='error'>".$weather['error']."</span>";
										} 
									?>
							    </div>

			
							<?php } ?>
	                    </div>                    
	                </div>
                <?php } ?>
                <div class="inner-wrapper row">

				    <?php if($logo) { ?> 
				    	<!-- Logo -->
	                    <div id="logo">
							<a href="<?php echo home_url(); ?>">
								<img src="<?php echo esc_url($logo);?>" alt="<?php echo esc_attr(get_bloginfo('name'));?>">
							</a>
						    <?php if(get_bloginfo('description')) { ?>
						    	<h2 id="site-description"><?php echo bloginfo('description');?></h2>
							<?php } ?> 
						</div>
					<?php } else { ?>
	                    <!-- Logo -->
	                    <div id="logo">
	                        <h1 id="site-logo">
	                        	<a href="<?php echo home_url(); ?>">
	                        		<?php echo substr(get_bloginfo('name'),0,$subCount);?><span><?php echo substr(get_bloginfo('name'),$subCount);?></span>
	                        	</a>
	                        </h1>
						    <?php if(get_bloginfo('description')) { ?>
						    	<h2 id="site-description"><?php echo bloginfo('description');?></h2>
							<?php } ?>
	                    </div>
					<?php } ?>



					<?php if($bannerTop=="on" && $bannerCode) { ?>
		                <!-- Top banner block -->
		                <div class="ad-banner-728x90"><?php echo stripslashes($bannerCode);?></div>
		            <?php } ?>

                    
                </div>


				<!-- Primary navigation -->
                <nav class="primary-menu <?php echo $menuStyle;?> sticky-menu" role="navigation">
                    <div class="inner-wrapper">   
                        <!-- Responsive menu -->
                        <a class="click-to-open-menu"><i class="fa fa-align-justify"></i></a>           
					<?php 
							$walker = new DF_Walker;
							$args = array(
								'container' => '',
								'theme_location' => 'main-menu',
								"link_before" => '',
								"menu_class" => 'main-menu',
								"link_after" => '' ,
								'items_wrap' => '<ul class="%2$s">%3$s</ul>',
								'depth' => 4,
								"echo" => false,
								'walker' => $walker
							);
												
							if(has_nav_menu('main-menu')) {
								echo add_menu_arrows(wp_nav_menu($args));		
							} else {
								echo "<ul class=\"main-menu\"><li class=\"navi-none\"><span style=\"background-color: #000000\"></span><a href=\"".admin_url("nav-menus.php") ."\">Please set up ".THEME_FULL_NAME." menu!</a></li></ul>";
							}
					?>                    
                    </div>                    

                </nav>
                
            </header>
