     	<div class="navigate-header">Navigate</div>
        
			<?php
    
				$projects = get_the_terms( get_the_ID(), 'project_id' );
				
				if ( ! is_wp_error( $projects ) && is_array( $projects ) ) {
			
				$term = array_shift( $projects );
    
       			/* Query for posts with project ID */
    
				$projectname = null;
				
				if ( isset( $term->slug ) && isset( $term->taxonomy ) ) {
			
					$projectname = get_posts( array(
			
						'term'        => $term->slug,
			
						'taxonomy'    => $term->taxonomy,
						
						'post_type'   => array('pplan_projects'),
						
						'orderby' => 'menu_order',
						
						'order' => 'ASC',
					
						'numberposts' => '0',
			
						'post_status' => 'publish',
			
						) );
			
				}
			
				if ( isset( $term->slug ) && isset( $term->taxonomy ) ) {
			
					$milestones = get_posts( array(
			
						'term'        => $term->slug,
			
						'taxonomy'    => $term->taxonomy,
						
						'post_type'   => array('pplan_milestones'),
						
						'orderby' => 'menu_order',
						
						'order' => 'ASC',
					
						'numberposts' => '0',
			
						'post_status' => 'publish',
			
						) );
			
				}
				
				$designs = null;
			
				if ( isset( $term->slug ) && isset( $term->taxonomy ) ) {
			
					$designs = get_posts( array(
			
						'term'        => $term->slug,
			
						'taxonomy'    => $term->taxonomy,
						
						'post_type'   => array('pplan_designs'),
						
						'orderby' => 'menu_order',
						
						'order' => 'ASC',
					
						'numberposts' => '0',
			
						'post_status' => 'publish',
			
						) );
			
				}
			
        		/* Loop over all posts and display unordered list */
    
				if ( $projectname ) {
			
					$_post = $post;
			
					print '<div class="navigate">';
					
					print '<ul>';
					
					print '<li><strong>Project Home</strong></li>';
					
					foreach ( (array) $projectname as $post ) {
			
						setup_postdata( $post );
			
						the_title( '<li><a href="' . esc_url( get_permalink() ) . '">', '</a></li>' );
			
					}
					
					if ( $milestones ) print '<li><strong>Milestones</strong></li>';	
			
					foreach ( (array) $milestones as $post ) {
			
						setup_postdata( $post );					
			
						the_title( '<li><a href="' . esc_url( get_permalink() ) . '">', '</a></li>' );
			
					}
					
					if ( $designs ) print '<li><strong>Designs</strong></li>';	
					
					foreach ( (array) $designs as $post ) {
			
						setup_postdata( $post );					
			
						the_title( '<li><a href="' . esc_url( get_permalink() ) . '">', '</a></li>' );
			
					}
			
					print '</ul>';
					
					print '</div>';
			
					$post = $_post;
			
					}
    
    			}
    
    		?>