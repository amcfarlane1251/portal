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

elgg.provide('elgg.modules.ajaxmodule');

elgg.modules.ajaxmodule.getURL = 'ajaxmodule/load'

elgg.modules.activity_interval = null;

elgg.modules.pagination_state_loaded = false;

elgg.modules.river_filter_state_loaded = false;

/**
 * System init
 */
elgg.modules.ajaxmodule.init = function() {

	// Init the river type selector change event
	$('#modules-river-type-selector').change(elgg.modules.river_selector_type_change);
	
	// Init the river role selector change event
	$('#modules-river-role-selector').change(elgg.modules.river_selector_role_change);
	
	// If we have river modules, init an activity checker
	if ($('.riverajaxmodule-content-container')) {
		elgg.modules.activity_interval = new elgg.modules.activityUpdateChecker(10000);
	}

	$('.ajaxmodule-content-container').each(function() {
		if (elgg.trigger_hook('should_display', 'ajaxmodule', $(this), true)) {
			elgg.modules.ajaxmodule.populateContainer($(this));
		}
	});

	// Make lightboxes
	$(".modules-lightbox").live('mouseover', function(event) {
		$(this).fancybox();
		$(this).die('mouseover');
	});

	// Handle click events for the refresh activity link
	$('#refresh-river-module').live('click', function() {
		$('#modules-river-type-selector').val("type=all");
		$('#modules-river-role-selector').val("type=all");
		
		var container = $('.riverajaxmodule-content-container');
		
		container.find('#relationship').remove();
		container.find('#relationship_guid').remove();
		container.find('#inverse_relationship').remove();
		container.find('#types').remove();
		container.find('#subtypestypes').remove();
		elgg.modules.ajaxmodule.populateContainer('.riverajaxmodule-content-container');
		return false;
	});
}

/** 
 * Populate ajaxmodule container
 */
elgg.modules.ajaxmodule.populateContainer = function(container, offset) {
	// How are we loading this container?
	var loadaction = $(container).find('div.options').find('input#loadaction').val();
	
	// If we're populating a river container, start the timer and clear the activity notifier
	if (loadaction == 'river') {
		elgg.modules.activity_interval.stop();
		elgg.modules.activity_interval.resetSeconds();
		elgg.modules.activity_interval.start();
		$('#activity-updates').html('').hide();
		
		// Check if we've got the pagination offset set as a cookie
		if (!elgg.modules.filter_state_loaded) {
			// Get cookie data
			type = elgg.session.cookie('river-type');
			subtype = elgg.session.cookie('river-subtype');
			role = elgg.session.cookie('river-role');
			
			// String to set type selector (default all)
			var type_val = 'type=all';
			
			// If we have a type (always do)
			if (type) {
				type_val = 'type=' + type;
				elgg.modules.addOption(container, 'types', type);
			}
			
			// If we have a subtype (may not)
			if (subtype) {
				type_val += '&subtype=' + subtype;
				elgg.modules.addOption(container, 'subtypes', subtype);
			} 
		
			// Set value of dropdown to cookie value
			$('#modules-river-type-selector').val(type_val);

			// If we have a role
			if (role) {
				elgg.modules.addOption(container, 'relationship', 'member_of_role');
				elgg.modules.addOption(container, 'relationship_guid', role);
				elgg.modules.addOption(container, 'inverse_relationship', true);
			} else {
				role = 0;
			}

			// Set value
			$('#modules-river-role-selector').val(role);
			
			elgg.modules.filter_state_loaded = true;
		}

		// Check if we've got the pagination offset set as a cookie
		if (!elgg.modules.pagination_state_loaded) {
			offset = elgg.session.cookie('pagination-offset');
			elgg.modules.pagination_state_loaded = true;
		}
	}

	// Populate data
	var data = {};
	$(container).find('div.options').find('input').each(function() {
		data[$(this).attr('id')] = $(this).val();
	});	

		
	// If supplied with an offset, use it
	if (offset) {
		data['offset'] = offset;
	}

	
	if (data['hide_empty']) {
		data['count'] = 1;
		// Load
		elgg.get(elgg.modules.ajaxmodule.getURL + data['loadaction'], {
			data: data,
			success: function(data) {
				if (data >= 1) {
					container.closest('div.hidden').show();
					elgg.modules.removeOption(container, 'hide_empty');
					elgg.modules.ajaxmodule.populateContainer(container, offset);
					return false;
				}
			},
		});
		data['count'] = 0;
	} else {
		// Load
		elgg.get(elgg.modules.ajaxmodule.getURL + data['loadaction'], {
			data: data, 
			success: function(data) {
				var content_container = $(container).find('div.content')
				content_container.html(data).css({'height': 'auto'});;

				// Transform pagination links
				$(container).find('ul.elgg-pagination').each(function() {
					$(this).find('a').each(function() {
						$(this).click(function() {
							var height = content_container.height();	
							content_container.html("<div style='height: 100%' class='elgg-ajax-loader'></div>").css({'height': height});

							// Get offset from the href querystring
							var offset = elgg.modules.getQueryVariableFromString($(this).attr('href'), 'offset');

							elgg.modules.ajaxmodule.populateContainer(container, offset);
							
							// Set up cookie options
							var options = Array();
							options.expires = 0.004; // About 5 minutes
	
							// Set a pagination offset cookie
							elgg.session.cookie('pagination-offset', offset, options);

							return false;
						});
					});
				});

				// Trigger a hook once container is populated
				elgg.trigger_hook('populated', 'modules', {container: container});
			},
		})
	}
}

/**
 * Updates the riverajaxmodule when a type is selected
 */
