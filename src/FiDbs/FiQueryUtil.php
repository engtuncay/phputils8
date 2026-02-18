<?php

namespace Engtuncay\Phputils8\FiDbs;

use Engtuncay\Phputils8\FiCores\FiString;
use Engtuncay\Phputils8\FiCores\FiBool;
use Engtuncay\Phputils8\FiCores\FiCollection;
use Engtuncay\Phputils8\FiDtos\FiKeybean;

class FiQueryUtil
{
  /**
   * SQL parametresini deaktif eder
   * @param string $fieldName Alan adı
   * @param string $sql SQL sorgusu
   * @return string Deaktif edilmiş SQL
   */
  public static function deActivateSqlParam(string $fieldName, string $sql): string
  {
    if (!FiString::isEmpty($fieldName)) {
      $pattern = '/\n\s*.*@(' . preg_quote($fieldName) . ').*/';
      $sql = preg_replace($pattern, "\n-- $1 deactivated", $sql);
    }
    return $sql;
  }

  /**
   * SQL problemlerini düzeltir (yorum satırında @ varsa kaldırır)
   * @param string $sql SQL sorgusu
   * @return string Düzeltilmiş SQL
   */
  public static function fixSqlProblems(string $sql): string
  {
    $sql2 = preg_replace('/--(.*?)@(\w+)(.*)/i', '--fixed$1$2', $sql);
    return $sql2;
  }

  /**
   * Tekli parametreyi çoklu parametrelere çevirir (abc_1,abc_2 gibi)
   * @param string $txQuery SQL sorgusu
   * @param FiKeybean $mapParams Parametreler
   * @param string $param Parametre adı
   * @param array $listParamData Parametre değerleri dizisi
   * @param bool $boKeepOldParam Eski parametreyi saklasın mı?
   * @return string Dönüştürülmüş SQL sorgusu
   */
  public static function convertSingleParamToMultiParam(
    string $txQuery,
    FiKeybean $mapParams,
    string $param,
    array $listParamData,
    bool $boKeepOldParam = false
  ): string {
    $sbNewParamsForQuery = [];

    $index = 0;
    foreach ($listParamData as $paramVal) {
      $sablonParam = self::makeMultiParamTemplate($param, $index);
      if ($index !== 0) {
        $sbNewParamsForQuery[] = ',';
      }
      $sbNewParamsForQuery[] = '@' . $sablonParam;
      $mapParams->put($sablonParam, $paramVal);
      $index++;
    }

    $newParamsStr = implode('', $sbNewParamsForQuery);
    $pattern = '/@' . preg_quote($param) . '/';
    $sqlNew = preg_replace($pattern, $newParamsStr, $txQuery);

    if (!FiBool::isTrue($boKeepOldParam)) {
      $mapParams->remove($param);
    }

    return $sqlNew;
  }

  /**
   * Çoklu parametre şablonu oluşturur
   * @param string $param Parametre adı
   * @param int $index İndeks numarası
   * @return string Şablon adı (örn: param_0)
   */
  public static function makeMultiParamTemplate(string $param, int $index): string
  {
    return $param . '_' . $index;
  }

  /**
   * Liste parametrelerini çoklu parametrelere çevirir
   * @param string $txQuery SQL sorgusu
   * @param FiKeybean $mapParams Parametreler
   * @param bool $boKeepOldMultiParamInFkb Eski çoklu parametreyi saklasın mı?
   * @return string Dönüştürülmüş SQL sorgusu
   */
  public static function convertListParamToMultiParams(
    string $txQuery,
    FiKeybean $mapParams,
    bool $boKeepOldMultiParamInFkb = false
  ): string {
    if ($mapParams === null) {
      return $txQuery;
    }

    $listMultiParamsName = [];

    foreach ($mapParams->getArr() as $sqlParam => $value) {
      if (is_array($value)) {
        $listMultiParamsName[] = $sqlParam;
      }
    }

    $spQuery = $txQuery;

    foreach ($listMultiParamsName as $param) {
      $listParam = $mapParams->get($param);
      if (is_array($listParam)) {
        $spQuery = self::convertSingleParamToMultiParam(
          $spQuery,
          $mapParams,
          $param,
          $listParam,
          $boKeepOldMultiParamInFkb
        );
      }
    }

    return $spQuery;
  }

  /**
   * Opsiyonel parametreyi deaktif eder
   * @param string $sql SQL sorgusu
   * @param string $paramKey Parametre anahtarı
   * @return string Deaktif edilmiş SQL
   */
  public static function deActivateOptParamMain(string $sql, string $paramKey): string
  {
    $pattern = '/--!(' . preg_quote($paramKey) . ').*\s*.*/';
    $subst = '--$1 deactivated';
    return preg_replace($pattern, $subst, $sql);
  }

