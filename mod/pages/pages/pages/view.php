<?php
/**
 * View a single page
 *
 * @package ElggPages
 */
error_log('here pages');
$page_guid = get_input('guid');
$page = get_entity($page_guid);
if (!$page) {
	register_error(elgg_echo('noaccess'));
	$_SESSION['last_forward_from'] = current_page_url();
	forward('');
}

elgg_set_page_owner_guid($page->getContainerGUID());

group_gatekeeper();

$container = elgg_get_page_owner_entity();
if (!$container) {
}

$title = $page->title;

if (elgg_instanceof($container, 'group')) {
	elgg_push_breadcrumb($container->name, "pages/group/$container->guid/all");
} else {
	elgg_push_breadcrumb($container->name, "pages/owner/$container->username");
}
pages_prepare_parent_breadcrumbs($page);
elgg_push_breadcrumb($title);

if($page->checkedOut){
	$content = "<p>".elgg_echo('pages:checked_out_by', array(get_entity($page->checkedOut)->name))."<p/>";
}
$content .= elgg_view_entity($page, array('full_view' => true));
$content .= elgg_view_comments($page);

//check to see if user has been notified of the new page feature via jquery UI dialog
$NewFeature = new NewFeatureTour();
	if(!$NewFeature->hasReadDialog('pageFeature')){
		$content .= "<div id='dialog-new-feature' title='New Feature'>
	  					<p>".elgg_echo('pages:dialog_text')."</p>
	  				</div>"; 
	  	$NewFeature->markAsRead('pageFeature');
	}

// can add subpage if can edit this page and write to container (such as a group)
if ($page->canEdit() && $container->canWriteToContainer(0, 'object', 'page')) {
	$url = "pages/add/$page->guid";
	elgg_register_menu_item('title', array(
			'name' => 'subpage',
			'href' => $url,
			'text' => elgg_echo('pages:newchild'),
			'link_class' => 'elgg-button elgg-button-action',
	));
}

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('pages/sidebar/navigation'),
));

echo elgg_view_page($title, $body);
