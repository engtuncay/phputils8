<?php

namespace Engtuncay\Phputils8\FiXmls;

use DateTime;
use Engtuncay\Phputils8\FiCores\FiStrbui;
use Engtuncay\Phputils8\FiCores\FiString;
use Engtuncay\Phputils8\FiDto\FiKeybean;
use Engtuncay\Phputils8\FiDto\FkbList;


class FiXmlUtil
{

  public static function convertXmlParams(string $txXml, FiKeybean $fkbParams): string
  {
    if (
      FiString::isEmpty($txXml)
      || $fkbParams == null
      || $fkbParams->count() == 0
    ) return $txXml;


    //foreach (var key in $fkbParams->getArr() .Keys)
    foreach ($fkbParams->getArr() as $key => $objValue) {
      //string 
      $placeholder = "{{$key}}"; // Şablondaki büyük parantezler
      //string 
      $value = "";

      //object 
      //$objValue = $fkbParams->getValue($key);

      //FiAppConfig.fiLogManager?.LogMessage(objValue.GetType().ToString());

      /** @var mixed $objValue */
      if (is_object($objValue) && is_a($objValue, 'Engtuncay\Phputils8\FiDto\FkbList')) //$fkbListChild
      {

        if (!self::containsTemplateKey($txXml, $key)) {
          continue;
        }

        //FiStrbui 
        $sbChild = new FiStrbui(); // StringBuilder();

        // 
        foreach ($objValue as $fkbChild) //FiKeybean fkbChild in fkbListChild
        {
          //string  // temp-commented:
          //$convertXmlParams = self::convertXmlParams($objValue->txTemplate, $fkbChild);
          //$sbChild->Append($convertXmlParams);
        }

        //fkbListChildElem.txValue = sbChild.ToString();
        $value = $sbChild->ToString(); //fkbListChild.txValue;
      } else if ($objValue instanceof DateTime) //$dtValue
      {
        //$dtValue = $objValue;
        $value = $objValue->format("c"); // O olursa milisecond lı oluyor

      } else if ($objValue instanceof bool) {
        $value = $fkbParams->getValue($key); //->ToLower();
      }
      // else if (objValue is JValue jsonValue)
      // {
      //   if (jsonValue.Type == JTokenType.Boolean)
      //   {
      //     value = fkbParams.GetAsString(key).ToLower();
      //   }
      //   else
      //   {
      //     $value = $fkbParams->GetAsString($key) ?? "";
      //   }
      // }
      else {
        //temp-commented:
        //$value = $fkbParams->GetAsString($key) ?? ""; // Anahtara karşılık gelen değeri al
      }

      // Şablondaki placeholder'ları değerle değiştir
      $txXml = str_replace($placeholder, $value, $txXml);
    }

    return ""; //txXmlTemp; // Güncellenmiş metni döndür
  }

  public static function prepFkbParams(string $txXmlTemp, FiKeybean $fkbParams): string
  {
    //$keys = $fkbParams->Keys->ToList(); // Keys'i geçici bir listeye kopyalıyoruz

    // Değerler ile ilgili düzeltmeler
    foreach ($fkbParams->getArr() as $key => $objValue) {
      //$objValue = $fkbParams->getValue($key);

      // JArray FkbList'e çevrilir, objValue FkbList olur
      // if ($objValue instanceof JArray) //$jarrList
      // {
      //   $fkbListConverted = FiJArray::convertFkbList($jarrList);
      //   $fkbParams->addOverWrite($key, $fkbListConverted); // Orijinal koleksiyona ekleme yapabilirsiniz
      //   $objValue = $fkbListConverted;
      // }

      // Template Block varsa fkbListChild'a eklenir
      if ( $objValue instanceof FkbList) //$fkbListChild
      {
        /** @var FkbList $fkbListChild */
        $fkbListChild = $objValue;

        $containsTemplateBlock = self::containsTemplateBlock($txXmlTemp, $key);

        //FiAppConfig.fiLogManager?.LogMessage("containsTemplateBlock:"+containsTemplateBlock + " key:" + key);

        if ($containsTemplateBlock) {
          list($txXmlNew, $txXmlExtracted) = self::processChildFkbList($txXmlTemp, $key);
          $txXmlTemp = $txXmlNew;
          $fkbListChild->txTemplate = $txXmlExtracted;
        }
        //continue;
      }
    }
    
    
    //   object objValue = fkbParams.GetAsObject(key);

    //   // JArray FkbList'e çevrilir, objValue FkbList olur
    //   if (objValue is JArray jarrList)
    //   {
    //     var fkbListConverted = FiJArray.ConvertFkbList(jarrList);
    //     fkbParams.AddOverWrite(key, fkbListConverted); // Orijinal koleksiyona ekleme yapabilirsiniz
    //     objValue = fkbListConverted;
    //   }

    //   // Template Block varsa fkbListChild'a eklenir
    //   if (objValue is FkbList fkbListChild)
    //   {
    //     bool containsTemplateBlock = self::containsTemplateBlock(txXmlTemp, key);

    //     //FiAppConfig.fiLogManager?.LogMessage("containsTemplateBlock:"+containsTemplateBlock + " key:" + key);

    //     if (containsTemplateBlock)
    //     {
    //       (string txXmlNew, string txXmlExtracted) = ProcessChildFkbList(txXmlTemp, key);
    //       txXmlTemp = txXmlNew;
    //       fkbListChild.txTemplate = txXmlExtracted;
    //     }
    //     //continue;
    //   }

    


    return $txXmlTemp;
  }

