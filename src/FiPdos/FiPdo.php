<?php

namespace Engtuncay\Phputils8\FiPdos;

use Engtuncay\Phputils8\FiApps\FiAppConfig;
use Engtuncay\Phputils8\FiDbs\FiDbTypes;
use Engtuncay\Phputils8\FiDbs\FiQuery;
use Engtuncay\Phputils8\FiDtos\Fdr;
use Engtuncay\Phputils8\FiDtos\FiKeybean;
use PDOException;
use PDO;

/**
 * Pdo Extend Helper Class
 * <br/>
 * 2024-06-10
 *
 */
class FiPdo extends PDO
{
  public ?bool $boDebug = null; // = false;
  public ?bool $boExecResult = null;
  public ?string $dbName = null;

  public static ?FiKeybean $fkbPdoPool = null;

  /**
   * shows whether or not there is a connection
   *
   * tr: bağlantı kurulup kurulmadığını gösterir.
   */
  public ?bool $boConnection = null;

  public ?PDOException $pdoException;

  public function __construct($host, $dbname, $username, $password, $charset = 'utf8', string $dbType = FiDbTypes::MYSQL)
  {
    try {
      if ($dbType == FiDbTypes::MYSQL) {
        $txDsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
      } else if ($dbType == FiDbTypes::MSSQL) {
        $txDsn = 'sqlsrv:server=' . $host . ';database=' . $dbname;
      } else if ($dbType == FiDbTypes::POSTGRESQL) {
        $txDsn = 'pgsql:host=' . $host . ';dbname=' . $dbname;
      } else if ($dbType == FiDbTypes::ORACLE) {
        $txDsn = 'oci:dbname=' . $dbname . ';host=' . $host;
      } else if ($dbType == FiDbTypes::SQLITE) {
        $txDsn = 'sqlite:' . $dbname;
      } else {
        throw new \Exception("Unsupported database type: " . $dbType);
      }

      FiAppConfig::$fiLog?->debug("FiPdo::__construct called. DSN: " . $txDsn);
      FiAppConfig::$fiLog?->debug("username password" . $username . " " . $password);

      parent::__construct($txDsn, $username, $password);
      $this->dbName = $dbname;
      $this->boConnection = true;

      if ($dbType == FiDbTypes::MYSQL) {
        $this->query('SET CHARACTER SET ' . $charset);
        $this->query('SET NAMES ' . $charset);
      }
      
      $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
      $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      $this->pdoException = $e;
      FiAppConfig::$fiLog?->error("FiPdo::__construct failed. Error: " . $e->getMessage());
      $this->boConnection = false;
    }
  }

  public static function buiWithProfile(string $connProfile = null): FiPdo
  {
    FiAppConfig::$fiLog?->debug("FiPdo::buiWithProfile called" . ($connProfile ? ". ConnProfile: " . $connProfile : ""));

    if ($connProfile == null) {
      $connProfile = FiAppConfig::$fiConfig?->getProfile();
    }

    if (self::$fkbPdoPool == null) {
      self::$fkbPdoPool = FiKeybean::bui([]);
    }

    if (self::$fkbPdoPool->has($connProfile)) {
      return self::$fkbPdoPool->get($connProfile);
    }

    $fiConnConfig = FiAppConfig::$fiConfig?->getFiConnConfig($connProfile);

    FiAppConfig::$fiLog?->debug("FiPdo::buiWithProfile called. ConnProfile: " . $connProfile . ", Host: " . $fiConnConfig->getTxServer() . ", DbName: " . $fiConnConfig->getTxDatabase());

    $fiPdo = null;

    if ($fiConnConfig != null) {
      $fiPdo = new FiPdo($fiConnConfig->getTxServer(), $fiConnConfig->getTxDatabase(), $fiConnConfig->getTxUsername(), $fiConnConfig->getTxPass(), null, $fiConnConfig->getTxDbType());
      self::$fkbPdoPool->set($connProfile, $fiPdo);
    } else {
      throw new \Exception("FiConnConfig is null. Please check your configuration.");
    }

    return $fiPdo;
  }

