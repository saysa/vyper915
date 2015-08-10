<?php
global $differentThemes_fields;
$differentThemes_general_options= array(


/* ------------------------------------------------------------------------*
 * HOME SETTINGS
 * ------------------------------------------------------------------------*/   

array(
	"type" => "homepage_blocks",
	"title" => __("Homepage Blocks:", THEME_NAME),
	"id" => $differentThemes_fields->themeslug."_homepage_blocks",
	"blocks" => array(
		array(
			"title" => __("Latest News Blocks", THEME_NAME),
			"type" => "homepage_news_block",
			"image" => "block-layout-one.png",
			"description" => __("Six small news with image & title.",THEME_NAME),
			"options" => array(

				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_homepage_news_block_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_cat",
					"taxonomy" => "category",
					"title" => "Set Category",
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			
			),
		),
		array(
			"title" => __("Latest News Blocks", THEME_NAME),
			"type" => "homepage_news_block_2",
			"image" => "block-layout-two.png",
			"description" => __("Two news blocks.",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_2_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
			
				array( "type" => "title", "title" => __("Block 1", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_homepage_news_block_2_count_1", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_2_cat_1",
					"taxonomy" => "category",
					"title" => "Set Category",
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_2_offset_1", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			
					
				array( "type" => "title", "title" => __("Block 2", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_homepage_news_block_2_count_2", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_2_cat_2",
					"taxonomy" => "category",
					"title" => "Set Category",
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_2_offset_2", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			
			),
		),
		array(
			"title" => __("Latest News Blocks", THEME_NAME),
			"type" => "homepage_news_block_3",
			"image" => "block-layout-three.png",
			"description" => __("Two column news.",THEME_NAME),
			"options" => array(

				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_3_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_homepage_news_block_3_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_3_cat",
					"taxonomy" => "category",
					"title" => "Set Category",
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_3_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			
			),
		),
		array(
			"title" => __("Reviews News Blocks", THEME_NAME),
			"type" => "homepage_news_block_4",
			"image" => "icon-review.png",
			"description" => __("Latest & top reviews.",THEME_NAME),
			"options" => array(

				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_4_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_homepage_news_block_4_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_4_cat",
					"taxonomy" => "category",
					"title" => "Set Category",
					"home" => "yes"
				),				
				array(
					"type" => "select",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_4_style",
					"title" => "Type",
					"options"=>array(
						array("slug"=>"latest", "name"=>"Latest Reviews"), 
						array("slug"=>"top", "name"=>"Top Reviews"),
					),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_4_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			
			),
		),
		array(
			"title" => __("Latest News Blocks", THEME_NAME),
			"type" => "homepage_news_block_5",
			"image" => "block-layout-five.png",
			"description" => __("Default Blog Style",THEME_NAME),
			"options" => array(

				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_5_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_homepage_news_block_5_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_5_cat",
					"taxonomy" => "category",
					"title" => "Set Category",
					"home" => "yes"
				),				
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_5_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			
			),
		),
		array(
			"title" => __("Popular News Blocks", THEME_NAME),
			"type" => "homepage_news_block_6",
			"image" => "block-layout-one.png",
			"description" => __("Six small news with image & title.",THEME_NAME),
			"options" => array(

				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_6_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_homepage_news_block_6_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_6_cat",
					"taxonomy" => "category",
					"title" => "Set Category",
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_6_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			
			),
		),
		array(
			"title" => __("Popular News Blocks", THEME_NAME),
			"type" => "homepage_news_block_7",
			"image" => "block-layout-two.png",
			"description" => __("Two news blocks.",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_7_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
			
				array( "type" => "title", "title" => __("Block 1", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_homepage_news_block_7_count_1", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_7_cat_1",
					"taxonomy" => "category",
					"title" => "Set Category",
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_7_offset_1", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			
					
				array( "type" => "title", "title" => __("Block 2", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_homepage_news_block_7_count_2", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_7_cat_2",
					"taxonomy" => "category",
					"title" => "Set Category",
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_7_offset_2", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			
			),
		),
		array(
			"title" => __("Popular News Blocks", THEME_NAME),
			"type" => "homepage_news_block_8",
			"image" => "block-layout-three.png",
			"description" => __("Two column news.",THEME_NAME),
			"options" => array(

				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_8_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_homepage_news_block_8_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_8_cat",
					"taxonomy" => "category",
					"title" => "Set Category",
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_8_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			
			),
		),
		array(
			"title" => __("Popular News Blocks", THEME_NAME),
			"type" => "homepage_news_block_9",
			"image" => "block-layout-five.png",
			"description" => __("Default Blog Style",THEME_NAME),
			"options" => array(

				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_9_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_homepage_news_block_9_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_9_cat",
					"taxonomy" => "category",
					"title" => "Set Category",
					"home" => "yes"
				),				
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_9_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			
			),
		),
		array(
			"title" => __("Shop Items", THEME_NAME),
			"type" => "homepage_news_block_10",
			"image" => "icon-shop.png",
			"description" => __("Latest/Featured Shop Items",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_10_title", "title" => __("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $differentThemes_fields->themeslug."_homepage_news_block_10_count", "title" => __("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_10_cat",
					"taxonomy" => "product_cat",
					"title" => "Set Category",
					"home" => "yes"
				),
				array(
					"type" => "select",
					"id" => $differentThemes_fields->themeslug."_homepage_news_block_10_type",
					"title" => __("Type", THEME_NAME),
					"options"=>array(
						array("slug"=>"latest", "name"=>__("Latest Items", THEME_NAME)), 
						array("slug"=>"featured", "name"=>__("Fetured Items", THEME_NAME)),
					),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $differentThemes_fields->themeslug."_homepage_news_block_10_offset", "title" => __("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			),
		),
		array(
			"title" => __("HTML Code", THEME_NAME),
			"type" => "homepage_html",
			"image" => "icon-html.png",
			"description" => __("Custom HTML/Shortcodes Block",THEME_NAME),
			"options" => array(
				array( "type" => "textarea", "id" => $differentThemes_fields->themeslug."_homepage_html", "title" => __("HTML Code:",THEME_NAME), "home" => "yes" ),
			),
		),
		array(
			"title" => __("Banner Block", THEME_NAME),
			"type" => "homepage_banner",
			"image" => "icon-banner.png",
			"description" => __("Supports HTML,CSS and Javascript.",THEME_NAME),
			"options" => array(
				array( "type" => "textarea", "id" => $differentThemes_fields->themeslug."_homepage_banner", "title" => __("HTML Code:",THEME_NAME), "home" => "yes","sample" => '<a href="http://www.different-themes.com" target="_blank"><img src="'.THEME_IMAGE_URL.'728x90.gif" alt="" title="" /></a>', ),
			),
		),
	)
),


 
 );



$differentThemes_fields->add_options($differentThemes_general_options);
?>
