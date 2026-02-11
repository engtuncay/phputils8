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
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcTxDesc');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxPrefix(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcTxPrefix');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxEntityName(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcTxEntityName');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxFieldName(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcTxFieldName');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxFieldType(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcTxFieldType');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxHeader(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcTxHeader');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxDbField(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcTxDbField');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcTxRefField(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcTxRefField');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'varchar');

    return $fkbCol;
  }

  public static function ofcLnLength(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcLnLength');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'int');

    return $fkbCol;
  }

  public static function ofcLnPrecision(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcLnPrecision');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'int');

    return $fkbCol;
  }

  public static function ofcLnScale(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcLnScale');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'int');

    return $fkbCol;
  }

  public static function ofcBoNullable(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcBoNullable');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcTxIdType(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcTxIdType');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcBoTransient(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcBoTransient');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcBoUnique(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcBoUnique');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcBoUniqGro1(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcBoUniqGro1');
    $fkbCol->addField(FicFiCol::fcTxFieldType(), 'bool');

    return $fkbCol;
  }

  public static function ofcTxDefValue(): FiKeybean
  {
    $fkbCol = new FiKeybean();
    $fkbCol->addField(FicFiCol::fcTxFieldName(), 'ofcTxDefValue');
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
