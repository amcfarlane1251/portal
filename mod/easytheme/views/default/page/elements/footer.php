<?php
/**
 * Elgg footer
 * The standard HTML footer that displays across the site
 *
 * @package Elgg
 * @subpackage Core
 * <p style=\'margin-right:22px;\'>
 */

echo elgg_view_menu('footer', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));

$powered_url = elgg_get_site_url() . "_graphics/powered_by_elgg_badge_drk_bckgnd.gif";

echo '<div class="mts clearfloat float-alt">';
echo '<img src="../../../images/sig-eng.png" class="image-actual" alt="Government of Canada / Gouvernement du Canada"/>&nbsp; &nbsp; &nbsp; ';
echo '</div>';
echo '<div align="left">&nbsp; &nbsp; &nbsp; Date modified: 31-05-13</div>';






