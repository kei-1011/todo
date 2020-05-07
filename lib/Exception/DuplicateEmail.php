<?php

namespace MyApp\Exception;

// 標準のExceptionを継承する
class DuplicateEmail extends \Exception {

  protected $message = 'Duplicate Email!';
}
