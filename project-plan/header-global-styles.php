<style type="text/css">

<?php

	$logo = get_option('pplan_header_logo');
			
	$width = get_option('pplan_logo_width');
	
	$height = get_option('pplan_logo_height');
			
		// Checks for logo, displays theme logo if needed

		if (empty($logo)) {

			echo '#logo a { background: url(http://designpresenter.com/demo/wp-content/uploads/2011/01/logo2.png) no-repeat; width: 180px; height: 48px; }';

		} else { echo '#logo a { background: url( ' .$logo['url']. ' ) no-repeat; width:' .$width. '; height: ' .$height. '; }'; }	

		if ( 'pplan_designs' == get_post_type() ) include 'header-design-styles.php';

?>

</style>