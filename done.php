<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/component/header.php');

// 登録したタスクをリスト表示させる

$todo = new Todo();
$folder = new Folder();
$tasks = $todo->getDoneTask();
$folders = $folder->getAll();
?>

<main class="top">
<div id="container" class="container">
<h2 class="mb-3">完了済のタスク一覧</h2>

  <div class="todo-list">
    <div class="folder">
      <?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/view/folders.php');?>
    </div>

    <div id="todos" class="todos">
      <table class="todo__list">
        <thead>
          <tr>
            <th class="todo__list--title">タイトル</th>
            <th class="todo__list--time">完了日時</th>
            <th class="todo__list--update">作業時間</th>
          </tr>
        </thead>
        <tbody>

        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/view/tasks.php');?>

        </tbody>
      </table>
    </div>
  </div><!--todo-list-->
</div><!--container-->
</main>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/component/footer.php');?>
