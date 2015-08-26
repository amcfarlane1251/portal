<?php 
/** 
* Activity widget
*/

$options = array();

$page_type = preg_replace('[\W]', '', get_input('page_type', 'all'));
$type = preg_replace('[\W]', '', get_input('type', 'all'));
$subtype = preg_replace('[\W]', '', get_input('subtype', ''));

if ($subtype) {
    $selector = "type=$type&subtype=$subtype";
} else {
    $selector = "type=$type";
}

if ($type != 'all') {
    $options['type'] = $type;
    if ($subtype) {
        $options['subtype'] = $subtype;
    }
}
//show the wire add
//$contents = elgg_view('page/elements/riverwire', array('content' => $content));


$num = $vars['entity']->num_display;

$content = elgg_list_river($options);

echo $content;

if ($content) {
	$wire_url = "activity/all";
	$more_link = elgg_view('output/url', array(
		'href' => $wire_url,
		'text' => elgg_echo('More Posts'),
		'is_trusted' => true,
	));
	echo "<span class=\"elgg-widget-more\">$more_link</span>";
} else {
	echo elgg_echo('No Posts');
}

?>
