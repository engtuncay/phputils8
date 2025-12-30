<?php
namespace Engtuncay\Phputils8\FiSoaps;

use Engtuncay\Phputils8\FiApps\FiAppConfig;
use Engtuncay\Phputils8\FiDtos\Fdr;
use Engtuncay\Phputils8\FiXmls\FiXmlReq;
use DOMDocument;
use Exception;

class FiSoap
{
  /**
   * SOAP mesajını belirtilen URL'ye gönderir ve sonucu döndürür
   *
   * @param FiXmlReq $fiXmlReq SOAP isteği (XML ve parametreler)
   * @return Fdr İşlem sonucu
   */
  public static function execute(FiXmlReq $fiXmlReq): Fdr
  {
    $fdrMain = new Fdr();

    try {
      // SOAP envelope'ı oluştur ve gönder
      $xmlContent = $fiXmlReq->getXmlFinal();
      $url = $fiXmlReq->txBaseUrl;

      // XML'nin geçerli olduğunu kontrol et
      $xmlDoc = new DOMDocument();
      if (!$xmlDoc->loadXML($xmlContent)) {
        $fdrMain->setBoResult(false);
        $fdrMain->setMessage("Invalid XML content.");
        return $fdrMain;
      }

      // HTTP isteğini oluştur ve gönder
      $response = self::sendHttpRequest($xmlContent, $url);

      if ($response === null) {
        $fdrMain->setBoResult(false);
        $fdrMain->setMessage("Response is null.");
        return $fdrMain;
      }

      // Yanıtı işle
      $fdrMain->setBoResult(true);
      $fdrMain->setRefValue($response['body']);
      $fdrMain->lnResponseCode = $response['statusCode'];

      if ($response['statusCode'] >= 400) {
        $fdrMain->setBoResult(false);
        $fdrMain->setMessage("HTTP Error: " . $response['statusCode']);
      }

      return $fdrMain;

    } catch (Exception $ex) {
      FiAppConfig::$fiLog?->error($ex->getMessage());
      FiAppConfig::$fiLog?->error($ex->getTraceAsString());
      $fdrMain->setBoResult(false);
      $fdrMain->setMessage($ex->getMessage());
      return $fdrMain;
    }
  }

  /**
   * String tabanlı SOAP mesajı gönderir
   *
   * @param string $xmlContent SOAP XML içeriği
   * @param string $url Hedef URL
   * @return Fdr İşlem sonucu
   */
  public static function executeString(string $xmlContent, string $url): Fdr
  {
    $fdrMain = new Fdr();

    try {
      // XML'nin geçerli olduğunu kontrol et
      $xmlDoc = new DOMDocument();
      if (!$xmlDoc->loadXML($xmlContent)) {
        $fdrMain->setBoResult(false);
        $fdrMain->setMessage("Invalid XML content.");
        return $fdrMain;
      }

      // HTTP isteğini oluştur ve gönder
      $response = self::sendHttpRequest($xmlContent, $url);

      if ($response === null) {
        $fdrMain->setBoResult(false);
        $fdrMain->setMessage("Response is null.");
        return $fdrMain;
      }

      // Yanıtı işle
      $fdrMain->setBoResult(true);
      $fdrMain->setRefValue($response['body']);
      $fdrMain->lnResponseCode = $response['statusCode'];

      if ($response['statusCode'] >= 400) {
        $fdrMain->setBoResult(false);
        $fdrMain->setMessage("HTTP Error: " . $response['statusCode']);
      }

      return $fdrMain;

    } catch (Exception $ex) {
      FiAppConfig::$fiLog?->error($ex->getMessage());
      FiAppConfig::$fiLog?->error($ex->getTraceAsString());
      $fdrMain->setBoResult(false);
      $fdrMain->setMessage($ex->getMessage());
      return $fdrMain;
    }
  }

