<?php

namespace hypeJunction\GameMechanics;

$limit = get_input('limit', 0);
$offset = get_input('offset', 0);

$badge_types = get_badge_types();

if (elgg_is_admin_logged_in()) {
	$sortable = " elgg-state-sortable";
} else {
	unset($badge_types['surprise']);
}

$content = '';
foreach ($badge_types as $type => $name) {
	$badges = get_badges_by_type($type, array(
		'limit' => $limit,
		'offset' => $offset,
	));
	if ($badges) {
		$list = elgg_view_entity_list($badges, array(
			'full_view' => false,
			'list_type' => 'gallery',
			'gallery_class' => 'gm-badge-gallery',
			'item_class' => 'gm-badge-item' . $sortable,
			'sortable' => (!empty($sortable)),
		));
		$content .= elgg_view_module('aside', elgg_echo('badge_type:value:' . $type), $list);
	}
}

if (!$content) {
	echo '<p>' . elgg_echo('mechanics:badges:empty') . '</p>';
} else {
	echo $content;
}