<?php
/**
 *
 * content.php
 *
*/
$userGuid = elgg_get_logged_in_user_guid();
$user = elgg_get_logged_in_user_entity();
$userName = $user->username;
$name = $user->name;

//logout link
$logout = elgg_view('output/url', array(
	'href' => 'action/logout',
	'text' => elgg_echo('logout'),
	'is_trusted' => true,
));

//create instance of the NetworkWidget class
$network = new NetworkWidget();

//get number of friends
$numOfFriends = $network->numOfEntitiesFromRelationship('user', 'friend', $network->userGuid);
$friendsLink = elgg_get_site_url()."friends/".$network->userName;

//get number of users files
$numOfFiles = $network->numOfEntities('file', $network->userGuid);
$filesLink = elgg_get_site_url()."file/owner/".$network->userName;

//get number of groups
$numOfGroups = $network->numOfEntitiesFromRelationship('group', 'member', $network->userGuid);
$groupsLink = elgg_get_site_url()."groups/all?filter=yours";

//get number of active group invites
$numOfGroupInvs = $network->numOfEntitiesFromRelationship('group', 'invited', $network->userGuid, TRUE);
$invsLink = elgg_get_site_url()."groups/invitations/".$network->userName;

//get number of user bookmarks
$numOfBkmrks = $network->numOfEntities('bookmarks', $network->userGuid);
$bkmrksLink = elgg_get_site_url()."bookmarks/owner/".$network->userName;

//get number of unread subscribed forum notifications
$numOfUnreadForums = $network->numOfEntitiesFromMetadata('messages', $network->userGuid, TRUE, array('fromId' => 1, 'readYet' => 0));

$numOfSubscrbForumMsgs = $network->numOfEntitiesFromMetadata('messages', $network->userGuid, FALSE, array('fromId' => 1));
$msgId = $numOfSubscrbForumMsgs[0]->guid; //get the id for the chain of subscribed forum notifications
$msgsLink = elgg_get_site_url()."messages/read/".$msgId;

echo "<div class='widget-your-network'>
		<a href='' class='tooltip-icon tooltip bottom tip-active' data-tool='".elgg_echo('widget_manager:widgets:your_network:tooltip')."'><img src='".elgg_get_site_url().'mod/wettoolkit/graphics/information.png'."' alt='Tooltip' /></a>
		<h3 class='widget-header'>".elgg_echo('widget_manager:widgets:your_network:welcome', array($name))."</h3>
		<div class='my-profile clearfix'>
			<div class='profile-avatar'>
				<a href='".elgg_get_site_url()."profile/".$userName."'><img src='".$user->getIconURL('large')."' /></a>
			</div>
			<div class='edit-profile'>
				<a href='".elgg_get_site_url()."profile/".$userName."'>".elgg_echo('widget_manager:widgets:your_network:edit')."</a>
				<a href='".elgg_get_site_url()."settings/user/".$userName."'>".elgg_echo('widget_manager:widgets:your_network:settings')."</a>
				".$logout."
			</div>
		</div>
		<ul>
			<li><a href='".$friendsLink."'>".elgg_echo('widget_manager:widgets:your_network:colleagues')."</a> <span>".$numOfFriends."</span></li>
			<li><a href='".$filesLink."'>".elgg_echo('widget_manager:widgets:your_network:myfiles')."</a> <span>".$numOfFiles."</span></li>
			<li><a href='".$groupsLink."'>".elgg_echo('widget_manager:widgets:your_network:mygroups')."</a> <span>".$numOfGroups."</span></li>
			<li><a href='".$bkmrksLink."'>".elgg_echo('widget_manager:widgets:your_network:mybookmarks')."</a> <span>".$numOfBkmrks."</span></li>
			<li><a href='".$invsLink."'>".elgg_echo('widget_manager:widgets:your_network:groupinvites')."</a> <span>".$numOfGroupInvs."</span></li>
		</ul>
	</div>
	";
	//<a href='".$lmsLink."'' class='widget-button'>".elgg_echo('widget_manager:widgets:your_network:mylearning')."</a>

