<?php
	
	function different_themes_scripts() { 
		global $wp_styles, $wp_scripts;
		$banner_type = get_option ( THEME_NAME."_banner_type" );
		$layout = get_option ( THEME_NAME."_layout" );
		$mainMenuStyle = get_option ( THEME_NAME."_main_menu" );
		$post_type = get_post_type();
		$menu_type = get_option ( THEME_NAME."_menu_type" );
		$pageWidth = get_option(THEME_NAME.'_page_width');	
		$responsive = get_option(THEME_NAME.'_responsive_layout');

		//font settings	
		$_font_cyrillic_ex = get_option(THEME_NAME.'_font_cyrillic_ex');	
		$_font_cyrillic = get_option(THEME_NAME.'_font_cyrillic');	
		$_font_greek_ex = get_option(THEME_NAME.'_font_greek_ex');	
		$_font_greek = get_option(THEME_NAME.'_font_greek');	
		$_font_vietnamese = get_option(THEME_NAME.'_font_vietnamese');	
		$_font_latin_ex = get_option(THEME_NAME.'_font_latin_ex');	

		if($_font_cyrillic_ex=="on") {
			$_font_cyrillic_ex = ",cyrillic-ext";	
		} else {
			$_font_cyrillic_ex = false;
		}
		if($_font_cyrillic=="on") {
			$_font_cyrillic = ",cyrillic";	
		} else {
			$_font_cyrillic = false;
		}
		if($_font_greek_ex=="on") {
			$_font_greek_ex = ",greek-ext";	
		} else {
			$_font_greek_ex = false;
		}
		if($_font_greek=="on") {
			$_font_greek = ",greek";	
		} else {
			$_font_greek = false;
		}
		if($_font_vietnamese=="on") {
			$_font_vietnamese = ",vietnamese";	
		} else {
			$_font_vietnamese = false;
		}
		if($_font_latin_ex=="on") {
			$_font_latin_ex = ",latin-ext";	
		} else {
			$_font_latin_ex = false;
		}



		$protocol = is_ssl() ? 'https' : 'http';
		
		//include google fonts
		$google_fonts = array();
		for($i=1; $i<=7; $i++) {
			if(get_option(THEME_NAME."_google_font_".$i)) {
				$google_fonts[] = get_option(THEME_NAME."_google_font_".$i);	
			}
			
		}
		$google_fonts = array_unique($google_fonts);
		$i=1;
		foreach($google_fonts as $google_font) {
			$protocol = is_ssl() ? 'https' : 'http';
			if($google_font && $google_font!="Arial" ) {
				wp_enqueue_style( 'google-fonts-'.$i, $protocol."://fonts.googleapis.com/css?family=".str_replace(" ", "+", $google_font).":300italic,400italic,700italic,400,300,700&subset=latin".$_font_cyrillic_ex.$_font_cyrillic.$_font_greek_ex.$_font_greek.$_font_vietnamese.$_font_latin_ex);
			}
			$i++;
		}

		wp_enqueue_style("normalize", THEME_CSS_URL."normalize.css", Array());		
		wp_enqueue_style("main-style", THEME_CSS_URL."style.css", Array());

		wp_enqueue_style("layout", THEME_CSS_URL."layout.css", Array());
		wp_enqueue_style("fontawesome", THEME_CSS_URL."fontawesome.css", Array());

		wp_enqueue_style("mobile", THEME_CSS_URL."mobile.css", Array(), false, '(min-width:0px) and (max-width:760px)');
		wp_enqueue_style("720", THEME_CSS_URL."720.css", Array(), false, '(min-width:761px) and (max-width:1080px)');
		wp_enqueue_style("960", THEME_CSS_URL."960.css", Array(), false, '(min-width:1081px) and (max-width:1300px)');
		wp_enqueue_style("1200", THEME_CSS_URL."1200.css", Array(), false, '(min-width:1301px)');

		if($responsive=="off") {	
		} else {
		}

		wp_enqueue_style('dynamic-css', admin_url('admin-ajax.php').'?action=df_dynamic_css');
 		wp_enqueue_style("style", get_stylesheet_uri(), Array());
 		
		wp_enqueue_script("jquery");
		wp_enqueue_script("query-ui-core");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("jquery-ui-accordion");
		wp_enqueue_script("jquery-ui-slider");
		wp_enqueue_script("html5" , "http://html5shiv.googlecode.com/svn/trunk/html5.js", Array('jquery'), "", false);
		$wp_scripts->add_data('html5', 'conditional', 'lt IE 9');

		wp_enqueue_script("cookies" , THEME_JS_URL."admin/jquery.c00kie.js", Array('jquery'), "1.0", true);
		if($banner_type && $banner_type!="off") {
			wp_enqueue_script("banner" , THEME_JS_URL."jquery.floating_popup.1.3.min.js", Array('jquery'), "1.0", true);
		}
		if (is_page_template ( 'template-contact.php' )) {
			wp_enqueue_script("contact" , THEME_JS_URL."jquery.contact.js", Array('jquery'), '', true);
		}
		wp_enqueue_script("modernizr" , THEME_JS_URL."modernizr.min.js", Array('jquery'), '', true);
		wp_enqueue_script("easing" , THEME_JS_URL."easing.min.js", Array('jquery'), '', true);

		if($mainMenuStyle!="normal") {
			wp_enqueue_script("stickykit" , THEME_JS_URL."stickykit.min.js", Array('jquery'), '', true);
		}
		
		wp_enqueue_script("flexslider" , THEME_JS_URL."flexslider.min.js", Array('jquery'), '', false);
		wp_enqueue_script("isotope" , THEME_JS_URL."isotope.js", Array('jquery'), '', true);
		wp_enqueue_script("fitvids" , THEME_JS_URL."fitvids.min.js", Array('jquery'), '', true);
		wp_enqueue_script("init" , THEME_JS_URL."init.js", Array('jquery'), '', true);

		
		if (is_page_template ( 'template-gallery.php' ) || $post_type=='gallery-item') {
			wp_enqueue_script("infinitescroll" , THEME_JS_URL."jquery.infinitescroll.min.js", Array('jquery'), '', true);
		} 

		wp_enqueue_script(THEME_NAME, THEME_JS_URL.THEME_NAME.".js", Array('jquery'), '', true);
		wp_enqueue_script("dynamic-scripts" , admin_url('admin-ajax.php').'?action=df_dynamic_js', "1.0", true);	


		

		if ( is_singular() ) { wp_enqueue_script( "comment-reply" ); }


		
		wp_localize_script('jquery','df',
			array(
				'adminUrl' => admin_url("admin-ajax.php"),
				'imageUrl' => THEME_IMAGE_URL,
				'cssUrl' => THEME_CSS_URL,
				'themeUrl' => THEME_URL,

			)
		);
		
	}

	add_action( 'wp_enqueue_scripts', 'different_themes_scripts');
?>