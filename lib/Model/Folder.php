<?php
namespace MyApp\Model;

class Folder extends \MyApp\Model {

  // ユーザーの全てのフォルダ取得
  public function getAll() {
    $user_id = $this->getUserId();
    $sql = "SELECT * FROM folder WHERE user_id = '$user_id' ORDER BY id ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

  // 特定のフォルダーを取得
  public function getFolder() {
  $user_id = $this->getUserId();
  $folder_id = h($_GET['folder_id']);

  $sql = "SELECT id,title FROM folder WHERE id = '$folder_id' AND user_id = '$user_id'";
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $res = $stmt->fetchAll();
  return $res;
  }

  // フォルダの更新
  public function update($values) {
    $sql = 'UPDATE folder SET title=? WHERE id=? AND user_id=?';
    $data[] = $values['title'];
    $data[] = $values['folder_id'];
    $data[] = $values['user_id'];
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }

  // フォルダ作成
  public function create($values) {
    $sql = 'INSERT INTO folder(user_id,title) VALUES (?,?)';
    $stmt = $this->db->prepare($sql);
    $data[] = $values['user_id'];
    $data[] = $values['title'];
    $stmt->execute($data);
  }

  // フォルダ削除
  public function delete($values) {
    $sql = 'DELETE FROM folder WHERE id=? AND user_id=?';
    $data[] = $values['folder_id'];
    $data[] = $values['user_id'];
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }
}
