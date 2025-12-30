<?php
namespace Engtuncay\Phputils8\FiConfigs;

use Engtuncay\Phputils8\FiDbs\FiConnConfig;

interface IFiConfigManager
{
  public function getConnString(?string $profile): string;
  public function getApiUrl(?string $txProfile): string;

  public function getFiConnConfig(?string $profile = null): FiConnConfig;

  /**
   * Ayar dosyasından okunarak alınacak profile
   */
  public function getProfile(): string;
}
//Dictionary<string, string> mapConnString { get; set; };