<?php

namespace Engtuncay\Phputils8\Core;

use Engtuncay\Phputils8\Meta\FiKeybean;

class FiString
{

  public static function substitutor(string $template, FiKeybean $fkbParams): string
  {
    // Düzenli ifade
    $pattern = '/\{\{(.*?)\}\}/';

    $params = $fkbParams->params;

    // Değiştirme işlemi
    $result = preg_replace_callback($pattern, function ($matches) use ($params) {
      $key = $matches[1]; // {{key}} içindeki 'key' kısmını al
      return $params[$key] ?? $matches[0]; // Eğer eşleşme yoksa orijinal {{key}}'i koru
    }, $template);

    return $result;
  }


  /**
   * Bir metni UpperCamelCase (PascalCase) formatına çevirir.
   *
   * @param string $string Dönüştürülecek metin.
   * @return string UpperCamelCase formatında metin.
   */
  public function toUpperCamelCase(string $string): string
  {
    // Tüm harfleri küçük yap ve kelimeleri ayır
    $words = preg_split('/[^a-zA-Z0-9]+/', strtolower($string), -1, PREG_SPLIT_NO_EMPTY);

    // Kelimelerin ilk harfini büyük yap ve birleştir
    $camelCase = array_map('ucfirst', $words);

    return implode('', $camelCase);
  }

//// Örnek Kullanım
//$input = "örnek_bir_metni_upper_camel_case";
//$output = toUpperCamelCase($input);
//
//echo $output; // Çıktı: ÖrnekBirMetniUpperCamelCase

}