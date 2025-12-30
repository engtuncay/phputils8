<?php

namespace Engtuncay\Phputils8\FiCores;

class FiStrbui
{
  /**
   * fkb is used as array, so it initialized.
   *
   * @var array $arrStr
   */
  public array $arrStr = [];

  public function append(string $str):FiStrbui
  {
    $this->arrStr[] = $str;
    return $this;
  }

  public function __toString(): string
  {
    return implode('', $this->arrStr);
  }

  public function toString(): string
  {
    return $this->__toString();
  }

}