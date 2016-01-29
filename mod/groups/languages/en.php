<?php
/**
 * Elgg groups plugin language pack
 *
 * @package ElggGroups
 */

$english = array(

	/**
	 * Menu items and titles
	 */
	'groups' => "Groups",
	'groups:owned' => "Groups I own",
	'groups:owned:user' => 'Groups %s owns',
	'groups:yours' => "My groups",
	'groups:user' => "%s's groups",
	'groups:all' => "All groups",
	'groups:add' => "Create a new group",
	'groups:edit' => "Edit group",
	'groups:copy' => "Copy Group",
	'groups:delete' => 'Delete group',
	'groups:membershiprequests' => 'Manage join requests',
	'groups:membershiprequests:pending' => 'Manage join requests (%s)',
	'groups:invitations' => 'Group invitations',
	'groups:invitations:pending' => 'Group invitations (%s)',
	'groups:inherit_members' => 'Copy Group Members?',
	'groups:inherit_files' => 'Copy Group Files?',
	'groups:inherit_forums' => 'Copy Group Forums?',

	'groups:icon' => 'Group icon (leave blank to leave unchanged)',
	'groups:name' => 'Group name',
	'groups:username' => 'Group short name (displayed in URLs, alphanumeric characters only)',
	'groups:description' => 'Description',
	'groups:briefdescription' => 'Brief description',
	'groups:interests' => 'Tags',
	'groups:website' => 'Website',
	'groups:members' => 'Group members',
	'groups:my_status' => 'My status',
	'groups:my_status:group_owner' => 'You own this group',
	'groups:my_status:group_member' => 'You are in this group',
	'groups:subscribed' => 'Group notifications on',
	'groups:unsubscribed' => 'Group notifications off',

	'groups:members:title' => 'Members of %s',
	'groups:members:more' => "View all members",
	'groups:membership' => "Group membership permissions",
	'groups:access' => "Access permissions",
	'groups:owner' => "Owner",
	'groups:owner:warning' => "Warning: if you change this value, you will no longer be the owner of this group.",
	'groups:widget:num_display' => 'Number of groups to display',
	'groups:widget:membership' => 'Group membership',
	'groups:widgets:description' => 'Display the groups you are a member of on your profile',
	'groups:noaccess' => 'No access to group',
	'groups:permissions:error' => 'You do not have the permissions for this',
	'groups:ingroup' => 'in the group',
	'groups:cantcreate' => 'You can not create a group. Only admins can.',
	'groups:cantedit' => 'You can not edit this group',
	'groups:saved' => 'Group saved',
	'groups:featured' => 'Featured groups',
	'groups:makeunfeatured' => 'Unfeature',
	'groups:makefeatured' => 'Make featured',
	'groups:featuredon' => '%s is now a featured group.',
	'groups:unfeatured' => '%s has been removed from the featured groups.',
	'groups:featured_error' => 'Invalid group.',
	'groups:joinrequest' => 'Request membership',
	'groups:join' => 'Join group',
	'groups:leave' => 'Leave group',
	'groups:leave:warning' => 'Are you sure you want to leave this group?',
	'groups:invite' => 'Invite friends',
	'groups:invite:title' => 'Invite friends to this group',
	'groups:inviteto' => "Invite friends to '%s'",
	'groups:nofriends' => "You have no friends left who have not been invited to this group.",
	'groups:nofriendsatall' => 'You have no friends to invite!',
	'groups:viagroups' => "via groups",
	'groups:group' => "Group",
	'groups:search:tags' => "tag",
	'groups:search:title' => "Search for groups tagged with '%s'",
	'groups:search:none' => "No matching groups were found",
	'groups:search_in_group' => "Search in this group",
	'groups:acl' => "Group: %s",

	'discussion:notification:topic:subject' => 'New group discussion post',
	'groups:notification' =>
'%s added a new discussion topic to %s:

%s
%s

View and reply to the discussion:
%s
',

	'discussion:notification:reply:body' =>
'%s replied to the discussion topic %s in the group %s:

%s

View and reply to the discussion:
%s
',

	'groups:activity' => "Group activity",
	'groups:enableactivity' => 'Enable group activity',
	'groups:activity:none' => "There is no group activity yet",

	'groups:notfound' => "Group not found",
	'groups:notfound:details' => "The requested group either does not exist or you do not have access to it",

	'groups:requests:none' => 'There are no current membership requests.',

	'groups:invitations:none' => 'There are no current invitations.',

	'item:object:groupforumtopic' => "Discussion topics",

	'groupforumtopic:new' => "Add discussion post",

	'groups:count' => "groups created",
	'groups:open' => "open group",
	'groups:closed' => "closed group",
	'groups:member' => "members",
	'groups:searchtag' => "Search for groups by tag",

	'groups:more' => 'More groups',
	'groups:none' => 'No groups',


	/*
	 * Access
	 */
	'groups:access:private' => 'Closed - Users must be invited',
	'groups:access:public' => 'Open - Any user may join',
	'groups:access:group' => 'Group members only',
	'groups:closedgroup' => 'This group has a closed membership.',
	'groups:closedgroup:request' => 'To ask to be added, click the "request membership" menu link.',
	'groups:visibility' => 'Who can see this group?',

	/*
	Group tools
	*/
	'groups:enableforum' => 'Enable group discussion',
	'groups:yes' => 'yes',
	'groups:no' => 'no',
	'groups:lastupdated' => 'Last updated %s by %s',
	'groups:lastcomment' => 'Last comment %s by %s',

	/*
	Group discussion
	*/
	'discussion' => 'Discussion',
	'discussion:add' => 'Add discussion topic',
	'discussion:latest' => 'Latest discussion',
	'discussion:group' => 'Group discussion',
	'discussion:none' => 'No discussion',
	'discussion:reply:title' => 'Reply by %s',

	'discussion:topic:created' => 'The discussion topic was created.',
	'discussion:topic:updated' => 'The discussion topic was updated.',
	'discussion:topic:deleted' => 'Discussion topic has been deleted.',

	'discussion:topic:notfound' => 'Discussion topic not found',
	'discussion:error:notsaved' => 'Unable to save this topic',
	'discussion:error:missing' => 'Both title and message are required fields',
	'discussion:error:permissions' => 'You do not have permissions to perform this action',
	'discussion:error:notdeleted' => 'Could not delete the discussion topic',

	'discussion:reply:deleted' => 'Discussion reply has been deleted.',
	'discussion:reply:error:notdeleted' => 'Could not delete the discussion reply',

	'reply:this' => 'Reply to this',

	'group:replies' => 'Replies',
	'groups:forum:created' => 'Created %s with %d comments',
	'groups:forum:created:single' => 'Created %s with %d reply',
	'groups:forum' => 'Discussion',
	'groups:addtopic' => 'Add a topic',
	'groups:forumlatest' => 'Latest discussion',
	'groups:latestdiscussion' => 'Latest discussion',
	'groups:newest' => 'Newest',
	'groups:popular' => 'Popular',
	'groupspost:success' => 'Your reply was succesfully posted',
	'groups:alldiscussion' => 'Latest discussion',
	'groups:edittopic' => 'Edit topic',
	'groups:topicmessage' => 'Topic message',
	'groups:topicstatus' => 'Topic status',
	'groups:reply' => 'Post a comment',
	'groups:topic' => 'Topic',
	'groups:posts' => 'Posts',
	'groups:lastperson' => 'Last person',
	'groups:when' => 'When',
	'grouptopic:notcreated' => 'No topics have been created.',
	'groups:topicopen' => 'Open',
	'groups:topicclosed' => 'Closed',
	'groups:topicresolved' => 'Resolved',
	'grouptopic:created' => 'Your topic was created.',
	'groupstopic:deleted' => 'The topic has been deleted.',
	'groups:topicsticky' => 'Sticky',
	'groups:topicisclosed' => 'This discussion is closed.',
	'groups:topiccloseddesc' => 'This discussion is closed and is not accepting new comments.',
	'grouptopic:error' => 'Your group topic could not be created. Please try again or contact a system administrator.',
	'groups:forumpost:edited' => "You have successfully edited the forum post.",
	'groups:forumpost:error' => "There was a problem editing the forum post.",


	'groups:privategroup' => 'This group is closed. Requesting membership.',
	'groups:notitle' => 'Groups must have a title',
	'groups:cantjoin' => 'Can not join group',
	'groups:cantleave' => 'Could not leave group',
	'groups:removeuser' => 'Remove from group',
	'groups:cantremove' => 'Cannot remove user from group',
	'groups:removed' => 'Successfully removed %s from group',
	'groups:addedtogroup' => 'Successfully added the user to the group',
	'groups:joinrequestnotmade' => 'Could not request to join group',
	'groups:joinrequestmade' => 'Requested to join group',
	'groups:joined' => 'Successfully joined group!',
	'groups:left' => 'Successfully left group',
	'groups:notowner' => 'Sorry, you are not the owner of this group.',
	'groups:notmember' => 'Sorry, you are not a member of this group.',
	'groups:alreadymember' => 'You are already a member of this group!',
	'groups:userinvited' => 'User has been invited.',
	'groups:usernotinvited' => 'User could not be invited.',
	'groups:useralreadyinvited' => 'User has already been invited',
	'groups:invite:subject' => "%s you have been invited to join %s!",
	'groups:updated' => "Last reply by %s %s",
	'groups:started' => "Started by %s",
	'groups:joinrequest:remove:check' => 'Are you sure you want to remove this join request?',
	'groups:invite:remove:check' => 'Are you sure you want to remove this invitation?',
	'groups:invite:body' => "Hi %s,

%s invited you to join the '%s' group. Click below to view your invitations:

%s",

	'groups:welcome:subject' => "Welcome to the %s group!",
	'groups:welcome:body' => "Hi %s!

You are now a member of the '%s' group! Click below to begin posting!

%s",

	'groups:request:subject' => "%s has requested to join %s",
	'groups:request:body' => "Hi %s,

%s has requested to join the '%s' group. Click below to view their profile:

%s

or click below to view the group's join requests:

%s",

	/*
		Forum river items
	*/

	'river:create:group:default' => '%s created the group %s',
	'river:join:group:default' => '%s joined the group %s',
	'river:create:object:groupforumtopic' => '%s added a new discussion topic %s',
	'river:reply:object:groupforumtopic' => '%s replied on the discussion topic %s',
	
	'groups:nowidgets' => 'No widgets have been defined for this group.',


	'groups:widgets:members:title' => 'Group members',
	'groups:widgets:members:description' => 'List the members of a group.',
	'groups:widgets:members:label:displaynum' => 'List the members of a group.',
	'groups:widgets:members:label:pleaseedit' => 'Please configure this widget.',

	'groups:widgets:entities:title' => "Objects in group",
	'groups:widgets:entities:description' => "List the objects saved in this group",
	'groups:widgets:entities:label:displaynum' => 'List the objects of a group.',
	'groups:widgets:entities:label:pleaseedit' => 'Please configure this widget.',

	'groups:forumtopic:edited' => 'Forum topic successfully edited.',

	'groups:allowhiddengroups' => 'Do you want to allow private (invisible) groups?',
	'groups:whocancreate' => 'Who can create new groups?',

	/**
	 * Action messages
	 */
	'group:deleted' => 'Group and group contents deleted',
	'group:notdeleted' => 'Group could not be deleted',

	'group:notfound' => 'Could not find the group',
	'grouppost:deleted' => 'Group posting successfully deleted',
	'grouppost:notdeleted' => 'Group posting could not be deleted',
	'groupstopic:deleted' => 'Topic deleted',
	'groupstopic:notdeleted' => 'Topic not deleted',
	'grouptopic:blank' => 'No topic',
	'grouptopic:notfound' => 'Could not find the topic',
	'grouppost:nopost' => 'Empty post',
	'groups:deletewarning' => "Are you sure you want to delete this group? There is no undo!",

	'groups:invitekilled' => 'The invite has been deleted.',
	'groups:joinrequestkilled' => 'The join request has been deleted.',

	// ecml
	'groups:ecml:discussion' => 'Group Discussions',
	'groups:ecml:groupprofile' => 'Group profiles',

	/*
	 Joyride Tooltip context - Group Summary Page
	 */
	 //Group Menu Buttons tooltips
	'groups:menu:edit:tooltipTitle' => "Edit Group",
	'groups:menu:edit:tooltip' => "Here to edit or add any information about the group, also enable and disable features from the group.",
	'groups:menu:invite:tooltipTitle' => "Invite Users",
	'groups:menu:invite:tooltip' => "You will be able to invite other members to this group.",
	'groups:menu:copy:tooltipTitle' => "Copy Group",
	'groups:menu:copy:tooltip' => "Create the new copy of the group based off your choice. Copying a group will not delete the old group.",
	'groups:menu:join:tooltipTitle' => "Join The Group",
	'groups:menu:join:tooltip' => "If you are interested in being a member of this group, click here to join directly.",
	'groups:menu:joinrequest:tooltipTitle' => "Request to Join the Group",
	'groups:menu:joinrequest:tooltip' => "This is a closed group. To join this group, you must send a request to the group owner. When approved, you will be a member of the group.",
	'groups:menu:leave:tooltipTitle' => "Leave The Current Group",
	'groups:menu:leave:tooltip' => "If you want to leave this group, click here to quit. You will still be able to join the group later if you changed your mind.",
	'groups:menu:subgroup:tooltipTitle' => "Create a Sub-Group",
	'groups:menu:subgroup:tooltip' => "You can choose to make sub-groups for their group. Doing so will take the user to a create group page with the same options as when they created the main group.",
	//Group Icons
	'groups:icon:addbookmark:tooltipTitle' => "Bookmark this page",
	'groups:icon:addbookmark:tooltip' => "Bookmarks are similar to using 'favourites' in a web browser. You can add this group into your bookmarks, so that you can easily visit the page of the group later.",
	'groups:icon:rss:tooltipTitle' => "RSS feed for this page",
	'groups:icon:rss:tooltip' => "This is an activity feed of frequently changing content on this page. You can subscribe to this activity feed to receive updates when the content changes.",
	//Group Description
	'groups:profile:description:tooltipTitle' => "Group Description",
	'groups:profile:description:tooltip' => "Find out more details about the group.",
	//Group Sidebar
	'groups:menu:sidebar:tooltipTitle' => "Group Sidebar",
	'groups:menu:sidebar:tooltip' => "The group sidebar acts as a navigation panel for viewing and navigating the group’s resources.",
	//Sub-Groups List
	'groups:module:subgroup:tooltipTitle' => "Sub-Groups",
	'groups:module:subgroup:tooltip' => "In the sidebar the user can see all of the sub-groups of their group. This section will display a few featured sub-groups and to view the rest the user can select to ‘view all sub-groups’ below.",
	//Group Search Box
	'groups:form:search:tooltipTitle' => "Search Box",
	'groups:form:search:tooltip' => "Searching will look for everything done in the group that relates to the input provided. This includes forum posts, videos, files, etc…",
	//Group Members List
	'groups:gallery:users:tooltipTitle' => "Group Members",
	'groups:gallery:users:tooltip' => "The group member’s panel will feature some of the most recent people to join the group. The user can view all of the members of the group by clicking ‘view all members’ located below the featured members.",
	//Group Plug-ins
	'groups:tools:tooltipTitle' => "Group Main Page",
	'groups:tools:tooltip' => "The group main page allows users to view all of the resources posted under that group. All of the content that has been posted is categorized and displayed on the main page.",

	/*
	 Joyride Tooltip context - Groups List Page
	 */
	 //Create Group Button
	'groups:button:create:tooltipTitle' => "Create Group",
	'groups:button:create:tooltip' => "The ‘Create Group’ button that allows you to create your own group that will allow you to create, manage and administrate your own group.",
	//Group Tabs
	'groups:tab:newest:tooltipTitle' => "Newest",
	'groups:tab:newest:tooltip' => "Displays the newest groups on the Learning Portal.",
	'groups:tab:yours:tooltipTitle' => "My groups",
	'groups:tab:yours:tooltip' => "Displays groups that you own or are a part of.",
	'groups:tab:popular:tooltipTitle' => "Popular",
	'groups:tab:popular:tooltip' => "Displays the most popular groups on the Learning Portal.",
	'groups:tab:discussion:tooltipTitle' => "Latest discussion",
	'groups:tab:discussion:tooltip' => "Displays the groups with a recent discussion.",
	'groups:tab:open:tooltipTitle' => "Open groups",
	'groups:tab:open:tooltip' => "Open displays groups that are open to join.",
	'groups:tab:closed:tooltipTitle' => "Closed groups",
	'groups:tab:closed:tooltip' => "Closed displays groups that cannot be joined.",
	'groups:tab:alpha:tooltipTitle' => "Alphabetical",
	'groups:tab:alpha:tooltip' => "Displays the groups in alphabetical order.",
	'groups:tab:suggested:tooltipTitle' => "Suggested",
	'groups:tab:suggested:tooltip' => "Displays groups that you may be interested in.",
	//Groups Side Nav
	'groups:nav:sidebar:tooltipTitle' => "Sidebar",
	'groups:nav:sidebar:tooltip' => "A filter that allows you to filter what is displayed on the main page. You can choose from displaying all groups which is displayed above, only showing your groups your apart of, displaying groups you own and displaying group invitations you have received.",
	//Groups Search
	'groups:search:groups:tooltipTitle' => "Search for groups",
	'groups:search:groups:tooltip' => "You can search for groups using the search box as shown.",

	/*
	 Joyride Tooltip context - Create/Edit Group Page
	 */
	 //Edit Group Icon
	'groups:edit:icon:tooltipTitle' => "Group Icon",
	'groups:edit:icon:tooltip' => "You will be able to optionally upload a picture to be used as your group icon.",
	//Edit Group Title
	'groups:edit:title:tooltipTitle' => "Group Name",
	'groups:edit:title:tooltip' => "You will be required to give a name to your group.",
	//Edit Group Description
	'groups:edit:description:tooltipTitle' => "Group Description",
	'groups:edit:description:tooltip' => "You will be able to optionally give a description to your group to let others know your group better.",
	//Edit Group permissions
	'groups:edit:permission:tooltipTitle' => "Group membership permissions",
	'groups:edit:permission:tooltip' => "In the dropdown list you can choose who can join the group. You have the option of allowing anyone to join the group or by invite only.",
	//Edit Who can see this group
	'groups:edit:access:tooltipTitle' => "Who can see this group?",
	'groups:edit:access:tooltip' => "You have the option of only allowing group members to see the group, logged in users, or everyone on the Learning Portal.",
	//Enable/Disable Group Features
	'groups:edit:features:tooltipTitle' => "Enable/Disable Group Features",
	'groups:edit:features:tooltip' => "You have the ability of enabling or disabling features from your group. This allows you to create groups to fit your needs by enabling features they need, or disabling features you don’t.",
);

add_translation("en", $english);
