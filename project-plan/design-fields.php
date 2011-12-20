<?php
	$design_bg = new UIElement('pplan_designs');
	
	$design_bg->createMetabox(array(
	'id' => 'pplan_design_bg',
	'title' => 'Design Background',
	));
	
	$design_bg->addInput(array(
	'id' => 'pplan_design_bg_color',
	'label' => 'Background Color',
	'desc' => 'For solid color backgrounds, enter the hexadecimal color of the background (including the #) above.',
	'size' => 'small',
	));
	
	$design_bg->addInput(array(
	'id' => 'pplan_design_bg_image',
	'label' => 'Background Image',
	'desc' => 'For designs requiring a repeating background image, enter the full link (including the http://) to where you have uploaded the background image.',
	'size' => 'large',
	));
	
	$design_bg->addRadiobuttons(array(
	'id' => 'pplan_design_bg_repeat',
	'label' => 'Background Image Repeat',
	'standard' => 'repeat-none',
	'options' => array(
		'repeat-none' => 'repeat-none',
		'repeat-x' => 'repeat-x',
		'repeat-y' => 'repeat-y',
		'repeat' => 'repeat',
		),
	));
	
	$design_hide_nav = new UIElement('pplan_designs');
	
	$design_hide_nav->createMetabox(array(
	'id' => 'pplan_design_hide_nav',
	'title' => 'Hide Navigation Link Options',
	));
	
	$design_hide_nav->addInput(array(
	'id' => 'pplan_design_hide_nav_color',
	'label' => 'Link Color',
	'desc' => 'By default, the "Design Description" and "Hide Navigation" link text is blue and may be hard to read against darker backgrounds. Enter a hexadecimal color value (including the #) above if the design background is dark (usually #fff works just fine). Below, adjust the positioning of these buttons to the right or the left to avoid overlapping something at the top of your design.',
	'size' => 'small',
	));
	
	$design_hide_nav->addRadiobuttons(array(
	'id' => 'pplan_design_hide_nav_float',
	'label' => 'Link Positioning',
	'standard' => 'right',
	'options' => array(
		'right' => 'right',
		'left' => 'left',
		),
	));

?>