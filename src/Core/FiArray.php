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

  public static function existKey(string $txKey, array $params):bool
  {
    if($txKey==null) return false;
    return array_key_exists($txKey, $params);
  }

  /**
   * Builds a string by concatenating all elements of the provided array.
   *
   * @param array $sbFiColMethodBody An array containing elements to be concatenated into a single string.
   * @return string The resulting string created by concatenating all elements of the provided array.
   */
  public static function arrStrBuild(array $sbFiColMethodBody):string
  {
    return implode('', $sbFiColMethodBody);
  }
}