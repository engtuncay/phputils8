<?php
namespace Engtuncay\Phputils8\FiApps;

use Engtuncay\Phputils8\FiConfigs\IFiConfigManager;
use Engtuncay\Phputils8\FiLogs\IFiLogManager;


class FiAppConfig
{
  // Uygulama tarafında, ConfigManager ataması yapılacak
  public static ?IFiConfigManager $fiConfig = null;

  public static ?IFiLogManager $fiLog = null;
  
}