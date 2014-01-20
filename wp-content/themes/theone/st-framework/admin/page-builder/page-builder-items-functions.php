<?php
function stpb_icon($name, $value){
?>
<div class="st-select-icon">
    <div class="st-list-icons-wrap">
    	<div class="st-list-icons">

    	</div><!-- /.st-list-icons  -->
    	<div class="clear"></div>
    </div>

    <div class="preview-wrapper">
	    <div class="st-icon-preview">
	    	<?php if(isset($value) && $value!=''){
	    		echo '<i class="'.$value.'"></i>';
	    	} ?>
	    </div>
		<div class="vac">
			<label>Icon Name:</label>
			<input type="text"  class="group-name st-icon-value"  group-name="<?php echo $name;?>" value="<?php echo esc_attr(stripslashes($value)); ?>" />
			<a href="#" class="remove-icon">Remove</a>
		</div>
		<div class="clear"></div>
	</div>

</div>
<?php
}

function stpb_image_upload($name, $value){
	?>
	<div class="pb-box-upload ui-img-w item-gr">
	    <h4><?php _e('Image','smooththemes'); ?></h4>
		<input type="text" value="<?php echo $value;; ?>" group-name="<?php echo $name; ?>" class="group-name pb-input-upload" >
	    <a href="#"  class="pb-upload-button button-secondary"><span></span><?php echo __('Select Image','smooththemes'); ?></a>
	    <a href="#" class="remove_image button-secondary"><span></span><?php echo __('Remove','smooththemes'); ?></a>
	    <div class="clear"></div>
	</div>
	<?php
}


function stpb_input_text($name, $value, $class=''){
	?>
	<input type="text"  class="group-name <?php echo esc_attr($class); ?>" group-name="<?php echo $name ?>" value="<?php echo esc_attr(stripslashes($value)); ?>" />
	<?php
}

function stpb_select($name,$value,$options, $class=""){
?>
<select  group-name="<?php echo $name; ?>"  class="group-name lb-chzn-select <?php echo $class; ?>" >
	<?php
	foreach($options as $k=>$v):
	     $selected="";
	     if($value==$k){
	        $selected = ' selected ="selected" ';
	     }

	     ?>
	     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($v); ?></option>
	<?php endforeach; ?>
</select>
<?php
}


function stpb_select_multiple($name,$value,$options, $class=""){
	if(!is_array($value)){
		$value =  (array) $value;
	}
	?>
<select  group-name="<?php echo $name; ?>" multiple="multiple" class="group-name lb-chzn-select <?php echo $class; ?>" >
	<?php
	foreach($options as $k=>$v):
	     $selected="";
	     if(in_array($k,$value)){
	        $selected = ' selected ="selected" ';
	     }

	     ?>
	     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($v); ?></option>
	<?php endforeach; ?>
</select>
<?php
}

function stpb_textarea($name, $value, $class=''){
	?>
	<textarea rows="10" class="group-name <?php echo esc_attr($class); ?>" group-name="<?php echo $name; ?>" ><?php echo esc_attr($value); ?></textarea>
	<?php
}


function stpb_images($name,$values = array(), $settings = array()){
    $meta_name= $name.'[meta]';
    $uniqid= 'g-'.uniqid();
    ?>
    <div class="box-inner stpb-gallery" >
          <input class="gallery-name"  type="hidden" value="<?php echo $name.'[images][]'; ?>" />
          <input class="gallery-meta-name"  type="hidden" value="<?php echo $meta_name; ?>" />

          <div style="display: none;" class="stpb-gallery-editct">
                     <div class="stpb-meta media-item">
                        <h2><?php  _e('Edit Image','smooththemes');?></h2>
                         <input type="hidden" value="" class="for-img-index">

                          <table class="slidetoggle ">
                            <tbody><tr class="postpb_title">

                    			<th valign="midle" scope="row" class="label">
                                    <label><span class="alignleft"><?php _e('Image','smooththemes'); ?></span></label>
                                </th>
                    			<td class="field image_preview">

                                </td>
                    		</tr>

                            <tr class="postpb_title form-required">

                    			<th valign="top" scope="row" class="label">
                                    <label><span class="alignleft"><?php _e('Title','smooththemes'); ?></span></label>
                                </th>
                    			<td class="field">
                                    <input type="text" value="" class="stpbn-title">
                                </td>
                    		</tr>

                            <tr class="postpb_title form-required">
                    			<th valign="top" scope="row" class="label">
                                    <label><span class="alignleft"><?php _e('Caption','smooththemes'); ?></span></label>
                                </th>
                    			<td class="field">
                                    <textarea class="stpbn-caption"></textarea>
                                </td>
                    		</tr>

                             <tr class="postpb_title form-required">
                    			<th valign="top" scope="row" class="label">
                                    <label><span class="alignleft">URL</span></label>

                                </th>
                    			<td class="field">
                                    <input type="text" value="" class="stpbn-url"><br>
                                    <small><?php _e('Example: http://goole.com','smooththemes'); ?></small>
                                </td>
                    		 </tr>

                    		 <tr class="postpb_title form-required">
                    			<th valign="top" scope="row" class="label">
                                    <label><span class="alignleft">Button label</span></label>

                                </th>
                    			<td class="field">
                                    <input type="text" value="" class="stpbn-btnlabel"><br>

                                </td>
                    		 </tr>


                          </tbody></table>

                          <button class="button-primary g-save-meta"><?php _e('Save','smooththemes'); ?></button>
                          <button onclick=" return false;" class="button-secondary close"><?php _e('Close','smooththemes'); ?></button>
                      </div>
                  </div>


          <div class="stpb-iws">

          <?php
          $ulc= '';
           if(empty($values['images'])){
            $ulc =' no-image';
            $values['images'] = array();
           }
           ?>

          <ul class="stpb-img-items images sortable <?php echo $ulc; ?>">
           <?php


           foreach($values['images'] as $k => $img):
           	$attachment=wp_get_attachment_image_src($img, 'stpb-thumb');
            $meta =  $values['meta'][$k];
           ?>
            <li>
                <div class="imw">
                     <input type="hidden" class="hidden_id" name="<?php echo $name.'[images][]'; ?>" value="<?php echo $img; ?>" />
                     <img class="imgid"  src="<?php echo $attachment[0]; ?>"  />
                     <a href="#" class="stpb_edit stpb_img_tbtn">Edit</a>
                     <a href="#" class="stpb_delete stpb_img_tbtn">Del</a>
                     <input type="hidden" class="gtitle" value="<?php echo esc_html($meta['title']); ?>" />
                     <input type="hidden" class="gcaption" value="<?php echo htmlspecialchars($meta['caption']); ?>" />
                     <input type="hidden" class="gurl" value="<?php echo esc_html($meta['url']); ?>" />
                     <input type="hidden" class="btnlabel" value="<?php echo esc_html($meta['btnlabel']); ?>" />
                </div>
            </li>
           <?php endforeach; ?>

          </ul>
          <div class="clear"></div>
          </div>


         <div class="clear"></div>
         <div class="btn-actions">
            <a href="#" class="add_more_image button-secondary"><span></span><?php  _e('Add image','smooththemes'); ?></a> <a href="#" class="close_ajax_images">Close</a>

            <div class="clear"></div>
         </div>
         <div class="ajax-media-cont"></div>
         <div class="clear"></div>
         </div><!--box-inner-->

    <?php
}


