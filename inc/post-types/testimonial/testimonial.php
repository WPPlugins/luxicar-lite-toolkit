<?php

if(!class_exists('LTP_Testimonial')){

	class LTP_Testimonial{

		public function __construct(){				
			add_action('init', array($this, 'init'), 0);			
			add_action('admin_init', array($this, 'register_metabox'));			

			add_filter('manage_testimonial_posts_columns', array($this, 'manage_colums'));			
			add_action('manage_testimonial_posts_custom_column' , array($this, 'manage_colum'));				
		}

		public function require_widgets(){
			require_once 'widget/testimonial-slider.php';
			require_once 'widget/testimonial-intro.php';
		}

		public function init(){

			$labels = array(
				'name'               => _x( 'Testimonials', 'post type general name', 'luxicar-lite-toolkit' ),
				'singular_name'      => _x( 'Testimonial', 'post type singular name', 'luxicar-lite-toolkit' ),
				'menu_name'          => _x( 'Testimonials', 'admin menu', 'luxicar-lite-toolkit' ),
				'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'luxicar-lite-toolkit' ),
				'add_new'            => _x( 'Add New', 'testimonial', 'luxicar-lite-toolkit' ),
				'add_new_item'       => esc_html__( 'Add New Testimonial', 'luxicar-lite-toolkit' ),
				'new_item'           => esc_html__( 'New Testimonial', 'luxicar-lite-toolkit' ),
				'edit_item'          => esc_html__( 'Edit Testimonial', 'luxicar-lite-toolkit' ),
				'view_item'          => esc_html__( 'View Testimonial', 'luxicar-lite-toolkit' ),
				'all_items'          => esc_html__( 'All Testimonials', 'luxicar-lite-toolkit' ),
				'search_items'       => esc_html__( 'Search Testimonials', 'luxicar-lite-toolkit' ),
				'parent_item_colon'  => esc_html__( 'Parent Testimonials:', 'luxicar-lite-toolkit' ),
				'not_found'          => esc_html__( 'No testimonial found.', 'luxicar-lite-toolkit' ),
				'not_found_in_trash' => esc_html__( 'No testimonial found in Trash.', 'luxicar-lite-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-testimonial',
				'public'             => false,	      
				'labels'             => $labels,
				'supports'           => array('title', 'editor', 'thumbnail'),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => false,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'testimonial' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 100
		    );

		    register_post_type('testimonial', $args);

		    $labels = array(
				'name'              => _x('Testimonials Tags', 'taxonomy general name', 'luxicar-lite-toolkit'),
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
				'rewrite'           => array('slug' => 'testimonial-tag'),
			);

			register_taxonomy('testimonial-tag', array('testimonial'), $args);
		}

		public function register_metabox(){
			$args = array(
				'id'          => 'testimonial-options-metabox',
			    'title'       => esc_html__('Options', 'luxicar-lite-toolkit'),
			    'desc'        => '',
			    'pages'       => array( 'testimonial' ),
			    'context'     => 'normal',
			    'priority'    => 'low',
			    'fields'      => array(
			    	array(
						'title'   => esc_html__('Name', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'testimonial-name',						
					),
					array(
						'title'   => esc_html__('Website', 'luxicar-lite-toolkit'),
						'type'    => 'url',
						'id'      => LTP_PREFIX . 'testimonial-website',						
					),
					array(
						'title'   => esc_html__('Position', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'testimonial-position',						
					),
					array(
						'title'   => esc_html__('Start', 'luxicar-lite-toolkit'),
						'type'    => 'select',
						'id'      => LTP_PREFIX . 'testimonial-star',
						'default' => '',
						'options' => array(
							''   => esc_html__('--- None ---', 'luxicar-lite-toolkit'),
							'1'   => esc_html__('1 Star', 'luxicar-lite-toolkit'),
							'2'   => esc_html__('2 Stars', 'luxicar-lite-toolkit'),
							'3'   => esc_html__('3 Stars', 'luxicar-lite-toolkit'),
							'4'   => esc_html__('4 Stars', 'luxicar-lite-toolkit'),
							'5'   => esc_html__('5 Stars', 'luxicar-lite-toolkit'),
						),					
					)
			    )
			);			
			
			kopa_register_metabox( $args );
		}

		public function manage_colums($columns){			
			$columns = array(
				'cb'                       => esc_html__('<input type="checkbox" />', 'luxicar-lite-toolkit'),
				'ltp-thumb'                => esc_html__('Avatar', 'luxicar-lite-toolkit'),
				'title'                    => esc_html__('Title', 'luxicar-lite-toolkit'),
				'taxonomy-testimonial-tag' => esc_html__('Tags', 'luxicar-lite-toolkit'),
				'name'                     => esc_html__('Name', 'luxicar-lite-toolkit'),
				'position'                 => esc_html__('Position', 'luxicar-lite-toolkit'),
				'star'                     => esc_html__('Star', 'luxicar-lite-toolkit'),
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
				case 'name':
					if($name = get_post_meta($post->ID, LTP_PREFIX . 'testimonial-name', true)){
						echo wp_kses_post( $name );
					}
					break;
				case 'position':
					if($position = get_post_meta($post->ID, LTP_PREFIX . 'testimonial-position', true)){
						echo wp_kses_post( $position );
					}
					break;
				case 'star':
					if($star = get_post_meta($post->ID, LTP_PREFIX . 'testimonial-star', true)){
						echo wp_kses_post( $star );
					}
					break;					
			}
		}

	}

	$LTP_Testimonial = new LTP_Testimonial();
	$LTP_Testimonial->require_widgets();

}