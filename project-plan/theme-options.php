<?php

$options = new SubPage(theme, 'Theme Options');

$options->addTitle('Branding');

$options->addSubtitle('Logo');

$options->addUpload(array(
		'id' => 'pplan_header_logo',
		'label' => 'Upload your logo',
		'desc' => 'By default, this uploaded file will display in the header on the left-hand side of your pages.'
	));
	
$options->addInput(array(
		'id' => 'pplan_logo_height',
		'label' => 'Logo Height',
		'desc' => 'Enter the pixel value (including the px) of your logo height. Keep in mind that the existing header is 70px tall with a 10px top padding.',
		'standard' => '48px',
	));
	
$options->addInput(array(
		'id' => 'pplan_logo_width',
		'label' => 'Logo Width',
		'desc' => 'Enter the pixel value (including the px) of your logo width. Recommended not to exceed 180px.',
		'standard' => '180px',
	));	
	
$options->addInput(array(
		'id' => 'pplan_logo_link',
		'label' => 'Logo Link',
		'desc' => 'Enter the URL, including http://, where you would like your logo to link.',
		'standard' => 'http://designpresenter.com',
	));	
	
$options->addInput(array(
		'id' => 'pplan_logo_anchor',
		'label' => 'Logo Anchor Text',
		'desc' => 'Enter the logo link anchor text. This does not display visually but will show in the site source.',
		'standard' => 'Company Name',
	));				
	
$options->addSubtitle('Help Page');

$options->addInput(array(
		'id' => 'pplan_help_url',
		'label' => 'Help Page URL (Optional)',
		'desc' => 'It it is recommended that you create a help page using the default plain page template. Enter the full URL, including the http://, for that page here.',
		'standard' => 'http://example.com/help',
	));	
	
$options->addSubtitle('Footer Code');	

$options->addTextarea(array(
		'id' => 'pplan_footer_code',
		'label' => 'Insert Scripts Here (Optional)',
		'desc' => 'Use this textarea to drop scripts into the footer like analytics or a feedback button.',
		'standard' => '<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>',
	));	
?>