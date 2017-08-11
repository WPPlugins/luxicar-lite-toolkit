<?php

if(!class_exists('LTP_Slide')){

	class LTP_Slide{

		public function __construct(){				
			add_action('init', array($this, 'init'), 0);			
			add_action('admin_init', array($this, 'register_metabox'));			

			add_filter('manage_slide_posts_custom_column' , array($this, 'manage_colum'));		
			add_image_size( 'slider', 1400, 700, true );		
		}

		public function require_widgets(){
			require_once 'widget/slider.php';
		}

		public function init(){

			$labels = array(
				'name'               => _x( 'Slides', 'post type general name', 'luxicar-lite-toolkit' ),
				'singular_name'      => _x( 'Slide', 'post type singular name', 'luxicar-lite-toolkit' ),
				'menu_name'          => _x( 'Slides', 'admin menu', 'luxicar-lite-toolkit' ),
				'name_admin_bar'     => _x( 'Slide', 'add new on admin bar', 'luxicar-lite-toolkit' ),
				'add_new'            => _x( 'Add New', 'testimonial', 'luxicar-lite-toolkit' ),
				'add_new_item'       => esc_html__( 'Add New Slide', 'luxicar-lite-toolkit' ),
				'new_item'           => esc_html__( 'New Slide', 'luxicar-lite-toolkit' ),
				'edit_item'          => esc_html__( 'Edit Slide', 'luxicar-lite-toolkit' ),
				'view_item'          => esc_html__( 'View Slide', 'luxicar-lite-toolkit' ),
				'all_items'          => esc_html__( 'All Slides', 'luxicar-lite-toolkit' ),
				'search_items'       => esc_html__( 'Search Slides', 'luxicar-lite-toolkit' ),
				'parent_item_colon'  => esc_html__( 'Parent Slides:', 'luxicar-lite-toolkit' ),
				'not_found'          => esc_html__( 'No testimonial found.', 'luxicar-lite-toolkit' ),
				'not_found_in_trash' => esc_html__( 'No testimonial found in Trash.', 'luxicar-lite-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-testimonial',
				'public'             => false,	      
				'labels'             => $labels,
				'supports'           => array('title', 'thumbnail'),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => false,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'slide' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 100
		    );

		    register_post_type('slide', $args);

		    $labels = array(
				'name'              => _x('Slides Tags', 'taxonomy general name', 'luxicar-lite-toolkit'),
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
				'rewrite'           => array('slug' => 'slide-tag'),
			);

			register_taxonomy('slide-tag', array('slide'), $args);
		}

		public function register_metabox(){
			$args = array(
				'id'          => 'slide-options-metabox',
			    'title'       => esc_html__('Options', 'luxicar-lite-toolkit'),
			    'desc'        => '',
			    'pages'       => array( 'slide' ),
			    'context'     => 'normal',
			    'priority'    => 'low',
			    'fields'      => array(
			    	array(
						'title'   => esc_html__('Sub title', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'sub-title',						
					),
					array(
						'title'   => esc_html__('Link Text', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'link-text',						
					),
					array(
						'title'   => esc_html__('Link URL', 'luxicar-lite-toolkit'),
						'type'    => 'url',
						'id'      => LTP_PREFIX . 'link-url',						
					)
			    )
			);			
			
			kopa_register_metabox( $args );
		}

		public function manage_colums($columns){			
			$columns = array(
				'cb'                 => esc_html__('<input type="checkbox" />', 'luxicar-lite-toolkit'),
				'ltp-thumb'          => esc_html__('Thumbnail', 'luxicar-lite-toolkit'),
				'title'              => esc_html__('Title', 'luxicar-lite-toolkit'),
				'taxonomy-slide-tag' => esc_html__('Tags', 'luxicar-lite-toolkit')
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
			}
		}

	}

	$LTP_Slide = new LTP_Slide();
	$LTP_Slide->require_widgets();

}