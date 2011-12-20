<?php get_header(); ?>

	<div class="cf">

	<section id="single-milestone">
    	
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <noscript>
        
                <div class="alert"><p>Your browser has javascript disabled. Javascript is required for features on this website (and many others) to function properly.</p>
                <p><strong>Visit <a href="http://www.activatejavascript.org/">activatejavascript.org</a> to learn how to enable javascript in your browser.</strong></p></div>
        
        </noscript>
    
			<?php the_title('<h1 id="milestone-title">', '</h1>'); ?>
            
					 <?php if ( get_post_meta($post->ID, 'pplan_alert', true) ) : ?>         
                            
                        <div class="alert">
                        
                            <p><?php echo get_post_meta($post->ID, 'pplan_alert', true) ?></p>
                        
                        </div>
                    
                    <?php endif; ?>
				
					<?php the_content(); ?>
    
    </section>
    
    <div id="sidebar">
    
   		<?php if ( get_post_meta($post->ID, 'pplan_milestone_start', true) ) echo '<section id="schedule"><h3>Schedule</h3><p class="date">';
            
        include 'milestone-date-query.php';
                
       	if ( get_post_meta($post->ID, 'pplan_milestone_start', true) ) echo '</p></section>'; ?>
        
        <?php if(get_post_meta($post->ID, 'pplan_milestone_design', true) == 'true') : ?> 

            	<?php
    
				$projects = get_the_terms( get_the_ID(), 'project_id' );
				
				if ( ! is_wp_error( $projects ) && is_array( $projects ) ) {
			
				$term = array_shift( $projects );
    
       			/* Query for posts with project ID */
    
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
    
				if ( $designs ) {
			
					$_post = $post;
					
					print '<section id="design-milestones">';
					
					print '<h3>Design Views</h3>';
					
					print '<ol>';
			
					foreach ( (array) $designs as $post ) {
			
						setup_postdata( $post );
			
						the_title( '<li><a href="' . esc_url( get_permalink() ) . '">', '</a></li>' );
			
					}
			
					print '</ol>';
					
					print '</section>';
			
					$post = $_post;
			
					}
    
    			}
    
    		?>
		
		<?php endif; ?>
    
    </div>
    
	<?php endwhile; else: ?>
    
		<?php include 'lost-message.php'; ?>
    
    <?php endif; ?>
    
    </div>
    
    <h1 id="doc-title">Milestones</h1>
    
    <div id="milestones" class="cf">
    
		<?php include 'milestone-query.php'; ?>
    
    </div>

<?php get_footer(); ?>