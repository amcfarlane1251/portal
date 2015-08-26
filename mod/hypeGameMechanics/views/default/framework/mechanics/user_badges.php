<?php

namespace hypeJunction\GameMechanics;

//$user = elgg_extract('entity', $vars, false);


$userGuid = elgg_get_logged_in_user_guid();

$badges = elgg_get_entities_from_relationship(array(
	'relationship' => HYPEGAMEMECHANICS_CLAIMED_REL,
	'relationship_guid' => $userGuid,
	'inverse_relationship' => false,
	'limit' => 20
		));

if ($badges) {
	echo elgg_view_entity_list($badges, array(
		'full_view' => false,
		'list_type' => 'gallery',
		'icon_size' => 'small',
		'icon_user_status' => false,
		'gallery_class' => 'gm-badge-gallery clearfix',
		'item_class' => 'gm-badge-item'
	));
} else {
	echo '<p>' . elgg_echo('mechanics:user_badges:empty') . '</p>';
}