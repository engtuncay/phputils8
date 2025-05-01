<?php

namespace Engtuncay\Phputils8\FiCol;

use Engtuncay\Phputils8\Meta\FicList;

interface IFiTableMeta
{
 function getITxTableName():string;

 function genITableCols():FicList;

 function genITableColsTrans():FicList;

}