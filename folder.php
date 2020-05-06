
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/component/header.php');

$todo = new Todo();
$folder = new Folder();
$tasks = $todo->getSortFolder();
$folders = $folder->getAll();

?>
<main class="top">
<div id="container" class="container">
  <div class="todo-list">
    <div class="folder">
      <?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/view/folders.php');?>
    </div>

    <div id="todos" class="todos">
      <table class="todo__list">
        <thead>
          <tr>
            <th class="todo__list--title">タイトル</th>
            <th class="todo__list--time">期限</th>
            <th class="todo__list--update">状態</th>
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
