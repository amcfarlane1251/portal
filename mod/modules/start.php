<?php
/**
 * Modules start.php
 * 
 * @package Modules
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */

elgg_register_event_handler('init', 'system', 'modules_init');

// Init
function modules_init() {
	
	// Register and load library
	elgg_register_library('ajaxmodule', elgg_get_plugins_path() . 'modules/lib/ajaxmodule.php');
	elgg_load_library('ajaxmodule');
	
	// Ajax module page handler
	elgg_register_page_handler('ajaxmodule', 'ajaxmodule_page_handler');

	// Register view hook handler
	elgg_register_plugin_hook_handler('view', 'all', 'ajaxmodule_view_hook_handler');
	
	// Register icon handlers
	elgg_register_plugin_hook_handler('entity:icon:url', 'object', 'simpleicon_hook_handler', 600);
	
	// Register JS
	$ajaxmodule_js = elgg_get_simplecache_url('js', 'modules/ajaxmodule');
	elgg_register_simplecache_view('js/modules/ajaxmodule');
	elgg_register_js('elgg.modules.ajaxmodule', $ajaxmodule_js);
	
	// Register JS
	$genericmodule_js = elgg_get_simplecache_url('js', 'modules/genericmodule');
	elgg_register_simplecache_view('js/modules/genericmodule');
	elgg_register_js('elgg.modules.genericmodule', $genericmodule_js);
	
	// Register CSS
	$m_css = elgg_get_simplecache_url('css', 'modules/css');
	elgg_register_simplecache_view('css/modules/css');
	elgg_register_css('elgg.modules', $m_css);
	
	// Load JS/CSS
	elgg_load_js('elgg.modules.ajaxmodule');
	elgg_load_js('elgg.modules.genericmodule');
	elgg_load_css('lightbox');
	elgg_load_js('lightbox');	
	elgg_load_css('elgg.modules');
}

/**
* Ajaxmodule page handler
* 
* @param array $page From the page_handler function
* @return true|false Depending on success
*
*/
function ajaxmodule_page_handler($page) {
	switch ($page[0]) {
		case 'load_activity_ping':
			// check for last checked time
			if (!$seconds_passed = get_input('seconds_passed', 0)) {
				echo '';
				exit;
			}

			$last_reload = time() - $seconds_passed;

			// Get current count of entries
			$current_count = elgg_get_river(array(
				'count' => TRUE,
			));

			// Get the count at the last reload
			$last_count = elgg_get_river(array(
				'count' => TRUE,
				'posted_time_upper' => $last_reload,
			));

			if ($current_count > $last_count) {
				$count = $current_count - $last_count;

				$s = ($count == 1) ? '' : 's';

				$link = "<a id='refresh-river-module' href='#' class='update_link'>$count update$s!</a>";
				$page_title = "[$count update$s] ";

				echo json_encode(array(
					'count' => $count,
					'link' => $link,
				));

				exit;
			}
			break;
		case 'loadriver':
			// River options
			$options['ids'] 					= get_input('ids');
			$options['subject_guids'] 			= json_decode(get_input('subject_guids'));
			$options['object_guids'] 			= json_decode(get_input('object_guids'));
			$options['annotation_ids'] 			= json_decode(get_input('annotation_ids'));
			$options['action_types']	 		= json_decode(get_input('action_types'));
			$options['posted_time_lower'] 		= get_input('posted_time_lower');
			$options['posted_time_upper'] 		= get_input('posted_time_upper');
			$options['types'] 					= get_input('types');
			$options['subtypes'] 				= get_input('subtypes');
			$options['type_subtype_pairs']		= json_decode(get_input('type_subtype_pairs'));
			$options['relationship'] 			= get_input('relationship');
			$options['relationship_guid'] 		= get_input('relationship_guid');
			$options['inverse_relationship'] 	= get_input('inverse_relationship');
			$options['limit'] 					= get_input('limit', 15); 
			$options['offset'] 					= get_input('offset', 0); 
			$options['count'] 					= get_input('count'); 
			$options['order_by'] 				= get_input('order_by');
			$options['group_by'] 				= get_input('group_by');
			
			// Remove empty options
			foreach($options as $key => $option) {
				if ($option === NULL || empty($options)) {
					unset($options[$key]);
				} 
			}

			$options = elgg_trigger_plugin_hook('get_options', 'river', '', $options);

			// Display river
			$river = elgg_list_river($options);
			
			if (!$river) {
				echo "<div style='font-weight: bold; margin-top: 10px; margin-bottom: 10px; border-top: 1px solid #aaa; width: 100%; text-align: center;'>" . elgg_echo('river:none') . "</div>";
			} else {
				//echo $river;
				echo elgg_trigger_plugin_hook('output', 'page', array(), $river);
			}
			
			break;
		case 'loadentities':
			// Entity options
			$options['container_guid'] 				= get_input('container_guid');
			$options['tag']							= get_input('tag', false);
			$options['tags']						= json_decode(get_input('tags', false));
			$options['types']						= json_decode(get_input('types'));
			$options['subtypes']					= json_decode(get_input('subtypes'));
			$options['limit']						= get_input('limit', 10);
			$options['offset']						= get_input('offset', 0);
			$options['owner_guids']					= json_decode(get_input('owner_guids'));
			$options['created_time_upper']			= get_input('created_time_upper');
			$options['created_time_lower']			= get_input('created_time_lower');
			$options['count'] 						= get_input('count', FALSE);

			// Store access status
			$access_status = access_get_show_hidden_status();

			// Check if bypassing hidden entities
			if (get_input('access_show_hidden_entities')) {
				// Override
				access_show_hidden_entities(true);
			}

			// Set 'listing type' for new simple listing if supplied
			if ($listing_type = get_input('listing_type', FALSE)) {
				set_input('ajaxmodule_listing_type', $listing_type);
			}
			
			// Make sure container guid isn't empty
			$options['container_guid'] = !empty($options['container_guid']) ? $options['container_guid'] : ELGG_ENTITIES_ANY_VALUE;
 						
			if (get_input('restrict_tag')) {
				// Grab content with supplied tags ONLY
				elgg_set_context('search');
				
				$options['type'] = 'object';
				$options['full_view'] = FALSE;
				
				// Multiple tags
				if ($options['tags']) {
			 		foreach($options['tags'] as $tag) {
						$options['metadata_name_value_pairs'][] = array(	
							'name' => 'tags', 
							'value' => $tag, 
							'operand' => '=',
							'case_sensitive' => FALSE
						);
					}
				} else { // Just one
					$options['metadata_name_value_pairs'] = array(array(	
						'name' => 'tags', 
						'value' => $options['tag'], 
						'operand' => '=',
						'case_sensitive' => FALSE
					));
					unset($options['tag']);
				}
				unset($options['tags']);

				// Let plugins decide if we want to check the container of the container as well (ie photos)
				if ($options['container_guid'] && elgg_trigger_plugin_hook('check_parent_container', 'modules', $options['subtypes'], FALSE)) {
					$dbprefix = elgg_get_config('dbprefix');
					$cont = sanitise_int($options['container_guid']);
					$options['joins'][] = "JOIN {$dbprefix}entities container_e on e.container_guid = container_e.guid";
					$options['wheres'][] = "(e.container_guid in ({$cont}) OR container_e.container_guid in ({$cont}))";
					unset($options['container_guid']);
				}

				if ($options['count']) {
					$entities = elgg_get_entities_from_metadata($options);
					echo $entities;
					break;
				} else {
					$content = elgg_list_entities_from_metadata($options);
				}
				
			} else if (get_input('albums_images')) {
				// Grab photos with tag, including photos in albums with tag
				$options['full_view'] = FALSE;
				$options['list_type'] = 'gallery';
			 	$content = elgg_list_entities($options, 'am_get_entities_from_tag_and_container_tag');
			} else if (!get_input('restrict_tag') && $options['container_guid'] != ELGG_ENTITIES_ANY_VALUE) {
				// Container supplied, and not restricting tags
				$options['full_view'] = FALSE;
				$content = elgg_list_entities($options);
			} else {
				// Default to container or tag
				$content = am_list_entities_by_container_or_tag($options);
			}

			// Display friendly message if there is no content
			if (!$content) {
				echo "<div style='width: 100%; text-align: center; margin: 10px;'><strong>No results</strong></div>";
			} else {
				echo $content;
			}
			break;
		default;
			access_show_hidden_entities($access_status);
			return FALSE;
	}
	access_show_hidden_entities($access_status);
	return TRUE;
}

