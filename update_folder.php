<?php
require_once('header.php');
$id = $_GET['folder_id'];
$dbh->query('SET NAMES utf8');

$sql_folder = "SELECT id,title FROM folder WHERE id = '$id'";
$statement = $dbh->prepare($sql_folder);
$statement->execute();
$response = $statement->fetchAll();

if($_POST['update']) {

  $title = h($_POST['title']);
  $sql = 'UPDATE folder SET title=? WHERE id=?';
  $data[] = $title;
  $data[] = $id;
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $dbh = null;
  header('Location:index.php');
  exit();

} else if($_POST['delete']) {

  $sql = 'DELETE FROM folder WHERE id=?';
  $data[] = $id;
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $dbh = null;

  header('Location:index.php');
  exit();
}

?>

<main class="add_todo">
<div class="container">
<h2 class="mb-3">フォルダを編集する</h2>
  <form action="" method="post">
    <div class="row">
      <label for="title">タイトル</label>
      <input type="text" name="title" id="title" class="input-text" value="<?php echo $response[0]['title'];?>">
    </div>
    <div class="btn-wrap">
      <button type="submit" class="button delete_todo" name="delete" value="delete">削除</button>
      <button type="submit" class="button btn__update-todo" name="update" value="update">更新</button>
    </div>
  </form>
</div><!--container-->
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="./lib/jquery.js"></script>
<script src="./lib/build/jquery.datetimepicker.full.min.js"></script>
<script>
$(function() {
  $('#datetimepicker').datetimepicker();
});
</script>
</body>
</html>
