<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
$app = new MyApp\Controller\Index();
$app->run();

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/header.php');
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
  <?php require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/folders.php');?>

  <div id="container" class="container">
  <?php if(isset($_GET['status'])) { ?>
    <h2 class="mb-3">完了済タスク一覧</h2>
  <?php } else if(isset($_GET['folder_id'])) { ?>
    <h2 class="mb-3"><?php echo $get_folder[0]['title'];?>のタスク一覧</h2>
  <?php } else { ?>
    <h2 class="mb-3">全てのタスク一覧</h2>
  <?php }?>
    <div class="todo-list">

      <div id="todos" class="todos">
        <table class="todo__list">
          <thead>
            <tr>
              <th class="todo__list--title">タイトル</th>
              <th class="todo__list--time">期限</th>
              <?php if(isset($_GET['status'])) { ?>
              <th class="todo__list--update">作業時間</th>
              <?php } else{ ?>
              <th class="todo__list--update">状態</th>
              <?php } ?>
              <th></th>
            </tr>
          </thead>
          <tbody>

          <?php require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/tasks.php');?>

          </tbody>
        </table>
      </div>
    </div><!--todo-list-->
  </div><!--container-->
</main>
<input type="hidden" name="token" id="token" value="<?php echo h($_SESSION['token']);?>">
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/footer.php');?>