  /**
   * HTTP POST isteği gönderir ve yanıtı döndürür
   *
   * @param string $xmlContent XML içeriği
   * @param string $url Hedef URL
   * @return array|null ['body' => string, 'statusCode' => int] veya null
   */
  private static function sendHttpRequest(string $xmlContent, string $url): ?array
  {
    try {
      $ch = curl_init($url);

      if ($ch === false) {
        return null;
      }

      // CURL seçeneklerini ayarla
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlContent);
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: text/xml; charset=utf-8',
        'Accept: text/xml',
        'Content-Length: ' . strlen($xmlContent)
      ]);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

      // İsteği gönder
      $response = curl_exec($ch);
      $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      $error = curl_error($ch);

      curl_close($ch);

      if ($error) {
        FiAppConfig::$fiLog?->error("CURL Error: " . $error);
        return null;
      }

      if ($response === false) {
        return null;
      }

      return [
        'body' => $response,
        'statusCode' => $statusCode
      ];

    } catch (Exception $ex) {
      FiAppConfig::$fiLog?->error($ex->getMessage());
      return null;
    }
  }

  /**
   * XML'e namespace ekler
   *
   * @param string $xml XML içeriği
   * @param string $prefix Namespace prefix (örn: "ws")
   * @param string $namespace Namespace URI (örn: "http://example.com/")
   * @return string Namespace'li XML
   */
  public static function addNamespace(string $xml, string $prefix = "ws", string $namespace = "http://example.com/"): string
  {
    try {
      $xmlDoc = new DOMDocument();
      if (!$xmlDoc->loadXML($xml)) {
        return $xml;
      }

      $root = $xmlDoc->documentElement;
      $tempRoot = $xmlDoc->createElementNS($namespace, $prefix . ":Request");

      // Orijinal root'un tüm çocuklarını yeni root'a taşı
      while ($root->firstChild) {
        $tempRoot->appendChild($root->removeChild($root->firstChild));
      }

      $xmlDoc->replaceChild($tempRoot, $root);

      return $xmlDoc->saveXML();

    } catch (Exception $ex) {
      FiAppConfig::$fiLog?->error($ex->getMessage());
      return $xml;
    }
  }

  /**
   * XML'e SOAP envelope ekler
   *
   * @param string $data İç XML içeriği
   * @return string SOAP envelope'lı XML
   */
  public static function appendEnvelope(string $data): string
  {
    $envelope = <<<XML
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
  <soapenv:Header/>
  <soapenv:Body>
    $data
  </soapenv:Body>
</soapenv:Envelope>
XML;
    return $envelope;
  }

  /**
   * SOAP yanıtını decode eder (escaped karakterleri çözer)
   *
   * @param string $soapResponse SOAP yanıtı
   * @return string Decode edilmiş yanıt
   */
  public static function decodeSoapResponse(string $soapResponse): string
  {
    // BOM (Byte Order Mark) karakterini kaldır
    $response = preg_replace('/^\xEF\xBB\xBF/', '', $soapResponse);

    // Escaped karakterleri decode et
    $response = html_entity_decode($response, ENT_QUOTES | ENT_XML1, 'UTF-8');

    return trim($response);
  }

  /**
   * SOAP hatasını XML yanıtından çıkar
   *
   * @param string $soapResponse SOAP yanıtı
   * @return string|null Hata mesajı veya null
   */
  public static function extractSoapFault(string $soapResponse): ?string
  {
    try {
      $xmlDoc = new DOMDocument();
      $xmlDoc->preserveWhiteSpace = false;

      // XML'i yükle (escaped karakterleri ele al)
      if (!@$xmlDoc->loadXML($soapResponse)) {
        return null;
      }

      // SOAP fault'u ara
      $faultElements = $xmlDoc->getElementsByTagName('Fault');

      if ($faultElements->length === 0) {
        return null;
      }

      $faultString = $xmlDoc->getElementsByTagName('faultstring');
      if ($faultString->length > 0) {
        return $faultString->item(0)->nodeValue;
      }

      return null;

    } catch (Exception $ex) {
      FiAppConfig::$fiLog?->error($ex->getMessage());
      return null;
    }
  }
}



// class FiSoap
// {
//   public static function Execute(FiXmlReq fiXmlReq): Fdr
//         {
//             Fdr fdrMain = new Fdr();

//             try
//             {
//                 HttpWebRequest request = CreateWebRequest(fiXmlReq.txBaseUrl);
//                 //request.ContentType = "text/xml;charset=\"utf-8\"";
//                 XmlDocument soapEnvelopeXml = new XmlDocument();
//                 soapEnvelopeXml.LoadXml(fiXmlReq.GetXmlFinal()); //AddNamespace(txXmlContent) //txXmlContent
//                 //FiAppConfig.fiLogManager?.LogMessage(fiXmlReq.txXml);
//                 //FiAppConfig.fiLogManager?.LogMessage(fiXmlReq.txBaseUrl);

//                 using (Stream stream = request.GetRequestStream())
//                 {
//                     soapEnvelopeXml.Save(stream);
//                 }

//                 //request.Method = "GET";
//                 using (HttpWebResponse response = (HttpWebResponse) request.GetResponse())
//                 {
//                     Stream responseStream = response.GetResponseStream();
//                     if (responseStream == null)
//                     {
//                         fdrMain.SetBoExecAndResultFalse();
//                         fdrMain.txMessage = "Response stream is null.";
//                         return fdrMain;
//                     }

//                     using (StreamReader rd = new StreamReader(responseStream))
//                     {
//                         string soapResult = rd.ReadToEnd();
//                         // 1. Escape edilmiş yanıtı decode et
//                         //string decodedSoapResult = WebUtility.HtmlDecode(soapResult);

