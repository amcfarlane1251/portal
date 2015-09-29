<?php
/**
 * Elgg file input
 * Displays a file input field
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['value'] The current value if any
 * @uses $vars['class'] Additional CSS class
 */

 elgg_register_js('button_press', 'mod/wettoolkit/views/default/js/button_press.js');
 elgg_load_js('button_press');
 
if (!empty($vars['value'])) {
	echo elgg_echo('fileexists') . "<br />";
}

if (isset($vars['class'])) {
	$vars['class'] = "elgg-input-file {$vars['class']}";
} else {
	$vars['class'] = "elgg-input-file";
}

$defaults = array(
	'disabled' => false,
	'size' => 30,
);

$attrs = array_merge($defaults, $vars);

?>
<input id="fileInput" type="file" <?php echo elgg_format_attributes($attrs); ?> />
