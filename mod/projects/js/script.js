$(function(){
	var limit = 0;
	var selectBoxHTML = '';

	//check how many opis the project has
	elgg.action('mod/projects/lib/projects.php', {
		data: {
			action: 'getOpis',
			projectId: 9414
		},
		complete: function(output){
			var guids = output.responseText;
			var parseOfStr = guids.split(',');
			limit = parseOfStr.length - 1;
		}
	});


	$('a.add-opi').click(function(e){
		e.preventDefault();
		if(limit < 2){
			if($('.add-opi-container').length){
				var html = "<div class='add-opi-container'>";
				html += $(this).next().html();
				html += "</div>";
				$(this).parent().append(html);
				limit ++;
			}
			else{
				$(this).parent().append(selectBoxHTML);
				limit ++;
			}
		}
	});

	$("form.elgg-form").delegate(".remove-opi", "click", function(e){
		e.preventDefault();
		if(limit == 0){
			selectBoxHTML = $(this).parent('.add-opi-container')[0].outerHTML;
		}
		$(this).parent('.add-opi-container').remove();
		limit -= 1;
	});
});