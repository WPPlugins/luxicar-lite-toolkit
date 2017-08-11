<?php

add_action( 'kpb_get_widgets_list', array('LTP_Widget_Service_Slider_2_Images', 'register_block'));
	
class LTP_Widget_Service_Slider_2_Images extends Kopa_Widget {

	public $kpb_group = 'service';
	
	public static function register_block($blocks){
       	$blocks['LTP_Widget_Service_Slider_2_Images'] = new LTP_Widget_Service_Slider_2_Images();
        return $blocks;
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'widget-slider-6';
		$this->widget_description = esc_html__( 'Display service list with 2 images.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'lucixcar-toolkit-plus-widget-service-slider-2-images';
		$this->widget_name        = esc_html__( 'Luxicar - Service Slider 2 Images', 'luxicar-lite-toolkit' );
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
				'type'  => 'text',
				'std'   => 4,
				'label' => esc_html__( 'Number of service', 'luxicar-lite-toolkit' )
			),
			'number'  => array(
				'type'  => 'text',
				'std'   => 4,
				'label' => esc_html__( 'Number of page', 'luxicar-lite-toolkit' )
			),
			'excerpt_length'  => array(
				'type'  => 'number',
				'std'   => 20,
				'label' => esc_html__( 'Excerpt length:', 'luxicar-lite-toolkit' ),
				'desc'  => esc_html__( 'Enter 0 to hide the excerpt.', 'luxicar-lite-toolkit' ),
			),
			'img_1'  => array(
				'type'  => 'upload',
				'std'   => '',
				'mines' => 'image',
				'label' => esc_html__( 'Images 1:', 'luxicar-lite-toolkit' ),
			),
			'img_2'  => array(
				'type'  => 'upload',
				'std'   => '',
				'label' => esc_html__( 'Image 2:', 'luxicar-lite-toolkit' ),
				'mines' => 'image'
			)
		);	

		$cbo_tags_options = array('' => __( '-- All --', 'luxicar-lite-toolkit' ));
				
		$tags = get_terms('service-tag');			
	
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
			'post_type'      => array('service'),
			'posts_per_page' => (int) $instance['posts_per_page'],
			'post_status'    => array('publish')
		);

		$tags = $instance['tags'];
		
		if(!empty($tags)){
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'service-tag',
					'field'    => 'slug',
					'terms'    => $tags
				),
			);
		}
		
		$result_set = new WP_Query( $query );
		$real_posts = count( $result_set->posts);
		?>
			<?php if( $title || $desc ) : ?>
				<div class="widget-title widget-title-1">
					<?php if( $title ) : ?>
						<h2><?php echo wp_kses_post( $before_title . $title .$after_title ); ?></h2>
					<?php endif; ?>
					<?php if( $desc ) : ?>
						<p><?php echo wp_kses_post( $desc ); ?></p>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ($result_set->have_posts()): $is_first = true; $index = 1; ?>
				<div class="widget-content">
					<div class="content-slider-6 load-slick">
						<?php while($result_set->have_posts()) : $result_set->the_post(); ?>
							<?php $icon = get_post_meta( get_the_id(), LTP_PREFIX . 'service-icon', true ); ?>
							<?php if( $index == 1 ) : ?>
								<div>
									<div class="list-item">
										<ul>
							<?php endif; ?>
										<li>
											<span class="square"><i class="<?php echo wp_kses_post( $icon ); ?>"></i></span>
											<article>
												<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
												<?php
				                                	$excerpt_tmp = get_the_excerpt();
					                                if((int)$excerpt_length){ 
														$excerpt = wp_trim_words(strip_shortcodes($excerpt_tmp), $excerpt_length, '');
														echo ($excerpt) ? apply_filters( 'the_content', $excerpt ) : '';
					                                }
				                                ?>
											</article>
										</li>
							<?php if( $index == $number || $index == $real_posts ) : $index = 0;?>
										</ul>
									</div>
									<?php if( $img_1 ) : ?>
										<div class="img-1">
											<img src="<?php echo esc_url( $img_1 ); ?>" alt="">
										</div>
									<?php endif; ?>
									<?php if( $img_2 ) : ?>
										<div class="img-2">
											<img src="<?php echo esc_url( $img_2 ); ?>" alt="">
										</div>
									<?php endif; ?>
								</div>
							<?php endif; $index++; ?>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php

		wp_reset_postdata();

		echo wp_kses_post( $after_widget );
		
	}

}