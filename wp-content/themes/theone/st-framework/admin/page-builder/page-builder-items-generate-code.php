<?php

/** ************************************************* ADMIN generate code FUNCTiONS ********************************************************************* */

// for blog post
function stpb_blog_generate($data,$type=''){
    if(empty($data)){
        return '';
    }
    $r = wp_parse_args($data['data'],array(
        'title'=>'',
        'cats' => array(),
        'numpost'=>5,
        'num_col'=>3,
        'exceprt_count'=>70,
        'exclude'=>'',
        'orderby'=>'ID',
        'order'=>'DESC',
        'display_type'=>1,
        'show_title'=>'n',
        'show_paging'=>'n',
        'view_all_text'=>'',
        'link_view_all'=>''
    ));
    
    extract($r);
    
    if(!empty($cats) and is_array($cats)){
        $cats =  ' cats="'.join(',',$cats).'" ';
    }else{
        $cats ='';
    }
    
     $short_code = ' [blog_post c="'.$data['pbwith'].'" show_title ="'.esc_attr($show_title).'"  show_paging="'.esc_attr($show_paging).'" type="'.esc_attr($display_type).'" order="'.esc_attr($order).'"  orderby="'.esc_attr($orderby).'" exclude="'.esc_attr(str_replace(' ','',$exclude)).'" title="'.str_replace('"','&quot;',esc_attr($title)).'" '.$cats.' numpost ="'.$numpost.'" num_col="'.$num_col.'" exceprt_count="'.$exceprt_count.'" view_all_text="'.$view_all_text.'" link_view_all="'.$link_view_all.'"] ';
     $short_code = apply_filters('stpb_blog_generate',$short_code,$data);
     return $short_code;
    
}

// for text items
function  stpb_text_generate($data,$type=''){ 
    
     if(empty($data)){
        return '';
    }
    
    $function = $data['function'];
    $function = explode('_',$function);
    unset($function[0]);
    $function =join('-',$function);
    if($function==''){
        $function ='text';
    }
    
    $function= strtolower($function);
    
    $r = wp_parse_args($data['data'],array(
        'title'=>'',
        'content'=>'',
        'img'=>'',
    	'icon'=>'',
        'url'=>'',
        'autop'=>false,
        'show_more'=>'',
        'img_pos'=>'',
    	'display_mode'=>'',
        'site_layout'=>'',
        'more_text'=>'',
    )); 
    
    extract($r);
    
    if($url!='' && ($show_more==1|| $show_more==true)){
        $more = '<div class="read-more"><a class="more btn small" title="'.esc_attr($title).'" href="'.esc_attr($url).'">'.esc_html($more_text).'</a></div>';
    }else{
        $more='';
    }
    
    
    
    
    $content = balanceTags($content);
    
    if($content !='' &&($autop ==1 || $autop==true )){
        $content = '<div class="content-txt">'.wpautop($content).'</div>';
    }
    
    
    if($function =='text'){
        if($img!=''){
             $img = '<img class="hotel-thumb" src="'.esc_attr($img).'" alt="'.esc_attr($title).'" />';
         }
           switch(strtolower($img_pos)){
               case 'top' :
                     $img = '<span class="img  top">'.$img.'</span>';
                     $content =  $img . $content;
               break;
               case 'right' :
                     $img = '<span class="img  right">'.$img.'</span>';
                     $content =  $img . $content;
               break;
               case 'bottom' :
                     $img = '<span class="img  bottom">'.$img.'</span>';
                     $content =  $content . $img ;
               break;
               
               default: 
                    $img = '<span class="img  left">'.$img.'</span>';
                     $content =  $img . $content;
           }
           
           $content .= '<div class="clear"></div>';
           
           if($title!=''){
                 $title ='
                 <div class="builder-title-wrapper">
                    <h3 class="builder-item-title title">'.esc_html($title).'</h3>
                </div>';
            }
           
            $html  = '<div class="'.$function.'-wrapper builder-item-wrapper builder-editor">'.$title.$content.$more.'</div>';
           
    }else{
        
    	if($icon!=''){
    		$icon ='<a class="icon icon-services '.esc_attr($icon).'" href="'.($url!='' ?  esc_url($url) : '#').'"></a>';
    	}
        
         if($content!=''){
         	
            $content ='<div class="sv-text">'.$content.'</div>';
         }
         
          if($title!=''){
          	if($url!=''){
          		$title =' <h3 class="service-title  builder-title title"><a href="'.esc_url($url).'" >'.esc_html($title).'</a></h3>';
          	}else{
          		$title =' <h3 class="service-title  builder-title title">'.esc_html($title).'</h3>';
          	}
                
          }
            
             
             
          $html  = '<div class="'.$function.'-wrapper service-wrap'.( $display_mode =='ic' ? ' servcices-fp' : '' ).'">
								'.$icon.'
								 <div class="sevices-text">
									'.$title.$content.'
								</div>
					</div>';
          
          
    }
    
   

    return $html;
    
}


