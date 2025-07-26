<?php
namespace Engtuncay\Phputils8\FiDto;

class FmtList
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

  public function add(FiMeta $item)
  {
    $this->items[] = $item;
  }

  public function getItems(): array
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

  public function get($index)
  {
    return $this->items[$index] ?? null;
  }

  public function size()
  {
    return count($this->items);
  }

}

