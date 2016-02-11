<?php

echo "
	<div class='template-header'>
		<h2>".elgg_echo('projects:add')."</h2>
		<a href='#/projects' class='elgg-button elgg-button-action'>List All Projects</a>
	</div>
	<div class='project-form project'>
		<form>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:title') ."</label>
				</div>
				<div class='col-md-6'>
					<input type='text' class='' name='title' ng-model='vm.title'/>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:course') ."</label>
				</div>
				<div class='col-md-6'>
					<input type='text' class='' ng-model='vm.course'/>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:org') ."</label>
				</div>
				<div class='col-md-6'>
					<input type='text' class='' ng-model='vm.org'/>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:type') ."</label>
				</div>
				<div class='col-md-6'>
					<select ng-model=vm.type ng-options='type for type in vm.projectTypes.values'>
					</select>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:description') ."</label>
				</div>
				<div class='col-md-6'>
					<textarea ng-model='vm.description'></textarea>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:scope') ."</label>
				</div>
				<div class='col-md-6'>
					<textarea ng-model='vm.scope'></textarea>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:opi') ."</label>
				</div>
				<div class='col-md-6 row sub-row'>
					<div class='col-lg-12'>
						<div ng-repeat='(key, opi) in vm.opis'>
							<div class='col-lg-12 row'>
								<h5>".elgg_echo('projects:opi:title')." {{key+1}}</h5>
								<button class='elgg-button elgg-button-action form-btn' ng-click='vm.removeContact(key)'>".elgg_echo('projects:removeContact')."</button>
							</div>
							
							<div class='row'>
								<div class='col-md-3'>
									<label>".elgg_echo('projects:rank').":</label>
								</div>
								<div class='col-md-9'>
									<input type='text' class='' ng-model='opi.rank' />
								</div>
							</div>
							<div class='row'>
								<div class='col-md-3'>
									<label>".elgg_echo('projects:name').":</label>
								</div>
								<div class='col-md-9'>
									<input type='text' class='' ng-model='opi.name'/>
								</div>
							</div>
							<div class='row'>
								<div class='col-md-3'>
									<label>".elgg_echo('projects:phone').":</label>
								</div>
								<div class='col-md-9'>
									<input type='text' class='' ng-model='opi.phone'/>
								</div>
							</div>
							<div class='row'>
								<div class='col-md-3'>
									<label>".elgg_echo('projects:email').":</label>
								</div>
								<div class='col-md-9'>
									<input type='text' class='' ng-model='opi.email'/>
								</div>
							</div>
						</div>
						<div class='col-lg-12 row'>
							<button class='elgg-button elgg-button-action' ng-click='vm.addContact()'>".elgg_echo('projects:addContact')."</button>
						</div>
					</div>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:isPriority') ."</label>
				</div>
				<div class='col-md-6'>
					<select ng-model='vm.isPriority' ng-options='option for option in vm.booleanOptions.values' ng-change=vm.toggleContainer(vm.isPriority,'briefExplain')></select>
				</div>
			</div>
			<div class='row form-row hidden' id='briefExplain'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:briefExplain') ."</label>
				</div>
				<div class='col-md-6'>
					<textarea ng-model='vm.priority'></textarea>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:isSme') ."</label>
				</div>
				<div class='col-md-6'>
					<select ng-model='vm.isSme' ng-options='option for option in vm.booleanOptions.values' ng-change=vm.toggleContainer(vm.isSme,'sme')></select>
				</div>
			</div>
			<div class='row form-row hidden' id='sme'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:sme') ."</label>
				</div>
				<div class='col-md-6 sub-row'>
					<div class='row'>
						<div class='col-md-3'>
							<label>".elgg_echo('projects:rank').":</label>
						</div>
						<div class='col-md-9'>
							<input type='text' class='' ng-model='vm.sme.rank'/>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<label>".elgg_echo('projects:name').":</label>
						</div>
						<div class='col-md-9'>
							<input type='text' class='' ng-model='vm.sme.name'/>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<label>".elgg_echo('projects:phone').":</label>
						</div>
						<div class='col-md-9'>
							<input type='text' class='' ng-model='vm.sme.phone'/>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<label>".elgg_echo('projects:email').":</label>
						</div>
						<div class='col-md-9'>
							<input type='text' class='' ng-model='vm.sme.email'/>
						</div>
					</div>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:isLimitation') ."</label>
				</div>
				<div class='col-md-6'>
					<select ng-model='vm.isLimitation' ng-options='option for option in vm.booleanOptions.values'></select>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:updateExistingProduct') ."</label>
				</div>
				<div class='col-md-6'>
					<select ng-model='vm.updateExistingProduct' ng-options='option for option in vm.multiOptions.values'></select>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:lifeExpectancy') ."</label>
				</div>
				<div class='col-md-6'>
					<input type='text' name='lifeExpectancy' ng-model='vm.lifeExpectancy'/>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:usa') ."</label>
				</div>
				<div class='col-md-6 row'>
					<div class='col-md-3'>
						<label>".elgg_echo('projects:rank').":</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' ng-model='vm.usa.rank'/>
					</div>
					<div class='col-md-3'>
						<label>".elgg_echo('projects:name').":</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' ng-model='vm.usa.name'/>
					</div>
					<div class='col-md-3'>
						<label>".elgg_echo('projects:position').":</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' ng-model='vm.usa.position'/>
					</div>
					<div class='col-md-3'>
						<label>".elgg_echo('projects:email').":</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' ng-model='vm.usa.email'/>
					</div>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:comments') ."</label>
				</div>
				<div class='col-md-6'>
					<textarea ng-model='vm.comments'></textarea>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:files') ."</label>
				</div>
				<div class='col-md-6'>
					<div class='elgg-button' ngf-select ng-model='vm.files' ngf-multiple='true'>Select</div>
					Drop files: <div ngf-drop ng-model='files'>Drop</div>
				</div>
			</div>
			
			<button class='elgg-button elgg-button-action' ng-click='vm.createProject()'>".elgg_echo('projects:submit')."</button>
		</form>
	</div>
";

