<?php

	if(isset($vars['entity'])) {
		$guid = $vars['entity']->guid;
		$summary = $vars['entity']->project_summary;
		$projectTeam = $vars['entity']->project_team;
		$projectTitle = $vars['entity']->project_title;
		$date = $vars['entity']->date;
		$percent_complete = $vars['entity']->percent_complete;

		$scheduleGrade = $vars['entity']->schedule_grade;
		$previousGrade = $vars['entity']->schedule_previous_grade;
		$scheduleComments = $vars['entity']->schedule_comments;
		$scheduleActionRequired = $vars['entity']->schedule_action_required;

		$scopePreviousGrade = $vars['entity']->scope_previous_grade;
		$scopeGrade = $vars['entity']->scope_grade;
		$scopeComments = $vars['entity']->scope_comments;
		$scopeActionRequired = $vars['entity']->scope_action;

		$resourcesPreviousGrade = $vars['entity']->resources_previous_grade;
		$resourcesGrade = $vars['entity']->resources_grade;
		$resourcesComments = $vars['entity']->resources_comments;
		$resourcesActionRequired = $vars['entity']->resources_action_required;

		$budgetPreviousGrade = $vars['entity']->budget_previous_grade;
		$budgetGrade = $vars['entity']->budget_grade;
		$budgetComments = $vars['entity']->budget_comments;
		$budgetActionRequired = $vars['entity']->budget_action_required;

		$changePreviousGrade = $vars['entity']->change_previous_grade;
		$changeGrade = $vars['entity']->change_grade;
		$changeComments = $vars['entity']->change_comments;
		$changeActionRequired = $vars['entity']->change_action_required;

		$riskIssue = $vars['entity']->riskissue;
		$mitigationStrategy = $vars['entity']->mitigation_strategy;

		$responsible = $vars['entity']->responsible;
		$dueDate = $vars['entity']->due_date;

		$accomplishmentsThis = $vars['entity']->accomplishments_this;
		$accomplishmentsNext = $vars['entity']->accomplishments_next;

		$milestoneTitle = $vars['entity']->milestone_title;
		$milestoneDate = $vars['entity']->milestone_date;
	}
?>

<table width="100%" class="tasks">
	<tr>
		<th class="report-add-heading" colspan="2"><?php echo elgg_echo('add:summary');?></th>
	</tr>
	<tr>
		<td colspan="2">
			<?php echo elgg_view('input/longtext', array(
					'name' => 'project_summary',
					'value' => $summary,
				)); 
			?>
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<th class="report-add-sub-heading" width="40%;"><?php echo elgg_echo('add:team'); ?></th>
		<th class="report-add-sub-heading" width="35%"><?php echo elgg_echo('add:project_title'); ?></th>
		<th class="report-add-sub-heading" width="15%;"><?php echo elgg_echo('add:report_week'); ?></th>
		<th class="report-add-sub-heading" width="10%;"><?php echo elgg_echo('add:percent_complete'); ?></th>
	</tr>
	<tr>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'project_team',
					'value' => $projectTeam
				)); 
			?>
		</td>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'project_title',
					'value' => $projectTitle
				));
			?>
		</td>
		<td>
			<input name="date" type="text" id="report_week_picker" value=<?php $date;?>>
		</td>
		<td>
			<?php echo elgg_view('input/text', array(
					'name' => 'percent_complete',
					'value' => $percent_complete,
				));
			?>
		</td>
	</tr>
</table>

<table class="tables" width="100%">
	<!--SCHEDULE-->
	<tr>
		<th class="report-add-heading" colspan="4"><?php echo elgg_echo('add:schedule') ?></th>
	</tr>
	<tr>
		<th class="report-add-sub-heading" style="width:10%;"><?php echo elgg_echo('add:previous-grade'); ?></th>
		<th class="report-add-sub-heading" style="width:10%;"><?php echo elgg_echo('add:current-grade'); ?></th>
		<th class="report-add-sub-heading" style="width:40%;"><?php echo elgg_echo('add:schedule-comments'); ?></th>
		<th class="report-add-sub-heading" style="width:40%;"><?php echo elgg_echo('add:schedule-action-required'); ?></th>
	</tr>
	<tr>
		<td>
			<select name="schedule_previous_grade">
				<option value="N/A">N/A</option>
				<option value="G">G</option>
				<option value="Y">Y</option>
				<option value="R">R</option>
			</select>
		</td>
		<td>
			<select name="schedule_grade">
				<option value="N/A">N/A</option>
				<option value="G">G</option>
				<option value="Y">Y</option>
				<option value="R">R</option>
			</select>
		</td>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'schedule_comments',
					'value' => $scheduleComments
				)); 
			?>
		</td>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'schedule_action_required',
					'value' => $scheduleActionRequired
				)); 
			?>
		</td>
	</tr>
