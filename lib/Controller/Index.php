<?php
/*
個別の処理はControllerフォルダのクラスに記述
index.phpの処理
*/

namespace MyApp\Controller;


// 共通処理を書いているControllerクラスを継承する
class Index extends \MyApp\Controller {

  public function run() {

    // login状態を調べる
    if(!$this->isLoggedIn()) {
      // ログインしていなかったら、ログイン画面に飛ばす
      header('Location:'.SITE_URL.'/login.php');
      exit();

    } else {
      //get users info
      $userModel = new \MyApp\Model\User();
      $this->setValues('users',$userModel->findAll());
    }
  }
}
