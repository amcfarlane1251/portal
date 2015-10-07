$(document).ready(function() { 

    var fileInput = $('#fileInput');

    $('#portalForm').submit(function(event) {
        $("#formButton").prop("disabled", true)
        .css("cursor", "default")
        .fadeTo(125,0.4);

        //only display progress bar if file to upload
        if(fileInput.val()) {
            //check for XMLHttpRequest support
            if(XMLHttpRequest) {
                var form = document.getElementById("portalForm");
                var fd = new FormData(form);

                fd.append('SelectedFile', document.getElementById('fileInput').files[0]);
                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener("progress", uploadProgress, false);

                xhr.open("POST", event);
                xhr.send(fd);
            } 
            else {
                this.ajaxLoader = elgg.normalize_url("/_graphics/ajax_loader.gif");
                var spinner = "<div class='ajax-spinner'>" + "<img id='file-upload-spinner' src='"+this.ajaxLoader+"' alt='Loading Content...' + />" + "</div>" + 
                    "<div id='upload-text'>" + "<p>Uploading File...</p>" + "</div>";
                $(this).append(spinner).fadeIn(100);
            }
        }
    });
}); 

//creates the progress bar
function uploadProgress(evt) {
    var percentComplete = Math.floor((evt.loaded / evt.total) * 100);
    $('#progressLabel').show("fast");
    $('#progressLabel').text(percentComplete + "%");
    $('#progressBar').show("fast");
    $('#progressBar').attr('value', percentComplete);
}

function ieVersion() {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf ( "MSIE " );

    if ( msie > 0 ) { 
        return parseInt (ua.substring (msie+5, ua.indexOf (".", msie )));
    }
    else {      
        return 0;
    }
}

