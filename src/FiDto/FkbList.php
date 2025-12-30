<?php

namespace Engtuncay\Phputils8\FiDto;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * FiKeybean nesne dizisi (listesini) tutar
 */
class FkbList implements IteratorAggregate
{
  /** @var FiKeybean[] $items */
  private $items = [];

  public ?string $txTemplate;

  //public ?string $txValue;

  /**
   * 
   *
   * @param FiKeybean[]|null $collection
   */
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

  public function getAsMultiArray(): array
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