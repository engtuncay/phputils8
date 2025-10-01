<?php

namespace Engtuncay\Phputils8\FiDb;

use Engtuncay\Phputils8\Core\FiStrbui;
use Engtuncay\Phputils8\FiDto\FiKeybean;
use Engtuncay\Phputils8\FiDto\FkbList;
use Engtuncay\Phputils8\FiMeta\FimFiCol;

/**
 * FiQuery Generator
 */
class FiQugen
{

  public static function sqlAlterFields(FkbList $fkbFields, array $fdrFields): string
  {
    $sbSql = new FiStrbui();

    $arrFieldId = [];

    foreach ($fdrFields as $refFields) {
      $arrFieldId[] = $refFields['Field'];
    }

    log_message('info', 'Mevcut alanlar: ' . print_r($arrFieldId, true));

    /** 
     *  @var FkbList $fkbFields 
     *  @var FiKeybean $fkb
     */
    foreach ($fkbFields as $fkb) {
      if (!in_array($fkb->getOfcTxFn(), $arrFieldId)) {
        // Field needs to be added
        $sbSql->append("ALTER TABLE payments_log ADD COLUMN {$fkb->getOfcTxFn()} {$fkb->getValueByFiMeta(FimFiCol::ofcTxFieldType())};");
        $sbSql->append("\n");
        // Execute the SQL
      }
    }
    return $sbSql->toString();
  }
}
