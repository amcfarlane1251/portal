<div>
<label>Request Status</label>
<?php
echo elgg_view("input/dr_down", array(
	'name' => 'status',
	'value' => $vars['project']->status,
));
echo '</div>';

echo elgg_view("input/hidden", array(
	'name' => 'guid',
	'value' => $vars['project']->guid,
));

echo elgg_view('input/submit', array('value' => elgg_echo('Update')));