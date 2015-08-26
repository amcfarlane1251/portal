<?php

/**
 * Game Mechanics for Elgg
 *
 * @package hypeJunction
 * @subpackage GameMechanics
 *
 * @author Ismayil Khayredinov <ismayil.khayredinov@gmail.com>
 * @copyright Copyright (c) 2011-2014, Ismayil Khayredinov
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 */

namespace hypeJunction\GameMechanics;

const PLUGIN_ID = 'hypeGameMechanics';
const PAGEHANDLER = 'points';

define('HYPEGAMEMECHANICS_RELEASE', 1395099219);

define('HYPEGAMEMECHANICS_BADGE_SUBTYPE', 'hjbadge');
define('HYPEGAMEMECHANICS_BADGERULE_SUBTYPE', 'badge_rule');
define('HYPEGAMEMECHANICS_SCORE_SUBTYPE', 'gm_score_history');

define('HYPEGAMEMECHANICS_DEPENDENCY_REL', 'badge_required');
define('HYPEGAMEMECHANICS_CLAIMED_REL', 'claimed');

elgg_register_class('hypeJunction\\GameMechanics\\gmRule', __DIR__ . '/classes/hypeJunction/GameMechanics/gmRule.php');
elgg_register_class('hypeJunction\\GameMechanics\\gmReward', __DIR__ . '/classes/hypeJunction/GameMechanics/gmReward.php');

// Load libraries
require_once __DIR__ . '/lib/functions.php';
require_once __DIR__ . '/lib/events.php';
require_once __DIR__ . '/lib/hooks.php';
require_once __DIR__ . '/lib/page_handlers.php';

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');
elgg_register_event_handler('upgrade', 'system', __NAMESPACE__ . '\\upgrade');
elgg_register_event_handler('pagesetup', 'system', __NAMESPACE__ . '\\pagesetup');

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\apply_event_rules', 999);
elgg_register_event_handler('all', 'object', __NAMESPACE__ . '\\apply_event_rules', 999);
elgg_register_event_handler('all', 'group', __NAMESPACE__ . '\\apply_event_rules', 999);
elgg_register_event_handler('all', 'user', __NAMESPACE__ . '\\apply_event_rules', 999);
elgg_register_event_handler('all', 'annotation', __NAMESPACE__ . '\\apply_event_rules', 999);
elgg_register_event_handler('all', 'metadata', __NAMESPACE__ . '\\apply_event_rules', 999);
elgg_register_event_handler('all', 'relationship', __NAMESPACE__ . '\\apply_event_rules', 999);

function init() {

	/**
	 * JS and CSS
	 */
	elgg_extend_view('js/elgg', 'js/framework/mechanics/mechanics');
	elgg_extend_view('js/admin', 'js/framework/mechanics/mechanics');

	elgg_extend_view('css/elgg', 'css/framework/mechanics/mechanics');
	elgg_extend_view('css/admin', 'css/framework/mechanics/mechanics');


	/**
	 * Actions
	 */
	elgg_register_action('badge/claim', __DIR__ . '/actions/badge/claim.php');
	elgg_register_action('badge/edit', __DIR__ . '/actions/badge/edit.php', 'admin');
	elgg_register_action('badge/delete', __DIR__ . '/actions/badge/delete.php', 'admin');
	elgg_register_action('badge/order', __DIR__ . '/actions/badge/order.php', 'admin');

	elgg_register_action('points/award', __DIR__ . '/actions/points/award.php');
	elgg_register_action('points/reset', __DIR__ . '/actions/points/reset.php', 'admin');

	/**
	 * URL and page handlers
	 */
	elgg_register_page_handler(PAGEHANDLER, __NAMESPACE__ . '\\page_handler');
	elgg_register_plugin_hook_handler('entity:icon:url', 'object', __NAMESPACE__ . '\\badge_icon_url_handler');
	elgg_register_entity_url_handler('object', HYPEGAMEMECHANICS_BADGE_SUBTYPE, __NAMESPACE__ . '\\badge_url_handler');
	
	/**
	 * Rules
	 */
	elgg_register_plugin_hook_handler('get_rules', 'gm_score', __NAMESPACE__ . '\\setup_scoring_rules');

	/**
	 * Menus
	 */
	elgg_register_plugin_hook_handler('register', 'menu:entity', __NAMESPACE__ . '\\entity_menu_setup');
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', __NAMESPACE__ . '\\owner_block_menu_setup');
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', __NAMESPACE__ . '\\user_hover_menu_setup');

	/**
	 * Permissions
	 */
	elgg_register_plugin_hook_handler('permissions_check:annotate', 'user', __NAMESPACE__ . '\\permissions_check_gm_score_award');
			
	/**
	 * Views
	 */
	elgg_register_widget_type('hjmechanics', elgg_echo('mechanics:widget:badges'), elgg_echo('mechanics:widget:badges:description'), 'index');

	elgg_extend_view('framework/mechanics/sidebar', 'framework/mechanics/history/filter');
	elgg_extend_view('framework/mechanics/sidebar', 'framework/mechanics/leaderboard/filter');
	
	// Load fonts
	elgg_extend_view('page/elements/head', 'framework/fonts/font-awesome');
	elgg_extend_view('page/elements/head', 'framework/fonts/open-sans');
}

