$(function () {
  $('#delete_btn').on('click', function () {
    return confirm("削除してもよろしいですか？");
  });

  $('#js-add_todo').on('click', function () {
    $('body').addClass('window-up');
  });
  $('.close-modal').on('click', function () {
    $('body').removeClass('window-up');
  });

  $(document).on('click', function () {
    if($(event.target).hasClass('window-overlay')) {
      $('body').removeClass('window-up');
    }
  });
});
