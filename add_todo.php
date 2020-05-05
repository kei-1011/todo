
<?php
require_once('header.php');
$sql_folder = 'SELECT * FROM folder ORDER BY created_at ASC';
$statement = $dbh->prepare($sql_folder);
$statement->execute();
$folders = $statement->fetchAll();


if(isset($_POST['title'])) {

  $error = '';
  $folder_id = h($_POST['folder_id']);
  $title = h($_POST['title']);
  $due_date = h($_POST['due_date']);

  $dbh->query('SET NAMES utf-8');
  $sql = 'INSERT INTO task(folder_id,title,due_date) VALUES (?,?,?)';
  $stmt = $dbh->prepare($sql);
  $data[] = $folder_id;
  $data[] = $title;
  $data[] = $due_date;
  $stmt->execute($data);

  $dbh = null;

  header('Location:index.php');
  exit();
}
?>

<main class="add_todo">
<div class="container">
<h2 class="mb-3">タスクを追加する</h2>
  <form action="" method="post">
    <div class="row">
      <label for="title">タイトル</label>
      <input type="text" name="title" id="title" class="input-text">
    </div>
    <div class="row">
      <label for="due_date">期限</label>
      <input type="text" name="due_date" id="datetimepicker" class="input-text" autocomplete="off">
    </div>
    <div class="row">
      <label for="folder_id">フォルダ</label>
      <select name="folder_id" id="folder_id" class="folder_id">
        <option value=""></option>
        <?php foreach($folders as $folder){?>
        <option value="<?php echo $folder['id'];?>"><?php echo $folder['title'];?></option>
        <?php }?>
      </select>
    </div>
    <div class="btn-wrap">
      <button type="submit" class="button btn__add-todo" name="create">追加</button>
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
