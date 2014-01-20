<?php
global $post;
if($post->ID):
    $thumb_class ='post-thumbnail  hover-thumb '; // six
    $content_class ='post-content'; // six
    $is_small = false;
    $pos_class ='post blog-post-item b0 in-loop-post';
    $link =get_permalink($post->ID);
    $date_format = get_option('date_format');

    $is_sticky = is_sticky($post->ID);
    if($is_sticky){
        $pos_class.=' sticky-post ';
    }

?>
<article <?php post_class($pos_class); ?>  id="post-<?php the_ID(); ?>">

		<div class="entry-date clf">
			<span class="post-date"><?php the_time($date_format); ?></span>
            <?php if($is_sticky){ ?>
                <span class="sticky"><?php _e('Sticky','smooththemes'); ?></span>
            <?php } ?>
		</div>
        <?php
         $image_size = (isset($settings['image_size']) && $settings['image_size'] !='' ) ? $settings['image_size']  : 'st_blog_thumb';
         $thumb_html = st_list_post_thumbnail($post->ID,$image_size);
         if($thumb_html){
         ?>
        <div class="<?php echo $thumb_class; ?>  blog-thumb-wrapper">
            <?php
            if($is_sticky){
                echo '<span class="sticky-icon"><i class="icon-pushpin"></i></span>';
            }
            echo $thumb_html; ?>
            <div class="clear"></div>
        </div>
        <?php } ?>
        
        <header class="entry-header">
			<h2 class="entry-title">
				<a  title="<?php printf( esc_attr__( 'Permalink to %s', 'smooththemes' ), the_title_attribute( 'echo=0' ) ); ?>"  rel="bookmark" href="<?php echo $link; ?>"><?php the_title(); ?></a>
			</h2>
		</header>
        
    <div class="clear"></div>   
</article>
<?php endif; ?>