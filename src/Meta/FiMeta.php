<?php

namespace Engtuncay\Phputils8\Meta;

class FiMeta
{
    /**
     * TxCode (TxKodu)
     */
    public ?string $ofmTxKey = null;

    public ?string $ofmTxValue  = null;

    /**
     * LnCode (LnKodu)
     * <p>
     * Key Meta Karşılık Gelen Integer Kod varsa
     */
    public ?int $ofmLnKey = null;

    /**
     * Açıklama (Description) gibi düşünebiliriz
     */
    public ?string $ofmTxLabel = null;

  //private ?string $txType = null;

    /**
     * @param string|null $txKey
     */
    public function __construct(string $txKey = '', string $txValue = null)
    {
        $this->ofmTxKey = $txKey;
        $this->ofmTxValue = $txValue;
    }

    /**
     * txKey boş ise lnkey dönsün diye de mekanizma kurulabilir.
     * @return
     */
    //@Override
    public function __toString()
    {
        return $this->ofmTxKey;
    }

    // Getter and Setters

    public function getTxKey(): ?string
    {
        return $this->ofmTxKey;
    }

    public function setTxKey(?string $txKey): void
    {
        $this->ofmTxKey = $txKey;
    }

    public function getTxValue(): ?string
    {
        return $this->ofmTxValue;
    }

    public function setTxValue(?string $txValue): void
    {
        $this->ofmTxValue = $txValue;
    }

    public function getLnKey(): ?int
    {
        return $this->ofmLnKey;
    }

    public function setLnKey(?int $lnKey): void
    {
        $this->ofmLnKey = $lnKey;
    }

    public function getTxLabel(): ?string
    {
        return $this->ofmTxLabel;
    }

    public function setTxLabel(?string $txLabel): void
    {
        $this->ofmTxLabel = $txLabel;
    }


}