  /**
   * Opsiyonel parametreyi aktif eder
   * @param string $sql SQL sorgusu
   * @param string $paramKey Parametre anahtarı
   * @return string Aktif edilmiş SQL
   */
  public static function activateOptParamMain(string $sql, string $paramKey): string
  {
    $pattern = '/--!(' . preg_quote($paramKey) . ')\b.*\s*-*(.*)/';
    $subst = '--$1 activated' . "\n" . '$2';
    return preg_replace($pattern, $subst, $sql);
  }

  /**
   * Parametreleri aktif/deaktif eder
   * @param string $txQuery SQL sorgusu
   * @param FiKeybean $mapParams Parametreler
   * @param bool $boActivateOnlyFullParams Sadece dolu parametreleri aktif etsin mi?
   * @return string İşlem yapılmış SQL sorgusu
   */
  public static function activateParamsMain(
    string $txQuery,
    FiKeybean $mapParams,
    bool $boActivateOnlyFullParams = false
  ): string {
    $listParamsDeActivated = [];

    foreach ($mapParams->getArr() as $key => $value) {
      if (FiBool::isTrue($boActivateOnlyFullParams)) {
        $boCheckParamsEmpty = self::checkParamsEmpty($value);

        if (!FiBool::isTrue($boCheckParamsEmpty)) {
          $txQuery = self::activateOptParamMain($txQuery, $key);
        } else {
          $txQuery = self::deActivateOptParamMain($txQuery, $key);
          $listParamsDeActivated[] = $key;
        }
      } else {
        $txQuery = self::activateOptParamMain($txQuery, $key);
      }
    }

    foreach ($listParamsDeActivated as $deActivatedParam) {
      $mapParams->remove($deActivatedParam);
    }

    return $txQuery;
  }

  /**
   * Parametrenin boş olup olmadığını kontrol eder
   * @param mixed $value Kontrol edilecek değer
   * @return bool Boş ise true, dolu ise false
   */
  private static function checkParamsEmpty(mixed $value): bool
  {
    if ($value === null) {
      return true;
    }

    if (is_string($value)) {
      return FiString::isEmpty($value);
    }

    if (is_array($value) || $value instanceof \Countable) {
      return FiCollection::isEmpty($value);
    }

    return false;
  }

  /**
   * Null olmayan parametreleri aktif eder
   * @param string $txSqlValue SQL sorgusu
   * @param FiKeybean $fkbParams Parametreler
   * @return string İşlem yapılmış SQL sorgusu
   */
  public static function activateParamsNotNull(string $txSqlValue, FiKeybean $fkbParams): string
  {
    if ($fkbParams === null) {
      return $txSqlValue;
    }

    $listParamsWillDeactivate = [];

    foreach ($fkbParams->getArr() as $param => $value) {
      if ($value !== null) {
        $txSqlValue = self::activateOptParamMain($txSqlValue, $param);
      } else {
        $txSqlValue = self::deActivateOptParamMain($txSqlValue, $param);
        $listParamsWillDeactivate[] = $param;
      }
    }

    foreach ($listParamsWillDeactivate as $deActivatedParam) {
      $fkbParams->remove($deActivatedParam);
    }

    return $txSqlValue;
  }

  /**
   * Tüm opsiyonel parametreleri deaktif eder (--!optParam format)
   * @param string $sql SQL sorgusu
   * @return string Deaktif edilmiş SQL
   */
  public static function deActivateAllOptParams(string $sql): string
  {
    $pattern = '/--!(\w+).*\s*.*/';
    $subst = '--$1 deactivated';
    return preg_replace($pattern, $subst, $sql);
  }

  /**
   * SQL parametrelerini şablon değişkenleriyle değiştirir
   * @param string $prmTxSql SQL şablonu
   * @param array $prmArrParams Parametre değerleri
   * @return string Dönüştürülmüş SQL
   */
  public static function prepSqlParams(string $prmTxSql, array $prmArrParams): string
  {
    $txSqlFinal = $prmTxSql;

    foreach ($prmArrParams as $key => $value) {
      $placeholder = '{' . $key . '}';
      $txSqlFinal = str_replace($placeholder, (string)$value, $txSqlFinal);
    }

    return $txSqlFinal;
  }

  public static function convertSqlParamToNamedParamMainExcludable(string $sql): string
  {
    return preg_replace('/@(?!__)/', ':', $sql);
  }

}



// using OrakUtilDotNetCore.FiContainer;
// using OrakUtilDotNetCore.FiCore;

// namespace OrakUtilDotNetCore.FiOrm
// {
//   using Newtonsoft.Json.Linq;
//   using System;
//   using System.Collections.Generic;
//   using System.Linq;
//   using System.Text;
//   using System.Text.RegularExpressions;
//   using System.Threading.Tasks;
//   using System.Collections;
//   using System.Collections.ObjectModel;


