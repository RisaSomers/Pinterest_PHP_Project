$('img').on('click',function(){
  //using id
  $('#url_image').val($(this).attr('src'));
   //using class
  $('.url_img').val($(this).attr('src'));
});
