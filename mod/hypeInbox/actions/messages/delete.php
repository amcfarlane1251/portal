<?php

$hashes = get_input('hashes');
$guids = get_input('guids');
$owner_guid = get_input('owner_guid', elgg_get_logged_in_user_guid());

$error = $success = $persistent = $notfound = 0;

$message_types = elgg_get_config('inbox_message_types');
if ($hashes) {
	foreach ($hashes as $hash) {
		$options = array(
			'types' => 'object',
			'subtypes' => 'messages',
			'owner_guid' => $owner_guid,
			'metadata_name_value_pairs' => array(
				'name' => 'msgHash', 'value' => $hash,
			),
			'limit' => 0,
		);

		$batch = new ElggBatch('elgg_get_entities_from_metadata', $options);
		foreach ($batch as $message) {
			if (!$message_types[$message->msgType]['persistent']) {
				if (!$message->delete()) {
					$error++;
				} else {
					$success++;
				}
			} else {
				$persistent++;
			}
		}
	}
}

if ($guids) {
	foreach ($guids as $guid) {
		$message = get_entity($guid);
		if (!elgg_instanceof($message, 'object', 'messages')) {
			$notfound++;
			continue;
		}
		if (!$message_types[$message->msgType]['persistent']) {
			if (!$message->delete()) {
				$error++;
			} else {
				$success++;
			}
		} else {
			$persistent++;
		}
	}
}

$count = $success + $error + $notfound + $persistent;

$msg[] = elgg_echo('hj:inbox:delete:success', array($success, $count));
$status = "success";
if ($notfound > 0) {
	$msg[] = elgg_echo('hj:approve:error:notfound', array($notfound));
	$status = "fail";
}
if ($persistent > 0) {
	$msg[] = elgg_echo('hj:approve:error:canedit', array($persistent));
	$status = "fail";
}
if ($error > 0) {
	$msg[] = elgg_echo('hj:approve:error:unknown', array($error));
	$status = "error";
}

system_message(implode('<br />', $msg));
if(elgg_is_xhr()) {
	echo json_encode(array('status'=>$status,'data'=>array('msg'=>$msg[0])));
}