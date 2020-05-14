<?php
namespace MyApp\Controller;

class Folder extends \MyApp\Controller {

  public function run() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->post();
    }
  }

  public function post(){

    try {
      $this->_validate();
    } catch(\MyApp\Exception\EmptyFolderTitle $e) {
      $this->setErrors('folder',$e->getMessage());
    }

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
    }
  }
}

  public function _update() {
    $todoModel = new \MyApp\Model\Folder();
    $todoModel->update([
      'user_id' => $this->me()->id,
      'folder_id' => h($_GET['folder_id']),
      'title' => h($_POST['title']),
    ]);

    header('Location: '.SITE_URL);
    exit();
  }

  public function _create() {
    $todoModel = new \MyApp\Model\Folder();
    $todoModel->create([
      'user_id' => $this->me()->id,
      'title' => h($_POST['title']),
    ]);

    header('Location: '.SITE_URL.'/post.php?type=folder');
    exit();
  }

  public function _delete() {
    $todoModel = new \MyApp\Model\Folder();
    $todoModel->delete([
      'user_id' => $this->me()->id,
      'folder_id' => h($_GET['folder_id']),
    ]);

    header('Location: '.SITE_URL);
    exit();
  }

  // バリデーション処理
  private function _validate() {
    // CSRF対策
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "Invalid Token!";
      exit();
    }

    // Title
    if(empty($_POST['title'])) {
      throw new \MyApp\Exception\EmptyFolderTitle();
    }

  }
}
