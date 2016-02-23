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
		<div ng-repeat='(key,project) in vm.projects' class='col-sm-6'>
			<div class='col-sm-12 project'>
				<div class='project-header'>
					<h3><a href='#/projects/view/{{project.id}}'>{{project.title}}</a></h3>
				</div>
				<h5><?php echo elgg_echo('projects:status');?>
				<?php if(elgg_is_admin_logged_in()) { ?> 
					: <select id='statusSelect{{key}}' ng-model='project.status' ng-options='status.name as status.name for status in vm.statuses' ng-change='vm.updateStatus(key)'></select></h5>
				<?php } 
				else{ ?>
					- <span>{{project.status}}</span></h5>
				<?php } ?>
				<p><?php echo elgg_echo('projects:reqNum'); ?>{{project.req_num}}</p>
				<p><?php echo elgg_echo('projects:submittedBy'); ?> {{project.owner}} <?php echo elgg_echo('projects:on'); ?> {{project.time_created}}</p>
                <div ng-if="project.can_edit" class='project-footer'>
                    <a href='#/projects/edit/{{project.id}}' class='elgg-button elgg-button-action'><?php echo elgg_echo('projects:edit'); ?></a>
                    <button class='elgg-button elgg-button-action float-alt' ng-click='vm.deleteProject(project.id)' ng-delete-once='Are you sure you want to delete this project? There is no undo!'><?php echo elgg_echo('projects:delete'); ?></button>    
                </div>
			</div>
		</div>
	</section>