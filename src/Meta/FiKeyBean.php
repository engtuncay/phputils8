<?php

namespace Engtuncay\Phputils8\Meta;

use ArrayIterator;
use Engtuncay\Phputils8\Core\FiArray;
use Engtuncay\Phputils8\FiCol\FicValue;
use Engtuncay\Phputils8\Log\FiLog;
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
   * @var array $params
   */
  public array $params = [];

  public static function bui(): FiKeybean
  {
    return new FiKeybean();

  }

  public function put($key, $value)
  {
    $this->params[$key] = $value;
  }

  public function buiPut($key, $value): FiKeybean
  {
    $this->params[$key] = $value;
    return $this;
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

  public function getValueByFiCol(FiCol $fiCol): mixed
  {
    //FiLog::$log?->debug( json_encode($this->getArr()));
    if (!FiArray::existKeyByFiCol($fiCol, $this->getArr())) return null;
    return $this->getArr()[$fiCol->ofcTxFieldName];
  }

  public function getIterator(): Traversable
  {
    return new ArrayIterator($this->params);
  }

  public function getValueAsBoolByFiCol(FiCol $fiCol): bool|null
  {
    if (!FiArray::existKeyByFiCol($fiCol, $this->getArr())) return null;
    $txValue = $this->getArr()[$fiCol->ofcTxFieldName];

    //if (is_string($txValue)) {
      return FicValue::toBool($txValue);
    //}

    //return null;
  }

}