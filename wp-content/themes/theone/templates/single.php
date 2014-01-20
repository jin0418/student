 <?php
 global $post, $page;
 the_post(); 
 $st_page_options =  $st_page_builder = get_page_builder_options($post->ID);
 $builder_content = get_page_builder_content($post->ID); 
 $date_format = get_option('date_format');
 $thumb_size = (st_get_layout()=='layout-no-sidebar') ? 'st_large' : 'st_medium';
 
 $post_link = get_permalink($post->ID);

 $is_sticky = is_sticky($post->ID);
 if($is_sticky){
     $pos_class.=' sticky-post ';
 }
 
 ?>
 
 <article id="post-ID" class="post single single-post blog-post-item b50">
 
 	<?php  if(st_get_setting('s_show_post_meta','y')!='n' || $is_sticky){ ?>
 	<div class="entry-date">
        <?php  if(st_get_setting('s_show_post_meta','y')!='n'){ ?>
		<span class="post-date"><?php the_time($date_format); ?></span>
        <?php } ?>
        <?php if($is_sticky){ ?>
            <span class="sticky"><?php _e('Sticky','smooththemes'); ?></span>
        <?php } ?>
	</div>
	 <?php } ?>
									
    <?php  if(st_get_setting('s_show_featured_img','y')!='n'){ ?>
    <div class="entry-media feature-post post-thumbnail">
        <?php
        if($is_sticky){
            echo '<span class="sticky-icon"><i class="icon-pushpin"></i></span>';
        }
        ?>
        <?php echo $thumb_html = st_post_thumbnail(get_the_ID(), $thumb_size, false, true); ?>
	</div>
    <?php } ?>
    
    <?php if( st_get_setting('s_show_post_meta','y')!='n'){ ?>
    
	<footer class="meta-entry">
		<ul class="post-categories">
			<?php the_category(); ?>
		</ul>
		<div class="meta-outer">
			<span class="post-time"><i class="icon-user"></i><?php echo the_author_posts_link(); ?></span>
			<span class="post-charactor"> | </span>
			<span class="post-comments"><i class="icon-comments"></i><a title="<?php printf( esc_attr__( 'Permalink to %s', 'smooththemes' ), the_title_attribute( 'echo=0' ) ); ?>"  rel="bookmark" href="<?php echo get_comments_link(); ?>"><?php comments_number(__('0 Comment','smooththemes'),__('1 Comment','smooththemes'),__('% Comments','smooththemes') ); ?></a></span>
		</div>
		<div class="clear"></div>
	</footer><!--END meta-entry-->

    <?php } ?>
    
    <header class="entry-header">
		<h2 class="entry-title"><?php the_title(); ?></h2>
	</header>
    
    
    <div class="entry-content">                                    
        <?php 
        do_action('st_before_the_content',$post);
         echo '<div class="text-content  editor-content">';
            the_content(); 
         echo '</div>';
        do_action('st_after_the_content',$post);
        do_action('st_after_page_content');
        
            $args = array(
              'before'           => '<p class="p-pagination">' . __('Pages:','smooththemes'),
              'after'            => '</p>',
              'link_before'      => '<span>',
              'link_after'       => '</span>',
              'next_or_number'   => 'number',
              'nextpagelink'     => __('Next page','smooththemes'),
              'previouspagelink' => __('Previous page','smooththemes'),
              'pagelink'         => '%',
              'echo'             => 1
            );
            
            wp_link_pages( $args ); 
                    
         ?> 
        <div class="clear"></div>
    </div><!-- END page-content-->
    
  	<?php if(st_get_setting('s_show_share','y')!='n' || st_get_setting('s_show_post_tag','y')!='n'){ ?>
		<div class="entry-tags">
			<div class="page-tags">
			<?php  if(st_get_setting('s_show_post_tag','y')!='n'){ ?>
			<?php the_tags('<i class="icon-tag"></i> ',', ',''); ?>    
			<?php } ?>
			</div>
			
			<?php  if(st_get_setting('s_show_share','y')!='n'){ ?>
			<span class="entry-share"><i class="icon-plus-sign-alt"></i><?php _e('Share','smooththemes'); ?>
			<span class="tooltip genericon genericon-downarrow">
		    <span class="tooltip-inner">
						
					
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                        <script type="text/javascript">
                        (function() {
                          var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                          po.src = 'https://apis.google.com/js/plusone.js';
                          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                        })();
                        </script>

                        <a data-lang="en" data-via="" data-text="Share title" data-url="<?php echo $post_link;  ?>" class="twitter-share-button" href="https://twitter.com/share">tweet</a>
                        <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode($post_link); ?>&amp;send=false&amp;layout=button_count&amp;width=107&amp;show_faces=false&amp;font=arial&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:107px; height:21px;" allowTransparency="true"></iframe>
                        <a data-pin-config="none" data-pin-do="buttonBookmark" href="//pinterest.com/pin/create/button/"><img src="//assets.pinterest.com/images/PinExt.png" /></a>
                        <script src="//assets.pinterest.com/js/pinit.js"></script>
		    </span>
			</span>
			<?php } ?>
		</span>
		<div class="clear"></div>
		</div><!--END entry-Tags-->

		<?php } ?>
		
		<?php if (st_get_setting('s_show_about_author', 'y')=='y') {  ?>
		<div class="divider"></div>
		<div class="author-info">
			<div class="author-inner">
				<span class="t-avt">
					<?php echo get_avatar( get_the_author_meta('ID'), 90 ); ?>
				</span>
				<h3 class="author-title"><?php _e('About the Author','smooththemes'); ?></h3>
				<div class="author-text">
					<?php echo st_get_user_desc( get_the_author_meta('ID') ); ?>
				</div>
			</div>
		</div>
		
		
		
	    <?php }; ?>
    
		<?php  if(st_get_setting('s_show_comments','y')!='n'){ ?>
		<div class="divider"></div>
        <div id="comments">
              <?php comments_template('', true ); ?>
		</div><!--END comments-->
		 <?php } ?>
    </article>
    
