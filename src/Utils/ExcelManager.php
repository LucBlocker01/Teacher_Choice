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
use App\Entity\WeekStatus;
use Doctrine\Persistence\ManagerRegistry;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelManager
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function importExcel(string $path = 'public/excel/Voeux.xlsx'): void
    {
        $spreadsheets = IOFactory::load($path)->getAllSheets();
        $rawData = $this->spreadsheetsToData($spreadsheets);
        $organisedData = $this->organiseData($rawData);
        $this->importDataToDatabase($organisedData);
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

                    case 'FFFFFF':
                        $semesterSpecialWeek[$spreadsheet->getCell($idxCheckWeek.'1')->getCalculatedValue()][] = 'lesson';

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

    public function importDataToDatabase(array $data)
    {
        $year = date('Y').'/'.(date('Y') + 1);

        // For each Semester in the data, we create one.
        foreach ($data as $semesterKey => $semesterData) {
            $semester = new Semester($semesterKey, $year);
            $this->doctrine->getManager()->persist($semester);

            foreach ($semesterData['specialWeek'] as $specialWeekKey => $specialWeek) {
                $week = $this->doctrine->getRepository(Week::class)->findOneBy(['weekNum' => $specialWeekKey]);
                $isHoliday = false;
                $isWorkStudy = false;
                $isInternship = false;

                foreach ($specialWeek as $typeWeek) {
                    switch ($typeWeek) {
                        case 'holiday':
                            $isHoliday = true;
                            break;

                        case 'workStudy':
                            $isWorkStudy = true;
                            break;

                        case 'internship':
                            $isInternship = true;
                            break;

                        default:
                            break;
                    }
                }

                $weekStatus = new WeekStatus($isHoliday, $isWorkStudy, $isInternship, $semester, $week);
                $this->doctrine->getManager()->persist($weekStatus);
            }

            $this->doctrine->getManager()->flush();

            foreach ($semesterData as $subjectKey => $subjectData) {
                if ('specialWeek' != $subjectKey) {
                    $subject = new Subject($subjectKey, $semester, null);
                    $this->doctrine->getManager()->persist($subject);

                    foreach ($subjectData as $lessonKey => $lessonData) {
                        $lesson = new Lesson($lessonKey, $subject);
                        $this->doctrine->getManager()->persist($lesson);

                        foreach ($lessonData as $lessonInformationKey => $lessonInformationData) {
                            if ('tags' != $lessonInformationKey) {
                                $lessonType = $this->doctrine->getRepository(LessonType::class)->findOneBy(['name' => $lessonInformationData['type']]);
                                $lessonInformation = new LessonInformation($lessonInformationData['group'], strval($lessonInformationData['sae']), $lesson, $lessonType);

                                foreach ($lessonInformationData['planning'] as $lessonPlanningData) {
                                    $week = $this->doctrine->getRepository(Week::class)->findOneBy(['weekNum' => $lessonPlanningData['week']]);
                                    $weekStatus = $this->doctrine->getRepository(WeekStatus::class)->findOneBy(['semester' => $semester, 'week' => $week]);

                                    if (0 != intval($lessonPlanningData['nbHours']) || null != $weekStatus) {
                                        $lessonPlanning = new LessonPlanning(intval($lessonPlanningData['nbHours']), $lessonInformation, $weekStatus);
                                        $this->doctrine->getManager()->persist($lessonPlanning);
                                    }
                                }

                                $this->doctrine->getManager()->persist($lessonInformation);
                            }
                        }

                        $tabTags = explode(' / ', $lessonData['tags']);

                        foreach ($tabTags as $tag) {
                            $searchTag = $this->doctrine->getRepository(Tag::class)->findOneBy(['name' => $tag]);

                            if (null == $searchTag) {
                                $tagCreate = new Tag($tag);
                                $tagCreate->addLesson($lesson);

                                $this->doctrine->getManager()->persist($tagCreate);
                                $this->doctrine->getManager()->flush();
                            } else {
                                $searchTag->addLesson($lesson);
                            }
                        }
                    }
                }
            }
        }

        $this->doctrine->getManager()->flush();
    }
}