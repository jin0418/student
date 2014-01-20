<?php

$portfolio_slug = trim(st_get_setting('post_portfolio')) != '' ? trim(st_get_setting('post_portfolio')) : 'portfolio';

register_post_type('portfolio', array(
    'label' => __('Portfolio', 'smooththemes'),
    'labels' => array(
        'singular_name' => __('Portfolio', 'smooththemes'),
        'menu_name' => __('Portfolio', 'smooththemes'),
        'all_items' => __('All Portfolio', 'smooththemes'),
        'add_new' => __('Add Portfolio', 'smooththemes'),
        'add_new_item' => __('Add new Portfolio', 'smooththemes'),
        'edit_item' => __('Edit Portfolio', 'smooththemes'),
        'new_item' => __('New Portfolio', 'smooththemes'),
        'view_item' => __('View Portfolio', 'smooththemes'),
        'search_items' => __('Search Portfolio', 'smooththemes'),
        'not_found' => __('Not found', 'smooththemes'),
        'not_found_in_trash' => __('Not found in trash', 'smooththemes')
    ),
    'public' => true,
    'show_ui' => true,
    'rewrite' => array('slug' => $portfolio_slug, 'with_front' => false),
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'menu_position' => 20
));
