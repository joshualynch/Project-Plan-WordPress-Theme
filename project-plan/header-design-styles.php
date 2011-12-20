	<?php if ( get_post_meta($post->ID, 'pplan_design_bg_color', true) ) : ?> 
	
		#page-wrap {background:<?php echo get_post_meta($post->ID, 'pplan_design_bg_color', true) ?>;}
	
	<?php endif; ?>

	<?php if ( get_post_meta($post->ID, 'pplan_design_bg_image', true) ) : ?> 
	
		#bg-repeat {background: url(<?php echo get_post_meta($post->ID, 'pplan_design_bg_image', true) ?>) <?php echo get_post_meta($post->ID, 'pplan_design_bg_repeat', true) ?>;}
		
	<?php endif; ?>
	
		a#header-toggle {
        
        	<?php echo get_post_meta($post->ID, 'pplan_design_hide_nav_float', true) ?>: 50px;
            
			<?php if ( get_post_meta($post->ID, 'pplan_design_hide_nav_color', true) ) : ?>
			color: <?php echo get_post_meta($post->ID, 'pplan_design_hide_nav_color', true) ?>; 
			<?php endif; ?>
		}
        
        #top {
        	<?php if ( get_post_meta($post->ID, 'pplan_design_hide_nav_float', true)  == 'left') echo 'float: left;' ?>
        
        	<?php echo get_post_meta($post->ID, 'pplan_design_hide_nav_float', true) ?>: 50px;
        
        	<?php if ( get_post_meta($post->ID, 'pplan_design_hide_nav_color', true) ) : ?>
			color: <?php echo get_post_meta($post->ID, 'pplan_design_hide_nav_color', true) ?>; 
			<?php endif; ?>
        }