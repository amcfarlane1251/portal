$(function(){
	$('#register_form').validate({
		rules: {
			name: "required",

			email: {
				required: true,
				email: true
			}
		}
	});
});