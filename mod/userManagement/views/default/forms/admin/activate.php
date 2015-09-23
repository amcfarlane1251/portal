<?php

?>
<div>
	<label class="normal">Add User: </label>
	<input type="text" name="user" id="name" class="text-input"/>
</div>
<input type="submit" name="submit" class="elgg-button elgg-button-submit" value="Activate"/>

<script>
  $(function() {
    var projects = $.ajax({
    				   url:'usermgmt/users?deactivated=true'
    			   });
 
    $( "#name" ).autocomplete({
      minLength: 0,
      source: projects,
      focus: function( event, ui ) {
        $( "#name" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $( "#name" ).val( ui.item.label );
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.label + "<br>" + item.desc + "</a>" )
        .appendTo( ul );
    };
  });
  </script>