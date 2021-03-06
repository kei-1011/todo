<h2 class="mb-3">タスクを追加する</h2>
  <form action="" method="post">
    <div class="row">
      <label for="title">タイトル</label>
      <input type="text" name="title" id="title" class="input-text" value="<?php if(isset($_POST['title'])) {echo h($_POST['title']); }?>">
      <p class="error"><?php echo h($todo->getErrors('title'));?></p>
    </div>
    <div class="row">
      <label for="due_date">期限</label>
      <input type="text" name="due_date" id="datetimepicker" class="input-text" autocomplete="off" value="<?php if(isset($_POST['due_date'])) {echo h($_POST['due_date']); }?>">
      <p class="error"><?php echo h($todo->getErrors('due_date'));?></p>
    </div>
    <div class="row">
      <label for="folder_id">フォルダ</label>
      <select name="folder_id" id="folder_id" class="folder_id">
        <?php foreach($folders as $folder){?>
        <option value="<?php echo $folder['id'];?>" <?php if(isset($_POST['folder_id'])){ if($_POST['folder_id'] === $folder['id']){ echo "selected";} } ?>><?php echo $folder['title'];?></option>
        <?php }?>
      </select>
      <p class="error"><?php echo h($todo->getErrors('folder'));?></p>
      <a href="/post.php?type=folder" class="link">フォルダを追加する</a>
    </div>
    <input type="hidden" name="token" id="token" value="<?php echo h($_SESSION['token']);?>">
    <div class="btn-wrap">
      <a href="javascript:history.back();" class="link">戻る</a>
      <button type="submit" class="button btn__add-todo" name="mode" value="create">追加</button>
    </div>
  </form>
