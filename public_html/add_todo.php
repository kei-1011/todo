
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/header.php');

$todo = new Todo();
$folder = new Folder();
$folders = $folder->getAll();
$todo->post();
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
      <a href="index.php" class="back">戻る</a>
      <button type="submit" class="button btn__add-todo" name="mode" value="create">追加</button>
    </div>
  </form>
</div><!--container-->
</main>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/footer.php');?>
