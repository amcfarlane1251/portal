<?php

echo "
	<div class='template-header'>
		<h2>".elgg_echo('projects:all')."</h2>
		<a href='#/projects/create' class='elgg-button elgg-button-action'>Request Project</a>
	</div>
	<div class='row projects'>
		<div ng-repeat='(key,project) in vm.projects' class='col-sm-6'>
			<div class='col-lg-10 col-lg-offset-1 project'>
				<div class='project-header'>
					<h3><a href='#/projects/view/{{project.id}}'>{{project.title}}</a></h3>
				</div>
				<h5>".elgg_echo('projects:status');
				if(elgg_is_admin_logged_in()) {
					echo 
					": <select id='statusSelect{{key}}' ng-model='project.status' ng-options='status.name as status.name for status in vm.statuses' ng-change='vm.updateStatus(key)'></select>";
				}
				else{
					echo " - <span>{{project.status}}</span></h5>";
				}
echo			"<p>".elgg_echo('projects:reqNum')." {{project.req_num}}</p>
				<p>". elgg_echo('projects:submittedBy') ." {{project.owner}} ". elgg_echo('projects:on') ." {{project.time_created}}</p>
				<button class='elgg-button elgg-button-action float-alt' ng-click='vm.deleteProject(project.id)' ng-confirmation-needed='Are you sure you want to delete this project? There is no undo!'>".elgg_echo('projects:delete')."</button>
				</div>
			</div>
		</div>
	</div>
";