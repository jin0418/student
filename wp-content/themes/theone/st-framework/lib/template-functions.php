<?php

/* remove default admin toool bar bump */
function  st_admin_bar_bump_cb()
{

}

add_theme_support('admin-bar', array('callback' => 'st_admin_bar_bump_cb'));


function st_get_tpl_file_name()
{

    $default = 'list-post';
    $file = 'list-post';

    if (is_singular()) {
        global $post;
        if ($post->post_type != 'page' && $post->post_type != 'post') {
            $file = $post->post_type;
            if (!file_exists(ST_TEMPLATE_DIR . $file . '.php')) {
                $file = 'single';
            }

        } else {
            if (is_page()) {
                $file = 'page';
            } else {
                $file = 'single';
            }
        }
    } elseif (is_author()) {
        $file = 'author';
    } elseif (is_tag()) {
        $file = 'tag';
    } elseif (is_tax()) {
        $tax = get_queried_object();
        $file = 'taxonomy-' . $tax->taxonomy;
        if (file_exists(ST_TEMPLATE_DIR . $file . '.php')) {
            return $file;
        } else {
            return 'taxonomy';
        }

    } elseif ((is_archive() || is_day() || is_date() || is_month() || is_year() || is_time()) && !is_category()) {
        $file = 'archive';
    } elseif (is_search()) {
        $file = 'search';
    } elseif (is_404()) {
        $file = '404';
    }

    if (file_exists(ST_TEMPLATE_DIR . $file . '.php')) {
        return $file;
    } else {
        return $default;
    }

}

/**/
function st_page_titlebar_tempalte()
{
    $file = ST_TEMPLATE_DIR . 'titlebar.php';

    if (file_exists($file)) {
        include($file);
    }
}

/**
 * hook : st_before_layout
 */
add_action('st_before_layout', 'st_page_titlebar_tempalte', 10); // make sure this acrion always at bottom


/**
 * @return class has-titlebar, has-slider, ...
 */
function main_outer_wrapper_class()
{
    $class = '';
    if (is_page() || (is_singular() && !is_singular('post'))) {
        global $post;
        $st_page_builder = get_page_builder_options($post->ID);
        if (isset($st_page_builder['show_top_slider']) && $st_page_builder['show_top_slider'] == 1) {
            if (isset($st_page_builder['slider_type']) && in_array($st_page_builder['slider_type'], array('layerslider', 'revslider', 'flexslider'))) {
                $class = 'has-slider';
            } else {
                $class = 'has-titlebar';
            }
        } else {
            $class = 'no-titlebar';
        }

    } elseif (is_singular('post') || is_tax() || is_category() || is_tag() || ((is_home() || is_front_page()) && !is_page())) {
        if (st_get_setting('show_blog_titlebar', 'y') != 'n') {
            $class = 'has-titlebar';

        }
    } elseif (is_404()) {
        $class = 'has-titlebar';
    }


    return $class;
}


function st_page_title_tempalte()
{
    $file = ST_TEMPLATE_DIR . 'top-title.php'; // default

    if (file_exists($file)) {
        include($file);
    }
}

/**
 * hook : st_page_title_tempalte
 */
add_action('st_top_page_template', 'st_page_title_tempalte', 10);


/**
 * Include current template for  layout
 */
function st_page_template()
{
    $default = 'list-post';
    // for title
    $file = $GLOBALS['st_template_file_name'];
    // for main content
    if (file_exists(ST_TEMPLATE_DIR . $file . '.php')) {
        include(ST_TEMPLATE_DIR . $file . '.php');
    } else {
        include(ST_TEMPLATE_DIR . $default . '.php');
    }
}

/**
 * hook : st_page_template
 */
add_action('st_page_template', 'st_page_template');


/**
 * display sidebar depend each page
 */
