<?php

$livesearch_label = "Enable/disable live search";
$livesearch_input = elgg_view('input/dropdown', array(
	'name' => 'params[livesearch]',
	'value' => $vars['entity']->livesearch,
	'options_values' => array('on' => 'Enabled', 'off' => 'Disabled')
		));

$settings = <<<__HTML
    <hr>

    <h3>Settings</h3>
    <div>
	<p><i>$livesearch_label</i><br />$livesearch_input</p>
    </div>
    </hr>

    <hr>

__HTML;

echo $settings;