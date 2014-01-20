<?php
/**
 * Display slider as type
 *
 *  'layerslider'=>"Layer slider",
'revslider'=>'Revolution Slider',
'elasticslideshow'=>'Elastic Slide show',
'nivo'=>'Nivo Slider',
'flexslider'=>'Flex Slider'
 *
 */
function st_the_slider($page_builder_data, $must_show = false, $is_top_slider = false)
{
    // if empty data 
    if (!isset($page_builder_data) || empty($page_builder_data)) {
        return;
    }
    // if not show  slider

    if ((boolean)$must_show == false) {
        if ((!isset($page_builder_data['show_top_slider']) || $page_builder_data['show_top_slider'] != 1) && (!isset($page_builder_data['show_slider']) || $page_builder_data['show_slider'] != 1)) {
            return;
        }
    }
    $img_size = (isset($page_builder_data['size']) && $page_builder_data['size'] != '') ? $page_builder_data['size'] : false;
    $img_size = ($img_size) ? $img_size : 'st_medium';
    $lightbox = (isset($page_builder_data['lightbox'])) ? $page_builder_data['lightbox'] : false;

    if (isset($page_builder_data['slider_full_w']) && $page_builder_data['slider_full_w'] == 1) {
        $class = "slider-no-boxed";

    } elseif (in_array($page_builder_data['slider_type'], array('flexslider', 'titlebar', 'statichtml'))) {
        $class = "slider-boxed";
    }

    $class = (!$is_top_slider) ? $class .= '-in' : $class;

    echo ($is_top_slider) ? ' <div class="slider-outer-wrapper ' . $class . '">  <div class="main_slider">' : '';

    switch (strtolower($page_builder_data['slider_type'])) {
        case 'flexslider':
            //$img_size ='';
            if ($is_top_slider) {
                $class .= ' top-page-flexslider';
                //$img_size ='full';
                $img_size = 'st_medium';
                $settings['show_caption'] = 'yes';
            }

            echo '<div class="' . $class . '">';

            $data = $page_builder_data;
            if (is_file(ST_TEMPLATE_DIR . '/sliders/flex.php')) {
                include(ST_TEMPLATE_DIR . '/sliders/flex.php');
            }

            echo '</div>';
            break;

    }
    echo ($is_top_slider) ? ' </div>  <div class="shadow-box"></div> </div>' : '';
}
