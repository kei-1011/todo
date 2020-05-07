<?php

namespace MyApp\Exception;

// 標準のExceptionを継承する
class UnmatchEmailOrPassword extends \Exception {

  protected $message = 'Email/Password do not match!';
}
