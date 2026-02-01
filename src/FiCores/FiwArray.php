<?php

namespace Engtuncay\Phputils8\FiCores;

use Engtuncay\Phputils8\FiDtos\FiKeybean;
use Engtuncay\Phputils8\FiDtos\FkbList;

/**
 * Fi-Wrapper-Array : FiwArray
 *
 * @template T
 */
class FiwArray
{
  /** @var T[] */
  public array $arrValue;

  /**
   * @param T[] $arrValue
   */
  public function __construct(array $arrValue = [])
  {
    $this->arrValue = $arrValue;
  }

  public function getArrValue(): array
  {
    return $this->arrValue;
  }

  public function setArrValue(array $arrValue): void
  {
    $this->arrValue = $arrValue;
  }

  public function existKey(mixed $mixKeyName)
  {
    return array_key_exists($mixKeyName, $this->getArrValue());
  }

  public function existValue(mixed $mixValue)
  {
    return in_array($mixValue, $this->getArrValue());
  }

  /**
   * @param mixed $mixKey
   * @param T $genValue
   * @return void
   */
  public function put(mixed $mixKey, $genValue)
  {
    $this->arrValue[$mixKey] = $genValue;
  }

public function addValue($genValue)
  {
    $this->putValue($genValue);
  }

  public function putValue($genValue)
  {
    $this->arrValue[] = $genValue;
  }

  /**
   * @param mixed $mixKey
   * @param T $genValue
   * @return void
   */
  public function putInArray($mixKey, $genValue)
  {
    $this->arrValue[$mixKey][] = $genValue;
  }

  /**
   * $mixkey FkbList olan bir anahtar olarak tanımlanarak, içine $fkbValue ekler
   *
   * @param mixed $mixKey
   * @param FiKeybean $fkbValue
   * @return void
   */
  public function putInFkbList($mixKey, FiKeybean $fkbValue)
  {
    /** @var FkbList $fkbList */
    $fkbList =  $this->arrValue[$mixKey];

    $fkbList->add($fkbValue);
  }

}