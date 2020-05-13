<?php

//セッションスタート
require_once($_SERVER['DOCUMENT_ROOT'].'/../config/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../config/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/Controller/Todo.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/Controller/Folder.php');

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo List</title>
  <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'];?>/src/css/style.css?<?php echo date("YmdHis"); ?>">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT'];?>/src/lib/jquery.datetimepicker.css">

</head>

<body>
<header class="header">
<div class="inner">
  <a href="index.php" class="header__logo">TodoApp</a>
  <nav class="header__nav">
    <ul class="header__menu">
    <?php if(isset($_SESSION['me']) && !empty($_SESSION['me'])) {
      $app = new MyApp\Controller\Index();
      $app->run();

    ?>
    　<li class="header__item">ユーザー名：<?php echo $app->me()->user_name;?></li>
    　<li class="header__item">
        <details class="task-menu">
          <summary class="task-menu-toggle"></summary>
          <ul>
            <li><a href="add_todo.php">タスク追加</a></li>
            <li><a href="add_folder.php">フォルダ追加</a></li>
          </ul>
        </details>
      </li>
    　<li class="header__item">
        <form action="logout.php" method="post" id="logout">
          <input type="submit" value="ログアウト" name="submit" class="logout-btn">
          <input type="hidden" name="token" value="<?php echo h($_SESSION['token']);?>">
        </form>
      </li>
    <?php } ?>
    </ul>
  </nav>
</div>
</header>
