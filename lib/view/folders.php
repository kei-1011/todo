<?php
$todo_cnt = new MyApp\Model\Todo();
$folder_side = new MyApp\Model\Folder();
$folders = $folder_side->getAll();

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
      <li><a href="<?php echo SITE_URL;?>/post.php?type=todo" class="<?php if($post_type === 'todo') { echo 'current'; }?>">+ タスク追加</a></li>
      <li><a href="<?php echo SITE_URL;?>/post.php?type=folder" class="<?php if($post_type === 'folder') { echo 'current'; }?>">+ フォルダ追加</a></li>
    </ul>
    <ul class="folder-list">
      <li class="folder-item"><a href="<?php echo SITE_URL;?>" class="folder-link full <?php if($url === SITE_URL){ echo "current";} ?>">全て</a></li>
      <?php foreach($folders as $fold){?>
      <li class="folder-item">
        <a href="<?php echo SITE_URL;?>/?folder_id=<?php echo $fold['id'];?>" class="folder-link <?php if(isset($folder_id)){ if($folder_id === $fold['id']) { echo 'current'; } }?>">
          <?php echo $fold['title'];?>
        </a>
          <a href="/update.php?folder_id=<?php echo $fold['id'];?>" class="folder-update"><i class="fas fa-edit"></i></a>
        </li>
      <?php }?>

        <li class="folder-item"><a href="<?php echo SITE_URL;?>/?status=2" class="folder-link full-done <?php if(isset($_GET['status'])){ echo "current";}?>">完了済</a></li>
      </ul>
      <input type="hidden" class='js-todo-count' id='todo_count' name="count" value='<?php echo $todo_cnt->allCount();?>'>
      <input type="hidden" class='js-todo-count' id='done_count' name="done_count" value='<?php echo $todo_cnt->doneCount();?>'>
    <div class="graph">
      <span>進捗率</span>
      <div class="bar"><div class="done js-done-bar"><span>Done</span></div></div>
    </div>
    <form action="logout.php" method="post" id="logout">
      <input type="submit" value="ログアウト" name="submit" class="logout-btn">
      <input type="hidden" name="token" value="<?php echo h($_SESSION['token']);?>">
    </form>
  </div>
