
<?php
require_once('header.php');

if(isset($_POST['title'])) {

  $title = h($_POST['title']);

  $dbh->query('SET NAMES utf-8');
  $sql = 'INSERT INTO folder(title) VALUES (?)';
  $stmt = $dbh->prepare($sql);
  $data[] = $title;
  $stmt->execute($data);

  $dbh = null;

  header('Location:index.php');
  exit();
}
?>

<main class="add_todo">
<div class="container">
<h2 class="mb-3">フォルダを追加する</h2>
  <form action="" method="post">
    <div class="row">
      <label for="title">フォルダ</label>
      <input type="text" name="title" id="title" class="input-text">
    </div>
    <div class="btn-wrap">
      <button type="submit" class="button btn__add-folder" name="create">追加</button>
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
