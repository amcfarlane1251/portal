<?php

$limit = get_input('limit', 20);
$offset = get_input('offset', 0);

$user = elgg_get_page_owner_entity();

$message_type = elgg_extract('message_type', $vars, 'all');
$read = elgg_extract('read', $vars, 'all');
if (!in_array($read, array(0, 1))) {
	$read = 'all';
}


$strings = array('toId', $user->guid, 'readYet', $read, 'msgType', $message_type, 'msgHash');
$map = array();
foreach ($strings as $string) {
	$id = get_metastring_id($string);
	if (!$id) {
		$id = add_metastring($string);
	}
	$map[$string] = $id;
}


$dbprefix = elgg_get_config('dbprefix');
$access = get_access_sql_suffix('e', $user->guid);

$subtype_id = get_subtype_id('object', 'messages');
if (!$subtype_id) {
	$subtype_id = add_subtype('object', 'messages');
}

$query = "SELECT COUNT(DISTINCT md.value_id) AS count
			FROM {$dbprefix}metadata md
			JOIN {$dbprefix}entities e ON e.guid = md.entity_guid
			JOIN {$dbprefix}metadata md2 ON md2.entity_guid = md.entity_guid AND md2.name_id = {$map['msgType']}
			WHERE e.type = 'object' AND e.subtype = $subtype_id
				AND md.name_id = {$map['msgHash']}
				AND md2.value_id = {$map[$message_type]}
				AND e.owner_guid = $user->guid
				AND $access";
$count = get_data($query);
$count = $count[0]->count;

if (!$count) {
	echo elgg_autop(elgg_echo('hj:inbox:nomessages'));
	return;
}

$query = "SELECT DISTINCT md.value_id
			FROM {$dbprefix}metadata md
			JOIN {$dbprefix}entities e ON e.guid = md.entity_guid
			JOIN {$dbprefix}metadata md2 ON md2.entity_guid = md.entity_guid AND md2.name_id = {$map['msgType']}
			WHERE e.type = 'object' AND e.subtype = $subtype_id
				AND md.name_id = {$map['msgHash']}
				AND md2.value_id = {$map[$message_type]}
				AND e.owner_guid = $user->guid
				AND $access
			ORDER BY e.time_created DESC";
$hashes = get_data($query);


$options = array(
	'owner_guids' => $user->guid,
	'order_by' => 'e.time_created DESC',
	'limit' => 1,
);

if ($read !== 'all') {
	$options['joins'][] = "JOIN {$dbprefix}metadata msg_readYet on e.guid = msg_readYet.entity_guid";
	$options['wheres'][] = "msg_readYet.name_id='{$map['readYet']}' AND msg_readYet.value_id='{$read}'";
}

if ($message_type !== 'all') {
	$options['joins'][] = "JOIN {$dbprefix}metadata msg_type on e.guid = msg_type.entity_guid";
	$options['wheres'][] = "msg_type.name_id='{$map['msgType']}' AND msg_type.value_id='{$map[$message_type]}'";
}

foreach ($hashes as $hash) {
	$tmp_options = $options;
	$tmp_options['joins'][] = "JOIN {$dbprefix}metadata msg_hash ON e.guid = msg_hash.entity_guid AND msg_hash.name_id='{$map['msgHash']}'";
	$tmp_options['wheres'][] = "msg_hash.value_id = $hash->value_id";

	$tmp_entities = elgg_get_entities($tmp_options);
	$messages[] = $tmp_entities[0];
}
usort($messages, function($a, $b)
{
    return -1 * strcmp($a->time_created, $b->time_created);
});
//check if message thread has unready messages
$tmpArr = array();
foreach($messages as $key => $message) {
	$count_unread = elgg_get_entities_from_metadata(array(
		'types' => 'object',
		'subtypes' => 'messages',
		'owner_guid' => $message->owner_guid,
		'metadata_name_value_pairs' => array(
			array('name' => 'msgHash', 'value' => $message->msgHash),
			array('name' => 'readYet', 'value' => 1, 'operand' => '!=')
		),
		'count' => true
	));
	
	//if already read push to bottom
	if($count_unread <= 0) {
		$tmpArr[] = $message;
		unset($messages[$key]);
	}
}

$messages = array_merge($messages, $tmpArr);
$messages = array_slice($messages, $offset, $limit);

elgg_push_context('inbox-table');
echo "<div class='float-alt'>
		<div class='more-menu-options' style='display:none;'><a id='messages-delete' class='glyphicon delete-button' title='".elgg_echo('hj:inbox:delete:all')."' href='javascript:void(0);'></a></div>
		<a id='messages-select-all' href='javascript:void(0);'>".elgg_echo('hj:inbox:select:all')."</a>
	 </div>";
echo elgg_view_entity_list($messages, array(
	'list_class' => 'inbox-messages-table',
	'full_view' => false,
	'pagination' => true,
	'count' => $count,
	'limit' => $limit,
	'offset' => $offset
));

elgg_pop_context();