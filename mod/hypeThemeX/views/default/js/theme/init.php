//<script>

	elgg.provide('elgg.theme');

	elgg.theme.init = function() {
		$.migrateMute = true;
		$(document).foundation();


		// Make More menu item respond to clicks
		$('.elgg-menu-site li.elgg-more')
				.live('mouseover', function() {
			$(this).addClass('elgg-state-active')
		})
				.live('mouseout', function() {
			$(this).removeClass('elgg-state-active')
		})
				.live('click', function() {
			if ($(this).hasClass('elgg-state-active')) {
				$(this).removeClass('elgg-state-active')
			} else {
				$(this).addClass('elgg-state-active')
			}
		});
	}

	elgg.register_hook_handler('init', 'system', elgg.theme.init);
