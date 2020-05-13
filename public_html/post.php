
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/header.php');

$todo = new MyApp\Model\Todo();
$folder = new MyApp\Model\Folder();
$folders = $folder->getAll();

?>

<main class="add_todo">
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/folders.php');?>

  <div class="container">
  <?php
  if($_GET['type'] === 'folder') {
    $folder = new MyApp\Controller\Folder();
    $folder->run();
    require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/add_folder.php');

  } else if($_GET['type'] === 'todo') {
    $folder = new MyApp\Model\Folder();
    $folders = $folder->getAll();
    $todo = new MyApp\Controller\Todo();
    $todo->run();
    require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/add_todo.php');
  }
  ?>
  </div><!--container-->
</main>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/footer.php');?>
