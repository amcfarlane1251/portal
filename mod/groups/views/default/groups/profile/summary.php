<?php
/**
 * Group profile summary
 *
 * Icon and profile fields
 *
 * @uses $vars['group']
 */

if (!isset($vars['entity']) || !$vars['entity']) {
	echo elgg_echo('groups:notfound');
	return true;
}

$group = $vars['entity'];
$owner = $group->getOwnerEntity();

?>
<div class="groups-profile clearfix elgg-image-block">
	<div class="elgg-image">
		<div class="groups-profile-icon">
			<?php echo elgg_view_entity_icon($group, 'large', array('href' => '')); ?>
		</div>
		<div class="groups-stats">
			<p>
				<b><?php echo elgg_echo("groups:owner"); ?>: </b>
				<?php
					echo elgg_view('output/url', array(
						'text' => $owner->name,
						'value' => $owner->getURL(),
						'is_trusted' => true,
					));
				?>
			</p>
			<p>
			<?php
				echo elgg_echo('groups:members') . ": " . $group->getMembers(0, 0, TRUE);
			?>
			</p>
		</div>
	</div>

	<div class="groups-profile-fields elgg-body">
		<?php
			elgg_load_css('bootstrap-css');
			echo elgg_view('groups/profile/fields', $vars);
		?>
	</div>
</div>

<!-- Section For Joyride - Group Summary -->
<?php
echo "<ol id='joyRideTipContent'>";
/*
 *	Top Buttons
 */
//if the user is admin or group owner, show tooltip for Edit, Invite and Copy buttons
if ($group->canEdit()) {
	echo "
		<!--tooltip for Edit group button-->
		<li data-class='elgg-menu-item-groups-edit' data-text='".elgg_echo('widget_manager:widgets:next')."' data-options='tipLocation:bottom;tipAnimation:fade'>
	    	<h2>".elgg_echo('groups:menu:edit:tooltipTitle')."</h2>
	        <p>".elgg_echo('groups:menu:edit:tooltip')."</p>
	    </li>
	    <!--tooltip for Invite users button-->
		<li data-class='elgg-menu-item-groups-invite' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:right;tipAnimation:fade'>
	        <h2>".elgg_echo('groups:menu:invite:tooltipTitle')."</h2>
	        <p>".elgg_echo('groups:menu:invite:tooltip')."</p>
	    </li>
	    <!--tooltip for Copy group button-->
	    <li data-class='elgg-menu-item-groups-copy' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
	        <h2>".elgg_echo('groups:menu:copy:tooltipTitle')."</h2>
	        <p>".elgg_echo('groups:menu:copy:tooltip')."</p>
	    </li>";
    //if the admin is not the member of the current group, show tooltip for Join button
    if (!$group->isMember(elgg_get_logged_in_user_entity())) {
    	echo "
    	<li data-class='elgg-menu-item-groups-join' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        	<h2>".elgg_echo('groups:menu:join:tooltipTitle')."</h2>
        	<p>".elgg_echo('groups:menu:join:tooltip')."</p>
    	</li>";
    }
}
//if the user is the member of the current group
if ($group->isMember(elgg_get_logged_in_user_entity())) {
	//if the user is not the group owner, show tooltip for LEAVE button
	if ($group->getOwnerGUID() != elgg_get_logged_in_user_guid()) {
	    echo "
	    <li data-class='elgg-menu-item-groups-leave' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
	        <h2>".elgg_echo('groups:menu:leave:tooltipTitle')."</h2>
	        <p>".elgg_echo('groups:menu:leave:tooltip')."</p>
	    </li>";
	    //if the user is not the admin,
    	//and group members can invite by settings, show tooltip for Invite button
    	if (!$group->canEdit() && $group->invite_members) {
	    echo "
	    <li data-class='elgg-menu-item-groups-invite' data-text='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:bottom;tipAnimation:fade'>
	        <h2>".elgg_echo('groups:menu:invite:tooltipTitle')."</h2>
	        <p>".elgg_echo('groups:menu:invite:tooltip')."</p>
    	</li>";
		}
	}
}
//else if the user is not in the group and logged in
elseif (elgg_is_logged_in()) {
	//if this is an OPEN group, show the tooltip for JOIN button
	if ($group->isPublicMembership()) {
	    echo "
	    <li data-class='elgg-menu-item-groups-join' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
	        <h2>".elgg_echo('groups:menu:join:tooltipTitle')."</h2>
	        <p>".elgg_echo('groups:menu:join:tooltip')."</p>
	    </li>";
	}
	//if this is a ClOSED group, show the tooltip for REQUEST button
	else {
		if (!$group->canEdit()) {
			echo "
		    <li data-class='elgg-menu-item-groups-joinrequest' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
		        <h2>".elgg_echo('groups:menu:joinrequest:tooltipTitle')."</h2>
		        <p>".elgg_echo('groups:menu:joinrequest:tooltip')."</p>
		    </li>";
		}
	}
}
//if subgroups are allowed by settings
if ($group->subgroups_enable == "yes") {
	//if the user is admin or group owner,
	//or the group allows subgroups and allows any member to create subgroups, show tooltip for Subgroup
	if ($group->canEdit() || ($group->isMember(elgg_get_logged_in_user_entity()) && $group->subgroups_members_create_enable == 'yes')) {
		echo "
    	<li data-class='elgg-menu-item-add-subgroup' data-text='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
	        <h2>".elgg_echo('groups:menu:subgroup:tooltipTitle')."</h2>
	        <p>".elgg_echo('groups:menu:subgroup:tooltip')."</p>
		</li>";
	}
}

