<?php

namespace Engtuncay\Phputils8\FiDtos;

class FiResponse
{
  private $fsTxMessage;

  private ?FiKeybean $fsFkbVal = null;

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

  public function getFkbValue(): ?FiKeybean
  {
    return $this->fsFkbVal;
  }

  public function getFkbValueInit(): FiKeybean
  {
    if ($this->fsFkbVal === null) {
      $this->fsFkbVal = new FiKeybean();
    }
    return $this->fsFkbVal;
  }

  public function setFkbValue(?FiKeybean $fsFkbVal): self
  {
    $this->fsFkbVal = $fsFkbVal;
    return $this;
  }
}
