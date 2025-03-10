<?php

namespace Engtuncay\Phputils8\FiCol;

use Engtuncay\Phputils8\Log\FiLog;

class FicValue
{
  /**
   * Converts a mixed value to a boolean or null based on specific string comparisons.
   *
   * @param mixed $value The value to be converted. Typically a string or a type that can be cast to a string.
   * @param bool|null $boElseValue The default value to return if the input does not match predefined conditions.
   * @return bool|null Returns true, false, or null depending on the value provided and defined conversion rules.
   */
  public static function toBool(mixed $value,bool|null $boElseValue = null):bool|null
  {
    $txValue = strval($value);

    FiLog::$log?->debug('toBool:'. $txValue);

    if(strcasecmp($txValue,'true')===0) return true;
    if(strcasecmp($txValue,'false')===0) return false;
    if(strcasecmp($txValue,'x')===0) return false;
    if(strcasecmp($txValue,'ok')===0) return true;

    if($boElseValue!==null) return $boElseValue;

    return null;
  }
}