</table>

<table class="tasks" width="100%">
	<!-- SCOPE -->
	<tr>
		<th class="report-add-heading" colspan="4"><?php echo elgg_echo('add:scope') ?></th>
	</tr>
	<tr>
		<th class="report-add-sub-heading" style="width:10%;"><?php echo elgg_echo('add:previous-grade'); ?></th>
		<th class="report-add-sub-heading" style="width:10%;"><?php echo elgg_echo('add:current-grade'); ?></th>
		<th class="report-add-sub-heading" style="width:40%;"><?php echo elgg_echo('add:schedule-comments'); ?></th>
		<th class="report-add-sub-heading" style="width:40%;"><?php echo elgg_echo('add:schedule-action-required'); ?></th>
	</tr>
	<tr>
		<td>
			<select name="scope_previous_grade">
			    <option value="N/A">N/A</option>
				<option value="G">G</option>
				<option value="Y">Y</option>
				<option value="R">R</option>
			</select>
		</td>
		<td>
			<select name="scope_grade">
				<option value="N/A">N/A</option>
				<option value="G">G</option>
				<option value="Y">Y</option>
				<option value="R">R</option>
			</select>
		</td>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'scope_comments',
					'value' => $scopeComments
				)); 
			?>
		</td>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'scope_action_required',
					'value' => $scopeActionRequired
				)); 
			?>
		</td>
	</tr>
</table>

<table class="tasks" width="100%">
	<!-- RESOURCES -->
	<tr>
		<th class="report-add-heading" colspan="4"><?php echo elgg_echo('add:resources') ?></th>
	</tr>
	<tr>
		<th class="report-add-sub-heading" style="width:10%;"><?php echo elgg_echo('add:previous-grade'); ?></th>
		<th class="report-add-sub-heading" style="width:10%;"><?php echo elgg_echo('add:current-grade'); ?></th>
		<th class="report-add-sub-heading" style="width:40%;"><?php echo elgg_echo('add:schedule-comments'); ?></th>
		<th class="report-add-sub-heading" style="width:40%;"><?php echo elgg_echo('add:schedule-action-required'); ?></th>
	</tr>
	<tr>
		<td>
			<select name="resources_previous_grade">
				<option value="N/A">N/A</option>
				<option value="G">G</option>
				<option value="Y">Y</option>
				<option value="R">R</option>
			</select>
		</td>
		<td>
			<select name="resources_grade">
				<option value="N/A">N/A</option>
				<option value="G">G</option>
				<option value="Y">Y</option>
				<option value="R">R</option>
			</select>
		</td>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'resources_comments',
					'value' => $resourcesComments
				)); 
			?>
		</td>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'resources_action_required',
					'value' => $resourcesActionRequired
				)); 
			?>
		</td>
	</tr>
	<!-- BUDGET -->
</table>

<table class="tasks" width="100%">
	<tr>
		<th class="report-add-heading" colspan="4"><?php echo elgg_echo('add:budget') ?></th>
	</tr>
	<tr>
		<th class="report-add-sub-heading" style="width:10%;"><?php echo elgg_echo('add:previous-grade'); ?></th>
		<th class="report-add-sub-heading" style="width:10%;"><?php echo elgg_echo('add:current-grade'); ?></th>
		<th class="report-add-sub-heading" style="width:40%;"><?php echo elgg_echo('add:schedule-comments'); ?></th>
		<th class="report-add-sub-heading" style="width:40%;"><?php echo elgg_echo('add:schedule-action-required'); ?></th>
	</tr>
	<tr>
		<td>
			<select name="budget_previous_grade">
				<option value="N/A">N/A</option>
				<option value="G">G</option>
				<option value="Y">Y</option>
				<option value="R">R</option>
			</select>
		</td>
		<td>
			<select name="budget_grade">
				<option value="N/A">N/A</option>
				<option value="G">G</option>
				<option value="Y">Y</option>
				<option value="R">R</option>
			</select>
		</td>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'budget_comments',
					'value' => $budgetComments
				)); 
			?>
		</td>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'budget_action_required',
					'value' => $budgetActionRequired
				)); 
			?>
		</td>
	</tr>
