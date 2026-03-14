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

  /**
   * Gets Environment Variable
   * 
   * @param null|string $key 
   * @return string|null
   */
  public function getEnvVar(?string $key): ?string;

}
//Dictionary<string, string> mapConnString { get; set; };