  // public function from($tableName)
  // {
  //   $this->sql = 'SELECT * FROM ' . $tableName;
  //   $this->tableName = $tableName;
  //   return $this;
  // }

  // public function select($columns)
  // {
  //   $this->sql = str_replace(' * ', ' ' . $columns . ' ', $this->sql);
  //   return $this;
  // }

  /**
   * Belirtilen tablonun auto_increment değerini ayarlar
   *
   * @param $tableName
   * @return mixed
   */
  public function setAutoIncrement($tableName, $ai = 1)
  {
    return $this->query("ALTER TABLE `{$tableName}` AUTO_INCREMENT = {$ai}")->fetch();
  }


  /**
   * Get the value of boExecResult
   */
  public function getBoExecResult()
  {
    return $this->boExecResult;
  }

  public function getBoExecResultNtn()
  {
    if ($this->boExecResult == null) {
      return false;
    }

    return $this->boExecResult;
  }


  /**
   * Set the value of boExecResult
   *
   * @return  self
   */
  public function setBoExecResult($boExecResult)
  {
    $this->boExecResult = $boExecResult;

    return $this;
  }

  // public function exec($boExecResult)
  // {
  //   $this->boExecResult = $boExecResult;

  //   return $this;
  // }

  // /**
  //  * Execute an SQL statement and return the number of affected rows
  //  * PDO::exec() executes an SQL statement in a single function call, returning the number of rows affected by the statement.
  //  *
  //  * //param string $statement The SQL statement to prepare and execute. Data inside the query should be properly escaped
  //  * @return bool|int PDO::exec() returns the number of rows that were modified or deleted by the SQL statement you issued. If no rows were affected, PDO::exec() returns `0`.
  //  * The following example incorrectly relies on the return value of PDO::exec(), wherein a statement that affected 0 rows results in a call to die():
  //  */
  // public function fiUpdate(FiQuery $fiQuery): Fdr
  // {
  //     $result = null;

  //     $fdrMain = new Fdr();

  //     // if ($this->boConnection == null || $this->boConnection == false) {
  //     //   echo "connection is not established";
  //     //   return false;
  //     // }

  //     try {
  //         $result = parent::exec($fiQuery->getSql());
  //         //$this->boExecResult = true;
  //         $fdrMain->setBoResult(true);
  //         return $fdrMain; // $result;
  //     } catch (PDOException $e) {
  //         //$this->boExecResult = false;
  //         $this->pdoException = $e;
  //         $fdrMain->setBoResult(false);
  //         return $fdrMain;
  //     }
  // }

  /**
   * Execute an SQL statement and return the number of affected rows
   * PDO::exec() executes an SQL statement in a single function call, returning the number of rows affected by the statement.
   *
   * @param string $statement The SQL statement to prepare and execute. Data inside the query should be properly escaped .
   * @return bool|int PDO::exec() returns the number of rows that were modified or deleted by the SQL statement you issued. If no rows were affected, PDO::exec() returns `0`.
   * The following example incorrectly relies on the return value of PDO::exec(), wherein a statement that affected 0 rows results in a call to die():
   */
  public function execTry(string $statement)
  {
    $result = null;

    // if ($this->boConnection == null || $this->boConnection == false) {
    //   echo "connection is not established";
    //   return false;
    // }

    try {
      $result = parent::exec($statement);
      $this->boExecResult = true;
      return $result;
    } catch (PDOException $e) {
      $this->boExecResult = false;
      $this->pdoException = $e;
      return $result;
    }
  }

  public function execFiWitEchoErr(string $statement)
  {
    $result = null;
    try {
      $result = parent::exec($statement);
      $this->boExecResult = true;
      return $result;
    } catch (PDOException $e) {
      $this->boExecResult = false;
      $this->pdoException = $e;
      echo $this->pdoException->getMessage();
      return $result;
    }
  }

  public function getErrorMessage(): string
  {
    if ($this->pdoException != null) {
      return $this->pdoException->getMessage();
    }

    return "";
  }

