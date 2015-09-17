/**
	Disables the button once it has been clicked.	
*/
$(document).ready(function() {
	$("form").submit(function() {
		$("#formInput").prop("disabled", true)
		.css("cursor", "default")
		.fadeTo(125,0.4);
	});
});
