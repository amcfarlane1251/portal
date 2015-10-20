$(document).ready(function() {

	//set below fields to be datepickers
	$("input[name='date']").datepicker();
	$('#report-due-date').datepicker();
	$('.milestone-dates').datepicker();

	addMilestones();	
});

/**
* Adds milestone input fields on click of the add milestone link
*/
addMilestones = function() {
	var counter = 1;
	$('#milestone-add-button').click(function(event) {
		event.preventDefault();
		counter++;
		if(counter <= 10) {
			var newRow = jQuery('<tr><td><input type="text" name="milestone_title' +
	        	counter + '"class="milestone-titles"/></td><td><input type="text" name="milestone_date' +
	        	counter + '"class="milestone-dates"/></td></tr>');
		    $('#milestones-table').append(newRow);
		    $('.milestone-dates').datepicker();
		}
	});
}
