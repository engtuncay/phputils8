<?php

namespace Engtuncay\Phputils8\FiCsv;

use Engtuncay\Phputils8\Log\FiLog;
use Engtuncay\Phputils8\FiDto\Fdr;
use Engtuncay\Phputils8\FiDto\FicList;
use Engtuncay\Phputils8\FiDto\FiKeybean;
use Engtuncay\Phputils8\FiDto\FkbList;

class FiCsv
{
  public static function read($file, FicList $ficList): Fdr
  {
    $fdrMain = new Fdr();
    // CSV'yi okumak için bir dizi oluşturun
    $data = [];
    $fkbListData = new FkbList();

    // Dosyayı açın
    if (($handle = fopen($file, 'r')) !== false) {
      // Her satırı oku (ilk satır başlık varsayılır)
      while (($rowIndex = fgetcsv($handle, 1000, ",")) !== false) {
        $data[] = $rowIndex; // Her satırı diziye ekle
      }
      fclose($handle);
    }

    //print_r($data);

    list($fiExcelHeaders, $headerRowNo) = self::findHeader($ficList, $data);

    // Satırları dolaş
    $rowIndex = $headerRowNo + 1;
    for (; $rowIndex <= count($data); $rowIndex++) {
      // Sütunları dolaş
      //FiLog::$log?->debug($data[$rowIndex]);

      if (array_key_exists($rowIndex, $data)) {
        $row = $data[$rowIndex];
        $fkb = new FiKeybean();
        // Sütunları gezmek için 'for' döngüsü
        foreach ($fiExcelHeaders as $col => $value) {
          $cellValue = $row[$col];
          $fkb->put($value, $cellValue);
        }
        $fkbListData->add($fkb);
      }
    }

    $fdrMain->setBoResult(true);
    $fdrMain->setFkbList($fkbListData);
    return $fdrMain;
  }

  public static function findHeader(FicList $ficList, array $data): array
  {
    /** @var int[] $fiExcelHeaders */
    $fiExcelHeaders = [];

    $boFoundHeaderRow = false;
    /** @var array $data */
    for ($rowHeaderNo = 0; $rowHeaderNo <= count($data); $rowHeaderNo++) {
      // Sütunları gezmek için 'for' döngüsü
      if (!array_key_exists($rowHeaderNo, $data)) {
        continue;
      }
      $row = $data[$rowHeaderNo];

      for ($colIndex = 0; $colIndex <= count($row); $colIndex++) {
        // Hücredeki değeri al
        if (array_key_exists($colIndex, $row)) {
          $cellValue = $row[$colIndex];   //$sheet->getCell($colIndex . $rowHeaderNo)->getFormattedValue();
          //
          if (in_array($cellValue, $ficList->getItemsHeader())) {
            $boFoundHeaderRow = true;
            FiLog::$log?->debug(sprintf("boFoundHeaderRow:%s", $boFoundHeaderRow));
            $fiExcelHeaders[$colIndex] = $ficList->getArrayHeaderToField()[$cellValue];
          }
        }


      }

      if ($boFoundHeaderRow) break;
    }

    //if(!$boFoundHeaderRow) return -1;
    return array($fiExcelHeaders, $rowHeaderNo);
  }

}