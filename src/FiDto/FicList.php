<?php

namespace Engtuncay\Phputils8\FiDto;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class FicList implements IteratorAggregate
{
  /** @var FiCol[] $items */
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

  /**
   * @return FiCol[]
   */
  public function getItems(): array
  {
    return $this->items;
  }

  public function getItemsField(): array
  {
    /** @var string[] $arrFields */
    $arrFields = [];
    foreach ($this->items as $item) {
      $arrFields[] = $item->ofcTxFieldName;
    }
    return $arrFields;
  }

  public function getItemsHeader()
  {
    /** @var string[] */
    $arrHeaders = [];

    foreach ($this->items as $item) {
      $arrHeaders[] = $item->ofcTxHeader;
    }

    return $arrHeaders;
  }

  /**
   * @return string[]
   */
  public function getArrayHeaderToField(): array
  {
    /** @var string[] */
    $arrData = [];

    foreach ($this->items as $item) {
      $arrData[$item->ofcTxHeader] = $item->ofcTxFieldName;
    }

    return $arrData;
  }

  public function get($index) : FiCol|null
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
}
