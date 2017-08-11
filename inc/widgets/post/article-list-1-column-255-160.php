<?php

add_action( 'kpb_get_widgets_list', array('LTP_Widget_Article_Lists_1_Column_255_160', 'register_block'));
	
class LTP_Widget_Article_Lists_1_Column_255_160 extends Kopa_Widget {

	public $kpb_group = 'post';
	
	public static function register_block($blocks){
       	$blocks['LTP_Widget_Article_Lists_1_Column_255_160'] = new LTP_Widget_Article_Lists_1_Column_255_160();
        return $blocks;
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'widget-testimonial-1 widget-testimonial-2';
		$this->widget_description = esc_html__( 'Display article list 1 column, thumb size 255x150.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'luxicar-toolkit-plus-widget-article-lists-1-column-255-160';
		$this->widget_name        = esc_html__( 'Luxicar - Article Lists 1 Column ( 255x160 )', 'luxicar-lite-toolkit' );
		$this->settings 		  = luxicar_toolkit_get_post_widget_args();	
		$this->settings['excerpt_length'] = array(
			'type'  => 'number',
			'std'   => 20,
			'label' => esc_html__( 'Excerpt length:', 'luxicar-lite-toolkit' ),
			'desc'  => esc_html__( 'Enter 0 to hide the excerpt.', 'luxicar-lite-toolkit' ),
		);
		$this->settings['desc'] = array(
			'type'  => 'text',
			'std'   => '',
			'label' => esc_html__( 'Description:', 'luxicar-lite-toolkit' ),
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

		$query = luxicar_toolkit_get_post_widget_query($instance);
		
		$result_set = new WP_Query( $query );
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
			<?php if ( $result_set->have_posts() ) : ?>
				<div class="widget-content">
					<?php while ( $result_set->have_posts() ) : $result_set->the_post(); ?>
						<div class="entry-item">
							<?php if( has_post_thumbnail() ) : ?>
								<div class="entry-thumb">
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'luxicar-widget-255x160' );?></a>
								</div>
							<?php endif; ?>
							<div class="entry-content">
								<div class="time-date-1">
									<span class="month"><?php echo get_the_date('M'); ?></span>
									<span class="day"><?php echo get_the_date( 'd' );?></span>
								</div>
								<footer>
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<div class="meta-item"><?php esc_html_e( 'By ', 'luxicar-lite-toolkit' ); the_author_posts_link(); ?>, in <span class="location"><?php the_category(', '); ?></span></div>
									<?php
	                                	$excerpt_tmp = get_the_excerpt();
		                                if((int)$excerpt_length){ 
											$excerpt = wp_trim_words(strip_shortcodes($excerpt_tmp), $excerpt_length, '');
											echo ($excerpt) ? apply_filters( 'the_content', $excerpt ) : '';
		                                }
	                                ?>
								</footer>
							</div>
						</div>
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