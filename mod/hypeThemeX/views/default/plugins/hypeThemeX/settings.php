<?php

$themes_path = elgg_get_plugins_path() . 'hypeThemeX/stylesheets/themes';

if ($handle = opendir($themes_path)) {
	while (false !== ($entry = readdir($handle))) {
		if ($entry != "." && $entry != "..") {
			$themes[] = "$entry";
		}
	}
	closedir($handle);
}

echo '<label>' . elgg_echo('hj:themex:select_theme') . '</label>';
echo elgg_view('input/dropdown', array(
	'name' => 'params[theme]',
	'options' => $themes,
	'value' => $vars['entity']->theme
));
?>