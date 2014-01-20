<?php
/** ******************** Shorcode for page builder******************************** */

function st_blog_post_func( $atts, $content='' ) {
    global $wp_query;
    global $post, $paged;
    $tmp_post = $post;

	extract( shortcode_atts( array(
		'title' => '',
		'cats' =>'',
        'numpost'=>6,
        'num_col'=>2,
       // 'excerpt_count'=>70,
        'exclude'=>'',
        'orderby'=>'ID',
        'order'=>'DESC',
        'pbwith'=>'1_1',
        'type'=>1,
        'site_layout'=>'',
        'show_title'=>'n',
        'show_paging'=>'n',
        'view_all_text'=>'',
        'link_view_all'=>''
	), $atts ) );
    
	$num_col =2;
	
        $html ='';
        $cat_link =$cat_title='';

        $list_cate = $cats;
        $cats =  (is_array($cats)) ? $cats[0]  : intval($cats);

        if($cats>0){
            $cat_link = get_category_link($cats);
            $cat_title = get_cat_name($cats);
        }else{
            // do some thing
        }

        if( $title!=''){
             //   $html .='<h1 class="st-category-heading blog-post">'.esc_html($title).'</h1>';
            $html ='
			<div class="portfolio-heading-wrapper">
				<h3 class="portfolio-heading">'.esc_html($title).'</h3>
			</div>';
          
        }
        
        if(intval($numpost)<=0){
            $numpost = (int) get_option('posts_per_page',10);
        }else{
            $numpost = intval($numpost);
        }
        
        $args = array( 'posts_per_page' => $numpost );
        if($list_cate!=''){
            // $args['category__in'] =  array($cats);
            $args['category__in'] =  explode(',', $list_cate);

        }
        
        if($exclude!=''){
            $exclude= explode(',',$exclude);
        }
        $args['post__not_in'] = $exclude;
        $args['orderby'] = $orderby;
        $args['order'] = $order;
        if($paged>0){
             $args['paged'] =  $paged;
        }else{
                 $paged = isset($_REQUEST['paged']) ? intval($_REQUEST['paged']) : 1;
        }
        
        // added in ver 1.3
        if(st_is_wpml()){
          $args['sippress_filters'] = true;
          $args['language'] = get_bloginfo('language');
         }

         $new_query = new WP_Query($args);
         $myposts =  $new_query->posts;
        
        $e = '';
        $c =0;
        
        $image_size ='st_blog_thumb';
      

        // display as list
       // $func =  st_excerpt_length( $excerpt_count );
        $col_txt = stpb_number_to_text(12/$num_col);
        $i = 1;
        foreach( $myposts as $d => $post ) : setup_postdata($post);  
         //$class=get_post_class();
        
             $e.='<div class="'.$col_txt.' columns b30">'.st_get_content(ST_TEMPLATE_DIR.'loop/loop-post.php',$post,array('display_type'=>$type,'i'=>$i,'image_size'=>$image_size)).'</div>';
             if($i>$num_col){
                $e.='<div class="clear"></div>';
                $i=1;
             }else{
                 $i++;
             }
         
        $i++;
        endforeach;
       // remove_filter('excerpt_length', $func);
        
        $html .='<div class="loop-posts"><div class="row">'.$e.' <div class="clear"></div></div></div>';
        $p ='';
        
        if($view_all_text!=''  && $link_view_all!=''){
        	$p ='<div class="blog-more text-center"> <a class="browse-all btn" href="'.esc_html($link_view_all).'">'.esc_html($view_all_text).' <i class="icon-angle-right"></i></a></div>';
        }elseif(!is_home() && !is_front_page()) { // only true if not is home page or front page
               if($show_paging=='y'){
                 $p =  st_post_pagination($new_query->max_num_pages,2, false);
                  if($p!=''){
                      $p = '<div class="pagination text-center t0">'.$p.'</div>';
                  }
               }
       }

       wp_reset_postdata();
  return '<div class="blog-wrap builder-item-wrapper">'.do_shortcode($html).$p.'</div>';
}

add_shortcode( 'blog_post', 'st_blog_post_func' );


