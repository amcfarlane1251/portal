<?php
/**
 * Create a form for data submission.
 * Use this view for forms as it provides protection against CSRF attacks.
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['body'] The body of the form (made up of other input/xxx views and html
 * @uses $vars['action'] The action URL of the form
 * @uses $vars['method'] The submit method: post (default) or get
 * @uses $vars['enctype'] Set to 'multipart/form-data' if uploading a file
 * @uses $vars['disable_security'] turn off CSRF security by setting to true
 * @uses $vars['class'] Additional class for the form
 */

 elgg_register_js('button_press', 'mod/wettoolkit/views/default/js/button_press.js');
 elgg_load_js('button_press');

$defaults = array(
	'method' => "post",
	'disable_security' => FALSE,
);

$vars = array_merge($defaults, $vars);

if (isset($vars['class'])) {
	$vars['class'] = "elgg-form {$vars['class']}";
} else {
	$vars['class'] = 'elgg-form';
}

$vars['action'] = elgg_normalize_url($vars['action']);
$vars['method'] = strtolower($vars['method']);

$body = $vars['body'];
unset($vars['body']);

echo $vars['disable_security'];
// Generate a security header
if (!$vars['disable_security']) {
	$body = elgg_view('input/securitytoken') . $body;
}
unset($vars['disable_security']);

$attributes = elgg_format_attributes($vars);

echo "<form id='portalForm' $attributes><fieldset>$body</fieldset></form>";

//creates the file upload progress box, only displayed on submit with forms with form that have file input
echo '<div id="progressbox"><div id="progressbar"></div><div id="statustxt">0%</div></div>';
echo '<div id="output"></div>';

