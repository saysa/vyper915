<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	global $wp_query;


	$sidebar = get_post_meta( df_page_id(), "_".THEME_NAME.'_sidebar_select', true );
	
	if(is_category()) {
		$sidebar = df_get_option( get_cat_id( single_cat_title("",false) ), 'sidebar_select', false );
	}

	if($sidebar=='' && function_exists('is_woocommerce') && is_woocommerce()) {
		$sidebar = 'woocommerce_sidebar';
	}
	if($sidebar=='' && function_exists("is_bbpress") && is_bbpress()) {
		$sidebar = 'bbpress_sidebar';
	}

	if($sidebar=='' && function_exists("is_buddypress") && is_buddypress()) {
		$sidebar = 'buddypress_sidebar';
	}

	if ( !isset($sidebar) || $sidebar=='' || is_search() || is_tax()) {
		$sidebar='default';	
	}

?>
	<?php if($sidebar!="DFoff") { ?>
	  	<!-- Aside -->
        <aside id="sidebar" role="complementary">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?>
			<?php endif; ?>
		<!-- END Sidebar -->
		</aside>
	<?php } ?>
