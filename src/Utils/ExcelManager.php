<?php

declare(strict_types=1);

namespace App\Utils;

use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelManager
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function importExcel(string $path = 'excel/Voeux.xlsx')
    {
        $spreadsheets = IOFactory::load($path)->getAllSheets();
        $rawData = $this->spreadsheetsToData($spreadsheets);
    }

    /**
     * This function transform the spreadsheet into a 2D Array with all the information that is in the delimited area in the Excel.
     */
    public function spreadsheetsToData($spreadsheets): array
    {
        $data = [];

        foreach ($spreadsheets as $spreadsheet) {
            $semesterInfo = [];
            $semesterSpecialWeek = [];
            $title = $spreadsheet->getTitle();

            // Get the size of the informations in the Excel.
            $startRow = 1;
            $startCol = 'A';
            $maxRow = 1;
            $maxCol = 'A';

            while ('///' != $spreadsheet->getCell($startCol.$maxRow)->getCalculatedValue()) {
                ++$maxRow;
            }

            while ('///' != $spreadsheet->getCell($maxCol.$startRow)->getCalculatedValue()) {
                ++$maxCol;
            }

            // Get the color of cellule for search if the week is a Work Study, Internship, Holiday.
            $idxCheckWeek = 'F';
            while ($idxCheckWeek != $maxCol) {
                $color = $spreadsheet->getCell($idxCheckWeek.'1')->getStyle()->getFill()->getStartColor()->getRGB();

                // Depending on the color of the cell, we define whether it is a holiday, work-study or a intership week.
                switch ($color) {
                    // If the color is for Holiday.
                    case 'FFDBB6':
                        $semesterSpecialWeek[$spreadsheet->getCell($idxCheckWeek.'1')->getCalculatedValue()][] = 'holiday';

                        if ('S5' == $title || 'S6' == $title) {
                            $semesterSpecialWeek[$spreadsheet->getCell($idxCheckWeek.'1')->getCalculatedValue()][] = 'workStudy';
                        }

                        break;

                        // If the color is for WorkStudy.
                    case '77BC65':
                        $semesterSpecialWeek[$spreadsheet->getCell($idxCheckWeek.'1')->getCalculatedValue()][] = 'workStudy';

                        break;

                        // If the color is for Internship.
                    case 'FF6D6D':
                        $semesterSpecialWeek[$spreadsheet->getCell($idxCheckWeek.'1')->getCalculatedValue()][] = 'internship';

                        if ('S5' == $title || 'S6' == $title) {
                            $semesterSpecialWeek[$spreadsheet->getCell($idxCheckWeek.'1')->getCalculatedValue()][] = 'workStudy';
                        }

                        break;

                    default:
                        break;
                }

                ++$idxCheckWeek;
            }

            // For each Row in the Spreadsheet, we get information in each cell and put it in a Array.
            for ($idxRow = 1; $idxRow <= $maxRow - 1; ++$idxRow) {
                $rowData = [];

                // For each Column.
                $idxCol = $startCol;
                while ($idxCol != $maxCol) {
                    $dataCell = $spreadsheet->getCell($idxCol.$idxRow)->getCalculatedValue();
                    $rowData[] = $dataCell;
                    ++$idxCol;
                }

                // Put the Row information into the Array of data.
                $semesterInfo[] = $rowData;
            }

            $data[$title] = $semesterInfo;
            $data[$title]['specialWeek'] = $semesterSpecialWeek;
        }

        // return new JsonReponse($data);
        return $data;
    }
}
