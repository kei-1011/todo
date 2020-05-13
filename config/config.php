<?php

ini_set('display_errors', 1); //エラー表示

date_default_timezone_set('Asia/Tokyo');

define('DSN', 'mysql:dbname=todo_app;host=localhost;charset=utf8');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');

define('SITE_URL', 'http://'. $_SERVER['HTTP_HOST'].'/');
// DB接続情報
try {
  $dbh = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $e) {
  print('DB接続エラー:' . $e->getMessage());
}


require_once($_SERVER['DOCUMENT_ROOT'].'/../config/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../config/autoload.php');
session_start();
