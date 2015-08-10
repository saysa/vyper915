(function($) {
	'use strict';

/* -------------------------------------------------------------------------*
 * 								SOCIAL POPOUP WINDOW
 * -------------------------------------------------------------------------*/
	jQuery('.df-share, .df-tweet, .df-pin, .df-pluss, .df-link').click(function(event) {
		var width  = 575,
			height = 400,
			left   = (jQuery(window).width()  - width)  / 2,
			top    = (jQuery(window).height() - height) / 2,
			url    = this.href,
			opts   = 'status=1' +
					 ',width='  + width  +
					 ',height=' + height +
					 ',top='    + top    +
					 ',left='   + left;

		window.open(url, 'twitter', opts);

		return false;
	});

/* -------------------------------------------------------------------------*
 * 								TWITTER BUTTON
 * -------------------------------------------------------------------------*/
	var API_URL = "http://cdn.api.twitter.com/1/urls/count.json",
		TWEET_URL = "https://twitter.com/intent/tweet";
    
	jQuery(".df-tweet").each(function() {
		var elem = jQuery(this),
		// Use current page URL as default link
		url = encodeURIComponent(elem.attr("data-url") || document.location.href),
		// Use page title as default tweet message
		text = elem.attr("data-text") || document.title,
		via = elem.attr("data-via") || "",
		related = encodeURIComponent(elem.attr("data-related")) || "",
		hashtags = encodeURIComponent(elem.attr("data-hashtags")) || "";
		
		// Set href to tweet page
		elem.attr({
			href: TWEET_URL + "?hashtags=" + hashtags + "&original_referer=" +
					encodeURIComponent(document.location.href) +
					"&source=tweetbutton&text=" + text + "&url=" + url + "&via=" + via,
			target: "_blank"
		});

		// Get count and set it as the inner HTML of .count
		jQuery.getJSON(API_URL + "?callback=?&url=" + url, function(data) {
			elem.parent().find("p.count-number").html(data.count);
		});
	});
	
/* -------------------------------------------------------------------------*
 * 								PINIT BUTTON
 * -------------------------------------------------------------------------*/
	var API_URL = "http://api.pinterest.com/v1/urls/count.json";
	
	jQuery(".df-pin").each(function() {
		var elem = jQuery(this),
		// Use current page URL as default link
		url = (elem.attr("data-url") || document.location.href);

		// Get count and set it as the inner HTML of .count
		jQuery.getJSON(API_URL + "?callback=?&url=" + url, function(data) {
			elem.parent().find("p.count-number").html(data.count);
		});
	});	
		
/* -------------------------------------------------------------------------*
 * 								LINKEDIN BUTTON
 * -------------------------------------------------------------------------*/
	var API_URL = "http://www.linkedin.com/countserv/count/share";
	
	jQuery(".df-link").each(function() {
		var elem = jQuery(this),
		// Use current page URL as default link
		url = (elem.attr("data-url") || document.location.href);

		// Get count and set it as the inner HTML of .count
		jQuery.getJSON(API_URL + "?callback=?&url=" + url, function(data) {
			elem.parent().find("p.count-number").html(data.count);
		});
	});	
	
 /* -------------------------------------------------------------------------*
 * 								FACEBOOK SHARE
 * -------------------------------------------------------------------------*/
function fbShare() {
	jQuery(".df-share").each(function() {
		var button = jQuery(this);
		var link = jQuery(this).attr('data-url');
		if(!link) {
			link = document.URL;
		}
		
		jQuery.ajax({
			url:df.adminUrl,
			type:"POST",
			data:"action=df_customFShare&link="+link,
			success:function(results) {
				button.parent().find('p.count-number').html(results);
			}
			
			
		});
	});	

}

addLoadEvent(fbShare);


/* -------------------------------------------------------------------------*
 * 								addLoadEvent
 * -------------------------------------------------------------------------*/
	function addLoadEvent(func) {
		var oldonload = window.onload;
		if (typeof window.onload != 'function') {
			window.onload = func;
		} else {
			window.onload = function() {
				if (oldonload) {
					oldonload();
				}
			func();
			}
		}
	}

/* -------------------------------------------------------------------------*
 * 						ADD CLASS TO COMMENT BUTTON					
 * -------------------------------------------------------------------------*/
jQuery(document).ready(function(){
	jQuery('#respond form input#submit').addClass('btn');

	
});

    /*---------------------------------
	  HIDE WOO EMPTY CART
	---------------------------------*/


	if ( $.cookie( "woocommerce_items_in_cart" ) > 0 ) {
		$('.hide_cart_widget_if_empty').closest('.widget').show();
	} else {
		$('.hide_cart_widget_if_empty').closest('.widget').hide();
	}

	jQuery('body').bind('adding_to_cart', function(){
	    jQuery(this).find('.hide_cart_widget_if_empty').closest('.widget').fadeIn();
	});

})(jQuery);