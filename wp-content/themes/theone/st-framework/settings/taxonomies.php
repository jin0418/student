<?php 
/**
 * Portfolio Tag 
 */
register_taxonomy('portfolio_tag','portfolio',array(
     'labels' =>array(
         'name'=>__('Tags','smooththemes'),
         'menu_name'=>__('Tags','smooththemes'),
         'singular_name'=>__('Tag','smooththemes'),
         'all_items'=>__('All Tags','smooththemes'),
         'edit_item'=>__('Edit Tag','smooththemes'),
         'update_item'=>__('Edit Tag','smooththemes'),
         'add_new_item'=>__('New Tag','smooththemes'),
         'new_item_name'=>__('New Tag Name','smooththemes'),
         'search_items'=>__('Search Tags','smooththemes'),
         'popular_items'=>__('Popular Tags','smooththemes')
     ),
      'show_tagcloud'=> true,
      'show_ui'=>true,
      'hierarchical'=>false
));