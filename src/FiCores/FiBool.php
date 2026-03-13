<?php

namespace Engtuncay\Phputils8\FiCores;

class FiBool
{

  public static function isTrue(?bool $boValue)
  {
    if($boValue===null)return false ;
    return $boValue;
  }

  public static function isFalse(?bool $boValue)
  {
    if($boValue===null)return false;
    return !$boValue;
  }
}