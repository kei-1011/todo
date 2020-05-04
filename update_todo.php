
<?php
require_once('header.php');

$id = $_GET['id'];
$dbh->query('SET NAMES utf8');
$sql = "SELECT title,status,due_date FROM task WHERE id = '$id'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll();
$dbh = null;

/*  status
0 未着手
1 着手
2 完了
3 保留
*/

if($_SERVER ['REQUEST_METHOD'] == 'POST') {


$status = h($_POST['status']);
$title = h($_POST['title']);
$due_date = h($_POST['due_date']);
$dbh = new PDO('mysql:dbname=todo_app;host=localhost;charset=utf8', 'root', 'root');

$sql = 'UPDATE task SET title=?,status=?,due_date=? WHERE id=?';
$stmt = $dbh->prepare($sql);
$data[] = $title;
$data[] = $status;
$data[] = $due_date;
$data[] = $id;
$stmt->execute($data);

$dbh = null;

header('Location:index.php');
exit();
}

?>

<main class="add_todo">
<div class="container">
<h2 class="mb-3">タスクを編集する</h2>
  <form action="" method="post">
    <div class="row">
      <label for="title">タイトル</label>
      <input type="text" name="title" id="title" class="input-text" value="<?php echo $res[0]['title'];?>">
    </div>
    <div class="row">
      <label for="status">状態</label>
      <select name="status" id="status" class="status">
        <option value=""></option>
        <option value="0" <?php if($res[0]['status'] == '0'){ echo "selected";}?>>未着手</option>
        <option value="1" <?php if($res[0]['status'] == '1'){ echo "selected";}?>>着手</option>
        <option value="2" <?php if($res[0]['status'] == '2'){ echo "selected";}?>>完了</option>
        <option value="3" <?php if($res[0]['status'] == '3'){ echo "selected";}?>>保留</option>
      </select>
    </div>
    <div class="row">
      <label for="due_date">期限</label>
      <input type="text" name="due_date" id="datetimepicker" class="input-text" autocomplete="off" value="<?php echo $res[0]['due_date'];?>">
    </div>
    <div class="btn-wrap">
      <button type="submit" class="button btn__update-todo">更新</button>
    </div>
    <input type="hidden" name="update">
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
