<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
$update_todo = new MyApp\Controller\Todo();
$todo = new MyApp\Model\Todo();

if(isset($_GET['folder_id'])) {
  $folder = new MyApp\Controller\Folder();
  $folder->run();

} else if(isset($_GET['id'])) {
  $res = $todo->getTaskSortId();
  $update_todo->run();
}


require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/header.php');
?>

<main class="add_todo">
  <?php require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/folders.php');?>
  <div class="container">
<?php
if(isset($_GET['folder_id'])) {
  require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/update_folder.php');

} else if(isset($_GET['id'])) {
  require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/update_todo.php');
}
?>
  </div><!--container-->
</main>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/footer.php');?>
