<?php
/**
 * Function Library for surveys plugin
 *
*/

function survey_prepare_form_vars($survey = null){
	$values = array(
		'hear[]' => '',
		'reason[]' => '',
		'overall' =>'',
		'speakers' => '',
		'facilitators' => '',
		'topics' => '',
		'structure' => '',
		'relevance' => '',
		'venue' => '',
		'overall_length' => '',
		'presentations' => '',
		'breaks' => '',
		'networking' => '',
		'groups' => '',
		'plenaries' => '',
		'worked' => '',
		'not_useful' => '',
		'useful' => '',
		'willAttend' => '',
		'attendExplain' => '',
		'help' => '',
		'helpExplain' => '',
		'recommend' => '',
		'otherDeparts' => '',
		'otherDepartsExplain' => '',
		'usefulDev' => '',
		'usefulDevExplain' => '',
		'suggestion' => '',
		'final1' => '',
		'final2' => '',
		'final3' => '',
		'final4' => '',
		'final5' => '',
		'final6' => '',
		'final7' => '',
		'final8[]' => '',
		'final9' => '',
		'final10' => '',
		'access_id' => ACCESS_DEFAULT,
		'guid' => null,
		'entity' => $survey,
	);

	return $values;
}

function surveys_hear_values(){
	$values = array(
		'1' => 'From the organizers',
		'2' => 'Canada School of Public Service (CSPS)',
		'3' => 'Colleague or supervisor',
		'4' => 'Other',
	);

	return $values;
}

function surveys_reason_values(){
	$values = array(
		'1' => 'To share my experiences',
		'2' => 'To network',
		'3' => 'To learn something new',
		'4' => 'To support the development of a national security community',
		'5' => 'Volunteered by my manager',
		'6' => 'Other',
	);

	return $values;
}

function surveys_final8_values(){
	$values = array(
		'1' => 'Moderate a page',
		'2' => 'Provide content',
		'3' => 'Other',
	);

	return $values;
}