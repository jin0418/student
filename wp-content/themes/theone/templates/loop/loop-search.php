<?php
global $post;
if($post->ID):
    $thumb_class ='post-thumbnail  hover-thumb'; // six
    $content_class ='post-content'; // six
    $is_small = false;
    $pos_class ='post blog-post-item b50';
    $link =get_permalink($post->ID);
    $date_format = get_option('date_format');
?>

<article <?php post_class($pos_class); ?>  id="post-<?php the_ID(); ?>">
        
        <header class="entry-header">
			<h2 class="entry-title">
				<a  title="<?php printf( esc_attr__( 'Permalink to %s', 'smooththemes' ), the_title_attribute( 'echo=0' ) ); ?>"  rel="bookmark" href="<?php echo $link; ?>"><?php the_title(); ?></a>
			</h2>
		</header>
        
        <div class="entry-excerpt">
            <?php st_excerpt_length(70); ?>
			<?php the_excerpt(); ?>
		</div>
        
       
    <div class="clear"></div>   
</article>
<?php endif; ?>