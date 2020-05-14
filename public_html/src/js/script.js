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

  function todoCountBar() {
    let allCount  = $('#todo_count').data('count');
    let doneCount = $('#done_count').data('count');
    let progress = ((doneCount / (allCount + doneCount)) * 100) + '%';

    $('.js-done-bar').css('width', progress);
  }
  todoCountBar();
});
