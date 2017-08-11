<?php

class Luxicar_Shortcode{
	
	function __construct(){
		add_action('admin_init', array($this, 'admin_init'));
	}

	public function admin_init(){
		if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
			add_filter('mce_external_plugins', array($this, 'mce_external_plugins'));
			add_filter('mce_buttons', array($this, 'mce_buttons'));
		}
	}

	public function mce_external_plugins($plugin_array) {
	    $plugin_array['luxicar_shortcodes'] = LT_DIR . "assets/js/tinymce.js";
	    return $plugin_array;
	}

	public function mce_buttons($buttons) {
	    $buttons[] = 'luxicar_shortcodes';
	    return $buttons;
	}

	public function load_shortcodes(){

		require LT_PATH . 'inc/shortcodes/blockquote_1.php';
		require LT_PATH . 'inc/shortcodes/blockquote_2.php';
		require LT_PATH . 'inc/shortcodes/button.php';
		require LT_PATH . 'inc/shortcodes/grid.php';
		require LT_PATH . 'inc/shortcodes/highlight.php';
		require LT_PATH . 'inc/shortcodes/progressbar.php';
		require LT_PATH . 'inc/shortcodes/stickynote.php';
		require LT_PATH . 'inc/shortcodes/partner.php';
		require LT_PATH . 'inc/shortcodes/pricing_table.php';
		require LT_PATH . 'inc/shortcodes/map.php';
		require LT_PATH . 'inc/shortcodes/fancy_heading.php';

		require LT_PATH . 'inc/shortcodes/tabs.php';		
		require LT_PATH . 'inc/shortcodes/accordions.php';
		require LT_PATH . 'inc/shortcodes/toggle.php';
		require LT_PATH . 'inc/shortcodes/dropcaps.php';
		require LT_PATH . 'inc/shortcodes/alert.php';
		require LT_PATH . 'inc/shortcodes/social.php';
		require LT_PATH . 'inc/shortcodes/list.php';
		
		
		require LT_PATH . 'inc/shortcodes/gallery.php';
		require LT_PATH . 'inc/shortcodes/soundclound.php';
		require LT_PATH . 'inc/shortcodes/vimeo.php';

		require LT_PATH . 'inc/shortcodes/counter.php';
		require LT_PATH . 'inc/shortcodes/icon-link.php';
		require LT_PATH . 'inc/shortcodes/bottom-bar.php';
		require LT_PATH . 'inc/shortcodes/info.php';
		require LT_PATH . 'inc/shortcodes/portfolio.php';
		require LT_PATH . 'inc/shortcodes/appointment.php';
		require LT_PATH . 'inc/shortcodes/service.php';
		require LT_PATH . 'inc/shortcodes/service_big.php';
		require LT_PATH . 'inc/shortcodes/single-service.php';
	}
}

$luxicar_toolkit_shortcodes = new Luxicar_Shortcode();
$luxicar_toolkit_shortcodes->load_shortcodes();