function stpb_ui($function_name,$name='',$values= array(),$supports= array(),$testimonial= false){
    global $post, $pagenow;

    $mata_name = $name . '[meta]';
    $uniqid = 'ui-' . uniqid();

    if (empty($supports)) {
        $supports = array('image', 'content', 'id', 'url');
    }


    foreach ($supports as $k => $v) {
        if (in_array($v, $supports)) {
            $current_support[$v] = true;
        } else {
            $current_support[$v] = false;
        }
    }

    $_title = ($testimonial) ? __('User:', 'smooththemes') : __('Title:', 'smooththemes');
    $_url_title = ($testimonial) ? __('Postion:', 'smooththemes') : __('Url:', 'smooththemes');


    $affter_name = '';
    $ui_name = $affter_name . "[ui_data]";

    $data = $values['ui_data'];

    // echo var_dump(  $values);
    ?>

    <div class="box-inner stpb-ui">

        <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name . '[function]'; ?>" value="<?php echo $function_name; ?>"/>

        <input type="hidden" class="val-only group-name stpb-ui-name" group-name="<?php echo $ui_name; ?>" value="<?php echo $ui_name; ?>"/>

        <ul class="sortable stpb-ui-list">

            <?php
            $n = count($data);
            for ($i = 0; $i < $n; $i++) {
                $v = $data[$i];
                ?>

                <li>

                    <div class="stpb-widget widget closed">
                        <div title="Click to toggle" class="ui-handlediv"><br/></div>
                        <a href="#" class="remove stwrmt button-secondary"><?php _e('Remove', 'smooththemes'); ?></a>

                        <h3 class="stpb-hndle"><?php echo $_title; ?><span><?php echo esc_html($v['title']); ?></span></h3>

                        <div class="inside">

                            <div class="widget-content">

                                <div class="widget-content">
                                    <p><label><?php echo $_title; ?></label>
                                        <input type="text" value="<?php echo esc_attr($v['title']); ?>" class="ui-title"></p>

                                    <?php if ($current_support['image']): ?>
                                        <div class="pb-box-upload ui-img-w"><label><?php _e('Image:', 'smooththemes'); ?></label>
                                            <input type="text" value="<?php echo esc_attr($v['img']); ?>" class="ui-img pb-input-upload">
                                            <a href="#" class="pb-upload-button button-secondary"><span></span><?php echo __('Select Image', 'smooththemes'); ?></a>
                                            <a href="#" class="remove_image button-secondary"><span></span><?php echo __('Remove', 'smooththemes'); ?></a>

                                            <div class="clear"></div>
                                            <?php if ($testimonial): ?>
                                                <p class="desc"><?php _e('Image recommends 30x30 px.', 'smooththemes'); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($current_support['url'] || $testimonial): ?>
                                        <p><label><?php echo $_url_title; ?></label>
                                            <input type="text" value="<?php echo esc_attr($v['url']); ?>" class="ui-url"></p>
                                    <?php endif; ?>


                                    <?php if ($current_support['content']): ?>
                                        <textarea rows="10" class="ui-cont"><?php echo esc_html($v['content']); ?></textarea>
                                        <p><label><input type="checkbox" class="ui-autop" <?php echo $v['autop'] == 1 ? ' checked="checked" ' : ''; ?> value="1"/>&nbsp;Automatically add paragraphs</label></p>
                                        <div class="widget-description"><?php _e('Arbitrary text or HTML', 'smooththemes'); ?></div>
                                    <?php endif; ?>
                                    <?php if ($current_support['id']): ?>
                                        <input type="hidden" class="ui-autoid" value=""/>
                                    <?php endif; ?>
                                </div>

                                <div class="widget-control-actions">
                                    <div class="alignleft">
                                        <a href="#remove" class="remove"><?php _e('Delete', 'smooththemes'); ?></a> |
                                        <a href="#close" class="close"><?php _e('Close', 'smooththemes'); ?></a>
                                    </div>
                                    <br class="clear"/>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /.stpb-widget  -->

                </li>
            <?php }// ?>
        </ul>

        <div class="ui-temp-code" style="display: none;">

            <div class="stpb-widget widget closed">
                <div title="Click to toggle" class="ui-handlediv"><br/></div>
                <a href="#" class="remove stwrmt button-secondary"><?php _e('Remove', 'smooththemes'); ?></a>

                <h3 class="stpb-hndle"><?php echo $_title; ?><span></span></h3>

                <div class="inside">

                    <div class="widget-content">

                        <div class="widget-content">
                            <p><label><?php echo $_title; ?></label>
                                <input type="text" value="" class="ui-title"></p>

                            <?php if ($current_support['image']): ?>
                                <div class="pb-box-upload ui-img-w"><label><?php _e('Image:', 'smooththemes'); ?></label>
                                    <input type="text" value="" class="ui-img pb-input-upload">
                                    <a href="#" class="pb-upload-button button-secondary"><span></span><?php echo __('Select Image', 'smooththemes'); ?></a>
                                    <a href="#" class="remove_image button-secondary"><span></span><?php echo __('Remove', 'smooththemes'); ?></a>

                                    <div class="clear"></div>
                                    <?php if ($testimonial): ?>
                                        <p class="desc"><?php _e('Image recommends 30x30 px.', 'smooththemes'); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($current_support['url'] || $testimonial): ?>
                                <p><label><?php echo $_url_title; ?></label>
                                    <input type="text" value="" class="ui-url"></p>
                            <?php endif; ?>


                            <?php if ($current_support['content']): ?>
                                <textarea rows="10" class="ui-cont"></textarea>
                                <p><label><input type="checkbox" class="ui-autop" value="1"/>&nbsp;<?php _e('Automatically add paragraphs', 'smooththemes'); ?></label></p>
                                <div class="widget-description"><?php _e('Arbitrary text or HTML', 'smooththemes'); ?>    </div>
                            <?php endif; ?>
                            <?php if ($current_support['id']): ?>
                                <input type="hidden" class="ui-autoid" value=""/>
                            <?php endif; ?>
                        </div>

                        <div class="widget-control-actions">
                            <div class="alignleft">
                                <a href="#remove" class="remove"><?php _e('Delete', 'smooththemes'); ?></a> |
                                <a href="#close" class="close"><?php _e('Close', 'smooththemes'); ?></a>
                            </div>
                            <br class="clear"/>
                        </div>

                    </div>

                </div>

            </div>
            <!-- /.stpb-widget  -->


        </div>
        <!-- ui-temp-code -->

        <div class="alignright">
            <input type="button" value="<?php _e('Add More', 'smooththemes'); ?>" class="button-secondary stpb-ui-more"/>
        </div>

    </div><!--box-inner-->
<?php

}



/** ============= START PAGE BUILDER ITEMS FUNCTIONs ================== */



function  stpb_accordion($function_name,$name='',$values= array()){
    ?>
    <h2 class="stpb_title"><?php _e('Accordion','smooththemes'); ?></h2>
    <div class="item-gr">
     <label>
        <h4><?php _e('Title','smooththemes'); ?></h4>
        <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[settings][title]'; ?>" value="<?php echo esc_attr($values['settings']['title']); ?>" />
     </label>
    </div>
    <div class="lb-stdive"></div>
    <?php
    stpb_ui($function_name,$name,$values, array('title','content'));

} /// stpb_ui

function  stpb_toggle($function_name,$name='',$values= array()){
    ?>
    <h2 class="stpb_title"><?php _e('Toggle','smooththemes'); ?></h2>
    <div class="item-gr">
     <label>
        <h4><?php _e('Title','smooththemes'); ?></h4>
        <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[settings][title]'; ?>" value="<?php echo esc_attr($values['settings']['title']); ?>" />
     </label>
    </div>
     <div class="lb-stdive"></div>
    <?php
    stpb_ui($function_name,$name,$values,array('title','content'));

} /// stpb_ui


function  stpb_tabs($function_name,$name='',$values= array()){
    ?>
    <h2 class="stpb_title"><?php _e('Tabs','smooththemes'); ?></h2>
    <div class="item-gr">
     <label>
        <h4><?php _e('Title','smooththemes'); ?></h4>
        <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[settings][title]'; ?>" value="<?php echo esc_attr($values['settings']['title']); ?>" />
     </label>
    </div>
     <div class="lb-stdive"></div>
    <?php
    stpb_ui($function_name,$name,$values,array('title','content'));

} /// stpb_ui



