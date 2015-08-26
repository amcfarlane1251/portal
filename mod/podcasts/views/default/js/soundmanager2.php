<?php
/**
 * Elgg Podcasts soundmanager2 JS simplecache view
 *
 * @package Podcasts
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2013
 * @link http://www.thinkglobalschool.com/
 *
 */
$js_path = elgg_get_config('path');

/* Debug script
$js_path = "{$js_path}mod/podcasts/vendors/soundmanager2/soundmanager2.js";
*/
$js_path = "{$js_path}mod/podcasts/vendors/soundmanager2/soundmanager2-nodebug-jsmin.js";

include $js_path;