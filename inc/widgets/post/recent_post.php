<?php

/**
 * Widget Recent Post
 */
add_action( 'widgets_init', array('LTP_Recent_Post', 'register_widget'));

class LTP_Recent_Post extends Kopa_Widget {

  public $kpb_group = 'post';

  public static function register_widget(){
	register_widget('LTP_Recent_Post');
  }

  public function __construct() {
	$this->widget_cssclass    = 'widget-news-list';
	$this->widget_description = esc_html__('Display recent post have thumbnail', 'luxicar_toolkit_plus');
	$this->widget_id          = 'luxicar-toolkit-plus-recent-post';
	$this->widget_name        = esc_html__( '(Luxicar) Recent Post Have Thumbnail', 'luxicar_toolkit_plus' );
	$this->settings       	= luxicar_toolkit_plus_get_post_widget_args();
	parent::__construct();
  }

  public function widget( $args, $instance ) { 
	ob_start();
	extract( $args );
	$instance = wp_parse_args((array) $instance, $this->get_default_instance());
	extract( $instance );
	echo wp_kses_post( $before_widget );
	if($title){
		echo wp_kses_post( $before_title.$title.$after_title );
	} 
	$query = luxicar_toolkit_plus_get_post_widget_query($instance);
	$results = new WP_Query( $query );
	if($results->have_posts()):
	?>
	<div class="widget-content">
		<?php while($results->have_posts()): $results->the_post(); 
		global $post;
		$author_id = $post->post_author;
		?>
			<article class="entry-item">
				<div class="entry-thumb">
					<a href="<?php the_permalink(); ?>">
						<?php if(has_post_thumbnail()): ?>
							<?php the_post_thumbnail('luxicar-recent-post', array('title' => get_the_title(), 'alt' => '')); ?>
						<?php else: ?>
							<img src="http://placehold.it/100x70" alt="">
						<?php endif; ?>
					</a>
				</div>
				<!-- /.entry-thumb -->

				<div class="entry-content">
					<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
					<div class="meta-item">
						<?php echo esc_attr('By', 'luxicar'); ?> <a href="<?php echo get_author_posts_url($author_id); ?>" class="author"><?php the_author(); ?></a>
						, <span class="date"><?php the_time('M j, Y'); ?></span>
					</div>
					<!-- /.meta-item -->
				</div>
				<!-- /.entry-content -->
			</article>
			<!-- /.entry-item -->
		<?php endwhile; ?>
	</div>
	<!-- /.widget-content -->

<?php
	endif;
	echo wp_kses_post( $after_widget );
	$content = ob_get_clean();
	echo wp_kses_post( $content ); 
}

}




