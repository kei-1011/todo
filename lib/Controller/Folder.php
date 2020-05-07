<?php
class Folder {

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
    $sql = 'SELECT * FROM folder ORDER BY id ASC';
    $stmt = $this->_db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

  public function getFolder() {
  $folder_id = $_GET['folder_id'];

  $sql = "SELECT id,title FROM folder WHERE id = '$folder_id'";
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

  public function _update() {
    $folder_id = $_GET['folder_id'];

    $title = h($_POST['title']);
    $sql = 'UPDATE folder SET title=? WHERE id=?';
    $data[] = $title;
    $data[] = $folder_id;
    $stmt = $this->_db->prepare($sql);
    $stmt->execute($data);

    header('Location:index.php');
    exit();
  }

  public function _create() {

    $title = h($_POST['title']);

    $sql = 'INSERT INTO folder(title) VALUES (?)';
    $stmt = $this->_db->prepare($sql);
    $data[] = $title;
    $stmt->execute($data);

    // $dbh = null;

    header('Location:index.php');
    exit();
  }

  public function _delete() {
    $folder_id = $_GET['folder_id'];

    $sql = 'DELETE FROM folder WHERE id=?';
    $data[] = $folder_id;
    $stmt = $this->_db->prepare($sql);
    $stmt->execute($data);
    $dbh = null;

    header('Location:index.php');
    exit();
  }
}
