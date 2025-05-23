<?php

namespace Engtuncay\Phputils8\Meta;

class FiMeta
{
    /**
     * TxCode (TxKodu)
     */
    public ?string $txKey = null;

    public ?string $txValue  = null;

    /**
     * LnCode (LnKodu)
     * <p>
     * Key Meta Karşılık Gelen Integer Kod varsa
     */
    public ?int $lnKey = null;

    /**
     * Açıklama (Description) gibi düşünebiliriz
     */
    public ?string $txLabel = null;

  //private ?string $txType = null;

    /**
     * @param string|null $txKey
     */
    public function __construct(string $txKey = '', string $txValue = null)
    {
        $this->txKey = $txKey;
        $this->txValue = $txValue;
    }

    /**
     * txKey boş ise lnkey dönsün diye de mekanizma kurulabilir.
     * @return
     */
    //@Override
    public function __toString()
    {
        return $this->txKey;
    }

    // Getter and Setters

    public function getTxKey(): ?string
    {
        return $this->txKey;
    }

    public function setTxKey(?string $txKey): void
    {
        $this->txKey = $txKey;
    }

    public function getTxValue(): ?string
    {
        return $this->txValue;
    }

    public function setTxValue(?string $txValue): void
    {
        $this->txValue = $txValue;
    }

    public function getLnKey(): ?int
    {
        return $this->lnKey;
    }

    public function setLnKey(?int $lnKey): void
    {
        $this->lnKey = $lnKey;
    }

    public function getTxLabel(): ?string
    {
        return $this->txLabel;
    }

    public function setTxLabel(?string $txLabel): void
    {
        $this->txLabel = $txLabel;
    }


}