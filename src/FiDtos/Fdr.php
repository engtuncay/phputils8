<?php

namespace Engtuncay\Phputils8\FiDtos;

use Exception;

class Fdr
{
  /**
   * Örneğin veritabanı işlemi ise sorgu başarılı mı başarısız mı gösterir
   *
   */
  private ?bool $boResult = null;

  // /**
  //  * Kulanılmayacak, çıkartılacak - depracated
  //  * 
  //  * boExecution : örneğin sorgu çalıştırıldığını gösterir, patlamadığını
  //  *
  //  * @var bool|null
  //  */
  //private ?bool $boExec = null;

  private ?string $txMessage = null;

  private mixed $refValue = null;

  private ?array $arrValue = null;

  private ?FiKeybean $fkbValue = null;

  private ?FkbList $fklValue = null;

  public ?int $lnResponseCode = null;

  private ?string $txId;

  public ?string $txName = null;

  public array $logList = [];

  private ?int $rowsAffected = null;

  // sayfalama yaparken lazım olan toplam kayıt sayısı
  private ?int $lnTotalCount = null;

  // private ?bool $boFalseExist;

  private ?Exception $exception = null;

  public array $listException = [];

  private ?int $lnStatus;
  private ?int $lnSuccessOpCount;
  private ?int $lnFailureOpCount;

  private ?string $txQueryType;

  // ?????
  private ?int $lnInsertedRows;
  private ?int $lnUpdatedRows;
  private ?int $lnDeletedRows;

  public ?bool $boQueryExecuted = null;

  public ?bool $boMultiFdr = null;

  public ?array $listFdr = null; // = [];

  private ?bool $boLockAddLog;


  public function __construct($boResult = null, $message = null)
  {
    $this->boResult = $boResult;
    $this->txMessage = $message;
  }

  public static function genInstance()
  {
    return new self();
  }

  public static function creBoResult(?bool $boResult)
  {
    return new self($boResult);
  }

  public static function creByValue($value, ?bool $boResult)
  {
    $instance = new self($boResult);
    $instance->setRefValue($value);
    return $instance;
  }

  public static function creEmptyAndResultFalse()
  {
    $instance = new self();
    $instance->setRefValue(null);
    $instance->setBoResult(false);
    return $instance;
  }

  public static function creByBoResultAndErrorLog(?bool $boResult, string $txErrorLog)
  {
    $instance = new self($boResult);
    $instance->addLogError($txErrorLog);
    return $instance;
  }

  public function getBoResult(): ?bool
  {
    return $this->boResult;
  }

  public function setBoResult(?bool $boResult): void
  {
    $this->boResult = $boResult;
  }

  public function getRefValue()
  {
    return $this->refValue;
  }

  public function setRefValue($refValue): void
  {
    $this->refValue = $refValue;
  }

  public function getMessage(): ?string
  {
    return $this->txMessage ?? '';
  }

  public function setMessage(?string $message): void
  {
    $this->txMessage = $message;
  }

  public function getRowsAffected(): ?int
  {
    return $this->rowsAffected ?? -1;
  }

  public function setRowsAffected(?int $rowsAffected): void
  {
    $this->rowsAffected = $rowsAffected;
  }

  public function setRowsAffectedWithUpBoResult(?int $rowsAffected): void
  {
    $this->rowsAffected = $rowsAffected;
    if ($rowsAffected !== null && $rowsAffected > 0) {
      $this->setBoResult(true);
    }
  }

  public function getException(): ?Exception
  {
    return $this->exception;
  }

  public function setException(?Exception $exception): void
  {
    $this->exception = $exception;
  }

  public function combineAnd(Fdr $fdrSubWork): void
  {
    if ($fdrSubWork->getBoResult() === false) {
      $this->setBoResult(false);
      $this->lnFailureOpCount = ($this->lnFailureOpCount ?? 0) + 1;
    }

    if ($fdrSubWork->getBoResult() === true) {
      $this->lnSuccessOpCount = ($this->lnSuccessOpCount ?? 0) + 1;
      if ($this->boResult === null) {
        $this->setBoResult(true);
      }
    }

    if ($fdrSubWork->getException() !== null) {
      $this->setException($fdrSubWork->getException());
      $this->listException[] = $fdrSubWork->getException();
    }

    if (!empty($fdrSubWork->getMessage())) {
      $this->appendMessageLn($fdrSubWork->getMessage());
    }

    $this->logList = array_merge($this->logList, $fdrSubWork->logList);
    $this->appendRowsAffected($fdrSubWork->getRowsAffected());

    if ($this->boMultiFdr) {
      $this->listFdr[] = $fdrSubWork;
    }
  }

  public function appendMessageLn(?string $message): void
  {
    if ($message !== null) {
      $this->txMessage .= "\n" . $message;
    }
  }

  public function appendRowsAffected(?int $rows): void
  {
    $this->rowsAffected = ($this->rowsAffected ?? 0) + ($rows ?? 0);
  }

  public function addLogError(string $log): void
  {
    $this->logList[] = ['type' => 'error', 'message' => $log];
  }

  public function getFkbListInit(): FkbList
  {
    if ($this->fklValue === null) {
      $this->fklValue = new FkbList();
    }
    return $this->fklValue;
  }

  public function setFkbList(FkbList $fkbList): void
  {
    $this->fklValue = $fkbList;
  }

  // public function getBoExec(): ?bool
  // {
  //   return $this->boExec;
  // }

  // public function setBoExec(?bool $boExec): void
  // {
  //   $this->boExec = $boExec;
  // }

  /**
   * Get the value of fkbValue
   */
  public function getFkbValue()
  {
    return $this->fkbValue;
  }

  /**
   * Set the value of fkbValue
   *
   * @return  self
   */
  public function setFkbValue($fkbValue)
  {
    $this->fkbValue = $fkbValue;

    return $this;
  }


  /**
   * Get the value of arrValue
   */
  public function getArrValue()
  {
    return $this->arrValue;
  }

  /**
   * Set the value of arrValue
   *
   * @return  self
   */
  public function setArrValue($arrValue)
  {
    $this->arrValue = $arrValue;

    return $this;
  }

  public function getArrValueNtn(): array
  {
    if ($this->arrValue === null) {
      return [];
    }
    return $this->arrValue;
  }

  public function isTrueBoResult(): bool
  {
    if( $this->getBoResult() === null ) {
      return false;
    }
    
    return $this->getBoResult() === true;
  }

} // end of class