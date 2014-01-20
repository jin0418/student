<?php

function st_builder_meta_items($name='', $values = array() , $post = false){
  
     $builder_items = get_page_builder_items();
    
        $builder_save = $values['builder'];
        
        if(empty($builder_save) || !is_array($builder_save)){
            $builder_save = array();
        }
        
        $builder_name =$name.'[builder]';
        
        $pd_item_width = array(
                             '1_1'=>0,     '3_4'=>1,
                             '2_3'=>2,   '1_2'=>3,
                             '1_3'=>4,   '1_4'=>5,
                             
                 );
    
       ?>

       <?php  
       // do not show page builder items  beacase it can not run in shop pages
       if(strtolower($post->post_type) =='page'): 
       ?>
       
       <div class="stbuilder">
             <input type="hidden"  class="builder_pre_name" value="<?php echo $builder_name; ?>" />
            <div class="stbuilder-items">
                <h4 class="sttitle"><?php _e('Add Items','smooththemes'); ?></h4>
                <p class="stdesc" ><?php _e('Click "add" to add item to Canvas','smooththemes'); ?></p>
                <div class="notifications">
                    <span class="n success"><?php _e("Item Added",'smooththemes') ;?></span>
                    <span class="n warning"><?php _e("Item removed",'smooththemes') ;?></span>
                </div>
                <div class="clear"></div>
                <div class="stbuilder-o-items">
                    
                    <?php foreach($builder_items as $function => $item): ?>
                    <div class="bd-item">
                        <div class="add-btn">
                            <span class="n"><?php echo esc_html($item['title']); ?></span>
                            <a href="#" class="act-add"><?php echo _e('Add','smooththemes'); ?></a>
                        </div><!-- add-btn -->
                        
                        <div class="item-js-options">
                      <?php 
                         $w = $item['default_with'];
                         if($w==''){
                            $w='1_1';
                         }
                      ?>
                            
                        <div class="obj-item  col_<?php echo $w; ?>" numc="<?php echo $pd_item_width[$w]; ?>">
                        <div class="obj-item-inner">
                                    <input type="hidden"  class="group-name builder-with"  group-name="[pbwith]" value="<?php echo $w; ?>" />
                                   <?php if(!$item['block']): ?>
                                    <span class="up">+</span>
                                    <span class="down">-</span>
                                    <?php endif; ?>
                                    <span class="with-info"><?php echo str_replace('_','/',$w); ?></span>
                                    <?php if($item['editable']!==false): ?>
                                    <span class="pbedit" title="<?php _e('Click here to edit','smooththemes'); ?>">Edit</span>
                                    <?php endif; ?>
                                    <span class="pbremove" title="<?php _e('Remove','smooththemes'); ?>"></span>
                                    
                                     <div class="t"><div><?php echo esc_html($item['title']); ?></div></div>
                             
                                 <div class="obj-js-edit">
                                    <?php 
                                     if(function_exists($function)){
                                        call_user_func($function, $function);
                                     }
                                    ?>
                                    
                                    <div class="pb-btns">
                                         <input type="button" value="<?php _e('Save','smooththemes'); ?>" class="pbdone pbbtn button-primary" />
                                         <input type="button" value="<?php _e('Cancel','smooththemes'); ?>" class="pbcancel pbbtn button-secondary" />
                                    </div>
                                 </div><!-- obj-js-edit -->
                            </div>
                                
                         </div><!--  /.obj-item  -->

                        </div><!-- item-js-options -->  
                    </div><!-- bd-item -->
                    <?php endforeach; ?>
                    
                    <div class="clear"></div>
                </div><!-- stbuilder-o-items -->
            </div><!-- stbuilder-items -->
            
            <div class="stbuilder-area-wprap">
            <div class="stbuilder-edit-box" style="display: none;">
            
            </div><!-- stbuilder-edit-box -->
            
            <div class="stbuilder-area row-fluid sortable">
                 <?php 
                 foreach($builder_save as $i => $item): 
                 
                 $func = $builder_items[$item['function']];
                     $w = $item['pbwith'];
                     if($w==''){
                        $w='1_1';
                     }
                 ?>
                 
                 <div class="obj-item  col_<?php echo $w; ?>" numc="<?php echo $pd_item_width[$w]; ?>">
                        <div class="obj-item-inner">
                                    <input type="hidden"  class="group-name builder-with"  group-name="[pbwith]" value="<?php echo $w; ?>" />
                                     <?php if(!$func['block']): ?>
                                    <span class="up">+</span>
                                    <span class="down">-</span>
                                    <?php endif; ?>
                                    <span class="with-info"><?php echo str_replace('_','/',$w); ?></span>
                                   <?php if(@$func['editable']!==false): ?>
                                    <span class="pbedit" title="<?php _e('Click here to edit','smooththemes'); ?>">Edit</span>
                                    <?php endif; ?>
                                    <span class="pbremove" title="<?php _e('Remove','smooththemes'); ?>"></span>
                                     <div class="t"><div><?php echo esc_html($func['title']); ?></div></div>
                             
                                 <div class="obj-js-edit">
                                    <?php 
                                     if(function_exists($item['function'])){
                                             call_user_func($item['function'],$item['function'],$builder_name,$item);
                                        }
                                    ?>
                                    <div class="pb-btns">
                                         <input type="button" value="<?php _e('Save','smooththemes'); ?>" class="pbdone pbbtn button-primary" />
                                         <input type="button" value="<?php _e('Cancel','smooththemes'); ?>" class="pbcancel pbbtn button-secondary" />
                                    </div>
                                 </div><!-- obj-js-edit -->
                            </div>
                                
                    </div><!--  /.obj-item  -->

                  <?php endforeach; ?>
                
            </div><!-- stbuilder-area -->
            </div>
       
       </div><!-- stbuilder -->
       
       <div class="stdive"></div>
       
       <?php endif; ?>
    
    <?php
}