function st_sidebar($sidebar = '', $positon = 'right')
{
    $sidebar;

    $afterfix = '_r';
    if (strtolower($positon) == 'left') {
        $afterfix = '_l';
    }

    if (empty($sidebar)) {
        if (is_category()) {
            $sidebar = st_get_setting("sidebar_category" . $afterfix, 'sidebar_default' . $afterfix);
        } elseif (is_search()) {
            $sidebar = st_get_setting("sidebar_search" . $afterfix, 'sidebar_default' . $afterfix);
        }
    }

    if (empty($sidebar) || $sidebar == '') {
        $sidebar = 'sidebar_default' . $afterfix;
    }


    do_action('st_before_sidebar' . $afterfix, $sidebar);
    dynamic_sidebar($sidebar);
    do_action('st_atter_sidebar' . $afterfix, $sidebar);
}

/**
 * hook st_sidebar
 */
add_action('st_sidebar', 'st_sidebar', 10, 2);


/**
 * Return laoyout file by number
 */
function st_get_layout($number = -1)
{
    if ($number < 1) {

        if (is_singular()) {
            global $post;

            $st_page_builder = get_page_builder_options($post->ID);
            $layout = (isset($st_page_builder['layout'])) ? intval($st_page_builder['layout']) : 0;

            if (in_array($layout, array(1, 2, 3, 4))) {
                $number = $layout;
            }

        } elseif (is_tax()) { // for default layout in admin page
            $tax = get_queried_object();
            $number = intval(st_get_setting("{$tax->taxonomy}_layout", 0));
        }

        if ($number <= 0) {
            $number = intval(st_get_setting("layout", 2));
        }

    } // end if number 


    switch (intval($number)) {
        case  4 :
            $l = 'layout-left-right-sidebar';
            break;
        case  3 :
            $l = 'layout-left-sidebar';
            break;
        case  2 :
            $l = 'layout-right-sidebar';
            break;
        case  1 :
            $l = 'layout-no-sidebar';
            break;
        default :
            $l = 'layout-right-sidebar';
    }

    return apply_filters('st_get_layout', $l, $number);
}


// this is call back for comments
function st_comments($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment-item">

        <div class="comment-header">
            <?php echo get_avatar($comment->comment_author_email, $size = '60', $default = ''); ?>

            <div class="comment-header-right">
                <?php $user_comment = @get_userdata($comment->user_id); ?>
                <?php if ($user_comment) { ?>
                    <a href="<?php echo get_author_posts_url($user_comment->ID); ?>" title="<?php echo esc_attr(($user_comment->display_name != '') ? $user_comment->display_name : $user_comment->nicename); ?>"
                       class="comment-author"><?php printf('<b class="author_name">%s</b>', ($user_comment->display_name != '') ? $user_comment->display_name : $user_comment->nicename) ?></a>
                <?php } else { ?>
                    <a href="<?php echo esc_attr(($comment->comment_author_url != '') ? $comment->comment_author_url : '#'); ?>" title="<?php echo esc_attr(($comment->comment_author_url != '') ? $comment->comment_author_url : ''); ?>"
                       class="comment-author"><?php printf('<b class="author_name">%s</b>', get_comment_author_link()) ?></a>
                <?php } ?>
                <p class="comment-date"><?php printf(__st('%1$s'), get_comment_date(__('F d, Y', 'smooththemes')) . ' ' . __('at', 'smooththemes') . ' ' . get_comment_date(__('g:i a', 'smooththemes'))); ?></p>
                <span class="rec"><?php echo __(' - ', 'smooththemes'); ?></span>
                <?php edit_comment_link(__st('(Edit)'), '  ', '') ?>
                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>

        </div>

        <div class='comment-content'>
            <?php comment_text() ?>
            <?php if ($comment->comment_approved == '0') : ?>
                <br/> <em><?php _st('Your comment is awaiting moderation.', 'smooththemes') ?></em>
            <?php endif; ?>

        </div>
        <div class="clear"></div>

    </div>
<?php
}


/**
 * parse Font
 * @return array
 */
