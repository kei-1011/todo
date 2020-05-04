<?php

function h($s)
{
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}


function e($s) {
  echo "<pre>";
  var_dump($s);
  echo "</pre>";
}
