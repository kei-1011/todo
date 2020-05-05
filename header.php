<?php

session_start();
//セッションスタート
require_once(__DIR__ . '/include/config.php');
require_once(__DIR__ . '/include/functions.php');
date_default_timezone_set('Asia/Tokyo');

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo List</title>
  <link rel="stylesheet" href="./css/style.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="./lib/jquery.datetimepicker.css">

</head>

<body>
<header class="header">
<div class="inner">
  <a href="index.php" class="header__logo">TodoApp</a>
  <nav class="header__nav">
    <ul class="header__menu">
    　<li class="header__item"><a href="">ログアウト</a></li>
    </ul>
  </nav>
</div>
</header>
