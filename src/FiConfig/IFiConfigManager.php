<?php

interface IFiConfigManager
{
  public function getConnString(string $profile): string;
  public function getApiUrl(string $txProfile): string;

  /**
   * Ayar dosyasından okunarak alınacak profile
   */
  public function getProfile(): string;
}
//Dictionary<string, string> mapConnString { get; set; };