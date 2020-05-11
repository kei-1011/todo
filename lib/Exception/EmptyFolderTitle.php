<?php

namespace MyApp\Exception;

// 標準のExceptionを継承する
class EmptyFolderTitle extends \Exception {

  protected $message = 'フォルダ名を入力してください。';
}
