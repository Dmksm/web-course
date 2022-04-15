<?php

namespace App\Survey;

use App\Module\Survey\RequestSurveyLoader;
use App\Module\Survey\SurveyFileStorage;
use App\Module\Survey\SurveyPrinter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SurveyI extends AbstractController
{
    public static function printingSurvey(): array
    {
        $request = new RequestSurveyLoader;
        $storage = new SurveyFileStorage;
        $survey = $request->createNewSurvey('first_name', 'last_name', 'email', 'age');
        $surveyArray = ["Don't found email!", "", "", "", ""];
        if ($survey and $storage->loadFileData($survey))
        {
            $storage->loadFileData($survey);
            $surveyArray = ["Loading old data from file:", 'First name: ' . SurveyPrinter::printFirstName($survey), 'Last name: ' . SurveyPrinter::printLastName($survey), 'Email: ' . SurveyPrinter::printEmail($survey), 'Age: ' . SurveyPrinter::printAge($survey)];
        }
        return ['operation_with_survey' => $surveyArray[0],
            'first_name' => $surveyArray[1],
            'last_name' => $surveyArray[2],
            'email' => $surveyArray[3],
            'age' => $surveyArray[4]];
    }
    public static function savingSurvey(): array
    {
        $request = new RequestSurveyLoader;
        $storage = new SurveyFileStorage;
        $survey = $request->createNewSurvey('first_name', 'last_name', 'email', 'age');
        $surveyArray = ["Don't found email!", "", "", "", ""];
        if ($survey)
        {
            $storage->saveData($survey, $storage);
            $storage->loadFileData($survey, $storage);
            $surveyArray = ["Done! Saved the survey:", 'First name: ' . SurveyPrinter::printFirstName($survey), 'Last name: ' . SurveyPrinter::printLastName($survey), 'Email: ' . SurveyPrinter::printEmail($survey), 'Age: ' . SurveyPrinter::printAge($survey)];
        }
        return ['operation_with_survey' => $surveyArray[0],
            'first_name' => $surveyArray[1],
            'last_name' => $surveyArray[2],
            'email' => $surveyArray[3],
            'age' => $surveyArray[4]];
    }
}