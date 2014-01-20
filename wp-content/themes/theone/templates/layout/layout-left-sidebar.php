<?php 
/**
 * Left sidebar  layout
 */ 
 
 
   if(is_singular()):
        global $post;
          $st_page_builder =  get_page_builder_options($post->ID);
    else :
          $st_page_builder = array();  
    endif;
    
     if(!isset($st_page_builder['left_sidebar']))
        $st_page_builder['left_sidebar'] ='';
?>



<div id="container">
	<section  class="page-area">
		<div class="container">
			<div class="page-wrapper row">
				<div class="twelve columns b0">
					<?php 
	                   /**
	                     * @hooked st_page_title_tempalte();
	                     */ 
	                    do_action('st_top_page_template'); 
	                   ?>
					<div class="content">
						<div class="row">
						
						 	<div class="sidebar-wrapper left-sidebar four columns b30">
								<?php 
                                  do_action('st_sidebar',$st_page_builder['left_sidebar'],'left');
                                ?>
                                <div class="clear"></div>
							</div><!--END right sidebar-->
						
						 
							<div class="eight columns b30">
								<?php
                                     /**
                                     * @hooked st_page_template();
                                     */ 
                                      do_action('st_page_template');
                                 ?>
							</div><!-- END post columns -->

							
							 <div class="clear"></div>
						</div>
						
					</div><!-- END content-->
				</div>
			</div>
		</div><!-- END Container-->
	</section>
	<?php 
	
	/**
	 * @hooked st_end_layout_container();
	 */
	
	do_action('st_end_layout_container');  
	?>
	<div class="clear"></div>
</div>



