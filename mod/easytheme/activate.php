<?php
elgg_invalidate_simplecache();
elgg_reset_system_cache();

$url = elgg_get_site_url();

forward($url . 'admin/plugin_settings/easytheme');
