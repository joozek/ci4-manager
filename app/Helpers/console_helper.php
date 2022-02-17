<?php

function logConsole($var): void {
  if(empty($var)) return;
  $formatedValue = null;
  if(is_array($var) || is_object($var)) {
    $formatedValue = json_encode($var);
  } else {
    $formatedValue = $var;
  }

  echo '<script> console.log('.$formatedValue.'); </script>';
}