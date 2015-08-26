<?php
/**
 * view for a survey
 * @package ElggPages
 *
 * @uses $vars['entity']    The survey object
 * @uses $vars['full_view'] Whether to display the full view
*/

$full = elgg_extract('full_view', $vars, FALSE);
$survey = elgg_extract('entity', $vars, FALSE);
$hearSelections = elgg_get_entities_from_relationship(array(
	"relationship" => "hearSelection",
	"relationship_guid" => $survey->guid,
	"inverse_relationship" => true
	));
$reasonSelections = elgg_get_entities_from_relationship(array(
	"relationship" => "reasonSelection",
	"relationship_guid" => $survey->guid,
	"inverse_relationship" => true
	));

$final8Selections = elgg_get_entities_from_relationship(array(
	"relationship" => "final8Selection",
	"relationship_guid" => $survey->guid,
	"inverse_relationship" => true
	));

if($full){
?>
	<section class="survey-results">
		<div class="result"><div class="label"><? echo elgg_echo('surveys:hear[]');?>: </div><? foreach($hearSelections as $selection){
			echo $selection->title . '<br />';
		}?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:reason[]');?>: </div><? foreach($reasonSelections as $selection){
			echo $selection->title . '<br />';
		}
		echo $survey->other1;
		?></div>
		<h3>How do you rate this Workshop?</h3>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:overall');?>: </div><? if($survey->overall == 0){echo "Poor";} elseif($survey->overall == 1){echo "Average";} elseif($survey->overall == 2){echo "Good";} elseif($survey->overall == 3){echo "Excellent";} elseif($survey->overall == 4){echo "Not Applicable";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:speakers');?>: </div><? if($survey->speakers == 0){echo "Poor";} elseif($survey->speakers == 1){echo "Average";} elseif($survey->speakers == 2){echo "Good";} elseif($survey->speakers == 3){echo "Excellent";} elseif($survey->speakers == 4){echo "Not Applicable";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:facilitators');?>: </div><? if($survey->facilitators == 0){echo "Poor";} elseif($survey->facilitators == 1){echo "Average";} elseif($survey->facilitators == 2){echo "Good";} elseif($survey->facilitators == 3){echo "Excellent";} elseif($survey->facilitators == 4){echo "Not Applicable";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:topics');?>: </div><? if($survey->topics == 0){echo "Poor";} elseif($survey->topics == 1){echo "Average";} elseif($survey->topics == 2){echo "Good";} elseif($survey->topics == 3){echo "Excellent";} elseif($survey->topics == 4){echo "Not Applicable";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:structure');?>: </div><? if($survey->structure == 0){echo "Poor";} elseif($survey->structure == 1){echo "Average";} elseif($survey->structure == 2){echo "Good";} elseif($survey->structure == 3){echo "Excellent";} elseif($survey->structure == 4){echo "Not Applicable";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:relevance');?>: </div><? if($survey->relevance == 0){echo "Poor";} elseif($survey->relevance == 1){echo "Average";} elseif($survey->relevance == 2){echo "Good";} elseif($survey->relevance == 3){echo "Excellent";} elseif($survey->relevance == 4){echo "Not Applicable";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:venue');?>: </div><? if($survey->venue == 0){echo "Poor";} elseif($survey->venue == 1){echo "Average";} elseif($survey->venue == 2){echo "Good";} elseif($survey->venue == 3){echo "Excellent";} elseif($survey->venue == 4){echo "Not Applicable";} ?></div>
		<h3>What did you think of the length of the event?</h3>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:overall_length');?>: </div><? if($survey->overall_length == 0){echo "Too Short";} elseif($survey->overall_length == 1){echo "Just Right";} elseif($survey->overall_length == 2){echo "Too Long";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:presentations');?>: </div><? if($survey->presentations == 0){echo "Too Short";} elseif($survey->presentations == 1){echo "Just Right";} elseif($survey->presentations == 2){echo "Too Long";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:breaks');?>: </div><? if($survey->breaks == 0){echo "Too Short";} elseif($survey->breaks == 1){echo "Just Right";} elseif($survey->breaks == 2){echo "Too Long";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:networking');?>: </div><? if($survey->networking == 0){echo "Too Short";} elseif($survey->networking == 1){echo "Just Right";} elseif($survey->networking == 2){echo "Too Long";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:groups');?>: </div><? if($survey->groups == 0){echo "Too Short";} elseif($survey->groups == 1){echo "Just Right";} elseif($survey->groups == 2){echo "Too Long";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:plenaries');?>: </div><? if($survey->plenaries == 0){echo "Too Short";} elseif($survey->plenaries == 1){echo "Just Right";} elseif($survey->plenaries == 2){echo "Too Long";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:worked');?>: </div><? echo $survey->worked; ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:not_useful');?>: </div><? echo $survey->not_useful; ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:useful');?>: </div><? echo $survey->useful; ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:willAttend');?>: </div><? if($survey->willAttend == "Yes"){echo "Yes";} elseif($survey->willAttend == "No"){echo "No";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:attendExplain');?>: </div><? echo $survey->attendExplain; ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:help');?>: </div><? if($survey->help == "Yes"){echo "Yes";} elseif($survey->help == "No"){echo "No";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:helpExplain');?>: </div><? echo $survey->helpExplain; ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:recommend');?>: </div><? if($survey->recommend == "Yes"){echo "Yes";} elseif($survey->recommend == "No"){echo "No";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:otherDeparts');?>: </div><? if($survey->otherDeparts == "Yes"){echo "Yes";} elseif($survey->otherDeparts == "No"){echo "No";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:otherDepartsExplain');?>: </div><? echo $survey->otherDepartsExplain; ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:usefulDev');?>: </div><? if($survey->usefulDev == "Yes"){echo "Yes";} elseif($survey->usefulDev == "No"){echo "No";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:usefulDevExplain');?>: </div><? echo $survey->usefulDevExplain; ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:suggestion');?>: </div><? echo $survey->suggestion; ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:final1');?>: </div><? if($survey->final1 == "Yes"){echo "Yes";} elseif($survey->final1 == "No"){echo "No";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:final2');?>: </div><? if($survey->final2 == "Yes"){echo "Yes";} elseif($survey->final2 == "No"){echo "No";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:final3');?>: </div><? if($survey->final3 == "Yes"){echo "Yes";} elseif($survey->final3 == "No"){echo "No";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:final4');?>: </div><? if($survey->final4 == "Yes"){echo "Yes";} elseif($survey->final4 == "No"){echo "No";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:final5');?>: </div><? if($survey->final5 == "Yes"){echo "Yes";} elseif($survey->final5 == "No"){echo "No";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:final6');?>: </div><? if($survey->final6 == "Yes"){echo "Yes";} elseif($survey->final6 == "No"){echo "No";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:final7');?>: </div><? if($survey->final7 == "Yes"){echo "Yes";} elseif($survey->final7 == "No"){echo "No";} ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:final8[]');?>: </div><? foreach($final8Selections as $selection){
			echo $selection->title . '<br />';
		}
		echo $survey->other2;
		?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:final9');?>: </div><? echo $survey->final9; ?></div>
		<div class="result"><div class="label"><? echo elgg_echo('surveys:final10');?>: </div><? echo $survey->final10; ?></div>

	</section>
<?php 
}
else{
	//list view

	$metadata = elgg_view_menu('entity', array(
		'entity' => $survey,
		'handler' => 'surveys',
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz',
	));
	$desc = "Survey Submission";
	if($survey->final10){
		$subtitle = $survey->final10;
	}
	$viewLink = "<a href='".$survey->getURL()."'>".$desc."</a>";

	$params = array(
		'entity' => $survey,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => $viewLink,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);
	echo elgg_view_image_block(null,$list_body);
}
?>

