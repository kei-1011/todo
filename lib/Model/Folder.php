<?php
namespace MyApp\Model;

class Folder extends \MyApp\Model {

  public function getAll() {
    $sql = 'SELECT * FROM folder ORDER BY id ASC';
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

  public function getFolder() {
  $folder_id = h($_GET['folder_id']);

  $sql = "SELECT id,title FROM folder WHERE id = '$folder_id'";
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $res = $stmt->fetchAll();
  return $res;
  }

  public function update($values) {
    $sql = 'UPDATE folder SET title=? WHERE id=?';
    $data[] = $values['title'];
    $data[] = $values['folder_id'];
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }

  public function create($values) {
    $sql = 'INSERT INTO folder(title) VALUES (?)';
    $stmt = $this->db->prepare($sql);
    $data[] = $values['title'];
    $stmt->execute($data);
  }

  public function delete($values) {
    $sql = 'DELETE FROM folder WHERE id=?';
    $data[] = $values['folder_id'];
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }
}
