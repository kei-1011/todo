<?php

namespace MyApp\Exception;

// 標準のExceptionを継承する
class EmptyTodoTitle extends \Exception {

  protected $message = 'Titleを選択してください。';
}
