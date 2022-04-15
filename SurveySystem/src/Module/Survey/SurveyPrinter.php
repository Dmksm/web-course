<?php

namespace App\Module\Survey;

class SurveyPrinter
{
    public static function printFirstName(Survey $survey): ?string
    { 
        return SurveyPrinter::getContent($survey, 'first_name');
    }

    public static function printLastName(Survey $survey): ?string
    {
        return SurveyPrinter::getContent($survey, 'last_name');
    }

    public static function printEmail(Survey $survey): ?string
    {
        return SurveyPrinter::getContent($survey, 'email');
    }

    public static function printAge(Survey $survey): ?string
    {
        return SurveyPrinter::getContent($survey, 'age');
    }

    private static function getContent(Survey $survey, string $parameter): ?string
    {
        $content = null;
        if (file_exists("./data/" . $survey->getParameterEmail() . ".txt"))
        {
            if ($parameter === 'first_name')
            {
                $content = $survey->getParameterFirstName();
            }
            if ($parameter === 'last_name')
            {
                $content = $survey->getParameterLastName();
            }
            if ($parameter === 'email')
            {
                $content = $survey->getParameterEmail();
            }
            if ($parameter === 'age')
            {
                $content = $survey->getParameterAge();
            }
        }
        return $content;
    }
}