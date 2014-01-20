<?php 
$title  = $tagline ='';
$is_blog_post = false;
global  $post;
if(is_singular()){
    if(is_singular(array('post'))){
	    if(st_get_setting('show_blog_toptitle','y')!='n'){
	            $title  =  stripslashes_deep(st_get_setting('blog_toptitle','') );
	    }
	    if(st_get_setting('show_blog_tagline','y')!='n'){
	            $tagline =  stripslashes_deep(st_get_setting('blog_tagline',''));
	    }
        $is_blog_post =   true;
    }elseif(is_singular(array('portfolio'))){
        $title =  get_the_title();
    }

    if(is_page()){
        $st_page_options  = get_page_builder_options($post->ID);
        if(empty($st_page_options) || (isset($st_page_options['show_title'])  &&  $st_page_options['show_title']==1)){
             $title =  get_the_title();
              
             $tagline = isset($st_page_options['tagline']) ?  ($st_page_options['tagline']) : '';
             
        }else{
            $title= '';
        }

    }
}elseif(is_author()){
    global $authordata;
    the_post();
    $title = ($authordata->display_name!='') ? $authordata->display_name : $authordata->nicename;
    $title = sprintf( __( 'Author Archives: %s', 'smooththemes' ), $title );
}elseif(is_category()){
    $title = sprintf( __( 'Category Archives: %s', 'smooththemes' ) , single_term_title('',false) );
}elseif(is_tag()) {
    $title = sprintf( __( 'Tag Archives: %s', 'smooththemes' ) , single_term_title('',false) );
}elseif(is_tax('portfolio_tag')) {
    $title = sprintf( __( 'Portfolio Tag: %s', 'smooththemes' ) , single_term_title('',false) );
}elseif(is_tax()){
	global $wp_query;
	$value    = $wp_query->query_vars['taxonomy'];
	$tx = get_taxonomy($value);
	$title = sprintf( $tx->labels->name.': %s' , single_term_title('',false) );
}elseif(is_search()){
    $title = sprintf( __('Seach for : %s','smooththemes'), get_search_query() );
}elseif( (is_archive() || is_day() || is_date() || is_month() || is_year() || is_time()) && !is_category() ){
   if ( is_day() ) : 
	  $title =	sprintf( __( 'Daily Archives: %s', 'smooththemes' ), '<span>' . get_the_date() . '</span>' ); 
	 elseif ( is_month() ) : 
		$title =	 sprintf( __( 'Monthly Archives: %s', 'smooththemes' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'smooththemes' ) ) . '</span>' );
	 elseif ( is_year() ) : 
		$title =	 sprintf( __( 'Yearly Archives: %s', 'smooththemes'), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'smooththemes' ) ) . '</span>' ); 
	 else : 
		$title =__( 'Blog Archives', 'smooththemes' );
	endif; 
}elseif(is_404()){
    $title =__('404','smooththemes');
}elseif((is_home() || is_front_page()) && !is_page()){  // default if user do not select static page
    $title  =  stripslashes_deep(st_get_setting('blog_toptitle','') );
    $tagline =  stripslashes_deep(st_get_setting('blog_tagline',''));
}
if($title){
	
	if($tagline!=''){
		$title .='.';
	}
	
?>


<div class="page-title-wrapper text-left">
	<h2 class="page-title<?php echo $tagline =='' ? ' float-none' : ''; ?>"><?php echo  $title; ?></h2>
	
	<?php  if($tagline!=''){ ?>
	<p class="page-title-desc"><?php echo $tagline;  ?></p>
	<?php } ?>
	
	<div class="page-title-shadow"></div>
    <?php if($is_blog_post==true  && st_get_setting('list_posts_url','')!=''){ ?>
    <div id="backto">
        <a title="" href="<?php echo st_get_setting('list_posts_url'); ?>" class="btn"><?php _e('Back to list post','smooththemes'); ?></a>
    </div>
    <?php } ?>

</div>

<?php
}