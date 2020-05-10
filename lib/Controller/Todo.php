<?php

namespace MyApp\Controller;

class Todo extends \MyApp\Controller {

  public function run() {

      if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->post();
      }
  }

  public function post() {

    //validate
    // try {
    //   $this->_validate(); // プライベートメソッド

    // } catch(\MyApp\Exception\InvalidUserName $e) {

    // } catch(\MyApp\Exception\InvalidEmail $e) {

    //   $this->setErrors('email',$e->getMessage());


    // } catch(\MyApp\Exception\InvalidPassword $e)  {
    //   $this->setErrors('password',$e->getMessage());
    // }

    // エラーがあった場合は処理を止める
    if($this->hasError()) {

      return;

    } else {

      switch ($_POST['mode']) {
        case 'update':
          return $this->_update();
        case 'create':
          return $this->_create();
        case 'delete':
          return $this->_delete();
        case 'done':
          return $this->_done();
      }
    }
  }
  // タスクの追加
  public function _create() {
    try{
    $todoModel = new \MyApp\Model\Todo();
    $todoModel->create([
      'folder_id' => h($_POST['folder_id']),
      'title' => h($_POST['title']),
      'due_date' => h($_POST['due_date'])
    ]);
    } catch(\MyApp\Exception\EmptyFolder $e) {
      $this->setErrors('folder',$e->getMessage());
      return;
    }
    header('Location: '.SITE_URL);
    exit();
  }

  // タスクの削除
  public function _delete() {
    $todoModel = new \MyApp\Model\Todo();
    $todoModel->delete([
      'id' => h($_GET['id']),
    ]);
    header('Location: '.SITE_URL);
    exit();
  }

  // タスクの更新
  public function _update() {
    $todoModel = new \MyApp\Model\Todo();
    $status = h($_POST['status']);

    if($status === '1') {
      $todoModel->delete([
        'id' => h($_GET['id']),
        'status' => h($_POST['status']),
        'title' => h($_POST['title']),
        'due_date' => h($_POST['due_date']),
        'folder_id' => h($_POST['folder_id']),
      ]);
    }
  }


  // タスクの更新
  public function _done() {
    $todoModel = new \MyApp\Model\Todo();
    $todoModel->done([
      'id' => h($_POST['id']),
      'status' => '2',
    ]);
  }


  // バリデーション処理
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
