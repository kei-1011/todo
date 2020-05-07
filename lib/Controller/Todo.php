<?php
class Todo {


  private $_db;

  public function __construct()
  {

    try {
      $this->_db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);         //config.phpで定義したDB情報
      $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
      echo $e->getMessage();
      exit;
    }
  }


  public function getAll() {
    $sql = "SELECT * FROM task WHERE status <> 2 ORDER BY due_date ASC";
    $stmt = $this->_db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }



  public function getDoneTask() {
    $sql = "SELECT * FROM task WHERE status = 2 ORDER BY created ASC";
    $stmt = $this->_db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }


  public function getTaskSortId() {
    $id = $_GET['id'];
    $sql = "SELECT folder_id,title,status,due_date FROM task WHERE id = '$id'";
    $stmt = $this->_db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

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


  public function post(){

    switch ($_POST['mode']) {
      case 'update':
        return $this->_update();
      case 'create':
        return $this->_create();
      case 'delete':
        return $this->_delete();
    }
  }


  public function _create() {
    $folder_id = h($_POST['folder_id']);
    $title = h($_POST['title']);
    $due_date = h($_POST['due_date']);

    $sql = 'INSERT INTO task(folder_id,title,due_date) VALUES (?,?,?)';
    $stmt = $this->_db->prepare($sql);
    $data[] = $folder_id;
    $data[] = $title;
    $data[] = $due_date;
    $stmt->execute($data);

    header('Location:index.php');
    exit();
  }

  public function _delete() {
    $id = $_GET['id'];

    $sql = 'DELETE FROM task WHERE id=?';
    $data[] = $id;
    $stmt = $this->_db->prepare($sql);
    $stmt->execute($data);

    header('Location:index.php');
    exit();
  }

  public function _update() {
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

    header('Location:index.php');
    exit();
  }
}
