<?php
/*
コントローラ共通の処理
*/

namespace MyApp;

class Controller {

  private $_errors; // エラー情報を格納
  private $_values;


  public function __construct(){

    // CSRF対策
    if(!isset($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));  // 32桁の推測されにくい文字列を作る
    }

    //スタンダードクラス クラス宣言なしで使える特殊なオブジェクト
    // 初期化
    $this->_errors = new \stdClass();
    $this->_values = new \stdClass();
  }

  protected function setValues($key,$value) {
    $this->_values->$key = $value;
  }

  public function getValues() {
    return $this->_values;
  }

  protected function setErrors($key,$error) {
    $this->_errors->$key = $error;
  }

  // インスタンスから呼ぶのでpublic
  public function getErrors($key) {
    // セットされていたら値を返す、されていなければ空文字を返す
    return isset($this->_errors->$key) ? $this->_errors->$key : '';
  }

  protected function hasError() {
    return !empty(get_object_vars($this->_errors));
  }

  // ログイン状態のチェック（継承するので、protectedとする）
  protected function isLoggedIn() {
    /*  ログイン状態の判定
        ログイン時、$_SESSION['me']　というキー情報を保持し、ログイン状態の判定を行う
    */
    // セットされている、かつ空でなかったとき
    return isset($_SESSION['me']) && !empty($_SESSION['me']);
  }

  // ログインしていたら、セッションのmeの値を返す
  public function me() {
    return $this->isLoggedIn() ? $_SESSION['me'] : null;
}
}
