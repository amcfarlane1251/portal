<?php
/**
 *  Riverajaxmodule content 
 *
 * @package Modules
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 * @uses $vars['ids']                 INT|ARR River item id(s)
 * @uses $vars['subject_guids']       INT|ARR Subject guid(s)
 * @uses $vars['object_guids']        INT|ARR Object guid(s)
 * @uses $vars['annotation_ids']      INT|ARR The identifier of the annotation(s)
 * @uses $vars['action_types']        STR|ARR The river action type(s) identifier
 * @uses $vars['posted_time_lower']   INT     The lower bound on the time posted
 * @uses $vars['posted_time_upper']   INT     The upper bound on the time posted
 *
 * @uses $vars['types']               STR|ARR Entity type string(s)
 * @uses $vars['subtypes']            STR|ARR Entity subtype string(s)
 * @uses $vars['type_subtype_pairs']  ARR     Array of type => subtype pairs where subtype
 *                                            can be an array of subtype strings
 *
 * @uses $vars['relationship']        STR     Relationship identifier
 * @uses $vars['relationship_guid']   INT|ARR Entity guid(s)
 * @uses $vars['inverse_relationship']BOOL    Subject or object of the relationship (false)
 *
 * @uses $vars['limit']               INT     Number to show per page (20)
 * @uses $vars['offset']              INT     Offset in list (0)
 * @uses $vars['count']               BOOL    Count the river items? (false)
 * @uses $vars['order_by']            STR     Order by clause (rv.posted desc)
 * @uses $vars['group_by']            STR     Group by clause
 */

// Manually supporting params
$supported_params = array(
	'ids',
	'subject_guids',
	'object_guids',
	'annotation_ids',
	'action_types',
	'posted_time_lower',
	'posted_time_upper',
	'types',
	'subtypes',
	'type_subtype_pairs',
	'relationship',
	'relationship_guid',
	'inverse_relationship',
	'limit', 
	'offset', 
	'count', 
	'order_by',
	'group_by',
	'loadaction',
);

// Unique ID for the module
$id = uniqid();

echo "
	<div id='{$id}' class='ajaxmodule-content-container riverajaxmodule-content-container'>
		<div class='options'>
";

// Build inputs
foreach($supported_params as $param) {
	
	$value = elgg_extract($param, $vars, NULL);
	
	// Skip empty values
	if (empty($value)) {
		continue;
	}
	
	// JSON encode arrays
	if (is_array($value)) {
		$value = json_encode($value);
	}
	
	// Cast booleans
	if (is_bool($value)) {
		$value = (int)$value;
	}
	
	echo elgg_view('input/hidden', array(
		'name' => $param,
		'id' => $param,
		'value' => $value,
		'disabled' => 'disabled',
	));
}

echo "
		</div>
		<div class='content'>
			<div class='elgg-ajax-loader'></div>
		</div>
	</div>
";