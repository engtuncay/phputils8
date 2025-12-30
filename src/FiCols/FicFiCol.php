<?php

namespace Engtuncay\Phputils8\FiCols;

// FiCol Class Generation v1
use Engtuncay\Phputils8\FiCols\IFiTableMeta;
use Engtuncay\Phputils8\FiDtos\FiCol;
use Engtuncay\Phputils8\FiDtos\FicList;

class FicFiCol implements IFiTableMeta
{

  public function getITxTableName(): string
  {
    return self::GetTxTableName();
  }

  public static function  getTxTableName(): string
  {
    return "FicFiCol";
  }


  public static function genTableCols(): FicList
  {
    $ficList = new FicList();

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

  public static function genTableColsTrans(): FicList
  {
    $ficList = new FicList();



    return $ficList;
  }

  public static function ofcTxDesc(): FiCol
  {
    $fiCol = new FiCol("ofcTxDesc");
    $fiCol->ofcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function ofcTxPrefix(): FiCol
  {
    $fiCol = new FiCol("ofcTxPrefix");
    $fiCol->ofcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function ofcTxEntityName(): FiCol
  {
    $fiCol = new FiCol("ofcTxEntityName");
    $fiCol->ofcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function ofcTxFieldName(): FiCol
  {
    $fiCol = new FiCol("ofcTxFieldName");
    $fiCol->ofcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function ofcTxFieldType(): FiCol
  {
    $fiCol = new FiCol("ofcTxFieldType");
    $fiCol->ofcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function ofcTxHeader(): FiCol
  {
    $fiCol = new FiCol("ofcTxHeader");
    $fiCol->ofcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function ofcTxDbField(): FiCol
  {
    $fiCol = new FiCol("ofcTxDbField");
    $fiCol->ofcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function ofcTxRefField(): FiCol
  {
    $fiCol = new FiCol("ofcTxRefField");
    $fiCol->ofcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function ofcLnLength(): FiCol
  {
    $fiCol = new FiCol("ofcLnLength");
    $fiCol->ofcTxFieldType = 'int';

    return $fiCol;
  }

  public static function ofcLnPrecision(): FiCol
  {
    $fiCol = new FiCol("ofcLnPrecision");
    $fiCol->ofcTxFieldType = 'int';

    return $fiCol;
  }

  public static function ofcLnScale(): FiCol
  {
    $fiCol = new FiCol("ofcLnScale");
    $fiCol->ofcTxFieldType = 'int';

    return $fiCol;
  }

  public static function ofcBoNullable(): FiCol
  {
    $fiCol = new FiCol("ofcBoNullable");
    $fiCol->ofcTxFieldType = 'bool';

    return $fiCol;
  }

  public static function ofcTxIdType(): FiCol
  {
    $fiCol = new FiCol("ofcTxIdType");
    $fiCol->ofcTxFieldType = 'bool';

    return $fiCol;
  }

  public static function ofcBoTransient(): FiCol
  {
    $fiCol = new FiCol("ofcBoTransient");
    $fiCol->ofcTxFieldType = 'bool';

    return $fiCol;
  }

  public static function ofcBoUnique(): FiCol
  {
    $fiCol = new FiCol("ofcBoUnique");
    $fiCol->ofcTxFieldType = 'bool';

    return $fiCol;
  }

  public static function ofcBoUniqGro1(): FiCol
  {
    $fiCol = new FiCol("ofcBoUniqGro1");
    $fiCol->ofcTxFieldType = 'bool';

    return $fiCol;
  }

  public static function ofcTxDefValue(): FiCol
  {
    $fiCol = new FiCol("ofcTxDefValue");
    $fiCol->ofcTxFieldType = 'varchar';

    return $fiCol;
  }



  public function genITableCols(): FicList
  {
    return self::genTableCols();
  }

  public function genITableColsTrans(): FicList
  {
    return self::genTableColsTrans();
  }
}
