<?php
namespace Engtuncay\Phputils8\FiXmls;

use Engtuncay\Phputils8\FiDtos\FiKeybean;
use Engtuncay\Phputils8\FiCores\FiCollection;
use Engtuncay\Phputils8\FiDtos\FiCol;
use Engtuncay\Phputils8\FiXmls\FiXmlUtil;

class FiXmlReq
{
  public string $txXml;

  public ?FiKeybean $fkbParams;

  public string $txBaseUrl;
  
  public function __construct(string $prmTxXml, ?FiKeybean $prmFkbParams)
  {
    $this->txXml = $prmTxXml;
    $this->fkbParams = $prmFkbParams;
  }

  // public function __construct()
  // {
  //   throw new \Exception('Not implemented');    
  // }()
  // {
  // }

  public function getXmlFinal()
  {
    $this->processParams();
    return $this->txXml;
  }

  public function prepFkbParams()
  {
    $this->txXml = FiXmlUtil::prepFkbParams($this->txXml, $this->fkbParams);
  }
  public function deactiveAllParams()
  {
    $this->txXml = FiXmlUtil::deActivateAllParams($this->txXml);
  }
  /**
   * Xml deki parametreleri değerlerle değiştirir.
   */
  public function processParams()
  {
    if (FiCollection::isEmpty($this->fkbParams)) return;
    $this->txXml = FiXmlUtil::convertXmlParams($this->txXml, $this->fkbParams);
  }

  public function processParamsWitPrep()
  {
    if (FiCollection::IsEmpty($this->fkbParams)) return;
    $this->txXml = FiXmlUtil::prepFkbParams($this->txXml, $this->fkbParams);
    $this->txXml = FiXmlUtil::convertXmlParams($this->txXml, $this->fkbParams);
  }
  public function deactiveField(FiCol $fiCol)
  {
    $this->txXml = FiXmlUtil::deActivateParam($this->txXml, $fiCol->ofcTxFieldName);
  }

}

