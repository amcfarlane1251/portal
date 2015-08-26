<?php

namespace hypeJunction\GameMechanics;

$badge_rules = elgg_extract('value', $vars, false);

$options_values = array(
	'' => elgg_echo('mechanics:select')
);

$system_rules = get_scoring_rules('events');

foreach ($system_rules as $rule_name => $rule_options) {
	if (elgg_get_plugin_setting($rule_name, PLUGIN_ID)) {
		$options_values[$rule_name] = $rule_options['title'];
	}
}

for ($i = 0; $i <= 9; $i++) {

	if ($badge_rules) {
		if (isset($badge_rules['name'])) {
			$rule = array(
				'name' => $badge_rules['name'][$i],
				'recurse' => $badge_rules['recurse'][$i],
				'guid' => $badge_rules['guid'][$i]
			);
		} else {
			$rule = elgg_extract($i, $badge_rules, false);
			if (is_numeric($rule)) {
				$rule_entity = get_entity($rule);
			} else if (elgg_instanceof($rule)) {
				$rule_entity = $rule;
			}
		}
	}

	echo '<div class="clearfix">';
	echo '<div class="elgg-col elgg-col-2of3">';
	echo '<label>' . elgg_echo('mechanics:badges:rule') . '</label>';
	echo elgg_view('input/dropdown', array(
		'name' => 'rules[name][]',
		'options_values' => $options_values,
		'value' => ($rule_entity) ? $rule_entity->annotation_value : elgg_extract('name', $rule, ''),
	));
	echo '</div>';

	echo '<div class="elgg-col elgg-col-1of3">';
	echo '<label>' . elgg_echo('mechanics:badges:recurse') . '</label>';
	echo elgg_view('input/text', array(
		'name' => 'rules[recurse][]',
		'value' => ($rule_entity) ? $rule_entity->recurse : elgg_extract('recurse', $rule, ''),
	));
	echo '</div>';
	echo elgg_view('input/hidden', array(
		'name' => 'rules[guid][]',
		'value' => ($rule_entity) ? $rule_entity->guid : elgg_extract('guid', $rule, ''),
	));
	echo '</div>';
}