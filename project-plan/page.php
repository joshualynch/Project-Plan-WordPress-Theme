<?php get_header(); ?>

	<div class="cf">

	<section id="single-doc">
    	
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <noscript>
        
                <div class="alert"><p>Your browser has javascript disabled. Javascript is required for features on this website (and many others) to function properly.</p>
                <p><strong>Visit <a href="http://www.activatejavascript.org/">activatejavascript.org</a> to learn how to enable javascript in your browser.</strong></p></div>
        
        </noscript>
    
			<?php the_title('<h1 id="doc-title">', '</h1>'); ?>
				
					<?php the_content(); ?>
    
    </section>
    
	<?php endwhile; else: ?>
    
		<?php include 'lost-message.php'; ?>
    
    <?php endif; ?>
    
    </div>

<?php get_footer('docs'); ?>