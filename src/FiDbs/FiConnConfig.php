<?php

namespace Engtuncay\Phputils8\FiDbs;

class FiConnConfig
{
  private ?string $txServer = null;
  private ?string $txDatabase = null;
  private ?string $txUsername = null;
  private ?string $txPass = null;
  private ?string $txDbType = null;

  /**
   * @return mixed
   */
  public function getTxServer()
  {
    return $this->txServer;
  }

  /**
   * @param mixed $hostname
   */
  public function setTxServer($hostname): void
  {
    $this->txServer = $hostname;
  }

  /**
   * @return mixed
   */
  public function getTxDatabase()
  {
    return $this->txDatabase;
  }

  /**
   * @param mixed $dbname
   */
  public function setTxDatabase($dbname): void
  {
    $this->txDatabase = $dbname;
  }

  /**
   * @return mixed
   */
  public function getTxUsername(): ?string
  {
    return $this->txUsername;
  }

  /**
   * @param mixed $txUsername
   */
  public function setTxUsername($txUsername): void
  {
    $this->txUsername = $txUsername;
  }

  public function getTxPass(): ?string
  {
    return $this->txPass;
  }

  /**
   * @param mixed $txPass
   */
  public function setTxPass($txPass): void
  {
    $this->txPass = $txPass;
  }

  /**
   * Get the value of txDbType
   *
   * @return ?string
   */
  public function getTxDbType(): ?string
  {
    return $this->txDbType;
  }

  /**
   * Set the value of txDbType
   *
   * @param ?string $txDbType
   *
   * @return self
   */
  public function setTxDbType(?string $txDbType): self
  {
    $this->txDbType = $txDbType;

    return $this;
  }

}
