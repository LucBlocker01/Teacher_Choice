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
        $organisedData = $this->organiseData($rawData);
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

    public function organiseData($data): array
    {
        $finalData = [];

        // For each Semester in $data.
        $idxSemester = 0;
        foreach ($data as $semesterInfo) {
            $tempSubject = '';
            $tempLesson = '';
            $tempTag = '';

            $finalData[array_keys($data)[$idxSemester]]['specialWeek'] = $semesterInfo['specialWeek'];

            // For each Row of the Semester.
            for ($idxRowData = 1; $idxRowData < sizeof($semesterInfo) - 1; ++$idxRowData) {
                // Retrieve all the information of the hours for this Lesson.
                $tabPlanning = [];

                for ($idxPlanning = 7; $idxPlanning <= sizeof($semesterInfo[$idxRowData]) - 1; ++$idxPlanning) {
                    $tabPlanning[] = [
                        'week' => $semesterInfo[0][$idxPlanning],
                        'nbHours' => $semesterInfo[$idxRowData][$idxPlanning],
                    ];
                }

                // Retrieve the other information useful for the lesson.
                $tabLessonInformation = [
                    'group' => $semesterInfo[$idxRowData][2],
                    'type' => $semesterInfo[$idxRowData][3],
                    'sae' => $semesterInfo[$idxRowData][5],
                    'planning' => $tabPlanning,
                ];

                // If the Row haven't a subject name, we reuse the old one because it concern the same Subject.
                if ('' != $semesterInfo[$idxRowData][0]) {
                    $tempSubject = $semesterInfo[$idxRowData][0];
                }

                // If the Row haven't a lesson name, we reuse the old one because it concern the same Lesson.
                if ('' != $semesterInfo[$idxRowData][1]) {
                    $tempLesson = $semesterInfo[$idxRowData][1];
                }

                // If the Row haven't a lesson name, we reuse the old one because it concern the same Lesson.
                if ('' != $semesterInfo[$idxRowData][6]) {
                    $tempTag = $semesterInfo[$idxRowData][6];
                }

                // We put all the informations retrieve into the final array of Data.
                $finalData[array_keys($data)[$idxSemester]][$tempSubject][$tempLesson][] = $tabLessonInformation;
                // We put the tags in the array.
                $finalData[array_keys($data)[$idxSemester]][$tempSubject][$tempLesson]['tags'] = $tempTag;
            }

            ++$idxSemester;
        }

        return $finalData;
    }
}
