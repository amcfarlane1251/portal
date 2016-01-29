<?php
/**
 * Group edit form
 * 
 * @package ElggGroups
 */

// new groups default to open membership
if (isset($vars['entity'])) {
	$membership = $vars['entity']->membership;
	$access = $vars['entity']->access_id;
	if ($access != ACCESS_PUBLIC && $access != ACCESS_LOGGED_IN) {
		// group only - this is done to handle access not created when group is created
		$access = ACCESS_PRIVATE;
	}
} else {
	$membership = ACCESS_PUBLIC;
	$access = ACCESS_PUBLIC;
}

?>
<div>
	<label><?php echo elgg_echo("groups:icon"); ?></label><br />
	<?php echo elgg_view("input/file", array('name' => 'icon')); ?>
</div>
<div>
	<label><?php echo elgg_echo("groups:name"); ?></label><br />
	<?php echo elgg_view("input/text", array(
		'name' => 'name',
		'value' => $vars['entity']->name,
	));
	?>
</div>
<?php

$group_profile_fields = elgg_get_config('group');
if ($group_profile_fields > 0) {
	foreach ($group_profile_fields as $shortname => $valtype) {
		$line_break = '<br />';
		if ($valtype == 'longtext') {
			$line_break = '';
		}
		echo '<div><label>';
		echo elgg_echo("groups:{$shortname}");
		echo "</label>$line_break";
		echo elgg_view("input/{$valtype}", array(
			'name' => $shortname,
			'value' => $vars['entity']->$shortname,
		));
		echo '</div>';
	}
}
?>

<div>
	<label>
		<?php echo elgg_echo('groups:membership'); ?><br />
		<?php echo elgg_view('input/dropdown', array(
			'name' => 'membership',
			'value' => $membership,
			'options_values' => array(
				ACCESS_PRIVATE => elgg_echo('groups:access:private'),
				ACCESS_PUBLIC => elgg_echo('groups:access:public')
			)
		));
		?>
	</label>
</div>
	
<?php

if (elgg_get_plugin_setting('hidden_groups', 'groups') == 'yes') {
	$this_owner = $vars['entity']->owner_guid;
	if (!$this_owner) {
		$this_owner = elgg_get_logged_in_user_guid();
	}
	$access_options = array(
		ACCESS_PRIVATE => elgg_echo('groups:access:group'),
		ACCESS_LOGGED_IN => elgg_echo("LOGGED_IN"),
		ACCESS_PUBLIC => elgg_echo("PUBLIC")
	);
?>

<div>
	<label>
			<?php echo elgg_echo('groups:visibility'); ?><br />
			<?php echo elgg_view('input/access', array(
				'name' => 'vis',
				'value' =>  $access,
				'options_values' => $access_options,
			));
			?>
	</label>
</div>

<?php 	
}

$tools = elgg_get_config('group_tool_options');
if ($tools) {
	usort($tools, create_function('$a,$b', 'return strcmp($a->label,$b->label);'));
	foreach ($tools as $group_option) {
		$group_option_toggle_name = $group_option->name . "_enable";
		if ($group_option->default_on) {
			$group_option_default_value = 'yes';
		} else {
			$group_option_default_value = 'no';
		}
		$value = $vars['entity']->$group_option_toggle_name ? $vars['entity']->$group_option_toggle_name : $group_option_default_value;
?>	
<div>
	<label>
		<?php echo $group_option->label; ?><br />
	</label>
		<?php echo elgg_view("input/radio", array(
			"name" => $group_option_toggle_name,
			"value" => $value,
			'options' => array(
				elgg_echo('groups:yes') => 'yes',
				elgg_echo('groups:no') => 'no',
			),
		));
		?>
</div>
<?php
	}
}
?>
<div class="elgg-foot">
<?php

if (isset($vars['entity'])) {
	echo elgg_view('input/hidden', array(
		'name' => 'group_guid',
		'value' => $vars['entity']->getGUID(),
	));
}

echo elgg_view('input/submit', array('value' => elgg_echo('save')));

if (isset($vars['entity'])) {
	$delete_url = 'action/groups/delete?guid=' . $vars['entity']->getGUID();
	echo elgg_view('output/confirmlink', array(
		'text' => elgg_echo('groups:delete'),
		'href' => $delete_url,
		'confirm' => elgg_echo('groups:deletewarning'),
		'class' => 'elgg-button elgg-button-delete float-alt',
	));
}

/*
 * Section For Joyride - Create/Edit Groups Page 
 */
echo "
<ol id='joyRideTipContent'>";
echo "
	<!--tooltip for Edit Group Icon-->
	<li data-class='elgg-input-file' data-text='".elgg_echo('widget_manager:widgets:next')."' data-options='tipLocation:left;tipAnimation:fade'>
    	<h2>".elgg_echo('groups:edit:icon:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:edit:icon:tooltip')."</p>
	</li>
	<!--tooltip for Edit Group Title-->
	<li data-class='elgg-input-text' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:edit:title:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:edit:title:tooltip')."</p>
    </li>
    <!--tooltip for Edit Group Description-->
    <li data-class='mceEditor' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:edit:description:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:edit:description:tooltip')."</p>
    </li>
    <!--tooltip for Edit Group permissions-->
    <li data-class='elgg-input-dropdown' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:edit:permission:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:edit:permission:tooltip')."</p>
    </li>
    <!--tooltip for Edit Who can see this group-->
    <li data-class='elgg-input-access' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:edit:access:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:edit:access:tooltip')."</p>
    </li>
    <!--tooltip for Enable/Disable Group Features-->
	<li data-class='elgg-vertical' data-button='".elgg_echo('widget_manager:widgets:close')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:edit:features:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:edit:features:tooltip')."</p>
    </li>";
echo 
"</ol>";

?>
</div>

