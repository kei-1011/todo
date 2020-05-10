<?php
namespace MyApp\Model;

class Todo extends \MyApp\Model {


  // 「完了」以外の全てのタスクを取得
  public function getAll() {
    $sql = "SELECT * FROM task WHERE status <> 2 ORDER BY due_date ASC";
    $stmt = $this->_db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

  // 「完了」タスクを取得
  public function getDoneTask() {
    $sql = "SELECT * FROM task WHERE status = 2 ORDER BY created ASC";
    $stmt = $this->_db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }


  // idと一致するタスクを取得
  public function getTaskSortId() {
    $id = $_GET['id'];
    $sql = "SELECT folder_id,title,status,due_date FROM task WHERE id = '$id'";
    $stmt = $this->_db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

  // folder_idと一致するフォルダ情報を取得
  public function getSortFolder() {
    if(isset($_GET['folder_id'])) {
      $folder_id = $_GET['folder_id'];
    } else {
      $folder_id = '';
    }
    $sql = "SELECT * FROM task WHERE status <> 2 AND folder_id = '$folder_id' ORDER BY due_date ASC";
    $stmt = $this->_db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

  // ! タスクの追加
  public function create($values) {
    $folder_id = $values['folder_id'];
    $title = $values['title'];
    $due_date = $values['due_date'];

    $sql = 'INSERT INTO task(folder_id,title,due_date) VALUES (?,?,?)';
    $stmt = $this->_db->prepare($sql);
    $data[] = $folder_id;
    $data[] = $title;
    $data[] = $due_date;
    $stmt->execute($data);

    header('Location:index.php');
    exit();
  }

  // TODO タスクの削除
  public function delete($values) {
    $id = $values['id'];
    $sql = 'DELETE FROM task WHERE id=?';
    $data[] = $id;
    $stmt = $this->_db->prepare($sql);
    $stmt->execute($data);
  }

  // TODO タスクの更新
  public function update() {
    $id = $_GET['id'];
    $status = h($_POST['status']);
    $title = h($_POST['title']);
    $due_date = h($_POST['due_date']);
    $folder_id = h($_POST['folder_id']);

    if($status === '1') {
      $date = new DateTime();
      $now_date = $date->format('Y-m-d H:i:s');
      $sql = 'UPDATE task SET folder_id=?,title=?,status=?,due_date=?,proceed_date=? WHERE id=?';

      $data[] = $folder_id;
      $data[] = $title;
      $data[] = $status;
      $data[] = $due_date;
      $data[] = $now_date;
      $data[] = $id;
    } else {
      $sql = 'UPDATE task SET folder_id=?,title=?,status=?,due_date=? WHERE id=?';
      $data[] = $folder_id;
      $data[] = $title;
      $data[] = $status;
      $data[] = $due_date;
      $data[] = $id;
    }
    $stmt = $this->_db->prepare($sql);
    $stmt->execute($data);
  }

  // TODO ajaxでDB更新
  public function done() {
    $id = $_POST['id'];
    $status = '2';
    //アップデート
    $sql = 'UPDATE task SET status=? WHERE id=?';
    $data[] = $status;
    $data[] = $id;

    $stmt = $this->_db->prepare($sql);
    $stmt->execute($data);

    //ajaxに値を返すためにSELECT
    $sql = ("SELECT * FROM task WHERE id = '$id'");
    $stmt = $this->_db->query($sql);
    $res = $stmt->fetchColumn();

    return $res;
  }
}
