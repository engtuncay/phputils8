<?php

namespace Engtuncay\Phputils8\FiCores;

class FiBool
{

  public static function isTrue(?bool $oftBoTransient)
  {
    if($oftBoTransient===null)return false ;
    return $oftBoTransient;
  }

  public static function isFalse(?bool $boValue)
  {
    if($boValue===null)return false;
    return !$boValue;
  }
}