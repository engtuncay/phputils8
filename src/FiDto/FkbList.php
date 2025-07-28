<?php

namespace Engtuncay\Phputils8\FiDto;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class FkbList implements IteratorAggregate
{
  private $items = [];

  public function __construct($collection = [])
  {
    if (is_array($collection)) {
      $this->items = $collection;
    } else {
      //throw new InvalidArgumentException('Parameter must be an array');
    }
  }

  public function add(FiKeybean $item)
  {
    $this->items[] = $item;
  }

  public function getItems()
  {
    return $this->items;
  }

  public function getAsMultiArray()
  {
    $arrFdr = [];
    foreach ($this->getItems() as $f) {
      array_push($arrFdr, $f->params);
    }
    return $arrFdr;
  }

  public function get($index): FikeyBean|null
  {
    return $this->items[$index] ?? null;
  }

  public function size()
  {
    return count($this->items);
  }


  public function getIterator(): Traversable
  {
    return new ArrayIterator($this->items);
  }

  public function getItemsField(): array
  {
    return array_map(function ($item) {
      /** @var FiKeybean $item */
      return $item->getOfcFieldName();
    }, $this->items);
  }
}

//// FiKeybean sınıfını tanımlamanız gerekecek.
//class FiKeybean
//{
//  public $key;
//  public $value;
//
//  public function __construct($key, $value)
//  {
//    $this->key = $key;
//    $this->value = $value;
//  }
//}
//
//// Kullanım örneği
//$fkbList = new FkbList([
//  new FiKeybean('key1', 'value1'),
//  new FiKeybean('key2', 'value2')
//]);
//
//$fkbList->add(new FiKeybean('key3', 'value3'));
//
//foreach ($fkbList->getItems() as $item) {
//  echo $item->key . ': ' . $item->value . PHP_EOL;
//}
//
//// Belirli bir öğeye erişim
//echo "İkinci öğe: " . $fkbList->get(1)->key . PHP_EOL;
//
//// Liste boyutu
//echo "Toplam öğe sayısı: " . $fkbList->size() . PHP_EOL;
