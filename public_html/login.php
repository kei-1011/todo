<?php
// ログイン
require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/header.php');

$app = new MyApp\Controller\Login();
$app->run();

?>
  <div class="container login">
    <div class="login_wrapper">
    <h2 class="mb-3">ログイン</h2>
      <form action="" method="post">
      <div class="row">
        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email" value="<?php echo isset($app->getValues()->email) ? h($app->getValues()->email) : '';?>">
      </div>
      <div class="row">
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password" >
        <p class="error"><?php echo h($app->getErrors('login'));?></p>
      </div>
      <input type="submit" value="ログイン" name="submit" class="login-btn">
      <p class="signup"><a class="signup-link" href="/signup.php">サインアップ</a></p>
      <input type="hidden" name="token" value="<?php echo h($_SESSION['token']);?>">
      </form>
    </div>
  </div>
  <?php require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/footer.php');?>
