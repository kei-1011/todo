
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/component/header.php');

$folder = new Folder();
$folder->post();
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
      <a href="index.php" class="back">戻る</a>
      <button type="submit" class="button btn__add-folder" name="mode" value="create">追加</button>
    </div>
  </form>
</div><!--container-->
</main>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/component/footer.php');?>
