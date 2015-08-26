<?php

elgg_load_js('foundation.topbar');

echo '<nav class="sticky" data-topbar>';
echo elgg_view_menu('topbar', array('sort_by' => 'priority'));
echo '</nav>';
