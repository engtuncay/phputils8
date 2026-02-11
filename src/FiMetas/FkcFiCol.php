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
    $fkbCol->addFm(FimFiCol::fcTxFieldName(), 'ofcTxDesc');
    $fkbCol->addFm(FimFiCol::fcTxFieldType(), 'varchar');

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
