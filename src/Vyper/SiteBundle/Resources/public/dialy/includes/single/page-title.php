<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	//single page titile
	$titleShow = get_post_meta ( df_page_id(), "_".THEME_NAME."_show_title", true );
	if(is_category()) {
		//custom colors
		$catId = get_cat_id( single_cat_title("",false) );
		$titleColor = df_title_color($catId, "category", false);
	} else {
		//custom colors
		$titleColor = df_title_color(df_page_id(),"page", false);
	}
	wp_reset_query();
?>					

<?php 
	//check if bbpress
	if (function_exists("is_bbpress") && is_bbpress()) {
		$DFbbpress = true;
	} else {
		$DFbbpress = false;
	}

?>
<?php if($titleShow!="hide") { ?>
    <!-- Page title -->
    <div id="above-the-fold" class="above-the-fold">
        <div class="inner-wrapper">
            <h2 class="page-title" style="color:<?php echo $titleColor;?>"><?php echo df_page_title(); ?></h2>
        </div>
    </div>    
<?php } ?>