</table>

<table class="tasks" width="100%">
	<!-- CHANGE -->
	<tr>
		<th class="report-add-heading" colspan="4"><?php echo elgg_echo('add:change') ?></th>
	</tr>
	<tr>
		<th class="report-add-sub-heading" style="width:10%;"><?php echo elgg_echo('add:previous-grade'); ?></th>
		<th class="report-add-sub-heading" style="width:10%;"><?php echo elgg_echo('add:current-grade'); ?></th>
		<th class="report-add-sub-heading" style="width:40%;"><?php echo elgg_echo('add:schedule-comments'); ?></th>
		<th class="report-add-sub-heading" style="width:40%;"><?php echo elgg_echo('add:schedule-action-required'); ?></th>
	</tr>
	<tr>
		<td>
			<select name="change_previous_grade">
				<option value="N/A">N/A</option>
				<option value="G">G</option>
				<option value="Y">Y</option>
				<option value="R">R</option>
			</select>
		</td>
		<td>
			<select name="change_grade">
				<option value="N/A">N/A</option>
				<option value="G">G</option>
				<option value="Y">Y</option>
				<option value="R">R</option>
			</select>
		</td>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'change_comments',
					'value' => $changeComments
				)); 
			?>
		</td>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'change_action_required',
					'value' => $changeActionRequired
				)); 
			?>
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<th class="report-add-sub-heading" style="width:40%;"><?php echo elgg_echo('add:risk'); ?></th>
		<th class="report-add-sub-heading" style="width:30%;"><?php echo elgg_echo('add:mitigation'); ?></th>
		<th class="report-add-sub-heading" style="width:20%;"><?php echo elgg_echo('add:responsible'); ?></th>
		<th class="report-add-sub-heading" style="width:10%;"><?php echo elgg_echo('add:due'); ?></th>
	</tr>
	<tr>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'riskissue',
					'value' => $riskIssue
				)); 
			?>
		</td>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'mitigation_strategy',
					'value' => $mitigationStrategy
				)); 
			?>
		</td>
		<td>
			<?php echo elgg_view("input/text", array(
					'name' => 'responsible',
					'value' => $responsible
				)); 
			?>
		</td>
		<td>
			<input name="due_date" type="text" id="report-due-date" value=<?php $dueDate;?>>
		</td>
	</tr>
</table>
<table class="tasks" width="100%">
	<tr>
		<th class="report-add-heading" colspan="2"><?php echo elgg_echo('add:accomplishmentsThis'); ?></th>
	</tr>
	<tr>
		<td>
			<?php echo elgg_view('input/longtext', array(
					'name' => 'accomplishments_this',
					'value' => $accomplishmentsThis,
				)); 
			?>
		<td>
	</tr>
	<tr>
		<th class="report-add-heading" colspan="2"><?php echo elgg_echo('add:accomplishmentsNext'); ?></th>
	</tr>
	<tr>
		<td>
			<?php echo elgg_view('input/longtext', array(
					'name' => 'accomplishments_next',
					'value' => $accomplishmentsNext,
				)); 
			?>
		<td>
	</tr>
</table>
<table id="milestones-table" class="tasks" width="100%">
	<tr>
		<th class="report-add-heading" colspan="2"><?php echo elgg_echo('add:milestone')?> </th>
	</tr>
	<tr>
		<th class="report-add-sub-heading" style="width:50%;"><?php echo elgg_echo('add:milestone-name'); ?></th>
		<th class="report-add-sub-heading" style="width:50%;"><?php echo elgg_echo('add:milestone-date'); ?></th>
	</tr>
	<tr>
		<td>
			<input type="text" name="milestone_title"/>
		</td>
		<td id="111">
			<input type="text" name="milestone_date" class="milestone-dates" />
		</td>
	</tr>
</table>
<a href='#' id="milestone-add-button"><?php echo elgg_echo('add:add-milestone'); ?></a>

<?php

echo '<div class="elgg-foot">';
if ($vars['guid']) {
	echo elgg_view('input/hidden', array(
		'name' => 'report_guid',
		'value' => $vars['guid'],
	));
}
echo elgg_view('input/hidden', array(
	'name' => 'container_guid',
	'value' => $vars['container_guid'],
));
if ($vars['parent_guid']) {
	echo elgg_view('input/hidden', array(
		'name' => 'parent_guid',
		'value' => $vars['parent_guid'],
	));
}

echo elgg_view('input/submit', array('value' => elgg_echo('save')));

echo '</div>';