function stpb_text($function_name,$name='',$values= array()){
    ?>
    <h2 class="stpb_title"><?php _e('Text','smooththemes'); ?></h2>
      <div class="box-inner stpb-text" >

            <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />
            <div class="item-gr">
                 <label>
                      <h4><?php _e('Title','smooththemes'); ?></h4>
                    <input type="text"  class="group-name" group-name="<?php echo $affter_name.'[data][title]'; ?>" value="<?php echo esc_attr($values['data']['title']); ?>" />
                 </label>
            </div>


            <div class="lb-stdive"></div>

            <div class="item-gr">
                 <label>
                  <h4><?php _e('Content','smooththemes'); ?></h4>
                  <textarea rows="10" class="group-name" group-name="<?php echo $affter_name.'[data][content]'; ?>" ><?php echo esc_attr($values['data']['content']); ?></textarea>
                 </label>
                 <span class="desc"><?php _e('Arbitrary text or HTML','smooththemes'); ?></span>
            </div>

             <div class="lb-stdive"></div>

           <div class="item-gr">
              <h4><?php _e('Automatically add paragraphs','smooththemes'); ?></h4>
              <input type="checkbox" group-name="<?php echo $affter_name.'[data][autop]'; ?>"  class="group-name lb-ibutton"  <?php echo $values['data']['autop']==1 ?' checked="checked"  ' : ''; ?> value="1" />

          </div>

    </div>
    <?php
}


function stpb_tag_line($function_name,$name='',$values= array()){
    ?>
    <h2 class="stpb_title"><?php _e('Tagline','smooththemes'); ?></h2>
      <div class="box-inner stpb-text" >

            <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />
            <div class="item-gr">
                 <label>
                      <h4><?php _e('Tagline','smooththemes'); ?></h4>
                    <input type="text"  class="group-name" group-name="<?php echo $affter_name.'[data][tag_line]'; ?>" value="<?php echo esc_attr($values['data']['tag_line']); ?>" />
                 </label>
            </div>

    </div>
    <?php
}


function stpb_divider($function_name,$name='',$values= array()){
    ?>
    <h2 class="stpb_title"><?php _e('Divider','smooththemes'); ?></h2>
      <div class="box-inner stpb-text" >

            <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />
            <div class="item-gr">
                 <label>
                      <h4><?php _e('Space top','smooththemes'); ?></h4>
                      <input type="text"  class="group-name" style="width: 40px;" size="4" max="2" group-name="<?php echo $affter_name.'[data][space_top]'; ?>" value="<?php echo esc_attr($values['data']['space_top']) ? esc_attr($values['data']['space_top']) : 0; ?>" /> px
                 </label>
            </div>
            <div class="lb-stdive"></div>
            <div class="item-gr">
                 <label>
                      <h4><?php _e('Space bottom','smooththemes'); ?></h4>
                      <input type="text"  class="group-name" style="width: 40px;" size="4" max="2" group-name="<?php echo $affter_name.'[data][space_bottom]'; ?>" value="<?php echo esc_attr($values['data']['space_bottom']) ? esc_attr($values['data']['space_bottom']) : 0; ?>" /> px
                 </label>
            </div>

    </div>
    <?php
}


function stpb_this_slider($function_name,$name='',$values= array()){
    ?>
    <h2 class="stpb_title"><?php _e('This Slider','smooththemes'); ?></h2>
      <div class="box-inner stpb-text" >

            <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />
            <div class="item-gr">
                 <label>
                      <h4><?php _e('Space top','smooththemes'); ?></h4>
                      <input type="text"  class="group-name" style="width: 40px;" size="4" max="2" group-name="<?php echo $affter_name.'[data][size_slider]'; ?>" value="<?php echo esc_attr($values['data']['size_slider']) ? esc_attr($values['data']['size_slider']) : 0; ?>" /> px
                 </label>
            </div>

    </div>
    <?php
}


function stpb_gallery($function_name,$name='',$values= array(), $settings= array()){
     ?>
    <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />

    <div class="box-inner stpb-gallery">
          <input class="group-name gallery-name val-only"  type="hidden" group-name="<?php echo $affter_name.'[images][]'; ?>" value="<?php echo '[images]'; ?>" />
          <input class="gallery-meta-name group-name val-only"  group-name="<?php echo $affter_name.'[meta]'; ?>" type="hidden" value="" />
          <div class="stpb-gallery-editct" stpbyle="display: none;">
             <div class="stpb-meta media-item">
                <h2><?php _e('Edit Image','smooththemes'); ?></h2>
                 <input type="hidden" class="for-img-index" value=""/>

                  <table class="slidetoggle ">
                    <tr class="postpb_title">

            			<th valign="midle" class="label" scope="row">
                            <label><span class="alignleft"><?php _e('Image','smooththemes'); ?></span></label>
                        </th>
            			<td class="field image_preview">

                        </td>
            		</tr>
                  <?php if($settings['show_title']!='n'): ?>
                    <tr class="postpb_title form-required">
            			<th valign="top" class="label" scope="row">
                            <label><span class="alignleft"><?php _e('Title','smooththemes'); ?></span></label>
                        </th>
            			<td class="field">
                            <input type="text" class="stpbn-title" value="" >
                        </td>
            		</tr>
                    <?php endif; ?>
                    <?php if($settings['show_caption']!='n'): ?>
                    <tr class="postpb_title form-required">
            			<th valign="top" class="label" scope="row">
                            <label><span class="alignleft"><?php _e('Caption','smooththemes'); ?></span></label>
                        </th>
            			<td class="field">
                            <textarea class="stpbn-caption"></textarea>
                        </td>
            		</tr>
                    <?php endif; ?>
                    <?php if($settings['show_url']!='n'): ?>
                     <tr class="postpb_title form-required">
            			<th valign="top" class="label" scope="row">
                            <label><span class="alignleft"><?php _e('URL','smooththemes'); ?></span></label>

                        </th>
            			<td class="field">
                            <input type="text" class="stpbn-url" value=""><br />
                            <small><?php _e('Example: http://goole.com','smooththemes'); ?></small>
                        </td>
            		</tr>
                    <?php endif; ?>

                  </table>

                  <button class="button-primary g-save-meta"><?php _e('Save','smooththemes'); ?></button>
                  <button class="button-secondary close"  onclick=" return false;"><?php _e('Close','smooththemes'); ?></button>
              </div>
          </div><!-- stpb-gallery-editct -->

          <div class="stpb-iws">
          <?php
          $ulc= '';
           if(empty($values['images'])){
            $ulc =' no-image';
            $values['images'] = array();
           }
           ?>
          <ul class="stpb-img-items images sortable <?php echo $ulc; ?>">
           <?php

           foreach($values['images'] as $k => $img):
           	$attachment=wp_get_attachment_image_src($img, 'stpb-thumb');
            $meta =  $values['meta'][$k];
           ?>
            <li>
                <div class="imw stpb-hndle">
                     <input type="hidden" class="group-name" group-name="[images][]" name="<?php echo $name.'[images][]'; ?>" value="<?php echo $img; ?>" />
                     <img class="imgid"  src="<?php echo $attachment[0]; ?>"  width="<?php echo $attachment[1]; ?>" height="<?php echo $attachment[2]; ?>" />
                     <a href="#" class="stpb_edit stpb_img_tbtn">Edit</a>
                     <a href="#" class="stpb_delete stpb_img_tbtn">Del</a>
                     <input type="hidden" class="gtitle" value="<?php echo esc_html($meta['title']); ?>" />
                     <input type="hidden" class="gcaption" value="<?php echo htmlspecialchars($meta['caption']); ?>" />
                     <input type="hidden" class="gurl" value="<?php echo esc_html($meta['url']); ?>" />
                </div>
            </li>
           <?php endforeach; ?>

          </ul>
          <div class="clear"></div>
          </div>

         <div class="clear"></div>
         <div class="btn-actions">
            <a href="#" class="add_more_image button-secondary"><span></span><?php _e('Add image','smooththemes'); ?></a> <a href="#" class="close_ajax_images"><?php _e('Close','smooththemes'); ?></a>

            <div class="clear"></div>
         </div>
         <div class="ajax-media-cont"></div>
         <div class="clear"></div>
         </div><!--box-inner-->

    <?php
   // stpb_gallery($name,$values);
}


