 <?php
 $settings['image_size'] ='st_blog_thumb';
 
 $index =1;
 $num_col =  2;
 $col_txt = stpb_number_to_text(12/$num_col);
 if(have_posts()): 
  
  
  ?>
<div class="loop-posts">
	<div class="row">
	  
	 <?php  while(have_posts()) : the_post(); ?>
	    <div class="<?php echo $col_txt;  ?> columns b30">
	    	<?php  include(ST_TEMPLATE_DIR.'loop/loop-post.php');?>
	    </div>
	 <?php 
	 if($index>=$num_col){
	 	echo '<div class="clear"></div>';
	 	$index=1;
	 }else{
	 	$index++;
	 }
	 
	 endwhile; ?>
	 
	<div class="clear"></div>
	</div>
</div>

<div class="pagination pagination-right text-center t40">
<?php st_post_pagination(); ?>
</div>
<?php else : ?>
	<?php // not found ?>
<?php endif  ?>
