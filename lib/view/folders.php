<?php
$url = 'http://'. $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<ul class="folder-list">
    <li class="folder-item"><a href="<?php echo SITE_URL;?>" class="folder-link full <?php if($url === SITE_URL){ echo "current";}?>">全てのフォルダ<?php echo '('.$todo->allCount().')';?></a></li>
    <?php foreach($folders as $folder){?>
      <li class="folder-item">
        <a href="<?php echo SITE_URL;?>?folder_id=<?php echo $folder['id'];?>" class="folder-link <?php if($_GET['folder_id'] == $folder['id']) { echo 'current'; }?>">
          <?php echo $folder['title'];?><?php echo '('.$todo->folderCount($folder['id']).')' ; ?>
        </a>
          <a href="update.php?folder_id=<?php echo $folder['id'];?>" class="folder-update">編集</a>
        </li>
    <?php }?>
      <li class="folder-item"><a href="<?php echo SITE_URL;?>?status=2" class="folder-link full-done <?php if(isset($_GET['status'])){ echo "current";}?>">完了済のタスク<?php echo '('.$todo->doneCount().')';?></a></li>
    </ul>
