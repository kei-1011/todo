<?php

namespace MyApp\Exception;

// 標準のExceptionを継承する
class EmptyTodoDueDate extends \Exception {

  protected $message = '期限を選択してください。';
}
