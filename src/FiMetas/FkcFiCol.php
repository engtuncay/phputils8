<?php

namespace Engtuncay\Phputils8\FiMetas;

// Codegen v2

use Engtuncay\Phputils8\FiCols\FicFiCol;
use Engtuncay\Phputils8\FiCols\IFkbTableMeta;
use Engtuncay\Phputils8\FiDtos\FiKeybean;
use Engtuncay\Phputils8\FiDtos\FkbList;

class FkcFiCol implements IFkbTableMeta
{

  public function getITxTableName(): string
  {
    return self::GetTxTableName();
  }

  public static function  getTxTableName(): string
  {
    return "FkcFiCol";
  }


  public static function genTableCols(): FkbList
  {
    $ficList = new FkbList();

    $ficList->add(self::fcTxDesc());
    $ficList->add(self::fcTxPrefix());
    $ficList->add(self::fcTxEntityName());
    $ficList->add(self::fcTxFieldName());
    $ficList->add(self::fcTxFieldType());
    $ficList->add(self::fcTxHeader());
    $ficList->add(self::fcTxDbField());
    $ficList->add(self::fcTxRefField());
    $ficList->add(self::fcLnLength());
    $ficList->add(self::fcLnPrecision());
    $ficList->add(self::fcLnScale());
    $ficList->add(self::fcBoNullable());
    $ficList->add(self::fcTxIdType());
    $ficList->add(self::fcBoTransient());
    $ficList->add(self::fcBoUnique());
    $ficList->add(self::fcBoUniqGro1());
    $ficList->add(self::fcTxDefValue());


    return $ficList;
  }

  public static function genTableColsTrans(): FkbList
  {
    $ficList = new FkbList();



    return $ficList;
  }

  public static function fcTxDesc(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFm(FimFiCol::fcTxFieldName(), 'fcTxDesc');
    $fkbCol->addFm(FimFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function fcTxPrefix(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcTxPrefix');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function fcTxEntityName(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcTxEntityName');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function fcTxFieldName(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcTxFieldName');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function fcTxFieldType(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcTxFieldType');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function fcTxHeader(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcTxHeader');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function fcTxDbField(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcTxDbField');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function fcTxRefField(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcTxRefField');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function fcLnLength(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcLnLength');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'int');

    return $fkbCol;
  }

  public static function fcLnPrecision(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcLnPrecision');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'int');

    return $fkbCol;
  }

  public static function fcLnScale(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcLnScale');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'int');

    return $fkbCol;
  }

  public static function fcBoNullable(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcBoNullable');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function fcTxIdType(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcTxIdType');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function fcBoTransient(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcBoTransient');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function fcBoUnique(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcBoUnique');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function fcBoUniqGro1(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcBoUniqGro1');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function fcTxDefValue(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcTxDefValue');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }



  public function genITableCols(): FkbList
  {
    return self::genTableCols();
  }

  public function genITableColsTrans(): FkbList
  {
    return self::genTableColsTrans();
  }
}
