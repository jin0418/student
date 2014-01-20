<footer id="footer" class="footer-outer-wrapper">
	<div class="footer-wrapper container">
		<div class="row">
			<div class="twelve columns p20 b0">
				<div class="copyright left text-left">
					<?php  echo do_shortcode(stripslashes_deep(st_get_setting('footer_left'))); ?>
				</div>
				<div class="social-connect right">
					<div class="widget-container widget_text" id="text-2">
						<?php  echo do_shortcode(stripslashes_deep(st_get_setting('footer_right'))); ?>
						<div class="clear"></div>
					</div>
				</div><!--End right-->
			</div>
			<div class="clear"></div>
		</div><!-- end .row-->
	</div><!-- end .container-->
</footer> <!-- END .footer-outer-wrapper -->
</div><!--END theOne_wrapper-->
<?php wp_footer(); ?>
</body>
</html>