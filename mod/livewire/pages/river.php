<?php
/**
 * Main activity stream list page
 */
 
elgg_load_js('river');

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

switch ($page_type) {
    case 'mine':
        $title = elgg_echo('river:mine');
        $page_filter = 'mine';
        $options['subject_guid'] = elgg_get_logged_in_user_guid();
        break;
    case 'friends':
        $title = elgg_echo('river:friends');
        $page_filter = 'friends';
        $options['relationship_guid'] = elgg_get_logged_in_user_guid();
        $options['relationship'] = 'friend';
        break;
    default:
        $title = elgg_echo('river:all');
        $page_filter = 'all';
        break;
}

/* 
this mobile check is required because the mobile 2.0 beta plugin that we are using uses jquery mobile and thus every page load is ajax
elgg_is_xhr() will check for an ajax page load and produce the wrong functionality because of JQM
*/

$useragent= strtolower ($_SERVER['HTTP_USER_AGENT']);	
if(preg_match('/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/',$useragent)||preg_match('/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /',$useragent && !strstr($useragent,'ipad'))){
	$mobile = true;
} else {
	$mobile = false;
}

if (!elgg_is_xhr() || $mobile) {
	$options['offset'] = (int)(get_input('offset'));
    $options['data-options'] = htmlentities(json_encode($options), ENT_QUOTES, 'UTF-8');
	$options['pagination'] = true;
    $activity = elgg_list_river($options);
    if (!$activity) {
		$activity = elgg_echo('river:none');
    }

    $content = elgg_view('core/river/filter', array('selector' => $selector));

    $sidebar = elgg_view('core/river/sidebar');

    $params = array(
        'content' => $content . $activity,
        'sidebar' => $sidebar,
        'filter_context' => $page_filter,
        'class' => 'elgg-river-layout',
    );

    $body = elgg_view_layout('content', $params);

    echo elgg_view_page($title, $body);
} else {	
	
    $sync = get_input('sync');
    $ts = (int) get_input('time');
    if (!$ts) {
        $ts = time();
    }
    $options = get_input('options');
	
    if ($sync == 'new') {
        $options['wheres'] = array("rv.posted > {$ts}");
        $options['order_by'] = 'rv.posted asc';
        $options['limit'] = 0;
    }

    $items = elgg_get_river($options);

	if (is_array($items) && count($items) > 0) {
		foreach ($items as $key => $item) {
			$id = "item-{$item->getType()}-{$item->id}";
			$time = $item->posted;

			$html = "<li id=\"$id\" class=\"elgg-item\" data-timestamp=\"$time\">";
			$html .= elgg_view_list_item($item, $vars = array());
			$html .= '</li>';

			$output[] = $html;
		}
	}
	print(json_encode($output));
	exit;
	
}
