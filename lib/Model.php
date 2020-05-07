<?php
// モデルの共通処理

namespace MyApp;

class Model {
  protected $db;

  public function __construct(){
    try {
      $this->db = new \PDO(DSN,DB_USERNAME,DB_PASSWORD);
    } catch (\PDOException $e) {
      echo $e->getMessage();
      exit();
    }
  }
}
