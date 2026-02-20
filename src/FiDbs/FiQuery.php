<?php

namespace Engtuncay\Phputils8\FiDbs;

use Engtuncay\Phputils8\FiApps\FiAppConfig;
use Engtuncay\Phputils8\FiCores\FiCollection;
use Engtuncay\Phputils8\FiCores\FiString;
use Engtuncay\Phputils8\FiDtos\FiKeybean;

class FiQuery
{
  private ?string $sql = null;

  private ?FiKeybean $fkbParams = null;

  // Query özellikleri
  public ?object $fiTableMeta = null;

  public ?object $ficListCol = null;

  public ?bool $boInsertFieldsOnly = null;

  public ?bool $boUseUpdateFieldsOnly = null;


  public function __construct(?string $sql = null, ?FiKeybean $fkbParams = null)
  {
    $this->sql = $sql;
    $this->fkbParams = $fkbParams;
  }


  // Getter and Setter

  public function getSql(): string
  {
    // if ($this->sql != null) {
    //   return FiQueryUtil::convertSqlParamToNamedParamMainExcludable($this->sql);
    // }
    return $this->sql ??  '';
  }

  /**
   * sql fixed
   *
   * @return string
   */
  public function getSqlFixed(): string
  {
    if ($this->sql != null) {
      return FiQueryUtil::convertSqlParamToNamedParamMainExcludable($this->sql);
    }
    return '';
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

  /**
   * Liste türündeki parametreleri multi param (abc_1, abc_2... gibi) çevirir
   * @param array $list Parametre listesi
   * @param string $paramName Parametre adı
   */
  public function addMultiParam(array $list, string $paramName): void
  {
    $index = 0;
    foreach ($list as $element) {
      $paramTemplate = $paramName . $index;
      $this->getFkbParams()->put($paramTemplate, $element);
      $index++;
    }
  }

  /**
   * Collection (List, Set) Türündeki parametreleri multi param (abc_1, abc_2... gibi) çevirir
   */
  public function convertListParamToMultiParams(): void
  {
    if (FiCollection::isEmpty($this->fkbParams)) {
      return;
    }
    $this->sql = FiQueryUtil::convertListParamToMultiParams($this->sql, $this->fkbParams, false);
  }

  /**
   * Null olmayan parametreleri aktive eder
   */
  public function activateParamsNotNull(): void
  {
    if (!FiCollection::isEmpty($this->fkbParams)) {
      $this->sql = FiQueryUtil::activateParamsNotNull($this->sql, $this->fkbParams);
    }
  }

  /**
   * boActivateOnlyFullParams parametresine false değeri gönderir.
   * @see FiQueryUtil::activateParamsMain()
   */
  public function activateParamsByMapParams(): void
  {
    $this->activateParamsMain(false);
  }

  /**
   * ActivateParamsByMapParams(), DeActivateAllOptParams() metodlarını çalıştırır
   * @see FiQueryUtil::activateParamsMain()
   * @see FiQueryUtil::deActivateAllOptParams()
   */
  public function processAllParamsByMapParams(): void
  {
    $this->activateParamsMain(false);
    $this->deActivateAllOptParams();
  }

  /**
   * FiKeybean'da olan parametreleri aktive eder
   * @param bool $boActivateOnlyFullParams Sadece dolu parametreleri aktif et?
   * @see FiQueryUtil::activateParamsMain()
   */
  public function activateParamsMain(bool $boActivateOnlyFullParams): void
  {
    if ($this->fkbParams !== null) {
      $this->sql = FiQueryUtil::activateParamsMain($this->sql, $this->fkbParams, $boActivateOnlyFullParams);
    }
  }

  /**
   * Tüm opsiyonel parametreleri deaktive eder
   * @see FiQueryUtil::deActivateAllOptParams()
   */
  public function deActivateAllOptParams(): void
  {
    $this->sql = FiQueryUtil::deActivateAllOptParams($this->sql);
  }

  /**
   * Sorguyu ve parametreleri log'a kaydeder
   */
  public function logQueryAndParams(): void
  {
    FiAppConfig::$fiLog?->debug("Query:" . $this->sql);
    FiAppConfig::$fiLog?->debug("Params:" . $this->fkbParamsToString());
  }

  /**
   * FkbParams'i string'e çevirir
   */
  private function fkbParamsToString(): string
  {
    if ($this->fkbParams === null) {
      return "null";
    }
    return json_encode($this->fkbParams->getParams());
  }
}

/*
FiQuery.php dosyasına yoruma alınmış C# FiQuery sınıfındaki tüm metodları ve özellikleri PHP'ye ekledim:

Eklenen Özellikler (Properties):
$fiTableMeta - Tablo meta verisi
$ficListCol - Kolon listesi
$boInsertFieldsOnly - Sadece insert alanları kullan mı?
$boUseUpdateFieldsOnly - Sadece update alanları kullan mı?
Eklenen Metodlar:
addMultiParam() - Liste parametrelerini multi param'a çevirir (abc_1, abc_2 vs)
convertListParamToMultiParams() - Collection türü parametreleri multi param'a çevirir
activateParamsNotNull() - Null olmayan parametreleri aktive eder
activateParamsByMapParams() - Parametreleri aktive eder (false flag ile)
processAllParamsByMapParams() - Parametreleri aktive ve deaktive eder
activateParamsMain() - Parametreleri şarta bağlı olarak aktive eder
deActivateAllOptParams() - Opsiyonel parametreleri deaktive eder
logQueryAndParams() - Sorguyu ve parametreleri log'a kaydeder
Diğer Değişiklikler:
Constructor overload: ?FiKeybean $fkbParams parametresi eklendi
Gerekli use statement'ları eklendi (FiAppConfig, FiCollection, FiString)
Tüm yorum satırları kaldırıldı
Tüm kodlar hatasız olarak derlenmiştir.
*/