//                         // Eğer BOM (Byte Order Mark) karakterinden şüpheleniyorsanız:
//                         //decodedSoapResponse = decodedSoapResponse.Replace("\uFEFF", "").Trim();

//                         fdrMain.txResponse = soapResult; //decodedSoapResult.Trim();

//                         //FiAppConfig.fiLogManager?.LogMessage("[Response XML Start]");
//                         //FiAppConfig.fiLogManager?.LogMessage($"[{fdrMain.txResponse}]");
//                         //FiAppConfig.fiLogManager?.LogMessage("[Response XML End]");

//                         //Console.WriteLine(soapResult);
//                         //FiAppConfig.fiLogManager?.LogMessage(soapResult);

//                         int statusCode = (int)response.StatusCode;
//                         fdrMain.lnStatusCode = statusCode;
//                         fdrMain.boExecution = true;
//                         //Console.WriteLine($"HTTP Durum Kodu: {statusCode}");
//                     }

//                 }
//             }
//             catch (Exception ex)
//             {
//                 FiAppConfig.fiLog?.Error(ex.Message);
//                 FiAppConfig.fiLog?.Error(ex.ToString());
//                 fdrMain.txMessage = ex.Message;
//                 fdrMain.SetBoExecAndResultFalse();
//             }

//             return fdrMain;
//         }


//         private static HttpWebRequest CreateWebRequest(string url)
//         {
//             //string url = "";
//             HttpWebRequest webRequest = null;

//             try
//             {
//                 webRequest = (HttpWebRequest)WebRequest.Create(url);
//                 //webRequest.Headers.Add(@"SOAPAction","LoginRequest");
//                 webRequest.ContentType = "text/xml;charset=\"utf-8\"";
//                 webRequest.Accept = "text/xml";
//                 webRequest.Method = "POST";
//             }
//             catch (Exception ex)
//             {
//                 FiAppConfig.fiLog?.Debug(ex.Message);
//                 FiAppConfig.fiLog?.Debug(ex.ToString());
//             }
//             return webRequest;
//         }

//         private static string AddNamespace(string XML)
//         {
//             string result = string.Empty;
//             try
//             {
//                 XmlDocument xdoc = new XmlDocument();
//                 xdoc.LoadXml(XML);

//                 XmlElement temproot = xdoc.CreateElement("ws", "Request", "http://example.com/");
//                 temproot.InnerXml = xdoc.DocumentElement.InnerXml;
//                 result = temproot.OuterXml;

//             }
//             catch (Exception ex)
//             {
//                 Console.WriteLine(ex);
//             }

//             return result;
//         }

//         private static string AppendEnvelope(string data)
//         {
//             string txHead = @"<soapenv:Envelope xmlns:soapenv=""http://schemas.xmlsoap.org/soap/envelope/"" ><soapenv:Header/><soapenv:Body>";
//             string txEnd = @"</soapenv:Body></soapenv:Envelope>";
//             return txHead + data + txEnd;
//         }

//         // Execute2
//         public static Fdr Execute2(string txXmlContent,string txUrl)
//         {
//             Fdr fdrMain = new Fdr();

//             try
//             {
//                 HttpWebRequest request = CreateWebRequest(txUrl);
//                 XmlDocument soapEnvelopeXml = new XmlDocument();
//                 soapEnvelopeXml.LoadXml(txXmlContent); //AddNamespace(txXmlContent) //txXmlContent

//                 using (Stream stream = request.GetRequestStream())
//                 {
//                     soapEnvelopeXml.Save(stream);
//                 }

//                 //request.Method = "GET";
//                 using (HttpWebResponse response = (HttpWebResponse) request.GetResponse())
//                 {

//                     Stream responseStream = response.GetResponseStream();
//                     if (responseStream == null)
//                     {
//                         //throw new InvalidOperationException("Response stream is null.");
//                         fdrMain.boExecution = false;
//                         fdrMain.txMessage = "Response stream is null.";
//                         return fdrMain;
//                     }

//                     using (StreamReader rd = new StreamReader(responseStream))
//                     {
//                         string soapResult = rd.ReadToEnd();
//                         fdrMain.txResponse = soapResult;
//                         Console.WriteLine(soapResult);

//                         int statusCode = (int)response.StatusCode;
//                         fdrMain.lnStatusCode = statusCode;
//                         fdrMain.boExecution = true;
//                         Console.WriteLine($"HTTP Durum Kodu: {statusCode}");
//                     }

//                 }
//             }
//             catch (Exception ex)
//             {
//                 Console.WriteLine(ex);
//                 fdrMain.txMessage = ex.Message;
//                 fdrMain.boExecution = false;
//             }

//             return fdrMain;
//         }


//     }//end class