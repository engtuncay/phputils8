<?php
namespace Engtuncay\Phputils8\FiMeta;

// Codegen v2

use Engtuncay\Phputils8\Meta\FiMeta;
//use Engtuncay\Phputils8\Meta\FmtList;

class FimFiMeta
{


  // public static function genTableCols() : FicList {
  //   $ficList = new FicList();



  //   return $ficList;
  // }

  // public static function genTableColsTrans() : FicList {
  //   $ficList = new FicList();



  //   return $ficList;
  // }

  public static function ofmTxKey(): FiMeta
  {
    $fiMeta = new FiMeta("ofmTxKey");

    return $fiMeta;
  }

  public static function ofmTxValue(): FiMeta
  {
    $fiMeta = new FiMeta("ofmTxValue");

    return $fiMeta;
  }

  public static function ofmTxLabel(): FiMeta
  {
    $fiMeta = new FiMeta("ofmTxLabel");

    return $fiMeta;
  }

  public static function ofmLnKey(): FiMeta
  {
    $fiMeta = new FiMeta("ofmLnKey");

    return $fiMeta;
  }
}
