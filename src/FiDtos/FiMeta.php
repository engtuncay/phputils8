<?php

namespace Engtuncay\Phputils8\FiDtos;

/**
 * Ana alanlar  ftTxKey, ftTxValue olarak tanımlanır.
 * 
 * Ek alanlar olarak ftLnKey, ftTxLabel tanımlanabilir.
 * 
 * Not : eski isimlendirme (ofmTxKey, ofmTxValue)
 */
class FiMeta
{
  /**
   * TxCode (TxKodu)
   */
  public ?string $ftTxKey = null;

  public ?string $ftTxValue  = null;

  /**
   * LnCode (LnKodu)
   * <p>
   * Key Meta Karşılık Gelen Integer Kod varsa
   */
  public ?int $ftLnKey = null;

  /**
   * Açıklama (Description) gibi düşünebiliriz
   */
  public ?string $ftTxLabel = null;

  //private ?string $txType = null;

  /**
   * @param string|null $txKey
   */
  public function __construct(string $txKey = '', string $txValue = null)
  {
    $this->ftTxKey = $txKey;
    $this->ftTxValue = $txValue;
  }

  /**
   * txKey boş ise lnkey dönsün diye de mekanizma kurulabilir.
   * @return
   */
  //@Override
  public function __toString()
  {
    return $this->ftTxKey;
  }

  // Getter and Setters

  public function getTxKey(): ?string
  {
    return $this->ftTxKey;
  }

  /**
   * {{ ofmTxKey }} şeklinde dönüş verir. Template variable olarak kullanılır.
   *
   * @return string|null
   */
  public function getTxKeyAsTemp(): ?string
  {
    return '{{' . $this->ftTxKey . '}}';
  }

  public function setTxKey(?string $txKey): void
  {
    $this->ftTxKey = $txKey;
  }

  public function getTxValue(): ?string
  {
    return $this->ftTxValue;
  }

  public function setTxValue(?string $txValue): void
  {
    $this->ftTxValue = $txValue;
  }

  public function getLnKey(): ?int
  {
    return $this->ftLnKey;
  }

  public function setLnKey(?int $lnKey): void
  {
    $this->ftLnKey = $lnKey;
  }

  public function getTxLabel(): ?string
  {
    return $this->ftTxLabel;
  }

  public function setTxLabel(?string $txLabel): void
  {
    $this->ftTxLabel = $txLabel;
  }

  public function key(): ?string
  {
    return $this->ftTxKey;
  }

  public function val(): ?string
  {
    return $this->ftTxValue;
  }
}
