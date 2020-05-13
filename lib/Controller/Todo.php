<?php

namespace MyApp\Controller;

class Todo extends \MyApp\Controller {

  public function run() {

      if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->post();
      }
  }

  public function post() {

    if(isset($_POST['mode'])) {

      if($_POST['mode'] === 'update') {
        return $this->_update();
      } elseif($_POST['mode'] === 'create') {
        return $this->_create();
      } elseif($_POST['mode'] === 'delete') {
        return $this->_delete();
      } elseif($_POST['mode'] === 'done') {
        return $this->_done();
      } else {
        return;
      }
    }
  }

  // タスクの追加
  public function _create() {
    try{
      $this->_createValidate(); // プライベートメソッド

    } catch(\MyApp\Exception\EmptyTodoTitle $e) {
      $this->setErrors('title',$e->getMessage());

    } catch(\MyApp\Exception\EmptyTodoDueDate $e) {

      $this->setErrors('due_date',$e->getMessage());

    } catch(\MyApp\Exception\EmptyTodoFolder $e)  {
      $this->setErrors('folder',$e->getMessage());
    }

    if($this->hasError()) {

      return;

    } else {

      $todoModel = new \MyApp\Model\Todo();
      $todoModel->create([
        'user_id' => $this->me()->id,
        'folder_id' => h($_POST['folder_id']),
        'title' => h($_POST['title']),
        'due_date' => h($_POST['due_date'])
      ]);
      header('Location: '.SITE_URL.'add_todo.php');
      exit();
    }
  }

  // タスクの削除
  public function _delete() {
    $todoModel = new \MyApp\Model\Todo();
    $todoModel->delete([
      'user_id' => $this->me()->id,
      'id' => h($_GET['id']),
    ]);
    header('Location: '.SITE_URL);
    exit();
  }

  // タスクの更新
  public function _update() {
    try{
      $this->_createValidate(); // プライベートメソッド

    } catch(\MyApp\Exception\EmptyTodoTitle $e) {
      $this->setErrors('title',$e->getMessage());

    } catch(\MyApp\Exception\EmptyTodoDueDate $e) {

      $this->setErrors('due_date',$e->getMessage());

    } catch(\MyApp\Exception\EmptyTodoFolder $e)  {
      $this->setErrors('folder',$e->getMessage());

    } catch(\MyApp\Exception\EmptyTodoStatus $e)  {
      $this->setErrors('status',$e->getMessage());
    }

    if($this->hasError()) {

      return;

    } else {
      $todoModel = new \MyApp\Model\Todo();
      $todoModel->update([
        'user_id' => $this->me()->id,
        'id' => h($_GET['id']),
        'status' => h($_POST['status']),
        'title' => h($_POST['title']),
        'due_date' => h($_POST['due_date']),
        'folder_id' => h($_POST['folder_id']),
      ]);
    }
    header('Location: '.SITE_URL);
    exit();
  }

  // タスクの更新
  public function _done() {
    $todoModel = new \MyApp\Model\Todo();
    $todoModel->done([
      'user_id' => $this->me()->id,
      'id' => h($_POST['id']),
      'status' => '2',
    ]);
  }

  // バリデーション処理 create
  private function _createValidate() {
    // CSRF対策
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "Invalid Token!";
      exit();
    }

    // Title
    if(empty($_POST['title'])) {
      throw new \MyApp\Exception\EmptyTodoTitle();
    }

    // due_date
    if(empty($_POST['due_date'])) {
      throw new \MyApp\Exception\EmptyTodoDueDate();
    }

    // folder_id
    if(empty($_POST['folder_id'])) {
      throw new \MyApp\Exception\EmptyTodoFolder();
    }
  }
}
