<?php
class SurveyPrinter 
{ 
    public function printSurvey($survey)
    { 
        if (file_exists("./data/" . $survey->getParameterEmail() . ".txt"))
        {
            echo 'First name:' . $survey->getParameterFirstName() . "\n" . 'Last name:' . $survey->getParameterLastName() . "\n" . 'Email:' . $survey->getParameterEmail() . "\n" . 'Age:' . $survey->getParameterAge() . "\n"; 
        }
        else
        {
            echo "Error printing: no such file or directory\n";
        }
    }
}