// Ajaxmodule view hook handler
function ajaxmodule_view_hook_handler($hook, $entity_type, $value, $params) {
	// Only dealing with object views here
	if (strpos($params['view'], 'object/') === 0) {
		switch (get_input('ajaxmodule_listing_type')) {
			case 'simple':
				if ($params['view'] != 'object/ajaxmodule/simple') {
					return elgg_view('object/ajaxmodule/simple', $params['vars']);	
				}
				break;
			case 'simpleicon':
				if (elgg_instanceof($entity = $params['vars']['entity'], 'object')) {
					$subtype = $entity->getSubtype();
					elgg_set_context('ajax_module_simpleicon');
					if ($params['view'] != "object/ajaxmodule/simpleicon/$subtype"
						&& $params['view'] != "object/ajaxmodule/simpleicon/generic") {
							
						if (elgg_view_exists("object/ajaxmodule/simpleicon/$subtype")) {
							return elgg_view("object/ajaxmodule/simpleicon/$subtype", $params['vars']);
						} else {
							return elgg_view("object/ajaxmodule/simpleicon/generic", $params['vars']);
						}	
					}
				}
				break;
			default: 
				break;
		}
	}
	return $value;
}

// Icon handler for core and other entities not under our control
function simpleicon_hook_handler($hook, $entity_type, $value, $params) {
	if (elgg_get_context() == 'ajax_module_simpleicon') {
		switch($params['entity']->getSubtype()) {
			case 'bookmarks':
				return elgg_get_site_url() . 'mod/modules/images/bookmark.png';
				break;
			case 'blog':
				return elgg_get_site_url() . 'mod/modules/images/balloon-left.png';
				break;
			case 'groupforumtopic':
				return elgg_get_site_url() . 'mod/modules/images/balloon-box.png';
				break;
			case 'forum_topic':
				return elgg_get_site_url() . 'mod/modules/images/balloon-box.png';
				break;
			case 'forum':
				return elgg_get_site_url() . 'mod/modules/images/balloons-box.png';
				break;
			case 'thewire':
				return elgg_get_site_url() . 'mod/modules/images/balloon-quotation.png';
				break;
			case 'todo':
				return elgg_get_site_url() . 'mod/modules/images/document-task.png';
				break;
			case 'webvideo':
			case 'videolist':
			case 'simplekaltura_video':
				return elgg_get_site_url() . 'mod/modules/images/film.png';
				break;
			case 'tagdashboard':
				return elgg_get_site_url() . 'mod/modules/images/tags.png';
				break;
			case 'album':
				return elgg_get_site_url() . 'mod/modules/images/photo-album.png';
				break;
			case 'file':
				return $value;
				break;
			case 'book':
				return elgg_get_site_url() . 'mod/modules/images/book-bookmark.png';
				break;
			default:
				return elgg_get_site_url() . 'mod/modules/images/document.png';
				break;
		}
	}
	return $value;
}
