<?php

namespace Engtuncay\Phputils8\Core;

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
    return in_array($mixKeyName, $this->getArrValue());
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

  /**
   * @param mixed $mixKey
   * @param T $genValue
   * @return void
   */
  public function putInArray($mixKey, $genValue)
  {
    $this->arrValue[$mixKey][] = $genValue;
  }

}