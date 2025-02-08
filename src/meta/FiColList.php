<?php
namespace Engtuncay\Phputils8\meta;

class FiColList
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

  public function add(FiCol $item)
  {
    $this->items[] = $item;
  }

  public function getItems()
  {
    return $this->items;
  }

  public function get($index)
  {
    return $this->items[$index] ?? null;
  }

  public function size()
  {
    return count($this->items);
  }
}

//// FiKeyBean sınıfını tanımlamanız gerekecek.
//class FiKeyBean
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
//  new FiKeyBean('key1', 'value1'),
//  new FiKeyBean('key2', 'value2')
//]);
//
//$fkbList->add(new FiKeyBean('key3', 'value3'));
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
