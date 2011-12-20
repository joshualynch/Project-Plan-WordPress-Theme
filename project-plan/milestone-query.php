<?php
    
        $projects = get_the_terms( get_the_ID(), 'project_id' );
        
        if ( ! is_wp_error( $projects ) && is_array( $projects ) ) {
    
        $term = array_shift( $projects );
    
        
    
        // Query for milestones that have the project ID
    
        $milestones = null;
    
        if ( isset( $term->slug ) && isset( $term->taxonomy ) ) {
    
            $milestones = get_posts( array(
    
                'term'        => $term->slug,
    
                'taxonomy'    => $term->taxonomy,
    
                'post_type'   => 'pplan_milestones',
				
				'orderby' => 'menu_order',
				
            	'order' => 'asc',
			
				'numberposts' => '0',
    
                'post_status' => 'publish',
    
                ) );
    
        }
    
        // Loop over all milestones and display
    
        if ( $milestones ) {
    
            $_post = $post;
    
            foreach ( (array) $milestones as $post ) {
    
                setup_postdata( $post );
				
				echo '<section class="';
				
				if ( $post->ID == $wp_query->post->ID ) echo 'current ';
				
				echo get_post_meta($post->ID, 'pplan_milestone_status', true);
				
				echo ' ' . $post->menu_order . '">';
    
                the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
				
				if ( get_post_meta($post->ID, 'pplan_milestone_start', true) ) echo '<h3 class="date">';
				
				include 'milestone-date-query.php';
				
				if ( get_post_meta($post->ID, 'pplan_milestone_start', true) ) echo '</h3>';
				
				echo '<a href="' . esc_url( get_permalink() ) . '">';
				
				echo '<img class="icon" src="' . get_stylesheet_directory_uri() . '/icons/' . get_post_meta($post->ID, 'pplan_milestone_icon', true) . '.png"/></a>';
				
				the_excerpt();
				
				echo '<a class="more" href="' . esc_url( get_permalink() ) . '">Details &raquo;</a></section>';
    
            }
    
            $post = $_post;
    
        }
    
    }
    
?>