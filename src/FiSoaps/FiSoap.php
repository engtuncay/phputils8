<?php

namespace Engtuncay\Phputils8\FiSoaps;

use Engtuncay\Phputils8\FiApps\FiAppConfig;
use Engtuncay\Phputils8\FiDtos\Fdr;
use Engtuncay\Phputils8\FiXmls\FiXmlReq;

class FiSoap
{
  // FiPdo'ya göre conn string
  public ?string $txBaseUrl = null;

  public function __construct(?string $txBaseUrl = null)
  {
    $this->txBaseUrl = $txBaseUrl;
  }

  /**
   * SOAP mesajını belirtilen URL'ye gönderir ve sonucu döndürür
   *
   * @param FiXmlReq $fiXmlReq SOAP isteği (XML ve parametreler)
   * @return Fdr İşlem sonucu
   */
  public function request(FiXmlReq $fiXmlReq): Fdr
  {
    $fiXmlReq->txBaseUrl = $this->txBaseUrl;
    return FiSoapUtil::execute($fiXmlReq);
  }


  public static function buiWithProfile(string $connProfile): FiSoap
  {
    FiAppConfig::$fiLog?->debug("FiSoap::buiWithProfile called" . $connProfile ?  ". ConnProfile: " . $connProfile :  "");
    if ($connProfile == null) {
      $connProfile = FiAppConfig::$fiConfig?->getProfile();
    }

    $txApiUrl = FiAppConfig::$fiConfig?->getApiUrl($connProfile);

    $fiSoap = null;
    if ($txApiUrl != null) {
      $fiSoap = new FiSoap;
      $fiSoap->txBaseUrl = $txApiUrl;
    } else {
      FiAppConfig::$fiLog?->error("Api Url is null for profile: " . $connProfile);
    }
    return $fiSoap;
  }
  public static function buiFdrWithProfile(string $connProfile): Fdr
  {
    FiAppConfig::$fiLog?->debug("FiSoap::buiWithProfile called" . $connProfile ?  ". ConnProfile: " . $connProfile :  "");

    if ($connProfile == null) {
      $connProfile = FiAppConfig::$fiConfig?->getProfile();
    }

    // if (self::$fkbPdoPool == null) {
    //   self::$fkbPdoPool = FiKeybean::bui([]);
    // }
    // if (self::$fkbPdoPool->has($connProfile)) {
    //   return self::$fkbPdoPool->get($connProfile);
    // }

    $fdrMain = new Fdr();

    $txApiUrl = FiAppConfig::$fiConfig?->getApiUrl($connProfile);

    $fiSoap = null;
    if ($txApiUrl != null) {
      $fiSoap = new FiSoap;
      $fiSoap->txBaseUrl = $txApiUrl;
      //self::$fkbPdoPool->set($connProfile, $fiPdo);
      $fdrMain->setRefValue($fiSoap);
      $fdrMain->setBoResult(true);
    } else {
      //throw new \Exception( "FiConnConfig is null. Please check your configuration.");
      FiAppConfig::$fiLog?->error("Api Url is null for profile: " . $connProfile);
      $fdrMain->setBoResult(false);
      $fdrMain->setMessage("Api Url is null for profile: " . $connProfile);
    }
    return $fdrMain;
  }
}
 