function  st_builder_meta_layout_sidebar($name='', $values = array() , $post = false){
    global $wp_registered_sidebars;
    $input = '';
    ?>
    <div class="layout-wrap">
     <div class="layout">
       <h4><?php _e('Layout','smooththemes'); ?></h4>
        <?php
        $layouts = array(
          //  '4'=>  array('title'=>'Three columns, left & right sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/3.png'),
            '3'=>  array('title'=>'Two columns, left sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/2.png'),
            '2'=>  array('title'=>'Two columns, right sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/1.png'),
            '1'=>  array('title'=>'One column, no sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/0.png')
        );
        
        $layout_name = $name.'[layout]';
        $current_layout =  $values['layout'];
        
        if(empty($current_layout)){
            $values['layout'] = $current_layout = (in_array($post->post_type, array('portfolio'))) ? '1' : st_get_setting("layout",2) ;// default right sidebar
        }
        
         foreach($layouts as $k => $item){
            // $check=$this->radio_checked($k);
             $class="";
             $check = "";
             if($k!='' && $k== $current_layout){
                $class=" label-checked";
                $check ='  checked="checked" ';
             }
             
             $image = $item['img'];
             
             $input.='<div class="stpb-layout-item'.$class.'">';
             $input.='
             <label class="label" title="'.esc_attr($item['title']).'">
                 <input value="'.htmlspecialchars($k).'" class="STpanel-radio-input" type="radio" '.$check.' name="'.$layout_name.'" />
                 <img src="'.$image.'" alt =""/>
             </label>';
             $input.='</div>';
         }
         
          echo $input;
        ?>
        <div class="clear"></div>
       </div><!-- layout -->
       
       <?php 
         // default sidebar 
         $values['left_sidebar'] = ($values['left_sidebar']!='') ? $values['left_sidebar']  : 'sidebar_default_l' ;
         $values['right_sidebar'] = ($values['right_sidebar']!='') ? $values['right_sidebar']  : 'sidebar_default_r' ;
       ?>
       
        <div class="sidebar" <?php echo ($values['layout']!=1) ? '' : ' style="display:none;" '; ?>>
        <h4><?php _e('Sidebar','smooththemes'); ?></h4>
        <span  <?php echo ($values['layout']==3  || $values['layout']==4) ? ' ' : ' style="display:none;" '; ?> class="left_sidebar">
        <span class="chzn-select-lb"><?php _e('Left sidebar','smooththemes'); ?></span>
         <select name="<?php echo $name.'[left_sidebar]'; ?>" class="chzn-select">
             <?php foreach($wp_registered_sidebars as $sb):
             
             $selected="";
             if($values['left_sidebar']==$sb['id']){
                $selected = ' selected ="selected" ';
             }
             
              ?>
             <option value="<?php echo esc_attr($sb['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($sb['name']); ?></option>
             <?php endforeach; ?>
          </select>
           <div class="clear"></div>
         </span>
          
          
         <span <?php echo ($values['layout']==2  || $values['layout']==4) ? ' ' : ' style="display:none;" '; ?> class="right_sidebar">
         <span class="chzn-select-lb"><?php _e('Right sidebar','smooththemes'); ?></span>
       
         <select name="<?php echo $name.'[right_sidebar]'; ?>" class="chzn-select">
             <?php foreach($wp_registered_sidebars as $sb):
             
             $selected="";
             if($values['right_sidebar']==$sb['id']){
                $selected = ' selected ="selected" ';
             }
             
              ?>
             <option value="<?php echo esc_attr($sb['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($sb['name']); ?></option>
             <?php endforeach; ?>
         </select>
           <div class="clear"></div>
          </span>
          
             <div class="clear"></div>
        </div><!--  /. sidebar -->
        
      </div>  
        
        
    <?php
}


function st_builder_meta_portfolio($name='', $values = array() , $post = false){
    
    if(!in_array(strtolower($post->post_type),array('portfolio'))){
        return ;
    }
    ?>

       <?php /** ============= Sub layout for portfolio ============= */ ?>
        
         <div class="stdive"></div>
         <?php /*
         <div class="portfolio-layout">
             <h4><?php _e('Portfolio Layout','smooththemes'); ?></h4>
             <?php
               $portfolio_layouts = array('half'=>__('Single portfolio half','smooththemes'),'full'=>'Single portfolio wide');
              ?>
               <select name="<?php echo $name.'[portfolio_layout]'; ?>" class="chzn-select">
                     <?php foreach($portfolio_layouts as $pk=> $pl){ 
                         $selected="";
                         if($values['portfolio_layout']==$pk){
                            $selected = ' selected ="selected" ';
                         }
                        ?>
                     <option value="<?php echo esc_attr($pk); ?>" <?php echo $selected; ?> ><?php echo esc_html($pl); ?></option>
                     <?php } ?>
               </select>
         </div><!-- portfolio-layout -->
         */ ?>
         
         
         <h4><?php _e('Portfolio details','smooththemes'); ?></h4>
          <div class="portfolio-details">
                <p>
                <strong><?php _e('Date','smooththemes'); ?></strong><br />
                 <input type="text" class="regular-text st_datepicker"  name="<?php echo $name.'[portfolio_date]'; ?>" value="<?php echo esc_attr($values['portfolio_date']); ?>" />
                </p>
                
                <p>
                <strong><?php _e('Client','smooththemes'); ?></strong><br />
                 <input type="text" class="regular-text"  name="<?php echo $name.'[portfolio_client]'; ?>" value="<?php echo esc_attr($values['portfolio_client']); ?>" />
                </p>
                
                <p>
                <strong><?php _e('Skills','smooththemes'); ?></strong><br />
                 <input type="text" class="regular-text"  name="<?php echo $name.'[portfolio_skills]'; ?>" value="<?php echo esc_attr($values['portfolio_skills']); ?>" />
                </p>
                
                 <p>
                <strong><?php _e('Website url','smooththemes'); ?></strong><br />
                 <input type="text" class="regular-text"  name="<?php echo $name.'[portfolio_website]'; ?>" value="<?php echo esc_attr($values['portfolio_website']); ?>" />
                </p>
          </div>
         
       <?php /** ============= END Sub layout for portfolio ============= */ ?>
    
    <?php
}


function st_builder_meta_page_title($name='', $values = array() , $post = false, $no_value= false){ 
     ?>
      <?php  if(strtolower($post->post_type)=='page'):  ?>
         <div class="stdive"></div>
       <?php
       
        if($no_value){
            $values['show_title'] = 1;
            $values['show_content'] = 1;
            $values['tag_line'] = '';
        }
        ?>
        <div class="page_options">
        
            <div class="show_title">
             <h4><?php _e('Show page Title','smooththemes'); ?><small>(<?php _e('Enable title for this page','smooththemes'); ?>)</small></h4>
                <input type="checkbox" class="show_title_ibutton" name="<?php echo $name.'[show_title]'; ?>" <?php  echo ($values['show_title'] ==1) ? '  checked="checked" ':''; ?> value="1" />
            </div>
            
            <div class="slider-show-title" <?php echo ($values['show_title']==1) ? '' : ' style="display: none;" '; ?>>
             <h4><?php _e('TagLine','smooththemes'); ?><small>(<?php _e('Show tagline after title','smooththemes'); ?>)</small></h4>
                <input type="text" class="bigtitle" style="width: 100%;" name="<?php echo $name.'[tagline]'; ?>" value="<?php echo esc_attr($values['tagline']); ?>" />
            </div>
           

        </div>
       <?php endif; ?>
     <?php
    
}

