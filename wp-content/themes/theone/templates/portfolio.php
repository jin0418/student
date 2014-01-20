 <?php
 global $post, $paged;
 the_post(); 
 $st_page_options =  $st_page_builder = get_page_builder_options($post->ID);
 $builder_content  = get_page_builder_content($post->ID);
 $p_layout ='half';

 ?>
    <div class="single-portfolio-wrapper single-portfolio-<?php echo $p_layout; ?> row">
    
    <?php if($p_layout=='half'){ ?>
        <?php if (st_get_setting('p_desc_align', 'r')=='l') : ?>
        <div class="project-detail project-left-detail four columns b0">
            
        	<div class="project-desc t35 b30">
        		<h3 class="title port-title"><?php _e('Project Decscription','smooththemes'); ?></h3>
        		<div class="ptext">
        			<?php the_content(); ?>
        		</div>
        	</div>
        	
             <div class="single-portfolio-details t35">
                  <?php include(dirname(__FILE__).'/portfolio-details.php'); ?>
            </div>
            
            <div class="project-nav">
				<ul>
					<li><?php  previous_post_link( '%link', '<i class="icon-long-arrow-left"></i>' ); ?></li>
					<li><a href="<?php echo st_get_setting('p_list_page','#'); ?>"><i class="icon-th-large"></i></a></li>
					<li><?php  next_post_link( '%link', '<i class="icon-long-arrow-right"></i>' ); ?></li>
				</ul>
			</div>
            
        </div>
        <?php endif; ?>
        
        <div class="content-primary eight columns b0">
             <div class="box-outer border-column">
                 <?php 
                    $thumb_html = st_post_thumbnail($post->ID,'st_p_large',false, true);
                    if($paged<2 && $thumb_html!=''):
                    ?>
                    <div class="page-featured-image cpt-thumb-wrapper">
                    <?php echo $thumb_html; ?>
                    </div>
                  <?php endif;  ?>
             </div>
        </div>
        
        
        <?php if (st_get_setting('p_desc_align', 'r')=='r') : ?>
        <div class="project-detail project-right-detail four columns b0">
           
        	<div class="project-desc b30">
        		<h3 class="title port-title"><?php _e('Project Decscription','smooththemes'); ?></h3>
        		<div class="ptext">
        			<?php the_content(); ?>
        		</div>
        	</div>
        	
             <div class="project-meta b30">
                  <?php  include(dirname(__FILE__).'/portfolio-details.php'); ?>
            </div>
            
            
            <div class="project-nav">
				<ul>
					<li><?php  previous_post_link( '%link', '<i class="icon-long-arrow-left"></i>' ); ?></li>
					<li><a href="<?php echo st_get_setting('p_list_page','#'); ?>"><i class="icon-th-large"></i></a></li>
					<li><?php next_post_link( '%link', '<i class="icon-long-arrow-right"></i>' ); ?></li>
				</ul>
			</div>
        	
        </div>
        <?php endif; ?>
        <div class="clear"></div>

    
    <?php } ?>
    
    
        
        <?php if (st_get_setting('p_show_relative', 'y')=='y') : ?>
        <div class="twelve columns b0">
            <div class="stpb-portfolio stpb-relative-portfolio portfolio-wrapper t40">
            <?php
            // recent portfolio 
            $term_list = wp_get_post_terms($post->ID, 'portfolio_tag');
            $ids=array();
            $term_start = null;
            foreach($term_list as $i => $term){
                if ($i==0) $term_start = $term;
                $ids[]= $term->term_id;
            }
            
            echo do_shortcode('[portfolio numpost="'.st_get_setting('p_numitem_relative', 3).'" title="'.__('Related Projects','smooththemes').'"  filter_type="custom" exclude="'.$post->ID.'" num_col="'.st_get_setting('p_numcol_relative', 3).'" cats="'.join(',',$ids).'" ]');
            ?>
            </div>
        </div>
        <?php endif; ?>
    </div><!-- END page-content-->
    
