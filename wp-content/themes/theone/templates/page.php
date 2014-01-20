<?php 
global $post;
 the_post();
$st_page_options  = get_page_builder_options($post->ID);
$builder_content = get_page_builder_content($post->ID) ;
?>
<div <?php post_class('text-content'); ?>>
    <?php

    if($builder_content==''){
		  echo '<div class="editor-content">';
          the_content();
          echo '</div>';
    }else{
        echo '<div class="builder-content">';
        echo do_shortcode($builder_content) ;
        echo '</div>';
    }

    ?>
</div>
