<?php

add_shortcode('luxicar_service', 'luxicar_toolkit_shortcode_service');

function luxicar_toolkit_shortcode_service($atts, $content = null) {
    extract(shortcode_atts(array('style' => 'normal', 'posts_per_page' => '3'), $atts));
	$class          = isset($atts['style']) ? $atts['style'] : 'normal';	
	$excerpt_length = isset($atts['excerpt']) ? $atts['excerpt'] : '20';	
		$query = array(
			'post_type'      => array('service'),
			'posts_per_page' => (int) $atts['posts_per_page'],
			'post_status'    => array('publish')
		);
		
		$result_set = new WP_Query( $query );

		ob_start();
		?>	
			<?php if ($result_set->have_posts()): ?>
				<?php if($style == 'normal') : ?>
					<div class="kopa-feature-box-1">
						<?php while($result_set->have_posts()) : $result_set->the_post(); ?>
							<div class="entry-item">
								<header><?php the_title(); ?></header>

								<?php if(has_post_thumbnail()) : ?>
									<div class="entry-thumb">
										<?php the_post_thumbnail('luxicar-widget-180x180'); ?>
									</div>
								<?php endif; ?>

								<div class="entry-content">
									<?php
		                            	$excerpt_tmp = get_the_excerpt();
		                                if((int)$excerpt_length){ 
											$excerpt = wp_trim_words(strip_shortcodes($excerpt_tmp), $excerpt_length, '');
											echo ($excerpt) ? apply_filters( 'the_content', $excerpt ) : '';
		                                }
		                            ?>
									<div class="more-1">
										<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'luxicar_toolkit'); ?><span></span></a>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				<?php else: ?>
					<div class="kopa-feature-box-2">
						<?php $index = 1; while($result_set->have_posts()) : $result_set->the_post(); ?>
							<div class="entry-item">
								<?php if(has_post_thumbnail()) : ?>
									<div class="entry-thumb">
										<?php the_post_thumbnail('luxicar-widget-180x180'); ?>
									</div>
								<?php endif; ?>

								<div class="entry-content">
									<div class="feature-icon"><span><?php echo wp_kses_post( $index++ ); ?></span></div>
									<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
									<?php
		                            	$excerpt_tmp = get_the_excerpt();
		                                if((int)$excerpt_length){ 
											$excerpt = wp_trim_words(strip_shortcodes($excerpt_tmp), $excerpt_length, '');
											echo ($excerpt) ? apply_filters( 'the_content', $excerpt ) : '';
		                                }
		                            ?>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		<?php

		wp_reset_postdata();

		$html = ob_get_clean();

    return apply_filters('luxicar_toolkit_shortcode_service', $html, $atts, $content);
}