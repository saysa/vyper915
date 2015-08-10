<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $differentThemes_meta_fields;

$differentThemes_meta_fields = new DifferentThemesManagment(THEME_FULL_NAME,THEME_NAME, "meta");

$differentThemes_meta_options= array(
	/* ------------------------------------------------------------------------*
	 * META SETTINGS
	 * ------------------------------------------------------------------------*/   
	array(
		"type" => "meta_block",
		"title" => THEME_NAME.__("Settings", THEME_NAME),
		"blocks" => array(
			array(
				"options" => array(
					array(
						"type" => "navigation",
					),					
					array(
						"type" => "meta_sub_navigation",
						"subname"=>array(
							array(
								"slug"=>"general", 
								"icon"=>"dashicons-admin-generic", 
								"name"=> __("General", THEME_NAME),
								"hide_in"=> array(DF_POST_GALLERY),//post/page type

							), 
							array(
								"slug"=>"post_settings", 
								"icon"=>"dashicons-list-view", 
								"name"=> __("Post/Page Settings", THEME_NAME),
								"skip_templates"=> array('homepage', 'gallery')//page template
							), 
							array(
								"slug"=>"sidebar", 
								"icon"=>"dashicons-admin-appearance", 
								"name"=>__("Sidebar", THEME_NAME)
							), 

						)
					),

					/* ------------------------------------------------------------------------*
					 * GENERAL SETTINGS
					 * ------------------------------------------------------------------------*/   
					array(
						"type" => "meta_sub_tab",
						"slug"=>'general',
						"hide_in"=> array(DF_POST_GALLERY),//post/page type
					),
					array(
						"type" => "row",
						"page_type" => array("blog")
					),
					array(
						"type" => "title",
						"title" => __("Blog Style", THEME_NAME),
						"page_type" => array("blog")
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_blog_style",
						"radio" => array(
							array("title" => __("Default Layout:", THEME_NAME), "value" => "1"),
							array("title" => __("Grid Layout:", THEME_NAME), "value" => "2")
						),
						"std" => "1",
						"page_type" => array("blog")
					),

					array(
						"type" => "close",
						"page_type" => array("blog")
					),	
					array(
						"type" => "row",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","gallery"),
						"compare" => get_option(THEME_NAME.'_share_all'),
					),
					array(
						"type" => "title",
						"title" => __("Share Buttons", THEME_NAME),
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","gallery"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_share_single",
						"radio" => array(
							array("title" => __("Show:", THEME_NAME), "value" => "show"),
							array("title" => __("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_share_all'),
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","gallery"),
					),

					array(
						"type" => "close",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","gallery"),
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_post_controls'),
					),
					array(
						"type" => "title",
						"title" => __("Post Controls (prev/next buttons)", THEME_NAME),
						"page_type" => array("post"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_post_controls_single",
						"radio" => array(
							array("title" => __("Show:", THEME_NAME), "value" => "show"),
							array("title" => __("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_post_controls'),
						"page_type" => array("post"),
					),

					array(
						"type" => "close",
						"page_type" => array("post"),
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_author'),
					),
					array(
						"type" => "title",
						"title" => __("Show Post Author", THEME_NAME),
						"page_type" => array("post"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_author_single",
						"radio" => array(
							array("title" => __("Show:", THEME_NAME), "value" => "show"),
							array("title" => __("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_author'),
						"page_type" => array("post"),
					),

					array(
						"type" => "close",
						"page_type" => array("post"),
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_published'),
					),
					array(
						"type" => "title",
						"title" => __("Show Post Date", THEME_NAME),
						"page_type" => array("post"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_published_single",
						"radio" => array(
							array("title" => __("Show:", THEME_NAME), "value" => "show"),
							array("title" => __("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_published'),
						"page_type" => array("post"),
					),

					array(
						"type" => "close",
						"page_type" => array("post"),
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_comments'),
					),
					array(
						"type" => "title",
						"title" => __("Show Post Comment Count", THEME_NAME),
						"page_type" => array("post"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_comments_single",
						"radio" => array(
							array("title" => __("Show:", THEME_NAME), "value" => "show"),
							array("title" => __("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_comments'),
						"page_type" => array("post"),
					),

					array(
						"type" => "close",
						"page_type" => array("post"),
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_categories'),
					),
					array(
						"type" => "title",
						"title" => __("Show Post Categories", THEME_NAME),
						"page_type" => array("post"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_categories_single",
						"radio" => array(
							array("title" => __("Show:", THEME_NAME), "value" => "show"),
							array("title" => __("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_categories'),
						"page_type" => array("post"),
					),

					array(
						"type" => "close",
						"page_type" => array("post"),
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_tags'),
					),
					array(
						"type" => "title",
						"title" => __("Show Post Tags", THEME_NAME),
						"page_type" => array("post"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_tags_single",
						"radio" => array(
							array("title" => __("Show:", THEME_NAME), "value" => "show"),
							array("title" => __("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_tags'),
						"page_type" => array("post"),
					),

					array(
						"type" => "close",
						"page_type" => array("post"),
					),
					
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_views'),
					),
					array(
						"type" => "title",
						"title" => __("Show Post Views Count", THEME_NAME),
						"page_type" => array("post"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_views_single",
						"radio" => array(
							array("title" => __("Show:", THEME_NAME), "value" => "show"),
							array("title" => __("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_views'),
						"page_type" => array("post"),
					),

					array(
						"type" => "close",
						"page_type" => array("post"),
					),
					
					array(
						"type" => "row",
						"page_type" => array("page","post","!blog"),
						"compare" => get_option(THEME_NAME.'_show_single_thumb'),
						"skip_templates" => array("homepage","contact","gallery"),
					),
					array(
						"type" => "title",
						"title" => __("Show Image In Single Post / News Page", THEME_NAME),
						"skip_templates" => array("homepage","contact","gallery"),
						"page_type" => array("page","post","!blog"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_show_single_thumb",
						"radio" => array(
							array("title" => __("Show:", THEME_NAME), "value" => "show"),
							array("title" => __("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","gallery"),
						"compare" => get_option(THEME_NAME.'_show_single_thumb'),
					),

					array(
						"type" => "close",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","gallery"),
						"compare" => get_option(THEME_NAME.'_single_thumb_size'),
					),
					array(
						"type" => "row",
						"page_type" => array("page","post","!blog"),
						"compare" => get_option(THEME_NAME.'_single_thumb_size'),
						"skip_templates" => array("homepage","contact","gallery"),
					),
					array(
						"type" => "title",
						"title" => __("Single Image Size", THEME_NAME),
						"skip_templates" => array("homepage","contact","gallery"),
						"page_type" => array("page","post","!blog"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_single_thumb_size",
						"radio" => array(
							array("title" => __("Default:", THEME_NAME), "value" => "show"),
							array("title" => __("Full Width:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","gallery"),
						"compare" => get_option(THEME_NAME.'_single_thumb_size'),
					),

					array(
						"type" => "close",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","gallery"),
						"compare" => get_option(THEME_NAME.'_show_single_thumb'),
					),
					array(
						"type" => "row",
						"page_type" => array("page")
					),	
					array(
						"type" => "title",
						"title" => __("Page Title Color", THEME_NAME),
						"page_type" => array("page")
					),
					array(
						"type" => "color",
						"title" => __("Color", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_title_color",
						"std" => get_option(THEME_NAME."_default_cat_color"),
						"page_type" => array("page")
					),
									
					array(
						"type" => "close",
						"page_type" => array("page")
					),	


					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_about_author'),
					),
					array(
						"type" => "title",
						"title" => __("\"About Author\" Block In Post", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_about_author",
						"radio" => array(
							array("title" => __("Show:", THEME_NAME), "value" => "show"),
							array("title" => __("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_about_author'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_similar_posts'),
					),
					array(
						"type" => "title",
						"title" => __("\"Similar News\" Block In Post", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_similar_posts",
						"radio" => array(
							array("title" => __("Show:", THEME_NAME), "value" => "show"),
							array("title" => __("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_similar_posts'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),

					array(
						"type" => "row",
						"page_type" => array("homepage")
					),
					array(
						"type" => "title",
						"title" => __("Show Homepage Main Slider/News Blocks?", THEME_NAME),
						"page_type" => array("homepage")
					),
					array(
						"type" => "radio",
						"title" => __("Show", THEME_NAME),
						"radio" => array(
							array("title" => __("Homepage Slider + 2 Blocks:", THEME_NAME), "value" => "on"),
							array("title" => __("6 News Blocks:", THEME_NAME), "value" => "news"),
							array("title" => __("Off:", THEME_NAME), "value" => "off")
						),
						"std" => "off",
						"id" => "_".$differentThemes_meta_fields->themeslug."_slider",
						"page_type" => array("homepage")
					),
					array(
						"type" => "multiple_select",
						"title" => __("Set Main News Slider Categories", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_slider_cat",
						"taxonomy" => "category",
						"page_type" => array("homepage"),
						"protected" => array(
							array("id" => "_".$different_themes_managment->themeslug."_slider", "value" => "on")
						)
					),
					array(
						"type" => "multiple_select",
						"title" => __("Set Main News Block Categories", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_slider_cat",
						"taxonomy" => "category",
						"page_type" => array("homepage"),
						"protected" => array(
							array("id" => "_".$different_themes_managment->themeslug."_slider", "value" => "news")
						)
					),
					array(
						"type" => "select",
						"title" => __("Slide Count", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_slide_count",
						"options"=>array(
							array("slug"=>"1", "name"=>__("1 Slide", THEME_NAME)), 
							array("slug"=>"2", "name"=>__("2 Slides", THEME_NAME)),
							array("slug"=>"3", "name"=>__("3 Slides", THEME_NAME)),
							array("slug"=>"4", "name"=>__("4 Slides", THEME_NAME)),
							array("slug"=>"5", "name"=>__("5 Slides", THEME_NAME)),
							array("slug"=>"6", "name"=>__("6 Slides", THEME_NAME)),
							array("slug"=>"7", "name"=>__("7 Slides", THEME_NAME)),
							array("slug"=>"8", "name"=>__("8 Slides", THEME_NAME)),
							array("slug"=>"9", "name"=>__("9 Slides", THEME_NAME)),
							array("slug"=>"10", "name"=>__("10 Slides", THEME_NAME)),

							),
						"std" => "5",
						"page_type" => array("homepage"),
						"protected" => array(
							array("id" => "_".$different_themes_managment->themeslug."_slider", "value" => "on")
						)
					),
					array(
						"type" => "select",
						"title" => __("Block Count", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_block_count",
						"options"=>array(
							array("slug"=>"3", "name"=>__("3 Blocks", THEME_NAME)),
							array("slug"=>"6", "name"=>__("6 Blocks", THEME_NAME)),

							),
						"std" => "6",
						"page_type" => array("homepage"),
						"protected" => array(
							array("id" => "_".$different_themes_managment->themeslug."_slider", "value" => "news")
						)
					),

					array(
						"type" => "checkbox",
						"title" => __("Auto Start", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_slider_auto",
						"page_type" => array("homepage"),
						"protected" => array(
							array("id" => "_".$different_themes_managment->themeslug."_slider", "value" => "on")
						)

					),
					array(
						"type" => "select",
						"title" => __("Slide Time", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_slider_time",
						"options"=>array(
							array("slug"=>"1000", "name"=>"1 Seccond"), 
							array("slug"=>"2000", "name"=>"2 Secconds"),
							array("slug"=>"3000", "name"=>"3 Secconds"),
							array("slug"=>"4000", "name"=>"4 Secconds"),
							array("slug"=>"5000", "name"=>"5 Secconds"),
							array("slug"=>"6000", "name"=>"6 Secconds"),
							array("slug"=>"7000", "name"=>"7 Secconds"),
							array("slug"=>"8000", "name"=>"8 Secconds"),
							array("slug"=>"9000", "name"=>"9 Secconds"),
							array("slug"=>"1000", "name"=>"10 Secconds"),

							),
						"std" => "5000",
						"page_type" => array("homepage"),
						"protected" => array(
							array("id" => "_".$different_themes_managment->themeslug."_slider", "value" => "on")
						)

					),
					array(
						"type" => "select",
						"title" => __("Slide Animation", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_slider_animation",
						"options"=>array(
							array("slug"=>"fade", "name"=>"Fade"), 
							array("slug"=>"slide", "name"=>"Slide"),

							),
						"std" => "fade",
						"page_type" => array("homepage"),
						"protected" => array(
							array("id" => "_".$different_themes_managment->themeslug."_slider", "value" => "on")
						)

					),
					array(
						"type" => "select",
						"title" => __("Slider Style", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_slider_style",
						"options"=>array(
							array("slug"=>"dark", "name"=>"Dark"), 
							array("slug"=>"light", "name"=>"Light"),

							),
						"std" => "light",
						"page_type" => array("homepage"),
						"protected" => array(
							array("id" => "_".$different_themes_managment->themeslug."_slider", "value" => "on")
						)

					),
					array(
						"type" => "select",
						"title" => __("Post Grid Style", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_slider_style",
						"options"=>array(
							array("slug"=>"dark", "name"=>"Dark"), 
							array("slug"=>"light", "name"=>"Light"),

							),
						"std" => "light",
						"page_type" => array("homepage"),
						"protected" => array(
							array("id" => "_".$different_themes_managment->themeslug."_slider", "value" => "news")
						)

					),

					array(
						"type" => "close",
						"page_type" => array("homepage")
					),
					array(
						"type" => "closesubtab",
						"hide_in"=> array(DF_POST_GALLERY),//post/page type

					),
					/* ------------------------------------------------------------------------*
					 * POST SETTINGS
					 * ------------------------------------------------------------------------*/   
					array(
						"type" => "meta_sub_tab",
						"slug"=>'post_settings',
						"skip_templates"=> array('homepage', 'gallery')//page template
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
					),	
					array(
						"type" => "title",
						"title" => __("Post Subtitle", THEME_NAME),
						"page_type" => array("post"),
					),
					array(
						"type" => "input",
						"title" => __("Subtitle:", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_subtitle",
						"page_type" => array("post"),
					),
									
					array(
						"type" => "close",
						"page_type" => array("post"),
					),	
					array(
						"type" => "row",
						"page_type" => array("post")
					),	

					array(
						"type" => "title",
						"title" => __("Show This Post In Main Slider?", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "checkbox",
						"title" => __("Show:",THEME_NAME),
						"id"=> '_'.$differentThemes_meta_fields->themeslug."_main_slider",
						"page_type" => array("post")
					),
									
					array(
						"type" => "close",
						"page_type" => array("post")
					),	
					array(
						"type" => "row",
						"page_type" => array("post")
					),	

					array(
						"type" => "title",
						"title" => __("Show This Post In Main News Block?", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "checkbox",
						"title" => __("Show:",THEME_NAME),
						"id"=> '_'.$differentThemes_meta_fields->themeslug."_main_news",
						"page_type" => array("post")
					),
									
					array(
						"type" => "close",
						"page_type" => array("post")
					),					
					array(
						"type" => "row",
						"page_type" => array("post","page",DF_POST_GALLERY),
						"skip_templates" => array("homepage","contact","gallery"),
					),	
					array(
						"type" => "title",
						"title" => __("Show Title in Single View?", THEME_NAME),
						"page_type" => array("post","page",DF_POST_GALLERY),
						"skip_templates" => array("homepage","contact","gallery"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_show_title",
						"radio" => array(
							array("title" => __("Yes:", THEME_NAME), "value" => "show"),
							array("title" => __("No:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"page_type" => array("post","page",DF_POST_GALLERY),
						"skip_templates" => array("homepage","contact","gallery"),
					),
									
					array(
						"type" => "close",
						"page_type" => array("post","page",DF_POST_GALLERY),
						"skip_templates" => array("homepage","contact","gallery"),
					),						
				
					array(
						"type" => "row",
						"page_type" => array("post")
					),

					array(
						"type" => "textarea",
						"title" => __('Ratings', THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_ratings",
						"info" => __('Enter the ratings like this - Graphics:5; Gameplay:4,5; Sound:3; Storyline:4',THEME_NAME),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("contact")
					),
					array(
						"type" => "title",
						"title" => __("Contact Page Email", THEME_NAME),
						"page_type" => array("contact")
					),
					array(
						"type" => "input",
						"title" => __("Email:", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_contact_mail",
						"page_type" => array("contact")
					),

					array(
						"type" => "close",
						"page_type" => array("contact")
					),
					array(
						"type" => "row",
						"page_type" => array("contact")
					),
					array(
						"type" => "title",
						"title" => __("Contact Page Google Map", THEME_NAME),
						"page_type" => array("contact")
					),
					array(
						"type" => "input",
						"title" => __("Map Url:", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_map",
						"page_type" => array("contact")
					),

					array(
						"type" => "close",
						"page_type" => array("contact")
					),

					array(
						"type" => "closesubtab",
						"skip_templates"=> array('homepage', 'gallery')//page template
					),
					/* ------------------------------------------------------------------------*
					 * SIDEBAR SETTINGS
					 * ------------------------------------------------------------------------*/   
					array(
						"type" => "meta_sub_tab",
						"slug"=>'sidebar'
					),
					array(
						"type" => "row"
					),
					array(
						"type" => "title",
						"title" => __('Sidebar Side', THEME_NAME),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_sidebar_position",
						"radio" => array(
							array("title" => __("Right:", THEME_NAME), "value" => "right"),
							array("title" => __("Left:", THEME_NAME), "value" => "left")
						),
						"std" => 'right',
						"compare" => get_option(THEME_NAME.'_sidebar_position'),
					),
					array(
						"type" => "title",
						"title" => __('Sidebar Name', THEME_NAME),
					),
					array(
						"type" => "sidebar_select",
						"title" => __('Sidebar', THEME_NAME),
						"id" => "_".$different_themes_managment->themeslug."_sidebar_select",
					),

					array(
						"type" => "close"
					),
					array(
						"type" => "closesubtab"
					),
		 			array(
						"type" => "close"
					)

				),
			),

		),
	)
);


$differentThemes_meta_fields->add_options($differentThemes_meta_options);


$different_themes_meta_options = $differentThemes_meta_fields->get_options();


function different_themes_meta_box() {
	$image = '<img src="'.THEME_IMAGE_CPANEL_URL.'logo-differentthemes-2.png" style="margin: 0 3px -5px 0;"/> ';
    $screens = array( 'post', 'page', DF_POST_GALLERY );
    foreach ( $screens as $screen ) {
        add_meta_box('different-themes-custom-'.$screen.'-data', ''.$image.__('Post Custom Settings', THEME_NAME), 'different_themes_meta_content', $screen, 'normal', 'high');
    }

}


 

function different_themes_meta_content($post) { 
	global $differentThemes_meta_fields;
	echo $differentThemes_meta_fields->print_options();
}


add_action( 'admin_menu', 'different_themes_meta_box' );

function save_meta_data($value) {
		global $post_id;
		
		$nonsavable_types = array(
			'navigation', 
			'tab',
			'sub_navigation',
			'meta_sub_navigation',
			'sub_tab',
			'meta_sub_tab',
			'homepage_set_test',
			'save',
			'closesubtab',
			'closetab',
			'row',
			'close'
		);

		if(isset($value['id'])) {
			$old = get_post_meta($post_id, $value['id'], true);
			if(isset($_REQUEST[$value['id']])) {
				$new = $_REQUEST[$value['id']];
			} else {
				$new = false;
			}
		}
		


		if(isset($value['id']) && isset($new) && !in_array($value['type'],$nonsavable_types)) {
			
			if($value['type']=="checkbox" && $new=="on" && $new!=$old){
				update_post_meta($post_id, $value['id'], $new);
			} elseif($value['type']=="checkbox" && $new!="on" && $new!=$old){
				update_post_meta($post_id, $value['id'], $new);
			}

			if($value['type']!="checkbox") {
				update_post_meta($post_id, $value['id'], $new);
				
			}

		}  elseif(!in_array($value['type'], $nonsavable_types) && isset($value['id'])){
			delete_post_meta($post_id, $value['id'], $old);
		}

		//set average rating for easier post sorting
		if(isset($value['id']) && $value['id']=="_".THEME_NAME."_ratings") {
			$average = df_avarage_rating($post_id);
			update_post_meta($post_id, $value['id']."_average", $average[1]);
		}
		
	}

	// Save data from meta box
	function save_sticky_data($post_id) {

		global $different_themes_meta_options;
		$nonsavable_types = array(
			'navigation', 
			'tab',
			'sub_navigation',
			'meta_sub_navigation',
			'sub_tab',
			'meta_sub_tab',
			'homepage_set_test',
			'save',
			'closesubtab',
			'closetab',
			'row',
			'close'
		);
		
		// verify nonce
		if (isset($_POST['sticky_meta_box_nonce']) && !wp_verify_nonce($_POST['sticky_meta_box_nonce'], "different-themes")) {
			die( _e('Security check', THEME_NAME) );
		} else {

			// check autosave
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return $post_id;
			}

			// check permissions
			if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
				if (!current_user_can('edit_page', $post_id)) {
					return $post_id;
				}
			} elseif (!current_user_can('edit_post', $post_id)) {
				return $post_id;
			}

			//insert the default values if the fields are empty

			foreach ($different_themes_meta_options[0]['blocks'][0]['options'] as $block) {
				if( isset( $block['id'] ) && get_post_meta($post_id,$block['id'],true)=='' && isset($block['std']) && !in_array($block['type'], $nonsavable_types)){
					update_post_meta($post_id, $block['id'], $block['std']);
				} else {
					save_meta_data($block);
					
				}
			}



		}
	}

	add_action('save_post', 'save_sticky_data');




$prefix = "_".THEME_NAME.'_';
$image = '<img src="'.THEME_IMAGE_CPANEL_URL.'logo-differentthemes-2.png" style="margin: 0 3px -5px 0;"/> ';

$homeID = DF_get_page('homepage');




if(isset($_GET['post'])) {
	$currentID = $_GET['post'];
} else {
	$currentID = 0;
}

global $box_array;

$box_array = array();

$box_array[] = array('id' => 'post-0','title' => ''.$image.__("Main Slider/News Block Image", THEME_NAME),'page' => 'post', 'context' => 'side','priority' => 'low','fields' => array(array('name' => __("Image:", THEME_NAME),'std' => '','id' => $prefix. 'homepage_image','type'=> 'slider_image_box')),'size' => 10,'first' => 'yes');
$box_array[] = array('id' => 'post-1','title' => ''.$image.__("SoundCloud Embed Code", THEME_NAME),'page' => 'post', 'context' => 'side','priority' => 'low','fields' => array(array('name' => __("Code:", THEME_NAME),'std' => '','id' => $prefix. 'audio','type'=> 'textarea')),'size' => 10,'first' => 'no');
$box_array[] = array('id' => 'post-2','title' => ''.$image.__(" Vimeo/YouTube Video url", THEME_NAME),'page' => 'post', 'context' => 'side','priority' => 'low','fields' => array(array('name' => __("URL:", THEME_NAME),'std' => '','id' => $prefix. 'video','type'=> 'input')),'size' => 10,'first' => 'no');
$box_array[] = array( 'id' => 'post-slider-images', 'title' => ''.$image.__("Post Slider Images", THEME_NAME), 'page' => 'post', 'context' => 'side', 'priority' => 'low', 'fields' => array(array('name' => __("", THEME_NAME), 'std' => '', 'id' => $prefix. 'slider_images', 'type'=> 'image_select' ) ), 'size' => 0,'first' => 'no'  );


//gallery images
$box_array[] = array( 'id' => 'post-slider-images', 'title' => ''.$image.__("Gallery Images", THEME_NAME), 'page' => DF_POST_GALLERY, 'context' => 'side', 'priority' => 'low', 'fields' => array(array('name' => __("", THEME_NAME), 'std' => '', 'id' => $prefix. 'gallery_images', 'type'=> 'image_select' ) ), 'size' => 0,'first' => 'no'  );


//homepage 
if(in_array($currentID, $homeID) || isset($_POST['post_type'])) {

	$box_array[] = array( 
		'id' => 'home-drag-drop', 
		'title' => ''.$image.__("Homepage Builder", THEME_NAME), 
		'page' => 'page', 
		'context' => 'normal', 
		'priority' => 'high', 
		'fields' => array(
			array(
				'name' => '', 
				'std' => '', 'id' => $prefix. 'home_drag_drop', 
				'type'=> 'home_drag_drop' 
				) 
			), 
		'size' => 0,
		'first' => 'no'  
	);
}

// Add meta box
function add_sticky_box() {
	global $box_array;
	
	foreach ($box_array as $box) {
		add_meta_box($box['id'], $box['title'], 'sticky_show_box', $box['page'], $box['context'], $box['priority'], array('content'=>$box, 'first'=>$box['first'], 'size'=>$box['size']));
	}

}

function sticky_show_box( $post, $metabox) {
	show_box_funtion($metabox['args']['content'], $metabox['args']['first'], $metabox['args']['size']);
}

// Callback function to show fields in meta box
function show_box_funtion($fields, $first='no', $width='60') {
	global $post, $post_id;



	foreach ($fields['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		echo '<label for="', $field['id'], '">', $field['name'], '</label>';
	
		switch ($field['type']) {
			case 'slider_image_box':
				echo '<input class="upload input-text-1 df-upload-field" type="text" name="', $field['id'], '" id="', $field['id'], '" value="',  $meta ? remove_html_slashes($meta) :  remove_html_slashes($field['std']), '" style="width: 140px;"/><a href="#" class="df-upload-button">Button</a>';
				break;
			case 'image_select':
				df_gallery_image_select($field['id'],$meta);
				break;
			case 'home_drag_drop':
				global $differentThemes_fields;
				$differentThemes_fields = new DifferentThemesManagment(THEME_FULL_NAME,THEME_NAME);
			
				get_template_part(THEME_FUNCTIONS."drag-drop");
				$options = $differentThemes_fields->get_options();

				echo '
					<div style="vertical-align:top;clear: both;">
						'.$differentThemes_fields->print_options().'
					</div>';
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" ', $meta ? ' ' : '', ' style="width:100%; height:100px;">', $meta ? remove_html_slashes($meta) : remove_html_slashes($field['std']), '</textarea>';
				if($field['id'] == THEME_NAME."_ratings") { 
					$average = df_avarage_rating($post_id);
					echo '<input type="hidden" name="', $field['id'], '_average" id="', $field['id'], '_average" value="',$average[0],'"/> ';
				}
				break;
			case 'input':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" ', $meta ? ' ' : '', ' value="', $meta ? remove_html_slashes($meta) : remove_html_slashes($field['std']), '"/> ';
				break;
		}

	}

}

function save_data($fields) {
	global $post_id;

	foreach ($fields['fields'] as $field) {	
		$old = get_post_meta($post_id, $field['id'], true);
		if(isset($_POST[$field['id']])) {
			$new = $_POST[$field['id']];
			
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif (($new == '' || !$new)) {
				delete_post_meta($post_id, $field['id']);
			}//else if closer
		} else {
			delete_post_meta($post_id, $field['id']);
		}
	}//foreach closer
	
}

function save_datepicker($fields) {
	global $post_id;

	foreach ($fields['fields'] as $field) {	
		$old = get_post_meta($post_id, $field['id'], true);
		if(isset($_POST[$field['id']])) {
			$new = $_POST[$field['id']];
			
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], strtotime($new));
			} elseif (($new == '' || !$new) && $old) {
				delete_post_meta($post_id, $field['id'], strtotime($old));
			}//else if closer
		}
	}//foreach closer
	
}

function save_numbers($fields) { 
	global $post_id;
	foreach ($fields['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if(!is_numeric($new)) { 
			$new = preg_replace("/[^0-9]/","",$new);
		}
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}//else if closer
	}//foreach closer

}
// Save data from meta box
function save_meta_sticky_data($post_id) {
	global $box_array;

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($box_array as $box) {
		save_data($box);
	}

} //function closer
	add_action('admin_menu', 'add_sticky_box');	
	add_action('save_post', 'save_meta_sticky_data');

	
?>
