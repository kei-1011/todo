
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/header.php');

$todo = new Todo();
$folder = new Folder();
$tasks = $todo->getSortFolder();
$folders = $folder->getAll();
$get_folder = $folder->getFolder();

?>
<main class="top">
<div id="container" class="container">
<h2 class="mb-3"><?php echo $get_folder[0]['title'];?>のタスク一覧</h2>
  <div class="todo-list">
    <div class="folder">
      <?php require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/folders.php');?>
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

        <?php require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/tasks.php');?>

        </tbody>
      </table>
    </div>
  </div><!--todo-list-->
</div><!--container-->
</main>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/footer.php');?>
