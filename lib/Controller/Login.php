<?php
/*
個別の処理はControllerフォルダのクラスに記述
login.phpの処理
*/

namespace MyApp\Controller;

class Login extends \MyApp\Controller {

  public function run() {
  // login状態を調べる
    if($this->isLoggedIn()) {
      // ログインしていたらホーム画面に飛ばす
      header('Location:'. SITE_URL);
      exit();

    } else {
      //POSTされた場合の処理
      if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->postProcess();
      }
    }
  }

  // 拡張性を考慮してprotectecで作る
  protected function postProcess() {
    /*
    formがpostされたとき、
    データの検証（バリデーション）
    ユーザーの登録
    redirect to login
    */

    //validate
    try {
      $this->_validate();
    } catch(\MyApp\Exception\EmptyPost $e) {
      $this->setErrors('login',$e->getMessage());
    }

    $this->setValues('email',$_POST['email']);

    // エラーがあった場合は処理を止める
    if($this->hasError()) {

      return;

    } else {
      try{
        $userModel = new \MyApp\Model\User();
        $user = $userModel->login([ // login メソッド
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ]);

      // PWとEmailがマッチしない場合の例外処理
      } catch(\MyApp\Exception\UnmatchEmailOrPassword $e) {
        $this->setErrors('login',$e->getMessage());
        return;
      }
      // ログイン処理

      session_regenerate_id(true);    // セッションハイジャック対策　→　// ? TODO調べる

      $_SESSION['me'] = $user;

      // redirect to home
      header('Location: '.SITE_URL);
      exit();
    }
  }

  private function _validate() {

    // CSRF対策
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "Invalid Token!";
      exit();
    }

    if(!isset($_POST['email']) || !isset($_POST['password'])) {
      echo "Invalid Form!";
      exit();
    }

    // EmptyPost の例外呼び出し
    if($_POST['email'] === '' || $_POST['password'] === '') {
      throw new \MyApp\Exception\EmptyPost();
    }
  }
}
