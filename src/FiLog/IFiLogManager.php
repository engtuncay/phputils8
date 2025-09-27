<?php
namespace Engtuncay\Phputils8\FiLog;

interface IFiLogManager
{
  // 
        public function debug(string $message):void;

        public function error(string $message):void;

        //void LogMessage(string message,Type refType);

}