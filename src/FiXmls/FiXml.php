<?php

namespace Engtuncay\Phputils8\FiXmls;

use DOMDocument;
use Engtuncay\Phputils8\FiCores\FiArray;
use Engtuncay\Phputils8\FiDtos\FiKeybean;
use SimpleXMLElement;

class FiXml
{
  public ?string $txXml = null;
  public ?SimpleXMLElement $sxmlDoc = null;
  public ?DOMDocument $domDoc = null;
  public ?FiKeybean $fkbData = null;

  public function __construct(?string $pTxXml = null)
  {
    $this->txXml = $pTxXml; // if ($pTxXml) {
    //   $this->sxmlDoc = self::parseAsSimpleXml($pTxXml);
    // }
  }

  public function convertFkb()
  {
    $cleanXml = str_ireplace(['soap:', 'xsi:', 'xsd:'], '', $this->txXml);
    $xmlObject = simplexml_load_string($cleanXml);
    $data = json_decode(json_encode($xmlObject), true);
    if (is_array($data)) {
      if (FiArray::existKey('Body', $data)) {
        // Body varsa eğer, Body altındaki altındaki elemanları üst seviyeye çıkart, Body'yi kaldır
        $data = $data['Body']; // reset kaldırılır
      }
      $this->fkbData = FiKeybean::bui($data);
    } else {
      //$this->arrData = null;

    } //return $data;
    // $token = $data['Body']['IntegrationLoginResponse']['IntegrationLoginResult']['ResultString'];
    // echo $token; // ze52t5ox1bm
  }

  /**
   * XML string'i SimpleXML ile parse eder
   * @param string $xmlString
   * @return \SimpleXMLElement|false
   */
  public static function parseAsSimpleXml(string $xmlString)
  {
    return simplexml_load_string($xmlString);
  }

  /**
   * XML string'i DOMDocument ile parse eder
   * @param string $xmlString
   * @return \DOMDocument|false
   */
  public static function parseAsDomDoc(string $xmlString)
  {
    $dom = new \DOMDocument;
    $success = $dom->loadXML($xmlString);
    return $success ? $dom : false; // public function getEleValue(string $elementName): ?string
    // {
    //   if ($this->xmlDoc && isset($this->xmlDoc->{$elementName})) {
    //     return (string)$this->xmlDoc->{$elementName};
    //   }
    //   return null;
    // }
  }

  public function getFkbData(): ?FiKeybean
  {
    return $this->fkbData;
  }

  public function setFkbData(?FiKeybean $fkbData): self
  {
    $this->fkbData = $fkbData;
    return $this;
  }
}
