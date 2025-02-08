<?php

namespace Engtuncay\Phputils8\excel;

use Engtuncay\Phputils8\meta\Fdr;
use Engtuncay\Phputils8\meta\FiKeybean;
use Engtuncay\Phputils8\meta\FkbList;
use PhpOffice\PhpSpreadsheet\IOFactory;

class FiExcel
{
  /**
   * @param $inputFileName
   * @return Fdr value FkbList
   */
  public static function readExcelFile($inputFileName): Fdr
  {
    //$inputFileName = $uploadedFile['tmp_name'];
    $fdrMain = new Fdr();

    try {
      $spreadsheet = IOFactory::load($inputFileName);
      $sheet = $spreadsheet->getActiveSheet();

      // En yüksek satır ve sütun numaralarını al
      $highestRow = $sheet->getHighestRow(); // Toplam satır sayısı
      $highestColumn = $sheet->getHighestColumn(); // En yüksek sütun harfi (örneğin, "D")
      $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // Sütun harfini indekse çevir (örneğin, "D" -> 4)
      $fkbList = new FkbList();

      $fiExcelHeaders = [];

      $row = 1;
      // Sütunları gezmek için 'for' döngüsü
      for ($col = 'A'; $col <= $highestColumn; $col++) {
        // Hücredeki değeri al
        $cellValue = $sheet->getCell($col . $row)->getFormattedValue();
        //echo "<td>" . htmlspecialchars($cellValue) . "</td>"; // Hücreyi yazdır
        $fiExcelHeaders[$col] = $cellValue;
      }

      //echo PHP_EOL; // Satır sonu

      // Satırları dolaş
      $row++;
      for (; $row <= $highestRow; $row++) {
        // Sütunları dolaş
        $fkb = new FiKeybean();
        // Sütunları gezmek için 'for' döngüsü
        for ($col = 'A'; $col <= $highestColumn; $col++) {
          // Hücredeki değeri al
          $cellValue = $sheet->getCell($col . $row)->getFormattedValue();
          //echo "<td>" . htmlspecialchars($cellValue) . "</td>"; // Hücreyi yazdır
          $fkb->put($fiExcelHeaders[$col],$cellValue);
          //$fiExcelHeaders[$col] = $cellValue;
        }
        $fkbList->add($fkb);

//        for ($col = 1; $col <= $highestColumnIndex; $col++) {
//          // Hücre değerini al
//          $cellValue = $sheet->getCellByColumnAndRow($col, $row)->getValue();
//          echo $cellValue . "\t";
//        }
//        echo PHP_EOL; // Satır sonu
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
}