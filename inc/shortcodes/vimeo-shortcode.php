<?php
/**
 * Shortcode vimeo
 * 
 */

function luxicar_toolkit_plus_webmaster_vimeo_handler( $atts, $content=null, $code="") {
	if(isset($atts['byline'])){
		$byline = $atts['byline'];
	}
	else{
		$byline = 0;
	}
	if(isset($atts['autoplay'])){
		$auto_play = 'true';
	}else{
		$auto_play = 'false';
	}
	if(isset($atts['portrait'])){
		$portrait = $atts['portrait'];
	}
	else{
		$portrait = 0;
	}

	if(isset($atts['width'])){
		$width = $atts['width'];
	}
	else{
		$width = "500";
	}
	if(isset($atts['height'])){
		$height = $atts['height'];
	}
	else{
		$height = "281";
	}

	if(isset($atts['title']) && ($atts['title'] == FALSE || $atts['title'] == 0 || strtolower($atts['title']) == 'no')){
		$title = 0;
	}else{
		$title = 1; 
	}

	if(isset($atts['class'])){
		$class=$atts['class'];
	}
	else{
		$class="";
	}
	if(is_category()){
		$list = '<iframe class="video-iframe" src="http://player.vimeo.com/video/'.$content.'?title=0&amp;byline=0&amp;portrait=0" height="'.($height/2).'"></iframe>';
	} else {
		$list = '<iframe class="video-iframe" src="http://player.vimeo.com/video/'.$content.'?title=0&amp;byline='.$byline.'&amp;portrait='.$portrait.'" height="'.$height.'"></iframe>';
	}
	return $list;
}

add_shortcode( 'vimeo', 'luxicar_toolkit_plus_webmaster_vimeo_handler' );


