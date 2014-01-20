<?php 
/**
 * FULL layout no sidebar
 */ 
 

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
					

							<div class="twelve columns b30">
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



