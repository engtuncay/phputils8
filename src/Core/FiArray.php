<?php

namespace Engtuncay\Phputils8\Core;

use Engtuncay\Phputils8\Meta\FiCol;

class FiArray
{

  public static function existKeyByFiCol(FiCol $fiCol, array $params):bool
  {
    if($fiCol->ofcTxFieldName==null) return false;
    return array_key_exists($fiCol->ofcTxFieldName, $params);
  }

  public static function arrStrBuild(array $sbFiColMethodBody):string
  {
    return implode('', $sbFiColMethodBody);
  }
}