<?php
namespace Engtuncay\Phputils8\FiXmls;

use Engtuncay\Phputils8\FiDtos\FiKeybean;
use Engtuncay\Phputils8\FiCores\FiCollection;
use Engtuncay\Phputils8\FiDtos\FiCol;
use Engtuncay\Phputils8\FiXmls\FiXmlUtil;

class FiXmlReq
{

	/**
	 * @var string
	 */
	public ?string $txXml;

	/**
	 * @var FiKeybean
	 */
	public ?FiKeybean $fkbParams;

	/**
	 * @var string
	 */
	public ?string $txBaseUrl;

	public function __construct(?string $prmTxXml = null, ?FiKeybean $prmFkbParams = null)
	{
		$this->txXml = $prmTxXml;
		$this->fkbParams = $prmFkbParams;
	}

	/**
	 * Xml'deki parametreleri işleyip sonucu döndürür
	 */
	public function getXmlFinal()
	{
		$this->processParams();
		return $this->txXml;
	}

	/**
	 * Parametreleri hazırlar (template block işlemleri)
	 */
	public function prepFkbParams()
	{
		$this->txXml = FiXmlUtil::prepFkbParams($this->txXml, $this->fkbParams);
	}

	/**
	 * Tüm parametreleri deaktive eder
	 */
	public function deactiveAllParams()
	{
		$this->txXml = FiXmlUtil::deActivateAllParams($this->txXml);
	}

	/**
	 * Xml'deki parametreleri değerlerle değiştirir
	 */
	public function processParams()
	{
		if (FiCollection::isEmpty($this->fkbParams)) return;
		$this->txXml = FiXmlUtil::convertXmlParams($this->txXml, $this->fkbParams);
	}

	/**
	 * Parametreleri hazırlar ve değerlerle değiştirir
	 */
	public function processParamsWitPrep()
	{
		if (FiCollection::isEmpty($this->fkbParams)) return;
		$this->txXml = FiXmlUtil::prepFkbParams($this->txXml, $this->fkbParams);
		$this->txXml = FiXmlUtil::convertXmlParams($this->txXml, $this->fkbParams);
	}

	/**
	 * Belirli bir alanı deaktive eder
	 */
	public function deactiveField(FiCol $fiCol)
	{
		$this->txXml = FiXmlUtil::deActivateParam($this->txXml, $fiCol->ofcTxFieldName);
	}
}


// using OrakYazilimLib.DbGeneric;
// using OrakYazilimLib.Util.core;
// using System.Text.RegularExpressions;

// namespace OrakYazilimLib.UtilXml
// {
//   public class FiXmlReq
//   {
//     public string txXml { get; set; }

//     public FiKeybean fkbParams { get; set; }

//     public string txBaseUrl { get; set; }

//     public FiXmlReq(string prmTxXml, FiKeybean prmFkbParams)
//     {
//       this.txXml = prmTxXml;
//       this.fkbParams = prmFkbParams;
//     }

//     public FiXmlReq()
//     {
//     }

//     public string GetXmlFinal()
//     {
//       ProcessParams();
//       return txXml;
//     }

//     public void PrepFkbParams()
//     {
//       this.txXml = FiXmlUtil.PrepFkbParams(txXml, this.fkbParams);
//     }
//     public void DeactiveAllParams()
//     {
//       this.txXml = FiXmlUtil.DeActivateAllParams(this.txXml);
//     }
//     /**
//      * Xml deki parametreleri değerlerle değiştirir.
//      */
//     public void ProcessParams()
//     {
//       if (FiCollection.IsEmpty(this.fkbParams)) return;
//       this.txXml = FiXmlUtil.ConvertXmlParams(this.txXml, this.fkbParams);
//     }

//     public void ProcessParamsWitPrep()
//     {
//       if (FiCollection.IsEmpty(this.fkbParams)) return;
//       this.txXml = FiXmlUtil.PrepFkbParams(this.txXml, this.fkbParams);
//       this.txXml = FiXmlUtil.ConvertXmlParams(this.txXml, this.fkbParams);
//     }
//     public void DeactiveField(FiCol fiCol)
//     {
//       this.txXml = FiXmlUtil.DeActivateParam(this.txXml, fiCol.ofcTxFieldName);
//     }

//   }

// }