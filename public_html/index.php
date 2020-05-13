<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/header.php');
$app = new MyApp\Controller\Index();
$app->run();
// 登録したタスクをリスト表示させる

$todo = new MyApp\Model\Todo();
$folder = new MyApp\Model\Folder();
$folders = $folder->getAll();

if(isset($_GET['status'])) {
  $tasks = $todo->getDoneTask();
} else {
  $tasks = $todo->getAll();
}

if(isset($_GET['folder_id'])) {
  $tasks = $todo->getSortFolder();
  $get_folder = $folder->getFolder();
  $folder_id = $_GET['folder_id'];
}

?>
<main class="top">
  <?php require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/folders.php');?>

  <div id="container" class="container">
    <h2 class="mb-3"><?php if(isset($_GET['folder_id'])){ echo $get_folder[0]['title']. 'の';} ?>タスク一覧</h2>
    <div class="todo-list">

      <div id="todos" class="todos">
        <table class="todo__list">
          <thead>
            <tr>
              <th class="todo__list--title">タイトル</th>
              <th class="todo__list--time">期限</th>
              <th class="todo__list--update">状態</th>
              <th></th>
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
<input type="hidden" name="token" id="token" value="<?php echo h($_SESSION['token']);?>">
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/footer.php');?>
