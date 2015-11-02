<?php
$variables = elgg_get_config('projects');
//check for opis
$opis = get_opis($vars['guid']);

foreach ($variables as $name => $type) {
?>
<div>
	<?php if($name == 'assigned_to[]'){
		?><label><?php echo elgg_echo ("projects:assigned_to"); ?></label>
		<a class="add-opi" href="#"><?php echo elgg_echo('projects:addOpi');?></a>
	<?php } 
	else{
		?><label><?php echo elgg_echo("projects:$name"); ?></label>
	<?php }
	
	if($type == 'file'){
		echo elgg_view("input/file", array(
			'name' => 'upload[]',
			'multiple' => true
		));
	}
	elseif($type == 'assign_to'){
		if($opis){
			foreach($opis as $opi){
				
					$html = "<div class='add-opi-container'>";
					$html .= elgg_view("input/$type", array(
						'name' => $name,
						'value' => $opi->guid,
					));
					$html .= "<a href='#' class='remove-opi'>Remove</a></div>";
					echo $html;
				
			}
		}
		else{
			$html = "<div class='add-opi-container'>";
			$html .= elgg_view("input/$type", array(
				'name' => $name,
				'value' => $vars[$name],
			));
			$html .= "<a href='#' class='remove-opi'>Remove</a></div>";
			echo $html;
		}
	}
	else{ 
		echo elgg_view("input/$type", array(
				'name' => $name,
				'value' => $vars[$name],
			));
	}
	?>
</div>


<?php

}

$cats = elgg_view('input/categories', $vars);
if (!empty($cats)) {
	echo $cats;
}

echo '<div class="elgg-foot">';
if ($vars['guid']) {
	echo elgg_view('input/hidden', array(
		'name' => 'project_guid',
		'value' => $vars['guid'],
	));
}
echo elgg_view('input/hidden', array(
	'name' => 'container_guid',
	'value' => $vars['container_guid'],
));
if ($vars['parent_guid']) {
	echo elgg_view('input/hidden', array(
		'name' => 'parent_guid',
		'value' => $vars['parent_guid'],
	));
}

echo elgg_view('input/submit', array('value' => elgg_echo('save')));

echo '</div>';