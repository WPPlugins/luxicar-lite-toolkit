<?php

add_action( 'kpb_get_widgets_list', array('LTP_Widget_Testimonial_Slider', 'register_block'));
	
class LTP_Widget_Testimonial_Slider extends Kopa_Widget {

	public $kpb_group = 'testimonial';
	
	public static function register_block($blocks){
       	$blocks['LTP_Widget_Testimonial_Slider'] = new LTP_Widget_Testimonial_Slider();
        return $blocks;
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'widget-slider-11 load-slick';
		$this->widget_description = esc_html__( 'Display testimonial slider.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'lucixcar-toolkit-plus-widget-testimonial-slider';
		$this->widget_name        = esc_html__( 'Luxicar - Testimonial Slider', 'luxicar-lite-toolkit' );
		$this->settings 		  = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title', 'luxicar-lite-toolkit' )
			),
			'desc'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Description', 'luxicar-lite-toolkit' )
			),
			'posts_per_page'  => array(
				'type'  => 'number',
				'std'   => 4,
				'label' => __( 'Number of testimonial', 'luxicar-lite-toolkit' )
			),
			'excerpt_length'  => array(
				'type'  => 'number',
				'std'   => 20,
				'label' => esc_html__( 'Excerpt length:', 'luxicar-lite-toolkit' ),
				'desc'  => esc_html__( 'Enter 0 to hide the excerpt.', 'luxicar-lite-toolkit' )	
			)
		);	

		$cbo_tags_options = array('' => __( '-- All --', 'luxicar-lite-toolkit' ));
				
		$tags = get_terms('testimonial-tag');			
	
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
		
		extract( $instance );
		echo wp_kses_post( $before_widget );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);			

		$query = array(
			'post_type'      => array('testimonial'),
			'posts_per_page' => (int) $instance['posts_per_page'],
			'post_status'    => array('publish')
		);

		$tags = $instance['tags'];
		
		if(!empty($tags)){
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'testimonial-tag',
					'field'    => 'slug',
					'terms'    => $tags
				),
			);
		}
		
		$result_set = new WP_Query( $query );
		?>
			<?php if ($result_set->have_posts()) : while($result_set->have_posts()) : $result_set->the_post(); ?>
				<div>
					<?php ?>
					<h2><?php echo wp_kses_post( $title ); ?></h2>

					<i>“<?php
                    	$excerpt_tmp = get_the_excerpt();
                        if((int)$excerpt_length){ 
							$excerpt = wp_trim_words(strip_shortcodes($excerpt_tmp), $excerpt_length, '');
							echo ($excerpt) ? wp_kses_post( $excerpt ) : '';
                        }
                    ?>”</i>
					<div class="user-reviews">
						<?php if( the_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'luxicar-widget-80x80' ); ?>
							</a>
						<?php endif; ?>
						<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						<?php $position = get_post_meta( get_the_id(), LTP_PREFIX . 'testimonial-position', true ); ?>
						<p><?php echo wp_kses_post( $position ); ?></p>
					</div>
				</div>
			<?php endwhile;  endif; ?>
		<?php

		wp_reset_postdata();

		echo wp_kses_post( $after_widget );

		$content = ob_get_clean();

		echo sprintf('%s', $content);		
		
	}

}