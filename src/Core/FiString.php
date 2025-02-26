<?php

namespace Engtuncay\Phputils8\Core;

use Engtuncay\Phputils8\Meta\FiKeybean;

class FiString
{

  public static function substitutor(string $template, FiKeybean $fkbParams):string
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
}