//   public static class FiQueryUtils
//   {
//     //public FiQueryTools() {}

//     public static string DeActivateSqlParam(string fieldName, string sql)
//     {
//       if (!FiString.IsEmpty(fieldName))
//       {
//         sql = Regex.Replace(sql, @"\n\s*.*@(" + fieldName + ").*", "\n-- $1 deactivated");
//       }
//       return sql;
//     }

//     public static string FixSqlProblems(string sql)
//     {
//       // yorum satırların @ varsa # diyeze çevirir.
//       string sql2 = Regex.Replace(sql, @"--(.*?)@(\w+)(.*)", "--fixed$1$2"); // 23-12-22
//       return sql2;
//     }

// //     /**
// // Collection (List,Set) değerindeki parametreyi abc_1,abc_2 gibi multi parametreye çevirir
// //
// //  @param param
// //  @param collParamData
// // @param boKeepOldParam
// // */
//     /// <summary>
//     ///
//     /// </summary>
//     /// <param name="txQuery"></param>
//     /// <param name="mapParams"></param>
//     /// <param name="param"></param>
//     /// <param name="listParamData"></param>
//     /// <param name="boKeepOldParam"></param>
//     /// <returns></returns>
//     public static string ConvertSingleParamToMultiParam(string txQuery, FiKeybean mapParams, String param, IList listParamData, bool boKeepOldParam)
//     {

//       // (1) şablona göre yeni eklenecek parametre listesi
//       // FiKeybean paramsNew = new FiKeybean();
//       StringBuilder sbNewParamsForQuery = new StringBuilder();

//       int index = 0;
//       foreach (var paramVal in listParamData) //for (Object listDatum : collParamData)
//       {
//         string sablonParam = MakeMultiParamTemplate(param, index);
//         if (index != 0) sbNewParamsForQuery.Append(",");
//         sbNewParamsForQuery.Append("@" + sablonParam);
//         //paramsNew.Add(sablonParam, paramVal);
//         mapParams.Add(sablonParam, paramVal);
//         index++;
//       }

//       // end-1

//       // Sorgu cümlesi güncellenir (eski parametre çıkarılır , yeni multi parametreler eklenir.)
//       string sqlNew = Regex.Replace(txQuery, "@" + param, sbNewParamsForQuery.ToString()); //(%s)

//       // map paramden eski parametre çıkarılıp, yenileri eklenir
//       if (!FiBool.IsTrue(boKeepOldParam))
//       {
//         mapParams.Remove(param);
//       }

//       //mapParams.Concat(paramsNew);

//       return sqlNew;
//     }

//     public static string MakeMultiParamTemplate(string param, int index)
//     {
//       return param + "_" + index.ToString();
//     }

//     public static string ConvertListParamToMultiParams(string txQuery, FiKeybean mapParams, bool boKeepOldMultiParamInFkb)
//     {

//       if (mapParams == null) return txQuery;

//       // (1) List türündeki parametreler bulunur.
//       List<string> listMultiParamsName = new List<string>();

//       foreach (var sqlParam in mapParams)
//       {
//         // concurrent modification olmaması amacıyla convert işlemi ayrı yapılacak (aşağıda)
//         if (sqlParam.Value is List<string> || sqlParam.Value is List<int>)
//         {
//           listMultiParamsName.Add(sqlParam.Key);
//           //FiLogWeb.logWeb("list multi parama eklendi:" + sqlParam.Key);
//         }

//         //if (value instanceof Set) {
//         //    listMultiParamsName.add(param);
//         //}
//       }

//       // --end-1

//       // List-Set türünde olan parametreleri , multi tekli parametrelere çevirir. (abc_1,abc_2 gibi)
//       string spQuery = txQuery;

//       foreach (var param in listMultiParamsName)
//       {
//         bool boFound = mapParams.TryGetValue(param, out object listParam);
//         //FiLogWeb.logWeb("boFound:" + boFound + " : param : " + param);
//         spQuery = ConvertSingleParamToMultiParam(spQuery, mapParams, param, listParam as IList, boKeepOldMultiParamInFkb);

//       }

//       return spQuery;
//     }

//     /**
//      *
//      */
//     public static string DeActivateOptParamMain(string sql, string paramKey)
//     {
//       var regex = $@"--!({paramKey}).*\s*.*"; // 15-10-19
//       //Console.WriteLine("deact regex:"+regex);
//       var subst = "--$1 deactivated"; // 15-10-19
//       return Regex.Replace(sql, regex, subst); //sql.replaceAll(regex, subst);

//     }

