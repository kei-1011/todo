<ul class="folder-list">
    <?php $folder_id = $_GET['folder_id'];?>
    <li class="folder-item"><a href="index.php" class="folder-link full <?php if(empty($folder_id)){ echo "current";}?>">全てのフォルダ</a></li>
    <?php foreach($folders as $folder){?>
      <li class="folder-item"><a href="folder.php?folder_id=<?php echo $folder['id'];?>" class="folder-link <?php if($folder_id == $folder['id']) { echo 'current'; }?>"><?php echo $folder['title'];?></a><a href="update_folder.php?folder_id=<?php echo $folder['id'];?>" class="folder-update">編集</a></li>
    <?php }?>
    </ul>
