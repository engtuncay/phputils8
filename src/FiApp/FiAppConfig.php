<?php
namespace Engtuncay\Phputils8\FiApp;

use Engtuncay\Phputils8\FiConfig\IFiConfigManager;
use Engtuncay\Phputils8\FiLog\IFiLogManager;


class FiAppConfig
{
  // Uygulama tarafında, ConfigManager ataması yapılacak
  public static ?IFiConfigManager $fiConfig = null;

  public static ?IFiLogManager $fiLog = null;
  
}