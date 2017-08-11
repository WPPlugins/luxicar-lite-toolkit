<?php

add_action( 'kpb_get_widgets_list', array('LTP_Widget_Team_4_Columns', 'register_block'));
	
class LTP_Widget_Team_4_Columns extends Kopa_Widget {

	public $kpb_group = 'team';
	
	public static function register_block($blocks){
       	$blocks['LTP_Widget_Team_4_Columns'] = new LTP_Widget_Team_4_Columns();
        return $blocks;
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'kopa-service-widget-7';
		$this->widget_description = esc_html__( 'Display list team 4 columns.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'lucixcar-toolkit-plus-widget-team-4-columns';
		$this->widget_name        = esc_html__( 'Luxicar - Team 4 Columns', 'luxicar-lite-toolkit' );
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
				'label' => __( 'Number of team', 'luxicar-lite-toolkit' )
			)		
		);	

		$cbo_tags_options = array('' => __( '-- All --', 'luxicar-lite-toolkit' ));
				
		$tags = get_terms('team-tag');			
	
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
			'post_type'      => array('team'),
			'posts_per_page' => (int) $instance['posts_per_page'],
			'post_status'    => array('publish')
		);

		$tags = $instance['tags'];
		
		if(!empty($tags)){
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'team-tag',
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
			<?php if ($result_set->have_posts()) : ?>
				<div class="widget-content">
					<div class="row">
						<?php while($result_set->have_posts()) : $result_set->the_post(); ?>
							<article class="entry-item">
								<div class="entry-wrap">
									<?php if( has_post_thumbnail() ) : ?>
										<div class="entry-thumb">
											<?php the_post_thumbnail( 'luxicar-widget-270x270' ); ?>
										</div>
									<?php endif; ?>

									<?php 
										$position = get_post_meta(get_the_id(), LTP_PREFIX . 'team-position', true ); 
										$phone    = get_post_meta(get_the_id(), LTP_PREFIX . 'team-phone', true );
										$email    = get_post_meta(get_the_id(), LTP_PREFIX . 'team-email', true );
										$facebook = get_post_meta(get_the_id(), LTP_PREFIX . 'team-facebook', true );
										$twitter  = get_post_meta(get_the_id(), LTP_PREFIX . 'team-twitter', true );
										$gplus    = get_post_meta(get_the_id(), LTP_PREFIX . 'team-gplus', true );
										$dribbble = get_post_meta(get_the_id(), LTP_PREFIX . 'team-dribbble', true );
									?>
									<div class="entry-content">
										<h5><?php the_title(); ?></h5>
										<?php 
											if( $position ){
												echo '<i>'.wp_kses_post( $position ).'</i>';
											}
											if( $phone ){
												echo '<p>'.wp_kses_post( $phone ).'</p>';
											}
											if( $email ){
												echo '<p>'.wp_kses_post( $email ).'</p>';
											}
										?>
										<?php if( $facebook || $twitter || $dribbble || $gplus ) : 
											echo '<ul class="kopa-social-2">';
												if( $facebook ) {
													echo '<li><a href="'.esc_url( $facebook ).'"><i class="fa fa-facebook"></i></a></li>';
												}
												if( $twitter ) {
													echo '<li><a href="'.esc_url( $twitter ).'"><i class="fa fa-twitter"></i></a></li>';
												}
												if( $dribbble ) {
													echo '<li><a href="'.esc_url( $dribbble ).'"><i class="fa fa-dribbble"></i></a></li>';
												}
												if( $gplus ) {
													echo '<li><a href="'.esc_url( $gplus ).'"><i class="fa fa-google-plus"></i></a></li>';
												}
											echo '</ul>';
											endif;
										?>
									</div>
								</div>
							</article>
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