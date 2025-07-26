<?php

namespace Engtuncay\Phputils8\FiCol;

use Engtuncay\Phputils8\FiDto\FkbList;

interface IFkbTableMeta
{
  function getITxTableName(): string;

  function genITableCols(): FkbList;

  function genITableColsTrans(): FkbList;
}
