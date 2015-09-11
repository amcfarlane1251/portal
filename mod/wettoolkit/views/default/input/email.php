<?php
/**
 * Elgg email input
 * Displays an email input field
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['class'] Additional CSS class
 */

if (isset($vars['class'])) {
	$vars['class'] = "elgg-input-email {$vars['class']}";
} else {
	$vars['class'] = "elgg-input-email";
}

$defaults = array(
	'disabled' => false,
);

$vars = array_merge($defaults, $vars);

$user = elgg_get_page_owner_entity();

?>

<p id="users_email"><?php echo $user->email; ?></p>
