<?php

namespace App\Module\Survey;

class Service
{
    private RequestSurveyLoader $request;
    private SurveyFileStorage $storage;

    function __construct()
    {
        $this->request = new RequestSurveyLoader();
        $this->storage = new SurveyFileStorage();
    }

    public function saveSurvey(): array
    {
        $survey = $this->request->createNewSurvey('first_name', 'last_name', 'email', 'age');
        $title = "Don't found email!";
        if ($survey)
        {
            $this->storage->saveData($survey);
            $title = "Done! Saved the survey:";
        }
        return [$survey, $title];
    }

    public function printSurvey(): array
    {
        $survey = $this->request->createNewSurvey('first_name', 'last_name', 'email', 'age');
        $title = "Don't found email!";
        if ($survey)
        {
            $this->storage->loadFileData($survey);
            $title = "Loading old data from file:";
        }
        return [$survey, $title];
    }
}