/*
 *	Description
 */
echo "
<!-- Tooltip for Group Description -->
<li data-class='groups-profile-fields' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:bottom;tipAnimation:fade'>
    <h2>".elgg_echo('groups:profile:description:tooltipTitle')."</h2>
    <p>".elgg_echo('groups:profile:description:tooltip')."</p>
</li>";

/*
 *	Listing of enabled group plug-ins
 */
//If user is in the group, or user is admin, show the tooltip for group plug-ins
if ($group->isMember(elgg_get_logged_in_user_entity()) || $group->canEdit()) {
	echo "
	<!-- Tooltip for Group Plug-ins -->
	<li data-id='groups-tools' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:right;tipAnimation:fade'>
	    <h2>".elgg_echo('groups:tools:tooltipTitle')."</h2>
	    <p>".elgg_echo('groups:tools:tooltip')."</p>
	</li>";
}

/*
 *	Icons
 */
echo "
<!-- Tooltip for Bookmark icon -->
<li data-class='elgg-menu-item-bookmark' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAdjustmentY:-25;tipAnimation:fade'>
    <h2>".elgg_echo('groups:icon:addbookmark:tooltipTitle')."</h2>
    <p>".elgg_echo('groups:icon:addbookmark:tooltip')."</p>
</li>
<!-- Tooltip for RSS icon -->
<li data-class='elgg-menu-item-rss' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:right;tipAdjustmentY:-25;tipAnimation:fade'>
    <h2>".elgg_echo('groups:icon:rss:tooltipTitle')."</h2>
    <p>".elgg_echo('groups:icon:rss:tooltip')."</p>
</li>";

//If user is not in the group, nor user is admin, show the tooltips for Sub-group List, Search Box & Members List
if (!$group->isMember(elgg_get_logged_in_user_entity()) && !$group->canEdit()) {
/*
 *	Sidebar
 */
	echo "
	<!-- Tooltip for Sidebar -->
	<li data-class='elgg-menu-owner-block' data-button='".elgg_echo('widget_manager:widgets:close')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
	    <h2>".elgg_echo('groups:menu:sidebar:tooltipTitle')."</h2>
	    <p>".elgg_echo('groups:menu:sidebar:tooltip')."</p>
	</li>";
}
else {
/*
 *	Sidebar
 */
	echo "
	<!-- Tooltip for Sidebar -->
	<li data-class='elgg-menu-owner-block' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
	    <h2>".elgg_echo('groups:menu:sidebar:tooltipTitle')."</h2>
	    <p>".elgg_echo('groups:menu:sidebar:tooltip')."</p>
	</li>";
/*
 *	Sub-group List
 */
	//if subgroups are allowed by settings
	if ($group->subgroups_enable == "yes") {
		echo "
		<!-- Tooltip for Sub-group List -->
		<li data-class='elgg-module-aside' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
		    <h2>".elgg_echo('groups:module:subgroup:tooltipTitle')."</h2>
		    <p>".elgg_echo('groups:module:subgroup:tooltip')."</p>
		</li>";
	}
/*
 *	Search Box
 */
	echo "
	<!-- Tooltip for Search Box -->
	<li data-class='elgg-form-groups-search' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
	    <h2>".elgg_echo('groups:form:search:tooltipTitle')."</h2>
	    <p>".elgg_echo('groups:form:search:tooltip')."</p>
	</li>";

/*
 *	Members List
 */
	echo "
	<!-- Tooltip for Members List -->
	<li data-class='elgg-gallery-users' data-button='".elgg_echo('widget_manager:widgets:close')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
	    <h2>".elgg_echo('groups:gallery:users:tooltipTitle')."</h2>
	    <p>".elgg_echo('groups:gallery:users:tooltip')."</p>
	</li>";	
}

echo "
</ol>";
?>

