<?php

namespace MyApp\Exception;

// 標準のExceptionを継承する
class InvalidUserName extends \Exception {

  protected $message = 'Invalid UserName!';
}
