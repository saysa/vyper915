<?php
	add_shortcode('alert', 'alert_handler');

	function alert_handler($atts, $content=null, $code="") {

		return '<div class="alert '.$atts['type'].'">'.do_shortcode($content).'</div>';
	
	}
?>