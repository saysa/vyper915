<?php

	//fonts
	$google_font_1 = get_option(THEME_NAME."_google_font_1");
	$google_font_2 = get_option(THEME_NAME."_google_font_2");


?>
/*==============================================================================
    Open Sans
===============================================================================*/
body,
h1#site-logo,
.single-post h3.lead {
    font-family: '<?php echo $google_font_1;?>', 'sans-serif';
}

/*==============================================================================
    Droid Serif
===============================================================================*/
h1, h2, h3, h4, h5, h6,
h3.widget-title,
.dropcap:first-letter,
p.title,
.ui-tabs-nav,
.post-controls a p,
.accordion .title,
h1#site-logo span,
#groups-list-options,
#members-list-options,
ul#groups-list li .item a,
ul#members-list li .item a {
    font-family: '<?php echo $google_font_2;?>', serif;
}