<?php
/**
 *
 * return all river items related to a users friends
*/

$userGuid = elgg_get_logged_in_user_guid();

$river_options_friends = array(
		"pagination" => false,
		"limit" => 10,
		"type_subtype_pairs" => array(),
		"relationship_guid" => $userGuid,
		"relationship" => 'friend',
);

$friend_activity = elgg_list_river($river_options_friends);

return $friend_activity;