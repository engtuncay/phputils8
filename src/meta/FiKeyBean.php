<?php

namespace Engtuncay\Phputils8\meta;

use ArrayIterator;
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

    public function getByFiCol(FiCol $fiCol)
    {
        return $this->getArr()[$fiCol->ofcTxFieldName];
    }

    public function getIterator(): Traversable {
        return new ArrayIterator($this->params);
    }

}