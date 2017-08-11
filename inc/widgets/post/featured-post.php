<?php

add_action( 'kpb_get_widgets_list', array('LTP_Widget_Featured_Post', 'register_block'));
	
class LTP_Widget_Featured_Post extends Kopa_Widget {

	public $kpb_group = 'post';
	
	public static function register_block($blocks){
       	$blocks['LTP_Widget_Featured_Post'] = new LTP_Widget_Featured_Post();
        return $blocks;
    }
    
	public function __construct() {
		$posts = get_posts( array( 'posts_per_page' => -1 ) );
		$posts_array = array( ''=> esc_html__('---- None ----', 'luxicar-lite-toolkit') );
		foreach ($posts as $post) {
			$posts_array[$post->ID]  = $post->post_title;
		}
		$this->widget_cssclass    = 'kopa-about-widget-2';
		$this->widget_description = esc_html__( 'Display featured post.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'luxicar-toolkit-plus-widget-article-lists-1-column-255-160';
		$this->widget_name        = esc_html__( 'Luxicar - Featured post', 'luxicar-lite-toolkit' );
		$this->settings 		  = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'luxicar-lite-toolkit' )
			),
			'title_below_thumb'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title Below Thumb', 'luxicar-lite-toolkit' )
			),
			'desc'  => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => esc_html__( 'Description', 'luxicar-lite-toolkit' ),
			),
			'post_id'  => array(
				'type'    => 'select',
				'std'     => '',
				'options' => $posts_array,
				'label'   => __( 'Select post', 'luxicar-lite-toolkit' )
			),
			'excerpt_length'  => array(
				'type'  => 'number',
				'std'   => 20,
				'label' => esc_html__( 'Excerpt length:', 'luxicar-lite-toolkit' ),
				'desc'  => esc_html__( 'Enter 0 to hide the excerpt.', 'luxicar-lite-toolkit' ),
			),
			'excerpt_length'  => array(
				'type'  => 'number',
				'std'   => 20,
				'label' => esc_html__( 'Excerpt length:', 'luxicar-lite-toolkit' ),
				'desc'  => esc_html__( 'Enter 0 to hide the excerpt.', 'luxicar-lite-toolkit' ),
			)
		);	

		parent::__construct();
	}

	public function widget( $args, $instance ) {	
		ob_start();

		extract( $args );
		
		$instance = wp_parse_args((array) $instance, $this->get_default_instance());
		
		extract( $instance );
		
		echo wp_kses_post( $before_widget );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);			
		?>
			<?php 
				if( $title || $desc ) :  
					echo '<div class="widget-title widget-title-1">';
					if( $title ) :
						echo '<h2>'.wp_kses_post( $before_title.$title.$after_title ).'</h2>';
					endif; 
					if( $desc ) :
						echo '<p>'.wp_kses_post( $desc ).'</p>';
					endif; 
					echo '</div>';
				endif;
			?>
			<?php if( $post_id ) : ?>
				<div class="widget-content">
					<article class="entry-item item-small">
						<?php if( has_post_thumbnail( $post_id ) ) : ?>
							<div class="entry-thumb">
								<a href="<?php the_permalink(); ?>">
									<?php if(get_post_format() == 'video') : ?>
										<div class="icon-play"></div>
										<div class="mask-video"></div>
									<?php endif; ?>
									<?php echo get_the_post_thumbnail( $post_id, 'luxicar-widget-540x290' ); ?>
								</a>
								<?php if(get_post_format() == 'video') : ?>
									<h5><a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $title_below_thumb ); ?></a></h5>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<div class="entry-content">
							<h2><a href="<?php echo get_permalink( $post_id ); ?>"><?php echo get_the_title( $post_id ); ?></a></h2>
							<?php luxicar_lite_get_the_excerpt_widget( $post_id, $excerpt_length ); ?>
							<a href="<?php echo get_permalink( $post_id ); ?>" class="more-3"><?php esc_html_e( 'More Learn', 'luxicar-lite-toolkit'); ?></a>
						</div>
					</article>
				</div>
			<?php endif; ?>
		<?php
		wp_reset_postdata();

		echo wp_kses_post( $after_widget );

		$content = ob_get_clean();

		echo sprintf('%s', $content);
		
	}

}