<?php
namespace Engtuncay\Phputils8\FiCols;

use Engtuncay\Phputils8\FiDtos\Fkb;

abstract class AbsFkbTable
{
  // child class hiding yapılarak static method yeniden tanımlanır
  public static function sqTableName(): Fkb
  {
    $fkbCol = new Fkb();
    return $fkbCol;
  }

  public static function genFkbFields(): Fkb
  {
    $fkbCol = new Fkb();
    return $fkbCol;
  }
  
}