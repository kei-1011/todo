$(function() {
  $("#todos").on("click", ".js_update_todo", function() {
    let id = $(this).parents("td").data("id");
    let rowId = $('#todo_row_' + id);
    let token = $("#token").val();

    $.ajax({
      type: "POST",
      url: "./_ajax.php",
      data: {
        "id": id,
        "mode": "done",
        "token": token
      },
      dataType: "json"
    }).done(function (res) {

      let allCount  = Number($('#todo_count').val());
      let doneCount = Number($('#done_count').val());

      // 行を消す
      rowId.hide("slow");

      // 進行中のタスクから-1 完了済タスクに+1
      $('#todo_count').val(allCount - 1);
      $('#done_count').val(doneCount + 1);

      // 変数再定義、グラフにCSS適応
      allCount  = Number($('#todo_count').val());
      doneCount = Number($('#done_count').val());
      let progress = ((doneCount / (allCount + doneCount)) * 100) + '%';
      $('.js-done-bar').css('width', progress);

    }).fail(function (XMLHttpRequest, textStatus, error) {
      alert(error);
    });

  });

});
