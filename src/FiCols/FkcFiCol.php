<?php

namespace Engtuncay\Phputils8\FiCols;

// FiCol Class Generation v1

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
    return "FicFiCol";
  }


  public static function genTableCols(): FkbList
  {
    $fkbList = new FkbList();

    $fkbList->add(self::fcTxDesc());
    $fkbList->add(self::fcTxPrefix());
    $fkbList->add(self::fcTxEntityName());
    $fkbList->add(self::fcTxFieldName());
    $fkbList->add(self::fcTxFieldType());
    $fkbList->add(self::fcTxHeader());
    $fkbList->add(self::fcTxDbField());
    $fkbList->add(self::fcTxRefField());
    $fkbList->add(self::fcLnLength());
    $fkbList->add(self::fcLnPrecision());
    $fkbList->add(self::fcLnScale());
    $fkbList->add(self::fcBoNullable());
    $fkbList->add(self::fcTxIdType());
    $fkbList->add(self::fcBoTransient());
    $fkbList->add(self::fcBoUnique());
    $fkbList->add(self::fcBoUniqGro1());
    $fkbList->add(self::fcTxDefValue());


    return $fkbList;
  }

  public static function genTableColsTrans(): FkbList
  {
    $ficList = new FkbList();



    return $ficList;
  }

  public static function fcTxDesc(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'fcTxDesc');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

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
