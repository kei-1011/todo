$(function () {
  $('#delete_btn').on('click', function () {
    return confirm("削除してもよろしいですか？");
  });

  $('#drawer').on('click', function () {
    if ($('body').hasClass('close')) {
      $('body').removeClass('close');
    } else {
      $('body').addClass('close');
    }
  });
});
