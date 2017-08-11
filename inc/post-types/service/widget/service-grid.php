<?php

add_action( 'kpb_get_widgets_list', array('LTP_Widget_Service_Grid', 'register_block'));
	
class LTP_Widget_Service_Grid extends Kopa_Widget {

	public $kpb_group = 'service';
	
	public static function register_block($blocks){
       	$blocks['LTP_Widget_Service_Grid'] = new LTP_Widget_Service_Grid();
        return $blocks;
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'kopa-service-widget-6';
		$this->widget_description = esc_html__( 'Display service grid.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'lucixcar-toolkit-plus-widget-service-grid';
		$this->widget_name        = esc_html__( 'Luxicar - Service Grid', 'luxicar-lite-toolkit' );
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
			<?php if ($result_set->have_posts()): $is_first = true; ?>
				<div class="widget-content">
					<?php while($result_set->have_posts()) : $result_set->the_post(); ?>
						<?php if( $is_first ) : ?>
							<article class="entry-item item-large">
								<?php if( has_post_thumbnail() ) : ?>
									<div class="entry-thumb">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'luxicar-widget-780x386' ); ?>
										</a>
									</div>
								<?php endif; ?>
								<div class="entry-content">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php
	                                	$excerpt_tmp = get_the_excerpt();
		                                if((int)$excerpt_length){ 
											$excerpt = wp_trim_words(strip_shortcodes($excerpt_tmp), $excerpt_length, '');
											echo ($excerpt) ? apply_filters( 'the_content', $excerpt ) : '';
		                                }
	                                ?>
									<a href="<?php the_permalink(); ?>" class="more"><?php esc_html_e('More Learn', 'luxicar-lite-toolkit'); ?></a>
								</div>
							</article>
						<?php $is_first = false; else : ?>
							<article class="entry-item item-small">
								<?php if( has_post_thumbnail() ) : ?>
									<div class="entry-thumb">
										<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'luxicar-widget-390x275' ); ?>
										</a>
									</div>
								<?php endif; ?>
								<div class="entry-content">
									<?php 
										$icon = get_post_meta( get_the_id(), LTP_PREFIX . 'service-icon', true );
										if( $icon ){
											echo '<span><i class="fa '.esc_attr( $icon ).'"></i></span>';
										}
									?>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php
	                                	$excerpt_tmp = get_the_excerpt();
		                                if((int)$excerpt_length){ 
											$excerpt = wp_trim_words(strip_shortcodes($excerpt_tmp), $excerpt_length, '');
											echo ($excerpt) ? apply_filters( 'the_content', $excerpt ) : '';
		                                }
	                                ?>
									<a href="<?php the_permalink(); ?>" class="more"><?php esc_html_e('More Learn', 'luxicar-lite-toolkit'); ?></a>
								</div>
							</article>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		<?php

		wp_reset_postdata();

		echo wp_kses_post( $after_widget );

		$content = ob_get_clean();

		echo sprintf('%s', $content);		
		
	}

}