<?php

namespace Engtuncay\Phputils8\Pdo;

use Engtuncay\Phputils8\FiDto\FiKeybean;

class FiQuery
{
  private string $sql;

  private ?FiKeybean $fkbParams = null;

  public function __construct(string $sql = "")
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

  public function getFkbParams(): ?FiKeybean
  {
    return $this->fkbParams;
  }

  public function setFkbParams(?FiKeybean $fkbParams): void
  {
    $this->fkbParams = $fkbParams;
  }





}