<?php

namespace Engtuncay\Phputils8\FiCol;

use Engtuncay\Phputils8\FiDto\FicList;

interface IFiTableMeta
{
 function getITxTableName():string;

 function genITableCols():FicList;

 function genITableColsTrans():FicList;

}