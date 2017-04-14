$(document).ready(function(){
   $("#btnSubmit").on("click", function(e){
       //console.log("clicked");

       // tekst vak uitlezen
       var update = $("#activitymessage").val();

       // via AJAX update naar databank sturen
       $.ajax({
           method: "POST",
           url: "AJAX/save_comments.php",
           data: { update: update } //update: is de naam en update is de waarde (value)
       })

           .done(function( response ) {

               // code + message
               if( response.code == 200 ){

                   // iets plaatsen?
                    var li = $("<li style='display: none;'>");
                    li.html("<h2>GoodBytes.be</h2>" + response.message);

                   // waar?
                   $("#listupdates").prepend( li );
                   $("#listupdates li").first().slideDown();
                   $("#activitymessage").val("").focus();
               }
           });

       e.preventDefault();
   });
});