<?php

$name = $vars['name'];

if($name == 'hear[]'){
	$values = surveys_hear_values();
	$output ='';
	foreach($values as $key => $value){
		$output .= "<input type='checkbox' name='".$name."' value='$value' />$value<br />";
	}
}
elseif($name == 'reason[]'){
	$values = surveys_reason_values();
	$output ='';
	foreach($values as $key => $value){
		$output .= "<input type='checkbox' name='".$name."' value='$value' />$value<br />";
	}
	$output .= elgg_view('input/text', array(
		'name' => 'other1',
	));
}
elseif($name == 'final8[]'){
	$values = surveys_final8_values();
	$output ='';
	foreach($values as $key => $value){
		$output .= "<input type='checkbox' name='".$name."' value='$value' />$value<br />";
	}
	$output .= elgg_view('input/text', array(
		'name' => 'other2',
	));
}

echo $output;

