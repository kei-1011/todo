<?php

// ini_set('display_errors', 1); //エラー表示

// DB接続情報
try {
  $dbh = new PDO('mysql:dbname=todo_app;host=localhost;charset=utf8', 'root', 'root');
} catch (PDOException $e) {
  print('DB接続エラー:' . $e->getMessage());
}
