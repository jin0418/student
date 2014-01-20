<div class="outer-wrapper r-index-1 columns-1 last-row stpb-portfolio b0">
<?php 
global $wp_query;
$term = $wp_query->queried_object;   
//include(ST_TEMPLATE_DIR.'list-post.php');
echo do_shortcode('[portfolio numpost="-1" title=""  filter_type="custom" num_col="'.st_get_setting('p_numcol_view_all', 3).'" cats="'.$term->term_id.'" custom_filter_text="" custom_filter_url="" ]');
?>
<div class="clear"></div>
</div>