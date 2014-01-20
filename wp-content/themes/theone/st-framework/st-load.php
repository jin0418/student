<?php
/** 
     WARNING : BE CAREFUL WHEN YOU CHANGE THIS FILE.
*/
#-----------------------------------------------------------------
# Default theme variables and information
#-----------------------------------------------------------------

$themeInfo            =  wp_get_theme() ; // get_theme_data(TEMPLATEPATH . '/style.css');
$themeName            = trim($themeInfo['Title']);
$themeAuthor          = trim($themeInfo['Author']);
$themeAuthor_URI      = trim($themeInfo['AuthorURI']);
$themeVersion         = trim($themeInfo['Version']);
$themeShortname       = sanitize_title($themeName . '_');
$frameworkVersion     = trim($themeInfo['Framework Version']);

#-----------------------------------------------------------------
# Shortcut variables
#-----------------------------------------------------------------

#-----------------------------------------------------------------
# Define variables
#-----------------------------------------------------------------
add_theme_support( 'post-thumbnails', array('post','portfolio') ); 
add_theme_support( 'automatic-feed-links' );

add_image_size( 'st_small_thumb', 50, 50, true ); // Small thumb // 306x160
add_image_size( 'st_medium', 640, 300, true );
add_image_size( 'st_blog_thumb', 474, 170, true );

add_image_size( 'st_p_medium_h', 480, 307, true ); // for portfolio horizontal
add_image_size( 'st_p_medium_v', 480, 550, true ); // for portfolio vertical
add_image_size( 'st_p_large', 750, 570, true );

add_image_size( 'st_large', 978, 470, true );  

define('ST_NAME','theone');    // $themeName                     // The theme title
define('ST_THEME_NAME',$themeName);
define('ST_AUTHOR',$themeAuthor);                    // The theme Author
define('ST_AUTHOR_URL',$themeAuthor_URI);            // Author URL
define('ST_VERSION',$themeVersion);                  // Theme version number
define('ST_THEME_URL',trailingslashit(get_bloginfo('template_url') ) );   
define('ST_THEME_DIR',get_template_directory() );
define('ST_URL',ST_THEME_URL.'st-framework/' );                         
define('ST_DIR',ST_THEME_DIR.'/st-framework' ); 			// Theme directory
define('ST_ADMIN_DIR',ST_DIR . '/admin/');
define('ST_LIB_DIR',ST_DIR .'/lib/');
define('ST_SETTINS_DIR',ST_DIR .'/settings/');
// for theme templates
define('ST_TEMPLATE_DIR',ST_THEME_DIR.'/templates/');
// Define THEME_INFO which will output at wp_footer();
define('THEME_INFO',ST_NAME.' Design by '.ST_AUTHOR_URL.' Vesion '.ST_VERSION);
define('ST_SETTINGS_OPTION',ST_NAME);	 // Theme Option Name ( Will be user when update_option() is called )
define('ST_TRANSLATE_OPTION',ST_NAME.'_trans');


#-----------------------------------------------------------------
# Load SMOOTHTHEMES_FRAMEWORK and define global $st_options
#-----------------------------------------------------------------
#-----------------------------------------------------------------
# Load Translation File
#-----------------------------------------------------------------
//global $locale; $locale = 'es_ES';
//$locale = get_locale();
load_theme_textdomain( 'smooththemes', ST_THEME_DIR . '/languages' );
/**
 *  @true  if WPML installed.
 */ 
function  st_is_wpml(){
    return function_exists('icl_get_languages');
}

/**  === DO NOT CHANGE === */


global $st_options ; // for Settings
       
       
  /**
   *  load options 
   * @return array();  
   */   
function __st_get_options(){
        if(st_is_wpml()){
             $st_same_settings = get_option('st_same_lang_settings','y');
            // reload  options for current language
             if($st_same_settings=='y'){
                $st_options = get_option(ST_SETTINGS_OPTION,array()); 
             }else{
                $st_options = get_option(ST_SETTINGS_OPTION.'_'.ICL_LANGUAGE_CODE,array()); 
                if(empty($st_options)){
                     $st_options = get_option(ST_SETTINGS_OPTION,array());  // default value
                }
             }

        }else{
             // default settings
            $st_options = get_option(ST_SETTINGS_OPTION);
        }
        
     // if is priview  and user can edit theme options
      if(isset($_POST['wp_customize']) && $_POST['wp_customize']=='on'  &&  current_user_can( 'edit_theme_options' )){
            $st_options = __st_preview_options($st_options, $_POST['customized']);
      }
      return  $st_options;
     
}   
 
function st_stripslashes($array){
    if(empty($array)){
        return  ;
    }
    
    if(!is_array($array)){
        return stripcslashes($array);
    }
    
    $tpl=  array();
    foreach($array as $k=> $v){
        if(is_string($v)){
             $tpl[stripslashes($k)] = stripcslashes($v);
        }elseif(is_array($v)){
            $tpl[stripslashes($k)] = st_stripslashes($v);
        }
       
    }
    return  $tpl;
}


/**
 * merge admin settings with preview settings
 * @return array
 */ 
function __st_preview_options($options, $preview_options){
    
    $preview_options   = (array) json_decode(stripslashes($preview_options));
    if(is_array($preview_options)){
         
        foreach($preview_options as $k => $v){
             $options[$k] = $v;
        }
       
    }
    return $options;
}


/**
 *  get settings and translate options.
 */ 
$st_options   = __st_get_options();

include_once(ST_LIB_DIR.'st-filters.php');
require_once(ST_LIB_DIR.'lib-functions.php');
// load other settings
require_once(ST_SETTINS_DIR.'post-type.php');
require_once(ST_SETTINS_DIR.'sidebars.php');
require_once(ST_SETTINS_DIR.'nav-menus.php');
require_once(ST_SETTINS_DIR.'js-and-css.php');
require_once(ST_SETTINS_DIR.'taxonomies.php');
require_once(ST_ADMIN_DIR.'admin-int.php');
require_once(ST_DIR.'/translate/translate.php');

if( is_file(ST_LIB_DIR.'/sliders-functions.php')){
    require_once(ST_LIB_DIR.'/sliders-functions.php');
}

// load widget 
require_once(ST_DIR .'/lib/widgets/recent-posts.php');
require_once(ST_DIR .'/lib/widgets/recent-comments.php');
require_once(ST_DIR .'/lib/widgets/flickr.php');
require_once(ST_DIR .'/lib/widgets/ads-125.php');

if( is_file(ST_DIR.'/lib/template-functions.php')){
    require_once(ST_DIR.'/lib/template-functions.php');
}

require_once(ST_LIB_DIR.'shortcode.php');
// load ajax
require_once(ST_LIB_DIR.'st-ajax.php');
// defbug screen
if(defined('ST_DEBUG') && ST_DEBUG===true){
    if(is_file(ST_LIB_DIR.'debug.php')){
        include_once ST_LIB_DIR.'debug.php';
    }
}

/*   Include Theme Plugins    */
require_once(ST_LIB_DIR.'st-active-theme.php');
require_once(ST_DIR.'/css/css.php');

/*   Include Theme Plugins    */
require_once(ST_LIB_DIR.'st-install-plugins.php');