function  stpb_divider_generate($data,$type=''){ 
    
     if(empty($data)){
        return '';
    }
    
    $function = $data['function'];
    $function = explode('_',$function);
    unset($function[0]);
    $function =join('-',$function);
    if($function==''){
        $function ='text';
    }
    
    $function= strtolower($function);
    
    $r = wp_parse_args($data['data'],array(
        'title'=>'',
        'space_top'=>0,
        'space_bottom'=>0
    )); 
    
    extract($r);
    
    return '<div class="divider" style="margin:'.$space_top.'px 0px '.$space_bottom.'px 0px"></div>';
    
}


// for tag line
function  stpb_tag_line_generate($data,$type=''){ 
    
     if(empty($data)){
        return '';
    }
    
    $function = $data['function'];
    $function = explode('_',$function);
    unset($function[0]);
    $function =join('-',$function);
    if($function==''){
        $function ='text';
    }
    
    $function= strtolower($function);
    
    $r = wp_parse_args($data['data'],array(
        'tag_line'=>''
    )); 
    
    $tag_line = balanceTags($tag_line);
    
    extract($r);
    
    if ($tag_line) $html = '
        <div class="top-bar-content">
			<div class="stunning-wrapper text-center">
				<h1>'.$tag_line.'</h1>
			</div>
		</div><!-- END .top-bar-content -->
    ';
    else $html = '';

    return $html;
    
}



function  stpb_alert_generate($data,$type=''){
     if(empty($data)){
        return '';
    }
    $r = wp_parse_args($data['data'],array(
        'title'=>'',
        'content'=>'',
        'img'=>'',
        'url'=>'',
        'autop'=>false,
        'alert_type'=>'',
    ));
    
    extract($r);
    
    $title = stripslashes($title);

    $content = balanceTags(stripcslashes($content));

    if($content !='' && ($autop ==1 || $autop==true )){
        
        $content = '<div class="alert-content" >'.wpautop($content).'</div>';
    }elseif($content!=''){
         $content = '<div class="alert-content">'.$content.'</div>';
    }else{
        $content ='';
    }
    
    if($img!=''){
        $img = '<div class="img"><img src="'.esc_attr($img).'" alt="'.esc_attr($title).'" /></div>';
    }

    if($title!=''){
         $title ='
         <div class="builder-title-wrapper">
            <h3 class="builder-item-title title">'.esc_html($title).'</h3>
         </div>
         ';
        
    }else{
        $title= '';
    }
    if($alert_type!=''){
        $alert_type =' alert-'.$alert_type;
    }
    $html  = '<div class="alert'.$alert_type.' builder-item-wrapper"><button type="button" class="close">'.esc_html(__('&#215;','smooththemes')).'</button>'.$title.$img.$content.'<div class="clear"></div></div>';
    return $html;
    
}

