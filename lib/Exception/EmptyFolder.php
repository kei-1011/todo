<?php

namespace MyApp\Exception;

// 標準のExceptionを継承する
class EmptyFolder extends \Exception {

  protected $message = 'Folderを選択してください。';
}
