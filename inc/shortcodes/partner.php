<?php

add_shortcode('luxicar_partner', 'luxicar_toolkit_shortcode_partner');

function luxicar_toolkit_shortcode_partner($atts, $content = null) {
    extract(shortcode_atts(array('style' => 'normal', 'posts_per_page' => '3'), $atts));
	$class          = isset($atts['style']) ? $atts['style'] : 'normal';
		$query = array(
			'post_type'      => array('partner'),
			'posts_per_page' => (int) $atts['posts_per_page'],
			'post_status'    => array('publish')
		);
		
		$result_set = new WP_Query( $query );

		ob_start();
		?>	
			<?php if ($result_set->have_posts()): ?>
				<?php if($style == 'normal') : ?>
					<div class="kopa-client s1">
						<?php while($result_set->have_posts()) : $result_set->the_post(); ?>
							<?php 
								if(has_post_thumbnail()) :
								$url = get_post_meta(get_the_id(), LTP_PREFIX.'partner-url', true );
							?>
								<div class="entry-item">
									<a href="<?php echo esc_url( $url ); ?>">
										<?php the_post_thumbnail( 'full', array('class' => 'img-responsive') ); ?>
									</a>
								</div>
							<?php endif; ?>
						<?php endwhile; ?>
					</div>
				<?php else: ?>
					<div class="kopa-client s2">
						<?php while($result_set->have_posts()) : $result_set->the_post(); ?>
							<?php 
								if(has_post_thumbnail()) :
								$url = get_post_meta(get_the_id(), LTP_PREFIX.'partner-url', true );
							?>
								<div class="entry-item">
									<a href="<?php echo esc_url( $url ); ?>">
										<?php the_post_thumbnail( 'full', array('class' => 'img-responsive') ); ?>
									</a>
								</div>
							<?php endif; ?>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		<?php

		wp_reset_postdata();

		$html = ob_get_clean();

    return apply_filters('luxicar_toolkit_shortcode_partner', $html, $atts, $content);
}