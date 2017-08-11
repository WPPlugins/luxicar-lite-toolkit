<?php
add_shortcode('luxicar_pricing_table', 'luxicar_toolkit_shortcode_pricing_table');
add_shortcode('luxicar_pricing_table_style', 'luxicar_toolkit_shortcode_pricing_table_style');
add_shortcode('pt_caption', '__return_false');
add_shortcode('pt_price', '__return_false');
add_shortcode('pt_featured', '__return_false');
add_shortcode('pt_button', '__return_false');

function luxicar_toolkit_shortcode_pricing_table($atts, $content = null) {
    extract(shortcode_atts(array('style'), $atts));

    $caption       = luxicar_toolkit_get_shortcode($content, false, array('pt_caption'));
    $price         = luxicar_toolkit_get_shortcode($content, false, array('pt_price'));
    $featureds     = luxicar_toolkit_get_shortcode($content, true, array('pt_featured'));
    $button        = luxicar_toolkit_get_shortcode($content, true, array('pt_button'));

    ob_start();
    ?>

    <?php if( $atts['style'] == '1') : ?>
        <div class="price-col">
            <header>
                <?php if (isset($caption[0])): ?>
                    <h5>
                       <?php echo esc_html( $caption[0]['content'] ); ?>
                    </h5>
                <?php endif; ?>
                <?php if (isset($price[0])): ?>
                    <div class="price-currency">
                        <h3><?php echo esc_html( $price[0]['content'] ); ?></h3><p><?php echo esc_html( $price[0]['atts']['prefix'] ); ?></p>
                    </div>
                <?php endif; ?>
            </header>

            <?php if (isset($featureds) && count($featureds) > 0): ?>
                <ul class="price-feature">
                    <?php foreach ($featureds as $featured): ?>
                        <li>
                            <?php echo esc_html( $featured['content'] ); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php 
            if (isset($button[0])): 
                
                $target = $button[0]['atts']['target'];
                if(empty($target)){
                    $target = '_self';
                }

                ?>
                <footer>
                    <a href="<?php echo esc_url($button[0]['atts']['url']); ?>" target="<?php echo esc_attr( $target ); ?>" class="btn btn-sm btn-default btn-bg"><?php echo esc_html( $button[0]['content'] ); ?></a>
                </footer>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if( $atts['style'] == '2') : ?>
        <div class="price-col current">
            <header>
                <?php if (isset($caption[0])): ?>
                    <h5>
                       <?php echo esc_html( $caption[0]['content'] ); ?>
                    </h5>
                <?php endif; ?>
                <?php if (isset($price[0])): ?>
                    <div class="price-currency">
                        <h3><?php echo esc_html( $price[0]['content'] ); ?></h3><p><?php echo esc_html( $price[0]['atts']['prefix'] ); ?></p>
                    </div>
                <?php endif; ?>
            </header>

            <?php if (isset($featureds) && count($featureds) > 0): ?>
                <ul class="price-feature">
                    <?php foreach ($featureds as $featured): ?>
                        <li>
                            <?php echo esc_html( $featured['content'] ); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php 
            if (isset($button[0])): 
                
                $target = $button[0]['atts']['target'];
                if(empty($target)){
                    $target = '_self';
                }

                ?>
                <footer>
                    <a href="<?php echo esc_url($button[0]['atts']['url']); ?>" target="<?php echo esc_attr( $target ); ?>" class="btn btn-sm btn-default btn-bg"><?php echo esc_html( $button[0]['content'] ); ?></a>
                </footer>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if( $atts['style'] == '3') : ?>
        <div class="price-col col-xs-12 col-sm-6 col-md-3">
            <div class="price-col-wrap">
                <header>
                    <?php if (isset($caption[0])): ?>
                        <h4>
                           <?php echo esc_html( $caption[0]['content'] ); ?>
                        </h4>
                    <?php endif; ?>
                    <?php if (isset($price[0])): ?>
                        <div class="price-currency">
                            <h3><?php echo esc_html( $price[0]['atts']['small_left'] ); ?><span><?php echo esc_html( $price[0]['content'] ); ?></span><?php echo esc_html( $price[0]['atts']['small_right'] ); ?></h3><p><?php echo esc_html( $price[0]['atts']['prefix'] ); ?></p>
                        </div>
                    <?php endif; ?>
                </header>

                <?php if (isset($featureds) && count($featureds) > 0): ?>
                    <ul class="price-feature">
                        <?php foreach ($featureds as $featured): ?>
                            <li>
                                <?php echo esc_html( $featured['content'] ); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php 
                if (isset($button[0])): 
                    
                    $target = $button[0]['atts']['target'];
                    if(empty($target)){
                        $target = '_self';
                    }

                    ?>
                    <footer>
                        <a href="<?php echo esc_url($button[0]['atts']['url']); ?>" target="<?php echo esc_attr( $target ); ?>" class="btn btn-sm btn-default btn-bg"><?php echo esc_html( $button[0]['content'] ); ?></a>
                    </footer>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if( $atts['style'] == '4') : ?>
        <div class="price-col current col-xs-12 col-sm-6 col-md-3">
            <div class="price-col-wrap">
                <header>
                    <?php if (isset($caption[0])): ?>
                        <h4>
                           <?php echo esc_html( $caption[0]['content'] ); ?>
                        </h4>
                    <?php endif; ?>
                    <?php if (isset($price[0])): ?>
                        <div class="price-currency">
                            <h3><?php echo esc_html( $price[0]['atts']['small_left'] ); ?><span><?php echo esc_html( $price[0]['content'] ); ?></span><?php echo esc_html( $price[0]['atts']['small_right'] ); ?></h3><p><?php echo esc_html( $price[0]['atts']['prefix'] ); ?></p>
                        </div>
                    <?php endif; ?>
                </header>

                <?php if (isset($featureds) && count($featureds) > 0): ?>
                    <ul class="price-feature">
                        <?php foreach ($featureds as $featured): ?>
                            <li>
                                <?php echo esc_html( $featured['content'] ); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php 
                if (isset($button[0])): 
                    
                    $target = $button[0]['atts']['target'];
                    if(empty($target)){
                        $target = '_self';
                    }

                    ?>
                    <footer>
                        <a href="<?php echo esc_url($button[0]['atts']['url']); ?>" target="<?php echo esc_attr( $target ); ?>" class="btn btn-sm btn-default btn-bg"><?php echo esc_html( $button[0]['content'] ); ?></a>
                    </footer>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return apply_filters('luxicar_toolkit_shortcode_pricing_table', $html, $atts, $content);
}

function luxicar_toolkit_shortcode_pricing_table_style($atts, $content = null) {
    extract(shortcode_atts(array('style'), $atts));
    if( $atts['style'] == '1'){
       $output = sprintf('<div class="kopa-price-table-1"">%s</div>', do_shortcode($content));
    }
    if( $atts['style'] == '2'){
       $output = sprintf('<div class="kopa-price-table-2""><div class="row">%s</div></div>', do_shortcode($content));
    }
    return apply_filters('luxicar_toolkit_shortcode_pricing_table_style', $output);
}