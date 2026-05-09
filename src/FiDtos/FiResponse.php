<?php

namespace Engtuncay\Phputils8\FiDtos;

class FiResponse
{
  private $fsTxMessage;

  private ?Fkb $fsFkbVal = null;

  public function __construct()
  {
    //$this->fsTxMessage = $message;
  }

  public function getMessage()
  {
    return $this->fsTxMessage;
  }

  public function setMessage($message)
  {
    $this->fsTxMessage = $message;
  }

  public function getFkbValue(): ?Fkb
  {
    return $this->fsFkbVal;
  }

  public function getFkbValueInit(): Fkb
  {
    if ($this->fsFkbVal === null) {
      $this->fsFkbVal = new Fkb();
    }
    return $this->fsFkbVal;
  }

  public function setFkbValue(?Fkb $fsFkbVal): self
  {
    $this->fsFkbVal = $fsFkbVal;
    return $this;
  }
}
