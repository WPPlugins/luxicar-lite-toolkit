<?php

if(!class_exists('LTP_Service')){

	class LTP_Service{

		public function __construct(){				
			add_action('init', array($this, 'init'), 0);			
			add_action('admin_init', array($this, 'register_metabox'));			

			add_filter('manage_service_posts_columns', array($this, 'manage_colums'));			
			add_action('manage_service_posts_custom_column' , array($this, 'manage_colum'));
			add_action('service-tag_add_form_fields',  array($this,'add_service_tag_image_field'));
			add_action('service-tag_edit_form_fields',  array($this,'edit_service_tag_meta_field'));
			add_action('edited_service-tag',  array($this,'save_service_tag_meta'));  
			add_action('create_service-tag',  array($this,'save_service_tag_meta')) ;
		}

		public function register_layout(){
			require_once LT_PATH . 'inc/post-types/service/layout.php';	
		}

		public function require_widgets(){
			require_once 'widget/service-highlight-2.php';
			require_once 'widget/sale-subscribe.php';
			require_once 'widget/service-list-4-columns.php';
			require_once 'widget/service-grid.php';
			require_once 'widget/service-slider-2-images.php';
		}

		public function init(){

			$labels = array(
				'name'               => _x( 'Services', 'post type general name', 'luxicar-lite-toolkit' ),
				'singular_name'      => _x( 'Service', 'post type singular name', 'luxicar-lite-toolkit' ),
				'menu_name'          => _x( 'Services', 'admin menu', 'luxicar-lite-toolkit' ),
				'name_admin_bar'     => _x( 'Service', 'add new on admin bar', 'luxicar-lite-toolkit' ),
				'add_new'            => _x( 'Add New', 'service', 'luxicar-lite-toolkit' ),
				'add_new_item'       => esc_html__( 'Add New Service', 'luxicar-lite-toolkit' ),
				'new_item'           => esc_html__( 'New Service', 'luxicar-lite-toolkit' ),
				'edit_item'          => esc_html__( 'Edit Service', 'luxicar-lite-toolkit' ),
				'view_item'          => esc_html__( 'View Service', 'luxicar-lite-toolkit' ),
				'all_items'          => esc_html__( 'All Services', 'luxicar-lite-toolkit' ),
				'search_items'       => esc_html__( 'Search Services', 'luxicar-lite-toolkit' ),
				'parent_item_colon'  => esc_html__( 'Parent Services:', 'luxicar-lite-toolkit' ),
				'not_found'          => esc_html__( 'No service found.', 'luxicar-lite-toolkit' ),
				'not_found_in_trash' => esc_html__( 'No service found in Trash.', 'luxicar-lite-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-admin-tools',
				'public'             => true,	      
				'labels'             => $labels,
				'supports'           => array('title', 'editor', 'thumbnail'),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'service' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 100
		    );

		    register_post_type('service', $args);

		    $labels = array(
				'name'              => _x('Services Tags', 'taxonomy general name', 'luxicar-lite-toolkit'),
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
				'rewrite'           => array('slug' => 'service-tag'),
			);

			register_taxonomy('service-tag', array('service'), $args);
		}

		public function register_metabox(){
			$args = array(
				'id'          => 'service-options-metabox',
			    'title'       => esc_html__('Options', 'luxicar-lite-toolkit'),
			    'desc'        => '',
			    'pages'       => array( 'service' ),
			    'context'     => 'normal',
			    'priority'    => 'low',
			    'fields'      => array(
			    	array(
						'title'   => esc_html__('Icon', 'luxicar-lite-toolkit'),
						'type'    => 'icon',
						'default' => 'fa fa-car',
						'id'      => LTP_PREFIX . 'service-icon',						
					),
			    	array(
						'title'   => esc_html__('Iclude', 'luxicar-lite-toolkit'),
						'type'    => 'textarea',
						'default' => '<ul><li>Auto Product Liability</li></ul>',
						'id'      => LTP_PREFIX . 'service-include',						
					),
					array(
						'title'   => esc_html__('Price', 'luxicar-lite-toolkit'),
						'type'    => 'text',
						'id'      => LTP_PREFIX . 'service-price',						
					),
			    )
			);			
			
			kopa_register_metabox( $args );
		}

		public function manage_colums($columns){			
			$columns = array(
				'cb'                   => esc_html__('<input type="checkbox" />', 'luxicar-lite-toolkit'),
				'ltp-thumb'            => esc_html__('Thumb', 'luxicar-lite-toolkit'),
				'title'                => esc_html__('Title', 'luxicar-lite-toolkit'),
				'taxonomy-service-tag' => esc_html__('Tags', 'luxicar-lite-toolkit'),
				'price'                => esc_html__('Price', 'luxicar-lite-toolkit')
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
				case 'price':
					if($price = get_post_meta($post->ID, LTP_PREFIX . 'service-price', true)){
						echo wp_kses_post( $price );
					}				
					break;				
			}
		}
		
		public function add_service_tag_image_field() {
			wp_enqueue_media();
			?>
			<div class="form-field">
				<label for="term_meta[image]"><?php esc_html_e( 'Image', 'luxicar-lite-toolkit' ); ?></label>
				<input type="text" name="term_meta[image]" id="term_meta[image]" class="add_term_image" value="">
				<input class="upload_image_button button" name="add_term_image" id="add_term_image" type="button" value="Select/Upload Image" />
				<script>
					jQuery(document).ready(function() {
						jQuery('#add_term_image').click(function() {
							wp.media.editor.send.attachment = function(props, attachment) {
								jQuery('.add_term_image').val(attachment.url);
							}
							wp.media.editor.open(this);
							return false;
						});
					});
				</script>
			</div>
		<?php
		}

		public function edit_service_tag_meta_field($term) {
			wp_enqueue_media();
			$t_id = $term->term_id;
			$term_meta = get_option( "taxonomy_$t_id" );
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="term_meta[image]"><?php esc_html_e( 'Image', 'luxicar-lite-toolkit' ); ?></label></th>
				<td>
					<input type="text" class="edit_term_image" name="term_meta[image]" id="term_meta[image]" value="<?php echo esc_attr( $term_meta['image'] ) ? esc_attr( $term_meta['image'] ) : ''; ?>">
					<input class="upload_image_button button" name="term_meta[image]" id="edit_term_image" type="button" value="Select/Upload Image" />
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"></th>
				<td style="height: 50px;">
					<div class="img-wrap">
						<img src="<?php echo esc_attr( $term_meta['image'] ) ? esc_attr( $term_meta['image'] ) : ''; ?>" id="preview-img">
					</div>
					<script>
						jQuery(document).ready(function() {
							jQuery('#edit_term_image').click(function() {
								wp.media.editor.send.attachment = function(props, attachment) {
									jQuery('#preview-img').attr("src",attachment.url)
									jQuery('.edit_term_image').val(attachment.url)
								}
								wp.media.editor.open(this);
								return false;
							});
						});
					</script>
				</td>
			</tr>
		<?php
		}

		public function save_service_tag_meta( $term_id ) {
			if ( isset( $_POST['term_meta'] ) ) {
				$t_id = $term_id;
				$term_meta = get_option( "taxonomy_$t_id" );
				$cat_keys = array_keys( $_POST['term_meta'] );
				foreach ( $cat_keys as $key ) {
					if ( isset ( $_POST['term_meta'][$key] ) ) {
						$term_meta[$key] = $_POST['term_meta'][$key];
					}
				}
				// Save the option array.
				update_option( "taxonomy_$t_id", $term_meta );
			}
		}  

	}

	$LTP_Service = new LTP_Service();
	$LTP_Service->require_widgets();
	$LTP_Service->register_layout();
}