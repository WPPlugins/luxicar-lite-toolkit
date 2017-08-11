<?php

add_action( 'kpb_get_widgets_list', array('LTP_Widget_Service_Highlight_2', 'register_block'));
	
class LTP_Widget_Service_Highlight_2 extends Kopa_Widget {

	public $kpb_group = 'service';
	
	public static function register_block($blocks){
       	$blocks['LTP_Widget_Service_Highlight_2'] = new LTP_Widget_Service_Highlight_2();
        return $blocks;
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'kopa-service-widget-1 option-2';
		$this->widget_description = esc_html__( 'Display hightlights service and excerpt.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'lucixcar-toolkit-plus-widget-hightlight-service-2';
		$this->widget_name        = esc_html__( 'Luxicar - Hightlights Service 2', 'luxicar-lite-toolkit' );
		$this->settings 		  = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'luxicar-lite-toolkit' )
			),
			'posts_per_page'  => array(
				'type'  => 'text',
				'std'   => 4,
				'label' => __( 'Number of service', 'luxicar-lite-toolkit' )
			),
			'excerpt_length'  => array(
				'type'  => 'number',
				'std'   => 20,
				'label' => esc_html__( 'Excerpt length:', 'luxicar-lite-toolkit' ),
				'desc'  => esc_html__( 'Enter 0 to hide the excerpt.', 'luxicar-lite-toolkit' ),
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
		extract( $instance );

		extract( $args );
		
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
		?>
			<?php if($title) :
				echo '<div class="widget-title"><h2>';
				echo wp_kses_post( $before_title . $title .$after_title );
				echo '</h2></div>';
				endif;
			?>
			<?php if ($result_set->have_posts()): ?>
				<div class="widget-content">
					<div class="row-5">
						<div class="widget-slider-2 load-slick">
							<?php while($result_set->have_posts()) : $result_set->the_post(); ?>
								<div>
									<article class="entry-item">
									<?php if(has_post_thumbnail()) : ?>
										<div class="entry-thumb">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail('luxicar-widget-285x265'); ?>
											</a>
										</div>
										<!-- /.entry-thumb -->
									<?php endif; ?>
										<div class="entry-content">
											<header>
												<?php
				                                	$excerpt_tmp = get_the_excerpt();
					                                if((int)$excerpt_length){ 
														$excerpt = wp_trim_words(strip_shortcodes($excerpt_tmp), $excerpt_length, '');
														echo ($excerpt) ? apply_filters( 'the_content', $excerpt ) : '';
					                                }
				                                ?>
											</header>

											<footer>
												<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
												<span class="readmore"><a href="<?php the_permalink(); ?>"></a></span>
											</footer>
										</div>
										<!-- /.entry-content -->
									</article>
									<!-- /.entry-item -->
								</div>
							<?php endwhile; ?>
						</div>
						<!-- /.widget-slider-2 -->
					</div>
				</div>
			<?php endif; ?>
		<?php

		wp_reset_postdata();

		echo wp_kses_post( $after_widget );

		$content = ob_get_clean();

		echo sprintf('%s', $content);		
		
	}

}