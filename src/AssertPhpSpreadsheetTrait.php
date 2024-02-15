<?php

declare(strict_types=1);

namespace Tests;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

trait AssertPhpSpreadsheetTrait
{
    protected function assertSpreadsheet(
        Spreadsheet $spreadsheet,
        string $fileName,
    ): void {
        $expectedContent = file_get_contents($fileName);
        $content = $this->spreadsheetAsString($spreadsheet);

        // for dev only, uncomment this line to overwrite all your expected files
        // file_put_contents($fileName, $content);

        $this->assertSame($expectedContent, $content);
    }

    protected function dumpSpreadsheet(
        Spreadsheet $spreadsheet,
        string $outputFileName,
    ): void {
        $writer = new Xlsx($spreadsheet);
        $writer->save($outputFileName);
    }

    protected function spreadsheetAsString(
        Spreadsheet $spreadsheet,
    ): string {
        $string  = '';

        foreach ($spreadsheet->getAllSheets() as $sheet) {
            $string .= 'SHEET '.$sheet->getTitle()."\n";
            $string .= var_export($sheet->toArray(), true);
        }

        return $string;
    }
}
