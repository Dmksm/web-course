<?php
header("Content-Type: text/plain");
require_once("src/common.inc.php");
$request = new RequestSurveyLoader;
$storage = new SurveyFileStorage;
$survey = $request->createNewSurvey('first_name', 'last_name', 'email', 'age'); 
if ($survey)
{
    echo "Loading old data from file:" . PHP_EOL . PHP_EOL;
    $storage->loadFileData($survey, $storage);
    SurveyPrinter::printSurvey($survey);

    echo PHP_EOL . "Writing new parameters to file:" . PHP_EOL . PHP_EOL;
    $survey = $request->createNewSurvey('first_name', 'last_name', 'email', 'age'); 
    if ($survey)
    {
        $storage->saveData($survey, $storage);
        $storage->loadFileData($survey, $storage);
        SurveyPrinter::printSurvey($survey);
    }
}