<?php
	add_shortcode('paragraph', 'paragraph_handler');

	function paragraph_handler($atts, $content=null, $code="") {

		return '<p class="lead">'.do_shortcode($content).'</p>';
	
	}
?>