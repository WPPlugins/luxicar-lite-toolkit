<?php

if(!class_exists('LTP_Team')){

	class LTP_Team{

		public function __construct(){				
			add_action('init', array($this, 'init'), 0);			
			add_action('admin_init', array($this, 'register_metabox'));			

			add_filter('manage_team_posts_columns', array($this, 'manage_colums'));			
			add_action('manage_team_posts_custom_column' , array($this, 'manage_colum'));				
		}

		public function require_widgets(){
			require_once 'widget/team-4-columns.php';
		}

		public function init(){

			$labels = array(
				'name'               => _x( 'Members', 'post type general name', 'luxicar-lite-toolkit' ),
				'singular_name'      => _x( 'Team', 'post type singular name', 'luxicar-lite-toolkit' ),
				'menu_name'          => _x( 'Teams', 'admin menu', 'luxicar-lite-toolkit' ),
				'name_admin_bar'     => _x( 'Team', 'add new on admin bar', 'luxicar-lite-toolkit' ),
				'add_new'            => _x( 'Add New', 'team', 'luxicar-lite-toolkit' ),
				'add_new_item'       => esc_html__( 'Add New Member', 'luxicar-lite-toolkit' ),
				'new_item'           => esc_html__( 'New Member', 'luxicar-lite-toolkit' ),
				'edit_item'          => esc_html__( 'Edit Member', 'luxicar-lite-toolkit' ),
				'view_item'          => esc_html__( 'View Member', 'luxicar-lite-toolkit' ),
				'all_items'          => esc_html__( 'All Members', 'luxicar-lite-toolkit' ),
				'search_items'       => esc_html__( 'Search Members', 'luxicar-lite-toolkit' ),
				'parent_item_colon'  => esc_html__( 'Parent Members:', 'luxicar-lite-toolkit' ),
				'not_found'          => esc_html__( 'No member found.', 'luxicar-lite-toolkit' ),
				'not_found_in_trash' => esc_html__( 'No member found in Trash.', 'luxicar-lite-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-groups',
				'public'             => false,	      
				'labels'             => $labels,
				'supports'           => array('title', 'thumbnail', 'editor'),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => false,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'team' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 100
		    );

		    register_post_type('team', $args);

		    $labels = array(
				'name'              => _x('Teams Tags', 'taxonomy general name', 'luxicar-lite-toolkit'),
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
				'rewrite'           => array('slug' => 'team-tag'),
			);

			register_taxonomy('team-tag', array('team'), $args);
		}

		public function register_metabox(){
			$args = array(
				'id'          => 'team-options-metabox',
			    'title'       => esc_html__('Options', 'luxicar-lite-toolkit'),
			    'desc'        => '',
			    'pages'       => array( 'team' ),
			    'context'     => 'normal',
			    'priority'    => 'low',
			    'fields'      => array(
			    	array(
						'title'   => esc_html__('Position', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'team-position',						
					),
					array(
						'title'   => esc_html__('Phone', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'team-phone',						
					),
					array(
						'title'   => esc_html__('Facebook', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'team-facebook',						
					),
			    	array(
						'title'   => esc_html__('Twitter', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'team-twitter',						
					),
					array(
						'title'   => esc_html__('Google +', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'team-gplus',						
					),
					array(
						'title'   => esc_html__('Dribbble', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'team-dribbble',						
					),
					array(
						'title'   => esc_html__('Email', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'team-email',						
					)					
			    )
			);			
			
			kopa_register_metabox( $args );
		}

		public function manage_colums($columns){			
			$columns = array(
				'cb'                => esc_html__('<input type="checkbox" />', 'luxicar-lite-toolkit'),
				'ltp-thumb'         => esc_html__('Avatar', 'luxicar-lite-toolkit'),
				'title'             => esc_html__('Name', 'luxicar-lite-toolkit'),
				'taxonomy-team-tag' => esc_html__('Tags', 'luxicar-lite-toolkit'),
				'position'          => esc_html__('Position', 'luxicar-lite-toolkit'),
				'socials'           => esc_html__('Socials', 'luxicar-lite-toolkit'),
				'phone'             => esc_html__('Phone', 'luxicar-lite-toolkit'),
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
				case 'position':
					if($position = get_post_meta($post->ID, LTP_PREFIX . 'team-position', true)){
						echo wp_kses_post( $position );
					}
					break;
				case 'socials':
					if($facebook = get_post_meta($post->ID, LTP_PREFIX . 'team-facebook', true)){
						echo "<a class='ltp-social-link ltp-sl-facebook' href='{$facebook}' target='_blank'>F</a>";
					}
					if($twitter = get_post_meta($post->ID, LTP_PREFIX . 'team-twitter', true)){
						echo "<a class='ltp-social-link ltp-sl-twitter' href='{$twitter}' target='_blank'>T</a>";
					}
					if($gplus = get_post_meta($post->ID, LTP_PREFIX . 'team-gplus', true)){
						echo "<a class='ltp-social-link ltp-sl-google_plus' href='{$gplus}' target='_blank'>G+</a>";
					}
					if($dribbble = get_post_meta($post->ID, LTP_PREFIX . 'team-dribbble', true)){
						echo "<a class='ltp-social-link ltp-sl-dribbble' href='{$dribbble}' target='_blank'>D</a>";
					}
					break;	
				case 'phone':
					if($phone = get_post_meta($post->ID, LTP_PREFIX . 'team-phone', true)){
						echo wp_kses_post( $phone );
					}
					break;					
			}
		}

	}

	$LTP_Team = new LTP_Team();
	$LTP_Team->require_widgets();

}