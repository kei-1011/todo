<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/header.php');

$folder = new Folder();
$folders = $folder->getFolder();
$folder->post();

?>

<main class="add_todo">
<div class="container">
<h2 class="mb-3">フォルダを編集する</h2>
  <form action="" method="post">
    <div class="row">
      <label for="title">タイトル</label>
      <input type="text" name="title" id="title" class="input-text" value="<?php echo $folders[0]['title'];?>">
    </div>
    <div class="btn-wrap">
    <a href="index.php" class="back">戻る</a>
    <div class="right">
      <button type="submit" class="button delete_todo"  id="delete_btn" name="mode" value="delete">削除</button>
      <button type="submit" class="button btn__update-todo" name="mode" value="update">更新</button>
    </div>
    </div>
  </form>
</div><!--container-->
</main>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/footer.php');?>
