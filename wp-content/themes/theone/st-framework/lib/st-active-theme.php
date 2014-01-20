<?php
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
      // your code here
      st_theme_activate();
}

function st_theme_activate() {
   // update_option(ST_SETTINGS_OPTION,$options);
    st_update_default_settings(true);
    ob_start();
  //  header('Location: '.admin_url('admin.php?page='.ST_PAGE_SLUG));
}



/**
 * Update to default settings
 */ 
function  st_update_default_settings($check  = false){
    $option_name = '_'.ST_NAME.'_is_import_default';
    
    if($check === true){
        if(get_option($option_name)=='y'){
              return false;
        }
    }
    
    // default setting options    
    $default ='a:63:{s:9:"site_mode";s:1:"f";s:16:"site_header_mode";s:1:"f";s:20:"site_header_floating";s:1:"y";s:6:"layout";s:1:"2";s:18:"show_footer_widget";s:1:"y";s:9:"site_logo";s:71:"http://localhost/theone/wp-content/themes/theone/assets/images/logo.png";s:12:"site_favicon";s:0:"";s:9:"body_font";a:8:{s:9:"font-size";s:2:"14";s:14:"font-size-unit";s:2:"px";s:11:"line-height";s:2:"22";s:16:"line-height-unit";s:2:"px";s:5:"color";s:6:"555555";s:11:"font-family";s:92:"http://fonts.googleapis.com/css?family=Gudea:regular%2Citalic%2C700&subset=latin%2Clatin-ext";s:10:"font-style";s:6:"normal";s:11:"font-weight";s:6:"normal";}s:15:"page_title_font";a:1:{s:11:"font-family";s:145:"http://fonts.googleapis.com/css?family=Lato:100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic&subset=latin";}s:13:"headings_font";a:2:{s:5:"color";s:6:"000000";s:11:"font-family";s:92:"http://fonts.googleapis.com/css?family=Gudea:regular%2Citalic%2C700&subset=latin%2Clatin-ext";}s:9:"heading_1";a:2:{s:9:"font-size";s:2:"38";s:14:"font-size-unit";s:2:"px";}s:9:"heading_2";a:2:{s:9:"font-size";s:2:"34";s:14:"font-size-unit";s:2:"px";}s:9:"heading_3";a:2:{s:9:"font-size";s:2:"26";s:14:"font-size-unit";s:2:"px";}s:9:"heading_4";a:2:{s:9:"font-size";s:2:"20";s:14:"font-size-unit";s:2:"px";}s:9:"heading_5";a:2:{s:9:"font-size";s:2:"16";s:14:"font-size-unit";s:2:"px";}s:9:"heading_6";a:2:{s:9:"font-size";s:2:"12";s:14:"font-size-unit";s:2:"px";}s:12:"skin_primary";s:6:"00A6D5";s:9:"skin_link";s:6:"757575";s:15:"skin_link_hover";s:6:"00A6D5";s:11:"skin_header";s:6:"000000";s:16:"skin_header_link";s:6:"757575";s:22:"skin_header_link_hover";s:6:"FFFFFF";s:7:"bg_type";s:6:"custom";s:10:"defined_bg";s:12:"pattern4.png";s:8:"bg_color";s:6:"f5f5f5";s:6:"bg_img";s:0:"";s:10:"bg_positon";s:0:"";s:10:"bg_repreat";s:0:"";s:8:"bg_fixed";s:0:"";s:13:"blog_toptitle";s:8:"Our Blog";s:12:"blog_tagline";s:38:"This is what we\'ve been doing so far.";s:14:"list_posts_url";s:43:"http://localhost/theone/wordpress/#our-blog";s:19:"s_show_featured_img";s:1:"y";s:16:"s_show_post_meta";s:1:"y";s:15:"s_show_post_tag";s:1:"y";s:19:"s_show_about_author";s:1:"y";s:15:"s_show_comments";s:1:"y";s:12:"s_show_share";s:1:"y";s:12:"p_desc_align";s:1:"r";s:15:"p_show_relative";s:1:"y";s:17:"p_numcol_relative";s:1:"3";s:18:"p_numitem_relative";s:1:"3";s:11:"p_list_page";s:30:"http://localhost/theone/works/";s:17:"p_numcol_view_all";s:1:"3";s:11:"footer_left";s:138:"Copyright  2013 All Rights Reserved. Powered by WordPress and <a href=\"http://www.smooththemes.com\" class=\"copyright\">SmoothThemes</a>";s:12:"footer_right";s:103:"<h3 class=\"widgettitle\">Stay Connected</h3><div class=\"textwidget\">[st_social size=\"16x16\"]</div>";s:14:"post_portfolio";s:0:"";s:14:"flex_animation";s:4:"fade";s:17:"flex_directionNav";s:1:"y";s:18:"flex_animationLoop";s:1:"y";s:14:"flex_slideshow";s:1:"y";s:19:"flex_slideshowSpeed";s:4:"7000";s:22:"flex_animationDuration";s:4:"7000";s:19:"flex_animationSpeed";s:4:"6000";s:17:"flex_pauseOnHover";s:1:"y";s:15:"flex_controlNav";s:1:"y";s:14:"flex_randomize";s:1:"n";s:12:"fsc_autoplay";s:1:"y";s:13:"fsc_slideshow";s:1:"y";s:12:"fsc_interval";s:4:"6000";s:20:"fsc_transition_speed";s:3:"800";s:21:"headder_tracking_code";s:0:"";s:20:"footer_tracking_code";s:0:"";}';
    $translate  = 'YTo2NTp7czo2OToiVGhpcyBwb3N0IGlzIHBhc3N3b3JkIHByb3RlY3RlZC4gRW50ZXIgdGhlIHBhc3N3b3JkIHRvIHZpZXcgY29tbWVudHMuIjtzOjA6IiI7czoxMjoiTm8gUmVzcG9uc2VzIjtzOjA6IiI7czoxMjoiT25lIFJlc3BvbnNlIjtzOjA6IiI7czoxMToiJSBSZXNwb25zZXMiO3M6MDoiIjtzOjE0OiJPbGRlciBDb21tZW50cyI7czowOiIiO3M6MTQ6Ik5ld2VyIENvbW1lbnRzIjtzOjA6IiI7czoyOiJ0byI7czowOiIiO3M6MjA6IkNvbW1lbnRzIGFyZSBjbG9zZWQuIjtzOjA6IiI7czoxOToiTGVhdmUgYSBSZXBseSB0byAlcyI7czowOiIiO3M6MTE6IllvdSBtdXN0IGJlIjtzOjA6IiI7czoxODoidG8gcG9zdCBhIGNvbW1lbnQuIjtzOjA6IiI7czoyOToiUmVxdWlyZWQgZmllbGRzIGFyZSBtYXJrZWQgJXMiO3M6MDoiIjtzOjEzOiJMZWF2ZSBhIFJlcGx5IjtzOjA6IiI7czoxMjoiQ2FuY2VsIFJlcGx5IjtzOjA6IiI7czoxMjoiUG9zdCBDb21tZW50IjtzOjA6IiI7czo3OiJDb21tZW50IjtzOjA6IiI7czo1NzoiWW91IG11c3QgYmUgPGEgaHJlZj0iJXMiPmxvZ2dlZCBpbjwvYT4gdG8gcG9zdCBhIGNvbW1lbnQuIjtzOjA6IiI7czo0MToiWW91ciBlbWFpbCBhZGRyZXNzIHdpbGwgbm90IGJlIHB1Ymxpc2hlZC4iO3M6MDoiIjtzOjQ6Ik5hbWUiO3M6MDoiIjtzOjU6IkVtYWlsIjtzOjA6IiI7czo3OiJXZWJzaXRlIjtzOjA6IiI7czo2OiJTZWFyY2giO3M6MDoiIjtzOjc6IlBhZ2UgJXMiO3M6MDoiIjtzOjE1OiJQZXJtYWxpbmsgdG8gJXMiO3M6MDoiIjtzOjEyOiJPcGVuIEdhbGxlcnkiO3M6MDoiIjtzOjM6IkFsbCI7czowOiIiO3M6Mjoiw5ciO3M6MDoiIjtzOjE0OiJUb3RhbCAlcyBwaG90byI7czowOiIiO3M6MTU6IlRvdGFsICVzIHBob3RvcyI7czowOiIiO3M6MzoiLi4uIjtzOjA6IiI7czo2OiJGIGQsIFkiO3M6MDoiIjtzOjI6ImF0IjtzOjA6IiI7czo1OiJnOmkgYSI7czowOiIiO3M6MzoiIC0gIjtzOjA6IiI7czo5OiIwIENvbW1lbnQiO3M6MDoiIjtzOjk6IjEgQ29tbWVudCI7czowOiIiO3M6MTA6IiUgQ29tbWVudHMiO3M6MDoiIjtpOjQwNDtzOjA6IiI7czoyNDoiR28gYmFjayB0byBwcmV2aW91cyBwYWdlIjtzOjA6IiI7czoxNDoiR28gdG8gaG9tZXBhZ2UiO3M6MDoiIjtzOjE1OiJQcm9qZWN0IERldGFpbHMiO3M6MDoiIjtzOjg6IkNsaWVudDogIjtzOjA6IiI7czo2OiJEYXRlOiAiO3M6MDoiIjtzOjY6IlRhZ3M6ICI7czowOiIiO3M6ODoiU2tpbGxzOiAiO3M6MDoiIjtzOjEzOiJQcm9qZWN0IFVybDogIjtzOjA6IiI7czoyMDoiUHJvamVjdCBEZWNzY3JpcHRpb24iO3M6MDoiIjtzOjE2OiJSZWxhdGVkIFByb2plY3RzIjtzOjA6IiI7czo2OiJQYWdlczoiO3M6MDoiIjtzOjk6Ik5leHQgcGFnZSI7czowOiIiO3M6MTM6IlByZXZpb3VzIHBhZ2UiO3M6MDoiIjtzOjU6IlNoYXJlIjtzOjA6IiI7czoxNjoiQWJvdXQgdGhlIEF1dGhvciI7czowOiIiO3M6MTk6IkF1dGhvciBBcmNoaXZlczogJXMiO3M6MDoiIjtzOjIxOiJDYXRlZ29yeSBBcmNoaXZlczogJXMiO3M6MDoiIjtzOjE2OiJUYWcgQXJjaGl2ZXM6ICVzIjtzOjA6IiI7czoxNzoiUG9ydGZvbGlvIFRhZzogJXMiO3M6MDoiIjtzOjE0OiJTZWFjaCBmb3IgOiAlcyI7czowOiIiO3M6MTg6IkRhaWx5IEFyY2hpdmVzOiAlcyI7czowOiIiO3M6MjA6Ik1vbnRobHkgQXJjaGl2ZXM6ICVzIjtzOjA6IiI7czozOiJGIFkiO3M6MDoiIjtzOjE5OiJZZWFybHkgQXJjaGl2ZXM6ICVzIjtzOjA6IiI7czoxOiJZIjtzOjA6IiI7czoxMzoiQmxvZyBBcmNoaXZlcyI7czowOiIiO3M6MTc6IkJhY2sgdG8gbGlzdCBwb3N0IjtzOjA6IiI7fQ==';

    $default = str_replace("'","\\'", $default);
    $default = maybe_unserialize($default);
    $default['site_logo'] = st_img('logo.png');
    update_option(ST_SETTINGS_OPTION,$default);
    
    if(st_is_wpml()){
        $langs = icl_get_languages('skip_missing=0&orderby=KEY&order=asc');
        foreach($langs as $l){
           update_option(ST_SETTINGS_OPTION.'_'.$l['language_code'],$default);
        }
    }
    // update translate options
    $translate = base64_decode($translate);
    $translate = str_replace("'","\\'", $translate);
    $translate=  maybe_unserialize($translate);
    update_option(ST_TRANSLATE_OPTION, $translate);
    
    update_option($option_name,'y');
    
}


/* Flush rewrite rules for custom post types. */
add_action( 'after_switch_theme', 'flush_rewrite_rules' );



