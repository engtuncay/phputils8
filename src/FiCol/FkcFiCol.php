<?php

namespace Engtuncay\Phputils8\FiCol;

// FiCol Class Generation v1

use Engtuncay\Phputils8\FiCol\FicFiCol;
use Engtuncay\Phputils8\FiCol\IFkbTableMeta;
use Engtuncay\Phputils8\Meta\FiKeybean;
use Engtuncay\Phputils8\Meta\FkbList;

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
    $ficList = new FkbList();

    $ficList->add(self::ofcTxDesc());
    $ficList->add(self::ofcTxPrefix());
    $ficList->add(self::ofcTxEntityName());
    $ficList->add(self::ofcTxFieldName());
    $ficList->add(self::ofcTxFieldType());
    $ficList->add(self::ofcTxHeader());
    $ficList->add(self::ofcTxDbField());
    $ficList->add(self::ofcTxRefField());
    $ficList->add(self::ofcLnLength());
    $ficList->add(self::ofcLnPrecision());
    $ficList->add(self::ofcLnScale());
    $ficList->add(self::ofcBoNullable());
    $ficList->add(self::ofcTxIdType());
    $ficList->add(self::ofcBoTransient());
    $ficList->add(self::ofcBoUnique());
    $ficList->add(self::ofcBoUniqGro1());
    $ficList->add(self::ofcTxDefValue());


    return $ficList;
  }

  public static function genTableColsTrans(): FkbList
  {
    $ficList = new FkbList();



    return $ficList;
  }

  public static function ofcTxDesc(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcTxDesc');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxPrefix(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcTxPrefix');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxEntityName(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcTxEntityName');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxFieldName(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcTxFieldName');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxFieldType(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcTxFieldType');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxHeader(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcTxHeader');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxDbField(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcTxDbField');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxRefField(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcTxRefField');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcLnLength(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcLnLength');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'int');

    return $fkbCol;
  }

  public static function ofcLnPrecision(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcLnPrecision');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'int');

    return $fkbCol;
  }

  public static function ofcLnScale(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcLnScale');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'int');

    return $fkbCol;
  }

  public static function ofcBoNullable(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcBoNullable');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcTxIdType(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcTxIdType');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcBoTransient(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcBoTransient');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcBoUnique(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcBoUnique');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcBoUniqGro1(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcBoUniqGro1');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcTxDefValue(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldName(), 'ofcTxDefValue');
    $fkbCol->addFiCol(FicFiCol::ofcTxFieldType(), 'varchar');

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
