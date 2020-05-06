<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/component/header.php');
/*  status
0 未着手
1 着手
2 完了
3 保留
*/


$todo = new Todo();
$folder = new Folder();
$folders = $folder->getAll();
$res = $todo->getTaskSortId();
$todo->post();

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
      <label for="due_date">期限</label>
      <input type="text" name="due_date" id="datetimepicker" class="input-text" autocomplete="off" value="<?php echo $res[0]['due_date'];?>">
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
      <label for="folder_id">フォルダ</label>
      <select name="folder_id" id="folder_id" class="folder_id">
        <option value=""></option>
      <?php foreach($folders as $key => $value) { ?>
        <option value="<?php echo $value['id'];?>" <?php if($value['id'] === $res[0]['folder_id']){ echo "selected"; }?>><?php echo $value['title']; ?></option>
      <?php } ?>
      </select>
    </div>

    <div class="btn-wrap">
    <a href="index.php" class="back">戻る</a>
    <div class="right">
      <button type="submit" class="button btn__update-todo" name="mode" value="update">更新</button>
      <button type="submit" class="button delete_todo" name="mode" value="delete">削除</button>
    </div>
    </div>
  </form>
</div><!--container-->
</main>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/component/footer.php');?>
