<?php

namespace Engtuncay\Phputils8\FiCols;

use Engtuncay\Phputils8\FiDtos\FicList;

interface IFiTableMeta
{
 function getITxTableName():string;

 function genITableCols():FicList;

 function genITableColsTrans():FicList;

}