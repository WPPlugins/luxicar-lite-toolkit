<?php 

if (!function_exists('ltp_get_portfolio')) {
    add_action('wp_ajax_ltp_get_portfolio', 'ltp_get_portfolio');
    add_action('wp_ajax_nopriv_ltp_get_portfolio', 'ltp_get_portfolio');

    function ltp_get_portfolio() {
        check_ajax_referer('$P$By.WhgC.styMXTVXajsHThQZgrlsVm1', 'ajax_security');

        $query = array(
            'post_type'      => array('portfolio'),
            'posts_per_page' => $_POST['number'],
            'post_status'    => array('publish'),
            'paged'          => isset($_POST['paged']) && !empty($_POST['paged']) ? (int)$_POST['paged'] : 1,
        );
        
        $result_set = new WP_Query($query);

        if ($result_set->have_posts()) :
            ?>
                <ul id="ltp-response">
                <?php
    			while ($result_set->have_posts()):
                    $result_set->the_post();
                
                    $classes = array('kopa-all');
                    $terms = get_the_terms(get_the_ID(), 'portfolio-tag');
                    $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

                    
                    if(!empty($terms)){
                        foreach ($terms as $term) {
                            $classes[] = "kopa-{$term->slug}";
                            $filter_bars[$term->slug] = $term->name;
                        }
                    }                  
                    ?>
                    <li class="loadmore-portfolio" data-filter-class='["<?php echo implode('","', $classes); ?>"]'>
                        <div class="entry-item">
                            <div class="entry-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'luxicar-widget-390x250' );?>
                                    <span class="icon-thumb"><i class="fa fa-expand"></i></span>
                                </a>
                            </div>

                            <div class="entry-content">
                                <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                <em><?php esc_html_e('By', 'luxicar-lite-toolkit'); ?> <?php the_author_posts_link(); ?></em>
                            </div>
                        </div>
                    </li>
                    <?php                
                endwhile;                
                ?>
                </ul>
            <?php        
        endif;        
       	
       	wp_reset_postdata();

        exit();
    }
}