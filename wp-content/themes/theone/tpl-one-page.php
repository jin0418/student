<?php
/*
 Template Name: One Page
*/

function one_page_body_class($classes, $class)
{
    global $post;
    $classes[] = '';
    $st_page_options = $st_page_builder = get_page_builder_options($post->ID);
    $home_element = $st_page_options['home_element_type'];
    if ($home_element && $home_element =='fixed-height-slider') {
        $classes[] = 'one-page home-fullslider';
    }
    else if ($home_element && $home_element =='layer-slider') {
        $classes[] = 'one-page home-top-slider';
    }
    else if ($home_element && $home_element =='fixed-height-video') {
        $classes[] = 'one-page home-video-fullwidth';
    }
    
    return $classes;
}

add_filter('body_class', 'one_page_body_class', 10, 2);

global $post;
the_post();

$st_page_options = $st_page_builder = get_page_builder_options($post->ID);
$builder_content = get_page_builder_content($post->ID);

$home_element = $st_page_options['home_element_type'];

do_action('st_theme_start');

$sections = is_array($st_page_options['one_page']) ? $st_page_options['one_page'] : array();

get_header();

if (isset($st_page_options['one_page_slider']) && isset($st_page_options['one_page_slider']['images']) && is_array($st_page_options['one_page_slider']['images']) && $home_element == 'fixed-height-slider') {
    echo '<div id="sliderfull"><section id="slidertop">';
    background_slider($st_page_options['one_page_slider'], true);
    echo '</section></div>';
}
else if ($home_element == 'layer-slider') { ?>
    <div id="top-slider">
        <?php layerslider($st_page_options['layer_slider_id']); ?>
    </div>
<?php
}
?>
    <div id="container">
<?php        
    if ($home_element == 'fixed-height-video') {
        $data = array();
        $data['home_video_id'] = $st_page_options['home_video_id'];
        $data['home_video_caption'] = $st_page_options['home_video_caption'];
        fixed_height_video($data, true);
    }


        // echo var_dump($sections);

        foreach ($sections as $bid => $section) {

            $box_id = (isset($section['custom_id'])  && $section['custom_id']!='') ? $section['custom_id'] : 'id-' . $bid;

            if ($section['item_type'] == 'page') {
                $post = get_post($section['page_id']);
                setup_postdata($post);

                $item_options = get_page_builder_options($post->ID);
                $title = $section['title'];
                $tagline = $section['tagline'];

                if ($tagline != '') {
                    $title .= '.';
                }

                $builder_content = get_page_builder_content($post->ID);

                $section_style = '';
                if ($section['is_parallax'] != 'y') {

                    $section_style = st_background_sytle($section['bg_color'], $section['bg_src'], $section['bg_positon'], $section['bg_repeat']);

                }

                ?>
                <section class="page-area<?php echo $section['is_parallax'] == 'y' ? ' is_parallax_page' : ''; ?>" id="<?php echo $box_id; ?>" <?php echo ($section_style != '') ? '  style="background: ' . $section_style . '" ' : ''; ?> >
                    <?php if ($section['is_parallax'] == 'y'){

                    $src = $section['bg_src'];
                    $style = '';

                    if ($src != '') {
                        $style = ' style="background-image: url(&quot;' . $src . '&quot;); background-position: 50% 13px;" ';
                    }

                    ?>

                    <div data-speed="0.4" data-bg="<?php echo $src; ?>" class="parallax">
                        <div class="separator-bg" <?php echo $style; ?>></div><div class="pattern"></div>
                  
                        <?php } // end cheack is paralax;   ?>

                        <div class="container">
                            <div class="page-wrapper row">
                                <div class="twelve columns b30">
                                    <?php if ($title != '') { ?>
                                        <div class="page-title-wrapper text-left">
                                            <h2 class="page-title"><?php echo esc_html($title); ?></h2>

                                            <p class="page-title-desc"><?php echo esc_html($tagline); ?></p>

                                            <div class="page-title-shadow"></div>

                                        </div><!-- END page-title -->
                                    <?php } ?>

                                    <div class="content">
                                        <div <?php post_class('text-content'); ?>>
                                            <?php
                                            if ($builder_content == '') {
                                                the_content();
                                            } else {

                                                echo do_shortcode($builder_content);
                                            }
                                            ?>
                                        </div>

                                    </div>
                                    <!-- END content-->
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>

                        <?php if ($section['is_parallax'] == 'y'){

                        ?>
                    </div>
                <?php }// end cheack is paralax;  ?>

                </section>

            <?php

            } else { // if not is page

                $src = $section['image'];
                $style = '';

                if ($src != '') {
                    $style = ' style="background-image: url(&quot;' . $src . '&quot;); background-position: 50% 13px;" ';
                }

                ?>
                <section class="page-area is_parallax_page" id="<?php echo $box_id; ?>">
                    <div data-speed="0.4" data-bg="<?php echo $src; ?>" class="parallax">

                        <div class="separator-bg" <?php echo $style; ?>></div><div class="pattern"></div>

                        <div class="container">

                            <div class="page-wrapper row">

                                <div class="twelve columns b30">

                                    <div class="parallax-element-wrapper">

                                        <div class="parallax-inner">

                                            <?php echo do_shortcode(balanceTags($section['content'])); ?>

                                        </div>
                                        <!--End parallax-inner-->

                                    </div>
                                    <!--END parallax-element-wrapper-->

                                </div>

                            </div>

                        </div>
                        <!-- END container-->

                    </div>
                </section>

            <?php
            }
        }// end foreach  $sections
        ?>

        <?php
        if (isset($st_page_options['bottom_custom_code']) && $st_page_options['bottom_custom_code'] != '') {
            echo '<div class="bottom-page-code">' . balanceTags($st_page_options['bottom_custom_code']) . '</div>';
        }
        ?>


    </div>

<?php
get_footer();
do_action('st_theme_end');