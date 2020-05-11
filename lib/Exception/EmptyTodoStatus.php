<?php

namespace MyApp\Exception;

// 標準のExceptionを継承する
class EmptyTodoStatus extends \Exception {

  protected $message = '状態を選択してください。';
}
