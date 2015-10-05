$(document).ready(function() { 

    var fileInput = $('#fileInput');

    $('#portalForm').submit(function() {
        $("#formButton").prop("disabled", true)
        .css("cursor", "default")
        .fadeTo(125,0.4);

        //display the loading spinner if there is a file to upload
        if(fileInput.val()) {
            this.ajaxLoader = elgg.normalize_url("/_graphics/ajax_loader.gif");
            var spinner = "<div class='ajax-spinner'>" + "<img id='file-upload-spinner' src='"+this.ajaxLoader+"' alt='Loading Content...' + />" + "</div>" + 
                "<div id='upload-text'>" + "<p>Uploading File...</p>" + "</div>";
            $(this).append(spinner).fadeIn(100);
        }   
    });
}); 