function st_img_func( $atts, $caption='' ) {
    
	extract( shortcode_atts( array(
		'img_id' => 0,
		'title' => '',
        'url'=>'',
        'caption'=>'',
        'is_gallery'=>0
	), $atts ) );
    
    extract($atts);
    
    $attachment=wp_get_attachment_image_src($img_id, 'st_medium_thumb');
    
    $html_format ='<div class="gird-box"> %1$s </div>';
    $img = '<img src="'.$attachment[0].'" alt="'.esc_attr($title).'">';
    
    $a_rel= $add_item= '';
    if($is_gallery==1){
        $image_full = wp_get_attachment_image_src($img_id, 'full');
        $url = $image_full[0];
        $a_rel =' rel="prettyPhoto" ';
        $add_item ='
                <span class="portfolio-thumb-hover"></span>
                <span class="hover-lightbox-image"></span>
            ';
    }
    if($url!=''){
            $a = '<a '.$a_rel.' href="'.esc_attr($url).'" title="'.esc_attr($title).'"> '.$add_item.'</a> ';
    }else{
        $a ='   ';
    }
    
     $img = $a.$img;
    
    $img = '<div class="portfolio-media-wrapper">'.$img.'</div>';
    
    if($title!=''){
         $title ='<div class="portfolio-desc"><h4 class="im-title">
                 <a '.$a_rel.' href="'.esc_attr($url).'" title="'.esc_attr($title).'">'.esc_html($title).'</a> 
                 </h4>
             </div>';
    }
    
    if($caption!=''){
        
    }
    
    return  sprintf($html_format, $img.$title .$caption);
 }

add_shortcode( 'st_img', 'st_img_func' );


function st_widget_func( $atts, $caption='' ){
    
	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );
    
    if($id==''){
        return '';
    }
    return st_get_content_from_func('dynamic_sidebar',$id);
    
}

add_shortcode( 'st_widget', 'st_widget_func' );

/** ======================================== EDITOR SHORTCODE =============================================== */
function st_heading_shortcode($number,$atts,$content=''){
    	extract( shortcode_atts( array(
        'class'=>''
	), $atts ) );
    if($class==''){
        $class ='st-h1';
    }else{
        $class  ='st-h1 '.$class;
    }
    return  '<h'.$number.' class="'.esc_attr($class).'">'.$content.'</h'.$number.'>';
}
function st_h1_func($atts, $content='' ){
    return st_heading_shortcode(1,$atts,$content);
}
add_shortcode( 'h1', 'st_h1_func' );
///===
function st_h2_func($atts, $content='' ){
	return st_heading_shortcode(2,$atts,$content);
}
add_shortcode( 'h2', 'st_h2_func' );
///===
function st_h3_func($atts, $content='' ){
	return st_heading_shortcode(3,$atts,$content);
}
add_shortcode( 'h3', 'st_h3_func' );

///===
function st_h4_func($atts, $content='' ){
	return st_heading_shortcode(4,$atts,$content);
}
add_shortcode( 'h4', 'st_h4_func' );

///===
function st_h5_func($atts, $content='' ){
	return st_heading_shortcode(5,$atts,$content);
}
add_shortcode( 'h5', 'st_h5_func' );

///===
function st_h6_func($atts, $content='' ){
	return st_heading_shortcode(6,$atts,$content);
}
add_shortcode( 'h6', 'st_h6_func' );

// buttons
function st_button_func( $atts, $content='' ){
    
	extract( shortcode_atts( array(
		'type' => '',
        'color'=>'',
        'link'=>'',
        'icon'=>'',
        'target'=>'',
        'rounded'=>0,
	), $atts ) );
    
    $class= array();
    
    if($type){
        $class[] = $type;
    }
    
     if($color!=''){
        $class[]='btn_'.$color;
    }else{
        $class[] ='color';
    }
    
    if(intval($rounded)>0){
        $class[] = 'rounded';
    }
   
   if($icon!=''){
       $icon ='<i class="'.esc_attr($icon).'"></i>' ;
   }
   
   if($target!=''){
        $target = ' target="'.$target.'" ';
   }
    
   if(trim($link)==''){
        return '<button class="btn '.esc_attr(join(' ',$class)).'">'.$icon.esc_html($content).'</button>';
   }else{
        return '<a class="btn '.esc_attr(join(' ',$class)).'" '.$target.' href="'.$link.'">'.$icon.esc_html($content).'</a>';
   }
    
}

add_shortcode( 'button', 'st_button_func' );

