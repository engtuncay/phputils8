<?php

namespace Engtuncay\Phputils8\meta;

use Exception;

class Fdr
{

  private ?bool $boResult = null;
  private ?string $message = null;
  private $value;
  private ?int $lnResponseCode = null;

  private ?string $txId = null;
  public ?string $txName = null;

  public array $logList = [];

  private ?int $rowsAffected = null;
  private ?int $lnTotalCount = null;
  private ?bool $boFalseExist = null;

  private ?Exception $exception = null;

  public array $listException = [];

  private ?int $lnStatus = null;
  private ?int $lnSuccessOpCount = null;
  private ?int $lnFailureOpCount = null;

  private ?string $txQueryType = null;

  private ?int $lnInsertedRows = null;
  private ?int $lnUpdatedRows = null;
  private ?int $lnDeletedRows = null;

  public ?bool $boOpResult = null;
  public ?bool $boQueryExecuted = null;
  public ?bool $boMultiFdr = null;
  public array $listFdr = [];

  private ?bool $boLockAddLog = null;
  public array $obsMethodFinished = [];

  public function __construct($boResult = null, $message = null)
  {
    $this->boResult = $boResult;
    $this->message = $message;
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
    $instance->setValue($value);
    return $instance;
  }

  public static function creEmptyAndResultFalse()
  {
    $instance = new self();
    $instance->setValue(null);
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

  public function getValue()
  {
    return $this->value;
  }

  public function setValue($value): void
  {
    $this->value = $value;
  }

  public function getMessage(): ?string
  {
    return $this->message ?? '';
  }

  public function setMessage(?string $message): void
  {
    $this->message = $message;
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
      $this->message .= "\n" . $message;
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

}


