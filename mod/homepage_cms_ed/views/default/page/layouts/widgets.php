<?php

//echo 'elgg_get_context(): '.elgg_get_context();

if ((elgg_get_context()=='index')||(elgg_get_context()=='homepage_cms')){
  echo elgg_view('page/layouts/homepage_widgets', $vars);
}
else{
  echo elgg_view('page/layouts/widget_manager_widgets', $vars);
}