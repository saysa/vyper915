<?php
	header("Content-type: text/css");

	
	$banner_type = get_option ( THEME_NAME."_banner_type" );

	$color_1 = get_option ( THEME_NAME."_color_1" );
	$color_2 = get_option ( THEME_NAME."_color_2" );
	$color_3 = get_option ( THEME_NAME."_color_3" );
	$color_4 = get_option ( THEME_NAME."_color_4" );
	$color_5 = get_option ( THEME_NAME."_color_5" );
	$color_6 = get_option ( THEME_NAME."_color_6" );
	$color_7 = get_option ( THEME_NAME."_color_7" );


	//body bg options
	$bodyBgType = get_option ( THEME_NAME."_body_bg_type" );
	$bodyPattern = get_option ( THEME_NAME."_body_pattern" );
	$bodyColor = get_option ( THEME_NAME."_body_color" );
	$bodyImage = get_option ( THEME_NAME."_body_image" );

	
	
?>



/*==============================================================================
    Color (Blue)
===============================================================================*/
a,
h1#site-logo,
h1#site-logo a,
.weather-report .report,
#sidebar h3.widget-title,
.tabs .ui-tabs-nav li.ui-state-active a,
article .post-meta span:before,
.post-info span:before,
.post-controls a:hover,
.post-controls a span i,
.accordion .title.ui-state-active,
.above-the-fold h2.page-title,
.page404 h2,
#groups-list-options a.selected,
#members-list-options a.selected {color: #<?php echo $color_1;?> }


/*==============================================================================
    Background color (Blue)
===============================================================================*/
.tagcloud a:hover,
.tagcloud-custom a:hover,
#footer .tagcloud a:hover,
ul.page-numbers li span.current,
ul.page-numbers li a:hover,
.onsale,
.price_slider_wrapper .ui-slider-range,
a.selected-gallery-filter,
.block-layout-one .item span,
.post-box-text span,
.block-layout-two .main-item .post-img span,
.block-layout-three .main-item .post-img span,
.block-layout-four .main-item .post-img span,
.block-layout-five .main-item .post-img span,
table.cart td.actions .coupon .button,
ul.top-rated .rating-total strong {background-color: #<?php echo $color_2;?> }


/*==============================================================================
    Border color (Blue)
===============================================================================*/
.price_slider_wrapper .ui-slider-handle,
.block-layout-three .item img,
.block-layout-two .item img,
.block-layout-one .item img {border-color: #<?php echo $color_3;?> }



/* POPUP BANNER */

<?php
	if ( $banner_type == "image" ) {
	//Image Banner
?>
		#overlay { width:100%; height:100%; position:fixed;  _position:absolute; top:0; left:0; z-index:10003; background-color:#000000; overflow: hidden;  }
		#popup { display: none; position:absolute; width:auto; height:auto; z-index:10004; color: #000; font-family: Tahoma,sans-serif;font-size: 14px; }
		#baner_close { width: 22px; height: 25px; background: url(<?php echo THEME_IMAGE_URL; ?>close.png) 0 0 repeat; text-indent: -5000px; position: absolute; right: -10px; top: -10px; }
<?php
	} else if ( $banner_type == "text" ) {
	//Text Banner
?>
		#overlay { width:100%; height:100%; position:fixed;  _position:absolute; top:0; left:0; z-index:10003; background-color:#000000; overflow: hidden;  }
		#popup { display: none; position:absolute; width:auto; height:auto; max-width:700px; z-index:10004; border: 1px solid #000; background: #e5e5e5 url(<?php echo THEME_IMAGE_URL; ?>dotted-bg-6.png) 0 0 repeat; color: #000; font-family: Tahoma,sans-serif;font-size: 14px; line-height: 24px; border: 1px solid #cccccc; -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px; text-shadow: #fff 0 1px 0; }
		#popup center { display: block; padding: 20px 20px 20px 20px; }
		#baner_close { width: 22px; height: 25px; background: url(<?php echo THEME_IMAGE_URL; ?>close.png) 0 0 repeat; text-indent: -5000px; position: absolute; right: -12px; top: -12px; }
<?php 
	} else if ( $banner_type == "text_image" ) {
	//Image And Text Banner
?>
		#overlay { width:100%; height:100%; position:fixed;  _position:absolute; top:0; left:0; z-index:10003; background-color:#000000; overflow: hidden;  }
		#popup { display: none; position:absolute; width:auto; z-index:10004; color: #000; font-size: 11px; font-weight: bold; }
		#popup center { padding: 15px 0 0 0; }
		#baner_close { width: 22px; height: 25px; background: url(<?php echo THEME_IMAGE_URL; ?>close.png) 0 0 repeat; text-indent: -5000px; position: absolute; right: -10px; top: -10px; }
<?php } ?>


/* ==========================================================================
   Body
   ========================================================================== */
<?php if($bodyBgType=="pattern") { ?>
body { 
	background-color: #ddd; 
	background-image: url(<?php echo THEME_IMAGE_URL;?>patterns/<?php echo $bodyPattern;?>.png)
}
<?php } elseif($bodyBgType=="color") { ?>
body { 
	background-color: #<?php echo $bodyColor;?>; 
}
<?php } elseif($bodyBgType=="image") { ?>
body { 
	background-image: url(<?php echo $bodyImage;?>);
	background-attachment:fixed;
	background-position:center;
}
<?php } ?>