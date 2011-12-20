<?php
	$project_alert = new UIElement('pplan_projects');
	
	$project_alert->createMetabox(array(
	'id' => 'pplan_project_alert',
	'title' => 'Alert',
	));
	
	$project_alert->addTextarea(array(
	'id' => 'pplan_alert',
	'label' => 'Optionally enter text to be displayed in an alert box below the project introduction',
	));

?>