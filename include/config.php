<?php

// ini_set('display_errors', 1); //エラー表示

define('DSN', 'mysql:dbname=todo_app;host=localhost;charset=utf8');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
// DB接続情報
try {
  $dbh = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $e) {
  print('DB接続エラー:' . $e->getMessage());
}
