<?php
    
    if ( get_post_meta($post->ID, 'pplan_milestone_status', true)=='overdue') echo 'Overdue as of '; 
    
    else echo get_post_meta($post->ID, 'pplan_milestone_due', true);
    
    if ( get_post_meta($post->ID, 'pplan_milestone_start', true) ) echo date('n/j/y', get_post_meta($post->ID, 'pplan_milestone_start', true));
    
    if ( get_post_meta($post->ID, 'pplan_milestone_end', true) ) echo ' &ndash; ';
    
    if ( get_post_meta($post->ID, 'pplan_milestone_end', true) ) echo date('n/j/y', get_post_meta($post->ID, 'pplan_milestone_end', true));
	
?>
    
   