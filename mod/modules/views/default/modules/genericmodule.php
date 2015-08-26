<?php
/**
 * A generic module to load any kind of listed content
 * 
 * @uses $vars['view'] 				View to load
 * @uses $vars['module_class'] 		Class for module
 * @uses $vars['module_id']			ID for module
 */

$id = $vars['module_id'];
$class = $vars['module_class'];
$view = $vars['view'];

// Admins: Check and see if this view is registered, display a warning otherwise
if (elgg_is_admin_logged_in()) {
	$allowed_views = elgg_get_config('allowed_ajax_views');
	if (!array_key_exists($view, $allowed_views)) {
		register_error("ERROR: View ({$view}) is unregistered. Register it with: elgg_register_ajax_view('{$view}')");
	}
}

$view_vars = $vars['view_vars'];

echo "<div id='$id' class='$class genericmodule-container' name='$view'><div class='options'>";

foreach($view_vars as $name => $var) {
 	echo elgg_view('input/hidden', array(
		'name' => $name,
		'id' => $name,
		'value' => $var,
		'disabled' => 'disabled',
	));
}
echo "</div><div class='content'></div></div>";
