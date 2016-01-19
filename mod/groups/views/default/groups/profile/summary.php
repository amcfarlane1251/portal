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
	//if subgroups are allowed by settings, show tooltip for Subgroup
	if ($group->subgroups_enable == "yes") {
		echo "
    	<li data-class='elgg-menu-item-add-subgroup' data-text='".elgg_echo('widget_manager:widgets:next')."' data-prev-text='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:bottom;tipAnimation:fade'>
        	<h2>".elgg_echo('groups:menu:subgroup:tooltipTitle')."</h2>
        	<p>".elgg_echo('groups:menu:subgroup:tooltip')."</p>
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
	    //if the user is the admin, show tooltip for Join button
	    if ($group->canEdit()) {
	    	echo "
	    	<li data-class='elgg-menu-item-groups-join' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
	        	<h2>".elgg_echo('groups:menu:join:tooltipTitle')."</h2>
	        	<p>".elgg_echo('groups:menu:join:tooltip')."</p>
	    	</li>";
	    }
	    //else if the user is just the group member
	    else {
	    	//if group members can invite by settings, show tooltip for Invite button
	    	if ($group->invite_members) {
		    echo "
		    <li data-class='elgg-menu-item-groups-invite' data-text='".elgg_echo('widget_manager:widgets:next')."' data-prev-text='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:bottom;tipAnimation:fade'>
		        <h2>".elgg_echo('groups:menu:invite:tooltipTitle')."</h2>
		        <p>".elgg_echo('groups:menu:invite:tooltip')."</p>
	    	</li>";
    		}
	    }
	}
	//if the group allows subgroups and allows any member to create subgroups
	if ($group->subgroups_enable == "yes" && $group->subgroups_members_create_enable == 'yes') {
		echo "
    	<li data-class='elgg-menu-item-add-subgroup' data-text='".elgg_echo('widget_manager:widgets:next')."' data-prev-text='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:bottom;tipAnimation:fade'>
        	<h2>".elgg_echo('groups:menu:subgroup:tooltipTitle')."</h2>
        	<p>".elgg_echo('groups:menu:subgroup:tooltip')."</p>
    	</li>";
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
		echo "
	    <li data-class='elgg-menu-item-groups-joinrequest' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
	        <h2>".elgg_echo('groups:menu:joinrequest:tooltipTitle')."</h2>
	        <p>".elgg_echo('groups:menu:joinrequest:tooltip')."</p>
	    </li>";
	}
}

echo "
</ol>";
?>

