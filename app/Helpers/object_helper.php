<?php

function getIfPropertyExists(object $object, string $param)
{
  return property_exists($object, $param) ? $object->{$param} : null;
}
