<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <?php if(''!=st_get_setting('site_favicon','')): ?>
    <link rel="shortcut icon" href="<?php echo esc_attr(st_get_setting('site_favicon')); ?>" />
    <?php endif; ?>
    <!-- Mobile Specific -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1" />
    <!-- Title Tag
    ========================================================================= -->
    <title><?php st_title(); ?></title>
    <!-- Browser Specical Files
    ========================================================================= -->
    <!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!-- Site Favicon
    ========================================================================= -->
    <?php if(''!=st_get_setting('site_favicon','')): ?>
    <link rel="shortcut icon" href="<?php echo esc_attr(st_get_setting('site_favicon')); ?>" />
    <?php endif; ?>
    
    <!-- WP HEAD
    ========================================================================= -->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<div id="mobile-menu-wrapper">
    <div id="mobile-menu-inner">
        <div class="menu-element-inner">
            <div id="primary-nav-mobile-a" class="primary-nav-close">
                <i class="icon icon-reorder"></i> 
            </div>

            <nav id="primary-nav-mobile">
                <div id="search-mobile" class="search-mobile"></div>
            </nav>
        </div>
    </div>
</div>  
<div class="theone-wrapper">
<header id="header">
    <div id="header-wapper-inner">
        <div id="header-sticky-wrapper">
            <div class="container">
                <div class="row">
                    <div class="twelve columns b0">
                        <div class="header-inner">
                            <div class="left-header left">
                                <div id="logo-wrapper" class="logo-wrapper">
                                    <h1>
                                        <a href="<?php echo site_url(); ?>/home">
                                          <!-- キャンペーンページの場合 TABIPPO LOGO -->
                                          <?php if ( is_page('3062') ) : ?>
                                              <?php if(st_get_setting("site_logo")!=''): ?>
                                              <img src="/wp-content/uploads/2013/12/his_tabippo_logo_s.png" class="event" alt="H.I.S.とTABIPPOキャンペーン"/>
                                              <?php else: ?>
                                              <span class="no-logo"><?php bloginfo('name'); ?></span>
                                          <?php  endif; ?>
                                          <!-- それ以外の場合 -->
                                          <?php else: ?>
                                              <?php if(st_get_setting("site_logo")!=''): ?>
                                              <img src="<?php echo esc_attr(st_get_setting("site_logo")); ?>" alt="<?php  bloginfo('name'); ?>"/>
                                              <?php else: ?>
                                              <span class="no-logo"><?php bloginfo('name'); ?></span>
                                              <?php  endif; ?>
                                          <?php endif; ?>
                                        </a>
                                    </h1>
                                </div><!-- END .logo-wrapper-->
                            </div>
                            <div class="right-header right">
                                <nav id="primary-nav-id" class="primary-nav slideMenu">
                                    <ul id="primary-nav-inner">
                                         <?php 
			                                 $defaults = array(
			                                        	'theme_location'  => 'Primary_Navigation',
			                                        	'container'       => false,
			                                            'container_class' => false,
			                                            'items_wrap'=>'%3$s',
			                                        	'echo'            => true
			                                        );
			                               wp_nav_menu( $defaults );
			                            ?> 
                                    </ul>
                                </nav>
                            </div>
                        </div><!--END Headerinner-->
                        <div class="clear"></div>
                    </div>
                </div><!--END row-->
            </div>
        </div>
    </div>
</header><!-- END .header-container-wrapper -->



