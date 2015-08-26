<?php
/**
 * delete a survey submission
 *
*/

$guid = get_input('guid');

$survey = get_entity($guid);

if($survey){
	if($survey->canEdit()){
		if($survey->delete()){
			system_message(elgg_echo('surveys:delete:success'));
			forward('surveys/all');
		}
	}
}

register_error('surveys:delete:failure');
forward(REFERER);