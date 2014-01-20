<?php
/**
 * @author Sa Truong - http://www.smooththemes.com
 * @copyright 2012
 */

function st_js_encode_object($l10n){
    foreach ( (array) $l10n as $key => $value ) {
			if ( !is_scalar($value) )
				continue;

			$l10n[$key] = html_entity_decode( (string) $value, ENT_QUOTES, 'UTF-8');
		}
        return  $l10n;
}

/**
 * Custom wp_localize_script;
 */ 
function  st_js_object_var($object_name,$l10n = array()){
     return  " var $object_name = " . json_encode($l10n) . '; ';
}

/**
 * return data type
 */ 
function st_data_type($var,$type='string'){
    switch(strtolower($type)){
        case 'bool': case 'boolean':
            $var = strtolower($var);
            if($var=='n' || $var == '' || $var ===0 || $var==false || $var=='false'){
                return  'false' ;
            }else{
                return 'true';
            }
        break;
        case 'float':
            return floatval($var);
        break;
        case  'array_join':
            return join(',',$var);
        break;
        case 'int':
             return intval($var); 
        break;
        default: 
            return $var; 
    }
    $var;
}

function st_flex_js_settings(){
    $settings =  array(
            'animation'=>'string',
            'animationLoop'=>'bool',
            'animationDuration'=>'int',
            'slideshow'=>'bool',
            'slideshowSpeed'=>'int',
            'animationSpeed'=>'int',
            'pauseOnAction'=>'bool',
            'pauseOnHover'=>'bool', 
            'controlNav'=>'bool',
            'randomize'=>'bool',
            'directionNav'=>'bool'
    );
    $js_options = array();
    foreach($settings as $name => $type){
         $v = st_get_setting('flex_'.$name,'');
         if(isset($v) && !empty($v)){
             $js_options[$name] =  st_data_type($v,$type);
         }
    }
    
    $js_options['nextText'] ='';
    $js_options['prevText'] ='';
    
    return $js_options;
}


function st_base_url_define() {
    $js_options = array();
    $js_options['baseurl'] = get_option('siteurl');
    return $js_options;
}



#-----------------------------------------------------------------
# Enqueue Style
#-----------------------------------------------------------------
if( !function_exists('st_enqueue_styles')){
    function st_enqueue_styles(){
        if(!is_admin()){
   
            //Register styles
            wp_enqueue_style('st_style', 		get_bloginfo( 'stylesheet_url' ),false, ST_VERSION );
            wp_enqueue_style('flexslider', 		st_css('flexslider.css'),false);
            wp_enqueue_style('font-awesome',    st_css('font-awesome.min.css'));
            wp_enqueue_style('font-tello',    st_css('fontello.css'));
            wp_enqueue_style('font-tello-animation',	st_css('animation.css'));
            wp_enqueue_style('genericons',		st_css('genericons.css'));
            wp_enqueue_style('magnific-popup',	st_css('magnific-popup.css'));
            wp_enqueue_style('flexslider',		st_css('flexslider.css'));
            wp_enqueue_style('responsive',		st_css('responsive.css'));
            wp_enqueue_style('supersized',		st_css('supersized.css'));
            wp_enqueue_style('skin',			st_css('skin.css'));
            

        }
    }
}
add_action('wp_print_styles','st_enqueue_styles');

#-----------------------------------------------------------------
# Enqueue Scripts
#-----------------------------------------------------------------
if(!function_exists('st_enqueue_scripts')){
    function st_enqueue_scripts(){
        if(!is_admin()){
        	
            
            wp_enqueue_script("jquery");
            wp_enqueue_script( 'tubular', 				st_js('jquery.tubular.1.0.js'), array('jquery'),'1.0', true);
           
            wp_enqueue_script( 'ddsmoothmenu', 				st_js('ddsmoothmenu.js'), array('jquery'),ST_VERSION, true);

            wp_enqueue_script( 'purl', 						st_js('purl.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script( 'jquery.fitvids', 			st_js('jquery.fitvids.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script( 'jquery.imagesloaded.min', 	st_js('jquery.imagesloaded.min.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script( 'jquery.isotope.min', 		st_js('jquery.isotope.min.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script( 'jquery.magnific-popup', 	st_js('jquery.magnific-popup.min.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script( 'jquery.easing', 			st_js('jquery.easing-1.3.js'), array('jquery'),'1.3', true);
            
            wp_enqueue_script( 'jquery.parallax', 			st_js('jquery.parallax-1.1.3.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script( 'jquery.localscroll', 		st_js('jquery.localscroll-1.2.7-min.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script( 'jquery.scrollTo', 			st_js('jquery.scrollTo-1.4.3.1-min.js'), array('jquery'),ST_VERSION, true);
            
            wp_enqueue_script( 'flexslider', 				st_js('jquery.flexslider.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script( 'scrollorama', 				st_js('jquery.scrollorama.js'), array('jquery'),ST_VERSION, true);

            wp_enqueue_script( 'jquery.nicescroll', 			st_js('jquery.nicescroll.min.js'), array('jquery'),ST_VERSION, true);

            wp_enqueue_script( 'supersized', 				st_js('supersized.3.2.7.min.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script( 'supersized.shutter', 		st_js('supersized.shutter.min.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script( 'supersized.shutter', 		st_js('supersized.shutter.min.js'), array('jquery'),ST_VERSION, true);
            
            wp_enqueue_script( 'shortcodes', 				st_js('shortcodes.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script( 'theone', 					st_js('theone.js'), array('jquery'),ST_VERSION, true);

        	if ( is_singular() && get_option( 'thread_comments' ) ){
        	     	wp_enqueue_script( 'comment-reply' );
        	}
            wp_localize_script( 'jquery', 'FS', st_flex_js_settings() );
            wp_localize_script( 'jquery', 'BASE_URL', st_base_url_define() );
            wp_localize_script('jquery','ajaxurl',admin_url('admin-ajax.php'));
        }
    }
}
add_action('wp_print_scripts','st_enqueue_scripts');

function st_user_custom_style(){
?>
<!-- Browser Specical File-->
<!--[if IE 8]><link href="<?php st_css('ie8.css',true); ?>" rel="stylesheet" type="text/css" /><![endif]-->
<link href="<?php echo ST_THEME_URL .'custom.css'; ?>" rel="stylesheet" type="text/css" />
<?php
}

add_action('wp_head','st_user_custom_style',10);
