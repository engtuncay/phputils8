<?php
namespace Engtuncay\Phputils8\FiCols;

use Engtuncay\Phputils8\FiDtos\FiKeybean;

abstract class AbsFkbTable
{
  // 
  public static function sqTableName(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    return $fkbCol;
  }
}