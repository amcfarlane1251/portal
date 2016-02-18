<?php
 
?>
<nav id="sidebar">
	<h3><?php echo elgg_echo('projects:filter'); ?></h3>
	<ul>
		<li>
			<a class="list-group-item active" href="" ng-click='vm.filterProjects($event)' id="All">All</a>
		</li>
		<li>
			<a class="list-group-item" href="" ng-click='vm.filterProjects($event)' id="Submitted">Submitted</a>
		</li>
		<li>
			<a class="list-group-item" href="" ng-click='vm.filterProjects($event)' id="Under Review">Under Review</a>
		</li>
		<li>
			<a class="list-group-item" href="" ng-click='vm.filterProjects($event)' id="In Progress">In Progress</a>
		</li>
	</ul>
</nav>