<?php

namespace Engtuncay\Phputils8\meta;

use ArrayIterator;
use Engtuncay\Phputils8\log\FiLog;
use IteratorAggregate;
use Traversable;

/**
 * Class which wraps an array for utility
 */
class FiKeybean implements IteratorAggregate
{
    /**
     * fkb is used as array, so it initialized.
     *
     * @var array
     */
    public array $params = [];

    public function put($key, $value)
    {
        $this->params[$key] = $value;
    }

    public function add($key, $value)
    {
        $this->params[$key] = $value;
    }

    public function getArr(): array
    {
        return $this->params;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function getValueByFiCol(FiCol $fiCol)
    {
      FiLog::$log?->debug( json_encode($this->getArr()));
      return $this->getArr()[$fiCol->getOfcTxFieldNameNtn()];
    }

    public function getIterator(): Traversable {
        return new ArrayIterator($this->params);
    }

}