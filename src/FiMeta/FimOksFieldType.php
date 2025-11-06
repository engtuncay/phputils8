<?php
namespace Engtuncay\Phputils8\FiMeta;
// Codegen v2

use Engtuncay\Phputils8\FiDto\FiMeta;
use Engtuncay\Phputils8\FiDto\FmtList;

class FimOksFieldType
{


  public static function varchar(): FiMeta
  {
    $fiMeta = new FiMeta("varchar");

    return $fiMeta;
  }

  public static function string(): FiMeta
  {
    $fiMeta = new FiMeta("string");

    return $fiMeta;
  }

  public static function double(): FiMeta
  {
    $fiMeta = new FiMeta("double");

    return $fiMeta;
  }

  public static function date(): FiMeta
  {
    $fiMeta = new FiMeta("date");

    return $fiMeta;
  }
}