  //(string txXmlNew, string txXmlExtracted)
  public static function processChildFkbList(string $txXml, string $key): array
  {
    // Regex deseni: <!--!psgRfSipSatirList--> ile <!--!psgRfSipSatirList--> arasındaki içeriği yakalar
    //string 
    $pattern = "<!--!{$key}-->(.*?)<!--!{$key}-->";

    // İçeriği yakala ve değiştir
    //string 
    $txXmlExtracted = "";
    //string 
    // $txXmlNew = Regex.Replace($txXml, $pattern, match =>
    // {
    //   $txXmlExtracted = match.Groups[1].Value; // Aradaki içeriği al
    //   return "{{" + $key + "}}"; // {{key}} olarak değiştir
    // }, RegexOptions.Singleline);

    return []; // new Array_($txXmlNew, $txXmlExtracted); // Hem değiştirilmiş XML'i hem de bulunan içerik döndürülür
  }

  public static function deActivateAllParams(string $txXml)
  {
    //"--!(\\w+).*\\s*.*"; // @ verbatim operatörü eklenince ikinci slashlar kaldırılır
    $regex = "/.*\{\{(.*?)\}\}.*\n/"; // 20250426
    $subst = "<!--$1 deactive-->\n";
    return preg_replace($regex, $subst, $txXml);
  }

  public static function deActivateParam(string $txXml, string $key)
  {
    $regex = "/.*\{\{($key)\}\}.*?\n/"; // 20250426
    $subst = "<!--$1 deactive-->\n";
    return preg_replace($regex, $subst, $txXml);
  }


  /// <summary>
  /// Verilen string içinde {{key}} formatında bir yapı olup olmadığını kontrol eder.
  /// </summary>
  /// <param name="txXml">Kontrol edilecek metin.</param>
  /// <returns>True, eğer {{key}} yapısı varsa; aksi halde False.</returns>
  // public static bool ContainsTemplateKeyAny(string txXml)
  // {
  //   if (String.IsNullOrEmpty(txXml)) return false;

  //   // {{key}} formatını kontrol eden regex
  //   var regex = new Regex(@"\{\{.+?\}\}");
  //   return regex.IsMatch(txXml);
  // }

  public static function containsTemplateBlock(string $txXml, string $txBlockName): bool
  {
    if (FiString::isEmpty($txXml)) return false;
    if (FiString::isEmpty($txBlockName)) return false;

    //var regex = new Regex(@"\{\{.+?\}\}");

    //, RegexOptions::Singleline);
    $regex = "/<!--!{$txBlockName}-->(.*?)<!--!{$txBlockName}-->/";

    return preg_match($regex, $txXml) === 1;
  }

  /**
   * Verilen string içinde {{$txKey}} formatında bir yapı olup olmadığını kontrol eder.
   * 
   * @param string $txTemplate 
   * @param string $txKey 
   * @return bool 
   */
  public static function containsTemplateKey(string $txTemplate, string $txKey): bool
  {
    if (FiString::isEmpty($txTemplate)) return false;

    // {{key}} formatını kontrol eden regex
    $regex = "/\{\{$txKey\}\}/";
    return preg_match($regex, $txTemplate) === 1;
  }

  /// <summary>
  /// XML içinde sık kullanılan escape edilmiş karakterleri çözmek için bir yardımcı yöntem
  /// </summary>
  // public static string ReplaceEscapedCharacters(string txXml)
  // {
  //   return txXml
  //     .Replace("&lt;", "<")
  //     .Replace("&gt;", ">")
  //     .Replace("&amp;", "&")
  //     .Replace("&apos;", "'")
  //     .Replace("&quot;", "\"");
  //   //.Replace("\n", "");
  // }


}



// public static class FiRegex
// {
//     /// <summary>
//     /// Verilen string içinde {{key}} formatında bir yapı olup olmadığını kontrol eder.
//     /// </summary>
//     /// <param name="txTemplate">Kontrol edilecek metin.</param>
//     /// <param name="txKey">Aranılan Key Değer</param>
//     /// <returns>True, eğer {{key}} yapısı varsa; aksi halde False.</returns>
//     public static bool ContainsTemplateKey(string txTemplate, string txKey)
//     {
//         if (string.IsNullOrEmpty(txTemplate))
//             return false;
//
//         // Escape special characters in txKey to ensure it's treated as a literal.
//         string escapedKey = Regex.Escape(txKey);
//
//         // Build the regex to match the template key.
//         var regex = new Regex(@"\{\{" + escapedKey + @"\}\}");
//         return regex.IsMatch(txTemplate);
//     }
// }