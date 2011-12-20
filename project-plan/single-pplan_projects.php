<?php get_header(); ?>

	

	<section id="project">
    	
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <noscript>
        
                <div class="alert"><p>Your browser has javascript disabled. Javascript is required for features on this website (and many others) to function properly.</p>
                <p><strong>Visit <a href="http://www.activatejavascript.org/">activatejavascript.org</a> to learn how to enable javascript in your browser.</strong></p></div>
        
        </noscript>
    
			<?php the_title('<h1 id="project-title">', '</h1>'); ?>
        
				<div id="intro">
				
					<?php the_content(); ?>
                    
                </div>
                
                <?php if ( get_post_meta($post->ID, 'pplan_alert', true) ) : ?>
                
                	<div class="alert">
                    
                    	<p><?php echo get_post_meta($post->ID, 'pplan_alert', true) ?></p>
                    
                    </div>
                
                <?php endif; ?>
                       
        <?php endwhile; else: ?>
        
        	<?php include 'lost-message.php'; ?>
        
		<?php endif; ?>
    
    </section>
    
    <h1 id="doc-title">Milestones</h1>

        <div id="milestones">
        
            <?php include 'milestone-query.php'; ?>
        
        </div> 
       
    <?php
    
			$docs_set = get_the_terms( get_the_ID(), 'docs_set' );
			
			if ( ! is_wp_error( $docs_set ) && is_array( $docs_set ) ) {
		
			$term = array_shift( $docs_set );

			/* Query for posts from docoument set */

			$docs = null;
		
			if ( isset( $term->slug ) && isset( $term->taxonomy ) ) {
		
				$docs = get_posts( array(
		
					'term'        => $term->slug,
		
					'taxonomy'    => $term->taxonomy,
					
					'post_type'   => array('pplan_docs'),
					
					'orderby' => 'menu_order',
					
					'order' => 'ASC',
				
					'numberposts' => '0',
		
					'post_status' => 'publish',
		
					) );
		
			}
		
			/* Loop over all posts and display unordered list */

			if ( $docs ) {
		
				$_post = $post;
				
				print '<section id="project-docs">';
				
				print '<h1 id="doc-title">Project Documents</h1>';
				
				print '<ul>';
		
				foreach ( (array) $docs as $post ) {
		
					setup_postdata( $post );
		
					the_title( '<li><a href="' . esc_url( get_permalink() ) . '">', '</a></li>' );
		
				}
		
				print '</ul>';
				
				print '</section>';
		
				$post = $_post;
		
				}

			}

		?>

<?php get_footer(); ?>