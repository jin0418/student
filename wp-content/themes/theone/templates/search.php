
<div class="content ">
 <?php
  if(have_posts()): while(have_posts()) : the_post(); ?>
             <?php  include(ST_TEMPLATE_DIR.'loop/loop-search.php');?>
 <?php endwhile; ?>
 
  <div class="pagination pagination-right text-center t40">
  <?php st_post_pagination(); ?>
  </div>
  <?php else : ?>
    <?php // not found ?>
 <?php endif  ?>
 
 
</div>