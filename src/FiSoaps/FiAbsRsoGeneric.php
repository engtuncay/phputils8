<?php
namespace Engtuncay\Phputils8\FiSoaps;

/**
 * FiAbsRepoSoapGeneric, SOAP işlemleri için temel bir soyut sınıf olarak tasarlanmıştır.
 * 
 * @package Engtuncay\Phputils8\FiSoaps
 */
abstract class FiAbsRsoGeneric
{
    public ?string $connProfile = null; 

    public function __construct(?string $connProfile = null) {
      $this->connProfile = $connProfile;
    }

    public function getDbHelper() : FiSoap|null
    {
      return FiSoap::buiWithProfile($this->connProfile);
    }

}