function st_parse_font($font_url)
{
    $font_url = urldecode($font_url);
    $args = parse_url($font_url);
    $return = array('is_g_font' => false, 'name' => $font_url, 'link' => '');

    $args = wp_parse_args($args, array(
        'host' => '',
        'query' => ''
    ));

    $font_data = wp_parse_args($args['query'], array('family' => '', 'subset' => ''));

    if ($args['host'] == 'fonts.googleapis.com' && $font_data['family'] != '') {
        //  echo var_dump($args) ; die();

        if (strpos($font_data['family'], ':') !== false) {
            $font_data['family'] = explode(':', $font_data['family']);
            $font_data['family'] = (isset($font_data['family'][0]) && $font_data['family'][0] != '') ? $font_data['family'][0] : '';
        } else {

        }

        if ($font_data['family'] != '') {
            $return['name'] = $font_data['family'];
            $return['is_g_font'] = true;
            $return['link'] = $font_url;
        }
    }

    return $return;
}


/**
 * make font style
 * Only use for header.php file
 */
function st_make_font_style($font, $css_selector, $show_font_size = true)
{


    if ($font['font-family'] != '') {
        $font_data = st_parse_font($font['font-family']);

        //$is_not_gfont = key_exists($font['font-family'],st_get_normal_fonts());
        ?>
        <?php if ($font_data['is_g_font'] == true) : ?>
            <link href='<?php echo $font_data['link'] ?>' rel='stylesheet' type='text/css'>
        <?php endif; ?>

        <style type="text/css">

            <?php echo $css_selector; ?>
            {
                font-family: '<?php echo $font_data['name']; ?>';
            <?php if(isset($font['font-style']) && $font['font-style']): ?>
                font-style:<?php echo $font['font-style']; ?>;
            <?php endif; ?>
            <?php if(isset($font['font-style']) && $font['font-style']): ?>
                font-style:<?php echo $font['font-style']; ?>;
            <?php endif; ?>
            <?php if(isset($font['font-weight']) && $font['font-weight']): ?>
                font-weight:<?php echo $font['font-weight']; ?>;
            <?php endif; ?>
            <?php if(isset($font['font-size']) && $font['font-size']): ?>
                font-size: <?php echo intval($font['font-size']); ?>px;
            <?php endif; ?>
            <?php if(isset($font['line-height']) && $font['line-height']): ?>
                line-height: <?php echo intval($font['line-height']); ?>px;
            <?php endif; ?>
            <?php if(isset($font['color'])  && $font['color']): ?>
                color: #<?php echo $font['color']; ?>;
            <?php endif; ?>

            }
        </style>
    <?php
    }
}


/** ************* ST Theme ads ********************/
/**
 *  auto add ads to hooks
 */
function st_auto_ads()
{
    $ads = st_get_setting("ads");
    if (is_array($ads)) {
        foreach ($ads as $ad) {
            if ($ad['hook'] != '' && $ad['content'] != '') {
                $ad['content'] = stripslashes($ad['content']);
                $ad['content'] = str_replace("'", "\'", $ad['content']);
                $new_func = create_function('$c=""', ' echo  \'' . $ad['content'] . '\' ; ');
                add_action($ad['hook'], $new_func);
            }
        }
    }

}

st_auto_ads(); // auto run


function st_background_sytle($bg_color = '', $bg_img = '', $bg_positon = '', $bg_repreat = '', $bg_fixed = 'n')
{
    $bd_style = '';
    $bg_color = str_replace('#', '', $bg_color);
    if ($bg_color != '' || $bg_positon != '' || $bg_img != '') {

        if ($bg_color != '') {
            $bd_style .= ' #' . $bg_color;
        }
        if ($bg_img != '') {
            $bd_style .= ' url(' . $bg_img . ') ';

            switch (strtolower($bg_positon)) {
                case 'tl':
                    $bd_style .= ' top left ';
                    break;

                case 'tr':
                    $bd_style .= ' top right ';
                    break;

                case 'tc':
                    $bd_style .= ' top center ';
                    break;

                case 'cc':
                    $bd_style .= ' center center';
                    break;
                case 'bl':
                    $bd_style .= ' bottom left ';
                    break;
                case 'br':
                    $bd_style .= ' bottom right ';
                    break;
                case 'bc':
                    $bd_style .= ' bottom center ';
                    break;
            }

            switch (strtolower($bg_repreat)) {
                case 'x':
                    $bd_style .= ' repeat-x ';
                    break;
                case 'y':
                    $bd_style .= ' repeat-y ';
                    break;
                case 'n':
                    $bd_style .= ' no-repeat ';
                    break;
            }

            if ($bg_fixed == 'y') {
                $bd_style .= ' fixed ';
            }
        }
    }

    return $bd_style;
}

