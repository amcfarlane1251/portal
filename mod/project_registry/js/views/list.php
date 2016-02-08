<?php

echo "
	<div class='template-header'>
		<h2>".elgg_echo('projects:all')."</h2>
		<a href='#/projects/create' class='elgg-button elgg-button-action'>Request Project</a>
	</div>
	<div class='row'>
		<div ng-repeat='project in vm.projects' class='project col-sm-6'>
			<div class='project-header'>
				<h3><a href='projects/{{project.id}}'>{{project.title}}</a></h3>
				<h5>".elgg_echo('projects:status')." - <span>{{project.status}}</span></h5>
				<p>".elgg_echo('projects:reqNum')." {{project.req_num}}</p>
				<p>". elgg_echo('projects:submittedBy') ." {{project.owner}} ". elgg_echo('projects:on') ." {{project.time_created}}</p>
			</div>
		</div>
	</div>
";