<?php

namespace App\Controller;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

            // Transform Spreadsheet to Data.
            // Data to OrganisedData.
            // OrganisedData to Database.
        }

        return $this->redirectToRoute('app_excel');
    }
}
