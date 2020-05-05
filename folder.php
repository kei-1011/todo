
<?php
require_once('header.php');

if(isset($_GET['folder_id'])) {
  $folder_id = $_GET['folder_id'];
} else {
  $folder_id = '';
}


// 登録したタスクをリスト表示させる
$dbh->query('SET NAMES utf8');
$sql = "SELECT * FROM task WHERE status <> 2 AND folder_id = '$folder_id' ORDER BY due_date ASC";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$tasks = $stmt->fetchAll();

$sql_folder = 'SELECT * FROM folder ORDER BY id ASC';
$statement = $dbh->prepare($sql_folder);
$statement->execute();
$folders = $statement->fetchAll();

$dbh = null;
?>

<main class="top">
<div id="container" class="container">
  <div class="todo-list">
  <div class="folder">
    <ul class="folder-list">
    <li class="folder-item"><a href="index.php" class="folder-link full <?php if(empty($folder_id)){ echo "current";}?>">全てのフォルダ</a></li>
    <?php foreach($folders as $folder){?>
      <li class="folder-item"><a href="folder.php?folder_id=<?php echo $folder['id'];?>" class="folder-link <?php if($folder_id == $folder['id']) { echo 'current'; }?>"><?php echo $folder['title'];?></a><a href="update_folder.php?folder_id=<?php echo $folder['id'];?>" class="folder-update">編集</a></li>
    <?php }?>
    </ul>
  </div>

    <div id="todos" class="todos">
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

        // タスク期限の管理
        $date = new DateTime();
        $due_date = $task['due_date'];
        $now_date = $date->format('Y-m-d H:i:s');

        // 現在時刻とタスクに設定した期限の日時を取得
        $timestamp = strtotime($now_date);
        $timestamp2 = strtotime($due_date);

        // 1時間以内であれば警告を表示
        $period = '';
        if($timestamp2 < $timestamp) {
          $period = 'over';

        } else if ((($timestamp2 - $timestamp)/60) < 60){
          $period = 'one_hour';
        // 期限をオーバーしたら赤字にする
        }
        ?>
        <tr>
          <td class="todo__list--title"><?php echo $task['title']; ?></td>
          <td class="todo__list--time <?php echo $period; ?>"><?php echo $due_date; ?></td>
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
