<h2 class="mb-3">フォルダを編集する</h2>
  <form action="" method="post">
    <div class="row">
      <label for="title">タイトル</label>
      <input type="text" name="title" id="title" class="input-text" value="<?php echo $folders[0]['title'];?>">
    </div>
    <div class="btn-wrap">
    <a href="<?php echo SITE_URL;?>" class="link">戻る</a>
    <div class="right">
      <button type="submit" class="button delete_todo"  id="delete_btn" name="mode" value="delete">削除</button>
      <button type="submit" class="button btn__update-todo" name="mode" value="update">更新</button>
    </div>
    </div>
    <input type="hidden" name="token" id="token" value="<?php echo h($_SESSION['token']);?>">
  </form>
