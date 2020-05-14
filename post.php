<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
$login = new MyApp\Controller\Index();
$login->run();

if($_GET['type'] === 'folder') {
  $folder = new MyApp\Controller\Folder();
  $folder->run();
} else if($_GET['type'] === 'todo') {
  $folder = new MyApp\Model\Folder();
  $folders = $folder->getAll();
  $todo = new MyApp\Controller\Todo();
  $todo->run();
}

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/header.php');
?>

<main class="add_todo">
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/folders.php');?>

  <div class="container">
  <?php
  if($_GET['type'] === 'folder') {
    require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/add_folder.php');

  } else if($_GET['type'] === 'todo') {
    require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/add_todo.php');
  }
  ?>
  </div><!--container-->
</main>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/footer.php');?>
