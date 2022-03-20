<?php
header("Content-Type: text/plain");
require_once("src/common.inc.php");
$request = new RequestSurveyLoader;
$storage = new SurveyFileStorage;
$printer = new SurveyPrinter;
$survey = $request->createNewSurvey('first_name', 'last_name', 'email', 'age'); 
if ($survey)
{
    echo "Loading old data from file:\n\n";
    $storage->loadFileData($survey, $storage);
    $printer->printSurvey($survey);

    echo "\nWriting new parameters to file:\n\n";
    $survey = $request->createNewSurvey('first_name', 'last_name', 'email', 'age'); 
    if ($survey)
    {
        $storage->saveData($survey, $storage);
        $storage->loadFileData($survey, $storage);
        $printer->printSurvey($survey);
    }
}