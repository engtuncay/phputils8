<?php

namespace Engtuncay\Phputils8\FiCiHelpers;

class FiRouteEnt
{
  private ?string $txRelUrl = null;
  private ?string $ClassMethodTarget = null;

  public function getTxRelUrl(): ?string
  {
    return $this->txRelUrl;
  }

  public function setTxRelUrl(?string $txRelUrl): self
  {
    $this->txRelUrl = $txRelUrl;
    return $this;
  }

  public function getClassMethodTarget(): ?string
  {
    return $this->ClassMethodTarget;
  }

  public function setClassMethodTarget(?string $ClassMethodTarget): self
  {
    $this->ClassMethodTarget = $ClassMethodTarget;
    return $this;
  }
}
