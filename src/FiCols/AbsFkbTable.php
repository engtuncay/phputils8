<?php
namespace Engtuncay\Phputils8\FiCols;

use Engtuncay\Phputils8\FiDtos\FiKeybean;

abstract class AbsFkbTable
{
  // child class hiding yapılarak static method yeniden tanımlanır
  public static function sqTableName(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    return $fkbCol;
  }
}