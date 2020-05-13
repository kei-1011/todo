<?php
$url = 'http://'. $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<ul class="folder-list">
    <li class="folder-item"><a href="<?php echo SITE_URL;?>" class="folder-link full <?php if($url === SITE_URL){ echo "current";}?>">全てのフォルダ</a></li>
    <li class="folder-item"><a href="done.php" class="folder-link full-done <?php if($url === SITE_URL.'done.php'){ echo "current";}?>">完了済のタスク</a></li>
    <?php foreach($folders as $folder){?>
      <li class="folder-item"><a href="index.php?folder_id=<?php echo $folder['id'];?>" class="folder-link <?php if($_GET['folder_id'] == $folder['id']) { echo 'current'; }?>"><?php echo $folder['title'];?></a><a href="update_folder.php?folder_id=<?php echo $folder['id'];?>" class="folder-update">編集</a></li>
    <?php }?>
    </ul>
