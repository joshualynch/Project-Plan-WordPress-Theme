<?php

/**
 * Abstraction of enhancing post-types in Wordpress
 * 
 * This class delivers a simple way to enhance all
 * the post types in Wordpress so that it is more like
 * a CMS than ever!
 * 
 * @author Markus Thömmes (merguez@semantifiziert.de)
 * @copyright Copyright 2010, Markus Thömmes
 * @version 1.0
 * @since 10.09.2010
 * 
 */

if(!class_exists('UIElement')) {
class UIElement {
	/**
     * Contains the type of posts this page is hooked into
     * @var string
     */
	private $type;
	
	/**
     * Contains all arguments needed to build the frame
     * @var array
     */
	private $args;
	
	/**
     * Contains all the information needed to build the form structure of the page
     * @var array
     */
	private $boxes;
	
	/**
     * Constructs a new object
	 *
     * @param string $type contains the type this UIElement is hooked into
     */
	public function __construct($type) {
		if(is_object($type)) {
			$this->type = $type->type_name;
		} else {
			$this->type = $type;
		}
		add_action('save_post', array($this, 'save'));
	}
	
	/**
     * Adds a Metabox to your page
	 *
	 * Possible keys within $args:
	 *  > id (string) - Just a unique id
	 *  > title (string) - The title of the frame
	 *  > context (string) (optional) - defines the context of the box
	 *  > priority (string) (optional) - defines the priority of the box
	 *
     * @param array $args contains everything needed to build the field
     */
	public function createMetabox($args) {
		$this->args = $args;
		add_action('admin_menu',array($this, 'renderUI'));
	}
	
	/**
     * Switches the CustomImage box from the side to the middle
	 *
	 * Possible keys within $args:
	 *  > id (string) - Just a unique id
	 *  > title (string) - The title of the frame
	 *
     * @param array $args contains everything needed to build the field
     */
	public function switchCustomImage($args) {
		$this->args = $args;
		add_action('do_meta_boxes', array($this, 'renderThumbnailBox'));
	}
	
	/**
     * Adds an input field to the current page
	 *
	 * Possible keys within $args:
	 *  > id (string) - This is what you need to get your variable from the database
	 *  > label (string) - Describes your field very shortly
	 *  > desc (string) (optional) - Further description for this element
	 *  > standard (string) - This is the standard value of your input
	 *
     * @param array $args contains everything needed to build the field
     */
	public function addInput($args) {
		$args['type'] = 'input';
		$this->boxes[] = $args;
	}
	
	/**
     * Adds a textarea to the current page
	 *
	 * Possible keys within $args:
	 *  > id (string) - This is what you need to get your variable from the database
	 *  > label (string) - Describes your field very shortly
	 *  > desc (string) (optional) - Further description for this element
	 *  > standard (string) (optional) - This is the standard value of your field
	 *  > rows (integer) (optional) - The number of rows you want to have, standard: 5
	 *  > cols (integer) (optional) - The number of cols you want to have, standard: 30
	 *  > width (integer) (optional) - How wide should the textarea be?, standard:500
	 *
     * @param array $args contains everything needed to build the field
     */
	public function addTextarea($args) {
		$defaults = array(
			'rows' => 5,
			'cols' => 30,
			'width' => 500,
		);
		$args = array_merge($defaults, $args);
		$args['type'] = 'textarea';
		$this->boxes[] = $args;
	}
	
	/**
     * Adds a TinyMCE editor to the current page
	 *
	 * Possible keys within $args:
	 *  > id (string) - This is what you need to get your variable from the database
	 *  > label (string) - Describes your field very shortly
	 *  > desc (string) (optional) - Further description for this element
	 *  > standard (string) (optional) - This is the standard value of your input
	 *
     * @param array $args contains everything needed to build the field
     */
	public function addEditor($args) {
		$args['type'] = 'editor';
		$this->boxes[] = $args;
	}
	
	/**
     * Adds a checkbox to the current page
	 *
	 * Possible keys within $args:
	 *  > id (string) - This is what you need to get your variable from the database
	 *  > label (string) - Describes your field very shortly
	 *  > desc (string) - Further description for this element
	 *  > standard (bool) - Define wether the checkbox should be checked our unchecked
	 *
     * @param array $args contains everything needed to build the field
     */
	public function addCheckbox($args) {
		$args['type'] = 'checkbox';
		$this->boxes[] = $args;
	}
	
	/**
     * Adds radiobuttons field to the current page
	 *
	 * Possible keys within $args:
	 *  > id (string) - This is what you need to get your variable from the database
	 *  > label (string) - Describes your field very shortly
	 *  > standard (string) - Define which of the options should be checked if there is nothing in the database
	 *  > options (array) - An array containing the options to choose from, written in this style: LABEL => VALUE
	 *
     * @param array $args contains everything needed to build the field
     */
	public function addRadiobuttons($args) {
		$args['type'] = 'radio';
		$this->boxes[] = $args;
	}
	
	/**
     * Adds a dropdown field to the current page
	 *
	 * Possible keys within $args:
	 *  > id (string) - This is what you need to get your variable from the database
	 *  > label (string) - Describes your field very shortly
	 *  > desc (string) (optional) - Describes your field very shortly
	 *  > standard (string) - Define which of the options should be checked if there is nothing in the database
	 *  > options (array) - An array containing the options to choose from, written in this style: LABEL => VALUE
	 *
     * @param array $args contains everything needed to build the field
     */
	public function addDropdown($args) {
		$args['type'] = 'dropdown';
		$this->boxes[] = $args;
	}
	
	/**
     * Adds a slider to the current page
	 *
	 * Possible keys within $args:
	 *  > id (string) - This is what you need to get your variable from the database
	 *  > label (string) - Describes your field very shortly
	 *  > standard (integer|array) (optional) - The starting position of your slider, if it is an array, a range slider is build
	 *  > max (integer) (optional) - The maximum value of your slider
	 *  > min (integer) (optional) - The minimum value of your slider
	 *  > step (integer) (optional) - The stepsize of your slider
	 *
     * @param array $args contains everything needed to build the field
     */
	public function addSlider($args) {
		$default = array(
			'standard' => 0,
			'max' => 100,
			'min' => 0,
			'step' => 1,
		);
		$args = array_merge($default,$args);
		$args['type'] = 'slider';
		$this->boxes[] = $args;
	}
	
	/**
     * Adds a datepicker to the current page
	 *
	 * Possible keys within $args:
	 *  > id (string) - This is what you need to get your variable from the database
	 *  > label (string) - Describes your field very shortly
	 *  > desc (string) (optional) - Describes your field very shortly
	 *  > standard (string) (optional) - The standard date in the format: MM/DD/YYYY
	 *
     * @param array $args contains everything needed to build the field
     */
	public function addDate($args) {
		$args['type'] = 'date';
		$date = explode('/', $args['standard']);
		if(isset($date[2])) $args['standard'] = mktime(0,0,0,$date[0],$date[1],$date[2]);
		$this->boxes[] = $args;
	}
	
	/**
     * Renders the interface
	 * @access private
     */
	public function renderUI() {
		$default = array(
			'context' => 'normal',
			'priority' => 'high',
		);
		$this->args = array_merge($default, $this->args);
		if(function_exists('add_meta_box')) {
			add_meta_box($this->args['id'], $this->args['title'], array($this, 'outputHTML'), $this->type, $this->args['context'], $this->args['priority']);
		}
	}
	
	/**
     * Switches the CustomImage box
	 * @access private
     */
	public function renderThumbnailBox() {
		remove_meta_box('postimagediv', $this->type, 'side');
		add_meta_box('postimagediv', $this->args['title'], 'post_thumbnail_meta_box', $this->type);
	}
	
	/**
     * Outputs all the HTML needed for the new elements
	 * @access private
     */
	public function outputHTML($post) {
		echo '<style type="text/css" media="screen">.editorcontainer { -webkit-border-radius:6px; border:1px solid #DEDEDE;}</style>';
		echo '<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/base/jquery-ui.css" rel="stylesheet" />';
		echo '<script type="text/javascript">var safe = jQuery</script>';
		echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>';
		echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>';
		echo '<table class="form-table">';
		if(count($this->boxes) > 0) {
		foreach($this->boxes as $box) {
			echo '<tr valign="top">';
			echo '<th><label for="'.$box['id'].'">'.$box['label'].':</label></th>';
			
			$try = add_post_meta($post->ID, $box['id'], $box['standard'], true);
			$data = get_post_meta($post->ID, $box['id'], true);
			switch($box['type']) {
				case 'input':
					$data = htmlspecialchars(stripslashes($data));
					echo '<td><input type="text" class="regular-text" name="'.$box['id'].'" id="'.$box['id'].'" value="'.$data.'" /> <span class="description">'.$box['desc'].'</span></td>';
					break;
					
				case 'textarea':
					$data = stripslashes($data);
					echo '<td><textarea rows="'.$box['rows'].'" cols="'.$box['cols'].'" style="width:'.$box['width'].'px" name="'.$box['id'].'" id="'.$box['id'].'">'.$data.'</textarea> <br><span class="description">'.$box['desc'].'</span></td>';
					break;
					
				case 'editor':
					echo '<td><div class="editorcontainer"><textarea class="theEditor" id="'.$box['id'].'" name="'.$box['id'].'">'.$data.'</textarea></div><span class="description">'.$box['desc'].'</span></td>';
					break;
				
				case 'checkbox':
					if($data == 'true') {
						$checked = 'checked="checked"';
					} elseif($data == 'false') {
						$checked = '';
					}
					echo '<td><input type="checkbox" name="'.$box['id'].'" id="'.$box['id'].'" value="true" '.$checked.' /> <label for="'.$box['id'].'">'.$box['desc'].'</label></td>';
					break;
					
				case 'radio':
					echo '<td>';
					foreach($box['options'] as $label=>$value) {
						if($data == $value) {
							$checked = 'checked="checked"';
						} else {
							$checked = '';
						}
						echo '<input type="radio" name="'.$box['id'].'" id="'.$box['id'].'_'.$value.'" value="'.$value.'" '.$checked.' /> <label for="'.$box['id'].'_'.$value.'">'.$label.'</label><br>';
					}
					echo '</td>';
					break;
					
				case 'dropdown':
					echo '<td>';
					echo '<select name="'.$box['id'].'" id="'.$box['id'].'">';
					foreach($box['options'] as $label=>$value) {
						if($data == '') {
							$selected = ($box['standard'] == $label) ? 'selected="selected"' : '';
						} elseif($data == $value) {
							$selected = 'selected="selected"';
						} else {
							$selected = '';
						}
						echo '<option value="'.$value.'" '.$selected.'>'.$label.'</option>';
					}
					echo '</select> <span class="description">'.$box['desc'].'</span>';
					echo '</td>';
					break;
					
				case 'slider':
					$show = $data;
					if(is_array($show)) $show = implode('-',$show);
					echo '<td>';
					echo '<div style="width:30%" id="'.$box['id'].'-slider" class="ui-slider"></div>';
					echo '<div id="'.$box['id'].'-handle">'.$show.'</div>';
					echo '<input type="hidden" name="'.$box['id'].'" id="'.$box['id'].'" value="'.$show.'" />';
					echo '<script type="text/javascript">jQuery("#'.$box['id'].'-slider").slider({';
					if(!is_array($data)) {
						echo 'value: '.$data.',';
					} else {
						echo 'range: true,';
						echo 'values: ['.implode(',',$data).'],';
					}
					echo 'step:' .$box['step'].',';
					echo 'max: '.$box['max'].',';
					echo 'min: '.$box['min'].',';
					if(!is_array($data)) {
						echo 'slide: function(e,ui) { jQuery("#'.$box['id'].'-handle").text(ui.value); jQuery("#'.$box['id'].'").val(ui.value); },';
					} else {
						echo 'slide: function(e,ui) { jQuery("#'.$box['id'].'-handle").text(ui.values[0]+"-"+ui.values[1]); jQuery("#'.$box['id'].'").val(ui.values[0]+"-"+ui.values[1]); },';
					}
					echo '}); </script>';
					echo '</td>';
					break;
					
				case 'date':
					if(strlen($data) > 0) $data = date('m/d/Y',$data);
					echo '<td><input type="text" name="'.$box['id'].'" id="'.$box['id'].'" value="'.$data.'" /> <span class="description">'.$box['desc'].'</span></td>';
					echo '<script type="text/javascript">jQuery("#'.$box['id'].'").datepicker();</script>';
					break;

			}
			echo '</tr>';
		}
		}
		echo '</table>';
		echo '<input type="hidden" name="'.$this->type.'_noncename" id="'.$this->type.'_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
		echo '<script type="text/javascript">jQuery = safe</script>';
	}
	
	/**
     * Does all the complicated database stuff
	 * @access private
     */
	public function save($post_id) {
		if(!wp_verify_nonce($_POST[$this->type.'_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		if('page' == $_POST['post_type']) {
			if(!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} else {
			if(!current_user_can('edit_post', $post_id)) {
				return $post_id;
			}
		}
		
		if(count($this->boxes) > 0) {

			foreach($this->boxes as $box) {
				$data = $_POST[$box['id']];
				if($box['type'] == 'editor') {
					$data = wptexturize(wpautop($data));
				}
				if($box['type'] == 'checkbox') {
					if($data != 'true') {
						$data = 'false';
					}
				}
				if($box['type'] == 'slider') {
					if(strpos($data, '-') !== false) {
						$data = explode('-',$data);
					}
				}
				if($box['type'] == 'date') {
					$date = explode('/', $data);
					if(isset($date[2])) $data = mktime(0,0,0,$date[0],$date[1],$date[2]);
				}
				update_post_meta($post_id, $box['id'], $data);
			}
		}	
	}
}
}
?>