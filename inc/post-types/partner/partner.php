<?php

if(!class_exists('LTP_Partner')){

	class LTP_Partner{

		public function __construct(){				
			add_action('init', array($this, 'init'), 0);			
			add_action('admin_init', array($this, 'register_metabox'));			

			add_filter('manage_partner_posts_columns', array($this, 'manage_colums'));			
			add_action('manage_partner_posts_custom_column' , array($this, 'manage_colum'));				
		}

		public function require_widgets(){
			require_once 'widget/partner.php';
		}

		public function init(){

			$labels = array(
				'name'               => _x( 'Partners', 'post type general name', 'luxicar-lite-toolkit' ),
				'singular_name'      => _x( 'Partner', 'post type singular name', 'luxicar-lite-toolkit' ),
				'menu_name'          => _x( 'Partners', 'admin menu', 'luxicar-lite-toolkit' ),
				'name_admin_bar'     => _x( 'Partner', 'add new on admin bar', 'luxicar-lite-toolkit' ),
				'add_new'            => _x( 'Add New', 'partner', 'luxicar-lite-toolkit' ),
				'add_new_item'       => esc_html__( 'Add New Partner', 'luxicar-lite-toolkit' ),
				'new_item'           => esc_html__( 'New Partner', 'luxicar-lite-toolkit' ),
				'edit_item'          => esc_html__( 'Edit Partner', 'luxicar-lite-toolkit' ),
				'view_item'          => esc_html__( 'View Partner', 'luxicar-lite-toolkit' ),
				'all_items'          => esc_html__( 'All Partners', 'luxicar-lite-toolkit' ),
				'search_items'       => esc_html__( 'Search Partners', 'luxicar-lite-toolkit' ),
				'parent_item_colon'  => esc_html__( 'Parent Partners:', 'luxicar-lite-toolkit' ),
				'not_found'          => esc_html__( 'No partner found.', 'luxicar-lite-toolkit' ),
				'not_found_in_trash' => esc_html__( 'No partner found in Trash.', 'luxicar-lite-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-networking',
				'public'             => false,	      
				'labels'             => $labels,
				'supports'           => array('title', 'thumbnail'),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => false,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'partner' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 100
		    );

		    register_post_type('partner', $args);

		    $labels = array(
				'name'              => _x('Partners Tags', 'taxonomy general name', 'luxicar-lite-toolkit'),
				'singular_name'     => _x('Tag', 'taxonomy singular name', 'luxicar-lite-toolkit'),
				'search_items'      => esc_html__('Search Tags', 'luxicar-lite-toolkit'),
				'all_items'         => esc_html__('All Tags', 'luxicar-lite-toolkit'),
				'parent_item'       => esc_html__('Parent Tag', 'luxicar-lite-toolkit'),
				'parent_item_colon' => esc_html__('Parent Tag:', 'luxicar-lite-toolkit'),
				'edit_item'         => esc_html__('Edit Tag', 'luxicar-lite-toolkit'),
				'update_item'       => esc_html__('Update Tag', 'luxicar-lite-toolkit'),
				'add_new_item'      => esc_html__('Add New Tag', 'luxicar-lite-toolkit'),
				'new_item_name'     => esc_html__('New Tag Name', 'luxicar-lite-toolkit'),
				'menu_name'         => esc_html__('Tag', 'luxicar-lite-toolkit'),
			);

			$args = array(
				'hierarchical'      => false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_in_nav_menus' => false,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array('slug' => 'partner-tag'),
			);

			register_taxonomy('partner-tag', array('partner'), $args);
		}

		public function register_metabox(){
			$args = array(
				'id'          => 'partner-options-metabox',
			    'title'       => esc_html__('Options', 'luxicar-lite-toolkit'),
			    'desc'        => '',
			    'pages'       => array( 'partner' ),
			    'context'     => 'normal',
			    'priority'    => 'low',
			    'fields'      => array(
			    	array(
						'title'   => esc_html__('URL', 'luxicar-lite-toolkit'),
						'type'    => 'url',
						'id'      => LTP_PREFIX.'partner-url',						
					)
			    )
			);			
			
			kopa_register_metabox( $args );
		}

		public function manage_colums($columns){			
			$columns = array(
				'cb'                   => esc_html__('<input type="checkbox" />', 'luxicar-lite-toolkit'),
				'ltp-thumb'            => esc_html__('Logo', 'luxicar-lite-toolkit'),
				'title'                => esc_html__('Title', 'luxicar-lite-toolkit'),
				'taxonomy-partner-tag' => esc_html__('Tags', 'luxicar-lite-toolkit'),
				'url'                  => esc_html__('URL', 'luxicar-lite-toolkit'),
			);

			return $columns;	
		}

		public function manage_colum($column){
			global $post;
			switch ($column) {
				case 'ltp-thumb':
					if(has_post_thumbnail($post->ID)){
						echo get_the_post_thumbnail( $post->ID, 'thumbnail');
					}					
					break;
				case 'url':
					if($url = get_post_meta($post->ID, LTP_PREFIX . 'partner-url', true)){
						echo sprintf( '<a href="%s">Link</a>', $url );
					}
					break;				
			}
		}

	}

	$LTP_Partner = new LTP_Partner();
	$LTP_Partner->require_widgets();

}