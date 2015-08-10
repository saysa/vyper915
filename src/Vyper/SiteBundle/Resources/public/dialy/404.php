 <?php 
	get_header();
?> 
<!-- Section -->
<section id="section">
    <div class="inner-wrapper">
        
        <!-- Main -->
        <div id="main" class="page404" role="main">
            <div class="row">
                <div class="grid_6">
                    <img src="<?php echo THEME_IMAGE_URL;?>404page.jpg" alt="<?php _e("404 Page", THEME_NAME);?>"/>
                </div>
                <div class="grid_6">
                    <h2><?php _e("404", THEME_NAME);?></h2>
                    <h4><?php _e("Something went terribly wrong...", THEME_NAME);?></h4>
                    <?php _e("But don't worry, it can happen to the best of us - and it just happened to you!<br> You can search something else or read this text one more time.", THEME_NAME);?>
                    <form method="get" action="<?php echo home_url();?>">
                        <input type="text" placeholder="<?php _e("Search...", THEME_NAME);?>" name="s" id="s"/>
                        <input type="submit" value="Search"/>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>


<?php 
	get_footer();
?>