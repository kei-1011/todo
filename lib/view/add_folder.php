<h2 class="mb-3">フォルダを追加する</h2>
  <form action="" method="post">
    <div class="row">
      <label for="title">フォルダ</label>
      <input type="text" name="title" id="title" class="input-text">
      <p class="error"><?php echo h($folder->getErrors('folder'));?></p>
    </div>
    <div class="btn-wrap">
      <a href="<?php echo SITE_URL;?>" class="link">戻る</a>
      <button type="submit" class="button btn__add-folder" name="mode" value="create">追加</button>
    </div>
    <input type="hidden" name="token" id="token" value="<?php echo h($_SESSION['token']);?>">
  </form>
