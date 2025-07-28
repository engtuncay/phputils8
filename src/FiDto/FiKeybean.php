<?php

namespace Engtuncay\Phputils8\FiDto;

use ArrayIterator;
use Engtuncay\Phputils8\Core\FiArray;
use Engtuncay\Phputils8\Core\FiString;
use Engtuncay\Phputils8\FiCol\FicFiCol;
use Engtuncay\Phputils8\FiCol\FicValue;
use Engtuncay\Phputils8\FiCol\FimColType;
use Engtuncay\Phputils8\FiMeta\FimFiCol;
use Engtuncay\Phputils8\Log\FiLog;
use IteratorAggregate;
use Traversable;

/**
 * Class which wraps an associative array for utility
 */
class FiKeybean implements IteratorAggregate
{
  /**
   * fkb is used as array, so it initialized.
   *
   * @var array $params
   */
  public array $params;

  /**
   * @param array $params
   */
  public function __construct(array $params = [])
  {
    $this->params = $params;
  }


  public static function bui(array $params = []): FiKeybean
  {
    return new FiKeybean($params);
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

  /**
   * Adds a field (FiCol->ofcTxFieldName) to the FiKeybean.
   *
   * @param FiCol $fiCol
   * @param mixed $value
   * @return void
   */
  public function addField($fiCol, $value)
  {
    if (FiString::isEmpty($fiCol->ofcTxFieldName)) {
      return;
    }
    $this->params[$fiCol->ofcTxFieldName] = $value;
  }

  /**
   * Undocumented function
   *
   * @param FiKeybean $fiCol
   * @param mixed $value
   * @return void
   */
  public function addFieldFkb($fiCol, $value)
  {
    if (FiString::isEmpty($fiCol->getValueByFiCol(FicFiCol::ofcTxFieldName()))) {
      return;
    }
    $this->params[$fiCol->getValueByFiCol(FicFiCol::ofcTxFieldName())] = $value;
  }

  /**
   * Adds a field (FiMeta->ofcTxFieldName) to the FiKeybean.
   *
   * @param FiMeta $fiMeta
   * @param mixed $value
   * @return void
   */
  public function addFieldMeta($fiMeta, $value)
  {
    if (FiString::isEmpty($fiMeta->ofmTxKey)) {
      return;
    }
    $this->params[$fiMeta->ofmTxKey] = $value;
  }

  public function addFm($fiMeta, $value)
  {
    self::addFieldMeta($fiMeta, $value);
  }

  /**
   * FkbCol->ofcTxFieldName is used as key
   *
   * @param FiKeybean $fkbCol
   * @param mixed $value
   * @return void
   */
  public function addFkbCol($fkbCol, $value)
  {
    if (FiString::isEmpty($fkbCol->getValueByFiCol(FicFiCol::ofcTxFieldName()))) {
      return;
    }
    $this->params[$fkbCol->getValueByFiCol(FicFiCol::ofcTxFieldName())] = $value;
  }

  public function getArr(): array
  {
    return $this->params;
  }

  public function toArray(): array
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
    return $this->getValue($fiCol->ofcTxFieldName);
  }

  public function getValueByFiMeta(FiMeta $fiMeta): mixed
  {
    //FiLog::$log?->debug( json_encode($this->getArr()));
    return $this->getValue($fiMeta->ofmTxKey);
  }

  public function getOfcFieldName(): mixed
  {
    //FiLog::$log?->debug( json_encode($this->getArr()));
    return $this->getValue(FimFiCol::ofcTxFieldName()->ofmTxKey);
  }

  public function getValue(string $txKey): mixed
  {
    //FiLog::$log?->debug( json_encode($this->getArr()));
    if (!FiArray::existKey($txKey, $this->getArr())) return null;
    return $this->getArr()[$txKey];
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
