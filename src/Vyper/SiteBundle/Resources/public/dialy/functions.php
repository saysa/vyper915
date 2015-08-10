<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	define("THEME_NAME", 'dialy');
	define("THEME_FULL_NAME", 'Dialy Magazine');

	
	// THEME PATHS
	define("THEME_FUNCTIONS_PATH",TEMPLATEPATH."/functions/");
	define("THEME_INCLUDES_PATH",TEMPLATEPATH."/includes/");
	define("THEME_SCRIPTS_PATH",TEMPLATEPATH."/js/");
	define("THEME_AWEBER_PATH", THEME_FUNCTIONS_PATH."aweber_api/");
	define("THEME_ADMIN_INCLUDES_PATH", THEME_INCLUDES_PATH."admin/");
	define("THEME_WIDGETS_PATH", THEME_INCLUDES_PATH."widgets/");
	define("THEME_SHORTCODES_PATH", THEME_INCLUDES_PATH."shortcodes/");


	//POST TYPES
	define("DF_POST_GALLERY","gallery-item");

	define("THEME_FUNCTIONS", "functions/");
	define("THEME_INCLUDES", "includes/");
	define("THEME_SLIDERS", THEME_INCLUDES."sliders/");
	define("THEME_LOOP", THEME_INCLUDES."loop/");
	define("THEME_SINGLE", THEME_INCLUDES."single/");
	define("THEME_SHORTCODES", THEME_INCLUDES."shortcodes/");
	define("THEME_WIDGETS", THEME_INCLUDES."widgets/");
	define("THEME_ADMIN_INCLUDES", THEME_INCLUDES."admin/");
	define("THEME_HOME_BLOCKS", THEME_INCLUDES."home-blocks/");
	define("THEME_SCRIPTS", "lib/js/");
	define("THEME_CSS", "lib/css/");

	define("THEME_URL", get_template_directory_uri());

	define("THEME_CSS_URL",THEME_URL."/lib/css/");
	define("THEME_CSS_ADMIN_URL",THEME_URL."/lib/css/admin/");
	define("THEME_FONTS_URL",THEME_URL."/lib/font/");
	define("THEME_JS_URL",THEME_URL."/lib/js/");
	define("THEME_JS_ADMIN_URL",THEME_URL."/lib/js/admin/");
	define("THEME_IMAGE_URL",THEME_URL."/lib/img/");
	define("THEME_IMAGE_CPANEL_URL",THEME_IMAGE_URL."/control-panel-images/");
	define("THEME_FUNCTIONS_URL",THEME_URL."/functions/");
	define("THEME_SHORTCODES_URL",THEME_URL."/includes/shortcodes/");
	define("THEME_ADMIN_URL",THEME_URL."/includes/admin/");

	require_once(THEME_FUNCTIONS_PATH."tax-meta-class/tax-meta-class.php");
	require_once(THEME_INCLUDES_PATH."theme-config.php");
	require_once(THEME_FUNCTIONS_PATH."init.php");
	require_once(THEME_WIDGETS_PATH."init.php");
	require_once(THEME_SHORTCODES_PATH."init.php");
	
	require_once(THEME_INCLUDES_PATH."admin/notifier/update-notifier.php");
	
	function woo_no_title() {
		return false;
	}
	//woocomerce
	add_filter('woocommerce_show_page_title', 'woo_no_title');

	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

	function my_theme_wrapper_start() {
	  echo '<section id="main">';
	}

	function my_theme_wrapper_end() {
	  echo '</section>';
	}
	
	add_theme_support( 'woocommerce' );

	$shopCount = 8; 
	if($shopCount) {
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$shopCount.';' ), 20 );
	}

	if ( df_is_woocommerce_activated() == true && version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	} else {
		define( 'WOOCOMMERCE_USE_CSS', false );
	}

?>