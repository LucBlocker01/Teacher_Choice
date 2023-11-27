<?php

declare(strict_types=1);

namespace App\Utils;

use App\Entity\Lesson;
use App\Entity\LessonInformation;
use App\Entity\LessonPlanning;
use App\Entity\LessonType;
use App\Entity\Semester;
use App\Entity\Subject;
use App\Entity\Tag;
use App\Entity\Week;
use App\Repository\SemesterRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelManager
{
    private ManagerRegistry $doctrine;
    private ObjectManager $entityManager;
    private SemesterRepository $semesterRepository;

    public function __construct(ManagerRegistry $doctrine, SemesterRepository $semesterRepository)
    {
        $this->doctrine = $doctrine;
        $this->entityManager = $doctrine->getManager();
        $this->semesterRepository = $semesterRepository;
    }

    public function importExcel(string $path = 'public/excel/Voeux.xlsx'): void
    {
        $spreadsheets = IOFactory::load($path)->getAllSheets();

        $this->retryImportBD($spreadsheets);
    }

    public function retryImportBD($excelDoc)
    {
        $year = date('Y').'/'.((int) date('Y') + 1);

        foreach ($excelDoc as $excelPage) {
            // On regarde si le semestre existe, sinon on le crée
            $semesterName = $excelPage->getTitle();
            $semester = $this->doctrine->getRepository(Semester::class)->findOneBy(['name' => $semesterName, 'year' => $year]);

            if (null != $semester) {
                if ($semester->asChoice()) {
                    dd('NON');
                }

                $this->entityManager->remove($semester);
                $this->entityManager->flush();
            }

            $semester = new Semester($semesterName, $year);
            $this->entityManager->persist($semester);
            $this->entityManager->flush();

            $startRow = 1;
            $startCol = 'A';
            $maxRow = 1;
            $maxCol = 'A';

            while ('///' != $excelPage->getCell($startCol.$maxRow)->getCalculatedValue()) {
                ++$maxRow;
            }

            while ('///' != $excelPage->getCell($maxCol.$startRow)->getCalculatedValue()) {
                ++$maxCol;
            }

            $tempTag = '';

            for ($idxRow = 2; $idxRow <= $maxRow - 1; ++$idxRow) {
                if (null != $excelPage->getCell('A'.$idxRow)->getCalculatedValue()) {
                    $tempSubject = $excelPage->getCell('A'.$idxRow)->getCalculatedValue();
                    $subject = new Subject($tempSubject, $semester);
                    $this->entityManager->persist($subject);
                }

                if (null != $excelPage->getCell('B'.$idxRow)->getCalculatedValue()) {
                    $tempLesson = $excelPage->getCell('B'.$idxRow)->getCalculatedValue();
                    $lesson = new Lesson($tempLesson, $subject);
                    $this->entityManager->persist($lesson);
                }

                $lessonType = $this->doctrine->getRepository(LessonType::class)->findOneBy(['name' => $excelPage->getCell('D'.$idxRow)->getCalculatedValue()]);

                $lessonInformation = new LessonInformation(
                    intval($excelPage->getCell('C'.$idxRow)->getCalculatedValue()),
                    strval($excelPage->getCell('F'.$idxRow)->getCalculatedValue()),
                    $lesson,
                    $lessonType
                );

                $this->entityManager->persist($lessonInformation);

                $actualCol = 'H';
                while ($maxCol != $actualCol) {
                    $week = $this->doctrine->getRepository(Week::class)->findOneBy(['weekNum' => $excelPage->getCell($actualCol.'1')->getCalculatedValue()]);

                    if (is_numeric($excelPage->getCell($actualCol.$idxRow)->getCalculatedValue())) {
                        $lessonPlanning = new LessonPlanning(
                            intval($excelPage->getCell($actualCol.$idxRow)->getCalculatedValue()),
                            $lessonInformation,
                            $week
                        );

                        $this->entityManager->persist($lessonPlanning);
                    }

                    ++$actualCol;
                }

                // Si la colonne des Tags n'est pas nulle, on change la variable temporaire.
                if (null != $excelPage->getCell('G'.$idxRow)->getCalculatedValue()) {
                    $tempTag = $excelPage->getCell('G'.$idxRow)->getCalculatedValue();
                }

                $tabTags = explode(' / ', $tempTag);

                foreach ($tabTags as $tag) {
                    $searchTag = $this->doctrine->getRepository(Tag::class)->findOneBy(['name' => $tag]);

                    if (null == $searchTag) {
                        $tagCreate = new Tag($tag);
                        $tagCreate->addLesson($lesson);
                        $this->entityManager->persist($tagCreate);
                    } else {
                        $searchTag->addLesson($lesson);
                    }
                }

                $this->entityManager->flush();
            }
        }
    }

    public function writeExcel()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0);

        $worksheet = new Worksheet($spreadsheet, 'S1');
        $spreadsheet->addSheet($worksheet);

        $semester = $this->semesterRepository->findOneBy(['year' => '2023/2024', 'name' => 'S1']);
        $subjects = $semester->getSubjects();

        $idx = 1;

        foreach ($subjects as $subjectKey => $subject) {
            // On écrit le nom de la MR
            $worksheet->setCellValue('A'.$idx, $subject->getName());
            $worksheet->getStyle('A'.$idx)->getAlignment()->setHorizontal('center');

            $lessons = $subject->getLessons();

            foreach ($lessons as $lessonKey => $lesson) {
                // On écrit le nom de la Lesson
                $worksheet->setCellValue('B'.$idx, $lesson->getName());
                $worksheet->getStyle('B'.$idx)->getAlignment()->setHorizontal('center');

                $lessonInformations = $lesson->getLessonInformation();

                foreach ($lessonInformations as $lessonInformation) {
                    // On écrit le infos de la Lesson.
                    $worksheet->setCellValue('C'.$idx, $lessonInformation->getNbGroups());
                    $worksheet->setCellValue('D'.$idx, $lessonInformation->getLessonType()->getName());
                    $worksheet->setCellValue('F'.$idx, $lessonInformation->getSaeSupport());

                    $lessonPlannings = $lessonInformation->getLessonPlannings();

                    $actualColumn = 'H';
                    foreach ($lessonPlannings as $lessonPlanning) {
                        $worksheet->setCellValue($actualColumn.$idx, $lessonPlanning->getWeek()->getWeekNum().' : '.$lessonPlanning->getNbHours());

                        ++$actualColumn;
                    }

                    ++$idx;
                }
            }
        }

        $worksheet->getColumnDimension('A')->setAutoSize(true);
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->getColumnDimension('C')->setAutoSize(true);
        $worksheet->getColumnDimension('D')->setAutoSize(true);
        $worksheet->setCellValue('A'.$idx, '///');

        $idxMerge = 0;
        $idxSubjectToMergeStart = 1;
        $idxSubjectToMergeEnd = 1;
        $idxLessonToMergeStart = 1;
        $idxLessonToMergeEnd = 1;

        while ('///' != $worksheet->getCell('A'.$idxMerge)->getCalculatedValue()) {
            ++$idxMerge;

            if (null == $worksheet->getCell('A'.$idxMerge)->getCalculatedValue()) {
                $idxSubjectToMergeEnd = $idxMerge;
            } else {
                if ($idxSubjectToMergeStart != $idxSubjectToMergeEnd) {
                    $worksheet->mergeCells('A'.$idxSubjectToMergeStart.':A'.$idxSubjectToMergeEnd);
                }

                $idxSubjectToMergeStart = $idxMerge;
                $idxSubjectToMergeEnd = $idxMerge;
            }

            if (null != $worksheet->getCell('B'.$idxMerge)->getCalculatedValue()) {
                if ($idxLessonToMergeStart != $idxLessonToMergeEnd) {
                    $worksheet->mergeCells('B'.$idxLessonToMergeStart.':B'.$idxLessonToMergeEnd);
                }

                $idxLessonToMergeStart = $idxMerge;
            }
            $idxLessonToMergeEnd = $idxMerge;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('excel/output.xlsx');
    }
}
