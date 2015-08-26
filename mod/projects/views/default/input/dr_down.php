<?php
$user  = elgg_get_logged_in_user_entity();
$name = $vars['name'];
$currentVal = $vars['value'];

if($name == "status"){
	$output ='';
	$output .= "<select name='status' id='status' class='elgg-input-dropdown'>\n";
	$output .= "<option value='Request' " . ($currentVal == "Request" ? "selected='selected'" : "") . ">" . elgg_echo('Request') . "</option>\n";
	$output .= "<option value='Review' " . ($currentVal == "Review" ? "selected='selected'" : "") . ">" . elgg_echo('Review') . "</option>\n";
	$output .= "<option value='Concept | Definition' " . ($currentVal == "Concept | Definition" ? "selected='selected'" : "") . ">" . elgg_echo('Concept | Definition') . "</option>\n";
	$output .= "<option value='Approved | Funded' " . ($currentVal == "Approved | Funded" ? "selected='selected'" : "") . ">" . elgg_echo('Approved | Funded') . "</option>\n";
	$output .= "<option value='Planning' " . ($currentVal == "Planning" ? "selected='selected'" : "") . ">" . elgg_echo('Planning') . "</option>\n";
	$output .= "<option value='Implementation | Conduct' " . ($currentVal == "Implementation | Conduct" ? "selected='selected'" : "") . ">" . elgg_echo('Implementation | Conduct') . "</option>\n";
	$output .= "<option value='Analysis' " . ($currentVal == "Analysis" ? "selected='selected'" : "") . ">" . elgg_echo('Analysis') . "</option>\n";
	$output .= "<option value='Report Writing' " . ($currentVal == "Report Writing" ? "selected='selected'" : "") . ">" . elgg_echo('Report Writing') . "</option>\n";
	$output .= "<option value='Completed' " . ($currentVal == "Completed" ? "selected='selected'" : "") . ">" . elgg_echo('Completed') . "</option>\n";
	$output .= "<option value='Closed Out' " . ($currentVal == "Closed Out" ? "selected='selected'" : "") . ">" . elgg_echo('Closed Out') . "</option>\n";
	$output .= "</select>";

	echo $output;
}
else if($name =='project_type'){
	$type_output ='';
	$type_output .= "<select name='project_type' id='project_type' class='elgg-input-dropdown'>\n";
	$type_output .= "<option value='Learning Application'>" . elgg_echo('projects:learning_app') . "</option>\n";
	$type_output .= "<option value='Courseware and Design'>" . elgg_echo('projects:courseware') . "</option>\n";
	$type_output .= "<option value='Serious Gaming'>" . elgg_echo('projects:serious_gaming') . "</option>\n";
	$type_output .= "<option value='Modelling and Simulation'>" . elgg_echo('projects:modelling_and_simulation') . "</option>\n";
	$type_output .= "<option value='Contracted Research'>" . elgg_echo('projects:contracted_research') . "</option>\n";
	$type_output .= "<option value='Internal Research'>" . elgg_echo('projects:internal_research') . "</option>\n";
	$type_output .= "<option value='Allied Research'>" . elgg_echo('projects:allied_research') . "</option>\n";
	$type_output .= "<option value='Best of the Web: Tools and Resources'>" . elgg_echo('projects:best_of_web') . "</option>\n";
	$type_output .= "<option value='Book Review'>" . elgg_echo('projects:book_review') . "</option>\n";
	$type_output .= "<option value='Massive Open Online Course (MOOC)'>" . elgg_echo('projects:mooc') . "</option>\n";
	$type_output .= "<option value='Other Research Studies'>" . elgg_echo('projects:other_research') . "</option>\n";
	$type_output .= "<option value='PG 4'>" . elgg_echo('projects:pg4') . "</option>\n";
	$type_output .= "</select>";

	echo $type_output;
}
else if($name == 'request'){
	$type_output = '';
	$type_output .= "<select name='request' id='request' class='elgg-input-dropdown'>\n";
	$type_output .= "<option value='Requested' " . ($currentVal == "Requested" ? "selected='selected'" : "") . ">" . elgg_echo('requests:requested') . "</option>\n";
	$type_output .= "<option value='In Progress' " . ($currentVal == "In Progress" ? "selected='selected'" : "") . ">" . elgg_echo('requests:in_progress') . "</option>\n";
	$type_output .= "<option value='Implementation' " . ($currentVal == "Implementation" ? "selected='selected'" : "") . ">" . elgg_echo('requests:implementation') . "</option>\n";
	$type_output .= "<option value='Completed' " . ($currentVal == "Completed" ? "selected='selected'" : "") . ">" . elgg_echo('requests:completed') . "</option>\n";
	$type_output .= "</select>";

	echo $type_output;

}