<?php

namespace Engtuncay\Phputils8\FiCol;

// FiCol Class Generation v1

use Engtuncay\Phputils8\FiCol\FicFiCol;
use Engtuncay\Phputils8\FiCol\IFkbTableMeta;
use Engtuncay\Phputils8\FiDto\FiKeybean;
use Engtuncay\Phputils8\FiDto\FkbList;

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

    $fkbList->add(self::ofcTxDesc());
    $fkbList->add(self::ofcTxPrefix());
    $fkbList->add(self::ofcTxEntityName());
    $fkbList->add(self::ofcTxFieldName());
    $fkbList->add(self::ofcTxFieldType());
    $fkbList->add(self::ofcTxHeader());
    $fkbList->add(self::ofcTxDbField());
    $fkbList->add(self::ofcTxRefField());
    $fkbList->add(self::ofcLnLength());
    $fkbList->add(self::ofcLnPrecision());
    $fkbList->add(self::ofcLnScale());
    $fkbList->add(self::ofcBoNullable());
    $fkbList->add(self::ofcTxIdType());
    $fkbList->add(self::ofcBoTransient());
    $fkbList->add(self::ofcBoUnique());
    $fkbList->add(self::ofcBoUniqGro1());
    $fkbList->add(self::ofcTxDefValue());


    return $fkbList;
  }

  public static function genTableColsTrans(): FkbList
  {
    $ficList = new FkbList();



    return $ficList;
  }

  public static function ofcTxDesc(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcTxDesc');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxPrefix(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcTxPrefix');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxEntityName(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcTxEntityName');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxFieldName(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcTxFieldName');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxFieldType(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcTxFieldType');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxHeader(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcTxHeader');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxDbField(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcTxDbField');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxRefField(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcTxRefField');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcLnLength(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcLnLength');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'int');

    return $fkbCol;
  }

  public static function ofcLnPrecision(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcLnPrecision');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'int');

    return $fkbCol;
  }

  public static function ofcLnScale(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcLnScale');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'int');

    return $fkbCol;
  }

  public static function ofcBoNullable(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcBoNullable');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcTxIdType(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcTxIdType');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcBoTransient(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcBoTransient');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcBoUnique(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcBoUnique');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcBoUniqGro1(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcBoUniqGro1');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcTxDefValue(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::ofcTxFieldName(), 'ofcTxDefValue');
    $fkbCol->addField(FicFiCol::ofcTxFieldType(), 'varchar');

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
