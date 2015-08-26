<?php

/* hypeAlive
 *
 * Comments
 * Likes
 * Notifications
 * River
 *
 * @package hypeJunction
 * @subpackage hypeAlive
 *
 * @author Ismayil Khayredinov <ismayil.khayredinov@gmail.com>
 * @copyright Copyrigh (c) 2011, Ismayil Khayredinov
 */

elgg_register_event_handler('init', 'system', 'hj_alive_init');

/**
 * Initialize hypeAlive
 */
function hj_alive_init() {

	$plugin = 'hypeAlive';

	$shortcuts = hj_path_shortcuts($plugin);
	
	elgg_register_classes($shortcuts['classes']);

		hj_alive_search_init();

}

/* ================================
 * LIVESEARCH
  ================================ */

function hj_alive_search_init() {
	$plugin = 'hypeAlive';

	$shortcuts = hj_path_shortcuts($plugin);
	elgg_register_action('livesearch/parse', $shortcuts['actions'] . 'hj/livesearch/parse.php', 'public');

	elgg_extend_view('css/elements/modules', 'css/hj/livesearch/base');

	$js = elgg_get_simplecache_url('js', 'hj/livesearch/autocomplete');
	elgg_register_js('hj.livesearch.autocomplete', $js, 'footer');

}
/**
 * Get plugin tree shortcut urls
 *
 * @param string  $plugin     Plugin name string
 * @return array
 */
function hj_path_shortcuts($plugin) {
    $path = elgg_get_plugins_path();
    $plugin_path = $path . $plugin . '/';

    return $structure = array(
        "actions" => "{$plugin_path}actions/",
        "classes" => "{$plugin_path}classes/",
        "graphics" => "{$plugin_path}graphics/",
        "languages" => "{$plugin_path}languages/",
        "lib" => "{$plugin_path}lib/",
        "pages" => "{$plugin_path}pages/",
        "vendors" => "{$plugin_path}vendors/"
    );
}

