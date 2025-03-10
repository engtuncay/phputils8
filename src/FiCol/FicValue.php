<?php

namespace Engtuncay\Phputils8\FiCol;

class FicValue
{
  public static function toBool(string $value):bool|null
  {
    if(strcasecmp($value,'true')===0) return true;
    if(strcasecmp($value,'false')===0) return false;
    if(strcasecmp($value,'x')===0) return false;
    if(strcasecmp($value,'ok')===0) return true;
    return null;
  }
}