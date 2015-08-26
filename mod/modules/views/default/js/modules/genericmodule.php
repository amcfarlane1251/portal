<?php
/**
 * Ajax module JS
 * 
 * @package Modules
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */
?>
//<script>

elgg.provide('elgg.modules.genericmodule');

/**
 * System init
 */
elgg.modules.genericmodule.init = function() {
	$('.genericmodule-container').each(function() {
		elgg.modules.genericmodule.populateContainer($(this));
	});
	
	// Make pagination load in the container
	$(document).delegate('.genericmodule-container .elgg-pagination a','click', function(event) {
		$container = $(this).closest('.genericmodule-container');

		var height = $container.height();

		$container.find('div.content').html("<div style='height: 100%' class='elgg-ajax-loader'></div>").css({
			'height': height,
		}).load($(this).attr('href'), function() {
			$(this).css({'height':'auto'});
			// Trigger a hook that pagination content loaded
			elgg.trigger_hook('pagination_content_loaded', 'modules');
		});

		event.stopPropagation(); // Don't propagate the click event.. this messes with popups, etc
		event.preventDefault();
	});
}

// Tear down genric modules
elgg.modules.genericmodule.destroy = function() {
	// Undelegate pagination clicks
	$(document).undelegate('.genericmodule-container .elgg-pagination a','click');
}

elgg.modules.genericmodule.populateContainer = function(container) {
	var data = "?t=1"

	$(container).find('div.options').find('input').each(function() {
		data += "&" + $(this).attr('id') + "=" + $(this).val() 
	});
	
	var view = container.attr('name');

	$content_box = container.find('div.content');

	$content_box.html("<div class='elgg-ajax-loader'></div>");

	$content_box.load(elgg.get_site_url() + 'ajax/view/' + view + data, function(){
		elgg.trigger_hook('generic_populated', 'modules', {container: container});
	});
}


// General function for other plugin hooks
elgg.modules.genericmodule.hooks = function(hook, type, params, value) {
	if (elgg.tidypics && elgg.tidypics.lightbox) {
		elgg.tidypics.lightbox.initImages();
	}
	return value;
}

elgg.register_hook_handler('init', 'system', elgg.modules.genericmodule.init, 999);
elgg.register_hook_handler('generic_populated', 'modules', elgg.modules.genericmodule.hooks);