$(function() {
  $("#todos").on("click", ".js_update_todo", function() {
    let id = $(this).parents("td").data("id");
    let rowId = $('#todo_row_' + id);
    let token = $("#token").val();

    console.log(id);
    console.log(rowId);
    console.log(token);

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
      setTimeout(function () {
        rowId.fadeOut();
      }, 500);
    }).fail(function (XMLHttpRequest, textStatus, error) {
      alert(error);
    });

  });

});
