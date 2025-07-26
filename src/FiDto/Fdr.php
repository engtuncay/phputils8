<?php

namespace Engtuncay\Phputils8\FiDto;

use Exception;

class Fdr
{
  private ?bool $boResult ;

  /**
   * boExecution : örneğin sorgu başarılı çalıştırıldığını gösterir, patlamadığını
   *
   * @var bool|null
   */
  private ?bool $boExec ;
  private ?string $message ;

  private mixed $refValue;

  private ?FiKeybean $fkbValue = null;

  private ?int $lnResponseCode ;

  private ?string $txId ;
  public ?string $txName ;

  public array $logList = [];

  private ?int $rowsAffected;
  private ?int $lnTotalCount;
  private ?bool $boFalseExist;

  private ?Exception $exception ;

  public array $listException = [];

  private ?int $lnStatus ;
  private ?int $lnSuccessOpCount ;
  private ?int $lnFailureOpCount ;

  private ?string $txQueryType ;

  private ?int $lnInsertedRows ;
  private ?int $lnUpdatedRows ;
  private ?int $lnDeletedRows ;

  //public ?bool $boOpResult = null;
  public ?bool $boQueryExecuted ;
  public ?bool $boMultiFdr ;
  public ?array $listFdr; // = [];

  private ?FkbList $fkbList = null; // init

  private ?bool $boLockAddLog;
  //public ?array $obsMethodFinished; // = [];

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

  public function getFkbListInit(): FkbList
  {
    if($this->fkbList === null) {
        $this->fkbList = new FkbList();
    }
    return $this->fkbList;
  }

  public function setFkbList(FkbList $fkbList): void
  {
    $this->fkbList = $fkbList;
  }

  public function getBoExec(): ?bool
  {
    return $this->boExec;
  }

  public function setBoExec(?bool $boExec): void
  {
    $this->boExec = $boExec;
  }





} // end of class