function st_builder_meta_post_type_thumb($name='', $values = array() , $post = false){ 
      
    ?>
      <?php
        if('page'!= strtolower($post->post_type)): 
        if(empty($values['thumbnail_type'])){
            $values['thumbnail_type'] ='image';
        }
        ?>
        <div class="stdive"></div>
          
        <div class="thumbnail">
            <h4><?php _e('Thumbnail','smooththemes'); ?></h4>
            <p>
                <label><input class="tt" type="radio" name="<?php echo $name.'[thumbnail_type]'; ?>" <?php  echo $values['thumbnail_type'] == 'image' ? '  checked="checked" ':''; ?> value="image" /><?php _e('Image (use featured Image)','smooththemes'); ?></label>
            </p>
            
            <p>
                <label><input class="tt" type="radio" name="<?php echo $name.'[thumbnail_type]'; ?>" <?php  echo $values['thumbnail_type'] == 'slider' ? '  checked="checked" ':''; ?> value="slider" /><?php _e('Slider','smooththemes'); ?></label>
            </p>
            
            <?php if(!in_array($post->post_type, array('room','gallery'))): ?>
            <p>
                <label><input class="tt" type="radio" name="<?php echo $name.'[thumbnail_type]'; ?>" <?php  echo $values['thumbnail_type'] == 'video' ? '  checked="checked" ':''; ?> value="video" /><?php _e('Video','smooththemes'); ?></label>
            </p>
            <?php endif; ?>
            
            <?php /*
            <p>
                <label><input class="tt" type="radio" name="<?php echo $name.'[thumbnail_type]'; ?>" <?php  echo $values['thumbnail_type'] == 'html' ? '  checked="checked" ':''; ?> value="html" /><?php _e('Custom HTML','smooththemes'); ?></label>
            </p>
            */ ?>
            
            <div class="thumbnail_images gallery-builder" <?php  echo ($values['thumbnail_type'] == 'video'  || $values['thumbnail_type'] == 'image' || $values['thumbnail_type'] == 'html' ) ? ' style="display: none" ' : ''; ?>>
                <?php stpb_images($name.'[thumbnails]',$values['thumbnails']); ?>
            </div>
            
            
            
            <div class="thumbnail_video" <?php  echo ($values['thumbnail_type'] == 'video')? '' : ' style="display: none" ' ; ?>>
                <label>
                <strong><?php echo _e("Video URL (Youtube or Vimeo only)",'smooththemes'); ?></strong><br />
                <input type="text" class="regular-text"  name="<?php echo $name.'[video_code]'; ?>" value="<?php echo esc_attr($values['video_code']); ?>" />
                </label>
            </div>
            
            <?php /*
            <div class="thumbnail_html" <?php  echo ($values['thumbnail_type'] == 'html') ? '' :' style="display: none" '; ?>>
                <label>
                <strong><?php echo _e("HTML code)",'smooththemes'); ?></strong><br />
                
                <textarea rows="10" style="width: 60%;" name="<?php echo $name.'[html_code]'; ?>"><?php echo esc_attr($values['html_code']); ?></textarea>
                
                
                </label>
            </div>
            */ ?>
            

        </div>
        <?php endif; ?>
         
    <?php
    
}

function st_builder_meta_page_type_thumb($name='', $values = array() , $post = false){ 
      
    ?>
      <?php
        if('page'== strtolower($post->post_type)): 
        if(empty($values['thumbnail_type'])){
            $values['thumbnail_type'] ='image';
        }
        ?>
        <div class="stdive"></div>
        
        <div class="show_top_slider">
            <h4><?php _e('Show top Element','smooththemes'); ?><small> (<?php _e('Enable top slider','smooththemes'); ?>)</small></h4>
            <input type="checkbox"  class="show_top_slider_ibutton show_top_slider" name="<?php echo $name.'[show_top_slider]'; ?>" <?php  echo ($values['show_top_slider'] == 1) ? '  checked="checked" ':''; ?> value="1" />
        </div>
        
        <div class="slider-types" <?php echo ($values['show_top_slider']==1) ? '' : ' style="display: none;" '; ?>>
            <div class="thumbnail">
                <p></p>
                <input class="tt" type="hidden" name="<?php echo $name.'[thumbnail_type]'; ?>" value="slider" />
                <div class="thumbnail_images gallery-builder">
                    <?php stpb_images($name.'[thumbnails]',$values['thumbnails']); ?>
                </div>
            </div>
        </div>

        <?php endif; ?>
         
    <?php
    
}

