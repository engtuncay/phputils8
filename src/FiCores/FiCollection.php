<?php
namespace Engtuncay\Phputils8\FiCores;

use Engtuncay\Phputils8\FiDtos\FiKeybean;

class FiCollection
{
  public static function isEmpty($objCollection): bool
  {
    if ($objCollection == null) return true;

    if (is_array($objCollection)) {
      return count($objCollection) == 0;
    }

    if($objCollection instanceof FiKeybean) {
      return count($objCollection->params) == 0;
    }

    // count metodu varsa onu kullan
    if (method_exists($objCollection, 'count')) {
      return $objCollection->count() == 0;
    }

    return false;
  }

  public static function size($objCollection): int
  {
    if ($objCollection == null) return 0;

    if (is_array($objCollection)) {
      return count($objCollection);
    }

    if (method_exists($objCollection, 'count')) {
      return $objCollection->count();
    }

    return 0;
  }

} 