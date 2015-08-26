<?php
/**
 * Edit a page
 *
 * @package ElggPages
 */

gatekeeper();

$page_guid = (int)get_input('guid');
$revision = (int)get_input('annotation_id');
$page = get_entity($page_guid);
if (!page) {
	register_error(elgg_echo('noaccess'));
	forward('');
}

//check if a page is checked out
if($page->checkedOut && $page->checkedOut != elgg_get_logged_in_user_guid()){
		pages_check_if_checked_out($page);
}
else{
	//let's check out the page to the current user
	$userGuid = elgg_get_logged_in_user_guid();
	if(check_out_page($page, $userGuid)){
		system_message(elgg_echo('pages:checked_out'));
	}
}

$container = $page->getContainerEntity();
if (!$container) {
	register_error(elgg_echo('noaccess'));
	forward('');
}

elgg_set_page_owner_guid($container->getGUID());

elgg_push_breadcrumb($page->title, $page->getURL());
elgg_push_breadcrumb(elgg_echo('edit'));

$title = elgg_echo("pages:edit");

if ($page->canEdit()) {

	if ($revision) {
		$revision = elgg_get_annotation_from_id($revision);
		if (!$revision || !($revision->entity_guid == $page_guid)) {
			register_error(elgg_echo('pages:revision:not_found'));
			forward(REFERER);
		}
	}

	$vars = pages_prepare_form_vars($page, $page->parent_guid, $revision);

	$content = elgg_view_form('pages/edit', array(), $vars);

	$NewFeature = new NewFeatureTour();
	if(!$NewFeature->hasReadDialog('pageFeature')){
		$content .= "<div id='dialog-new-feature' title='New Feature'>
	  					<p>".elgg_echo('pages:dialog_text')."</p>
	  				</div>"; 
	  	$NewFeature->markAsRead('pageFeature');
	}
} else {
	$content = elgg_echo("pages:noaccess");
}

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);
