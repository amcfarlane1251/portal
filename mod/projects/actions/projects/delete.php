<?php
/**
 * Remove a project
 *
 * Subprojects are not deleted but are moved up a level in the tree
 *
 * @package ElggPages
 */

$guid = get_input('guid');
$project = get_entity($guid);
if ($project) {
	if ($project->canEdit()) {
		$container = get_entity($project->container_guid);

		// Bring all child elements forward
		$parent = $project->parent_guid;
		$children = elgg_get_entities_from_metadata(array(
			'metadata_name' => 'parent_guid',
			'metadata_value' => $project->getGUID()
		));
		if ($children) {
			foreach ($children as $child) {
				$child->parent_guid = $parent;
			}
		}
		
		if ($project->delete()) {
			system_message(elgg_echo('projects:delete:success'));
			if ($parent) {
				if ($parent = get_entity($parent)) {
					forward($parent->getURL());
				}
			}
			if (elgg_instanceof($container, 'group')) {
				forward("projects/group/$container->guid/all");
			} else {
				forward("projects/owner/$container->username");
			}
		}
	}
}

register_error(elgg_echo('projects:delete:failure'));
forward(REFERER);
