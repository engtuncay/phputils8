<?php
namespace Engtuncay\Phputils8\Log;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class FiLog
{
  public static ?Logger $log = null;

  public static function initLogger(string $logFileName)
  {
    //echo 'log init';
    if (self::$log === null) { //!isset(self::$log)
      //echo 'log başlatıldi';
      self::$log = new Logger('filog');
      self::$log->pushHandler(new StreamHandler('./fi-logs/' . $logFileName . '.log', Level::Debug));

      // Filtreleme veya değiştirme işlemi yapan processor
      self::$log->pushProcessor(function ($record) {
        // Örneğin, 'password' içeren mesajları filtrele
        if (strpos($record['message'], 'password') !== false) {
          // Log'u tamamen iptal etmek için null dönebilirsiniz (Monolog bunu direkt desteklemez ama Handler içinde yapılabilir)
          $record['message'] = '[REDACTED]';
        }
        return $record;
      });

    }

  }

}