<?php
/**
 * Members index
 *
 */

$num_members = get_number_users();

$title = elgg_echo('members');

$options = array('type' => 'user', 'limit'=>50,'full_view' => false);
switch ($vars['page']) {
	case 'popular':
		$options['relationship'] = 'friend';
		$options['inverse_relationship'] = false;
		$content = elgg_list_entities_from_relationship_count($options);
		break;
	case 'online':
		$content = get_online_users();
		break;
	case 'newest':
	default:
		$content = elgg_list_entities($options);
		break;
}

$content.= "<ol id='joyRideTipContent'>
      <li data-class='elgg-heading-main' data-text='".elgg_echo('widget_manager:widgets:next')."' data-options='tipLocation:right;tipAnimation:fade'>
        <h2>".elgg_echo('members:pageinfo:tooltipTitle')."</h2>
        <p>".elgg_echo('members:pageinfo:tooltip')."</p>
      </li>
      <li data-class='elgg-tabs' data-text='".elgg_echo('widget_manager:widgets:next')."' data-options='tipLocation:bottom;tipAnimation:fade'>
        <h2>".elgg_echo('members:newest:tooltipTitle')."</h2>
        <p>".elgg_echo('members:newest:tooltip')."</p>
      </li>
      <li data-class='elgg-tabs' data-text='".elgg_echo('widget_manager:widgets:next')."' data-options='tipLocation:bottom;tipAdjustmentX:100px;tipAnimation:fade'>
        <h2>".elgg_echo('members:popular:tooltipTitle')."</h2>
        <p>".elgg_echo('members:popular:tooltip')."</p>
      </li>
      <li data-class='elgg-tabs' data-text='".elgg_echo('widget_manager:widgets:next')."' data-options='tipLocation:bottom;tipAdjustmentX:200px;tipAnimation:fade'>
        <h2>".elgg_echo('members:online:tooltipTitle')."</h2>
        <p>".elgg_echo('members:online:tooltip')."</p>
      </li>
      <li data-class='elgg-form-members-tag-search' data-text='".elgg_echo('widget_manager:widgets:next')."' data-options='tipLocation:right;tipAnimation:fade'>
        <h2>".elgg_echo('members:searchtag:tooltipTitle')."</h2>
        <p>".elgg_echo('members:searchtag:tooltip')."</p>
      </li>
       <li data-class='elgg-form-members-name-search' data-text='".elgg_echo('widget_manager:widgets:close')."' data-options='tipLocation:right;tipAnimation:fade'>
        <h2>".elgg_echo('members:searchname:tooltipTitle')."</h2>
        <p>".elgg_echo('members:searchname:tooltip')."</p>
      </li>
    </ol>";

$params = array(
	'content' => $content,
	'sidebar' => elgg_view('members/sidebar'),
	'title' => $title . " ($num_members)",
	'filter_override' => elgg_view('members/nav', array('selected' => $vars['page'])),
);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);
