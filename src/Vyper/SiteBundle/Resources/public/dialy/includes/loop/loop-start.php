<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    wp_reset_query();
	$sidebar = get_post_meta( df_page_id(), "_".THEME_NAME.'_sidebar_select', true );
    $contentId = df_page_id();

    if(is_category()) {
        $sidebar = df_get_option( get_cat_id( single_cat_title("",false) ), 'sidebar_select', false );
    }

    //get current cat id
    $catId = get_cat_id( single_cat_title("",false) );
 
?>
    <?php get_template_part(THEME_SINGLE."image","full"); ?> 
    <!-- Section -->
    <section id="section">
        <div class="inner-wrapper">
            
            <!-- Main -->
            <div id="main"<?php if($sidebar!="DFoff") { ?> class="<?php DF_content_class($contentId);?>"<?php } ?> role="main">

     
