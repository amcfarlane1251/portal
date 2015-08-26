<?php
/**
 * Ajaxmodule lib
 * 
 * @package Modules
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

/** 
 * Custom function to grab entities belonging to a container OR a tag
 */
function am_list_entities_by_container_or_tag($options) {	
	if ($options['container_guid']) {
		$container_sql = "e.container_guid IN ({$options['container_guid']})";
	}

	if ($options['tag']) {
		$access_sql = get_access_sql_suffix('tag_meta_table');
		$tag_sql = "
			(
				(tag_msn.string IN ('tags')) AND ( BINARY tag_msv.string IN ('{$options['tag']}')) 
				AND
				$access_sql
			)
		";
	}

	$subtypes		= (is_array($options['subtypes'])) ? $options['subtypes'] : array();
	$limit			= ($options['limit'] === NULL) ? 10 : $options['limit']; 
	$offset			= ($options['offset'] === NULL) ? 0 : $options['offset'];
	$title 			= ($options['title'] === NULL) ? 'Custom Module' : $options['title'];
	
	global $CONFIG;

	// As long as we have either a container_guid or a tag, use the $wheres
	if ($container_sql || $tag_sql) {
		$joins[] = "JOIN {$CONFIG->dbprefix}metadata tag_meta_table on e.guid = tag_meta_table.entity_guid";
		$joins[] = "JOIN {$CONFIG->dbprefix}metastrings tag_msn on tag_meta_table.name_id = tag_msn.id";
		$joins[] = "JOIN {$CONFIG->dbprefix}metastrings tag_msv on tag_meta_table.value_id = tag_msv.id";
		
		// Need to watch the brackets here.. 
		$wheres[] = "
			(
				$container_sql
				OR
				$tag_sql
			)
		";
	}
	
	// Not sure if I still need this one..
	elgg_push_context('search');
	
	// Don't display metadata menu
	elgg_push_context('widgets');
	
	$params = array(
		'type' => 'object',
		'subtypes' => $subtypes,
		'joins' => $joins,
		'wheres' => $wheres,
		'full_view' => FALSE,
		'limit' => $limit,
		'offset' => $offset,
		'owner_guids' => $options['owner_guids'],
		'created_time_upper' => $options['created_time_upper'],
		'created_time_lower' => $options['created_time_lower'],
		'count' => $options['count'],
	);

	if ($options['count']) {
		$entities = elgg_get_entities_from_metadata($params);
		echo $entities;
	} else {
		$entities = elgg_list_entities_from_metadata($params);
		
		if ($entities) {
			return $entities;
		} else {
			return "<div style='width: 100%; text-align: center; margin: 10px;'><strong>No results</strong></div>";
		}
	}
}

/**
 * Screwy function name I know.. this is a hacked up entity getter
 * function that gets entities with given tag ($params['tag']) and
 * entities with a container guid with given tag. This is mostly for images, but 
 * could work on just about anything. I couldn't do this with any existing elgg
 * core functions, so I have this here custom query.
 *
 * @uses $params['tag']
 * @uses $params['callback'] - pass in a callback, or use none (return just data rows)
 * @return array
 */