function  stpb_select_layout($name, $layout_name,$left_sidebar_name,$right_sidebar_name,$values= array(), $title=''){
      global $wp_registered_sidebars;
    ?>
    <div class="layout-wrap">
     <div class="layout">
       <h4><?php echo esc_html($title); ?></h4>
        <?php
        $layouts = array(
          //  '4'=>  array('title'=>'Three columns, left & right sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/3.png'),
            '3'=>  array('title'=>'Two columns, left sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/2.png'),
            '2'=>  array('title'=>'Two columns, right sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/1.png'),
            '1'=>  array('title'=>'One column, no sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/0.png')
        );
        
        $input_layout_name = $name.'['.$layout_name.']';
        $current_layout =  $values[$layout_name];
        
       //  echo var_dump($layout_name);
        
        if(empty($current_layout)){
            $values[$layout_name] = 1; 
        }
        
         foreach($layouts as $k => $item){
            // $check=$this->radio_checked($k);
             $class="";
             $check = "";
             if($k!='' && $k== $current_layout){
                $class=" label-checked";
                $check ='  checked="checked" ';
             }
             
             $image = $item['img'];
             
             $input.='<div class="stpb-layout-item'.$class.'">';
             $input.='
             <label class="label" title="'.esc_attr($item['title']).'">
                 <input value="'.htmlspecialchars($k).'" class="STpanel-radio-input" type="radio" '.$check.' name="'.$input_layout_name.'" />
                 <img src="'.$image.'" alt =""/>
             </label>';
             $input.='</div>';
         }
          echo $input;
        ?>
        <div class="clear"></div>
       </div><!-- layout -->
       
       <?php 
         // default sidebar 
         $values[$left_sidebar_name] = ($values[$left_sidebar_name]!='') ? $values[$left_sidebar_name]  : 'sidebar_default_l' ;
         $values[$right_sidebar_name] = ($values[$right_sidebar_name]!='') ? $values[$right_sidebar_name]  : 'shop_right_sidebar' ;
       ?>
       
        <div class="sidebar" <?php echo ($values[$layout_name]!=1) ? '' : ' style="display:none;" '; ?>>
        <h4><?php _e('Sidebar','smooththemes'); ?></h4>
        <span  <?php echo ($values[$layout_name]==3  || $values[$layout_name]==4) ? ' ' : ' style="display:none;" '; ?> class="left_sidebar">
        <span class="chzn-select-lb"><?php _e('Left sidebar','smooththemes'); ?></span>
         <select name="<?php echo $name.'['.$left_sidebar_name.']'; ?>" class="chzn-select">
             <?php foreach($wp_registered_sidebars as $sb):
             
             $selected="";
             if($values[$left_sidebar_name]==$sb['id']){
                $selected = ' selected ="selected" ';
             }
             
              ?>
             <option value="<?php echo esc_attr($sb['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($sb['name']); ?></option>
             <?php endforeach; ?>
          </select>
           <div class="clear"></div>
         </span>
          
         <span <?php echo ($values[$layout_name]==2  || $values[$layout_name]==4) ? ' ' : ' style="display:none;" '; ?> class="right_sidebar">
         <span class="chzn-select-lb"><?php _e('Right sidebar','smooththemes'); ?></span>
       
         <select name="<?php echo $name.'['.$right_sidebar_name.']'; ?>" class="chzn-select">
             <?php
              foreach($wp_registered_sidebars as $sb):
             
             $selected="";
             if($values[$right_sidebar_name]==$sb['id']){
                $selected = ' selected ="selected" ';
             }
             
              ?>
             <option value="<?php echo esc_attr($sb['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($sb['name']); ?></option>
             <?php endforeach; ?>
         </select>
           <div class="clear"></div>
          </span>
          
             <div class="clear"></div>
        </div><!--  /. sidebar -->
      </div>  
    <?php
    
}


