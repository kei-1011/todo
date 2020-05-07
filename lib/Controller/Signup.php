<?php
/*
個別の処理はControllerフォルダのクラスに記述
signup.phpの処理
*/

namespace MyApp\Controller;

// 共通処理を書いているControllerクラスを継承する
class Signup extends \MyApp\Controller {

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
      $this->_validate(); // プライベートメソッド

    // Exception クラスを継承して例外クラスを作る　→　libフォルダに例外クラスのファイルを作り、処理の内容を書く
    // MuyApp という名前空間の中に、Exceptionというサブ名前空間を作り、その中にInvalidEmailという例外クラスを作る
    } catch(\MyApp\Exception\InvalidUserName $e) {

    } catch(\MyApp\Exception\InvalidEmail $e) {

      // setErrorsメソッドで、emailのきーでエラーメッセージを渡す
      $this->setErrors('email',$e->getMessage());


      //パスワードは英数字限定にする　→　それに合致しないパスワードが来た場合にも例外処理をかける
    } catch(\MyApp\Exception\InvalidPassword $e)  {
      $this->setErrors('password',$e->getMessage());
    }

    $this->setValues('email',$_POST['email']);

    // エラーがあった場合は処理を止める
    if($this->hasError()) {

      return;

    } else {
      // create user

      try{
        $userModel = new \MyApp\Model\User();
        $userModel->create([
          'user_name' => $_POST['user_name'],
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ]);

      // Email が既に存在する場合の例外処理
      } catch(\MyApp\Exception\DuplicateEmail $e) {
        $this->setErrors('email',$e->getMessage());
        return;
      }
      // redirect to login
      header('Location: '.SITE_URL . '/login.php');
      exit();
    }
  }

  private function _validate() {

    // CSRF対策
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "Invalid Token!";
      exit();
    }

    // Email
    if(empty($_POST['user_name'])) {
      throw new \MyApp\Exception\InvalidUserName();
    }

    // Email
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
      // fildter_varのオプションFILTER_VALIDATE_EMAILで検証、
      // うまくいかない場合には例外クラスを返す
      throw new \MyApp\Exception\InvalidEmail();
    }

    // Password
    if(!preg_match('/\A[a-zA-Z0-9]+\z/',$_POST['password'])) {
      // うまくいかない場合には例外クラスを返す
      throw new \MyApp\Exception\InvalidPassword();
    }
  }
}
