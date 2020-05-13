<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/header.php');

$todo = new MyApp\Controller\Todo();
$get_todo = new MyApp\Model\Todo();
$get_folder = new MyApp\Model\Folder();
$folders = $get_folder->getAll();

?>

<main class="add_todo">
  <div class="container">
<?php
if(isset($_GET['folder_id'])) {
  $folder = new MyApp\Controller\Folder();
  $folder->run();
  require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/update_folder.php');

} else if(isset($_GET['id'])) {
  $res = $get_todo->getTaskSortId();
  $todo->run();
  require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/update_todo.php');
}
?>
  </div><!--container-->
</main>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/footer.php');?>
