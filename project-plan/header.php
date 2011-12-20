<!DOCTYPE html>

<!--[if lt IE 7 ]> <html class="ie ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head id="pplan" data-template-set="project-plan-wordpress-theme">

<link rel="profile" href="http://gmpg.org/xfn/11" /> 

	<meta charset="<?php bloginfo('charset'); ?>">
	
	<!-- Always force latest IE rendering engine & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<!-- For WordPress SEO plugin-->
	<title><?php wp_title(''); ?></title>

	<meta name="description" content="<?php bloginfo('description'); ?>">
    
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
        
    <?php include 'header-global-styles.php'; ?>
    
    <!-- Include fonts from Google -->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>

	<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
    
    <?php wp_head(); ?>
    
    <!-- Modernizr -->
	<script src="<?php bloginfo('template_directory'); ?>/js/modernizr-1.7.min.js"></script>
    
    <!-- Include local scripts -->
	<script type="text/javascript" src="<?php echo home_url(); ?>/wp-content/themes/project-plan/js/jquery.easing.1.3.js"></script>
    
    <script type="text/javascript" src="<?php echo home_url(); ?>/wp-content/themes/project-plan/js/jquery.anyDropDown.js"></script>
    
    <script type="text/javascript">
	$(function(){
			
		$('.dropdown').anyDropDown({
			dropDownElem: '.navigate-header', //the class name for your drop down
			dropDownMenuElem: '.navigate', //the class name for the drop down menu
			slideDownEasing: 'easeInOutCirc', //easing method for slideDown
			slideUpEasing: 'easeInOutCirc', //easing method for slideUp
			slideDownDuration: 100, //easing duration for slideDown
			slideUpDuration: 100, //easing duration for slideUp
			closeMessage: 'Hide Navigation' //message shown when drop down is opened
		});
			
	});
	</script>
    
   	<script type="text/javascript" src="<?php echo home_url(); ?>/wp-content/themes/project-plan/js/autocolumn.min.js"></script>
    
	<script>
		$(function(){
			$('#intro').columnize({columns:2, lastNeverTallest:true, target: "#intro"});
		});
	</script>
    
    <script type="text/javascript" src="<?php echo home_url(); ?>/wp-content/themes/project-plan/js/jquery.bxSlider.js" type="text/javascript"></script>

	<script>
		
		$(function(){
			$('#milestones').bxSlider({
			displaySlideQty: 4,
			moveSlideQty: 2,
			infiniteLoop: false,
    		hideControlOnEnd: true
		  });
		});
	
	</script>
	
</head>

<body <?php body_class(); ?>>

	<header id="global-header" role="banner" class="cf">
    
    	<hgroup>
        
        	<h1 id="logo"><a href="<?php echo get_option('pplan_logo_link'); ?>"><?php echo get_option('pplan_logo_anchor'); ?></a></h1>
        
                <h2 id="title"><?php bloginfo('name'); ?></h2>
        
        </hgroup>
        
        <?php if ( 'pplan_docs' == get_post_type() ) {
		
		echo '';
		
		} else {
        
			echo '<nav class="dropdown" role="navigation">';
			
				include 'navigate.php';
			
			echo '</nav>';
        
        }?>
    
    </header> 
    
	<?php if ( 'pplan_designs' == get_post_type() ) echo '<a id="header-toggle" href="#">Hide Navigation</a>' ?>
    
    <div id="page-wrap" class="cf">