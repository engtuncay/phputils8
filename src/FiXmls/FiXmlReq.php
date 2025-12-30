<?php
namespace Engtuncay\Phputils8\FiXmls;

use Engtuncay\Phputils8\FiDto\FiKeybean;
use Engtuncay\Phputils8\FiCores\FiCollection;
use Engtuncay\Phputils8\FiDto\FiCol;
use Engtuncay\Phputils8\FiXmls\FiXmlUtil;

class FiXmlReq
{
  public string $txXml;

  public FiKeybean $fkbParams;

  public string $txBaseUrl;
  
  public function __construct(string $prmTxXml, FiKeybean $prmFkbParams)
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

  public function GetXmlFinal()
  {
    $this->ProcessParams();
    return $this->txXml;
  }

  public function PrepFkbParams()
  {
    $this->txXml = FiXmlUtil::PrepFkbParams($this->txXml, $this->fkbParams);
  }
  public function DeactiveAllParams()
  {
    $this->txXml = FiXmlUtil::deActivateAllParams($this->txXml);
  }
  /**
   * Xml deki parametreleri değerlerle değiştirir.
   */
  public function  ProcessParams()
  {
    if (FiCollection::isEmpty($this->fkbParams)) return;
    $this->txXml = FiXmlUtil::ConvertXmlParams($this->txXml, $this->fkbParams);
  }

  public function ProcessParamsWitPrep()
  {
    if (FiCollection::IsEmpty($this->fkbParams)) return;
    $this->txXml = FiXmlUtil::PrepFkbParams($this->txXml, $this->fkbParams);
    $this->txXml = FiXmlUtil::ConvertXmlParams($this->txXml, $this->fkbParams);
  }
  public function DeactiveField(FiCol $fiCol)
  {
    $this->txXml = FiXmlUtil::deActivateParam($this->txXml, $fiCol->ofcTxFieldName);
  }

}

