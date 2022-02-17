<?php

function logConsole($var): void {
  if(empty($var)) return;

  echo '<script> console.log('.json_encode($var).'); </script>';
}