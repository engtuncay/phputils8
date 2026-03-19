<?php
namespace Engtuncay\Phputils8\FiSoaps;

use Engtuncay\Phputils8\FiDtos\Fdr;

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

    public function getHelper() : FiSoap|null
    {
      return FiSoap::buiWithProfile($this->connProfile);
    }

    public function getFdHelper() : Fdr
    {
      $fdr = new Fdr();
      $fiSoap = FiSoap::buiWithProfile($this->connProfile);

      if ($fiSoap) {
        $fdr->setBoResult(true);
        $fdr->setRefValue($fiSoap);
      } else {
        $fdr->setBoResult(false);
      }

      return $fdr;
    }

}