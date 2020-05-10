<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../config/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/Controller/Todo.php');

// ! TODO ajax 処理
$todoApp = new Todo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $res = $todoApp->post();
    //JSで扱いやすいようにjson形式にする
    header("Content-type: application/json; charset=UTF-8");
    echo json_encode($res);   // resで返ってきた配列をjsonで出力する
    exit;
  } catch (Exception $e) {    //エラーメッセージの表示
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo $e->getMessage();
    exit;
  }
}
