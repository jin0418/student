<h3 class="port-title"><?php _e('Project Details','smooththemes'); ?></h3>
<ul class="project-detail-list">
    <?php if($st_page_options['portfolio_client']): ?>
    <li class="spd-client"><span><?php _e('Client: ','smooththemes'); ?></span><?php  echo esc_html($st_page_options['portfolio_client']); ?></li>
    <?php endif; ?>
    <?php if($st_page_options['portfolio_date']):
         $p_date =  $st_page_options['portfolio_date'];
     ?>
    <li class="spd-time"><span><?php _e('Date: ','smooththemes'); ?></span><?php  echo esc_html($p_date); ?></li>
    <?php endif; ?>
    <?php echo get_the_term_list( $post->ID, 'portfolio_tag', '<li class="spd-tags"><span>'.__('Tags: ','smooththemes').'</span>', ', ', '</li>' ); ?>
    
    <?php if($st_page_options['portfolio_skills']): ?>
    <li class="spd-skill"><span><?php _e('Skills: ','smooththemes'); ?></span><?php  echo esc_html($st_page_options['portfolio_skills']); ?></li>
    <?php endif; ?> 
    
    <?php if($st_page_options['portfolio_website']):
    $url = parse_url($st_page_options['portfolio_website']);
    if($url['host']!=''){
        $link = $url['host'];
    }else{
        $link =esc_html($st_page_options['portfolio_website']);
    }
    ?>
    <li class="spd-url"><span><?php echo __('Project Url: ','smooththemes'); ?></span><a href="<?php echo esc_attr($st_page_options['portfolio_website']); ?>"><?php echo $link; ?></a></li>
    <?php endif; ?>
    
</ul>
