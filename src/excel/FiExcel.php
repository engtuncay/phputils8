<?php

namespace Engtuncay\Phputils8\excel;

use Engtuncay\Phputils8\meta\Fdr;
use Engtuncay\Phputils8\meta\FiColList;
use Engtuncay\Phputils8\meta\FiKeybean;
use Engtuncay\Phputils8\meta\FkbList;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FiExcel
{
  /**
   * @param $inputFileName
   * @return Fdr value FkbList
   */
  public static function readExcelFile($inputFileName,FiColList $fiCols): Fdr
  {
    //$inputFileName = $uploadedFile['tmp_name'];
    $fdrMain = new Fdr();

    try {
      $spreadsheet = IOFactory::load($inputFileName);
      $sheet = $spreadsheet->getActiveSheet();

      // En yüksek satır ve sütun numaralarını al
      $highestRow = $sheet->getHighestRow(); // Toplam satır sayısı
      $highestColumn = $sheet->getHighestColumn(); // En yüksek sütun harfi (örneğin, "D")
      //$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // Sütun harfini indekse çevir (örneğin, "D" -> 4)
      $fkbList = new FkbList();
      // URTBC burası düzeltilecek

      /** @var string[] $fiExcelHeaders */
      $fiExcelHeaders = [];
      //list($row, $col, $cellValue, $fiExcelHeaders)
      $headerRowNo  = self::findHeaderRowNo($sheet, $fiCols);

      if($headerRowNo==-1){
        $fdrMain->setMessage("başlık bulunamadı.");
        $fdrMain->setBoResult(false);
        return $fdrMain;
      }

      for ($col = 'A'; $col <= $highestColumn; $col++) {
        // Hücredeki değeri al
        $cellValue = $sheet->getCell($col . $headerRowNo)->getFormattedValue();
        //echo "<td>" . htmlspecialchars($cellValue) . "</td>"; // Hücreyi yazdır
        if(empty($cellValue))continue;
        $fiExcelHeaders[$col] = $cellValue;
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
          $fkb->put($fiExcelHeaders[$col],$cellValue);
        }

        $fkbList->add($fkb);

      }

      $fdrMain->setBoResult(true);

    } catch (Exception $e) {
      //echo 'Excel dosyası okunurken hata oluştu: ', $e->getMessage(), PHP_EOL;
      $fdrMain->setBoResult(false);
      $fdrMain->setException($e);
      $fdrMain->setMessage("Excel dosyası okunurken hata oluştu: ". $e->getMessage());
    }

    $fdrMain->setFkbList($fkbList);
    return $fdrMain;
  }

  /**
   * @param int $highestRow
   * @param string $highestColumn
   * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
   * @param FiColList $fiCols
   * @param array $fiExcelHeaders
   * @return array
   */
  public static function findHeaderRowNo(Worksheet $sheet, FiColList $fiCols): int
  { //, array $fiExcelHeaders

    // En yüksek satır ve sütun numaralarını al
    $highestRow = $sheet->getHighestRow(); // Toplam satır sayısı
    $highestColumn = $sheet->getHighestColumn(); // En yüksek sütun harfi (örneğin, "D")

    for ($row = 1; $row <= $highestRow; $row++) {
      // Sütunları gezmek için 'for' döngüsü
      $boFound = false;
      for ($col = 'A'; $col <= $highestColumn; $col++) {
        // Hücredeki değeri al
        $cellValue = $sheet->getCell($col . $row)->getFormattedValue();
        //echo "<td>" . htmlspecialchars($cellValue) . "</td>"; // Hücreyi yazdır
        if (in_array($cellValue,$fiCols->getItemsHeader())) {
          $boFound = true;
          break;
        }

        if($boFound)break;
      }

    }

    if(!$boFound) return -1;

    return $row; //array($row, $col, $cellValue, $fiExcelHeaders);
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