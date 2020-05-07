<?php

namespace MyApp\Exception;

// 標準のExceptionを継承する
class EmptyPost extends \Exception {

  protected $message = 'Please Enter email/password!!';
}