function st_builder_one_page($name='', $values = array() , $post = false){ 

	if('page'!= strtolower($post->post_type)){
		return ;
	}
	
	$items =  is_array($values['one_page']) ?  $values['one_page'] :  array();
	
	// echo var_dump($items);
	
	$bg_pos = array(
                'tl'=>__('Top left','smooththemes'),
                'tc'=>__('Top center','smooththemes'),
                'tr'=>__('Top right','smooththemes'),
                'cc'=>__('Center','smooththemes'),
                'bl'=>__('Bottom left','smooththemes'),
                'br'=>__('Bottom right','smooththemes'),
                'bc'=>__('Bottom center','smooththemes'),
        );

	$bg_reppeat = array(
                'r'=>__('Repeat','smooththemes'),
                'n'=>__('No repeat','smooththemes'),
                'x'=>__('Repeat X','smooththemes'),
                'y'=>__('Repeat Y','smooththemes')
        );

	$yes_no = array(
		'n'=>__('No','smooththemes'),
		'y'=>__('Yes','smooththemes')
				
	);
	
	?>
	
	<style type="text/css">
     .pages-available, .pages-included{ }
     .pages-available{ }
     .pages-included{ position: relative; }
     .pages-item  li img{ max-width: 400px;  margin-right: 5px; margin-top: 10px; margin-bottom: 10px; }
     
      .pages-item li .action{ float: right; }
      .pages-item .st-widget .stwrmt { margin-top:3px; }
      .pages-available-items .stwrmt{ display: none; }
      .parallax-item-tpl, .page-item-tpl{  display: none; }
      
      .st-opl-list-pages .item{
            background: none repeat scroll 0 0 #F9F9F9;
            border: 1px solid #DFDFDF;
            border-radius: 3px 3px 3px 3px;
            box-shadow: 0 1px 0 #FFFFFF inset;
            display: block;
            padding: 7px;
            margin: 5px 0px 10px;
        }
        .st-opl-list-pages{ display: none;  overflow: auto;  max-height:  200px; border: 1px solid #ccc;  margin: 10px 0px 20px; padding: 10px; }
        .st-opl-list-pages .item .st-add{ float: right; }
        a.st-opl-hide-pages.button-secondary{ display: none }
        
        .item-added{display: none;  text-align: center;}
        .item-added span{  border: 1px solid #2C96C7;  padding: 10px;   border-radius:  5px; }
        
 	</style>
 	
 	
 	<script type="text/javascript">
 	/* <![CDATA[ */
      jQuery(document).ready(function(){
            var otpl_meta_name =<?php echo json_encode($meta_name); ?>;
            var s_remove_txt =<?php echo json_encode($remove_txt); ?>;
            var s_ =<?php echo json_encode($remove_txt); ?>;
            var opt_pre_name =  '<?php echo $name; ?>[one_page]';
           
			// rename items
			var opt_rename_items = function (){
					var wrap = jQuery('.pages-included-items');
					jQuery('li',wrap).each(function(i){
						var obj = jQuery(this);

						jQuery('input, select, textarea',obj).each(function(){
							var ip= jQuery(this);
							var name = ip.attr('data-name');
							if(typeof(name)!=='undefined'  && ip!==''){
								ip.attr('name',opt_pre_name+'['+i+']'+name);	
							}
							
						});
						
					});
			};

			var show_note =  function(){
				jQuery('.item-added').show();
				setTimeout(function(){
					jQuery('.item-added').hide();
				},2000);
			};

			
			
			
			opt_rename_items();

			 jQuery('.pages-included-items').sortable({
				 handle: '.st-hndle',
				 items: "> li",
				 stop: function(){
				 	opt_rename_items();
				 }
					
			 });

			jQuery('.st-opl-hide-pages').click(function(){
				jQuery('.st-opl-list-pages').hide();
				jQuery(this).hide();
				return false;
			});


			// change item settings	
			jQuery('.pages-included-items li .is_parallax').live('change', function() {
					var  p = jQuery(this).parents('li');
					var v = jQuery(this).val();
					if(v==='n'){
						jQuery('.bg-meta',p).show();
					}else{
						jQuery('.bg-meta',p).hide();
					}
	
			});
			// when load
			jQuery('.pages-included-items li .is_parallax').each( function() {
				var  p = jQuery(this).parents('li');
				var v = jQuery(this).val();
				if(v==='n'){
					jQuery('.bg-meta',p).show();
				}else{
					jQuery('.bg-meta',p).hide();
				}

		});
				

            
         // for add new
            jQuery('.st-add-parallax').click(function(){
				var html = jQuery('.parallax-item-tpl').html();
				jQuery('.pages-included-items').append('<li>'+html+'</li>');

				opt_rename_items();
				show_note();
				jQuery(".pages-included-items .chzn-select, .pages-included-items .chzn-select-n ").addClass('chzn-select').chosen();
				return false;
                
            });

			// add page
			jQuery('.st-opl-list-pages .item .st-add').live('click',function() {
				var p = jQuery(this).parents('.item');
				var html = jQuery('.page-item-tpl').html();
				var page_id =  jQuery(this).attr('data-id');
				var title=  jQuery(this).attr('data-title');
				var tagline = jQuery(this).attr('data-tagline');

				var info= jQuery('.st-ptt',p).html();
				html = '<li class="page-item item-id-'+page_id+'">'+html+'</li>';
				
				html = jQuery(html);
			  	html.find('.meta').html(info);
			  	html.find('.st-hndle span').html(title);
			  	html.find('.ui-title').val(title);
			  	html.find('.ui-input.tagline').val(tagline);
			  	html.find('.page_id').val(page_id);
				
				jQuery('.pages-included-items').append(html);
				// p.remove();
				//p.addClass('hide').hide();
				if(jQuery('.st-opl-list-pages .item:not(.hide)').length<=0){
					jQuery('.st-opl-list-pages').hide();
					jQuery('.st-opl-hide-pages').css({'display':'hidden'});
				}
				
				show_note();
				opt_rename_items();
				jQuery(".pages-included-items .chzn-select, .pages-included-items .chzn-select-n ").addClass('chzn-select').chosen();


				// color pickder
				jQuery('.colorSelector-wrap').each(function(){
				       
				       var p= jQuery(this);
				       var  c =  jQuery('.colorSelector-input',p).val();
				       c ='#'+c;
				       
				       jQuery('.colorSelector',p).ColorPicker({
							color: c,
							onShow: function (colpkr) {
								jQuery(colpkr).fadeIn(500);
								return false;
							},
							onHide: function (colpkr) {
								jQuery(colpkr).fadeOut(500);
								return false;
							},
				             onSubmit: function(hsb, hex, rgb, el) {
				    				jQuery(el).val(hex);
				    				jQuery(el).ColorPickerHide();
				                    jQuery('.colorSelector div',p).css('backgroundColor', '#' + hex);
				                    return false;
							     },
							onChange: function (hsb, hex, rgb) {
								jQuery('.colorSelector div',p).css('backgroundColor', '#' + hex);
				                 jQuery('.colorSelector-input',p).val(hex);
							},
				        	onBeforeShow: function () {
				        	   var c = jQuery('.colorSelector-input',p).val();
								jQuery(this).ColorPickerSetColor(c);
							}
						});
				        
				         jQuery('.colorSelector-input',p).ColorPicker({
				              
				                onSubmit: function(hsb, hex, rgb, el) {
				    				jQuery(el).val(hex);
				    				jQuery(el).ColorPickerHide();
				                    jQuery('.colorSelector div',p).css('backgroundColor', '#' + hex);
				                    return false;
							     },
				                onChange: function (hsb, hex, rgb) {
				                    jQuery('.colorSelector-input',p).val(hex);
				                    jQuery('.colorSelector div',p).css('backgroundColor', '#' + hex);
				                },
				    			onBeforeShow: function () {
				    				jQuery(this).ColorPickerSetColor(this.value);
				    			}
				         }).bind('keyup', function(){
				        	   jQuery(this).ColorPickerSetColor(this.value);
				               jQuery('.colorSelector div',p).css('backgroundColor', '#' + this.value);
				        });
				        
				    });

			    
						
				return false;
				
			} );
            

            // remove 
            jQuery('.pages-included-items  li .remove').live('click',function(){
                
            	jQuery(this).parents('li').fadeOut(500,function(){
            		
            		if(jQuery('.st-opl-list-pages .item:not(.hide)').length<=0){
    					jQuery('.st-opl-list-pages').hide();
    					jQuery('.st-opl-hide-pages').css({'display':'hidden'});
    				}
            		
               	});

            	jQuery(this).parents('li').remove();
            	opt_rename_items();
					
				return false;
            });

            // ajax load page 
            jQuery('.st-opl-add-page').live('click', function () {
               var lp =  jQuery('.st-opl-list-pages');
               var loading = lp.attr('data-loading') || 'Loading...';
               lp.html('<p>'+loading+'</p> ');
               lp.show();
               
				var post_id =0;
                var data = {
                    action: 'stpb_get_pages',
                    url: ajaxurl,
                    post_id: post_id,
                    ajax_nonce: STpb_options.ajax_nonce,
                    rand: (new Date().getTime())
                };


                jQuery.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: data,
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                    	lp.html(data);
                    	jQuery('.st-opl-hide-pages').css({'display':'inline-block'});
                    }
                });

                return false;
            });
           
      });

      /* ]]> */
 	</script>
      
	<div class="stpb_pd_w  st-one-page-settings">
		<h4><?php _e('One page template settings','smooththemes'); ?></h4>
		
        <div class="home-element-wrapper">            
    		<h4><?php _e('Top Home Elements','smooththemes'); ?></h4>	
            <?php
                if(empty($values['home_element_type'])){
                    $values['home_element_type'] ='fixed-height-slider';
                }
            ?>   
            <p>
                <label><input class="tt" type="radio" name="<?php echo $name.'[home_element_type]'; ?>" <?php  echo $values['home_element_type'] == 'fixed-height-slider' ? '  checked="checked" ':''; ?> value="fixed-height-slider" /><?php _e('Fixed height slider','smooththemes'); ?></label>
            </p>
            
            <p>
                <label><input class="tt" type="radio" name="<?php echo $name.'[home_element_type]'; ?>" <?php  echo $values['home_element_type'] == 'layer-slider' ? '  checked="checked" ':''; ?> value="layer-slider" /><?php _e('Layer Slider','smooththemes'); ?></label>
            </p>  
            <p>
                <label><input class="tt" type="radio" name="<?php echo $name.'[home_element_type]'; ?>" <?php  echo $values['home_element_type'] == 'fixed-height-video' ? '  checked="checked" ':''; ?> value="fixed-height-video" /><?php _e('Fixed height video','smooththemes'); ?></label>
            </p> 

            <div class="home-element-wrap fixed-height-slider" <?php  echo ($values['home_element_type'] == 'fixed-height-slider' ) ? '' : ' style="display: none" '; ?>>
                <?php stpb_images($name.'[one_page_slider]',$values['one_page_slider']); ?> 
            </div>
            <div class="home-element-wrap layer-slider" <?php  echo ($values['home_element_type'] == 'layer-slider')? '' : ' style="display: none" ' ; ?>>
                <label>
                <strong><?php echo _e("Layer Slider Id",'smooththemes'); ?></strong><br />
                <input type="text" class="regular-text"  name="<?php echo $name.'[layer_slider_id]'; ?>" value="<?php echo esc_attr($values['layer_slider_id']); ?>" />
                </label>
            </div>      
            <div class="home-element-wrap fixed-video" <?php  echo ($values['home_element_type'] == 'fixed-height-video')? '' : ' style="display: none" ' ; ?>>
                <label class="fixed-video-label">Youtube Video Id</label><input type="text" class="regular-text"  name="<?php echo $name.'[home_video_id]'; ?>" value="<?php echo esc_attr($values['home_video_id']); ?>" /> <label>http://www.youtube.com/watch?v=<b style="color : red">X-mViAEryVg</b></label><br>
                <br><label class="fixed-video-label">Html code</label><textarea type="text" class="regular-text width-100" rows="10" name="<?php echo $name.'[home_video_caption]'; ?>" ><?php echo esc_attr($values['home_video_caption']); ?></textarea>  
            </div>      
        </div>
	    <br class="clear">
        <div class="stdive"></div>
      	<div class="parallax-item-tpl">
		    <div class="st-widget widget closed">	
			    <div title="<?php  _e('Click to toggle','smooththemes'); ?>" class="ui-handlediv"><br></div>
			    <a href="#" class="remove stwrmt button-secondary"><?php _e('Remove','smooththemes'); ?></a>
			    <h3 class="st-hndle"><?php  _e('Parallax','smooththemes'); ?><span></span></h3>
			    
				<div class="inside">
			
			    	<div class="widget-content">
						<input type="hidden" class="item_type" value="parallax" data-name="[item_type]"  >
						
						<div class="STpanel-box-upload ui-img-w"><label><b><?php _e('Image:','smooththemes'); ?></b></label>
							<input type="text" class="ui-img bp-input-upload" data-type="id" data-name="[image]" value="">
						    <input type="button" value="Insert image" class="bp-upload-button button-secondary">
						    <a class="remove_image button-secondary" href="#" style="display: none;"><?php _e('Remove',''); ?></a>
							    <div class="STpanel-image-preview"></div>
							    <div class="clear"></div>
						</div>
							 
							<p>
							<label><b><?php _e('Content:','smooththemes'); ?></b></label>
							<textarea rows="10" class="ui-cont content" data-name="[content]"  ></textarea>
							</p>
						</div>
						
						<p>
							<b><label><?php _e('Box ID:','smooththemes'); ?></label></b>
							<input type="text" class="ui-input" value="" data-name="[custom_id]" >
						</p>
						
						<p>
							<b><label><?php _e('Custom class:','smooththemes'); ?></label></b>
							<input type="text" class="ui-input" value="" data-name="[custom_class]" >
						</p>
	
				    	<div class="widget-control-actions">
				    		<div class="alignleft">
				        		<a href="#remove" class="remove"><?php _e('Delete','smooththemes'); ?></a> |
				        		<a href="#close" class="close"><?php _e('Close','smooththemes'); ?></a>
				    		</div>
				    		<br class="clear">
				    	</div>
					
					</div>
				  
		    </div>
		</div>
		
		
		<div class="page-item-tpl">
			    <div class="st-widget widget closed">	
			    <div class="ui-handlediv" title="<?php  _e('Click to toggle','smooththemes'); ?>"><br></div>
			    <a class="remove stwrmt button-secondary" href="#"><?php _e('Remove','smooththemes'); ?></a>
			    <h3 class="st-hndle"><?php _e('Page:','smooththemes'); ?><span></span></h3>
			    
				<div class="inside">
			
			    	<div class="widget-content">
			    		<input type="hidden" class="page_id" value="" data-name="[page_id]"  >
			    		<input type="hidden" class="item_type" value="page" data-name="[item_type]"  >
			    		
			    		
			    		<p ><?php  _e('Page:','smooththemes') ?> <span class="meta"></span></p>
			    		
			    		
						<p>
							<label><b><?php _e('Is parallax item ?','smooththemes'); ?></b></label>
						</p>
						
						<select   data-name="[is_parallax]" class="chzn-select-n is_parallax bp-input-select"  >
							<?php  foreach ($yes_no as $k => $v){  ?>
							<option value="<?php echo $k ?>"><?php echo esc_html($v); ?></option>
							<?php } ?>
							
						</select>
							
			    		
						<p>
							<label><b><?php _e('Title:','smooththemes'); ?></b></label>
							<input type="text" class="ui-title title" value="" data-name="[title]"  >
						</p>
						
						<p>
							<label><b><?php _e('Tagline:','smooththemes'); ?></b></label>
							<input type="text" class="ui-input tagline" value="" data-name="[tagline]" >
						</p>
						
						
						<!-- For back ground -->
						<h4><b><?php _e('Background','smooththemes'); ?></b></h4>
						

						<p><b><?php _e('Background Image','smooththemes'); ?></b></p>
						<div class="STpanel-box-upload ui-img-w">
							<input type="text" class="ui-img bp-input-upload" data-type="id" data-name="[bg_src]" value="">
						    <input type="button" value="Insert image" class="bp-upload-button button-secondary">
						    <a class="remove_image button-secondary" href="#" style="display: none;"><?php _e('Remove',''); ?></a>
							 <div class="STpanel-image-preview"></div>
							 <div class="clear"></div>
						</div>
						
						<div class="bg-meta">
						
						<p><b><?php _e('Background Color','smooththemes'); ?></b></p>
						<div class="STpanel-box-inner STpanel-box-color ">
							<div class="colorSelector-wrap">
								<div class="colorSelector">
									<div></div>
								</div>
								<label><input value="" data-name="[bg_color]" size="6" maxlength="6"  class="colorSelector-input"></label>
							</div>
							<div class="clear"></div>
						</div>
						
						
						<p><b><?php _e('Background Positon','smooththemes'); ?></b></p>
						<select   data-name="[bg_positon]" class="chzn-select-n  bp-input-select"  >
							<option value=""><?php _e('Select','smooththemes'); ?></option>
							<?php  foreach ($bg_pos as $k => $v){ 
							
							?>
							<option value="<?php echo $k ?>"><?php echo esc_html($v); ?></option>
							<?php } ?>
							
						</select>
						
						
						<p><b><?php _e('Background Repeat','smooththemes'); ?></b></p>
						<select data-name="[bg_repeat]" class="chzn-select-n  bp-input-select ">
							<option value=""><?php _e('Select','smooththemes'); ?></option>
							<?php  foreach ($bg_reppeat as $k => $v){ ?>
							<option value="<?php echo $k ?>"><?php echo esc_html($v); ?></option>
							<?php } ?>
						</select>
						
						
						<div class="clear"></div>
						
						</div><!-- /.bg-meta -->
						<!-- / For back ground -->
						
						<p>
							<b><label><?php _e('Box ID:','smooththemes'); ?></label></b>
							<input type="text" class="ui-input" value="" data-name="[custom_id]" >
						</p>
						
						<p>
							<b><label><?php _e('Custom class:','smooththemes'); ?></label></b>
							<input type="text" class="ui-input" value="" data-name="[custom_class]" >
						</p>
						
						
						
					</div>

			    	<div class="widget-control-actions">
			    		<div class="alignleft">
			        		<a href="#remove" class="remove"><?php _e('Delete','smooththemes'); ?></a> |
				        	<a href="#close" class="close"><?php _e('Close','smooththemes'); ?></a>
			    		</div>
			    		<br class="clear">
			    	</div>
				
				</div>
			    </div>
		</div>
		      	
		  
		  <div class="pages-included">
		  
		    
		    
		    <a href="#" class="st-add-parallax button button-primary">Add a custom Parallax</a>
		  
		    
		    <a href="#" class="st-opl-add-page button button-primary">Add Pages</a>
		    <a href="#" class="st-opl-hide-pages  button-secondary">Hide list pages</a>
		    
		    <div class="item-added">
			    <span class="item-added-i">
			    	<?php _e('Item Added','smooththemes'); ?>
			    </span>
		    </div>
		    

		    <div class="st-opl-list-pages" data-loading="<?php _e('Loading...','smooththemes'); ?>"></div>
		    
		    <h4><?php _e('Items Included','smooththemes'); ?></h4>
			
		    <ul class="pages-item pages-included-items st-ui-sortable">
		    
		    	<?php foreach($items as $item){ 
		    		if($item['item_type']=='page'){
						$page_title = get_the_title($item['page_id']); 
					 ?>
		    			<li>
		    			
						    <div class="st-widget widget closed">	
						    <div class="ui-handlediv" title="<?php  _e('Click to toggle','smooththemes'); ?>"><br></div>
						    <a class="remove stwrmt button-secondary" href="#"><?php _e('Remove','smooththemes'); ?></a>
						    <h3 class="st-hndle"><?php _e('Page:','smooththemes'); ?><span><?php echo $page_title; ?></span></h3>
						    
							<div class="inside">
						
						    	<div class="widget-content">
						    		<input type="hidden" class="page_id" value="<?php  echo esc_attr($item['page_id']); ?>" data-name="[page_id]"  >
						    		<input type="hidden" class="item_type" value="page" data-name="[item_type]"  >
						    		
						    		<p><?php  _e('Page:','smooththemes') ?> 
						    			<span class="meta">
							    			<a href="<?php echo get_permalink($item['page_id']);  ?>" target="_blank"><?php echo $page_title ; ?> </a>
							    		</span>
						    		</p>
						    		
						    		<p>
										<label><b><?php _e('Is parallax item ?','smooththemes'); ?></b></label>
									</p>
									
									<select   data-name="[is_parallax]" class="chzn-select bp-input-select is_parallax"  >
										<?php  foreach ($yes_no as $k => $v){ 
											$selected = '';
											if($item['is_parallax']==$k){
												$selected =' selected="selected" ';
											}
											
											?>
										<option value="<?php echo $k ?>" <?php echo $selected; ?>><?php echo esc_html($v); ?></option>
										<?php } ?>

									</select>
						    		
									<p>
										<label><b><?php _e('Title:','smooththemes'); ?></b></label>
										<input type="text" class="ui-title title" value="<?php  echo esc_attr($item['title']); ?>" data-name="[title]"  >
									</p>
									
									<p>
										<label><b><?php _e('Tagline:','smooththemes'); ?></b></label>
										<input type="text" class="ui-input tagline" value="<?php  echo esc_attr($item['tagline']); ?>" data-name="[tagline]" >
									</p>
									
									<!-- For back ground -->
									<h4><b><?php _e('Background','smooththemes'); ?></b></h4>
									

									<p><b><?php _e('Background Image','smooththemes'); ?></b></p>
									<div class="STpanel-box-upload ui-img-w">
										<input type="text" class="ui-img bp-input-upload" data-type="id" data-name="[bg_src]" value="<?php echo esc_attr($item['bg_src']); ?>">
									    <input type="button" value="Insert image" class="bp-upload-button button-secondary">
									    <a class="remove_image button-secondary" href="#" style="display: none;"><?php _e('Remove',''); ?></a>
										 <div class="STpanel-image-preview"> <?php if($item['bg_src']!=''){ ?> <img alt="" src="<?php echo esc_attr($item['bg_src']); ?>"><?php  } ?></div>
										 <div class="clear"></div>
									</div>
									
									<div class="bg-meta">
									 
									<p><b><?php _e('Background Color','smooththemes'); ?></b></p>
									<div class="STpanel-box-inner STpanel-box-color ">
										<div class="colorSelector-wrap">
											<div class="colorSelector">
												<div <?php if($item['bg_color']!=''){  ?> style="background-color: <?php echo '#'.$item['bg_color'];  ?>" <?php  } ?> ></div>
											</div>
											<label><input value="<?php echo $item['bg_color']; ?>" data-name="[bg_color]" size="6" maxlength="6"  class="colorSelector-input"></label>
										</div>
										<div class="clear"></div>
									</div>
									
									
									<p><b><?php _e('Background Positon','smooththemes'); ?></b></p>
									<select   data-name="[bg_positon]" class="chzn-select bp-input-select"  >
										<option value=""><?php _e('Select','smooththemes'); ?></option>
										<?php  foreach ($bg_pos as $k => $v){ 
											$selected = '';
											if($item['bg_positon']==$k){
												$selected =' selected="selected" ';
											}
												
										?>
										<option value="<?php echo $k ?>" <?php echo $selected;  ?>><?php echo esc_html($v); ?></option>
										<?php } ?>
										
									</select>
									
									
									<p><b><?php _e('Background Repeat','smooththemes'); ?></b></p>
									<select data-name="[bg_repeat]" class="chzn-select bp-input-select ">
										<option value=""><?php _e('Select','smooththemes'); ?></option>
										<?php  foreach ($bg_reppeat as $k => $v){ 
										
											$selected = '';
											if($item['bg_repeat']==$k){
												$selected =' selected="selected" ';
											}
											
										?>
										<option value="<?php echo $k ?>" <?php echo $selected;  ?>><?php echo esc_html($v); ?></option>
										<?php } ?>
									</select>
									
									
									
									<div class="clear"></div>
									</div><!-- /.bg-meta -->
									
									<!-- / For back ground -->
									
									<p>
										<b><label><?php _e('Box ID:','smooththemes'); ?></label></b>
										<input type="text" class="ui-input" value="<?php  echo esc_attr($item['custom_id']); ?>" data-name="[custom_id]" >
									</p>
									
									<p>
										<b><label><?php _e('Custom class:','smooththemes'); ?></label></b>
										<input type="text" class="ui-input" value="<?php  echo esc_attr($item['custom_class']); ?>" data-name="[custom_class]" >
									</p>
									

									
								</div>
			
						    	<div class="widget-control-actions">
						    		<div class="alignleft">
						        		<a href="#remove" class="remove"><?php _e('Delete','smooththemes'); ?></a> |
							        	<a href="#close" class="close"><?php _e('Close','smooththemes'); ?></a>
						    		</div>
						    		<br class="clear">
						    	</div>
							
							</div>
						    </div>
					
					</li>
								    			
			    	<?php }else{ ?>
			    	
			    	<li>
			    	
					    <div class="st-widget widget closed">	
						    <div title="<?php  _e('Click to toggle','smooththemes'); ?>" class="ui-handlediv"><br></div>
						    <a href="#" class="remove stwrmt button-secondary"><?php _e('Remove','smooththemes'); ?></a>
						    <h3 class="st-hndle"><?php  _e('Parallax','smooththemes'); ?><span></span></h3>
						    
							<div class="inside">
						
						    	<div class="widget-content">
									<input type="hidden" class="item_type" value="parallax" data-name="[item_type]"  >
									
										<div class="STpanel-box-upload ui-img-w">
										<b><label><?php _e('Image:','smooththemes'); ?></label></b>
										<input type="text" class="ui-img bp-input-upload" data-type="id" data-name="[image]" value="<?php echo esc_attr($item['image']); ?>">
									    <input type="button" value="Insert image" class="bp-upload-button button-secondary">
									    <a class="remove_image button-secondary" href="#" style="display: none;"><?php _e('Remove',''); ?></a>
										    <div class="STpanel-image-preview"><?php  if($item['image']!=''){ ?><img alt="" src="<?php echo esc_attr($item['image']); ?>"><?php } ?></div>
										    <div class="clear"></div>
										 </div>
										 
										<p>
										<b><label><?php _e('Content:','smooththemes'); ?></label></b>
										<textarea rows="10" class="ui-cont content" data-name="[content]"  ><?php echo esc_attr($item['content']); ?></textarea>
										</p>
										
										<p>
											<b><label><?php _e('Box ID:','smooththemes'); ?></label></b>
											<input type="text" class="ui-input" value="<?php  echo esc_attr($item['custom_id']); ?>" data-name="[custom_id]" >
										</p>
										
										<p>
											<b><label><?php _e('Custom class:','smooththemes'); ?></label></b>
											<input type="text" class="ui-input" value="<?php  echo esc_attr($item['custom_class']); ?>" data-name="[custom_class]" >
										</p>
										
									</div>
				
							    	<div class="widget-control-actions">
							    		<div class="alignleft">
							        		<a href="#remove" class="remove"><?php _e('Delete','smooththemes'); ?></a> |
							        		<a href="#close" class="close"><?php _e('Close','smooththemes'); ?></a>
							    		</div>
							    		<br class="clear">
							    	</div>
								
								</div>
							  
					    </div>
					
			    	</li>	
			    		
			    	<?php } ?>
		    	
		    	
		    	<?php } // end foreach ?>
		    
		    </ul><!-- /pages-included-items -->
		    
		    <p>
		      <em><?php _e('Drag items to sort','smooththemes'); ?></em>
		    </p>
		  </div>
		  
		  
		  <div class="clear"></div>
		  
	</div>
             
    <?php

}


function st_builder_custom_bottom_page($name='', $values = array() , $post = false){
	if('page'!= strtolower($post->post_type)){
		return ;
	}
	?>
	<div class="stdive"></div>
	<div class="stpb_pd_w st_page_builder_bottom_code stpb_pd_w_always_show">
		<h4><?php _e('Bottom custom code','smooththemes'); ?></h4>
	
		<textarea rows="10" name="<?php echo $name.'[bottom_custom_code]'; ?>" class="width-100"  ><?php echo esc_attr($values['bottom_custom_code']); ?></textarea>
	</div>
	<?php 

}






add_action('st_builder_items','st_builder_meta_items',10,3);
add_action('st_builder_meta','st_builder_meta_layout_sidebar',10,3);
add_action('st_builder_meta','st_builder_meta_portfolio',11,3);
add_action('st_builder_meta','st_builder_meta_page_title',12,4);
add_action('st_builder_meta','st_builder_meta_post_type_thumb',13,3);
// ('st_builder_meta','st_builder_meta_page_type_thumb',13,3);


add_action('st_after_builder','st_builder_one_page',13,3);
add_action('st_after_builder','st_builder_custom_bottom_page',15,3);


