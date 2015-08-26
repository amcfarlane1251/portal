<?php
	/**
	 * View a single page
	 *
	 * @package ElggPages
	 */
	
	$page_guid = (int) get_input('guid');
	$page = get_entity($page_guid);
	if (!$page) {
		forward();
	}
	
	// load pages library
	elgg_load_library('elgg:pages');
	
	elgg_set_page_owner_guid($page->getContainerGUID());
	
	group_gatekeeper();
	
	$container = elgg_get_page_owner_entity();
	
	$title = $page->title;
	
	// make breadcrumb
	elgg_push_breadcrumb(elgg_echo("pages"), "pages/all");
	if (elgg_instanceof($container, 'group')) {
		elgg_push_breadcrumb($container->name, "pages/group/$container->guid/all");
	} else {
		elgg_push_breadcrumb($container->name, "pages/owner/$container->username");
	}
	pages_prepare_parent_breadcrumbs($page);
	elgg_push_breadcrumb($title);

	if($page->checkedOut){
		$content = "<p>".elgg_echo('pages:checked_out_by', array(get_entity($page->checkedOut)->name))."<p/>";
		if(elgg_get_logged_in_user_guid() == $page->checkedOut || (elgg_instanceof($container, 'group') && $container->canEdit())){
			$ts = time();
			$tk = generate_action_token($ts);
			elgg_register_menu_item('title', array(
				'name' => 'check',
				'href' => "/action/pages/checkin?pageGuid=$page->guid&__elgg_ts=$ts&__elgg_token=$tk",
				'text' => elgg_echo('pages:checkin'),
				'link_class' => 'elgg-button elgg-button-action',
			));
		}
	}

	$content .= elgg_view_entity($page, array('full_view' => true));
	
	if($page->allow_comments != "no"){
		$content .= elgg_view_comments($page);
	}

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
	
	elgg_load_css("lightbox");
	elgg_load_js("lightbox");
	
	elgg_register_menu_item('title', array(
						'name' => 'export',
						'href' => "pages/export/" . $page->getGUID(),
						'text' => elgg_echo('export'),
						'link_class' => 'elgg-button elgg-button-action pages-tools-lightbox',
	));
	
	$body = elgg_view_layout('content', array(
		'filter' => '',
		'content' => $content,
		'title' => $title,
		'sidebar' => elgg_view('pages/sidebar/navigation'),
	));
	
	echo elgg_view_page($title, $body);