function stpb_image_grid_generate($data){
    
    if(empty($data['images'])){
        return '';
    }
    
    $images = $data['images'];
    $meta = $data['meta'];
    $num_col = intval($data['settings']['col']);
    $is_gallery = intval($data['settings']['is_gallery'])==1 ? 1 : 0; 
    
    if($num_col<=0){
        $num_col =4;
    }
    
    if($num_col>6){
        $num_col = 6; // max 6 col
    }
    $title ='';
    if($data['settings']['title']!=''){
         $title .='
         <div class="builder-title-wrapper">
                <h3 class="builder-item-title">'.esc_html(stripslashes($data['settings']['title'])).'</h3>
            </div>';
    }
    $shorcode = '<div class="content-wrapper image_grid col-'.$num_col.'">'.$title.'  %1$s  </div>';
    
    $class=  stpb_number_to_text(round(12*(1/$num_col)));
    $string_shortcode = array();
    
    $rows = array();
    
    $c = 0;
    $i =0;
    $str_cols ='';
    $format = "<div class=\"row builder-item-wrapper\"> \n".'%1$s'."\n</div>";
    
    foreach($images as $n=> $img){
        $col = array();
        $col['img'] = $img;
        $col['meta'] =$meta[$n];
      
      $str_cols = ' <div class="'.$class.' columns b30 "> [st_img img_id="'.esc_attr($col['img']).'" is_gallery="'.$is_gallery.'" title="'.esc_attr($col['meta']['title']).'" url="'.esc_attr($col['meta']['url']).'" ] caption="'.esc_attr($col['meta']['caption']).'" [/st_img] </div>';
    
      $rows[$c][] =  $str_cols ;
      if($i>=$num_col-1){
        $c++;
        $i=0;
      }else{
         $i++;
      }        
    }
    
    $item=array();
    foreach($rows  as  $cols){
        // $item[] =  sprintf($format,join("\n",$cols));
         $item[] =   sprintf($format,join("\n",$cols).'<div class="clear"></div>');
    }
    
    $shorcode = sprintf($shorcode,join("\n",$item).'').'<div class="clear"></div>';
    
    return  $shorcode;
   // extract($r);  
}


function stpb_widget_generate($data){
    
    if(empty($data)){
        return '';
    }
    
    $title ='';
    if($data['data']['title']!=''){
         $title .='<div class="builder-title-wrapper">
                <h3 class="builder-item-title">'.esc_html($data['data']['title']).'</h3>
                </div>';
    }
    
    return '<div class="content-wrapper widget col-'.$num_col.' builder-item-wrapper">'.$title.'  [st_widget id="'.esc_attr($data['data']['widget']).'"]  </div>';
   
}


function stpb_slider_generate($data){
    
    if(empty($data['images'])){
        return '';
    }

    $page_builder_data['slider_items']['images'] = $data['images'];
    $page_builder_data['slider_items']['meta'] = $data['meta'];
    $page_builder_data['show_slider'] = 1;
    if(empty($data['slider_type'])){
        $data['slider_type'] ='flexslider';
    }

    $page_builder_data['slider_type'] = $data['slider_type'];
    
   $page_builder_data = array_merge($data,$page_builder_data);
    
    $html = '<div class="blog-thumb-wrapper silder-wrap builder-item-wrapper">'.st_get_content_from_func('st_the_slider',$page_builder_data).'</div>';
    return  $html;
}


function stpb_portfolio_generate($data,$type=''){
    if(empty($data)){
        return '';
    }
    
     $short_code = ' [portfolio '.st_shortcode_attr($data['data']).'] ';
     $short_code = apply_filters('stpb_portfolio_generate',$short_code,$data);
      
     return $short_code;
}


function stpb_this_slider_generate($data){
    global $post;
    $image_size = (isset($settings['image_size']) && $settings['image_size'] !='' ) ? $settings['image_size']  : 'st_large';
    $thumb_html = st_post_thumbnail($post->ID, $image_size);
    return $thumb_html;
}


/**
 * return  item html code
 */ 
