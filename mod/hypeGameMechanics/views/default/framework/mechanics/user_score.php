<?php

namespace hypeJunction\GameMechanics;

$user = elgg_get_logged_in_user_entity();
$size = elgg_extract('size', $vars);

$score = get_user_score($user);
error_log($score);
$score_str = elgg_echo('mechanics:currentscore', array($score));

if ($status = $user->gm_status) {
	$badge = get_entity($status);
	$status_icon = elgg_view_entity_icon($badge, 'tiny');
	$status_str = elgg_echo('mechanics:currentstatus', array($badge->title));
}

echo elgg_view_image_block($status_icon, $score_str . '<br />' . $status_str);

