<?php

add_shortcode('luxicar_portfolio', 'luxicar_toolkit_shortcode_portfolio');

function luxicar_toolkit_shortcode_portfolio($atts, $content = null) {
    extract(shortcode_atts(array('posts_per_page' => '3'), $atts));
	$posts_per_page = isset($atts['posts_per_page']) ? $atts['posts_per_page'] : '4';	
		$query = array(
			'post_type'      => array('portfolio'),
			'posts_per_page' => (int) $atts['posts_per_page'],
			'post_status'    => array('publish')
		);
		
		$result_set = new WP_Query( $query );

		ob_start();
		?>	
		<?php if ($result_set->have_posts()): ?>
			<div class="content-slider-10 load-slick">
				<?php while($result_set->have_posts()) : $result_set->the_post(); ?>
					<div class="entry-item">
						<?php if(has_post_thumbnail()) : ?>
							<div class="entry-thumb">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'luxicar-widget-635x350' ); ?>
								</a>
								<span class="icon-thumb"><i class="fa fa-expand"></i></span>
							</div>
						<?php endif; ?>

						<div class="entry-content">
							<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
							<p><?php esc_html_e('By', 'luxicar-toolkit-plus') ?> <?php the_author_posts_link(); ?></p>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
		<?php

		wp_reset_postdata();

		$html = ob_get_clean();

    return apply_filters('luxicar_toolkit_shortcode_portfolio', $html, $atts, $content);
}