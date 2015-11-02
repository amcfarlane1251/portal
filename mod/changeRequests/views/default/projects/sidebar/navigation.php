<?php
/**
 * Navigation menu for a user's or a group's projects
 *
 * @uses $vars['project'] Page object if manually setting selected item
 */

$selected_project = elgg_extract('project', $vars, false);
if ($selected_project) {
	$url = $selected_project->getURL();
}

$title = elgg_echo('projects:navigation');

projects_register_navigation_tree(elgg_get_page_owner_entity());

$content = elgg_view_menu('projects_nav', array('class' => 'projects-nav'));
if (!$content) {
	$content = '<p>' . elgg_echo('projects:none') . '</p>';
}

echo elgg_view_module('aside', $title, $content);

?><?php //@todo JS 1.8: no ?>
<script type="text/javascript">
$(document).ready(function() {
	$(".projects-nav").treeview({
		persist: "location",
		collapsed: true,
		unique: true
	});

<?php
if ($selected_project) {
	// if on a history project, we need to manually select the correct menu item
	// code taken from the jquery.treeview library
?>
	var current = $(".projects-nav a[href='<?php echo $url; ?>']");
	var items = current.addClass("selected").parents("ul, li").add( current.next() ).show();
	var CLASSES = $.treeview.classes;
	items.filter("li")
		.swapClass( CLASSES.collapsable, CLASSES.expandable )
		.swapClass( CLASSES.lastCollapsable, CLASSES.lastExpandable )
			.find(">.hitarea")
				.swapClass( CLASSES.collapsableHitarea, CLASSES.expandableHitarea )
				.swapClass( CLASSES.lastCollapsableHitarea, CLASSES.lastExpandableHitarea );
<?php
}
?>

});

</script>
