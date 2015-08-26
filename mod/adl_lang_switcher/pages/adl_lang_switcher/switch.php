<?php
// make sure only logged in users can see this page 
//gatekeeper();
 
// set the title
// for distributed plugins, be sure to use elgg_echo() for internationalization
$title = "Switch Language";

 
// start building the main column of the page
$content = elgg_view_title($title);

$content .= elgg_add_action_token_to_url("action/adl_lang_switcher/switch.php") 
// add the form to this section
$content .= elgg_view_form("adl_lang_switcher/switch");
 
// optionally, add the content for the sidebar
$sidebar = "Hi ya!";
 
// layout the page
$body = elgg_view_layout('one_sidebar', array(
   'content' => $content,
   'sidebar' => $sidebar
));
 
// draw the page
echo elgg_view_page($title, $body);
?>
