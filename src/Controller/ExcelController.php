<?php

namespace App\Controller;

use App\Repository\SemesterRepository;
use App\Utils\ExcelManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ExcelController extends AbstractController
{
    private ExcelManager $excelManager;

    public function __construct(ExcelManager $excelManager)
    {
        $this->excelManager = $excelManager;
    }

    #[Route('/excel', name: 'app_excel')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(SemesterRepository $semesterRepository): Response
    {
        $year = date('Y').'/'.((int) date('Y') + 1);
        $semesters = $semesterRepository->findBy(['year' => $year]);

        return $this->render('excel/index.html.twig', [
            'semesters' => $semesters,
        ]);
    }

    #[Route('/excel/import', name: 'app_excel_import')]
    #[IsGranted('ROLE_ADMIN')]
    public function import(Request $request, ManagerRegistry $doctrine): Response
    {
        $fileExcel = strval($request->files->get('excel'));

        $this->excelManager->importExcel($fileExcel);

        return $this->redirectToRoute('app_excel');
    }

    #[Route('/excel/export', name: 'app_excel_export')]
    #[IsGranted('ROLE_ADMIN')]
    public function export()
    {
        $this->excelManager->writeExcel();

        return $this->redirectToRoute('app_excel');
    }

    #[Route('/excel/export/modele', name: 'app_excel_export_modele')]
    #[IsGranted('ROLE_ADMIN')]
    public function downloadExcelModele(): BinaryFileResponse
    {
        $excelPath = 'excel/MaquetteVoeux.xlsx';

        $response = new BinaryFileResponse($excelPath);
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'maquetteVoeux.xlsx' // Nom du fichier téléchargé par l'utilisateur
        );

        return $response;
    }
}
