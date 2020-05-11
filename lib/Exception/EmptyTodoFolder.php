<?php

namespace MyApp\Exception;

// 標準のExceptionを継承する
class EmptyTodoFolder extends \Exception {

  protected $message = 'Folderを選択してください。';
}
