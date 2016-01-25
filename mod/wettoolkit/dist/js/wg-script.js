$(function(){
	var i = 1;
	$('a.menu').click(function(e){
		// stop browser from refreshing screen
		e.preventDefault();
		var menuNav = $('ul.elgg-menu-site-default');
		// slide menu nav in
		$('ul.elgg-menu-site-default').slideToggle('slow');

		//remove inline styles applied to the site menu when out of mobile view
		$(window).resize(function(){
			var w = $(window).width();

			if(w > 768 && menuNav.is(':hidden')){
				menuNav.removeAttr('style');
			}
		});
	});

	$('form').preventDoubleSubmission();

	$('.elgg-page-body').wetMessages();

});