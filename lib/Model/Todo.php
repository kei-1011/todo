<?php
namespace MyApp\Model;

class Todo extends \MyApp\Model {


  // 「完了」以外の全てのタスクを取得
  public function getAll() {
    $sql = "SELECT * FROM task WHERE status <> 2 ORDER BY due_date ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

  // 「完了」タスクを取得
  public function getDoneTask() {
    $sql = "SELECT * FROM task WHERE status = 2 ORDER BY created ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }


  // idと一致するタスクを取得
  public function getTaskSortId() {
    $id = h($_GET['id']);
    $sql = "SELECT folder_id,title,status,due_date FROM task WHERE id = '$id'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

  // folder_idと一致するフォルダ情報を取得
  public function getSortFolder() {
    if(isset($_GET['folder_id'])) {
      $folder_id = h($_GET['folder_id']);
    } else {
      $folder_id = '';
    }
    $sql = "SELECT * FROM task WHERE status <> 2 AND folder_id = '$folder_id' ORDER BY due_date ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

  //  タスクの追加
  public function create($values) {
    $sql = 'INSERT INTO task(folder_id,title,due_date) VALUES (?,?,?)';
    $stmt = $this->db->prepare($sql);
    $data[] = $values['folder_id'];
    $data[] = $values['title'];
    $data[] = $values['due_date'];
    $stmt->execute($data);

  }

  // タスクの削除
  public function delete($values) {
    $id = $values['id'];
    $sql = 'DELETE FROM task WHERE id=?';
    $data[] = $id;
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

    if($values['status'] === '1') {
      $sql = 'UPDATE task SET folder_id=?,title=?,status=?,due_date=?,proceed_date=NOW() WHERE id=?';
    } else {
      $sql = 'UPDATE task SET folder_id=?,title=?,status=?,due_date=? WHERE id=?';
    }
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }

  // ajaxでDB更新
  public function done($values) {
    $id = $values['id'];

    $sql = 'UPDATE task SET status=? WHERE id=?';
    $data[] = $values['status'];
    $data[] = $id;
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);

    //ajaxに値を返すためにSELECT
    $sql = ("SELECT * FROM task WHERE id = '$id'");
    $stmt = $this->db->query($sql);
    $res = $stmt->fetchColumn();

    return $res;
  }
}
