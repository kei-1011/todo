<?php foreach($tasks as $task) {
        if($task['status'] === '0') {
          $status = '未着手';
        } else if ($task['status'] === '1') {
          $status = '着手';
        } else if($task['status'] === '2') {
          $status = '完了';
        } else if ($task['status'] === '3') {
          $status = '保留';
        }

        // タスク期限の管理
        $date = new DateTime();
        if(isset($task['proceed_date'])) {
          $proceed = strtotime($task['proceed_date']);   // 着手日
        } else {
          $proceed = strtotime($task['created']);   // 着手日
        }
        $created = strtotime($task['created']);  // 最新の更新日

        // 作業時間を計算
        $work_diff = ceil(($created - $proceed)/60);

        $due_date = $task['due_date'];    //期限
        $now_date = $date->format('Y-m-d H:i:s');   //現在日時

        // 現在時刻とタスクに設定した期限の日時を取得
        $timestamp = strtotime($now_date);
        $timestamp2 = strtotime($due_date);

        // 1時間以内であれば警告を表示
        $period = '';
        if($timestamp2 < $timestamp) {
          $period = 'over';

        } else if ((($timestamp2 - $timestamp)/60) < 60){
          $period = 'one_hour';
        // 期限をオーバーしたら赤字にする
        }
        ?>
        <tr id="todo_row_<?php echo $task['id']; ?>" class="todo_row">
          <td class="todo__list--title" data-id="<?php echo $task['id']; ?>">
          <?php if($task['status'] !== '2'){?>
            <button type="button" class="js_update_todo"><i class="fas fa-check"></i></button>
          <?php } ?>
            <?php echo $task['title']; ?>
          </td>
          <td class="todo__list--time <?php if($task['status'] !== '2'){ echo $period; } ?>">
            <?php if($task['status'] === '2'){ echo $task['created']; }else { echo $due_date; }?></td>
          <td class="todo__list--delete">
          <?php if($task['status'] === '2'){?>
            <?php echo $work_diff?>分
          <?php }else { ?>
            <?php echo $status; ?>
          <?php } ?>
          </td>
          <td class="todo__list--update"><a href="/update.php?id=<?php echo $task['id'];?>" class="update_todo"><i class="fas fa-edit"></a></td>
        </tr>
        <?php } ?>
