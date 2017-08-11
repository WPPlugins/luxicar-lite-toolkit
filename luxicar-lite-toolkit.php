<?php
/*
Plugin Name: Luxicar Lite Toolkit
Description: A specific plugin use in Luxicar Lite Theme, included some custom widgets, and layout.
Version: 1.0.0
Author: Kopa Theme
Author URI: http://kopatheme.com
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Luxicar Toolkit plugin, Copyright 2015 Kopatheme.com
Luxicar Toolkit is distributed under the terms of the GNU GPL

Requires at least: 3.8
Tested up to: 4.3.1
Text Domain: luxicar-lite-toolkit
Domain Path: /languages/
*/

define('LT_DIR', plugin_dir_url(__FILE__));
define('LT_PATH', plugin_dir_path(__FILE__));
define('LTP_PREFIX', 'luxicar_toolkit_plus_');

add_action('plugins_loaded', array('Luxicar_Toolkit', 'plugins_loaded'));	
add_action('after_setup_theme', array('Luxicar_Toolkit', 'after_setup_theme'), 20 );	

class Luxicar_Toolkit {

	function __construct(){
		add_image_size( 'luxicar-widget-160x200', 160, 200, true );
		add_image_size( 'luxicar-widget-155x155', 155, 155, true );
		add_image_size( 'luxicar-widget-220x150', 220, 150, true );
		add_image_size( 'luxicar-widget-270x310', 270, 310, true );
		add_image_size( 'luxicar-widget-100x100', 100, 100, true );
		add_image_size( 'luxicar-widget-570x210', 570, 210, true );
		add_image_size( 'luxicar-widget-570x560', 570, 560, true );
		add_image_size( 'luxicar-widget-570x365', 570, 365, true );
		add_image_size( 'luxicar-widget-420x350', 420, 350, true );
		add_image_size( 'luxicar-widget-180x180', 180, 180, true );
		add_image_size( 'luxicar-widget-255x160', 255, 160, true );
		add_image_size( 'luxicar-widget-285x265', 285, 265, true );
		add_image_size( 'luxicar-widget-540x290', 540, 290, true );
		add_image_size( 'luxicar-widget-780x386', 780, 386, true );
		add_image_size( 'luxicar-widget-780x386', 780, 386, true );
		add_image_size( 'luxicar-widget-390x275', 390, 275, true );
		add_image_size( 'luxicar-widget-270x270', 270, 270, true );
		add_image_size( 'luxicar-widget-635x350', 635, 350, true );
		add_image_size( 'luxicar-widget-80x80', 80, 80, true );
		add_image_size( 'luxicar-widget-1170x380', 1170, 380, true );
		add_image_size( 'luxicar-widget-100x50', 100, 50, true );
		add_image_size( 'luxicar-widget-390x250', 390, 250, true );
		add_image_size( 'luxicar-widget-370x210', 370, 210, true );
		add_image_size( 'luxicar-widget-270x180', 370, 210, true );

		require LT_PATH . 'inc/hook.php';
		require LT_PATH . 'inc/util.php';
		require LT_PATH . 'inc/widget.php';
		require LT_PATH . 'inc/shortcode.php';

		# METABOX-FIELD
		require_once LT_PATH . 'inc/fields/metabox/icon.php';
		require_once LT_PATH . 'inc/fields/metabox/datetime.php';
		require_once LT_PATH . 'inc/fields/metabox/gallery.php';	

		# POSTTYPES
		require LT_PATH . 'inc/post-types/portfolio/portfolio.php';
		require LT_PATH . 'inc/post-types/team/team.php';
		require LT_PATH . 'inc/post-types/testimonial/testimonial.php';
		require LT_PATH . 'inc/post-types/partner/partner.php';
		require LT_PATH . 'inc/post-types/service/service.php';
		require LT_PATH . 'inc/post-types/slide/slide.php';

		# WIDGETS
		require LT_PATH . 'inc/widgets/contact/map.php';
		require LT_PATH . 'inc/widgets/contact/contact-form.php';
		require LT_PATH . 'inc/widgets/contact/contact-form-2.php';
		require LT_PATH . 'inc/widgets/contact/contact-info-4-columns.php';
		require LT_PATH . 'inc/widgets/contact/contact-info-4-columns-2.php';
		require LT_PATH . 'inc/widgets/contact/contact-info-3-columns.php';
		require LT_PATH . 'inc/widgets/contact/contact-info-2-columns.php';
		require LT_PATH . 'inc/widgets/contact/contact-info-logo.php';
		require LT_PATH . 'inc/widgets/post/article-list-3-columns-370-210.php';
		require LT_PATH . 'inc/widgets/post/article-list-1-column-255-160.php';
		require LT_PATH . 'inc/widgets/post/featured-post.php';
		require LT_PATH . 'inc/widgets/post/news-testimonials.php';
		require LT_PATH . 'inc/widgets/misc/multimenu.php';
		require LT_PATH . 'inc/widgets/misc/counter.php';

		if(is_admin()){

			add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'), 20);
			add_action('admin_init', 'luxicar_toolkit_register_metabox_description');

			#metabox-custom-field
			add_filter('kopa_admin_meta_box_field_gallery', 'luxicar_toolkit_metabox_field_gallery', 10, 5);

			#metabox-custom-wrap
			add_filter('kopa_admin_meta_box_wrap_start', 'luxicar_toolkit_meta_box_wrap_start', 10, 3);
			add_filter('kopa_admin_meta_box_wrap_end', 'luxicar_toolkit_meta_box_wrap_end', 10, 3);			
		}
		add_action('luxicar_lite_print_single_post_author', 'luxicar_toolkit_print_single_post_author');
		add_filter('user_contactmethods', 'luxicar_toolkit_add_social_field');
	}

