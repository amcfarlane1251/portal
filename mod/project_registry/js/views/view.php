<?php

echo "
	<div class='template-header'>
		<h2>{{vm.project.title}}</h2>
		<a href='#/projects' class='elgg-button elgg-button-action'>List All Projects</a>
	</div>
	<div class='project'>
		<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:title') ."</label>
				</div>
				<div class='col-md-6'>
					<p>{{vm.project.title}}</p>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:course') ."</label>
				</div>
				<div class='col-md-6'>
					<p>{{vm.project.course}}</p>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:org') ."</label>
				</div>
				<div class='col-md-6'>
					<p>{{vm.project.org}}</p>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:type') ."</label>
				</div>
				<div class='col-md-6'>
					<p>{{vm.project.project_type}}</p>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:description') ."</label>
				</div>
				<div class='col-md-6'>
					<p>{{vm.project.description}}</p>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:scope') ."</label>
				</div>
				<div class='col-md-6'>
					<p>{{vm.project.scope}}</p>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:opi') ."</label>
				</div>
				<div class='col-md-6 row sub-row'>
					<div class='col-lg-12'>
						<div ng-repeat='(key, opi) in vm.opis'>
							<div class='row'>
								<div class='col-lg-12'>
									<h5>".elgg_echo('projects:opi:title')." {{key+1}}</h5>
								</div>
							</div>
							<div class='row'>
							<div class='col-md-3'>
								<label>".elgg_echo('projects:rank').":</label>
							</div>
							<div class='col-md-9'>
								<p>{{opi.rank}}</p>
							</div>
							</div>
							<div class='row'>
							<div class='col-md-3'>
								<label>".elgg_echo('projects:name').":</label>
							</div>
							<div class='col-md-9'>
								<p>{{opi.name}}</p>
							</div>
							</div>
							<div class='row'>
							<div class='col-md-3'>
								<label>".elgg_echo('projects:phone').":</label>
							</div>
							<div class='col-md-9'>
								<p>{{opi.phone}}</p>
							</div>
							</div>
							<div class='row'>
							<div class='col-md-3'>
								<label>".elgg_echo('projects:email').":</label>
							</div>
							<div class='col-md-9'>
								<p>{{opi.email}}</p>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:isPriority') ."</label>
				</div>
				<div class='col-md-6'>
					<p>{{vm.project.is_priority}}</p>
				</div>
			</div>
			<div class='row form-row' id='briefExplaiin'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:briefExplain') ."</label>
				</div>
				<div class='col-md-6'>
					<p>{{vm.project.priority}}</p>
				</div>
			</div>
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:isSme') ."</label>
				</div>
				<div class='col-md-6'>
					<p>{{vm.project.is_sme_avail}}</p>
				</div>
			</div>
			
			<div class='row form-row' id='sme'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:sme') ."</label>
				</div>
				<div class='col-md-6 sub-row'>
					<div class='row'>
						<div class='col-md-3'>
							<label>".elgg_echo('projects:rank').":</label>
						</div>
						<div class='col-md-9'>
							<p>{{vm.project.sme.rank}}</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<label>".elgg_echo('projects:name').":</label>
						</div>
						<div class='col-md-9'>
							<p>{{vm.project.sme.name}}</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<label>".elgg_echo('projects:phone').":</label>
						</div>
						<div class='col-md-9'>
							<p>{{vm.project.sme.phone}}</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<label>".elgg_echo('projects:email').":</label>
						</div>
						<div class='col-md-9'>
							<p>{{vm.project.sme.email}}</p>
						</div>
					</div>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:isLimitation') ."</label>
				</div>
				<div class='col-md-6'>
					<p>{{vm.project.is_limitation}}</p>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:updateExistingProduct') ."</label>
				</div>
				<div class='col-md-6'>
					<p>{{vm.project.update_existing_product}}</p>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:lifeExpectancy') ."</label>
				</div>
				<div class='col-md-6'>
					<p>{{vm.project.life_expectancy}}</p>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:usa') ."</label>
				</div>
				<div class='col-md-6 sub-row'>
					<div class='row'>
						<div class='col-md-3'>
							<label>".elgg_echo('projects:rank').":</label>
						</div>
						<div class='col-md-9'>
							<p>{{vm.project.usa.rank}}</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<label>".elgg_echo('projects:name').":</label>
						</div>
						<div class='col-md-9'>
							<p>{{vm.project.usa.name}}</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<label>".elgg_echo('projects:position').":</label>
						</div>
						<div class='col-md-9'>
							<p>{{vm.project.usa.position}}</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<label>".elgg_echo('projects:email').":</label>
						</div>
						<div class='col-md-9'>
							<p>{{vm.project.usa.email}}</p>
						</div>
					</div>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:comments') ."</label>
				</div>
				<div class='col-md-6'>
					<p>{{vm.project.comments}}</p>
				</div>
			</div>
			
			<div class='row form-row'>
				<div class='col-md-3'>
					<label>". elgg_echo('projects:files') ."</label>
				</div>
				<div class='col-md-6'>
					
				</div>
			</div>
	</div>
";