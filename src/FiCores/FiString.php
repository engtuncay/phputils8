<?php

namespace Engtuncay\Phputils8\FiCores;

use Engtuncay\Phputils8\FiDto\FiKeybean;

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
   * Verilen metin içinde küçük harf bulunup bulunmadığını kontrol eder.
   *
   * @param string $txValue Kontrol edilecek metin.
   * @return bool Küçük harf varsa true, yoksa false döner.
   */
  public static function hasLowercaseLetter(string $txValue): bool
  {
    // Küçük harfleri kontrol etmek için preg_match kullanıyoruz
    return preg_match('/[a-z]/', $txValue) === 1;
  }

  public static function orEmpty(mixed $objValue)
  {
    if ($objValue === null) return '';

    return $objValue;
  }

  /**
   * Trim is Applied
   *
   * @param mixed $objValue
   * @return true|void
   */
  public static function isEmpty(mixed $objValue): bool
  {
    if ($objValue === null) return true;
    if (trim($objValue) === '') return true;
    return false;
  }
}
