$("#filter").focus().keyup(function() {
//$("#filter").keyup(function() {
  var filter = $(this).val();
  $("#slats li").each(function () {
    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
      $(this).addClass('hidden');
    } else {
      $(this).removeClass('hidden');
    }
  });
});