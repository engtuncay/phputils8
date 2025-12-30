<?php

namespace Engtuncay\Phputils8\FiDbs;

use Engtuncay\Phputils8\FiCores\FiStrbui;
use Engtuncay\Phputils8\FiApps\FiAppConfig;
use Engtuncay\Phputils8\FiCols\FimColType;
use Engtuncay\Phputils8\FiDtos\FiKeybean;
use Engtuncay\Phputils8\FiDtos\FkbList;
use Engtuncay\Phputils8\FiMetas\FimFiCol;
use Engtuncay\Phputils8\FiMetas\FimOksFieldType;

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

        if($fieldType == FimOksFieldType::varchar()->getTxKey()
          || $fieldType == FimOksFieldType::string()->getTxKey()) {
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
