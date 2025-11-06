<?php

namespace Engtuncay\Phputils8\FiDb;

use Engtuncay\Phputils8\Core\FiStrbui;
use Engtuncay\Phputils8\FiApp\FiAppConfig;
use Engtuncay\Phputils8\FiCol\FimColType;
use Engtuncay\Phputils8\FiDto\FiKeybean;
use Engtuncay\Phputils8\FiDto\FkbList;
use Engtuncay\Phputils8\FiMeta\FimFiCol;
use Engtuncay\Phputils8\FiMeta\FimOksFieldType;

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

    //$debugMessage = 'Log from FiQugen - Mevcut alanlar: ' . print_r($arrFieldId, true);
    //FiAppConfig::$fiLog->debug($debugMessage);

    /** 
     *  @var FkbList $fkbFields 
     *  @var FiKeybean $fkb
     */
    foreach ($fkbFields as $fkb) {
      if (!in_array($fkb->getOfcTxFn(), $arrFieldId)) {
        // Field needs to be added
        $fieldType = $fkb->getValueByFiMeta(FimFiCol::ofcTxFieldType());
        
        $sbSql->append("ALTER TABLE payments_log ADD COLUMN {$fkb->getOfcTxFn()} {$fieldType}");

        if($fieldType == FimOksFieldType::varchar()->getTxValue()) {
          $lnLength = $fkb->getValueByFiMeta(FimFiCol::ofcLnLength());
          if($lnLength !== null) {
            $sbSql->append("({$lnLength})");
          }else{
            // Varsayılan uzunluk eklenebilir
            $sbSql->append("(50)");
          }
        }

        $sbSql->append(";\n");
        // Execute the SQL
      }
    }
    return $sbSql->toString();
  }
}
