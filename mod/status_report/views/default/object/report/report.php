<?php

echo elgg_view('output/text', array('value' => $vars['entity']->date));
echo elgg_view('output/text', array('value' => $vars['entity']->project_summary));
echo elgg_view('output/text', array('value' => $vars['entity']->project_team));
echo elgg_view('output/dropdown', array('value' => $vars['entity']->schedule_grade);
echo elgg_view('output/dropdown', array('value' => $vars['entity']->schedule_previous_grade));
echo elgg_view('output/text', array('value' => $vars['entity'] ->$vars['guid']));

?>
