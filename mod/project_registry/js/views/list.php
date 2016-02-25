<?php

?>
	<div class='template-header'>
		<h2><?php echo elgg_echo('projects:all');?></h2>
		<a href='#/projects/create' class='elgg-button elgg-button-action'>Request Project</a>
	</div>
	<section class='row col-md-3'>
		<div ng-include="'projects/sidebar'"</div>
	</section>
	<section class='row col-md-9 projects'>
		<table class='data-table'>
			<thead>
				<tr>
					<th>Title</th>
					<th>Status</th>
					<th>Submitted By</th>
					<th>Date Submitted</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat='(key,project) in vm.projects'>
					<td><a href='#/projects/view/{{project.id}}'>{{project.title}}</a></td>
					<td>
						<?php if(elgg_is_admin_logged_in()) { ?> 
							<select id='statusSelect{{key}}' ng-model='project.status' ng-options='status.name as status.name for status in vm.statuses' ng-change='vm.updateStatus(key)'></select>
						<?php }
						else{ ?>
							<span>{{project.status}}</span>
						<?php } ?>
					</td>
					<td>{{project.owner}}</td>
					<td>{{project.time_created}}</td>
					<td style="text-align: center;"><a class="glyphicon delete-button" ng-if="project.can_edit" ng-click='vm.deleteProject(project.id)' ng-delete-once='Are you sure you want to delete this project? There is no undo!'></a></td>
				</tr>
			</tbody>
		</table>
	</section>
	<script>
		$(document).ready(function() {
			$('.data-table').DataTable();
		} );
		</script>
	