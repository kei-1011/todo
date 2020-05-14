<?php

/*
MyApp
index.php の Controller クラス
MyApp\Controller\index.phpにする

クラスファイル
-> lib/Controller/index,php

*/

spl_autoload_register(function($class) {

  $prefix = 'MyApp\\';

  // クラス名がMyAppから始まるならば
  if(strpos($class,$prefix) === 0) {
    $className = substr($class,strlen($prefix));

    $classFilePath = $_SERVER['DOCUMENT_ROOT'] .'/lib/' .str_replace('\\','/',$className) . '.php';

    if(file_exists($classFilePath)) {
      require $classFilePath;
    }
  }
});