function  stpb_ui_item_generate($data=array(),$tag ='li',$class='',$chil_class_prefix='item',$icon='', $item_id='',$is_tab = false){
    $data = wp_parse_args($data,array(
            'title'=>'',
            'content'=>'',
            'img'=>'',
            'url'=>'',
            'autop'=>false,
            'show_more'=>'',
            'item_type'=>'',
            'more_text'=>__('Read more','smooththemes')
        ));
        
        extract($data);
        $html ='';
        
        if($url!='' && ($show_more==1|| $show_more==true)){
            $more = '<div class="read-more"><a class="more" title="'.esc_attr($title).'" href="'.esc_attr($url).'">'.esc_html($more_text).'</a></div>';
        }else{
            $more='';
        }
        
         $content = balanceTags($content);
        if($content !='' &&($autop ==1 || $autop==true )){
            $content = '<div class="txt-content" >'.wpautop($content).'</div>';
        }elseif($content!=''){
             $content = '<div class="txt-content">'.$content.'</div>';
        }else{
            $content ='';
        }
        
        if($img!=''){
            $img = '<div class="img"><img src="'.esc_attr($img).'" alt="'.esc_attr($title).'" /></div>';
        }

       if($title!='' and !$is_tab){
          if($icon){
            $icon = '-'.$icon;
          }
          
          if($item_type=='toggle'){
                $icon_btn  = '<i class="ui-icon icon-plus"></i><i class="ui-icon icon'.$icon.'"></i>';
          }else{
              $icon_btn  = '<i class="ui-icon icon'.$icon.'"></i>';
          }
          
           
            $title =' <h3 class="'.esc_attr($chil_class_prefix).'-title">'.esc_html($title).$icon_btn.'</h3>';
            
        }else{
            $title= '';
        }
        
        if($class!=''){
            $class = ' class="'.esc_attr($class).'"';
        }
        
        if($item_id!=''){
            $item_id = '  id= "'.esc_attr($item_id).'" ';
        }
        
        if($is_tab){
            $html .= '<'.$tag.$item_id.$class.'>'.$img.$content.$more.'</'.$tag.'>'."\n";
        
        }else{
            $html .= '<'.$tag.$item_id.$class.'>'.$title.'<div class="'.esc_html($chil_class_prefix).'-content">'.$img.$content.$more.'</div></'.$tag.'>'."\n";
        
        }
        
        
        return $html;
}


function  stpb_accordion_generate($data){
    $actitle = '';
    if($data['settings']['title']!=''){
        $actitle = '
            <div class="builder-title-wrapper">
                <h3 class="builder-item-title title">'.esc_html($data['settings']['title']).'</h3>
            </div>';
    }
    $html ='';
    if($data['ui_data'])
    foreach($data['ui_data'] as $k => $d){
        $html .=stpb_ui_item_generate($d,'li','accordion-item','acc','chevron-down');
    }
    
    $html = '<div class="accordion-wrap builder-item-wrapper">
            '.$actitle.'
            <ul class="st-accordion">
                '.$html.'
            </ul>
        </div>';
    return $html;
}


function  stpb_toggle_generate($data){
    $actitle = '';
    if($data['settings']['title']!=''){
         $actitle = '
            <div class="builder-title-wrapper">
                <h3 class="builder-item-title title">'.esc_html($data['settings']['title']).'</h3>
            </div>';
    }
    $html ='';
     if($data['ui_data'])
    foreach($data['ui_data'] as $k => $d){
        $d['item_type'] ='toggle';
        $html .=stpb_ui_item_generate($d,'li','toggle-item','toggle','minus');
    }
    
    $html = '<div class="toggle-wrap builder-item-wrapper">
            '.$actitle.'
            <ul class="st-toggle">
                '.$html.'
            </ul>
        </div>';
    return $html;
}


function  stpb_tabs_generate($data){
    $mtitle = '';
    if($data['settings']['title']!=''){
        $mtitle = '<div class="builder-title-wrapper title">
            <h3 class="builder-item-title">'.esc_html($data['settings']['title']).'</h3>
        </div>';
    }
    $content  ='';
    $tab_titles = '';
    $i = 0;
    $id = 'tab-'.uniqid();
    if($data['ui_data'])
    foreach($data['ui_data'] as $k => $d){

        $tab_titles.='<li'.$class.' tab-id="'.$id.$k.'"><span>'.esc_html($d['title']).'</span></li>'."\n";
        $content .=stpb_ui_item_generate($d,'div','tab-content','','',$id.$k,true);
        $i++;
    }
    
    $html = '<div class="tabs-wrap builder-item-wrapper">
            '.$mtitle.'
            <div class="st-tabs b0">
                    <ul class="tab-title">
                        '.$tab_titles.'
                    </ul>
                    <div class="tab-content-wrapper">
                        '.$content.'
                    </div>
                </div>
        </div>';
    return $html;
}


