    </div> <!-- end #page-wrap -->
    
    <footer id="global-footer"> 
    
    	<a id="top" class="scroll" href="#global-header">Return to Top</a>
            
            <div id="author-meta">
            	
				<p>
                
                	<a href="http://www.addthis.com/bookmark.php" style="text-decoration:none;" class="addthis_button_email">Share via Email</a>
                
					<?php $help = get_option('pplan_help_url');

						if (empty($help)) { echo ''; } else { echo ' | <a href="' .$help. '">Get Help with This Site</a>'; } ?>
                    
                    <?php edit_post_link('Edit This Page', ' | ', ''); ?>
                    
				</p>   
                                
			</div>                
    
    </footer>

	<?php wp_footer(); ?>
    
    <?php echo stripslashes(get_option('pplan_footer_code')); ?>
    
    <script type="text/javascript" src="<?php echo home_url(); ?>/wp-content/themes/project-plan/js/slider.js" type="text/javascript"></script>
	
</body>

</html>