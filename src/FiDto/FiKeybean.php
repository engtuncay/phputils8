<?php

namespace Engtuncay\Phputils8\FiDto;

use ArrayIterator;
use Engtuncay\Phputils8\Core\FiArray;
use Engtuncay\Phputils8\Core\FiString;
use Engtuncay\Phputils8\FiCol\FicFiCol;
use Engtuncay\Phputils8\FiCol\FicValue;
use Engtuncay\Phputils8\FiMeta\FimFiCol;
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
  public function __construct(?array $params = null)
  {
    $this->params = $params ?? [];
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

  public function set($key, $value)
  {
    $this->add($key, $value);
  }

  public function addValue($value)
  {
    $this->params[] = $value;
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
    if ($fiCol == null) return;

    $txFieldName =  $fiCol->getValueByFiMeta(FimFiCol::ofcTxFieldName());

    if (FiString::isEmpty($txFieldName)) return;

    $this->params[$fiCol->getValueByFiMeta(FimFiCol::ofcTxFieldName())] = $value;
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

  public function getValueByFkc(FiKeybean $fkcCol): mixed
  {
    return $this->getValue($fkcCol->getValueByFiMeta(FimFiCol::ofcTxFieldName()));
  }

  // Deprecated, use getOfcTxFieldName() instead
  public function getOfcFieldName(): mixed
  {
    //FiLog::$log?->debug( json_encode($this->getArr()));
    return $this->getValueByFiMeta(FimFiCol::ofcTxFieldName());
  }

  public function getOfcTxFieldName(): mixed
  {
    //FiLog::$log?->debug( json_encode($this->getArr()));
    return $this->getValueByFiMeta(FimFiCol::ofcTxFieldName());
  }

  public function getOfcTxFn(): mixed
  {
    //FiLog::$log?->debug( json_encode($this->getArr()));
    return $this->getValueByFiMeta(FimFiCol::ofcTxFieldName());
  }

  public function getValue(string $txKey): mixed
  {
    //FiLog::$log?->debug( json_encode($this->getArr()));
    if (!FiArray::existKey($txKey, $this->getArr())) return null;
    return $this->getArr()[$txKey];
  }

  public function get(string $txKey): mixed
  {
    return $this->getValue($txKey);
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
  }

  public function has(string $txKey = null): bool
  {
    if ($txKey == null) return false;
    return array_key_exists($txKey, $this->getArr());
  }
}