function  stpb_post_slider_generate($data){
    if(empty($data)){
        return '';
    }
    //st_slider()
    $html ='';
    if(trim($data['data']['title'])!=''){
        $html .= '
        <div class="builder-title-wrapper title">
            <h3 class="builder-item-title">'.esc_html($data['data']['title']).'</h3>
        </div>
        ';
    }
    

    $data['data']['pbwith'] = isset($data['pbwith']) ? $data['pbwith'] :  null;
    $data['data']['site_layout'] = isset($data['site_layout']) ? $data['site_layout'] :  null;
   
     $html .='[st_slider '.st_shortcode_attr($data['data']).']';
   // wp_reset_query();
    return '<div class="builder-item-wrapper">'.$html.'</div>';

}


function stpb_this_entry_generate($data,$type=''){
    return '<div class="builder-editor text-wrapper builder-item-wrapper"> [this_entry] </div>';
}


function stpb_teammember_generate($data) {
    $html = $num_col = $class_name = $name = $img = $position = $description = '';
    $num_col  = (isset($data['num_col'])  && intval($data['num_col'])>0) ? intval($data['num_col']) : 4 ;
    $class_name=stpb_number_to_text(12/$num_col);

    if ($data['data']['name']) {
        $name = '<h3 class="name">'.esc_html($data['data']['name']).'</h3>';
    }
    if ($data['data']['img']) {
        $img = '<img src="'.esc_html($data['data']['img']).'" alt="">';
    }
    if ($data['data']['position']) {
        $position = '<div class="position">'.esc_html($data['data']['position']).'</div>';
    }
    if ($data['data']['description']) {
        $description = '<p class="desc">'.esc_html($data['data']['description']).'</p>';
    }
    
    $html .= '<div class="ourteam-page">
        <div class="member-info">'.$img.$name.$position.'</div>
        <div class="member-desc">'.$description.'</div>
    </div>';

    return $html;
}


function stpb_clients_generate($data,$type=''){
    $actitle = '';
    if($data['settings']['title']!=''){
        $split = ($data['settings']['tag_line']!='') ? '<span class="div-middle"> / </span>' : '';
        $actitle = '
        <div class="clients-heading-wrapper">
            <h3 class="clients-heading title">'.esc_html($data['settings']['title']).$split.'</h3>
         </div>
        ';
    }
    
    $target ='';
    
    if($data['settings']['target']!=''){
        if($data['settings']['target']=='_self' || $data['settings']['target'] =='_blank'){
            $target = ' target="'.$data['settings']['target'].'" ';
        }
    }
    
    $html ='';
    $items = '';
    
    $num_col  = (isset($data['settings']['num_col'])  && intval($data['settings']['num_col'])>0) ? intval($data['settings']['num_col']) : 4 ;
    
    $class_name=stpb_number_to_text(12/$num_col);
    
    $i =1;
    if($data['ui_data'])
    foreach($data['ui_data'] as $k => $d){
        
        $item = '';
        if($d['img']!=''){
           $item = '<img src="'.esc_url($d['img']).'" alt="'.esc_attr($d['title']).'"/>'; 
        }
        
        if($d['url']!=''){
            $item=' <a href="'.esc_url($d['url']).'" '.$target.' title="'.esc_attr($d['title']).'">'.$item.'</a>';
        }
        if($item!=''){
            $items .='<div class="'.$class_name.' client-item two columns'.( ($i==1) ? ' start' : ($i==$num_col ? ' end' :'') ).'">'.$item.'</div>';
        }
        
        if($i==$num_col){
            $items.='<div class="clear"></div>';
            $i=1;
        }else{
            $i++;
        }
        
        
    }
    
    $id =  uniqid();
    $html = '<div class="clients-wrapper">
            '.$actitle.'
            <div class="st-clients clients-items twelve row" id="caro-'.$id.'">
                <div class="clients-items-inner">
                    '.$items.'
                    <div class="clear"></div>
                </div>
            </div>
        </div>';
    return $html;
}


