<?php
// ログイン

require_once($_SERVER['DOCUMENT_ROOT'].'/../lib/view/header.php');

$app = new MyApp\Controller\Login();
$app->run();

?>
  <div class="container">
    <form action="" method="post">
    <div class="row">
      <input type="email" name="email" id="email" placeholder="メールアドレス" value="<?php echo isset($app->getValues()->email) ? h($app->getValues()->email) : '';?>">
    </div>
    <div class="row">
      <input type="password" name="password" id="password" placeholder="パスワード">
      <p class="error"><?php echo h($app->getErrors('login'));?></p>
    </div>
    <input type="submit" value="ログイン" name="submit" class="login-btn">
    <p><a class="signup-link" href="/signup.php">サインアップ</a></p>
    <input type="hidden" name="token" value="<?php echo h($_SESSION['token']);?>">
    </form>
  </div>
