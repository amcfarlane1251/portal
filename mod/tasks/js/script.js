$(function(){
	var limit = 0;
	$('a.add-worker').click(function(e){
		e.preventDefault();
		if(limit < 1){
			var options = $(this).prev().html();
			var html = "<select name='assigned_to_second' class='elgg-input-dropdown'>";
			html += options;
			html += "</select>";
			$(this).prev().after(html);
		}
		limit ++;
	});
});