<?php
    if(empty($data['slider_items']['images'])){
        return '';
    }
    
    $images = $data['slider_items']['images'];
    $metas = $data['slider_items']['meta'];
    $id =  'slider-'.uniqid();
    if(isset($data['class'])  && $data['class']!=''){
        $data['class'] = ' '.trim($data['class']);
    }else{
        $data['class'] ='';
    }
    
    if(isset($data['slider_full_with'])  && $data['slider_full_with']==1){
        
    }
    ?>
    <div class="layer-slider-wrapper">
        <div id="<?php echo $id; ?>" class="<?php echo !($is_top_slider) ? 'inside-post-slider ' : ''; ?> flexslider <?php echo $data['class']; ?>">
            <ul class="slides">
                <?php
                foreach($images as $n=> $img_id){
                    $col = array();
                   // $col['img'] = $img_id;
                    $meta  = $metas[$n]; 
                    $attachment=wp_get_attachment_image_src($img_id, $img_size);
                    
                    $item = '<li> %1$s </li>';
                    $img = sprintf('<img src="%1$s" alt="'.esc_attr($meta['title']).'" />',$attachment[0]);
                    if($meta['url']!=''){
                            $img ='<a href="'.$meta['url'].'">'.$img.'</a>';
                    }elseif($lightbox==true){
                    	$full=wp_get_attachment_image_src($img_id, 'full');
                    	$img ='<a class="st-lightbox" href="'.$full[0].'">'.$img.'</a>';
                    }
                    
                    $caption ='';
                  
                  if(isset($settings['show_caption'])  && strtolower($settings['show_caption'])=='no'){
                    
                  }else{
                     if($meta['title']!='' || $meta['caption']!='' ){
                        if($meta['url']!=''){
                            $title ='<h2 class="title"><a href="'.$meta['url'].'">'.esc_html($meta['title']).'</a></h2>';
                        }else{
                             $title = '<h2 class="title">'.esc_html($meta['title']).'</h2>';
                        }
                      if($meta['caption']!=''){
                         $caption = '
                            <div class="caption flex-caption-wrapper">
                                <div class="flex-caption-text">
                                        '.$title.'
                                       <div class="border-underline">border</div>
                                       <div class="introtext">'.esc_html($meta['caption']).'</div>
                                </div>
                            </div>';
                      }
    
                    }
                     
                  }
                   $item = sprintf($item, $img.$caption); 
                   echo  apply_filters('st_slider_item',$item,$img_id,$meta);    
                }
                ?>
            </ul>
        </div><!-- inside-post-slider -->
    </div>
<?php 