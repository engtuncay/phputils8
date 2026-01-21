<?php
namespace Engtuncay\Phputils8\FiDbs;

use Engtuncay\Phputils8\FiPdos\FiPdo;

abstract class FiAbsRepoGeneric
{
    public ?string $connProfile = null; 

    public function __construct(?string $connProfile = null) {
      $this->connProfile = $connProfile;
    }

    public function getDbHelper() : FiPdo
    {
      return FiPdo::buiWithProfile($this->connProfile);
    }
}

//