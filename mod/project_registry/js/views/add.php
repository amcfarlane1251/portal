<?php

echo "
	<div class='template-header'><a href='#/projects' class='elgg-button elgg-button-action ang-button'>List All Projects</a></div>
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
					<select ng-model=vm.type>
						<option value='Courseware' selected='selected'>Courseware</option>
						<option value='Instructor Support'>Instructor Support</option>
						<option value='Learning Application'>Learning Application</option>
						<option value='Learning Technologies'>Learning Technologies</option>
						<option value='Mobile'>Mobile</option>
						<option value='Modelling and Simulation'>Modelling and Simulation</option>
						<option value='R and D'>R and D</option>
						<option value='Serious Gaming'>Serious Gaming</option>
						<option value='Support'>Support</option>
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
				<div class='col-md-6 row'>
					<div class='col-md-3'>
						<label>".elgg_echo('projects:rank').":</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' ng-model='vm.opi.rank' />
					</div>
					<div class='col-md-3'>
						<label>".elgg_echo('projects:name').":</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' ng-model='vm.opi.name'/>
					</div>
					<div class='col-md-3'>
						<label>".elgg_echo('projects:phone').":</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' ng-model='vm.opi.phone'/>
					</div>
					<div class='col-md-3'>
						<label>".elgg_echo('projects:email').":</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' ng-model='vm.opi.email'/>
					</div>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:isPriority') ."</label>
				</div>
				<div class='col-md-6'>
					<select ng-model='vm.isPriority'>
						<option value=true>".elgg_echo('projects:yes')."</option>
						<option value=false>".elgg_echo('projects:no')."</option>
					</select>
				</div>
			</div>
			<div class='row form-row'>
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
					<label>
						<input type='radio' name='isSme' value=true ng-model='vm.isSme'>".elgg_echo('projects:yes')."
					</label>
					<label>
						<input type='radio' name='isSme' value=false ng-model='vm.isSme'>".elgg_echo('projects:no')."
					</label>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:sme') ."</label>
				</div>
				<div class='col-md-6 row'>
					<div class='col-md-3'>
						<label>".elgg_echo('projects:rank').":</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' ng-model='vm.sme.rank'/>
					</div>
					<div class='col-md-3'>
						<label>".elgg_echo('projects:name').":</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' ng-model='vm.sme.name'/>
					</div>
					<div class='col-md-3'>
						<label>".elgg_echo('projects:phone').":</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' ng-model='vm.sme.phone'/>
					</div>
					<div class='col-md-3'>
						<label>".elgg_echo('projects:email').":</label>
					</div>
					<div class='col-md-9'>
						<input type='text' class='' ng-model='vm.sme.email'/>
					</div>
				</div>
			</div>
			
			<button class='elgg-button elgg-button-action' ng-click='vm.createProject()'>".elgg_echo('projects:submit')."</button>
		</form>
	</div>
";

