<?php

namespace Engtuncay\Phputils8\FiDtos;

/**
 * Sınıf test edilmeli - kontrol yapılmadı
 */
class FiDatabean
{
  private array $arrData = [];
  private array $dictFieldToIndex = [];
  private int $lnLastIndex = 1;

  public function __construct(array $arrValue = [])
  {
    $this->arrData = $arrValue;
  }

  public function addField(string $txKey, $objValue): void
  {
    $index = $this->getOrSetIndexForField($txKey);
    $this->arrData[$index] = $objValue;
  }

  private function getOrSetIndexForField(string $key): int
  {
    if (array_key_exists($key, $this->dictFieldToIndex)) {
      return $this->dictFieldToIndex[$key];
    }

    // Assign new index
    $this->dictFieldToIndex[$key] = $this->lnLastIndex;
    $this->lnLastIndex++;
    return $this->lnLastIndex - 1;
  }

  public function getAsString(string $txKey): ?string
  {
    if (array_key_exists($txKey, $this->dictFieldToIndex)) {
      $index = $this->dictFieldToIndex[$txKey];
      if (isset($this->arrData[$index])) {
        return (string)$this->arrData[$index];
      }
    }
    return null;
  }
  
}
