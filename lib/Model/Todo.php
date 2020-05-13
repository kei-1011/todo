<?php
namespace MyApp\Model;
class Todo extends \MyApp\Model {

  // 「完了」以外の全てのタスクを取得
  public function getAll() {
    $user_id = $this->getUserId();
    $sql = "SELECT * FROM task WHERE status <> 2 AND user_id = '$user_id' ORDER BY due_date ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

  // 「完了」タスクを取得
  public function getDoneTask() {
    $user_id = $this->getUserId();
    $sql = "SELECT * FROM task WHERE status = 2 AND user_id = '$user_id' ORDER BY created ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }


  // idと一致するタスクを取得
  public function getTaskSortId() {
    $id = h($_GET['id']);
    $user_id = $this->getUserId();
    $sql = "SELECT folder_id,title,status,due_date FROM task WHERE id = '$id' AND user_id = '$user_id'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

  // folder_idと一致するフォルダ情報を取得
  public function getSortFolder() {
    $user_id = $this->getUserId();
    if(isset($_GET['folder_id'])) {
      $folder_id = h($_GET['folder_id']);
    } else {
      $folder_id = '';
    }
    $sql = "SELECT * FROM task WHERE status <> 2 AND folder_id = '$folder_id' AND user_id = '$user_id' ORDER BY due_date ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

  //  タスクの追加
  public function create($values) {
    $sql = 'INSERT INTO task(folder_id,user_id,title,due_date) VALUES (?,?,?,?)';
    $stmt = $this->db->prepare($sql);
    $data[] = $values['folder_id'];
    $data[] = $values['user_id'];
    $data[] = $values['title'];
    $data[] = $values['due_date'];
    $stmt->execute($data);

  }

  // タスクの削除
  public function delete($values) {
    $sql = 'DELETE FROM task WHERE id=? AND user_id=?';
    $data[] = $values['id'];
    $data[] = $values['user_id'];
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }

  //  タスクの更新
  public function update($values) {

    $data[] = $values['folder_id'];
    $data[] = $values['title'];
    $data[] = $values['status'];
    $data[] = $values['due_date'];
    $data[] = $values['id'];
    $data[] = $values['user_id'];

    if($values['status'] === '1') {
      $sql = 'UPDATE task SET folder_id=?,title=?,status=?,due_date=?,proceed_date=NOW() WHERE id=? AND user_id=?';
    } else {
      $sql = 'UPDATE task SET folder_id=?,title=?,status=?,due_date=? WHERE id=? AND user_id=?';
    }
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }

  // ajaxでDB更新
  public function done($values) {
    $id = $values['id'];
    $user_id = $values['user_id'];

    $sql = 'UPDATE task SET status=? WHERE id=? AND user_id=?';
    $data[] = $values['status'];
    $data[] = $id;
    $data[] = $user_id;
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);

    //ajaxに値を返すためにSELECT
    $sql = ("SELECT * FROM task WHERE id = '$id' AND user_id = '$user_id'");
    $stmt = $this->db->query($sql);
    $res = $stmt->fetchColumn();

    return $res;
  }
}
