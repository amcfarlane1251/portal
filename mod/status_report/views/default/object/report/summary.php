<?php
	$percentVar;

	if(strpos($vars['entity']->percent_complete, '%') == false) {
		if($vars['entity']->percent_complete != null) {
			$percentVar = '%';
		} else {
			$percentVar = '0%';
		}
	}
?>

<table class="tasks">
	<th><h3 class="report-status-heading"><?php echo elgg_echo('add:team') . ": " . $vars['entity']->project_team ?></h3></th>
</table>
<table class="tasks" width="100%">
	<tr>
		<th class="report-table-headings"><?php echo elgg_echo('add:summary_view') . ' ' . $vars['entity']->project_title; ?></th>
		<th class="report-table-headings"><?php echo elgg_echo('add:percent_complete') ?></th>
	</tr>
	<tr rowspan="2">
		<td id="summary-td" style="width:80%;">
			<?php echo $vars['entity']->project_summary; ?>
		</td>
		<td>
			<h2 id="percent-complete"><?php echo $vars['entity']->percent_complete . $percentVar ?></h2>
		</td>
	</tr>
</table>

<table class="tasks" width="100%">
	<!-- HEADINGS -->
	<tr>
		<th class="report-table-headings" style="width: 10%;"><?php echo elgg_echo('add:status');?></th>
		<th class="report-table-headings" style="width: 12.5%;"><?php echo elgg_echo('add:previous-grade');?></th>
		<th class="report-table-headings" style="width: 12.5%;"><?php echo elgg_echo('add:current-grade');?></th>
		<th class="report-table-headings" style="width: 22.5%;"><?php echo elgg_echo('add:schedule-comments');?></th>
		<th class="report-table-headings" style="width: 22.5%;"><?php echo elgg_echo('add:schedule-action-required');?></th>
	</tr>

	<!-- SCHEDULE -->
	<tr>
		<td><h3 class="report-status-heading"><?php echo elgg_echo('add:schedule');?></h3></td>
		<td class="report-grades"><?php echo $vars['entity']->schedule_previous_grade?></td>
		<td class="report-grades"><?php echo $vars['entity']->schedule_grade ?></td>
		<td><?php echo $vars['entity']->schedule_comments?></td>
		<td><?php echo $vars['entity']->schedule_action_required?></td>
	</tr>
	<!-- SCOPE -->
	<tr>
		<td><h3 class="report-status-heading"><?php echo elgg_echo('add:scope');?></h3></td>
		<td class="report-grades"><?php echo $vars['entity']->scope_previous_grade?></td>
		<td class="report-grades"><?php echo $vars['entity']->scope_grade ?></td>
		<td><?php echo $vars['entity']->scope_comments?></td>
		<td><?php echo $vars['entity']->scope_action_required?></td>
	</tr>

	<!-- RESOURCES -->
	<tr>
		<td><h3 class="report-status-heading"><?php echo elgg_echo('add:resources');?></h3></td>
		<td class="report-grades"><?php echo $vars['entity']->resources_previous_grade?></td>
		<td class="report-grades"><?php echo $vars['entity']->resources_grade ?></td>
		<td><?php echo $vars['entity']->resources_comments?></td>
		<td><?php echo $vars['entity']->resources_action_required?></td>
	</tr>

	<!-- BUDGET -->
	<tr>
		<td><h3 class="report-status-heading"><?php echo elgg_echo('add:budget');?></h3></td>
		<td class="report-grades"><?php echo $vars['entity']->budget_previous_grade?></td>
		<td class="report-grades"><?php echo $vars['entity']->budget_grade ?></td>
		<td><?php echo $vars['entity']->budget_comments?></td>
		<td><?php echo $vars['entity']->budget_action_required?></td>
	</tr>

	<!-- CHANGE -->
	<tr>
		<td><h3 class="report-status-heading"><?php echo elgg_echo('add:change');?></h3></td>
		<td class="report-grades"><?php echo $vars['entity']->change_previous_grade?></td>
		<td class="report-grades"><?php echo $vars['entity']->change_grade ?></td>
		<td><?php echo $vars['entity']->change_comments?></td>
		<td><?php echo $vars['entity']->change_action_required?></td>
	</tr>
</table>

<table class="tasks" width="100%">
	<tr>
		<th class="report-table-headings" style="width:30%;"><?php echo elgg_echo('add:risk')?></th>
		<th class="report-table-headings" style="width:30%;"><?php echo elgg_echo('add:mitigation')?></th>
		<th class="report-table-headings" style="width:30%;"><?php echo elgg_echo('add:responsible')?></th>
		<th class="report-table-headings" style="width:10%;"><?php echo elgg_echo('add:due')?></th>
	</tr>
	<tr>
		<td><?php echo $vars['entity']->riskissue ?></td>
		<td><?php echo $vars['entity']->mitigation_strategy ?></td>
		<td><?php echo $vars['entity']->responsible ?></td>
		<td><?php echo $vars['entity']->due_date ?></td>
	</tr>
</table>

<table class="tasks" width="100%">
	<tr>
		<th class="report-table-headings" style="width:50%"><?php echo elgg_echo('add:accomplishmentsThis'); ?></th>
		<th class="report-table-headings" style="width:50%"><?php echo elgg_echo('add:accomplishmentsNext'); ?></th>
	</tr>
	<tr rowspan="2">
		<td><?php echo $vars['entity']->accomplishments_this ?></td>
		<td><?php echo $vars['entity']->accomplishments_next ?></td>
	</tr>
</table>

<table class="tasks" id="milestone-display-table" width="100%">
	<tr>
		<th class="report-table-headings" colspan="10"><?php echo elgg_echo('add:milestone'); ?></th>
	</tr>
	<tr class="milestone-title-display" rowspan="2">
		<td><?php echo $vars['entity']->milestone_title; ?></td>
		<td><?php echo $vars['entity']->milestone_title2; ?></td>
		<td><?php echo $vars['entity']->milestone_title3; ?></td>
		<td><?php echo $vars['entity']->milestone_title4; ?></td>
		<td><?php echo $vars['entity']->milestone_title5; ?></td>
		<td><?php echo $vars['entity']->milestone_title6; ?></td>
		<td><?php echo $vars['entity']->milestone_title7; ?></td>
		<td><?php echo $vars['entity']->milestone_title8; ?></td>
		<td><?php echo $vars['entity']->milestone_title9; ?></td>
		<td><?php echo $vars['entity']->milestone_title10; ?></td>
	</tr>
	<tr class="milestone-date-display">
		<td><?php echo $vars['entity']->milestone_date; ?></td>
		<td><?php echo $vars['entity']->milestone_date2; ?></td>
		<td><?php echo $vars['entity']->milestone_date3; ?></td>
		<td><?php echo $vars['entity']->milestone_date4; ?></td>
		<td><?php echo $vars['entity']->milestone_date5; ?></td>
		<td><?php echo $vars['entity']->milestone_date6; ?></td>
		<td><?php echo $vars['entity']->milestone_date7; ?></td>
		<td><?php echo $vars['entity']->milestone_date8; ?></td>
		<td><?php echo $vars['entity']->milestone_date9; ?></td>
		<td><?php echo $vars['entity']->milestone_date10; ?></td>
	</tr>
</table>