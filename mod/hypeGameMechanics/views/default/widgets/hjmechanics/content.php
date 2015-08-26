<?php

namespace hypeJunction\GameMechanics;

$user = elgg_get_page_owner_entity();

echo "<h3 class='widget-header'>".elgg_echo('mechanics:widget:title')."</h3>";

echo elgg_view('framework/mechanics/user_score', array(
	'entity' => $user
));

echo elgg_view('framework/mechanics/user_badges', array(
	'entity' => $user
));