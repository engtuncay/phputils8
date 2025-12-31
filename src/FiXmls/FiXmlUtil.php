<?php

namespace Engtuncay\Phputils8\FiXmls;

use DateTime;
use Engtuncay\Phputils8\FiCores\FiStrbui;
use Engtuncay\Phputils8\FiCores\FiString;
use Engtuncay\Phputils8\FiDtos\FiKeybean;
use Engtuncay\Phputils8\FiDtos\FkbList;


class FiXmlUtil
{

  /**
   * XML template içindeki {{key}} formatındaki placeholder'ları değerlerle değiştirir
   */
  public static function convertXmlParams(string $txXmlTemp, FiKeybean $fkbParams = null): string
  {
    if (FiString::isEmpty($txXmlTemp) || $fkbParams === null || $fkbParams->count() == 0) {
      return $txXmlTemp;
    }

    foreach ($fkbParams as $key => $objValue) {
      $placeholder = "{{" . $key . "}}";
      $value = "";

      //$objValue = $fkbParams->getAsObject($key);

      if ($objValue instanceof FkbList) {
        if (!self::containsTemplateKey($txXmlTemp, $key)) {
          continue;
        }

        $sbChild = "";

        foreach ($objValue as $fkbChild) {
          $convertXmlParams = self::convertXmlParams($objValue->txTemplate, $fkbChild);
          $sbChild .= $convertXmlParams;
        }

        $value = $sbChild;
      } elseif ($objValue instanceof DateTime) {
        $value = $objValue->format("c");
      } elseif (is_bool($objValue)) {
        $value = strtolower($objValue); //$fkbParams->getAsString($key)
      } else {
        $value = $objValue ?? "";
      }

      $txXmlTemp = str_replace($placeholder, $value, $txXmlTemp);
    }

    return $txXmlTemp;
  }

  /**
   * FiKeybean parametrelerini hazırlar ve template block'larını işler
   */
  public static function prepFkbParams(string $txXmlTemp, FiKeybean $fkbParams): string
  {
    //$keys = $fkbParams->getKeys();

    foreach ($fkbParams as $key => $objValue) {

      if ($objValue instanceof FkbList) {
        $containsTemplateBlock = self::containsTemplateBlock($txXmlTemp, $key);

        if ($containsTemplateBlock) {
          [$txXmlNew, $txXmlExtracted] = self::processChildFkbList($txXmlTemp, $key);
          $txXmlTemp = $txXmlNew;
          $objValue->txTemplate = $txXmlExtracted;
        }
      }
    }

    return $txXmlTemp;
  }

  /**
   * XML içinde <!--!key--> ile <!--!key--> arasındaki içeriği çıkarır ve {{key}} ile değiştirir
   * 
   * @return array [$txXmlNew, $txXmlExtracted]
   */
  public static function processChildFkbList(string $txXml, string $key): array
  {
    $escapedKey = preg_quote($key);
    $pattern = "/<!--!{$escapedKey}-->(.*?)<!--!{$escapedKey}-->/s";

    $txXmlExtracted = "";
    $txXmlNew = preg_replace_callback(
      $pattern,
      function ($match) use (&$txXmlExtracted, $key) {
        $txXmlExtracted = $match[1];
        return "{{" . $key . "}}";
      },
      $txXml
    );

    return [$txXmlNew, $txXmlExtracted];
  }

  /**
   * XML içindeki tüm {{key}} placeholder'larını <!--key deactive--> ile değiştirir
   */
  public static function deActivateAllParams(string $txXml): string
  {
    $pattern = '/.*\{\{(.*?)\}\}.*\n/';
    $subst = "<!--\$1 deactive-->\n";
    return preg_replace($pattern, $subst, $txXml);
  }

  /**
   * XML içindeki belirli {{key}} placeholder'ını <!--key deactive--> ile değiştirir
   */
  public static function deActivateParam(string $txXml, string $key): string
  {
    $escapedKey = preg_quote($key);
    $pattern = '/.*\{\{(' . $escapedKey . ')\}\}.*?\n/';
    $subst = "<!--\$1 deactive-->\n";
    return preg_replace($pattern, $subst, $txXml);
  }

  /**
   * Verilen string içinde {{key}} formatında herhangi bir yapı olup olmadığını kontrol eder
   */
  public static function containsTemplateKeyAny(string $txXml): bool
  {
    if (empty($txXml)) {
      return false;
    }
    return preg_match('/\{\{.+?\}\}/', $txXml) === 1;
  }

  /**
   * Verilen string içinde <!--!blockName--> ile <!--!blockName--> arasında bir blok olup olmadığını kontrol eder
   */
  public static function containsTemplateBlock(string $txXml, string $txBlockName): bool
  {
    if (empty($txXml) || empty($txBlockName)) {
      return false;
    }
    $escapedBlockName = preg_quote($txBlockName);
    $pattern = "/<!--!{$escapedBlockName}-->(.*?)<!--!{$escapedBlockName}-->/s";
    return preg_match($pattern, $txXml) === 1;
  }

