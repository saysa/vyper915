jQuery(document).ready(function($) {
    'use strict';
    
    // Mobile menu
    setupMenu($('ul.main-menu'));
    setupMenu($('ul.top-menu'));
    setupMobileMenu();


    

    // Tabs
    jQuery(".tabs").tabs();
    
    // Accordion
    jQuery(".accordion").accordion({collapsible: true, heightStyle: "content"});
    
    // Flexslider
    jQuery(".flexslider").flexslider({animation: "fade", controlNav: false});
    
    // Gallery slider
    jQuery(".gallery-single").flexslider({slideshow : false,smoothHeight : true, controlNav: "thumbnails", animation: "slide"});
    
    // Fitvids
    jQuery("body").fitVids();

    /*==============================================================================
        Responsive navigation
    ===============================================================================*/
    function setupMenu($menu) {
        $menu.each(function() {
            var mobileMenu = $(this).clone();
            var mobileMenuWrap = $('<div></div>').append(mobileMenu);
            mobileMenuWrap.attr('class', "open-close-wrapper");
            $(this).parent().append(mobileMenuWrap);
            mobileMenu.attr('class', 'menu-mobile');
        });
    }
    function setupMobileMenu() {
        $(".inner-wrapper").each(function() {
            var clickTopOpenMenu = $(this).find(".click-to-open-menu");
            clickTopOpenMenu.click(function() {
                $(this).parent().find('.open-close-wrapper').slideToggle("fast");
            });
        });
    }

    $( window ).resize(function() {
        $(".open-close-wrapper").each(function() {
            $(this).hide();
        });
    });


    

    
    // Portfolio container
    var $container = $('.gallery-content');
   
    $container.isotope({
        layoutMode: 'fitRows'
    });
 
    

});