elgg.modules.river_selector_type_change = function() {
	var type = elgg.modules.getQueryVariableFromString($(this).val(), 'type');
	var subtype = elgg.modules.getQueryVariableFromString($(this).val(), 'subtype');
	var container = $('.riverajaxmodule-content-container');
	
	var content_container = $(container).find('div.content');
	var height = content_container.height();	
	content_container.html("<div style='height: 100%' class='elgg-ajax-loader'></div>").css({'height': height});

	// Set cookie options
	var options = Array();
	options.expires = 0.004; // About 5 minutes
	
	// If we've got a type, add it (exclude 'all')
	if (type && type != 'all') {
		elgg.modules.addOption(container, 'types', type);

		// Set a type cookie
		elgg.session.cookie('river-type', type, options);
	} else {
		container.find('#types').remove();
		
		// Unset cookie
		elgg.session.cookie('river-type', '');
	}
	
	// If we have a subtype, add it
	if (subtype) {
		elgg.modules.addOption(container, 'subtypes', subtype);

		// Set subtype cookie
		elgg.session.cookie('river-subtype', subtype, options);
	} else {
		container.find('#subtypes').remove();

		// Unset cookie
		elgg.session.cookie('river-subtype', '');
	}
	
	// Clear pagination cookie
	elgg.session.cookie('pagination-offset', '');
	
	elgg.modules.ajaxmodule.populateContainer(container);
}

/**
 * Updates the riverajaxmodule when a role is selected
 */
elgg.modules.river_selector_role_change = function() {
	var guid = $(this).val();
	var container = $('.riverajaxmodule-content-container');
	
	var content_container = $(container).find('div.content');
	var height = content_container.height();	
	content_container.html("<div style='height: 100%' class='elgg-ajax-loader'></div>").css({'height': height});
	
	// Set cookie options
	var options = Array();
	options.expires = 0.004; // About 5 minutes
	
	if (guid != '0') {
		// Add relationship options
		elgg.modules.addOption(container, 'relationship', 'member_of_role');
		elgg.modules.addOption(container, 'relationship_guid', $(this).val());
		elgg.modules.addOption(container, 'inverse_relationship', true);
		
		// Unset cookie
		elgg.session.cookie('river-role', guid, options);
	} else {
		// Remove relationship options
		container.find('#relationship').remove();
		container.find('#relationship_guid').remove();
		container.find('#inverse_relationship').remove();
		
		// Unset cookie
		elgg.session.cookie('river-role', 0);
	}
	// Clear pagination cookie
	elgg.session.cookie('pagination-offset', '');

	elgg.modules.ajaxmodule.populateContainer(container);
}

/**	
 * Helper function to grab a variable from a query string
 */
elgg.modules.getQueryVariableFromString = function(string, variable) { 
  var query = string; 
  var vars = query.split("&"); 
  for (var i=0;i<vars.length;i++) { 
    var pair = vars[i].split("="); 
    if (pair[0] == variable) { 
      return pair[1]; 
    } 
  } 
}

/**
 * Helper function to add an option to given ajaxmodule container
 */
elgg.modules.addOption = function(container, name, value) {
	var $options = container.find("div.options");

	$options.find('input').each(function() {
		if ($(this).attr('id') == name) {
			// Remove if already exists
			$(this).remove();
		}
	});
	
	$options.append("<input id='" + name + "' name='" + name + "' type='hidden' disabled='disabled' value='" + value + "' />");
}

/**
 * Helper function to remove an option from the given container
 */
elgg.modules.removeOption = function(container, name) {
	container.find("div.options").find('input').each(function() {
		if ($(this).attr('name') == name) {
			$(this).remove();
		}
	});
}

elgg.modules.activityUpdateChecker = function(interval) {
	this.intervalID = null;
	this.interval = interval;
	this.url = elgg.modules.ajaxmodule.getURL + '_activity_ping';
	this.seconds_passed = 0;
	
	this.start = function() {
		// needed to complete closure scope.
		var self = this;

		this.intervalID = setInterval(function() { self.checkUpdates(); }, this.interval);
	}

	this.checkUpdates = function() {
		this.seconds_passed += this.interval / 1000;
		// more closure fun
		var self = this;
		$.ajax({
			'type': 'GET',
			'url': this.url,
			'data': {'seconds_passed': this.seconds_passed},
			'success': function(data) {
				if (data) {
					json_response = eval( "(" + data + ")" );
					$('#activity-updates').html(json_response.link).slideDown();
				}
			}
		})
	}
	
	this.resetSeconds = function() {
		this.seconds_passed = 0;
	}
	

	this.stop = function() {
		clearInterval(this.intervalID);
	}

	this.changeInterval = function(interval) {
		this.stop();
		this.interval = interval;
		this.start();
	}
}

// General function for other plugin hooks
elgg.modules.ajaxmodule.hooks = function(hook, type, params, value) {
	if (elgg.tidypics && elgg.tidypics.lightbox) {
		elgg.tidypics.lightbox.initImages();
	}
	return value;
}

// General function for other plugin hooks
elgg.modules.ajaxmodule.popState = function(hook, type, params, value) {
	if (elgg.tidypics && elgg.tidypics.lightbox && $('.fancybox2-overlay').length && location.href.indexOf('photos/image/') === -1 && location.href.indexOf('photos/album/') === -1) {
		$.fancybox2.close();
	}
	return value;
}

elgg.register_hook_handler('init', 'system', elgg.modules.ajaxmodule.init);
elgg.register_hook_handler('populated', 'modules', elgg.modules.ajaxmodule.hooks);
elgg.register_hook_handler('popState', 'tidypics', elgg.modules.ajaxmodule.popState);