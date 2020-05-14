<?php
// 新規登録
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');

$app = new MyApp\Controller\Signup();
$app->run();

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/header.php');
?>
  <div class="container login">
    <div class="login_wrapper">
      <h2 class="mb-3">新規登録</h2>
      <form action="" method="post">
      <div class="row">
      <label for="user_name">ユーザー名</label>
        <input type="user_name" name="user_name" id="user_name" value="<?php echo isset($app->getValues()->user_name) ? h($app->getValues()->user_name) : '';?>">
        <p class="error"><?php echo h($app->getErrors('user_name'));?></p>
      </div>
      <div class="row">
      <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email" value="<?php echo isset($app->getValues()->email) ? h($app->getValues()->email) : '';?>">
        <p class="error"><?php echo h($app->getErrors('email'));?></p>
      </div>
      <div class="row">
      <label for="password">パスワード</label>
        <input type="password" name="password" id="password">
        <p class="error"><?php echo h($app->getErrors('password'));?></p>
      </div>
      <input type="submit" value="サインアップ" name="submit" class="login-btn signup-btn">
      <p class="login"><a class="login-link" href="/login.php">ログイン画面へ</a></p>
      <input type="hidden" name="token" value="<?php echo h($_SESSION['token']);?>">
      </form>
    </div>
  </div>
  <?php require_once($_SERVER['DOCUMENT_ROOT'].'/lib/view/footer.php');?>
