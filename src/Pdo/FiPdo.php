<?php

namespace Engtuncay\Phputils8\Pdo;

use Engtuncay\Phputils8\Meta\Fdr;
use Engtuncay\Phputils8\Meta\FiKeybean;
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

    /**
     * shows whether or not there is a connection
     *
     * tr: bağlantı kurulup kurulmadığını gösterir.
     */
    public ?bool $boConnection = null;

    public ?PDOException $pdoException;

    public function __construct($host, $dbname, $username, $password, $charset = 'utf8')
    {
        try {
            parent::__construct('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
            $this->dbName = $dbname;
            $this->query('SET CHARACTER SET ' . $charset);
            $this->query('SET NAMES ' . $charset);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->boConnection = true;
        } catch (PDOException $e) {
            $this->pdoException = $e;
            $this->boConnection = false;
        }
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
    $boExec = null;

    if ($fkbParams != null) {
      $boExec = $stmt->execute($fkbParams->getParams());
    } else {
      $boExec = $stmt->execute();
    }

    $fdr->setBoExec($boExec);
    $fdr->setBoResult($boExec);
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
