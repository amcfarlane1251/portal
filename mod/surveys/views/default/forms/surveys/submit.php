<?php
/**
 * Form submission for a survey
 * 
*/

$variables = elgg_get_config('surveys');
$rateArray1 = array("overall", "speakers", "facilitators", "topics", "structure", "relevance", "venue", "overall");
foreach($variables as $key => $value){
?>
<div>
	<?if($key=="overall"){?>
		<h3>How do you rate this Workshop</h3>
	<?}
	elseif($key=="overall_length"){?>
		<h3>What did you think of the length of the event?</h3>
	<?}?>
	<label><? echo elgg_echo("surveys:$key"); ?></label>
	<?
	if(in_array($key,$rateArray1)){
		echo elgg_view("input/$value", array(
			'name' => $key,
			'options_values' => array(
				'Poor', 'Average', 'Good', 'Excellent', 'Not Applicable'),
		));
	}
	elseif($value == 'dropdown' && $key != 'rating'){
		echo elgg_view("input/$value", array(
			'name' => $key,
			'options_values' => array(
				'Too Short', 'Just Right', 'Too Long')
		));
	}
	elseif($value == "radio"){
		echo elgg_view("input/$value", array(
			'name' => $key,
			'options' => array(
				'Yes', 'No'
			)
		));
	}
	else{
		echo elgg_view("input/$value", array(
			'name' => $key,
			'value' => ''
		));
	}
	?>
</div>
<?
}

echo elgg_view('input/submit', array('value' => elgg_echo('Submit')));
