//Image Selector Webscraper onder Upload.php
$('img').on('click',function(){
  //using id
  $('#url_image').val($(this).attr('src'));
   //using class
  $('.url_img').val($(this).attr('src'));
});
//Search Functie Live Preview
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });

        // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
// Live Preview Resultaten met Post items in om te selecteren naar board
$("#sel1").on("change", function(){
  function clearpost(){
    $("#results").val("");
  }

  var selected = $(this).val();
  makeAjaxRequest(selected);
  function makeAjaxRequest(postID){
    $.ajax({
      type:"POST",
      data:{postID},
      url:"itemOverview.php",
      datatype: "text/json",
      success:function(res){
        $("#results").html("<p>Uw items : " + res + "</p>");
      }
    })
  }

})