function  stpb_image_grid($function_name,$name='',$values= array()){
    ?>
     <h2 class="stpb_title"><?php _e('Images Grid','smooththemes'); ?></h2>

     <div class="item-gr">
     <label>
        <h4><?php _e('Title','smooththemes'); ?></h4>
        <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[settings][title]'; ?>" value="<?php echo esc_attr($values['settings']['title']); ?>" />
     </label>
    </div>

    <?php
    stpb_gallery($function_name,$name,$values);
    if(empty($values['settings']['col'])){
        $values['settings']['col']=4;
    }

    ?>
    <div class="lb-stdive"></div>
    <div class="item-gr">
        <h4><?php _e('How many columns to show ?','smooththemes'); ?></h4>
         <select class="group-name lb-chzn-select " group-name="[settings][col]" >
          <?php for($i=1; $i<=6; $i++){
            // esc_attr($values['settings']['col']);
             if($i<=12){
                if(12%$i!=''){
                    continue;
                }
             }else{
                 if($i%12!=''){
                    continue;
                }
             }

            $selected="";
            if($values['settings']['col']==$i){
                $selected =' selected="selected" ';
            }
             echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';

          } ?>
         </select>
    </div>
    <?php
};


function  stpb_slider($function_name,$name='',$values= array()){
    ?>
     <h2 class="stpb_title"><?php _e('Slider','smooththemes'); ?></h2>

     <div class="item-gr">
     <label>
        <h4><?php _e('Title','smooththemes'); ?></h4>
        <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[title]'; ?>" value="<?php echo esc_attr($values['title']); ?>" />
     </label>
    </div>

    <?php
    stpb_gallery($function_name,$name,$values);
    ?>

    <div class="lb-stdive"></div>
     <?php
     $slider_types =  array(
                            'elasticslideshow'=>'Elastic Slide show',
                            'nivo'=>'Nivo Slider',
                            'flexslider'=>'Flex Slider',
     );

     ?>
     <div class="item-gr">
         <h4><?php _e('Slider Type','smooththemes'); ?></h4>
        <select group-name="<?php echo $affter_name.'[slider_type]'; ?>"  class="group-name lb-chzn-select" >

        <?php
        foreach($slider_types as $k => $a):

             $selected="";
             if($values['slider_type']==$k){
                $selected = ' selected ="selected" ';
             }
              ?>
             <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($a); ?></option>
             <?php endforeach; ?>
        </select>
     </div>
     <?php

};

