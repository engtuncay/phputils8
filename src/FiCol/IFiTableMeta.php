<?php

namespace Engtuncay\Phputils8\FiCol;

use Engtuncay\Phputils8\Meta\FclList;

interface IFiTableMeta
{
 function getITxTableName():string;

 function genITableCols():FclList;

 function genITableColsTrans():FclList;

}