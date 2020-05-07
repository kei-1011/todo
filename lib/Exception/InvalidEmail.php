<?php

namespace MyApp\Exception;

// 標準のExceptionを継承する
class InvalidEmail extends \Exception {

  protected $message = 'Invalid Email!';
}