function stpb_testimonials_generate($data,$type=''){
    
   //  echo var_dump($data); die();
    $actitle = '';
    if($data['settings']['title']!=''){
        $actitle = '<div class="builder-title-wrapper ">
            <h3 class="builder-item-title">'.esc_html($data['settings']['title']).'</h3>
        </div>';
    }
    
    $html ='';
    $items = '';
    if(is_array($data['ui_data']))
    foreach($data['ui_data'] as $k => $d){
        //$html .=stpb_ui_item_generate($d,'li','toggle-item','toggle','minus');
       $author = $img = $avatar  =  $postion = $title = '';
        if($d['img']!=''){ // now is avatar
           $img = '<img src="'.esc_url($d['img']).'" class="t-avt" alt="'.esc_attr($d['title']).'"  title ="'.esc_attr($d['title']).'"/>'; 
        }
        
        if ($img) {
            $avatar = '<span class="t-avt">'.$img.'</span>';
        }

        $author ='
        <div class="t-a-m">
            <div class="t-a-name">'.esc_html($d['title']).', </div>
            <div class="t-a-positon">'.esc_html($d['url']).'</div>
            <div class="clear"></div>
        </div>';
        
        $content = $d['content'];
     
         
      if($content!=''){
             $content = '<div class="test-c">'.esc_html($content).'</div>';
        }else{
            $content ='';
        }
        
        $content ='<div class="test-c-w"><div class="test-c">'.$content.'</div><div class="arr"></div></div>';
        
        $items .='<div class="carou-item "><div class="testi-w">'.$avatar.$content.$author.'</div></div>';
        
    }
    
    
    $id =  uniqid();
    
    $html = '<div class="testimonials-wrapper">
                <div class="testimonials-wrapper-inner">
                    '.$actitle.'
                    <div class="st-testimonials carou" id="test-'.$id.'">
                        '.$items.'
                    </div>
                </div>
                <div class="pagination" id="paging-testimonial"></div>
            </div>
            <div class="clear"></div>';
    return $html;
}

function stpb_table_price_generate($data,$type=''){
	
	$data_settings =  wp_parse_args($data['data'],array(
							'title'=>'',
							'price'=>'',
							'price_detail'=>'',
							'button_label'=>'',
							'button_link'=>'',
							'link_target'=>'',
							'is_active'=>''
							
						));
	
	if($data_settings['button_label']==''){
		 $data_settings['button_label'] = __('More details <i class="icon-plus"></i></a>','smooththemes');
	}
	
	$title = $list =  $btn = '';;
	if($data_settings['title']!=''){
		$title .= '<figcaption>'.esc_html($data_settings['title']).'</figcaption>';
	}
	
	if($data_settings['price']!=''){
		$title .= '<div class="price text-center">'.esc_html($data_settings['price']).'';
		
		$title .='<span>/'.$data_settings['price_detail'].'</span>';
		
		$title .='</div>';
	}
	
	if($title!=''){
		$title = '<figure>'.$title.'</figure>';
	}
	
	
	if(isset($data['ui_data']) && is_array($data['ui_data'])){
		foreach($data['ui_data'] as $item){
			$list .='<li>'.esc_html($item['title']).'</li>';
		}
	}
	
	if($list!=''){
		$list = '<ul class="desc-feature">'.$list.'</ul>';
	}
	
	
	if($data_settings['button_label']!=''  || $data_settings['button_link']!='' ){
		 $data_settings['button_label'] = balanceTags($data_settings['button_label']);
		$btn = '<footer><a href="'.$data_settings['button_link'].'" target="'.$data_settings['link_target'].'" class="pricing-button btn">'.$data_settings['button_label'].'</a></footer>';
	}
	
	 

	return '<div class="pricetable">
				<div class="plan '.($data_settings['is_active']=='y' ? ' plan-active' : '' ).'">
					'.$title.$list.$btn.'
				</div>
			</div>';
	
	
}

