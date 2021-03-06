<?php

add_filter( 'widgets_init', array('LTP_Widget_Partner', 'register_widget'));
	
class LTP_Widget_Partner extends Kopa_Widget {

	public $kpb_group = 'partner';
	
	public static function register_widget($blocks){
       	register_widget('LTP_Widget_Partner');
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'widget-slider-4 load-slick';
		$this->widget_description = esc_html__( 'Display list partner slider.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'lucixcar-toolkit-plus-widget-partner';
		$this->widget_name        = esc_html__( 'Luxicar - Partner', 'luxicar-lite-toolkit' );
		$this->settings 		  = array(
			'posts_per_page'  => array(
				'type'  => 'text',
				'std'   => 4,
				'label' => __( 'Number of partner', 'luxicar-lite-toolkit' )
			)		
		);	

		$cbo_tags_options = array('' => __( '-- All --', 'luxicar-lite-toolkit' ));
				
		$tags = get_terms('partner-tag');			
	
		if($tags && !is_wp_error($tags) ){			
			foreach ($tags as $tag) {						
				$cbo_tags_options[$tag->slug] = "{$tag->name} ({$tag->count})";
			}
		}		
		
		$this->settings['tags'] = array(
			'type'    => 'select',
			'label'   => __( 'Tags', 'luxicar-lite-toolkit' ),
			'std'     => '',
			'options' => $cbo_tags_options
		);

		parent::__construct();
	}

	public function widget( $args, $instance ) {	
		ob_start();

		extract( $args );
		
		echo wp_kses_post( $before_widget );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);			

		$query = array(
			'post_type'      => array('partner'),
			'posts_per_page' => (int) $instance['posts_per_page'],
			'post_status'    => array('publish')
		);

		$tags = $instance['tags'];
		
		if(!empty($tags)){
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'partner-tag',
					'field'    => 'slug',
					'terms'    => $tags
				),
			);
		}
		
		$result_set = new WP_Query( $query );
		?>
			<?php if ($result_set->have_posts()) : while($result_set->have_posts()) : $result_set->the_post(); ?>
				<?php 
					if(has_post_thumbnail()) :
					$url = get_post_meta(get_the_id(), LTP_PREFIX.'partner-url', true );
				?>
					<div>
						<a href="<?php echo esc_url( $url ); ?>">
							<?php the_post_thumbnail( 'full' ); ?>
						</a>
					</div>
				<?php endif; ?>
			<?php endwhile; endif; ?>
		<?php

		wp_reset_postdata();

		echo wp_kses_post( $after_widget );

		$content = ob_get_clean();

		echo sprintf('%s', $content);		
		
	}

}