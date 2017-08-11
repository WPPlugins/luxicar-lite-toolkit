<?php

if(!class_exists('LTP_Portfolio')){

	class LTP_Portfolio{

		public function __construct(){				
			add_action('init', array($this, 'init'), 0);			
			add_action('admin_init', array($this, 'register_metabox'));			

			add_filter('manage_portfolio_posts_columns', array($this, 'manage_colums'));			
			add_action('manage_portfolio_posts_custom_column' , array($this, 'manage_colum'));				
		}

		public function register_layout(){
			require_once LT_PATH . 'inc/post-types/portfolio/layout.php';	
		}

		public function register_ajax_handle(){
           require_once LT_PATH . 'inc/post-types/portfolio/ajax.php'; 
        }

		public function require_widgets(){
			require_once 'widget/portfolio-slider.php';
			require_once 'widget/portfolio-loadmore.php';
		}

		public function init(){

			$labels = array(
				'name'               => _x( 'Portfolios', 'post type general name', 'luxicar-lite-toolkit' ),
				'singular_name'      => _x( 'Portfolio', 'post type singular name', 'luxicar-lite-toolkit' ),
				'menu_name'          => _x( 'Portfolios', 'admin menu', 'luxicar-lite-toolkit' ),
				'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'luxicar-lite-toolkit' ),
				'add_new'            => _x( 'Add New', 'portfolio', 'luxicar-lite-toolkit' ),
				'add_new_item'       => esc_html__( 'Add New Portfolio', 'luxicar-lite-toolkit' ),
				'new_item'           => esc_html__( 'New Portfolio', 'luxicar-lite-toolkit' ),
				'edit_item'          => esc_html__( 'Edit Portfolio', 'luxicar-lite-toolkit' ),
				'view_item'          => esc_html__( 'View Portfolio', 'luxicar-lite-toolkit' ),
				'all_items'          => esc_html__( 'All Portfolios', 'luxicar-lite-toolkit' ),
				'search_items'       => esc_html__( 'Search Portfolios', 'luxicar-lite-toolkit' ),
				'parent_item_colon'  => esc_html__( 'Parent Portfolios:', 'luxicar-lite-toolkit' ),
				'not_found'          => esc_html__( 'No portfolio found.', 'luxicar-lite-toolkit' ),
				'not_found_in_trash' => esc_html__( 'No portfolio found in Trash.', 'luxicar-lite-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-portfolio',
				'public'             => false,	      
				'labels'             => $labels,
				'supports'           => array('title', 'editor', 'thumbnail'),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'portfolio' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 100
		    );

		    register_post_type('portfolio', $args);

		    $labels = array(
				'name'              => _x('Portfolio Tags', 'taxonomy general name', 'luxicar-lite-toolkit'),
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
				'rewrite'           => array('slug' => 'portfolio-tag'),
			);

			register_taxonomy('portfolio-tag', array('portfolio'), $args);
		}

		public function register_metabox(){
			$args = array(
				'id'          => 'portfolio-options-metabox',
			    'title'       => esc_html__('Options', 'luxicar-lite-toolkit'),
			    'desc'        => '',
			    'pages'       => array( 'portfolio' ),
			    'context'     => 'normal',
			    'priority'    => 'low',
			    'fields'      => array(
			    	array(
						'title'   => esc_html__('Gallery', 'luxicar-lite-toolkit'),
						'type'    => 'gallery',
						'id'      => LTP_PREFIX . 'portfolio-gallery',			
					),
			    	array(
						'title'   => esc_html__('Date', 'luxicar-lite-toolkit'),
						'type'    => 'datetime',
						'id'      => LTP_PREFIX . 'portfolio-date',
						'format'	=> 'M d Y',			
						'datepicker' => true,
						'timepicker' => false,				
					),
					array(
						'title'   => esc_html__('Client', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'portfolio-client',						
					),
			    	array(
						'title'   => esc_html__('Task', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'portfolio-task',						
					),
					array(
						'title'   => esc_html__('Website', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'portfolio-website',						
					)				
			    )
			);			
			
			kopa_register_metabox( $args );
		}

		public function manage_colums($columns){			
			$columns = array(
				'cb'                     => esc_html__('<input type="checkbox" />', 'luxicar-lite-toolkit'),
				'ltp-thumb'              => esc_html__('Image', 'luxicar-lite-toolkit'),
				'title'                  => esc_html__('Title', 'luxicar-lite-toolkit'),
				'taxonomy-portfolio-tag' => esc_html__('Tags', 'luxicar-lite-toolkit'),
				'client'                 => esc_html__('Client', 'luxicar-lite-toolkit'),
				'task'                   => esc_html__('Task', 'luxicar-lite-toolkit'),
				'website'                => esc_html__('Website', 'luxicar-lite-toolkit'),
				'date'                   => esc_html__('Date', 'luxicar-lite-toolkit'),
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
				case 'client':
					if($client = get_post_meta($post->ID, LTP_PREFIX . 'portfolio-client', true)){
						echo wp_kses_post( $client );
					}
					break;
				case 'task':
					if($task = get_post_meta($post->ID, LTP_PREFIX . 'portfolio-task', true)){
						echo wp_kses_post( $task );
					}
					break;
				case 'website':
					if($website = get_post_meta($post->ID, LTP_PREFIX . 'portfolio-website', true)){
						echo wp_kses_post( $website );
					}
					break;
				case 'date':
					if($date = get_post_meta($post->ID, LTP_PREFIX . 'portfolio-date', true)){
						echo wp_kses_post( $date );
					}
					break;			
			}
		}

	}

	$LTP_Portfolio = new LTP_Portfolio();
	$LTP_Portfolio->require_widgets();
	$LTP_Portfolio->register_layout();
	$LTP_Portfolio->register_ajax_handle();
}