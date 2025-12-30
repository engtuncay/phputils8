<?php
namespace Engtuncay\Phputils8\FiMetas;
// Codegen v2

use Engtuncay\Phputils8\FiDtos\FiMeta;
use Engtuncay\Phputils8\FiDtos\FmtList;

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