// for columns and rows
function st_row( $atts, $content='' ){
    extract( shortcode_atts( array(
		'class' => '',
        'id'=>'',
	), $atts ) );
    $attr ='';
    
    if($id!=''){
        $attr.' id="'.esc_attr($id).'" ';
    }
    if($class!=''){
        $class .='row '.$class;
    }else{
        $class ='row';
    }
    
    $attr.=' class="'.esc_attr($class).'"';
    
    return  '<div class="row-wrapper"><div '.$attr.'>'.do_shortcode(trim($content)).'<div class="clear"></div></div></div>';
    
}
add_shortcode( 'row', 'st_row' );


// for columns and rows
function st_col( $atts, $content='' ){
    extract( shortcode_atts( array(
		'class' => '',
        'id'=>'',
        'width'=>''
	), $atts ) );
    $attr ='';
    
    if($id!=''){
        $attr.' id="'.esc_attr($id).'" ';
    }
    if($class!=''){
        $class .='columns  b10 '.$class;
    }else{
        $class ='columns  b10';
    }
    if($width!=''){
        $class =$width.' '.$class;
    }else{
         $class =$width.' twelve';
    }
    
    $attr.=' class="'.esc_attr($class).'"';
    
    return  '<div '.$attr.'>'.do_shortcode(trim($content)).'</div>';
    
}
add_shortcode( 'col', 'st_col' );
// other shortcode
function st_clear_func($atts, $content='' ){
	return '<div class="clear"></div>';
}
add_shortcode( 'clear', 'st_clear_func' );

function st_divider_func($atts, $content='' ){
	return '<div class="row"><div class="twelve columns"><div class="divider"></div></div></div>';
}
add_shortcode( 'divider', 'st_divider_func' );


function st_space_func($atts, $content='' ){
    
    if(isset($atts['height'])  && intval($atts['height'])>0){
        $style = ' style="height: '.intval($atts['height']).'px; display: block;" ';
    }else{
        $style ='';
    }
	return '<div '.$style.' class="space"></div>';
}
add_shortcode( 'space', 'st_space_func' );


// for video 
function st_video_func($atts, $content='' ){
    $link = $atts['link'];
    if($link==''){
        return '';
    }else{
        return st_get_video($link).'<div class="video-shadow"></div>';
    }
   
}
add_shortcode( 'video', 'st_video_func' );


// for  Accordion
function st_accordion_func($atts, $content=''){
    $class= (isset($atts['class'])) ?  $atts['class'] : '';
    if($class==''){
        $class = 'st-accordion';
    }else{
        $class ='st-accordion '.$class;
    }
    return  '<ul class="'.esc_attr($class).'">'.do_shortcode($content).'</ul>';
    
}

function st_accordion_item_func($atts, $content=''){
    
   	extract( shortcode_atts( array(
		'title' => '',
        'class'=>''
	), $atts ) );
    
    $title ='<h3 class="acc-title">'.esc_html($title).'<i class="icon-angle-down"></i></h3>';
    
    return  '<li class="'.esc_attr($class).'">'.$title.'
    <div class="acc-content" style="display: none;"><div class="txt-content">'.do_shortcode($content).'</div></div>
    </li>';
    
}
add_shortcode( 'accordion', 'st_accordion_func' );
add_shortcode( 'accordion_item', 'st_accordion_item_func' );

// for  Toggle
function st_toggle_func($atts, $content=''){
    $class= (isset($atts['class'])) ?  $atts['class'] : '';
    if($class==''){
        $class = 'st-toggle';
    }else{
        $class ='st-toggle '.$class;
    }
    return  '<ul class="'.esc_attr($class).'">'.do_shortcode($content).'</ul>';
    
}

function st_toggle_item_func($atts, $content=''){
    
   	extract( shortcode_atts( array(
		'title' => '',
        'class'=>''
	), $atts ) );
    
    $title ='<h3 class="toggle-title sc-title">'.esc_html($title).'<i class="icon-plus"></i><i class="icon-minus"></i></h3>';
    
    return  '<li class="'.esc_attr($class).'">'.$title.'
    <div class="toggle-content" style="display: none;"><div class="txt-content">'.do_shortcode($content).'</div></div>
    </li>';

}


add_shortcode( 'toggle', 'st_toggle_func' );
add_shortcode( 'toggle_item', 'st_toggle_item_func' );