//     /// <summary>
//     ///
//     /// </summary>
//     /// <param name="sql"></param>
//     /// <param name="paramKey"></param>
//     /// <returns></returns>
//     public static string ActivateOptParamMain(string sql, string paramKey)
//     {
//       // 200317_1741 sql param altındaki ifade yorum satırı olursa, yorum satırını kaldırır.
//       var regex = $@"--!({paramKey})\b.*\s*-*(.*)";
//       //Console.WriteLine("act regex:"+regex);
//       var subst = "--$1 activated \n$2"; // 17-03-2020
//       return Regex.Replace(sql, regex, subst); // sql.replaceAll(regex, subst);
//     }

//     /// <summary>
//     /// FiMapParam'da olan parametreleri aktive eder.
//     ///
//     /// boActivateOnlyFullParams true olursa sadece dolu olan parametreleri aktif eder, parametre dolu değilse (null dahil) deaktif eder.
//     ///
//     /// Deaktif edilecek parametrelerde FiKeyBean'de bulunmalı. (FkbParams olmayanlar deaktif edilmez)
//     ///
//     /// Dolu olma Şartları : String boş string degilse
//     ///
//     /// Collection larda size > 0 olmalı
//     ///
//     /// Diger türler için null olmamalı
//     /// </summary>
//     /// <param name="txQuery"></param>
//     /// <param name="mapParams"></param>
//     /// <param name="boActivateOnlyFullParams"></param>
//     /// <returns></returns>
//     public static string ActivateParamsMain(string txQuery, FiKeybean mapParams, bool boActivateOnlyFullParams)
//     {

//       var listParamsDeActivated = new List<string>();

//       foreach (KeyValuePair<string, object> keyValuePair in mapParams)
//       {
//         if (FiBool.IsTrue(boActivateOnlyFullParams))
//         {
//           // Dolu olanları aktif edecek, boş olanları deaktif edecek
//           bool boCheckParamsEmpty = CheckParamsEmpty(keyValuePair.Value);

//           if (FiBool.IsFalse(boCheckParamsEmpty))
//           {
//             txQuery = ActivateOptParamMain(txQuery, keyValuePair.Key);
//           }
//           else
//           {
//             txQuery = DeActivateOptParamMain(txQuery, keyValuePair.Key);
//             listParamsDeActivated.Add(keyValuePair.Key);
//           }

//         }
//         else
//         { // boActivateOnlyFullParams false veya null ise, tüm parametreleri aktif eder
//           txQuery = ActivateOptParamMain(txQuery, keyValuePair.Key);
//         }

//       }

//       foreach (string deActivatedParam in listParamsDeActivated)
//       {
//         mapParams.Remove(deActivatedParam);
//       }

//       return txQuery;
//     }

//     private static bool CheckParamsEmpty(object value)
//     {
//       return value switch
//       {
//         null => true,
//         string txValue => FiString.IsEmpty(txValue),
//         ICollection collection => FiCore.FiCollection.IsEmpty(collection),
//         _ => false
//       };

//       /*
//        if (value == null) return true;

//       if (value is string txValue)
//       {
//         return FiString.IsEmpty(txValue);
//       }
//       else if (value is System.Collections.IEnumerable enumerable)
//       { // Collection size'a göre karar verecek
//         return FiCollection.IsEmpty(enumerable);
//       }
//       else
//       { // string ve collection tipinden dışında olanlar, null degilse aktif edilir
//         return false;
//       }
//        */

//     }

//     public static string ActivateParamsNotNull(string txSqlValue, FiKeybean fkbParams)
//     {

//       if (fkbParams == null) return txSqlValue;

//       List<string> listParamsWillDeactivate = new List<string>();

//       foreach (var param in fkbParams)
//       {
//         // Null olanlar deaktif olacak
//         if (param.Value != null)
//         { // null degilse aktif edilir.
//           txSqlValue = ActivateOptParamMain(txSqlValue, param.Key);
//           //setTxQuery(newQuery);
//         }
//         else
//         { // param null ise,deaktif edilir
//           txSqlValue = FiQueryUtils.DeActivateOptParamMain(txSqlValue, param.Key);
//           listParamsWillDeactivate.Add(param.Key);
//         }
//       }

//       // deAktif edilen parametreler çıkarıldı.
//       foreach (string deActivatedParam in listParamsWillDeactivate)
//       {
//         fkbParams.Remove(deActivatedParam);
//       }

//       return txSqlValue;
//     }

//     /**
//      * Tüm optional parametreleri ( --!optParam ) deaktif eder. (alt satır yoruma alınmasa bile deaktif olur)
//      *
//      * <returns>string</returns>
//      */
//     public static string DeActivateAllOptParams(string sql)
//     {
//       //"--!(\\w+).*\\s*.*"; // @ verbatim operatörü eklenince ikinci slashlar kaldırılır
//       const string regex = @"--!(\w+).*\s*.*"; // 15-10-19
//       const string subst = "--$1 deactivated"; // 15-10-19
//       return Regex.Replace(sql, regex, subst);
//     }




//   }

// }