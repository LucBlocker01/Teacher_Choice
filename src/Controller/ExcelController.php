<?php

namespace App\Controller;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExcelController extends AbstractController
{
    #[Route('/excel', name: 'app_excel')]
    public function index(): Response
    {
        return $this->render('excel/index.html.twig', [
            'controller_name' => 'ExcelController',
        ]);
    }

    #[Route('/excel/import', name: 'app_excel_import')]
    public function import(Request $request): Response
    {
        $fileExcel = strval($request->files->get('excel'));

        if ($fileExcel) {
            $spreadsheets = IOFactory::load($fileExcel)->getAllSheets();

            $data = $this->spreadsheetsToData($spreadsheets);

            return new JsonResponse($data);
            // Data to OrganisedData.
            // OrganisedData to Database.
        }

        return $this->redirectToRoute('app_excel');
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
            $idxCheckWeek = 'G';
            while ($idxCheckWeek != $maxCol) {
                $color = $spreadsheet->getCell($idxCheckWeek.'1')->getStyle()->getFill()->getStartColor()->getRGB();

                // Depending on the color of the cell, we define whether it is a holiday, work-study or a intership week.
                switch ($color) {
                    // If the color is for Holiday.
                    case 'FFDBB6':
                        $semesterSpecialWeek['holiday'][] = $spreadsheet->getCell($idxCheckWeek.'1')->getCalculatedValue();

                        if ('S5' == $title || 'S6' == $title) {
                            $semesterSpecialWeek['workStudy'][] = $spreadsheet->getCell($idxCheckWeek.'1')->getCalculatedValue();
                        }

                        break;

                        // If the color is for WorkStudy.
                    case '77BC65':
                        $semesterSpecialWeek['workStudy'][] = $spreadsheet->getCell($idxCheckWeek.'1')->getCalculatedValue();

                        break;

                        // If the color is for Internship.
                    case 'FF6D6D':
                        $semesterSpecialWeek['internship'][] = $spreadsheet->getCell($idxCheckWeek.'1')->getCalculatedValue();

                        if ('S5' == $title || 'S6' == $title) {
                            $semesterSpecialWeek['workStudy'][] = $spreadsheet->getCell($idxCheckWeek.'1')->getCalculatedValue();
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

        return $data;
    }
}