// for tabs

function st_do_shortcode($content, $autop = FALSE) 
{ 

	$content = do_shortcode( $content ); 
	
	if ( $autop ) {
		$content = wpautop($content);
	}
	
	return $content;
}


function st_tabs_func($atts, $content = null)
{	
	extract(shortcode_atts(array(
		'position' => ''
	), $atts));
	
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	}
	else
	{
		for ($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		
		$tabs_post = ( $position == 'left' ) ? 'tabs-left' : '';
		
		$out = '<div class="st-tabs '. $tabs_post .'">';
		
		$out.= '<ul class="tab-title">';
		for ($i = 0; $i < count($matches[0]); $i++) {
		    if ($i==0)  
	            $out.= '<li class="current" tab-id="tab-'. $i .'"><span>'. $matches[3][$i]['title'] .'</a></li>';
            else 
                $out.= '<li tab-id="tab-'. $i .'"><span>'. $matches[3][$i]['title'] .'</a></li>';
		}
		$out.= '</ul>';
		
		$out.= '<div class="tab-content-wrapper">';
		for ($i = 0; $i < count($matches[0]); $i++) {
            if ($i==0)
                $out.= '<div tab-id="tab-'. $i .'" class="tab-content active"><div class="txt-content">'. st_do_shortcode(trim($matches[5][$i]), TRUE) .'</div></div>';
            else 
                $out.= '<div tab-id="tab-'. $i .'" class="tab-content"><div class="txt-content">'. st_do_shortcode(trim($matches[5][$i]), TRUE) .'</div></div>';
		}
		$out.= '</div>';
		
		$out.= '</div>';
		
		return $out;
	}
}
add_shortcode('tabs', 'st_tabs_func');




