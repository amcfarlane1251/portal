<?php

/* Manually check in a page
***************************/
$pageGuid = get_input('pageGuid');
$page = get_entity($pageGuid);

if($page->deleteMetadata("checkedOut")){
	system_message(elgg_echo('pages:checked_in'));
}
else{
	system_message('Error checking in page');
}
forward(REFERER);
