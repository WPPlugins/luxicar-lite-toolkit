<?php

/**
 * Widget Recent Post No Thumbnail
 */
add_action( 'widgets_init', array('LTP_Recent_Post_No_Thumbnail', 'register_widget'));

class LTP_Recent_Post_No_Thumbnail extends Kopa_Widget {

  public $kpb_group = 'post';

  public static function register_widget(){
	register_widget('LTP_Recent_Post_No_Thumbnail');
  }

  public function __construct() {
	$this->widget_cssclass    = 'widget-news-list-2';
	$this->widget_description = esc_html__('Display recent post no thumbnail', 'luxicar_toolkit_plus');
	$this->widget_id          = 'luxicar-toolkit-plus-recent-post-no-thumb';
	$this->widget_name        = esc_html__( '(Luxicar) Recent Post No Thumbnail', 'luxicar_toolkit_plus' );
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
					<?php echo get_avatar( get_the_author_meta( 'ID' ) , 52); ?>
				</div>
				<!-- /.entry-thumb -->

				<div class="entry-content">
					<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
					<?php 
				        $blog_excerpt_length = intval(get_theme_mod('custom_excerpt_lenght', '10'));
				        $post_excerpt = luxicar_lite_get_the_excerpt( get_the_excerpt(), get_the_content(), $blog_excerpt_length, '' ); 
				        echo esc_attr($post_excerpt); 
				        if($blog_excerpt_length !=0){
				        	echo '<br/>';
				        }
			        ?>
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




