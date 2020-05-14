$(function() {
  $("#todos").on("click", ".js_update_todo", function() {
    let id = $(this).parents("td").data("id");
    let rowId = $('#todo_row_' + id);
    let token = $("#token").val();
    let currentUrl = location.href;

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
      rowId.hide("slow");
      window.location = currentUrl;
    }).fail(function (XMLHttpRequest, textStatus, error) {
      alert(error);
    });

  });

});
