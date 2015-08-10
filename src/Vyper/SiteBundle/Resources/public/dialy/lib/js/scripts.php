<?php
	header("Content-type: text/javascript");

	$mainMenuStyle = get_option ( THEME_NAME."_main_menu" );
?>
    <?php 
    	if($mainMenuStyle!="normal") {
    ?>
jQuery(document).ready(function($) {
    'use strict';
    // Sticky navigation
    if(jQuery( "body" ).hasClass( "admin-bar" )) {
        jQuery("body.admin-bar .sticky-menu").fixTo('body', {top: 32});
    } else {
        jQuery(".primary-menu.sticky-menu").fixTo('body');
    }
});
    <?php } ?>

	//form validation
	function validateName(fld) {
			
		var error = "";
				
		if (fld.value === '' || fld.value === '<?php _e("Nickname", THEME_NAME);?>' || fld.value === '<?php _e("First Name", THEME_NAME);?>') {
			error = "<?php _e( 'You didn\'t enter Your First Name.' , THEME_NAME );?>\n";
		} else if ((fld.value.length < 2) || (fld.value.length > 50)) {
			error = "<?php _e( 'First Name is the wrong length.' , THEME_NAME );?>\n";
		}
		return error;
	}
			
	function validateEmail(fld) {

		var error="";
		var illegalChars = /^[^@]+@[^@.]+\.[^@]*\w\w$/;
				
		if (fld.value === "") {
			error = "<?php _e( 'You didn\'t enter an email address.' , THEME_NAME );?>\n";
		} else if ( fld.value.match(illegalChars) === null) {
			error = "<?php _e( 'The email address contains illegal characters.' , THEME_NAME );?>\n";
		}

		return error;

	}
			
	function validateMessage(fld) {

		var error = "";
				
		if (fld.value === '' || fld.value === '<?php _e("Message", THEME_NAME);?>') {
			error = "<?php _e( 'You didn\'t enter Your message.' , THEME_NAME );?>\n";
		} else if (fld.value.length < 3) {
			error = "<?php _e( 'The message is to short.' , THEME_NAME );?>\n";
		}

		return error;
	}

	function validateLastname(fld) {
			
		var error = "";

				
		if (fld.value === '' || fld.value === 'Nickname' || fld.value === 'Enter Your Name..' || fld.value === 'Your Name..') {
			error = "<?php _e( 'You didn\'t enter Your last name.' , THEME_NAME );?>\n";
		} else if ((fld.value.length < 2) || (fld.value.length > 50)) {
			error = "<?php  _e( 'Last Name is the wrong length.' , THEME_NAME );?>\n";
		}
		return error;
	}

	function validatePhone(fld) {
			
		var error = "";
		var illegalChars = /^\+?s*\d+\s*$/;

		if (fld.value === '') {
			error = "<?php _e( 'You didn\'t enter Your phone number.' , THEME_NAME );?>\n";
		} else if ( fld.value.match(illegalChars) === null) {
			error = "<?php _e( 'Please enter a valid phone number.' , THEME_NAME );?>\n";
		}
		return error;
	}


(function($) {   
'use strict'; 


})(jQuery);