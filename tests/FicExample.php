<?php
// FiCol Class Generation v1
use Engtuncay\Phputils8\FiCol\IFiTableMeta;
use Engtuncay\Phputils8\FiDto\FiCol;
use Engtuncay\Phputils8\FiDto\FicList;

class OksCoding implements IFiTableMeta
{

  public function getITxTableName(): string
  {
    return self::GetTxTableName();
  }

  public static function getTxTableName(): string
  {
    return "OksCoding";
  }


  public static function genTableCols(): FicList
  {
    $ficList = new FicList();

    $ficList->add(self::okTableName());
    $ficList->add(self::okTableFields());
    $ficList->add(self::okCsvFields());

    return $ficList;
  }

  public static function genTableColsTrans(): FicList
  {
    $ficList = new FicList();



    return $ficList;
  }

  public static function okTableName(): FiCol
  {
    $fiCol = new FiCol("okTableName");

    return $fiCol;
  }

  public static function okTableFields(): FiCol
  {
    $fiCol = new FiCol("okTableFields");

    return $fiCol;
  }

  public static function okCsvFields(): FiCol
  {
    $fiCol = new FiCol("okCsvFields");

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
