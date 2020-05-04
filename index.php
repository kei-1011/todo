
<?php
require_once('header.php');

// 登録したタスクをリスト表示させる
$dbh->query('SET NAMES utf8');
$sql = 'SELECT * FROM task ORDER BY due_date ASC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$tasks = $stmt->fetchAll();
// $dbh = null;

$sql_folder = 'SELECT * FROM folder ORDER BY created_at ASC';
$statement = $dbh->prepare($sql_folder);
$statement->execute();
$folders = $statement->fetchAll();

$dbh = null;




// 今日の日付
$date = date("Y-m-d");
e($date);

// created の日付
$str_created = strtotime($tasks[0]['created']);
echo(date('Y-m-d',$str_created));

// 期限の日付
$str_due = strtotime($tasks[0]['due_date']);
echo(date('Y-m-d',$str_due));

?>

<main class="top">
<div id="container" class="container">
  <div class="todo-list">
  <div class="folder">
    <a href="add_folder.php" class="btn-add">フォルダ追加</a>
    <ul class="folder-list">
    <?php foreach($folders as $folder){?>
      <li class="folder-item"><?php echo $folder['title'];?></li>
    <?php }?>
    </ul>
  </div>

    <div id="todos" class="todos">
      <div class="form-group">
        <a href="add_todo.php" class="btn-add">タスク追加</a>
      </div>
      <table class="todo__list">
        <thead>
          <tr>
            <th class="todo__list--title">タイトル</th>
            <th class="todo__list--time">期限</th>
            <th class="todo__list--update">状態</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($tasks as $task) {
        if($task['status'] === '0') {
          $status = '未着手';
        } else if ($task['status'] === '1') {
          $status = '着手';
        } else if($task['status'] === '2') {
          $status = '完了';
        } else if ($task['status'] === '3') {
          $status = '保留';
        }
        ?>
        <tr>
          <td class="todo__list--title"><?php echo $task['title']; ?></td>
          <td class="todo__list--time"><?php echo $task['due_date']; ?></td>
          <td class="todo__list--delete"><?php echo $status; ?></td>
          <td class="todo__list--update"><a href="update_todo.php?id=<?php echo $task['id'];?>" class="update_todo">編集</a></td>
        </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div><!--todo-list-->
</div><!--container-->
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>