  public function bindFields($fields)
  {
    end($fields);
    $lastField = key($fields);
    $bindString = ' ';
    foreach ($fields as $field => $data) {
      $bindString .= $field . '=:' . $field;
      $bindString .= ($field === $lastField ? ' ' : ',');
    }
    return $bindString;
  }

  public function prepFetchOnly(string $sql): array
  {
    return $this->prepFetch($sql, null);
  }

  /**
   * PDOStatement::fetch — Fetches the next row from a result set
   */
  public function prepFetch(string $sql, ?array $arrParam): array
  {
    $stmt = $this->prepare($sql);

    if ($arrParam != null) {
      $stmt->execute($arrParam);
    } else {
      $stmt->execute();
    }

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * PDOStatement::fetch — Fetches the next row from a result set
   */
  public function sqlExecute(FiQuery $fiQuery): Fdr  //string $sql, ?array $fkbParams = null
  {
    $fdr = new Fdr();
    $fkbParams = $fiQuery->getFkbParams();

    $stmt = $this->prepare($fiQuery->getSql());;
    $boResult = null;

    if ($fkbParams != null) {
      $boResult = $stmt->execute($fkbParams->getParams());
    } else {
      $boResult = $stmt->execute();
    }

    //$fdr->setBoExec($boExec);
    $fdr->setBoResult($boResult);
    $fkbResult = FiKeybean::bui($stmt->fetch(PDO::FETCH_ASSOC));
    $fdr->setRefValue($fkbResult);
    $fdr->setRefValue($fkbResult);

    return $fdr;
  }

  /**
   * PDOStatement::fetchAll — Returns an array containing all of the result set rows
   */
  public function prepFetchAll(string $sql, ?array $arrParam): array
  {
    $stmt = $this->prepare($sql);

    if ($arrParam != null) {
      $stmt->execute($arrParam);
    } else {
      $stmt->execute();
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * PDOStatement::fetchAll — Returns an named array containing all of the result set rows
   */
  public function fiSelect(FiQuery $fiQuery): Fdr
  {
    $fdrMain = new Fdr();

    try {

      $stmt = $this->prepare($fiQuery->getSql());

      if ($fiQuery->getFkbParams() != null) {
        $stmt->execute($fiQuery->getFkbParams()->getParams());
      } else {
        $stmt->execute();
      }
      $fdrMain->setBoResult(true);
      $arrResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $fdrMain->setArrValue($arrResult);
      $fdrMain->setRefValue($arrResult);
      return $fdrMain;
    } catch (PDOException $e) {
      $fdrMain->setBoResult(false);
      $fdrMain->setException($e);
      return $fdrMain; //$result;
    }
  }

  /**
   * Select query
   *
   * @param FiQuery $fiQuery
   * @return Fdr
   */
  public function selectFkb(FiQuery $fiQuery): Fdr
  {
    $fdrMain = new Fdr();

    try {

      $stmt = $this->prepare($fiQuery->getSqlFixed());

      if ($fiQuery->getFkbParams() != null) {
        $stmt->execute($fiQuery->getFkbParams()->getArr());
      } else {
        $stmt->execute();
      }
      $fdrMain->setBoResult(true);
      $arrResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $fkbVal = new FiKeybean($arrResult);
      $fdrMain->setFkbValue($fkbVal);
      return $fdrMain;
    } catch (PDOException $e) {

      $fdrMain->setBoResult(false);
      $fdrMain->setException($e);
      return $fdrMain; //$result;
    }
  }

  public function getBoDebug(): ?bool
  {
    return $this->boDebug;
  }

  public function setBoDebug(?bool $boDebug): void
  {
    $this->boDebug = $boDebug;
  }

  public function getDbName(): ?string
  {
    return $this->dbName;
  }

  public function setDbName(?string $dbName): void
  {
    $this->dbName = $dbName;
  }

  public function getBoConnection(): ?bool
  {
    return $this->boConnection;
  }

  public function setBoConnection(?bool $boConnection): void
  {
    $this->boConnection = $boConnection;
  }

  public function getPdoException(): ?PDOException
  {
    return $this->pdoException;
  }

  public function setPdoException(?PDOException $pdoException): void
  {
    $this->pdoException = $pdoException;
  }
}
