jQuery(document).ready(function() {

    jQuery(function() {
        var menu = jQuery('.primary-menu .content-wrap > ul');
        jQuery(".menu-slide").click(function() {
            menu.slideToggle(500);
        });


        jQuery(window).on('resize', function(){
            if(!jQuery(".menu-slide").is(":visible")){
                menu.css({'display':''});
            }
        });
    });

    jQuery(".primary-menu").show();
    jQuery('.primary-menu ul.sf-menu').superfish({				// main menu settings
        hoverClass:  'over', 								// the class applied to hovered list items
        animation:   {opacity:'show',height:'show'},  		// fade-in and slide-down animation
        speed:       150,                          			// faster animation speed
        autoArrows:  true,                           		// disable generation of arrow mark-up
        dropShadows: true,                            		// disable drop shadows
        delay       : 0
    });

    jQuery(".video-thumb iframe").each(function(){
        var ifr_source = jQuery(this).attr('src');
        var wmode = "wmode=transparent";
        if(ifr_source.indexOf('?') != -1) jQuery(this).attr('src',ifr_source+'&'+wmode);
        else jQuery(this).attr('src',ifr_source+'?'+wmode);
    });

});