function  stpb_post_slider($function_name,$name='',$values= array()){

    if(empty($values['data']['show_title'])){

    }
    ?>
    <h2 class="stpb_title"><?php _e('Blog Posts Slider','smooththemes'); ?></h2>
      <div class="box-inner stpb-text" >

            <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />

            <div class="item-gr">
             <label>
                <h4><?php _e('Title','smooththemes'); ?></h4>
                <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[data][title]'; ?>" value="<?php echo esc_attr($values['data']['title']); ?>" />
             </label>
            </div>

             <div class="lb-stdive"></div>

             <div class="item-gr">
               <h4><?php echo _e('Show in Categories','smooththemes'); ?></h4>
                <?php

                if(empty($values['data']['cats']) or !is_array($values['data']['cats'])){
                    $values['data']['cats'] = array();
                }

               // $select = wp_dropdown_categories('show_count=1&orderby=name&echo=0&class=group-name&hierarchical=1&show_option_all='.rawurlencode()));
             //  $select = preg_replace("#<select([^>]*)>#", "<select$1 multiple=\"multiple\" selected-ids=\"".join(',',$values['data']['cats'])."\" group-name=\"{$affter_name}[data][cats][]\">", $select);

               //selected='.join(',',$values['data']['cats']).'&
                $select = wp_dropdown_categories('id=&show_count=1&orderby=name&echo=0&class=group-name++lb-chzn-select&hierarchical=1');
                $select = preg_replace("#<select([^>]*)>#", "<select$1   multiple=\"multiple\" selected-ids=\"".join(',',$values['data']['cats'])."\"  group-name=\"{$affter_name}[data][cats][]\">", $select);
                echo $select;
               //  echo $select;
                ?>

             </div>

              <div class="lb-stdive"></div>

             <?php if(intval($values['data']['numpost'])<=0){
                $values['data']['numpost'] = 4;
             } ?>

             <div class="item-gr">
             <label>
                 <h4><?php _e('Num posts to show','smooththemes'); ?></h4>
                <input type="text"  class="group-name" style="width: 40px;" size="4" max="2" group-name="<?php echo $affter_name.'[data][numpost]'; ?>" value="<?php echo esc_attr($values['data']['numpost']); ?>" />
             </label>
            </div>

             <div class="lb-stdive"></div>

            <div class="item-gr">
             <label>
                 <h4><?php _e('Exclude','smooththemes'); ?></h4>
                <input type="text"  class="group-name"  group-name="<?php echo $affter_name.'[data][exclude]'; ?>" value="<?php echo esc_attr($values['data']['exclude']); ?>" />
             </label>
             <span class="desc"><?php _e('Enter post IDs, separated by commas','smooththemes'); ?></span>
            </div>

             <div class="lb-stdive"></div>
             <?php
             $orderby = array(''=>'Default','title'=>'Title','comment_count'=>'Comment count','rand'=>'Random');
             ?>
             <div class="item-gr">
                 <h4><?php _e('Order by','smooththemes'); ?></h4>
                <select group-name="<?php echo $affter_name.'[data][orderby]'; ?>"  class="group-name lb-chzn-select" >

                <?php foreach($orderby as $k => $a):

                     $selected="";
                     if($values['data']['orderby']==$k){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($a); ?></option>
                     <?php endforeach; ?>

                </select>

             </div>
              <div class="lb-stdive"></div>
             <?php
             $order = array('DESC'=>'Descending ','ASC'=>'Ascending');
             ?>
             <div class="item-gr">
                 <h4><?php _e('Order','smooththemes'); ?></h4>
                <select group-name="<?php echo $affter_name.'[data][order]'; ?>"  class="group-name lb-chzn-select" >

                <?php foreach($order as $k => $a):

                     $selected="";
                     if($values['data']['order']==$k){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($a); ?></option>
                     <?php endforeach; ?>

                </select>
             </div>

    </div>

    <?php

};




function stpb_widget($function_name,$name='',$values= array()){
    global $wp_registered_sidebars;
    ?>
    <h2 class="stpb_title"><?php _e('Widget','smooththemes'); ?></h2>
      <div class="box-inner stpb-text" >

            <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />

            <div class="item-gr">
             <label>
                <h4><?php _e('Title','smooththemes'); ?></h4>
                <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[data][title]'; ?>" value="<?php echo esc_attr($values['data']['title']); ?>" />
             </label>
            </div>
            <div class="lb-stdive"></div>

            <div class="item-gr">

                <h4><?php _e('Choose widget area','smooththemes'); ?></h4>
               <select name=""class="group-name lb-chzn-select" group-name="<?php echo $affter_name.'[data][widget]'; ?>">
                     <?php foreach($wp_registered_sidebars as $sb):

                     $selected="";
                     if($values['data']['widget']==$sb['id']){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($sb['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($sb['name']); ?></option>
                     <?php endforeach; ?>
                 </select>

            </div>
       </div>
    <?php
}


function stpb_service($function_name,$name='',$values= array()){
    ?>
    <h2 class="stpb_title"><?php _e('Service Column','smooththemes'); ?></h2>
       <div class="box-inner stpb-service" >

            <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />

            <div class="item-gr">
                 <label>
                      <h4><?php _e('Title','smooththemes'); ?></h4>
                    <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[data][title]'; ?>" value="<?php echo esc_attr(stripslashes($values['data']['title'])); ?>" />
                 </label>
            </div>

            <div class="lb-stdive"></div>

            <!--  for icon select  -->
            <div class="item-gr">
                <h4><?php _e('Icon','smooththemes'); ?></h4>
                <?php stpb_icon($affter_name.'[data][icon]', $values['data']['icon']);  ?>
            </div>

           <div class="lb-stdive"></div>

            <div class="item-gr">
                 <h4><?php _e('Display mod','smooththemes'); ?></h4>
                 <?php stpb_select($affter_name.'[data][display_mode]',  $values['data']['display_mode'], array(
                 		 'il'=>'Icon left',
                 		 'ic'=>'Icon center'
                 	)); ?>

             </div>

            <div class="lb-stdive"></div>

            <div class="item-gr">
                 <label>
                  <h4><?php _e('Content','smooththemes'); ?></h4>
                  <textarea rows="10" class="group-name" group-name="<?php echo $affter_name.'[data][content]'; ?>" ><?php echo esc_attr(stripcslashes($values['data']['content'])); ?></textarea>
                 </label>
                 <span class="desc"><?php echo __('Arbitrary text or HTML','smooththemes'); ?></span>
            </div>

             <div class="lb-stdive"></div>

             <div class="item-gr">
             <label>
                <h4><?php _e('URL','smooththemes'); ?></h4>
                <input type="text"  class="group-name" group-name="<?php echo $affter_name.'[data][url]'; ?>" value="<?php echo esc_attr($values['data']['url']); ?>" />

             </label>
              <span  class="desc"><?php _e('example','smooththemes'); ?> : http://google.com </span>
            </div>

              <div class="lb-stdive"></div>

               <div class="item-gr">
                  <h4><?php _e('Automatically add paragraphs','smooththemes'); ?></h4>
                  <input type="checkbox" group-name="<?php echo $affter_name.'[data][autop]'; ?>"  class="group-name lb-ibutton"  <?php echo $values['data']['autop']==1 ?' checked="checked"  ' : ''; ?> value="1" />

              </div>


    </div>

    <?php
}





function stpb_alert($function_name,$name='',$values= array()){
    ?>
    <h2 class="stpb_title"><?php _e('Alert','smooththemes'); ?></h2>
      <div class="box-inner stpb-text" >

            <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />

            <div class="item-gr">
             <label>
                <h4><?php _e('Title','smooththemes'); ?></h4>
                <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[data][title]'; ?>" value="<?php echo esc_attr($values['data']['title']); ?>" />
             </label>
            </div>

            <div class="lb-stdive"></div>
            <?php /*
             <div class="pb-box-upload ui-img-w"><label ><strong>Image:</strong></label>
        		<input type="text" value="<?php echo esc_attr($values['data']['img']); ?>" group-name="<?php echo $affter_name.'[data][img]'; ?>" class="group-name pb-input-upload" >
                 <a href="#"  class="pb-upload-button button-secondary"><span></span><?php echo __('Select Image','smooththemes'); ?></a>
                <a href="#" class="remove_image button-secondary"><span></span><?php echo __('Remove','smooththemes'); ?></a>
                <div class="clear"></div>
            </div>
            */ ?>

            <div class="item-gr">

                  <h4><?php _e('Content','smooththemes'); ?></h4>
                  <textarea rows="10" class="group-name" group-name="<?php echo $affter_name.'[data][content]'; ?>" ><?php echo esc_attr($values['data']['content']); ?></textarea>
                 <span><?php echo __('Arbitrary text or HTML','smooththemes'); ?></span>

            </div>

             <div class="lb-stdive"></div>

              <div class="item-gr">
                 <h4><?php _e('Automatically add paragraphs','smooththemes'); ?></h4>
                <input type="checkbox" group-name="<?php echo $affter_name.'[data][autop]'; ?>"  class="group-name lb-ibutton"  <?php echo $values['data']['autop']==1 ?' checked="checked"  ' : ''; ?> value="1" />
                <div class="clear"></div>
              </div>

             <div class="lb-stdive"></div>

             <?php
             $types = array(
                     ''=>__('Notification','smooththemes'),
                     'info'=>__('Info','smooththemes'),
                     'success'=>__('Success','smooththemes'),
                     'error'=>__('Error','smooththemes'),
                   );
             ?>
             <div class="item-gr">
                <h4><?php _e('Alert type','smooththemes') ?></h4>
                <select group-name="<?php echo $affter_name.'[data][alert_type]'; ?>"  class="group-name lb-chzn-select" >

                <?php foreach($types as $k => $a):

                     $selected="";
                     if($values['data']['alert_type']==$k){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($a); ?></option>
                     <?php endforeach; ?>

                </select>

             </div>

    </div>
    <?php
}



function stpb_blog($function_name,$name='',$values= array()){
     $affter_name ='';

    if(empty($values['data']['show_title'])){
      //  $values['data']['show_title'] ='y';
    }
    ?>
    <h2 class="stpb_title"><?php _e('Blog Posts','smooththemes'); ?></h2>
      <div class="box-inner stpb-text" >

            <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />

            <div class="item-gr">
             <label>
                <h4><?php _e('Title','smooththemes'); ?></h4>
                <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[data][title]'; ?>" value="<?php echo esc_attr($values['data']['title']); ?>" />
             </label>
            </div>

             <div class="lb-stdive"></div>


             <div class="item-gr">
               <h4><?php echo _e('Show in Categories','smooththemes'); ?></h4>
                <?php

                if(empty($values['data']['cats']) or !is_array($values['data']['cats'])){
                    $values['data']['cats'] = array();
                }

                $select = wp_dropdown_categories('selected='.join(',',$values['data']['cats']).'&id=&show_count=1&orderby=name&echo=0&class=group-name++lb-chzn-select&hierarchical=1&show_option_all='.rawurlencode(__('All','smooththemes')));
                $select = preg_replace("#<select([^>]*)>#", "<select$1 multiple=\"multiple\" selected-ids=\"".join(',',$values['data']['cats'])."\"  group-name=\"{$affter_name}[data][cats][]\">", $select);
                echo $select;
                ?>


             </div>

              <div class="lb-stdive"></div>

             <?php if(intval($values['data']['numpost'])<=0){
                $values['data']['numpost'] = 4;
             } ?>

             <div class="item-gr">
             <label>
                 <h4><?php _e('Num posts to show','smooththemes'); ?></h4>
                <input type="text"  class="group-name" style="width: 40px;" size="4" max="2" group-name="<?php echo $affter_name.'[data][numpost]'; ?>" value="<?php echo esc_attr($values['data']['numpost']); ?>" />
             </label>
            </div>

            <?php /*
            <div class="lb-stdive"></div>
            <div class="item-gr">
             <label>
                 <h4><?php _e('Exceprt Length (Word)','smooththemes'); ?></h4>
                <input type="text"  class="group-name" style="width: 40px;" size="4" group-name="<?php echo $affter_name.'[data][exceprt_count]'; ?>" value="<?php echo (esc_attr($values['data']['exceprt_count'])) ? esc_attr($values['data']['exceprt_count']) : 70; ?>" />
             </label>
            </div>
           
            
            
            <div class="lb-stdive"></div>
            <div class="item-gr">
                 <h4><?php _e('How many columns to display ?','smooththemes'); ?></h4>
                <select group-name="<?php echo $affter_name.'[data][num_col]'; ?>"  class="group-name lb-chzn-select" >
                
                <?php 
                if($values['data']['num_col']==''){
                    $values['data']['num_col'] = 3;
                }
                foreach( array(1,2,3,4) as $i):
                     
                     $selected="";
                     if($values['data']['num_col']==$i){
                        $selected = ' selected ="selected" ';
                     }
                     
                      ?>
                     <option value="<?php echo esc_attr($i); ?>" <?php echo $selected; ?> ><?php echo esc_html($i); ?></option>
                <?php endforeach; ?>
                </select>
             </div>
             
             
            
            
             <div class="lb-stdive"></div>
             <?php 
             $types = array('1'=>'Type  1 ','2'=>'Type  2');
            
             ?>
             <div class="item-gr">
                 <h4><?php _e('Display Type','smooththemes'); ?></h4>
                <select group-name="<?php echo $affter_name.'[data][display_type]'; ?>"  class="group-name lb-chzn-select" >
                
                <?php foreach($types as $k => $a):
                     
                     $selected="";
                     if($values['data']['display_type']==$k){
                        $selected = ' selected ="selected" ';
                     }
                     
                      ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($a); ?></option>
                     <?php endforeach; ?>
                </select>
             </div>
              
             
             
             <div class="lb-stdive"></div>
             <div class="item-gr">
                
                <h4><?php _e('Show custom title','smooththemes'); ?></h4>
            
                <input type="checkbox"  class="group-name lb-ibutton"  group-name="<?php echo $affter_name.'[data][show_title]'; ?>" <?php echo ($values['data']['show_title']=='y') ? ' checked="checked" ': ''; ?> value="y" />

            </div>
            
            */ ?>

            <div class="lb-stdive"></div>

             <div class="item-gr">
             <label>
                <h4><?php _e('Custom viell all text','smooththemes'); ?></h4>
                <input type="text"  class="group-name" group-name="<?php echo $affter_name.'[data][view_all_text]'; ?>" value="<?php echo esc_attr($values['data']['view_all_text']); ?>" />
             </label>
             </div>
             <div class="item-gr">
             <label>
                <h4><?php _e('Custom view all URL','smooththemes'); ?></h4>
                <input type="text"  class="group-name" group-name="<?php echo $affter_name.'[data][link_view_all]'; ?>" value="<?php echo esc_attr($values['data']['link_view_all']); ?>" />
             </label>
              <p>Note: if this options are set, the option &quot;<b>Show paging</b>&quot; will not effect.</p>
             </div>


            <div class="lb-stdive"></div>

             <div class="item-gr">
                <h4><?php _e('Show paging','smooththemes'); ?></h4>
                <input type="checkbox"  class="group-name lb-ibutton"  group-name="<?php echo $affter_name.'[data][show_paging]'; ?>" <?php echo ($values['data']['show_paging']=='y') ? ' checked="checked" ': ''; ?> value="y" />
            </div>

             <div class="lb-stdive"></div>

            <div class="item-gr">
             <label>
                 <h4><?php _e('Exclude','smooththemes'); ?></h4>
                <input type="text"  class="group-name"  group-name="<?php echo $affter_name.'[data][exclude]'; ?>" value="<?php echo esc_attr($values['data']['exclude']); ?>" />
             </label>
             <span class="desc"><?php _e('Enter post IDs, separated by commas','smooththemes'); ?></span>
            </div>

             <div class="lb-stdive"></div>
             <?php
             $orderby = array(''=>'Default','title'=>'Title','comment_count'=>'Comment count','rand'=>'Random');
             ?>
             <div class="item-gr">
                 <h4><?php _e('Order by','smooththemes'); ?></h4>
                <select group-name="<?php echo $affter_name.'[data][orderby]'; ?>"  class="group-name lb-chzn-select" >

                <?php foreach($orderby as $k => $a):

                     $selected="";
                     if($values['data']['orderby']==$k){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($a); ?></option>
                     <?php endforeach; ?>

                </select>

             </div>
              <div class="lb-stdive"></div>
             <?php
             $order = array('DESC'=>'Descending ','ASC'=>'Ascending');
             ?>
             <div class="item-gr">
                 <h4><?php _e('Order','smooththemes'); ?></h4>
                <select group-name="<?php echo $affter_name.'[data][order]'; ?>"  class="group-name lb-chzn-select" >

                <?php foreach($order as $k => $a):

                     $selected="";
                     if($values['data']['order']==$k){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($a); ?></option>
                     <?php endforeach; ?>

                </select>
             </div>


    </div>
    <?php
}




function stpb_portfolio($function_name,$name='',$values= array()){

     if(empty($values['data']['show_title'])){
      //  $values['data']['show_title'] ='y';
    }
    ?>
    <h2 class="stpb_title"><?php _e('Portfolio','smooththemes'); ?></h2>
      <div class="box-inner stpb-text" >

            <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />

            <div class="item-gr">
             <label>
                <h4><?php _e('Title', 'smooththemes'); ?></h4>
                <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[data][title]'; ?>" value="<?php echo esc_attr($values['data']['title']); ?>" />
             </label>
            </div>

             <div class="lb-stdive"></div>

             <div class="item-gr">
               <h4><?php echo _e('Show in Tags', 'smooththemes'); ?></h4>
                <?php

                if(empty($values['data']['cats']) or !is_array($values['data']['cats'])){
                    $values['data']['cats'] = array();
                }
                $select = wp_dropdown_categories('selected=-99&id=&show_count=1&orderby=name&echo=0&class=group-name++lb-chzn-select&hierarchical=1&taxonomy=portfolio_tag&show_option_all='.rawurlencode(__('All','smooththemes')));
                $select = preg_replace("#<select([^>]*)>#", "<select$1  multiple=\"multiple\" selected-ids=\"".join(',',$values['data']['cats'])."\" group-name=\"{$affter_name}[data][cats][]\">", $select);
                echo $select;
               //  echo $select;
                ?>

             </div>

              <div class="lb-stdive"></div>

             <?php if(intval($values['data']['numpost'])<=0 ){
               // $values['data']['numpost'] = 4;
             } ?>

             <div class="item-gr">
             <label>
                 <h4><?php _e('Number portfolio to show', 'smooththemes'); ?></h4>
                <input type="text"  class="group-name" style="width: 40px;" size="4" max="2" group-name="<?php echo $affter_name.'[data][numpost]'; ?>" value="<?php echo esc_attr($values['data']['numpost']); ?>" />
                <span><?php _e('Leave empty to show all','smooththemes'); ?></span>
             </label>
            </div>

             <div class="lb-stdive"></div>

             <div class="item-gr">
                 <h4><?php _e('Display type ?','smooththemes'); ?></h4>
                 <?php
                 stpb_select($affter_name.'[data][image_size]', $values['data']['image_size'], array(
	                 	'st_p_medium_h' =>'Horizontal',
	                 	'st_p_medium_v' =>'Vertical'
                 	));
                 ?>

             </div>

             <div class="lb-stdive"></div>

             <div class="item-gr">
                 <h4><?php _e('How many columns to display ?','smooththemes'); ?></h4>
                <select group-name="<?php echo $affter_name.'[data][num_col]'; ?>"  class="group-name lb-chzn-select" >

                <?php
                if($values['data']['num_col']==''){
                    $values['data']['num_col'] = 3;
                }
                foreach( array(2,3) as $i):

                     $selected="";
                     if($values['data']['num_col']==$i){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($i); ?>" <?php echo $selected; ?> ><?php echo esc_html($i); ?></option>
                <?php endforeach; ?>
                </select>
             </div>

             <div class="lb-stdive"></div>
             <div class="item-gr">

                <h4><?php _e('Show Filter type','smooththemes'); ?></h4>
                 <select group-name="<?php echo $affter_name.'[data][filter_type]'; ?>"  class="group-name lb-chzn-select" >
                <?php

                $filter_types = array('default'=>__('Default- Filter by tags','smooththemes'),'custom'=>__('Custom view all','smooththemes'));

                foreach($filter_types as $k=> $v):

                     $selected="";
                     if($values['data']['filter_type']==$k){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($v); ?></option>
                     <?php endforeach; ?>
                </select>
                <?php  /* ?>
                 <h4><?php _e('Custom viell all text', 'smooththemes'); ?></h4>
                <input type="text"  class="group-name"  group-name="<?php echo $affter_name.'[data][custom_filter_text]'; ?>" value="<?php echo esc_attr($values['data']['custom_filter_text']); ?>" />
                <br /> <br />
                <h4><?php _e('Custom view all URL', 'smooththemes'); ?></h4>
                <input type="text"  class="group-name"  group-name="<?php echo $affter_name.'[data][custom_filter_url]'; ?>" value="<?php echo esc_attr($values['data']['custom_filter_url']); ?>" />
                */
                ?>
            </div>
             <div class="lb-stdive"></div>

            <div class="item-gr">
             <label>
                 <h4><?php _e('Exclude', 'smooththemes'); ?></h4>
                <input type="text"  class="group-name"  group-name="<?php echo $affter_name.'[data][exclude]'; ?>" value="<?php echo esc_attr($values['data']['exclude']); ?>" />
             </label>
             <span class="desc"><?php _e('Enter post IDs, separated by commas','smooththemes'); ?></span>
            </div>

             <div class="lb-stdive"></div>
             <?php
             $orderby = array(''=>'Default','title'=>'Title','comment_count'=>'Comment count','rand'=>'Random');
             ?>
             <div class="item-gr">
                 <h4><?php _e('Order by','smooththemes'); ?></h4>
                <select group-name="<?php echo $affter_name.'[data][orderby]'; ?>"  class="group-name lb-chzn-select" >

                <?php foreach($orderby as $k => $a):

                     $selected="";
                     if($values['data']['orderby']==$k){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($a); ?></option>
                     <?php endforeach; ?>

                </select>

             </div>
              <div class="lb-stdive"></div>
             <?php
             $order = array('DESC'=>'Descending ','ASC'=>'Ascending');
             ?>
             <div class="item-gr">
                 <h4><?php _e('Order','smooththemes'); ?></h4>
                <select group-name="<?php echo $affter_name.'[data][order]'; ?>"  class="group-name lb-chzn-select" >
                <?php foreach($order as $k => $a):
                     $selected="";
                     if($values['data']['order']==$k){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($a); ?></option>
                     <?php endforeach; ?>

                </select>
             </div>

    </div>
    <?php
}



function  stpb_this_entry($function_name,$name='',$values= array()){
    ?>
     <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />
    <?php
}



function  stpb_clients($function_name,$name='',$values= array()){
    ?>
    <h2 class="stpb_title"><?php _e('Clients','smooththemes'); ?></h2>
    <div class="item-gr">
     <label>
        <h4><?php _e('Title','smooththemes'); ?></h4>
        <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[settings][title]'; ?>" value="<?php echo esc_attr($values['settings']['title']); ?>" />
     </label>

    </div>
     <div class="lb-stdive"></div>
    <?php
    stpb_ui($function_name,$name,$values,array('title','image','url'));
    ?>


    <?php
     $targets = array('_self'=>'Open in current window','_blank'=>'Open in a new window ');
     ?>


     <div class="item-gr">
         <h4><?php _e('How manay items per column ?','smooththemes'); ?></h4>
        <select group-name="<?php echo $affter_name.'[settings][num_col]'; ?>"  class="group-name lb-chzn-select" >

        <?php
         if(!isset($values['settings']['num_col']) || empty($values['settings']['num_col'])){
            $values['settings']['num_col'] =4;
         }
         for( $i = 1 ; $i<=12; $i++):
             $selected="";
             if($values['settings']['num_col']==$i){
                $selected = ' selected ="selected" ';
             }
              ?>
             <option value="<?php echo esc_attr($i); ?>" <?php echo $selected; ?> ><?php echo esc_html($i); ?></option>
             <?php endfor; ?>

        </select>
     </div>
     <div class="lb-stdive"></div>
     <div class="item-gr">
         <h4><?php _e('Link target','smooththemes'); ?></h4>
        <select group-name="<?php echo $affter_name.'[settings][target]'; ?>"  class="group-name lb-chzn-select" >

        <?php foreach($targets as $k => $a):
             $selected="";
             if($values['settings']['target']==$k){
                $selected = ' selected ="selected" ';
             }
              ?>
             <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($a); ?></option>
             <?php endforeach; ?>

        </select>
     </div>
    <?php
} /// stpb_ui



function  stpb_testimonials($function_name,$name='',$values= array()){
    ?>
    <h2 class="stpb_title"><?php _e('Testimonials','smooththemes'); ?></h2>
    <div class="item-gr">
     <label>
        <h4><?php _e('Title','smooththemes'); ?></h4>
        <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[settings][title]'; ?>" value="<?php echo esc_attr($values['settings']['title']); ?>" />
     </label>
    </div>
     <div class="lb-stdive"></div>
    <?php
    stpb_ui($function_name,$name,$values,array('title','image','url','content'),true);

} /// stpb_ui




function stpb_post_gallery($function_name,$name='',$values= array()){

    ?>
    <h2 class="stpb_title"><?php _e('Gallery','smooththemes'); ?></h2>
      <div class="box-inner stpb-text" >

            <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />

            <div class="item-gr">
             <label>
                <h4><?php _e('Title', 'smooththemes'); ?></h4>
                <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[data][title]'; ?>" value="<?php echo esc_attr($values['data']['title']); ?>" />
             </label>
            </div>

             <div class="lb-stdive"></div>

             <div class="item-gr">
               <h4><?php echo _e('Show in Tags', 'smooththemes'); ?></h4>
                <?php

                if(empty($values['data']['cats']) or !is_array($values['data']['cats'])){
                    $values['data']['cats'] = array();
                }
                $select = wp_dropdown_categories('selected=-99&id=&show_count=1&orderby=name&echo=0&class=group-name++lb-chzn-select&hierarchical=1&taxonomy=gallery_tag');
                $select = preg_replace("#<select([^>]*)>#", "<select$1  multiple=\"multiple\" selected-ids=\"".join(',',$values['data']['cats'])."\" group-name=\"{$affter_name}[data][cats][]\">", $select);
                echo $select;
               //  echo $select;
                ?>


             </div>

              <div class="lb-stdive"></div>

             <?php if(intval($values['data']['numpost'])<=0 ){
               // $values['data']['numpost'] = 4;
             } ?>

             <div class="item-gr">
             <label>
                 <h4><?php _e('Num galleries to show', 'smooththemes'); ?></h4>
                <input type="text"  class="group-name" style="width: 40px;" size="4" max="2" group-name="<?php echo $affter_name.'[data][numpost]'; ?>" value="<?php echo esc_attr($values['data']['numpost']); ?>" />
                <span><?php _e('Leave empty to show all','smooththemes'); ?></span>
             </label>
            </div>

             <div class="lb-stdive"></div>

             <div class="item-gr">
                 <h4><?php _e('How many columns to display ?','smooththemes'); ?></h4>
                <select group-name="<?php echo $affter_name.'[data][num_col]'; ?>"  class="group-name lb-chzn-select" >

                <?php
                if($values['data']['num_col']==''){
                    $values['data']['num_col'] = 3;
                }
                foreach( array(2,3) as $i):

                     $selected="";
                     if($values['data']['num_col']==$i){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($i); ?>" <?php echo $selected; ?> ><?php echo esc_html($i); ?></option>
                <?php endforeach; ?>
                </select>
             </div>
              <div class="lb-stdive"></div>
             <div class="item-gr">

                <h4><?php _e('Show Filter type','smooththemes'); ?></h4>
                 <select group-name="<?php echo $affter_name.'[data][filter_type]'; ?>"  class="group-name lb-chzn-select" >
                <?php

                $filter_types = array('default'=>__('Default- Filter by tags','smooththemes'),'custom'=>__('Custom view all','smooththemes'));

                foreach($filter_types as $k=> $v):

                     $selected="";
                     if($values['data']['filter_type']==$k){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($v); ?></option>
                     <?php endforeach; ?>
                </select>

                 <h4><?php _e('Custom view all text', 'smooththemes'); ?></h4>
                <input type="text"  class="group-name"  group-name="<?php echo $affter_name.'[data][custom_filter_text]'; ?>" value="<?php echo esc_attr($values['data']['custom_filter_text']); ?>" />
                <br /> <br />
                <h4><?php _e('Custom view all URL', 'smooththemes'); ?></h4>
                <input type="text"  class="group-name"  group-name="<?php echo $affter_name.'[data][custom_filter_url]'; ?>" value="<?php echo esc_attr($values['data']['custom_filter_url']); ?>" />



            </div>
             <div class="lb-stdive"></div>

            <div class="item-gr">
             <label>
                 <h4><?php _e('Exclude', 'smooththemes'); ?></h4>
                <input type="text"  class="group-name"  group-name="<?php echo $affter_name.'[data][exclude]'; ?>" value="<?php echo esc_attr($values['data']['exclude']); ?>" />
             </label>
             <span class="desc"><?php _e('Enter gallery IDs, separated by commas','smooththemes'); ?></span>
            </div>

             <div class="lb-stdive"></div>
             <?php
             $orderby = array(''=>'Default','title'=>'Title','comment_count'=>'Comment count','rand'=>'Random');
             ?>
             <div class="item-gr">
                 <h4><?php _e('Order by','smooththemes'); ?></h4>
                <select group-name="<?php echo $affter_name.'[data][orderby]'; ?>"  class="group-name lb-chzn-select" >

                <?php foreach($orderby as $k => $a):

                     $selected="";
                     if($values['data']['orderby']==$k){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($a); ?></option>
                     <?php endforeach; ?>

                </select>

             </div>
              <div class="lb-stdive"></div>
             <?php
             $order = array('DESC'=>'Descending ','ASC'=>'Ascending');
             ?>
             <div class="item-gr">
                 <h4><?php _e('Order','smooththemes'); ?></h4>
                <select group-name="<?php echo $affter_name.'[data][order]'; ?>"  class="group-name lb-chzn-select" >
                <?php foreach($order as $k => $a):
                     $selected="";
                     if($values['data']['order']==$k){
                        $selected = ' selected ="selected" ';
                     }

                      ?>
                     <option value="<?php echo esc_attr($k); ?>" <?php echo $selected; ?> ><?php echo esc_html($a); ?></option>
                     <?php endforeach; ?>

                </select>
             </div>

    </div>
    <?php
}

function stpb_teammember($function_name,$name='',$values= array()) {
    ?>
    <h2 class="stpb_title"><?php _e('Team Member','smooththemes'); ?></h2>
    <input type="hidden" class="group-name func_name" group-name="<?php echo $affter_name.'[function]'; ?>"  value="<?php echo $function_name; ?>" />
    <div class="item-gr">
        <label>
            <h4><?php _e('Name','smooththemes'); ?></h4>
            <input type="text"  class="group-name" group-name="<?php echo $affter_name.'[data][name]'; ?>" value="<?php echo esc_attr($values['data']['name']); ?>" />
        </label>       
    </div>
    <div class="lb-stdive"></div>
   <div class="pb-box-upload ui-img-w"><label><h4><?php _e('Image:', 'smooththemes'); ?></h4></label>
        <input type="text" group-name="<?php echo $affter_name.'[data][img]'; ?>" value="<?php echo esc_attr($values['data']['img']); ?>" class="ui-img pb-input-upload group-name">
        <a href="#" class="pb-upload-button button-secondary"><span></span><?php echo __('Select Image', 'smooththemes'); ?></a>
        <a href="#" class="remove_image button-secondary"><span></span><?php echo __('Remove', 'smooththemes'); ?></a>
        <div class="clear"></div>
    </div>
    <div class="lb-stdive"></div>
    <div class="item-gr">
        <label>
            <h4><?php _e('Position','smooththemes'); ?></h4>
            <input type="text"  class="group-name" group-name="<?php echo $affter_name.'[data][position]'; ?>" value="<?php echo esc_attr($values['data']['position']); ?>" />
        </label> 
     </div>
     <div class="lb-stdive"></div>
    <div class="item-gr">
        <label>
            <h4><?php _e('Description','smooththemes'); ?></h4>
            <textarea rows="10" class="group-name" group-name="<?php echo $affter_name.'[data][description]'; ?>"><?php echo esc_attr($values['data']['description']); ?></textarea>
        </label> 
     </div>
    <?php
}



function  stpb_table_price($function_name,$name='',$values= array()){
	if(empty($values)){
		$values['data']['button_label'] =__('More details+ <i class="icon-plus"></i></a>','smooththemes');
	}

	?>
    <h2 class="stpb_title"><?php _e('Table Price','smooththemes'); ?></h2>

    <div class="item-gr">
     <label>
        <h4><?php _e('Title','smooththemes'); ?></h4>
        <input type="text"  class="group-name bigtitle" group-name="<?php echo $affter_name.'[data][title]'; ?>" value="<?php echo esc_attr($values['data']['title']); ?>" />
     </label>
    </div>

     <div class="lb-stdive"></div>

     <div class="item-gr">
          <h4><?php _e('Price','smooththemes'); ?></h4>
          <?php stpb_input_text($affter_name.'[data][price]', $values['data']['price']) ?>
     </div>


     <div class="item-gr">
          <h4><?php _e('Price detail','smooththemes'); ?></h4>
          <?php stpb_input_text($affter_name.'[data][price_detail]', $values['data']['price_detail']) ?>

     </div>

     <div class="lb-stdive"></div>

     <div class="item-gr">
          <h4><?php _e('Button label','smooththemes'); ?></h4>
          <?php stpb_input_text($affter_name.'[data][button_label]', $values['data']['button_label']) ?>
          <span  class="desc"><?php _e('Default','smooththemes'); ?> : <?php echo __('More details+','smooththemes'); ?></span>
     </div>

     <div class="item-gr">
          <h4><?php _e('Button Link','smooththemes'); ?></h4>
          <?php stpb_input_text($affter_name.'[data][button_link]', $values['data']['button_link']) ?>
     </div>


     <div class="lb-stdive"></div>
     <h4><?php _e('Features','smooththemes'); ?></h4>

    <?php
    stpb_ui($function_name,$name,$values,array('title'));
    ?>
    <br/>
     <br/>

    <div class="lb-stdive"></div>

	 <div class="item-gr">
	    <h4><?php _e('Is Active','smooththemes'); ?></h4>
	    <input type="checkbox"  class="group-name lb-ibutton"  group-name="<?php echo $affter_name.'[data][is_active]'; ?>" <?php echo ($values['data']['is_active']=='y') ? ' checked="checked" ': ''; ?> value="y" />
	</div>


    <div class="lb-stdive"></div>
    <h4><?php _e('Link target','smooththemes'); ?></h4>
    <?php
	    stpb_select($affter_name.'[data][link_target]', $values['data']['link_target'],
		     array(
		     	'_blank'=>'_blank',
		     	'_self'=>'_self'
		     )
	      );
     ?>

    <?php
} /// stpb_ui









