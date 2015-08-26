<?php ?>
<script>
$(document).ready(function(){

    $('#more').click(function () {
        $('#more').html('<img src="http://198.164.43.9/elgg/_graphics/ajax_loader_bw.gif" />');
	var count = 5;
	window.location.href='activity/all?offset='+count;
    });
});
</script>
<?php 
	$widget = $vars["entity"];
	$userGuid = elgg_get_logged_in_user_guid();

	$count = sanitise_int($widget->activity_count, false);
	if(empty($count)){
		$count = 10;
	}
	
	if ($activity_content = $widget->activity_content){
		if(!is_array($activity_content)){
			if($activity_content == "all"){
				unset($activity_content);
			} else {
				$activity_content = explode(",", $activity_content);
			}
		}
	}
	
	$river_options = array(
			"pagination" => false,
			"limit" => $count,
			"type_subtype_pairs" => array(),
			//"class" => 'all',
	);

	$river_options_friends = array(
			"pagination" => false,
			"limit" => $count,
			"type_subtype_pairs" => array(),
			"relationship_guid" => $userGuid,
			"relationship" => 'friend',
	);
	
	if(empty($activity_content)){
		$activity = elgg_list_river($river_options);
		$friend_activity = elgg_list_river($river_options_friends);
	} else {
		foreach($activity_content as $content){
			list($type, $subtype) = explode(",", $content);
			if(!empty($type)){
				$value = $subtype;
				if(array_key_exists($type, $river_options['type_subtype_pairs'])){
					if(!is_array($river_options['type_subtype_pairs'][$type])){
						$value = array($river_options['type_subtype_pairs'][$type]);
					} else {
						$value = $river_options['type_subtype_pairs'][$type];
					}
					
					$value[] = $subtype;
				}
				$river_options['type_subtype_pairs'][$type] = $value;
			}
		}
		$activity = elgg_list_river($river_options);
	}
	
	if(empty($activity)){
		$activity = elgg_echo("river:none");
	}
	//$activity = "<ul class='elgg-list elgg-list-river elgg-river'></ul>";
	echo "<a href='' class='tooltip-icon tooltip bottom tip-active' data-tool='".elgg_echo('widget_manager:widgets:index_activity:tooltip')."'><img src='".elgg_get_site_url().'mod/wettoolkit/graphics/information.png'."' alt='Tooltip' /></a>";
	echo "<h3 class='widget-header'>".elgg_echo('widget_manager:widgets:index_activity:activityfeed')."</h3>";
	echo "<ul id='activity-filter'>
			<li class='active'><a href='#all' class='tooltip'>".elgg_echo('widget_manager:widgets:index_activity:all')."</a></li>
			<li><a href='#colleagues' class='tooltip'>".elgg_echo('widget_manager:widgets:index_activity:colleagues')."</a></li>
			<li><a href='#learners' class='tooltip tip-active' data-tool='".elgg_echo('widget_manager:widgets:index_activity:toolTipLearner')."'>".elgg_echo('widget_manager:widgets:index_activity:learners')."</a></li>
			<li><a href='#developers' class='tooltip tip-active' data-tool='".elgg_echo('widget_manager:widgets:index_activity:toolTipDeveloper')."'>".elgg_echo('widget_manager:widgets:index_activity:developers')."</a></li>
			<li><a href='#instructors' class='tooltip tip-active' data-tool='".elgg_echo('widget_manager:widgets:index_activity:toolTipInstructor')."'>".elgg_echo('widget_manager:widgets:index_activity:instructors')."</a></li>
		</ul>
	";
	echo "<div id='activity-feed'>".$activity."</div>";
?>
<div align="center" id="more" class="morebox">
<a href="javascript:void(0);" id="refresh">See More</a>
</div>
