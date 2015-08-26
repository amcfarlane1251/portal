<?php
$group = $vars['entity'];

$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt',
);

echo elgg_view_form('groups/copy', $form_vars, array('entity'=>$group));
