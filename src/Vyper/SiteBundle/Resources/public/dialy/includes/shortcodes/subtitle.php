<?php
	add_shortcode('subtitle', 'subtitle_handler');

	function subtitle_handler($atts, $content=null, $code="") {

		return '<p class="title"><span>'.do_shortcode($content).'</span></p>';
	
	}
?>