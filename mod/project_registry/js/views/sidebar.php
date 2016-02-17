<?php
 
?>
<nav id="sidebar">
	<h3><?php echo elgg_echo('projects:filter'); ?></h3>
	<ul>
		<li>
			<a class="list-group-item" href="" ng-click='vm.filterProjects($event)' id="Submitted">Submitted</a>
		</li>
		<li>
			<a class="list-group-item" href="" ng-click='vm.filterProjects($event)' id="Submitted">Under Review</a>
		</li>
		<li>
			<a class="list-group-item" href="" ng-click='vm.filterProjects($event)' id="Submitted">In Progress</a>
		</li>
	</ul>
</nav>