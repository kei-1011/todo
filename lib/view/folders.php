<?php
$url = 'http://'. $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if(isset($_GET['type'])) {
  if($_GET['type'] === 'todo') {
    $post_type = 'todo';
  } else {
    $post_type = 'folder';
  }
}
?>

<div class="folder">
    <button type="button" id="drawer"><i class="far fa-arrow-alt-circle-left"></i></button>
    <a href="<?php echo SITE_URL;?>" class="logo">TodoApp</a>
    <ul class="add_menu">
      <li><a href="<?php echo SITE_URL;?>post.php?type=todo" class="<?php if($post_type === 'todo') { echo 'current'; }?>">+ タスク追加</a></li>
      <li><a href="<?php echo SITE_URL;?>post.php?type=folder" class="<?php if($post_type === 'folder') { echo 'current'; }?>">+ フォルダ追加</a></li>
    </ul>
    <ul class="folder-list">
      <li class="folder-item"><a href="<?php echo SITE_URL;?>" class="folder-link full <?php if($url === SITE_URL){ echo "current";} ?>" id="todo_count" data-count="<?php echo $todo->allCount();?>">全てのフォルダ<?php echo '('.$todo->allCount().')';?></a></li>
      <?php foreach($folders as $folder){?>
      <li class="folder-item">
        <a href="<?php echo SITE_URL;?>?folder_id=<?php echo $folder['id'];?>" class="folder-link <?php if(isset($folder_id)){ if($folder_id === $folder['id']) { echo 'current'; } }?>">
          <?php echo $folder['title'];?><?php echo '('.$todo->folderCount($folder['id']).')' ; ?>
        </a>
          <a href="update.php?folder_id=<?php echo $folder['id'];?>" class="folder-update"><i class="fas fa-edit"></i></a>
        </li>
      <?php }?>

        <li class="folder-item"><a href="<?php echo SITE_URL;?>?status=2" class="folder-link full-done <?php if(isset($_GET['status'])){ echo "current";}?>" id="done_count" data-count="<?php echo $todo->doneCount();?>">完了済のタスク<?php echo '('.$todo->doneCount().')';?></a></li>
      </ul>

    <div class="graph">
      <span>進捗率</span>
      <div class="bar"><div class="done js-done-bar">Done</div></div>
    </div>
    <form action="logout.php" method="post" id="logout">
      <input type="submit" value="ログアウト" name="submit" class="logout-btn">
      <input type="hidden" name="token" value="<?php echo h($_SESSION['token']);?>">
    </form>
  </div>