function st_theme_style()
{
    $font_body = st_get_setting("body_font", array('font-family' => 'Roboto'));
    $heading_font = st_get_setting("headings_font", array('font-family' => 'Roboto'));
    $page_title_font = st_get_setting("page_title_font", array('font-family' => 'Roboto'));
    st_make_font_style($font_body, 'body');
    st_make_font_style($heading_font, 'h1,h2,h3,h4,h5,h6, .subscribe_section label, .widget_calendar  caption');
    st_make_font_style($page_title_font, 'h2.page-title, .page-title');
    // Predefined Colors (pc) - Custom Color (cc)
    /*
    $pc = st_get_setting("predefined_colors");
    $e_cc = st_get_setting("enable_custom_global_skin");
    $cc = st_get_setting("custom_global_skin");
    $skin = '';
    if ($e_cc == 'y') {
        $skin = ($cc != '') ? $cc : $pc;
    } elseif ($pc != '') {
        $skin = $pc;
    }

    $skin = str_replace('#', '', esc_attr($skin));
    $skin = ($skin != '') ? $skin : 'bca474';
    */

    //

    $skin_elements = array(
         'skin_header'=> array(
            'default'=>'000000',
            'selector'=>'
                #header-sticky-wrapper{ background-color : __SKIN__ ; }
            ',
         ),

        'skin_header_link'=> array(
            'default'=>'757575',
            'selector'=>'#primary-nav-id >  ul > li > a {color: __SKIN__; } ',
        ),
        'skin_header_link_hover'=> array(
            'default'=>'FFFFFF',
            'selector'=>' #primary-nav-id ul li.current > a, #primary-nav-id ul li a:hover, #primary-nav-id ul li.st-current-item a, #primary-nav-id ul li.current-menu-parent a, #primary-nav-id ul li.menu-must-active.st-current-item a {color: __SKIN__; }',
        ),

        'skin_primary'=> array(
            'default'=>'00A6D5',
            'selector'=>'
            .pricetable .plan-active figcaption, .pricetable .plan-active footer a,
             .widget_tag_cloud a, ul.post-categories li a,
            .ourteam-page .member-info .position,
             .video-desc a.btn,
            .browse-all.btn , .page-area input.wpcf7-submit, .btn-primary,
             #slidecaption .desc a.btn, .video-desc a.btn, #top-slider .desc a.btn,
             .btn.color, .input.btn.color, #respond #submit, .btn,  #backto a,
             .st-pagination li a
            { background-color : __SKIN__ ; }

             .service-wrap .icon-services, .entry-content .servcices-fp .icon, .post .sticky{ color: __SKIN__;}
             body .service-wrap .icon-services:hover, body .entry-content .servcices-fp .icon:hover{ color:  #FFFFFF;  background-color: __SKIN__; }

             .post-thumbnail .sticky-icon{  border-color: transparent __SKIN__ transparent transparent; line-height: 0px; _border-color: #000000 __SKIN__ #000000 #000000; }

            ',
         ),


        'skin_link'=> array(
            'default'=>'757575',
            'selector'=>'a{ color : __SKIN__;  }',
        ),
        'skin_link_hover'=> array(
            'default'=>'00A6D5',
            'selector'=>'a:hover, .tab-title li.current, .cpt-filters li a:hover, .cpt-filters li a.selected{ color : __SKIN__ ;  }',
        ),


    );




    ?>
<style type="text/css">
<?php
    foreach($skin_elements as $k => $e){
        $e_color = st_get_setting($k,'');
        if($e_color==''){
            $e_color = $e['default'];
        }

        if($e_color!='' && $e['selector']!=''){
             $e_color = '#'.$e_color;
             echo "\n";
             echo str_replace('__SKIN__',$e_color, $e['selector']);
             echo "\n";

        }


    }

    for($i=1; $i<=6; $i++){
        $h = st_get_setting("heading_".$i,array());
        if(intval($h['font-size'])>0){
            echo "h{$i}{ font-size: ".intval($h['font-size'])."px;} \n";
        }
    }
?>
</style>

<?php
}

/**
 * Set back ground for body
 * hook  wp_head
 */
function st_theme_body_bg()
{
// For background settings
    $bg_type = st_get_setting("bg_type", 'd');
    if ($bg_type == 'd') {
        $bg = st_get_setting("defined_bg", 'background1.jpg');
        // large image with fixed
        if (in_array($bg, array('background1.jpg'))) {
            $bg = ST_THEME_URL . 'assets/images/patterns/' . $bg;
            $style = 'background: url("' . $bg . '") no-repeat fixed center center / cover  transparent;';
        } else {
            $bg = ST_THEME_URL . 'assets/images/patterns/' . $bg;
            $style = 'background: url("' . $bg . '") repeat  center center ';
        }

        echo '<style type="text/css">body, .page-area {' . $style . ' }</style>';
        return;
    } elseif ($bg_type == 'c') {
        $bg = st_get_setting("defined_bg_color");
        if ($bg != '') {
            echo '<style type="text/css">body, .page-area {background: #' . $bg . '; }</style>';
        }
        return;
    }

    // if is custom background

    $bd_style = '';
    $bg_color = $bg_img = $bg_positon = $bg_repreat = $bg_fixed = '';

    $bg_color = st_get_setting("bg_color", '');

    $bg_img = st_get_setting("bg_img", '');
    $bg_positon = st_get_setting("bg_positon", '');
    $bg_repreat = st_get_setting("bg_repreat", '');
    $bg_fixed = st_get_setting('bg_fixed', 'n');

    $bd_style = st_background_sytle($bg_color, $bg_img, $bg_positon, $bg_repreat, $bg_fixed);

    if ($bd_style != '') {
        echo '<style type="text/css">body, .page-area {background: ' . $bd_style . '; }</style>';
    }

}

add_action('wp_head', 'st_theme_body_bg', 91);

// add to wp_head
add_action('wp_head', 'st_theme_style', 90);

function st_header_tracking_code()
{
    $code = st_get_setting('headder_tracking_code', '');
    $code = stripslashes($code);
    if (is_string($code)) {
        echo $code;
    }
}

function st_footer_tracking_code()
{
    $code = st_get_setting('footer_tracking_code', '');
    $code = stripslashes($code);
    if (is_string($code)) {
        echo $code;
    }
}

add_action('wp_head', 'st_header_tracking_code', 123);
add_action('wp_footer', 'st_footer_tracking_code', 123);


function st_theme_body_class($classes, $class)
{
    if (st_get_setting('site_mode', 'f') == 'b') {
        $classes[] = 'boxed-mode';
    } else {
        $classes[] = 'full-width-mode';
    }

    if (st_get_setting('site_header_mode', 'f') == 'b') {
        $classes[] = 'header-boxed';
    } else {
        $classes[] = 'header-full-width';
    }

    if(st_get_setting('site_header_floating')=='n'){
        $classes[] = 'no-floating-header';
    }


    return $classes;
}

add_filter('body_class', 'st_theme_body_class', 35, 2);


function background_slider($data, $show_caption = false)
{
    $images = $data['images'];
    $metas = $data['meta'];

    $sliders = array();

    if (count($images)) {

        foreach ($images as $i => $img_id) {
            $attachment = wp_get_attachment_image_src($img_id, 'full');
            $img_url = $attachment[0];
            $item = array();
            $item['image'] = $img_url;
            $item['title'] = '';
            $meta = $metas[$i];


            if ($meta['title'] != '') {
                $item['title'] = '<h2>' . esc_html($meta['title']) . '</h2>';
            } else if ($meta['title'] != '') {
                $item['title'] = esc_html($meta['title']);
            }

            if ($meta['caption'] != '') {
                $meta['caption'] = '<div class="desc">' . balanceTags($meta['caption']);
                $meta['caption'] .= '<a class="btn local-scroll" href="' . esc_url($meta['url']) . '">' . esc_html($meta['btnlabel']) . ' <i class="iconentypo-down-open-big"></i></a>';
                $meta['caption'] .= '</div>';

                $item['title'] .= $meta['caption'];

            } elseif (isset($meta['btnlabel']) && $meta['btnlabel'] != '') {
                $item['title'] .= '<a class="btn local-scroll" href="' . esc_url($meta['url']) . '">' . esc_html($meta['btnlabel']) . ' <i class="iconentypo-down-open-big"></i></a>';
            }


			//$test = '<div class="text-center" id="slidecaption"><h2>We are theone agency and we do branding &amp; themes</h2><div class="desc">We work with some of the world\'s most recognisable brands. <a class="btn" href="http://demo.smooththemes.com/tung/theone/html#oursevices">Our services <i class="icon-angle-down"></i></a></div> </div>';

            $sliders[] = $item;


        }
        $slider_settings = array();

        $slider_settings['slideshow'] = st_get_setting("fsc_slideshow") == 'n' ? 0 : 1;
        $slider_settings['autoplay'] = st_get_setting("fsc_autoplay") == 'n' ? 0 : 1;
        $slider_settings['slide_interval'] = intval(st_get_setting("fsc_interval")) > 0 ? intval(st_get_setting("fsc_interval")) : 6000;
        $slider_settings['transition_speed'] = intval(st_get_setting("fsc_transition_speed")) > 0 ? intval(st_get_setting("fsc_transition_speed")) : 800;
        $slider_settings['path'] = st_img('');


        ?>
        <script type="text/javascript">
            var full_slider_settings =<?php echo json_encode($slider_settings) ?>;
            var full_slider_data = <?php echo json_encode($sliders); ?>;
        </script>

        <div id="slidecaption" class="text-center"></div>
        <!--Navigation-->
        <ul id="slide-list"></ul>

    <?php
    }

}

function fixed_height_video($data, $show_caption = false) {
?>
<div id="video-full-width-slider">
    <div class="video-fullwidth-content">
        <div class="container">
            <div class="page-wrapper row">
                <div class="twelve columns b30">
                    <div class="video-element-wrapper">
                        <div class="video-inner">
                            <?php echo $data['home_video_caption'] ?>
                        </div><!--End parallax-inner-->
                    </div><!--END parallax-element-wrapper-->
                </div>
                <div class="clear"></div>
            </div>
        </div><!-- END container-->
    </div>
    <div class="video-full-controls">
        <ul>
            <li class="tubular-play"><i class="iconentypo-play"></i></li>
            <li class="tubular-pause"><i class="iconentypo-pause"></i></li>
            <li class="tubular-mute"><i class="iconentypo-mute"></i></li>
            <li class="tubular-volume-down"><i class="iconentypo-volume-down"></i></li>
            <li class="tubular-volume-up"><i class="iconentypo-volume-up"></i></li>
        </ul>
        <div class="control-handle"></div>
    </div>
    <div id="video-full-cover-loading"><div class="loading-icon"></div></div>
</div>
<script type="text/javascript">
    var full_video_data = <?php echo json_encode($data['home_video_id']); ?>;
</script>
<?php
}


function st_end_layout_container()
{
    if (is_page()) {
        global $post;
        $st_page_options = get_page_builder_options($post->ID);
        if (isset($st_page_options['bottom_custom_code']) && $st_page_options['bottom_custom_code'] != '') {
            echo '<div class="bottom-page-code">' . balanceTags($st_page_options['bottom_custom_code']) . '</div>';
        }
    }

}

add_action('st_end_layout_container', 'st_end_layout_container', 123);




