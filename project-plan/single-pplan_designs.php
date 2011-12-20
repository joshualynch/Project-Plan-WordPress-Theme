<?php get_header(); ?>
    	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <noscript>
        
                <div class="alert"><p>Your browser has javascript disabled. Javascript is required for features on this website (and many others) to function properly.</p>
                <p><strong>Visit <a href="http://www.activatejavascript.org/">activatejavascript.org</a> to learn how to enable javascript in your browser.</strong></p></div>
        
        </noscript> 
  
	<div id="bg-repeat">   

  			<?php the_content(); ?>
        
    </div>
                       
        <?php endwhile; else: ?>
        
        	<?php include 'lost-message.php'; ?>
        
		<?php endif; ?>

<?php get_footer(); ?>