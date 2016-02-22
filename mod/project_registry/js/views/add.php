<?php

?>
	<div class='template-header'>
		<h2><?php echo elgg_echo('projects:add');?></h2>
		<a href='#/projects' class='elgg-button elgg-button-action'>List All Projects</a>
	</div>
	<div class='project-form project'>
		<form name='projectForm' ng-submit="vm.createProject(projectForm.$valid)" ng-focus-error="" novalidate>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:title'); ?></label>
				</div>
				<div class='col-md-6'>
					<input type='text' class='' name='title' ng-model='vm.title' required/>
					<div ng-messages="projectForm.title.$error" ng-if="(projectForm.title.$touched) || (projectForm.$submitted)">
						<div ng-messages-include="projects/messages"></div>
					</div>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:course');?></label>
				</div>
				<div class='col-md-6'>
					<input type='text' class='' name='course' ng-model='vm.course'/>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:org');?></label>
				</div>
				<div class='col-md-6'>
					<input type='text' class='' name="org" ng-model='vm.org' required/>
					<div ng-messages="projectForm.org.$error" ng-if="(projectForm.org.$touched) || (projectForm.$submitted)">
						<div ng-messages-include="projects/messages"></div>
					</div>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:type');?></label>
				</div>
				<div class='col-md-6'>
					<select ng-model=vm.type ng-options='type for type in vm.projectTypes.values'>
					</select>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:description');?></label>
				</div>
				<div class='col-md-6'>
					<textarea name='description' ng-model='vm.description' ng-minlength='3' ng-maxlength='500' required></textarea>
					<div ng-messages="projectForm.description.$error" ng-if="(projectForm.description.$touched) || (projectForm.$submitted)">
						<div ng-messages-include="projects/messages"></div>
					</div>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:scope'); ?></label>
				</div>
				<div class='col-md-6'>
					<textarea name="scope" ng-model='vm.scope' required></textarea>
					<div ng-messages="projectForm.scope.$error" ng-if="(projectForm.scope.$touched) || (projectForm.$submitted)">
						<div ng-messages-include="projects/messages"></div>
					</div>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:opi'); ?></label>
				</div>
				<div class='col-md-6 row sub-row'>
					<div class='col-lg-12'>
						<div ng-repeat='(key, opi) in vm.opis'>
							<div class='col-lg-12 row'>
								<h5><?php echo elgg_echo('projects:opi:title');?> {{key+1}}</h5>
								<button class='elgg-button elgg-button-action form-btn' ng-click='vm.removeContact(key)'><?php echo elgg_echo('projects:removeContact');?></button>
							</div>
							
							<div class='row'>
								<div class='col-md-3'>
									<label><?php echo elgg_echo('projects:rank');?>:</label>
								</div>
								<div class='col-md-9'>
									<input type='text' class='' name='opi_rank' ng-model='opi.rank' required/>
									<div ng-messages="projectForm.opi_rank.$error" ng-if="(projectForm.opi_rank.$touched) || (projectForm.$submitted)">
										<div ng-messages-include="projects/messages"></div>
									</div>
								</div>
							</div>
							<div class='row'>
								<div class='col-md-3'>
									<label><?php echo elgg_echo('projects:name');?>:</label>
								</div>
								<div class='col-md-9'>
									<input type='text' class='' name='opi_name' ng-model='opi.name' required/>
									<div ng-messages="projectForm.opi_name.$error" ng-if="(projectForm.opi_name.$touched) || (projectForm.$submitted)">
										<div ng-messages-include="projects/messages"></div>
									</div>
								</div>
							</div>
							<div class='row'>
								<div class='col-md-3'>
									<label><?php echo elgg_echo('projects:phone');?>:</label>
								</div>
								<div class='col-md-9'>
									<input type='text' class='' name='opi_phone' ng-model='opi.phone' required/>
									<div ng-messages="projectForm.opi_phone.$error" ng-if="(projectForm.opi_phone.$touched) || (projectForm.$submitted)">
										<div ng-messages-include="projects/messages"></div>
									</div>
								</div>
							</div>
							<div class='row'>
								<div class='col-md-3'>
									<label><?php echo elgg_echo('projects:email');?>:</label>
								</div>
								<div class='col-md-9'>
									<input type='email' class='' name='opi_email' ng-model='opi.email' required/>
									<div ng-messages="projectForm.opi_email.$error" ng-if="(projectForm.opi_email.$touched) || (projectForm.$submitted)">
										<div ng-messages-include="projects/messages"></div>
									</div>
								</div>
							</div>
						</div>
						<div class='col-lg-12 row'>
							<a class='elgg-button elgg-button-action' ng-click='vm.addContact()'><?php echo elgg_echo('projects:addContact');?></a>
						</div>
					</div>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:isPriority'); ?></label>
				</div>
				<div class='col-md-6'>
					<select ng-model='vm.isPriority' ng-options='option for option in vm.booleanOptions.values' ng-change=vm.toggleContainer(vm.isPriority,'briefExplain')></select>
				</div>
			</div>
			<div class='row form-row hidden' id='briefExplain'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:briefExplain'); ?></label>
				</div>
				<div class='col-md-6'>
					<textarea ng-model='vm.priority'></textarea>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:isSme'); ?></label>
				</div>
				<div class='col-md-6'>
					<select ng-model='vm.isSme' ng-options='option for option in vm.booleanOptions.values' ng-change=vm.toggleContainer(vm.isSme,'sme')></select>
				</div>
			</div>
			<div class='row form-row hidden' id='sme'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:sme'); ?></label>
				</div>
				<div class='col-md-6 sub-row'>
					<div class='row'>
						<div class='col-md-3'>
							<label><?php echo elgg_echo('projects:rank'); ?>:</label>
						</div>
						<div class='col-md-9'>
							<input type='text' class='' ng-model='vm.sme.rank'/>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<label><?php echo elgg_echo('projects:name'); ?>:</label>
						</div>
						<div class='col-md-9'>
							<input type='text' class='' ng-model='vm.sme.name'/>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<label><?php echo elgg_echo('projects:phone'); ?>:</label>
						</div>
						<div class='col-md-9'>
							<input type='text' class='' ng-model='vm.sme.phone'/>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<label><?php echo elgg_echo('projects:email'); ?>:</label>
						</div>
						<div class='col-md-9'>
							<input type='email' name='sme_email' class='' ng-model='vm.sme.email'/>
							<div ng-messages="projectForm.sme_email.$error" ng-if="(projectForm.sme_email.$dirty) || (projectForm.$submitted)">
								<div ng-messages-include="projects/messages"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo  elgg_echo('projects:isLimitation'); ?></label>
				</div>
				<div class='col-md-6'>
					<select ng-model='vm.isLimitation' ng-options='option for option in vm.booleanOptions.values'></select>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:updateExistingProduct'); ?></label>
				</div>
				<div class='col-md-6'>
					<select ng-model='vm.updateExistingProduct' ng-options='option for option in vm.multiOptions.values'></select>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:lifeExpectancy'); ?></label>
				</div>
				<div class='col-md-6'>
					<input type='text' name='lifeExpectancy' ng-model='vm.lifeExpectancy'/>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:usa'); ?></label>
					<p>(An email notification will be sent to this individual after your submission)</p>
				</div>
				<div class='col-md-6 row'>
					<div class='col-md-3'>
						<label><?php echo elgg_echo('projects:rank'); ?>:</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' name='usa_rank' ng-model='vm.usa.rank' required/>
						<div ng-messages="projectForm.usa_rank.$error" ng-if="projectForm.usa_rank.$touched || projectForm.$submitted">
							<div ng-messages-include='projects/messages'></div>
						</div>
					</div>
					<div class='col-md-3'>
						<label><?php echo elgg_echo('projects:name');?>:</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' name='usa_name' ng-model='vm.usa.name' required/>
						<div ng-messages="projectForm.usa_name.$error" ng-if="(projectForm.usa_name.$touched) || (projectForm.$submitted)">
							<div ng-messages-include="projects/messages"></div>
						</div>
					</div>
					<div class='col-md-3'>
						<label><?php echo elgg_echo('projects:position');?>:</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' name='usa_position' ng-model='vm.usa.position' required/>
						<div ng-messages="projectForm.usa_position.$error" ng-if="(projectForm.usa_position.$touched) || (projectForm.$submitted)">
							<div ng-messages-include="projects/messages"></div>
						</div>
					</div>
					<div class='col-md-3'>
						<label><?php echo elgg_echo('projects:email');?>:</label>
					</div>
					<div class='col-md-9'>
						<input type='email' class='' name='usa_email' ng-model='vm.usa.email' required/>
						<div ng-messages="projectForm.usa_email.$error" ng-if="(projectForm.usa_email.$touched) || (projectForm.$submitted)">
							<div ng-messages-include="projects/messages"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:comments');?></label>
				</div>
				<div class='col-md-6'>
					<textarea ng-model='vm.comments'></textarea>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label><?php echo elgg_echo('projects:files');?></label>
				</div>
				<div class='col-md-6'>
					<input type="file" ngf-select="" ng-model="vm.files" name="file" ngf-multiple="true">
				</div>
			</div>
			
			<button type='submit' class='elgg-button elgg-button-action'><?php echo elgg_echo('projects:submit');?></button>
		</form>
	</div>
