<?php

	$milestone_status = new UIElement('pplan_milestones');
	
	$milestone_status->createMetabox(array(
	'id' => 'pplan_milestone_statuses',
	'title' => 'Milestone Status',
	));
	
	$milestone_status->addRadiobuttons(array(
	'id' => 'pplan_milestone_status',
	'label' => 'This milestone is',
	'standard' => 'on-time',
	'options' => array(
		'On Time' => 'on-time',
		'Complete' => 'complete',
		'At Risk' => 'risk',
		'Overdue' => 'overdue',
	),
	));
	
	$milestone_type = new UIElement('pplan_milestones');
	
	$milestone_type->createMetabox(array(
	'id' => 'pplan_milestone_type',
	'title' => 'Milestone Type',
	));
	
	$milestone_type->addDropdown(array(
	'id' => 'pplan_milestone_icon',
	'label' => 'Icon Options',
	'desc' => 'Chose an image to be associated with the milestone.',
	'standard' => 'calendar',
	'options' => array(
		'Alert' => 'alert',
		'Arrow Sign' => 'arrow-sign',
		'Building Blocks' => 'blocks',
		'Calendar (default)' => 'calendar',
		'Check Box' => 'check-box',
		'Comment Bubbles' => 'comment-bubbles',
		'Designs' => 'designs',
		'Document Review' => 'doc-review',
		'Documents' => 'docs',
		'Edit' => 'edit',
		'Info' => 'info',
		'Key' => 'key',
		'Laptop' => 'laptop',
		'Lightbulb' => 'bulb',
		'Links' => 'links',
		'List' => 'list',
		'Palette' => 'palette',
		'People' => 'people',
		'Phone' => 'phone',
		'Power' => 'power',
		'Puzzle' => 'puzzle',
		'Question' => 'question',
		'Rocket' => 'rocket',
		'RSS' => 'rss',
		'Share' => 'share',
		'Star' => 'star',
		'Tack' => 'tack',
		'Tools' => 'tools',
		'Users' => 'users',
	),
	));
	
	$milestone_type->addCheckbox(array(
	'id' => 'pplan_milestone_design',
	'label' => 'Design Milestone',
	'desc' => 'Check to display designs related to this project on this milestone page.',
	'standard' => false,
	));
	
	$milestone_date = new UIElement('pplan_milestones');
	
	$milestone_date->createMetabox(array(
	'id' => 'pplan_milestone_dates',
	'title' => 'Milestone Dates',
	));
	
	$milestone_date->addRadiobuttons(array(
	'id' => 'pplan_milestone_due',
	'label' => 'Date Description',
	'desc' => 'Choose text to precede the milestone date(s)',
	'standard' => '',
	'options' => array(
		'None' => '',
		'Due' => 'Due ',
		'Approved by' => 'Approved by ',
		'Target' => 'Target ',
	),
	));
	
	$milestone_date->addDate(array(
	'id' => 'pplan_milestone_start',
	'label' => 'Start Date',
	));

	$milestone_date->addDate(array(
	'id' => 'pplan_milestone_end',
	'label' => 'End Date',
	));
	
	$project_alert = new UIElement('pplan_milestones');
	
	$project_alert->createMetabox(array(
	'id' => 'pplan_project_alert',
	'title' => 'Alert',
	));
	
	$project_alert->addTextarea(array(
	'id' => 'pplan_alert',
	'label' => 'Optionally enter text to be displayed in an alert box at the top of the milestone',
	));
?>