<?php

namespace Engtuncay\Phputils8\FiMods;

abstract class FiAbsMod
{
  public ?string $connProfile = null;

  public function __construct(?string $connProfile = null)
  {
    $this->connProfile = $connProfile;
  }
}
