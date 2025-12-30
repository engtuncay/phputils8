<?php
namespace Engtuncay\Phputils8\FiConfigs;

use Engtuncay\Phputils8\FiDtos\Fdr;
use Engtuncay\Phputils8\FiDtos\FiKeybean;

class FiConfReader
{
  public static function readConfFile(string $filePath): Fdr
  {
    $fdr = new Fdr();

    if (!file_exists($filePath)) {
      $fdr->setBoResult(false);
      $fdr->setMessage("Config file not found: " . $filePath);
    }

    $conf = parse_ini_file($filePath, true, INI_SCANNER_TYPED);
    if ($conf === false) {
      //throw new \Exception("Failed to parse configuration file: " . $filePath);
      $fdr->setBoResult(false);
      $fdr->setMessage("Failed to parse configuration file: " . $filePath);
    }

    $fkbVal = new FiKeybean($conf);

    $fdr->setFkbValue($fkbVal);

    return $fdr;
  }
}
