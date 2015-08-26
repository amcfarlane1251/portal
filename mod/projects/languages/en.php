<?php
/**
 * projects languages
 *
 * @package Elggprojects
 */

$english = array(

	/**
	 * Menu items and titles
	 */

	'projects' => "Projects",
	'projects:owner' => "%s's projects",
	'projects:friends' => "Friends' projects",
	'projects:all' => "Learning Project Registry",
	'projects:add' => "Add project",
	'projects:request' => "Request a Project",

	'projects:group' => "Group projects",
	'groups:enableprojects' => 'Enable group projects',

	'projects:edit' => "Edit this project",
	'projects:delete' => "Delete this project",
	'projects:history' => "History",
	'projects:view' => "View project",
	'projects:revision' => "Revision",

	'projects:navigation' => "Navigation",
	'projects:via' => "via projects",
	'item:object:project_top' => 'Projects',
	'item:object:project' => 'projects',
	'projects:nogroup' => 'This group does not have any projects yet',
	'projects:more' => 'More projects',
	'projects:none' => 'No projects created yet',

	/**
	* River
	**/

	'river:create:object:project' => '%s created a project %s',
	'river:create:object:project_top' => '%s created a project %s',
	'river:update:object:project' => '%s updated a project %s',
	'river:update:object:project_top' => '%s updated a project %s',
	'river:comment:object:project' => '%s commented on a project titled %s',
	'river:comment:object:project_top' => '%s commented on a project titled %s',

	/**
	 * Form fields
	 */

	'projects:title' => 'Project Title',
	'projects:description' => 'Project Description',
	'projects:cost' => 'Project Cost',
	'projects:organization' => 'Organization',
	'projects:funding' => 'Funding Source', 
	'projects:tags' => 'Tags',
	'projects:access_id' => 'Read access',
	'projects:write_access_id' => 'Write access',
	'projects:project_type' => 'Type',
	'projects:status' => 'Status',
	'projects:assigned_to' => 'OPI',
	'projects:upload' => 'Attachment(s)',
	'projects:addOpi' => 'Add',


	/**
	 * Status and error messages
	 */
	'projects:noaccess' => 'No access to project',
	'projects:cantedit' => 'You cannot edit this project',
	'projects:saved' => 'project saved',
	'projects:notsaved' => 'project could not be saved',
	'projects:error:no_title' => 'You must specify a title for this project.',
	'projects:error:invalid_opis' => 'OPIs must be unique.',
	'projects:delete:success' => 'The project was successfully deleted.',
	'projects:delete:failure' => 'The project could not be deleted.',

	/**
	 * project
	 */
	'projects:strapline' => 'Last updated %s by %s',
	'projects:transfer:myself' => '',

	/**
	 * History
	 */
	'projects:revision:subtitle' => 'Revision created %s by %s',

	/**
	 * Widget
	 **/

	'projects:num' => 'Number of projects to display',
	'projects:widget:description' => "This is a list of your projects.",

	/**
	 * Submenu items
	 */
	'projects:label:view' => "View project",
	'projects:label:edit' => "Edit project",
	'projects:label:history' => "project history",

	/**
	 * Sidebar items
	 */
	'projects:sidebar:this' => "This project",
	'projects:sidebar:children' => "Sub-projects",
	'projects:sidebar:parent' => "Parent",

	'projects:newchild' => "Create a sub-project",
	'projects:backtoparent' => "Back to '%s'",
	
	
	
	'projects:start_date' => "Start Date",
	'projects:end_date' => "End Date",
	'projects:percent_done' => " Done",
	'projects:work_remaining' => "Remain.",
	 


	 
	 'projects:learning_app' => 'Learning Application',
	 'projects:courseware' => 'Courseware and Design',
	 'projects:serious_gaming' => 'Serious Gaming',
	 'projects:modelling_and_simulation' => 'Modelling and Simulation',
	 'projects:contracted_research' => 'Contracted Research',
	 'projects:internal_research' => 'Internal Research',
	 'projects:allied_research' => 'Allied Research',
	 'projects:best_of_web' => 'Best of the Web: Tools and Resources',
	 'projects:book_review' => 'Book Review',
	 'projects:mooc' => 'Massive Open Online Course (MOOC)',
	 'projects:other_research' => 'Other Research Studies',
	 'projects:pg4' => "PG 4",

	 'projects:project_type_'=>"",
	 'projects:project_type_0'=>"",
	 'projects:project_type_1'=>"Analyse",
	 'projects:project_type_2'=>"Specifications",
	 'projects:project_type_3'=>"Developement",
	 'projects:project_type_4'=>"Test",
	 'projects:project_type_5'=>"Mise en production",
	 
	 'projects:project_status_'=>"",
	 'projects:project_status_0'=>"",
	 'projects:project_status_1'=>"Opened",
	 'projects:project_status_2'=>"Assigned",
	 'projects:project_status_3'=>"Charged",
	 'projects:project_status_4'=>"In progress",
	 'projects:project_status_5'=>"Closed",
	 
	 'projects:project_percent_done_'=>"0%",
	 'projects:project_percent_done_0'=>"0%",
	 'projects:project_percent_done_1'=>"20%",
	 'projects:project_percent_done_2'=>"40%",
	 'projects:project_percent_done_3'=>"60%",
	 'projects:project_percent_done_4'=>"80%",
	 'projects:project_percent_done_5'=>"100%",
	 
	 'projects:projectsboard'=>"projectsBoard",
	 'projects:projectsmanage'=>"Manage",
	 'projects:projectsmanageone'=>"Manage a project",

	 'projects:search:title' => 'Search Projects',
	 'projects:search:tagTitle' => 'Search By Tag',

	 'requests:add' => 'Request a Project',
	 'requests:submit' => 'Request Project',

	 'requests:requested' => 'Requested',
	 'requests:received' => 'Received',
	 'requests:in_progress' => 'In Progress',
	 'requests:implementation' => 'Implementation',
	 'requests:completed' => 'Completed',
	 'requests:edit' => 'Edit This Request',
);

add_translation("en", $english);