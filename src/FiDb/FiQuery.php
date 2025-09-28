<?php

namespace Engtuncay\Phputils8\FiDb;

use Engtuncay\Phputils8\FiDto\FiKeybean;

class FiQuery
{
  private ?string $sql = null;

  private ?FiKeybean $fkbParams = null;

  public function __construct(?string $sql = null)
  {
    $this->sql = $sql;
  }


  // Getter and Setter

  public function getSql(): string
  {
    return $this->sql;
  }

  public function setSql(string $sql): void
  {
    $this->sql = $sql;
  }

  public function getFkbParams(): FiKeybean
  {
    return $this->fkbParams ?? new FiKeybean();
  }

  public function setFkbParams(?FiKeybean $fkbParams): void
  {
    $this->fkbParams = $fkbParams;
  }





}