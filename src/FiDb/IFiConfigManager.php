<?php

use Engtuncay\Phputils8\FiDb\FiConnConfig;

interface IFiConfigManager
{
    //Dictionary string, string mapConnString { get; set; }

    public function getConnConfig(string $profile): FiConnConfig;
    //string GetApiUrl(string txProfile);

    /**
    * Ayar dosyasından okunarak alınacak profile
    */
    //string GetProfile();
  
}