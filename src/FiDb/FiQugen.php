<?php

namespace Engtuncay\Phputils8\FiDb;

use Engtuncay\Phputils8\Core\FiStrbui;
use Engtuncay\Phputils8\FiDto\FkbList;

/**
 * FiQuery Generator
 */
class FiQugen
{

  public static function sqlAlterFields(FkbList $settingsField, array $fdrFields)
  {
    $sbSql = new FiStrbui();

    foreach ($settingsField as $field) {
      if (!in_array($field, $fdrFields)) {
        // Field needs to be added
        $sql = "ALTER TABLE payments_log ADD COLUMN {$field->getName()} {$field->getType()}";
        // Execute the SQL
      }
    }
  }

}