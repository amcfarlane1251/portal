<?php

?>
<div>
	<label class="normal">User: </label>
	<input type="text" name="user" id="name" class="text-input"/>
</div>
<div id="names">

</div>
<input type="submit" name="submit" class="elgg-button elgg-button-submit" value="Activate"/>

<script>
  $(function() {
    $( "#name" ).autocomplete({
      source: function(request, response) {
        var results = [];
        var term = request.term;
        $.ajax({
          url:'../../usermgmt/users?deactivated=true',
          success:function(data){
            if(term.length > 0) {
              var users = JSON.parse(data);
              for(var index in users) {
                if(users[index]['name'].toLowerCase().indexOf(term.toLowerCase()) == 0) {
                  results.push(users[index]);
                }
              } 
            }
            else{
              results = ["Start typing..."];
            }

            response($.map(results, function(item){
              if(item['guid']) {
                return {
                  label: item['name'],
                  value: item['name'],
                  guid: item['guid']
                }
              }
              else{
                return results;
              }
            }));

          }
        });
      },
      minLength: 1,
      focus: function( event, ui ) {
        //do nothing
        return false;
      },
      select: function( event, ui ) {
        var userString = "<div>";
        userString += "<p>"+ui.item.label+"</p>";
        userString += "<input type='hidden' name='user-guids[]' value='"+ui.item.guid+"'/>";
        userString += "</div>";
        $("#names").append(userString);

        this.value = '';
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.name + "<br>" + item.guid + "</a>" )
        .appendTo( ul );
    };
  });
</script>