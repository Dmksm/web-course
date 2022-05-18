<?php

namespace App\View;

use App\Module\Survey\Survey;
use App\Module\Survey\SurveyPrinter;

class SurveyView
{
    public static function getTemplate(): string
    {
        return 'CreatingSurvey.html.twig';
    }

    public static function getPage(): string
    {
        return 'CreatingPage.html.twig';
    }

    public static function getPageData(): array
    {
        return ['operation_with_survey' => 'SaveSurvey'];
    }

    public static function getArgs(?Survey $survey, string $title): array
    {
        $surveyArray = ['', '', '', '', ''];
        $defaultTitle = "Don't found email!";
        if ($survey && (file_exists("./data/" . $survey->getParameterEmail() . ".txt")))
        {
            $surveyArray = ['First name: ' . SurveyPrinter::printFirstName($survey), 'Last name: ' . SurveyPrinter::printLastName($survey), 'Email: ' . SurveyPrinter::printEmail($survey), 'Age: ' . SurveyPrinter::printAge($survey), SurveyPrinter::printAvatar($survey)];
            $defaultTitle = $title;
        }
        return ['operation_with_survey' => $defaultTitle,
        'first_name' => $surveyArray[0],
        'last_name' => $surveyArray[1],
        'email' => $surveyArray[2],
        'age' => $surveyArray[3],
        'avatar' => $surveyArray[4]];
    }
}