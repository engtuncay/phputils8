<?php

namespace Engtuncay\Phputils8\FiExcels;

use Engtuncay\Phputils8\FiDtos\FicList;

class FiExcelConfig
{
    private ?FicList $fiCols = null;

    public function getFiCols(): ?FicList
    {
        return $this->fiCols;
    }

    public function setFiCols(?FicList $fiCols): self
    {
        $this->fiCols = $fiCols;
        return $this;
    }
}