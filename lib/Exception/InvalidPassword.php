<?php

namespace MyApp\Exception;

// 標準のExceptionを継承する
class InvalidPassword extends \Exception {

  protected $message = 'Invalid Password!';
}
