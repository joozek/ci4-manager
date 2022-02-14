<?php

function reduceStringToLength(string $str, int $len, int $MIN_STR_LENGTH = 5)
{
  if (strlen($str) >= $len && strlen($str) < $MIN_STR_LENGTH) {
    return $str;
  }

  return substr($str, 0, $len - 3) . '...';
}

function show_if_exists($object, $param)
{
  return property_exists($object, $param) ? $object->{$param} : null;
}
