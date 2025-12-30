<?php

namespace Engtuncay\Phputils8\FiCores;

use Engtuncay\Phputils8\FiDto\FiCol;

class FiArray
{

  public static function existKeyByFiCol(FiCol $fiCol, array $params): bool
  {
    if ($fiCol->ofcTxFieldName == null) return false;
    return array_key_exists($fiCol->ofcTxFieldName, $params);
  }

  public static function existKey(string $txKey, array $params): bool
  {
    if ($txKey == null) return false;
    return array_key_exists($txKey, $params);
  }

  /**
   * Builds a string by concatenating all elements of the provided array.
   *
   * @param array $sbFiColMethodBody An array containing elements to be concatenated into a single string.
   * @return string The resulting string created by concatenating all elements of the provided array.
   */
  public static function arrStrBuild(array $sbFiColMethodBody): string
  {
    return implode('', $sbFiColMethodBody);
  }

  /**
   * Belirtilen alana göre obje array'inden eşleşen ilk objeyi döner.
   *
   * @param object[] $objects Obje array'i
   * @param string $field Aranacak alan adı (property)
   * @param mixed $value Aranan değer
   * @return object|null Eşleşen obje veya null
   */
  public static function findObjectByField(array $objects, string $field, mixed $value): ?object
  {
    if (!is_array($objects)) {
      return null;
    }

    foreach ($objects as $obj) {
      if (is_object($obj) && property_exists($obj, $field) && $obj->$field === $value) {
        return $obj;
      }
    }
    return null;
  }

  public static function findElemInMultiArrayByKeyValue(array $array, string $key, $value): ?array
  {
    if (!is_array($array)) {
      return null;
    }

    foreach ($array as $item) {
      if (is_array($item) && array_key_exists($key, $item) && $item[$key] === $value) {
        return $item;
      }
    }
    return null; // Eşleşme yoksa null döner
  }
}
