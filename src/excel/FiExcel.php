<?php

namespace Engtuncay\Phputils8\excel;

use Engtuncay\Phputils8\log\FiLog;
use Engtuncay\Phputils8\meta\Fdr;
use Engtuncay\Phputils8\meta\FiColList;
use Engtuncay\Phputils8\meta\FiKeybean;
use Engtuncay\Phputils8\meta\FkbList;
use Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FiExcel
{

  /**
   * @param $inputFileName
   * @return Fdr value FkbList
   */
  public static function readExcelFile($inputFileName, FiColList $fiCols): Fdr
  {
    //echo 'excel';
    FiLog::$log?->debug('Excel Read');
    //$inputFileName = $uploadedFile['tmp_name'];
    $fdrMain = new Fdr();

    try {
      $spreadsheet = IOFactory::load($inputFileName);
      $sheet = $spreadsheet->getActiveSheet();

      // En yüksek satır ve sütun numaralarını al
      $highestRow = $sheet->getHighestRow(); // Toplam satır sayısı
      $highestColumn = $sheet->getHighestColumn(); // En yüksek sütun harfi (örneğin, "D")
      //$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // Sütun harfini indekse çevir (örneğin, "D" -> 4)
      $fkbListExcel = new FkbList();

      /**
       * @var string[] $fiExcelHeaders key:colCharIndex,value:fieldName
       * @var int $headerRowNo
       */
      list($fiExcelHeaders, $headerRowNo) = self::findHeaders($sheet, $fiCols);

      if (array_count_values($fiExcelHeaders) == 0) {
        $fdrMain->setMessage("başlık bulunamadı.");
        $fdrMain->setBoResult(false);
        return $fdrMain;
      }

      //echo PHP_EOL; // Satır sonu

      // Satırları dolaş
      $row = $headerRowNo + 1;
      for (; $row <= $highestRow; $row++) {
        // Sütunları dolaş
        $fkb = new FiKeybean();
        // Sütunları gezmek için 'for' döngüsü
        foreach ($fiExcelHeaders as $col => $value) {
          $cellValue = $sheet->getCell($col . $row)->getFormattedValue();
          //echo "<td>" . htmlspecialchars($cellValue) . "</td>"; // Hücreyi yazdır
          $fkb->put($fiExcelHeaders[$col], $cellValue);
        }

        $fkbListExcel->add($fkb);
      }

      $fdrMain->setBoResult(true);
      $fdrMain->setFkbList($fkbListExcel);
      return $fdrMain;

    } catch (Exception $e) {
      //echo 'Excel dosyası okunurken hata oluştu: ', $e->getMessage(), PHP_EOL;
      FiLog::$log?->debug('Exception aldı');
      $fdrMain->setBoResult(false);
      $fdrMain->setException($e);
      $fdrMain->setMessage("Excel dosyası okunurken hata oluştu: " . $e->getMessage());
      return $fdrMain;
    }

  }

  /**
   * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
   * @param FiColList $fiCols
   * @return array
   */
  public static function findHeaders(Worksheet $sheet, FiColList $fiCols): array
  {
    /** @var string[] $fiExcelHeaders */
    $fiExcelHeaders = [];

    // En yüksek satır ve sütun numaralarını al
    $highestRow = $sheet->getHighestRow(); // Toplam satır sayısı
    $highestColumn = $sheet->getHighestColumn(); // En yüksek sütun harfi (örneğin, "D")

    $boFoundHeaderRow = false;
    for ($rowHeaderNo = 1; $rowHeaderNo <= $highestRow; $rowHeaderNo++) {
      // Sütunları gezmek için 'for' döngüsü
      for ($colIndex = 'A'; $colIndex <= $highestColumn; $colIndex++) {
        // Hücredeki değeri al
        $cellValue = $sheet->getCell($colIndex . $rowHeaderNo)->getFormattedValue();

        //FiLog::$log->info('info message:');
        //FiLog::$log?->debug('cellValue:' . $cellValue);
        //FiLog::$log?->debug(sprintf("itemHeaders:%s", implode("-", $fiCols->getItemsHeader())));

        //echo "<td>" . htmlspecialchars($cellValue) . "</td>"; // Hücreyi yazdır
        if (in_array($cellValue, $fiCols->getItemsHeader())) {
          $boFoundHeaderRow = true;
          FiLog::$log?->debug(sprintf("boFoundHeaderRow:%s", $boFoundHeaderRow));
          $fiExcelHeaders[$colIndex] = $fiCols->getItemsHeaderToField()[$cellValue];
        }

      }

      if ($boFoundHeaderRow) break;
    }

    //if(!$boFoundHeaderRow) return -1;
    return array($fiExcelHeaders, $rowHeaderNo); //array($rowHeaderNo, $colIndex, $cellValue, $fiExcelHeaders);
  }
}

//        for ($col = 1; $col <= $highestColumnIndex; $col++) {
//          // Hücre değerini al
//          $cellValue = $sheet->getCellByColumnAndRow($col, $row)->getValue();
//          echo $cellValue . "\t";
//        }

//        echo PHP_EOL; // Satır sonu
//        for ($col = 'A'; $col <= $highestColumn; $col++) {
//          // Hücredeki değeri al
//          $cellValue = $sheet->getCell($col . $row)->getFormattedValue();
//          //echo "<td>" . htmlspecialchars($cellValue) . "</td>"; // Hücreyi yazdır
//          $fkb->put($fiExcelHeaders[$col],$cellValue);
//          //$fiExcelHeaders[$col] = $cellValue;
//        }