function st_portfolio_func( $atts, $content='' ) {
    global $wp_query;
    global $post;
    $tmp_post = $post;
    extract(shortcode_atts(array(
        'title' => '',
        'cats' => '',
        'numpost' => '-1',
        'exclude' => '',
        'orderby' => 'ID',
        'order' => 'DESC',
        'pbwith' => '1_1',
        'image_size' => '',
        'num_col' => 3,
        'site_layout' => '',
        'show_heading' => 'y',
        'filter_type' => 'default',
        'custom_filter_text' => '',
        'custom_filter_url' => '',
        'row_index' => 9 // not begin
    ), $atts));

    $wc = $pbwith;
    $w = explode('_', $wc);
    $t = intval($w[0]);
    $m = intval($w[1]);

    if ($m > 0 and $t > 0) {
        $c = $t / $m;
    } else {
        $c = 1;
    }

    $html = $heading = $htitle = '';
    if ($show_heading != 'n') {
        if ($title != '') {
            $f_class = '';
            $htitle = esc_html($title);
        } else {
            $f_class = " hide-heading ";
        }

        $filter = '';
        $is_filter = false;

        if ($filter_type == 'default') {
            $terms = get_terms('portfolio_tag', array('include' => $cats, 'fields' => 'all'));
            $filter = '<ul data-option-key="filter" class="cpt-filters' . $f_class . '">	
                        <li><a class="selected" href="#filter=*">' . __('All', 'smooththemes') . '</a></li>';
            foreach ($terms as $term) {
                $filter .= '<li></li><li><a  href="#filter=.' . esc_attr($term->slug) . '">' . esc_html(stripslashes($term->name)) . '</a></li>';
            }

            $filter .= '</ul>';

            $is_filter = true;
        } else {
            if ($custom_filter_text != '') {
                if (trim($custom_filter_url) == '') {
                    $custom_filter_url = '#';
                }
                $filter = '<a class="view-all" href="' . esc_attr($custom_filter_url) . '">' . esc_html($custom_filter_text) . '</a>';
            }
        }

        $htitle = ($htitle != '') ? '<h3 class="builder-item-title portfolio-heading">' . $htitle . '</h3>' : '';


        $heading = '<div class="builder-title-wrapper portfolio-heading-wrapper' . (($is_filter && $row_index == 1) ? '  has_filter' : '  no_filter') . '">
                        ' . ($htitle) . '
                            ' . $filter . '
                        <div class="clear"></div>
                    </div>';

    } // end show heading


    if (intval($numpost) > 0) {
        $numpost = intval($numpost);
    } else {
        $numpost = -1; // get all portfolio
    }

    $args = array('posts_per_page' => $numpost);
    if ($exclude != '') {
        $exclude = explode(',', $exclude);
    }

    $args['post__not_in'] = $exclude;
    $args['orderby'] = $orderby;
    $args['order'] = $order;
    $args['post_type'] = 'portfolio';

    if (!empty($cats)) {
        $args['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'portfolio_tag',
                'field' => 'id',
                'terms' => explode(',', $cats),
                'operator' => 'IN'
            )
        );
    }

    if (st_is_wpml()) {
        $args['sippress_filters'] = true;
        $args['language'] = get_bloginfo('language');
    }

    //  echo var_dump($wp_query);
    $new_query = new WP_Query($args);

    //$myposts =  $wp_query->query($args);
    $myposts = $new_query->posts;

    $num_col = intval($num_col) > 0 ? intval($num_col) : 4;

    $e = '';
    $c = 0;
    $i = 1;

    if ($image_size == '') {
        $image_size = 'st_p_medium_h';
    }

    // echo $num_col;
    $col_txt = stpb_number_to_text(12 / $num_col);
    foreach ($myposts as $post) : setup_postdata($post);
        $st_page_options = get_page_builder_options(@$post->ID);
        $term_list = wp_get_post_terms($post->ID, 'portfolio_tag', array("fields" => "all"));
        $filter_class = array();
        $caption = array();
        foreach ($term_list as $term) {
            $filter_class[] = $term->slug;
            $caption[] = $term->name;
        }

        $ptitle = the_title_attribute('echo=0');
        $title = sprintf(esc_attr__('Permalink to %s', 'smooththemes'), $ptitle);
        $link = get_permalink($post->ID);

        /*
        $caption  = (!empty($caption)) ? join(esc_html(' / '),$caption) : '&nbsp;&nbsp;';
        $caption =   '<div class="cpt-desc"><span class="border-underline"></span>'.$caption.'</div>';
        */

        $html .= '<div class="cpt-item item-isotope isotope-item ' .$image_size.' '. $col_txt . ' columns b30 ' . esc_attr(join(' ', $filter_class)) . ' ' . strtolower($st_page_options['thumbnail_type']) . '">
                        <div class="thumb-wrapper">
                            <a  title="' . get_the_title($post->ID) . '" href="' . $link . '">
                                ' . st_portfolio_thumbnail_one($post->ID, $image_size) . '
                            </a>

                            <div class="thumb-hover-outer">
                                <span class="portfolio-thumb-hover"></span>
                                <div class="portfolio-detail">
                                    <h2 class="portfolio-title  title"><a href="' . $link . '">' . get_the_title($post->ID) . '</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>';

        if ($i >= $num_col) {
            $html .= '<div class="clear"></div>';
            $i = 1;
        } else {
            $i++;
        }

    endforeach;

    wp_reset_query();

    return '<div class="builder-item-wrapper builder-portfolio">
                ' . $heading . '
                <div class="builder-item-content row' . ($is_filter ? ' has-isotope' : ' no-isotope') . '">
                    <div class="twelve columns b0">
                        <div class="cpt-items row isotope">
                        ' . do_shortcode($html) . '
                        </div>
                    </div>
                </div>
              
            </div>';
}
add_shortcode('portfolio', 'st_portfolio_func');



// for entry content
function st_this_entry_func($atts, $content='' ){
     global $post;
      return apply_filters('the_content',$post->post_content);
}
add_shortcode( 'this_entry', 'st_this_entry_func' );

function  st_shorcode_alert_func($atts,$content =''){
    extract(shortcode_atts(array(
		'alert_type' => ''
	), $atts));
    
    if($alert_type!=''){
        $alert_type =' alert-'.$alert_type;
    }
    $html  = '<div class="alert'.$alert_type.'"><button type="button" class="close">'.esc_html(__('&#215;','smooththemes')).'</button>'.do_shortcode($content).'<div class="clear"></div></div>';
    return $html;
    
}

add_shortcode('alert', 'st_shorcode_alert_func');


function st_block_quote_func($atts, $content='' ){
	return '<div class="st-blockquote">
            <i class="icon-quote-left icon-4x pull-left icon-muted"></i> '.$content.'
                </div>';
}
add_shortcode( 'block_quote', 'st_block_quote_func' );



