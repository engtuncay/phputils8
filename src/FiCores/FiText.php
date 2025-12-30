<?php

namespace Engtuncay\Phputils8\FiCores;

use Engtuncay\Phputils8\FiDtos\FkbList;

class FiText
{
  /**
   * @param $fkbList
   * @return void
   */
  public static function textArrayFkbList($fkbList):string
  {
    $sbText = new FiStrbui();
    $indexFor = 0;
    foreach ($fkbList as $fkb) {
      $indexFor++;
      $sbText->append("$indexFor : ");
      foreach ($fkb as $key => $value) {
        $sbText->append("$key : $value");
      }
      $sbText->append("\n");
    }

    return $sbText->toString();
  }
}