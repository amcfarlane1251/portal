<?php
/**
 * Group search
 *
 * @package ElggGroups
 */
$url = elgg_get_site_url() . 'groups/search';
$body = elgg_view_form('groups/find', array(
	'action' => $url,
	'method' => 'get',
	'disable_security' => true,
));

echo elgg_view_module('aside', elgg_echo('groups:searchtag'), $body);

/*
 * Section For Joyride - Groups Page 
 */
echo "
<ol id='joyRideTipContent'>";
echo "
	<!--tooltip for Create Group Button-->
	<li data-class='elgg-menu-item-add' data-text='".elgg_echo('widget_manager:widgets:next')."' data-options='tipLocation:left;tipAnimation:fade'>
    	<h2>".elgg_echo('groups:button:create:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:button:create:tooltip')."</p>
	</li>
	<!--tooltip for Group Tabs-->
	<li data-class='elgg-menu-item-newest' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:tab:newest:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:tab:newest:tooltip')."</p>
    </li>
    <li data-class='elgg-menu-item-yours' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:tab:yours:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:tab:yours:tooltip')."</p>
    </li>
    <li data-class='elgg-menu-item-popular' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:tab:popular:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:tab:popular:tooltip')."</p>
    </li>
    <li data-class='elgg-menu-item-discussion' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:tab:discussion:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:tab:discussion:tooltip')."</p>
    </li>
    <li data-class='elgg-menu-item-open' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:tab:open:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:tab:open:tooltip')."</p>
    </li>
    <li data-class='elgg-menu-item-closed' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:tab:closed:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:tab:closed:tooltip')."</p>
    </li>
    <li data-class='elgg-menu-item-alpha' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:tab:alpha:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:tab:alpha:tooltip')."</p>
    </li>
    <li data-class='elgg-menu-item-suggested' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:tab:suggested:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:tab:suggested:tooltip')."</p>
    </li>
    <!--tooltip for Groups Side Nav-->
    <li data-class='elgg-menu-page' data-button='".elgg_echo('widget_manager:widgets:next')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:nav:sidebar:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:nav:sidebar:tooltip')."</p>
    </li>
    <!--tooltip for Groups Search-->
	<li data-class='elgg-form-groups-find' data-button='".elgg_echo('widget_manager:widgets:close')."' data-prev-button='".elgg_echo('widget_manager:widgets:prev')."' data-options='tipLocation:left;tipAnimation:fade'>
        <h2>".elgg_echo('groups:search:groups:tooltipTitle')."</h2>
        <p>".elgg_echo('groups:search:groups:tooltip')."</p>
    </li>";
echo 
"</ol>";