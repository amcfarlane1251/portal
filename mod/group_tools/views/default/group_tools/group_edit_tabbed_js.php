<?php
/**
 * prefix to make the group edit tabbed
 */

if (!empty($vars["entity"])) {
	?>
	<script type="text/javascript">
		
		$("#group_tools_group_edit_tabbed li").click(function() {
			// remove selected class
			$(this).siblings().removeClass("elgg-state-selected");
			$(this).addClass("elgg-state-selected");
			
			var link = $(this).children("a").attr("href");
	
			if (link == "#other") {
				$("#group_tools_group_edit_tabbed").nextAll("form").hide();
				$("#group_tools_group_edit_tabbed").nextAll("div").show();
			} else {
				$("#group_tools_group_edit_tabbed").nextAll("div").hide();
				$("#group_tools_group_edit_tabbed").nextAll("form").show();
			}

			//Load Joyride Tooltip - Edit Group depending on active tab link
			$('#joyRideTipContent').joyride('destroy');
			//get the current active tab link class
			var active_tab_class = $('#group_tools_group_edit_tabbed li.elgg-state-selected a').attr('class');
			//if Group profile/tools tab is active
			if (active_tab_class == "group-tools-group-edit-profile") {				
				$("#joyRideContainer ol:first").attr("id", "joyRideTipContent");
				$("#joyRideContainer ol:last").attr("id", "joyRideInactive")
			}
			//if Other options tab is active
			else if (active_tab_class == "group-tools-group-edit-other") {
				$("#joyRideContainer ol:last").attr("id", "joyRideTipContent");
				$("#joyRideContainer ol:first").attr("id", "joyRideInactive")
			}

		});
	
		$("#group_tools_group_edit_tabbed li:first").click();
	
	</script>
	<?php
}
