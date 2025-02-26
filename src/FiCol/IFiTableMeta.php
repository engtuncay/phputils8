<?php

namespace Engtuncay\Phputils8\FiCol;

use Engtuncay\Phputils8\Meta\FiColList;

interface IFiTableMeta
{
 function getITxTableName():string;

 function genITableCols():FiColList;

 function genITableColsTrans():FiColList;

}