  /**
   * Verilen string içinde {{key}} formatında bir yapı olup olmadığını kontrol eder
   */
  public static function containsTemplateKey(string $txTemplate, string $txKey): bool
  {
    if (empty($txTemplate)) {
      return false;
    }
    $escapedKey = preg_quote($txKey);
    $pattern = '/\{\{' . $escapedKey . '\}\}/';
    return preg_match($pattern, $txTemplate) === 1;
  }

  /**
   * XML içinde sık kullanılan escape edilmiş karakterleri çözmek için bir yardımcı yöntem
   */
  public static function replaceEscapedCharacters(string $txXml): string
  {
    return str_replace(
      ["&lt;", "&gt;", "&amp;", "&apos;", "&quot;"],
      ["<", ">", "&", "'", "\""],
      $txXml
    );
  }
}

// using Newtonsoft.Json.Linq;
// using OrakYazilimLib.Util.Collection;
// using OrakYazilimLib.Util.core;
// using System;
// using System.Text;
// using System.Text.RegularExpressions;
// using System.Linq;

// namespace OrakYazilimLib.UtilXml
// {
//   public static class FiXmlUtil
//   {

//     public static string ConvertXmlParams(string txXmlTemp, FiKeybean fkbParams)
//     {
//       if (FiString.IsEmpty(txXmlTemp) || fkbParams == null || fkbParams.Count == 0
//         // template key yoksa, değiştirilecek bir şey yok
//         //|| !FiXmlUtils.ContainsTemplateKey(txXmlTemp)
//       )
//         return txXmlTemp;

//       //
//       foreach (var key in fkbParams.Keys)
//       {
//         string placeholder = "{{" + key + "}}"; // Şablondaki büyük parantezler
//         string value = "";

//         object objValue = fkbParams.GetAsObject(key);

//         //FiAppConfig.fiLogManager?.LogMessage(objValue.GetType().ToString());


//         if (objValue is FkbList fkbListChild)
//         {
//           if (!ContainsTemplateKey(txXmlTemp, key))
//           {
//             continue;
//           }

//           StringBuilder sbChild = new StringBuilder();

//           foreach (FiKeybean fkbChild in fkbListChild)
//           {
//             string convertXmlParams = ConvertXmlParams(fkbListChild.txTemplate, fkbChild);
//             sbChild.Append(convertXmlParams);
//           }

//           //fkbListChildElem.txValue = sbChild.ToString();
//           value = sbChild.ToString(); //fkbListChild.txValue;

//         }
//         else if (objValue is DateTime dtValue)
//         {
//           value = dtValue.ToString("s"); // O olursa milisecond lı oluyor
//         }
//         else if (objValue is bool)
//         {
//           value = fkbParams.GetAsString(key).ToLower();
//         }
//         else if (objValue is JValue jsonValue)
//         {
//           if (jsonValue.Type == JTokenType.Boolean)
//           {
//             value = fkbParams.GetAsString(key).ToLower();
//           }
//           else
//           {
//             value = fkbParams.GetAsString(key) ?? string.Empty;
//           }
//         }
//         else
//         {
//           value = fkbParams.GetAsString(key) ?? string.Empty; // Anahtara karşılık gelen değeri al
//         }

//         // Şablondaki placeholder'ları değerle değiştir
//         txXmlTemp = txXmlTemp.Replace(placeholder, value);

//       }

//       return txXmlTemp; // Güncellenmiş metni döndür
//     }

//     public static string PrepFkbParams(string txXmlTemp, FiKeybean fkbParams)
//     {
//       var keys = fkbParams.Keys.ToList(); // Keys'i geçici bir listeye kopyalıyoruz

//       // Değerler ile ilgili düzeltmeler
//       foreach (var key in keys)
//       {
//         object objValue = fkbParams.GetAsObject(key);

//         // JArray FkbList'e çevrilir, objValue FkbList olur
//         if (objValue is JArray jarrList)
//         {
//           var fkbListConverted = FiJArray.ConvertFkbList(jarrList);
//           fkbParams.AddOverWrite(key, fkbListConverted); // Orijinal koleksiyona ekleme yapabilirsiniz
//           objValue = fkbListConverted;
//         }

//         // Template Block varsa fkbListChild'a eklenir
//         if (objValue is FkbList fkbListChild)
//         {
//           bool containsTemplateBlock = ContainsTemplateBlock(txXmlTemp, key);

//           //FiAppConfig.fiLogManager?.LogMessage("containsTemplateBlock:"+containsTemplateBlock + " key:" + key);

//           if (containsTemplateBlock)
//           {
//             (string txXmlNew, string txXmlExtracted) = ProcessChildFkbList(txXmlTemp, key);
//             txXmlTemp = txXmlNew;
//             fkbListChild.txTemplate = txXmlExtracted;
//           }
//           //continue;
//         }

