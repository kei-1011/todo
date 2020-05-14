<?php
// ログイン

require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');


if($_SERVER['REQUEST_METHOD'] === 'POST') {
  // tokenのチェック
  if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
    echo "Invalid Token!";
    exit();
  }

  // セッションを空に
  $_SESSION = [];

  // セッションの管理にcookieを使っているので、cookieも空にする
  if(isset($_COOKIE[session_name()])) {      // cookieの名前はsession_nameで取得

    // setcookieで内容を空にし、有効期限を過去にすれば削除できる
    setcookie(session_name(), '', time() - 86400, '/');
  }

  session_destroy();

  header('Location:'.SITE_URL);
  exit();

}
