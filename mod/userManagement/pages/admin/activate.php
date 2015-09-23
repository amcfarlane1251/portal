<?php

admin_gatekeeper();
elgg_admin_add_plugin_settings_menu();
elgg_set_context('admin');

elgg_unregister_css('elgg');
elgg_load_js('elgg.admin');
elgg_load_js('jquery.jeditable');

$vars = array('page' => $page);
$content = elgg_view_form('admin/activate', array('class' => 'responsive-form'));


$body = elgg_view_layout('admin', array('content' => $content, 'title' => $title));
echo elgg_view_page($title, $body, 'admin');