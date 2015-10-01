$(document).ready(function() { 

    var fileInput = $('#fileInput');

    $('#portalForm').submit(function() {
        $("#formButton").prop("disabled", true)
        .css("cursor", "default")
        .fadeTo(125,0.4);

        //display the loading spinner if there
        //is a file being uploaded
        if(fileInput.val()) {
             this.ajaxLoader = elgg.normalize_url("/_graphics/ajax_loader.gif");
            $(this).append("<div class='ajax-spinner'><img src='"+this.ajaxLoader+"' alt='Loading Content...' style='position: fixed; top: 50%; left: 50%;'/></div>").fadeIn(100);
        }
    });
}); 
