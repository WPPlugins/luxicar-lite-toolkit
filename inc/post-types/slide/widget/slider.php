<?php

add_action( 'widgets_init', array('LTP_Widget_Slider', 'register_widget'));
	
class LTP_Widget_Slider extends Kopa_Widget {

	public $kpb_group = 'slider';
	
	public static function register_widget($blocks){
       	register_widget('LTP_Widget_Slider');
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'widget-slider-9 flexslider';
		$this->widget_description = esc_html__( 'Display list partner slider.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'lucixcar-toolkit-plus-widget-slider';
		$this->widget_name        = esc_html__( 'Luxicar - Slider', 'luxicar-lite-toolkit' );
		$this->settings 		  = array(
			'posts_per_page'  => array(
				'type'  => 'text',
				'std'   => 4,
				'label' => __( 'Number of partner', 'luxicar-lite-toolkit' )
			)		
		);	

		$cbo_tags_options = array('' => __( '-- All --', 'luxicar-lite-toolkit' ));
				
		$tags = get_terms('slide-tag');			
	
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
			'post_type'      => array('slide'),
			'posts_per_page' => (int) $instance['posts_per_page'],
			'post_status'    => array('publish')
		);

		$tags = $instance['tags'];
		
		if(!empty($tags)){
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'slide-tag',
					'field'    => 'slug',
					'terms'    => $tags
				),
			);
		}
		
		$result_set = new WP_Query( $query );
		?>
			<?php if ($result_set->have_posts()) : ?> 
				<ul class="slides">
					<?php while($result_set->have_posts()) : $result_set->the_post(); ?>
						<?php 
							if(has_post_thumbnail()) :
							$sub_title = get_post_meta(get_the_id(), LTP_PREFIX.'sub-title', true );
							$link_text = get_post_meta(get_the_id(), LTP_PREFIX.'link-text', true );
							$link_url  = get_post_meta(get_the_id(), LTP_PREFIX.'link-url', true );
						?>
							<li class="entry-item">
								<div class="entry-thumb">
									<?php the_post_thumbnail( 'slider' ); ?>
								</div>
								<div class="entry-content">
									<h2><?php the_title(); ?></h2>
									<?php if( $sub_title ) : ?>
										<span><i><?php echo esc_html( $sub_title ); ?></i></span>
									<?php endif; ?>
									<?php if( $link_text || $link_url ) : ?>
										<a href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_text ); ?></a>
									<?php endif; ?>
								</div>
								<!-- /.entry-content -->
							</li>
						<?php endif; ?>
						
					<?php endwhile; ?> 
				</ul>
				<div class="arr-down"><a href="#widget-area-3"></a></div>
				<!-- /.arr-down -->

				<div class="loading">
					<i class="fa fa-refresh fa-spin"></i>
				</div>
				<!-- /.loading -->
			<?php endif; ?>
		<?php

		wp_reset_postdata();

		echo wp_kses_post( $after_widget );

		$content = ob_get_clean();

		echo sprintf('%s', $content);		
		
	}

}