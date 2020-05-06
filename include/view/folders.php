<?php
$url = $_SERVER['REQUEST_URI'];
$folder_id = $_GET['folder_id'];

?>
<ul class="folder-list">
    <li class="folder-item"><a href="index.php" class="folder-link full <?php if($url === '/index.php'){ echo "current";}?>">全てのフォルダ</a></li>
    <li class="folder-item"><a href="done.php" class="folder-link full-done <?php if($url === '/done.php'){ echo "current";}?>">完了済のタスク</a></li>
    <?php foreach($folders as $folder){?>
      <li class="folder-item"><a href="folder.php?folder_id=<?php echo $folder['id'];?>" class="folder-link <?php if($folder_id == $folder['id']) { echo 'current'; }?>"><?php echo $folder['title'];?></a><a href="update_folder.php?folder_id=<?php echo $folder['id'];?>" class="folder-update">編集</a></li>
    <?php }?>
    </ul>
