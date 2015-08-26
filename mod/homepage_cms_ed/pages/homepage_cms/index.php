<?php
/*
@file: pages/homepage_cms/index.php
@desc: custom index page for elgg
*/

$hpc_params = array(
		"type"=>"object",
		"subtype"=>"hpcroles"
	);
$allRoles = elgg_get_entities($hpc_params);

$thisGuid = (string)$allRoles[3]->guid;

elgg_set_page_owner_guid($thisGuid);

$title = elgg_view_title('Testing homepage_cms_extension');

//$content .= elgg_get_page_owner_entity()->pagecontent;
$content = elgg_view('page/layouts/widgets',$vars);

$body .= elgg_view_layout('one_column',array('content'=>$content));

echo elgg_view_page($title,$body);
?>