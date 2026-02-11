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

  public static function genTableColsTrans(): FicList
  {
    $ficList = new FicList();



    return $ficList;
  }

  public static function fcTxDesc(): FiCol
  {
    $fiCol = new FiCol("fcTxDesc");
    $fiCol->fcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function fcTxPrefix(): FiCol
  {
    $fiCol = new FiCol("fcTxPrefix");
    $fiCol->fcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function fcTxEntityName(): FiCol
  {
    $fiCol = new FiCol("fcTxEntityName");
    $fiCol->fcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function fcTxFieldName(): FiCol
  {
    $fiCol = new FiCol("fcTxFieldName");
    $fiCol->fcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function fcTxFieldType(): FiCol
  {
    $fiCol = new FiCol("fcTxFieldType");
    $fiCol->fcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function fcTxHeader(): FiCol
  {
    $fiCol = new FiCol("fcTxHeader");
    $fiCol->fcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function fcTxDbField(): FiCol
  {
    $fiCol = new FiCol("fcTxDbField");
    $fiCol->fcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function fcTxRefField(): FiCol
  {
    $fiCol = new FiCol("fcTxRefField");
    $fiCol->fcTxFieldType = 'varchar';

    return $fiCol;
  }

  public static function fcLnLength(): FiCol
  {
    $fiCol = new FiCol("fcLnLength");
    $fiCol->fcTxFieldType = 'int';

    return $fiCol;
  }

  public static function fcLnPrecision(): FiCol
  {
    $fiCol = new FiCol("fcLnPrecision");
    $fiCol->fcTxFieldType = 'int';

    return $fiCol;
  }

  public static function fcLnScale(): FiCol
  {
    $fiCol = new FiCol("fcLnScale");
    $fiCol->fcTxFieldType = 'int';

    return $fiCol;
  }

  public static function fcBoNullable(): FiCol
  {
    $fiCol = new FiCol("fcBoNullable");
    $fiCol->fcTxFieldType = 'bool';

    return $fiCol;
  }

  public static function fcTxIdType(): FiCol
  {
    $fiCol = new FiCol("fcTxIdType");
    $fiCol->fcTxFieldType = 'bool';

    return $fiCol;
  }

  public static function fcBoTransient(): FiCol
  {
    $fiCol = new FiCol("fcBoTransient");
    $fiCol->fcTxFieldType = 'bool';

    return $fiCol;
  }

  public static function fcBoUnique(): FiCol
  {
    $fiCol = new FiCol("fcBoUnique");
    $fiCol->fcTxFieldType = 'bool';

    return $fiCol;
  }

  public static function fcBoUniqGro1(): FiCol
  {
    $fiCol = new FiCol("fcBoUniqGro1");
    $fiCol->fcTxFieldType = 'bool';

    return $fiCol;
  }

  public static function fcTxDefValue(): FiCol
  {
    $fiCol = new FiCol("fcTxDefValue");
    $fiCol->fcTxFieldType = 'varchar';

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
