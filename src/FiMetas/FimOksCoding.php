<?php
namespace Engtuncay\Phputils8\FiMetas;

use Engtuncay\Phputils8\FiDtos\FiMeta;
use Engtuncay\Phputils8\FiDtos\FmtList;

class FimOksCoding {


public static function genTableCols() : FmtList {
  $fmtList = new FmtList();

  

  return $fmtList;
}

public static function genTableColsTrans() : FmtList {
  $fmtList = new FmtList();

  

  return $fmtList;
}

public static function oscTxTableName() : FiMeta
{ 
  $fiMeta = new FiMeta("oscTxTableName");

  return $fiMeta;
}

public static function oscTxTableFields() : FiMeta
{ 
  $fiMeta = new FiMeta("oscTxTableFields");

  return $fiMeta;
}

public static function oscCsvFields() : FiMeta
{ 
  $fiMeta = new FiMeta("oscCsvFields");

  return $fiMeta;
}

public static function oscTxWhere() : FiMeta
{ 
  $fiMeta = new FiMeta("oscTxWhere");

  return $fiMeta;
}



}