//       }

//       return txXmlTemp;
//     }

//     public static (string txXmlNew, string txXmlExtracted) ProcessChildFkbList(string txXml, string key)
//     {
//       // Regex deseni: <!--!psgRfSipSatirList--> ile <!--!psgRfSipSatirList--> arasındaki içeriği yakalar
//       string pattern = $"<!--!{key}-->(.*?)<!--!{key}-->";

//       // İçeriği yakala ve değiştir
//       string txXmlExtracted = "";
//       string txXmlNew = Regex.Replace(txXml, pattern, match =>
//       {
//         txXmlExtracted = match.Groups[1].Value; // Aradaki içeriği al
//         return "{{" + key + "}}"; // {{key}} olarak değiştir
//       }, RegexOptions.Singleline);

//       return (txXmlNew, txXmlExtracted); // Hem değiştirilmiş XML'i hem de bulunan içerik döndürülür
//     }

//     public static string DeActivateAllParams(string txXml)
//     {
//       //"--!(\\w+).*\\s*.*"; // @ verbatim operatörü eklenince ikinci slashlar kaldırılır
//       const string regex = @".*\{\{(.*?)\}\}.*\n"; // 20250426
//       const string subst = "<!--$1 deactive-->\n";
//       return Regex.Replace(txXml, regex, subst);
//     }

//     public static string DeActivateParam(string txXml, string key)
//     {
//       string regex = @".*\{\{(" + key + @")\}\}.*?\n"; // 20250426
//       const string subst = "<!--$1 deactive-->\n";
//       return Regex.Replace(txXml, regex, subst);
//     }


//     /// <summary>
//     /// Verilen string içinde {{key}} formatında bir yapı olup olmadığını kontrol eder.
//     /// </summary>
//     /// <param name="txXml">Kontrol edilecek metin.</param>
//     /// <returns>True, eğer {{key}} yapısı varsa; aksi halde False.</returns>
//     public static bool ContainsTemplateKeyAny(string txXml)
//     {
//       if (String.IsNullOrEmpty(txXml)) return false;

//       // {{key}} formatını kontrol eden regex
//       var regex = new Regex(@"\{\{.+?\}\}");
//       return regex.IsMatch(txXml);
//     }

//     public static bool ContainsTemplateBlock(string txXml, string txBlockName)
//     {
//       if (String.IsNullOrEmpty(txXml)) return false;
//       if (String.IsNullOrEmpty(txBlockName)) return false;

//       //var regex = new Regex(@"\{\{.+?\}\}");
//       var regex = new Regex($"<!--!{txBlockName}-->(.*?)<!--!{txBlockName}-->", RegexOptions.Singleline);
//       return regex.IsMatch(txXml);
//     }

//     /// <summary>
//     /// Verilen string içinde {{key}} formatında bir yapı olup olmadığını kontrol eder.
//     /// </summary>
//     /// <param name="txTemplate">Kontrol edilecek metin.</param>
//     /// <param name="txKey">Aranılan Key Değer</param>
//     /// <returns>True, eğer {{key}} yapısı varsa; aksi halde False.</returns>
//     public static bool ContainsTemplateKey(string txTemplate, string txKey)
//     {
//       if (string.IsNullOrEmpty(txTemplate))
//         return false;

//       // {{key}} formatını kontrol eden regex
//       var regex = new Regex(@"\{\{" + txKey + @"\}\}");
//       return regex.IsMatch(txTemplate);
//     }

//     /// <summary>
//     /// XML içinde sık kullanılan escape edilmiş karakterleri çözmek için bir yardımcı yöntem
//     /// </summary>
//     public static string ReplaceEscapedCharacters(string txXml)
//     {
//       return txXml
//         .Replace("&lt;", "<")
//         .Replace("&gt;", ">")
//         .Replace("&amp;", "&")
//         .Replace("&apos;", "'")
//         .Replace("&quot;", "\"");
//       //.Replace("\n", "");
//     }


//   }

// }

// // public static class FiRegex
// // {
// //     /// <summary>
// //     /// Verilen string içinde {{key}} formatında bir yapı olup olmadığını kontrol eder.
// //     /// </summary>
// //     /// <param name="txTemplate">Kontrol edilecek metin.</param>
// //     /// <param name="txKey">Aranılan Key Değer</param>
// //     /// <returns>True, eğer {{key}} yapısı varsa; aksi halde False.</returns>
// //     public static bool ContainsTemplateKey(string txTemplate, string txKey)
// //     {
// //         if (string.IsNullOrEmpty(txTemplate))
// //             return false;
// //
// //         // Escape special characters in txKey to ensure it's treated as a literal.
// //         string escapedKey = Regex.Escape(txKey);
// //
// //         // Build the regex to match the template key.
// //         var regex = new Regex(@"\{\{" + escapedKey + @"\}\}");
// //         return regex.IsMatch(txTemplate);
// //     }
// // }