	public static function plugins_loaded(){
		load_plugin_textdomain('luxicar-lite-toolkit', false, LT_PATH . '/languages/');
	}

	public static function after_setup_theme(){
		if (!class_exists('Kopa_Framework'))
			return; 		
		else	
			new Luxicar_Toolkit();							
	}

	public function admin_enqueue_scripts($hook){
		if(in_array($hook, array('widgets.php', 'post.php', 'post-new.php'))){	        
			wp_enqueue_style( 'jquery-datetimepicker', plugins_url("assets/css/jquery.datetimepicker.css", __FILE__), NULL, NULL);
			wp_enqueue_style('kopa_font_awesome');
			// wp_enqueue_style( LTP_PREFIX . 'metabox', plugins_url("assets/css/metabox.css", __FILE__), NULL, NULL);			

			wp_enqueue_script( 'jquery-datetimepicker-js', plugins_url("assets/js/jquery.datetimepicker.js", __FILE__), array('jquery'), NULL, TRUE);
			wp_enqueue_script( 'metabox', plugins_url("assets/js/metabox.js", __FILE__), array('jquery'), NULL, TRUE);

			wp_enqueue_style('luxicar-toolkit-metabox', LT_DIR . "assets/css/metabox.css", array(), NULL);
			wp_enqueue_style('luxicar-toolkit-tinymce', LT_DIR . "assets/css/tinymce.css", array(), NULL);
			wp_enqueue_script('luxicar-toolkit-gallery', LT_DIR . "assets/js/gallery.js", array('jquery'), NULL, TRUE);
			wp_localize_script('jquery', 'luxicar_toolkit', array(
				'i18n' => array(
					'shortcodes'                => esc_html__('Shortcodes', 'luxicar-lite-toolkit'),
					'typography'                => esc_html__('Typography', 'luxicar-lite-toolkit'),
					'common'                    => esc_html__('Common', 'luxicar-lite-toolkit'),
					'infor_media'               => esc_html__('Infographic', 'luxicar-lite-toolkit').' & '.esc_html__('Media', 'luxicar-lite-toolkit'),
					'blockquote'                => esc_html__('Blockquote', 'luxicar-lite-toolkit'),
					'blockquote_style_1'        => esc_html__('Blockquote style 1', 'luxicar-lite-toolkit'),
					'blockquote_style_2'        => esc_html__('Blockquote style 2', 'luxicar-lite-toolkit'),
					'blockquote_style_3'        => esc_html__('Blockquote style 3', 'luxicar-lite-toolkit'),
					'buttons'                   => esc_html__('Button', 'luxicar-lite-toolkit'),
					'normal_buttons'            => esc_html__('Normal buttons', 'luxicar-lite-toolkit'),
					'icon_buttons'              => esc_html__('Buttons with icon', 'luxicar-lite-toolkit'),
					'default_button'            => esc_html__('Default', 'luxicar-lite-toolkit'),
					'blue_button'               => esc_html__('Blue', 'luxicar-lite-toolkit'),
					'orange_button'             => esc_html__('Orange', 'luxicar-lite-toolkit'),
					'green_button'              => esc_html__('Green', 'luxicar-lite-toolkit'),
					'red_button'                => esc_html__('Red', 'luxicar-lite-toolkit'),
					'yellow_button'             => esc_html__('Yellow', 'luxicar-lite-toolkit'),
					'small'                     => esc_html__('Small', 'luxicar-lite-toolkit'),
					'normal'                    => esc_html__('Normal', 'luxicar-lite-toolkit'),
					'large'                     => esc_html__('Large', 'luxicar-lite-toolkit'),
					'column'                    => esc_html__('Column', 'luxicar-lite-toolkit'),
					'dropcap'                   => esc_html__('Drop', 'luxicar-lite-toolkit'),
					'dropcap_transparent'       => esc_html__('Normal', 'luxicar-lite-toolkit'),
					'dropcap_background'        => esc_html__('Background', 'luxicar-lite-toolkit'),
					'fancy_heading'             => esc_html__('Fancy heading', 'luxicar-lite-toolkit'),
					'fancy_heading_left'        => esc_html__('Fancy heading left', 'luxicar-lite-toolkit'),
					'fancy_heading_center'      => esc_html__('Fancy heading center', 'luxicar-lite-toolkit'),
					'fancy_heading_center_icon' => esc_html__('Fancy heading center icon', 'luxicar-lite-toolkit'),
					'highlight'                 => esc_html__('Highlight', 'luxicar-lite-toolkit'),
					'underline_hl'              => esc_html__('Underline', 'luxicar-lite-toolkit'),
					'black_hl'                  => esc_html__('Black background', 'luxicar-lite-toolkit'),
					'blue_hl'                   => esc_html__('Blue background', 'luxicar-lite-toolkit'),
					'alert'                     => esc_html__('Alert', 'luxicar-lite-toolkit'),
					'list'                      => esc_html__('List', 'luxicar-lite-toolkit'),
					'social_media'              => esc_html__('Social media', 'luxicar-lite-toolkit'),
					'alert_succes'              => esc_html__('Success', 'luxicar-lite-toolkit'),
					'alert_infor'               => esc_html__('Infor', 'luxicar-lite-toolkit'),
					'alert_warning'             => esc_html__('Warning', 'luxicar-lite-toolkit'),
					'alert_error'               => esc_html__('Error', 'luxicar-lite-toolkit'),
					'list_order'                => esc_html__('Lists', 'luxicar-lite-toolkit'),
					'plus_lo'                   => esc_html__('Plus', 'luxicar-lite-toolkit'),
					'dot_lo'                    => esc_html__('Dot', 'luxicar-lite-toolkit'),
					'social_media'              => esc_html__('Social media', 'luxicar-lite-toolkit'),
					'facebook_sm'               => esc_html__('Facebook', 'luxicar-lite-toolkit'),
					'twitter_sm'                => esc_html__('Twitter', 'luxicar-lite-toolkit'),
					'linkedin_sm'               => esc_html__('Linkedin', 'luxicar-lite-toolkit'),
					'instagram_sm'              => esc_html__('Instagram', 'luxicar-lite-toolkit'),
					'google_plus_sm'            => esc_html__('Google +', 'luxicar-lite-toolkit'),
					'skype_sm'                  => esc_html__('Skype', 'luxicar-lite-toolkit'),
					'pinterest_sm'              => esc_html__('Pinterest', 'luxicar-lite-toolkit'),
					'github_sm'                 => esc_html__('Github', 'luxicar-lite-toolkit'),
					'foursquare_sm'             => esc_html__('Foursquare', 'luxicar-lite-toolkit'),
					'dribble_sm'                => esc_html__('Dribble', 'luxicar-lite-toolkit'),
					'youtube_sm'                => esc_html__('Youtube', 'luxicar-lite-toolkit'),
					'rss_sm'                    => esc_html__('Rss', 'luxicar-lite-toolkit'),
					'breadcrumb'                => esc_html__('Breadcrumb', 'luxicar-lite-toolkit'),
					'contact'                   => esc_html__('Contact', 'luxicar-lite-toolkit'),
					'normal_ct'                 => esc_html__('Normal', 'luxicar-lite-toolkit'),
					'background_ct'             => esc_html__('Background image', 'luxicar-lite-toolkit'),
					'client'                    => esc_html__('Client', 'luxicar-lite-toolkit'),
					'accordion'                 => esc_html__('Accordion', 'luxicar-lite-toolkit'),
					'normal_acc'                => esc_html__('Normal', 'luxicar-lite-toolkit'),
					'image_acc'                 => esc_html__('Image inside', 'luxicar-lite-toolkit'),
					'icon_acc'                  => esc_html__('Icon inside', 'luxicar-lite-toolkit'),
					
					'progress'                  => esc_html__('Progress', 'luxicar-lite-toolkit'),
					'progress_small'            => esc_html__('Progress Small', 'luxicar-lite-toolkit'),
					'progress_medium'           => esc_html__('Progress Medium', 'luxicar-lite-toolkit'),
					'progress_chart'            => esc_html__('Progress Chart', 'luxicar-lite-toolkit'),
					
					'sticky_note'               => esc_html__('Sticky Note', 'luxicar-lite-toolkit'),
					'sticky_note_color_1'       => esc_html__('Sticky Note Color 1', 'luxicar-lite-toolkit'),
					'sticky_note_color_2'       => esc_html__('Sticky Note Color 2', 'luxicar-lite-toolkit'),
					'sticky_note_color_3'       => esc_html__('Sticky Note Color 3', 'luxicar-lite-toolkit'),
					'sticky_note_color_4'       => esc_html__('Sticky Note Color 4', 'luxicar-lite-toolkit'),
					'sticky_note_color_5'       => esc_html__('Sticky Note Color 5', 'luxicar-lite-toolkit'),
					'sticky_note_color_6'       => esc_html__('Sticky Note Color 6', 'luxicar-lite-toolkit'),
					
					'tab'                       => esc_html__('Tabs', 'luxicar-lite-toolkit'),
					'tab_top'                   => esc_html__('Tabs Top', 'luxicar-lite-toolkit'),
					'tab_right'                 => esc_html__('Tab Right', 'luxicar-lite-toolkit'),
					'tab_top_image'             => esc_html__('Tab Top Image', 'luxicar-lite-toolkit'),
					
					'service_list'              => esc_html__('Service List', 'luxicar-lite-toolkit'),
					'service_list_normal'       => esc_html__('Service List Normal', 'luxicar-lite-toolkit'),
					'service_list_adv'          => esc_html__('Service Advanced', 'luxicar-lite-toolkit'),
					
					'portfolio'                 => esc_html__('Portfolio', 'luxicar-lite-toolkit'),
					
					'pricing_table'             => esc_html__('Pricing Table', 'luxicar-lite-toolkit'),
					'pricing_table_1'           => esc_html__('Pricing Table 1', 'luxicar-lite-toolkit'),
					'pricing_table_2'           => esc_html__('Pricing Table 2', 'luxicar-lite-toolkit'),
					
					'map'                       => esc_html__('Map', 'luxicar-lite-toolkit'),
					'counter'                   => esc_html__('Counter', 'luxicar-lite-toolkit'),
					'counter_1'                 => esc_html__('Square', 'luxicar-lite-toolkit'),
					'counter_2'                 => esc_html__('Rhombus', 'luxicar-lite-toolkit'),
					
					'partner'                   => esc_html__('Partner', 'luxicar-lite-toolkit'),
					'partner_1'                 => esc_html__('Partner 1', 'luxicar-lite-toolkit'),
					'partner_2'                 => esc_html__('Partner 2', 'luxicar-lite-toolkit'),
					
					'single_service'            => esc_html__('Single Service', 'luxicar-lite-toolkit'),
					)
				));
		}
	}
}