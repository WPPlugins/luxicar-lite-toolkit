<?php

add_action( 'kpb_get_widgets_list', array('LTP_Widget_Portfolio_Slider', 'register_block'));
	
class LTP_Widget_Portfolio_Slider extends Kopa_Widget {

	public $kpb_group = 'portfolio';
	
	public static function register_block($blocks){
       	$blocks['LTP_Widget_Portfolio_Slider'] = new LTP_Widget_Portfolio_Slider();
        return $blocks;
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'widget-slider-10';
		$this->widget_description = esc_html__( 'Display list portfolio slider.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'lucixcar-toolkit-plus-widget-portfolio-slider';
		$this->widget_name        = esc_html__( 'Luxicar - Portfolio Slider', 'luxicar-lite-toolkit' );
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
				'label' => __( 'Number of portfolio', 'luxicar-lite-toolkit' )
			)		
		);	

		$cbo_tags_options = array('' => __( '-- All --', 'luxicar-lite-toolkit' ));
				
		$tags = get_terms('portfolio-tag');			
	
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
			'post_type'      => array('portfolio'),
			'posts_per_page' => (int) $instance['posts_per_page'],
			'post_status'    => array('publish')
		);

		$tags = $instance['tags'];
		
		if(!empty($tags)){
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio-tag',
					'field'    => 'slug',
					'terms'    => $tags
				),
			);
		}
		
		$result_set = new WP_Query( $query );
		?>
			<?php if( $title || $desc ) : ?>
				<div class="wrapper">
					<div class="widget-title widget-title-1">
						<?php if( $title ) : ?>
							<h2><?php echo wp_kses_post( $before_title . $title .$after_title ); ?></h2>
						<?php endif; ?>
						<?php if( $desc ) : ?>
							<p><?php echo wp_kses_post( $desc ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($result_set->have_posts()) : ?>
				<div class="widget-content">
					<div class="content-slider-10">
						<?php while($result_set->have_posts()) : $result_set->the_post(); ?>
							<?php if( has_post_thumbnail() ) : ?>
								<div class="entry-item">
									<div class="entry-thumb">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'luxicar-widget-635x350' ); ?>
										</a>
										<span class="icon-thumb"><i class="fa fa-expand"></i></span>
									</div>

									<div class="entry-content">
										<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
										<p><?php esc_html_e('By', 'luxicar-lite-toolkit'); ?> <?php the_author_posts_link(); ?></p>
									</div>
								</div>
							<?php endif; ?>
						<?php endwhile; ?>
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