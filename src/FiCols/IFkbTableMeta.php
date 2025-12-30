<?php

namespace Engtuncay\Phputils8\FiCols;

use Engtuncay\Phputils8\FiDtos\FkbList;

interface IFkbTableMeta
{
  function getITxTableName(): string;

  function genITableCols(): FkbList;

  function genITableColsTrans(): FkbList;
}
