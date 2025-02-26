<?php

namespace Engtuncay\Phputils8\Core;

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

  public function toString()
  {
    return $this->__toString();
  }

}