function am_get_entities_from_tag_and_container_tag($params) {
	global $CONFIG;
	
	// Default Callback
	if (!$params['callback']) {
		$params['callback'] = 'entity_row_to_elggstar';
	}
	
	// Default Types
	if (!$params['types']) {
		$params['types'] = array('object');
	}
	
	$px = $CONFIG->dbprefix;
		
	$type_subtype_sql = elgg_get_entity_type_subtype_where_sql('e', $params['types'], $params['subtypes'], $params['type_subtype_pairs']);
	
	if (is_array($params['owner_guids'])) {
		$owner_guids_sql = " AND " . elgg_get_guid_based_where_sql('e.owner_guid', $params['owner_guids']) . " ";
	}
	
	if ((int)$params['created_time_upper'] && (int)$params['created_time_lower']) {
		$date_sql = " AND " . elgg_get_entity_time_where_sql(
			'e', 
			$params['created_time_upper'],
			$params['created_time_lower'], 
			$params['modified_time_upper'], 
			$params['modified_time_lower']
		);
	}

	$access_sql = get_access_sql_suffix('e');
	
	// Include additional wheres
	if ($params['wheres']) {
		foreach($params['wheres'] as $where) {
			$wheres .= " AND $where";
		}
	}

	// Support Multiple tags
	if (is_array($params['tags']) && count($params['tags']) > 1) {
		foreach ($params['tags'] as $idx => $tag) {
			$index = $idx + 1;
			$metadata .= "
				JOIN {$px}metadata n_table{$index} on e.guid = n_table{$index}.entity_guid 
				JOIN {$px}metastrings msn{$index} on n_table{$index}.name_id = msn{$index}.id 
				JOIN {$px}metastrings msv{$index} on n_table{$index}.value_id = msv{$index}.id 
			";

			$container_metadata .= "
				JOIN {$px}metadata c_table{$index} on e.container_guid = c_table{$index}.entity_guid 
				JOIN {$px}metastrings cmsn{$index} on c_table{$index}.name_id = cmsn{$index}.id 
				JOIN {$px}metastrings cmsv{$index} on c_table{$index}.value_id = cmsv{$index}.id 
			";

			$m_wheres .= "(msn{$index}.string = 'tags' AND msv{$index}.string = '{$tag}')";

			$container_m_wheres .= "(cmsn{$index}.string = 'tags' AND cmsv{$index}.string = '{$tag}')";

			if (count($params['tags']) != $index) {
				$m_wheres .= " AND ";
				$container_m_wheres .= " AND ";
			}
		}
	} else {
		// Single tag
		$metadata = "
			JOIN {$px}metadata n_table1 on e.guid = n_table1.entity_guid 
			JOIN {$px}metastrings msn1 on n_table1.name_id = msn1.id 
			JOIN {$px}metastrings msv1 on n_table1.value_id = msv1.id
		";
		$m_wheres = "(msn1.string = 'tags' AND msv1.string = '{$params['tag']}')";
		
		$container_metadata = "
			JOIN {$px}metadata c_table on e.container_guid = c_table.entity_guid 
			JOIN {$px}metastrings cmsn on c_table.name_id = cmsn.id 
			JOIN {$px}metastrings cmsv on c_table.value_id = cmsv.id 
		";

		$container_m_wheres = "(cmsn.string = 'tags' AND cmsv.string = '{$params['tag']}')";
	}

	if ($params['container_guid']) {
		$cont = $params['container_guid'];
		$container_guid_join = "JOIN {$px}entities container_e on e.container_guid = container_e.guid";
		$wheres .= "AND (e.container_guid in ({$cont}) OR container_e.container_guid in ({$cont}))";
	}
		
	$query =   "(SELECT e.* FROM {$CONFIG->dbprefix}entities e 
				$metadata
				$container_guid_join
				WHERE $m_wheres
					AND {$type_subtype_sql}
					$owner_guids_sql
					$container_guid_sql
					$date_sql
					AND (e.site_guid IN ({$CONFIG->site_guid}))
					AND $access_sql
					$wheres) 
				UNION DISTINCT
				(SELECT e.* FROM {$CONFIG->dbprefix}entities e 
				$container_metadata
				$container_guid_join
				WHERE $container_m_wheres
					AND {$type_subtype_sql}
					$owner_guids_sql
					$container_guid_sql
					$date_sql
					AND (e.site_guid IN ({$CONFIG->site_guid}))
					AND $access_sql
					$wheres) ";
																							
	if (!$params['count']) {
		$query .= " ORDER BY time_created desc";
		
		if ($params['limit']) {
			$limit = sanitise_int($params['limit']);
			$offset = sanitise_int($params['offset']);
			$query .= " LIMIT $offset, $limit";
		}
		$dt = get_data($query, $params['callback']);			
		return $dt;
	} else {
		$dt = get_data($query);
		return count($dt);
	}
}